@extends('layouts.main')
@section('content')

<div class="w-30">

    <div class="card">
        <div class="card-header">
            <h3>Create list</h3>
        </div>
        <div class="card-body">
            <form id="create-list-form">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-info">Name</label>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" class="form-control-plaintext">
                        <span id="name-error" class="text-danger"></span>
                        <span id="store-success" class="text-success"></span>
                    </div>  
                </div>

                <div id="task-container">
                    <div class="form-group row task">
                        <label for="task1" class="col-sm-3 col-form-label">Task 1</label>
                        <div class="col-sm-8">
                            <input type="text" id="task1" name="task1" class="form-control-plaintext">
                            <span id="name-error" class="text-danger"></span>
                        </div>  
                    </div>
                </div>
                <button type="button" id="add-task-button" class="btn btn-outline-primary btn-sm">Add Task</button>

                <div class="list-sbm">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
            newTaskGroup.find('label').attr('for', 'task' + taskCount).text('Task ' + taskCount);
            newTaskGroup.find('input').attr({
                'id': 'task' + taskCount,
                'name': 'task' + taskCount
            });
            newTaskGroup.find('span.name-error').attr('id', 'name-error' + taskCount);

            // Clear the input field of the cloned task group
            newTaskGroup.find('input').val('');

            // Append the cloned task group to the container
            $('#task-container').append(newTaskGroup);
        });

        $('#create-list-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

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
                success: function(response) {
                    // Handle success response
                    if (response.success) {
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
                    alert('An error occurred while storing the list.');
                }
            });
        });
    });
</script>

@endsection
