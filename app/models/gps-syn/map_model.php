<?php
class Map_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
   
    }

	public function Qoverdue( $start, $off ) {

		  $query = $this->db->query("
                    select prvin.prvin_desc_en , distr.distr_desc_en, commu.commu_id,commu.commu_nu_latitude, commu.commu_nu_longitude, commu.commu_desc_en,count(con.cotra_id) overdue from td_contract_other_data as conOther
                    inner join td_contract as con on conOther.cotra_id = con.cotra_id
                    inner join td_quotation as quo on quo.quota_nu_bo_reference = con.cotra_id
                    inner join td_quotation_applicant as quoapp on quoapp.quota_id = quo.quota_id
                    inner join td_applicant as app on app.appli_id = quoapp.appli_id
                    inner join td_applicant_address as appAdd on appAdd.appli_id = quoapp.appli_id 
                    inner join td_address as addr on addr.addre_id = appAdd.addre_id
                    inner join tu_province as prvin on addr.prvin_id = prvin.prvin_id
                    inner join tu_district as distr on addr.distr_id = distr.distr_id
                    inner join tu_commune as commu on addr.commu_id = commu.commu_id
                    where cooth_nu_nb_overdue_in_days  ". ( $start == 0 ?' <= 0' : '> '.$start.' and cooth_nu_nb_overdue_in_days <= '.$off.'')."  and aptyp_code = 'C' AND commu.commu_nu_latitude > 0 
                    GROUP BY (prvin.prvin_desc_en ,distr.distr_desc_en, commu.commu_id)

                ");
 

        $return = array();
       
         if ( $query->num_rows() > 0 ) {
            foreach ($query->result() as $row) {
             array_push($return, $row);
            }
        }

        return $return;

    }

    public function Qcoo_id( $start, $off ) {

		 $query = $this->db->query("

			select prvin.prvin_desc_en,distr.distr_desc_en,commu.commu_desc_en , commu.commu_id, distr.distr_nu_latitude,distr.distr_nu_longitude,count(con.cotra_id) overdue from td_contract_other_data as conOther
			inner join td_contract as con on conOther.cotra_id = con.cotra_id
			inner join td_quotation as quo on quo.quota_nu_bo_reference = con.cotra_id
			inner join td_quotation_applicant as quoapp on quoapp.quota_id = quo.quota_id
			inner join td_applicant as app on app.appli_id = quoapp.appli_id
			inner join td_applicant_address as appAdd on appAdd.appli_id = quoapp.appli_id 
			inner join td_address as addr on addr.addre_id = appAdd.addre_id
			inner join tu_province as prvin on addr.prvin_id = prvin.prvin_id
			RIGHT JOIN tu_district as distr on addr.distr_id = distr.distr_id
			RIGHT JOIN tu_commune as commu on addr.commu_id = commu.commu_id
			where cooth_nu_nb_overdue_in_days > '".$start."' and cooth_nu_nb_overdue_in_days <= '".$off."' and aptyp_code = 'C' AND distr.distr_nu_latitude > 0 
			GROUP BY (prvin.prvin_desc_en,distr.distr_desc_en,commu.commu_desc_en, commu.commu_id) ORDER BY prvin.prvin_desc_en

		");
 

        $return = array();
       
         if ( $query->num_rows() > 0 ) {
            foreach ( $query->result() as $row ) {
             array_push($return, $row);
            }
        }

        return $return;

    }
 
              
}