<?php

namespace App\Http\Middleware;

use Closure, Session, DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $segment = $request->segment(2);
        // var_dump($segment);die;
        $menu_user = Session::get('menu_user');

        $valid = 0;
        foreach ($menu_user as $row) {

            if ($row['szType'] == 'S') {
                $path = explode('/', $row['szLink']);
                // var_dump($path[2]." ".$segment);die;
                if ($segment == $path[2]) {
                    $session['trancode'] = $row['szTrancode'];
                    $session['idgroup'] = $row['szGroupId'];
                    // var_dump('Sukses');die;
                    Session($session);
                    $valid++;
                }
            }


            $exclude_url = $this->exclude_url();
            if (in_array($segment, $exclude_url)) {
                $valid++;
            }
        }

        if ($valid > 0) {
            return $next($request);
        }
        else {
            Session::flash('message', 'error|Sorry you dont have permission to this page');
            return redirect('/');
        }
    }

    public function exclude_url(){
        $url = [
            'get-data-trx-series',
            'get-transaction',
            'detail-transaction',
            'user-detail',
            'user-create',
            'user-remove',
            'user-form',
            'project-detail',
            'document-detail',
            'editproject',
            'submitproject',
            'post-document',
            'template-detail',
            'post-template',
        ];

        return $url;
    }
}
