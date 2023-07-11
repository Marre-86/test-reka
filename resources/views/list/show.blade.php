@extends('layouts.main')
@section('content')
<div class="ali-cen-out">
  <div class="w-60 ali-cen-in">

    <div class="card" style="margin-bottom:1rem; min-width:fit-content;clear:both">
            <div class="card-header">
                <h5 style="clear:both;">{{ $list->name }}</h5>
                <p class="text-secondary">by {{ $list->created_by->name }} </p>
            </div>
            <div style="padding: 1rem 0.5rem 0 0.5rem">
              @livewire('search-tasks', ['listId' => $list->id])
            </div>
    </div>

  </div>
</div>
@endsection