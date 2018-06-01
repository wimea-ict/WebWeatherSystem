<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Metar Report
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Metar  Report</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/ReportsController/displaymetarreport/" method="post" enctype="multipart/form-data">
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
                                    <span class="input-group-addon">Select Date</span>
                                    <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <input type="submit" name="generatemetarReport_button" id="generatemetarReport_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>

            <?php
            if(is_array($displayMetarReportHeaderFields) &&
               count($displayMetarReportHeaderFields) &&
              is_array($metarreportdataforADayFromObservationSlipTable) &&
                  !empty($metarreportdataforADayFromObservationSlipTable)
            ){

                $date= $displayMetarReportHeaderFields['date'];
                $monthDay =date('d',strtotime($date)); //get the day num from the date.e.g 6th
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayMetarReportHeaderFields['stationName'];
                $stationNumber=$displayMetarReportHeaderFields['stationNumber'];


               $stationIndicator;
            //echo $stationName;


              if (is_array($stationIndicatorData) && count($stationIndicatorData)) {
                 foreach($stationIndicatorData as $station){
                    // echo strtolower($station->LocationStationName);
                     if(strcasecmp($stationName, $station->LocationStationName) == 0){  //strcasecmp returns 0 if the strings are the same
                         $stationIndicator=$station->Indicator;
                        // echo $station->Indicator;
                       //  echo $stationIndicator;
                         break;
                     }
                     }
                     }



                ?>

                <span><strong>STATION</strong></span> <span class="dotted-line"><?php echo $stationName;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>STATION NUMBER</strong></span>
                <span class="dotted-line"><?php echo $stationNumber;?></span>


                <span><strong>DAY</strong></span> <span class="dotted-line"><?php echo $dayInWords;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>DATE</strong></span>
                <span class="dotted-line"><?php echo $date;?></span>

                <div class="clearfix"></div>
                <br>
                <table class="report-table" id="table2excel">

                    <tr>
                        <td class="main">METAR <br> SPECI</td>
                        <td class="main">CCCC</td>
                        <td class="main">YYGGgg</td>
                        <td class="main">Dddff/<br> f/f</td>
                        <td class="main">WW or <br> COVAK</td>
                        <td class="main">WW</td>
                        <td class="main">NCChhhNCChhh N CChhh</td>
                        <!-- <td class="main">A/Temperature</td>
                         <td class="main">Dew Point</td>
                         <td class="main">Wet Bulb</td> -->
                        <td class="main">TT/ <br> TT</td>
                        <td class="main">QNH <br>(hpa)</td>
                        <td class="main">QNH <br>(in)</td>
                        <td class="main">QFE<br> (hpa)</td>
                        <td class="main">QFE<br> (in)</td>
                        <td class="main">RE <br> W1W1</td>
                    </tr>

                    <?php
                    $count = 0;
                    $array_MetarReportDataForADayFromObservationSlipTable=array();

                        foreach($metarreportdataforADayFromObservationSlipTable as $data){
                           // $count++;
                           // $metarid = $data->id;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["TIME"]=$data->TIME;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["Wind_Direction"]=$data->Wind_Direction;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["Wind_Speed"]=$data->Wind_Speed;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["Visibility"]=$data->Visibility;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["Present_Weather"]=$data->Present_Weather;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfLowClouds1"]=$data->OktasOfLowClouds1;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfLowClouds1"]=$data->HeightOfLowClouds1;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfLowClouds2"]=$data->OktasOfLowClouds2;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfLowClouds2"]=$data->HeightOfLowClouds2;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfLowClouds3"]=$data->OktasOfLowClouds3;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfLowClouds3"]=$data->HeightOfLowClouds3;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfMediumClouds1"]=$data->OktasOfMediumClouds1;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfMediumClouds1"]=$data->HeightOfMediumClouds1;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfMediumClouds2"]=$data->OktasOfMediumClouds2;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfMediumClouds2"]=$data->HeightOfMediumClouds2;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfMediumClouds3"]=$data->OktasOfMediumClouds3;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfMediumClouds3"]=$data->HeightOfMediumClouds3;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfHighClouds1"]=$data->OktasOfHighClouds1;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfHighClouds1"]=$data->HeightOfHighClouds1;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfHighClouds2"]=$data->OktasOfHighClouds2;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfHighClouds2"]=$data->HeightOfHighClouds2;

                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["OktasOfHighClouds3"]=$data->OktasOfHighClouds3;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["HeightOfHighClouds3"]=$data->HeightOfHighClouds3;



                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["Dry_Bulb"]=$data->Dry_Bulb;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["Wet_Bulb"]=$data->Wet_Bulb;


                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["MSLPr"]=$data->MSLPr;
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["CLP"]=$data->CLP;


                            if($count==0){
                            $array_MetarReportDataForADayFromObservationSlipTable[$count]["REW1W1"]='';
                            }elseif($count!=0){
                            $array_MetarReportDataForADayFromObservationSlipTable[$count-1]["REW1W1"]=$data->Present_Weather; //get the present weather for previous Hour

                            }
                            $count++;  //move to the next Hour
                        }
                            ?>
                 <?php   foreach($array_MetarReportDataForADayFromObservationSlipTable as $data){

                     ?>



                     <tr>
                            <?php
                            if(($data['TIME']=='0000Z') || ($data['TIME']=='0030Z')||
                             ($data['TIME']=='0100Z')   || ($data['TIME']=='0130Z') ||
                            ($data['TIME']=='0200Z')      || ($data['TIME']=='0230Z') ||
                            ($data['TIME']=='0300Z')      || ($data['TIME']=='0330Z') ||
                            ($data['TIME']=='0400Z')      || ($data['TIME']=='0430Z') ||
                            ($data['TIME']=='0500Z')      || ($data['TIME']=='0530Z') ||
                            ($data['TIME']=='0600Z')   || ($data['TIME']=='0630Z') ||
                            ($data['TIME']=='0700Z')   || ($data['TIME']=='0730Z') ||
                            ($data['TIME']=='0800Z')   || ($data['TIME']=='0830Z') ||
                            ($data['TIME']=='0900Z')   || ($data['TIME']=='0930Z') ||
                            ($data['TIME']=='1000Z')   || ($data['TIME']=='1030Z') ||
                            ($data['TIME']=='1100Z')   || ($data['TIME']=='1130Z') ||
                            ($data['TIME']=='1200Z')   || ($data['TIME']=='1230Z') ||
                            ($data['TIME']=='1300Z')   || ($data['TIME']=='1330Z') ||
                            ($data['TIME']=='1400Z')   || ($data['TIME']=='1430Z') ||
                            ($data['TIME']=='1500Z')   || ($data['TIME']=='1530Z') ||
                            ($data['TIME']=='1600Z')   || ($data['TIME']=='1630Z') ||
                            ($data['TIME']=='1700Z')   || ($data['TIME']=='1730Z') ||
                            ($data['TIME']=='1800Z')   || ($data['TIME']=='1830Z') ||
                            ($data['TIME']=='1900Z')   || ($data['TIME']=='1930Z') ||
                            ($data['TIME']=='2000Z')   || ($data['TIME']=='2030Z') ||
                            ($data['TIME']=='2100Z')   || ($data['TIME']=='2130Z') ||
                            ($data['TIME']=='2200Z')   || ($data['TIME']=='2230Z') ||
                            ($data['TIME']=='2300Z')   || ($data['TIME']=='2330Z')){ ?>

                            <td ><?php echo 'METAR';?></td>  <!--METARSPECI  -->
                            <?php
                            }else{ ?>

                            <td ><?php echo 'SPECI';?></td>  <!--METARSPECI  -->
                          <?php  }
                            ?>


                                <td ><?php echo $stationIndicator;?></td>   <!-- CCCC -->
                                <td ><?php echo $monthDay . $data['TIME'];?></td>  <!-- YYGGgg -->
                                <td ><?php echo $data['Wind_Direction'] . $data['Wind_Speed'] . 'KT';?></td> <!-- Dddfffmfm -->
                                <td ><?php echo $data['Visibility'];?></td>   <!-- WWorCOVAK -->
                                <td><?php echo $data['Present_Weather'];?></td>  <!-- W1W1 -->

                                <?php
                                $OktasOfLowCloud1='';
                                $HeightOfLowCloud1='';
                                $OktasAndHeightOfLowCloud1='';

                                $OktasOfLowCloud2='';
                                $HeightOfLowCloud2='';
                                $OktasAndHeightOfLowCloud2='';

                                $OktasOfLowCloud3='';
                                $HeightOfLowCloud3='';
                                $OktasAndHeightOfLowCloud3='';




                                $OktasOfMediumCloud1='';
                                $HeightOfMediumCloud1='';
                                $OktasAndHeightOfMediumCloud1='';

                                $OktasOfMediumCloud2='';
                                $HeightOfMediumCloud2='';
                                $OktasAndHeightOfMediumCloud2='';

                                $OktasOfMediumCloud3='';
                                $HeightOfMediumCloud3='';
                                $OktasAndHeightOfMediumCloud3='';


                                $OktasOfHighCloud1='';
                                $HeightOfHighCloud1='';
                                $OktasAndHeightOfHighCloud1='';

                                $OktasOfHighCloud2='';
                                $HeightOfHighCloud2='';
                                $OktasAndHeightOfHighCloud2='';

                                $OktasOfHighCloud3='';
                                $HeightOfHighCloud3='';
                                $OktasAndHeightOfHighCloud3='';

                                ?>

                               <?php // BEGIN FIRST LINE OF LOW CLOUDS ?>
                                <?php if(($data['OktasOfLowClouds1']==1) ||($data['OktasOfLowClouds1']==2) ){
                                    $OktasOfLowCloud1='FEW';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING

                                }elseif(($data['OktasOfLowClouds1']==3) ||($data['OktasOfLowClouds1']==4) ){
                                    $OktasOfLowCloud1='SCT';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING


                                }elseif(($data['OktasOfLowClouds1']==5) ||($data['OktasOfLowClouds1']==7) ){
                                    $OktasOfLowCloud1='BKN';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING



                                }elseif(($data['OktasOfLowClouds1']==8)  ){
                                    $OktasOfLowCloud1='OVC';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING

                                } ?>
                                <?php//END OF FIRST LINE OF LOW CLOUDS ?>

                                <?php // BEGIN SECOND LINE OF LOW CLOUDS ?>
                                <?php if(($data['OktasOfLowClouds2']==1) ||($data['OktasOfLowClouds2']==2) ){
                                    $OktasOfLowCloud2='FEW';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING

                                }elseif(($data['OktasOfLowClouds2']==3) ||($data['OktasOfLowClouds2']==4) ){
                                    $OktasOfLowCloud2='SCT';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING


                                }elseif(($data['OktasOfLowClouds2']==5) ||($data['OktasOfLowClouds2']==7) ){
                                    $OktasOfLowCloud2='BKN';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING



                                }elseif(($data['OktasOfLowClouds2']==8)  ){
                                    $OktasOfLowCloud2='OVC';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING

                                } ?>
                                <?php//END OF SECOND LINE OF LOW CLOUDS ?>

                                <?php // BEGIN THIRD LINE OF LOW CLOUDS ?>
                                <?php if(($data['OktasOfLowClouds3']==1) ||($data['OktasOfLowClouds3']==2) ){
                                    $OktasOfLowCloud3='FEW';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING

                                }elseif(($data['OktasOfLowClouds3']==3) ||($data['OktasOfLowClouds3']==4) ){
                                    $OktasOfLowCloud3='SCT';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING


                                }elseif(($data['OktasOfLowClouds3']==5) ||($data['OktasOfLowClouds3']==7) ){
                                    $OktasOfLowCloud3='BKN';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING



                                }elseif(($data['OktasOfLowClouds3']==8)  ){
                                    $OktasOfLowCloud3='OVC';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING

                                } ?>
                                <?php//END OF THIRD LINE OF LOW CLOUDS ?>



                                <?php // BEGIN FIRST LINE OF MEDIUM CLOUDS ?>
                                <?php if(($data['OktasOfMediumClouds1']==1) ||($data['OktasOfMediumClouds1']==2) ){
                                    $OktasOfMediumCloud1='FEW';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfMediumClouds1']==3) ||($data['OktasOfMediumClouds1']==4) ){
                                    $OktasOfMediumCloud1='SCT';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfMediumClouds1']==5) ||($data['OktasOfMediumClouds1']==7) ){
                                    $OktasOfMediumCloud1='BKN';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfMediumClouds1']==8)  ){
                                    $OktasOfMediumCloud1='OVC';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF FIRST LINE OF MEDIUM CLOUDS ?>




                                <?php // BEGIN SECOND LINE OF MEDIUM CLOUDS ?>
                                <?php if(($data['OktasOfMediumClouds2']==1) ||($data['OktasOfMediumClouds2']==2) ){
                                    $OktasOfMediumCloud2='FEW';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfMediumClouds2']==3) ||($data['OktasOfMediumClouds2']==4) ){
                                    $OktasOfMediumCloud2='SCT';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfMediumClouds2']==5) ||($data['OktasOfMediumClouds2']==7) ){
                                    $OktasOfMediumCloud2='BKN';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfMediumClouds2']==8)  ){
                                    $OktasOfMediumCloud2='OVC';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF SECOND LINE OF LOW CLOUDS ?>

                                <?php // BEGIN THIRD LINE OF MEDIUM CLOUDS ?>
                                <?php if(($data['OktasOfMediumClouds3']==1) ||($data['OktasOfMediumClouds3']==2) ){
                                    $OktasOfMediumCloud3='FEW';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfMediumClouds3']==3) ||($data['OktasOfMediumClouds3']==4) ){
                                    $OktasOfMediumCloud3='SCT';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfMediumClouds3']==5) ||($data['OktasOfMediumClouds3']==7) ){
                                    $OktasOfMediumCloud3='BKN';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfMediumClouds3']==8)  ){
                                    $OktasOfMediumCloud3='OVC';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF THIRD LINE OF MEDIUM CLOUDS ?>



                                <?php // BEGIN FIRST LINE OF HIGH CLOUDS ?>
                                <?php if(($data['OktasOfHighClouds1']==1) ||($data['OktasOfHighClouds1']==2) ){
                                    $OktasOfHighCloud1='FEW';
                                    $HeightOfHighCloud1= substr($data['HeightOfHighClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfHighClouds1']==3) ||($data['OktasOfHighClouds1']==4) ){
                                    $OktasOfHighCloud1='SCT';
                                    $HeightOfHighCloud1= substr($data['HeightOfHighClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfHighClouds1']==5) ||($data['OktasOfHighClouds1']==7) ){
                                    $OktasOfHighCloud1='BKN';
                                    $HeightOfHighCloud1= substr($data['HeightOfHighClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfHighClouds1']==8)  ){
                                    $OktasOfHighCloud1='OVC';
                                    $HeightOfHighCloud1= substr($data['HeightOfHighClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF FIRST LINE OF HIGH CLOUDS ?>

                                <?php // BEGIN SECOND LINE OF HIGH CLOUDS ?>
                                <?php if(($data['OktasOfHighClouds2']==1) ||($data['OktasOfHighClouds2']==2) ){
                                    $OktasOfHighCloud2='FEW';
                                    $HeightOfHighCloud2= substr($data['HeightOfHighClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfHighClouds2']==3) ||($data['OktasOfHighClouds2']==4) ){
                                    $OktasOfHighCloud2='SCT';
                                    $HeightOfHighCloud2= substr($data['HeightOfHighClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfHighClouds2']==5) ||($data['OktasOfHighClouds2']==7) ){
                                    $OktasOfHighCloud2='BKN';
                                    $HeightOfHighCloud2= substr($data['HeightOfHighClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfHighClouds2']==8)  ){
                                    $OktasOfHighCloud2='OVC';
                                    $HeightOfHighCloud2= substr($data['HeightOfHighClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF SECOND LINE OF HIGH CLOUDS ?>

                                <?php // BEGIN THIRD LINE OF HIGH CLOUDS ?>
                                <?php if(($data['OktasOfHighClouds3']==1) ||($data['OktasOfHighClouds3']==2) ){
                                    $OktasOfHighCloud3='FEW';
                                    $HeightOfHighCloud3= substr($data['HeightOfHighClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfHighClouds3']==3) ||($data['OktasOfHighClouds3']==4) ){
                                    $OktasOfHighCloud3='SCT';
                                    $HeightOfHighCloud3= substr($data['HeightOfHighClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfHighClouds3']==5) ||($data['OktasOfHighClouds3']==7) ){
                                    $OktasOfHighCloud3='BKN';
                                    $HeightOfHighCloud3= substr($data['HeightOfHighClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfHighClouds3']==8)  ){
                                    $OktasOfHighCloud3='OVC';
                                    $HeightOfHighCloud3= substr($data['HeightOfHighClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF THIRD LINE OF HIGH CLOUDS ?>



                                <td>
                                <?php   //N1CCCNmCCNhCC
                                echo $OktasAndHeightOfLowCloud1.' '.$OktasAndHeightOfLowCloud2.' '.$OktasAndHeightOfLowCloud3.' '.
                                     $OktasAndHeightOfMediumCloud1.' '.$OktasAndHeightOfMediumCloud2.' '.$OktasAndHeightOfMediumCloud3.' '.
                                     $OktasAndHeightOfHighCloud1.' '.$OktasAndHeightOfHighCloud2.' '.$OktasAndHeightOfHighCloud3;?>



                                </td>

                               <?php //air Temp is Dry Bulb ?>

                                <?php
                                $DryBulb=round($data['Dry_Bulb']);
                                $WetBulb=$data['Wet_Bulb'];

                                $Dew_PointTemperature=(3 * $WetBulb ) - ($DryBulb) / 2;

                                //TTTdTd is DryBulb|DewPointTemperature
                                ?>

                                <td ><?php echo $DryBulb.'|'.round($Dew_PointTemperature,2);?></td> <!-- TTTdTd -->



                                <td ><?php echo $data['MSLPr'];?></td>  <!--Qnhhpa -->


                                <td><?php echo round((0.02952998751 * $data['MSLPr'])) ;?></td> <!-- Qnhin -->
                                <td><?php echo $data['CLP'];?></td>  <!-- Qfehpa -->
                                <td><?php echo '';?></td>
                                <td><?php echo $data['REW1W1'];?></td>


                            </tr>
                        <?php
                        }
                    ?>
                </table>
                <br><br>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
                <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
                 <br><br><br><br>
                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
                <a href="<?php echo base_url()."index.php/MetarReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>
            <?php  }elseif(is_array($displayMetarReportHeaderFields)
                && count($displayMetarReportHeaderFields)
                && empty($metarreportdataforADayFromObservationSlipTable))
                            {

     $date= $displayMetarReportHeaderFields['date'];
     //get the day in words.
     $dayInWords=date('l', strtotime($date));
     //Month
     //$month = date('m', strtotime($loop->date));
     $stationName=$displayMetarReportHeaderFields['stationName'];
     $stationNumber=$displayMetarReportHeaderFields['stationNumber'];
     ?>

     <center>
         <?php echo "No Metar Report Data Yet for ".$stationName.' '.'Date'.' '.$date. ' '.'From the DB'; ?>
     </center>
 <?php } ?>


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
            $('#generatemetarReport_button').click(function(event) {


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
                //Check that the TIME is selected from the list of TIME for the METAR
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Date not Selected");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
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
