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
           Archived Yearly Rainfall Report
            <small>Preview Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archived Yearly Rainfall Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedYearlyRainfallFormReportData/displayArchivedYearlyRainfallFormReport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='OC'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='ManagerData' || $userrole=='DataOfficer'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <select name="stationManager" id="stationManager" required  class="form-control" placeholder="Select Station">
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

                <?php }elseif($userrole=='ManagerData'  || $userrole=='DataOfficer'){?>
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
                    <input type="submit" name="displayarchivedyearannualreportrainfall_button" id="displayarchivedyearannualreportrainfall_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>

    <?php
    if(is_array($displayArchivedYearlyRainfallFormReportHeaderFields) && count($displayArchivedYearlyRainfallFormReportHeaderFields)){

        $year= $displayArchivedYearlyRainfallFormReportHeaderFields['year'];
        //$month= $displayYearlyRainfallReportHeaderFields['month'];
        $stationName=$displayArchivedYearlyRainfallFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedYearlyRainfallFormReportHeaderFields['stationNumber'];
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
        if (is_array($archivedmonthlyrainfallreportdataForMonthOfJanuary) ||is_array($archivedmonthlyrainfallreportdataForMonthOfFebruary)
            || is_array($archivedmonthlyrainfallreportdataForMonthOfMarch) || is_array($archivedmonthlyrainfallreportdataForMonthOfApril)
            || is_array($archivedmonthlyrainfallreportdataForMonthOfMay) || is_array($archivedmonthlyrainfallreportdataForMonthOfJune)
            || is_array($archivedmonthlyrainfallreportdataForMonthOfJuly) || is_array($archivedmonthlyrainfallreportdataForMonthOfAugust)
            || is_array($archivedmonthlyrainfallreportdataForMonthOfSeptember) || is_array($archivedmonthlyrainfallreportdataForMonthOfOctober)
            || is_array($archivedmonthlyrainfallreportdataForMonthOfNovember) || is_array($archivedmonthlyrainfallreportdataForMonthOfDecember)
        ) {



            //Create Arrays to store data to be formated e.g if data for a day is missing we insert it
            $array_archivedrainfallForMonthOfJanuary=array();
            $array_archivedrainfallForMonthOfFebruary=array();

            $array_archivedrainfallForMonthOfMarch=array();
            $array_archivedrainfallForMonthOfApril=array();

            $array_archivedrainfallForMonthOfMay=array();
            $array_archivedrainfallForMonthOfJune=array();

            $array_archivedrainfallForMonthOfJuly=array();
            $array_archivedrainfallForMonthOfAugust=array();

            $array_archivedrainfallForMonthOfSeptember=array();
            $array_archivedrainfallForMonthOfOctober=array();

            $array_archivedrainfallForMonthOfNovember=array();
            $array_archivedrainfallForMonthOfDecember=array();

            //First loop thru  the arrays  and then  insert it into the different array we have created
            //format if day not there.
            //the days of the Month
            //THE MONTH OF JAN
            $getNumberOfdaysInTheMonthOfJAN=cal_days_in_month(CAL_GREGORIAN,'1',$year);
            $print1=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfJanuary as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfJanuary[$daynum-1]["JanuaryDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfJanuary[$daynum-1]["JanuaryRainfall"]=$data->Rainfall;

                        $print1=1;

                        break;
                    }//end of if
                    else{

                        $print1=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print1==0){

                    $array_archivedrainfallForMonthOfJanuary[$daynum-1]["JanuaryDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfJanuary[$daynum-1]["JanuaryRainfall"]='';

                }//end of if
            }//end of for loop for JANUARY RAINFALL.


            /////////////////////////////////
            //THE MONTH OF FEB
            $getNumberOfdaysInTheMonthOfFEB=cal_days_in_month(CAL_GREGORIAN,'2',$year);
            $print2=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfFebruary as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfFebruary[$daynum-1]["FebruaryDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfFebruary[$daynum-1]["FebruaryRainfall"]=$data->Rainfall;

                        $print2=1;

                        break;
                    }//end of if
                    else{

                        $print2=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print2==0){

                    $array_archivedrainfallForMonthOfFebruary[$daynum-1]["FebruaryDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfFebruary[$daynum-1]["FebruaryRainfall"]='';

                }//end of if
            }//end of for loop for FEBRUARY RAINFALL.
            ///////////////////////////////////////////////////////////
            //THE MONTH OF MARCH
            $getNumberOfdaysInTheMonthOfMARCH=cal_days_in_month(CAL_GREGORIAN,'3',$year);
            $print3=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfMarch as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfMarch[$daynum-1]["MarchDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfMarch[$daynum-1]["MarchRainfall"]=$data->Rainfall;

                        $print3=1;

                        break;
                    }//end of if
                    else{

                        $print3=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print3==0){

                    $array_archivedrainfallForMonthOfMarch[$daynum-1]["MarchDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfMarch[$daynum-1]["MarchRainfall"]='';

                }//end of if
            }//end of for loop for MARCH RAINFALL.

            /////////////////////////////////////////////////////////////
            //THE MONTH OF APRIL
            $getNumberOfdaysInTheMonthOfAPRIL=cal_days_in_month(CAL_GREGORIAN,'4',$year);
            $print4=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfApril as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfApril[$daynum-1]["AprilDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfApril[$daynum-1]["AprilRainfall"]=$data->Rainfall;

                        $print4=1;

                        break;
                    }//end of if
                    else{

                        $print4=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print4==0){

                    $array_archivedrainfallForMonthOfApril[$daynum-1]["AprilDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfApril[$daynum-1]["AprilRainfall"]='';

                }//end of if
            }//end of for loop for APRIL RAINFALL.
            ///////////////////////////////////////////////////////////
            //THE MONTH OF MAY
            $getNumberOfdaysInTheMonthOfMAY=cal_days_in_month(CAL_GREGORIAN,'5',$year);
            $print5=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfMay as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfMay[$daynum-1]["MayDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfMay[$daynum-1]["MayRainfall"]=$data->Rainfall;

                        $print5=1;

                        break;
                    }//end of if
                    else{

                        $print5=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print5==0){

                    $array_archivedrainfallForMonthOfMay[$daynum-1]["MayDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfMay[$daynum-1]["MayRainfall"]='';

                }//end of if
            }//end of for loop for MAY RAINFALL.

            /////////////////////////////////////////////////////////////////////
            //THE MONTH OF JUNE
            $getNumberOfdaysInTheMonthOfJUNE=cal_days_in_month(CAL_GREGORIAN,'6',$year);
            $print6=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfJune as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfJune[$daynum-1]["JuneDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfJune[$daynum-1]["JuneRainfall"]=$data->Rainfall;

                        $print6=1;

                        break;
                    }//end of if
                    else{

                        $print6=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print6==0){

                    $array_archivedrainfallForMonthOfJune[$daynum-1]["JuneDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfJune[$daynum-1]["JuneRainfall"]='';

                }//end of if
            }//end of for loop for JUNE RAINFALL.

            ///////////////////////////////////////////////////////////////////
            //THE MONTH OF JULY
            $getNumberOfdaysInTheMonthOfJULY=cal_days_in_month(CAL_GREGORIAN,'7',$year);
            $print7=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfJuly as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfJuly[$daynum-1]["JulyDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfJuly[$daynum-1]["JulyRainfall"]=$data->Rainfall;

                        $print7=1;

                        break;
                    }//end of if
                    else{

                        $print7=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print7==0){

                    $array_archivedrainfallForMonthOfJuly[$daynum-1]["JulyDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfJuly[$daynum-1]["JulyRainfall"]='';

                }//end of if
            }//end of for loop for JULY RAINFALL.
            //////////////////////////////////////////////////////////////////
            //THE MONTH OF AUGUST
            $getNumberOfdaysInTheMonthOfAUGUST=cal_days_in_month(CAL_GREGORIAN,'8',$year);
            $print8=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfAugust as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfAugust[$daynum-1]["AugustDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfAugust[$daynum-1]["AugustRainfall"]=$data->Rainfall;

                        $print8=1;

                        break;
                    }//end of if
                    else{

                        $print8=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print8==0){

                    $array_archivedrainfallForMonthOfAugust[$daynum-1]["AugustDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfAugust[$daynum-1]["AugustRainfall"]='';

                }//end of if
            }//end of for loop for AUGUST RAINFALL.
            ///////////////////////////////////////////////////////////
            //THE MONTH OF SEPT
            $getNumberOfdaysInTheMonthOfSEPT=cal_days_in_month(CAL_GREGORIAN,'9',$year);
            $print9=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfSeptember as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfSeptember[$daynum-1]["SeptemberDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfSeptember[$daynum-1]["SeptemberRainfall"]=$data->Rainfall;

                        $print9=1;

                        break;
                    }//end of if
                    else{

                        $print9=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print9==0){

                    $array_archivedrainfallForMonthOfSeptember[$daynum-1]["SeptemberDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfSeptember[$daynum-1]["SeptemberRainfall"]='';

                }//end of if
            }//end of for loop for SEPTEMBER RAINFALL.
            ///////////////////////////////////////////////////////////////////
            //THE MONTH OF OCTOBER
            $getNumberOfdaysInTheMonthOfOCT=cal_days_in_month(CAL_GREGORIAN,'10',$year);
            $print10=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfOctober as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfOctober[$daynum-1]["OctoberDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfOctober[$daynum-1]["OctoberRainfall"]=$data->Rainfall;

                        $print10=1;

                        break;
                    }//end of if
                    else{

                        $print10=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print10==0){

                    $array_archivedrainfallForMonthOfOctober[$daynum-1]["OctoberDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfOctober[$daynum-1]["OctoberRainfall"]='';

                }//end of if
            }//end of for loop for OCTOBER RAINFALL.

            ///////////////////////////////////////////////////////////////////
            //THE MONTH OF NOVEMBER
            $getNumberOfdaysInTheMonthOfNOV=cal_days_in_month(CAL_GREGORIAN,'11',$year);
            $print11=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfNovember as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfNovember[$daynum-1]["NovemberDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfNovember[$daynum-1]["NovemberRainfall"]=$data->Rainfall;

                        $print11=1;

                        break;
                    }//end of if
                    else{

                        $print11=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print11==0){

                    $array_archivedrainfallForMonthOfNovember[$daynum-1]["NovemberDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfNovember[$daynum-1]["NovemberRainfall"]='';

                }//end of if
            }//end of for loop for NOVEMBER RAINFALL.

            /////////////////////////////////////////////////////////////////////
            //THE MONTH OF DEC
            $getNumberOfdaysInTheMonthOfDEC=cal_days_in_month(CAL_GREGORIAN,'12',$year);
            $print12=0;
            for($daynum = 1; $daynum<=31; $daynum++ ){

                foreach($archivedmonthlyrainfallreportdataForMonthOfDecember as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedrainfallForMonthOfDecember[$daynum-1]["DecemberDayNumber"]=$data->DayOfTheMonth;
                        $array_archivedrainfallForMonthOfDecember[$daynum-1]["DecemberRainfall"]=$data->Rainfall;

                        $print12=1;

                        break;
                    }//end of if
                    else{

                        $print12=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print12==0){

                    $array_archivedrainfallForMonthOfDecember[$daynum-1]["DecemberDayNumber"]=$daynum;
                    $array_archivedrainfallForMonthOfDecember[$daynum-1]["DecemberRainfall"]='';

                }//end of if
            }//end of for loop for DECEMBER RAINFALL.
            ?>
            <?php
            //nid to create an array with row contain each (corresponding e.g first of each row) row of each array
            $finalarraymerge=array();
            $i = 0;

            for($daynum = 1; $daynum<=31; $daynum++ ){
                //MONTH OF JAN
                $finalarraymerge [$i]["JanuaryDayNumber"]= $array_archivedrainfallForMonthOfJanuary[$i]['JanuaryDayNumber'];
                $finalarraymerge [$i]["JanuaryRainfall"]= $array_archivedrainfallForMonthOfJanuary[$i]['JanuaryRainfall'];

                //MONTH OF FEB
                $finalarraymerge [$i]["FebruaryDayNumber"]= $array_archivedrainfallForMonthOfFebruary[$i]['FebruaryDayNumber'];
                $finalarraymerge [$i]["FebruaryRainfall"]= $array_archivedrainfallForMonthOfFebruary[$i]['FebruaryRainfall'];


                //MONTH OF MARCH
                $finalarraymerge [$i]["MarchDayNumber"]= $array_archivedrainfallForMonthOfMarch[$i]['MarchDayNumber'];
                $finalarraymerge [$i]["MarchRainfall"]= $array_archivedrainfallForMonthOfMarch[$i]['MarchRainfall'];

                //MONTH OF APRIL
                $finalarraymerge [$i]["AprilDayNumber"]= $array_archivedrainfallForMonthOfApril[$i]['AprilDayNumber'];
                $finalarraymerge [$i]["AprilRainfall"]= $array_archivedrainfallForMonthOfApril[$i]['AprilRainfall'];

                //MONTH OF MAY
                $finalarraymerge [$i]["MayDayNumber"]= $array_archivedrainfallForMonthOfMay[$i]['MayDayNumber'];
                $finalarraymerge [$i]["MayRainfall"]= $array_archivedrainfallForMonthOfMay[$i]['MayRainfall'];

                //MONTH OF JUNE
                $finalarraymerge [$i]["JuneDayNumber"]= $array_archivedrainfallForMonthOfJune[$i]['JuneDayNumber'];
                $finalarraymerge [$i]["JuneRainfall"]= $array_archivedrainfallForMonthOfJune[$i]['JuneRainfall'];

                //MONTH OF JULY
                $finalarraymerge [$i]["JulyDayNumber"]= $array_archivedrainfallForMonthOfJuly[$i]['JulyDayNumber'];
                $finalarraymerge [$i]["JulyRainfall"]= $array_archivedrainfallForMonthOfJuly[$i]['JulyRainfall'];

                //MONTH OF AUGUST
                $finalarraymerge [$i]["AugustDayNumber"]= $array_archivedrainfallForMonthOfAugust[$i]['AugustDayNumber'];
                $finalarraymerge [$i]["AugustRainfall"]= $array_archivedrainfallForMonthOfAugust[$i]['AugustRainfall'];

                //MONTH OF SEPT
                $finalarraymerge [$i]["SeptemberDayNumber"]= $array_archivedrainfallForMonthOfSeptember[$i]['SeptemberDayNumber'];
                $finalarraymerge [$i]["SeptemberRainfall"]= $array_archivedrainfallForMonthOfSeptember[$i]['SeptemberRainfall'];

                //MONTH OF OCT
                $finalarraymerge [$i]["OctoberDayNumber"]= $array_archivedrainfallForMonthOfOctober[$i]['OctoberDayNumber'];
                $finalarraymerge [$i]["OctoberRainfall"]= $array_archivedrainfallForMonthOfOctober[$i]['OctoberRainfall'];

                //MONTH OF NOV
                $finalarraymerge [$i]["NovemberDayNumber"]= $array_archivedrainfallForMonthOfNovember[$i]['NovemberDayNumber'];
                $finalarraymerge [$i]["NovemberRainfall"]= $array_archivedrainfallForMonthOfNovember[$i]['NovemberRainfall'];

                //MONTH OF DEC
                $finalarraymerge [$i]["DecemberDayNumber"]= $array_archivedrainfallForMonthOfDecember[$i]['DecemberDayNumber'];
                $finalarraymerge [$i]["DecemberRainfall"]= $array_archivedrainfallForMonthOfDecember[$i]['DecemberRainfall'];


                $i++;
            }  //end of for loop.
            ?>
            <?php
            //Loop thr the final array start from the index one(wic is two)
            $indexNo = 1;

            for($daynum = 1; $daynum<31; $daynum++ ){ ?>

                <tr>
                    <td><?php echo $finalarraymerge[$daynum]["JanuaryDayNumber"];?></td>  <!-- Date -->
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
        <br><br>
       </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
       <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br><br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/ArchivedYearlyRainfallFormReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
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
            $('#displayarchivedyearannualreportrainfall_button').click(function(event) {


                // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.
                   // $("#stationManager").focus();
                    $("#stationManager").focus();
                    return false;
                }
                //Manager that the a stationManagerer is selectManagerom the list of stations(Admin)
                var stationNoManager=$('#stationNoManager').val();
                if (stationNoManager==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Number not picked");
                    $('#stationNoManager').val("");  //Clear the field.
                    $("#stationNoManager").focus();
                    return false;

                }

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
                if(year==''){  // returns true if the variable does NOT contain a valid number
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
