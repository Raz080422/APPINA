<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session, Auth;

use App\Http\Helper\Web_service;
use App\Http\Helper\MainController;
class HomeController extends Controller
{
    public function __construct(Request $request, Web_service $_web_service, MainController $controller)
    {
        $this->request = $request;
        $this->web_service = $_web_service;
        $this->controller = $controller;
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }
    public function index(){
        $data['application'] =  $this->controller->DashboardControllers('Main Dashboard','GET_MAINDASHBOARD');
        $trancode['trancode'] = "APPINA-0001";
        Session($trancode);
        return view('dashboard.index',$data);
    }
}
