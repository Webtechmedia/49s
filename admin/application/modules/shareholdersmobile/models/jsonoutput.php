<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class JsonOutput extends CI_Model
{
    private $body;

    function __construct()
    {
        parent::__construct();

        $this->load->model('Server_obj', 'server_obj');;
    }

    public function setBody($body_import){

        $this->body = $body_import;
    }

    public function execute($encrypt = false){
        $output = new stdClass();
        $output->server_obj = $this->server_obj;
        $output->body = $this->body;

        if($encrypt){
            $this->output
                ->set_content_type('application/json')
                ->set_output($this->Encrypt_model->encode(json_encode($output)));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($output));
        }

    }


}

