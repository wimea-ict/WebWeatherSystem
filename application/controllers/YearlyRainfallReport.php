<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class YearlyRainfallReport extends CI_Controller {

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
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        //View the dekadal form.
        $this->load->view('yearlyRainfallReport',$data);

    }
    public function displayyearlyrainfallreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        //$month = $this->input->post('month');

        if($userrole=='Manager'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayYearlyRainfallReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year);


        //Get Monthly Report Data for all the Months in a Given Year
        //Get for January
        $query1 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfJanuaryFromObservationSlipTable('01',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query1) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary'] = $query1;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary'] = array();
        }

        //Get Monthly Report Data for all the Months in a Given Year
        //Get for Month of February
        $query2 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfFebruaryFromObservationSlipTable('02',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query2) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary'] = $query2;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary'] = array();
        }

        //Get for Month of March
        $query3 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfMarchFromObservationSlipTable('03',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query3) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch'] = $query3;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch'] = array();
        }

        //Get for Month of April
        $query4 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfAprilFromObservationSlipTable('04',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query4) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril'] = $query4;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril'] = array();
        }

        //Get for Month of May
        $query5 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfMayFromObservationSlipTable('05',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query5) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay'] = $query5;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay'] = array();
        }

        //Get for Month of June
        $query6 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfJuneFromObservationSlipTable('06',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query6) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune'] = $query6;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune'] = array();
        }

        //Get for Month of July
        $query7 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfJulyFromObservationSlipTable('07',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query7) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly'] = $query7;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly'] = array();
        }


        //Get for Month of August
        $query8 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfAugustFromObservationSlipTable('08',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query8) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust'] = $query8;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust'] = array();
        }


        //Get for Month of September
        $query9 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfSeptemberFromObservationSlipTable('09',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query9) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember'] = $query9;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember'] = array();
        }


        //Get for Month of October
        $query10 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfOctoberFromObservationSlipTable('10',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query10) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober'] = $query10;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober'] = array();
        }


        //Get for Month of November
        $query11 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfNovemberFromObservationSlipTable('11',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query11) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember'] = $query11;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember'] = array();
        }


        //Get for Month of December
        $query12 = $this->DbHandler->selectMonthlyRainfallReportForTheMonthOfDecemberFromObservationSlipTable('12',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query12) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember'] = $query12;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember'] = array();
        }




  //Nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }





        $this->load->view('yearlyRainfallReport',$data);

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