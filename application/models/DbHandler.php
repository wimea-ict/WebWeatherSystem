<?php
class DbHandler extends CI_Model {

    function __construct() {
        parent::__construct();

    }

    function getStationIdAndRegion($username, $password){

        $this->db->select('station,region_zone');
        $this->db->from('systemusers as user');
        $this->db->where('user.UserName', $username);
        $this->db->where('user.UserPassword', $password);
        $this->db->where('user.Active', 1);
        $this->db->order_by("user.userid", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        
        
        if($query -> num_rows() == 1)
        {
            foreach ($query->result() as $row){
                $result = $row->station;
               // $row->region_zone;exit();
            }
		
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    function StationUsers($stationid){
		$this->db->select('*');
        $this->db->from('systemusers as user');
		$this->db->where('user.station', $stationid);
		//$this->db->where('user.Active', 1);
		 $this->db->order_by("user.UserRole", "asc");
		  $query = $this->db->get();
		
        if($query->num_rows() >0)
        {
            $result = $query->result();
			
            return $result;
           
        }
        else
        {
			 //exit("hmmmmmmmqewrt");
            return false;
			
        }
	}
    function getUserLogInDetails($username, $password,$res,$active) {
        $this->db->select('*');
        $this->db->from('systemusers as user');

        if($res && $res != 0){
            $this->db->join('stations as stationsdata', 'user.station = stationsdata.station_id');
        }else{
			 $this->db->join('stations as stationsdata', 'user.region_zone = stationsdata.StationRegion','left');
		}
        
        $this->db->where('user.UserName', $username);
        $this->db->where('user.UserPassword', $password);
        if($active !=0){
        $this->db->where('user.Active', 1);
        }
        $this->db->order_by("user.userid", "desc");

        $this->db->limit(1);
        //$results = mysqli_query($con,
        //"SELECT systemusers.Userid,systemusers.FirstName,systemusers.SurName,systemusers.UserName, systemusers.UserEmail, systemusers.UserRole, systemusers.Active,systemusers.StationNumber,systemusers.UserStation,stations.Longitude ,stations.Latitude,stations.StationName  FROM systemusers,stations
        //WHERE (systemusers.UserName='".$userName."' ) AND systemusers.UserPassword='".$password."' AND systemusers.StationNumber=stations.StationNumber  LIMIT 1") or die('{"error":"Login error! Code: 003"}');
        // Run the query
        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    public function checkUserDetails($username, $email){
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('userName', $username);
        $this->db->where('UserEmail', $email);
        $this->db->order_by("userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
	  public function selectCustomisedRainfall($stationNo, $station, $dateFro, $dateTo){
       
		$this->db->select('*');
        $this->db->from('observationslip as slip');
		$this->db->join('stations','slip.Station= stations.station_id');
        $this->db->where('stations.StationName', $stationNo);
        $this->db->where('stations.StationNumber', $station);
		 $this->db->where('slip.Date >=', $dateFro);
        $this->db->where('slip.Date <=', $dateTo);
        $this->db->order_by("slip.Date", "desc");
        // Run the query
        $query = $this->db->get();
		
        if($query -> num_rows() >0)
        {
            $result = $query->result();
			//exit("am here".$result->Date);
            return $result;
            //return $query->result();
        }
        else
        {
			 //exit("hmmmmmmmqewrt");
            return false;
			
        }
    }

    public  function ResetUserPassword($data,$userid,$email,$username){
        $this->db->set($data);
        $this->db->where("userid",$userid);

        if($email!= "" && $username!="" ){

            $this->db->where("UserEmail",$email);
            $this->db->where("UserName",$username);
        }
        else{

        }

        $this->db->update("systemusers", $data);

        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }
public    function  saveUserLogs($userlogsdata){
        $this->db->insert("userlogs", $userlogsdata);  //userlogs is the table
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
// Count all record of table "contact_info" in database.
public function record_count($field, $value) {
//return $this->db->count_all("observationslip");
$this->db->select('*');
$this->db->from('observationslip as slip');
$this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');
$this->db->where('stationsdata.'.$field, $value);
return $this->db->count_all_results();
}
public function record_count_webmobile($field, $value) {

  $this->db->select('*');
  $this->db->from('observationslip as slip');
  $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');
  $this->db->where('stationsdata.'.$field, $value);
  $this->db->where_not_in('slip.DeviceType', 'AWS');
return $this->db->count_all_results();
}
public function record_count_aws($field, $value) {
  $this->db->select('*');
  $this->db->from('observationslip as slip');
  $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');
  $this->db->where('stationsdata.'.$field, $value);
  $this->db->where('slip.DeviceType', 'AWS');
return $this->db->count_all_results();
}

//jovRi
    public function selectAllSystemUsers($value, $field,$tablename){ //field:UserStation value:StationName


       $this->db->select('*');
       $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id','left');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $StationRegion=$session_data['StationRegion'];
        if($userrole=='Manager' || $userrole=='ManagerData'){
/*          $this->db->where_not_in('user.UserRole', 'ObserverDataEntrant');
            $this->db->where_not_in('user.UserRole', 'ObserverArchive');
            $this->db->where_not_in('user.UserRole', 'Observer');
            $this->db->where_not_in('user.UserRole', 'ManagerData');
*/
        }elseif($userrole=='OC'){
            $this->db->where_not_in('user.UserRole', 'ManagerStationNetworks');
            $this->db->where('user.'.$field, $value);
            $this->db->where('user.Active', 1);
        }
        elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $this->db->where('user.StationRegion', $StationRegion);
            $this->db->where('user.Active', 1);
        }
        $this->db->where_not_in('user.UserRole', 'ManagerData');
        $this->db->order_by("user.Userid", "desc");
        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
//Check if something exists alredy in the DB.
    function check($value, $field, $table) {
        $query = $this->db->query('SELECT * FROM ' . $table . ' where ' . $field . '="' . $value . '"');

        if ($query->num_rows() > 0)
            return true;
        else
            return false;

    }

    //Get DB Results when an Manager select StationName the StationNumber should be picked from DB Automatically
    function getResults($value, $field, $table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
      //  $this->db->order_by("id", "desc");
        //$this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$stationLocation,$stationIndicator,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        $this->db->or_where('StationName', $stationName);
        $this->db->or_where('StationNumber', $stationNumber);
        $this->db->or_where('Location', $stationLocation);
        $this->db->or_where('Indicator', $stationIndicator);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }

    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfStationInstrumentCodeInformationRecordExistsAlready($instrumentname,$stationinstrumentcode,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('InstrumentName', $instrumentname);
        $this->db->where('InstrumentCode', $stationinstrumentcode);


        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfStationElementMeasuredFromAnInstrumentInformationRecordExistsAlready($elementname,$instrumentnameelement,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('ElementName', $elementname);
        $this->db->where('InstrumentName', $instrumentnameelement);


        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfUserDetailsRecordExistsAlready($firstname,$surname,$email,$stationId,$userRole,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('FirstName', $firstname);
        $this->db->where('SurName', $surname);

        $this->db->where('station',$stationId);

        //$this->db->where('UserEmail', $email);
        $this->db->where('UserRole', $userRole);

        $this->db->order_by("Userid", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
//checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion  for ZonalOfficer and SenoirZonalOfficer
    function checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion($firstname,$surname,$email,$stationRegion,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('FirstName', $firstname);
        $this->db->where('SurName', $surname);
        $this->db->where('StationRegion', $stationRegion);
       // $this->db->where('StationNumber', $stationNumber);
        $this->db->where('UserEmail', $email);
        //$this->db->where('UserPhone', $phone);

        $this->db->order_by("Userid", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfObservationSlipFormRecordExistsAlready($date,$time,$stationName,$stationNumber,$tablename) {
        $this->db->select('station_id');
        $this->db->from('stations');
        
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
         $this->db->limit(1);
		  $query = $this->db->get();
		   if($query -> num_rows() >0){
			   $result= $query->row();
			   
			   return $result;
		   }else{
			   return 0;
		   }
		  
		$this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME', $time);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfMoreFormFieldsFormRecordExistsAlready($date,$time,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME', $time);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveMetarFormRecordExistsAlready($date,$stationName,$stationNumber,$time,$metarOption, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename.' as tab');
        $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');

        $this->db->where('tab.DATE', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('tab.TIME', $time);
        $this->db->where('tab.METARSPECI', $metarOption);
        $this->db->order_by("tab.id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveSynopticFormReportRecordExistsAlready($date,$time,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME', $time);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkIfArchiveDekadalFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber, $tablename) {
      $this->db->select('*');
      $this->db->from($tablename.' as tab');
      $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');

        $this->db->where('tab.DATE', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->order_by("tab.id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkIfArchiveWeatherSummaryFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkIfArchiveMonthlyRainfallFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedMetarFormDataCopyRecordExistsAlready($date,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready($date,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready($date,$time,$stationName,$stationNumber, $tablename) {
        $station = $this->identifyStationById($stationName,$stationNumber);
		
		$this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('station', $station);
       
        $this->db->where('TIME', $time);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedDekadalFormDataReportCopyRecordExistsAlready($fromdate,$todate,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('FromDate', $fromdate);
        $this->db->where('ToDate', $todate);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedWeatherSummaryFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('Month', $month);
        $this->db->where('Year', $year);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedMonthlyRainfallFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('Month', $month);
        $this->db->where('Year', $year);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfArchiveScannedYearlyRainfallFormDataReportCopyRecordExistsAlready($year,$stationName,$stationNumber, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        //$this->db->where('Month', $month);
        $this->db->where('Year', $year);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }

    //select field modified by user
    public function SelectFieldsForUserUpdate(){
        $this->db->select('*');
        $this->db->from('data_tracking as tracking');
        $this->db->join('systemusers as user', 'tracking.modifiedBy= user.Userid');
        $this->db->order_by("tracking.id", "desc");

        $query = $this->db->get();
                if($query -> num_rows() > 0)
                {
                    $result = $query->result();  //$query -> result_array();
                    return $result;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }

    }
     public function SelectZonal($user){
        $this->db->select('region_zone');
        $this->db->from('systemusers');
        $this->db->where('Userid',$user);
		$this->db->limit(1);
       

        $query = $this->db->get();
                if($query -> num_rows() > 0)
                {
                    $result = $query->row();
                   				//$query -> result_array();
                    return $result->region_zone;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }

    }


    //Select all from the tables(Stations,Instruments,Elements,UserLogs) in the DB.
    //jovRi
  public function selectAllFromSystemData($value, $field,$tablename,$id_to_use){ //$stationame ,field StationName
		$session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userid=$session_data['Userid'];
		$region =$this->SelectZonal($userid);
 if($tablename=="stations"){
	
        $this->db->select('*');
        $this->db->from($tablename );
         //$this->db->join('systemusers as data', 'stations.station_id = data.station','left');
		//$this->db->where('Active','1');
        
            if($userrole=='ManagerData' ){
            $this->db->where('StationStatus','on');
              $this->db->where_not_in('station_id','0');
            }elseif($userrole=="ManagerStationNetworks"){
                $this->db->where_not_in('station_id','0');

                    }
                    elseif($userrole=='ZonalOfficer' || $userrole=="SeniorZonalOfficer"  || $userrole=="Director" ){
                          $this->db->where('StationStatus','on');
                          $this->db->where('StationRegion', $region);
							
                    }elseif($userrole=='OC' ){
                        $this->db->where('StationStatus','on');
						  $this->db->where_not_in('station_id','0');
                    }
                    
                  $this->db->order_by("station_id", "desc");
  }else{
    $this->db->select('*');
    $this->db->from($tablename.' as tab');//select from userlogs
    $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
    $this->db->where_not_in('tab.station','0');
    if($tablename=='stations' ){
        $this->db->where('tab.'.$field, $value);
    }else{
		  $this->db->where('stationsdata.'.$field, $value);
	}

    //$this->db->join('data_tracking as tracking','tracking.modified = tab.Date');
    //$this->db->where('tracking.modifiedBy','tab.Userid');
    
    $this->db->order_by("tab.id", "desc");
  }
              // Run the query
                $query = $this->db->get();
                if($query -> num_rows() > 0)
                {
					
                    $result = $query->result();  //$query -> result_array();
                    return $result;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }
            }
            //jovRi
                public function selectAllscanDaily($value, $field,$tablename,$form){ //$stationame ,field StationName
                    $this->db->select('*');
                    $this->db->from($tablename.' as slip');
                    $this->db->join('stations as stationsdata', 'slip.station = stationsdata.station_id');
                    $this->db->where('slip.Form_scanned', $form);
                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];


                    if($userrole=='Manager'){

                    }elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){

                     }elseif($userrole=='OC' ){
                        $this->db->where('stationsdata.'.$field, $value); //field is StationName

                    }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){
                        $this->db->where('stationsdata.'.$field, $value);

                    }

                    $this->db->order_by("slip.id", "desc");
                    // Run the query
                    $query = $this->db->get();
                    if($query -> num_rows() > 0)
                    {
                        $result = $query->result();  //$query -> result_array();
                        return $result;
                    }
                    else
                    {
                        //$results = $query->result();
                        return false;
                    }
                }


                function updateLogViewstatus($query){
                    $session_data = $this->session->userdata('logged_in');
                            $userrole= $session_data['UserRole'];

                    foreach($query as $row){
                       $logdate=$row->logdate;
                       $logid=$row->logid;
                       $query1=$this->getPopuplogs($logdate,$logid);
                            foreach($query1 as $row){
                                $statusflag = $row->status;break;
                            }
                            if($statusflag=='01'){$setflag='11';}
                            if($statusflag=='10'){$setflag='11';}
                            if($statusflag=='00' && $userrole=='OC'){$setflag='10';}
                            if($statusflag=='00' && $userrole=='ManagerData'){$setflag='01';}

                            $updatedata=array('status'=>$setflag);
                        $this->db->where('Userid',$logid)
                             ->where('Date',$logdate)
                             ->update('userlogs',$updatedata);
                    }
                }

                function getLogViews(){
                    $session_data = $this->session->userdata('logged_in');
                            $userstationid=$session_data['StationId'];
                            $userid= $session_data['Userid'];
                            $userrole= $session_data['UserRole'];
                    $statusvalues4oc=array('01','00');
                    $statusvalues4manager=array('10','00');
                    $this->db->select('*,logs.Date as logdate,logs.Userid as logid');
                      $this->db->from('userlogs as logs');
                      $this->db->join('systemusers as users','logs.Userid=users.Userid');
                      $this->db->join('observationslip as slip','logs.data_id=slip.id');
                      $this->db->join('stations as stationdata','stationdata.station_id=slip.station');

                      if($userrole=='OC'){
                          $this->db->where_in('logs.status',$statusvalues4oc);
                          $this->db->where('slip.station',$userstationid);
                        }
                      else if($userrole=='ManagerData'){
                          $this->db->where_in('logs.status',$statusvalues4manager);
                          $this->db->where_in('users.UserRole',array('ZonalOfficer','SeniorZonalOfficer'));
                        }
                      
                      
                      $this->db->where_not_in('logs.Userid',$userid);
                      $this->db->group_by(array("logs.Userid", "logs.Date",));
                    $query = $this->db->get();
                    if($query -> num_rows() > 0)
                    {
                        $result = $query->result(); 
                        return $result;
                    }
                    else
                    {
                        return false;
                    }
                }

                public function getPopupRecord($data_id){
                    $this->db->select('*');
                    $this->db->from('observationslip as slip');
                    $this->db->join('systemusers as users', 'slip.Userid= users.Userid');
                    $this->db->join('stations as stationsdata', 'users.station = stationsdata.station_id');
                    $this->db->where('slip.id',$data_id); 
                    $query = $this->db->get();
                    if($query -> num_rows() > 0)
                    {
                        $result = $query->result(); 
                        return $result;
                    }
                    else
                    {
                        return false;
                    }

                }

                function updatePopupRecord($userid,$date){
                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];
                    $date = rawurldecode($date);
                    $query=$this->getPopuplogs($date,$userid);
                    foreach($query as $row){
                        $statusflag = $row->status;break;
                    }
                    if($statusflag=='01'){$setflag='11';}
                    if($statusflag=='10'){$setflag='11';}
                    if($statusflag=='00' && $userrole=='OC'){$setflag='10';}
                    if($statusflag=='00' && $userrole=='ManagerData'){$setflag='01';}
                    else{$setflag==null;}
                    $updatedata=array('status'=>$setflag);
                        $this->db->where('Userid',$userid)
                             ->where('Date',$date)
                             ->update('userlogs',$updatedata);
                    if($this->db->affected_rows() > 0){
                        return true;
                    }else{
                        return false;
                    }
                    
                } 

                function getPopuplogs($date,$userid){

                    $this->db->select('*');
                      $this->db->from('userlogs as logs');
                      $this->db->join('systemusers as users','logs.Userid=users.Userid');
                      $this->db->where('logs.Date',$date);
                      $this->db->where('logs.Userid',$userid);
                      $query = $this->db->get();
                     if($query -> num_rows() >0)
                    {
                        $result = $query->result();
                        return $result;
                    }
                    else
                    {
                        return false;
                    }
                        
                }

                function getNotificationData(){
                    $session_data = $this->session->userdata('logged_in');
                            $userstationid=$session_data['StationId'];
                            $userid= $session_data['Userid'];
                            $userrole=$session_data['UserRole'];
                            $statusvalues4oc=array('01','00');
                            $statusvalues4manager=array('10','00');
                    $this->db->select('logs.Userid as userid,logs.Date as date,users.FirstName as FirstName,users.SurName as SurName,
                    users.UserRole as UserRole,logs.Action as Action');
                      $this->db->from('userlogs as logs');
                      $this->db->join('systemusers as users','logs.Userid=users.Userid');
                      $this->db->join('observationslip as slip','logs.data_id=slip.id');
                      if($userrole=='OC'){
                        $this->db->where_in('logs.status',$statusvalues4oc);
                      $this->db->where('slip.station',$userstationid);
                      }
                      else if($userrole=='ManagerData'){
                        $this->db->where_in('logs.status',$statusvalues4manager);
                        $this->db->where_in('users.UserRole',array('ZonalOfficer','SeniorZonalOfficer'));
                      }
                      $this->db->where_not_in('logs.Userid',$userid);
                      $this->db->group_by(array("logs.Userid", "logs.Date"));
                      $this->db->order_by('date','desc');
                      $this->db->limit(20);
                      $query = $this->db->get();
                      if($query -> num_rows() >0){
                        //data-toggle="modal" data-target="#myModal1"
            
                        $result = $query->result(); 
                        foreach ($result as $row){
                            $output .= '<li  >
                            <a onclick="getData(this);return false;" href="index.php/Users/getPopuplogs/'.rawurlencode($row->userid).'/'.rawurlencode($row->date).'">
                            <strong>'.$row->FirstName.' '.$row->SurName.', <em>'.$row->UserRole.'</em></strong><br />
                            <small><em>'.$row->Action.'</em></small>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                            ';
                        }
                        return $output;
            
                      }else{
                          return false;
                      }
                }
            
                public function getNotification(){
                    $session_data = $this->session->userdata('logged_in');
                            $userstationid=$session_data['StationId'];
                            $userid= $session_data['Userid'];
                            $userrole= $session_data['UserRole'];
                    $counter = 0;$statusvalues4oc=array('01','00');
                    $statusvalues4manager=array('10','00');
                    $this->db->select('*');
                      $this->db->from('userlogs as logs');
                      $this->db->join('systemusers as users','logs.Userid=users.Userid');
                      $this->db->join('observationslip as slip','logs.data_id=slip.id');
                      if($userrole=='OC'){
                          $this->db->where_in('logs.status',$statusvalues4oc);
                          $this->db->where('slip.station',$userstationid);
                        }
                      else if($userrole=='ManagerData'){
                          $this->db->where_in('logs.status',$statusvalues4manager);
                          $this->db->where_in('users.UserRole',array('ZonalOfficer','SeniorZonalOfficer'));
                        }
                      
                      
                      $this->db->where_not_in('logs.Userid',$userid);
                      $this->db->group_by(array("logs.Userid", "logs.Date"));
                      $query = $this->db->get();
                      if($query -> num_rows() >0){
            
                        $result = $query->result(); 
                        foreach ($result as $row){
                            $counter++;
                        }
                        return $counter;
            
                      }else{
                          return 0;
                      }
                }

                public function SelectZonalStations($region){
        
                    $this->db->select('*');
                    $this->db->from('stations');
                    $this->db->where('StationRegion',$region);
                    $this->db->order_by("StationName", "asc");
                    $query = $this->db->get();
                    if($query -> num_rows() > 0)
                    {
                        
                        $result = $query->result();  //$query -> result_array();
                        return $result;
                        //return $query->result();
                    }
                    else
                    {
                        //$results = $query->result();
                        return false;
                    }
            
                }

               function getdataid($arr,$table,$id){
                $query = $this->db->get_where($table,$arr,1);
                if($query -> num_rows() > 0)
                    {
                        
                        $result = $query->result();
                        foreach($result as $row){
                            if($id == 'id'){
                                $data_id = $row->id;
                            }
                            else if($id == 'Userid'){
                                $data_id = $row->Userid;
                            }
                            
                        }
                        return $data_id;
                    }
                    else
                    {
                        //$results = $query->result();
                        return false;
                    }
                }

                function GetUserLogs($station,$action,$typeofform,$startdate,$enddate){
                   // exit($station.'...... '.$typeofform.'....'.$startdate.'...'.$enddate);
                    $this->db->select('*,logs.Date as logdate');
                    $this->db->from('userlogs as logs');
                    $this->db->join('systemusers as users','logs.Userid=users.Userid','left');
                    
                    
                            if($action=='login/logout'){
                                $this->db->join('stations as station','users.station=station.station_id');
                                $this->db->where_in('logs.Action',array('Signed Out','Logged in'));
                                $this->db->where('station.station_id',$station);
                            }else{
                                $this->db->join('stations as station','users.station=station.station_id','left');
                                $this->db->join('observationslip as slip','slip.id=logs.data_id','left');
                                $this->db->where('logs.Action',$action.' '.$typeofform);
                                $this->db->where('slip.station',$station);
                            }
                            
                            $this->db->where('logs.Date >= ',$startdate);
                            $this->db->where('logs.Date <= ',$enddate);
                            $query=$this->db->get();
                        if($query -> num_rows() >0){
                                $result = $query->result();
                                return $result;
                            }
                            else
                            {
                                return false;
                            }
                }

                 public function selectAll($value, $field,$tablename,$lowerLimit,$upperLimit){ //$stationame ,field StationName
                    $this->db->select('*');
                    $this->db->from($tablename.' as slip');
                    $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');

                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];

                    //$lowerLimit=$total_row-($NoOfRecords*$pageNo);
                    //$upperLimit=$lowerLimit+$NoOfRecords;
                      if($lowerLimit!=NULL || $upperLimit!=NULL){
                    $this->db->where("slip.O_CreationDate >", $lowerLimit);
                    $this->db->where("slip.O_CreationDate <=", $upperLimit);
					  }
                    if($userrole=='Manager' || $userrole=='ManagerData'){

                    }elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){

                     }elseif($userrole=='OC' ){
                        $this->db->where('stationsdata.'.$field, $value); //field is StationName
                        //$this->db->where('stationsdata.'.$field, $value);
                    }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){
                        $this->db->where('stationsdata.'.$field, $value);

                    }
                     if($tablename=='observationslip'){
						 $this->db->order_by("slip.O_CreationDate", "desc"); 
					 }else{
						 $this->db->order_by("slip.CreationDate", "desc"); 
					 }
                   
                    $this->db->limit($NoOfRecords);
                    // Run the query
                    $query = $this->db->get();
                    if($query -> num_rows() > 0)
                    {
                        $result = $query->result();
						//$query -> result_array();
                        return $result;
                    }
                    else
                    {
                        //$results = $query->result();
						
                        return false;
                    }
                }

      public function selectAll2conditionsOneNegative($value, $field,$tablename,$value2, $field2,$lowerLimit,$upperLimit){ //$stationame ,field StationName
         $session_data = $this->session->userdata('logged_in');
          $userrole=$session_data['UserRole'];
		  $userid =$session_data['Userid'];
		  $region =$this->SelectZonal($userid);
		$this->db->select('*');
        $this->db->from($tablename.' as slip');
        $this->db->join('systemusers as users', 'slip.Userid= users.Userid');
		if($userrole=="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){
        //$this->db->join('stations as stationsdata', 'users.region_zone = stationsdata.StationRegion');
		 $this->db->join('stations as stationsdata', 'users.station = stationsdata.station_id');
		  $this->db->where('stationsdata.StationRegion', $region);
		}else{
			 $this->db->join('stations as stationsdata', 'users.station = stationsdata.station_id');
		     $this->db->where('stationsdata.'.$field, $value);
		}
         $NoOfRecords = 336;


         if($lowerLimit!=NULL || $upperLimit!=NULL){
		  $this->db->where("slip.O_CreationDate >=", $lowerLimit);
          $this->db->where("slip.O_CreationDate <", $upperLimit);
		 }
          $this->db->where_not_in('slip.'.$field2, $value2);
          $this->db->order_by("slip.O_CreationDate","DESC");
          $this->db->limit($NoOfRecords);

          $query = $this->db->get();
          if($query -> num_rows() > 0)
          {
              $result = $query->result();  //$query -> result_array();
              return $result;
          }
          else
          {
              //$results = $query->result();
              return false;
          }
      }//Select all from the tables(ObservationSlip,MoreFormFields,ALL THE ARCHIVE TABLES) in the DB.

   public function selectAll2conditions($value, $field,$tablename,$value2, $field2,$lowerLimit,$upperLimit){//$stationame ,field StationName
         $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
          $userid =$session_data['Userid'];
		  $region =$this->SelectZonal($userid); 
        $this->db->select('*');
        $this->db->from($tablename.' as slip');
        $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');

          $NoOfRecords= 336;
        //$lowerLimit=$total_row-($NoOfRecords*$pageNo);
        //$upperLimit=$lowerLimit+$NoOfRecords;
           if($lowerLimit!=NULL || $upperLimit!=NULL){
          $this->db->where("slip.O_CreationDate >=", $lowerLimit);
          $this->db->where("slip.O_CreationDate <", $upperLimit);
		   }
		if($userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer"){
			 $this->db->where('stationsdata.StationRegion', $region);
		}else{
			$this->db->where('stationsdata.'.$field, $value);
		} 
        
        $this->db->where('slip.'.$field2, $value2);
        $this->db->order_by("slip.O_CreationDate","DESC");
        $this->db->limit($NoOfRecords);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
        }
        else
        {
            return false;
        }
    }
    public function selectAll3conditionsOneNegative($value, $field,$tablename,$value2, $field2, $value3, $field3,$lowerLimit,$upperLimit){  //$stationame ,field StationName
        $this->db->select('*');
        $this->db->from($tablename.' as slip');
        $this->db->join('systemusers as users', 'slip.Userid= users.Userid');
        $this->db->join('stations as stationsdata', 'users.station= stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userid=$session_data['Userid'];//added
         if($lowerLimit!=NULL || $upperLimit!=NULL){
        $this->db->where("slip.O_CreationDate >=", $lowerLimit);
        $this->db->where("slip.O_CreationDate <", $upperLimit);
		 }
        $this->db->where('stationsdata.'.$field, $value);//stationname is user's station
        //$this->db->where('slip.'.$field2, $value2);//where Approved is 0
        $this->db->where_not_in('slip.'.$field3, $value3);//device type not in aws
        $this->db->where_not_in('slip.Approved', 'TRUE');
        //$this->db->where("slip.Userid", $userid);//added
        $this->db->order_by("slip.O_CreationDate","DESC");
       $this->db->limit(336);
        
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();
           		//$query -> result_array();
            return $result;
        }
        else
        {
			
            //$results = $query->result();
            return false;
        }
    }


    public function checkforduplicate($date,$station_id,$timeobservationslip){
        $this->db->select('*');
        $this->db->from('observationslip');
        $this->db->where('Date',$date);
        $this->db->where('Station',$station_id);
        $this->db->where('TIME',$timeobservationslip);
		 $this->db->where('DeviceType','web');
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }


    ////////////////////////////////////////////////
    //Insertion for all Forms in the DB
    function  insertData($FormDataToInsert,$tablename){


        $this->db->insert($tablename,$FormDataToInsert);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    //Insert User
    function  insertUser($insertUserData){

        $this->db->insert("systemusers",$insertUserData);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    ///////////////////////////////////////////////////
    //Update for ALL Form Data
    //jovRi

    


public   function  updateData($FormDataToUpdate,$FormDataToUpdate2, $tablename, $id,$userlogs){

    //exit('hey....'.$FormDataToUpdate['TotalAmountOfAllClouds'] );
    $user=$userlogs['User'];
    $UserRole=$userlogs['UserRole'];
    $Action=$userlogs['Action'];
    $Details=$userlogs['Details'];
    $station=$userlogs['station'];
    $IP=$userlogs['IP'];

    $session_data = $this->session->userdata('logged_in');
        $updater_id=$session_data['Userid'];
        //$this->db->query("SET @var1= $name");
        $this->db->query("SET @Userid= '$updater_id'");
        $this->db->query("SET @UserRole= '$UserRole'");
        $this->db->query("SET @Action= '$Action'");
        $this->db->query("SET @Details='$Details'");
        $this->db->query("SET @station= '$station'");
        $this->db->query("SET @IP= '$IP'");
    
    
    if($tablename=="stations"){
           $this->db->where('station_id',$id);
    }
        else{
          $this->db->where('id',$id);
        }

       //$this->db->where('id',$id);
        $this->db->update($tablename,$FormDataToUpdate);  

       
        
        if ($this->db->affected_rows() ==1)
        {
            //exit('true');
            return TRUE;
        }
        else
        {
            //exit('false');
            return FALSE;
        }
    }



    public function checkifApproved($id){
        $this->db->select('ApprovedBy');
        $this->db->from('observationslip');
        $this->db->where("id",$id);
       $this->db->limit(1); 
       $query= $this->db->get();
       
           
                
       
        if($query->num_rows()>0){
            
            $val=$query->row();
            $value=$val->ApprovedBy;
            return $value;
    
        }
        else
        {
            return "none";
        }
    
    }

    //Update the User
      //jovRi
public    function  updateUser($updateUserData,$updateUserData2,$tablename,$id,$id2,$userlogs){

    $user=$userlogs['User'];
    $UserRole=$userlogs['UserRole'];
    $Action=$userlogs['Action'];
    $Details=$userlogs['Details'];
    $station=$userlogs['station'];
    $IP=$userlogs['IP'];

    $session_data = $this->session->userdata('logged_in');
        $usersid=$session_data['Userid'];
        $this->db->query("SET @Userid= '$usersid'");
        $this->db->query("SET @UserRole= '$UserRole'");
        $this->db->query("SET @Action= '$Action'");
        $this->db->query("SET @Details='$Details'");
        $this->db->query("SET @station= $station");
        $this->db->query("SET @IP= '$IP'");
        
        $this->db->where("Userid",$id);
        $this->db->update($tablename,$updateUserData);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;

        }
        else
        {
            return FALSE;
        }
    }
    ///////////////////////////////////////////////////////
    //Delete for all Forms
  public  function  deleteData($tablename,$deleteFormDataId){ 
        if ($tablename=="stations"){  //$tablename and id of the record
           $deletesql = "DELETE FROM $tablename WHERE station_id =? ";
		}else{
			 $deletesql = "DELETE FROM $tablename WHERE id =? ";
		}
        // Run the query
        $this->db->query($deletesql, array($deleteFormDataId));
        //return $this->db->affected_rows();
        // $query = $this->db->get();
        if($this->db->affected_rows() == 1)
        {
            //$result = $query->result();
            return TRUE;
            //return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
    //Delete for a user
    function  deleteUser($tablename,$deleteUserId){  //$tablename,id of the row
      $data=array('Active' => 0);

      $this->db->set($data);
      $this->db->where("userid",$deleteUserId);
      $this->db->update($tablename, $data);

        if($this->db->affected_rows() == 1)
        {
            return TRUE;
            //return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    //Activate a user by manager
    function  activateUser($tablename,$activeUserId){  //$tablename,id of the row
        $data=array('Active' => 1);
  
        $this->db->set($data);
        $this->db->where("userid",$activeUserId);
        $this->db->update($tablename, $data);
  
          if($this->db->affected_rows() == 1)
          {
              return TRUE;
              //return $query->result();
          }
          else
          {
              return FALSE;
          }
      }


    /////////////////////////////////////////////////////////////
//jov
    public function selectById($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        if($tablename=="stations"){
          $this->db->from($tablename);
          $this->db->where($field, $value);
          $this->db->order_by($field, "desc");
        }
          else{
          $this->db->from($tablename.' as tab');
          $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
          $this->db->where('tab.'.$field, $value);
          $this->db->order_by('tab.'.$field, "desc");

        }

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    public function selectByIdZonalOfficer($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id');

        $this->db->where('user.'.$field, $value);
        $this->db->where('user.UserRole', "ZonalOfficer");
        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() >= 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    public function selectByIdZonalOfficer_andOC($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id');

        $this->db->where('user.'.$field, $value);
        $this->db->where('user.UserRole', "ZonalOfficer");
        $this->db->or_where('user.UserRole', "OC");
        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() >= 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
              //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    public function selectByIdOC($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id');

        $this->db->where('user.'.$field, $value);
        $this->db->where('user.UserRole', "OC");

        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() >= 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
              //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //jovRi
    public function selectUserById($value, $field, $tablename){  //$value, $field,$table
        
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id','left');
        $this->db->where('user.'.$field, $value);
        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }



    


//jovRi
    function checkforDuplicateUserDetails($firstname, $surname,$email,$stationName,$stationNumber,$stationRegion,$userRoleAssigned) {
        
        $this->db->select('*');
        $this->db->from('systemusers as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id','left');
        $this->db->where('user.UserRole', $userRoleAssigned);
        $this->db->where('user.UserEmail', $email);

        /*$this->db->where('user.FirstName', $firstname);
        !empty($observationslipdataforspecifictimeofaday)
        $this->db->where('user.SurName', $surname);
        if($stationName=="NULL" && $stationNumber=="NULL" ){

           $this->db->where('user.region_zone', $stationRegion);
        }else if(!empty($stationName) && !empty($stationNumber) && empty($stationRegion)){

           $this->db->where('stationsdata.StationName', $stationName);
           $this->db->where('stationsdata.StationNumber', $stationNumber);
        }*/



        $this->db->order_by("user.Userid", "desc");
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() ==1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }



////////////////////////////////////////////////////////////////////////////////


    function generateUniqueUsername($username,$surname,$counter){
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('UserName', $username);

        $this->db->order_by("Userid", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        foreach($query -> row() as $row)
        {
            $alphabet = str_split('abcdefghijklmnopqrstuvwxyz');
                //shuffle($seed);
                //$rand = '';
                //foreach (array_rand($seed, 1) as $k) $rand .= $seed[$k];
                $counter++;
            $newsurname=firstcharlowercase($surname);
            $trialname=$alphabet[$counter].'.'.$newsurname; 
            if($counter<26){
             return $this->generateUniqueUsername($trialname,$newsurname,$counter);
            }
            else{
                return false;
            }
                 
        }

        return $username;
        
    }




    function checkIfUserNameExistsAlreadyInDB($username) {
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('UserName', $username);

        $this->db->order_by("Userid", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

///////////////////////////////////////////////////////////////////////////////

    function  deleteUserLogs($DeleteUserLogsId){
        $deletesql = "DELETE FROM logs WHERE id =? ";
        $this->db->query($deletesql, array($DeleteUserLogsId));
        return $this->db->affected_rows();
    }
    function show($table) {

        $query = $this->db->query("SELECT * FROM $table order by id desc " );
        $result = $query->result();
        return $result;
    }


    
    ////////////////////////
    //Select Reports for Certain Forms
    //OBSERVATION SLIP DATA
    public function selectObservationSlipReportForSpecificTimeOfADay($timeInZoo,$date,$stationName,$stationNumber,$tablename){
        
        $this->db->select('*');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        if($approve != 0 && $approve != FALSE){
            $this->db->join('systemusers as users', 'report.ApprovedBy = users.Userid');
        }
        
        $timeInZoo0=explode(":",$timeInZoo);
        $timeInZoo1=$timeInZoo0[0].$timeInZoo0[1];
        $timeInZoo0=explode(" ",$timeInZoo);
        $timeInZoo2=($timeInZoo0[0]<10?"0":"").$timeInZoo0[0].$timeInZoo0[1];
        $timeInZoo0=explode(":",$timeInZoo2);
        $timeInZoo3=$timeInZoo0[0].$timeInZoo0[1];

//die($timeInZoo3.$timeInZoo2);

        $this->db->where('report.TIME', $timeInZoo3);
        $this->db->where('report.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->or_where('report.TIME', $timeInZoo2);
        $this->db->where('report.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }

    //METAR REPORT FOR A SPECIFIC DAY FROM OBSERVATION SLIP
    //jovRi
      public function selectMetarReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,$tablename){
          $this->db->select('*');
          $this->db->from($tablename.' as report');
          $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

          $this->db->where('report.Date', $date);
          $this->db->where('stationsdata.StationName', $stationName);
          $this->db->where('stationsdata.StationNumber', $stationNumber);
          $this->db->order_by('report.TIME','ASC'); //small to big
          //$this->db->limit(1);

  // Run the query
        $query = $this->db->get();


        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }
    public function selectSpeciReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

      //  $this->db->where('report.Date', $date);
        $this->db->order_by('report.TIME','ASC'); //small to big
        $this->db->where('report.speciOrMetar', 'speci');

// Run the query
      $query = $this->db->get();


      if($query -> num_rows() > 0)
      {
          $result = $query->result();  //$query -> result_array();
          return $result;
          //return $query->result();
      }
      else
      {
          //$results = $query->result();
          return false;
      }



  }

    /////////////////////////////////////////////////START FOR WEATHER SUMMARY REPORT FROM OBSERVATION SLIP TABLE AND METAR TABLE
    //WEATHER SUMMARY REPORT  NOT DIRECT.
    //FOR 0600Z TIME FROM OBSERVATION SLIP
    //jovRi
    public function selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall,CLP,WindRun,sunduration',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];

            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('report.TIME', $time);
        $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    //WEATHER SUMMARY REPORT
    //FOR 0600Z TIME FROM MORE FORM FIELDS
    //jovRi
    public function selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StandardIsobaricSurface,VapourPressure',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('report.TIME', $time);



        $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    /////////////////////////////////////END OF WEATHER SUMMARY REPORT PICK DATA FROM OBSERVTION SLIP AND METAR.
//////////////////////////////////////////////////////////////START FOR DEKADAL REPORT PICK DATA FROM OBSERVATION SLIP
    //PICK DEKADAL REPORT DATA FROM OBSERVATION SLIP TABLE FOR 0600Z(9.00 AM) AND 1200Z(3.00 PM)
    //START WITH TIME 0600Z.
    //jovRi
    public function selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
        $this->db->where('report.TIME', $time);

        $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    ////////////////////////////////////////////////////////////END OF DEKADAL REPORT PICK DATA FROM DIFFERENT TABLES

//START FOR PICK DATA FROM OBSERVATION SLIP FOR MONTHLY RAINFALL REPORT
    //MONTHLY RAINFALL REPORT.
    public function  selectMonthlyRainfallReportForAMonthFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from('observationslip as data');
        $this->db->join('stations as stationsdata', 'data.station = stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='ManagerData' || $userrole=='Manager'){

            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(data.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(data.Date)', $year);
        $this->db->where('data.TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(data.Date)','ASC');

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }


    }
//pick custom rainfall report data i.e rainfall data for a given interval of dates
public function  selectCustomisedRainfallReportFromObservationSlipTable($dateOne,$dateTwo,$stationName,$stationNumber,$tablename){
    $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

    $this->db->from('observationslip as data');
    $this->db->join('stations as stationsdata', 'data.station = stationsdata.station_id');

    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'){

        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

    }elseif($userrole=='OC'){
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

    }

    $this->db->where('data.Date >=', $dateOne);
    $this->db->where('data.Date <=', $dateTwo);
    $this->db->where('data.TIME','0600Z');

    $this->db->order_by('DAYOFMONTH(data.Date)','ASC');

    // Run the query
    $query = $this->db->get();
    if($query -> num_rows() > 0)
    {
        $result = $query->result();  //$query -> result_array();
        return $result;
        //return $query->result();
    }
    else
    {
        //$results = $query->result();
        return false;
    }


}

//END FOR PICK DATA FROM OBSERVATION SLIP FOR YEARLY RAINFALL REPORT
//////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////START FOR SYNOPTIC REPORT PICK DATA FROM OBSERVATION SLIP AND THE MORE FORM FIELDS TABLE
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0000Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,
        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,
        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,
        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
        CloudSearchLightReading,Rainfall,
         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,
        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,
        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0000Z'); //small to big
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0300Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0300Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0600Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0600Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
        CloudSearchLightReading,Rainfall,
         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,
        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,
        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0600Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0900Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0900Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0900Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

    
//update the observation slip data for ms from false to true 
public  function  updateApproval($id,$data){
    $this->db->where("id",$id);
    $this->db->update("observationslip",$data);
    if ($this->db->affected_rows() ==1)
    {
        return TRUE;

    }
    else
    {
        return FALSE;
    }
}
//update the archive  slips data for ms from false to true 
public  function  updateApproval1($id,$data,$table){
    $this->db->where("id",$id);
    $this->db->update($table,$data);
    if ($this->db->affected_rows() ==1)
    {
        return TRUE;

    }
    else
    {
        return FALSE;
    }
}
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 1200Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','1200Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 1500Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1500Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','1500Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 1800Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1800Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','1800Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 2100Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime2100Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Present_WeatherCode,Past_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','2100Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0000Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0000Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0000Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE  TIME 0300Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0300Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0300Z'); //small to big
        $this->db->limit(1);

        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0600Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0600Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);



        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0600Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0900Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0900Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);



        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','0900Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 1200Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1200Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);


        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','1200Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 1500Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1500Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','1500Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 1800Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1800Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','1800Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 2100Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable2100Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
        Supp_Info,VapourPressure,T_H_Graph',FALSE);


        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','2100Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
//////////////////////////////////////////////END OF LIVE FORMS INPUT REPORTS

    ///ARCHIVED FORMS REPORT DB QUERIES START HERE. DIRECT FROM THE DB TABLE

    //ARCHIVED OBSERVATION SLIP  DATA FORM.   //FROM THE TABLE IN THE DB
    //jovRi
    public function selectArchivedObservationSlipFormReportForSpecificTimeOfADay($timeInZoo,$date,$stationName,$stationNumber,$tablename){

        $this->db->select('*');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $this->db->where('archived.Date', $date);
        $this->db->where('archived.TIME', $timeInZoo);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }

    ///////////////////////////////////ARCHIVED METAR FORM FROM THE DB. DIRECT FROM THE DB TABLE
    // ARCHIVED METAR REPORT FOR A SPECIFIC DAY
      //jovRi
    public function selectArchivedMetarFormReportForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->order_by('archived.TIME','ASC'); //small to big

        // Run the query
        $query = $this->db->get();  //WE GET MORE THAN ONE ROW.SAME DAY BUT AT DIFFERENT TIMES.ORDER BY THE TIME

        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }
    //////////////////////////
    // ARCHIVED WEATHER SUMMARY  FORM REPORT. DIRECT FRM THE DB TABLE.JUST AS IT IS.
    //jovRi
    public function selectArchivedWeatherSummaryFormDataReportForAMonth($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TEMP_MAX,TEMP_MIN,SUNSHINE,
        DB_0600Z,WB_0600Z,DP_0600Z,VP_0600Z,RH_0600Z,CLP_0600Z,GPM_0600Z,WIND_DIR_0600Z,FF_0600Z,
        DB_1200Z,WB_1200Z,DP_1200Z,VP_1200Z,RH_1200Z,CLP_1200Z,GPM_1200Z,WIND_DIR_1200Z,FF_1200Z,
        WIND_RUN,R_F,ThunderStorm,Fog,Haze,HailStorm,EarthQuake',FALSE);



        //$this->db->from('archiveweathersummaryformreportdata');
          $this->db->from($tablename.' as archived');
          $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){
          $this->db->where('stationsdata.StationName', $stationName);
          $this->db->where('stationsdata.StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
          $this->db->where('stationsdata.StationName', $stationName);
          $this->db->where('stationsdata.StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber);  //Month as a Number eg.1,2
        $this->db->where('YEAR(archived.Date)', $year);

        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC');  //FRM THE SMALLEST DAY(ONE) TO BIGGEST DAY(LAST)

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    /////////////////////////////////////////////////////////
    ////////////////////////
    //ARCHIVED DEKADAL REPORT FOR ANY TEN DAYS OF A SAME MONTH. DIRECT FROM THE DB TABLE.
    //jovRi
    public function selectArchivedDekadalFormDataReportForAnyTenDaysOfAMonth($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        MAX_TEMP,MIN_TEMP,
        DRY_BULB_0600Z,WET_BULB_0600Z,DEW_POINT_0600Z,RELATIVE_HUMIDITY_0600Z,WIND_DIRECTION_0600Z,WIND_SPEED_0600Z,
        RAINFALL_0600Z,
        DRY_BULB_1200Z,WET_BULB_1200Z,DEW_POINT_1200Z,RELATIVE_HUMIDITY_1200Z,WIND_DIRECTION_1200Z,WIND_SPEED_1200Z,
        ',FALSE);


        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(archived.Date)', $year);
        $this->db->where('DATE(archived.Date) >= ',$fromdate);
        $this->db->where('DATE(archived.Date) <= ',$todate);
        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC');

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //////////////////////////////////ARCHIVED MONTHLY RAINFALL FROM DB
    // GET THE ARCHIVED MONTHLY RAINFALL REPORT. DIRECT FRM THE DB TABLE.
    //jovRi
    public function  selectArchivedMonthlyRainfallFormReportForAMonthFromArchiveMonthlyRainfallFormTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
      //  $session_data = $this->session->userdata('logged_in');
      //  $userrole=$session_data['UserRole'];
      $this->db->where('stationsdata.StationName', $stationName);
      $this->db->where('stationsdata.StationNumber', $stationNumber);


        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber); //MONTH NUMBER 1 FOR JAN
        $this->db->where('YEAR(archived.Date)', $year); //YR LIKE 2016,2017


        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC'); //DAY OF MONTH LIKE 1 ,2 3.


        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }


    }
    /////////////////////////////////////////////////////////
    //////ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month). FROM THE ARCHIVED MONTHLY RAINFALL DATA FOR A MONTH
    /// ARCHIVED START WITH JAN.
//jovRi
    public function  selectArchivedMonthlyRainfallReportForTheMonth($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
      //  $session_data = $this->session->userdata('logged_in');
      //  $userrole=$session_data['UserRole'];
      $this->db->where('stationsdata.StationName', $stationName);
      $this->db->where('stationsdata.StationNumber', $stationNumber);


        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(archived.Date)', $year);


        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC');


        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
      //jovRi

    public function selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(archived.Date) as DayOfTheMonth,
         archived.Date, archived.Time, archived.UWS, archived.BN,  archived.IOOP, archived.TSPPW, archived.HLC,
         archived.HV, archived.TCC, archived.WD, archived.WS, archived.GI1_1, archived.SignOfData_1, archived.Air_temperature, archived.GI2_1, archived.SignOfData_2,
         archived.Dewpoint_temperature, archived.GI3_1, archived.PASL, archived.GI4_1, archived.SIS, archived.GSIS, archived.GI6_1, archived.AOP, archived.DPOP, archived.GI7_1,
         archived.Present_Weather, archived.Past_Weather, archived.GI8_1, archived.AOC, archived.CLOG, archived.CGOG, archived.CHOG, archived.Section_Indicator333, archived.GI0_1,
          archived.GMT, archived.CIOP, archived.BEOP, archived.ThunderStorm, archived.HailStorm, archived.Fog, archived.EarthQuake, archived.Anemometer_Reading, archived.Actual_Rainfall, archived.GI1_2,
           archived.SignOfData_3, archived.Max_TempTx, archived.GI2_2, archived.SignOfData_4, archived.Max_TempTn, archived.GI5_1, archived.AOE, archived.ITI, archived.GI55, archived.DOS,
           archived.GI5_2, archived.SPC, archived.PCI24Hrs, archived.GI6_2, archived.AOP_2, archived.DPOP_2, archived.GI8_2, archived.AICL, archived.GOC, archived.HBCLOM, archived.GI8_3, archived.AICL_2,
           archived.GOC_2, archived.HBCLOM_2, archived.GI8_4, archived.AICL_3, archived.GOC_3, archived.HBCLOM_3, archived.GI8_5, archived.AICL_4, archived.GOC_4, archived.HBCLOM_4, archived.GI9,
           archived.Supp_Info, archived.Section_Indicator555, archived.GI1_3, archived.SignOfData_5, archived.Wetbulb_Temp, archived.R_Humidity,
           archived.V_Pressure, archived.Approved, archived.SubmittedBy, archived.CreationDate',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME',$time);
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

public function identifyStationById($stationName,$stationNumber){

    $this->db->select('station_id');
    $this->db->from("stations");
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);
    $this->db->limit(1);

    $query = $this->db->get();
    $row = $query->row();
  if (isset($row))
    {
        return  $row->station_id;
        //return $query->result();
    }
    else
    {
        //$results = $query->result();
        return false;
    }

}

    //////////////////////////////////////////////////////////////////////////
    ///// SEARCH FOR ARCHIVED SCANNED DATA STARTS HERE
    ///METAR FORM
    ///////////////////////////////////
    // ARCHIVED SCANNED METAR FORM DETAILS FOR A SPECIFIC DAY
    public function selectArchivedScannedMetarFormForSpecificDay($date,$stationName,$stationNumber,$tablename){
       $station= $this->identifyStationById($stationName,$stationNumber);
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->join('stations', 'stations.station_id = '.$tablename.'.station');
        $this->db->where( $tablename.'.station',$station);
        $this->db->where($tablename.'.Form_scanned', 'metarreport');////Only metars should be fetched
        $this->db->where($tablename.'.form_date', $date);
        $this->db->limit(1);



        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }
    // ARCHIVED SCANNED SYNOPTIC FORM DETAILS FOR A SPECIFIC DAY
    //jovRi
    public function selectArchivedScannedSynopticFormReportDetailsForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_daily as archived');
        $this->db->join('stations', 'stations.station_id = archived.station');
        $this->db->where('archived.Form_scanned', 'synopticform');
          $this->db->where('archived.form_date', $date);
        $this->db->where('stations.StationName', $stationName);
        $this->db->where('stations.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }
    // ARCHIVED SCANNED OBSERVATION SLIP FORM DETAILS FOR A SPECIFIC DAY
    public function selectArchivedScannedObservationSlipFormDetailsForSpecificDay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber){
      $this->db->select('*');
      $this->db->from('scans_daily');
      $this->db->join('stations', 'stations.station_id = scans_daily.station');
    // $this->db->where('stations.StationNumber', $stationNumber);
      //$this->db->where('stations.StationName', $stationName);
      $this->db->where('scans_daily.Form_scanned', 'observationslip');
        $this->db->where('scans_daily.form_date', $date);
        $this->db->where('scans_daily.TIME', $ObservationslipTimeInZoo);

        $this->db->limit(1);



        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }

    //ARCHIVED SCANNED DEKADAL FORM REPORT FOR A GIVEN RANGE IN A MONTH
    //jovRi
    public function selectArchivedScannedDekadalFormReportDetailsForAGivenRangeInAMonth($fromdate,$todate,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_dekadals as scanned');
        $this->db->join('stations', 'stations.station_id =  scanned.station');

        $this->db->where('scanned.from_date', $fromdate);
        $this->db->where('scanned.to_date', $todate);
        $this->db->where('stations.StationName', $stationName);
        $this->db->where('stations.StationNumber', $stationNumber);
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

}

//jovRi
  public function getMonthNumber($monthStr) {
  //e.g, $month='Jan' or 'January' or 'JAN' or 'JANUARY' or 'january' or 'jan'
  $m = ucfirst(strtolower(trim($monthStr)));
  $m0=0;
  switch ($m) {
    case "January":
    case "Jan":
        $m0 = 1;
        break;
    case "Febuary":
    case "Feb":
      $m0 = 2;
        break;
    case "March":
    case "Mar":
        $m0= 3;
        break;
    case "April":
    case "Apr":
        $m0 = 4;
        break;
    case "May":
        $m0 = 5;
        break;
    case "June":
    case "Jun":
        $m0 = 6;
        break;
    case "July":
    case "Jul":
        $m0 = 7;
        break;
    case "August":
    case "Aug":
        $m0 = 8;
        break;
    case "September":
    case "Sep":
        $m0 = 9;
        break;
    case "October":
    case "Oct":
        $m0 = 10;
        break;
    case "November":
    case "Nov":
        $m0 = 11;
        break;
    case "December":
    case "Dec":
        $m0 = 12;
        break;
    default:
        $m0 = 0;
        break;
  }
  return $m0;
  }
    //ARCHIVED SCANNED WEATHER SUMMARY FORM REPORT FOR A  A MONTH
    //jovRi
    public function selectArchivedScannedWeatherSummaryFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_monthly as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $this->db->where('archived.month', $this->DbHandler->getMonthNumber($month));
        $this->db->where('archived.Year', $year);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);
       // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

    //ARCHIVED SCANNED Monthly Rainfall FORM REPORT FOR A  A MONTH
    //jovRi
    public function selectArchivedScannedMonthlyRainfallFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_monthly as scanned');
        $this->db->join('stations as stationsdata', 'scanned.station = stationsdata.station_id');

        $this->db->where('scanned.month', $this->DbHandler->getMonthNumber($month));
        $this->db->where('scanned.year', $year);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);



        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }

    //ARCHIVED SCANNED Monthly Rainfall FORM REPORT FOR A  A MONTH
    //jovRi
    public function selectArchivedScannedYearlyRainfallFormReportDataDetailsForAYear($year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from('scans_yearly as scanned');
        $this->db->join('stations as stationsdata', 'scanned.station = stationsdata.station_id');


        $this->db->where('scanned.Year', $year);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }





}

?>
