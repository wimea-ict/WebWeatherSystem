<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MetarReport extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');
        if(!$this->session->userdata('logged_in')){
	    $this->session->set_flashdata('warning', 'Sorry, your session has expired.Please login again.');
       redirect('/Welcome');
	  }
    }
    public function index(){
        //$this->unsetflashdatainfo();


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

        $this->load->view('metarReport',$data);
    }
    public function displaymetarreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        // $range = $this->input->post('range');

        $date = $this->input->post('date');



        if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayMetarReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);

        //NID TO GET THE MONTH AND


        $userstation=$session_data['UserStation'];
//////////////////////////////////////////////////////////////////////////////////
        //pick data from Observation slip for the Metar Report.
         $query = $this->DbHandler->selectMetarReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,'observationslip');  //value,field,table

         if ($query) {
           $data['metarreportdataforADayFromObservationSlipTable'] = $query;
          } else {
            $data['metarreportdataforADayFromObservationSlipTable'] = array();
          }

//////////////////////////////////////////////////////////////////////////////////////////////
        //prevoius from Metar Table
        //Get Daily Data
        //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
       // $query = $this->DbHandler->selectMetarReportForSpecificDay($date,$stationName,$stationNumber,'metar');  //value,field,table

       // if ($query) {
        //    $data['metarreportdataforADay'] = $query;
      //  } else {
        //    $data['metarreportdataforADay'] = array();
      //  }

/////////////////////////////////////////////////////////////////////////////////////////////////////
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
/////////////////////////////////////////////
       // NID TO LOAD STATION INDICATORS
        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }


        $this->load->view('metarReport',$data);
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
