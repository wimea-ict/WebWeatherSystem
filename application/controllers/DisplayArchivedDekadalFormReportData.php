<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedDekadalFormReportData extends CI_Controller {

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
        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        //View the dekadal form.
        $this->load->view('displayArchivedDekadalFormReportData',$data);

    }
    public function displayArchivedDekadalFormReport(){
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
        $data['displayArchivedDekadalFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year
        );





        //Get Archived DEKADAL Report Data
        $query = $this->DbHandler->selectArchivedDekadalFormDataReportForAnyTenDaysOfAMonth($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'archivedekadalformreportdata');  //value,field,table

        if ($query) {
            $data['archivedDekadalFormReportdataforAnyTenDaysOfAMonth'] = $query;
        } else {
            $data['archivedDekadalFormReportdataforAnyTenDaysOfAMonth'] = array();
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


        $this->load->view('displayArchivedDekadalFormReportData',$data);

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