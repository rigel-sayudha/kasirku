<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Madmin');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function get_response() {
        $question = $this->input->post('question');
        $response = $this->Madmin->get_response($question);

        if ($response) {
            echo json_encode(array('answer' => $response));
        } else {
            $api_response = $this->get_response_from_openai($question);
            echo json_encode(array('answer' => $api_response));
        }
    }

    private function get_response_from_openai($question) {
        // Read API key from environment variable for security
        $api_key = getenv('OPENAI_API_KEY') ?: 'REDACTED_OPENAI_KEY';
        $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
        
        $data = array(
            'prompt' => $question,
            'max_tokens' => 150
        );
        
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n" .
                             "Authorization: Bearer " . $api_key,
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return 'Maaf, saya tidak dapat menjawab pertanyaan Anda saat ini.';
        }

        $response_data = json_decode($result, true);
        return $response_data['choices'][0]['text'];
    }
}
