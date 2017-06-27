<?php
class DbHandler extends CI_Model {

    function __construct() {
        parent::__construct();

    }

    function getUserLogInDetails($username, $password) {
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('userName', $username);
        $this->db->where('UserPassword', $password);
        $this->db->order_by("userid", "desc");
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
    function  saveUserLogs($userlogsdata){
        // if($this->db->insert("logs",$userlogsdata)){

        $this->db->insert("logs", $userlogsdata);

        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function selectAllSystemUsers($value, $field,$table){
        $this->db->select('*');
        $this->db->from($table);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where($field, $value);

        }elseif($userrole=='OC'){

            //$this->db->where($field, $value);

        }

        $this->db->order_by("Userid", "desc");
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
        $this->db->order_by("id", "desc");
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
    function checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

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
    function checkInDBIfUserDetailsRecordExistsAlready($firstname,$surname,$email,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('FirstName', $firstname);
        $this->db->where('SurName', $surname);
        $this->db->where('UserStation', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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
        $this->db->from($tablename);
        $this->db->where('DATE', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME', $time);
        $this->db->where('METARSPECI', $metarOption);
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
//Select all from the tables in the DB.
    public function selectAll($value, $field,$table){ //$stationame ,field StationName
        $this->db->select('*');
        $this->db->from($table);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$firstname=$session_data['FirstName'];
        // $SurName= $session_data['SurName'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

           // $this->db->where("DATE_SUB(NOW(),INTERVAL 2 DAYS", null);
            //event_start_date <= DATE_ADD(NOW(),INTERVAL 7 DAYS)', null

        }elseif($userrole=='OC' ){

            $this->db->where($field, $value);

            //$this->db->where("NOW()<=DATE_ADD(CreationDate,INTERVAL 2 DAYS", null);

        }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){

          //  $this->db->where("CreationDate", $value);
            $this->db->where($field, $value);
            //$this->db->where('FirstName', $firstname);
            //$this->db->where('SurName', $SurName);
          //  $this->db->where('CreationDate <', date('Y-m-d H:i:s', strtotime('-24 hours')));

        }
       // WHERE creation_date >= DATE_SUB(NOW(),INTERVAL 15 MINUTE)

        $this->db->order_by("id", "desc");
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
    function  updateData($FormDataToUpdate,$tablename,$id){
        $this->db->set($FormDataToUpdate);
        $this->db->where("id",$id);

        $this->db->update($tablename,$FormDataToUpdate);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    //Update the User
    function  updateUser($updateUserData,$tablename,$id){
        $this->db->set($updateUserData);
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
    function  deleteData($tablename,$deleteFormDataId){  //$tablename and id of the record
        $deletesql = "DELETE FROM $tablename WHERE id =? ";

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
        $deletesql = "DELETE FROM $tablename WHERE Userid =? ";
        $this->db->query($deletesql, array($deleteUserId));
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
    /////////////////////////////////////////////////////////////

    public function selectById($value, $field, $table){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
        $this->db->order_by("id", "desc");
        //$this->db->limit(1);
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
    public function selectUserById($value, $field, $table){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
        $this->db->order_by("Userid", "desc");
        //$this->db->limit(1);
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
//////////////////////////////////////////////////////////////////////////////
    function checkforDuplicateUserDetails($firstname, $surname,$email) {
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('FirstName', $firstname);
        $this->db->where('SurName', $surname);
        $this->db->where('UserEmail', $email);
        $this->db->order_by("userid", "desc");
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
        $this->db->from($tablename);
        $this->db->where('TIME', $timeInZoo);
        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        //$this->db->order_by("userid", "desc");
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
    ///////////////////////////////////
    //METAR REPORT FOR A SPECIFIC DAY
    public function selectMetarReportForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('metar');
        //$this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->order_by('TIME','ASC'); //small to big
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
    /////////////////////////////////////////////////START FOR WEATHER SUMMARY REPORT FROM OBSERVATION SLIP TABLE AND METAR TABLE
    //WEATHER SUMMARY REPORT  NOT DIRECT.
    //FOR 0600Z TIME FROM OBSERVATION SLIP
    public function selectWeatherSummaryDataReportForAMonthFromObservationSlipTableFor0600Z($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall,CLP',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);

        $this->db->where('TIME', '0600Z');



        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///////////////////////////
    //WEATHER SUMMARY REPORT
    //FOR 1200Z TIME FROM OBSERVATION SLIP
    public function selectWeatherSummaryDataReportForAMonthFromObservationSlipTableFor1200Z($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall,CLP',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);

        $this->db->where('TIME', '1200Z');



        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    //WEATHER SUMMARY REPORT
    //FOR 0600Z TIME FROM MORE FORM FIELDS
    public function selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTableFor0600Z($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StandardIsobaricSurface,DurationOfSunshine,VapourPressure',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);

        $this->db->where('TIME', '0600Z');



        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    //WEATHER SUMMARY REPORT
    //FOR 1200Z TIME FROM MORE FORM FIELDS
    public function selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTableFor1200Z($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StandardIsobaricSurface,DurationOfSunshine,VapourPressure',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);

        $this->db->where('TIME', '1200Z');



        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    /////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////END OF WEATHER SUMMARY REPORT PICK DATA FROM OBSERVTION SLIP AND METAR.

//////////////////////////////////////////////////////////////START FOR DEKADAL REPORT PICK DATA FROM OBSERVATION SLIP
    //PICK DEKADAL REPORT DATA FROM OBSERVATION SLIP TABLE FOR 0600Z(9.00 AM) AND 1200Z(3.00 PM)
    //START WITH TIME 0600Z.
    public function selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTableFor0600Z($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall',FALSE);


        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('DATE(Date) >= ',$fromdate);
        $this->db->where('DATE(Date) <= ',$todate);

        $this->db->where('TIME', '0600Z');



        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///////////PICK DEKADAL REPORT DATA FROM OBSERVATION SLIP TABLE FOR 0600Z(9.00 AM) AND 1200Z(3.00 PM).
    //DEKADAL REPORT DATA  FOR 1200Z
    public function selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTableFor1200Z($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('DATE(Date) >= ',$fromdate);
        $this->db->where('DATE(Date) <= ',$todate);

        $this->db->where('TIME', '1200Z');



        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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


    //////////////////////////////////////////////////////////////END OF DEKADAL REPORT PICK DATA FROM DIFFERENT TABLES

//START FOR PICK DATA FROM OBSERVATION SLIP FOR MONTHLY RAINFALL REPORT
    //MONTHLY RAINFALL REPORT.
    public function  selectMonthlyRainfallReportForAMonthFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
//END FOR PICK DATA FROM OBSERVATION SLIP FOR MONTHLY RAINFALL REPORT

/////////////////////////////////////////////////////////////////////////////////////////////////////////
//START FOR PICK DATA FROM OBSERVATION SLIP FOR YEARLY RAINFALL REPORT
//////YEARLY RAINFALL REPORT FOR A YEAR.
///START WITH JAN.

    public function  selectMonthlyRainfallReportForTheMonthOfJanuaryFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///START WITH FEB.
    public function  selectMonthlyRainfallReportForTheMonthOfFebruaryFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH MARCH.
    public function  selectMonthlyRainfallReportForTheMonthOfMarchFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH APRIL.
    public function  selectMonthlyRainfallReportForTheMonthOfAprilFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH MAY.
    public function  selectMonthlyRainfallReportForTheMonthOfMayFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///START WITH JUNE.
    public function  selectMonthlyRainfallReportForTheMonthOfJuneFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH JULY.
    public function  selectMonthlyRainfallReportForTheMonthOfJulyFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH AUGUST.
    public function  selectMonthlyRainfallReportForTheMonthOfAugustFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH SEPTEMBER.
    public function  selectMonthlyRainfallReportForTheMonthOfSeptemberFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH OCTOBER.
    public function  selectMonthlyRainfallReportForTheMonthOfOctoberFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH NOVEMBER.
    public function  selectMonthlyRainfallReportForTheMonthOfNovemberFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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

    ///START WITH DECEMBER.
    public function  selectMonthlyRainfallReportForTheMonthOfDecemberFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        $this->db->from('observationslip');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
//END FOR PICK DATA FROM OBSERVATION SLIP FOR YEARLY RAINFALL REPORT
//////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////START FOR SYNOPTIC REPORT PICK DATA FROM OBSERVATION SLIP AND THE MORE FORM FIELDS TABLE
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0000Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0000Z'); //small to big
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
    //FROM OBSERVATION SLIP TABLE TIME 0300Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0300Z'); //small to big
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

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0600Z'); //small to big
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

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0900Z'); //small to big
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
    //FROM OBSERVATION SLIP TABLE TIME 1200Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
         TotalAmountOfAllClouds,TotalAmountOfLowClouds,

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1200Z'); //small to big
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

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1500Z'); //small to big
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

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1800Z'); //small to big
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

        TypeOfLowClouds,OktasOfLowClouds,HeightOfLowClouds,CLCODEOfLowClouds,

        TypeOfMediumClouds,OktasOfMediumClouds,HeightOfMediumClouds,CLCODEOfMediumClouds,

        TypeOfHighClouds,OktasOfHighClouds,HeightOfHighClouds,CLCODEOfHighClouds,

        CloudSearchLightReading,Rainfall,

         Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
         TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


        Present_Weather,Visibility,Wind_Direction,Wind_Speed,Gusting,

        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','2100Z'); //small to big
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
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0000Z'); //small to big
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
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0300Z'); //small to big
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
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0600Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0600Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0600Z'); //small to big
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
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0900Z'); //small to big
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
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);


        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1200Z'); //small to big
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
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1500Z'); //small to big
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
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1800Z'); //small to big
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
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
        TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
        StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
        Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
        IndicatorOfTypeOfIntrumentation,DurationOfSunshine,SignOfPressureChange,
        Supp_Info,VapourPressure,Wind_Run,T_H_Graph',FALSE);
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','2100Z'); //small to big
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
    public function selectArchivedObservationSlipFormReportForSpecificTimeOfADay($timeInZoo,$date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('TIME', $timeInZoo);
        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        //$this->db->order_by("userid", "desc");
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
    public function selectArchivedMetarFormReportForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('archivemetarformdata');
        $this->db->from($tablename);  //INCASE YOU CHG THE TABLE IN THE DB

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->order_by('TIME','ASC'); //small to big

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
    public function selectArchivedWeatherSummaryFormDataReportForAMonth($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TEMP_MAX,TEMP_MIN,SUNSHINE,
        DB_0600Z,WB_0600Z,DP_0600Z,VP_0600Z,RH_0600Z,CLP_0600Z,GPM_0600Z,WIND_DIR_0600Z,FF_0600Z,
        DB_1200Z,WB_1200Z,DP_1200Z,VP_1200Z,RH_1200Z,CLP_1200Z,GPM_1200Z,WIND_DIR_1200Z,FF_1200Z,
        WIND_RUN,R_F,ThunderStorm,Fog,Haze,HailStorm,EarthQuake',FALSE);


        //$this->db->from('archiveweathersummaryformreportdata');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);  //Month as a Number eg.1,2
        $this->db->where('YEAR(Date)', $year);

        $this->db->order_by('DAYOFMONTH(Date)','ASC');  //FRM THE SMALLEST DAY(ONE) TO BIGGEST DAY(LAST)

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
    public function selectArchivedDekadalFormDataReportForAnyTenDaysOfAMonth($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        MAX_TEMP,MIN_TEMP,
        DRY_BULB_0600Z,WET_BULB_0600Z,DEW_POINT_0600Z,RELATIVE_HUMIDITY_0600Z,WIND_DIRECTION_0600Z,WIND_SPEED_0600Z,
        RAINFALL_0600Z,
        DRY_BULB_1200Z,WET_BULB_1200Z,DEW_POINT_1200Z,RELATIVE_HUMIDITY_1200Z,WIND_DIRECTION_1200Z,WIND_SPEED_1200Z,
        ',FALSE);


        //$this->db->from('archivedekadalformreportdata');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);
        $this->db->where('DATE(Date) >= ',$fromdate);
        $this->db->where('DATE(Date) <= ',$todate);
        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    public function  selectArchivedMonthlyRainfallFormReportForAMonthFromArchiveMonthlyRainfallFormTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber); //MONTH NUMBER 1 FOR JAN
        $this->db->where('YEAR(Date)', $year); //YR LIKE 2016,2017


        $this->db->order_by('DAYOFMONTH(Date)','ASC'); //DAY OF MONTH LIKE 1 ,2 3.


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

    public function  selectArchivedMonthlyRainfallReportForTheMonthOfJanuary($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);


        //$this->db->from('archivemonthlyrainfallformreport');
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');


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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    //ARCHIVED FEB.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfFebruary($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];


        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///START WITH MARCH.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfMarch($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);
        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED APRIL.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfApril($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED MAY.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfMay($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');
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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED JUNE.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfJune($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

        // Run the query
        $query = $this->db->get();

        if($query -> num_rows() > 0) //GET DATA FOR A WHOLE MONTH FRM THE DB
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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED JULY.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfJuly($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED AUGUST.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfAugust($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED SEPTEMBER.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfSeptember($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED OCTOBER.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfOctober($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVED NOVEMBER.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfNovember($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    ///ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month).
    ///ARCHIVE DECEMBER.
    public function  selectArchivedMonthlyRainfallReportForTheMonthOfDecember($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from($tablename);

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'){

            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }elseif($userrole=='OC'){
            $this->db->where('StationName', $stationName);
            $this->db->where('StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(Date)', $year);


        $this->db->order_by('DAYOFMONTH(Date)','ASC');

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
    //FOR 0000Z
    public function selectArchivedSynopticFormReportDataForTime0000Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0000Z'); //small to big
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
    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 0300Z
    public function selectArchivedSynopticFormReportDataForTime0300Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0300Z');
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
    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 0600Z
    public function selectArchivedSynopticFormReportDataForTime0600Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0600Z');
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
    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 0900Z
    public function selectArchivedSynopticFormReportDataForTime0900Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','0900Z');
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
    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 1200Z
    public function selectArchivedSynopticFormReportDataForTime1200Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1200Z');
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
    /////ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 1500Z
    public function selectArchivedSynopticFormReportDataForTime1500Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog, EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1500Z'); //small to big
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
    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 1800Z
    public function selectArchivedSynopticFormReportDataForTime1800Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate ',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','1800Z'); //small to big
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
    /////ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
    //FOR 2100Z
    public function selectArchivedSynopticFormReportDataForTime2100Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        StationName, Date, Time, UWS, BN, StationNumber, IOOP, TSPPW, HLC,
         HV, TCC, WD, WS, GI1_1, SignOfData_1, Air_temperature, GI2_1, SignOfData_2,
         Dewpoint_temperature, GI3_1, PASL, GI4_1, SIS, GSIS, GI6_1, AOP, DPOP, GI7_1,
         Present_Weather, Past_Weather, GI8_1, AOC, CLOG, CGOG, CHOG, Section_Indicator333, GI0_1,
          GMT, CIOP, BEOP, ThunderStorm, HailStorm, Fog,EarthQuake, Anemometer_Reading, Actual_Rainfall, GI1_2,
           SignOfData_3, Max_TempTx, GI2_2, SignOfData_4, Max_TempTn, GI5_1, AOE, ITI, GI55, DOS,
            GI5_2, SPC, PCI24Hrs, GI6_2, AOP_2, DPOP_2, GI8_2, AICL, GOC, HBCLOM, GI8_3, AICL_2,
             GOC_2, HBCLOM_2, GI8_4, AICL_3, GOC_3, HBCLOM_3, GI8_5, AICL_4, GOC_4, HBCLOM_4, GI9,
              Supp_Info, Section_Indicator555, GI1_3, SignOfData_5, Wetbulb_Temp, R_Humidity,
               V_Pressure, Approved, SubmittedBy, CreationDate',FALSE);

        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('TIME','2100Z');
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
    ///ARCHIVED FORMS REPORT DB QUERIES ENDS HERE. DIRECT FROM THE DB TABLE



    //////////////////////////////////////////////////////////////////////////
    ///// SEARCH FOR ARCHIVED SCANNED DATA STARTS HERE
    ///METAR FORM
    ///////////////////////////////////
    // ARCHIVED SCANNED METAR FORM DETAILS FOR A SPECIFIC DAY
    public function selectArchivedScannedMetarFormForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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
    // ARCHIVED SCANNED SYNOPTIC FORM DETAILS FOR A SPECIFIC DAY
    public function selectArchivedScannedSynopticFormReportDetailsForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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
    public function selectArchivedScannedObservationSlipFormDetailsForSpecificDay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);

        $this->db->where('Date', $date);
        $this->db->where('TIME', $ObservationslipTimeInZoo);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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
    /////////////////////////////////////////////////
    //ARCHIVED SCANNED DEKADAL FORM REPORT FOR A GIVEN RANGE IN A MONTH
    public function selectArchivedScannedDekadalFormReportDetailsForAGivenRangeInAMonth($fromdate,$todate,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);

        $this->db->where('FromDate', $fromdate);
        $this->db->where('ToDate', $todate);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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

    //ARCHIVED SCANNED WEATHER SUMMARY FORM REPORT FOR A  A MONTH
    public function selectArchivedScannedWeatherSummaryFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);

        $this->db->where('Month', $month);
        $this->db->where('Year', $year);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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
    public function selectArchivedScannedMonthlyRainfallFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);

        $this->db->where('Month', $month);
        $this->db->where('Year', $year);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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
    public function selectArchivedScannedYearlyRainfallFormReportDataDetailsForAYear($year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from($tablename);


        $this->db->where('Year', $year);
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
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


    public function Login($email, $password){

        $query = $this->db->query("SELECT * FROM user where email='". $email ."' and password='". $password ."'");

        if ($query->num_rows() > 0)

            return false;   //Record in the DB

        else
            return true;  //No Record in the DB

    }


}
?>