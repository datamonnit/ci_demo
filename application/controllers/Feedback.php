<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function index()
	{
        $data['nav'] = 'navigation/base_nav.php';
        $data['title'] = 'Anna palautetta';
        $data['content'] = 'feedback';

        $this->load->view('layouts/base_layout', $data);
    }
    
    public function get()
    {
        $this->load->helper(array('form','url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Sähköpostiosoite', 'required');
        $this->form_validation->set_rules('grade', 'Arvosana', 'required');
        $this->form_validation->set_rules('feedback', 'Palaute', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            
            $data['nav'] = 'navigation/base_nav.php';
            $data['title'] = 'Anna palautetta';
            $data['content'] = 'feedback';

            $this->load->view('layouts/base_layout', $data);
        } else {
            $data['nav'] = 'navigation/base_nav.php';
            $data['title'] = 'Kiitos palautteesta';
            $data['content'] = 'feedback_success';

        $this->load->view('layouts/base_layout', $data);
        }
    }
}
