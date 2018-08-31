<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MetarForm extends CI_Controller {

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

        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','metar');


        //  var_dump($query);
        if ($query) {
            $data['metarformdata'] = $query;
        } else {
            $data['metarformdata'] = array();
        }

        $this->load->view('metarForm', $data);
    }
    public function DisplayMetar(){
        $this->unsetflashdatainfo();
        $name='displaynewmetarform';
        $data['displaynewmetarform'] = array('name' => $name);

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

        /////////////////////////////////////////////////////////

        $this->load->view('metarForm', $data);

    }
    public function DisplayMetarFormForUpdate(){
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

        $metarid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($metarid,'id','metar');  //$value, $field,$table
        if ($query) {
            $data['metardataid'] = $query;
        } else {
            $data['metardataid'] = array();
        }


        $this->load->view('metarForm', $data);
    }

    public function insertMetar(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];



        $date = $this->input->post('date_metar');


       //Both the Observer and OC can input data into the form

            $station = firstcharuppercase(chgtolowercase($this->input->post('station_metar')));

            $stationNumber = $this->input->post('stationNo_metar');






        $timemetar=$this->input->post('time_metar');
        $metarspeci = $this->input->post('metarspeci_metar');
        $cccc = $this->input->post('cccc_metar');
        $yyGGgg = $this->input->post('yyGGgg_metar');
        $Dddfffmfm = $this->input->post('dddfffmfm_metar');
        $wwcovak = $this->input->post('wwcovak_metar');
        $w1w1 = $this->input->post('w1w1_metar');
        $n1cch1 = $this->input->post('ncc_metar');

        $airtemperature = $this->input->post('airtemperature_metar');
        //$humidity = $this->input->post('humiditymetar');
        $dew_temperature = $this->input->post('dewpoint_metar');
        $wet_bulb = $this->input->post('wetbulb_metar');

        $tttdtd = $this->input->post('tttdtd_metar');
        $qnhhpa = $this->input->post('qnhhpa_metar');
        $qnhin = $this->input->post('qnhin_metar');
        $qfehpa = $this->input->post('qfehpa_metar');
        $qfein = $this->input->post('qfein_metar');
        $rew1w1 = $this->input->post('rew1w1_metar');

        $approved="false";
       // $creationDate= date('Y-m-d H:i:s');
        $user=$firstname.' '.$surname;
        //$approved='false';

        $insertMetarFormData=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=>$stationNumber,'TIME'=>$timemetar,
            'METARSPECI'=> $metarspeci, 'CCCC'=>$cccc,
            'YYGGgg'=> $yyGGgg,'Dddfffmfm'=> $Dddfffmfm, 'WWorCOVAK'=> $wwcovak,
            'W1W1'=>$w1w1, 'NlCCNmCCNhCC'=> $n1cch1, 'Air_temperature'=> $airtemperature,
            'Dew_temperature'=>$dew_temperature,
            'Wet_bulb'=> $wet_bulb,'TTTdTd'=> $tttdtd, 'Qnhhpa'=>$qnhhpa, 'Qnhin'=>$qnhin,
            'Qfehpa'=>$qfehpa, 'Qfein'=>$qfein,'REW1W1'=>$rew1w1,'Approved'=>$approved,
             'SubmittedBy'=>$user);


        //Insert New Metar Infor into the Database.
        // $insertsuccess= $this->DbHandler->insertMetarFormData($insertMetarFormData);

        $insertsuccess= $this->DbHandler->insertData($insertMetarFormData,'metar'); //Array for data to insert then  the Table Name


        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

           $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
                'Action' => 'Added metar book info',
                'Details' => $name . ' added metar book info into the system',
              
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'New metar info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }



    }

    public function updateMetarFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        //$firstname=$session_data['FirstName'];
        //$surname=$session_data['SurName'];



        $date = $this->input->post('date');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));

            $stationNumber = $this->input->post('stationNo');






        $time=$this->input->post('timeRecorded');
        $metarspeci = $this->input->post('metarspeci');
        $cccc = $this->input->post('cccc');
        $yyGGgg = $this->input->post('yyGGgg');
        $Dddfffmfm = $this->input->post('dddfffmfm');
        $wwcovak = $this->input->post('wwcovak');
        $w1w1 = $this->input->post('w1w1');
        $n1cch1 = $this->input->post('ncc');

        $airtemperature = $this->input->post('airtemperature');
        //$humidity = $this->input->post('humidity');
        $dew_temperature = $this->input->post('dewpoint');
        $wet_bulb = $this->input->post('wetbulb');

        $tttdtd = $this->input->post('tttdtd');
        $qnhhpa = $this->input->post('qnhhpa');
        $qnhin = $this->input->post('qnhin');
        $qfehpa = $this->input->post('qfehpa');
        $qfein = $this->input->post('qfein');
        $rew1w1 = $this->input->post('rew1w1');

        $approved=$this->input->post('approval');

        $id = $this->input->post('id');


        $updateMetarFormData=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=>$stationNumber,'TIME'=>$time,
            'METARSPECI'=> $metarspeci, 'CCCC'=>$cccc,
            'YYGGgg'=> $yyGGgg,'Dddfffmfm'=> $Dddfffmfm, 'WWorCOVAK'=> $wwcovak,
            'W1W1'=>$w1w1, 'NlCCNmCCNhCC'=> $n1cch1, 'Air_temperature'=> $airtemperature,
             'Dew_temperature'=>$dew_temperature,
            'Wet_bulb'=> $wet_bulb,'TTTdTd'=> $tttdtd, 'Qnhhpa'=>$qnhhpa, 'Qnhin'=>$qnhin,
            'Qfehpa'=>$qfehpa, 'Qfein'=>$qfein,'REW1W1'=>$rew1w1,'Approved'=>$approved
        );



        $updatesuccess=$this->DbHandler->updateData($updateMetarFormData,'metar',$id);




        //Redirect the user back with  message
        if($updatesuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
           'Action' => 'Updated metar book info',
                'Details' => $name . ' updated metar book info into the system',
                
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Metar book info was updated successfully!');
           // $this->session->set_flashdata('success', 'You have successfully logged out');
            $this->index();
            //Load the next page
            //$this->load->view('observationslipform');

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
            $this->index();

        }

    }

    public function deleteMetarFormData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('metar',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted metar book info',
                'Details' => $name . ' deleted metar book info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Metar book info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfMetarFormRecordExistsAlready($date,$stationName,$stationNumber,$timeOfMetarRecorded,$metarOption) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $timeOfMetarRecorded = ($timeOfMetarRecorded == "") ? $this->input->post('timeOfMetarRecorded') : $timeOfMetarRecorded;
        $metarOption = ($metarOption == "") ? $this->input->post('metarOption') : $metarOption;
        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveMetarFormRecordExistsAlready($date,$stationName,$stationNumber,$timeOfMetarRecorded,$metarOption,'metar');   // $value, $field, $table

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