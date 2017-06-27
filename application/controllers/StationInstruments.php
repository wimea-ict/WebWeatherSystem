<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StationInstruments extends CI_Controller {

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
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','instruments');  //value,field,table
        if ($query) {
            $data['instruments'] = $query;
        } else {
            $data['instruments'] = array();
        }

        $query = $this->DbHandler->selectAll($userstation,'StationName','elements');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['elements'] = $query;
        } else {
            $data['elements'] = array();
        }

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        //Load the view.
        $this->load->view('stationInstruments', $data);
    }

    public function DisplayStationInstrumentForm(){
        $this->unsetflashdatainfo();
        $name='displaynewinstrumentsform';
        $data['displaynewinstrumentsform'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
         if ($query) {
            $data['stationsdata'] = $query;
        } else {
           $data['stationsdata'] = array();
        }

        /////////////////////////////////////////////////////////

        $query = $this->DbHandler->selectAll($userstation,'StationName','elements');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['elements'] = $query;
        } else {
            $data['elements'] = array();
        }

        /////////////////////////////////////////////////////////////

        $this->load->view('stationInstruments', $data);

    }
    public function DisplayStationInstrumentFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        ///////////////////////////////////////////////////////////////////////

        $instrumentid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($instrumentid,'id','instruments');  //$value, $field,$table
        if ($query) {
            $data['stationinstrumentdataid'] = $query;
        } else {
            $data['stationinstrumentdataid'] = array();
        }


        $this->load->view('stationInstruments', $data);
    }


    public function insertInstrument(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

       // $firstname =firstcharuppercase(chgtolowercase($this->input->post('userfirstname')));
        $instrumentname = firstcharuppercase(chgtolowercase($this->input->post('stationinstrumentname')));

        if($role=="Manager"){
        $station = $this->input->post('stationinstrumentManager');
        $stationNo = $this->input->post('stationNoinstrumentManager');
        }
        elseif($role=="OC"){

            $station = $this->input->post('stationinstrumentOC');
            $stationNo = $this->input->post('stationNoinstrumentOC');

        }

        $instrumentcode = chgtouppercase($this->input->post('stationinstrumentcode'));

        $manufacturer = $this->input->post('stationinstrumentmanufacturer');

        //$element = $this->input->post('element');
        $dateregistered = $this->input->post('stationinstrumentdateregistered');
        $expirydate = $this->input->post('stationinstrumentexpirydate');


        $description = $this->input->post('stationinstrumentdescription');
        $creationDate= date('Y-m-d H:i:s');

        $insertInstrumentData=array(
                'InstrumentName' => $instrumentname, 'StationName' => $station,
                'StationNumber' => $stationNo, 'DateRegistered' => $dateregistered,
                'ExpirationDate' => $expirydate, 'InstrumentCode' => $instrumentcode,
                'Manufacturer'=> $manufacturer,'Description'=>$description,'CreationDate'=> $creationDate);

        //$this->DbHandler->insertInstrument($insertInstrumentData);
        $insertsuccess= $this->DbHandler->insertData($insertInstrumentData,'instruments'); //Array for data to insert then  the Table Name

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
                'UserRole' => $userrole,'Action' => 'Added new instrument details',
                'Details' => $name . ' added new instrument details into the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'New Instrument info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }




    }
    public function updateInstrument(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        // $firstname =firstcharuppercase(chgtolowercase($this->input->post('userfirstname')));
        $instrumentname = firstcharuppercase(chgtolowercase($this->input->post('instrumentname')));

        if($role=="Manager"){
            $station = $this->input->post('stationManager');
            $stationNo = $this->input->post('stationNoManager');
        }
        elseif($role=="OC"){

            $station = $this->input->post('stationOC');
            $stationNo = $this->input->post('stationNoOC');

        }

        $instrumentcode = chgtouppercase($this->input->post('instrumentcode'));

        $manufacturer = $this->input->post('instrumentmanufacturer');

        //$element = $this->input->post('element');
        $dateregistered = $this->input->post('instrumentdateregistered');
        $expirydate = $this->input->post('instrumentexpirydate');


        $description = $this->input->post('instrumentdescription');

        //ID to update in the table.
        $id = $this->input->post('id');


        $updateInstrumentData=array(
            'InstrumentName' => $instrumentname, 'StationName' => $station,
            'StationNumber' => $stationNo, 'DateRegistered' => $dateregistered,
            'ExpirationDate' => $expirydate, 'InstrumentCode' => $instrumentcode,
            'Manufacturer'=> $manufacturer,'Description'=>$description);

        //$this->DbHandler->updateInstrument($updateInstrumentData,$id);

        $updatesuccess=$this->DbHandler->updateData($updateInstrumentData,'instruments',$id);


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
                'UserRole' => $userrole,'Action' => 'Updated instrument details',
                'Details' => $name . ' updated instrument details in the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'Instrument info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
            $this->index();

        }

    }
    public function deleteInstrument() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('instruments',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted instrument details',
                'Details' => $name . ' deleted instrument details into the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Instrument info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    function getInstruments($stationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
//check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {


            //$get_result = $this->DbHandler->getResults($stationName, 'StationName', 'instruments');   // $value, $field, $table
            //More than one result.(Array of instruments at a station)
            $data['results'] = $this->DbHandler->getResults($stationName, 'StationName', 'instruments');
            if($data['results']){   // we got a result, output json
                echo json_encode( $data['results'] );
            } else {
                echo json_encode( array('error' => true) );
            }
        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfStationInstrumentCodeInformationRecordExistsAlready($instrumentname,$stationinstrumentcode,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $instrumentname = ($instrumentname == "") ? $this->input->post('instrumentname') : $instrumentname;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $stationinstrumentcode = ($stationinstrumentcode == "") ? $this->input->post('stationinstrumentcode') : $stationinstrumentcode;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
           // echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfStationInstrumentCodeInformationRecordExistsAlready($instrumentname,$stationinstrumentcode,$stationName,$stationNumber,'instruments');   // $value, $field, $table

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

?>