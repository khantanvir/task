<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "All Task";
        $data['current'] = URL::full();
        Session::put('current_url',$data['current']);
        $data['task_list'] = Task::orderByRaw("FIELD(priority, 'high', 'medium', 'low')")->where('status',0)->where('is_deleted',0)->paginate(5);
        return view('task/all',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=NULL)
    {
        $data['page_title'] = "Add Task";
        $data['task'] = Task::find($id);
        return view('task/add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task_id = $request->input('task_id');
        if(!empty($task_id)){
            $task = Task::where('id',$task_id)->first();
        }else{
            $task = new Task();
        }
        $task->name = $request->input('name');
        $task->priority = $request->input('priority');

        $task->save();
        Session::flash('task_id',$task->id);
        Session::flash('success',(!empty($task_id))?'Task data Updated successfully':'Task data Saved Successfully');
        return redirect('/');
    }
    public function delete($id=NULL){
        if(empty($id)){
            Session::flash('warning','Task Id Not Found!');
            return redirect()->back();
        }
        $TaskValue = Task::find($id);
        if(empty($TaskValue)){
            Session::flash('error','Task Data Not Found!');
            return redirect()->back();
        }
        $delete = Task::where('id',$TaskValue->id)->update(['is_deleted'=>1]);
        Session::flash('success','Task Data Deleted Successfully!');
        if(!empty(Session::get('current_url'))){
            return redirect(Session::get('current_url'));
        }else{
            return redirect('/');
        }
    }
    //task status chage 
    public function task_status_change(Request $request){
        $change = Task::where('id',$request->input('task_id'))->update(['priority'=>$request->input('priority')]);
        $dataurl = '';
        if(!empty(Session::get('current_url'))){
            $dataurl = Session::get('current_url');
        }else{
            $dataurl = '/';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$change,
            'url'=> $dataurl
        );
        return response()->json($data,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
