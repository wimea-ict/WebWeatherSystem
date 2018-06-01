<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportsController extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');

    }

    public function initializeRainfallYearlyReport(){
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
        $this->load->view('yearlyRainfallReport',$data);

    }
    public function displayyearlyrainfallreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        //$month = $this->input->post('month');

        if($userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherAnalyst" || $userrole=="WeatherForecaster"){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayYearlyRainfallReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year);


        //Get Monthly Report Data for all the Months in a Given Year
        //Get for January    //$monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary
        $query1 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('01',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query1) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary'] = $query1;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary'] = array();
        }

        //Get Monthly Report Data for all the Months in a Given Year
        //Get for Month of February
        $query2 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('02',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query2) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary'] = $query2;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary'] = array();
        }

        //Get for Month of March
        $query3 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('03',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query3) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch'] = $query3;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch'] = array();
        }

        //Get for Month of April
        $query4 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('04',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query4) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril'] = $query4;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril'] = array();
        }

        //Get for Month of May
        $query5 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('05',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query5) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay'] = $query5;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay'] = array();
        }

        //Get for Month of June   //$monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune
        $query6 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('06',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query6) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune'] = $query6;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune'] = array();
        }

        //Get for Month of July
        $query7 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('07',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query7) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly'] = $query7;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly'] = array();
        }


        //Get for Month of August
        $query8 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('08',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query8) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust'] = $query8;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust'] = array();
        }


        //Get for Month of September
        $query9 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('09',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query9) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember'] = $query9;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember'] = array();
        }


        //Get for Month of October
        $query10 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('10',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query10) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober'] = $query10;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober'] = array();
        }


        //Get for Month of November
        $query11 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('11',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query11) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember'] = $query11;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember'] = array();
        }


        //Get for Month of December
        $query12 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('12',$year,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query12) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember'] = $query12;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember'] = array();
        }




        //Nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }





        $this->load->view('yearlyRainfallReport',$data);

    }


    //weather summary report methods
    public function initializeWeatherSummnaryReport(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        // $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

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

        $this->load->view('weatherSummaryReport',$data);
    }
    public function displayweathersummaryreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');

        if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        //Get the Month Selected As A Number.
        $monthAsANumberselected="";
        if($month=='January'){
            $monthAsANumberselected=1;

        }elseif($month=='February'){
            $monthAsANumberselected=2;

        }elseif($month=='March'){
            $monthAsANumberselected=3;

        }elseif($month=='April'){
            $monthAsANumberselected=4;

        }elseif($month=='May'){
            $monthAsANumberselected=5;

        }elseif($month=='June'){
            $monthAsANumberselected=6;

        }elseif($month=='July'){
            $monthAsANumberselected=7;

        }elseif($month=='August'){
            $monthAsANumberselected=8;

        }elseif($month=='September'){
            $monthAsANumberselected=9;

        }elseif($month=='October'){
            $monthAsANumberselected=10;

        }
        elseif($month=='November'){
            $monthAsANumberselected=11;

        }
        elseif($month=='December'){
            $monthAsANumberselected=12;

        }



        $data['displayWeatherSummaryReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year,'monthInWords'=>$month,'monthAsANumberselected'=>$monthAsANumberselected);




        /////Get Data From the OS TABLE,METAR TABLE,MORE FORM FIELDS FORM TABLE TO DISPLAY THE WEATHER SUMMARY FORM.
        //FROM OS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"0600Z");  //value,field,table
        if ($sqlquery1) {
            $data['observationslipdataforAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['observationslipdataforAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"1200Z");  //value,field,table
        if ($query1) {
            $data['observationslipdataforAMonthAndTime1200Z'] = $query1;
        } else {
            $data['observationslipdataforAMonthAndTime1200Z'] = array();
        }

         //FROM MORE FORM FIELDS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"0600Z");  //value,field,table
        if ($sqlquery2) {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = $sqlquery2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"1200Z");  //value,field,table
        if ($query2) {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = $query2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = array();
        }



        //nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $this->load->view('weatherSummaryReport',$data);

    }
    //Synoptic Report methods
    public function initializeSynopticReport(){
       // $this->unsetflashdatainfo();
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
        $this->load->view('synopticReport',$data);

    }
    public function displaysynopticreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $date = $this->input->post('date');
        //$month = $this->input->post('month');

        if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='OC'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displaySynopticReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);

        //FROM THE OBSERVATION SLIP KIP DATA FROM DIFFERENT TIMES.
        //FOR 0000Z
        $query1= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query1) {
            $data['synopticreportdataforADayFromObservationSlip0000Z'] = $query1;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0000Z'] = array();
        }

        //FOR 0600Z
        $query2= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query2) {
            $data['synopticreportdataforADayFromObservationSlip0300Z'] = $query2;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0300Z'] = array();
        }

        //FOR 0600Z
        $query3= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0600Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query3) {
            $data['synopticreportdataforADayFromObservationSlip0600Z'] = $query3;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0600Z'] = array();
        }

        //FOR 0900Z
        $query4= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0900Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query4) {
            $data['synopticreportdataforADayFromObservationSlip0900Z'] = $query4;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0900Z'] = array();
        }

        //FOR 1200Z
        $query5= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query5) {
            $data['synopticreportdataforADayFromObservationSlip1200Z'] = $query5;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1200Z'] = array();
        }

        //FOR 1500Z
        $query6= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1500Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query6) {
            $data['synopticreportdataforADayFromObservationSlip1500Z'] = $query6;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1500Z'] = array();
        }

        //FOR 1800Z
        $query7= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1800Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query7) {
            $data['synopticreportdataforADayFromObservationSlip1800Z'] = $query7;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1800Z'] = array();
        }

        //FOR 2100Z
        $query8= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime2100Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query8) {
            $data['synopticreportdataforADayFromObservationSlip2100Z'] = $query8;
        } else {
            $data['synopticreportdataforADayFromObservationSlip2100Z'] = array();
        }





        //FROM THE MORE FORM FIELDS TABLE KIP DATA FROM DIFFERENT TIMES.
        //FOR 0000Z
        $more_form_fields_table_query1= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0000Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query1) {
            $data['synopticreportdataforADayFrom_observationslipTable0000Z'] = $more_form_fields_table_query1;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0000Z'] = array();
        }

        //FOR 0300Z
        $more_form_fields_table_query2= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0300Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query2) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0300Z'] = $more_form_fields_table_query2;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0300Z'] = array();
        }

        //FOR 0600Z
        $more_form_fields_table_query3= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0600Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query3) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0600Z'] = $more_form_fields_table_query3;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0600Z'] = array();
        }

        //FOR 0900Z
        $more_form_fields_table_query4= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0900Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query4) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0900Z'] = $more_form_fields_table_query4;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0900Z'] = array();
        }

        //FOR 1200Z
        $more_form_fields_table_query5= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1200Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query5) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1200Z'] = $more_form_fields_table_query5;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1200Z'] = array();
        }

        //FOR 1500Z
        $more_form_fields_table_query6= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1500Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query6) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1500Z'] = $more_form_fields_table_query6;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1500Z'] = array();
        }

        //FOR 1800Z
        $more_form_fields_table_query7= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1800Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query7) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1800Z'] = $more_form_fields_table_query7;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1800Z'] = array();
        }

        //FOR 2100Z
        $more_form_fields_table_query8= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable2100Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query8) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable2100Z'] = $more_form_fields_table_query8;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable2100Z'] = array();
        }


        //nid to load stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $this->load->view('synopticReport',$data);

    }
  //sepci Report methods

      public function initializeSpeciReport(){
          $session_data = $this->session->userdata('logged_in');
          $userrole=$session_data['UserRole'];
          // $range = $this->input->post('range');



          if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
              $stationName =  $this->input->post('stationManager');
              $stationNumber =  $this->input->post('stationNoManager');

          }elseif($userrole=='OC'){
              $stationName = $this->input->post('stationOC');
              $stationNumber = $this->input->post('stationNoOC');

          }


          $data['displaySpeciReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
              'date'=>$date);

          //NID TO GET THE MONTH AND


          $userstation=$session_data['UserStation'];
  //////////////////////////////////////////////////////////////////////////////////
          //pick data from Observation slip for the Speci Report.
           $query = $this->DbHandler->selectSpeciReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,'observationslip');  //value,field,table

           if ($query) {
             $data['observationslipformdata'] = $query;
            } else {
              $data['observationslipformdata'] = array();
            }




          $this->load->view('speciReport',$data);
      }

//Observationslip Report methods

public function initialiseObservationSlipReport(){
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


//Monthly Rainfall report


public function initializeMonthlyRainfallReport(){
  //  $this->unsetflashdatainfo();
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

    $this->load->view('monthlyRainfallReport',$data);
}
public function displaymonthlyrainfallreport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];


    $year = $this->input->post('year');
    $monthselected = $this->input->post('month');



    if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
        $stationName =  $this->input->post('stationManager');
        $stationNumber =  $this->input->post('stationNoManager');

    }elseif($userrole=='OC'){
        $stationName = $this->input->post('stationOC');
        $stationNumber = $this->input->post('stationNoOC');

    }
    //Get the Month Selected As A Number.
    $monthAsANumberselected="";
    if($monthselected=='January'){
        $monthAsANumberselected=1;

    }elseif($monthselected=='February'){
        $monthAsANumberselected=2;

    }elseif($monthselected=='March'){
        $monthAsANumberselected=3;

    }elseif($monthselected=='April'){
        $monthAsANumberselected=4;

    }elseif($monthselected=='May'){
        $monthAsANumberselected=5;

    }elseif($monthselected=='June'){
        $monthAsANumberselected=6;

    }elseif($monthselected=='July'){
        $monthAsANumberselected=7;

    }elseif($monthselected=='August'){
        $monthAsANumberselected=8;

    }elseif($monthselected=='September'){
        $monthAsANumberselected=9;

    }elseif($monthselected=='October'){
        $monthAsANumberselected=10;

    }
    elseif($monthselected=='November'){
        $monthAsANumberselected=11;

    }
    elseif($monthselected=='December'){
        $monthAsANumberselected=12;

    }


    $data['displayMonthlyRainfallReportHeaderFields'] = array('stationName'=>$stationName,
        'stationNumber'=>$stationNumber,
        'year'=>$year,'monthInWords'=>$monthselected,'monthAsANumberselected'=>$monthAsANumberselected);




    //Get Monthly Report Data
    //$query = $this->DbHandler->selectMonthlyRainfallReportForAMonth($monthselected,$year,$stationName,$stationNumber,'dailyperiodicrainfall');  //value,field,table

    // if ($query) {
    //    $data['monthlyrainfallreportdata'] = $query;
    //} else {
    //    $data['monthlyrainfallreportdata'] = array();
    //}


    //Get Monthly Report Data
    $sqlquery = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table

    if ($sqlquery) {
        $data['monthlyrainfallreportdatafromObservationSlipTable'] = $sqlquery;
    } else {
        $data['monthlyrainfallreportdatafromObservationSlipTable'] = array();
    }





    //Nid to load the stations again

    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $this->load->view('monthlyRainfallReport',$data);

}
//Metar Report
public function initializeMetarReport(){
    //$this->unsetflashdatainfo();
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

    $this->load->view('metarReport',$data);
}
public function displaymetarreport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    // $range = $this->input->post('range');

    $date = $this->input->post('date');

    if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
        $stationName =  $this->input->post('stationManager');
        $stationNumber =  $this->input->post('stationNoManager');

    }elseif($userrole=='OC'){
        $stationName = $this->input->post('stationOC');
        $stationNumber = $this->input->post('stationNoOC');

    }


    $data['displayMetarReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'date'=>$date);

    //NID TO GET THE MONTH AND


    $userstation=$session_data['UserStation'];
//////////////////////////////////////////////////////////////////////////////////
    //pick data from Observation slip for the Metar Report.
     $query = $this->DbHandler->selectMetarReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,'observationslip');  //value,field,table

     if ($query) {
       $data['metarreportdataforADayFromObservationSlipTable'] = $query;
      } else {
        $data['metarreportdataforADayFromObservationSlipTable'] = array();
      }



/////////////////////////////////////////////////////////////////////////////////////////////////////
    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
/////////////////////////////////////////////
   // NID TO LOAD STATION INDICATORS
    $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,tablename
    if ($station_indicators_query) {
        $data['stationIndicatorData'] = $station_indicators_query;
    } else {
        $data['stationIndicatorData'] = array();
    }


    $this->load->view('metarReport',$data);
}




//Dekadal Report methods
public function initializeDekadalReport(){
   // $this->unsetflashdatainfo();
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
    $this->load->view('dekadalReport',$data);

}
public function displaydekadalreport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
        $stationName =  $this->input->post('stationManager');
        $stationNumber =  $this->input->post('stationNoManager');

    }elseif($userrole=='OC'){
        $stationName = $this->input->post('stationOC');
        $stationNumber = $this->input->post('stationNoOC');

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));





    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"0600Z");  //value,field,table
    if ($sqlquery1) {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = $sqlquery1;
    } else {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = array();
    }

    /////FOR 1200Z
    $query1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"1200Z");  //value,field,table
    if ($query1) {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = $query1;
    } else {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = array();
    }

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    $this->load->view('dekadalReport',$data);

}
//Rainfall temperature Report methods

public function initializerainfallTempReport(){
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
    $this->load->view('rainfalltempReport',$data);

}

public function displayrainfallTempeReport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    // $range = $this->input->post('range');

    $date = $this->input->post('fromdate');
    $todate = $this->input->post('todate');
  /*  if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
        $stationName =  $this->input->post('stationManager');
        $stationNumber =  $this->input->post('stationNoManager');

    }elseif($userrole=='OC'){
        $stationName = $this->input->post('stationOC');
        $stationNumber = $this->input->post('stationNoOC');

    }*/




    $userstation=$session_data['UserStation'];
//////////////////////////////////////////////////////////////////////////////////
    //pick data from Observation slip for the Metar Report.
     $query = $this->DbHandler->selectRainfallTemperatureForAdateRange($date,$todate);  //value,field,table

     if ($query) {
       $data['rainfalltempReportDate'] = $query;
      } else {
        $data['rainfalltempReportDate'] = array();
      }

    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

//die(JSON_encode($data));
    $this->load->view('rainfalltempReport',$data);
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
