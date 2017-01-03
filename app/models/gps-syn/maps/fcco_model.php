<?php
class Fcco_model extends CI_Model {

 	public function rquery($id,$tb, $field) {

	  	if(is_null($id)){
	  		return $this->db->get($tb)->result();
	  	}else{
	  		return $this->db->get_where($tb, array( $field => $id))->row();
	  	}
     
	}

	public function modify($tb, $data,$field) {

	  	return $this->db->update($tb, $data, array($field => $this->input->post('id')));
     
	}

	public function get_today_fco(){
   
        $this->db->select('leodu_id,leodu_photopath,leodu_reference,leodu_latitue,'
                . 'leodu_longtitue,leodu_installment,leodu_overdue,'
                . 'leodu_panelty,sec_usr_desc,leodu_received_date');
        $this->db->from('td_lesseeoverdue_paid as leodu');
        $this->db->join('tu_sec_user as secuser','leodu.sec_usr_id = secuser.sec_usr_id');
        $this->db->where('DATE(leodu_received_date) = ',date('Y-m-d'));
        $this->db->limit(1);
        $this->db->order_by('leodu_id','desc');
        $query = $this->db->get();
        
        return $query->row();
    }
              
}