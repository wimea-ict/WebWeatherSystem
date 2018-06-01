<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedSynopticFormReportData extends CI_Controller {

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
        $this->load->view('displayArchivedSynopticFormReportData',$data);

    }
    public function displayArchivedSynopticFormReport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $date = $this->input->post('date');
        //$month = $this->input->post('month');

        if($userrole=='Manager' || $userrole=='DataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayArchivedSynopticFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);



        //FROM THE PICK DATA FROM DIFFERENT TIMES FROM THE DIRECT SYNOPTIC TABLE ARCHIVED.
        //FOR 0000Z
        $query1= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','0000z');  //value,field,table

        if ($query1) {
            $data['synopticformreportdataForTime0000Z'] = $query1;
        } else {
            $data['synopticformreportdataForTime0000Z'] = array();
        }

        //FOR 0300Z
        $query2= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','0300Z');  //value,field,table

        if ($query2) {
            $data['synopticformreportdataForTime0300Z'] = $query2;
        } else {
            $data['synopticformreportdataForTime0300Z'] = array();
        }

        //FOR 0600Z
        $query3= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','0600Z');  //value,field,table

        if ($query3) {
            $data['synopticformreportdataForTime0600Z'] = $query3;
        } else {
            $data['synopticformreportdataForTime0600Z'] = array();
        }

        //FOR 0900Z
        $query4= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','0900Z');  //value,field,table

        if ($query4) {
            $data['synopticformreportdataForTime0900Z'] = $query4;
        } else {
            $data['synopticformreportdataForTime0900Z'] = array();
        }

        //FOR 1200Z
        $query5= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','1200Z');  //value,field,table

        if ($query5) {
            $data['synopticformreportdataForTime1200Z'] = $query5;
        } else {
            $data['synopticformreportdataForTime1200Z'] = array();
        }

        //FOR 1500Z
        $query6= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','1500Z');  //value,field,table

        if ($query6) {
            $data['synopticformreportdataForTime1500Z'] = $query6;
        } else {
            $data['synopticformreportdataForTime1500Z'] = array();
        }

        //FOR 1800Z
        $query7= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','1800Z');  //value,field,table

        if ($query7) {
            $data['synopticformreportdataForTime1800Z'] = $query7;
        } else {
            $data['synopticformreportdataForTime1800Z'] = array();
        }

        //FOR 2100Z
        $query8= $this->DbHandler->selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,'archivesynopticformreportdata','2100Z');  //value,field,table

        if ($query8) {
            $data['synopticformreportdataForTime2100Z'] = $query8;
        } else {
            $data['synopticformreportdataForTime2100Z'] = array();
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



        //View the dekadal form.
        $this->load->view('displayArchivedSynopticFormReportData',$data);


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
