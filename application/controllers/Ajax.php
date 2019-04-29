<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function delete($id)
    {
        header('Content-Type: application/json; charset=utf-8');
    
        $this->load->model('wall_model');
        
        if ($this->wall_model->delete_wall($id))
        {
            $data = array(
                'action' => 'delete',
                'status' => 'success',
                'id' => $id,
                'deleted_rows' => $this->db->affected_rows()
            );
        } else {
            $data = array(
                'action' => 'delete',
                'status' => 'fail',
                'id' => $id,
                'deleted_rows' => $this->db->affected_rows()
            );
        }



		echo json_encode($data);
    }
}
