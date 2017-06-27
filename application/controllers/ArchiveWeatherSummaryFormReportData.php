<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveWeatherSummaryFormReportData extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }
    public function index(){
      //  $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','archiveweathersummaryformreportdata');  //value,field,table
        // $query = $this->DbHandler->selectAll('dailyperiodicrainfall');  //dailyperiodicrainfall is the Table Name.
        //  var_dump($query);

        //  var_dump($query);
        if ($query) {
            $data['archivedweathersummaryformreportdata'] = $query;
        } else {
            $data['archivedweathersummaryformreportdata'] = array();
        }

        $this->load->view('archiveWeatherSummaryFormReportData', $data);
    }
    public function DisplayNewArchiveWeatherSummaryFormReportData(){
        $this->unsetflashdatainfo();
        $name='displaynewarchiveweathersummaryFormreportdata';
        $data['displaynewarchiveweathersummaryFormreportdata'] = array('name' => $name);

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

        $this->load->view('archiveWeatherSummaryFormReportData', $data);

    }
    public function DisplayArchiveWeatherSummaryFormReportDataForUpdate(){
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


        $archiveweathersummaryformreportdataid = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($archiveweathersummaryformreportdataid,'id','archiveweathersummaryformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['updatearchiveweathersummaryformreportdata'] = $query;
        } else {
            $data['updatearchiveweathersummaryformreportdata'] = array();
        }

        $this->load->view('archiveWeatherSummaryFormReportData', $data);
    }

    public function insertArchiveWeatherSummaryFormReportData(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date_archiveweathersummaryformreportdata');
        //$time=$this->input->post('timewsf');
       // $ztime=$this->input->post('zwsf');
       // $month = date("F");
       // $year = date("Y");




            $station = firstcharuppercase(chgtolowercase($this->input->post('station_archiveweathersummaryformreportdata')));

            $stationNumber = $this->input->post('stationNo_archiveweathersummaryformreportdata');






        $max = $this->input->post('maxTemp_wsf');
        $min = $this->input->post('minTemp_wsf');
        $sunshine = $this->input->post('sunshine_wsf');

        $db0600Z = $this->input->post('db0600Z_wsf');
        $wb0600Z = $this->input->post('wb0600Z_wsf');
        $dp0600Z = $this->input->post('dp0600Z_wsf');
        $vp0600Z = $this->input->post('vp0600Z_wsf');
        $rh0600Z = $this->input->post('rh0600Z_wsf');
        $clp0600Z = $this->input->post('clp0600Z_wsf');
        $gpm0600Z = $this->input->post('gpm0600Z_wsf');
        $winddir_0600Z = $this->input->post('winddir0600Z_wsf');
        $ff_0600Z = $this->input->post('ff0600Z_wsf');

        /////////////////////////////////////////
        $db1200Z = $this->input->post('db1200Z_wsf');
        $wb1200Z = $this->input->post('wb1200Z_wsf');
        $dp1200Z = $this->input->post('dp1200Z_wsf');
        $vp1200Z = $this->input->post('vp1200Z_wsf');
        $rh1200Z = $this->input->post('rh1200Z_wsf');
        $clp1200Z = $this->input->post('clp1200Z_wsf');
        $gpm1200Z = $this->input->post('gpm1200Z_wsf');
        $winddir_1200Z = $this->input->post('winddir1200Z_wsf');
        $ff_1200Z = $this->input->post('ff1200Z_wsf');



        $windrun = $this->input->post('windrun_wsf');
        $rf = $this->input->post('rf_wsf');
        //$rday = $this->input->post('rdaywsf');

        $rain = "";
       // if($this->input->post('rainwsf')!= "")
       //     $rain = $this->input->post('rainwsf');
      //  else
       //     $rain = "false";

        $thunderstorm = "";
        if($this->input->post('thunderstorm_wsf')!="")
            $thunderstorm = $this->input->post('thunderstorm_wsf');
        else
            $thunderstorm = "false";

        $fog = "";
        if($this->input->post('fog_wsf')!="")
            $fog = $this->input->post('fog_wsf');
        else
            $fog = "false";

        $haze = "";
        if($this->input->post('haze_wsf')!="")
            $haze = $this->input->post('haze_wsf');
        else
            $haze = "false";

        $hailstorm = "";
        if($this->input->post('hailstorm_wsf')!="")
            $hailstorm = $this->input->post('hailstorm_wsf');
        else
            $hailstorm = "false";

        $earthquake = "";
        if($this->input->post('earthquake_wsf')!="")
            $earthquake = $this->input->post('earthquake_wsf');
        else
            $earthquake = "false";



        $Approved = "FALSE";
        $creationDate= date('Y-m-d H:i:s');
        $SubmittedBy=$name;



        $insertArchiveWeatherSummaryFormReportDataIntoDB=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=> $stationNumber,
            'SubmittedBy' => $SubmittedBy ,'Approved'=>$Approved,'CreationDate'=>$creationDate,
            'TEMP_MAX'=> $max, 'TEMP_MIN'=>$min,'SUNSHINE'=>$sunshine,

            'DB_0600Z'=>$db0600Z,'WB_0600Z'=>$wb0600Z,
            'DP_0600Z'=>$dp0600Z,'VP_0600Z'=>$vp0600Z,'RH_0600Z'=>$rh0600Z,'CLP_0600Z'=>$clp0600Z,
            'GPM_0600Z'=>$gpm0600Z,'WIND_DIR_0600Z'=>$winddir_0600Z,'FF_0600Z'=>$ff_0600Z,



            'DB_1200Z'=>$db1200Z,'WB_1200Z'=>$wb1200Z,
            'DP_1200Z'=>$dp1200Z,'VP_1200Z'=>$vp1200Z,'RH_1200Z'=>$rh1200Z,'CLP_1200Z'=>$clp1200Z,
            'GPM_1200Z'=>$gpm1200Z,'WIND_DIR_1200Z'=>$winddir_1200Z,'FF_1200Z'=>$ff_1200Z,


            'WIND_RUN'=>$windrun,'R_F'=>$rf,



             'ThunderStorm'=>$thunderstorm,'Fog'=>$fog,
            'Haze'=>$haze, 'HailStorm'=>$hailstorm,'EarthQuake'=>$earthquake);

        $insertsuccess= $this->DbHandler->insertData($insertArchiveWeatherSummaryFormReportDataIntoDB,'archiveweathersummaryformreportdata'); //Array for data to insert then  the Table Name





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
                'UserRole' => $userrole,'Action' => 'Added Archived WEather Summary Form  info',
                'Details' => $name . ' added Archived WEather Summary Form info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'New Archived WEather Summary Form info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! WEather Summary Form not inserted ');
            $this->index();

        }

    }
    public function updateArchiveWeatherSummaryFormReportData(){
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        //$name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date');

        //$month = date("F");
        //$year = date("Y");




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
            $stationNumber = $this->input->post('stationNo');



        $maxTemp = $this->input->post('maxTemp');
        $minTemp = $this->input->post('minTemp');
        $sunshine = $this->input->post('sunshine');
        $db0600Z = $this->input->post('db0600Z');
        $wb0600Z = $this->input->post('wb0600Z');
        $dp0600Z = $this->input->post('dp0600Z');
        $vp0600Z = $this->input->post('vp0600Z');
        $rh0600Z = $this->input->post('rh0600Z');
        $clp0600Z = $this->input->post('clp0600Z');
        $gpm0600Z = $this->input->post('gpm0600Z');
        $winddir_0600Z = $this->input->post('winddir0600Z');
        $ff_0600Z = $this->input->post('ff0600Z');

        $db1200Z = $this->input->post('db1200Z');
        $wb1200Z = $this->input->post('wb1200Z');
        $dp1200Z = $this->input->post('dp1200Z');
        $vp1200Z = $this->input->post('vp1200Z');
        $rh1200Z = $this->input->post('rh1200Z');
        $clp1200Z = $this->input->post('clp1200Z');
        $gpm1200Z = $this->input->post('gpm1200Z');
        $winddir_1200Z = $this->input->post('winddir1200Z');
        $ff_1200Z = $this->input->post('ff1200Z');


        $windrun = $this->input->post('windrun');
        $rf = $this->input->post('rf');


        $thunderstorm = "";
        if($this->input->post('thunderstorm')!="")
            $thunderstorm = $this->input->post('thunderstorm');
        else
            $thunderstorm = "false";

        $fog = "";
        if($this->input->post('fog')!="")
            $fog = $this->input->post('fog');
        else
            $fog = "false";

        $haze = "";
        if($this->input->post('haze')!="")
            $haze = $this->input->post('haze');
        else
            $haze = "false";

        $hailstorm = "";
        if($this->input->post('hailstorm')!="")
            $hailstorm = $this->input->post('hailstorm');
        else
            $hailstorm = "false";

        $earthquake = "";
        if($this->input->post('earthquake')!="")
            $earthquake = $this->input->post('earthquake');
        else
            $earthquake = "false";



        $Approved = $this->input->post('approval');

        $id = $this->input->post('id');




        $updateArchiveWeatherSummaryFormReportDataInDB=array(
            'Date'=>$date,'StationName'=>$station,'StationNumber'=> $stationNumber,
            'Approved'=>$Approved,
            'TEMP_MAX'=> $maxTemp, 'TEMP_MIN'=>$minTemp,'SUNSHINE'=>$sunshine,


            'DB_0600Z'=>$db0600Z,'WB_0600Z'=>$wb0600Z,
            'DP_0600Z'=>$dp0600Z,'VP_0600Z'=>$vp0600Z,'RH_0600Z'=>$rh0600Z,'CLP_0600Z'=>$clp0600Z,
            'GPM_0600Z'=>$gpm0600Z,'WIND_DIR_0600Z'=>$winddir_0600Z,'FF_0600Z'=>$ff_0600Z,



            'DB_1200Z'=>$db1200Z,'WB_1200Z'=>$wb1200Z,
            'DP_1200Z'=>$dp1200Z,'VP_1200Z'=>$vp1200Z,'RH_1200Z'=>$rh1200Z,'CLP_1200Z'=>$clp1200Z,
            'GPM_1200Z'=>$gpm1200Z,'WIND_DIR_1200Z'=>$winddir_1200Z,'FF_1200Z'=>$ff_1200Z,


            'WIND_RUN'=>$windrun,'R_F'=>$rf, 'ThunderStorm'=>$thunderstorm,'Fog'=>$fog,
            'Haze'=>$haze, 'HailStorm'=>$hailstorm,'EarthQuake'=>$earthquake);

        $updatesuccess=$this->DbHandler->updateData($updateArchiveWeatherSummaryFormReportDataInDB,'archiveweathersummaryformreportdata',$id);


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
                'UserRole' => $userrole,'Action' => 'Updated Archived Weather Summary Form info',
                'Details' => $name . ' updated Archived Weather Summary Form info into the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Weather Summary Form info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue! Weather Summary Form info not updated');
            $this->index();

        }

    }

    public function deleteArchiveWeatherSummaryFormData()
    {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        //$query = $this->DbHandler->DeleteDailyPeriodicRainfallData($id);

        $rowsaffected = $this->DbHandler->deleteData('archiveweathersummaryformreportdata',$id);  //$rowsaffected > 0 $tablename,id of the row

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted periodic rainfall  info',
                'Details' => $name . ' deleted periodic rainfall from the system',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', ' Archive Weather Summary info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveWeatherSummaryFormReportRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkIfArchiveWeatherSummaryFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber,'archiveweathersummaryformreportdata');   // $value, $field, $table

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