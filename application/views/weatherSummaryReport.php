<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>
                <b>Name: <?php echo $name ; ?> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Role: <?php echo $userrole  ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Station: <?php echo $userstation  ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Station Number: <?php echo $userstationNo ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                </b>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Weather Summary Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div class="no-print">
        <div id="output"></div>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/WeatherSummaryReport/displayweathersummaryreport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='OC'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='Manager'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <select name="stationManager" id="stationManager"  required class="form-control" placeholder="Select Station">
                                    <option value="">Select Stations</option>
                                    <?php
                                    if (is_array($stationsdata) && count($stationsdata)) {
                                        foreach($stationsdata as $station){?>
                                            <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if($userrole=='OC'){ ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value="monthly_rainfall_report" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }elseif($userrole=='Manager'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value="monthly_rainfall_report" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoManager"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }?>

                <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Month</span>
                            <input type="text" name="month" id="month" class="form-control summonth" placeholder="Please select month" >
                        </div>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Year</span>
                            <input type="text" name="year" id="year" class="form-control sumyear" placeholder="Please select year" >
                        </div>
                    </div>
                </div>

                <div class="col-xs-2">
                    <input type="submit" name="generateweathersummaryreport_button" id="generateweathersummaryreport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>


    <?php
    if(is_array($displayWeatherSummaryReportHeaderFields)
        && count($displayWeatherSummaryReportHeaderFields)){

        $monthAsANumber=0;
        $year=0;

        $monthInWords= $displayWeatherSummaryReportHeaderFields['monthInWords'];
        $monthAsANumber= $displayWeatherSummaryReportHeaderFields['monthAsANumberselected'];

        $year= $displayWeatherSummaryReportHeaderFields['year'];

        $getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);
        //$getNumberOfdaysInAMonth=cal_days_in_month(CAL_GREGORIAN,$monthAsANumber,$year);



        $stationName=$displayWeatherSummaryReportHeaderFields['stationName'];
        $stationNumber=$displayWeatherSummaryReportHeaderFields['stationNumber'];
        ?>
        <h3>UGANDA NATIONAL METEOROLOGY AUTHORITY</h3>
        <span><strong>FORM 10 (REV 2003)</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>(WEATHER SUMMARY FORM)</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>STATION NO.</strong></span> <span class="dotted-line"><?php echo $stationNumber;?></span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>REG NO.</strong></span>
        <span class="dotted-line"> <?php echo $getNumberOfdaysInAMonth;?></span>
        <div class="clearfix"></div>

        <span><strong>STATION</strong></span> <span class="dotted-line"><?php echo $stationName;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>MONTH</strong></span> <span class="dotted-line"><?php echo $monthInWords;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><strong>YEAR</strong> </span>
        <span class="dotted-line"><?php echo $year;?></span>

        <div class="clearfix"></div>
        <br>
        <p>Reading of selected parameters</p>
        <table class="report-table" id="table2excel">
        <tr>
            <td></td>
            <td colspan="3"></td>
            <td class="main" colspan="9"> <center>0600Z</center></td>
            <td class="main" colspan="9">  <center>1200Z</center></td>
            <td class="main" colspan="8">  <center>DAYS WITH</center></td>
        </tr>

        <tr>
            <td class="main">Date</td>

            <td class="main">MAX &deg;C</td>
            <td class="main">MIN &deg;C</td>
            <td class="main">SUNSHINE</td>

            <td class="main">DB</td>
            <td class="main">WB</td>
            <td class="main">DP</td>
            <td class="main">VP</td>
            <td class="main">RH</td>
            <td class="main">CLP</td>
            <td class="main">GPM</td>
            <td class="main">WIND DIR</td>
            <td class="main">FF</td>


            <td class="main">DB</td>
            <td class="main">WB</td>
            <td class="main">DP</td>
            <td class="main">VP</td>
            <td class="main">RH</td>
            <td class="main">CLP</td>
            <td class="main">GPM</td>
            <td class="main">WIND DIR</td>
            <td class="main">FF</td>


            <td class="main">WIND RUN</td>
            <td class="main">R/F</td>
            <td class="main">R/DAY</td>
            <td class="main">Ts</td>
            <td class="main">Fg</td>
            <td class="main">HZ</td>
            <td class="main">HAIL</td>
            <td class="main">EARTHQ</td>
        </tr>

        <?php
        //Pick the different arrays from the DB Populated with data.But these arrays might not contain the
        //total number of days that make up the month
        if (is_array($observationslipdataforAMonthAndTime0600Z) ||is_array($observationslipdataforAMonthAndTime1200Z)
               ||is_array($moreformfieldsdatatable_forAMonthAndTime0600Z)  || is_array($moreformfieldsdatatable_forAMonthAndTime1200Z)


        ) {


            //Create Arrays to store data to be formated e.g if data for a day is missing we insert blank fields in that day.
            //Mek sure the days are for a month and all are present
            $array_observationslipdataOfAMonthAndforTime0600Z=array();
            $array_observationslipdataOfAMonthAndforTime1200Z=array();


            $array_moreformfieldsdataOfAMonthAndforTime0600Z=array();
            $array_moreformfieldsdataOfAMonthAndforTime1200Z=array();



            //First loop thru  the array for observationslip with TIME 0600Z and then  insert it into the different array we have created above that wl have all days of the month
            //format if day not there.Put blank fields if the day is not there else do nothing
            //the days of the Month
            $print=0;
            for($daynum = 1; $daynum<=$getNumberOfdaysInAMonth; $daynum++ ){

                foreach($observationslipdataforAMonthAndTime0600Z as $data){ //goes thr whole array searching for daynum
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {  //compare daynum with the day no we picked frm DB

                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSDayNumber"]=$data->DayOfTheMonth;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Max_Read"]=$data->Max_Read;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Min_Read"]=$data->Min_Read;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Dry_Bulb"]=$data->Dry_Bulb;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Wet_Bulb"]=$data->Wet_Bulb;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Wind_Direction"]=$data->Wind_Direction;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Wind_Speed"]=$data->Wind_Speed;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_CLP"]=$data->CLP;
                        $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Rainfall"]=$data->Rainfall;

                        $print=1; //IF IT EXISTS PRINT CHGS TO 1

                        break;
                    }//end of if
                    else{

                        $print=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print==0){

                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSDayNumber"]=$daynum;
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Max_Read"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Min_Read"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Dry_Bulb"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Wet_Bulb"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Wind_Direction"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Wind_Speed"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_CLP"]='';
                    $array_observationslipdataOfAMonthAndforTime0600Z[$daynum-1]["OSTime0600Z_Rainfall"]='';

                }//end of if
            }//end of for loop for OS TIME 0600Z

            ///////////////////////////////////////////////////////////////////////
            //First loop thru  the array for observationslip with TIME 1200Z and then format if day not there.
            //the days of the Month
            $print1=0;
            for($daynum = 1; $daynum<=$getNumberOfdaysInAMonth; $daynum++ ){

                foreach($observationslipdataforAMonthAndTime1200Z as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSDayNumber1"]=$data->DayOfTheMonth;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Max_Read"]=$data->Max_Read;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Min_Read"]=$data->Min_Read;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Dry_Bulb"]=$data->Dry_Bulb;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Wet_Bulb"]=$data->Wet_Bulb;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Wind_Direction"]=$data->Wind_Direction;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Wind_Speed"]=$data->Wind_Speed;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_CLP"]=$data->CLP;
                        $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Rainfall"]=$data->Rainfall;

                        $print1=1;
                        break;
                    }//end of if
                    else{

                        $print1=0;
                    }

                } //end of foreach to print all values that are in the report array

                if($print1==0){

                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSDayNumber1"]=$daynum;
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Max_Read"]='';
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Min_Read"]='';
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Dry_Bulb"]='';
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Wet_Bulb"]='';

                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Wind_Direction"]='';
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Wind_Speed"]='';
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_CLP"]='';
                    $array_observationslipdataOfAMonthAndforTime1200Z[$daynum-1]["OSTime1200Z_Rainfall"]='';

                }//end of if
            }//end of for loop FOR OS 1200Z TIME
//////////////////////////////////////////////////////////////////////////////////////////////////
            //First loop thru  the array for MORE FORM FIELDS TABLE with TIME 0600Z and then format if day not there.
            //the days of the Month
            $print2=0;
            for($daynum = 1; $daynum<=$getNumberOfdaysInAMonth; $daynum++ ){

                foreach($moreformfieldsdatatable_forAMonthAndTime0600Z as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_DayNumber"]=$data->DayOfTheMonth;
                        $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_Time0600Z_GPM"]=$data->StandardIsobaricSurface;
                        $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_Time0600Z_DURATION_OF_SUNSHINE"]=$data->DurationOfSunshine;

                        $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_Time0600Z_VapourPressure"]=$data->VapourPressure;

                        $print2=1;
                        break;
                    }//end of if
                    else{

                        $print2=0;
                    }

                } //end of foreach to print all values that are in the report array

                if($print2==0){
                    $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_DayNumber"]=$daynum;
                    $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_Time0600Z_GPM"]='';
                    $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_Time0600Z_DURATION_OF_SUNSHINE"]='';

                    $array_moreformfieldsdataOfAMonthAndforTime0600Z[$daynum-1]["MOREFORMFIEDSTABLE_Time0600Z_VapourPressure"]='';

                }//end of if
            }//end of for loop for MORE FORM FIELDS TABLE TIME 0600Z
//////////////////////////////////////////////////////////////////////////////
            //First loop thru  the array for MORE FORM FIELDS TABLE with TIME 1200Z and then format if day not there.
            //the days of the Month
            $print3=0;
            for($daynum = 1; $daynum<=$getNumberOfdaysInAMonth; $daynum++ ){

                foreach($moreformfieldsdatatable_forAMonthAndTime1200Z as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_DayNumber2"]=$data->DayOfTheMonth;
                        $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_Time1200Z_GPM"]=$data->StandardIsobaricSurface;
                        $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_Time1200Z_DURATION_OF_SUNSHINE"]=$data->DurationOfSunshine;

                        $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_Time1200Z_VapourPressure"]=$data->VapourPressure;

                        $print3=1;
                        break;
                    }//end of if
                    else{

                        $print3=0;
                    }

                } //end of foreach to print all values that are in the report array

                if($print3==0){
                    $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_DayNumber2"]=$daynum;
                    $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_Time1200Z_GPM"]='';
                    $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_Time1200Z_DURATION_OF_SUNSHINE"]='';

                    $array_moreformfieldsdataOfAMonthAndforTime1200Z[$daynum-1]["MOREFORMFIEDSTABLE_Time1200Z_VapourPressure"]='';

                }//end of if
            }//end of for loop for MORE FORM FIELDS TABLE TIME 1200Z

            ?>

            <?php
            //nid to create an array with row contain each (corresponding e.g first of each row) row of each array
            $finalarraymerge=array();
            $i = 0;

            for($daynum = 1; $daynum<=$getNumberOfdaysInAMonth; $daynum++ ){
                $finalarraymerge [$i]["Date"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSDayNumber'];
                $finalarraymerge [$i]["OSTime0600Z_Max_Read"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Max_Read'];
                $finalarraymerge [$i]["OSTime0600Z_Min_Read"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Min_Read'];
                $finalarraymerge [$i]["Sunshine_0600Z"]= $array_moreformfieldsdataOfAMonthAndforTime0600Z[$i]["MOREFORMFIEDSTABLE_Time0600Z_DURATION_OF_SUNSHINE"];

                $finalarraymerge [$i]["OSTime0600Z_Dry_Bulb"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Dry_Bulb'];
                $finalarraymerge [$i]["OSTime0600Z_Wet_Bulb"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Wet_Bulb'];

                //Cal the Dew Point Temperature
                $DP_0600Z=(((3 * $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Wet_Bulb'])- $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Dry_Bulb']) / 2);
                if($DP_0600Z!=0){

                    $finalarraymerge [$i]["DewPointTemperature_0600Z"]= round($DP_0600Z,2);

                }elseif($DP_0600Z==0){
                    $finalarraymerge [$i]["DewPointTemperature_0600Z"]= '';
                }

                //VP
                $finalarraymerge [$i]["VapourPressure_0600Z"]=$array_moreformfieldsdataOfAMonthAndforTime0600Z[$i]['MOREFORMFIEDSTABLE_Time0600Z_VapourPressure'];

                //Cal the Relative Humidity(RH)
                $RH_0600Z=((100 * $DP_0600Z) / $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Dry_Bulb']);
                if($RH_0600Z!=0){

                    $finalarraymerge [$i]["RelativeHumidity_0600Z"]= round($RH_0600Z,2);

                }elseif($RH_0600Z==0){
                    $finalarraymerge [$i]["RelativeHumidity_0600Z"]= '';
                }

                //CLP
                $finalarraymerge [$i]["OSTime0600Z_CLP"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_CLP'];

                //GPM
                $finalarraymerge [$i]["GPM_0600Z"]= $array_moreformfieldsdataOfAMonthAndforTime0600Z[$i]['MOREFORMFIEDSTABLE_Time0600Z_GPM'];

                $finalarraymerge [$i]["OSTime0600Z_Wind_Direction"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Wind_Direction'];
                $finalarraymerge [$i]["OSTime0600Z_Wind_Speed"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Wind_Speed'];
                $finalarraymerge [$i]["OSTime0600Z_Rainfall"]= $array_observationslipdataOfAMonthAndforTime0600Z[$i]['OSTime0600Z_Rainfall'];




                //1200Z
                $finalarraymerge [$i]["OSDayNumber1"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSDayNumber1'];

                $finalarraymerge [$i]["OSTime1200Z_Max_Read"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Max_Read'];
                $finalarraymerge [$i]["OSTime1200Z_Min_Read"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Min_Read'];
                $finalarraymerge [$i]["Sunshine_1200Z"]= $array_moreformfieldsdataOfAMonthAndforTime1200Z[$i]["MOREFORMFIEDSTABLE_Time1200Z_DURATION_OF_SUNSHINE"];

                $finalarraymerge [$i]["OSTime1200Z_Dry_Bulb"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Dry_Bulb'];
                $finalarraymerge [$i]["OSTime1200Z_Wet_Bulb"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Wet_Bulb'];

                //CAL DP
                $DP_1200Z=(((3 * $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Wet_Bulb'])- $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Dry_Bulb']) / 2);
                if($DP_1200Z!=0){

                    $finalarraymerge [$i]["DewPointTemperature_1200Z"]= round($DP_1200Z,2);

                }elseif($DP_1200Z==0){
                    $finalarraymerge [$i]["DewPointTemperature_1200Z"]= '';
                }

                //VP
                $finalarraymerge [$i]["VapourPressure_1200Z"]= $array_moreformfieldsdataOfAMonthAndforTime1200Z[$i]['MOREFORMFIEDSTABLETime1200Z_Vapour_Pressure'];

                //RH
                $RH_1200Z=((100 * $DP_1200Z)/$array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Dry_Bulb']);
                if($RH_1200Z!=0){

                    $finalarraymerge [$i]["RelativeHumidity_1200Z"]= round($RH_1200Z,2);

                }elseif($RH_1200Z==0){
                    $finalarraymerge [$i]["RelativeHumidity_1200Z"]= '';
                }

                //CLP
                $finalarraymerge [$i]["OSTime1200Z_CLP"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_CLP'];


                //GPM
                $finalarraymerge [$i]["GPM_1200Z"]= $array_moreformfieldsdataOfAMonthAndforTime1200Z[$i]['MOREFORMFIEDSTABLETime1200Z_GPM'];


                $finalarraymerge [$i]["OSTime1200Z_Wind_Direction"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Wind_Direction'];
                $finalarraymerge [$i]["OSTime1200Z_Wind_Speed"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Wind_Speed'];
                 $finalarraymerge [$i]["OSTime1200Z_Rainfall"]= $array_observationslipdataOfAMonthAndforTime1200Z[$i]['OSTime1200Z_Rainfall'];


                $i++;
            }  //end of for loop.

            //Cal the Total And Mean of each column with data.If no data i do not count it.

            $TotalMax=0.0;
            $TotalRowswithDataCountForMaxTemp=0;

            $TotalMin=0.0;
            $TotalRowswithDataCountForMinTemp=0;

            $TotalSunshine=0.0;
            $TotalRowswithDataCountForSunshine=0;

            $TotalDB_0600Z=0.0;
            $TotalRowswithDataCountForDB_0600Z=0;

            $TotalWB_0600Z=0.0;
            $TotalRowswithDataCountForWB_0600Z=0;

            $TotalDP_0600Z=0.0;
            $TotalRowswithDataCountForDP_0600Z=0;

            $TotalVP_0600Z=0.0;
            $TotalRowswithDataCountForVP_0600Z=0;

            $TotalRH_0600Z=0.0;
            $TotalRowswithDataCountForRH_0600Z=0;

            $TotalCLP_0600Z=0.0;
            $TotalRowswithDataCountForCLP_0600Z=0;

            $TotalGPM_0600Z=0.0;
            $TotalRowswithDataCountForGPM_0600Z=0;

            $TotalWIND_DIR_0600Z=0.0;
            $TotalRowswithDataCountForWIND_DIR_0600Z=0;

            $TotalFF_0600Z=0.0;
            $TotalRowswithDataCountForFF_0600Z=0;

///////////////////////////////////////////////////////////////////////////////////////////////
            $TotalDB_1200Z=0.0;
            $TotalRowswithDataCountForDB_1200Z=0;

            $TotalWB_1200Z=0.0;
            $TotalRowswithDataCountForWB_1200Z=0;

            $TotalDP_1200Z=0.0;
            $TotalRowswithDataCountForDP_1200Z=0;

            $TotalVP_1200Z=0.0;
            $TotalRowswithDataCountForVP_1200Z=0;

            $TotalRH_1200Z=0.0;
            $TotalRowswithDataCountForRH_1200Z=0;

            $TotalCLP_1200Z=0.0;
            $TotalRowswithDataCountForCLP_1200Z=0;

            $TotalGPM_1200Z=0.0;
            $TotalRowswithDataCountForGPM_1200Z=0;

            $TotalWIND_DIR_1200Z=0.0;
            $TotalRowswithDataCountForWIND_DIR_1200Z=0;

            $TotalFF_1200Z=0.0;
            $TotalRowswithDataCountForFF_1200Z=0;

            $TotalRainfall=0.0;
            $TotalRowswithDataCountForRainfall=0;

            foreach($finalarraymerge as $data){

                //TOTAL MAX TEMPERATURE
                if($data['OSTime0600Z_Max_Read']!='' && $data['OSTime1200Z_Max_Read'] !='' ){
                   //not null ,not null for both times.We tek data for 0600Z time

                    $TotalMax+=$data['OSTime0600Z_Max_Read'];
                    $TotalRowswithDataCountForMaxTemp+=1;

                }elseif($data['OSTime0600Z_Max_Read'] =='' && $data['OSTime1200Z_Max_Read'] !=''){
                         //null , not null

                    $TotalMax+=$data['OSTime1200Z_Max_Read'];
                    $TotalRowswithDataCountForMaxTemp+=1;

                }elseif($data['OSTime0600Z_Max_Read'] !='' && $data['OSTime1200Z_Max_Read'] ==''){  //not null, null
                    $TotalMax+=$data['OSTime0600Z_Max_Read'];
                    $TotalRowswithDataCountForMaxTemp+=1;

                }
                elseif($data['OSTime0600Z_Max_Read'] =='' && $data['OSTime1200Z_Max_Read'] ==''){  //null,null
                    $TotalMax+=0.0;
                    $TotalRowswithDataCountForMaxTemp+=0;

                }
                ////////////////////////////////// TOTAL MIN TEMPERATURE
                if($data['OSTime0600Z_Min_Read']!='' && $data['OSTime1200Z_Min_Read'] !='' ){  //not null ,not null

                    $TotalMin+=$data['OSTime0600Z_Min_Read'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }elseif($data['OSTime0600Z_Min_Read'] =='' && $data['OSTime1200Z_Min_Read'] !=''){ //null , not null

                    $TotalMin+=$data['OSTime1200Z_Min_Read'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }elseif($data['OSTime0600Z_Min_Read'] !='' && $data['OSTime1200Z_Min_Read'] ==''){  //not null, null
                    $TotalMin+=$data['OSTime0600Z_Min_Read'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }
                elseif($data['OSTime0600Z_Min_Read'] =='' && $data['OSTime1200Z_Min_Read'] ==''){  //null,null
                    $TotalMin+=0;
                    $TotalRowswithDataCountForMinTemp+=0;

                }
                //////////////TOTAL SUNSHINE
                if($data['Sunshine_0600Z']!=''){

                    $TotalSunshine+=$data['Sunshine_0600Z'];
                    $TotalRowswithDataCountForSunshine+=1;
                }
                elseif($data['Sunshine_0600Z']==''){

                    $TotalSunshine+=0.0;
                    $TotalRowswithDataCountForSunshine+=0;
                }

                /////TOTAL DB FOR 0600Z
                if($data['OSTime0600Z_Dry_Bulb']!=''){

                    $TotalDB_0600Z+=$data['OSTime0600Z_Dry_Bulb'];
                    $TotalRowswithDataCountForDB_0600Z+=1;
                }
                elseif($data['OSTime0600Z_Dry_Bulb']==''){

                    $TotalDB_0600Z+=0.0;
                    $TotalRowswithDataCountForDB_0600Z+=0;
                }

                /////TOTAL WB FOR 0600Z
                if($data['OSTime0600Z_Wet_Bulb']!=''){

                    $TotalWB_0600Z+=$data['OSTime0600Z_Wet_Bulb'];
                    $TotalRowswithDataCountForWB_0600Z+=1;
                }
                elseif($data['OSTime0600Z_Wet_Bulb']==''){

                    $TotalWB_0600Z+=0.0;
                    $TotalRowswithDataCountForWB_0600Z+=0;
                }

                /////TOTAL DP FOR 0600Z
                if($data['DewPointTemperature_0600Z']!=''){

                    $TotalDP_0600Z+=$data['DewPointTemperature_0600Z'];
                    $TotalRowswithDataCountForDP_0600Z+=1;
                }
                elseif($data['DewPointTemperature_0600Z']==''){

                    $TotalDP_0600Z+=0.0;
                    $TotalRowswithDataCountForDP_0600Z+=0;
                }

                /////TOTAL VP FOR 0600Z
                if($data['VapourPressure_0600Z']!=''){

                    $TotalVP_0600Z+=$data['VapourPressure_0600Z'];
                    $TotalRowswithDataCountForVP_0600Z+=1;
                }
                elseif($data['VapourPressure_0600Z']==''){

                    $TotalVP_0600Z+=0.0;
                    $TotalRowswithDataCountForVP_0600Z+=0;
                }

                /////TOTAL RH FOR 0600Z
                if($data['RelativeHumidity_0600Z']!=0){

                    $TotalRH_0600Z+=$data['RelativeHumidity_0600Z'];
                    $TotalRowswithDataCountForRH_0600Z+=1;
                }
                elseif($data['RelativeHumidity_0600Z']==0 ||  $data['RelativeHumidity_0600Z']==''){

                    $TotalRH_0600Z+=0.0;
                    $TotalRowswithDataCountForRH_0600Z+=0;
                }

                /////TOTAL CLP FOR 0600Z
                if($data['OSTime0600Z_CLP']!=''){

                    $TotalCLP_0600Z+=$data['OSTime0600Z_CLP'];
                    $TotalRowswithDataCountForCLP_0600Z+=1;
                }
                elseif($data['OSTime0600Z_CLP']==''){

                    $TotalCLP_0600Z+=0.0;
                    $TotalRowswithDataCountForCLP_0600Z+=0;
                }

                /////TOTAL GPM FOR 0600Z
                if($data['GPM_0600Z']!=''){

                    $TotalGPM_0600Z+=$data['GPM_0600Z'];
                    $TotalRowswithDataCountForGPM_0600Z+=1;
                }
                elseif($data['GPM_0600Z']==''){

                    $TotalGPM_0600Z+=0.0;
                    $TotalRowswithDataCountForGPM_0600Z+=0;
                }

                /////TOTAL WIND DIR FOR 0600Z
                if($data['OSTime0600Z_Wind_Direction']!=''){

                    $TotalWIND_DIR_0600Z+=$data['OSTime0600Z_Wind_Direction'];
                    $TotalRowswithDataCountForWIND_DIR_0600Z+=1;
                }
                elseif($data['OSTime0600Z_Wind_Direction']==''){

                    $TotalWIND_DIR_0600Z+=0.0;
                    $TotalRowswithDataCountForWIND_DIR_0600Z+=0;
                }

                /////TOTAL FF FOR 0600Z
                if($data['OSTime0600Z_Wind_Speed']!=''){

                    $TotalFF_0600Z+=$data['OSTime0600Z_Wind_Speed'];
                    $TotalRowswithDataCountForFF_0600Z+=1;
                }
                elseif($data['OSTime0600Z_Wind_Speed']==''){

                    $TotalFF_0600Z+=0.0;
                    $TotalRowswithDataCountForFF_0600Z+=0;
                }

                ///////////////////////////////////TOTALS FOR 1200Z.
                /////TOTAL DB FOR 1200Z
                if($data['OSTime1200Z_Dry_Bulb']!=''){

                    $TotalDB_1200Z+=$data['OSTime1200Z_Dry_Bulb'];
                    $TotalRowswithDataCountForDB_1200Z+=1;
                }
                elseif($data['OSTime1200Z_Dry_Bulb']==''){

                    $TotalDB_1200Z+=0.0;
                    $TotalRowswithDataCountForDB_1200Z+=0;
                }

                /////TOTAL WB FOR 1200Z
                if($data['OSTime1200Z_Wet_Bulb']!=''){

                    $TotalWB_1200Z+=$data['OSTime1200Z_Wet_Bulb'];
                    $TotalRowswithDataCountForWB_1200Z+=1;
                }
                elseif($data['OSTime1200Z_Wet_Bulb']==''){

                    $TotalWB_1200Z+=0.0;
                    $TotalRowswithDataCountForWB_1200Z+=0;
                }

                /////TOTAL DP FOR 1200Z
                if($data['DewPointTemperature_1200Z']!=''){

                    $TotalDP_1200Z+=$data['DewPointTemperature_1200Z'];
                    $TotalRowswithDataCountForDP_1200Z+=1;
                }
                elseif($data['DewPointTemperature_1200Z']==''){

                    $TotalDP_1200Z+=0.0;
                    $TotalRowswithDataCountForDP_1200Z+=0;
                }

                /////TOTAL VP FOR 1200Z
                if($data['VapourPressure_1200Z']!=''){

                    $TotalVP_1200Z+=$data['VapourPressure_1200Z'];
                    $TotalRowswithDataCountForVP_1200Z+=1;
                }
                elseif($data['VapourPressure_1200Z']==''){

                    $TotalVP_1200Z+=0.0;
                    $TotalRowswithDataCountForVP_1200Z+=0;
                }

                /////TOTAL RH FOR 1200Z
                if($data['RelativeHumidity_1200Z']!=0){

                    $TotalRH_1200Z+=$data['RelativeHumidity_1200Z'];
                    $TotalRowswithDataCountForRH_1200Z+=1;
                }
                elseif($data['RelativeHumidity_1200Z']==0 || $data['RelativeHumidity_1200Z']=='' ){

                    $TotalRH_1200Z+=0.0;
                    $TotalRowswithDataCountForRH_1200Z+=0;
                }

                /////TOTAL CLP FOR 1200Z
                if($data['OSTime1200Z_CLP']!=''){

                    $TotalCLP_1200Z+=$data['OSTime1200Z_CLP'];
                    $TotalRowswithDataCountForCLP_1200Z+=1;
                }
                elseif($data['OSTime1200Z_CLP']==''){

                    $TotalCLP_1200Z+=0.0;
                    $TotalRowswithDataCountForCLP_1200Z+=0;
                }

                /////TOTAL GPM FOR 1200Z
                if($data['GPM_1200Z']!=''){

                    $TotalGPM_1200Z+=$data['GPM_1200Z'];
                    $TotalRowswithDataCountForGPM_1200Z+=1;
                }
                elseif($data['GPM_1200Z']==''){

                    $TotalGPM_1200Z+=0.0;
                    $TotalRowswithDataCountForGPM_1200Z+=0;
                }

                /////TOTAL WIND DIR FOR 1200Z
                if($data['OSTime1200Z_Wind_Direction']!=''){

                    $TotalWIND_DIR_1200Z+=$data['OSTime1200Z_Wind_Direction'];
                    $TotalRowswithDataCountForWIND_DIR_1200Z+=1;
                }
                elseif($data['OSTime1200Z_Wind_Direction']==''){

                    $TotalWIND_DIR_1200Z+=0.0;
                    $TotalRowswithDataCountForWIND_DIR_1200Z+=0;
                }

                /////TOTAL FF FOR 1200Z
                if($data['OSTime1200Z_Wind_Speed']!=''){

                    $TotalFF_1200Z+=$data['OSTime1200Z_Wind_Speed'];
                    $TotalRowswithDataCountForFF_1200Z+=1;
                }
                elseif($data['OSTime1200Z_Wind_Speed']==''){

                    $TotalFF_1200Z+=0.0;
                    $TotalRowswithDataCountForFF_1200Z+=0;
                }

                /////TOTAL RAINFALL
                if($data['OSTime0600Z_Rainfall']!='' && $data['OSTime1200Z_Rainfall']!=''){

                    $TotalRainfall+=$data['OSTime0600Z_Rainfall'];
                    $TotalRowswithDataCountForRainfall+=1;
                }
                elseif($data['OSTime0600Z_Rainfall']=='' && $data['OSTime1200Z_Rainfall']!=''){

                    $TotalRainfall+=$data['OSTime1200Z_Rainfall']!='';
                    $TotalRowswithDataCountForRainfall+=1;

                }elseif($data['OSTime0600Z_Rainfall']!='' && $data['OSTime1200Z_Rainfall']==''){

                    $TotalRainfall+=$data['OSTime0600Z_Rainfall']!='';
                    $TotalRowswithDataCountForRainfall+=1;

                }elseif($data['OSTime0600Z_Rainfall']=='' && $data['OSTime1200Z_Rainfall']==''){

                    $TotalRainfall+=0.0;
                    $TotalRowswithDataCountForRainfall+=0;
                }

            }//END OF FOREACH
            //loop thru the array
            foreach($finalarraymerge as $data){ ?>

                <tr>
                    <td class="main"><?php echo $data['Date'];?></td>

                    <?php
                    if($data['OSTime0600Z_Max_Read']!='' && $data['OSTime1200Z_Max_Read']!='' ){
                        //not null,not null
                        ?>
                        <td class="main"><?php echo $data['OSTime0600Z_Max_Read'];?></td>
                    <?php
                    }elseif($data['OSTime0600Z_Max_Read']=='' && $data['OSTime1200Z_Max_Read']!='') {
                        //null,not null
                        ?>
                        <td class="main"><?php echo $data['OSTime1200Z_Max_Read'];?></td>
                    <?php
                    }elseif($data['OSTime0600Z_Max_Read']!='' && $data['OSTime1200Z_Max_Read']=='') {
                        //not null,null
                        ?>
                        <td class="main"><?php echo $data['OSTime0600Z_Max_Read'];?></td>
                    <?php
                    }elseif($data['OSTime0600Z_Max_Read']=='' && $data['OSTime1200Z_Max_Read']=='') {
                        //null,null
                        ?>
                        <td class="main"></td>
                    <?php
                    }//end of else if for MAX TEMP
                    ?>

                    <?php   //min Temp
                    if($data['OSTime0600Z_Min_Read']!='' && $data['OSTime1200Z_Min_Read']!='' ){
                        //not null,not null
                        ?>
                        <td class="main"><?php echo $data['OSTime0600Z_Min_Read'];?></td>
                    <?php
                    }elseif($data['OSTime0600Z_Min_Read']=='' && $data['OSTime1200Z_Min_Read']!='') {
                        //null,not null
                        ?>
                        <td class="main"><?php echo $data['OSTime1200Z_Min_Read'];?></td>
                    <?php
                    }elseif($data['OSTime0600Z_Min_Read']!='' && $data['OSTime1200Z_Min_Read']=='') {
                        //not null,null
                        ?>
                        <td class="main"><?php echo $data['OSTime0600Z_Min_Read'];?></td>
                    <?php
                    }elseif($data['OSTime0600Z_Min_Read']=='' && $data['OSTime1200Z_Min_Read']=='') {
                        //null,null
                        ?>
                        <td class="main"></td>
                    <?php
                    }//end of else if FOR MIN TEMP
                    ?>

                    <td class="main"><?php echo $data['Sunshine_0600Z'];?></td>



                    <td class="main"><?php echo $data['OSTime0600Z_Dry_Bulb'];?></td>
                    <td class="main"><?php echo $data['OSTime0600Z_Wet_Bulb'];?></td>
                    <td class="main"><?php echo $data['DewPointTemperature_0600Z'];?></td>
                    <td class="main"><?php echo $data['VapourPressure_0600Z'];?></td>
                    <td class="main"><?php echo $data['RelativeHumidity_0600Z'];   //RH?></td>
                    <td class="main"><?php echo $data['OSTime0600Z_CLP'];?></td>
                    <td class="main"><?php echo$data['GPM_0600Z'];?></td>
                    <td class="main"><?php echo $data['OSTime0600Z_Wind_Direction'];?></td>
                    <td class="main"><?php echo $data['OSTime0600Z_Wind_Speed'];?></td>




                    <td class="main"><?php echo $data['OSTime1200Z_Dry_Bulb'];?></td>
                    <td class="main"><?php echo $data['OSTime1200Z_Wet_Bulb'];?></td>
                    <td class="main"><?php echo $data['DewPointTemperature_1200Z'];?></td>
                    <td class="main"><?php echo $data['VapourPressure_1200Z'];?></td>
                    <td class="main"><?php echo $data['RelativeHumidity_1200Z'];   //RH?></td>
                    <td class="main"><?php echo $data['OSTime1200Z_CLP'];?></td>
                    <td class="main"><?php echo$data['GPM_1200Z'];?></td>
                    <td class="main"><?php echo $data['OSTime1200Z_Wind_Direction'];?></td>
                    <td class="main"><?php echo $data['OSTime1200Z_Wind_Speed'];?></td>



                    <td class="main"></td>



                    <?php
                    if($data['OSTime0600Z_Rainfall']!='' && $data['OSTime1200Z_Rainfall'] !='' ){
                        if($data['OSTime0600Z_Rainfall'] < 0.1){
                            ?>
                            <td class="main"><?php echo 'TR';?></td>
                            <td class="main"></td>
                        <?php
                        }elseif($data['OSTime0600Z_Rainfall'] > 0.1){
                            ?>
                            <td class="main"><?php echo $data['OSTime0600Z_Rainfall'];?></td>
                            <td class="main"><?php echo '|';?></td>
                        <?php
                        }

                    }
                    elseif($data['OSTime0600Z_Rainfall']=='' && $data['OSTime1200Z_Rainfall']!='') {
                        if($data['OSTime1200Z_Rainfall'] < 0.1){
                            ?>
                            <td class="main"><?php echo 'TR';?></td>
                            <td class="main"></td>
                        <?php
                        }elseif($data['OSTime1200Z_Rainfall'] > 0.1){ ?>
                            <td class="main"><?php echo $data['OSTime1200Z_Rainfall'];?></td>
                            <td class="main"><?php echo '|';?></td>
                        <?php }
                    }
                    elseif($data['OSTime0600Z_Rainfall']!='' && $data['OSTime1200Z_Rainfall']==''){
                        if($data['OSTime0600Z_Rainfall'] < 0.1){
                            ?>
                            <td class="main"><?php echo 'TR';?></td>
                            <td class="main"></td>
                        <?php
                        }elseif($data['OSTime0600Z_Rainfall'] > 0.1){
                            ?>
                            <td class="main"><?php echo $data['OSTime0600Z_Rainfall'];?></td>
                            <td class="main"><?php echo '|';?></td>

                        <?php }
                    }
                    elseif($data['OSTime0600Z_Rainfall']=='' && $data['OSTime1200Z_Rainfall']=='') {
                        ?>
                        <td class="main"></td>
                        <td class="main"></td>
                    <?php } ?>



                    <td class="main"></td>
                    <td class="main"></td>
                    <td class="main"></td>
                    <td class="main"></td>
                    <td class="main"></td>


                </tr>
            <?php }?>
            <tr>
                <td class="main"> TOTAL</td>
                <td class="main"><?php echo round($TotalMax,2);?> </td>
                <td class="main"> <?php echo round($TotalMin,2) ;?></td>
                <td class="main"><?php echo round($TotalSunshine,2) ;?> </td>

                <td class="main"><?php echo round($TotalDB_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalWB_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalDP_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalVP_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalRH_0600Z,2);?> </td>
                <td class="main"><?php echo round($TotalCLP_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalGPM_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalWIND_DIR_0600Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalFF_0600Z,2) ;?> </td>


                <td class="main"><?php echo round($TotalDB_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalWB_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalDP_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalVP_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalRH_1200Z,2);?> </td>
                <td class="main"><?php echo round($TotalCLP_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalGPM_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalWIND_DIR_1200Z,2) ;?> </td>
                <td class="main"><?php echo round($TotalFF_1200Z,2) ;?> </td>


                <td class="main"><?php echo round($TotalWIND_RUN,2) ;?> </td>
                <td class="main"><?php echo round($TotalRainfall,2) ;?> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>

            </tr>
            <tr>
                <?php
                //$TotalMeanMax=$Totalmax/$rowcountwithdata;

                ?>
                <td class="main"> MEAN</td>
                <td class="main"><?php echo round(($TotalMax/$TotalRowswithDataCountForMaxTemp),2) ;?></td>
                <td class="main"><?php echo round(($TotalMin/$TotalRowswithDataCountForMinTemp),2) ;?> </td>
                <td class="main"><?php echo round($TotalSunshine/$TotalRowswithDataCountForSunshine,2) ;?> </td>


                <td class="main"><?php echo round(($TotalDB_0600Z/$TotalRowswithDataCountForDB_0600Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalWB_0600Z/$TotalRowswithDataCountForWB_0600Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalDP_0600Z/$TotalRowswithDataCountForDP_0600Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalVP_0600Z/$TotalRowswithDataCountForVP_0600Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalRH_0600Z/$TotalRowswithDataCountForRH_0600Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalCLP_0600Z/$TotalRowswithDataCountForCLP_0600Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalGPM_0600Z/$TotalRowswithDataCountForGPM_0600Z),2);?> </td>
                <td class="main"><?php echo round($TotalWIND_DIR_0600Z/$TotalRowswithDataCountForWIND_DIR_0600Z,2) ;?> </td>
                <td class="main"><?php echo round(($TotalFF_0600Z/$TotalRowswithDataCountForFF_0600Z),2) ;?> </td>


                <td class="main"><?php echo round(($TotalDB_1200Z/$TotalRowswithDataCountForDB_1200Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalWB_1200Z/$TotalRowswithDataCountForWB_1200Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalDP_1200Z/$TotalRowswithDataCountForDP_1200Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalVP_1200Z/$TotalRowswithDataCountForVP_1200Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalRH_1200Z/$TotalRowswithDataCountForRH_1200Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalCLP_1200Z/$TotalRowswithDataCountForCLP_1200Z),2) ;?> </td>
                <td class="main"><?php echo round(($TotalGPM_1200Z/$TotalRowswithDataCountForGPM_1200Z),2);?> </td>
                <td class="main"><?php echo round($TotalWIND_DIR_1200Z/$TotalRowswithDataCountForWIND_DIR_1200Z,2) ;?> </td>
                <td class="main"><?php echo round(($TotalFF_1200Z/$TotalRowswithDataCountForFF_1200Z),2) ;?> </td>


                <td class="main"><?php echo round($TotalWIND_RUN/$rowcountwithdata,2) ;?> </td>
                <td class="main"><?php echo round(($TotalRainfall/$TotalRowswithDataCountForRainfall),2) ;?> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
                <td class="main"> </td>
            </tr>


            </table>
        <?php  }//end of if array loop

        ?>
        <br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print"  data-export="export"><i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/WeatherSummaryReport/"; ?>" class="btn btn-warning pull-right"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>


    <?php
    }   ?>
    </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2
     <script src="js/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#generateweathersummaryreport_button').click(function(event) {


                //Check that the a station is selected from the list Managerations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.
                    $("#stationManager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoManager=$('#stationNoManager').val();
                if(stationNoManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoManager').val("");  //Clear the field.
                    $("#stationNoManager").focus();
                    return false;

                }
/////////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the a station is selected from the list of stations(Manager)
                var stationOC=$('#stationOC').val();
                if(stationOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#stationOC').val("");  //Clear the field.
                    $("#stationOC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoOC=$('#stationNoOC').val();
                if(stationNoOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoOC').val("");  //Clear the field.
                    $("#stationNoOC").focus();
                    return false;

                }
                //////////////////////////////////////////////////////////////////////////////////////////////               //////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the MONTH is selected from the list of MONTHS
                var month=$('#month').val();
                if(month==""){  // returns true if the variable does NOT contain a valid number
                    alert("Month not Selected from the List");
                    $('#month').val("");  //Clear the field.
                    $("#month").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the YEAR is selected from the list of Year
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Year not Selected");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();
                    return false;

                }

            });
        });
    </script>
    <script type="text/javascript">
        //Once the Admin selects the Station the Station Number should be picked from the DB.
        // For Add Update Daily
        $(document).on('change','#stationManager',function(){
            $('#stationNoManager').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoManager').val("");
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/getStationNumber",
                    type: "POST",
                    data: {'stationName': stationName},
                    cache: false,
                    //dataType: "JSON",
                    success: function(data){
                        if (data)
                        {
                            var json = JSON.parse(data);

                            $('#stationNoManager').empty();

                            // alert(data);
                            $("#stationNoManager").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoManager').empty();
                            $('#stationNoManager').val("");

                        }
                    }

                });



            }
            else {

                $('#stationNoManager').empty();
                $('#stationNoManager').val("");
            }

        })
    </script>





<?php require_once(APPPATH . 'views/footer.php'); ?>