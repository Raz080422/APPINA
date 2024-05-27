<?php

namespace App\Http\Controllers\Management\Task;

use App\Http\Controllers\Controller;
use App\Http\Helper\MainController;

use Illuminate\Http\Request;
use Session;

class TaskController extends Controller
{
    public function __construct(Request $request,MainController $controller)
    {
        $this->request = $request;
        $this->controller = $controller;
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }

    public function GetAllTask(){
        $projectId = $this->request->input('id');
        $data['action'] = '';

        if($projectId){
            $data['data'] = json_decode(json_encode($this->controller->TaskControllers($projectId,'GET_ALLTASK')), true);
            $data['project'] = json_decode(json_encode($this->controller->ProjectControllers($projectId,'GET_DETAILPROJECT')), true);
            $data['action'] = $this->request->input('action');
        }
        // print_r($data['action']);
        // print_r($projectId);
        // die();

        // print_r(json_encode($data));die;
        return view ('management.projectmanagement.taskmanagement.index-task',$data);
    }

    public function GetDetailTask(){
        $projectId = $this->request->input('id');
        $data['id'] = $projectId;
        $itemnumber = $this->request->input('number');
        $reqData = $projectId .'|'.$itemnumber;
        $data['action'] = '';
        if($projectId){
            $data['data'] = json_decode(json_encode($this->controller->TaskControllers($reqData,'GET_DETAILTASK')), true);
        }
        // print_r($data);die();
        return view ('management.projectmanagement.taskmanagement.form-task',$data);
    }
}
