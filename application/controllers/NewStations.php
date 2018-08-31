<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewStations extends CI_Controller {

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
        // $this->unsetflashdatainfo();
        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];





        //View Station.Load all the previous Stations
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('newstations', $data);
    }
    public function DisplayStationsForm(){
        $this->unsetflashdatainfo();
        $name='displaynewstationsform';
        $data['displaynewstationsform'] = array('name' => $name);

        //On Add New Station
        //Load table(stationlocationindicators) with all the station Indicators.
        //ROLE IS MANAGER
        //$session_data = $this->session->userdata('logged_in');
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }

        /////////////////////////////////////////////////////////

        $this->load->view('newstations', $data);

    }
    public function DisplayStationsFormForUpdate(){
        $this->unsetflashdatainfo();
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

        ///////////////////////////////////////////////////////////////////////
        //On Add New Station
        //Load table(stationlocationindicators) with all the station Indicators.
        //ROLE IS MANAGER
        //Load table(stationlocationindicators) with all the station Indicators.
        //ROLE IS MANAGER

        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'LocationStationName','stationlocationindicators');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }

        /////////////////////////////////////////////////////////////////////

        $stationid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($stationid,'id','stations');  //$value, $field,$table
        if ($query) {
            $data['stationdataid'] = $query;
        } else {
            $data['stationdataid'] = array();
        }


        $this->load->view('newstations', $data);
    }
    public function insertStationInformation(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        if($role=="ManagerStationNetworks"){


            $stationname = firstcharuppercase(chgtolowercase($this->input->post('namestation')));
            $stationnumber = ($this->input->post('numberstation'));

            $stationregNo = ($this->input->post('registrationnumberstation'));

            $stationlocation = firstcharuppercase(chgtolowercase($this->input->post('locationstation')));

            $indicator = $this->input->post('indicatorstation');
            $country = firstcharuppercase(chgtolowercase($this->input->post('countrystation')));
            $region = firstcharuppercase(chgtolowercase($this->input->post('regionstation')));



            $latitude = $this->input->post('latitudestation');
            $longitude = $this->input->post('longitudestation');
            $altitude=$this->input->post('altitudestation');
            $opened = $this->input->post('openedstation');
            $closed = $this->input->post('closedstation');
            $status=$this->input->post('statusstation');
            $type = $this->input->post('typestation');
            //$creationDate= date('Y-m-d H:i:s');
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $SubmittedBy=$name;
            $height = $this->input->post('height');
            $insertStationData=array(
                'StationName'=> $stationname,'StationNumber'=>$stationnumber,'StationRegNumber'=>$stationregNo,
                'Location'=>$stationlocation,'Country'=>$country,
                'StationRegion'=>$region,'Indicator'=>$indicator,
                'Latitude'=>$latitude,'Longitude'=>$longitude,'Height'=>$height,
                'Altitude'=>$altitude,'Opened'=>$opened,
                'Closed'=>$closed,'StationStatus'=>$status,
                'StationType'=>$type,'SubmittedBy'=>$SubmittedBy);

            //$this->DbHandler->insertStation($insertStationData);
            $insertsuccess= $this->DbHandler->insertData($insertStationData,'stations'); //Array for data to insert then  the Table Name


            //Redirect the user back with  message
            if($insertsuccess){
                //Store User logs.
                //Create user Logs
                $session_data = $this->session->userdata('logged_in');
                $UserRole=$session_data['UserRole'];
                $StationName=$session_data['StationName'];
                $StationNumber=$session_data['StationNumber'];
                //$StationRegion=$session_data['StationRegion'];
                $name=$session_data['FirstName'].' '.$session_data['SurName'];

               $userid =$session_data['Userid'];
               $userlogs = array('Userid' => $userid,
                    'Action' => 'Created new station ',
                    'Details' => $name . ' created a new station details in the system ',
                   
                    'IP' => $this->input->ip_address());
                //  save user logs
                $this->DbHandler->saveUserLogs($userlogs);



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

        if($role=="ManagerStationNetworks"){
            $stationname = $this->input->post('station_name');
            $stationnumber = $this->input->post('stationNo');





            $stationlocation = $this->input->post('stationlocation');
            $indicator = chgtouppercase($this->input->post('stationindicator'));
            $region = $this->input->post('stationregion');
            $country = firstcharuppercase(chgtolowercase($this->input->post('stationcountry')));





            $latitude = $this->input->post('stationlatitude');
            $longitude = $this->input->post('stationlongitude');
            $altitude=$this->input->post('stationaltitude');
            $opened = $this->input->post('stationopened');
            $status=$this->input->post('stationstatus');
            $closed = $this->input->post('stationclosed');

            $type = $this->input->post('stationtype');

            $id = $this->input->post('id');
             $height = $this->input->post('height');
                


            $updateStationData=array(
                'StationName'=> $stationname,'StationNumber'=>$stationnumber,
                'Location'=>$stationlocation,'Country'=>$country,
                'StationRegion'=>$region,'Indicator'=>$indicator,
                'Latitude'=>$latitude,'Longitude'=>$longitude,'Height'=>$height,
                'Altitude'=>$altitude,'Opened'=>$opened,
                'Closed'=>$closed,'StationStatus'=>$status,
                'StationType'=>$type);

            $updatesuccess=$this->DbHandler->updateData($updateStationData,'stations',$id);

            //Redirect the user back with  message
            if($updatesuccess){
                //Store User logs.
                //Create user Logs
                $session_data = $this->session->userdata('logged_in');
                $UserRole=$session_data['UserRole'];
                $StationName=$session_data['StationName'];
                $StationNumber=$session_data['StationNumber'];

                $name=$session_data['FirstName'].' '.$session_data['SurName'];

               $userid =$session_data['Userid'];
               $userlogs = array('Userid' => $userid,
                    'Action' => 'Updated station details',
                    'Details' => $name . ' updated station details in the system ',
                   
                    'IP' => $this->input->ip_address());
                //  save user logs
                $this->DbHandler->saveUserLogs($userlogs);


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
            $UserRole=$session_data['UserRole'];
            $StationName=$session_data['StationName'];
            $StationNumber=$session_data['StationNumber'];
            $StationRegion=$session_data['StationRegion'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $UserRole,'Action' => 'Deleted station details',
                'Details' => $name . ' deleted station details in the system ',
                'StationName' => $StationName,
                'StationNumber' => $StationNumber,
                'StationRegion' => $StationRegion,
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

    function getStationDetails($StationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));
        //stationLocation
        $StationName = ($StationName == "") ? $this->input->post('StationName') : $StationName;
//check($value,$field,$table)
        if ($this->input->post('StationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {


            $get_result = $this->DbHandler->getResults($StationName, 'LocationStationName', 'stationlocationindicators');   // $value, $field, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }

        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$stationLocation,$stationIndicator) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;

        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        $stationLocation = ($stationLocation == "") ? $this->input->post('stationLocation') : $stationLocation;

        $stationIndicator = ($stationIndicator == "") ? $this->input->post('stationIndicator') : $stationIndicator;

        if ($this->input->post('stationName') == "") {
            //echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$stationLocation,$stationIndicator,'stations');   // $value, $table

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
