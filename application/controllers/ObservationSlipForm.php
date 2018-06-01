<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ObservationSlipForm extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('pagination');

    }
    public function index(){
      $session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];

$config = array();
$config["base_url"] = base_url()."index.php/ObservationSlipForm/index";
$total_row = $this->DbHandler->record_count('StationName',$userstation);
$config["total_rows"] = $total_row;
$config["per_page"] = 100;
$config['use_page_numbers'] = TRUE;
$config['num_links'] = 10;
$config['cur_tag_open'] = '&nbsp;<a class="current">';
$config['cur_tag_close'] = '</a>';
$config['next_link'] = 'Next';
$config['prev_link'] = 'Previous';

$this->pagination->initialize($config);

if($this->uri->segment(3)){
$page = ($this->uri->segment(3)) ;
}
else{
$page = 1;
}

$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links );


        if($userrole=="WeatherForecaster" || $userrole=="Observer" || $userrole=="ObserverDataEntrant" )
        $query = $this->DbHandler->selectAll2conditions($userstation,'StationName','observationslip',0,"Approved",$config["per_page"],$page,$total_row);
        else
        $query = $this->DbHandler->selectAll($userstation,'StationName','observationslip',$config["per_page"],$page,$total_row);

        //  var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
        } else {
            $data['observationslipformdata'] = array();
        }

        $this->load->view('observationSlipForm', $data);
    }
    public function showAwsdata(){
       // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];

        $config = array();
        $config["base_url"] = base_url() . "index.php/ObservationSlipForm/showAwsdata";
        $total_row = $this->DbHandler->record_count_aws('StationName',$userstation);
        $config["total_rows"] = $total_row;
        $config["per_page"] = 100;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        if($this->uri->segment(3)){
        $page = ($this->uri->segment(3)) ;
        }
        else{
        $page = 1;
        }

        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $query = $this->DbHandler->selectAll2conditions($userstation,'StationName','observationslip',"AWS","DeviceType",$config["per_page"],$page,$total_row);

        //  var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
        } else {
            $data['observationslipformdata'] = array();
        }

        $this->load->view('observationSlipForm', $data);
    }
    public function showWebmobiledata(){
       // $this->unsetflashdatainfo();
       $session_data = $this->session->userdata('logged_in');
       $userstation=$session_data['UserStation'];
       $userrole=$session_data['UserRole'];

       $config = array();
       $config["base_url"] = base_url() . "index.php/ObservationSlipForm/showWebmobiledata";
       $total_row =$this->DbHandler->record_count_webmobile('StationName',$userstation);
       $config["total_rows"] = $total_row;
       $config["per_page"] = 100;
       $config['use_page_numbers'] = TRUE;
       $config['num_links'] = 10;
       $config['cur_tag_open'] = '&nbsp;<a class="current">';
       $config['cur_tag_close'] = '</a>';
       $config['next_link'] = 'Next';
       $config['prev_link'] = 'Previous';

       $this->pagination->initialize($config);

       if($this->uri->segment(3)){
       $page = ($this->uri->segment(3)) ;
       }
       else{
       $page = 1;
       }

       $str_links = $this->pagination->create_links();
       $data["links"] = explode('&nbsp;',$str_links );


        if($userrole=="WeatherForecaster" || $userrole=="Observer" || $userrole=="ObserverDataEntrant" )
        $query = $this->DbHandler->selectAll3conditionsOneNegative($userstation,'StationName','observationslip',0,"Approved","AWS","DeviceType",$config["per_page"],$page,$total_row);
        else
        $query = $this->DbHandler->selectAll2conditionsOneNegative($userstation,'StationName','observationslip',"AWS","DeviceType",$config["per_page"],$page,$total_row);

        //  var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
        } else {
            $data['observationslipformdata'] = array();
        }

        $this->load->view('observationSlipForm', $data);
    }

//sends an email to Zonal officer if an edit on obersation/raw data made
  public function sendObservationEditEmail($station,$stationNo,$date,$time){
    //get detaile of user who made changes
   $session_data = $this->session->userdata('logged_in');
   $userrole=$session_data['UserRole'];
   $userstation=$session_data['UserStation'];
   $StationRegion=$session_data['StationRegion'];
   $name=$session_data['FirstName'].' '.$session_data['SurName'];

   $stationId0=$this->DbHandler->identifyStationById($station,$stationNo);

if($userrole=="WeatherForecaster") {
  //OC officer of the station Details
  $ocData= $this->DbHandler->selectByIdOC($stationId0,"station","systemusers");
 foreach ($ocData as $row)
  {

   $htmlmessage = 'Hello Sir/madam, '.''.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
        '<p>Your  kindly informed that a TREND has been added to observation/raw data record '.
        'of date '.$date.', time '.$time.', station '.$station.'('.$stationNo.')  by '.$userrole.
         ' '.$name.' of '.$userstation.' Sation </p><br></br><br></br>'.
        '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
        'Thank You'.'<br></br><b></br><b></br>'.'WIMEA-ICT';

      $this->sendMail($htmlmessage,$row->UserEmail);
  }
}
elseif ($userrole=="OC") {
  //getZonal officer of the station Details
  $zonalOfficerData= $this->DbHandler->selectByIdZonalOfficer($stationId0,"station","systemusers");
 foreach ($zonalOfficerData as $row)
  {

   $htmlmessage = 'Hello Sir/madam, '.''.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
        '<p>Your  kindly informed that an observation/raw data record '.
        'of date '.$date.', time '.$time.', '.$station.'('.$stationNo.') station has been changed by '.$userrole.
         ' '.$name.' of '.$userstation.' Sation </p><br></br><br></br>'.
        '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
        'Thank You'.'<br></br><b></br><b></br>'.'WIMEA-ICT';

      $this->sendMail($htmlmessage,$row->UserEmail);
  }
}



  }
  public function sendObservationSpeci_note_Email($station,$stationNo,$date,$time){
    //get detaile of user who made changes
   $session_data = $this->session->userdata('logged_in');
   $userrole=$session_data['UserRole'];
   $userstation=$session_data['UserStation'];
   $StationRegion=$session_data['StationRegion'];
   $name=$session_data['FirstName'].' '.$session_data['SurName'];


    //getZonal officer of the station Details
   $stationId0=$this->DbHandler->identifyStationById($station,$stationNo);
    $zonalOfficerData= $this->DbHandler->selectByIdZonalOfficer_andOC($stationId0,"station","systemusers");
   foreach ($zonalOfficerData as $row)
    {

     $htmlmessage = 'Hello Sir/madam, '.''.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
          '<p>Your  kindly informed that a speci(Special phenomenon) has been observed at date '.
          $date.', time '.$time.', '.$station.'('.$stationNo.') station and submitted to the observation/raw data '.
          'form </p><br></br>'.
          '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
          'Thank You'.'<br></br><b></br><b></br>'.'WIMEA-ICT';

        $this->sendMail($htmlmessage,$row->UserEmail);
    }

  }
  public function  sendMail($htmlmsgbody,$msgreceiver)
  {
      $this->unsetflashdatainfo();
      $this->load->library('email');

      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'ssl://smtp.gmail.com';
      $config['smtp_port'] = '465';
      $config['smtp_user'] = 'wimeaictwdr@gmail.com';  //change it
      $config['smtp_pass'] = '1wimeawdr2'; //change it
      $config['charset'] = 'utf-8';
      $config['newline'] = "\r\n";
      $config['mailtype'] = 'html';


      $config['wordwrap'] = TRUE;
      $this->email->initialize($config);

      $this->email->from('wimeaictwdr@gmail.com','WIMEA-ICT');   //change it
      $this->email->to($msgreceiver);       //change it
      $this->email->subject("WIMEA-ICT Web Interface Credentials");
      $this->email->message($htmlmsgbody);

      if($this->email->send()) {
          return true;
      } else {
          return false;
      }


  }
    public function DisplayNewObservationSlipForm(){
        $this->unsetflashdatainfo();
        $name='displaynewobservationslipform';
        $data['displaynewobservationslipform'] = array('name' => $name);

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

        $this->load->view('observationSlipForm', $data);

    }
    public function DisplayObservationSlipFormForUpdate(){
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

        $observationslipformid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($observationslipformid,'id','observationslip');  //$value, $field,$table
        if ($query) {
            $data['observationslipidupdate'] = $query;
        } else {
            $data['observationslipidupdate'] = array();
        }


        $this->load->view('observationSlipForm', $data);
    }

    public function insertObervationSlipFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];

        $date = $this->input->post('date_observationslipform');
        $station = firstcharuppercase(chgtolowercase($this->input->post('station_observationslipform')));
        $stationNumber = $this->input->post('stationNo_observationslipform');
        $totalAmountOfAllClouds =intval( $this->input->post('totalamountofallclouds_observationslipform'));
        $totalAmountOfLowClouds =intval( $this->input->post('totalamountoflowclouds_observationslipform'));
        $TypeOfLowClouds1 = intval($this->input->post('TypeOfLowClouds1_observationslipform'));
        $OktasOfLowClouds1= intval($this->input->post('OktasOfLowClouds1_observationslipform'));
        $HeightOfLowClouds1 = intval($this->input->post('HeightOfLowClouds1_observationslipform'));
        $CLCODEOfLowClouds1 = $this->input->post('CLCODEOfLowClouds1_observationslipform');
        $TypeOfLowClouds2 = intval($this->input->post('TypeOfLowClouds2_observationslipform'));
        $OktasOfLowClouds2= intval($this->input->post('OktasOfLowClouds2_observationslipform'));
        $HeightOfLowClouds2 = intval($this->input->post('HeightOfLowClouds2_observationslipform'));
        $CLCODEOfLowClouds2 = $this->input->post('CLCODEOfLowClouds2_observationslipform');
        $TypeOfLowClouds3 = intval($this->input->post('TypeOfLowClouds3_observationslipform'));
        $OktasOfLowClouds3= intval($this->input->post('OktasOfLowClouds3_observationslipform'));
        $HeightOfLowClouds3 = intval($this->input->post('HeightOfLowClouds3_observationslipform'));
        $CLCODEOfLowClouds3 = $this->input->post('CLCODEOfLowClouds3_observationslipform');
        $TypeOfMediumClouds1 = intval($this->input->post('TypeOfMediumClouds1_observationslipform'));
        $OktasOfMediumClouds1= intval($this->input->post('OktasOfMediumClouds1_observationslipform'));
        $HeightOfMediumClouds1 = intval($this->input->post('HeightOfMediumClouds1_observationslipform'));
        $CLCODEOfMediumClouds1 = $this->input->post('CLCODEOfMediumClouds1_observationslipform');
        $TypeOfMediumClouds2 = intval($this->input->post('TypeOfMediumClouds2_observationslipform'));
        $OktasOfMediumClouds2= intval($this->input->post('OktasOfMediumClouds2_observationslipform'));
        $HeightOfMediumClouds2 = intval($this->input->post('HeightOfMediumClouds2_observationslipform'));
        $CLCODEOfMediumClouds2 = $this->input->post('CLCODEOfMediumClouds2_observationslipform');
        $TypeOfMediumClouds3 = intval($this->input->post('TypeOfMediumClouds3_observationslipform'));
        $OktasOfMediumClouds3= intval($this->input->post('OktasOfMediumClouds3_observationslipform'));
        $HeightOfMediumClouds3 = intval($this->input->post('HeightOfMediumClouds3_observationslipform'));
        $CLCODEOfMediumClouds3 = $this->input->post('CLCODEOfMediumClouds3_observationslipform');
        $TypeOfHighClouds1 = intval($this->input->post('TypeOfHighClouds1_observationslipform'));
        $OktasOfHighClouds1= intval($this->input->post('OktasOfHighClouds1_observationslipform'));
        $HeightOfHighClouds1 = intval($this->input->post('HeightOfHighClouds1_observationslipform'));
        $CLCODEOfHighClouds1 = $this->input->post('CLCODEOfHighClouds1_observationslipform');
        $TypeOfHighClouds2 = intval( $this->input->post('TypeOfHighClouds2_observationslipform'));
        $OktasOfHighClouds2= intval($this->input->post('OktasOfHighClouds2_observationslipform'));
        $HeightOfHighClouds2 = intval($this->input->post('HeightOfHighClouds2_observationslipform'));
        $CLCODEOfHighClouds2 = $this->input->post('CLCODEOfHighClouds2_observationslipform');
        $TypeOfHighClouds3 = intval($this->input->post('TypeOfHighClouds3_observationslipform'));
        $OktasOfHighClouds3= intval($this->input->post('OktasOfHighClouds3_observationslipform'));
        $HeightOfHighClouds3 = intval($this->input->post('HeightOfHighClouds3_observationslipform'));
        $CLCODEOfHighClouds3 = $this->input->post('CLCODEOfHighClouds3_observationslipform');
        $CloudSearchLightReading = intval($this->input->post('cloudsearchlight_observationslipform'));
        $Rainfall= $this->input->post('rainfall_observationslipform');
        $Dry_Bulb= $this->input->post('drybulb_observationslipform');
        $Wet_Bulb = $this->input->post('wetbulb_observationslipform');
        $Max_Read = $this->input->post('maxRead_observationslipform');
        $Max_Reset = $this->input->post('maxReset_observationslipform');
        $Min_Read = $this->input->post('minRead_observationslipform');
        $Min_Reset = $this->input->post('minReset_observationslipform');
        $Piche_Read = $this->input->post('picheRead_observationslipform');
        $Piche_Reset = $this->input->post('picheReset_observationslipform');
        $TimeMarksThermo = $this->input->post('timemarksThermo_observationslipform');
        $TimeMarksHygro = $this->input->post('timemarksHygro_observationslipform');
        $TimeMarksRainRec = $this->input->post('timemarksRainRec_observationslipform');
        $Present_Weather = $this->input->post('presentweather_observationslipform');
        $Present_WeatherCode = $this->input->post('presentweatherCode_observationslipform');
        $Past_Weather = $this->input->post('pastweather_observationslipform');
        $Visibility = floatval($this->input->post('visibility_observationslipform'));
        $Wind_Direction = $this->input->post('winddirection_observationslipform');
        $Wind_Speed = $this->input->post('windspeed_observationslipform');
        $Gusting = floatval($this->input->post('gusting_observationslipform'));
        $AttdThermo = floatval($this->input->post('attdThermo_observationslipform'));
        $PrAsRead = floatval($this->input->post('prAsRead_observationslipform'));
        $Correction = floatval($this->input->post('correction_observationslipform'));
        $CLP = $this->input->post('CLP_observationslipform');
        $MSLPr = floatval($this->input->post('MSLPR_observationslipform'));
        $TimeMarksBarograph = floatval($this->input->post('timeMarksBarograph_observationslipform'));
        $TimeMarksAnemoograph = floatval($this->input->post('timeMarksAnemograph_observationslipform'));
        $OtherTMarks = $this->input->post('otherTMarks_observationslipform');
        $Remarks = $this->input->post('remarks_observationslipform');
        $WindRun=$this->input->post('windRun_observationslipform');
        $DurationOfSunshine=$this->input->post('durationOfSunshine_observationslipform');

$UnitOfWindSpeed_mff =$this->input->post("UnitOfWindSpeed_mff");
$IndOrOmissionOfPrecipitation_mff =$this->input->post("IndOrOmissionOfPrecipitation_mff");
$TypeOfStation_Present_Past_Weather_mff =$this->input->post("TypeOfStation_Present_Past_Weather_mff");
$heightOfLowestCloud_mff =$this->input->post("heightOfLowestCloud_mff");
$StandardIsobaricSurface_mff=$this->input->post("StandardIsobaricSurface_mff");
$gpm_mff =$this->input->post("gpm_mff");
$dopop_mff =$this->input->post("dopop_mff");
$gmt_mff =$this->input->post("gmt_mff");
$CI_OfPrecipitation_mff=$this->input->post("CI_OfPrecipitation_mff");
$CI_OfPrecipitation_mff =$this->input->post("CI_OfPrecipitation_mff");
$BE_OfPrecipitation_mff =$this->input->post("BE_OfPrecipitation_mff");
$IndicatorOfTypeOfIntrumentation_mff =$this->input->post("IndicatorOfTypeOfIntrumentation_mff");
$SignOfPressureChange_mff =$this->input->post("SignOfPressureChange_mff");
$supplementaryinformation_mff=$this->input->post("supplementaryinformation_mff");
$VapourPressure_mff =$this->input->post("VapourPressure_mff");
$thgraph_mff =$this->input->post("thgraph_mff");
$Trend_mff =$this->input->post("Trend_mff");
$approved=0;
        $user=$firstname.' '.$surname;
        $InputType="Web";
$metarOrSpeci=$this->input->post('metar_speci');
$timeobservationslip= $metarOrSpeci=="speci"? $this->input->post('speci_time_observationslipform'):$this->input->post('metar_time_observationslipform');
$station_id= $this->DbHandler->identifyStationById($station,$stationNumber);



$Dry_Bulb=floatval( $this->input->post('drybulb_observationslipform'));
$Wet_Bulb = floatval($this->input->post('wetbulb_observationslipform'));
$Max_Read = floatval($this->input->post('maxRead_observationslipform'));
$Max_Reset = floatval($this->input->post('maxReset_observationslipform'));
$Min_Read = floatval($this->input->post('minRead_observationslipform'));
$Min_Reset = floatval($this->input->post('minReset_observationslipform'));
$Piche_Read = floatval($this->input->post('picheRead_observationslipform'));
$Piche_Reset = floatval($this->input->post('picheReset_observationslipform'));
$TimeMarksThermo = floatval($this->input->post('timemarksThermo_observationslipform'));
$TimeMarksHygro =floatval( $this->input->post('timemarksHygro_observationslipform'));
$TimeMarksRainRec =floatval( $this->input->post('timemarksRainRec_observationslipform'));


        $insertObservationSlipFormData=array(
            'Date'=>$date,'station'=>$station_id,
            'TIME'=> $timeobservationslip,'DeviceType '=> $InputType,
            'TotalAmountOfAllClouds'=>$totalAmountOfAllClouds,  'TotalAmountOfLowClouds'=> $totalAmountOfLowClouds,
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
            'Rainfall'=> $Rainfall, 'Dry_Bulb'=>$Dry_Bulb,'Wet_bulb'=> $Wet_Bulb,
            'Max_Read'=> $Max_Read, 'Max_Reset'=>$Max_Reset,
            'Min_Read'=>$Min_Read,'Min_Reset'=>$Min_Reset,
            'Piche_Read'=> $Piche_Read, 'Piche_Reset'=>$Piche_Reset,

            'TimeMarksThermo'=>$TimeMarksThermo,            'TimeMarksHygro'=>$TimeMarksHygro,
            'TimeMarksRainRec'=>$TimeMarksRainRec,
            'Present_Weather'=>$Present_Weather,'Present_WeatherCode'=>$Present_WeatherCode,
            'Past_Weather'=>$Past_Weather,'Visibility'=>$Visibility,


            'Wind_Direction'=>$Wind_Direction,            'Wind_Speed'=>$Wind_Speed,
            'Gusting'=>$Gusting,            'AttdThermo'=>$AttdThermo,
            'PrAsRead'=>$PrAsRead,            'Correction'=>$Correction,
            'CLP'=>$CLP,            'MSLPr'=>$MSLPr,
            'TimeMarksBarograph'=>$TimeMarksBarograph,     'TimeMarksAnemograph'=>$TimeMarksAnemoograph,
            'OtherTMarks'=>$OtherTMarks,
            'Remarks'=>$Remarks,    'windrun'=> $WindRun,
            'sunduration'=> $DurationOfSunshine,'Approved'=>$approved,

            'trend'=>$Trend_mff,'speciOrMetar'=>$metarOrSpeci,
            'UnitOfWindSpeed'=>$UnitOfWindSpeed_mff, 	'IndOrOmissionOfPrecipitation'=>$IndOrOmissionOfPrecipitation_mff,
            'TypeOfStation_Present_Past_Weather'=>$TypeOfStation_Present_Past_Weather_mff, 	'HeightOfLowestCloud'=>$heightOfLowestCloud_mff,
            'StandardIsobaricSurface'=>$StandardIsobaricSurface_mff,  	'GPM'=>$gpm_mff,
            'DurationOfPeriodOfPrecipitation'=>$dopop_mff, 	'GrassMinTemp'=>$gmt_mff,
            'CI_OfPrecipitation'=>$CI_OfPrecipitation_mff, 'BE_OfPrecipitation'=>$BE_OfPrecipitation_mff,
            'IndicatorOfTypeOfIntrumentation'=>$IndicatorOfTypeOfIntrumentation_mff, 	'SignOfPressureChange'=>$SignOfPressureChange_mff,
            'Supp_Info'=>$supplementaryinformation_mff, 'VapourPressure'=>$VapourPressure_mff,
            'T_H_Graph'=>$thgraph_mff ,'SubmittedBy'=>$user);




        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipFormData,'observationslip'); //Array for data to insert then  the Table Name


        //Redirect the user back with  message
        if($insertsuccess){
          if($metarOrSpeci=="speci")
          $this->sendObservationSpeci_note_Email($station,$stationNumber,$date,$timeobservationslip);
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $stationId= $session_data['StationId'];
            $StationRegion=$session_data['StationRegion'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Added Observation Slip info',
                'Details' => $name . ' added Observation Slip info into the system',
                'station' => $stationId,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'New Observation Slip info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue Observation Slip Data uninserted! ');
            $this->index();

        }



    }

    public function UpdateObservationSlipFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $date = $this->input->post('date');
        $metarOrSpeci=$this->input->post('metar_speci');
        $timeobservationslip= $metarOrSpeci=="speci"? $this->input->post('speci_time_observationslipform'):$this->input->post('metar_time_observationslipform');

        $stationName = firstcharuppercase(chgtolowercase($this->input->post('station')));
        $stationNumber = $this->input->post('stationNo');
        $station = $this->DbHandler->identifyStationById($stationName,$stationNumber);



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
        $Max_Read = floatval($this->input->post('maxRead'));
        $Max_Reset = floatval($this->input->post('maxReset'));
        $Min_Read = floatval($this->input->post('minRead'));
        $Min_Reset = floatval($this->input->post('minReset'));
        $Piche_Read = floatval($this->input->post('picheRead'));
        $Piche_Reset = floatval($this->input->post('picheReset'));
        $TimeMarksThermo =floatval( $this->input->post('timemarksThermo'));
        $TimeMarksHygro = floatval($this->input->post('timemarksHygro'));
        $TimeMarksRainRec = floatval($this->input->post('timemarksRainRec'));
        $Present_Weather = $this->input->post('presentweather');
        $Present_WeatherCode = $this->input->post('presentweatherCode');
        $Past_Weather = $this->input->post('pastweather');
        $Visibility = floatval($this->input->post('visibility'));

        $Wind_Direction = $this->input->post('winddirection');
        $Wind_Speed = $this->input->post('windspeed');
        $Gusting = floatval($this->input->post('gusting'));

        $AttdThermo = floatval($this->input->post('attdThermo'));
        $PrAsRead = floatval($this->input->post('prAsRead'));
        $Correction = floatval($this->input->post('correction'));
        $CLP = $this->input->post('CLP');
        $MSLPr = floatval($this->input->post('MSLPR'));
        $TimeMarksBarograph = floatval($this->input->post('timeMarksBarograph'));
        $TimeMarksAnemoograph = floatval($this->input->post('timeMarksAnemograph'));

        $OtherTMarks = $this->input->post('otherTMarks');
        $Remarks = $this->input->post('remarks');
        $WindRun=$this->input->post('windRun');
        $DurationOfSunshine=$this->input->post('DurationOfSunshine');
       // $TREND=$this->input->post('Trend');
       $UnitOfWindSpeed_mff =$this->input->post("UnitOfWindSpeed_mff");
       $IndOrOmissionOfPrecipitation_mff =$this->input->post("IndOrOmissionOfPrecipitation_mff");
       $TypeOfStation_Present_Past_Weather_mff =$this->input->post("TypeOfStation_Present_Past_Weather_mff");
       $heightOfLowestCloud_mff =$this->input->post("heightOfLowestCloud_mff");
       $StandardIsobaricSurface_mff=$this->input->post("StandardIsobaricSurface_mff");
       $gpm_mff =$this->input->post("gpm_mff");
       $dopop_mff =$this->input->post("dopop_mff");
       $gmt_mff =$this->input->post("gmt_mff");
       $CI_OfPrecipitation_mff=$this->input->post("CI_OfPrecipitation_mff");
       $CI_OfPrecipitation_mff =$this->input->post("CI_OfPrecipitation_mff");
       $BE_OfPrecipitation_mff =$this->input->post("BE_OfPrecipitation_mff");
       $IndicatorOfTypeOfIntrumentation_mff =$this->input->post("IndicatorOfTypeOfIntrumentation_mff");
       $SignOfPressureChange_mff =$this->input->post("SignOfPressureChange_mff");
       $supplementaryinformation_mff=$this->input->post("supplementaryinformation_mff");
       $VapourPressure_mff =$this->input->post("VapourPressure_mff");
       $thgraph_mff =$this->input->post("thgraph_mff");
       $Trend_mff =$this->input->post("Trend_mff");
        $approved=$this->input->post('approval');

        $id = $this->input->post('id');


        $updateObservationSlipFormData=array(
            'Date'=>$date,'station'=>$station,
            'TIME'=> $timeobservationslip,
            'TotalAmountOfAllClouds'=>$totalAmountOfAllClouds,'TotalAmountOfLowClouds'=> $totalAmountOfLowClouds,
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
            'Wet_bulb'=> $Wet_Bulb,    'Max_Read'=> $Max_Read, 'Max_Reset'=>$Max_Reset,
            'Min_Read'=>$Min_Read,'Min_Reset'=>$Min_Reset,
            'Piche_Read'=> $Piche_Read, 'Piche_Reset'=>$Piche_Reset,
            'TimeMarksThermo'=>$TimeMarksThermo,
            'TimeMarksHygro'=>$TimeMarksHygro,  'TimeMarksRainRec'=>$TimeMarksRainRec,
            'Present_Weather'=>$Present_Weather,'Present_WeatherCode'=>$Present_WeatherCode,'Past_Weather'=>$Past_Weather,
            'Visibility'=>$Visibility,            'Wind_Direction'=>$Wind_Direction,
            'Wind_Speed'=>$Wind_Speed,            'Gusting'=>$Gusting,
            'AttdThermo'=>$AttdThermo,            'PrAsRead'=>$PrAsRead,
            'Correction'=>$Correction,            'CLP'=>$CLP,
            'MSLPr'=>$MSLPr,            'TimeMarksBarograph'=>$TimeMarksBarograph,
            'TimeMarksAnemograph'=>$TimeMarksAnemoograph,    'OtherTMarks'=>$OtherTMarks,
            'Remarks'=>$Remarks,        'windrun'=> $WindRun,
            'sunduration'=> $DurationOfSunshine, 'speciOrMetar'=>$speciOrmetar,
            'trend'=>$Trend_mff,
            'UnitOfWindSpeed'=>$UnitOfWindSpeed_mff, 	'IndOrOmissionOfPrecipitation'=>$IndOrOmissionOfPrecipitation_mff,
            'TypeOfStation_Present_Past_Weather'=>$TypeOfStation_Present_Past_Weather_mff,
            'HeightOfLowestCloud'=>$heightOfLowestCloud_mff,
            'StandardIsobaricSurface'=>$StandardIsobaricSurface_mff,'GPM'=>$gpm_mff,
            'DurationOfPeriodOfPrecipitation'=>$dopop_mff, 	'GrassMinTemp'=>$gmt_mff,
            'CI_OfPrecipitation'=>$CI_OfPrecipitation_mff, 'BE_OfPrecipitation'=>$BE_OfPrecipitation_mff,
            'IndicatorOfTypeOfIntrumentation'=>$IndicatorOfTypeOfIntrumentation_mff,
            'SignOfPressureChange'=>$SignOfPressureChange_mff,
            'Supp_Info'=>$supplementaryinformation_mff, 'VapourPressure'=>$VapourPressure_mff,
            'T_H_Graph'=>$thgraph_mff,  'Approved'=>$approved);
foreach ($updateObservationSlipFormData as $key => $value) {
  # code...
  if($value=='')
  $updateObservationSlipFormData[$key]=NULL;
}

        $updatesuccess=$this->DbHandler->updateData($updateObservationSlipFormData,"",'observationslip',$id);

     //Redirect the user back with  message
        if($updatesuccess){
          //alert zonal officer by email
           $this->sendObservationEditEmail($stationName,$stationNumber,$date,$timeobservationslip);
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationId=$session_data['StationId'];
            $StationRegion=$session_data['StationRegion'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Updated Observation Slip info',
                'Details' => $name . ' updated Observation Slip info into the system',
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
    public function deleteObservationSlipFormData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('obervationslip',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted Observation Slip info',
                'Details' => $name . ' deleted Observation Slip info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
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
    function checkInDBIfObservationSlipFormRecordExistsAlready($date,$time_OfObservationSlipForm,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
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


            $get_result = $this->DbHandler->checkInDBIfObservationSlipFormRecordExistsAlready($date,$time_OfObservationSlipForm,$stationName,$stationNumber,'observationslip');   // $value, $field, $table

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
