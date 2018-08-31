<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
class AutomaticWeatherStations extends CI_Controller {

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
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];




        //Select all from the table(aws) in the DB.
        $query = $this->DbHandler->selectAll($userstation,'StationName','aws');
        //  var_dump($query);
        if ($query) {
            $data['formdataforaws'] = $query;
        } else {
            $data['formdataforaws'] = array();
        }

        $this->load->view('automaticweatherstationsform', $data);
    }
    public function DisplayAutomaticWeatherStationsForm(){
        $this->unsetflashdatainfo();
        $name='displaynewautomaticweatherstationsForm';
        $data['displaynewautomaticweatherstationsForm'] = array('name' => $name);

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

        $this->load->view('automaticweatherstationsform', $data);

    }
    public function DisplayAutomaticWeatherStationsFormForUpdate(){
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


        $awsformid = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($awsformid,'id','aws');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['updateawsformdata'] = $query;
        } else {
            $data['updateawsformdata'] = array();
        }

        $this->load->view('automaticweatherstationsform', $data);
    }
    public function insertAWSData(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('dateaws');
        //$time=$this->input->post('timesynoptic');
        $time=$this->input->post('timeaws');
        //$month = date("F");
        //$year = date("Y");


        if($role=="Manager"){

            $station = firstcharuppercase(chgtolowercase($this->input->post('stationawsManager')));

            $stationNumber = $this->input->post('stationNoawsManager');




        }
        else if($role=="OC"){

            $station = firstcharuppercase(chgtolowercase($this->input->post('stationawsOC')));
            $stationNumber = $this->input->post('stationNoawsOC');

        }

        $txt = $this->input->post('txtaws');
        $macaddress = $this->input->post('e64aws');

        $idoftransmittingnode = $this->input->post('idaws');
        $temperature = $this->input->post('tempaws');
        $soiltemperature = $this->input->post('soiltemperatureaws');

        $temperatureofmicroprocessor = $this->input->post('t_mcuaws');
        $voltageofmicroprocessor = $this->input->post('v_mcuaws');
        $p0 = $this->input->post('p0aws');
        $p0_lst60_02 = $this->input->post('p0_lst60_0.2aws');

        $p1 = $this->input->post('p1aws');
        $p1_t = $this->input->post('p1_taws');

        $p1_lst = $this->input->post('p1_lstaws');
        $uptime = $this->input->post('uptimeaws');
        $error = $this->input->post('erroraws');

        $inputvoltage = $this->input->post('v_inaws');
        $analogvoltageone = $this->input->post('a1aws');
        $analogvoltagetwo = $this->input->post('a2aws');
        $analogvoltagethree = $this->input->post('a3aws');

        $stationlongitude = $this->input->post('gw_lonaws');
        $stationlatitude = $this->input->post('gw_lataws');
        $p_ms5611 = $this->input->post('p_ms5611aws');
        $ut = $this->input->post('utaws');


        $rh_sht2x = $this->input->post('rh_sht2xaws');

        $t_sht2x = $this->input->post('t_sht2xaws');
        $adc1 = $this->input->post('adc1aws');


        $adc2 = $this->input->post('adc2aws');
        $domain = $this->input->post('domainaws');
        $tz = $this->input->post('tzaws');

        $up = $this->input->post('upaws');

        $temperatureOftheBox = $this->input->post('temperatureoftheboxaws');
        $soilmoisture = $this->input->post('v_a1aws');
        $windspeed = $this->input->post('p0_taws');

        $V_A1_V_A2_005_400= $this->input->post('((V_A1)_(V_A2)_0.05)_400aws');
        $V_AD1_100= $this->input->post('V_AD1_100aws');

        $V_AD2_100 = $this->input->post('V_AD2_100aws');
        $V_AD3_100 = $this->input->post('V_AD3_100aws');


        $V_AD1_1000 = $this->input->post('V_AD1_1000aws');
        $V_AD2_1000 = $this->input->post('V_AD2_1000aws');
        $V_AD3_1000 = $this->input->post('V_AD3_1000aws');




        $creationDate= date('Y-m-d H:i:s');
        $SubmittedBy=$name;



        $insertAWSFormData=array(
            'Date'=>$date,'Time'=>$time,
            'StationName'=>$station,'StationNumber'=> $stationNumber,

            'Txt'=> $txt, 'E64'=>$macaddress,'IdOfTransmittingNode'=>$idoftransmittingnode,

            'Temperature'=>$temperature,'SoilTemperature'=>$soiltemperature,
            'T_mcu'=>$temperatureofmicroprocessor,'V_mcu'=>$voltageofmicroprocessor,
            'P0'=>$p0,'P0_lst60_02'=>$p0_lst60_02,
            'P1'=>$p1,'P1_t'=>$p1_t,'P1_lst'=>$p1_lst,
            'Uptime'=>$uptime,

            'Error'=>$error,
            'V_in'=>$inputvoltage,'A1'=>$analogvoltageone,
            'A2'=>$analogvoltagetwo,'A3'=>$analogvoltagethree,
            'GW_LON'=>$stationlongitude,'GW_LAT'=>$stationlatitude,'P_MS5611'=>$p_ms5611,
            'UT'=>$ut,'RH_SHT2X'=>$rh_sht2x,
            'T_SHT2X'=>$t_sht2x,

            'ADC1'=>$adc1,'ADC2'=>$adc2,
            'DOMAIN'=>$domain,
            'TZ'=>$tz,'UP'=>$up,'TemperatureOfBox'=>$temperatureOftheBox,
            'V_a1'=>$soilmoisture,'P0_T'=>$windspeed,
            'V_A1_V_A2_005_400'=>$V_A1_V_A2_005_400,
            'V_AD1_100'=>$V_AD1_100,'V_AD2_100'=>$V_AD2_100,


            'V_AD3_100'=>$V_AD3_100,

            'V_AD1_1000'=>$V_AD1_1000,
            'V_AD2_1000'=>$V_AD2_1000,'V_AD3_1000'=>$V_AD3_1000);

        $insertsuccess= $this->DbHandler->insertData($insertAWSFormData,'aws'); //Array for data to insert then  the Table Name





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
                'UserRole' => $userrole,'Action' => 'Added aws info',
                'Details' => $name . ' added aws info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'New AWS info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }


    }
    public function updateAWSFormData(){
        $this->unsetflashdatainfo();
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date');
        //$time=$this->input->post('timesynoptic');
        $time=$this->input->post('time');
        //$month = date("F");
        //$year = date("Y");


        if($role=="Manager"){

            $station = firstcharuppercase(chgtolowercase($this->input->post('stationManager')));

            $stationNumber = $this->input->post('stationNoManager');




        }
        else if($role=="OC"){

            $station = firstcharuppercase(chgtolowercase($this->input->post('stationOC')));
            $stationNumber = $this->input->post('stationNoOC');

        }

        $txt = $this->input->post('txt');
        $macaddress = $this->input->post('e64');

        $idoftransmittingnode = $this->input->post('id');
        $temperature = $this->input->post('temp');
        $soiltemperature = $this->input->post('soiltemperature');

        $temperatureofmicroprocessor = $this->input->post('t_mcu');
        $voltageofmicroprocessor = $this->input->post('v_mcu');
        $p0 = $this->input->post('p0');
        $p0_lst60_02 = $this->input->post('p0_lst60_0.2');

        $p1 = $this->input->post('p1');
        $p1_t = $this->input->post('p1_t');

        $p1_lst = $this->input->post('p1_lst');
        $uptime = $this->input->post('uptime');
        $error = $this->input->post('error');

        $inputvoltage = $this->input->post('v_in');
        $analogvoltageone = $this->input->post('a1');
        $analogvoltagetwo = $this->input->post('a2');
        $analogvoltagethree = $this->input->post('a3');

        $stationlongitude = $this->input->post('gw_lon');
        $stationlatitude = $this->input->post('gw_lat');
        $p_ms5611 = $this->input->post('p_ms5611');
        $ut = $this->input->post('ut');


        $rh_sht2x = $this->input->post('rh_sht2x');

        $t_sht2x = $this->input->post('t_sht2x');
        $adc1 = $this->input->post('adc1');


        $adc2 = $this->input->post('adc2');
        $domain = $this->input->post('domain');
        $tz = $this->input->post('tz');

        $up = $this->input->post('up');

        $temperatureOftheBox = $this->input->post('temperatureofthebox');
        $soilmoisture = $this->input->post('v_a1');
        $windspeed = $this->input->post('p0_t');

        $V_A1_V_A2_005_400= $this->input->post('((V_A1)_(V_A2)_0.05)_400');
        $V_AD1_100= $this->input->post('V_AD1_100');

        $V_AD2_100 = $this->input->post('V_AD2_100');
        $V_AD3_100 = $this->input->post('V_AD3_100');


        $V_AD1_1000 = $this->input->post('V_AD1_1000');
        $V_AD2_1000 = $this->input->post('V_AD2_1000');
        $V_AD3_1000 = $this->input->post('V_AD3_1000');


       // $id = $this->input->post('id');


        $updateAWSFormData=array(
            'Date'=>$date,'Time'=>$time,
            'StationName'=>$station,'StationNumber'=> $stationNumber,

            'Txt'=> $txt, 'E64'=>$macaddress,'IdOfTransmittingNode'=>$idoftransmittingnode,

            'Temperature'=>$temperature,'SoilTemperature'=>$soiltemperature,
            'T_mcu'=>$temperatureofmicroprocessor,'V_mcu'=>$voltageofmicroprocessor,
            'P0'=>$p0,'P0_lst60_02'=>$p0_lst60_02,
            'P1'=>$p1,'P1_t'=>$p1_t,'P1_lst'=>$p1_lst,
            'Uptime'=>$uptime,

            'Error'=>$error,
            'V_in'=>$inputvoltage,'A1'=>$analogvoltageone,
            'A2'=>$analogvoltagetwo,'A3'=>$analogvoltagethree,
            'GW_LON'=>$stationlongitude,'GW_LAT'=>$stationlatitude,'P_MS5611'=>$p_ms5611,
            'UT'=>$ut,'RH_SHT2X'=>$rh_sht2x,
            'T_SHT2X'=>$t_sht2x,

            'ADC1'=>$adc1,'ADC2'=>$adc2,
            'DOMAIN'=>$domain,
            'TZ'=>$tz,'UP'=>$up,'TemperatureOfBox'=>$temperatureOftheBox,
            'V_a1'=>$soilmoisture,'P0_T'=>$windspeed,
            'V_A1_V_A2_005_400'=>$V_A1_V_A2_005_400,
            'V_AD1_100'=>$V_AD1_100,'V_AD2_100'=>$V_AD2_100,


            'V_AD3_100'=>$V_AD3_100,

            'V_AD1_1000'=>$V_AD1_1000,
            'V_AD2_1000'=>$V_AD2_1000,'V_AD3_1000'=>$V_AD3_1000);

        $id = $this->input->post('id');



        //$this->DbHandler->insertInstrument($insertInstrumentData);
        $updatesuccess= $this->DbHandler->updateData($updateAWSFormData,'aws',$id); //Array for data to insert then  the Table Name



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
                'UserRole' => $userrole,'Action' => 'Update archieve info',
                'Details' => $name . ' updated  aws  info in the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);
            $this->session->set_flashdata('success', ' AWS info was Updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }



    // }
    public function deleteAWSFormData(){
        $this->unsetflashdatainfo();
        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('aws',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
//Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted aws info',
                'Details' => $name . ' deleted aws info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'AWS info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

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