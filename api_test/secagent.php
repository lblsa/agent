<?php

//check if you have curl loaded
if(!function_exists("curl_init")) die("cURL extension is not installed");

class SecAgentException extends Exception { }

class SecAgent {
    function __construct($token, $api_url = 'https://secagent.ru/app_dev.php')
    {
        $this->token = $token;
        $this->api_url = $api_url;
    }

    public function createPoint($data)
    {
        return $this->send('/point/', 'POST', $data);
    }

    public function updatePoint($id, $data)
    {
        return $this->send('/point/'.$id, 'PUT', $data);
    }

    public function deletePoint($id)
    {
        return $this->send('/point/'.$id, 'DELETE');
    }

    private function send($sub_url, $method = 'GET', $data = NULL)
    {

        $json_url = $this->api_url . $sub_url;

        // Initializing curl
        $ch = curl_init( $json_url );

        curl_setopt( $ch, CURLOPT_COOKIE, "PHPSESSID=p5cfs1s9t99v1l1t7qi8kktdf7; path=/" ); 

        // Configuring curl options
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5
        );

        if ('POST' == $method)
        {
            $options[CURLOPT_POSTFIELDS] = $data;
            $options[CURLOPT_POST] = true;
        } 
        else if ('DELETE' == $method)
        {
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        }
        else if ('PUT' == $method)
        {
            $options[CURLOPT_POSTFIELDS] = $data;
            $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
        }

//            $options[CURLOPT_SSL_VERIFYPEER] = false;
//            $options[CURLOPT_SSL_VERIFYHOST] = 0;

        // Setting curl options
        curl_setopt_array( $ch, $options );
#        curl_setopt($ch, CURLOPT_HEADER, true); // Display headers
#        curl_setopt($ch, CURLOPT_VERBOSE, true); // Display communication with server
         
        // Getting results
        $result =  curl_exec($ch); // Getting jSON result string

        $result_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        echo "result: ".$result_code."\n";
        curl_close($ch);

        if ($result_code >= 300) {
            throw new SecAgentException($result_code);
        }

        return json_decode($result);
    }
}

?>
