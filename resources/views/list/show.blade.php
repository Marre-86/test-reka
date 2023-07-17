@extends('layouts.main')
@section('content')
<div class="ali-cen-out">
  <div class="w-60 ali-cen-in">

    <div class="card" style="margin-bottom:1rem; min-width:fit-content;clear:both">
            <div class="card-header">
                <h5 style="clear:both; float:left">{{ $list->name }}</h5>
                @if ($list->created_by_id === auth()->id())
                  <a href="{{ route('list.edit', $list) }}">
                    <img src="/pics/icons8-edit-80.png" alt="logo" style="height:1.8rem;margin-left:8px">
                  </a>
                @endif
                <p class="text-secondary" style="clear:both;">by {{ $list->created_by->name }} </p>
            </div>
            <div style="padding: 1rem 0.5rem 0 0.5rem">
              @livewire('search-tasks', ['listId' => $list->id])
            </div>
    </div>

  </div>
</div>
@endsection