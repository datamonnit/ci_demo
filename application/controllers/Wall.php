<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wall extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('wall_model');
    }
    
    public function index()
	{
        $data['nav'] = 'navigation/base_nav.php';
        $data['title'] = 'Kaikki seinät';
        $data['content'] = 'all_walls';

        // Haetaan data tietokannasta
       
        $data['seinat'] =  $this->wall_model->get_all();       

        $this->load->view('layouts/base_layout', $data);
    }
    
    public function create()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nimi', 'Nimi', 'required');

        if ($this->form_validation->run() === FALSE)
        {

            $data['nav'] = 'navigation/base_nav.php';
            $data['title'] = 'Kaikki seinät';
            $data['content'] = 'all_walls';

            // Haetaan data tietokannasta
            $this->load->model('wall_model');
            $data['seinat'] =  $this->wall_model->get_all();       

            $this->load->view('layouts/base_layout', $data);

        }
        else
        {
        
            $this->wall_model->create_wall();
            redirect(base_url().'wall');
            


        }

    }


    public function delete($id)
    {
        if ($this->wall_model->delete_wall($id) == FALSE) {
            
        } else {
            redirect(base_url().'wall');
        }
    }
}
