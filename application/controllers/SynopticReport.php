<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SynopticReport extends CI_Controller {

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
        $this->load->view('synopticReport',$data);

    }
    public function displaysynopticreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $date = $this->input->post('date');
        //$month = $this->input->post('month');

        if($userrole=='Manager'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displaySynopticReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);

        //FROM THE OBSERVATION SLIP KIP DATA FROM DIFFERENT TIMES.
        //FOR 0000Z
        $query1= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query1) {
            $data['synopticreportdataforADayFromObservationSlip0000Z'] = $query1;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0000Z'] = array();
        }

        //FOR 0600Z
        $query2= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query2) {
            $data['synopticreportdataforADayFromObservationSlip0300Z'] = $query2;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0300Z'] = array();
        }

        //FOR 0600Z
        $query3= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0600Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query3) {
            $data['synopticreportdataforADayFromObservationSlip0600Z'] = $query3;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0600Z'] = array();
        }

        //FOR 0900Z
        $query4= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0900Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query4) {
            $data['synopticreportdataforADayFromObservationSlip0900Z'] = $query4;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0900Z'] = array();
        }

        //FOR 1200Z
        $query5= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query5) {
            $data['synopticreportdataforADayFromObservationSlip1200Z'] = $query5;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1200Z'] = array();
        }

        //FOR 1500Z
        $query6= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1500Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query6) {
            $data['synopticreportdataforADayFromObservationSlip1500Z'] = $query6;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1500Z'] = array();
        }

        //FOR 1800Z
        $query7= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1800Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query7) {
            $data['synopticreportdataforADayFromObservationSlip1800Z'] = $query7;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1800Z'] = array();
        }

        //FOR 2100Z
        $query8= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime2100Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query8) {
            $data['synopticreportdataforADayFromObservationSlip2100Z'] = $query8;
        } else {
            $data['synopticreportdataforADayFromObservationSlip2100Z'] = array();
        }





        //FROM THE MORE FORM FIELDS TABLE KIP DATA FROM DIFFERENT TIMES.
        //FOR 0000Z
        $more_form_fields_table_query1= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0000Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query1) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0000Z'] = $more_form_fields_table_query1;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0000Z'] = array();
        }

        //FOR 0300Z
        $more_form_fields_table_query2= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0300Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query2) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0300Z'] = $more_form_fields_table_query2;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0300Z'] = array();
        }

        //FOR 0600Z
        $more_form_fields_table_query3= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0600Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query3) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0600Z'] = $more_form_fields_table_query3;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0600Z'] = array();
        }

        //FOR 0900Z
        $more_form_fields_table_query4= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0900Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query4) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0900Z'] = $more_form_fields_table_query4;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0900Z'] = array();
        }

        //FOR 1200Z
        $more_form_fields_table_query5= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1200Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query5) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1200Z'] = $more_form_fields_table_query5;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1200Z'] = array();
        }

        //FOR 1500Z
        $more_form_fields_table_query6= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1500Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query6) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1500Z'] = $more_form_fields_table_query6;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1500Z'] = array();
        }

        //FOR 1800Z
        $more_form_fields_table_query7= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1800Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query7) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1800Z'] = $more_form_fields_table_query7;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1800Z'] = array();
        }

        //FOR 2100Z
        $more_form_fields_table_query8= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable2100Z($date,$stationName,$stationNumber,'moreformfields');  //value,field,table

        if ($more_form_fields_table_query8) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable2100Z'] = $more_form_fields_table_query8;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable2100Z'] = array();
        }


        //nid to load stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $this->load->view('synopticReport',$data);

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