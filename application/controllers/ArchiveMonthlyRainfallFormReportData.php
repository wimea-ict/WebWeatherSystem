<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveMonthlyRainfallFormReportData extends CI_Controller {

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
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','archivemonthlyrainfallformreportdata');  //value,field,table
        // $query = $this->DbHandler->selectAll('dailyperiodicrainfall');  //dailyperiodicrainfall is the Table Name.
        //  var_dump($query);
        if ($query) {
            $data['archivedrainfalldata'] = $query;
        } else {
            $data['archivedrainfalldata'] = array();
        }

        //Get all Stations.
        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('archiveMonthlyRainfallFormReportData', $data);

    }
    public function DisplayNewArchiveMonthlyRaifallForm(){
        $this->unsetflashdatainfo();
        $name='displaynewarchivemonthlyrainfallForm';
        $data['displaynewarchivemonthlyrainfallForm'] = array('name' => $name);

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

        $this->load->view('archiveMonthlyRainfallFormReportData', $data);

    }
    public function DisplayArchivedMonthlyRainfallFormForUpdate(){
        $this->unsetflashdatainfo();
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


        $monthlyrainfallformdataidforupdate = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($monthlyrainfallformdataidforupdate,'id','archivemonthlyrainfallformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['updatearchivedmonthlyrainfallformreportdata'] = $query;
        } else {
            $data['updatearchivedmonthlyrainfallformreportdata'] = array();
        }

        $this->load->view('archiveMonthlyRainfallFormReportData', $data);
    }

    public function insertMonthlyRainfallFormReportData(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date_archivedailymonthlyrainfalldata');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station_archivedailymonthlyrainfalldata')));

            $stationNumber = $this->input->post('stationNo_archivedailymonthlyrainfalldata');





        $rainfall = $this->input->post('rainfall_archivedailymonthlyrainfalldata');
        $approved="FALSE";
        $creationDate= date('Y-m-d H:i:s');

        $session_data = $this->session->userdata('logged_in');

        $name=$session_data['FirstName'].' '.$session_data['SurName'];

        $insertDailyPeriodicRainfallData=array('Date'=> $date,'Rainfall'=>$rainfall,
            'StationName' => $station, 'StationNumber' => $stationNumber,
            'Approved'=>$approved,'SubmittedBy' => $name,
            'CreationDate' => $creationDate);

        // $this->DbHandler->insertData($insertDailyPeriodicRainfallData,'dailyperiodicrainfall'); //Array for data to insert then  the Table Name
        $insertsuccess= $this->DbHandler->insertData($insertDailyPeriodicRainfallData,'archivemonthlyrainfallformreportdata'); //Array for data to insert then  the Table Name





        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Added archived daily periodic rainfall info',
                'Details' => $name . ' added archived daily periodic rainfall info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'Archived New Rainfall info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    public function UpdateMonthlyRainfallFormReportData(){
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
            $stationNumber = $this->input->post('stationNo');


        $rainfall = $this->input->post('rainfall');
        $approved=$this->input->post('approval');;




        $id = $this->input->post('id');


        $updateDailyPeriodicRainfallData=array('Date'=> $date,
            'StationName' => $station, 'StationNumber' => $stationNumber,
            'Rainfall'=>$rainfall,'Approved'=>$approved
        );


        $updatesuccess=$this->DbHandler->updateData($updateDailyPeriodicRainfallData,'archivemonthlyrainfallformreportdata',$id);


        //Redirect the user back with  message
        if($updatesuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Updated archived periodic rainfall info',
                'Details' => $name . ' updated archived periodic rainfall info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Archived Periodic Rainfall info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
            $this->index();

        }



    }
    public function DeleteRainfallData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        //$query = $this->DbHandler->DeleteDailyPeriodicRainfallData($id);

        $rowsaffected = $this->DbHandler->deleteData('archivemonthlyrainfallformreportdata',$id);  //$table and $id

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted periodic rainfall  info',
                'Details' => $name . ' deleted periodic rainfall from the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'dailyperiodicrainfall info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    ///Check DB against the DATE,STATIONName,StationNumber.
    function checkInDBIfArchiveMonthlyRainfallFormReportRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkIfArchiveMonthlyRainfallFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');   // $value, $field, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }
        }


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