<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchArchivedScannedSynopticFormDataReportCopy extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

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

        $this->load->view('searchArchivedScannedSynopticFormDataReportCopy',$data);
    }
    public function displayarchivedscannedsynopticformreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        // $range = $this->input->post('range');

        $date = $this->input->post('date');



        if($userrole=='Manager'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayArchivedScannedSynopticFormDataReportDetails'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);

        //NID TO GET THE MONTH AND


        $userstation=$session_data['UserStation'];

        //Get Daily Data
        //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
        $query = $this->DbHandler->selectArchivedScannedSynopticFormReportDetailsForSpecificDay($date,$stationName,$stationNumber,'scannedarchivesynopticformreportcopydetails');  //value,field,table

        if ($query) {
            $data['archivedscannedsynopticformdatareportcopyforADay'] = $query;
        } else {
            $data['archivedscannedsynopticformdatareportcopyforADay'] = array();
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

        $this->load->view('searchArchivedScannedSynopticFormDataReportCopy',$data);
    }
    public  function DownloadArchivedScannedSynopticForm($filename = NULL){
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

        header('Content-Type: application/pptx');

        $image = file_get_contents(base_url('/archive/'.$filename));
        echo $image;

        $this->load->view('searchArchivedScannedSynopticFormDataReportCopy');
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