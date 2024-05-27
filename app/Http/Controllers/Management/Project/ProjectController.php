<?php

namespace App\Http\Controllers\Management\Project;

use App\Http\Controllers\Controller;
use App\Http\Helper\MainController;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller
{
    public function __construct(Request $request, MainController $controller)
    {
        $this->request = $request;
        $this->controller = $controller;
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }
    public function GetActiveProject()
    {
        $data['data'] = $this->controller->ProjectControllers(session::get('teamId'), 'GET_ACTIVEPROJECT');
        $data['assignee'] = $this->controller->ProjectControllers(session::get('teamId'), 'GET_ASSIGNEE');

        // print_r($data);die;
        return view('management.projectmanagement.index-project', $data);
    }
    public function GetDetailProject($projectId = null)
    {
        $data['id'] = $projectId;
        $data['action'] = '';

        if ($projectId) {
            $data['data'] = json_decode(json_encode($this->controller->ProjectControllers($projectId, 'GET_DETAILPROJECT')), true);
            $data['parent'] = json_decode(json_encode($this->controller->ProjectControllers($projectId, 'GET_PARENTPAGE')), true);
            $data['action'] = $this->request->input('action');

            $data['document'] = $this->controller->DocumentControllers($projectId, 'GET_ALLDOCUMENT');
            $data['project'] = json_decode(json_encode($this->controller->ProjectControllers($projectId, 'GET_DETAILPROJECT')), true);

            $data['task'] = json_decode(json_encode($this->controller->TaskControllers($projectId,'GET_ALLTASK')), true);
            $data['assignee'] = $this->controller->JiraController($projectId, 'GET_ALLASSIGNEE');
        }
        $data['root'] = $this->controller->ProjectControllers('ROOT PAGE', 'GET_ROOTPAGE');
        $data['status'] = $this->controller->ProjectControllers('ROOT PAGE', 'GET_STATUSPROJECT');
        $data['application'] = $this->controller->ApplicationControllers('ROOT PAGE', 'GET_ALLAPPLICATION');

        // $data['project'] = $this->controller->ProjectControllers($projectId,'GET_DETAILPROJECT');
        // $data['role'] = $this->controller->getManagement($userId,'GET_TEAMROLE');
        // print_r($data['assignee']);die;
        // return view ('management.projectmanagement.projectdetail.form-detailproject',$data);
        return view('management.projectmanagement.projectdetail.draft-index-detailproject', $data);
    }
    public function GetDetailDocument($projectId)
    {
        if ($projectId) {
            $data['data'] = json_decode(json_encode($this->controller->ProjectControllers($projectId, 'GET_DETAILPROJECT')), true);
            $data['form_url'] = '/project/process-transaction-list';
        }
        $data['project'] = $this->controller->ProjectControllers($projectId, 'GET_DETAILPROJECT');
        // print_r($data['project']);die;
        return view('management.projectmanagement.projectdetail.detail-project', $data);
    }
    public function CreateProject()
    {
        $requestdata = [
            'szTittle' => $this->request->input('title'),
            'szJiraLink' => $this->request->input('jira'),
            'szDescription' => $this->request->input('description'),
            'szAncestors' => $this->request->input('ancestors'),
            'szStatus' => $this->request->input('status'),
            'szTeamId' => Session::get('teamId'),
            'szProjectid' => $this->request->input('projectid'),
            'application' => $this->request->input('application'),
            'szCreator' => Session::get('username'),
            'szBRDTittle' => $this->request->input('brdtittle'),
            'szDevTittle' => $this->request->input('devtittle'),
            'szJiraKey' => $this->request->input('jirakey'),
            'action' => ($this->request->input('projectid')) ? 'EDIT' : 'ADD'
        ];
        // print_r($requestdata);die;
        // $data = $this->web_service->ws_post_response($url, $requestdata);
        $data = $this->controller->PostProject($requestdata);
        // var_dump($data);die;
        if ($data['RESPONSE_CODE'] == 0001) {
            $message = 'success|' . $data['RESPONSE_DESC'];
        } else {
            $message = 'error|' . $data['RESPONSE_DESC'];
        }

        Session::flash('message', $message);
        return redirect('/project/allProject');
    }

}
