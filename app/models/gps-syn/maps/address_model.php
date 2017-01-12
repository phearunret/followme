<?php

class Address_model extends CI_Model
{

    public function rquery($id, $tb, $field)
    {

        if (is_null($id)) {
            return $this->db->get($tb)->result();
        } else {
            return $this->db->get_where($tb, array($field => $id))->row();
        }

    }

    public function modify($tb, $data, $field)
    {
        return $this->db->update($tb, $data, array($field => $this->input->post('id')));

    }

}