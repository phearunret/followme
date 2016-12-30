<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gchart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'array');
        $this->load->library('gcharts');
        $this->load->model('gchart_model', 'gchart');
    }

    public function index()
    {
        $data['main_title'] = 'Advance Search';
        $data['template'] ='advance_search';
        $this->load->view('includes/template', $data);

    }

    public function pie_chart( $condition = null )
    {
        
        $this->gcharts->load('DonutChart');

        $this->gcharts->DataTable('country')->addColumn('string', 'Overdue', 'overdue')->addColumn('string', 'Amount', 'amount');
        $query = $this->gchart->Qchart($condition);
        if( $query ){
            foreach($query as $row){
                $this->gcharts->DataTable('country')->addRow(array($row['provin'],  rand(0, $row['cust'] )));      
            } 
        }       

        $config = array(
            'title' => 'Overview',
            'pieHole' => .25
        );

        $this->gcharts->DonutChart('country')->setConfig($config);

        $data['main_title'] = 'Pie Chart'. '-' . ( $condition == 't' ? 'Overdue' :  'Never late' );
        $data['template'] ='pie_chart';
        $this->load->view('includes/template', $data);

    }

    public function geo_chart( $condition = null )
    {
    
        $this->gcharts->load('GeoChart');
        $this->gcharts->DataTable('Debt')->addColumn('string', 'Province', 'province');

        if($condition =='t' ){

            $query = $this->gchart->Qchart('t');
            if(count($query)){

                $this->gcharts->DataTable('Debt')->addColumn('number', 'Overdue', 'overdue');
                $colorAxis = $this->gcharts->colorAxis()->colors(array('blue', 'orange'));
                
                foreach($query as $row){
                    $this->gcharts->DataTable('Debt')->addRows(array(
                        array($row['provin'], $row['cust']),   
                    ));
                } 

            }

        }else{

            $query = $this->gchart->Qchart('f');
            if(count($query)){

                $this->gcharts->DataTable('Debt')->addColumn('number', 'neverlate', 'Never late');
                $colorAxis = $this->gcharts->colorAxis()->colors(array('Green', 'Yellow'));

                foreach($query as $row){
                    $this->gcharts->DataTable('Debt')->addRows(array(
                        array($row['provin'], $row['cust']),   
                    ));
                } 

            }

        }

        

        $sizeAxis = $this->gcharts->sizeAxis()
                                  ->minSize(1)
                                  ->minValue(0)
                                  ->maxSize(10)
                                  ->maxValue(100);

        $config = array(

            'sizeAxis' => $sizeAxis,
            'colorAxis' => $colorAxis,
            'datalessRegionColor' => '#f6f6f6',
            'displayMode' => 'markers',
            'enableRegionInteractivity' => TRUE,
            'magnifyingGlass' => new magnifyingGlass(3),
            'region' => 'KH',
            'resolution' => 'provinces'

        );

        $this->gcharts->GeoChart('Debt')->setConfig($config);
        $data['main_title'] = 'Geo Chart' . '-' . ( $condition == 't' ? 'Overdue' :  'Never late' );;
        $data['template'] ='geo_chart';
        $this->load->view('includes/template', $data);

    }

}

/* End of file gchart_examples.php */
/* Location: ./application/controllers/gchart_examples.php */