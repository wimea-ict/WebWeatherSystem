<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayCustomRainfallReport extends CI_Controller {

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
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        //View the dekadal form.
        $this->load->view('CustomRainfallReport',$data);

    }
    public function displaycustomrainfallreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $dateTo = $this->input->post('to');
		$dateFrom = $this->input->post('from');
        //$month = $this->input->post('month');
		 $stationName =  $this->input->post('stationManager');
         $stationNumber =  $this->input->post('stationNoManager');
		  
      
		 $data['noRainfallData'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'to'=>$dateTo,'from'=>$dateFrom);
			
        $query = $this->DbHandler->selectCustomisedRainfall($stationName, $stationNumber, $dateFrom, $dateTo);  //value,field,table
        //  var_dump($query);
		//exit("am here".$stationNumber);
        if ($query) {
			
            $data['rainfalldata'] = $query;
        } else {
            $data['rainfalldata'] = array();
			//exit("am not");
        }
		 $userstation=$session_data['UserStation'];

        //Get all Stations.
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }





        $this->load->view('CustomRainfallReport',$data);

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
