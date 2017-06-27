<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedWeatherSummaryFormDataReportCopy extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }
    public function index(){
        // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];


        $query = $this->DbHandler->selectAll($userstation,'StationName','scannedarchiveweathersummaryformreportcopydetails');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['archivedscannedweathersummaryformreportdetails'] = $query;
        } else {
            $data['archivedscannedweathersummaryformreportdetails'] = array();
        }


        //Load the view.
        $this->load->view('archiveScannedWeatherSummaryFormDataReportCopy', $data);
    }

    public function DisplayFormToArchiveScannedWeatherSummaryFormReport(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedWeatherSummaryFormReport';
        $data['displaynewFormToArchiveScannedWeatherSummaryFormReport'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        /////////////////////////////////////////////////////////

        $this->load->view('archiveScannedWeatherSummaryFormDataReportCopy', $data);

    }
    public function DisplayFormToArchiveScannedWeatherSummaryFormReportForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }




        $scannedweathersummaryformreportid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedweathersummaryformreportid,'id','scannedarchiveweathersummaryformreportcopydetails');  //$value, $field,$table
        if ($query) {
            $data['scannedweathersummaryformreportidDetails'] = $query;
        } else {
            $data['scannedweathersummaryformreportidDetails'] = array();
        }


        $this->load->view('archiveScannedWeatherSummaryFormDataReportCopy', $data);
    }


    public function insertInformationForArchiveScannedWeatherSummaryFormReport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_weathersummaryformdatareport';


        $config['upload_path'] = 'archive/';
        // $config['upload_path'] = '/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '2048000';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
        $config['max_height'] = '768';
        $config['max_width'] = '1024';

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




            $formname = $this->input->post('formname_weathersummaryformreport');



                $station = $this->input->post('station_ArchiveScannedWeatherSummaryFormReport');
                $stationNo = $this->input->post('stationNo_ArchiveScannedWeatherSummaryFormReport');



            $monthOFScannedWeatherSummaryFormReport = $this->input->post('monthOfScannedWeatherSummaryFormReport_weathersummaryformreport');
            $yearOFScannedWeatherSummaryFormReport = $this->input->post('yearOfScannedWeatherSummaryFormReport_weathersummaryformreport');


            $description = $this->input->post('description_weathersummaryformreport');
            $creationDate= date('Y-m-d H:i:s');
            $Approved="FALSE";
            $firstname=$session_data['FirstName'];
            $surname=$session_data['SurName'];
            $SubmittedBy=$user=$firstname.' '.$surname;

            $insertScannedWeatherSummaryFormReportDataDetails=array(
                'Form' => $formname, 'StationName' => $station,
                'StationNumber' => $stationNo, 'Month' => $monthOFScannedWeatherSummaryFormReport,'Year' => $yearOFScannedWeatherSummaryFormReport,
                'Approved'=> $Approved,'SubmittedBy'=>$SubmittedBy,
                'Description'=>$description,'FileName' => $filename,'CreationDate'=> $creationDate);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $insertsuccess= $this->DbHandler->insertData($insertScannedWeatherSummaryFormReportDataDetails,'scannedarchiveweathersummaryformreportcopydetails'); //Array for data to insert then  the Table Name

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
                    'UserRole' => $userrole,'Action' => 'Added new Scanned Metar Form details',
                    'Details' => $name . ' added new Scanned Metar Form details into the system ',
                    'StationName' => $userstation,
                    'StationNumber' => $userstationNo ,
                    'IP' => $this->input->ip_address());
                //  save user logs
                // $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned Metar Form details info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

        }
    }



    public function updateInformationForArchiveScannedWeatherSummaryFormReport(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'updatearchievescannedcopy_weathersummaryformdatareportcopy';


        $config['upload_path'] = 'archive/';
        // $config['upload_path'] = '/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '2048000';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
        $config['max_height'] = '768';
        $config['max_width'] = '1024';

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




            $formname = $this->input->post('formname');




                $station = $this->input->post('station');
                $stationNo = $this->input->post('stationNo');




            $monthOFScannedWeatherSummaryFormReport = $this->input->post('monthOfScannedWeatherSummaryFormReport');
            $yearOFScannedWeatherSummaryFormReport = $this->input->post('yearOfScannedWeatherSummaryFormReport');


            $description = $this->input->post('description');

            $id = $this->input->post('id');






            $updateScannedWeatherSummaryFormReportDataDetails=array(
                'Form' => $formname, 'StationName' => $station,
                'StationNumber' => $stationNo, 'Month' => $monthOFScannedWeatherSummaryFormReport,'Year'=> $yearOFScannedWeatherSummaryFormReport,
                'Description'=>$description,'FileName' => $filename,);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $updatesuccess=$this->DbHandler->updateData($updateScannedWeatherSummaryFormReportDataDetails,'scannedarchiveweathersummaryformreportcopydetails',$id);

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
                    'UserRole' => $userrole,'Action' => 'Added new Scanned Metar Form details',
                    'Details' => $name . ' added new Scanned Metar Form details into the system ',
                    'StationName' => $userstation,
                    'StationNumber' => $userstationNo ,
                    'IP' => $this->input->ip_address());
                //  save user logs
                // $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned Metar Form details info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

        }

    }
    public function deleteInformationForArchiveScannedWeatherSummaryFormReport() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('instruments',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted instrument details',
                'Details' => $name . ' deleted instrument details into the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
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
    function checkInDBIfArchiveScannedWeatherSummaryFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $month = ($month == "") ? $this->input->post('month') : $month;
        $year = ($year == "") ? $this->input->post('year') : $year;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedWeatherSummaryFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber,'scannedarchiveweathersummaryformreportcopydetails');   // $value, $field, $table

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