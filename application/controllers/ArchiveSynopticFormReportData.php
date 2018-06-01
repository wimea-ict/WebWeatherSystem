<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveSynopticFormReportData extends CI_Controller {

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

        $query = $this->DbHandler->selectAll($userstation,'StationName','archivesynopticformreportdata');  //value,field,table
        // $query = $this->DbHandler->selectAll('dailyperiodicrainfall');  //dailyperiodicrainfall is the Table Name.
        //  var_dump($query);

        //  var_dump($query);
        if ($query) {
            $data['archivedsynopticformreportdata'] = $query;
        } else {
            $data['archivedsynopticformreportdata'] = array();
        }

        $this->load->view('archiveSynopticFormReportData', $data);
    }
    public function DisplaySynopticForm(){
        $this->unsetflashdatainfo();
        $name='displaynewsynopticForm';
        $data['displaynewsynopticForm'] = array('name' => $name);

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

        $this->load->view('archiveSynopticFormReportData', $data);

    }
    public function DisplaySynopticFormForUpdate(){
        $this->unsetflashdatainfo();
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


        $synopticformid = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($synopticformid,'id','archivesynopticformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['synopticformdata'] = $query;
        } else {
            $data['synopticformdata'] = array();
        }

        $this->load->view('archiveSynopticFormReportData', $data);
    }

    public function insertSynopticData(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date_archivesynopticformreportdata');
        //$time=$this->input->post('timesynoptic');
        $ztime=$this->input->post('time_archivesynopticformreportdata');
        //$month = date("F");
        //$year = date("Y");




            $station = firstcharuppercase(chgtolowercase($this->input->post('station_archivesynopticformreportdata')));
            $stationNumber = $this->input->post('stationNo_archivesynopticformreportdata');
            $stationId = $this->DbHandler->identifyStationById($station,$stationNumber);

        $unitofwindspeed = $this->input->post('unitows_archivesynopticformreportdata');
        $blockNo = $this->input->post('blockNo_archivesynopticformreportdata');
        //$sunshine = $this->input->post('precipitation');
        $incorommissionofprecipitation = $this->input->post('precipitation_archivesynopticformreportdata');
        $typeofstation = $this->input->post('typeofstation_archivesynopticformreportdata');
        $heightoflowestcloud = $this->input->post('hlowestcloud_archivesynopticformreportdata');

        $horizontalvisibility = $this->input->post('hvisibility_archivesynopticformreportdata');
        $totalcloudcover = $this->input->post('tcloudcover_archivesynopticformreportdata');
        $winddirection = $this->input->post('winddirection_archivesynopticformreportdata');
        $windspeed = $this->input->post('windspeed_archivesynopticformreportdata');

        $groupindicator1 = $this->input->post('groupindicator1_archivesynopticformreportdata');
        $signofdata1 = $this->input->post('signofdata1_archivesynopticformreportdata');

        $airtemperature = $this->input->post('airtemperature_archivesynopticformreportdata');
        $groupindicator2 = $this->input->post('groupindicator2_archivesynopticformreportdata');
        $signofdata2 = $this->input->post('signofdata2_archivesynopticformreportdata');

        $dewpointtemp = $this->input->post('dewpointtemp_archivesynopticformreportdata');
        $groupindicator3 = $this->input->post('groupindicator3_archivesynopticformreportdata');
        $pressureatstationlevel = $this->input->post('pressureatstationlevel_archivesynopticformreportdata');
        $groupindicator4 = $this->input->post('groupindicator4_archivesynopticformreportdata');

        $standardisobaricsurface = $this->input->post('sisobaricsurface_archivesynopticformreportdata');
        $geopotential = $this->input->post('geopotential_archivesynopticformreportdata');
        $groupindicator6 = $this->input->post('groupindicator6_archivesynopticformreportdata');


        $amountofprecipitation = $this->input->post('amtofprecipitation_archivesynopticformreportdata');

        $durationofprecipitation = $this->input->post('durationofprecipitation_archivesynopticformreportdata');
        $groupindicator7 = $this->input->post('groupindicator7_archivesynopticformreportdata');


        $presentweather = $this->input->post('presentweather_archivesynopticformreportdata');
        $pastweather = $this->input->post('pastweather_archivesynopticformreportdata');
        $groupindicator8 = $this->input->post('groupindicator8_archivesynopticformreportdata');

        $amountofclouds = $this->input->post('amountofclouds_archivesynopticformreportdata');

        $cloudsgenera1 = $this->input->post('cloudsgenera1_archivesynopticformreportdata');
        $cloudsgenera2 = $this->input->post('cloudsgenera2_archivesynopticformreportdata');
        $cloudsgenera3 = $this->input->post('cloudsgenera3_archivesynopticformreportdata');

        $sectionindicator333 = $this->input->post('sectionindicator333_archivesynopticformreportdata');
        $groupindicator0 = $this->input->post('groupindicator0_archivesynopticformreportdata');

        $gmtemp = $this->input->post('gmtemperature_archivesynopticformreportdata');
        $charandintensityofprecipitation = $this->input->post('characterintensity_archivesynopticformreportdata');
        $begendofprecipitation = $this->input->post('begendofprecipitation_archivesynopticformreportdata');



        $thunderstorm = "";
        if($this->input->post('thunderstorm_archivesynopticformreportdata')!="")
            $thunderstorm = $this->input->post('thunderstorm_archivesynopticformreportdata');
        else
            $thunderstorm = "false";

        $hailstorm = "";
        if($this->input->post('hailstorm_archivesynopticformreportdata')!="")
            $hailstorm = $this->input->post('hailstorm_archivesynopticformreportdata');
        else
            $hailstorm = "false";


        $fog = "";
        if($this->input->post('fog_archivesynopticformreportdata')!="")
            $fog = $this->input->post('fog_archivesynopticformreportdata');
        else
            $fog = "false";

        $earthquake = "";
        if($this->input->post('earthquake_archivesynopticformreportdata')!="")
            $earthquake = $this->input->post('earthquake_archivesynopticformreportdata');
        else
            $earthquake = "false";

        $anemometerReading = "";
        if($this->input->post('anemometerReading_archivesynopticformreportdata')!="")
            $anemometerReading = $this->input->post('anemometerReading_archivesynopticformreportdata');
        else
            $anemometerReading = "false";



        $actualrainfall = "";
        if($this->input->post('actualrainfall_archivesynopticformreportdata')!= "")
            $actualrainfall = $this->input->post('actualrainfall_archivesynopticformreportdata');
        else
            $actualrainfall = "false";



        $groupindicator1_2 = $this->input->post('groupindicator1_2_archivesynopticformreportdata');
        $signofdata3 = $this->input->post('signofdata3_archivesynopticformreportdata');




        $maxtemptx = $this->input->post('maxtemperaturetx_archivesynopticformreportdata');
        $groupindicator2_2 = $this->input->post('groupindicator2_2_archivesynopticformreportdata');
        $signofdata4 = $this->input->post('signofdata4_archivesynopticformreportdata');
        $maxtemptn = $this->input->post('maxtemperaturetn_archivesynopticformreportdata');
        $groupindicator5 = $this->input->post('groupindicator5_archivesynopticformreportdata');

        $amountofevapouration = $this->input->post('amtofevapouration_archivesynopticformreportdata');
        $instrumentation = $this->input->post('indtypeofin_archivesynopticformreportdata');

        $groupindicator55 = $this->input->post('groupindicator55_archivesynopticformreportdata');
        $durationofsunshine = $this->input->post('durationofsunshine_archivesynopticformreportdata');
        $groupindicator5_2 = $this->input->post('groupindicator5_2_archivesynopticformreportdata');
        $signofpressurechg = $this->input->post('signofpressurechg_archivesynopticformreportdata');
        $pressurechgIn24hrs = $this->input->post('pressurechange24_archivesynopticformreportdata');

        $groupindicator6_2 = $this->input->post('groupindicator6_2_archivesynopticformreportdata');
        $amountofprecipitation2 = $this->input->post('amtofprecipitation2_archivesynopticformreportdata');

        $durationofprecipitation2 = $this->input->post('durationofprecipitation2_archivesynopticformreportdata');

        $groupindicator8_2 = $this->input->post('groupindicator8_2_archivesynopticformreportdata');
        $amountofindividualcloudcover = $this->input->post('amtofcloudlayer_archivesynopticformreportdata');
        $genusofcloud = $this->input->post('genuscloud_archivesynopticformreportdata');
        $heightofbasecloudlayer = $this->input->post('hofbasecloud_archivesynopticformreportdata');
        ///////////////////////////////////////////////////////////////////

        $groupindicator8_3 = $this->input->post('groupindicator8_3_archivesynopticformreportdata');
        $amountofindividualcloudcover2 = $this->input->post('amtofcloudlayer2_archivesynopticformreportdata');
        $genusofcloud2 = $this->input->post('genuscloud2_archivesynopticformreportdata');
        $heightofbasecloudlayer2 = $this->input->post('hofbasecloud2_archivesynopticformreportdata');

        ///////////////////////////////////////////////////////////////////////
        $groupindicator8_4 = $this->input->post('groupindicator8_4_archivesynopticformreportdata');
        $amountofindividualcloudcover3 = $this->input->post('amtofcloudlayer3_archivesynopticformreportdata');
        $genusofcloud3 = $this->input->post('genuscloud3_archivesynopticformreportdata');
        $heightofbasecloudlayer3 = $this->input->post('hofbasecloud3_archivesynopticformreportdata');

        /////////////////////////////////////////////////////////////////////////////

        $groupindicator8_5 = $this->input->post('groupindicator8_5_archivesynopticformreportdata');
        $amountofindividualcloudcover4 = $this->input->post('amtofcloudlayer4_archivesynopticformreportdata');
        $genusofcloud4 = $this->input->post('genuscloud4_archivesynopticformreportdata');
        $heightofbasecloudlayer4 = $this->input->post('hofbasecloud4_archivesynopticformreportdata');

        $groupindicator9 = $this->input->post('groupindicator9_archivesynopticformreportdata');
        $supplementaryinformation = $this->input->post('supplementaryinfo_archivesynopticformreportdata');
        $sectionindicator555 = $this->input->post('sectionindicator555_archivesynopticformreportdata');
        $groupindicator1_3 = $this->input->post('groupindicator1_3_archivesynopticformreportdata');
        $signofdata5 = $this->input->post('signofdata5_archivesynopticformreportdata');

        $wetbulbtemp = $this->input->post('wetbulbtemp_archivesynopticformreportdata');
        $rhumidity = $this->input->post('relativehumidity_archivesynopticformreportdata');
        $vpressure = $this->input->post('vapourpressure_archivesynopticformreportdata');


$remarks = $this->input->post('remarks');
$time_ = $this->input->post('time_');
$ObserverOnDuty = $this->input->post('ObserverOnDuty');
$to = $this->input->post('to');
$from = $this->input->post('from');


        $Approved = "FALSE";
       // $creationDate= date('Y-m-d H:i:s');
        $SubmittedBy=$name;



        $insertSynopticFormData=array(
            'Date'=>$date,'Time'=>$ztime,'UWS'=>$unitofwindspeed,'BN'=>$blockNo,
            'station'=>$stationId,
            'SubmittedBy' => $SubmittedBy ,'Approved'=>$Approved,
            'IOOP'=> $incorommissionofprecipitation, 'TSPPW'=>$typeofstation,

            'HLC'=>$heightoflowestcloud,'HV'=>$horizontalvisibility,
            'TCC'=>$totalcloudcover,'WD'=>$winddirection,'WS'=>$windspeed,'GI1_1'=>$groupindicator1,
            'SignOfData_1'=>$signofdata1,'Air_Temperature'=>$airtemperature,'GI2_1'=>$groupindicator2,
            'SignOfData_2'=>$signofdata2,

            'Dewpoint_temperature'=>$dewpointtemp,
            'GI3_1'=>$groupindicator3,'PASL'=>$pressureatstationlevel,
            'GI4_1'=>$groupindicator4,'SIS'=>$standardisobaricsurface,
            'GSIS'=>$geopotential,'GI6_1'=>$groupindicator6,'AOP'=>$amountofprecipitation,
            'DPOP'=>$durationofprecipitation,'GI7_1'=>$groupindicator7,
            'Present_Weather'=>$presentweather,

            'Past_Weather'=>$pastweather,'GI8_1'=>$groupindicator8,
            'AOC'=>$amountofclouds,
            'CLOG'=>$cloudsgenera1,'CGOG'=>$cloudsgenera2,'CHOG'=>$cloudsgenera3,
            'Section_Indicator333'=>$sectionindicator333,'GI0_1'=>$groupindicator0,
            'GMT'=>$gmtemp,'CIOP'=>$charandintensityofprecipitation,'BEOP'=>$begendofprecipitation,


            'GI1_2'=>$groupindicator1_2,'SignOfData_3'=>$signofdata3,
            'Max_TempTx'=>$maxtemptx,'GI2_2'=>$groupindicator2_2,'SignOfData_4'=>$signofdata4,
            'Max_TempTn'=>$maxtemptn,'GI5_1'=>$groupindicator5,
            'AOE'=>$amountofevapouration,'ITI'=>$instrumentation,'GI55'=>$groupindicator55,
            'DOS'=>$durationofsunshine,'GI5_2'=>$groupindicator5_2,
            'SPC'=>$signofpressurechg,'PCI24Hrs'=>$pressurechgIn24hrs,'GI6_2'=>$groupindicator6_2,
            'AOP_2'=>$amountofprecipitation2,'DPOP_2'=>$durationofprecipitation2,
            'GI8_2'=>$groupindicator8_2,
            'AICL'=>$amountofindividualcloudcover,'GOC'=>$genusofcloud,'HBCLOM'=>$heightofbasecloudlayer,

            'GI8_3'=>$groupindicator8_3,
            'AICL_2'=>$amountofindividualcloudcover2,'GOC_2'=>$genusofcloud2,'HBCLOM_2'=>$heightofbasecloudlayer2,

            'GI8_4'=>$groupindicator8_4,
            'AICL_3'=>$amountofindividualcloudcover3,'GOC_3'=>$genusofcloud3,'HBCLOM_3'=>$heightofbasecloudlayer3,

            'GI8_5'=>$groupindicator8_5,
            'AICL_4'=>$amountofindividualcloudcover4,'GOC_4'=>$genusofcloud4,'HBCLOM_4'=>$heightofbasecloudlayer4,

            'GI9'=>$groupindicator9,'Supp_Info'=>$supplementaryinformation,'Section_Indicator555'=>$sectionindicator555,
            'GI1_3'=>$groupindicator1_3,'SignOfData_5'=>$signofdata5,
            'Wetbulb_Temp'=>$wetbulbtemp,'R_Humidity'=>$rhumidity,
            'V_Pressure'=>$vpressure, 'remarks'=>$remarks, 'time_'=>$time_,
            'ObserverOnDuty'=>$ObserverOnDuty, 'to_'=>$to, 'from_'=>$from,

            'ThunderStorm'=>$thunderstorm,'HailStorm'=>$hailstorm,
            'Fog'=>$fog,
            'EarthQuake'=>$earthquake,'Anemometer_Reading'=>$anemometerReading,
            'Actual_Rainfall'=>$actualrainfall,);

        $insertsuccess= $this->DbHandler->insertData($insertSynopticFormData,'archivesynopticformreportdata'); //Array for data to insert then  the Table Name





        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId = $session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Added archived synoptic info',
                'Details' => $name . ' added archived synoptic info into the system',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'New Archived Synoptic info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }


    }
    public function updateSynopticFormData(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date');
        //$time=$this->input->post('timesynoptic');
        $ztime=$this->input->post('timeRecorded');

            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
            $stationNumber = $this->input->post('stationNo');
            $stationId = $this->DbHandler->identifyStationById($station,$stationNumber);


        $unitofwindspeed = $this->input->post('unitofwindspeed');
        $blockNo = $this->input->post('blockNumber');
        //$sunshine = $this->input->post('precipitation');
        $incorommissionofprecipitation = $this->input->post('ioprecipitation');
        $typeofstation = $this->input->post('typeofstat');
        $heightoflowestcloud = $this->input->post('lowestcloudheight');

        $horizontalvisibility = $this->input->post('horizontalvisibility');
        $totalcloudcover = $this->input->post('cloudcovertotal');
        $winddirection = $this->input->post('wdirection');
        $windspeed = $this->input->post('wspeed');

        $groupindicator1 = $this->input->post('gindicator1');
        $signofdata1 = $this->input->post('signdata1');

        $airtemperature = $this->input->post('airtemp');
        $groupindicator2 = $this->input->post('gindicator2');
        $signofdata2 = $this->input->post('signdata2');

        $dewpointtemp = $this->input->post('dewpointtemperature');
        $groupindicator3 = $this->input->post('gindicator3');
        $pressureatstationlevel = $this->input->post('pressurestationlevel');
        $groupindicator4 = $this->input->post('gindicator4');

        $standardisobaricsurface = $this->input->post('isobaric');
        $geopotential = $this->input->post('geopotentialsis');
        $groupindicator6 = $this->input->post('gindicator6');


        $amountofprecipitation = $this->input->post('amountofprecipitation');

        $durationofprecipitation = $this->input->post('precipitationduration');
        $groupindicator7 = $this->input->post('gindicator7');


        $presentweather = $this->input->post('presentweather');
        $pastweather = $this->input->post('pastweather');
        $groupindicator8 = $this->input->post('gindicator8');

        $amountofclouds = $this->input->post('amountclouds');

        $cloudsgenera1 = $this->input->post('cloudsgene1');
        $cloudsgenera2 = $this->input->post('cloudsgene2');
        $cloudsgenera3 = $this->input->post('cloudsgene3');

        $sectionindicator333 = $this->input->post('sindicator333');
        $groupindicator0 = $this->input->post('gindicator0');

        $gmtemp = $this->input->post('grassmintemp');
        $charandintensityofprecipitation = $this->input->post('characterinten');
        $begendofprecipitation = $this->input->post('begendprecipitation');



        $thunderstorm = "";
        if($this->input->post('thunderstorm')!="")
            $thunderstorm = $this->input->post('thunderstorm');
        else
            $thunderstorm = "false";

        $hailstorm = "";
        if($this->input->post('hailstorm')!="")
            $hailstorm = $this->input->post('hailstorm');
        else
            $hailstorm = "false";


        $fog = "";
        if($this->input->post('fog')!="")
            $fog = $this->input->post('fog');
        else
            $fog = "false";

        $earthquake = "";
        if($this->input->post('earthquake')!="")
            $earthquake = $this->input->post('earthquake');
        else
            $earthquake = "false";

        $anemometerReading = "";
        if($this->input->post('anemometerreading')!="")
            $anemometerReading = $this->input->post('anemometerreading');
        else
            $anemometerReading = "false";



        $actualrainfall = "";
        if($this->input->post('actualrainfall')!= "")
            $actualrainfall = $this->input->post('actualrainfall');
        else
            $actualrainfall = "false";



        $groupindicator1_2 = $this->input->post('gindicator1_2');
        $signofdata3 = $this->input->post('signdata3');
        $maxtemptx = $this->input->post('maxtemptx');
        $groupindicator2_2 = $this->input->post('gindicator2_2');
        $signofdata4 = $this->input->post('signdata4');
        $maxtemptn = $this->input->post('maxtemptn');
        $groupindicator5 = $this->input->post('gindicator5');

        $amountofevapouration = $this->input->post('amtofevap');
        $instrumentation = $this->input->post('indtype');

        $groupindicator55 = $this->input->post('gindicator55');
        $durationofsunshine = $this->input->post('durationsunshine');
        $groupindicator5_2 = $this->input->post('gindicator5_2');
        $signofpressurechg = $this->input->post('pressurechgsign');
        $pressurechgIn24hrs = $this->input->post('pressurechgin24hrs');

        $groupindicator6_2 = $this->input->post('gindicator6_2');
        $amountofprecipitation2 = $this->input->post('amountofprecipitation2');

        $durationofprecipitation2 = $this->input->post('precipitationduration2');

        $groupindicator8_2 = $this->input->post('gindicator8_2');
        $amountofindividualcloudcover = $this->input->post('cloudlayeramount');
        $genusofcloud = $this->input->post('cloudgenus');
        $heightofbasecloudlayer = $this->input->post('basecloudheight');
        ///////////////////////////////////////////////////////////////////

        $groupindicator8_3 = $this->input->post('gindicator8_3');
        $amountofindividualcloudcover2 = $this->input->post('cloudlayeramount2');
        $genusofcloud2 = $this->input->post('cloudgenus2');
        $heightofbasecloudlayer2 = $this->input->post('basecloudheight2');

        ///////////////////////////////////////////////////////////////////////
        $groupindicator8_4 = $this->input->post('gindicator8_4');
        $amountofindividualcloudcover3 = $this->input->post('cloudlayeramount3');
        $genusofcloud3 = $this->input->post('cloudgenus3');
        $heightofbasecloudlayer3 = $this->input->post('basecloudheight3');

        /////////////////////////////////////////////////////////////////////////////

        $groupindicator8_5 = $this->input->post('gindicator8_5');
        $amountofindividualcloudcover4 = $this->input->post('cloudlayeramount4');
        $genusofcloud4 = $this->input->post('cloudgenus4');
        $heightofbasecloudlayer4 = $this->input->post('basecloudheight4');

        $groupindicator9 = $this->input->post('gindicator9');
        $supplementaryinformation = $this->input->post('supplementary_info');
        $sectionindicator555 = $this->input->post('sindicator555');
        $groupindicator1_3 = $this->input->post('gindicator1_3');
        $signofdata5 = $this->input->post('signdata5');

        $wetbulbtemp = $this->input->post('wetbulbtemperature');
        $rhumidity = $this->input->post('rhumidity');
        $vpressure = $this->input->post('vpressure');
        $remarks = $this->input->post('remarks');
        $time_ = $this->input->post('time_');
        $ObserverOnDuty = $this->input->post('ObserverOnDuty');
        $to = $this->input->post('to');
        $from = $this->input->post('from');

        $Approved = $this->input->post('approval');




        $updateSynopticFormData=array(
            'Date'=>$date,'Time'=>$ztime,'UWS'=>$unitofwindspeed,'BN'=>$blockNo,
            'station'=>$stationId,
            'Approved'=>$Approved,
            'IOOP'=> $incorommissionofprecipitation, 'TSPPW'=>$typeofstation,

            'HLC'=>$heightoflowestcloud,'HV'=>$horizontalvisibility,
            'TCC'=>$totalcloudcover,'WD'=>$winddirection,'WS'=>$windspeed,'GI1_1'=>$groupindicator1,
            'SignOfData_1'=>$signofdata1,'Air_Temperature'=>$airtemperature,'GI2_1'=>$groupindicator2,
            'SignOfData_2'=>$signofdata2,

            'Dewpoint_temperature'=>$dewpointtemp,
            'GI3_1'=>$groupindicator3,'PASL'=>$pressureatstationlevel,
            'GI4_1'=>$groupindicator4,'SIS'=>$standardisobaricsurface,
            'GSIS'=>$geopotential,'GI6_1'=>$groupindicator6,'AOP'=>$amountofprecipitation,
            'DPOP'=>$durationofprecipitation,'GI7_1'=>$groupindicator7,
            'Present_Weather'=>$presentweather,

            'Past_Weather'=>$pastweather,'GI8_1'=>$groupindicator8,
            'AOC'=>$amountofclouds,
            'CLOG'=>$cloudsgenera1,'CGOG'=>$cloudsgenera2,'CHOG'=>$cloudsgenera3,
            'Section_Indicator333'=>$sectionindicator333,'GI0_1'=>$groupindicator0,
            'GMT'=>$gmtemp,'CIOP'=>$charandintensityofprecipitation,'BEOP'=>$begendofprecipitation,


            'GI1_2'=>$groupindicator1_2,'SignOfData_3'=>$signofdata3,
            'Max_TempTx'=>$maxtemptx,'GI2_2'=>$groupindicator2_2,'SignOfData_4'=>$signofdata4,
            'Max_TempTn'=>$maxtemptn,'GI5_1'=>$groupindicator5,
            'AOE'=>$amountofevapouration,'ITI'=>$instrumentation,'GI55'=>$groupindicator55,
            'DOS'=>$durationofsunshine,'GI5_2'=>$groupindicator5_2,
            'SPC'=>$signofpressurechg,'PCI24Hrs'=>$pressurechgIn24hrs,'GI6_2'=>$groupindicator6_2,
            'AOP_2'=>$amountofprecipitation2,'DPOP_2'=>$durationofprecipitation2,
            'GI8_2'=>$groupindicator8_2,
            'AICL'=>$amountofindividualcloudcover,'GOC'=>$genusofcloud,'HBCLOM'=>$heightofbasecloudlayer,

            'GI8_3'=>$groupindicator8_3,
            'AICL_2'=>$amountofindividualcloudcover2,'GOC_2'=>$genusofcloud2,'HBCLOM_2'=>$heightofbasecloudlayer2,

            'GI8_4'=>$groupindicator8_4,
            'AICL_3'=>$amountofindividualcloudcover3,'GOC_3'=>$genusofcloud3,'HBCLOM_3'=>$heightofbasecloudlayer3,

            'GI8_5'=>$groupindicator8_5,
            'AICL_4'=>$amountofindividualcloudcover4,'GOC_4'=>$genusofcloud4,'HBCLOM_4'=>$heightofbasecloudlayer4,

            'GI9'=>$groupindicator9,'Supp_Info'=>$supplementaryinformation,'Section_Indicator555'=>$sectionindicator555,
            'GI1_3'=>$groupindicator1_3,'SignOfData_5'=>$signofdata5,
            'Wetbulb_Temp'=>$wetbulbtemp,'R_Humidity'=>$rhumidity,
            'V_Pressure'=>$vpressure, 'remarks'=>$remarks, 'time_'=>$time_,
            'ObserverOnDuty'=>$ObserverOnDuty, 'to_'=>$to, 'from_'=>$from,


            'ThunderStorm'=>$thunderstorm,'HailStorm'=>$hailstorm,
            'Fog'=>$fog,
            'EarthQuake'=>$earthquake,'Anemometer_Reading'=>$anemometerReading,
            'Actual_Rainfall'=>$actualrainfall,);


        $id = $this->input->post('id');

        //$this->DbHandler->insertInstrument($insertInstrumentData);
        $updatesuccess= $this->DbHandler->updateData($updateSynopticFormData,"",'archivesynopticformreportdata',$id); //Array for data to insert then  the Table Name



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

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Update archieve Synoptic info',
                'Details' => $name . ' updated  archieve  Synoptic info in the system',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);
            $this->session->set_flashdata('success', 'Archived Synoptic info was Updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }



    // }
    public function deleteSynopticFormData(){
        $this->unsetflashdatainfo();
        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('archivesynopticformreportdata',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
//Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted archieve info',
                'Details' => $name . ' deleted archieve info into the system',
                'station' => $userstationId,
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
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveSynopticFormReportRecordExistsAlready($date,$time_OnSynopticFormRecorded,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $time_OnSynopticFormRecorded = ($time_OnSynopticFormRecorded == "") ? $this->input->post('time_OnSynopticFormRecorded') : $time_OnSynopticFormRecorded;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveSynopticFormReportRecordExistsAlready($date,$time_OnSynopticFormRecorded,$stationName,$stationNumber,'archivesynopticformreportdata');   // $value, $field, $table

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
