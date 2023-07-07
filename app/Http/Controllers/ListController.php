<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $list = new TodoList();
        $list->name = $validatedData['name'];
        if (Auth::check()) {
            $list->created_by_id = intval(Auth::id());
        }
        $list->save();

        $taskNames = [];

        foreach ($request->all() as $fieldName => $fieldValue) {
            if ((strpos($fieldName, 'task') === 0) && ($fieldValue !== null)) {
                $taskNames[] = $fieldValue;
            }
        }

        $i = 1;
        foreach ($taskNames as $taskName) {
            $task = new Task();
            $task->name = $taskName;
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
        //
    }
}
