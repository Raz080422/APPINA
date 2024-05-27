<?php

namespace App\Http\Controllers\Management\ProjectDocument;

use App\Http\Controllers\Controller;
use App\Http\Helper\MainController;

use Session;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(Request $request,MainController $controller)
    {
        $this->request = $request;
        $this->controller = $controller;
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }
    public function GetDetailDocument($projectid){
        $data['projectid'] = $projectid;
        // print_r($data);die;
        $data['document'] = $this->controller->DocumentControllers($projectid,'GET_ALLDOCUMENT');
        $data['project'] = json_decode(json_encode($this->controller->ProjectControllers($projectid,'GET_DETAILPROJECT')), true);
        // print_r($data);die;
        return view('management.projectmanagement.documentdetail.index-document', $data);
    }
    public function ProcessDocument(){
        $action = $this->request->input('action');
        $projectid  = $this->request->input('projectid');
        print_r(''.$action.''.$projectid.'');
        $data = '';
        return $data;
    }

    public function GetAllTemplate(){
        $data['template'] = $this->controller->DocumentControllers('All Template', 'GET_ALLTEMPLATE');

        return view('management.projectmanagement.templatemanagement.index-template', $data);
    }
    public function GetDetailTemplate($templateId){
        $data['id'] = $templateId;
        $data['action'] = $this->request->input('action');
        if($templateId){
            $data['data'] = $this->controller->DocumentControllers($templateId, 'GET_DETAILTEMPLATE');
        }
        $data['rootPage'] = $this->controller->DocumentControllers('Root Template', 'GET_ROOTTEMPLATE');

        return view('management.projectmanagement.templatemanagement.form-template', $data);

    }

    public function PostTemplate(){
        $tittle = $this->request->input('title');
        $templateId = $this->request->input('templateid');
        $rootPage = $this->request->input('szRootPage');
        $category = $this->request->input('categoryPage');
        $templateName = $this->request->input('templateName');
        $status = $this->request->input('statusPage');
        $action = $this->request->input('action');

        // print_r($templateId);die;

        if(strtolower($action) == 'edit'){
            $reqData = [
                'templateId'        => $templateId,
                'tittle'            => $tittle,
                'rootPage'          => $rootPage,
                'categoryPage'      => $category,
                'status'            => $status,
                'templateName'      => $templateName,
                'action'            => $action
            ];
            $data = $this->controller->ConfluenceControllers($reqData,'POST_EDITTEMPLATE');
            if ($data['RESPONSE_CODE'] == 0001) {
                $message = 'success|' . $data['RESPONSE_DESC'];
            }
            else {
                $message = 'error|' . $data['RESPONSE_DESC'];
            }
        }else if(strtolower($action) == 'update'){
            $reqData = $templateId . '|'.$templateName;
            // print_r($reqData);die;
            $data = $this->controller->ConfluenceControllers($reqData,'POST_UPDATETEMPLATE');
            // print_r($data);die;
            if ($data->RESPONSE_CODE == 0001) {
                $message = 'success|' . $data->RESPONSE_DESC;
            }
            else {
                $message = 'error|' . $data->RESPONSE_DESC;
            }
        }

        Session::flash('message', $message);
        return redirect('/document/template');
    }
}
