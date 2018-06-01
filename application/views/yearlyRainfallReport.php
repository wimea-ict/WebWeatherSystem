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
            Yearly Rainfall Report
            <small>Preview Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Yearly Rainfall Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/YearlyRainfallReport/displayyearlyrainfallreport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='OC'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='ManagerData' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherAnalyst" || $userrole=="WeatherForecaster"){?>
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
                                <input type="text" name="stationNoOC" id="stationNoOC" required class="form-control" value="<?php echo $userstationNo;?>" required placeholder="Please select station Number" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }elseif($userrole=='ManagerData' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherAnalyst" || $userrole=="WeatherForecaster"){?>
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
                            <span class="input-group-addon">Select Year</span>
                            <input type="text" name="year" id="year" class="form-control metaryear" placeholder="Please select year" >
                        </div>
                    </div>
                </div>


                <div class="col-xs-2">
                    <input type="submit" name="displayyearannualreportrainfallreport_button" id="displayyearannualreportrainfallreport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>

    <?php
    if(is_array($displayYearlyRainfallReportHeaderFields) &&
    count($displayYearlyRainfallReportHeaderFields)){

    $year= $displayYearlyRainfallReportHeaderFields['year'];
    //$month= $displayYearlyRainfallReportHeaderFields['month'];
    $stationName=$displayYearlyRainfallReportHeaderFields['stationName'];

    $stationNumber=$displayYearlyRainfallReportHeaderFields['stationNumber'];
    echo $stationNumber;
    ?>

    <span><strong>RAINFALL OBSERVATION AT</strong></span>
    <span class="dotted-line"><?php echo $stationName;?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>FOR THE YEAR</strong></span> <span class="dotted-line"><?php echo $year;?></span>

    <div class="clearfix"></div>
    <br>
    <table class="report-table" id="table2excel">

    <tr>
        <td class="main">Date </td>
        <td class="main">Jan</td>
        <td class="main">Feb</td>
        <td class="main">March</td>
        <td class="main">April</td>
        <td class="main">May</td>
        <td class="main">June</td>
        <td class="main">July</td>
        <td class="main">Aug</td>
        <td class="main">Sept</td>
        <td class="main">Oct</td>
        <td class="main">Nov</td>
        <td class="main">Dec</td>
    </tr>

    <?php
    
    //Pick the different arrays from the DB Populated with data.But these arrays might not contain the
    //total number of days that make up the month
    if (is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary) ||is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary)
    || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch) || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril)
    || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay) || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune)
    || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly) || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust)
    || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember) || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober)
    || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember) || is_array($monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember)
    ) {





    //Create Arrays to store data to be formated e.g if data for a day is missing we insert blank there
    $array_rainfallForMonthOfJanuary=array();
    $array_rainfallForMonthOfFebruary=array();

    $array_rainfallForMonthOfMarch=array();
    $array_rainfallForMonthOfApril=array();

    $array_rainfallForMonthOfMay=array();
    $array_rainfallForMonthOfJune=array();

    $array_rainfallForMonthOfJuly=array();
    $array_rainfallForMonthOfAugust=array();

    $array_rainfallForMonthOfSeptember=array();
    $array_rainfallForMonthOfOctober=array();

    $array_rainfallForMonthOfNovember=array();
    $array_rainfallForMonthOfDecember=array();

    //First loop thru  the arrays  and then  insert it into the different array we have created
    //format if day not there.Put blank in that space
    //the days of the Month
    //THE MONTH OF JAN
    $getNumberOfdaysInTheMonthOfJAN=cal_days_in_month(CAL_GREGORIAN,'1',$year);
    $print1=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfJanuary[$daynum-1]["JanuaryDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfJanuary[$daynum-1]["JanuaryRainfall"]=$data->Rainfall;

                $print1=1;

                break;
            }//end of if
            else{

                $print1=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print1==0){

            $array_rainfallForMonthOfJanuary[$daynum-1]["JanuaryDayNumber"]=$daynum;
            $array_rainfallForMonthOfJanuary[$daynum-1]["JanuaryRainfall"]='';

        }//end of if
    }//end of for loop for JANUARY RAINFALL.


    /////////////////////////////////
    //THE MONTH OF FEB
    $getNumberOfdaysInTheMonthOfFEB=cal_days_in_month(CAL_GREGORIAN,'2',$year);
    $print2=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfFebruary[$daynum-1]["FebruaryDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfFebruary[$daynum-1]["FebruaryRainfall"]=$data->Rainfall;

                $print2=1;

                break;
            }//end of if
            else{

                $print2=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print2==0){

            $array_rainfallForMonthOfFebruary[$daynum-1]["FebruaryDayNumber"]=$daynum;
            $array_rainfallForMonthOfFebruary[$daynum-1]["FebruaryRainfall"]='';

        }//end of if
    }//end of for loop for FEBRUARY RAINFALL.
    ///////////////////////////////////////////////////////////
    //THE MONTH OF MARCH
    $getNumberOfdaysInTheMonthOfMARCH=cal_days_in_month(CAL_GREGORIAN,'3',$year);
    $print3=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfMarch[$daynum-1]["MarchDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfMarch[$daynum-1]["MarchRainfall"]=$data->Rainfall;

                $print3=1;

                break;
            }//end of if
            else{

                $print3=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print3==0){

            $array_rainfallForMonthOfMarch[$daynum-1]["MarchDayNumber"]=$daynum;
            $array_rainfallForMonthOfMarch[$daynum-1]["MarchRainfall"]='';

        }//end of if
    }//end of for loop for MARCH RAINFALL.

    /////////////////////////////////////////////////////////////
    //THE MONTH OF APRIL
    $getNumberOfdaysInTheMonthOfAPRIL=cal_days_in_month(CAL_GREGORIAN,'4',$year);
    $print4=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfApril[$daynum-1]["AprilDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfApril[$daynum-1]["AprilRainfall"]=$data->Rainfall;

                $print4=1;

                break;
            }//end of if
            else{

                $print4=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print4==0){

            $array_rainfallForMonthOfApril[$daynum-1]["AprilDayNumber"]=$daynum;
            $array_rainfallForMonthOfApril[$daynum-1]["AprilRainfall"]='';

        }//end of if
    }//end of for loop for APRIL RAINFALL.
    ///////////////////////////////////////////////////////////
    //THE MONTH OF MAY
    $getNumberOfdaysInTheMonthOfMAY=cal_days_in_month(CAL_GREGORIAN,'5',$year);
    $print5=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfMay[$daynum-1]["MayDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfMay[$daynum-1]["MayRainfall"]=$data->Rainfall;

                $print5=1;

                break;
            }//end of if
            else{

                $print5=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print5==0){

            $array_rainfallForMonthOfMay[$daynum-1]["MayDayNumber"]=$daynum;
            $array_rainfallForMonthOfMay[$daynum-1]["MayRainfall"]='';

        }//end of if
    }//end of for loop for MAY RAINFALL.

    /////////////////////////////////////////////////////////////////////
    //THE MONTH OF JUNE
    $getNumberOfdaysInTheMonthOfJUNE=cal_days_in_month(CAL_GREGORIAN,'6',$year);
    $print6=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfJune[$daynum-1]["JuneDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfJune[$daynum-1]["JuneRainfall"]=$data->Rainfall;

                $print6=1;

                break;
            }//end of if
            else{

                $print6=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print6==0){

            $array_rainfallForMonthOfJune[$daynum-1]["JuneDayNumber"]=$daynum;
            $array_rainfallForMonthOfJune[$daynum-1]["JuneRainfall"]='';

        }//end of if
    }//end of for loop for JUNE RAINFALL.

    ///////////////////////////////////////////////////////////////////
    //THE MONTH OF JULY
    $getNumberOfdaysInTheMonthOfJULY=cal_days_in_month(CAL_GREGORIAN,'7',$year);
    $print7=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfJuly[$daynum-1]["JulyDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfJuly[$daynum-1]["JulyRainfall"]=$data->Rainfall;

                $print7=1;

                break;
            }//end of if
            else{

                $print7=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print7==0){

            $array_rainfallForMonthOfJuly[$daynum-1]["JulyDayNumber"]=$daynum;
            $array_rainfallForMonthOfJuly[$daynum-1]["JulyRainfall"]='';

        }//end of if
    }//end of for loop for JULY RAINFALL.
    //////////////////////////////////////////////////////////////////
    //THE MONTH OF AUGUST
    $getNumberOfdaysInTheMonthOfAUGUST=cal_days_in_month(CAL_GREGORIAN,'8',$year);
    $print8=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfAugust[$daynum-1]["AugustDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfAugust[$daynum-1]["AugustRainfall"]=$data->Rainfall;

                $print8=1;

                break;
            }//end of if
            else{

                $print8=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print8==0){

            $array_rainfallForMonthOfAugust[$daynum-1]["AugustDayNumber"]=$daynum;
            $array_rainfallForMonthOfAugust[$daynum-1]["AugustRainfall"]='';

        }//end of if
    }//end of for loop for AUGUST RAINFALL.
    ///////////////////////////////////////////////////////////
    //THE MONTH OF SEPT
    $getNumberOfdaysInTheMonthOfSEPT=cal_days_in_month(CAL_GREGORIAN,'9',$year);
    $print9=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfSeptember[$daynum-1]["SeptemberDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfSeptember[$daynum-1]["SeptemberRainfall"]=$data->Rainfall;

                $print9=1;

                break;
            }//end of if
            else{

                $print9=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print9==0){

            $array_rainfallForMonthOfSeptember[$daynum-1]["SeptemberDayNumber"]=$daynum;
            $array_rainfallForMonthOfSeptember[$daynum-1]["SeptemberRainfall"]='';

        }//end of if
    }//end of for loop for SEPTEMBER RAINFALL.
    ///////////////////////////////////////////////////////////////////
    //THE MONTH OF OCT
    $getNumberOfdaysInTheMonthOfOCT=cal_days_in_month(CAL_GREGORIAN,'10',$year);
    $print10=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfOctober[$daynum-1]["OctoberDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfOctober[$daynum-1]["OctoberRainfall"]=$data->Rainfall;

                $print10=1;

                break;
            }//end of if
            else{

                $print10=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print10==0){

            $array_rainfallForMonthOfOctober[$daynum-1]["OctoberDayNumber"]=$daynum;
            $array_rainfallForMonthOfOctober[$daynum-1]["OctoberRainfall"]='';

        }//end of if
    }//end of for loop for OCTOBER RAINFALL.

    ///////////////////////////////////////////////////////////////////
    //THE MONTH OF NOV
    $getNumberOfdaysInTheMonthOfNOV=cal_days_in_month(CAL_GREGORIAN,'11',$year);
    $print11=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfNovember[$daynum-1]["NovemberDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfNovember[$daynum-1]["NovemberRainfall"]=$data->Rainfall;

                $print11=1;

                break;
            }//end of if
            else{

                $print11=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print11==0){

            $array_rainfallForMonthOfNovember[$daynum-1]["NovemberDayNumber"]=$daynum;
            $array_rainfallForMonthOfNovember[$daynum-1]["NovemberRainfall"]='';

        }//end of if
    }//end of for loop for NOVEMBER RAINFALL.

    /////////////////////////////////////////////////////////////////////
    //THE MONTH OF DEC
    $getNumberOfdaysInTheMonthOfDEC=cal_days_in_month(CAL_GREGORIAN,'12',$year);
    $print12=0;
    for($daynum = 1; $daynum<=31; $daynum++ ){

        foreach($monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember as $data){
            // if the day exists in the array we populate it into another array else we
            if ($daynum==$data->DayOfTheMonth) {

                $array_rainfallForMonthOfDecember[$daynum-1]["DecemberDayNumber"]=$data->DayOfTheMonth;
                $array_rainfallForMonthOfDecember[$daynum-1]["DecemberRainfall"]=$data->Rainfall;

                $print12=1;

                break;
            }//end of if
            else{

                $print12=0;
            }

        } //end of foreach to print all values that are in the report array
        //if the day does not exist we populate it into array but in right order
        if($print12==0){

            $array_rainfallForMonthOfDecember[$daynum-1]["DecemberDayNumber"]=$daynum;
            $array_rainfallForMonthOfDecember[$daynum-1]["DecemberRainfall"]='';

        }//end of if
    }//end of for loop for DECEMBER RAINFALL.
    ?>
    <?php
    //nid to create an array with row contain each (corresponding e.g first of each row) row of each array of the month
    $finalarraymerge=array();
    $i = 0;

    for($daynum = 1; $daynum<=31; $daynum++ ){
        //MONTH OF JAN
        $finalarraymerge [$i]["JanuaryDayNumber"]= $array_rainfallForMonthOfJanuary[$i]['JanuaryDayNumber'];
        $finalarraymerge [$i]["JanuaryRainfall"]= $array_rainfallForMonthOfJanuary[$i]['JanuaryRainfall'];

        //MONTH OF FEB
        $finalarraymerge [$i]["FebruaryDayNumber"]= $array_rainfallForMonthOfFebruary[$i]['FebruaryDayNumber'];
        $finalarraymerge [$i]["FebruaryRainfall"]= $array_rainfallForMonthOfFebruary[$i]['FebruaryRainfall'];


        //MONTH OF MARCH
        $finalarraymerge [$i]["MarchDayNumber"]= $array_rainfallForMonthOfMarch[$i]['MarchDayNumber'];
        $finalarraymerge [$i]["MarchRainfall"]= $array_rainfallForMonthOfMarch[$i]['MarchRainfall'];

        //MONTH OF APRIL
        $finalarraymerge [$i]["AprilDayNumber"]= $array_rainfallForMonthOfApril[$i]['AprilDayNumber'];
        $finalarraymerge [$i]["AprilRainfall"]= $array_rainfallForMonthOfApril[$i]['AprilRainfall'];

        //MONTH OF MAY
        $finalarraymerge [$i]["MayDayNumber"]= $array_rainfallForMonthOfMay[$i]['MayDayNumber'];
        $finalarraymerge [$i]["MayRainfall"]= $array_rainfallForMonthOfMay[$i]['MayRainfall'];

        //MONTH OF JUNE
        $finalarraymerge [$i]["JuneDayNumber"]= $array_rainfallForMonthOfJune[$i]['JuneDayNumber'];
        $finalarraymerge [$i]["JuneRainfall"]= $array_rainfallForMonthOfJune[$i]['JuneRainfall'];

        //MONTH OF JULY
        $finalarraymerge [$i]["JulyDayNumber"]= $array_rainfallForMonthOfJuly[$i]['JulyDayNumber'];
        $finalarraymerge [$i]["JulyRainfall"]= $array_rainfallForMonthOfJuly[$i]['JulyRainfall'];

        //MONTH OF AUGUST
        $finalarraymerge [$i]["AugustDayNumber"]= $array_rainfallForMonthOfAugust[$i]['AugustDayNumber'];
        $finalarraymerge [$i]["AugustRainfall"]= $array_rainfallForMonthOfAugust[$i]['AugustRainfall'];

        //MONTH OF SEPT
        $finalarraymerge [$i]["SeptemberDayNumber"]= $array_rainfallForMonthOfSeptember[$i]['SeptemberDayNumber'];
        $finalarraymerge [$i]["SeptemberRainfall"]= $array_rainfallForMonthOfSeptember[$i]['SeptemberRainfall'];

        //MONTH OF OCT
        $finalarraymerge [$i]["OctoberDayNumber"]= $array_rainfallForMonthOfOctober[$i]['OctoberDayNumber'];
        $finalarraymerge [$i]["OctoberRainfall"]= $array_rainfallForMonthOfOctober[$i]['OctoberRainfall'];

        //MONTH OF NOV
        $finalarraymerge [$i]["NovemberDayNumber"]= $array_rainfallForMonthOfNovember[$i]['NovemberDayNumber'];
        $finalarraymerge [$i]["NovemberRainfall"]= $array_rainfallForMonthOfNovember[$i]['NovemberRainfall'];

        //MONTH OF DEC
        $finalarraymerge [$i]["DecemberDayNumber"]= $array_rainfallForMonthOfDecember[$i]['DecemberDayNumber'];
        $finalarraymerge [$i]["DecemberRainfall"]= $array_rainfallForMonthOfDecember[$i]['DecemberRainfall'];


        $i++;
    }  //end of for loop.
    ?>
    <?php
    //Loop thr the final array start from the index one(wic is two)
    $indexNo = 1;

    for($daynum = 1; $daynum<31; $daynum++ ){ ?>

        <tr>
            <td><?php echo $finalarraymerge[$daynum]["JanuaryDayNumber"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["JanuaryRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["FebruaryRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["MarchRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["AprilRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["MayRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["JuneRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["JulyRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["AugustRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["SeptemberRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["OctoberRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["NovemberRainfall"];?></td>
            <td><?php echo $finalarraymerge[$daynum]["DecemberRainfall"];?></td>
        </tr>
    <?php  }//end of for loop
    ?>
    <tr>
        <td class="main">1st of </td>
        <td class="main">Feb</td>
        <td class="main">March</td>
        <td class="main">April</td>
        <td class="main">May</td>
        <td class="main">June</td>
        <td class="main">July</td>
        <td class="main">Aug</td>
        <td class="main">Sept</td>
        <td class="main">Oct</td>
        <td class="main">Nov</td>
        <td class="main">Dec</td>
        <td class="main">Jan</td>
    </tr>

    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


    </tr>

    <tr>
        <td>Total to date</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


    </tr>

    <tr>
        <td>No. of days</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


    </tr>

    <tr>
        <td>Average</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


    </tr>

    <tr>
        <td>Year</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


    </tr>

    <tr>
        <td>.</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


    </tr>
    </table>
    <?php  } //end of if for array dbs ?>
    <br><br>
    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
        <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br><br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/YearlyRainfallReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
        <?php }?>

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
            $('#displayyearannualreportrainfallreport_button').click(function(event) {


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