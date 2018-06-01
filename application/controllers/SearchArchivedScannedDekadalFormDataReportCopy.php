<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchArchivedScannedDekadalFormDataReportCopy extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }
    public function index(){
        // $this->unsetflashdatainfo();
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
        $this->load->view('searchArchivedScannedDekadalFormDataReportCopy',$data);

    }
    public function displayarchivedscanneddekadalformreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $fromdate=$this->input->post('fromdate');
        $todate=$this->input->post('todate');

        // Get the Month From the date selected.
        //$month = date('m', strtotime($loop->date));
        $monthAsANumberselected = date('m', strtotime($fromdate));
        //$range = $this->input->post('range');
        $monthselected2 = date('m', strtotime($todate));

        $year = date('Y', strtotime($todate));





        // $name='displayDekadalReportHeaderFields';
        $data['displayArchivedScannedDekadalFormReportDetails'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year
        );

        //GET DATA FROM THE OBSERVATION SLIP TABLE.
        //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
        //FOR 0600Z
        $sqlquery=$this->DbHandler->selectArchivedScannedDekadalFormReportDetailsForAGivenRangeInAMonth($fromdate,$todate,$stationName,$stationNumber,'scannedarchivedekadalformreportcopydetails');  //value,field,table
        if ($sqlquery) {
            $data['archivedscanneddekadalformreportdataForAGivenRangeInAMonth'] = $sqlquery;
        } else {
            $data['archivedscanneddekadalformreportdataForAGivenRangeInAMonth'] = array();
        }



        //nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }



        $this->load->view('searchArchivedScannedDekadalFormDataReportCopy',$data);
    }
        public  function DownloadArchivedScannedDekadalFormReport($filename = NULL){
            // load download helder
            $this->load->helper('download');
            // read file contents
            $data = file_get_contents(base_url('/archive/'.$filename));
            force_download($filename, $data);

    }
    public  function ViewImageFromBrowser($filename = NULL){

        //'gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx';


        header('Content-Type: image/gif');
        header('Content-Type: image/jpg');
        header('Content-Type: image/png');

        header('Content-Type: image/jpeg');
        header('Content-Type: application/pdf');
        header('Content-Type: application/doc');

        header('Content-Type: application/docx');
        header('Content-Type: application/xlsx');
        header('Content-Type: application/ppt');

        header('Content-Type: image/pptx');

        $image = file_get_contents(base_url('/archive/'.$filename));
        echo $image;

        $this->load->view('searchArchivedScannedDekadalFormDataReportCopy');
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