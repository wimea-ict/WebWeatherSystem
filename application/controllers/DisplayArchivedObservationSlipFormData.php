<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedObservationSlipFormData extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }
    public function index(){
        // $this->unsetflashdatainfo();
        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('displayArchivedObservationSlipFormData',$data);
    }
    public function displayarchivedobservationslipformreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];


        $ObservationslipTimeInZoo = $this->input->post('ArchivedObservationSlipFormReportTime');
        $date = $this->input->post('date');



        if($userrole=='Manager' || $userrole=='DataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayArchivedObservationSlipFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'TimeInZoo'=>$ObservationslipTimeInZoo,'date'=>$date);

        //Get Daily Data
        //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
        $query = $this->DbHandler->selectArchivedObservationSlipFormReportForSpecificTimeOfADay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber,'archiveobservationslipformdata');  //value,field,table

        if ($query) {
            $data['archivedobservationslipformdataforspecifictimeofaday'] = $query;
        } else {
            $data['archivedobservationslipformdataforspecifictimeofaday'] = array();
        }


        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }



        $this->load->view('displayArchivedObservationSlipFormData',$data);

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
