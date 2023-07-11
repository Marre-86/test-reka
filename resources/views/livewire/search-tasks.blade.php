<div>
    <div class="search-task">
        <input wire:model="searchTaskName" class="form-control" type="search" placeholder="Search tasks...">
        <small class="form-text text-muted">Search by task name</small>
    </div>
    <div class="search-task">        
        <select wire:model="searchTag1" class="form-select" required>
          <option value="">Search tags...</option>
          @foreach ($tags as $tag)
            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
          @endforeach
        </select>
        <small class="form-text text-muted">Search by tag 1</small>
    </div>
    <div class="search-task">
        <select wire:model="searchTag2" class="form-select" required>
          <option value="">Search tags...</option>
          @foreach ($tags as $tag)
            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
          @endforeach
        </select>
        <small class="form-text text-muted">Search by tag 2</small>
    </div>

    <table class="table">
            <thead>
                <tr class="text-center" style="vertical-align: middle">
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col" style="width:80%"></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
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
</div>
