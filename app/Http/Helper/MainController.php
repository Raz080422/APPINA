<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Validator, DB, Redirect, Hash, Auth, Session;


use App\Models\User;
use App\Http\Helper\Web_service;
use App\Http\Controller\Login;

class Maincontroller
{
    public function __construct(Request $request, Web_service $web_service)
    {
        $this->request = $request;
        $this->web_service = $web_service;
    }
    public function GetResponsePost($response)
    {
        if ($response->RESPONSE_CODE == '0001') {
            // print_r($response);die;
            $result = $response->RESPONSE_DATA;
        } else {
            Session::flash('message', 'error|Failed to Fetch Data.');
            return Redirect::back();
        }
        return $result;
    }
    public function GetResponse($response)
    {
        if ($response['RESPONSE_CODE'] == '0001') {
            $result = json_decode(json_encode($response['RESPONSE_DATA']), true);
        } else {
            Session::flash('message', 'error|Failed to Fetch Data.');
            return Redirect::back();
        }
        return $result;
    }

    public function LoginControllers($reqdata, $type)
    {
        if (strtoupper($type) == "GET_LOGINUSER") {
            $url = '/user/post-login';
            $response = $this->web_service->ws_post_response($url, $reqdata);
        }
        $response = $this->GetResponsePost($response);
        return $response;
    }
    public function MenuControllers($reqData, $type)
    {
        if (strtoupper($type) == 'GET_MENU') {
            $url = '/menu/get-menu';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        $response = $this->GetResponse($response);
        return $response;
    }
    public function DashboardControllers($reqData, $type)
    {
        if (strtoupper($type) == 'GET_MAINDASHBOARD') {
            $url = '/project/get-maindashboard';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        $response = $this->GetResponse($response);
        // print_r($response);die;
        return $response;
    }

    public function ProjectControllers($reqData, $type)
    {
        if (strtoupper($type) == 'GET_ACTIVEPROJECT') {
            $url = '/project/get-activeproject';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_DETAILPROJECT') {
            $url = '/project/get-detailproject';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_ROOTPAGE') {
            $url = '/project/get-rootpage';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_STATUSPROJECT') {
            $url = '/project/get-statusproject';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_PARENTPAGE') {
            $url = '/project/get-parentpage';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }else if (strtoupper($type) == 'GET_ASSIGNEE') {
            $url = '/project/get-totalassignee';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        $response = $this->GetResponse($response);
        // print_r($response);die;
        return $response;
    }
    public function ApplicationControllers($reqData, $type)
    {
        if (strtoupper($type) == 'GET_ALLAPPLICATION') {
            $url = '/application/get-allapplication';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_DETAILAPPLICATION') {
            $url = '/application/get-detailapplication';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        $response = $this->GetResponse($response);
        return $response;
    }
    public function DocumentControllers($reqData, $type)
    {
        if (strtoupper($type) == 'GET_ALLDOCUMENT') {
            $url = '/document/get-documentproject';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_MAPPINGDOCUMENT') {
            $url = '';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }else if (strtoupper($type) == 'GET_ALLTEMPLATE') {
            $url = '/document/get-template';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }else if (strtoupper($type) == 'GET_DETAILTEMPLATE') {
            $url = '/document/get-detailtemplate';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }else if (strtoupper($type) == 'GET_ROOTTEMPLATE') {
            $url = '/document/get-roottemplate';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        $response = $this->GetResponse($response);
        return $response;
    }
    public function TaskControllers($reqData, $type)
    {
        if (strtoupper($type) == 'GET_ALLTASK') {
            $url = '/task/get-alltask';
            $response = $this->web_service->ws_get_response($url, $reqData);
        } else if (strtoupper($type) == 'GET_DETAILTASK') {
            $url = '/task/get-detailtask';
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        $response = $this->GetResponse($response);
        return $response;
    }
    public function PostProject($requestdata)
    {
        // Hit API to Create Project
        $url = '/project/post-submitproject';
        $response = $this->web_service->ws_post_data($url, $requestdata);
        // print_r($response);die;
        //Check if responseis success
        // if ($response->RESPONSE_CODE == '0001') {
        //     //Do Generate Confluence Page
        //     $url = '/confluence/post-generatedocument';
        //     // print_r($response);die;
        //     $response = $this->web_service->ws_post_response($url, $response->RESPONSE_DATA);
        // }

        return $response;
    }
    public function ConfluenceControllers($reqData, $type){
        if (strtoupper($type) == 'POST_UPDATETEMPLATE') {
            $url = '/confluence/post-templateconfluence';
            // print_r($reqData);die;
            $response = $this->web_service->ws_post_response($url, $reqData);
        }else if (strtoupper($type) == 'POST_EDITTEMPLATE') {
            $url = '/document/post-template';
            // print_r($reqData);die;
            $response = $this->web_service->ws_post_data($url, $reqData);
        }
        // $response = $this->GetResponsePost($response);

        return $response;
    }
    public function JiraController($reqData, $type){
        if (strtoupper($type) == 'GET_ALLASSIGNEE') {
            $url = '/jira/get-assigneduser';
            // print_r($reqData);die;
            $response = $this->web_service->ws_get_response($url, $reqData);
        }else if (strtoupper($type) == '') {
            $url = '/document/post-template';
            // print_r($reqData);die;
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        // $response = $this->GetResponsePost($response);
        if($response['RESPONSE_CODE'] == '0001'){
            $response= $response['RESPONSE_DATA'];
        }else{
            $response= $response['RESPONSE_DATA'];
        }
        return $response;
    }
    public function UserController($reqData, $type){
        if (strtoupper($type) == 'GET_ALLUSER') {
            $url = '/user/get-alluser';
            // print_r($reqData);die;
            $response = $this->web_service->ws_get_response($url, $reqData);
        }else if (strtoupper($type) == '') {
            $url = '/document/post-template';
            // print_r($reqData);die;
            $response = $this->web_service->ws_get_response($url, $reqData);
        }
        // $response = $this->GetResponsePost($response);
        if($response['RESPONSE_CODE'] == '0001'){
            $response= $response['RESPONSE_DATA'];
        }else{
            $response= $response['RESPONSE_DATA'];
        }

        return $response;
    }

}
