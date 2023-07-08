@extends('layouts.main')
@section('content')

<div class="w-30">

    <div class="card">
        <div class="card-header">
            <h3>Create list</h3>
        </div>
        <div class="card-body">
        <form id="create-list-form" enctype="multipart/form-data">
        @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-primary">Name</label>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" class="form-control-plaintext">
                        <span id="name-error" class="text-danger"></span>
                        <span id="store-success" class="text-success"></span>
                    </div>  
                </div>

                <div id="task-container">
                    <div class="form-group row task">
                        <label for="task1" class="col-sm-3 col-form-label"><strong>Task 1</strong></label>
                        <div class="col-sm-8">
                            <input type="text" id="task1" name="task1" class="form-control-plaintext">
                        </div>
                        <label for="images[1]" class="col-sm-3 col-form-label">Image 1</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" id="images[1]" name="images[1]" multiple accept="image/*">
                            <span id="image-error1" class="text-danger"></span>
                            <small id="imageHelp" class="form-text text-muted">Max size is 2048 kB.</small>
                        </div>       
                    </div>
                </div>
                <button type="button" id="add-task-button" class="btn btn-outline-primary btn-sm">Add Task</button>

                <div class="list-sbm">
                    <button type="submit" class="btn btn-primary">Create List</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        var taskCount = 1; // Counter for task fields

        // Add task button click event
        $('#add-task-button').click(function() {
            taskCount++;

            // Clone the first task group
            var newTaskGroup = $('.form-group.row.task').first().clone();

            // Update the IDs and names of the cloned elements
            newTaskGroup.find('label[for^="task"]').attr('for', 'task' + taskCount).html('<strong>Task ' + taskCount + '</strong>');
            newTaskGroup.find('label[for^="image"]').attr('for', 'image' + taskCount).text('Image ' + taskCount);
            newTaskGroup.find('input[name^="task"]').attr({
                'id': 'task' + taskCount,
                'name': 'task' + taskCount,
            });
            newTaskGroup.find('input[name^="image"]').attr({
                'id': 'images[' + taskCount + ']',
                'name': 'images[' + taskCount + ']',
            });
            newTaskGroup.find('#image-error1').attr('id', 'image-error' + taskCount);

            // Clear the input field of the cloned task group
            newTaskGroup.find('input').val('');

            // Append the cloned task group to the container
            $('#task-container').append(newTaskGroup);
        });

        $('#create-list-form').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);

                // Reset error message
            $('#name-error').text('');

                // Check if name field is empty
            if ($('#name').val() === '') {
                // Display error message
                $('#name-error').text('Name is required');
                
                    // Remove error message after 3 seconds
                setTimeout(function() {
                    $('#name-error').text('');
                }, 1200);
                return; // Stop form submission
            }

            $.ajax({
                url: '{{ route("list.store") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle success response
                    if (response.success) {
                        console.log('success');
                        $('#name').val('');
                        $('#task-container .form-group.row.task:not(:first)').remove();
                        $('#task-container .form-group.row.task:first input').val('');
                        taskCount = 1;
                        $('#store-success').text('List stored successfully! You can add one more!');
                         setTimeout(function() {
                            $('#store-success').text('');
                        }, 3000);
                    }
                },
                error: function(xhr) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.error) {
                        var [, index] = errorResponse.error.match(/images\.(\d+)/);
                        $('#images\\[' + index + '\\]').val('');
                        $('#image-error'+ index).text(errorResponse.error);
                         setTimeout(function() {
                            $('#image-error'+ taskCount).text('');
                        }, 3000);
                    } else {
                        alert('An error occurred while storing the model.');
                    }
                }
            });
        });
    });
</script>

@endsection
