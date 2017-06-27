<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WeatherSummaryReport extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }
    public function index(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        // $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('weatherSummaryReport',$data);
    }
    public function displayweathersummaryreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');

        if($userrole=='Manager'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        //Get the Month Selected As A Number.
        $monthAsANumberselected="";
        if($month=='January'){
            $monthAsANumberselected=1;

        }elseif($month=='February'){
            $monthAsANumberselected=2;

        }elseif($month=='March'){
            $monthAsANumberselected=3;

        }elseif($month=='April'){
            $monthAsANumberselected=4;

        }elseif($month=='May'){
            $monthAsANumberselected=5;

        }elseif($month=='June'){
            $monthAsANumberselected=6;

        }elseif($month=='July'){
            $monthAsANumberselected=7;

        }elseif($month=='August'){
            $monthAsANumberselected=8;

        }elseif($month=='September'){
            $monthAsANumberselected=9;

        }elseif($month=='October'){
            $monthAsANumberselected=10;

        }
        elseif($month=='November'){
            $monthAsANumberselected=11;

        }
        elseif($month=='December'){
            $monthAsANumberselected=12;

        }



        $data['displayWeatherSummaryReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year,'monthInWords'=>$month,'monthAsANumberselected'=>$monthAsANumberselected);




        /////Get Data From the OS TABLE,METAR TABLE,MORE FORM FIELDS FORM TABLE TO DISPLAY THE WEATHER SUMMARY FORM.
        //FROM OS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTableFor0600Z($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
        if ($sqlquery1) {
            $data['observationslipdataforAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['observationslipdataforAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTableFor1200Z($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
        if ($query1) {
            $data['observationslipdataforAMonthAndTime1200Z'] = $query1;
        } else {
            $data['observationslipdataforAMonthAndTime1200Z'] = array();
        }

         //FROM MORE FORM FIELDS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTableFor0600Z($monthAsANumberselected,$year,$stationName,$stationNumber,'moreformfields');  //value,field,table
        if ($sqlquery2) {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = $sqlquery2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTableFor1200Z($monthAsANumberselected,$year,$stationName,$stationNumber,'moreformfields');  //value,field,table
        if ($query2) {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = $query2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = array();
        }



        //nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $this->load->view('weatherSummaryReport',$data);

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