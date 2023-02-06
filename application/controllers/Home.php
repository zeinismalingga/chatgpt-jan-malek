<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function get_response()
    {

        $prompt = $this->input->post('text');

        $jayParsedAry = [
            "model" => "text-davinci-003",
            "prompt" => $prompt,
            "max_tokens" => 3000,
            "temperature" => 0.9
        ];

        $payload = json_encode($jayParsedAry);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.openai.com/v1/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . OPENAI_KEY
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
    }
}
