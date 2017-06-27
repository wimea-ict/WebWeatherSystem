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
            Synoptic Report
            <small>Preview Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Synoptic Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedSynopticFormReportData/displayArchivedSynopticFormReport/" method="post" enctype="multipart/form-data">
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
                                <select name="stationManager" id="stationManager"   class="form-control" placeholder="Select Station">
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
                            <span class="input-group-addon">Select Date</span>
                            <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <input type="submit" name="archivedSynopticFormReport_button" id="archivedSynopticFormReport_button" class="btn btn-primary" value="Generate  Synoptic report" >
                </div>
            </form>
        </div>
        <hr>
    </div>

    <?php
    if(is_array($displayArchivedSynopticFormReportHeaderFields) && count($displayArchivedSynopticFormReportHeaderFields)){



        $stationName=$displayArchivedSynopticFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedSynopticFormReportHeaderFields['stationNumber'];

        $date= $displayArchivedSynopticFormReportHeaderFields['date'];
        //GET THE DAY FROM THE DATE.
        $dayInWords=date('l', strtotime($date));

        //GET THE day AS A NUMBER
        //$dayOfTheMonth=date('l', strtotime($date));


        //NID TO GET THE MONTH FROM THE DATE
        $Month = date('M',strtotime($date));


        //NID TO GET THE YEAR FROM THE DATE
        $Year = date('Y',strtotime($date));


        $monthDayAsANumber = date('d',strtotime($date));
        ?>

        <span><strong>FORM No.444(REV 9/94)</strong></span> </br></br>

        <span><strong>DAY</strong></span> <span class="dotted-line"><?php echo $dayInWords;?>
        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><strong>DATE</strong></span>
        <span class="dotted-line"><?php echo $date;?></span>

        <span><strong>MONTH</strong></span> <span class="dotted-line"><?php echo $Month;?>
        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>YEAR</strong></span>
        <span class="dotted-line"><?php echo $Year;?></span>

        <div class="clearfix"></div>
        <br>
        <table class="report-table" id="table2excel" style="width:200%">

        <tr>
            <td class="main rotate"><div><span>Day</span></div></td>
            <td class="main rotate"><div><span>Time</span></div></td>
            <td class="main rotate"><div><span>Unit of wind speed</span></div></td>
            <td class="main rotate"><div><span>Block number</span></div></td>
            <td class="main rotate"><div><span>Station number</span></div></td>
            <td class="main rotate"><div><span>Ind. or omission of<br> precipitation</span></div></td>
            <td class="main rotate"><div><span>Type of station/present <br> or past weather</span></div></td>
            <td class="main rotate"><div><span>Height of lowest cloud</span></div></td>
            <td class="main rotate"><div><span>Horizontal visibility</span></div></td>
            <td class="main rotate"><div><span>Total cloud cover</span></div></td>
            <td class="main rotate"><div><span>Wind direction</span></div></td>
            <td class="main rotate"><div><span>Wind speed</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Sign of the data</span></div></td>
            <td class="main rotate"><div><span>Air Temperature</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Sign of the data</span></div></td>
            <td class="main rotate"><div><span>Dew point temperature</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Pressure at station level</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Standard isobaric surface</span></div></td>
            <td class="main rotate"><div><span>Geopotential of standard<br> isobaric surface</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of precipitation</span></div></td>
            <td class="main rotate"><div><span>Duration period of precipitation</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Present weather</span></div></td>
            <td class="main rotate"><div><span>Past weather</span></div></td>
            <td class="main rotate"><div><span>Group indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of clouds</span></div></td>
            <td class="main rotate"><div><span>Clouds of the general Sc. St. Cu, Cb</span></div></td>
            <td class="main rotate"><div><span>Clouds of the general Ac, As, Ns</span></div></td>
            <td class="main rotate"><div><span>Clouds of the general C, Cc, Cs</span></div></td>
            <td class="main rotate"><div><span>Section Indicator</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Grass Minimum Temperature</span></div></td>
            <td class="main rotate"><div><span>Character & Intensity of precipitation</span></div></td>
            <td class="main rotate"><div><span>Beginning or end of precipitation</span></div></td>

            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Sign of the data</span></div></td>
            <td class="main rotate"><div><span>Maximum temperature</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Sign of the data</span></div></td>
            <td class="main rotate"><div><span>Minimum temperature</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of evapouration</span></div></td>
            <td class="main rotate"><div><span>Indicator of type of instrumentation</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Duration of sunshine</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>

            <td class="main rotate"><div><span>Sign of pressure change</span></div></td>
            <td class="main rotate"><div><span>Pressure change in 24 hrs</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of precipitation</span></div></td>
            <td class="main rotate"><div><span>Duration of period of precipitation</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of individual cloud layer</span></div></td>
            <td class="main rotate"><div><span>Genus of cloud</span></div></td>
            <td class="main rotate"><div><span>Height of base cloud layer or mass</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of individual cloud layer</span></div></td>
            <td class="main rotate"><div><span>Genus of cloud</span></div></td>

            <td class="main rotate"><div><span>Height of base cloud layer or mass</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of individual cloud layer</span></div></td>
            <td class="main rotate"><div><span>Genus of cloud</span></div></td>
            <td class="main rotate"><div><span>Height of base cloud layer or mass</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Amount of individual cloud layer</span></div></td>
            <td class="main rotate"><div><span>Genus of cloud</span></div></td>
            <td class="main rotate"><div><span>Height of base cloud layer or mass</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Suplementary Information</span></div></td>
            <td class="main rotate"><div><span>Section Indicator</span></div></td>
            <td class="main rotate"><div><span>Group Indicator</span></div></td>
            <td class="main rotate"><div><span>Sign of data</span></div></td>
            <td class="main rotate"><div><span>Wet bulb temperature</span></div></td>
            <td class="main rotate"><div><span>RELATIVE HUMIDITY</span></div></td>
            <td class="main rotate"><div><span>VAPOUR PRESSURE</span></div></td>
        </tr>

        <tr>
            <td class="main">Y Y</td>
            <td class="main">GG</td>
            <td class="main">i</td>
            <td class="main">ii</td>
            <td class="main">iii</td>
            <td class="main">i</td>
            <td class="main">i</td>
            <td class="main">h</td>
            <td class="main">VV</td>
            <td class="main">N</td>
            <td class="main">dd</td>
            <td class="main">ff</td>
            <td class="main">1</td>
            <td class="main">S</td>
            <td class="main">TTT</td>
            <td class="main">2</td>
            <td class="main">S</td>
            <td class="main">TTT</td>
            <td class="main">3</td>
            <td class="main">PPPP</td>
            <td class="main">4</td>
            <td class="main">8</td>
            <td class="main">hhh</td>
            <td class="main">6</td>
            <td class="main">RRR</td>
            <td class="main">t</td>
            <td class="main">7</td>
            <td class="main">WW</td>
            <td class="main">WW</td>
            <td class="main">8</td>
            <td class="main">N</td>
            <td class="main">C</td>
            <td class="main">C</td>
            <td class="main">C</td>
            <td class="main">333</td>
            <td class="main">0</td>
            <td class="main">TT</td>
            <td class="main">R</td>
            <td class="main">R</td>

            <td class="main">1</td>
            <td class="main">S</td>
            <td class="main">TTT</td>
            <td class="main">2</td>
            <td class="main">S</td>
            <td class="main">TTT</td>
            <td class="main">5E</td>
            <td class="main">EE</td>
            <td class="main">E</td>
            <td class="main">55</td>
            <td class="main">SSS</td>
            <td class="main">5</td>

            <td class="main">8</td>
            <td class="main">PPP</td>
            <td class="main">6</td>
            <td class="main">RRR</td>
            <td class="main">t</td>
            <td class="main">8</td>
            <td class="main">N</td>
            <td class="main">C</td>
            <td class="main">hh</td>
            <td class="main">8</td>
            <td class="main">N</td>
            <td class="main">C</td>

            <td class="main">hh</td>
            <td class="main">8</td>
            <td class="main">N</td>
            <td class="main">C</td>
            <td class="main">hh</td>
            <td class="main">8</td>
            <td class="main">N</td>
            <td class="main">C</td>
            <td class="main">hh</td>
            <td class="main">9</td>
            <td class="main">SSS</td>
            <td class="main">555</td>
            <td class="main">1</td>
            <td class="main">S</td>
            <td class="main">TTT</td>
            <td class="main"></td>
            <td class="main"></td>
        </tr>

        <?php
        if (is_array($synopticformreportdataForTime0000Z)
            ||is_array($synopticformreportdataForTime0300Z)
            || is_array($synopticformreportdataForTime0600Z)
            || is_array($synopticformreportdataForTime0900Z)
            || is_array($synopticformreportdataForTime1200Z)
            || is_array($synopticformreportdataForTime1500Z)
            || is_array($synopticformreportdataForTime1800Z)
            || is_array($synopticformreportdataForTime2100Z)   ) {
            //Pick a row frm DB if no data inserted.

            ///FOR THE FIRST ROW OF THE SYNOPTIC REPORT
            //TIME 0000Z.
            if(count($synopticformreportdataForTime0000Z)==1){

            foreach($synopticformreportdataForTime0000Z as $data){
                //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                ?>

                <tr>
                    <td><?php echo $data->DayOfTheMonth;?></td>
                    <td><?php echo '00'; ?></td>
                    <td><?php echo $data->UWS; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo $stationNumber;?></td>
                    <td><?php echo $data->IOOP  ;?></td>
                    <td><?php echo $data->TSPPW;?></td>
                    <td><?php echo $data->HLC;?></td>
                    <td><?php echo $data->HV;?></td>
                    <td><?php echo $data->TCC;?></td>
                    <td><?php echo $data->WD;?></td>
                    <td><?php echo $data->WS;?></td>
                    <td><?php echo $data->GI1_1;?></td>
                    <td><?php echo $data->SignOfData_1;?></td>

                    <td><?php echo $data->Air_temperature;?></td>
                    <td><?php echo $data->GI2_1;?></td>
                    <td><?php echo $data->SignOfData_2;?></td>
                    <td><?php echo $data->Dewpoint_temperature;?></td>
                    <td><?php echo $data->GI3_1;?></td>
                    <td><?php echo $data->PASL;?></td>
                    <td><?php echo $data->GI4_1;?></td>
                    <td><?php echo $data->SIS;?></td>
                    <td><?php echo $data->GSIS;?></td>
                    <td><?php echo $data->GI6_1;?></td>

                    <td><?php echo $data->AOP;?></td>
                    <td><?php echo $data->DPOP;?></td>
                    <td><?php echo $data->GI7_1;?></td>
                    <td><?php echo $data->Present_Weather;?></td>
                    <td><?php echo $data->Past_Weather;?></td>
                    <td><?php echo $data->GI8_1;?></td>
                    <td><?php echo $data->AOC;?></td>
                    <td><?php echo $data->CLOG;?></td>
                    <td><?php echo $data->CGOG;?></td>
                    <td><?php echo $data->CHOG;?></td>
                    <td><?php echo $data->Section_Indicator333;?></td>
                    <td><?php echo $data->GI0_1;?></td>
                    <td><?php echo $data->GMT;?></td>
                    <td><?php echo $data->CIOP;?></td>
                    <td><?php echo $data->BEOP;?></td>




                    <td><?php echo $data->GI1_2;?></td>
                    <td><?php echo $data->SignOfData_3;?></td>
                    <td><?php echo $data->Max_TempTx;?></td>
                    <td><?php echo $data->GI2_2;?></td>
                    <td><?php echo $data->SignOfData_4;?></td>
                    <td><?php echo $data->Max_TempTn;?></td>
                    <td><?php echo $data->GI5_1;?></td>
                    <td><?php echo $data->AOE;?></td>
                    <td><?php echo $data->ITI;?></td>
                    <td><?php echo $data->GI55;?></td>
                    <td><?php echo $data->DOS;?></td>
                    <td><?php echo $data->GI5_2;?></td>
                    <td><?php echo $data->SPC;?></td>
                    <td><?php echo $data->PCI24Hrs;?></td>
                    <td><?php echo $data->GI6_2;?></td>
                    <td><?php echo $data->AOP_2;?></td>
                    <td><?php echo $data->DPOP_2;?></td>

                    <td><?php echo $data->GI8_2;?></td>
                    <td><?php echo $data->AICL;?></td>
                    <td><?php echo $data->GOC;?></td>
                    <td><?php echo $data->HBCLOM;?></td>


                    <td><?php echo $data->GI8_3;?></td>
                    <td><?php echo $data->AICL_2;?></td>
                    <td><?php echo $data->GOC_2;?></td>
                    <td><?php echo $data->HBCLOM_2;?></td>




                    <td><?php echo $data->GI8_4;?></td>
                    <td><?php echo $data->AICL_3;?></td>
                    <td><?php echo $data->GOC_3;?></td>
                    <td><?php echo $data->HBCLOM_3;?></td>

                    <td><?php echo $data->GI8_5;?></td>
                    <td><?php echo $data->AICL_4;?></td>
                    <td><?php echo $data->GOC_4;?></td>
                    <td><?php echo $data->HBCLOM_4;?></td>

                    <td><?php echo $data->G19;?></td>
                    <td><?php echo $data->Supp_Info;?></td>
                    <td><?php echo $data->Section_Indicator555;?></td>
                    <td><?php echo $data->GI1_3;?></td>
                    <td><?php echo $data->SignOfData_5;?></td>
                    <td><?php echo $data->Wetbulb_Temp;?></td>
                    <td><?php echo $data->R_Humidity;?></td>
                    <td><?php echo $data->V_Pressure;?></td>
                </tr>

            <?php  }  //END OF IF DATA EXISTS FOR 0000Z TIME
            }else {  //ELSE PRINT NOTHING FOR 0000Z TIME
                ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '00'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }

                ?>
           <?php
           if(count($synopticformreportdataForTime0300Z)==1){

               foreach($synopticformreportdataForTime0300Z as $data){
                   //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                   //TIME 0300Z
                   ?>


                <tr>
                    <td><?php echo $data->DayOfTheMonth;?></td>
                    <td><?php echo '03'; ?></td>
                    <td><?php echo $data->UWS; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo $stationNumber;?></td>
                    <td><?php echo $data->IOOP  ;?></td>
                    <td><?php echo $data->TSPPW;?></td>
                    <td><?php echo $data->HLC;?></td>
                    <td><?php echo $data->HV;?></td>
                    <td><?php echo $data->TCC;?></td>
                    <td><?php echo $data->WD;?></td>
                    <td><?php echo $data->WS;?></td>
                    <td><?php echo $data->GI1_1;?></td>
                    <td><?php echo $data->SignOfData_1;?></td>
                    <td><?php echo $data->Air_temperature;?></td>
                    <td><?php echo $data->GI2_1;?></td>
                    <td><?php echo $data->SignOfData_2;?></td>
                    <td><?php echo $data->Dewpoint_temperature;?></td>
                    <td><?php echo $data->GI3_1;?></td>
                    <td><?php echo $data->PASL;?></td>
                    <td><?php echo $data->GI4_1;?></td>
                    <td><?php echo $data->SIS;?></td>
                    <td><?php echo $data->GSIS;?></td>
                    <td><?php echo $data->GI6_1;?></td>
                    <td><?php echo $data->AOP;?></td>
                    <td><?php echo $data->DPOP;?></td>
                    <td><?php echo $data->GI7_1;?></td>
                    <td><?php echo $data->Present_Weather;?></td>
                    <td><?php echo $data->Past_Weather;?></td>
                    <td><?php echo $data->GI8_1;?></td>
                    <td><?php echo $data->AOC;?></td>
                    <td><?php echo $data->CLOG;?></td>
                    <td><?php echo $data->CGOG;?></td>
                    <td><?php echo $data->CHOG;?></td>
                    <td><?php echo $data->Section_Indicator333;?></td>
                    <td><?php echo $data->GI0_1;?></td>
                    <td><?php echo $data->GMT;?></td>
                    <td><?php echo $data->CIOP;?></td>
                    <td><?php echo $data->BEOP;?></td>




                    <td><?php echo $data->GI1_2;?></td>
                    <td><?php echo $data->SignOfData_3;?></td>
                    <td><?php echo $data->Max_TempTx;?></td>
                    <td><?php echo $data->GI2_2;?></td>
                    <td><?php echo $data->SignOfData_4;?></td>
                    <td><?php echo $data->Max_TempTn;?></td>
                    <td><?php echo $data->GI5_1;?></td>
                    <td><?php echo $data->AOE;?></td>
                    <td><?php echo $data->ITI;?></td>
                    <td><?php echo $data->GI55;?></td>
                    <td><?php echo $data->DOS;?></td>
                    <td><?php echo $data->GI5_2;?></td>
                    <td><?php echo $data->SPC;?></td>
                    <td><?php echo $data->PCI24Hrs;?></td>
                    <td><?php echo $data->GI6_2;?></td>
                    <td><?php echo $data->AOP_2;?></td>
                    <td><?php echo $data->DPOP_2;?></td>

                    <td><?php echo $data->GI8_2;?></td>
                    <td><?php echo $data->AICL;?></td>
                    <td><?php echo $data->GOC;?></td>
                    <td><?php echo $data->HBCLOM;?></td>


                    <td><?php echo $data->GI8_3;?></td>
                    <td><?php echo $data->AICL_2;?></td>
                    <td><?php echo $data->GOC_2;?></td>
                    <td><?php echo $data->HBCLOM_2;?></td>




                    <td><?php echo $data->GI8_4;?></td>
                    <td><?php echo $data->AICL_3;?></td>
                    <td><?php echo $data->GOC_3;?></td>
                    <td><?php echo $data->HBCLOM_3;?></td>

                    <td><?php echo $data->GI8_5;?></td>
                    <td><?php echo $data->AICL_4;?></td>
                    <td><?php echo $data->GOC_4;?></td>
                    <td><?php echo $data->HBCLOM_4;?></td>

                    <td><?php echo $data->G19;?></td>
                    <td><?php echo $data->Supp_Info;?></td>
                    <td><?php echo $data->Section_Indicator555;?></td>
                    <td><?php echo $data->GI1_3;?></td>
                    <td><?php echo $data->SignOfData_5;?></td>
                    <td><?php echo $data->Wetbulb_Temp;?></td>
                    <td><?php echo $data->R_Humidity;?></td>
                    <td><?php echo $data->V_Pressure;?></td>
                </tr>

            <?php  } // END IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS TIME 0300Z
           }else {   //ELSE PRINT NOTHING TIME 0300Z
               ?>
               <tr>
                   <td><?php echo $monthDayAsANumber;?></td>
                   <td><?php echo '03'; ?></td>
                   <td><?php echo ''; ?></td>
                   <td><?php echo 63;?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo ''  ;?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>




                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>

                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>


                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>




                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>

                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>

                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
                   <td><?php echo '';?></td>
               </tr>
           <?php  }

           ?>

            <?php
            if(count($synopticformreportdataForTime0600Z)==1){

                foreach($synopticformreportdataForTime0600Z as $data){

                    //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS TIME 0600Z
                    ?>


            <tr>
                <td><?php echo $data->DayOfTheMonth;?></td>
                <td><?php echo '06'; ?></td>
                <td><?php  echo $data->UWS; ?></td>
                <td><?php echo '63';?></td>
                <td><?php echo $stationNumber;?></td>
                <td><?php echo $data->IOOP  ;?></td>
                <td><?php echo $data->TSPPW;?></td>
                <td><?php echo $data->HLC;?></td>
                <td><?php echo $data->HV;?></td>
                <td><?php echo $data->TCC;?></td>
                <td><?php echo $data->WD;?></td>
                <td><?php echo $data->WS;?></td>
                <td><?php echo $data->GI1_1;?></td>
                <td><?php echo $data->SignOfData_1;?></td>
                <td><?php echo $data->Air_temperature;?></td>
                <td><?php echo $data->GI2_1;?></td>
                <td><?php echo $data->SignOfData_2;?></td>
                <td><?php echo $data->Dewpoint_temperature;?></td>
                <td><?php echo $data->GI3_1;?></td>
                <td><?php echo $data->PASL;?></td>
                <td><?php echo $data->GI4_1;?></td>
                <td><?php echo $data->SIS;?></td>
                <td><?php echo $data->GSIS;?></td>
                <td><?php echo $data->GI6_1;?></td>
                <td><?php echo $data->AOP;?></td>
                <td><?php echo $data->DPOP;?></td>
                <td><?php echo $data->GI7_1;?></td>
                <td><?php echo $data->Present_Weather;?></td>
                <td><?php echo $data->Past_Weather;?></td>
                <td><?php echo $data->GI8_1;?></td>
                <td><?php echo $data->AOC;?></td>
                <td><?php echo $data->CLOG;?></td>
                <td><?php echo $data->CGOG;?></td>
                <td><?php echo $data->CHOG;?></td>
                <td><?php echo $data->Section_Indicator333;?></td>
                <td><?php echo $data->GI0_1;?></td>
                <td><?php echo $data->GMT;?></td>
                <td><?php echo $data->CIOP;?></td>
                <td><?php echo $data->BEOP;?></td>




                <td><?php echo $data->GI1_2;?></td>
                <td><?php echo $data->SignOfData_3;?></td>
                <td><?php echo $data->Max_TempTx;?></td>
                <td><?php echo $data->GI2_2;?></td>
                <td><?php echo $data->SignOfData_4;?></td>
                <td><?php echo $data->Max_TempTn;?></td>
                <td><?php echo $data->GI5_1;?></td>
                <td><?php echo $data->AOE;?></td>
                <td><?php echo $data->ITI;?></td>
                <td><?php echo $data->GI55;?></td>
                <td><?php echo $data->DOS;?></td>
                <td><?php echo $data->GI5_2;?></td>
                <td><?php echo $data->SPC;?></td>
                <td><?php echo $data->PCI24Hrs;?></td>
                <td><?php echo $data->GI6_2;?></td>
                <td><?php echo $data->AOP_2;?></td>
                <td><?php echo $data->DPOP_2;?></td>

                <td><?php echo $data->GI8_2;?></td>
                <td><?php echo $data->AICL;?></td>
                <td><?php echo $data->GOC;?></td>
                <td><?php echo $data->HBCLOM;?></td>


                <td><?php echo $data->GI8_3;?></td>
                <td><?php echo $data->AICL_2;?></td>
                <td><?php echo $data->GOC_2;?></td>
                <td><?php echo $data->HBCLOM_2;?></td>




                <td><?php echo $data->GI8_4;?></td>
                <td><?php echo $data->AICL_3;?></td>
                <td><?php echo $data->GOC_3;?></td>
                <td><?php echo $data->HBCLOM_3;?></td>

                <td><?php echo $data->GI8_5;?></td>
                <td><?php echo $data->AICL_4;?></td>
                <td><?php echo $data->GOC_4;?></td>
                <td><?php echo $data->HBCLOM_4;?></td>

                <td><?php echo $data->G19;?></td>
                <td><?php echo $data->Supp_Info;?></td>
                <td><?php echo $data->Section_Indicator555;?></td>
                <td><?php echo $data->GI1_3;?></td>
                <td><?php echo $data->SignOfData_5;?></td>
                <td><?php echo $data->Wetbulb_Temp;?></td>
                <td><?php echo $data->R_Humidity;?></td>
                <td><?php echo $data->V_Pressure;?></td>
            </tr>

                <?php  } // END OF IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                   }else {  //ELSE PRINT NOTHING FOR TIME 0600Z
                ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '06'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }
            ?>
            <?php
            if(count($synopticformreportdataForTime0900Z)==1){ //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                //TIME 0900Z

                foreach($synopticformreportdataForTime0900Z as $data){

                    ?>


            <tr>
                <td><?php echo $data->DayOfTheMonth;?></td>
                <td><?php echo '09'; ?></td>
                <td><?php echo $data->UWS; ?></td>
                <td><?php echo '63';?></td>
                <td><?php echo $stationNumber;?></td>
                <td><?php echo $data->IOOP  ;?></td>
                <td><?php echo $data->TSPPW;?></td>
                <td><?php echo $data->HLC;?></td>
                <td><?php echo $data->HV;?></td>
                <td><?php echo $data->TCC;?></td>
                <td><?php echo $data->WD;?></td>
                <td><?php echo $data->WS;?></td>
                <td><?php echo $data->GI1_1;?></td>
                <td><?php echo $data->SignOfData_1;?></td>
                <td><?php echo $data->Air_temperature;?></td>
                <td><?php echo $data->GI2_1;?></td>
                <td><?php echo $data->SignOfData_2;?></td>
                <td><?php echo $data->Dewpoint_temperature;?></td>
                <td><?php echo $data->GI3_1;?></td>
                <td><?php echo $data->PASL;?></td>
                <td><?php echo $data->GI4_1;?></td>
                <td><?php echo $data->SIS;?></td>
                <td><?php echo $data->GSIS;?></td>
                <td><?php echo $data->GI6_1;?></td>
                <td><?php echo $data->AOP;?></td>
                <td><?php echo $data->DPOP;?></td>
                <td><?php echo $data->GI7_1;?></td>
                <td><?php echo $data->Present_Weather;?></td>
                <td><?php echo $data->Past_Weather;?></td>
                <td><?php echo $data->GI8_1;?></td>
                <td><?php echo $data->AOC;?></td>
                <td><?php echo $data->CLOG;?></td>
                <td><?php echo $data->CGOG;?></td>
                <td><?php echo $data->CHOG;?></td>
                <td><?php echo $data->Section_Indicator333;?></td>
                <td><?php echo $data->GI0_1;?></td>
                <td><?php echo $data->GMT;?></td>
                <td><?php echo $data->CIOP;?></td>
                <td><?php echo $data->BEOP;?></td>




                <td><?php echo $data->GI1_2;?></td>
                <td><?php echo $data->SignOfData_3;?></td>
                <td><?php echo $data->Max_TempTx;?></td>
                <td><?php echo $data->GI2_2;?></td>
                <td><?php echo $data->SignOfData_4;?></td>
                <td><?php echo $data->Max_TempTn;?></td>
                <td><?php echo $data->GI5_1;?></td>
                <td><?php echo $data->AOE;?></td>
                <td><?php echo $data->ITI;?></td>
                <td><?php echo $data->GI55;?></td>
                <td><?php echo $data->DOS;?></td>
                <td><?php echo $data->GI5_2;?></td>
                <td><?php echo $data->SPC;?></td>
                <td><?php echo $data->PCI24Hrs;?></td>
                <td><?php echo $data->GI6_2;?></td>
                <td><?php echo $data->AOP_2;?></td>
                <td><?php echo $data->DPOP_2;?></td>

                <td><?php echo $data->GI8_2;?></td>
                <td><?php echo $data->AICL;?></td>
                <td><?php echo $data->GOC;?></td>
                <td><?php echo $data->HBCLOM;?></td>


                <td><?php echo $data->GI8_3;?></td>
                <td><?php echo $data->AICL_2;?></td>
                <td><?php echo $data->GOC_2;?></td>
                <td><?php echo $data->HBCLOM_2;?></td>




                <td><?php echo $data->GI8_4;?></td>
                <td><?php echo $data->AICL_3;?></td>
                <td><?php echo $data->GOC_3;?></td>
                <td><?php echo $data->HBCLOM_3;?></td>

                <td><?php echo $data->GI8_5;?></td>
                <td><?php echo $data->AICL_4;?></td>
                <td><?php echo $data->GOC_4;?></td>
                <td><?php echo $data->HBCLOM_4;?></td>

                <td><?php echo $data->G19;?></td>
                <td><?php echo $data->Supp_Info;?></td>
                <td><?php echo $data->Section_Indicator555;?></td>
                <td><?php echo $data->GI1_3;?></td>
                <td><?php echo $data->SignOfData_5;?></td>
                <td><?php echo $data->Wetbulb_Temp;?></td>
                <td><?php echo $data->R_Humidity;?></td>
                <td><?php echo $data->V_Pressure;?></td>
            </tr>

        <?php  }
                //END OF IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                //TIME 0900Z
            }else { ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '09'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }

            ?>

            <?php
            if(count($synopticformreportdataForTime1200Z)==1){ //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                //TIME 1200Z

                foreach($synopticformreportdataForTime1200Z as $data){ ?>


                <tr>
                    <td><?php echo $data->DayOfTheMonth;?></td>
                    <td><?php echo '12'; ?></td>
                    <td><?php echo $data->UWS; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo $stationNumber;?></td>
                    <td><?php echo $data->IOOP  ;?></td>
                    <td><?php echo $data->TSPPW;?></td>
                    <td><?php echo $data->HLC;?></td>
                    <td><?php echo $data->HV;?></td>
                    <td><?php echo $data->TCC;?></td>
                    <td><?php echo $data->WD;?></td>
                    <td><?php echo $data->WS;?></td>
                    <td><?php echo $data->GI1_1;?></td>
                    <td><?php echo $data->SignOfData_1;?></td>
                    <td><?php echo $data->Air_temperature;?></td>
                    <td><?php echo $data->GI2_1;?></td>
                    <td><?php echo $data->SignOfData_2;?></td>
                    <td><?php echo $data->Dewpoint_temperature;?></td>
                    <td><?php echo $data->GI3_1;?></td>
                    <td><?php echo $data->PASL;?></td>
                    <td><?php echo $data->GI4_1;?></td>
                    <td><?php echo $data->SIS;?></td>
                    <td><?php echo $data->GSIS;?></td>
                    <td><?php echo $data->GI6_1;?></td>
                    <td><?php echo $data->AOP;?></td>
                    <td><?php echo $data->DPOP;?></td>
                    <td><?php echo $data->GI7_1;?></td>
                    <td><?php echo $data->Present_Weather;?></td>
                    <td><?php echo $data->Past_Weather;?></td>
                    <td><?php echo $data->GI8_1;?></td>
                    <td><?php echo $data->AOC;?></td>
                    <td><?php echo $data->CLOG;?></td>
                    <td><?php echo $data->CGOG;?></td>
                    <td><?php echo $data->CHOG;?></td>
                    <td><?php echo $data->Section_Indicator333;?></td>
                    <td><?php echo $data->GI0_1;?></td>
                    <td><?php echo $data->GMT;?></td>
                    <td><?php echo $data->CIOP;?></td>
                    <td><?php echo $data->BEOP;?></td>




                    <td><?php echo $data->GI1_2;?></td>
                    <td><?php echo $data->SignOfData_3;?></td>
                    <td><?php echo $data->Max_TempTx;?></td>
                    <td><?php echo $data->GI2_2;?></td>
                    <td><?php echo $data->SignOfData_4;?></td>
                    <td><?php echo $data->Max_TempTn;?></td>
                    <td><?php echo $data->GI5_1;?></td>
                    <td><?php echo $data->AOE;?></td>
                    <td><?php echo $data->ITI;?></td>
                    <td><?php echo $data->GI55;?></td>
                    <td><?php echo $data->DOS;?></td>
                    <td><?php echo $data->GI5_2;?></td>
                    <td><?php echo $data->SPC;?></td>
                    <td><?php echo $data->PCI24Hrs;?></td>
                    <td><?php echo $data->GI6_2;?></td>
                    <td><?php echo $data->AOP_2;?></td>
                    <td><?php echo $data->DPOP_2;?></td>

                    <td><?php echo $data->GI8_2;?></td>
                    <td><?php echo $data->AICL;?></td>
                    <td><?php echo $data->GOC;?></td>
                    <td><?php echo $data->HBCLOM;?></td>


                    <td><?php echo $data->GI8_3;?></td>
                    <td><?php echo $data->AICL_2;?></td>
                    <td><?php echo $data->GOC_2;?></td>
                    <td><?php echo $data->HBCLOM_2;?></td>




                    <td><?php echo $data->GI8_4;?></td>
                    <td><?php echo $data->AICL_3;?></td>
                    <td><?php echo $data->GOC_3;?></td>
                    <td><?php echo $data->HBCLOM_3;?></td>

                    <td><?php echo $data->GI8_5;?></td>
                    <td><?php echo $data->AICL_4;?></td>
                    <td><?php echo $data->GOC_4;?></td>
                    <td><?php echo $data->HBCLOM_4;?></td>

                    <td><?php echo $data->G19;?></td>
                    <td><?php echo $data->Supp_Info;?></td>
                    <td><?php echo $data->Section_Indicator555;?></td>
                    <td><?php echo $data->GI1_3;?></td>
                    <td><?php echo $data->SignOfData_5;?></td>
                    <td><?php echo $data->Wetbulb_Temp;?></td>
                    <td><?php echo $data->R_Humidity;?></td>
                    <td><?php echo $data->V_Pressure;?></td>
                </tr>

            <?php  }
            } //END IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
            //ELSE PRINT NOTHING TIME 1200Z
            else { ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '12'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }

            ?>
            <?php
            if(count($synopticformreportdataForTime1500Z)==1){ //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                //TIME 1500Z

                foreach($synopticformreportdataForTime1500Z as $data){ ?>


                <tr>
                    <td><?php echo $data->DayOfTheMonth;?></td>
                    <td><?php echo '15'; ?></td>
                    <td><?php echo $data->UWS; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo $stationNumber;?></td>
                    <td><?php echo $data->IOOP  ;?></td>
                    <td><?php echo $data->TSPPW;?></td>
                    <td><?php echo $data->HLC;?></td>
                    <td><?php echo $data->HV;?></td>
                    <td><?php echo $data->TCC;?></td>
                    <td><?php echo $data->WD;?></td>
                    <td><?php echo $data->WS;?></td>
                    <td><?php echo $data->GI1_1;?></td>
                    <td><?php echo $data->SignOfData_1;?></td>
                    <td><?php echo $data->Air_temperature;?></td>
                    <td><?php echo $data->GI2_1;?></td>
                    <td><?php echo $data->SignOfData_2;?></td>
                    <td><?php echo $data->Dewpoint_temperature;?></td>
                    <td><?php echo $data->GI3_1;?></td>
                    <td><?php echo $data->PASL;?></td>
                    <td><?php echo $data->GI4_1;?></td>
                    <td><?php echo $data->SIS;?></td>
                    <td><?php echo $data->GSIS;?></td>
                    <td><?php echo $data->GI6_1;?></td>
                    <td><?php echo $data->AOP;?></td>
                    <td><?php echo $data->DPOP;?></td>
                    <td><?php echo $data->GI7_1;?></td>
                    <td><?php echo $data->Present_Weather;?></td>
                    <td><?php echo $data->Past_Weather;?></td>
                    <td><?php echo $data->GI8_1;?></td>
                    <td><?php echo $data->AOC;?></td>
                    <td><?php echo $data->CLOG;?></td>
                    <td><?php echo $data->CGOG;?></td>
                    <td><?php echo $data->CHOG;?></td>
                    <td><?php echo $data->Section_Indicator333;?></td>
                    <td><?php echo $data->GI0_1;?></td>
                    <td><?php echo $data->GMT;?></td>
                    <td><?php echo $data->CIOP;?></td>
                    <td><?php echo $data->BEOP;?></td>




                    <td><?php echo $data->GI1_2;?></td>
                    <td><?php echo $data->SignOfData_3;?></td>
                    <td><?php echo $data->Max_TempTx;?></td>
                    <td><?php echo $data->GI2_2;?></td>
                    <td><?php echo $data->SignOfData_4;?></td>
                    <td><?php echo $data->Max_TempTn;?></td>
                    <td><?php echo $data->GI5_1;?></td>
                    <td><?php echo $data->AOE;?></td>
                    <td><?php echo $data->ITI;?></td>
                    <td><?php echo $data->GI55;?></td>
                    <td><?php echo $data->DOS;?></td>
                    <td><?php echo $data->GI5_2;?></td>
                    <td><?php echo $data->SPC;?></td>
                    <td><?php echo $data->PCI24Hrs;?></td>
                    <td><?php echo $data->GI6_2;?></td>
                    <td><?php echo $data->AOP_2;?></td>
                    <td><?php echo $data->DPOP_2;?></td>

                    <td><?php echo $data->GI8_2;?></td>
                    <td><?php echo $data->AICL;?></td>
                    <td><?php echo $data->GOC;?></td>
                    <td><?php echo $data->HBCLOM;?></td>


                    <td><?php echo $data->GI8_3;?></td>
                    <td><?php echo $data->AICL_2;?></td>
                    <td><?php echo $data->GOC_2;?></td>
                    <td><?php echo $data->HBCLOM_2;?></td>




                    <td><?php echo $data->GI8_4;?></td>
                    <td><?php echo $data->AICL_3;?></td>
                    <td><?php echo $data->GOC_3;?></td>
                    <td><?php echo $data->HBCLOM_3;?></td>

                    <td><?php echo $data->GI8_5;?></td>
                    <td><?php echo $data->AICL_4;?></td>
                    <td><?php echo $data->GOC_4;?></td>
                    <td><?php echo $data->HBCLOM_4;?></td>

                    <td><?php echo $data->G19;?></td>
                    <td><?php echo $data->Supp_Info;?></td>
                    <td><?php echo $data->Section_Indicator555;?></td>
                    <td><?php echo $data->GI1_3;?></td>
                    <td><?php echo $data->SignOfData_5;?></td>
                    <td><?php echo $data->Wetbulb_Temp;?></td>
                    <td><?php echo $data->R_Humidity;?></td>
                    <td><?php echo $data->V_Pressure;?></td>
                </tr>

            <?php  }
            } // END OF IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
            //ELSE PRINT NOTHING
            else { ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '15'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }

            ?>
            <?php
            if(count($synopticformreportdataForTime1800Z)==1){ //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                //TIME 1800Z

                foreach($synopticformreportdataForTime1800Z as $data){ ?>


                <tr>
                    <td><?php echo $data->DayOfTheMonth;?></td>
                    <td><?php echo '18'; ?></td>
                    <td><?php echo $data->UWS; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo $stationNumber;?></td>
                    <td><?php echo $data->IOOP  ;?></td>
                    <td><?php echo $data->TSPPW;?></td>
                    <td><?php echo $data->HLC;?></td>
                    <td><?php echo $data->HV;?></td>
                    <td><?php echo $data->TCC;?></td>
                    <td><?php echo $data->WD;?></td>
                    <td><?php echo $data->WS;?></td>
                    <td><?php echo $data->GI1_1;?></td>
                    <td><?php echo $data->SignOfData_1;?></td>
                    <td><?php echo $data->Air_temperature;?></td>
                    <td><?php echo $data->GI2_1;?></td>
                    <td><?php echo $data->SignOfData_2;?></td>
                    <td><?php echo $data->Dewpoint_temperature;?></td>
                    <td><?php echo $data->GI3_1;?></td>
                    <td><?php echo $data->PASL;?></td>
                    <td><?php echo $data->GI4_1;?></td>
                    <td><?php echo $data->SIS;?></td>
                    <td><?php echo $data->GSIS;?></td>
                    <td><?php echo $data->GI6_1;?></td>
                    <td><?php echo $data->AOP;?></td>
                    <td><?php echo $data->DPOP;?></td>
                    <td><?php echo $data->GI7_1;?></td>
                    <td><?php echo $data->Present_Weather;?></td>
                    <td><?php echo $data->Past_Weather;?></td>
                    <td><?php echo $data->GI8_1;?></td>
                    <td><?php echo $data->AOC;?></td>
                    <td><?php echo $data->CLOG;?></td>
                    <td><?php echo $data->CGOG;?></td>
                    <td><?php echo $data->CHOG;?></td>
                    <td><?php echo $data->Section_Indicator333;?></td>
                    <td><?php echo $data->GI0_1;?></td>
                    <td><?php echo $data->GMT;?></td>
                    <td><?php echo $data->CIOP;?></td>
                    <td><?php echo $data->BEOP;?></td>




                    <td><?php echo $data->GI1_2;?></td>
                    <td><?php echo $data->SignOfData_3;?></td>
                    <td><?php echo $data->Max_TempTx;?></td>
                    <td><?php echo $data->GI2_2;?></td>
                    <td><?php echo $data->SignOfData_4;?></td>
                    <td><?php echo $data->Max_TempTn;?></td>
                    <td><?php echo $data->GI5_1;?></td>
                    <td><?php echo $data->AOE;?></td>
                    <td><?php echo $data->ITI;?></td>
                    <td><?php echo $data->GI55;?></td>
                    <td><?php echo $data->DOS;?></td>
                    <td><?php echo $data->GI5_2;?></td>
                    <td><?php echo $data->SPC;?></td>
                    <td><?php echo $data->PCI24Hrs;?></td>
                    <td><?php echo $data->GI6_2;?></td>
                    <td><?php echo $data->AOP_2;?></td>
                    <td><?php echo $data->DPOP_2;?></td>

                    <td><?php echo $data->GI8_2;?></td>
                    <td><?php echo $data->AICL;?></td>
                    <td><?php echo $data->GOC;?></td>
                    <td><?php echo $data->HBCLOM;?></td>


                    <td><?php echo $data->GI8_3;?></td>
                    <td><?php echo $data->AICL_2;?></td>
                    <td><?php echo $data->GOC_2;?></td>
                    <td><?php echo $data->HBCLOM_2;?></td>




                    <td><?php echo $data->GI8_4;?></td>
                    <td><?php echo $data->AICL_3;?></td>
                    <td><?php echo $data->GOC_3;?></td>
                    <td><?php echo $data->HBCLOM_3;?></td>

                    <td><?php echo $data->GI8_5;?></td>
                    <td><?php echo $data->AICL_4;?></td>
                    <td><?php echo $data->GOC_4;?></td>
                    <td><?php echo $data->HBCLOM_4;?></td>

                    <td><?php echo $data->G19;?></td>
                    <td><?php echo $data->Supp_Info;?></td>
                    <td><?php echo $data->Section_Indicator555;?></td>
                    <td><?php echo $data->GI1_3;?></td>
                    <td><?php echo $data->SignOfData_5;?></td>
                    <td><?php echo $data->Wetbulb_Temp;?></td>
                    <td><?php echo $data->R_Humidity;?></td>
                    <td><?php echo $data->V_Pressure;?></td>
                </tr>

            <?php  }
            }  //END OF IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
            //TIME 1800Z
            else { ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '18'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }

            ?>
            <?php
            if(count($synopticformreportdataForTime2100Z)==1){ //IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
                //TIME 2100Z

                foreach($synopticformreportdataForTime2100Z as $data){ ?>


                <tr>
                    <td><?php echo $data->DayOfTheMonth;?></td>
                    <td><?php echo '21'; ?></td>
                    <td><?php echo $data->UWS; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo $stationNumber;?></td>
                    <td><?php echo $data->IOOP  ;?></td>
                    <td><?php echo $data->TSPPW;?></td>
                    <td><?php echo $data->HLC;?></td>
                    <td><?php echo $data->HV;?></td>
                    <td><?php echo $data->TCC;?></td>
                    <td><?php echo $data->WD;?></td>
                    <td><?php echo $data->WS;?></td>
                    <td><?php echo $data->GI1_1;?></td>
                    <td><?php echo $data->SignOfData_1;?></td>
                    <td><?php echo $data->Air_temperature;?></td>
                    <td><?php echo $data->GI2_1;?></td>
                    <td><?php echo $data->SignOfData_2;?></td>
                    <td><?php echo $data->Dewpoint_temperature;?></td>
                    <td><?php echo $data->GI3_1;?></td>
                    <td><?php echo $data->PASL;?></td>
                    <td><?php echo $data->GI4_1;?></td>
                    <td><?php echo $data->SIS;?></td>
                    <td><?php echo $data->GSIS;?></td>
                    <td><?php echo $data->GI6_1;?></td>
                    <td><?php echo $data->AOP;?></td>
                    <td><?php echo $data->DPOP;?></td>
                    <td><?php echo $data->GI7_1;?></td>
                    <td><?php echo $data->Present_Weather;?></td>
                    <td><?php echo $data->Past_Weather;?></td>
                    <td><?php echo $data->GI8_1;?></td>
                    <td><?php echo $data->AOC;?></td>
                    <td><?php echo $data->CLOG;?></td>
                    <td><?php echo $data->CGOG;?></td>
                    <td><?php echo $data->CHOG;?></td>
                    <td><?php echo $data->Section_Indicator333;?></td>
                    <td><?php echo $data->GI0_1;?></td>
                    <td><?php echo $data->GMT;?></td>
                    <td><?php echo $data->CIOP;?></td>
                    <td><?php echo $data->BEOP;?></td>




                    <td><?php echo $data->GI1_2;?></td>
                    <td><?php echo $data->SignOfData_3;?></td>
                    <td><?php echo $data->Max_TempTx;?></td>
                    <td><?php echo $data->GI2_2;?></td>
                    <td><?php echo $data->SignOfData_4;?></td>
                    <td><?php echo $data->Max_TempTn;?></td>
                    <td><?php echo $data->GI5_1;?></td>
                    <td><?php echo $data->AOE;?></td>
                    <td><?php echo $data->ITI;?></td>
                    <td><?php echo $data->GI55;?></td>
                    <td><?php echo $data->DOS;?></td>
                    <td><?php echo $data->GI5_2;?></td>
                    <td><?php echo $data->SPC;?></td>
                    <td><?php echo $data->PCI24Hrs;?></td>
                    <td><?php echo $data->GI6_2;?></td>
                    <td><?php echo $data->AOP_2;?></td>
                    <td><?php echo $data->DPOP_2;?></td>

                    <td><?php echo $data->GI8_2;?></td>
                    <td><?php echo $data->AICL;?></td>
                    <td><?php echo $data->GOC;?></td>
                    <td><?php echo $data->HBCLOM;?></td>


                    <td><?php echo $data->GI8_3;?></td>
                    <td><?php echo $data->AICL_2;?></td>
                    <td><?php echo $data->GOC_2;?></td>
                    <td><?php echo $data->HBCLOM_2;?></td>




                    <td><?php echo $data->GI8_4;?></td>
                    <td><?php echo $data->AICL_3;?></td>
                    <td><?php echo $data->GOC_3;?></td>
                    <td><?php echo $data->HBCLOM_3;?></td>

                    <td><?php echo $data->GI8_5;?></td>
                    <td><?php echo $data->AICL_4;?></td>
                    <td><?php echo $data->GOC_4;?></td>
                    <td><?php echo $data->HBCLOM_4;?></td>

                    <td><?php echo $data->G19;?></td>
                    <td><?php echo $data->Supp_Info;?></td>
                    <td><?php echo $data->Section_Indicator555;?></td>
                    <td><?php echo $data->GI1_3;?></td>
                    <td><?php echo $data->SignOfData_5;?></td>
                    <td><?php echo $data->Wetbulb_Temp;?></td>
                    <td><?php echo $data->R_Humidity;?></td>
                    <td><?php echo $data->V_Pressure;?></td>
                </tr>

            <?php  }
            }  //END OF IF THERE IS DATA FROM DB FOR THIS ROW PRINT AS FOLLOWS
            //ELSE PRINT NOTHING TIME 2100Z
            else { ?>
                <tr>
                    <td><?php echo $monthDayAsANumber;?></td>
                    <td><?php echo '21'; ?></td>
                    <td><?php echo ''; ?></td>
                    <td><?php echo 63;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo ''  ;?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>


                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>




                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>

                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                    <td><?php echo '';?></td>
                </tr>
            <?php  }

            ?>

        <?php
        }
        ?>
        </table>
        <br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export">Export to csv</button>


        <a href="<?php echo base_url()."index.php/DisplayArchivedSynopticFormReportData/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
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
            $('#archivedSynopticFormReport_button').click(function(event) {


                // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.

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
                //Check that the DATE is selected from the month
                var date=$('#date').val();
                if(date==''){  // returns true if the variable does NOT contain a valid number
                    alert("Date not Selected from the List");
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