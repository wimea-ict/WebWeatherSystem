<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedYearlyRainfallFormReportData extends CI_Controller {

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
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        //View the dekadal form.
        $this->load->view('displayArchivedYearlyRainfallFormReportData',$data);

    }
    public function displayArchivedYearlyRainfallFormReport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        //$month = $this->input->post('month');

        if($userrole=='Manager' || $userrole=='DataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayArchivedYearlyRainfallFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year);


        //Get Monthly Report Data for all the Months in a Given Year
        //Get for January
        $query1 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('01',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query1) {
            $data['archivedmonthlyrainfallreportdataForMonthOfJanuary'] = $query1;
        } else {
            $data['monthlyrainfallreportreportdataForMonthOfJanuary'] = array();
        }

        //Get Monthly Report Data for all the Months in a Given Year
        //Get for Month of February
        $query2 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('02',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query2) {
            $data['archivedmonthlyrainfallreportdataForMonthOfFebruary'] = $query2;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfFebruary'] = array();
        }

        //Get for Month of March
        $query3 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('03',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query3) {
            $data['archivedmonthlyrainfallreportdataForMonthOfMarch'] = $query3;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfMarch'] = array();
        }

        //Get for Month of April
        $query4 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('04',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query4) {
            $data['archivedmonthlyrainfallreportdataForMonthOfApril'] = $query4;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfApril'] = array();
        }

        //Get for Month of May
        $query5 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('05',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query5) {
            $data['archivedmonthlyrainfallreportdataForMonthOfMay'] = $query5;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfMay'] = array();
        }

        //Get for Month of June
        $query6 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('06',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query6) {
            $data['archivedmonthlyrainfallreportdataForMonthOfJune'] = $query6;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfJune'] = array();
        }

        //Get for Month of July
        $query7 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('07',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query7) {
            $data['archivedmonthlyrainfallreportdataForMonthOfJuly'] = $query7;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfJuly'] = array();
        }


        //Get for Month of August
        $query8 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('08',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query8) {
            $data['archivedmonthlyrainfallreportdataForMonthOfAugust'] = $query8;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfAugust'] = array();
        }


        //Get for Month of September
        $query9 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('09',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query9) {
            $data['archivedmonthlyrainfallreportdataForMonthOfSeptember'] = $query9;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfSeptember'] = array();
        }


        //Get for Month of October
        $query10 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('10',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query10) {
            $data['archivedmonthlyrainfallreportdataForMonthOfOctober'] = $query10;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfOctober'] = array();
        }


        //Get for Month of November
        $query11 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('11',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query11) {
            $data['archivedmonthlyrainfallreportdataForMonthOfNovember'] = $query11;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfNovember'] = array();
        }


        //Get for Month of December
        $query12 = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth('12',$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($query12) {
            $data['archivedmonthlyrainfallreportdataForMonthOfDecember'] = $query12;
        } else {
            $data['archivedmonthlyrainfallreportdataForMonthOfDecember'] = array();
        }


        //nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations',"");  //value,field,table

        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('displayArchivedYearlyRainfallFormReportData',$data);

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
