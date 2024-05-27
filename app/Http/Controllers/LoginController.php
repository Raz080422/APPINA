<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Validator, DB, Redirect, Hash, Auth, Session;

use App\Models\User;
use App\Http\Helper\Web_service;
use App\Http\Helper\MainController;

class LoginController extends Controller
{
    private $client;
    public function __construct(Request $request, Web_service $_web_service, MainController $controller)
    {
        $this->request = $request;
        $this->web_service = $_web_service;
        $this->controller = $controller;
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }

    public function index(){
        if (Session::get('status_login')) {
            return redirect('/');
        }

        return view('login.login');
    }
    public function do_login()
    {

        $rules = [
            'username' => 'required',
            'password' => 'required|min:6',
        ];

        $input = $this->request->all();
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password tidak boleh kurang dari 6 karakter.',
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            $validation_desc = $validator->errors()->first('username');
            $validation_desc .= ' ' . $validator->errors()->first('password');

            Session::flash('message', 'error|' . $validation_desc);
            return Redirect::back();
        }
        $userAPI = (object)config('config_url');
        $passAPI = (object)config('config_url');

        $username = $this->request->input('username');
        $password = $this->request->input('password');
// var_dump($userAPI->userAPI.' '.$passAPI->passAPI);die;
        $requestData =
        $url = '/main/get-user';
        // $user = $this->web_service->ws_post_response($url, ['apiuser' => $userAPI->userAPI, 'apipassword'=> $passAPI->passAPI, 'username'=> $username]);
        $user = $this->controller->LoginControllers($username,'GET_LOGINUSER');
        // var_dump($user);die;
        $user_exist =  (array)$user;
        // var_dump($user_exist);die;
        if (count($user_exist) > 0) {
            // $menu = $this->web_service->ws_get_response('/main/get-menu', ['apiuser' => $userAPI->userAPI, 'apipassword' => $passAPI->passAPI, 'username'=>$user->szUserId]);
            $menu = $this->controller->MenuControllers($username, 'GET_MENU');
            // print_r($menu);die;
            $arrSession = [
                'username'      => $user[0]->szUserLogin,
                'name'          => $user[0]->szMemberName,
                'jabatan'       => $user[0]->szRoleName,
                'jira'          => $user[0]->szJiraId,
                'confluence'    => $user[0]->szConfluenceId,
                'teamName'      => $user[0]->szTeamName,
                'userId'        => $user[0]->szUserId,
                'teamMember'    => $user[0]->szTeamMemberId,
                'teamId'        => $user[0]->szTeamId,
                'roleId'        => $user[0]->szTeamRole,
                'memberId'      => $user[0]->szUserId,
                'menu_user'  => $menu,
                'status_login' => TRUE
            ];
            // print_r($arrSession);die;
            $status = $user[0]->szIsLogin;
// var_dump($status);die;
            if($status == "1")
            {
                Session::flash('message', 'error|Login gagal. User yang anda gunakan dalam posisi aktif.');
                return Redirect::back();
            }
// var_dump(strtoupper($username));die;
            if (strtoupper($username) == 'ADMININA') {
                // var_dump(Hash::make($password));die;
                $hashedPassword = $user[0]->szPassword;
                // var_dump(Hash::check($password, $hashedPassword));die;
                if (Hash::check($password, $hashedPassword)) {
                    // var_dump("sukses login");die;
                    session($arrSession);

                    // Tambah Fungsi Update status login 1 untuk tiap kali berhasil login

                    return Redirect::to('/');
                }
                else {
                    Session::flash('message', 'error|Login gagal. Kesalahan Format User');
                    return Redirect::back();
                }
            }else if(strtoupper($username) !=""){
                // var_dump("sukses login");die;

                $hashedPassword = $user[0]->szPassword;
                // var_dump(Hash::check($password, $hashedPassword));die;
                if (Hash::check($password, $hashedPassword)) {
                    // var_dump("sukses login");die;
                    session($arrSession);

                    return Redirect::to('/');
                }
                else {
                    Session::flash('message', 'error|Login gagal. Kesalahan Format User');
                    return Redirect::back();
                }
            }
            else
            {
                if (ctype_alpha($username)) {
                    Session::flash('message', 'error|Login gagal. Kesalahan Format User');
                    return Redirect::back();
                }
            }

        }
        else {
            Session::flash('message', 'error|Login gagal. User belum terdaftar.');
            return Redirect::back();
        }


    }
    public function check_session(){
        Session::forget('status_login');
        $status_login = Session::get('status_login');

        $response['status_login'] = 'force logout';
        return response()->json($response);
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('status_login');
        return redirect('/login');
    }
}
