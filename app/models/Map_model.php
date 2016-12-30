<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }


        public function Qoverdue( $start, $to ) {

          
                 $query = $this->db->query("
                    select prvin.prvin_desc_en , distr.distr_desc_en, commu.commu_id,commu.commu_nu_latitude as lat, commu.commu_nu_longitude as lon, commu.commu_desc_en,count(con.cotra_id) overdue from td_contract_other_data as conOther
                    inner join td_contract as con on conOther.cotra_id = con.cotra_id
                    inner join td_quotation as quo on quo.quota_nu_bo_reference = con.cotra_id
                    inner join td_quotation_applicant as quoapp on quoapp.quota_id = quo.quota_id
                    inner join td_applicant as app on app.appli_id = quoapp.appli_id
                    inner join td_applicant_address as appAdd on appAdd.appli_id = quoapp.appli_id 
                    inner join td_address as addr on addr.addre_id = appAdd.addre_id
                    inner join tu_province as prvin on addr.prvin_id = prvin.prvin_id
                    inner join tu_district as distr on addr.distr_id = distr.distr_id
                    inner join tu_commune as commu on addr.commu_id = commu.commu_id
                    where cooth_nu_nb_overdue_in_days  ". ( $start == 0 ?' <= 0' : '> '.$start.' and cooth_nu_nb_overdue_in_days <= '.$to.'')."  and aptyp_code = 'C' AND commu.commu_nu_latitude > 0 
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


        public function live_data_update(){

            return $this->db->select('count(lesse_received_date) as newRecord')->limit(1)
                 ->get_where('td_lessee_overdue_paid', array('DATE(lesse_received_date) >= ' => date('Y-m-d') ) )->row();

        }

        public function get_today_fco($date = null ){

            $this->db->select('lp.lesse_id, lpd.lesse_doc_id, path,lesse_received_date ,lesse_map_latitue as lat, lesse_map_longtitue as lon,civil_code, perso_va_lastname_en,
                perso_va_firstname_en, num_overdue,commu_desc_en, distr_desc_en, prvin_desc_en ');
            $this->db->from('td_lessee_overdue_paid  as lp');
            $this->db->join('td_lessee_overdue_paid_document as lpd','lp.lesse_id = lpd.lesse_id', 'INNER');
            $this->db->join('td_applicant as app','lp.appli_bo_id = app.appli_id', 'INNER');
            $this->db->join('td_applicant_address as apaddr','lp.appli_bo_id = apaddr.appli_id', 'INNER');
            $this->db->join('td_address  as addr','apaddr.addre_id = addr.addre_id', 'INNER');
            $this->db->join('tu_province as prvin','addr.prvin_id = prvin.prvin_id', 'INNER');
            $this->db->join('tu_district as distr','addr.distr_id = distr.distr_id', 'INNER');
            $this->db->join('tu_commune as commu','addr.commu_id = commu.commu_id', 'INNER');
            $this->db->where('DATE(lesse_received_date) >= ', ( !is_null($date) ? $date : date('Y-m-d')) );
            $this->db->like(array('path' => 'PHO_IMG_'));

            $query = $this->db->get();
            $return = array();
       
            if ( $query->num_rows() > 0 ) {
                foreach ($query->result() as $row) {
                 array_push($return, $row);
                }
            }

            return $return;

        }

        public function get_leasee_comment($date = null ){

            $this->db->select('lp.lesse_id, lesse_attribute,lpd.lesse_doc_id, path,lesse_received_date ,lesse_map_latitue as lat, lesse_map_longtitue as lon,civil_code, perso_va_lastname_en,
                perso_va_firstname_en, num_overdue,commu_desc_en, distr_desc_en, prvin_desc_en ');
            $this->db->from('td_lessee_overdue_paid  as lp');
            $this->db->join('td_lessee_overdue_paid_document as lpd','lp.lesse_id = lpd.lesse_id', 'INNER');
            $this->db->join('td_applicant as app','lp.appli_bo_id = app.appli_id', 'INNER');
            $this->db->join('td_applicant_address as apaddr','lp.appli_bo_id = apaddr.appli_id', 'INNER');
            $this->db->join('td_address  as addr','apaddr.addre_id = addr.addre_id', 'INNER');
            $this->db->join('tu_province as prvin','addr.prvin_id = prvin.prvin_id', 'INNER');
            $this->db->join('tu_district as distr','addr.distr_id = distr.distr_id', 'INNER');
            $this->db->join('tu_commune as commu','addr.commu_id = commu.commu_id', 'INNER');
            $this->db->where('DATE(lesse_received_date) <=', ( !is_null($date) ? $date : date('Y-m-d')) );
            $this->db->like(array('path' => 'PHO_IMG_'));

            $query = $this->db->get();
            $return = array();
       
            if ( $query->num_rows() > 0 ) {
                foreach ($query->result() as $row) {
                 array_push($return, $row);
                }
            }

            return $return;

        }


        public function Qin_days( $start, $to ) {

            $arr = ( $start === 0 ? array( 'cooth_nu_nb_overdue_in_days <= ' => 0, 'aptyp_code' => 'C' ) : array( 'cooth_nu_nb_overdue_in_days >' => $start, 'cooth_nu_nb_overdue_in_days <= ' => $to, 'aptyp_code' => 'C' ));
 
            $this->db->select('prvin.prvin_id ,prvin_desc_en ,distr.distr_id,distr_desc_en,count(con.cotra_id) AS overdue');
            $this->db->from('td_contract_other_data as conOther');
            $this->db->join('td_contract as con','conOther.cotra_id = con.cotra_id', 'INNER');
            $this->db->join('td_quotation as quo','quo.quota_nu_bo_reference = con.cotra_id', 'INNER');
            $this->db->join('td_quotation_applicant as quoapp ','quoapp.quota_id = quo.quota_id', 'INNER');
            $this->db->join('td_applicant as app','app.appli_id = quoapp.appli_id', 'INNER');
            $this->db->join('td_applicant_address appAdd','appAdd.appli_id = quoapp.appli_id', 'INNER');
            $this->db->join('td_address as addr','addr.addre_id = appAdd.addre_id', 'INNER');
            $this->db->join('tu_province as prvin','addr.prvin_id = prvin.prvin_id', 'INNER');
            $this->db->join('tu_district as distr','addr.distr_id = distr.distr_id', 'INNER');
            $this->db->join('tu_commune as commu','addr.commu_id = commu.commu_id', 'INNER');
            $this->db->where($arr);
            $this->db->limit(5000,0);
            $this->db->group_by('prvin.prvin_id,prvin_desc_en ,distr.distr_id,distr_desc_en');
            $this->db->order_by('prvin_desc_en', 'overdue', 'dt_cre', 'DESC');
            $query = $this->db->get();

            $return = array();
             if ( $query->num_rows() > 0 ) {
                foreach ($query->result() as $row) {
                 array_push($return, $row);
                }
            }
            return $return;

        }

        public function sort_addr_by_id($segment ,$id, $start, $to ) {

            $arr = ( $start === 0 ? array( 'cooth_nu_nb_overdue_in_days <= ' => 0, 'aptyp_code' => 'C' ) : array( 'cooth_nu_nb_overdue_in_days >' => $start, 'cooth_nu_nb_overdue_in_days <= ' => $to, 'aptyp_code' => 'C' ));

            $sort_select = ( $segment == 'prvin_id' ? 'prvin.prvin_id ,prvin_desc_en ,distr.distr_id,distr_desc_en, count(con.cotra_id) AS overdue' : 'prvin.prvin_id, prvin_desc_en, distr.distr_id, distr_desc_en, commu.commu_id,commu_desc_en, count(con.cotra_id) AS overdue');
 
            $this->db->select($sort_select);
            $this->db->from('td_contract_other_data as conOther');
            $this->db->join('td_contract as con','conOther.cotra_id = con.cotra_id', 'INNER');
            $this->db->join('td_quotation as quo','quo.quota_nu_bo_reference = con.cotra_id', 'INNER');
            $this->db->join('td_quotation_applicant as quoapp ','quoapp.quota_id = quo.quota_id', 'INNER');
            $this->db->join('td_applicant as app','app.appli_id = quoapp.appli_id', 'INNER');
            $this->db->join('td_applicant_address appAdd','appAdd.appli_id = quoapp.appli_id', 'INNER');
            $this->db->join('td_address as addr','addr.addre_id = appAdd.addre_id', 'INNER');
            $this->db->join('tu_province as prvin','addr.prvin_id = prvin.prvin_id', 'INNER');
            $this->db->join('tu_district as distr','addr.distr_id = distr.distr_id', 'INNER');

            if( $segment == 'distr_id' ) { $this->db->join('tu_commune as commu','addr.commu_id = commu.commu_id', 'INNER'); } 
        
            $this->db->where($arr);
            $this->db->where( ( $segment == 'prvin_id'  ? array('prvin.prvin_id' => $id ) : array('distr.distr_id' => $id ) ) );
            $this->db->limit(500,0);
            $group_by = ( $segment == 'prvin_id' ? 'prvin.prvin_id, prvin_desc_en, distr.distr_id, distr_desc_en': 'prvin.prvin_id, prvin_desc_en, distr.distr_id, distr_desc_en, commu.commu_id, commu_desc_en' );
            $this->db->group_by($group_by);
            $this->db->order_by('prvin_desc_en', 'overdue', 'dt_cre', 'DESC');
            $query = $this->db->get();

            $return = array();
             if ( $query->num_rows() > 0 ) {
                foreach ($query->result() as $row) {
                 array_push($return, $row);
                }
            }
            return $return;

        }

}// end class

