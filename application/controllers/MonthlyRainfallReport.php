<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonthlyRainfallReport extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }
    public function index(){
      //  $this->unsetflashdatainfo();
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

        $this->load->view('monthlyRainfallReport',$data);
    }
    public function displaymonthlyrainfallreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];


        $year = $this->input->post('year');
        $monthselected = $this->input->post('month');



        if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }
        //Get the Month Selected As A Number.
        $monthAsANumberselected="";
        if($monthselected=='January'){
            $monthAsANumberselected=1;

        }elseif($monthselected=='February'){
            $monthAsANumberselected=2;

        }elseif($monthselected=='March'){
            $monthAsANumberselected=3;

        }elseif($monthselected=='April'){
            $monthAsANumberselected=4;

        }elseif($monthselected=='May'){
            $monthAsANumberselected=5;

        }elseif($monthselected=='June'){
            $monthAsANumberselected=6;

        }elseif($monthselected=='July'){
            $monthAsANumberselected=7;

        }elseif($monthselected=='August'){
            $monthAsANumberselected=8;

        }elseif($monthselected=='September'){
            $monthAsANumberselected=9;

        }elseif($monthselected=='October'){
            $monthAsANumberselected=10;

        }
        elseif($monthselected=='November'){
            $monthAsANumberselected=11;

        }
        elseif($monthselected=='December'){
            $monthAsANumberselected=12;

        }


        $data['displayMonthlyRainfallReportHeaderFields'] = array('stationName'=>$stationName,
            'stationNumber'=>$stationNumber,
            'year'=>$year,'monthInWords'=>$monthselected,'monthAsANumberselected'=>$monthAsANumberselected);




        //Get Monthly Report Data
        //$query = $this->DbHandler->selectMonthlyRainfallReportForAMonth($monthselected,$year,$stationName,$stationNumber,'dailyperiodicrainfall');  //value,field,table

        // if ($query) {
        //    $data['monthlyrainfallreportdata'] = $query;
        //} else {
        //    $data['monthlyrainfallreportdata'] = array();
        //}


        //Get Monthly Report Data
        $sqlquery = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($sqlquery) {
            $data['monthlyrainfallreportdatafromObservationSlipTable'] = $sqlquery;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTable'] = array();
        }





        //Nid to load the stations again

        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }



        $this->load->view('monthlyRainfallReport',$data);

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