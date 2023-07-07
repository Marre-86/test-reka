<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function created_by()            // phpcs:ignore
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tasks()
    {
         return $this->hasMany('App\Models\Task', 'list_id');
    }
}
