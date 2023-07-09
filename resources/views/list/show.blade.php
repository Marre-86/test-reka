@extends('layouts.main')
@section('content')
    <div class="w-60">


    <div class="card" style="margin-bottom:1rem; min-width:fit-content;clear:both">
            <div class="card-header">
                <h5 style="clear:both;">{{ $list->name }}</h5>
                <p class="text-secondary">by {{ $list->created_by->name }} </p>
            </div>
            <div style="padding: 1rem 0.5rem 0 0.5rem">

        
        <table class="table">
            <thead>
                <tr class="text-center" style="vertical-align: middle">
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col" style="width:80%"></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($list->tasks as $task)
                <tr class="text-center bg-light" style="vertical-align: middle; height:150px;">
                    <td>{{ $task->order_within_list }}</td>
                    <td>
                      @if ($task->image)
                        <a href="{{ asset('storage/images/'.$task->image) }}" target="_blank">
                          <img src="{{ asset('storage/images/'.$task->image) }}" class="img-sm">
                        </a>
                      @endif
                    </td>
                    <td>{{ $task->name }}
                      <div>
                        @foreach ($task->tags as $tag)
                          <span class="badge bg-primary">{{ $tag->name }}</span>
                        @endforeach
                      </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>

        </div></div>
    </div>
@endsection