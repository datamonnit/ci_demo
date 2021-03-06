<?php
class Wall_model extends CI_Model {

    public function get_all()
    {
        $query = $this->db->get('seinat'); 
        return $query->result();
    }

    public function create_wall()
    {
        $data = array(
            'nimi' => $this->input->post('nimi')
        );

        return $this->db->insert('seinat', $data);
    }


    // Remove wall by id and return number of deleted walls
    public function delete_wall($id)
    {
        $this->db->delete('seinat', array('id' => $id)); 
        return $this->db->affected_rows();
    }

    // Save wall name by id and return number of deleted walls
    public function update_wall_name($id, $name)
    {
        $data = array(
            'nimi' => $name
        );
    
        $this->db->where('id', $id);
        $this->db->update('seinat', $data);
        
        return $this->db->affected_rows();
}

}