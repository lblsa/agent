<?php

//check if you have curl loaded
if(!function_exists("curl_init")) die("cURL extension is not installed");

class SecAgentException extends Exception { }

class SecAgent {
    function __construct($token, $api_url = 'https://secagent.ru')
    {
        $this->token = $token;
        $this->api_url = $api_url;
    }

    function send($sub_url, $method = 'GET', $data = NULL)
    {

        $json_url = $this->api_url . $sub_url;

        $json_string = json_encode($data);

        // Initializing curl
        $ch = curl_init( $json_url );

        curl_setopt( $ch, CURLOPT_COOKIE, "PHPSESSID=p5cfs1s9t99v1l1t7qi8kktdf7; path=/" ); 

        // Configuring curl options
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'), //, 'Content-Length'
            CURLOPT_CONNECTTIMEOUT => 5
        );

        if ('POST' == $method)
        {
            $options[CURLOPT_POSTFIELDS] = $json_string;
            $options[CURLOPT_POST] = true;
        } 
        else if ('DELETE' == $method)
        {
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        }
        else if ('PUT' == $method)
        {
            $options[CURLOPT_POSTFIELDS] = $json_string;
            $options[CURLOPT_PUT] = true;
            $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
        }

//            $options[CURLOPT_SSL_VERIFYPEER] = false;
//            $options[CURLOPT_SSL_VERIFYHOST] = 0;

        // Setting curl options
        curl_setopt_array( $ch, $options );
         
        // Getting results
        $result =  curl_exec($ch); // Getting jSON result string

        $result_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($result_code >= 300) {
            throw new SecAgentException($result_code);
        }

        return json_decode($result);
    }
}

?>
