@extends('layouts.main')
@section('content')
    <div style="width: 40%;">
        <div class="card" style="margin-bottom:1rem; min-width:28rem;">
            <div class="card-header">
                <h3>Edit List</h3>
            </div>

            <div class="card-body">
                {{ Form::model($list, ['route' => ['list.update', $list], 'method' => 'PATCH', 'files' => true]) }}

                @if ($errors->any())
                    <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color: #df382c">{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif

                <div class="form-group row">
                    {{ Form::label('name', 'List name', ['class' => 'col-sm-3 col-form-label text-primary', 'style' => 'font-weight: bold']) }}
                    <div class="col-sm-9">
                        {{ Form::text('name', $list->name, ['class' => 'form-control-plaintext', 'style' => 'width:80%', 'required' => 'required'])}}
                    </div>
                </div>
            </div>
        </div>
        @foreach ($list->tasks as $task)
          <div class="card" style="margin-top:1rem; padding-left:1rem; min-width:28rem;">
            <div class="form-group row" style="margin-bottom:10px">
                {{ Form::label('tasks[' . $task->id . ']', 'Task ' . $task->order_within_list, ['class' => 'col-sm-3 col-form-label', 'style' => 'font-weight: bold']) }}
                <div class="col-sm-9">
                    {{ Form::text('tasks[' . $task->id . ']', $task->name, ['class' => 'form-control-plaintext', 'style' => 'width:80%', 'required' => 'required'])}}
                </div>
            </div>

            <div class="form-group row" style="margin-bottom:10px">
                {{ Form::label('tags[' . $task->id . ']', 'Tags', ['class' => 'col-sm-3 col-form-label']) }}
                <div class="col-sm-9">
                    {{ Form::text('tags[' . $task->id . ']', $tags[$task->order_within_list], ['class' => 'form-control-plaintext', 'style' => 'width:80%'])}}
                </div>
            </div>

            <p style="margin-bottom:0.2rem; float:left;">Image</p>
            @if ($task->image !== null)
                <div style="width:10rem; margin-left:1rem; float:left;">
                    <img src="{{ asset('storage/images/'.$task->image) }}" class="img-edit-form">
                </div>
                {{ Form::label('images[' . $task->id . ']', 'If you want to replace it with another file, then choose it:') }}
            @endif
            <div class="form-group" style="margin-bottom:10px;">
                {{ Form::file('images[' . $task->id . ']', ['class' => 'form-control', 'style' => 'width:60%', 'accept' => 'image/*'])}}
                <small id="imageHelp" class="form-text text-muted">Max size is 2048 kB.</small>
            </div>

          </div>
        @endforeach        
        <div class="list-sbm" style="margin-bottom:1rem">
            {{ Form::submit('Update List', ['class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
        
    </div>
@endsection

