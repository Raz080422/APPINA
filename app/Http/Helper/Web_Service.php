<?php

namespace App\Http\Helper;

class Web_service
{
    public function get_auth_token()
    {
        $config = (object) config('config_url');
        $address = $config->api_host . '/v1/oauth/token';

        $client = new \GuzzleHttp\Client;
        $requestdata = [
            [
                "name" => 'grant_type',
                "contents" => 'password'
            ],
            [
                "name" => 'client_id',
                "contents" => '2'
            ],
            [
                "name" => 'client_secret',
                "contents" => 'A2MsNY1hqGxGgsSGJuXAeIKyTbHFS5e2HdlE7mYi'
            ],
            [
                "name" => 'password',
                "contents" => 'P@ssw0rd'
            ],
            [
                "name" => 'username',
                "contents" => 'credentials@brilian.bri.co.id'
            ]

        ];

        $response = $client->request('POST', $address, [
            'multipart' => $requestdata
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data, TRUE);

        $token = $data['token_type'] . ' ' . $data['access_token'];

        return $token;
    }

    public function ws_get_response($url, $reqData)
    {
        $config = (object) config('config_url');
        $token = $config->authorization;
        $address = $config->api_host . $url;
        $userAPI = (object) config('config_url');
        $passAPI = (object) config('config_url');

        $token = $userAPI->userAPI . '|' . $passAPI->passAPI;

        $client = new \GuzzleHttp\Client;
        $header = [
            'Content_Type' => 'application/json',
            'Authorization' => $token
        ];
        $body = [
            'token' => $token,
            'reqData' => $reqData
        ];
        // var_dump($body);die;
        $response = $client->request('GET', $address, [
            'headers' => $header,
            'json' => $body
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data, TRUE);

        return $data;
    }

    public function ws_post_response($url, $reqData)
    {
        $config = (object) config('config_url');
        $token = $config->authorization;
        $address = $config->api_host . $url;
        $userAPI = (object) config('config_url');
        $passAPI = (object) config('config_url');

        $token = $userAPI->userAPI . '|' . $passAPI->passAPI;
        // print_r($token);die;

        $client = new \GuzzleHttp\Client;
        $header = [
            'Content_Type' => 'application/json',
            'Authorization' => $token
        ];
        $body = [
            'token' => $token,
            'reqData' => $reqData
        ];
        // Debugging Request Data
        // var_dump($address, ['headers' => $header, 'json' => $body]);die;
        // echo '<pre>';print_r($header);print_r($body);print_r($reqType);echo '</pre>'; die;
        // print_r($body);die;
        $response = $client->request('POST', $address, ['headers' => $header, 'json' => $body]);
        $data = json_decode($response->getBody());



        return $data;
    }
    public function ws_post_response_old($url, $requestdata, $reqType)
    {
        $config = (object) config('config_url');
        $token = $config->authorization;
        $address = $config->api_host . $url;
        $userAPI = (object) config('config_url');
        $passAPI = (object) config('config_url');

        $client = new \GuzzleHttp\Client;
        $header = [
            'Content_Type' => 'application/json',
            'Authorization' => $token
        ];
        $auth = [
            'username' => $userAPI->userAPI,
            'password' => $passAPI->passAPI,
            'reqType' => $reqType
        ];
        $reqData = $requestdata + $auth;
        // echo '<pre>';print_r($reqData);echo '</pre>'; die;

        $response = $client->request('POST', $address, ['headers' => $header, 'json' => $reqData]);
        $data = json_decode($response->getBody());

        return $data;
    }
    public function ws_post_data($url, $reqData)
    {
        $config = (object) config('config_url');
        $token = $config->authorization;
        $address = $config->api_host . $url;
        $userAPI = (object) config('config_url');
        $passAPI = (object) config('config_url');

        $token = $userAPI->userAPI . '|' . $passAPI->passAPI;
        // print_r($token);die;

        $client = new \GuzzleHttp\Client;
        $header = [
            'Content_Type' => 'application/json',
            'Authorization' => $token
        ];
        $token = [
            'token' => $token
        ];
        $body = $reqData + $token;
        // Debugging Request Data
        // var_dump($address, ['headers' => $header, 'json' => $body]);die;
        // echo '<pre>';print_r($header);print_r($body);print_r($reqType);echo '</pre>'; die;

        $response = $client->request('POST', $address, ['headers' => $header, 'json' => $body]);
        // print_r($response->getBody());die;
        $data = json_decode($response->getBody(),TRUE);


        return $data;
    }
    public function ws_put_data($url, $reqData){
        $config = (object) config('config_url');
        $token = $config->authorization;
        $address = $config->api_host . $url;
        $userAPI = (object) config('config_url');
        $passAPI = (object) config('config_url');

        $token = $userAPI->userAPI . '|' . $passAPI->passAPI;
        // print_r($token);die;

        $client = new \GuzzleHttp\Client;
        $header = [
            'Content_Type' => 'application/json',
            'Authorization' => $token
        ];
        $body = [
            'token' => $token,
            'reqData' => $reqData
        ];
        // Debugging Request Data
        // var_dump($address, ['headers' => $header, 'json' => $body]);die;
        // echo '<pre>';print_r($header);print_r($body);print_r($reqType);echo '</pre>'; die;

        $response = $client->request('PUT', $address, ['headers' => $header, 'json' => $body]);
        $data = json_decode($response->getBody());


        return $data;
    }
}
