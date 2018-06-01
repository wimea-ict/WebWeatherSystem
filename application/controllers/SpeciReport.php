<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SpeciReport extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }

    public function index(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        // $range = $this->input->post('range');



        if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displaySpeciReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);

        //NID TO GET THE MONTH AND


        $userstation=$session_data['UserStation'];
//////////////////////////////////////////////////////////////////////////////////
        //pick data from Observation slip for the Speci Report.
         $query = $this->DbHandler->selectSpeciReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,'observationslip');  //value,field,table

         if ($query) {
           $data['observationslipformdata'] = $query;
          } else {
            $data['observationslipformdata'] = array();
          }




        $this->load->view('speciReport',$data);
    }


    public function unsetflashdatainfo(){

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        elseif(isset($_SESSION['success'])){
            unset($_SESSION['success']);
        }
        elseif(isset($_SESSION['warning'])){
            unset($_SESSION['warning']);
        }
        elseif(isset($_SESSION['info'])){
            unset($_SESSION['info']);
        }

    }
}
