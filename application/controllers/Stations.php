<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends CI_Controller {

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

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('stations', $data);
    }
    public function DisplayStationsForm(){
        $this->unsetflashdatainfo();
        $name='displaynewstationsform';
        $data['displaynewstationsform'] = array('name' => $name);

        //Get all Stations.
        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];

        //$query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
       // if ($query) {
        //    $data['stationsdata'] = $query;
        //} else {
         //   $data['stationsdata'] = array();
        //}

        /////////////////////////////////////////////////////////

        $this->load->view('stations', $data);

    }
    public function DisplayStationsFormForUpdate(){
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

        $stationid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($stationid,'id','stations');  //$value, $field,$table
        if ($query) {
            $data['stationdataid'] = $query;
        } else {
            $data['stationdataid'] = array();
        }


        $this->load->view('stations', $data);
    }
    public function insertStationInformation(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        if($role=="Manager"){

            //$firstname =firstcharuppercase(chgtolowercase($this->input->post('userfirstname')));
            $stationname = firstcharuppercase(chgtolowercase($this->input->post('namestation')));
            $stationnumber = ($this->input->post('numberstation'));

            $stationlocation = firstcharuppercase(chgtolowercase($this->input->post('locationstation')));
            $country = firstcharuppercase(chgtolowercase($this->input->post('countrystation')));
            $region = firstcharuppercase(chgtolowercase($this->input->post('regionstation')));

            $code = chgtouppercase($this->input->post('codestation'));
            $city = firstcharuppercase(chgtolowercase($this->input->post('citystation')));

            $latitude = $this->input->post('latitudestation');
            $longitude = $this->input->post('longitudestation');
            $altitude=$this->input->post('altitudestation');
            $opened = $this->input->post('openedstation');
            $closed = $this->input->post('closedstation');
            $status="Active";
            $type = $this->input->post('typestation');
            $creationDate= date('Y-m-d H:i:s');

            $insertStationData=array(
                'StationName'=> $stationname,'StationNumber'=>$stationnumber,
                'Location'=>$stationlocation,'Country'=>$country,
                'Region'=>$region,'Code'=>$code,'City'=>$city,
                'Latitude'=>$latitude,'Longitude'=>$longitude,
                'Altitude'=>$altitude,'Opened'=>$opened,
                'Closed'=>$closed,'Status'=>$status,
                'Type'=>$type,'CreationDate'=>$creationDate);

            //$this->DbHandler->insertStation($insertStationData);
            $insertsuccess= $this->DbHandler->insertData($insertStationData,'stations'); //Array for data to insert then  the Table Name


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
                    'UserRole' => $userrole,'Action' => 'Inserted new station details',
                    'Details' => $name . ' inserted new station details in the system ',
                    'StationName' => $userstation,
                    'StationNumber' => $userstationNo ,
                    'IP' => $this->input->ip_address());
                //  save user logs
                // $this->DbHandler->saveUserLogs($userlogs);



                $this->session->set_flashdata('success', 'Station info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

        }
    }
    public function updateStationInformation(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        if($role=="Manager"){
            $stationname = $this->input->post('station_name');
            $stationnumber = $this->input->post('stationNo');





        $stationlocation = firstcharuppercase(chgtolowercase($this->input->post('stationlocation')));
        $country = firstcharuppercase(chgtolowercase($this->input->post('stationcountry')));
        $region = firstcharuppercase(chgtolowercase($this->input->post('stationregion')));

        $code = chgtouppercase($this->input->post('stationcode'));
        $city = firstcharuppercase(chgtolowercase($this->input->post('stationcity')));

        $latitude = $this->input->post('stationlatitude');
        $longitude = $this->input->post('stationlongitude');
        $altitude=$this->input->post('stationaltitude');
        $opened = $this->input->post('stationopened');
        $status=$this->input->post('stationstatus');
        $closed = $this->input->post('stationclosed');

        $type = $this->input->post('stationtype');

        $id = $this->input->post('id');




        $updateStationData=array(
            'StationName'=> $stationname,'StationNumber'=>$stationnumber,
            'Location'=>$stationlocation,'Country'=>$country,
            'Region'=>$region,'Code'=>$code,'City'=>$city,
            'Latitude'=>$latitude,'Longitude'=>$longitude,
            'Altitude'=>$altitude,'Opened'=>$opened,
            'Closed'=>$closed,'Status'=>$status,
            'Type'=>$type);

        $updatesuccess=$this->DbHandler->updateData($updateStationData,'stations',$id);

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
                'UserRole' => $userrole,'Action' => 'Updated station details',
                'Details' => $name . ' updated station details in the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'Station info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
            $this->index();

        }
        }
    }
    public function deleteStation() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('stations',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted station details',
                'Details' => $name . ' deleted station details in the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Stations info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }


    function getStationNumber($stationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
//check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {


            $get_result = $this->DbHandler->getResults($stationName, 'StationName', 'stations');   // $value, $field, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }

        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;

        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        if ($this->input->post('stationName') == "") {
            //echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,'stations');   // $value, $field, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }
        }


    }
    public function check($user) {
        $this->load->helper(array('form', 'url'));

        $station = $this->input->post('name');

        $user = ($user == "") ? $this->input->post('name') : $user;
//check($value,$field,$table)
        if ($this->input->post('name') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }else {
//check($value,$field,$table)
            $get_result = $this->DbHandler->check($station, 'StationName', 'systemusers');   //$value, $field, $table

            if (!$get_result)
                echo '<span style="color:#f00">email already in use. </span>';
            else
                echo '<span style="color:#0c0">email not in use</span>';
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