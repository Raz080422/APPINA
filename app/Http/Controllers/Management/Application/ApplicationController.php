<?php

namespace App\Http\Controllers\Management\Application;

use App\Http\Controllers\Controller;
use App\Http\Helper\MainController;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct(Request $request, MainController $controller)
    {
        $this->request = $request;
        $this->controller = $controller;
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }
    public function GetAllApplication(){
        $data = '';
        return $data;
    }

}
