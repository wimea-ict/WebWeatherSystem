<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ObservationSlipReport extends CI_Controller {

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
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('observationSlipReport',$data);
    }
    public function reportIssues(){
      $date=$this->input->post('date');

      $time=$this->input->post('time');
      $stationName=$this->input->post('stationName');
      $stationNumber=$this->input->post('stationNumber');
      $stationId=$this->DbHandler->identifyStationById($stationName,$stationNumber);
      //fetch data of oc of  the station
     $htmlmessage = 'Hello Sir/madam, '.'<br></br><br></br>'.
           '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
           'that Issues have been identified on observationSlip report of  '.
           $date.', time '.$time.'  '.
           'form </p><br></br>'.
           '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
           'Thank You'.'<b></br><b></br>'.'WIMEA-ICT';

         $this->sendMail($htmlmessage,"mutesasirajovan@gmail.com");
         die($htmlmessage);
      $ocData= $this->DbHandler->selectByIdOC($stationId,"station","systemusers");

      foreach ($ocData as $row ) {

        $htmlmessage = 'Hello Sir/madam, '.''.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
             '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
             'that Issues have been identified on observationSlip report of  '.
             $date.', time '.$time.'  '.
             'form </p><br></br>'.
             '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
             'Thank You'.'<b></br><b></br>'.'WIMEA-ICT';

           $this->sendMail($htmlmessage,$row->UserEmail);
          // $tester.=" ".$row->UserEmail;
      }

      $this->session->set_flashdata('success', 'Issue report Email sent to OC!');
      $this->index();
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
    public function displayobservationslipreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];


        $ObservationslipTimeInZoo = $this->input->post('ObservationSlipTime');

        $date = $this->input->post('date');



        if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayObservationSlipReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'TimeInZoo'=>$ObservationslipTimeInZoo,'date'=>$date);

        //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
        $query = $this->DbHandler->selectObservationSlipReportForSpecificTimeOfADay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query) {
            $data['observationslipdataforspecifictimeofaday'] = $query;
        } else {
            $data['observationslipdataforspecifictimeofaday'] = array();
        }

        //load all stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }



        $this->load->view('observationSlipReport',$data);

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
