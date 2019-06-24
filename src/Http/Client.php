<?php

namespace TinyERP\Http;

use TinyERP\Api\AbstractApi;

class Client {

    protected $token;

    protected $format;

    public function __construct($token, $format = 'json') {
        $this->token = $token;
        $this->format = $format;
    }

    public function request( $request, $path, $params ){

        @set_time_limit( 300 );
        ini_set('max_execution_time', 300);
        ini_set('max_input_time', 300);
        ini_set('memory_limit', '256M');

        $urlextra = '';
        foreach ($params as $paramKey => $paramValue) {
            $urlextra .= sprintf("&%s=%s", $paramKey, $paramValue);
        }

        $data = sprintf("token=%s&formato=%s%s", $this->token, $this->format, $urlextra);

        $ch = curl_init(AbstractApi::ENDPOINT . $path.'?time='.time());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Cache-Control: no-cache',
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($data))
        );

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);

    }

}