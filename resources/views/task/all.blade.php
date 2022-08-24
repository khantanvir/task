@extends('welcome')
@section('userpanel')
<div class="container">
    <h2>All Task</h2>
    <a href="{{ URL::to('create') }}" class="btn btn-info" role="button">Create Task</a>
    <table class="table table-responsive-md">
        <thead>
            <tr>
                <th><strong>Id</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Priority</strong></th>
                <th><strong>Status</strong></th>
                <th><strong>Action</strong></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($task_list as $row)
            <tr class="{{ (!empty(Session::get('task_id')) && Session::get('task_id')==$row->id)?'table-primary':'' }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>
                    <input id="task_id{{ $row->id }}" type="hidden" name="task_id" value="{{ $row->id }}">
                    <select onchange="getVal({{ $row->id }})" id="priority{{ $row->id }}" name="priority" class="form-control" id="sel1">
                        <option {{ (!empty($row->priority) && $row->priority=="high")?'selected':'' }} value="high">High</option>
                        <option {{ (!empty($row->priority) && $row->priority=="medium")?'selected':'' }} value="medium">Medium</option>
                        <option {{ (!empty($row->priority) && $row->priority=="low")?'selected':'' }} value="low">Low</option>
                      </select>
                </td>
                <td>
                    @if($row->status==0)
                    <span class="label label-success">Active</span>
                    @else
                    <span class="label label-danger">Inactive</span> 
                    @endif
                </td>
                <td>
                    <div class="d-flex">
                        <a type="button" title="Edit" href="{{ URL::to('create/'.$row->id) }}" class="btn btn-info">Edit</a>
                        <a type="button" href="javascript:void(0)" onclick="if(confirm('Are you sure to Delete this Task Data?')) location.href='{{ URL::to('task-delete/'.$row->id) }}'; return false;" title="Delete" href="#" class="btn btn-danger">Delete</a>
                    </div>
                </td>
            </tr>
            @empty
            <p class="bg-danger text-white p-1">No Item Found</p>
            @endforelse
        </tbody>
    </table>
    <nav>
        <ul class="pagination pagination-xs pagination-gutter  pagination-warning">
            {!! $task_list->links() !!}
        </ul>
    </nav>
  </div>
  @endsection