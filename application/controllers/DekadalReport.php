<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DekadalReport extends CI_Controller {

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
        $this->load->view('dekadalReport',$data);

    }
    public function displaydekadalreport(){
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

        // Get the Year From the date selected.
        $year = date('Y', strtotime($todate));





        // $name='displayDekadalReportHeaderFields';
        $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year
        );

        //GET DATA FROM THE OBSERVATION SLIP TABLE.
        //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
        //FOR 0600Z
        $sqlquery1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTableFor0600Z($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
        if ($sqlquery1) {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTableFor1200Z($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
        if ($query1) {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = $query1;
        } else {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = array();
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


        $this->load->view('dekadalReport',$data);

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