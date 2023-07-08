@extends('layouts.main')
@section('content')
    <div class="w-60">
      <div class="card" style="margin-bottom:1rem; min-width:fit-content;">
        <div class="card-header">

                <h3>All Lists</h3>

        </div>
        <div style="padding: 1rem 0.5rem 0 0.5rem">
          <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                    <th scope="col">Id</th>
                    <th scope="col" style="width:22%">Creator</th>
                    <th scope="col" style="width:40%">Name</th>
                    <th scope="col">Number of tasks</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 0; @endphp
                @foreach ($lists as $list)
                    @php $class = $counter % 2 === 0 ? 'table-active' : 'table-default'; @endphp
                    <tr class="{{ $class }} text-center" onclick="if (!event.target.closest('a')) { window.location='{{ route('list.show', $list) }}'; }" style="cursor: pointer; vertical-align:middle;">
                    <td>{{ $list->id }}</td>
                        <td>{{ $list->created_by->name }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->tasks()->count() }}</td>
                        <td>{{ $list->created_at }}</td>
                    </tr>
                    @php $counter++; @endphp
                @endforeach
            </tbody>
          </table>
          {{ $lists->links() }}
        </div>
      </div>
    </div>
@endsection