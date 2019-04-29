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


    public function save()
    {
        header('Content-Type: application/json; charset=utf-8');
        
        $id = $this->input->post('id');
		$content = $this->input->post('content');

        $this->load->model('wall_model');
        
        if ($this->wall_model->update_wall_name($id, $content))
        {
            $data = array(
                'action' => 'save',
                'status' => 'success',
                'id' => $id,
                'deleted_rows' => $this->db->affected_rows(),
                'sql' => $this->db->last_query()
            );
        } else {
            $data = array(
                'action' => 'save',
                'status' => 'fail',
                'id' => $id,
                'deleted_rows' => $this->db->affected_rows(),
                'sql' => $this->db->last_query()
            );
        }



		echo json_encode($data);
    }
}
