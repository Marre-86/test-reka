<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user() === null) {
            abort(403);
        }
        if (Auth::user()->hasRole('Admin')) {
            $lists = TodoList::orderBy('id', 'desc')->paginate(5);
        } else {
            $lists = TodoList::where('created_by_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
        }

        return view('list.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $images = $request->input('images');
        $rules = [
            'name' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048',
        ];
      //  dd($request->all());
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first('images.*')], 400);
        }

        $validatedData = $validator->validated();

        $list = new TodoList();
        $list->name = $validatedData['name'];
        if (Auth::check()) {
            $list->created_by_id = intval(Auth::id());
        }
        $list->save();

        $taskContent = [];

        foreach ($request->all() as $fieldName => $fieldValue) {
            if ((strpos($fieldName, 'task') === 0) && ($fieldValue !== null)) {
                $i = intval(substr($fieldName, 4, 9));
                if ((array_key_exists('images', $validatedData)) && (array_key_exists($i, $validatedData['images']))) {
                    $image = $validatedData['images'][$i];
                    $fileName = now()->format('Y.m.d-H.i.s') . '(' . $i . ').' . $image->extension();
                    $image->storeAs('public/images', $fileName);
                }

                $taskContent[] = ['name' => $fieldValue,
                                  'image' => $fileName ?? null];
                $fileName = null;
            }
        }

        $i = 1;
        foreach ($taskContent as $taskContentItem) {
            $task = new Task();
            $task->name = $taskContentItem['name'];
            $task->image = $taskContentItem['image'];
            $task->list_id = $list->id;
            $task->order_within_list = $i;
            $task->save();
            $i += 1;
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $list)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoList $list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TodoList $list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoList $list)
    {
        if ((Auth::user() === null) or (Auth::id() !== $list->created_by->id)) {
            abort(403);
        }
        $list = TodoList::findOrFail($list->id);
        $list->tasks()->each(function ($task) {
            if ($task->image !== null) {
                $taskFilePath = 'public/images/' . $task->image;
                if (Storage::exists($taskFilePath)) {
                    Storage::delete($taskFilePath);
                }
            }
            $task->delete();
        });
        $list->delete();

        flash('List has been successfully deleted!')->success();
        return redirect()->route('list.index');
    }
}
