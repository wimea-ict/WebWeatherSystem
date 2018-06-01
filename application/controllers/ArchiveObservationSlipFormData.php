<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveObservationSlipFormData extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        //$this->load->library('encrypt');

    }
    public function index(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
        $query = $this->DbHandler->selectAll($userstation,'StationName','archiveobservationslipformdata');


        //  var_dump($query);
        if ($query) {
            $data['archivedobservationslipformdata'] = $query;
        } else {
            $data['archivedobservationslipformdata'] = array();
        }

        $this->load->view('archiveObservationSlipFormData', $data);
    }
    public function DisplayNewArchiveObservationSlipForm(){
        $this->unsetflashdatainfo();
        $name='displaynewarchiveobervationslipform';
        $data['displaynewarchiveobervationslipform'] = array('name' => $name);

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

        $this->load->view('archiveObservationSlipFormData', $data);

    }
    public function DisplayArchiveObservationSlipFormForUpdate(){
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

        $archivedobservationslipformdataid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($archivedobservationslipformdataid,'id','archiveobservationslipformdata');  //$value, $field,$table
        if ($query) {
            $data['archivedobservationslipformdataidupdate'] = $query;
        } else {
            $data['archivedobservationslipformdataidupdate'] = array();
        }


        $this->load->view('archiveObservationSlipFormData', $data);
    }

    public function insertArchiveObservationSlipFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];



        $date = $this->input->post('date_archiveobservationslipformdata');





            $station = firstcharuppercase(chgtolowercase($this->input->post('station_archiveobservationslipformdata')));
            $stationNumber = $this->input->post('stationNo_archiveobservationslipformdata');



        $timeobservationslipform = $this->input->post('time_archiveobservationslipformdata');


        $totalAmountOfAllClouds = $this->input->post('totalamountofallclouds_archiveobservationslipformdata');
        $totalAmountOfLowClouds = $this->input->post('totalamountoflowclouds_archiveobservationslipformdata');

        $TypeOfLowClouds1 = $this->input->post('TypeOfLowClouds1_archiveobservationslipformdata');
        $OktasOfLowClouds1= $this->input->post('OktasOfLowClouds1_archiveobservationslipformdata');
        $HeightOfLowClouds1 = $this->input->post('HeightOfLowClouds1_archiveobservationslipformdata');
        $CLCODEOfLowClouds1 = $this->input->post('CLCODEOfLowClouds1_archiveobservationslipformdata');

        $TypeOfLowClouds2 = $this->input->post('TypeOfLowClouds2_archiveobservationslipformdata');
        $OktasOfLowClouds2= $this->input->post('OktasOfLowClouds2_archiveobservationslipformdata');
        $HeightOfLowClouds2 = $this->input->post('HeightOfLowClouds2_archiveobservationslipformdata');
        $CLCODEOfLowClouds2 = $this->input->post('CLCODEOfLowClouds2_archiveobservationslipformdata');

        $TypeOfLowClouds3 = $this->input->post('TypeOfLowClouds3_archiveobservationslipformdata');
        $OktasOfLowClouds3= $this->input->post('OktasOfLowClouds3_archiveobservationslipformdata');
        $HeightOfLowClouds3 = $this->input->post('HeightOfLowClouds3_archiveobservationslipformdata');
        $CLCODEOfLowClouds3 = $this->input->post('CLCODEOfLowClouds3_archiveobservationslipformdata');

        $TypeOfMediumClouds1 = $this->input->post('TypeOfMediumClouds1_archiveobservationslipformdata');
        $OktasOfMediumClouds1= $this->input->post('OktasOfMediumClouds1_archiveobservationslipformdata');
        $HeightOfMediumClouds1 = $this->input->post('HeightOfMediumClouds1_archiveobservationslipformdata');
        $CLCODEOfMediumClouds1 = $this->input->post('CLCODEOfMediumClouds1_archiveobservationslipformdata');

        $TypeOfMediumClouds2 = $this->input->post('TypeOfMediumClouds2_archiveobservationslipformdata');
        $OktasOfMediumClouds2= $this->input->post('OktasOfMediumClouds2_archiveobservationslipformdata');
        $HeightOfMediumClouds2 = $this->input->post('HeightOfMediumClouds2_archiveobservationslipformdata');
        $CLCODEOfMediumClouds2 = $this->input->post('CLCODEOfMediumClouds2_archiveobservationslipformdata');

        $TypeOfMediumClouds3 = $this->input->post('TypeOfMediumClouds3_archiveobservationslipformdata');
        $OktasOfMediumClouds3= $this->input->post('OktasOfMediumClouds3_archiveobservationslipformdata');
        $HeightOfMediumClouds3 = $this->input->post('HeightOfMediumClouds3_archiveobservationslipformdata');
        $CLCODEOfMediumClouds3 = $this->input->post('CLCODEOfMediumClouds3_archiveobservationslipformdata');

        $TypeOfHighClouds1 = $this->input->post('TypeOfHighClouds1_archiveobservationslipformdata');
        $OktasOfHighClouds1= $this->input->post('OktasOfHighClouds1_archiveobservationslipformdata');
        $HeightOfHighClouds1 = $this->input->post('HeightOfHighClouds1_archiveobservationslipformdata');
        $CLCODEOfHighClouds1 = $this->input->post('CLCODEOfHighClouds1_archiveobservationslipformdata');

        $TypeOfHighClouds2 = $this->input->post('TypeOfHighClouds2_archiveobservationslipformdata');
        $OktasOfHighClouds2= $this->input->post('OktasOfHighClouds2_archiveobservationslipformdata');
        $HeightOfHighClouds2 = $this->input->post('HeightOfHighClouds2_archiveobservationslipformdata');
        $CLCODEOfHighClouds2 = $this->input->post('CLCODEOfHighClouds2_archiveobservationslipformdata');

        $TypeOfHighClouds3 = $this->input->post('TypeOfHighClouds3_archiveobservationslipformdata');
        $OktasOfHighClouds3= $this->input->post('OktasOfHighClouds3_archiveobservationslipformdata');
        $HeightOfHighClouds3 = $this->input->post('HeightOfHighClouds3_archiveobservationslipformdata');
        $CLCODEOfHighClouds3 = $this->input->post('CLCODEOfHighClouds3_archiveobservationslipformdata');


        $CloudSearchLightReading = $this->input->post('cloudsearchlight_archiveobservationslipformdata');
        $Rainfall= $this->input->post('rainfall_archiveobservationslipformdata');
        $Dry_Bulb= $this->input->post('drybulb_archiveobservationslipformdata');
        $Wet_Bulb = $this->input->post('wetbulb_archiveobservationslipformdata');

        $Max_Read = $this->input->post('maxRead_archiveobservationslipformdata');
        $Max_Reset = $this->input->post('maxReset_archiveobservationslipformdata');

        $Min_Read = $this->input->post('minRead_archiveobservationslipformdata');
        $Min_Reset = $this->input->post('minReset_archiveobservationslipformdata');

        $Piche_Read = $this->input->post('picheRead_archiveobservationslipformdata');
        $Piche_Reset = $this->input->post('picheReset_archiveobservationslipformdata');

        $TimeMarksThermo = $this->input->post('timemarksThermo_archiveobservationslipformdata');
        $TimeMarksHygro = $this->input->post('timemarksHygro_archiveobservationslipformdata');
        $TimeMarksRainRec = $this->input->post('timemarksRainRec_archiveobservationslipformdata');


        $Present_Weather = $this->input->post('presentweather_archiveobservationslipformdata');
        $Visibility = $this->input->post('visibility_archiveobservationslipformdata');

        $Wind_Direction = $this->input->post('winddirection_archiveobservationslipformdata');
        $Wind_Speed = $this->input->post('windspeed_archiveobservationslipformdata');
        $Gusting = $this->input->post('gusting_archiveobservationslipformdata');

        $AttdThermo = $this->input->post('attdThermo_archiveobservationslipformdata');
        $PrAsRead = $this->input->post('prAsRead_archiveobservationslipformdata');
        $Correction = $this->input->post('correction_archiveobservationslipformdata');
        $CLP = $this->input->post('CLP_archiveobservationslipformdata');
        $MSLPr = $this->input->post('MSLPR_archiveobservationslipformdata');
        $TimeMarksBarograph = $this->input->post('timeMarksBarograph_archiveobservationslipformdata');
        $TimeMarksAnemoograph = $this->input->post('timeMarksAnemograph_archiveobservationslipformdata');

        $OtherTMarks = $this->input->post('otherTMarks_archiveobservationslipformdata');
        $Remarks = $this->input->post('remarks_archiveobservationslipformdata');


        $approved="FALSE";
       // $creationDate= date('Y-m-d H:i:s');
        $user=$firstname.' '.$surname;


        $insertObservationSlipFormData=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=>$stationNumber,
            'TIME'=> $timeobservationslipform,
            'TotalAmountOfAllClouds'=>$totalAmountOfAllClouds,

            'TotalAmountOfLowClouds'=> $totalAmountOfLowClouds,

            'TypeOfLowClouds1'=> $TypeOfLowClouds1, 'OktasOfLowClouds1'=> $OktasOfLowClouds1,
            'HeightOfLowClouds1'=>$HeightOfLowClouds1, 'CLCODEOfLowClouds1'=> $CLCODEOfLowClouds1,

            'TypeOfLowClouds2'=> $TypeOfLowClouds2, 'OktasOfLowClouds2'=> $OktasOfLowClouds2,
            'HeightOfLowClouds2'=>$HeightOfLowClouds2, 'CLCODEOfLowClouds2'=> $CLCODEOfLowClouds2,

            'TypeOfLowClouds3'=> $TypeOfLowClouds3, 'OktasOfLowClouds3'=> $OktasOfLowClouds3,
            'HeightOfLowClouds3'=>$HeightOfLowClouds3, 'CLCODEOfLowClouds3'=> $CLCODEOfLowClouds3,




            'TypeOfMediumClouds1'=> $TypeOfMediumClouds1, 'OktasOfMediumClouds1'=> $OktasOfMediumClouds1,
            'HeightOfMediumClouds1'=>$HeightOfMediumClouds1, 'CLCODEOfMediumClouds1'=> $CLCODEOfMediumClouds1,

            'TypeOfMediumClouds2'=> $TypeOfMediumClouds2, 'OktasOfMediumClouds2'=> $OktasOfMediumClouds2,
            'HeightOfMediumClouds2'=>$HeightOfMediumClouds2, 'CLCODEOfMediumClouds2'=> $CLCODEOfMediumClouds2,

            'TypeOfMediumClouds3'=> $TypeOfMediumClouds3, 'OktasOfMediumClouds3'=> $OktasOfMediumClouds3,
            'HeightOfMediumClouds3'=>$HeightOfMediumClouds3, 'CLCODEOfMediumClouds3'=> $CLCODEOfMediumClouds3,





            'TypeOfHighClouds1'=> $TypeOfHighClouds1, 'OktasOfHighClouds1'=> $OktasOfHighClouds1,
            'HeightOfHighClouds1'=>$HeightOfHighClouds1, 'CLCODEOfHighClouds1'=> $CLCODEOfHighClouds1,

            'TypeOfHighClouds2'=> $TypeOfHighClouds2, 'OktasOfHighClouds2'=> $OktasOfHighClouds2,
            'HeightOfHighClouds2'=>$HeightOfHighClouds2, 'CLCODEOfHighClouds2'=> $CLCODEOfHighClouds2,

            'TypeOfHighClouds3'=> $TypeOfHighClouds3, 'OktasOfHighClouds3'=> $OktasOfHighClouds3,
            'HeightOfHighClouds3'=>$HeightOfHighClouds3, 'CLCODEOfHighClouds3'=> $CLCODEOfHighClouds3,




            'CloudSearchLightReading'=> $CloudSearchLightReading,
            'Rainfall'=> $Rainfall, 'Dry_Bulb'=>$Dry_Bulb,
            'Wet_bulb'=> $Wet_Bulb,

            'Max_Read'=> $Max_Read, 'Max_Reset'=>$Max_Reset,
            'Min_Read'=>$Min_Read,'Min_Reset'=>$Min_Reset,

            'Piche_Read'=> $Piche_Read, 'Piche_Reset'=>$Piche_Reset,


            'TimeMarksThermo'=>$TimeMarksThermo,
            'TimeMarksHygro'=>$TimeMarksHygro,
            'TimeMarksRainRec'=>$TimeMarksRainRec,

            'Present_Weather'=>$Present_Weather,
            'Visibility'=>$Visibility,


            'Wind_Direction'=>$Wind_Direction,
            'Wind_Speed'=>$Wind_Speed,
            'Gusting'=>$Gusting,
            'AttdThermo'=>$AttdThermo,
            'PrAsRead'=>$PrAsRead,
            'Correction'=>$Correction,
            'CLP'=>$CLP,
            'MSLPr'=>$MSLPr,
            'TimeMarksBarograph'=>$TimeMarksBarograph,
            'TimeMarksAnemograph'=>$TimeMarksAnemoograph,
            'OtherTMarks'=>$OtherTMarks,
            'Remarks'=>$Remarks,


            'Approved'=>$approved,
             'SubmittedBy'=>$user);




        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipFormData,'archiveobservationslipformdata'); //Array for data to insert then  the Table Name


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

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Added New Archive Observation Slip Form info',
                'Details' => $name . ' added New Archive Observation Slip Form info into the system',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
            $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'New Archive Observation Slip info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue Archive Observation Slip Data uninserted! ');
            $this->index();

        }



    }

    public function UpdateArchiveObservationSlipFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];



        $date = $this->input->post('date');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
            $stationNumber = $this->input->post('stationNo');
            $stationId = $this->DbHandler->identifyStationById($station,$stationNumber);


        $timeobservationslip = $this->input->post('timeRecorded');
        $totalAmountOfAllClouds = $this->input->post('totalamountofallclouds');
        $totalAmountOfLowClouds = $this->input->post('totalamountoflowclouds');

        $TypeOfLowClouds1 = $this->input->post('TypeOfLowClouds1');
        $OktasOfLowClouds1= $this->input->post('OktasOfLowClouds1');
        $HeightOfLowClouds1 = $this->input->post('HeightOfLowClouds1');
        $CLCODEOfLowClouds1 = $this->input->post('CLCODEOfLowClouds1');

        $TypeOfLowClouds2 = $this->input->post('TypeOfLowClouds2');
        $OktasOfLowClouds2= $this->input->post('OktasOfLowClouds2');
        $HeightOfLowClouds2 = $this->input->post('HeightOfLowClouds2');
        $CLCODEOfLowClouds2 = $this->input->post('CLCODEOfLowClouds2');

        $TypeOfLowClouds3 = $this->input->post('TypeOfLowClouds3');
        $OktasOfLowClouds3= $this->input->post('OktasOfLowClouds3');
        $HeightOfLowClouds3 = $this->input->post('HeightOfLowClouds3');
        $CLCODEOfLowClouds3 = $this->input->post('CLCODEOfLowClouds3');

        $TypeOfMediumClouds1 = $this->input->post('TypeOfMediumClouds1');
        $OktasOfMediumClouds1= $this->input->post('OktasOfMediumClouds1');
        $HeightOfMediumClouds1 = $this->input->post('HeightOfMediumClouds1');
        $CLCODEOfMediumClouds1 = $this->input->post('CLCODEOfMediumClouds1');

        $TypeOfMediumClouds2 = $this->input->post('TypeOfMediumClouds2');
        $OktasOfMediumClouds2= $this->input->post('OktasOfMediumClouds2');
        $HeightOfMediumClouds2 = $this->input->post('HeightOfMediumClouds2');
        $CLCODEOfMediumClouds2 = $this->input->post('CLCODEOfMediumClouds2');

        $TypeOfMediumClouds3 = $this->input->post('TypeOfMediumClouds3');
        $OktasOfMediumClouds3= $this->input->post('OktasOfMediumClouds3');
        $HeightOfMediumClouds3 = $this->input->post('HeightOfMediumClouds3');
        $CLCODEOfMediumClouds3 = $this->input->post('CLCODEOfMediumClouds3');

        $TypeOfHighClouds1 = $this->input->post('TypeOfHighClouds1');
        $OktasOfHighClouds1= $this->input->post('OktasOfHighClouds1');
        $HeightOfHighClouds1 = $this->input->post('HeightOfHighClouds1');
        $CLCODEOfHighClouds1 = $this->input->post('CLCODEOfHighClouds1');

        $TypeOfHighClouds2 = $this->input->post('TypeOfHighClouds2');
        $OktasOfHighClouds2= $this->input->post('OktasOfHighClouds2');
        $HeightOfHighClouds2 = $this->input->post('HeightOfHighClouds2');
        $CLCODEOfHighClouds2 = $this->input->post('CLCODEOfHighClouds2');

        $TypeOfHighClouds3 = $this->input->post('TypeOfHighClouds3');
        $OktasOfHighClouds3= $this->input->post('OktasOfHighClouds3');
        $HeightOfHighClouds3 = $this->input->post('HeightOfHighClouds3');
        $CLCODEOfHighClouds3 = $this->input->post('CLCODEOfHighClouds3');



        $CloudSearchLightReading = $this->input->post('cloudsearchlight');
        $Rainfall= $this->input->post('rainfall');
        $Dry_Bulb= $this->input->post('drybulb');
        $Wet_Bulb = $this->input->post('wetbulb');

        $Max_Read = $this->input->post('maxRead');
        $Max_Reset = $this->input->post('maxReset');

        $Min_Read = $this->input->post('minRead');
        $Min_Reset = $this->input->post('minReset');

        $Piche_Read = $this->input->post('picheRead');
        $Piche_Reset = $this->input->post('picheReset');

        $TimeMarksThermo = $this->input->post('timemarksThermo');
        $TimeMarksHygro = $this->input->post('timemarksHygro');
        $TimeMarksRainRec = $this->input->post('timemarksRainRec');


        $Present_Weather = $this->input->post('presentweather');
        $Visibility = $this->input->post('visibility');

        $Wind_Direction = $this->input->post('winddirection');
        $Wind_Speed = $this->input->post('windspeed');
        $Gusting = $this->input->post('gusting');

        $AttdThermo = $this->input->post('attdThermo');
        $PrAsRead = $this->input->post('prAsRead');
        $Correction = $this->input->post('correction');
        $CLP = $this->input->post('CLP');
        $MSLPr = $this->input->post('MSLPR');
        $TimeMarksBarograph = $this->input->post('timeMarksBarograph');
        $TimeMarksAnemoograph = $this->input->post('timeMarksAnemograph');

        $OtherTMarks = $this->input->post('otherTMarks');
        $Remarks = $this->input->post('remarks');


        $approved=$this->input->post('approval');

        $id = $this->input->post('id');


        $updateArchiveObservationSlipFormData=array(
            'Date'=>$date,'station'=>$stationId,
            'TIME'=> $timeobservationslip,
            'TotalAmountOfAllClouds'=>$totalAmountOfAllClouds,
            'TotalAmountOfLowClouds'=> $totalAmountOfLowClouds,
            'TypeOfLowClouds1'=> $TypeOfLowClouds1, 'OktasOfLowClouds1'=> $OktasOfLowClouds1,
            'HeightOfLowClouds1'=>$HeightOfLowClouds1, 'CLCODEOfLowClouds1'=> $CLCODEOfLowClouds1,

            'TypeOfLowClouds2'=> $TypeOfLowClouds2, 'OktasOfLowClouds2'=> $OktasOfLowClouds2,
            'HeightOfLowClouds2'=>$HeightOfLowClouds2, 'CLCODEOfLowClouds2'=> $CLCODEOfLowClouds2,

            'TypeOfLowClouds3'=> $TypeOfLowClouds3, 'OktasOfLowClouds3'=> $OktasOfLowClouds3,
            'HeightOfLowClouds3'=>$HeightOfLowClouds3, 'CLCODEOfLowClouds3'=> $CLCODEOfLowClouds3,

            'TypeOfMediumClouds1'=> $TypeOfMediumClouds1, 'OktasOfMediumClouds1'=> $OktasOfMediumClouds1,
            'HeightOfMediumClouds1'=>$HeightOfMediumClouds1, 'CLCODEOfMediumClouds1'=> $CLCODEOfMediumClouds1,

            'TypeOfMediumClouds2'=> $TypeOfMediumClouds2, 'OktasOfMediumClouds2'=> $OktasOfMediumClouds2,
            'HeightOfMediumClouds2'=>$HeightOfMediumClouds2, 'CLCODEOfMediumClouds2'=> $CLCODEOfMediumClouds2,

            'TypeOfMediumClouds3'=> $TypeOfMediumClouds3, 'OktasOfMediumClouds3'=> $OktasOfMediumClouds3,
            'HeightOfMediumClouds3'=>$HeightOfMediumClouds3, 'CLCODEOfMediumClouds3'=> $CLCODEOfMediumClouds3,

            'TypeOfHighClouds1'=> $TypeOfHighClouds1, 'OktasOfHighClouds1'=> $OktasOfHighClouds1,
            'HeightOfHighClouds1'=>$HeightOfHighClouds1, 'CLCODEOfHighClouds1'=> $CLCODEOfHighClouds1,

            'TypeOfHighClouds2'=> $TypeOfHighClouds2, 'OktasOfHighClouds2'=> $OktasOfHighClouds2,
            'HeightOfHighClouds2'=>$HeightOfHighClouds2, 'CLCODEOfHighClouds2'=> $CLCODEOfHighClouds2,

            'TypeOfHighClouds3'=> $TypeOfHighClouds3, 'OktasOfHighClouds3'=> $OktasOfHighClouds3,
            'HeightOfHighClouds3'=>$HeightOfHighClouds3, 'CLCODEOfHighClouds3'=> $CLCODEOfHighClouds3,


            'CloudSearchLightReading'=> $CloudSearchLightReading,
            'Rainfall'=> $Rainfall, 'Dry_Bulb'=>$Dry_Bulb,
            'Wet_bulb'=> $Wet_Bulb,

            'Max_Read'=> $Max_Read, 'Max_Reset'=>$Max_Reset,
            'Min_Read'=>$Min_Read,'Min_Reset'=>$Min_Reset,

            'Piche_Read'=> $Piche_Read, 'Piche_Reset'=>$Piche_Reset,


            'TimeMarksThermo'=>$TimeMarksThermo,
            'TimeMarksHygro'=>$TimeMarksHygro,
            'TimeMarksRainRec'=>$TimeMarksRainRec,

            'Present_Weather'=>$Present_Weather,
            'Visibility'=>$Visibility,


            'Wind_Direction'=>$Wind_Direction,
            'Wind_Speed'=>$Wind_Speed,
            'Gusting'=>$Gusting,
            'AttdThermo'=>$AttdThermo,
            'PrAsRead'=>$PrAsRead,
            'Correction'=>$Correction,
            'CLP'=>$CLP,
            'MSLPr'=>$MSLPr,
            'TimeMarksBarograph'=>$TimeMarksBarograph,
            'TimeMarksAnemograph'=>$TimeMarksAnemoograph,
            'OtherTMarks'=>$OtherTMarks,
            'Remarks'=>$Remarks,


            'Approved'=>$approved
        );

        $updatesuccess=$this->DbHandler->updateData($updateArchiveObservationSlipFormData,"",'archiveobservationslipformdata',$id);




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

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Updated Archived Observation Slip info',
                'Details' => $name . ' updated Archived Observation Slip info into the system',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Observation Slip info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue! Observation Slip did not update');
            $this->index();

        }

    }

    public function deleteArchiveObservationSlipFormData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('archiveobservationslipformdata',$id);  //$rowsaffected > 0

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
                'UserRole' => $userrole,'Action' => 'Deleted Observation Slip info',
                'Details' => $name . ' deleted Observation Slip info into the system',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('Success', 'Observation Slip info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('Error', '"Sorry, we encountered an issue! Observation Slip info was not deleted ');
            $this->index();

        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveObservationSlipFormDataRecordExistsAlready($date,$time_OfObservationSlipForm,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $time_OfObservationSlipForm = ($time_OfObservationSlipForm == "") ? $this->input->post('time_OfObservationSlipForm') : $time_OfObservationSlipForm;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfObservationSlipFormRecordExistsAlready($date,$time_OfObservationSlipForm,$stationName,$stationNumber,'archiveobservationslipformdata');   // $value, $field, $table

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
