<?php
class Gchart_model extends CI_Model {

	function Qchart($condition) {
 
     return $this->db->query("
    				select count(apadr_bo_id) as cust, t6.prvin_desc_en as provin from td_contract t1
					INNER JOIN td_contract_applicant t2 ON t1.cotra_id = t2.cotra_id
					INNER JOIN td_bo_applicant t3 ON t2.appli_bo_id = t3.appli_bo_id
					INNER JOIN td_bo_applicant_address t4 ON t4.appli_bo_id = t3.appli_bo_id
					INNER JOIN td_bo_address t5 ON t5.addre_bo_id = t4.addre_bo_id 
					INNER JOIN tu_province t6 ON t6.prvin_id = t5.prvin_id
					where cotra_bl_overdue = '".$condition."' and costa_code = 'FIN' AND t2.aptyp_code = 'C' AND t4.adtyp_code ='MAIN' 
					GROUP BY t6.prvin_id
			")->result_array();
    

     
    }
              
}