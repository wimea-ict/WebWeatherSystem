<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedObservationSlipFormDataCopy extends CI_Controller {

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


        $query = $this->DbHandler->selectAllscanDaily($userstation,'StationName','scans_daily',"observationslip");  //value,field,table

        if ($query) {
            $data['archivedscannedobservationslipformcopydetails'] = $query;
        } else {
            $data['archivedscannedobservationslipformcopydetails'] = array();
        }


        //Load the view.
        $this->load->view('archiveScannedObservationSlipFormDataCopy', $data);
    }

    public function DisplayFormToArchiveScannedObservationSlipFormDetails(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedObservationSlipFormDetails';
        $data['displaynewFormToArchiveScannedObservationSlipFormDetails'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        /////////////////////////////////////////////////////////



        $this->load->view('archiveScannedObservationSlipFormDataCopy', $data);

    }
    public function DisplayFormToArchiveScannedObservationSlipFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }




        $scannedobservationslipformid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedobservationslipformid,'id','scans_daily');  //$value, $field,$table
        if ($query) {
            $data['scannedobservationslipformcopyidDetails'] = $query;
        } else {
            $data['scannedobservationslipformcopyidDetails'] = array();
        }


        $this->load->view('archiveScannedObservationSlipFormDataCopy', $data);
    }


    public function insertInformationForArchiveScannedObservationSlipFormDetails(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_observationslipform';   //name of the input text field


        $config['upload_path'] = 'archive/';    //path on the server to store the file
        // $config['upload_path'] = '/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx';
        $config['encrypt_name'] = FALSE;
        // $config['max_size'] = '2GB';
        //IMB=1024KB  2MB=2048KB   1GB=1024MB   2GB=2048MB
        //1MB=1024KB  THEN 2048MB=2097152KB
        $config['max_size'] = '2097152';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
        $config['max_height'] = '768';
        $config['max_width'] = '1024';
        $config['remove_spaces'] = TRUE;
        $config['file_name'] ='scannedObservationSlip' .'-'.date("Y-m-d").'-'.$_FILES['userfile']['name'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            echo   $msg = $this->upload->display_errors('', '');
        }
        else //($this->upload->do_upload($file_element_name))
        {
            $data = $this->upload->data();
            $filename = $data['file_name'];






                $formname = firstcharuppercase(chgtolowercase($this->input->post('formname_observationslipform')));




                    $station = $this->input->post('station_ArchiveScannedObservationSlipForm');
                    $stationNumber = $this->input->post('stationNo_ArchiveScannedObservationSlipForm');
                    $station_id= $this->DbHandler->identifyStationById($station,$stationNumber);



                $dateOnScannedObservationSlipForm = $this->input->post('dateOnScannedObservationSlipForm_observationslipform');


                $description = $this->input->post('description_observationslipform');
                $time=$this->input->post('time_ArchiveScannedObservationSlipForm');


               // $creationDate= date('Y-m-d H:i:s');
                $Approved="FALSE";
                $firstname=$session_data['FirstName'];
                $surname=$session_data['SurName'];
                $SubmittedBy=$firstname.' '.$surname;
                 $stationId=$this->DbHandler->identifyStationById($station, $stationNumber);//station name and station number

                $insertScannedObservationSlipFormDataCopyDetails=array(
                    'Form_scanned' => $formname, 'station' => $stationId,
                     'TIME'=>$time,

                    'form_date' => $dateOnScannedObservationSlipForm,'Approved'=> $Approved,'SD_SubmittedBy'=>$SubmittedBy,
                    'Description'=>$description,'FileRef' => $filename);

                //$this->DbHandler->insertInstrument($insertInstrumentData);
                $insertsuccess= $this->DbHandler->insertData($insertScannedObservationSlipFormDataCopyDetails,'scans_daily'); //Array for data to insert then  the Table Name

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
                       'Action' => 'Added new Scanned Observation Slip Form details',
                        'Details' => $name . ' added new Scanned Observation Slip Form details into the system ',
                        
                        'IP' => $this->input->ip_address());
                    //  save user logs
                     $this->DbHandler->saveUserLogs($userlogs);


                    $this->session->set_flashdata('success', 'New Scanned Observation Form details info was added successfully!');
                    $this->index();

                }
                else{
                    $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                    $this->index();

                }

            }
        }




    public function updateInformationForArchiveScannedObservationSlipFormDetails(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'updatearchievescannedcopy_observationslipform';  //name of the file upload name


        if (isset($_FILES[$file_element_name]) && is_uploaded_file($_FILES[$file_element_name]['tmp_name'])) { //file has been uploaded
            //load upload class with the config, etc...
            //$this->load->library('upload', $config);
            $config['upload_path'] = 'archive/';
            // $config['upload_path'] = '/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx';
            $config['encrypt_name'] = FALSE;
            // $config['max_size'] = '2GB';
            //IMB=1024KB  2MB=2048KB   1GB=1024MB   2GB=2048MB
            //1MB=1024KB  THEN 2048MB=2097152KB
            $config['max_size'] = '2097152';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
            $config['max_height'] = '768';
            $config['max_width'] = '1024';
            $config['remove_spaces'] = TRUE;
            $config['file_name'] ='Updated_ObservationSlip' .'-'.date("Y-m-d").'-'.$_FILES['userfile']['name'];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                echo   $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();

                $filename = $data['file_name'];
            }
        } else {    //no file has been uploaded.

            $filename= $this->input->post('PreviouslyUploadedFileName_observationSlipForm');
        }
         // no file uploaded..






      // }

                $formname = firstcharuppercase(chgtolowercase($this->input->post('formname')));

                    $stationId = $this->input->post('stationId');
                    $stationNo = $this->input->post('stationNo');
                    $time=$this->input->post('timeRecorded');

            $dateOnScannedObservationSlipForm = $this->input->post('dateOnScannedObservationSlipForm');


            $description = $this->input->post('description');

            $id = $this->input->post('id');

        $approved=$this->input->post('approval');



                $updateScannedObservationFormDataDetails=array(
                    'station' => $stationId,'TIME'=>$time,'Approved'=>$approved,
                    'form_date' => $dateOnScannedObservationSlipForm,
                    'Description'=>$description,'FileRef' => $filename);

                //$this->DbHandler->insertInstrument($insertInstrumentData);
                $updatesuccess=$this->DbHandler->updateData($updateScannedObservationFormDataDetails,'','scans_daily',$id);

                //Redirect the user back with  message
                if($updatesuccess){
                    //Store User logs.
                    //Create user Logs
                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];
                    $userstation=$session_data['UserStation'];
                    $userstationId=$session_data['StationId'];
                    $name=$session_data['FirstName'].' '.$session_data['SurName'];

                   $userid =$session_data['Userid'];
                    $userlogs = array('Userid' => $userid,
                        'Action' => 'Updated new Scanned Observation Slip Form details',
                        'Details' => $name . ' updated new Scanned Observation Slip Form details into the system ',
                     
                        'IP' => $this->input->ip_address());
                    //  save user logs
                    $this->DbHandler->saveUserLogs($userlogs);


                    $this->session->set_flashdata('success', 'Updated Scanned Observation Slip Form details info was updated successfully!');
                    $this->index();

                }
                else{
                    $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                    $this->index();

                }

            }
      //  }
          public 	function update_approval() {
		$session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];
	  $user_id=$session_data['Userid'];
		$id= $this->input->post('id');
		$data = array(
		'Approved' => $this->input->post('approve')
		
		);
		$query=$this->DbHandler->updateApproval1($id,$data,"scans_daily");
		if ($query) {
		$this->session->set_flashdata('success', 'Data was updated successfully!');
		$this->index();
		}else{
		$this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
		$this->index();	
		}
		}
    public function deleteInformationForArchiveScannedObservationSlipFormDetails() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('scans_daily',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted Observation Slip Form details',
                'Details' => $name . ' deleted Observation Slip Form details into the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Synoptic info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    function getInstruments($stationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
//check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {


            //$get_result = $this->DbHandler->getResults($stationName, 'StationName', 'instruments');   // $value, $field, $table
            $data['results'] = $this->DbHandler->getResults($stationName, 'StationName', 'instruments');
            if($data['results']){   // we got a result, output json
                echo json_encode( $data['results'] );
            } else {
                echo json_encode( array('error' => true) );
            }



        }


    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready($date,$time,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $time = ($time == "") ? $this->input->post('time') : $time;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready($date,$time,$stationName,$stationNumber,'scans_daily');   // $value, $field, $table

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
