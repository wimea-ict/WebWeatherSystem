<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedDekadalFormDataReportCopy extends CI_Controller {

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


        $query = $this->DbHandler->selectAll($userstation,'StationName','scans_dekadals');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['archivedscanneddekadalformreportdetails'] = $query;
        } else {
            $data['archivedscanneddekadalformreportdetails'] = array();
        }


        //Load the view.
        $this->load->view('archiveScannedDekadalFormDataReportCopy', $data);
    }

    public function DisplayFormToArchiveScannedDekadalFormReport(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedDekadalFormReport';
        $data['displaynewFormToArchiveScannedDekadalFormReport'] = array('name' => $name);

        //Get all Stations.
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

        /////////////////////////////////////////////////////////



        $this->load->view('archiveScannedDekadalFormDataReportCopy', $data);

    }
    public function DisplayFormToArchiveScannedDekadalFormReportForUpdate(){
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




        $scanneddekadalformreportid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scanneddekadalformreportid,'id','scans_dekadals');  //$value, $field,$table
        if ($query) {
            $data['scanneddekadalformreportidDetails'] = $query;
        } else {
            $data['scanneddekadalformreportidDetails'] = array();
        }


        $this->load->view('archiveScannedDekadalFormDataReportCopy', $data);
    }


    public function insertInformationForArchiveScannedDekadalFormReport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_dekadalformdatareport';


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
        $config['file_name'] ='scanDekadal' .'-'.date("Y-m-d").'-'.$_FILES['userfile']['name'];



        $config['remove_spaces'] = TRUE;

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

           // $filename = md5(uniqid(mt_rand())).$this->$filename;




            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname_dekadal')));



                $station = $this->input->post('station_ArchiveScannedDekadalFormReport');
                $stationNumber = $this->input->post('stationNo_ArchiveScannedDekadalFormReport');
                $station_id= $this->DbHandler->identifyStationById($station,$stationNumber);


            $FromdateOnScannedDekadalFormReport = $this->input->post('FromdateOnScannedDekadalFormReport_dekadal');
            $TodateOnScannedDekadalFormReport = $this->input->post('TodateOnScannedDekadalFormReport_dekadal');


            $description = $this->input->post('description_dekadal');
           // $creationDate= date('Y-m-d H:i:s');
            $Approved="FALSE";
            $firstname=$session_data['FirstName'];
            $surname=$session_data['SurName'];
            $SubmittedBy=$user=$firstname.' '.$surname;
            $stationId=$this->DbHandler->identifyStationById($station, $stationNumber);//station name and station number

            $insertScannedDekadalFormReportDataDetails=array(
                'station' => $stationId,
                 'from_date' => $FromdateOnScannedDekadalFormReport,'to_date' => $TodateOnScannedDekadalFormReport,
                'Approved'=> $Approved,'SDE_SubmittedBy'=>$SubmittedBy,
                'Description'=>$description,'FileRef' => $filename);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $insertsuccess= $this->DbHandler->insertData($insertScannedDekadalFormReportDataDetails,'scans_dekadals'); //Array for data to insert then  the Table Name

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

               $userid =$session_data['Userid'];
               $userlogs = array('Userid' => $userid,
                   'Action' => 'Added new Scanned dekadal form details',
                    'Details' => $name . ' added new Scanned dekadal Form details into the system ',
                    'IP' => $this->input->ip_address());
                //  save user logs
                 $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned dekadal Form details info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

        }
    }



    public function updateInformationForArchiveScannedDekadalFormReport(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'updatearchievescannedcopy_dekadalformdatareportcopy';

        if (isset($_FILES[$file_element_name]) && is_uploaded_file($_FILES[$file_element_name]['tmp_name'])) { //file has been uploaded


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
        $config['file_name'] ='UpdatedscanDekadal' .'-'.date("Y-m-d").'-'.$_FILES['userfile']['name'];

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
        }else {    //no file has been uploaded.

                $filename= $this->input->post('PreviouslyUploadedFileName_dekadalformdatareportcopy');
            }


            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname')));


                $stationId = $this->input->post('stationId');
                $stationNo = $this->input->post('stationNo');




            $FromdateOnScannedDekadalFormReport = $this->input->post('FromdateOnScannedDekadalFormReport');
            $TodateOnScannedDekadalFormReport = $this->input->post('TodateOnScannedDekadalFormReport');


            $description = $this->input->post('description');

            $id = $this->input->post('id');
            $approved=$this->input->post('approval');

            $firstname=$session_data['FirstName'];
            $surname=$session_data['SurName'];
            $UpdatedBy=$firstname.' '.$surname;


            $updateScannedDekadalFormReportDataDetails=array(
                'station' => $stationId,'Approved'=>$approved, 
                'from_date' => $FromdateOnScannedDekadalFormReport,'to_date'=>$TodateOnScannedDekadalFormReport,
                'Description'=>$description, 'SDE_SubmittedBy'=>$UpdatedBy, 'FileRef' => $filename);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $updatesuccess=$this->DbHandler->updateData($updateScannedDekadalFormReportDataDetails,'','scans_dekadals',$id);

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

                  $userid =$session_data['Userid'];
                  $userlogs = array('Userid' => $userid,
                    'Action' => 'Added new Scanned dekadal Form details',
                    'Details' => $name . ' added new Scanned dekadal Form details into the system ',
                    'IP' => $this->input->ip_address());
                //  save user logs
                $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned dekadal Form details info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

       // }

    }
	public 	function update_approval() {
		$session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];
	  $user_id=$session_data['Userid'];
		$id= $this->input->post('id');
		$data = array(
		'Approved' => $this->input->post('approve')
		
		);
		$query=$this->DbHandler->updateApproval1($id,$data,"scans_dekadals");
		if ($query) {
		$this->session->set_flashdata('success', 'Data was updated successfully!');
		$this->index();
		}else{
		$this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
		$this->index();	
		}
		}
    public function deleteInformationForArchiveScannedDekadalFormReport() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('scans_dekadals',$id);  //$rowsaffected > 0

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
                'UserRole' => $userrole,'Action' => 'Deleted instrument details',
                'Details' => $name . ' deleted instrument details into the system ',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Instrument info was deleted successfully!');
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
    function checkInDBIfArchiveScannedDekadalFormDataReportCopyRecordExistsAlready($fromdate,$todate,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $fromdate = ($fromdate == "") ? $this->input->post('fromdate') : $fromdate;
        $todate = ($todate == "") ? $this->input->post('todate') : $todate;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedDekadalFormDataReportCopyRecordExistsAlready($fromdate,$todate,$stationName,$stationNumber,'scans_dekadals');   // $value, $field, $table

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
