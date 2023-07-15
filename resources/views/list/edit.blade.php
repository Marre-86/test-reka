@extends('layouts.main')
@section('content')
<div class="ali-cen-out">
    <div class="ali-cen-in">
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

        <div class="ins-task-btn">
              <button type="button" class="btn btn-outline-dark">INSERT TASK</button>
        </div>

        <div class="new-task-container" style="display: none;">
            <div class="card" style="margin-top:1rem; padding-left:1rem; min-width:28rem;">
                <div class="form-group row" style="margin-bottom:10px">
                    {{ Form::label('newTasks[1]', 'New Task', ['class' => 'col-sm-3 col-form-label', 'style' => 'font-weight: bold']) }}
                    <div class="col-sm-9">
                        {{ Form::text('newTasks[1]', null, ['class' => 'form-control-plaintext', 'style' => 'width:80%', 'required' => 'required', 'disabled' => 'disabled'])}}
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom:10px">
                    {{ Form::label('newTags[1]', 'Tags', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('newTags[1]', null, ['class' => 'form-control-plaintext', 'style' => 'width:80%', 'disabled' => 'disabled'])}}
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:10px;">
                    <p style="margin-bottom:0.2rem; float:left;">Image</p>
                    {{ Form::file('newImages[1]', ['class' => 'form-control', 'style' => 'width:60%', 'accept' => 'image/*', 'disabled' => 'disabled'])}}
                    <small id="imageHelp" class="form-text text-muted">Max size is 2048 kB.</small>
                </div>
            </div>
        </div>

        @foreach ($tasks as $task)
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

          <div class="ins-task-btn">
              <button type="button" class="btn btn-outline-dark">INSERT TASK</button>
          </div>

          <div class="new-task-container" style="display: none;">
            <div class="card" style="margin-top:1rem; padding-left:1rem; min-width:28rem;">
                <div class="form-group row" style="margin-bottom:10px">
                    {{ Form::label('newTasks[' . $task->order_within_list + 1 . ']', 'New Task', ['class' => 'col-sm-3 col-form-label', 'style' => 'font-weight: bold']) }}
                    <div class="col-sm-9">
                        {{ Form::text('newTasks[' . $task->order_within_list + 1 . ']', null, ['class' => 'form-control-plaintext', 'style' => 'width:80%', 'required' => 'required', 'disabled' => 'disabled'])}}
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom:10px">
                    {{ Form::label('newTags[' . $task->order_within_list + 1 . ']', 'Tags', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('newTags[' . $task->order_within_list + 1 . ']', null, ['class' => 'form-control-plaintext', 'style' => 'width:80%', 'disabled' => 'disabled'])}}
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:10px;">
                    <p style="margin-bottom:0.2rem; float:left;">Image</p>
                    {{ Form::file('newImages[' . $task->order_within_list + 1 . ']', ['class' => 'form-control', 'style' => 'width:60%', 'accept' => 'image/*', 'disabled' => 'disabled'])}}
                    <small id="imageHelp" class="form-text text-muted">Max size is 2048 kB.</small>
                </div>
            </div>
          </div>
        @endforeach        
        <div class="list-sbm" style="margin-bottom:1rem">
            {{ Form::submit('Update List', ['class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-outline-dark').on('click', function() {
      var currentTaskForm = $(this).closest('.ins-task-btn').next('.new-task-container');

      currentTaskForm.show();
      $(this).parent().hide();

      var indexForNewTaskInsertion_String = $(this).closest('.ins-task-btn').prev('.card').find('.col-form-label:first').text();
      var indexForNewTaskInsertion = indexForNewTaskInsertion_String.includes('Task') ? Number(indexForNewTaskInsertion_String.replace('Task ', '')) + 1 : 1;

      // Activating disabled inputs
      currentTaskForm.find('input').eq(0)
        .removeAttr('disabled');
      currentTaskForm.find('input').eq(1)
        .removeAttr('disabled');
      currentTaskForm.find('input').eq(2)
        .removeAttr('disabled');

      // Incrementing Labels of old tasks, that follow inserted new task
      var followingIndexes = $(this).closest('.ins-task-btn').nextAll('.card').find('.col-form-label:first');
      followingIndexes.each(function(index, element) {
            var currentValue = $(element).text();
            var incrementedValue = 'Task ' + (parseInt(currentValue.replace('Task ', '')) + 1);
            $(element).text(incrementedValue);
      });

      // Incrementing Labels and Inputs of new tasks, following the current new task
      var followingTaskForms = currentTaskForm.nextAll('.new-task-container');
      followingTaskForms.each(function() {
            var labels = $(this).find('label[for^="new"]');
            labels.each(function() {
                var attributeFor = $(this).attr('for');
                var incrementedAttributeFor = attributeFor.replace(/\[\d+\]/, function(match) {
                    var currentNumber = parseInt(match.match(/\d+/)[0]);
                    return '[' + (currentNumber + 1) + ']';
                });
                $(this).attr('for', incrementedAttributeFor);
            });
            var inputs = $(this).find('input[name^="new"]');
            inputs.each(function() {
                var attributeName = $(this).attr('name');
                var incrementedAttributeName = attributeName.replace(/\[\d+\]/, function(match) {
                    var currentNumber = parseInt(match.match(/\d+/)[0]);
                    return '[' + (currentNumber + 1) + ']';
                });
                $(this).attr('name', incrementedAttributeName);
                $(this).attr('id', incrementedAttributeName);
            });
      });

    });
  });
</script>

@endsection

