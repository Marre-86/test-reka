<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class SearchTasks extends Component
{
    public $searchTaskName = '';
    public $searchTag1 = '';
    public $searchTag2 = '';
    public $listId;

    public function render()
    {
        $tasks = Task::where('list_id', $this->listId)
             ->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTaskName . "') || '%'")
             ->whereHas('tags', function ($query) {
                $query->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTag1 . "') || '%'");
             })
             ->whereHas('tags', function ($query) {
                $query->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTag2 . "') || '%'");
             })
             ->get();

        return view('livewire.search-tasks', [
            'tasks' => $tasks,
        ]);
    }
}
