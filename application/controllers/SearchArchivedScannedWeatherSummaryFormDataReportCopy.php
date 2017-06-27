<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchArchivedScannedWeatherSummaryFormDataReportCopy extends CI_Controller {

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

        $this->load->view('searchArchivedScannedWeatherSummaryFormDataReportCopy',$data);
    }
    public function displayarchivedscannedweathersummaryformreport(){
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




        $data['displayArchivedScannedWeatherSummaryFormReportDetails'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year,'monthInWords'=>$month);


        ////////////////////////

        $sqlquery1=$this->DbHandler->selectArchivedScannedWeatherSummaryFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,'scannedarchiveweathersummaryformreportcopydetails');  //value,field,table
        if ($sqlquery1) {
            $data['archivedscannedweathersummaryformreportdataForAMonth'] = $sqlquery1;
        } else {
            $data['archivedscannedweathersummaryformreportdataForAMonth'] = array();
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

        $this->load->view('searchArchivedScannedWeatherSummaryFormDataReportCopy',$data);

    }
    public  function DownloadArchivedWeatherSummaryFormReport($filename = NULL){
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('/archive/'.$filename));
        force_download($filename, $data);


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