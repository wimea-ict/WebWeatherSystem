<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedSynopticFormDataReportCopy extends CI_Controller {

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


        $query = $this->DbHandler->selectAll($userstation,'StationName','scannedarchivesynopticformreportcopydetails');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['archivedscannedsynopticformreportcopydetails'] = $query;
        } else {
            $data['archivedscannedsynopticformreportcopydetails'] = array();
        }


        //Load the view.
        $this->load->view('archiveScannedSynopticFormDataReportCopy', $data);
    }

    public function DisplayFormToArchiveScannedSynopticFormReportDetails(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedSynopticFormReportDetails';
        $data['displaynewFormToArchiveScannedSynopticFormReportDetails'] = array('name' => $name);

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



        $this->load->view('archiveScannedSynopticFormDataReportCopy', $data);

    }
    public function DisplayFormToArchiveScannedSynopticFormReportForUpdate(){
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




        $scannedsynopticformid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedsynopticformid,'id','scannedarchivesynopticformreportcopydetails');  //$value, $field,$table
        if ($query) {
            $data['scannedsynopticformreportcopyidDetails'] = $query;
        } else {
            $data['scannedsynopticformreportcopyidDetails'] = array();
        }


        $this->load->view('archiveScannedSynopticFormDataReportCopy', $data);
    }


    public function insertInformationForArchiveScannedSynopticFormReport(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_synopticformreport_firstpage';   //name of the input text field


        $config['upload_path'] = 'archive/';    //path on the server to store the file
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
            $filename_firstpage = $data['file_name'];


     ////////////////////////////////////////////////////
            $file_element_name1 = 'archievescannedcopy_synopticformreport_secondpage';   //name of the input text field


            $config['upload_path'] = 'archive/';    //path on the server to store the file
            // $config['upload_path'] = '/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['encrypt_name'] = FALSE;
            $config['max_size'] = '2048000';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
            $config['max_height'] = '768';
            $config['max_width'] = '1024';

            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name1))
            {
                $status = 'error';
                echo   $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $filename_secondpage = $data['file_name'];




            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname_synoptic')));




                $station = $this->input->post('station_ArchiveScannedSynopticFormReport');
                $stationNo = $this->input->post('stationNo_ArchiveScannedSynopticFormReport');




            $dateOnScannedSynopticFormReport = $this->input->post('dateOnScannedSynopticFormReport_synoptic');


            $description = $this->input->post('description_synoptic');


            $creationDate= date('Y-m-d H:i:s');
            $Approved="FALSE";
            $firstname=$session_data['FirstName'];
            $surname=$session_data['SurName'];
            $SubmittedBy=$firstname.' '.$surname;

            $insertScannedSynopticFormReportDataCopyDetails=array(
                'Form' => $formname, 'StationName' => $station,
                'StationNumber' => $stationNo, 'Date' => $dateOnScannedSynopticFormReport,'Approved'=> $Approved,'SubmittedBy'=>$SubmittedBy,
                'Description'=>$description,'FileName_FirstPage' => $filename_firstpage,'FileName_SecondPage' => $filename_secondpage,

                'CreationDate'=> $creationDate);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $insertsuccess= $this->DbHandler->insertData($insertScannedSynopticFormReportDataCopyDetails,'scannedarchivesynopticformreportcopydetails'); //Array for data to insert then  the Table Name

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
                    'UserRole' => $userrole,'Action' => 'Added new Scanned Synoptic Form details',
                    'Details' => $name . ' added new Scanned Synoptic Form details into the system ',
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
    }



    public function updateInformationForArchiveScannedSynopticFormReport(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name1 = 'updatearchievescannedcopy_synopticformreport_firstpage';


        $config['upload_path'] = 'archive/';
        // $config['upload_path'] = '/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '2048000';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
        $config['max_height'] = '768';
        $config['max_width'] = '1024';

        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name1))
        {
            $status = 'error';
            echo   $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $filename1 = $data['file_name'];


    ///////////////////////////////////////////////////////////////////////
            $file_element_name2 = 'updatearchievescannedcopy_synopticformreport_secondpage';


            $config['upload_path'] = 'archive/';
            // $config['upload_path'] = '/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['encrypt_name'] = FALSE;
            $config['max_size'] = '2048000';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
            $config['max_height'] = '768';
            $config['max_width'] = '1024';

            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name2))
            {
                $status = 'error';
                echo   $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $filename2 = $data['file_name'];




            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname')));



                $station = $this->input->post('station');
                $stationNo = $this->input->post('stationNo');




                $dateOnScannedSynopticFormReport = $this->input->post('dateOnScannedSynopticFormReport');


            $description = $this->input->post('description');

            $id = $this->input->post('id');






            $updateScannedSynopticFormDataReportDetails=array(
                'Form' => $formname, 'StationName' => $station,
                'StationNumber' => $stationNo, 'Date' => $dateOnScannedSynopticFormReport,
                'Description'=>$description,'FileName_FirstPage' => $filename1,'FileName_SecondPage' => $filename2);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $updatesuccess=$this->DbHandler->updateData($updateScannedSynopticFormDataReportDetails,'scannedarchivesynopticformreportcopydetails',$id);

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
                    'UserRole' => $userrole,'Action' => 'Updated new Scanned Synoptic Form details',
                    'Details' => $name . ' added new Scanned Synoptic Form details into the system ',
                    'StationName' => $userstation,
                    'StationNumber' => $userstationNo ,
                    'IP' => $this->input->ip_address());
                //  save user logs
                // $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'Updated Scanned Synoptic Form details info was updated successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

        }
        }

    }
    public function deleteInformationForArchiveScannedSynopticFormReport() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('scannedarchivesynopticformreportcopydetails',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted Synoptic details',
                'Details' => $name . ' deleted Synoptic details into the system ',
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
    function checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready($date,$stationName,$stationNumber,'scannedarchivesynopticformreportcopydetails');   // $value, $field, $table

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