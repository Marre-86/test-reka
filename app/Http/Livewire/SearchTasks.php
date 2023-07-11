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
        // we use 'when' here for cases when task has no tags and nulls are in tag searches
        $tasks = Task::where('list_id', $this->listId)
            ->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTaskName . "') || '%'")
            ->when($this->searchTag1, function ($query) {
                return $query->whereHas('tags', function ($subQuery) {
                    $subQuery->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTag1 . "') || '%'");
                });
            })
            ->when($this->searchTag2, function ($query) {
                return $query->whereHas('tags', function ($subQuery) {
                    $subQuery->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTag2 . "') || '%'");
                });
            })
            ->orderBy('order_within_list')
            ->get();

        $tags = Task::where('list_id', $this->listId)->get()->pluck('tags')->flatten()->unique('id')->values();

        return view('livewire.search-tasks', [
            'tasks' => $tasks,
            'tags' => $tags
        ]);
    }
}
