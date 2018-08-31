<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StationElements extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');
		if(!$this->session->userdata('logged_in')){
	  $this->session->set_flashdata('warning', 'Sorry, your session has expired.Please login again.');
       redirect('/Welcome');
	  }

    }
    public function index(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','elements');  //value,field,table
        if ($query) {
            $data['elements'] = $query;
        } else {
            $data['elements'] = array();
        }

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $this->load->view('stationElements', $data);
    }
    public function DisplayStationElementForm(){
        $this->unsetflashdatainfo();
        $name='displaynewelementsform';
        $data['displaynewelementsform'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        /////////////////////////////////////////////////////////

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','instruments');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['elements'] = $query;
        } else {
            $data['elements'] = array();
        }

        /////////////////////////////////////////////////////////////

        $this->load->view('stationElements', $data);

    }
    public function DisplayStationElementFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        ///////////////////////////////////////////////////////////////////////

        $elementid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($elementid,'id','elements');  //$value, $field,$table
        if ($query) {
            $data['stationelementdataid'] = $query;
        } else {
            $data['stationelementdataid'] = array();
        }


        $this->load->view('stationElements', $data);
    }

    public function insertElement(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        $session_data = $this->session->userdata('logged_in');
        $UserRole=$session_data['UserRole'];

        //$firstname =firstcharuppercase(chgtolowercase($this->input->post('userfirstname')));

        $elementname = firstcharuppercase(chgtolowercase($this->input->post('name_element')));

        if($UserRole=="Manager" || $UserRole=='ZonalOfficer' || $UserRole=='SeniorZonalOfficer'){

            $station = firstcharuppercase(chgtolowercase($this->input->post('station_insertElement_element')));



            $stationNo = $this->input->post('stationNo_insertElement_element');
            //$stationRegion = $this->input->post('stationRegion_insertElement_element');




        }
        else if($UserRole=="OC"){

            $station = firstcharuppercase(chgtolowercase($this->input->post('station_OC_element')));


            $stationNo = $this->input->post('stationNo_OC_element');
            //$stationRegion = $this->input->post('stationRegion_OC_element');

        }


        $instrumentName = firstcharuppercase(chgtolowercase($this->input->post('instrumentname_element')));
        $abbrev = $this->input->post('abbrev_element');
        $type = $this->input->post('type_element');
        $units = $this->input->post('units_element');
        $scale = $this->input->post('scale_element');
        $limits = $this->input->post('limits_element');
        $description = $this->input->post('description_element');
        //$creationDate= date('Y-m-d H:i:s');
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];
        $user=$firstname.' '.$surname;

        $insertElementData=array(
            'ElementName' => $elementname, 'InstrumentName' => $instrumentName,
            'StationName' => $station, 'StationNumber' => $stationNo,
            'Abbrev' => $abbrev, 'Type' => $type,
            'Units'=>$units,'Scale'=> $scale,
            'Limits'=> $limits,'Description'=> $description,
            'SubmittedBy'=>$user);

        $insertsuccess= $this->DbHandler->insertData($insertElementData,'elements'); //Array for data to insert then  the Table Name



        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

           $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
               'Action' => 'Inserted new element details',
                'Details' => $name . ' added new element details in the system ',
          
                'IP' => $this->input->ip_address());
           $this->DbHandler->saveUserLogs($userlogs); 
            $this->session->set_flashdata('success', 'New Element info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }



    }
    public function updateElement(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));


        $session_data = $this->session->userdata('logged_in');
        $UserRole=$session_data['UserRole'];

        //$firstname =firstcharuppercase(chgtolowercase($this->input->post('userfirstname')));

        $elementname = firstcharuppercase(chgtolowercase($this->input->post('elementName')));

        if($UserRole=="Manager" || $UserRole=='ZonalOfficer' || $UserRole=='SeniorZonalOfficer'){

            $station = firstcharuppercase(chgtolowercase($this->input->post('station_updateElement')));



            $stationNo = $this->input->post('stationNo_updateElement');
           // $stationRegion = $this->input->post('stationRegion_updateElement');





        }
        else if($UserRole=="OC"){

            $station = firstcharuppercase(chgtolowercase($this->input->post('station_OC')));


            $stationNo = $this->input->post('stationNo_OC');
           // $stationRegion = $this->input->post('stationRegion_OC');


        }


        $instrumentName = firstcharuppercase(chgtolowercase($this->input->post('instrumentname__element_Update')));

        $abbrev = $this->input->post('abbrev');
        $type = $this->input->post('type');
        $units = $this->input->post('units');
        $scale = $this->input->post('scale');
        $limits = $this->input->post('limits');
        $description = $this->input->post('description');
        //$creationDate= date('Y-m-d H:i:s');


        $id = $this->input->post('id');


        $updateElementData=array(
            'ElementName' => $elementname, 'InstrumentName' => $instrumentName,
            'Abbrev' => $abbrev, 'Type' => $type,
            'Units'=>$units,'Scale'=> $scale,
            'Limits'=> $limits,'Description'=> $description);
          $updateElementData2=array('StationName' => $station, 'StationNumber' => $stationNo);

        //$updatesuccess=$this->DbHandler->updateData($updateElementData,'elements',$id);
        $updatesuccess=$this->DbHandler->updateData($updateElementData,$updateElementData2,'elements',$id);



        //Redirect the user back with  message
        if($updatesuccess){

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

             $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
               'Action' => 'Updated element details',
                'Details' => $name . ' updated element details in the system ',
               
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'Elements info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
            $this->index();

        }

    }
    public function deleteElement() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('elements',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted element details',
                'Details' => $name . ' deleted element details in the system ',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Elements info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfStationElementMeasuredFromAnInstrumentInformationRecordExistsAlready($elementname,$instrumentnameelement,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $elementname = ($elementname == "") ? $this->input->post('elementname') : $elementname;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $instrumentnameelement = ($instrumentnameelement == "") ? $this->input->post('instrumentnameelement') : $instrumentnameelement;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            // echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfStationElementMeasuredFromAnInstrumentInformationRecordExistsAlready($elementname,$instrumentnameelement,$stationName,$stationNumber,'elements');   // $value, $field, $table

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
