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
            <li class="active">Archived Weather Summary Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div class="no-print">
        <div id="output"></div>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedWeatherSummaryFormReportData/displayarchivedweathersummaryformreport/" method="post" enctype="multipart/form-data">
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
                    <input type="submit" name="archivedWeatherSummaryFormReport_button" id="archivedWeatherSummaryFormReport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>


    <?php
    if(is_array($displayArchivedWeatherSummaryFormReportHeaderFields)
        && count($displayArchivedWeatherSummaryFormReportHeaderFields)){

        $monthAsANumber=0;
        $year=0;

        $monthInWords= $displayArchivedWeatherSummaryFormReportHeaderFields['monthInWords'];
        $monthAsANumber= $displayArchivedWeatherSummaryFormReportHeaderFields['monthAsANumberselected'];

        $year= $displayArchivedWeatherSummaryFormReportHeaderFields['year'];

        $getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);
        //$getNumberOfdaysInAMonth=cal_days_in_month(CAL_GREGORIAN,$monthAsANumber,$year);



        $stationName=$displayArchivedWeatherSummaryFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedWeatherSummaryFormReportHeaderFields['stationNumber'];
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
        if (is_array($archivedweathersummaryformreportdataforAMonth) && count($archivedweathersummaryformreportdataforAMonth)) {


            //Create Arrays to store data to be formated e.g if data for a day is missing we insert it
            $array_archivedweathersummaryformreportdataforAMonth=array();


            //First loop thru  the array for observationslip with TIME 0600Z and then  insert it into the different array we have created
            //format if day not there.
            //the days of the Month
            $print=0;
            for($daynum = 1; $daynum<=$getNumberOfdaysInAMonth; $daynum++ ){

                foreach($archivedweathersummaryformreportdataforAMonth as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DayOfTheMonth"]=$data->DayOfTheMonth;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Max_Temperature"]=$data->TEMP_MAX;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Min_Temperature"]=$data->TEMP_MIN;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Sunshine"]=$data->SUNSHINE;

                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DB_0600Z"]=$data->DB_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WB_0600Z"]=$data->WB_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DP_0600Z"]=$data->DP_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["VP_0600Z"]=$data->VP_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["RH_0600Z"]=$data->RH_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["CLP_0600Z"]=$data->CLP_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["GPM_0600Z"]=$data->GPM_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WIND_DIR_0600Z"]=$data->WIND_DIR_0600Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["FF_0600Z"]=$data->FF_0600Z;



                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DB_1200Z"]=$data->DB_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WB_1200Z"]=$data->WB_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DP_1200Z"]=$data->DP_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["VP_1200Z"]=$data->VP_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["RH_1200Z"]=$data->RH_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["CLP_1200Z"]=$data->CLP_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["GPM_1200Z"]=$data->GPM_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WIND_DIR_1200Z"]=$data->WIND_DIR_1200Z;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["FF_1200Z"]=$data->FF_1200Z;


                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WIND_RUN"]=$data->WIND_RUN;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["R_F"]=$data->R_F;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["ThunderStorm"]=$data->ThunderStorm;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Fog"]=$data->Fog;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Haze"]=$data->Haze;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["HailStorm"]=$data->HailStorm;
                        $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["EarthQuake"]=$data->EarthQuake;

                        $print=1;

                        break;
                    }//end of if
                    else{

                        $print=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print==0){

                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DayOfTheMonth"]=$daynum;
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Max_Temperature"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Min_Temperature"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Sunshine"]='';

                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DB_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WB_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DP_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["VP_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["RH_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["CLP_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["GPM_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WIND_DIR_0600Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["FF_0600Z"]='';



                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DB_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WB_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["DP_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["VP_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["RH_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["CLP_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["GPM_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WIND_DIR_1200Z"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["FF_1200Z"]='';


                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["WIND_RUN"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["R_F"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["ThunderStorm"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Fog"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["Haze"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["HailStorm"]='';
                    $array_archivedweathersummaryformreportdataforAMonth[$daynum-1]["EarthQuake"]='';

                }//end of if
            }//end of for loop
            ///////////////////////////////////////


            //Cal the Total And Mean of each column with data.If no data i do not count it.
            $TotalRowswithDataCountForMaxTemp=0;
            $TotalMaxTemp=0.0;
            //$TotalRowswithDataCountForMaxTemp=0;

            $TotalMinTemp=0.0;
            $TotalRowswithDataCountForMinTemp=0;

            $TotalRowswithDataCountForSunshine=0;
            $TotalSunshine=0.0;


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

//////////////////////////////////////
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

            /////////////////////////////////////TOTAL RAINFALL

            $TotalRainfall=0.0;
            $TotalRowswithDataCountForRainfall=0;

            //////////////////////////TOTAL WIND RUN
            $TotalWindRun=0.0;
            $TotalRowswithDataCountForWindRun=0;

            //loop thr the array to carry out some cals before display

            foreach($array_archivedweathersummaryformreportdataforAMonth as $data){

                //TOTAL MAX TEMPERATURE
                if($data['Max_Temperature']!=''){  //not null ,not null

                    $TotalMax+=$data['Max_Temperature'];
                    $TotalRowswithDataCountForMaxTemp+=1;
                }elseif($data['Max_Temperature']==''){

                    $TotalMax+=0.0;
                    $TotalRowswithDataCountForMaxTemp+=0;
                }
                ////////////////////////////////// TOTAL MIN TEMPERATURE
                if($data['Min_Temperature']!='' ){  //not null ,not null

                    $TotalMin+=$data['Min_Temperature'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }elseif($data['Min_Temperature']==''){

                    $TotalMin+=0.0;
                    $TotalRowswithDataCountForMinTemp+=0;
                }
                //////////////TOTAL SUNSHINE
                if($data['Sunshine']!=''){

                    $TotalSunshine+=$data['Sunshine'];
                    $TotalRowswithDataCountForSunshine+=1;
                }
                elseif($data['Sunshine']==''){

                    $TotalSunshine+=0.0;
                    $TotalRowswithDataCountForSunshine+=0;
                }

                /////TOTAL DB FOR 0600Z
                if($data['DB_0600Z']!=''){

                    $TotalDB_0600Z+=$data['DB_0600Z'];
                    $TotalRowswithDataCountForDB_0600Z+=1;
                }
                elseif($data['DB_0600Z']==''){

                    $TotalDB_0600Z+=0.0;
                    $TotalRowswithDataCountForDB_0600Z+=0;
                }

                /////TOTAL WB FOR 0600Z
                if($data['WB_0600Z']!=''){

                    $TotalDB_0600Z+=$data['WB_0600Z'];
                    $TotalRowswithDataCountForWB_0600Z+=1;
                }
                elseif($data['WB_0600Z']==''){

                    $TotalWB_0600Z+=0.0;
                    $TotalRowswithDataCountForWB_0600Z+=0;
                }

                /////TOTAL DP FOR 0600Z
                if($data['DP_0600Z']!=''){

                    $TotalDP_0600Z+=$data['DP_0600Z'];
                    $TotalRowswithDataCountForDP_0600Z+=1;
                }
                elseif($data['DP_0600Z']==''){

                    $TotalDP_0600Z+=0.0;
                    $TotalRowswithDataCountForDP_0600Z+=0;
                }

                /////TOTAL VP FOR 0600Z
                if($data['VP_0600Z']!=''){

                    $TotalVP_0600Z+=$data['VP_0600Z'];
                    $TotalRowswithDataCountForVP_0600Z+=1;
                }
                elseif($data['VP_0600Z']==''){

                    $TotalVP_0600Z+=0.0;
                    $TotalRowswithDataCountForVP_0600Z+=0;
                }

                /////TOTAL RH FOR 0600Z
                if($data['RH_0600Z']!=''){

                    $TotalRH_0600Z+=$data['RH_0600Z'];
                    $TotalRowswithDataCountForRH_0600Z+=1;
                }
                elseif($data['RH_0600Z']==''){

                    $TotalRH_0600Z+=0.0;
                    $TotalRowswithDataCountForRH_0600Z+=0;
                }

                /////TOTAL CLP FOR 0600Z
                if($data['CLP_0600Z']!=''){

                    $TotalCLP_0600Z+=$data['CLP_0600Z'];
                    $TotalRowswithDataCountForCLP_0600Z+=1;
                }
                elseif($data['CLP_0600Z']==''){

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
                if($data['WIND_DIR_0600Z']!=''){

                    $TotalWIND_DIR_0600Z+=$data['WIND_DIR_0600Z'];
                    $TotalRowswithDataCountForWIND_DIR_0600Z+=1;
                }
                elseif($data['WIND_DIR_0600Z']==''){

                    $TotalWIND_DIR_0600Z+=0.0;
                    $TotalRowswithDataCountForWIND_DIR_0600Z+=0;
                }

                /////TOTAL FF FOR 0600Z
                if($data['FF_0600Z']!=''){

                    $TotalFF_0600Z+=$data['FF_0600Z'];
                    $TotalRowswithDataCountForFF_0600Z+=1;
                }
                elseif($data['FF_0600Z']==''){

                    $TotalFF_0600Z+=0.0;
                    $TotalRowswithDataCountForFF_0600Z+=0;
                }

                ///////////////////////////////////TOTALS FOR 1200Z.
                /////TOTAL DB FOR 1200Z
                if($data['DB_1200Z']!=''){

                    $TotalDB_1200Z+=$data['DB_1200Z'];
                    $TotalRowswithDataCountForDB_1200Z+=1;
                }
                elseif($data['DB_1200Z']==''){

                    $TotalDB_1200Z+=0.0;
                    $TotalRowswithDataCountForDB_1200Z+=0;
                }

                /////TOTAL WB FOR 1200Z
                if($data['WB_1200Z']!=''){

                    $TotalWB_1200Z+=$data['WB_1200Z'];
                    $TotalRowswithDataCountForWB_200Z+=1;
                }
                elseif($data['WB_1200Z']==''){

                    $TotalWB_1200Z+=0.0;
                    $TotalRowswithDataCountForWB_1200Z+=0;
                }

                /////TOTAL DP FOR 1200Z
                if($data['DP_1200Z']!=''){

                    $TotalDP_1200Z+=$data['DP_1200Z'];
                    $TotalRowswithDataCountForDP_1200Z+=1;
                }
                elseif($data['DP_1200Z']==''){

                    $TotalDP_1200Z+=0.0;
                    $TotalRowswithDataCountForDP_1200Z+=0;
                }

                /////TOTAL VP FOR 1200Z
                if($data['VP_1200Z']!=''){

                    $TotalVP_1200Z+=$data['VP_1200Z'];
                    $TotalRowswithDataCountForVP_1200Z+=1;
                }
                elseif($data['VP_1200Z']==''){

                    $TotalVP_1200Z+=0.0;
                    $TotalRowswithDataCountForVP_1200Z+=0;
                }

                /////TOTAL RH FOR 1200Z
                if($data['RH_1200Z']!=''){

                    $TotalRH_1200Z+=$data['RH_1200Z'];
                    $TotalRowswithDataCountForRH_1200Z+=1;
                }
                elseif($data['RH_1200Z']==''){

                    $TotalRH_1200Z+=0.0;
                    $TotalRowswithDataCountForRH_1200Z+=0;
                }

                /////TOTAL CLP FOR 1200Z
                if($data['CLP_1200Z']!=''){

                    $TotalCLP_1200Z+=$data['CLP_1200Z'];
                    $TotalRowswithDataCountForCLP_1200Z+=1;
                }
                elseif($data['CLP_1200Z']==''){

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
                if($data['WIND_DIR_1200Z']!=''){

                    $TotalWIND_DIR_1200Z+=$data['WIND_DIR_1200Z'];
                    $TotalRowswithDataCountForWIND_DIR_1200Z+=1;
                }
                elseif($data['WIND_DIR_1200Z']==''){

                    $TotalWIND_DIR_1200Z+=0.0;
                    $TotalRowswithDataCountForWIND_DIR_1200Z+=0;
                }

                /////TOTAL FF FOR 1200Z
                if($data['FF_1200Z']!=''){

                    $TotalFF_1200Z+=$data['FF_1200Z'];
                    $TotalRowswithDataCountForFF_1200Z+=1;
                }
                elseif($data['FF_1200Z']==''){

                    $TotalFF_1200Z+=0.0;
                    $TotalRowswithDataCountForFF_1200Z+=0;
                }

                /////TOTAL WIND RUN
                if($data['WIND_RUN']!='' ){

                    $TotalWindRun+=$data['WIND_RUN'];
                    $TotalRowswithDataCountForWindRun+=1;
                }
                elseif($data['WIND_RUN']==''){

                    $TotalWindRun+=0.0;
                    $TotalRowswithDataCountForWindRun+=0;
                }

                /////TOTAL RAINFALL
                if($data['R_F']!='' ){

                    $TotalRainfall+=$data['R_F'];
                    $TotalRowswithDataCountForRainfall+=1;
                }
                elseif($data['R_F']==''){

                    $TotalRainfall+=0.0;
                    $TotalRowswithDataCountForRainfall+=0;
                }

            }//END OF FOREACH
            //loop thru the array to display the data
            foreach($array_archivedweathersummaryformreportdataforAMonth as $data){ ?>

                <tr>
                    <td class="main"><?php echo $data['DayOfTheMonth'];?></td>
                    <td class="main"><?php echo $data['Max_Temperature'];?></td>
                    <td class="main"><?php echo $data['Min_Temperature'];?></td>
                    <td class="main"><?php echo $data['Sunshine'];?></td>

                    <td class="main"><?php echo $data['DB_0600Z'];?></td>
                    <td class="main"><?php echo $data['WB_0600Z'];?></td>
                    <td class="main"><?php echo $data['DP_0600Z'];?></td>
                    <td class="main"><?php echo $data['VP_0600Z'];?></td>
                    <td class="main"><?php echo $data['RH_0600Z'];   //RH?></td>
                    <td class="main"><?php echo $data['CLP_0600Z'];?></td>
                    <td class="main"><?php echo$data['GPM_0600Z'];?></td>
                    <td class="main"><?php echo $data['WIND_DIR_0600Z'];?></td>
                    <td class="main"><?php echo $data['FF_0600Z'];?></td>




                    <td class="main"><?php echo $data['DB_1200Z'];?></td>
                    <td class="main"><?php echo $data['WB_1200Z'];?></td>
                    <td class="main"><?php echo $data['DP_1200Z'];?></td>
                    <td class="main"><?php echo $data['VP_1200Z'];?></td>
                    <td class="main"><?php echo $data['RH_1200Z'];   //RH?></td>
                    <td class="main"><?php echo $data['CLP_1200Z'];?></td>
                    <td class="main"><?php echo$data['GPM_1200Z'];?></td>
                    <td class="main"><?php echo $data['WIND_DIR_1200Z'];?></td>
                    <td class="main"><?php echo $data['FF_1200Z'];?></td>


                    <td class="main"><?php echo $data['WIND_RUN'];?></td>





                    <?php
                    if($data['R_F']!=''){
                        if($data['R_F'] < 0.1){
                            ?>
                            <td class="main"><?php echo 'TR';?></td>
                            <td class="main"></td>
                        <?php
                        }elseif($data['R_F'] > 0.1){
                            ?>
                            <td class="main"><?php echo $data['R_F'];?></td>
                            <td class="main"><?php echo '|';?></td>
                        <?php
                        }

                    }elseif($data['R_F']=='') {
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
                $TotalMeanMax=$Totalmax/$rowcountwithdata;

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


                <td class="main"><?php echo round($TotalWindRun/$TotalRowswithDataCountForWindRun,2) ;?> </td>
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
        <a href="<?php echo base_url()."index.php/DisplayArchivedWeatherSummaryFormReportData/"; ?>" class="btn btn-warning pull-right"><i class="fa fa-times"></i> Close report</a>
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
            $('#archivedWeatherSummaryFormReport_button').click(function(event) {


                // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.
                  //  $("#stationManager").focus();
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
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
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