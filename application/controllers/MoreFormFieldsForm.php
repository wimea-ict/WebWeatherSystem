<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MoreFormFieldsForm extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        //$this->load->library('encrypt');

    }
    public function index(){
       // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','moreformfields');


        //  var_dump($query);
        if ($query) {
            $data['moreformfieldsformdata'] = $query;
        } else {
            $data['moreformfieldsformdata'] = array();
        }

        $this->load->view('moreFormFieldsForm', $data);
    }
    public function DisplayMoreFormFieldsForm(){
        $this->unsetflashdatainfo();
        $name='displaynewmoreformfieldsform';
        $data['displaynewmoreformfieldsform'] = array('name' => $name);

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

        /////////////////////////////////////////////////////////

        $this->load->view('moreFormFieldsForm', $data);

    }
    public function DisplayMoreFormFieldsFormForUpdate(){
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

        $dataid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($dataid,'id','moreformfields');  //$value, $field,$table
        if ($query) {
            $data['moreformfieldsform_id'] = $query;
        } else {
            $data['moreformfieldsform_id'] = array();
        }


        $this->load->view('moreFormFieldsForm', $data);
    }

    public function insertMoreFormFieldsFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];



        $date = $this->input->post('date_mff');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station_mff')));

            $stationNumber = $this->input->post('stationNo_mff');


        $time = $this->input->post('time_mff');
        $UnitOfWindSpeed = $this->input->post('UnitOfWindSpeed_mff');

        $IndOrOmissionOfPrecipitation = $this->input->post('IndOrOmissionOfPrecipitation_mff');
        $TypeOfStation_Present_Past_Weather = $this->input->post('TypeOfStation_Present_Past_Weather_mff');

        $HeightOfLowestCloud = $this->input->post('heightOfLowestCloud_mff');
        $StandardIsobaricSurface = $this->input->post('StandardIsobaricSurface_mff');
        $GPM = $this->input->post('gpm_mff');
        $DurationOfPeriodOfPrecipitation = $this->input->post('dopop_mff');
        $Past_Weather = $this->input->post('pastweather_mff');
        $GrassMinTemperature = $this->input->post('gmt_mff');

        $CI_OfPrecipitation = $this->input->post('CI_OfPrecipitation_mff');

        $BE_OfPrecipitation = $this->input->post('BE_OfPrecipitation_mff');
        $IndicatorOfTypeOfIntrumentation=$this->input->post('IndicatorOfTypeOfIntrumentation_mff');
        $DurationOfSunshine=$this->input->post('DurationOfSunshine_mff');
        $SignOfPressureChange=$this->input->post('SignOfPressureChange_mff');

        $Supplementary_Information = $this->input->post('supplementaryinformation_mff');

        $Wind_Run=$this->input->post('windrun_mff');
        $VapourPressure=$this->input->post('VapourPressure_mff');

        $T_H_Graph = $this->input->post('thgraph_mff');


        $approved="FALSE";
        $creationDate= date('Y-m-d H:i:s');
        $user=$firstname.' '.$surname;


        $insertMoreFormFieldsData=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=>$stationNumber,
            'TIME'=> $time,
            'UnitOfWindSpeed'=>$UnitOfWindSpeed,'IndOrOmissionOfPrecipitation'=>$IndOrOmissionOfPrecipitation,
            'TypeOfStation_Present_Past_Weather'=>$TypeOfStation_Present_Past_Weather,
            'HeightOfLowestCloud'=>$HeightOfLowestCloud,
            'StandardIsobaricSurface'=>$StandardIsobaricSurface,
            'GPM'=> $GPM, 'DurationOfPeriodOfPrecipitation'=> $DurationOfPeriodOfPrecipitation,

            'Past_Weather'=>$Past_Weather, 'GrassMinTemp'=> $GrassMinTemperature,
            'CI_OfPrecipitation'=> $CI_OfPrecipitation,
            'BE_OfPrecipitation'=>$BE_OfPrecipitation,
            'IndicatorOfTypeOfIntrumentation'=>$IndicatorOfTypeOfIntrumentation,
            'DurationOfSunshine'=>$DurationOfSunshine,
            'SignOfPressureChange'=>$SignOfPressureChange,
            'VapourPressure'=>$VapourPressure,
            'Supp_Info'=> $Supplementary_Information,
            'Wind_Run'=>$Wind_Run,
            'T_H_Graph'=> $T_H_Graph,
            'Approved'=>$approved,
            'CreationDate'=>$creationDate, 'SubmittedBy'=>$user);


        //Insert New Metar Infor into the Database.
        // $insertsuccess= $this->Md->insertMetarFormData($insertMetarFormData);

        $insertsuccess= $this->DbHandler->insertData($insertMoreFormFieldsData,'moreformfields'); //Array for data to insert then  the Table Name


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
                'UserRole' => $userrole,'Action' => 'Added More Form Fields book info',
                'Details' => $name . ' added More Form Fields info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'New More Form Fields info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }



    }

    public function updateMoreFormFieldsFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        //$firstname=$session_data['FirstName'];
        //$surname=$session_data['SurName'];



        $date = $this->input->post('date');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));

            $stationNumber = $this->input->post('stationNo');



        $time = $this->input->post('timeRecorded');
        $UnitOfWindSpeed = $this->input->post('UnitOfWindSpeed');

        $IndOrOmissionOfPrecipitation = $this->input->post('IndOrOmissionOfPrecipitation');
        $TypeOfStation_Present_Past_Weather = $this->input->post('TypeOfStation_Present_Past_Weather');

        $HeightOfLowestCloud = $this->input->post('heightOfLowestCloud');
        $StandardIsobaricSurface = $this->input->post('StandardIsobaricSurface');

        $GPM = $this->input->post('gpm');
        $DurationOfPeriodOfPrecipitation = $this->input->post('dopop');
        $Past_Weather = $this->input->post('pastweather');
        $GrassMinTemperature = $this->input->post('gmt');

        $CI_OfPrecipitation = $this->input->post('CI_OfPrecipitation');

        $BE_OfPrecipitation = $this->input->post('BE_OfPrecipitation');
        $IndicatorOfTypeOfIntrumentation=$this->input->post('IndicatorOfTypeOfIntrumentation');
        $DurationOfSunshine=$this->input->post('DurationOfSunshine');
        $SignOfPressureChange=$this->input->post('SignOfPressureChange');

        $Supplementary_Information = $this->input->post('supplementaryinformation');
        $VapourPressure=$this->input->post('VapourPressure');

        $Wind_Run=$this->input->post('windrun');

        $T_H_Graph = $this->input->post('thgraph');

        $approved=$this->input->post('approval');

        $id = $this->input->post('id');


        $updateMoreFormFieldsData=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=>$stationNumber,
            'TIME'=> $time,
            'UnitOfWindSpeed'=>$UnitOfWindSpeed,'IndOrOmissionOfPrecipitation'=>$IndOrOmissionOfPrecipitation,
            'TypeOfStation_Present_Past_Weather'=>$TypeOfStation_Present_Past_Weather,

            'HeightOfLowestCloud'=>$HeightOfLowestCloud,
            'StandardIsobaricSurface'=>$StandardIsobaricSurface,
            'GPM'=> $GPM, 'DurationOfPeriodOfPrecipitation'=> $DurationOfPeriodOfPrecipitation,

            'Past_Weather'=>$Past_Weather, 'GrassMinTemp'=> $GrassMinTemperature,
            'CI_OfPrecipitation'=> $CI_OfPrecipitation,
            'BE_OfPrecipitation'=>$BE_OfPrecipitation,
            'IndicatorOfTypeOfIntrumentation'=>$IndicatorOfTypeOfIntrumentation,
            'DurationOfSunshine'=>$DurationOfSunshine,
            'SignOfPressureChange'=>$SignOfPressureChange,

            'Supp_Info'=> $Supplementary_Information,
            'VapourPressure'=>$VapourPressure,
            'Wind_Run'=>$Wind_Run,

            'T_H_Graph'=> $T_H_Graph,
            'Approved'=>$approved
        );



        $updatesuccess=$this->DbHandler->updateData($updateMoreFormFieldsData,'moreformfields',$id);




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
                'UserRole' => $userrole,'Action' => 'Updated More Form Fields info',
                'Details' => $name . ' updated More Form Fields info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'More Form Fields info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
            $this->index();

        }

    }

    public function deleteMoreFormFieldsData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('moreformfields',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted metar book info',
                'Details' => $name . ' deleted metar book info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->Md->saveUserLogs($userlogs);

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
    function checkInDBIfMoreFormFieldsFormRecordExistsAlready($date,$timeRecorded,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $timeRecorded = ($timeRecorded == "") ? $this->input->post('timeRecorded') : $timeRecorded;
       // $metarOption = ($metarOption == "") ? $this->input->post('metarOption') : $metarOption;
        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfMoreFormFieldsFormRecordExistsAlready($date,$timeRecorded,$stationName,$stationNumber,'moreformfields');   // $value, $field, $table

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