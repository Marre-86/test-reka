<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    /**
     * Show the form for creating a new resource and render a table with resources
     */
    public function createAndIndex()
    {
        $lists = TodoList::where('created_by_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);

        return view('list.create', compact('lists'));
    }

    public function indexForAdmin()
    {
        $lists = TodoList::orderBy('id', 'desc')->paginate(5);

        return view('list.indexForAdmin', compact('lists'));
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
            'tags.*' => 'nullable',
        ];

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

        $n = 1;
        foreach ($request->all() as $fieldName => $fieldValue) {
            if ((strpos($fieldName, 'task') === 0) && ($fieldValue !== null)) {
                $i = intval(substr($fieldName, 4, 9));
                if ((array_key_exists('images', $validatedData)) && (array_key_exists($i, $validatedData['images']))) {
                    $image = $validatedData['images'][$i];
                    $fileName = now()->format('Y.m.d-H.i.s') . '(' . $i . ').' . $image->extension();
                    $image->storeAs('public/images', $fileName);
                }

                if ((array_key_exists('tags', $validatedData)) && (array_key_exists($i, $validatedData['tags']))) {
                    $tagsString = $validatedData['tags'][$i];
                    $tagsArray = array_map('trim', explode(',', $tagsString));
                    $uniqueTags = array_unique($tagsArray);
                    $tagIds[$n] = [];
                    foreach ($uniqueTags as $tagName) {
                        $tag = Tag::firstOrCreate(['name' => $tagName]);
                        $tagIds[$n][] = $tag->id;
                    }
                    $n += 1;
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
            $task->tags()->attach($tagIds[$i]);
            $i += 1;
        }

        $newList = TodoList::findOrFail($list->id);

        // Get the count of associated tasks
        $taskCount = $newList->tasks()->count();

        // Prepare the data for the JSON response
        $responseData = [
            'success' => true,
            'id' => $newList->id,
            'name' => $newList->name,
            'created_at' => $newList->created_at,
            'task_count' => $taskCount,
        ];

        // Return the JSON response
        return response()->json($responseData);
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $list)
    {
        $listCreatorId = $list->created_by->id ?? 0;
        if ((Auth::user() === null) or ((Auth::id() !== $listCreatorId) && (!Auth::user()->hasRole('Admin')))) {
            abort(403);
        }
        $list = TodoList::findOrFail($list->id);
        return view('list.show', ['list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoList $list)
    {
        $list = TodoList::findOrFail($list->id);
        $tagNamesArray = [];

        foreach ($list->tasks as $task) {
            $tagNames = $task->tags->pluck('name')->implode(', ');
            $tagNamesArray[$task->order_within_list] = $tagNames;
        }

        return view('list.edit', ['list' => $list, 'tags' => $tagNamesArray]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TodoList $list)
    {
     //   dd($request->all());
        $images = $request->input('images');
        $rules = [
            'name' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048',
            'tags.*' => 'nullable',
            'newImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048',
            'newTags.*' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect(route('list.edit', $list))
                    ->withErrors($validator)
                    ->withInput();
        }

        $validatedData = $validator->validated();
     //   dd($validatedData);
        $list->name = $validatedData['name'];
        $list->save();



        if ($request->input('newTasks') !== null) {
            foreach ($request->input('newTasks') as $newTaskGoesAfter => $newTaskName) {
                $task = new Task();
                $task->name = $newTaskName;
                if ((array_key_exists('newImages', $validatedData)) && (array_key_exists($newTaskGoesAfter, $validatedData['newImages']))) {   // phpcs:ignore
                    $image = $validatedData['newImages'][$newTaskGoesAfter];
                    $fileName = now()->format('Y.m.d-H.i.s') . '(' . $newTaskGoesAfter . ').' . $image->extension();
                    $image->storeAs('public/images', $fileName);
                    $task->image = $fileName ?? null;
                    $fileName = null;
                }
                $task->list_id = $list->id;
                $task->order_within_list = 999;
                $task->save();
                if ((array_key_exists('newTags', $validatedData)) && (array_key_exists($newTaskGoesAfter, $validatedData['newTags']))) {   // phpcs:ignore
                    $tagsString = $validatedData['newTags'][$newTaskGoesAfter];
                    $tagsArray = array_map('trim', explode(',', $tagsString));
                    $uniqueTags = array_unique($tagsArray);
                    foreach ($uniqueTags as $tagName) {
                        $tag = Tag::firstOrCreate(['name' => $tagName]);
                        $task->tags()->attach($tag->id);
                    }
                }
            }
        }



        if ($request->input('tasks') !== null) {
            foreach ($request->input('tasks') as $taskId => $taskName) {
                $task = Task::find($taskId);
                $task->name = $taskName;

                $tagsString = $validatedData['tags'][$taskId];
                $tagsArray = array_filter(array_map('trim', explode(',', $tagsString)));
                $uniqueTags = array_unique($tagsArray);
                // Deleting tags which are not attached to any other task and not found in the current input
                $detachedTags = $task->tags;
                $task->tags()->detach();
                foreach ($detachedTags as $detachedTag) {
                    if (($detachedTag->tasks()->count() === 0) && (!in_array($detachedTag->name, $uniqueTags))) {
                        $detachedTag->delete();
                    }
                }
                foreach ($uniqueTags as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $task->tags()->attach($tag->id);
                }
                if (array_key_exists('images', $validatedData) && array_key_exists($taskId, $validatedData['images'])) {
                    $imageFilePath = 'public/images/' . $task->image;
                    if (Storage::exists($imageFilePath)) {
                        Storage::delete($imageFilePath);
                    }
                    $image = $validatedData['images'][$taskId];
                    $fileName = now()->format('Y.m.d-H.i.s') . '(' . $taskId . ').' . $image->extension();
                    $image->storeAs('public/images', $fileName);
                    $task->image = $fileName;
                }

                $task->save();
            }
        }

        flash('List has been successfully updated!')->success();
        return redirect()->route('list.createAndIndex');
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
            // Deleting tags which are not attached to any other task
            $detachedTags = $task->tags;
            $task->tags()->detach();
            foreach ($detachedTags as $detachedTag) {
                if ($detachedTag->tasks()->count() === 0) {
                    $detachedTag->delete();
                }
            }

            $task->delete();
        });

        $list->delete();

        flash('List has been successfully deleted!')->success();
        return redirect()->route('list.createAndIndex');
    }
}
