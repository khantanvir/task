@extends('welcome')
@section('userpanel')
<div class="container">
    <h2>Form control: select</h2>
    <p>The form below contains two dropdown menus (select lists):</p>
    <form method="post" action="{{ URL::to('task-store') }}">
        @csrf
    <input type="hidden" name="task_id" value="{{ (!empty($task->id))?$task->id:'' }}">
    <div class="form-group">
        <label for="usr">Name:</label>
        <input value="{{ (!empty($task->name))?$task->name:'' }}" type="text" name="name" class="form-control">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
      <div class="form-group">
        
        <label for="sel1">Select list (select one):</label>
        <select name="priority" class="form-control" id="sel1">
          <option value="">--Select One--</option>
          <option {{ (!empty($task->priority) && $task->priority=="high")?'selected':'' }} value="high">High</option>
          <option {{ (!empty($task->priority) && $task->priority=="medium")?'selected':'' }} value="medium">Medium</option>
          <option {{ (!empty($task->priority) && $task->priority=="low")?'selected':'' }} value="low">Low</option>
        </select>
        @if ($errors->has('priority'))
            <span class="text-danger">{{ $errors->first('priority') }}</span>
        @endif
        <br>
      </div><br>
      <button type="submit" class="btn btn-success">Add</button>
    </form>
  </div>
@endsection