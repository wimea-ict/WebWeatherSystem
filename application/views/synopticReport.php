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
            <form action="<?php echo base_url(); ?>index.php/SynopticReport/displaysynopticreport/" method="post" enctype="multipart/form-data">
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
                    <input type="submit" name="generateSynopticReport_Button" id="generateSynopticReport_Button" class="btn btn-primary" value="Generate  Synoptic report" >
                </div>
            </form>
        </div>
        <hr>
    </div>

    <?php
    if(is_array($displaySynopticReportHeaderFields) && count($displaySynopticReportHeaderFields)){



        $stationName=$displaySynopticReportHeaderFields['stationName'];
        $stationNumber=$displaySynopticReportHeaderFields['stationNumber'];

        $date= $displaySynopticReportHeaderFields['date'];
        //GET THE DAY FROM THE DATE.
        $dayInWords=date('l', strtotime($date));

        //GET THE DATE AS IT IS


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
            <td class="main rotate"><div><span>Station Indicator</span></div></td>
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
            <td class="main">YY</td>
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
            <td class="main">W1W2</td>
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
        if (is_array($synopticreportdataforADayFromObservationSlip0000Z)
            ||is_array($synopticreportdataforADayFromObservationSlip0300Z)
            ||is_array($synopticreportdataforADayFromObservationSlip0600Z)
            ||is_array($synopticreportdataforADayFromObservationSlip0900Z)
            || is_array($synopticreportdataforADayFromObservationSlip1200Z)
            || is_array($synopticreportdataforADayFromObservationSlip1500Z)
            ||is_array($synopticreportdataforADayFromObservationSlip1800Z)
            ||is_array($synopticreportdataforADayFromObservationSlip2100Z)

            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable0000Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable0300Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable0600Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable0900Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable1200Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable1500Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable1800Z)
            || is_array($synopticreportdataforADayFrom_MoreFormFieldsTable2100Z)


        ) {
            $i=0;
            ///////FROM OBSERVATION SLIP
            //for TIME 0000Z
            $array_synopticreportdataforADayFromObservationSlip0000Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFromObservationSlip0000Z as $data){

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["Same_Day1"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HorizontalVisibility_Time_0000Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HorizontalVisibility_Time_0000Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                  $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["TotalAmountOfAllClouds_Time_0000Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                 $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["WindDirection_Time_0000Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["WindSpeed_Time_0000Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AirTemperature_Time_0000Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["DewPointTemperature_Time_0000Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["PressureAtStationLevel_Time_0000Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                 $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfPrecipitation_Time_0000Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["PresentWeather_Time_0000Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["PresentWeatherCode_Time_0000Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["PastWeather_Time_0000Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfLowClouds_Time_0000Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["LowCloudsOftheGenera_Time_0000Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["MediumCloudsOftheGenera_Time_0000Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HighCloudsOftheGenera_Time_0000Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["MaximumTemperature_Time_0000Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["MinimumTemperature_Time_0000Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfEvaporation_Time_0000Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["PressureChgIn24Hrs_Time_0000Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfIndividualLowCloudLayer_Time_0000Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["GenusOfLowCloud_Time_0000Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0000Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0000Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["GenusOfMediumCloud_Time_0000Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0000Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfIndividualHighCloudLayer_Time_0000Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["GenusOfHighCloud_Time_0000Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0000Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_0000Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["GenusOfMediumsCloud_Time_0000Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_0000Z"]= $data->HeightOfHighClouds1;

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["Wind_Run_Time_0000Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["DurationOfSunshine_Time_0000Z"]= $data->DurationOfSunshine;


                $array_synopticreportdataforADayFromObservationSlip0000Z [$i]["WetBulbTemperature_Time_0000Z"]= $data->Wet_Bulb;
            }




///////////////////////////////////////////////////////////////////////////////////////////////////
            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 0000Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable0000Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["Same_Day1_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["UnitOfWindSpeed_Time_0000Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["IndOrOmissionOfPrecipitation_Time_0000Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["TypeOfStation_Present_Past_Weather_Time_0000Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["HeightOfLowestCloud_Time_0000Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["StandardIsobaricSurface_Time_0000Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["GPM_Time_0000Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["DurationOfPeriodOfPrecipitation_Time_0000Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                 $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["GrassMinTemp_Time_0000Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["CI_OfPrecipitation_Time_0000Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["BE_OfPrecipitation_Time_0000Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0000Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["SignOfPressureChange_Time_0000Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["Supp_Info_Time_0000Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["VapourPressure_Time_0000Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z [$i]["T_H_Graph_Time_0000Z"]= $data->T_H_Graph;

            }




///////////////////////////////////////////////////////////////////////////////////////////////////
            ////FROM THE OBSERVATION SLIP TIME
            //FOR TIME  0300Z
            $array_synopticreportdataforADayFromObservationSlip0300Z=array();
            foreach($synopticreportdataforADayFromObservationSlip0300Z as $data){

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["Same_Day2"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HorizontalVisibility_Time_0300Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HorizontalVisibility_Time_0300Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["TotalAmountOfAllClouds_Time_0300Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["WindDirection_Time_0300Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["WindSpeed_Time_0300Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AirTemperature_Time_0300Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["DewPointTemperature_Time_0300Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["PressureAtStationLevel_Time_0300Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfPrecipitation_Time_0300Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["PresentWeather_Time_0300Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["PresentWeatherCode_Time_0300Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["PastWeather_Time_0300Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfLowClouds_Time_0300Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["LowCloudsOftheGenera_Time_0300Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["MediumCloudsOftheGenera_Time_0300Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HighCloudsOftheGenera_Time_0300Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["MaximumTemperature_Time_0300Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["MinimumTemperature_Time_0300Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfEvaporation_Time_0300Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["PressureChgIn24Hrs_Time_0300Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfIndividualLowCloudLayer_Time_0300Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["GenusOfLowCloud_Time_0300Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0300Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0300Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["GenusOfMediumCloud_Time_0300Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0300Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfIndividualHighCloudLayer_Time_0300Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["GenusOfHighCloud_Time_0300Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0300Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_0300Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["GenusOfMediumsCloud_Time_0300Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_0300Z"]= $data->HeightOfHighClouds1;

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["Wind_Run_Time_0300Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["DurationOfSunshine_Time_0300Z"]= $data->DurationOfSunshine;


                $array_synopticreportdataforADayFromObservationSlip0300Z [$i]["WetBulbTemperature_Time_0300Z"]= $data->Wet_Bulb;

            }
            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 0300Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable0300Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["Same_Day2_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["UnitOfWindSpeed_Time_0300Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["IndOrOmissionOfPrecipitation_Time_0300Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["TypeOfStation_Present_Past_Weather_Time_0300Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["HeightOfLowestCloud_Time_0300Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["StandardIsobaricSurface_Time_0300Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["GPM_Time_0300Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["DurationOfPeriodOfPrecipitation_Time_0300Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                 $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["GrassMinTemp_Time_0300Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["CI_OfPrecipitation_Time_0300Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["BE_OfPrecipitation_Time_0300Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0300Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["SignOfPressureChange_Time_0300Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["Supp_Info_Time_0300Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["VapourPressure_Time_0300Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z [$i]["T_H_Graph_Time_0300Z"]= $data->T_H_Graph;

            }


////////////////////////////////////////////////////////////////////////////////////
            //FROM OBSERVATION SLIP TABLE
            //TIME 0600Z
            $array_synopticreportdataforADayFromObservationSlip0600Z=array();
            foreach($synopticreportdataforADayFromObservationSlip0600Z as $data){

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["Same_Day3"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HorizontalVisibility_Time_0600Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HorizontalVisibility_Time_0600Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["TotalAmountOfAllClouds_Time_0600Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["WindDirection_Time_0600Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["WindSpeed_Time_0600Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AirTemperature_Time_0600Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["DewPointTemperature_Time_0600Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["PressureAtStationLevel_Time_0600Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfPrecipitation_Time_0600Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["PresentWeather_Time_0600Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["PresentWeatherCode_Time_0600Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["PastWeather_Time_0600Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfLowClouds_Time_0600Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["LowCloudsOftheGenera_Time_0600Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["MediumCloudsOftheGenera_Time_0600Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HighCloudsOftheGenera_Time_0600Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["MaximumTemperature_Time_0600Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["MinimumTemperature_Time_0600Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfEvaporation_Time_0600Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["PressureChgIn24Hrs_Time_0600Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfIndividualLowCloudLayer_Time_0600Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["GenusOfLowCloud_Time_0600Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0600Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0600Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["GenusOfMediumCloud_Time_0600Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0600Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfIndividualHighCloudLayer_Time_0600Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["GenusOfHighCloud_Time_0600Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0600Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_0600Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["GenusOfMediumsCloud_Time_0600Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_0600Z"]= $data->HeightOfHighClouds1;


                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["Wind_Run_Time_0600Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["DurationOfSunshine_Time_0600Z"]= $data->DurationOfSunshine;




                $array_synopticreportdataforADayFromObservationSlip0600Z [$i]["WetBulbTemperature_Time_0600Z"]= $data->Wet_Bulb;

            }
            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 0600Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable0600Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["Same_Day3_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["UnitOfWindSpeed_Time_0600Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["IndOrOmissionOfPrecipitation_Time_0600Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["TypeOfStation_Present_Past_Weather_Time_0600Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["HeightOfLowestCloud_Time_0600Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["StandardIsobaricSurface_Time_0600Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["GPM_Time_0600Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["DurationOfPeriodOfPrecipitation_Time_0600Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                 $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["GrassMinTemp_Time_0600Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["CI_OfPrecipitation_Time_0600Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["BE_OfPrecipitation_Time_0600Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0600Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["SignOfPressureChange_Time_0600Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["Supp_Info_Time_0600Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["VapourPressure_Time_0600Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z [$i]["T_H_Graph_Time_0600Z"]= $data->T_H_Graph;
            }



/////////////////////////////////////////////////////////////////////////////////////
           //////////////FROM OBSERVATION SLIP TABLE
            ///////////for TIME  0900Z
            $array_synopticreportdataforADayFromObservationSlip0900Z=array();
            foreach($synopticreportdataforADayFromObservationSlip0900Z as $data){

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["Same_Day4"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HorizontalVisibility_Time_0900Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HorizontalVisibility_Time_0900Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["TotalAmountOfAllClouds_Time_0900Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["WindDirection_Time_0900Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["WindSpeed_Time_0900Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AirTemperature_Time_0900Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["DewPointTemperature_Time_0900Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["PressureAtStationLevel_Time_0900Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfPrecipitation_Time_0900Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["PresentWeather_Time_0900Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["PresentWeatherCode_Time_0900Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["PastWeather_Time_0900Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfLowClouds_Time_0900Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["LowCloudsOftheGenera_Time_0900Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["MediumCloudsOftheGenera_Time_0900Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HighCloudsOftheGenera_Time_0900Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["MaximumTemperature_Time_0900Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["MinimumTemperature_Time_0900Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfEvaporation_Time_0900Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["PressureChgIn24Hrs_Time_0900Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfIndividualLowCloudLayer_Time_0900Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["GenusOfLowCloud_Time_0900Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0900Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0900Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["GenusOfMediumCloud_Time_0900Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0900Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfIndividualHighCloudLayer_Time_0900Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["GenusOfHighCloud_Time_0900Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0900Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_0900Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["GenusOfMediumsCloud_Time_0900Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_0900Z"]= $data->HeightOfHighClouds1;

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["Wind_Run_Time_0900Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["DurationOfSunshine_Time_0900Z"]= $data->DurationOfSunshine;




                $array_synopticreportdataforADayFromObservationSlip0900Z [$i]["WetBulbTemperature_Time_0900Z"]= $data->Wet_Bulb;

            }
            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 0900Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable0900Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["Same_Day4_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["UnitOfWindSpeed_Time_0900Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["IndOrOmissionOfPrecipitation_Time_0900Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["TypeOfStation_Present_Past_Weather_Time_0900Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["HeightOfLowestCloud_Time_0900Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["StandardIsobaricSurface_Time_0900Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["GPM_Time_0900Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["DurationOfPeriodOfPrecipitation_Time_0900Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["GrassMinTemp_Time_0900Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["CI_OfPrecipitation_Time_0900Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["BE_OfPrecipitation_Time_0900Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0900Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["SignOfPressureChange_Time_0900Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["Supp_Info_Time_0900Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["VapourPressure_Time_0900Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z [$i]["T_H_Graph_Time_0900Z"]= $data->T_H_Graph;

            }



//////////////////////////////////////////////////////////////////////////////////////////
            //FROM OBSERVATION SLIP TABLE
            //FOR TIME  1200Z
            $array_synopticreportdataforADayFromObservationSlip1200Z=array();
            foreach($synopticreportdataforADayFromObservationSlip1200Z as $data){

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["Same_Day5"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HorizontalVisibility_Time_1200Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HorizontalVisibility_Time_1200Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["TotalAmountOfAllClouds_Time_1200Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["WindDirection_Time_1200Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["WindSpeed_Time_1200Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AirTemperature_Time_1200Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["DewPointTemperature_Time_1200Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["PressureAtStationLevel_Time_1200Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfPrecipitation_Time_1200Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["PresentWeather_Time_1200Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["PresentWeatherCode_Time_1200Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["PastWeather_Time_1200Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfLowClouds_Time_1200Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["LowCloudsOftheGenera_Time_1200Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["MediumCloudsOftheGenera_Time_1200Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HighCloudsOftheGenera_Time_1200Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["MaximumTemperature_Time_1200Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["MinimumTemperature_Time_1200Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfEvaporation_Time_1200Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["PressureChgIn24Hrs_Time_1200Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfIndividualLowCloudLayer_Time_1200Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["GenusOfLowCloud_Time_1200Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1200Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1200Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["GenusOfMediumCloud_Time_1200Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1200Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfIndividualHighCloudLayer_Time_1200Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["GenusOfHighCloud_Time_1200Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1200Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_1200Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["GenusOfMediumsCloud_Time_1200Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_1200Z"]= $data->HeightOfHighClouds1;

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["Wind_Run_Time_1200Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["DurationOfSunshine_Time_1200Z"]= $data->DurationOfSunshine;



                $array_synopticreportdataforADayFromObservationSlip1200Z [$i]["WetBulbTemperature_Time_1200Z"]= $data->Wet_Bulb;

            }
            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 1200Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable1200Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["Same_Day5_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["UnitOfWindSpeed_Time_1200Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["IndOrOmissionOfPrecipitation_Time_1200Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["TypeOfStation_Present_Past_Weather_Time_1200Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["HeightOfLowestCloud_Time_1200Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["StandardIsobaricSurface_Time_1200Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["GPM_Time_1200Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["DurationOfPeriodOfPrecipitation_Time_1200Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                 $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["GrassMinTemp_Time_1200Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["CI_OfPrecipitation_Time_1200Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["BE_OfPrecipitation_Time_1200Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1200Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["SignOfPressureChange_Time_1200Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["Supp_Info_Time_1200Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["VapourPressure_Time_1200Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z [$i]["T_H_Graph_Time_1200Z"]= $data->T_H_Graph;

            }



/////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///FROM THE OBSERVATION SLIP TABLE
            //FOR TIME  1500Z
            $array_synopticreportdataforADayFromObservationSlip1500Z=array();
            foreach($synopticreportdataforADayFromObservationSlip1500Z as $data){

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["Same_Day6"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HorizontalVisibility_Time_1500Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HorizontalVisibility_Time_1500Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["TotalAmountOfAllClouds_Time_1500Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["WindDirection_Time_1500Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["WindSpeed_Time_1500Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AirTemperature_Time_1500Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["DewPointTemperature_Time_1500Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["PressureAtStationLevel_Time_1500Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfPrecipitation_Time_1500Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["PresentWeather_Time_1500Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["PresentWeatherCode_Time_1500Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["PastWeather_Time_1500Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfLowClouds_Time_1500Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["LowCloudsOftheGenera_Time_1500Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["MediumCloudsOftheGenera_Time_1500Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HighCloudsOftheGenera_Time_1500Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["MaximumTemperature_Time_1500Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["MinimumTemperature_Time_1500Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfEvaporation_Time_1500Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["PressureChgIn24Hrs_Time_1500Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfIndividualLowCloudLayer_Time_1500Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["GenusOfLowCloud_Time_1500Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1500Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1500Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["GenusOfMediumCloud_Time_1500Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1500Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfIndividualHighCloudLayer_Time_1500Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["GenusOfHighCloud_Time_1500Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1500Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_1500Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["GenusOfMediumsCloud_Time_1500Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_1500Z"]= $data->HeightOfHighClouds1;


                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["Wind_Run_Time_1500Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["DurationOfSunshine_Time_1500Z"]= $data->DurationOfSunshine;



                $array_synopticreportdataforADayFromObservationSlip1500Z [$i]["WetBulbTemperature_Time_1500Z"]= $data->Wet_Bulb;

            }

            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 1500Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable1500Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["Same_Day6_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["UnitOfWindSpeed_Time_1500Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["IndOrOmissionOfPrecipitation_Time_1500Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["TypeOfStation_Present_Past_Weather_Time_1500Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["HeightOfLowestCloud_Time_1500Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["StandardIsobaricSurface_Time_1500Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["GPM_Time_1500Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["DurationOfPeriodOfPrecipitation_Time_1500Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                  $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["GrassMinTemp_Time_1500Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["CI_OfPrecipitation_Time_1500Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["BE_OfPrecipitation_Time_1500Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1500Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["SignOfPressureChange_Time_1500Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["Supp_Info_Time_1500Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["VapourPressure_Time_1500Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z [$i]["T_H_Graph_Time_1500Z"]= $data->T_H_Graph;

            }



//////////////////////////////////////////////////////////////////////////////////////////////////            /////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///FROM THE OBSERVATION SLIP TABLE
            //FOR TIME  1800Z
            $array_synopticreportdataforADayFromObservationSlip1800Z=array();
            foreach($synopticreportdataforADayFromObservationSlip1800Z as $data){

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["Same_Day7"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HorizontalVisibility_Time_1800Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HorizontalVisibility_Time_1800Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["TotalAmountOfAllClouds_Time_1800Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["WindDirection_Time_1800Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["WindSpeed_Time_1800Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AirTemperature_Time_1800Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["DewPointTemperature_Time_1800Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["PressureAtStationLevel_Time_1800Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfPrecipitation_Time_1800Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["PresentWeather_Time_1800Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["PresentWeatherCode_Time_1800Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["PastWeather_Time_1800Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfLowClouds_Time_1800Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["LowCloudsOftheGenera_Time_1800Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["MediumCloudsOftheGenera_Time_1800Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HighCloudsOftheGenera_Time_1800Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["MaximumTemperature_Time_1800Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["MinimumTemperature_Time_1800Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfEvaporation_Time_1800Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["PressureChgIn24Hrs_Time_1800Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfIndividualLowCloudLayer_Time_1800Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["GenusOfLowCloud_Time_1800Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1800Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1800Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["GenusOfMediumCloud_Time_1800Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1800Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfIndividualHighCloudLayer_Time_1800Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["GenusOfHighCloud_Time_1800Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1800Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_1800Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["GenusOfMediumsCloud_Time_1800Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_1800Z"]= $data->HeightOfHighClouds1;


                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["Wind_Run_Time_1800Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["DurationOfSunshine_Time_1800Z"]= $data->DurationOfSunshine;


                $array_synopticreportdataforADayFromObservationSlip1800Z [$i]["WetBulbTemperature_Time_1800Z"]= $data->Wet_Bulb;

            }

            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 1800Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable1800Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["Same_Day7_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["UnitOfWindSpeed_Time_1800Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["IndOrOmissionOfPrecipitation_Time_1800Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["TypeOfStation_Present_Past_Weather_Time_1800Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["HeightOfLowestCloud_Time_1800Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["StandardIsobaricSurface_Time_1800Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["GPM_Time_1800Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["DurationOfPeriodOfPrecipitation_Time_1800Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                 $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["GrassMinTemp_Time_1800Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["CI_OfPrecipitation_Time_1800Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["BE_OfPrecipitation_Time_1800Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1800Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["SignOfPressureChange_Time_1800Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["Supp_Info_Time_1800Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["VapourPressure_Time_1800Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z [$i]["T_H_Graph_Time_1800Z"]= $data->T_H_Graph;

            }




/////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///FROM THE OBSERVATION SLIP TABLE
            //FOR TIME  2100Z
            $array_synopticreportdataforADayFromObservationSlip2100Z=array();
            foreach($synopticreportdataforADayFromObservationSlip2100Z as $data){

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["Same_Day8"]=$data->DayOfTheMonth ;
                //FOR HORIZONTAL VISIBILITY
                //IF U PICK FIG. FROM 6000 you ADD 50 to the FIRST DIGIT OF THE FIG.E.G GOT 7000 YOU ADD 50 + 7.
                //IF U PICK LESS THAN 6000 YOY TEK THE FIRST 2 DIGITS OF THE FIG
                if($data->Visibility>=6000){

                    $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HorizontalVisibility_Time_2100Z"]= 50 + substr($data->Visibility,0,1);


                }elseif($data->Visibility<6000){

                    $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HorizontalVisibility_Time_2100Z"]= substr($data->Visibility,0,2); //0 means start from the first digit.then 2 means hw mny digits to tek frm the fig


                }
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["TotalAmountOfAllClouds_Time_2100Z"]= $data->TotalAmountOfAllClouds;
                //BOTH WIND DIRECTION AND WIND SPEED FROM OBSERVATION SLIP.
                //TEK THE FIRST 2 DIGITS OF THE STRING.
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["WindDirection_Time_2100Z"]= substr($data->Wind_Direction,0,2);  //substr($data['HeightOfHighClouds2'],0,3);
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["WindSpeed_Time_2100Z"]= substr($data->Wind_Speed,0,2);

                //for AIR TEMP and DEW POINT and Pressure at Station Level YOU IGNORE THE DECIMAL POINT.E.G 25.5 U TEK 255
                // str_replace('.','',$figure))
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AirTemperature_Time_2100Z"]= str_replace('.', '',$data->Dry_Bulb);
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["DewPointTemperature_Time_2100Z"]= str_replace('.', '',(((3 * $data->Wet_Bulb )- ($data->Dry_Bulb))/2));
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["PressureAtStationLevel_Time_2100Z"]= str_replace('.', '',$data->CLP);  //Pressure at the station level



                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfPrecipitation_Time_2100Z"]= $data->Rainfall;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["PresentWeather_Time_2100Z"]= $data->Present_Weather;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["PresentWeatherCode_Time_2100Z"]= $data->Present_WeatherCode;

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["PastWeather_Time_2100Z"]= $data->Past_Weather;

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfLowClouds_Time_2100Z"]= $data->TotalAmountOfLowClouds; //TotalAmountOfLowClouds

                //ALL THESE YOU TEK THE SECOND INPUT.
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["LowCloudsOftheGenera_Time_2100Z"]= $data->TypeOfLowClouds2;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["MediumCloudsOftheGenera_Time_2100Z"]= $data->TypeOfMediumClouds2;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HighCloudsOftheGenera_Time_2100Z"]= $data->TypeOfHighClouds2;



                //next page

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["MaximumTemperature_Time_2100Z"]= $data->Max_Read;

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["MinimumTemperature_Time_2100Z"]= $data->Min_Read;


                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfEvaporation_Time_2100Z"]= $data->Piche_Read;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["PressureChgIn24Hrs_Time_2100Z"]= $data->CLP;

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfIndividualLowCloudLayer_Time_2100Z"]= $data->OktasOfLowClouds1;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["GenusOfLowCloud_Time_2100Z"]= $data->CLCODEOfLowClouds1;

                //HEIGHT OF LOW CLOUD
                //TEK THE FIRST 2 FIGURES OF THE STRING
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_2100Z"]= substr($data->HeightOfLowClouds1,0,2);


                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfIndividualMediumCloudLayer_Time_2100Z"]= $data->OktasOfMediumClouds1;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["GenusOfMediumCloud_Time_2100Z"]= $data->CLCODEOfMediumClouds1;
                //HEIGHT OF MEDIUM CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_2100Z"]= substr($data->HeightOfMediumClouds1,0,2) + 50;


                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfIndividualHighCloudLayer_Time_2100Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["GenusOfHighCloud_Time_2100Z"]= $data->CLCODEOfHighClouds1;
                //HEIGHT OF HIGH CLOUD
                //TEK THE FIRST TWO FIGURES OF THE STRING THEN ADD 50 to the number
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_2100Z"]= substr($data->HeightOfHighClouds1,0,2) + 50;




                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["AmountOfIndividualMediumsCloudLayer_Time_2100Z"]= $data->OktasOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["GenusOfMediumsCloud_Time_2100Z"]= $data->CLCODEOfHighClouds1;
                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["HeightBaseOfMediumsCloudLayerOfMass_Time_2100Z"]= $data->HeightOfHighClouds1;


                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["Wind_Run_Time_2100Z"]= $data->Wind_Run;

                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["DurationOfSunshine_Time_2100Z"]= $data->DurationOfSunshine;





                $array_synopticreportdataforADayFromObservationSlip2100Z [$i]["WetBulbTemperature_Time_2100Z"]= $data->Wet_Bulb;

            }
            //////////////////////////////////////////////////////////////////////
            ///////FROM MORE FORM FIELDS TABLE
            //for TIME 2100Z
            $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z=array();  //synopticreportdataforADayFromObservationSlip0600Z
            foreach($synopticreportdataforADayFrom_MoreFormFieldsTable2100Z as $data){

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["Same_Day8_MoreFormFieldsTable"]=$data->DayOfTheMonth ;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["UnitOfWindSpeed_Time_2100Z"]= $data->UnitOfWindSpeed;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["IndOrOmissionOfPrecipitation_Time_2100Z"]= $data->IndOrOmissionOfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["TypeOfStation_Present_Past_Weather_Time_2100Z"]= $data->TypeOfStation_Present_Past_Weather;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["HeightOfLowestCloud_Time_2100Z"]= $data->HeightOfLowestCloud;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["StandardIsobaricSurface_Time_2100Z"]= $data->StandardIsobaricSurface;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["GPM_Time_2100Z"]= $data->GPM;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["DurationOfPeriodOfPrecipitation_Time_2100Z"]= $data->DurationOfPeriodOfPrecipitation;  //Pressure at the station level



                 $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["GrassMinTemp_Time_2100Z"]= $data->GrassMinTemp;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["CI_OfPrecipitation_Time_2100Z"]= $data->CI_OfPrecipitation;
                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["BE_OfPrecipitation_Time_2100Z"]= $data->BE_OfPrecipitation;



                //next page

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["IndicatorOfTypeOfIntrumentation_Time_2100Z"]= $data->IndicatorOfTypeOfIntrumentation;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["SignOfPressureChange_Time_2100Z"]= $data->SignOfPressureChange;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["Supp_Info_Time_2100Z"]= $data->Supp_Info;

                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["VapourPressure_Time_2100Z"]= $data->VapourPressure;


                $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z [$i]["T_H_Graph_Time_2100Z"]= $data->T_H_Graph;

            }




            //MERGE DIFFERENT ARRAYS
            ////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_0000Z=array();

            $finalarraymerge_Time_0000Z [$i]["Same_Day1"]=$monthDayAsANumber ;
            $finalarraymerge_Time_0000Z [$i]["Day_Time_0000Z"]= '00'; //Hard Coded
            $finalarraymerge_Time_0000Z[$i]["UnitOfWind_Time_0000Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["UnitOfWindSpeed_Time_0000Z"]; //MFF
            $finalarraymerge_Time_0000Z [$i]["BlockNumber_Time_0000Z"]=63;
            $finalarraymerge_Time_0000Z [$i]["StationNumber_Time_0000Z"]= $stationNumber;
            $finalarraymerge_Time_0000Z [$i]["IndOrOmissionOfPrecipitation_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["IndOrOmissionOfPrecipitation_Time_0000Z"]; //MFF
            $finalarraymerge_Time_0000Z [$i]["TypeOfStation_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["TypeOfStation_Present_Past_Weather_Time_0000Z"];

            $finalarraymerge_Time_0000Z [$i]["HeightOfLowestCloud_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["HeightOfLowestCloud_Time_0000Z"]; //MFF

            $finalarraymerge_Time_0000Z [$i]["HorizontalVisibility_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["HorizontalVisibility_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["TotalCloudCover_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["TotalAmountOfAllClouds_Time_0000Z"];;  //OS
            $finalarraymerge_Time_0000Z [$i]["WindDirection_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["WindDirection_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["WindSpeed_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["WindSpeed_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorOne_One_Time_0000Z"]= 1; //Hard Coded

            $finalarraymerge_Time_0000Z [$i]["SignOfDataFirstOccurance_Time_0000Z"]= 0; //Hard Coded

            $finalarraymerge_Time_0000Z [$i]["AirTemperature_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AirTemperature_Time_0000Z"]; //OS


            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorTwo_One_Time_0000Z"]= 2; //hard coded

            $finalarraymerge_Time_0000Z [$i]["SignOfDataSecondOccurance_Time_0000Z"]= 0;  //hard coded

            $finalarraymerge_Time_0000Z [$i]["DewPointTemperature_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["DewPointTemperature_Time_0000Z"]; //Calucation

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorThree_One_Time_0000Z"]= 3;  //hard coded


            $finalarraymerge_Time_0000Z [$i]["PressureAtStationLevel_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["PressureAtStationLevel_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorFour_One_Time_0000Z"]= 4;    //hard coded


            $finalarraymerge_Time_0000Z [$i]["StandardIsobaricSurface_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["StandardIsobaricSurface_Time_0000Z"]; //MFF //MMF

            $finalarraymerge_Time_0000Z [$i]["GPM_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["GPM_Time_0000Z"]; //MFF //MMF



            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorSix_One_Time_0000Z"]= 6; //Hard code
            $finalarraymerge_Time_0000Z [$i]["AmountOfPrecipitation_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfPrecipitation_Time_0000Z"]; //OS RAINFALL

            $finalarraymerge_Time_0000Z [$i]["DurationOfPeriodOfPrecipitation_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["DurationOfPeriodOfPrecipitation_Time_0000Z"]; //MFF //MMF


            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorSeven_One_Time_0000Z"]= 7; //Hard Coded
            $finalarraymerge_Time_0000Z [$i]["PresentWeatherCode_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["PresentWeatherCode_Time_0000Z"];
            $finalarraymerge_Time_0000Z [$i]["PastWeather_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["PastWeather_Time_0000Z"]; //MFF //MMF

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_One_Time_0000Z"]= 8; //Hard Coded
            $finalarraymerge_Time_0000Z [$i]["AmountOfLowClouds_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfLowClouds_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["LowCloudsOftheGenera_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["LowCloudsOftheGenera_Time_0000Z"];  //OS
            $finalarraymerge_Time_0000Z [$i]["MediumCloudsOftheGenera_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["MediumCloudsOftheGenera_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["HighCloudsOftheGenera_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["HighCloudsOftheGenera_Time_0000Z"];  //OS

            $finalarraymerge_Time_0000Z [$i]["SectionIndicator333_Time_0000Z"]=333; //hard coded
            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorZero_Time_0000Z"]= 0;  //hard coded
            $finalarraymerge_Time_0000Z [$i]["GrassMinimumTemperature_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["GrassMinTemp_Time_0000Z"]; //MFF

            $finalarraymerge_Time_0000Z [$i]["CI_OfPrecipitation_Time_0000Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["CI_OfPrecipitation_Time_0000Z"];//MMF
            $finalarraymerge_Time_0000Z [$i]["BOrEOfPrecipitation_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["BE_OfPrecipitation_Time_0000Z"]; //MMF


            //next page
            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorOne_Two_Time_0000Z"]=1;//hard coded
            $finalarraymerge_Time_0000Z [$i]["SignOfDataThirdOccurance_Time_0000Z"]= 0; //hard coded
            $finalarraymerge_Time_0000Z [$i]["MaximumTemperature_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["MaximumTemperature_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorTwo_Two_Time_0000Z"]= 2; //hard coded

            $finalarraymerge_Time_0000Z [$i]["SignOfDataFourthOccurance_Time_0000Z"]= 0;//hard coded
            $finalarraymerge_Time_0000Z [$i]["MinimumTemperature_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["MinimumTemperature_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorFive_One_Time_0000Z"]= 5; //hard coded
            $finalarraymerge_Time_0000Z [$i]["AmountOfEvaporation_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfEvaporation_Time_0000Z"];

            $finalarraymerge_Time_0000Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["IndicatorOfTypeOfIntrumentation_Time_0000Z"]; //MMF


            $finalarraymerge_Time_0000Z [$i]["GroupIndicator55_Time_0000Z"]= 55; //hard coded

            $finalarraymerge_Time_0000Z [$i]["DurationOfSunshine_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["DurationOfSunshine_Time_0000Z"]; //MMF


            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorFive_Two_Time_0000Z"]= 5; //hard coded

            $finalarraymerge_Time_0000Z [$i]["SignOfPressureChange_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["SignOfPressureChange_Time_0000Z"]; //MMF

            $finalarraymerge_Time_0000Z [$i]["PressureChgIn24Hrs_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["PressureChgIn24Hrs_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorSix_Two_Time_0000Z"]= 6; //hard coded

            $finalarraymerge_Time_0000Z [$i]["AmountOfPrecipitation_Two_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfPrecipitation_Time_0000Z"];
            $finalarraymerge_Time_0000Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["DurationOfPeriodOfPrecipitation_Time_0000Z"]; //MMF
            //MMF


            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Two_Time_0000Z"]= 8; //hard coded

            $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualLowCloudLayer_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfIndividualLowCloudLayer_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["GenusOfLowCloud_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["GenusOfLowCloud_Time_0000Z"];  //OS
            $finalarraymerge_Time_0000Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Three_Time_0000Z"]= 8; //hard coded

            $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfIndividualMediumCloudLayer_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["GenusOfMediumCloud_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["GenusOfMediumCloud_Time_0000Z"]; //OS
            $finalarraymerge_Time_0000Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0000Z"]; //OS

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Four_Time_0000Z"]= 8; //hard coded

            $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualHighCloudLayer_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["AmountOfIndividualHighCloudLayer_Time_0000Z"];
            $finalarraymerge_Time_0000Z [$i]["GenusOfHighCloud_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["GenusOfHighCloud_Time_0000Z"];
            $finalarraymerge_Time_0000Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_0000Z"];

            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Five_Time_0000Z"]= 8;  //hard coded




            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorNine_One_Time_0000Z"]= 9; //hard coded


            $finalarraymerge_Time_0000Z [$i]["SupplementaryInformation_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["Supp_Info_Time_0000Z"]; //MMF
            $finalarraymerge_Time_0000Z [$i]["SectionIndicator555_Time_0000Z"]= 555; //HARD CODED
            $finalarraymerge_Time_0000Z [$i]["GroupIndicatorOne_Three_Time_0000Z"]= 1; //HARD CODED

            $finalarraymerge_Time_0000Z [$i]["SignOfDataFourthOccurance_Time_0000Z"]= 0; //HARD CODED

            $finalarraymerge_Time_0000Z [$i]["WetBulbTemperature_Time_0000Z"]= $array_synopticreportdataforADayFromObservationSlip0000Z[$i]["WetBulbTemperature_Time_0000Z"];
            $finalarraymerge_Time_0000Z [$i]["RelativeHumidity_Time_0000Z"]= ''; //still blank
            $finalarraymerge_Time_0000Z [$i]["VapourPressure_Time_0000Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0000Z[$i]["VapourPressure_Time_0000Z"]; //MMF


            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_0300Z=array();

            $finalarraymerge_Time_0300Z [$i]["Same_Day2"]=$monthDayAsANumber ;
            $finalarraymerge_Time_0300Z [$i]["Day_Time_0300Z"]= '03'; //Hard Coded
            $finalarraymerge_Time_0300Z[$i]["UnitOfWind_Time_0300Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["UnitOfWindSpeed_Time_0300Z"]; //MFF
            $finalarraymerge_Time_0300Z [$i]["BlockNumber_Time_0300Z"]=63;
            $finalarraymerge_Time_0300Z [$i]["StationNumber_Time_0300Z"]= $stationNumber;
            $finalarraymerge_Time_0300Z [$i]["IndOrOmissionOfPrecipitation_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["IndOrOmissionOfPrecipitation_Time_0300Z"]; //MFF
            $finalarraymerge_Time_0300Z [$i]["TypeOfStation_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["TypeOfStation_Present_Past_Weather_Time_0300Z"];

            $finalarraymerge_Time_0300Z [$i]["HeightOfLowestCloud_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["HeightOfLowestCloud_Time_0300Z"]; //MFF

            $finalarraymerge_Time_0300Z [$i]["HorizontalVisibility_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["HorizontalVisibility_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["TotalCloudCover_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["TotalAmountOfAllClouds_Time_0300Z"];;  //OS
            $finalarraymerge_Time_0300Z [$i]["WindDirection_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["WindDirection_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["WindSpeed_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["WindSpeed_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorOne_One_Time_0300Z"]= 1; //Hard Coded

            $finalarraymerge_Time_0300Z [$i]["SignOfDataFirstOccurance_Time_0300Z"]= 0; //Hard Coded

            $finalarraymerge_Time_0300Z [$i]["AirTemperature_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AirTemperature_Time_0300Z"]; //OS


            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorTwo_One_Time_0300Z"]= 2; //hard coded

            $finalarraymerge_Time_0300Z [$i]["SignOfDataSecondOccurance_Time_0300Z"]= 0;  //hard coded

            $finalarraymerge_Time_0300Z [$i]["DewPointTemperature_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["DewPointTemperature_Time_0300Z"]; //Calucation

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorThree_One_Time_0300Z"]= 3;  //hard coded


            $finalarraymerge_Time_0300Z [$i]["PressureAtStationLevel_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["PressureAtStationLevel_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorFour_One_Time_0300Z"]= 4;    //hard coded


            $finalarraymerge_Time_0300Z [$i]["StandardIsobaricSurface_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["StandardIsobaricSurface_Time_0300Z"]; //MFF //MMF

            $finalarraymerge_Time_0300Z [$i]["GPM_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["GPM_Time_0300Z"]; //MFF //MMF



            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorSix_One_Time_0300Z"]= 6; //Hard code
            $finalarraymerge_Time_0300Z [$i]["AmountOfPrecipitation_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfPrecipitation_Time_0300Z"]; //OS RAINFALL

            $finalarraymerge_Time_0300Z [$i]["DurationOfPeriodOfPrecipitation_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["DurationOfPeriodOfPrecipitation_Time_0300Z"]; //MFF //MMF


            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorSeven_One_Time_0300Z"]= 7; //Hard Coded
            $finalarraymerge_Time_0300Z [$i]["PresentWeatherCode_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["PresentWeatherCode_Time_0300Z"];
            $finalarraymerge_Time_0300Z [$i]["PastWeather_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["PastWeather_Time_0300Z"]; //MFF //MMF

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_One_Time_0300Z"]= 8; //Hard Coded
            $finalarraymerge_Time_0300Z [$i]["AmountOfLowClouds_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfLowClouds_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["LowCloudsOftheGenera_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["LowCloudsOftheGenera_Time_0300Z"];  //OS
            $finalarraymerge_Time_0300Z [$i]["MediumCloudsOftheGenera_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["MediumCloudsOftheGenera_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["HighCloudsOftheGenera_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["HighCloudsOftheGenera_Time_0300Z"];  //OS

            $finalarraymerge_Time_0300Z [$i]["SectionIndicator333_Time_0300Z"]=333; //hard coded
            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorZero_Time_0300Z"]= 0;  //hard coded
            $finalarraymerge_Time_0300Z [$i]["GrassMinimumTemperature_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["GrassMinTemp_Time_0300Z"]; //MFF

            $finalarraymerge_Time_0300Z [$i]["CI_OfPrecipitation_Time_0300Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["CI_OfPrecipitation_Time_0300Z"];//MMF
            $finalarraymerge_Time_0300Z [$i]["BOrEOfPrecipitation_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["BE_OfPrecipitation_Time_0300Z"]; //MMF


            //next page
            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorOne_Two_Time_0300Z"]=1;//hard coded
            $finalarraymerge_Time_0300Z [$i]["SignOfDataThirdOccurance_Time_0300Z"]= 0; //hard coded
            $finalarraymerge_Time_0300Z [$i]["MaximumTemperature_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["MaximumTemperature_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorTwo_Two_Time_0300Z"]= 2; //hard coded

            $finalarraymerge_Time_0300Z [$i]["SignOfDataFourthOccurance_Time_0300Z"]= 0;//hard coded
            $finalarraymerge_Time_0300Z [$i]["MinimumTemperature_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["MinimumTemperature_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorFive_One_Time_0300Z"]= 5; //hard coded
            $finalarraymerge_Time_0300Z [$i]["AmountOfEvaporation_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfEvaporation_Time_0300Z"];

            $finalarraymerge_Time_0300Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["IndicatorOfTypeOfIntrumentation_Time_0300Z"]; //MMF


            $finalarraymerge_Time_0300Z [$i]["GroupIndicator55_Time_0300Z"]= 55; //hard coded

            $finalarraymerge_Time_0300Z [$i]["DurationOfSunshine_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["DurationOfSunshine_Time_0300Z"]; //MMF


            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorFive_Two_Time_0300Z"]= 5; //hard coded

            $finalarraymerge_Time_0300Z [$i]["SignOfPressureChange_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["SignOfPressureChange_Time_0300Z"]; //MMF

            $finalarraymerge_Time_0300Z [$i]["PressureChgIn24Hrs_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["PressureChgIn24Hrs_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorSix_Two_Time_0300Z"]= 6; //hard coded

            $finalarraymerge_Time_0300Z [$i]["AmountOfPrecipitation_Two_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfPrecipitation_Time_0300Z"];
            $finalarraymerge_Time_0300Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["DurationOfPeriodOfPrecipitation_Time_0300Z"]; //MMF
            //MMF


            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Two_Time_0300Z"]= 8; //hard coded

            $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualLowCloudLayer_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfIndividualLowCloudLayer_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["GenusOfLowCloud_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["GenusOfLowCloud_Time_0300Z"];  //OS
            $finalarraymerge_Time_0300Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Three_Time_0300Z"]= 8; //hard coded

            $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfIndividualMediumCloudLayer_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["GenusOfMediumCloud_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["GenusOfMediumCloud_Time_0300Z"]; //OS
            $finalarraymerge_Time_0300Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0300Z"]; //OS

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Four_Time_0300Z"]= 8; //hard coded

            $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualHighCloudLayer_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["AmountOfIndividualHighCloudLayer_Time_0300Z"];
            $finalarraymerge_Time_0300Z [$i]["GenusOfHighCloud_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["GenusOfHighCloud_Time_0300Z"];
            $finalarraymerge_Time_0300Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_0300Z"];

            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Five_Time_0300Z"]= 8;  //hard coded




            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorNine_One_Time_0300Z"]= 9; //hard coded


            $finalarraymerge_Time_0300Z [$i]["SupplementaryInformation_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["Supp_Info_Time_0300Z"]; //MMF
            $finalarraymerge_Time_0300Z [$i]["SectionIndicator555_Time_0300Z"]= 555; //HARD CODED
            $finalarraymerge_Time_0300Z [$i]["GroupIndicatorOne_Three_Time_0300Z"]= 1; //HARD CODED

            $finalarraymerge_Time_0300Z [$i]["SignOfDataFourthOccurance_Time_0300Z"]= 0; //HARD CODED

            $finalarraymerge_Time_0300Z [$i]["WetBulbTemperature_Time_0300Z"]= $array_synopticreportdataforADayFromObservationSlip0300Z[$i]["WetBulbTemperature_Time_0300Z"];
            $finalarraymerge_Time_0300Z [$i]["RelativeHumidity_Time_0300Z"]= ''; //still blank
            $finalarraymerge_Time_0300Z [$i]["VapourPressure_Time_0300Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0300Z[$i]["VapourPressure_Time_0300Z"]; //MMF


            ////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_0600Z=array();


            $finalarraymerge_Time_0600Z [$i]["Same_Day3"]=$monthDayAsANumber ;
            $finalarraymerge_Time_0600Z [$i]["Day_Time_0600Z"]= '06'; //Hard Coded
            $finalarraymerge_Time_0600Z[$i]["UnitOfWind_Time_0600Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["UnitOfWindSpeed_Time_0600Z"]; //MFF
            $finalarraymerge_Time_0600Z [$i]["BlockNumber_Time_0600Z"]=63;
            $finalarraymerge_Time_0600Z [$i]["StationNumber_Time_0600Z"]= $stationNumber;
            $finalarraymerge_Time_0600Z [$i]["IndOrOmissionOfPrecipitation_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["IndOrOmissionOfPrecipitation_Time_0600Z"]; //MFF
            $finalarraymerge_Time_0600Z [$i]["TypeOfStation_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["TypeOfStation_Present_Past_Weather_Time_0600Z"];

            $finalarraymerge_Time_0600Z [$i]["HeightOfLowestCloud_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["HeightOfLowestCloud_Time_0600Z"]; //MFF

            $finalarraymerge_Time_0600Z [$i]["HorizontalVisibility_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["HorizontalVisibility_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["TotalCloudCover_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["TotalAmountOfAllClouds_Time_0600Z"];;  //OS
            $finalarraymerge_Time_0600Z [$i]["WindDirection_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["WindDirection_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["WindSpeed_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["WindSpeed_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorOne_One_Time_0600Z"]= 1; //Hard Coded

            $finalarraymerge_Time_0600Z [$i]["SignOfDataFirstOccurance_Time_0600Z"]= 0; //Hard Coded

            $finalarraymerge_Time_0600Z [$i]["AirTemperature_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AirTemperature_Time_0600Z"]; //OS


            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorTwo_One_Time_0600Z"]= 2; //hard coded

            $finalarraymerge_Time_0600Z [$i]["SignOfDataSecondOccurance_Time_0600Z"]= 0;  //hard coded

            $finalarraymerge_Time_0600Z [$i]["DewPointTemperature_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["DewPointTemperature_Time_0600Z"]; //Calucation

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorThree_One_Time_0600Z"]= 3;  //hard coded


            $finalarraymerge_Time_0600Z [$i]["PressureAtStationLevel_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["PressureAtStationLevel_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorFour_One_Time_0600Z"]= 4;    //hard coded


            $finalarraymerge_Time_0600Z [$i]["StandardIsobaricSurface_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["StandardIsobaricSurface_Time_0600Z"]; //MFF //MMF

            $finalarraymerge_Time_0600Z [$i]["GPM_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["GPM_Time_0600Z"]; //MFF //MMF



            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorSix_One_Time_0600Z"]= 6; //Hard code
            $finalarraymerge_Time_0600Z [$i]["AmountOfPrecipitation_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfPrecipitation_Time_0600Z"]; //OS RAINFALL

            $finalarraymerge_Time_0600Z [$i]["DurationOfPeriodOfPrecipitation_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["DurationOfPeriodOfPrecipitation_Time_0600Z"]; //MFF //MMF


            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorSeven_One_Time_0600Z"]= 7; //Hard Coded
            $finalarraymerge_Time_0600Z [$i]["PresentWeatherCode_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["PresentWeatherCode_Time_0600Z"];
            $finalarraymerge_Time_0600Z [$i]["PastWeather_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["PastWeather_Time_0600Z"]; //MFF //MMF



            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_One_Time_0600Z"]= 8; //Hard Coded
            $finalarraymerge_Time_0600Z [$i]["AmountOfLowClouds_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfLowClouds_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["LowCloudsOftheGenera_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["LowCloudsOftheGenera_Time_0600Z"];  //OS
            $finalarraymerge_Time_0600Z [$i]["MediumCloudsOftheGenera_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["MediumCloudsOftheGenera_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["HighCloudsOftheGenera_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["HighCloudsOftheGenera_Time_0600Z"];  //OS

            $finalarraymerge_Time_0600Z [$i]["SectionIndicator333_Time_0600Z"]=333; //hard coded
            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorZero_Time_0600Z"]= 0;  //hard coded
            $finalarraymerge_Time_0600Z [$i]["GrassMinimumTemperature_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["GrassMinTemp_Time_0600Z"]; //MFF

            $finalarraymerge_Time_0600Z [$i]["CI_OfPrecipitation_Time_0600Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["CI_OfPrecipitation_Time_0600Z"];//MMF
            $finalarraymerge_Time_0600Z [$i]["BOrEOfPrecipitation_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["BE_OfPrecipitation_Time_0600Z"]; //MMF


            //next page
            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorOne_Two_Time_0600Z"]=1;//hard coded
            $finalarraymerge_Time_0600Z [$i]["SignOfDataThirdOccurance_Time_0600Z"]= 0; //hard coded
            $finalarraymerge_Time_0600Z [$i]["MaximumTemperature_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["MaximumTemperature_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorTwo_Two_Time_0600Z"]= 2; //hard coded

            $finalarraymerge_Time_0600Z [$i]["SignOfDataFourthOccurance_Time_0600Z"]= 0;//hard coded
            $finalarraymerge_Time_0600Z [$i]["MinimumTemperature_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["MinimumTemperature_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorFive_One_Time_0600Z"]= 5; //hard coded
            $finalarraymerge_Time_0600Z [$i]["AmountOfEvaporation_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfEvaporation_Time_0600Z"];

            $finalarraymerge_Time_0600Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["IndicatorOfTypeOfIntrumentation_Time_0600Z"]; //MMF


            $finalarraymerge_Time_0600Z [$i]["GroupIndicator55_Time_0600Z"]= 55; //hard coded

            $finalarraymerge_Time_0600Z [$i]["DurationOfSunshine_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["DurationOfSunshine_Time_0600Z"]; //MMF


            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorFive_Two_Time_0600Z"]= 5; //hard coded

            $finalarraymerge_Time_0600Z [$i]["SignOfPressureChange_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["SignOfPressureChange_Time_0600Z"]; //MMF

            $finalarraymerge_Time_0600Z [$i]["PressureChgIn24Hrs_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["PressureChgIn24Hrs_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorSix_Two_Time_0600Z"]= 6; //hard coded

            $finalarraymerge_Time_0600Z [$i]["AmountOfPrecipitation_Two_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfPrecipitation_Time_0600Z"];
            $finalarraymerge_Time_0600Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["DurationOfPeriodOfPrecipitation_Time_0600Z"]; //MMF
            //MMF


            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Two_Time_0600Z"]= 8; //hard coded

            $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualLowCloudLayer_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfIndividualLowCloudLayer_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["GenusOfLowCloud_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["GenusOfLowCloud_Time_0600Z"];  //OS
            $finalarraymerge_Time_0600Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Three_Time_0600Z"]= 8; //hard coded

            $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfIndividualMediumCloudLayer_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["GenusOfMediumCloud_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["GenusOfMediumCloud_Time_0600Z"]; //OS
            $finalarraymerge_Time_0600Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0600Z"]; //OS

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Four_Time_0600Z"]= 8; //hard coded

            $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualHighCloudLayer_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["AmountOfIndividualHighCloudLayer_Time_0600Z"];
            $finalarraymerge_Time_0600Z [$i]["GenusOfHighCloud_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["GenusOfHighCloud_Time_0600Z"];
            $finalarraymerge_Time_0600Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_0600Z"];

            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Five_Time_0600Z"]= 8;  //hard coded




            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorNine_One_Time_0600Z"]= 9; //hard coded


            $finalarraymerge_Time_0600Z [$i]["SupplementaryInformation_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["Supp_Info_Time_0600Z"]; //MMF
            $finalarraymerge_Time_0600Z [$i]["SectionIndicator555_Time_0600Z"]= 555; //HARD CODED
            $finalarraymerge_Time_0600Z [$i]["GroupIndicatorOne_Three_Time_0600Z"]= 1; //HARD CODED

            $finalarraymerge_Time_0600Z [$i]["SignOfDataFourthOccurance_Time_0600Z"]= 0; //HARD CODED

            $finalarraymerge_Time_0600Z [$i]["WetBulbTemperature_Time_0600Z"]= $array_synopticreportdataforADayFromObservationSlip0600Z[$i]["WetBulbTemperature_Time_0600Z"];
            $finalarraymerge_Time_0600Z [$i]["RelativeHumidity_Time_0600Z"]= ''; //still blank
            $finalarraymerge_Time_0600Z [$i]["VapourPressure_Time_0600Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0600Z[$i]["VapourPressure_Time_0600Z"]; //MMF

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_0900Z=array();

            $finalarraymerge_Time_0900Z [$i]["Same_Day4"]=$monthDayAsANumber ;
            $finalarraymerge_Time_0900Z [$i]["Day_Time_0900Z"]= '09'; //Hard Coded
            $finalarraymerge_Time_0900Z[$i]["UnitOfWind_Time_0900Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["UnitOfWindSpeed_Time_0900Z"]; //MFF
            $finalarraymerge_Time_0900Z [$i]["BlockNumber_Time_0900Z"]=63;
            $finalarraymerge_Time_0900Z [$i]["StationNumber_Time_0900Z"]= $stationNumber;
            $finalarraymerge_Time_0900Z [$i]["IndOrOmissionOfPrecipitation_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["IndOrOmissionOfPrecipitation_Time_0900Z"]; //MFF
            $finalarraymerge_Time_0900Z [$i]["TypeOfStation_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["TypeOfStation_Present_Past_Weather_Time_0900Z"];

            $finalarraymerge_Time_0900Z [$i]["HeightOfLowestCloud_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["HeightOfLowestCloud_Time_0900Z"]; //MFF

            $finalarraymerge_Time_0900Z [$i]["HorizontalVisibility_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["HorizontalVisibility_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["TotalCloudCover_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["TotalAmountOfAllClouds_Time_0900Z"];;  //OS
            $finalarraymerge_Time_0900Z [$i]["WindDirection_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["WindDirection_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["WindSpeed_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["WindSpeed_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorOne_One_Time_0900Z"]= 1; //Hard Coded

            $finalarraymerge_Time_0900Z [$i]["SignOfDataFirstOccurance_Time_0900Z"]= 0; //Hard Coded

            $finalarraymerge_Time_0900Z [$i]["AirTemperature_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AirTemperature_Time_0900Z"]; //OS


            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorTwo_One_Time_0900Z"]= 2; //hard coded

            $finalarraymerge_Time_0900Z [$i]["SignOfDataSecondOccurance_Time_0900Z"]= 0;  //hard coded

            $finalarraymerge_Time_0900Z [$i]["DewPointTemperature_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["DewPointTemperature_Time_0900Z"]; //Calucation

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorThree_One_Time_0900Z"]= 3;  //hard coded


            $finalarraymerge_Time_0900Z [$i]["PressureAtStationLevel_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["PressureAtStationLevel_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorFour_One_Time_0900Z"]= 4;    //hard coded


            $finalarraymerge_Time_0900Z [$i]["StandardIsobaricSurface_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["StandardIsobaricSurface_Time_0900Z"]; //MFF //MMF

            $finalarraymerge_Time_0900Z [$i]["GPM_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["GPM_Time_0900Z"]; //MFF //MMF



            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorSix_One_Time_0900Z"]= 6; //Hard code
            $finalarraymerge_Time_0900Z [$i]["AmountOfPrecipitation_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfPrecipitation_Time_0900Z"]; //OS RAINFALL

            $finalarraymerge_Time_0900Z [$i]["DurationOfPeriodOfPrecipitation_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["DurationOfPeriodOfPrecipitation_Time_0900Z"]; //MFF //MMF


            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorSeven_One_Time_0900Z"]= 7; //Hard Coded
            $finalarraymerge_Time_0900Z [$i]["PresentWeatherCode_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["PresentWeatherCode_Time_0900Z"];
            $finalarraymerge_Time_0900Z [$i]["PastWeather_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["PastWeather_Time_0900Z"]; //MFF //MMF

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_One_Time_0900Z"]= 8; //Hard Coded
            $finalarraymerge_Time_0900Z [$i]["AmountOfLowClouds_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfLowClouds_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["LowCloudsOftheGenera_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["LowCloudsOftheGenera_Time_0900Z"];  //OS
            $finalarraymerge_Time_0900Z [$i]["MediumCloudsOftheGenera_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["MediumCloudsOftheGenera_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["HighCloudsOftheGenera_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["HighCloudsOftheGenera_Time_0900Z"];  //OS

            $finalarraymerge_Time_0900Z [$i]["SectionIndicator333_Time_0900Z"]=333; //hard coded
            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorZero_Time_0900Z"]= 0;  //hard coded
            $finalarraymerge_Time_0900Z [$i]["GrassMinimumTemperature_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["GrassMinTemp_Time_0900Z"]; //MFF

            $finalarraymerge_Time_0900Z [$i]["CI_OfPrecipitation_Time_0900Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["CI_OfPrecipitation_Time_0900Z"];//MMF
            $finalarraymerge_Time_0900Z [$i]["BOrEOfPrecipitation_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["BE_OfPrecipitation_Time_0900Z"]; //MMF


            //next page
            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorOne_Two_Time_0900Z"]=1;//hard coded
            $finalarraymerge_Time_0900Z [$i]["SignOfDataThirdOccurance_Time_0900Z"]= 0; //hard coded
            $finalarraymerge_Time_0900Z [$i]["MaximumTemperature_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["MaximumTemperature_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorTwo_Two_Time_0900Z"]= 2; //hard coded

            $finalarraymerge_Time_0900Z [$i]["SignOfDataFourthOccurance_Time_0900Z"]= 0;//hard coded
            $finalarraymerge_Time_0900Z [$i]["MinimumTemperature_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["MinimumTemperature_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorFive_One_Time_0900Z"]= 5; //hard coded
            $finalarraymerge_Time_0900Z [$i]["AmountOfEvaporation_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfEvaporation_Time_0900Z"];

            $finalarraymerge_Time_0900Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["IndicatorOfTypeOfIntrumentation_Time_0900Z"]; //MMF


            $finalarraymerge_Time_0900Z [$i]["GroupIndicator55_Time_0900Z"]= 55; //hard coded

            $finalarraymerge_Time_0900Z [$i]["DurationOfSunshine_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["DurationOfSunshine_Time_0900Z"]; //OS


            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorFive_Two_Time_0900Z"]= 5; //hard coded

            $finalarraymerge_Time_0900Z [$i]["SignOfPressureChange_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["SignOfPressureChange_Time_0900Z"]; //MMF

            $finalarraymerge_Time_0900Z [$i]["PressureChgIn24Hrs_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["PressureChgIn24Hrs_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorSix_Two_Time_0900Z"]= 6; //hard coded

            $finalarraymerge_Time_0900Z [$i]["AmountOfPrecipitation_Two_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfPrecipitation_Time_0900Z"];
            $finalarraymerge_Time_0900Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["DurationOfPeriodOfPrecipitation_Time_0900Z"]; //MMF
            //MMF


            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Two_Time_0900Z"]= 8; //hard coded

            $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualLowCloudLayer_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfIndividualLowCloudLayer_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["GenusOfLowCloud_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["GenusOfLowCloud_Time_0900Z"];  //OS
            $finalarraymerge_Time_0900Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Three_Time_0900Z"]= 8; //hard coded

            $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfIndividualMediumCloudLayer_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["GenusOfMediumCloud_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["GenusOfMediumCloud_Time_0900Z"]; //OS
            $finalarraymerge_Time_0900Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0900Z"]; //OS

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Four_Time_0900Z"]= 8; //hard coded

            $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualHighCloudLayer_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["AmountOfIndividualHighCloudLayer_Time_0900Z"];
            $finalarraymerge_Time_0900Z [$i]["GenusOfHighCloud_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["GenusOfHighCloud_Time_0900Z"];
            $finalarraymerge_Time_0900Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_0900Z"];

            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Five_Time_0900Z"]= 8;  //hard coded




            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorNine_One_Time_0900Z"]= 9; //hard coded


            $finalarraymerge_Time_0900Z [$i]["SupplementaryInformation_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["Supp_Info_Time_0900Z"]; //MMF
            $finalarraymerge_Time_0900Z [$i]["SectionIndicator555_Time_0900Z"]= 555; //HARD CODED
            $finalarraymerge_Time_0900Z [$i]["GroupIndicatorOne_Three_Time_0900Z"]= 1; //HARD CODED

            $finalarraymerge_Time_0900Z [$i]["SignOfDataFourthOccurance_Time_0900Z"]= 0; //HARD CODED

            $finalarraymerge_Time_0900Z [$i]["WetBulbTemperature_Time_0900Z"]= $array_synopticreportdataforADayFromObservationSlip0900Z[$i]["WetBulbTemperature_Time_0900Z"];
            $finalarraymerge_Time_0900Z [$i]["RelativeHumidity_Time_0900Z"]= ''; //still blank
            $finalarraymerge_Time_0900Z [$i]["VapourPressure_Time_0900Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable0900Z[$i]["VapourPressure_Time_0900Z"]; //MMF


            ////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_1200Z=array();

            $finalarraymerge_Time_1200Z [$i]["Same_Day5"]=$monthDayAsANumber ;
            $finalarraymerge_Time_1200Z [$i]["Day_Time_1200Z"]= '12'; //Hard Coded
            $finalarraymerge_Time_1200Z[$i]["UnitOfWind_Time_1200Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["UnitOfWindSpeed_Time_1200Z"]; //MFF
            $finalarraymerge_Time_1200Z [$i]["BlockNumber_Time_1200Z"]=63;
            $finalarraymerge_Time_1200Z [$i]["StationNumber_Time_1200Z"]= $stationNumber;
            $finalarraymerge_Time_1200Z [$i]["IndOrOmissionOfPrecipitation_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["IndOrOmissionOfPrecipitation_Time_1200Z"]; //MFF
            $finalarraymerge_Time_1200Z [$i]["TypeOfStation_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["TypeOfStation_Present_Past_Weather_Time_1200Z"];

            $finalarraymerge_Time_1200Z [$i]["HeightOfLowestCloud_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["HeightOfLowestCloud_Time_1200Z"]; //MFF

            $finalarraymerge_Time_1200Z [$i]["HorizontalVisibility_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["HorizontalVisibility_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["TotalCloudCover_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["TotalAmountOfAllClouds_Time_1200Z"];;  //OS
            $finalarraymerge_Time_1200Z [$i]["WindDirection_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["WindDirection_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["WindSpeed_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["WindSpeed_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorOne_One_Time_1200Z"]= 1; //Hard Coded

            $finalarraymerge_Time_1200Z [$i]["SignOfDataFirstOccurance_Time_1200Z"]= 0; //Hard Coded

            $finalarraymerge_Time_1200Z [$i]["AirTemperature_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AirTemperature_Time_1200Z"]; //OS


            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorTwo_One_Time_1200Z"]= 2; //hard coded

            $finalarraymerge_Time_1200Z [$i]["SignOfDataSecondOccurance_Time_1200Z"]= 0;  //hard coded

            $finalarraymerge_Time_1200Z [$i]["DewPointTemperature_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["DewPointTemperature_Time_1200Z"]; //Calucation

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorThree_One_Time_1200Z"]= 3;  //hard coded


            $finalarraymerge_Time_1200Z [$i]["PressureAtStationLevel_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["PressureAtStationLevel_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorFour_One_Time_1200Z"]= 4;    //hard coded


            $finalarraymerge_Time_1200Z [$i]["StandardIsobaricSurface_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["StandardIsobaricSurface_Time_1200Z"]; //MFF //MMF

            $finalarraymerge_Time_1200Z [$i]["GPM_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["GPM_Time_1200Z"]; //MFF //MMF



            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorSix_One_Time_1200Z"]= 6; //Hard code
            $finalarraymerge_Time_1200Z [$i]["AmountOfPrecipitation_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfPrecipitation_Time_1200Z"]; //OS RAINFALL

            $finalarraymerge_Time_1200Z [$i]["DurationOfPeriodOfPrecipitation_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["DurationOfPeriodOfPrecipitation_Time_1200Z"]; //MFF //MMF


            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorSeven_One_Time_1200Z"]= 7; //Hard Coded
            $finalarraymerge_Time_1200Z [$i]["PresentWeatherCode_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["PresentWeatherCode_Time_1200Z"];
            $finalarraymerge_Time_1200Z [$i]["PastWeather_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["PastWeather_Time_1200Z"]; //MFF //MMF

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_One_Time_1200Z"]= 8; //Hard Coded
            $finalarraymerge_Time_1200Z [$i]["AmountOfLowClouds_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfLowClouds_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["LowCloudsOftheGenera_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["LowCloudsOftheGenera_Time_1200Z"];  //OS
            $finalarraymerge_Time_1200Z [$i]["MediumCloudsOftheGenera_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["MediumCloudsOftheGenera_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["HighCloudsOftheGenera_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["HighCloudsOftheGenera_Time_1200Z"];  //OS

            $finalarraymerge_Time_1200Z [$i]["SectionIndicator333_Time_1200Z"]=333; //hard coded
            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorZero_Time_1200Z"]= 0;  //hard coded
            $finalarraymerge_Time_1200Z [$i]["GrassMinimumTemperature_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["GrassMinTemp_Time_1200Z"]; //MFF

            $finalarraymerge_Time_1200Z [$i]["CI_OfPrecipitation_Time_1200Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["CI_OfPrecipitation_Time_1200Z"];//MMF
            $finalarraymerge_Time_1200Z [$i]["BOrEOfPrecipitation_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["BE_OfPrecipitation_Time_1200Z"]; //MMF


            //next page
            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorOne_Two_Time_1200Z"]=1;//hard coded
            $finalarraymerge_Time_1200Z [$i]["SignOfDataThirdOccurance_Time_1200Z"]= 0; //hard coded
            $finalarraymerge_Time_1200Z [$i]["MaximumTemperature_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["MaximumTemperature_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorTwo_Two_Time_1200Z"]= 2; //hard coded

            $finalarraymerge_Time_1200Z [$i]["SignOfDataFourthOccurance_Time_1200Z"]= 0;//hard coded
            $finalarraymerge_Time_1200Z [$i]["MinimumTemperature_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["MinimumTemperature_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorFive_One_Time_1200Z"]= 5; //hard coded
            $finalarraymerge_Time_1200Z [$i]["AmountOfEvaporation_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfEvaporation_Time_1200Z"];

            $finalarraymerge_Time_1200Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["IndicatorOfTypeOfIntrumentation_Time_1200Z"]; //MMF


            $finalarraymerge_Time_1200Z [$i]["GroupIndicator55_Time_1200Z"]= 55; //hard coded

            $finalarraymerge_Time_1200Z [$i]["DurationOfSunshine_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["DurationOfSunshine_Time_1200Z"]; //OS


            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorFive_Two_Time_1200Z"]= 5; //hard coded

            $finalarraymerge_Time_1200Z [$i]["SignOfPressureChange_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["SignOfPressureChange_Time_1200Z"]; //MMF

            $finalarraymerge_Time_1200Z [$i]["PressureChgIn24Hrs_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["PressureChgIn24Hrs_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorSix_Two_Time_1200Z"]= 6; //hard coded

            $finalarraymerge_Time_1200Z [$i]["AmountOfPrecipitation_Two_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfPrecipitation_Time_1200Z"];
            $finalarraymerge_Time_1200Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["DurationOfPeriodOfPrecipitation_Time_1200Z"]; //MMF
            //MMF


            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Two_Time_1200Z"]= 8; //hard coded

            $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualLowCloudLayer_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfIndividualLowCloudLayer_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["GenusOfLowCloud_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["GenusOfLowCloud_Time_1200Z"];  //OS
            $finalarraymerge_Time_1200Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Three_Time_1200Z"]= 8; //hard coded

            $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfIndividualMediumCloudLayer_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["GenusOfMediumCloud_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["GenusOfMediumCloud_Time_1200Z"]; //OS
            $finalarraymerge_Time_1200Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1200Z"]; //OS

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Four_Time_1200Z"]= 8; //hard coded

            $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualHighCloudLayer_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["AmountOfIndividualHighCloudLayer_Time_1200Z"];
            $finalarraymerge_Time_1200Z [$i]["GenusOfHighCloud_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["GenusOfHighCloud_Time_1200Z"];
            $finalarraymerge_Time_1200Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_1200Z"];

            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Five_Time_1200Z"]= 8;  //hard coded




            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorNine_One_Time_1200Z"]= 9; //hard coded


            $finalarraymerge_Time_1200Z [$i]["SupplementaryInformation_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["Supp_Info_Time_1200Z"]; //MMF
            $finalarraymerge_Time_1200Z [$i]["SectionIndicator555_Time_1200Z"]= 555; //HARD CODED
            $finalarraymerge_Time_1200Z [$i]["GroupIndicatorOne_Three_Time_1200Z"]= 1; //HARD CODED

            $finalarraymerge_Time_1200Z [$i]["SignOfDataFourthOccurance_Time_1200Z"]= 0; //HARD CODED

            $finalarraymerge_Time_1200Z [$i]["WetBulbTemperature_Time_1200Z"]= $array_synopticreportdataforADayFromObservationSlip1200Z[$i]["WetBulbTemperature_Time_1200Z"];
            $finalarraymerge_Time_1200Z [$i]["RelativeHumidity_Time_1200Z"]= ''; //still blank
            $finalarraymerge_Time_1200Z [$i]["VapourPressure_Time_1200Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1200Z[$i]["VapourPressure_Time_1200Z"]; //MMF




            ////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_1500Z=array();

            $finalarraymerge_Time_1500Z [$i]["Same_Day6"]=$monthDayAsANumber ;
            $finalarraymerge_Time_1500Z [$i]["Day_Time_1500Z"]= '15'; //Hard Coded
            $finalarraymerge_Time_1500Z[$i]["UnitOfWind_Time_1500Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["UnitOfWindSpeed_Time_1500Z"]; //MFF
            $finalarraymerge_Time_1500Z [$i]["BlockNumber_Time_1500Z"]=63;
            $finalarraymerge_Time_1500Z [$i]["StationNumber_Time_1500Z"]= $stationNumber;
            $finalarraymerge_Time_1500Z [$i]["IndOrOmissionOfPrecipitation_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["IndOrOmissionOfPrecipitation_Time_1500Z"]; //MFF
            $finalarraymerge_Time_1500Z [$i]["TypeOfStation_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["TypeOfStation_Present_Past_Weather_Time_1500Z"];

            $finalarraymerge_Time_1500Z [$i]["HeightOfLowestCloud_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["HeightOfLowestCloud_Time_1500Z"]; //MFF

            $finalarraymerge_Time_1500Z [$i]["HorizontalVisibility_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["HorizontalVisibility_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["TotalCloudCover_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["TotalAmountOfAllClouds_Time_1500Z"];;  //OS
            $finalarraymerge_Time_1500Z [$i]["WindDirection_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["WindDirection_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["WindSpeed_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["WindSpeed_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorOne_One_Time_1500Z"]= 1; //Hard Coded

            $finalarraymerge_Time_1500Z [$i]["SignOfDataFirstOccurance_Time_1500Z"]= 0; //Hard Coded

            $finalarraymerge_Time_1500Z [$i]["AirTemperature_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AirTemperature_Time_1500Z"]; //OS


            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorTwo_One_Time_1500Z"]= 2; //hard coded

            $finalarraymerge_Time_1500Z [$i]["SignOfDataSecondOccurance_Time_1500Z"]= 0;  //hard coded

            $finalarraymerge_Time_1500Z [$i]["DewPointTemperature_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["DewPointTemperature_Time_1500Z"]; //Calucation

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorThree_One_Time_1500Z"]= 3;  //hard coded


            $finalarraymerge_Time_1500Z [$i]["PressureAtStationLevel_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["PressureAtStationLevel_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorFour_One_Time_1500Z"]= 4;    //hard coded


            $finalarraymerge_Time_1500Z [$i]["StandardIsobaricSurface_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["StandardIsobaricSurface_Time_1500Z"]; //MFF //MMF

            $finalarraymerge_Time_1500Z [$i]["GPM_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["GPM_Time_1500Z"]; //MFF //MMF



            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorSix_One_Time_1500Z"]= 6; //Hard code
            $finalarraymerge_Time_1500Z [$i]["AmountOfPrecipitation_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfPrecipitation_Time_1500Z"]; //OS RAINFALL

            $finalarraymerge_Time_1500Z [$i]["DurationOfPeriodOfPrecipitation_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["DurationOfPeriodOfPrecipitation_Time_1500Z"]; //MFF //MMF


            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorSeven_One_Time_1500Z"]= 7; //Hard Coded
            $finalarraymerge_Time_1500Z [$i]["PresentWeatherCode_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["PresentWeatherCode_Time_1500Z"];
            $finalarraymerge_Time_1500Z [$i]["PastWeather_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["PastWeather_Time_1500Z"]; //MFF //MMF

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_One_Time_1500Z"]= 8; //Hard Coded
            $finalarraymerge_Time_1500Z [$i]["AmountOfLowClouds_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfLowClouds_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["LowCloudsOftheGenera_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["LowCloudsOftheGenera_Time_1500Z"];  //OS
            $finalarraymerge_Time_1500Z [$i]["MediumCloudsOftheGenera_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["MediumCloudsOftheGenera_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["HighCloudsOftheGenera_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["HighCloudsOftheGenera_Time_1500Z"];  //OS

            $finalarraymerge_Time_1500Z [$i]["SectionIndicator333_Time_1500Z"]=333; //hard coded
            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorZero_Time_1500Z"]= 0;  //hard coded
            $finalarraymerge_Time_1500Z [$i]["GrassMinimumTemperature_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["GrassMinTemp_Time_1500Z"]; //MFF

            $finalarraymerge_Time_1500Z [$i]["CI_OfPrecipitation_Time_1500Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["CI_OfPrecipitation_Time_1500Z"];//MMF
            $finalarraymerge_Time_1500Z [$i]["BOrEOfPrecipitation_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["BE_OfPrecipitation_Time_1500Z"]; //MMF


            //next page
            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorOne_Two_Time_1500Z"]=1;//hard coded
            $finalarraymerge_Time_1500Z [$i]["SignOfDataThirdOccurance_Time_1500Z"]= 0; //hard coded
            $finalarraymerge_Time_1500Z [$i]["MaximumTemperature_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["MaximumTemperature_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorTwo_Two_Time_1500Z"]= 2; //hard coded

            $finalarraymerge_Time_1500Z [$i]["SignOfDataFourthOccurance_Time_1500Z"]= 0;//hard coded
            $finalarraymerge_Time_1500Z [$i]["MinimumTemperature_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["MinimumTemperature_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorFive_One_Time_1500Z"]= 5; //hard coded
            $finalarraymerge_Time_1500Z [$i]["AmountOfEvaporation_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfEvaporation_Time_1500Z"];

            $finalarraymerge_Time_1500Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["IndicatorOfTypeOfIntrumentation_Time_1500Z"]; //MMF


            $finalarraymerge_Time_1500Z [$i]["GroupIndicator55_Time_1500Z"]= 55; //hard coded

            $finalarraymerge_Time_1500Z [$i]["DurationOfSunshine_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["DurationOfSunshine_Time_1500Z"]; //OS


            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorFive_Two_Time_1500Z"]= 5; //hard coded

            $finalarraymerge_Time_1500Z [$i]["SignOfPressureChange_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["SignOfPressureChange_Time_1500Z"]; //MMF

            $finalarraymerge_Time_1500Z [$i]["PressureChgIn24Hrs_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["PressureChgIn24Hrs_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorSix_Two_Time_1500Z"]= 6; //hard coded

            $finalarraymerge_Time_1500Z [$i]["AmountOfPrecipitation_Two_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfPrecipitation_Time_1500Z"];
            $finalarraymerge_Time_1500Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["DurationOfPeriodOfPrecipitation_Time_1500Z"]; //MMF
            //MMF


            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Two_Time_1500Z"]= 8; //hard coded

            $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualLowCloudLayer_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfIndividualLowCloudLayer_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["GenusOfLowCloud_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["GenusOfLowCloud_Time_1500Z"];  //OS
            $finalarraymerge_Time_1500Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Three_Time_1500Z"]= 8; //hard coded

            $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfIndividualMediumCloudLayer_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["GenusOfMediumCloud_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["GenusOfMediumCloud_Time_1500Z"]; //OS
            $finalarraymerge_Time_1500Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1500Z"]; //OS

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Four_Time_1500Z"]= 8; //hard coded

            $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualHighCloudLayer_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["AmountOfIndividualHighCloudLayer_Time_1500Z"];
            $finalarraymerge_Time_1500Z [$i]["GenusOfHighCloud_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["GenusOfHighCloud_Time_1500Z"];
            $finalarraymerge_Time_1500Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_1500Z"];

            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Five_Time_1500Z"]= 8;  //hard coded




            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorNine_One_Time_1500Z"]= 9; //hard coded


            $finalarraymerge_Time_1500Z [$i]["SupplementaryInformation_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["Supp_Info_Time_1500Z"]; //MMF
            $finalarraymerge_Time_1500Z [$i]["SectionIndicator555_Time_1500Z"]= 555; //HARD CODED
            $finalarraymerge_Time_1500Z [$i]["GroupIndicatorOne_Three_Time_1500Z"]= 1; //HARD CODED

            $finalarraymerge_Time_1500Z [$i]["SignOfDataFourthOccurance_Time_1500Z"]= 0; //HARD CODED

            $finalarraymerge_Time_1500Z [$i]["WetBulbTemperature_Time_1500Z"]= $array_synopticreportdataforADayFromObservationSlip1500Z[$i]["WetBulbTemperature_Time_1500Z"];
            $finalarraymerge_Time_1500Z [$i]["RelativeHumidity_Time_1500Z"]= ''; //still blank
            $finalarraymerge_Time_1500Z [$i]["VapourPressure_Time_1500Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1500Z[$i]["VapourPressure_Time_1500Z"]; //MMF




            ////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_1800Z=array();

            $finalarraymerge_Time_1800Z [$i]["Same_Day7"]=$monthDayAsANumber ;
            $finalarraymerge_Time_1800Z [$i]["Day_Time_1800Z"]= '18'; //Hard Coded
            $finalarraymerge_Time_1800Z[$i]["UnitOfWind_Time_1800Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["UnitOfWindSpeed_Time_1800Z"]; //MFF
            $finalarraymerge_Time_1800Z [$i]["BlockNumber_Time_1800Z"]=63;
            $finalarraymerge_Time_1800Z [$i]["StationNumber_Time_1800Z"]= $stationNumber;
            $finalarraymerge_Time_1800Z [$i]["IndOrOmissionOfPrecipitation_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["IndOrOmissionOfPrecipitation_Time_1800Z"]; //MFF
            $finalarraymerge_Time_1800Z [$i]["TypeOfStation_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["TypeOfStation_Present_Past_Weather_Time_1800Z"];

            $finalarraymerge_Time_1800Z [$i]["HeightOfLowestCloud_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["HeightOfLowestCloud_Time_1800Z"]; //MFF

            $finalarraymerge_Time_1800Z [$i]["HorizontalVisibility_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["HorizontalVisibility_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["TotalCloudCover_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["TotalAmountOfAllClouds_Time_1800Z"];;  //OS
            $finalarraymerge_Time_1800Z [$i]["WindDirection_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["WindDirection_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["WindSpeed_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["WindSpeed_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorOne_One_Time_1800Z"]= 1; //Hard Coded

            $finalarraymerge_Time_1800Z [$i]["SignOfDataFirstOccurance_Time_1800Z"]= 0; //Hard Coded

            $finalarraymerge_Time_1800Z [$i]["AirTemperature_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AirTemperature_Time_1800Z"]; //OS


            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorTwo_One_Time_1800Z"]= 2; //hard coded

            $finalarraymerge_Time_1800Z [$i]["SignOfDataSecondOccurance_Time_1800Z"]= 0;  //hard coded

            $finalarraymerge_Time_1800Z [$i]["DewPointTemperature_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["DewPointTemperature_Time_1800Z"]; //Calucation

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorThree_One_Time_1800Z"]= 3;  //hard coded


            $finalarraymerge_Time_1800Z [$i]["PressureAtStationLevel_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["PressureAtStationLevel_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorFour_One_Time_1800Z"]= 4;    //hard coded


            $finalarraymerge_Time_1800Z [$i]["StandardIsobaricSurface_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["StandardIsobaricSurface_Time_1800Z"]; //MFF //MMF

            $finalarraymerge_Time_1800Z [$i]["GPM_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["GPM_Time_1800Z"]; //MFF //MMF



            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorSix_One_Time_1800Z"]= 6; //Hard code
            $finalarraymerge_Time_1800Z [$i]["AmountOfPrecipitation_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfPrecipitation_Time_1800Z"]; //OS RAINFALL

            $finalarraymerge_Time_1800Z [$i]["DurationOfPeriodOfPrecipitation_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["DurationOfPeriodOfPrecipitation_Time_1800Z"]; //MFF //MMF


            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorSeven_One_Time_1800Z"]= 7; //Hard Coded
            $finalarraymerge_Time_1800Z [$i]["PresentWeatherCode_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["PresentWeatherCode_Time_1800Z"];
            $finalarraymerge_Time_1800Z [$i]["PastWeather_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["PastWeather_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_One_Time_1800Z"]= 8; //Hard Coded
            $finalarraymerge_Time_1800Z [$i]["AmountOfLowClouds_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfLowClouds_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["LowCloudsOftheGenera_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["LowCloudsOftheGenera_Time_1800Z"];  //OS
            $finalarraymerge_Time_1800Z [$i]["MediumCloudsOftheGenera_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["MediumCloudsOftheGenera_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["HighCloudsOftheGenera_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["HighCloudsOftheGenera_Time_1800Z"];  //OS

            $finalarraymerge_Time_1800Z [$i]["SectionIndicator333_Time_1800Z"]=333; //hard coded
            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorZero_Time_1800Z"]= 0;  //hard coded
            $finalarraymerge_Time_1800Z [$i]["GrassMinimumTemperature_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["GrassMinTemp_Time_1800Z"]; //MFF

            $finalarraymerge_Time_1800Z [$i]["CI_OfPrecipitation_Time_1800Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["CI_OfPrecipitation_Time_1800Z"];//MMF
            $finalarraymerge_Time_1800Z [$i]["BOrEOfPrecipitation_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["BE_OfPrecipitation_Time_1800Z"]; //MMF


            //next page
            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorOne_Two_Time_1800Z"]=1;//hard coded
            $finalarraymerge_Time_1800Z [$i]["SignOfDataThirdOccurance_Time_1800Z"]= 0; //hard coded
            $finalarraymerge_Time_1800Z [$i]["MaximumTemperature_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["MaximumTemperature_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorTwo_Two_Time_1800Z"]= 2; //hard coded

            $finalarraymerge_Time_1800Z [$i]["SignOfDataFourthOccurance_Time_1800Z"]= 0;//hard coded
            $finalarraymerge_Time_1800Z [$i]["MinimumTemperature_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["MinimumTemperature_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorFive_One_Time_1800Z"]= 5; //hard coded
            $finalarraymerge_Time_1800Z [$i]["AmountOfEvaporation_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfEvaporation_Time_1800Z"];

            $finalarraymerge_Time_1800Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["IndicatorOfTypeOfIntrumentation_Time_1800Z"]; //MMF


            $finalarraymerge_Time_1800Z [$i]["GroupIndicator55_Time_1800Z"]= 55; //hard coded

            $finalarraymerge_Time_1800Z [$i]["DurationOfSunshine_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["DurationOfSunshine_Time_1800Z"]; //OS


            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorFive_Two_Time_1800Z"]= 5; //hard coded

            $finalarraymerge_Time_1800Z [$i]["SignOfPressureChange_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["SignOfPressureChange_Time_1800Z"]; //MMF

            $finalarraymerge_Time_1800Z [$i]["PressureChgIn24Hrs_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["PressureChgIn24Hrs_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorSix_Two_Time_1800Z"]= 6; //hard coded

            $finalarraymerge_Time_1800Z [$i]["AmountOfPrecipitation_Two_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfPrecipitation_Time_1800Z"];
            $finalarraymerge_Time_1800Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["DurationOfPeriodOfPrecipitation_Time_1800Z"]; //MMF
            //MMF


            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Two_Time_1800Z"]= 8; //hard coded

            $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualLowCloudLayer_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfIndividualLowCloudLayer_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["GenusOfLowCloud_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["GenusOfLowCloud_Time_1800Z"];  //OS
            $finalarraymerge_Time_1800Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Three_Time_1800Z"]= 8; //hard coded

            $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfIndividualMediumCloudLayer_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["GenusOfMediumCloud_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["GenusOfMediumCloud_Time_1800Z"]; //OS
            $finalarraymerge_Time_1800Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1800Z"]; //OS

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Four_Time_1800Z"]= 8; //hard coded

            $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualHighCloudLayer_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["AmountOfIndividualHighCloudLayer_Time_1800Z"];
            $finalarraymerge_Time_1800Z [$i]["GenusOfHighCloud_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["GenusOfHighCloud_Time_1800Z"];
            $finalarraymerge_Time_1800Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_1800Z"];

            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Five_Time_1800Z"]= 8;  //hard coded




            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorNine_One_Time_1800Z"]= 9; //hard coded


            $finalarraymerge_Time_1800Z [$i]["SupplementaryInformation_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["Supp_Info_Time_1800Z"]; //MMF
            $finalarraymerge_Time_1800Z [$i]["SectionIndicator555_Time_1800Z"]= 555; //HARD CODED
            $finalarraymerge_Time_1800Z [$i]["GroupIndicatorOne_Three_Time_1800Z"]= 1; //HARD CODED

            $finalarraymerge_Time_1800Z [$i]["SignOfDataFourthOccurance_Time_1800Z"]= 0; //HARD CODED

            $finalarraymerge_Time_1800Z [$i]["WetBulbTemperature_Time_1800Z"]= $array_synopticreportdataforADayFromObservationSlip1800Z[$i]["WetBulbTemperature_Time_1800Z"];
            $finalarraymerge_Time_1800Z [$i]["RelativeHumidity_Time_1800Z"]= ''; //still blank
            $finalarraymerge_Time_1800Z [$i]["VapourPressure_Time_1800Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable1800Z[$i]["VapourPressure_Time_1800Z"]; //MMF


            ////////////////////////////////////////////////////////////////////////////////////
            $finalarraymerge_Time_2100Z=array();

            $finalarraymerge_Time_2100Z [$i]["Same_Day8"]=$monthDayAsANumber ;
            $finalarraymerge_Time_2100Z [$i]["Day_Time_2100Z"]= '21'; //Hard Coded
            $finalarraymerge_Time_2100Z[$i]["UnitOfWind_Time_2100Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["UnitOfWindSpeed_Time_2100Z"]; //MFF
            $finalarraymerge_Time_2100Z [$i]["BlockNumber_Time_2100Z"]=63;
            $finalarraymerge_Time_2100Z [$i]["StationNumber_Time_2100Z"]= $stationNumber;
            $finalarraymerge_Time_2100Z [$i]["IndOrOmissionOfPrecipitation_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["IndOrOmissionOfPrecipitation_Time_2100Z"]; //MFF
            $finalarraymerge_Time_2100Z [$i]["TypeOfStation_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["TypeOfStation_Present_Past_Weather_Time_2100Z"];

            $finalarraymerge_Time_2100Z [$i]["HeightOfLowestCloud_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["HeightOfLowestCloud_Time_2100Z"]; //MFF

            $finalarraymerge_Time_2100Z [$i]["HorizontalVisibility_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["HorizontalVisibility_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["TotalCloudCover_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["TotalAmountOfAllClouds_Time_2100Z"];;  //OS
            $finalarraymerge_Time_2100Z [$i]["WindDirection_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["WindDirection_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["WindSpeed_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["WindSpeed_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorOne_One_Time_2100Z"]= 1; //Hard Coded

            $finalarraymerge_Time_2100Z [$i]["SignOfDataFirstOccurance_Time_2100Z"]= 0; //Hard Coded

            $finalarraymerge_Time_2100Z [$i]["AirTemperature_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AirTemperature_Time_2100Z"]; //OS


            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorTwo_One_Time_2100Z"]= 2; //hard coded

            $finalarraymerge_Time_2100Z [$i]["SignOfDataSecondOccurance_Time_2100Z"]= 0;  //hard coded

            $finalarraymerge_Time_2100Z [$i]["DewPointTemperature_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["DewPointTemperature_Time_2100Z"]; //Calucation

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorThree_One_Time_2100Z"]= 3;  //hard coded


            $finalarraymerge_Time_2100Z [$i]["PressureAtStationLevel_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["PressureAtStationLevel_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorFour_One_Time_2100Z"]= 4;    //hard coded


            $finalarraymerge_Time_2100Z [$i]["StandardIsobaricSurface_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["StandardIsobaricSurface_Time_2100Z"]; //MFF //MMF

            $finalarraymerge_Time_2100Z [$i]["GPM_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["GPM_Time_2100Z"]; //MFF //MMF



            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorSix_One_Time_2100Z"]= 6; //Hard code
            $finalarraymerge_Time_2100Z [$i]["AmountOfPrecipitation__Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfPrecipitation_Time_2100Z"]; //OS RAINFALL

            $finalarraymerge_Time_2100Z [$i]["DurationOfPeriodOfPrecipitation_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["DurationOfPeriodOfPrecipitation_Time_2100Z"]; //MFF //MMF


            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorSeven_One_Time_2100Z"]= 7; //Hard Coded
            $finalarraymerge_Time_2100Z [$i]["PresentWeatherCode_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["PresentWeatherCode_Time_2100Z"];
            $finalarraymerge_Time_2100Z [$i]["PastWeather_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["PastWeather_Time_2100Z"]; //MFF //MMF

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_One_Time_2100Z"]= 8; //Hard Coded
            $finalarraymerge_Time_2100Z [$i]["AmountOfLowClouds_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfLowClouds_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["LowCloudsOftheGenera_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["LowCloudsOftheGenera_Time_2100Z"];  //OS
            $finalarraymerge_Time_2100Z [$i]["MediumCloudsOftheGenera_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["MediumCloudsOftheGenera_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["HighCloudsOftheGenera_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["HighCloudsOftheGenera_Time_2100Z"];  //OS

            $finalarraymerge_Time_2100Z [$i]["SectionIndicator333_Time_2100Z"]=333; //hard coded
            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorZero_Time_2100Z"]= 0;  //hard coded
            $finalarraymerge_Time_2100Z [$i]["GrassMinimumTemperature_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["GrassMinTemp_Time_2100Z"]; //MFF

            $finalarraymerge_Time_2100Z [$i]["CI_OfPrecipitation_Time_2100Z"]=$array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["CI_OfPrecipitation_Time_2100Z"];//MMF
            $finalarraymerge_Time_2100Z [$i]["BOrEOfPrecipitation_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["BE_OfPrecipitation_Time_2100Z"]; //MMF


            //next page
            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorOne_Two_Time_2100Z"]=1;//hard coded
            $finalarraymerge_Time_2100Z [$i]["SignOfDataThirdOccurance_Time_2100Z"]= 0; //hard coded
            $finalarraymerge_Time_2100Z [$i]["MaximumTemperature_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["MaximumTemperature_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorTwo_Two_Time_2100Z"]= 2; //hard coded

            $finalarraymerge_Time_2100Z [$i]["SignOfDataFourthOccurance_Time_2100Z"]= 0;//hard coded
            $finalarraymerge_Time_2100Z [$i]["MinimumTemperature_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["MinimumTemperature_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorFive_One_Time_2100Z"]= 5; //hard coded
            $finalarraymerge_Time_2100Z [$i]["AmountOfEvaporation_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfEvaporation_Time_2100Z"];

            $finalarraymerge_Time_2100Z [$i]["IndicatorOfTypeOfIntrumentation_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["IndicatorOfTypeOfIntrumentation_Time_2100Z"]; //MMF


            $finalarraymerge_Time_2100Z [$i]["GroupIndicator55_Time_2100Z"]= 55; //hard coded

            $finalarraymerge_Time_2100Z [$i]["DurationOfSunshine_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["DurationOfSunshine_Time_2100Z"]; //OS


            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorFive_Two_Time_2100Z"]= 5; //hard coded

            $finalarraymerge_Time_2100Z [$i]["SignOfPressureChange_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["SignOfPressureChange_Time_2100Z"]; //MMF

            $finalarraymerge_Time_2100Z [$i]["PressureChgIn24Hrs_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["PressureChgIn24Hrs_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorSix_Two_Time_2100Z"]= 6; //hard coded

            $finalarraymerge_Time_2100Z [$i]["AmountOfPrecipitation_Two_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfPrecipitation_Time_2100Z"];
            $finalarraymerge_Time_2100Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["DurationOfPeriodOfPrecipitation_Time_2100Z"]; //MMF
            //MMF


            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Two_Time_2100Z"]= 8; //hard coded

            $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualLowCloudLayer_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfIndividualLowCloudLayer_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["GenusOfLowCloud_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["GenusOfLowCloud_Time_2100Z"];  //OS
            $finalarraymerge_Time_2100Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["HeightBaseOfLowCloudLayerOfMass_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Three_Time_2100Z"]= 8; //hard coded

            $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualMediumCloudLayer_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfIndividualMediumCloudLayer_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["GenusOfMediumCloud_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["GenusOfMediumCloud_Time_2100Z"]; //OS
            $finalarraymerge_Time_2100Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["HeightOfBaseMediumCloudLayerOfMass_Time_2100Z"]; //OS

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Four_Time_2100Z"]= 8; //hard coded

            $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualHighCloudLayer_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["AmountOfIndividualHighCloudLayer_Time_2100Z"];
            $finalarraymerge_Time_2100Z [$i]["GenusOfHighCloud_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["GenusOfHighCloud_Time_2100Z"];
            $finalarraymerge_Time_2100Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["HeightBaseOfHighCloudLayerOfMass_Time_2100Z"];

            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Five_Time_2100Z"]= 8;  //hard coded




            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorNine_One_Time_2100Z"]= 9; //hard coded


            $finalarraymerge_Time_2100Z [$i]["SupplementaryInformation_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["Supp_Info_Time_2100Z"]; //MMF
            $finalarraymerge_Time_2100Z [$i]["SectionIndicator555_Time_2100Z"]= 555; //HARD CODED
            $finalarraymerge_Time_2100Z [$i]["GroupIndicatorOne_Three_Time_2100Z"]= 1; //HARD CODED

            $finalarraymerge_Time_2100Z [$i]["SignOfDataFourthOccurance_Time_2100Z"]= 0; //HARD CODED

            $finalarraymerge_Time_2100Z [$i]["WetBulbTemperature_Time_2100Z"]= $array_synopticreportdataforADayFromObservationSlip2100Z[$i]["WetBulbTemperature_Time_2100Z"];
            $finalarraymerge_Time_2100Z [$i]["RelativeHumidity_Time_2100Z"]= ''; //still blank
            $finalarraymerge_Time_2100Z [$i]["VapourPressure_Time_2100Z"]= $array_synopticreportdataforADayFrom_MoreFormFieldsTable2100Z[$i]["VapourPressure_Time_2100Z"]; //MMF



            ?>

             <tr>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["Same_Day1"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["Day_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["UnitOfWind_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["BlockNumber_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["StationNumber_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["IndOrOmissionOfPrecipitation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["TypeOfStation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["HeightOfLowestCloud_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["HorizontalVisibility_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["TotalCloudCover_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["WindDirection_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["WindSpeed_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorOne_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SignOfDataFirstOccurance_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AirTemperature_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorTwo_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SignOfDataSecondOccurance_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["DewPointTemperature_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorThree_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["PressureAtStationLevel_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorFour_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["StandardIsobaricSurface_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GPM_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorSix_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfPrecipitation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["DurationOfPeriodOfPrecipitation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorSeven_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["PresentWeather_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["PastWeather_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfLowClouds_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["LowCloudsOftheGenera_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["MediumCloudsOftheGenera_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["HighCloudsOftheGenera_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SectionIndicator333_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorZero_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GrassMinimumTemperature_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["CI_OfPrecipitation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["BOrEOfPrecipitation_Time_0000Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorOne_Two_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SignOfDataThirdOccurance_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["MaximumTemperature_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorTwo_Two_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SignOfDataFourthOccurance_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["MinimumTemperature_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorFive_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfEvaporation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicator55_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["DurationOfSunshine_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorFive_Two_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SignOfPressureChange_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["PressureChgIn24Hrs_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorSix_Two_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfPrecipitation_Two_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0000Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Two_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualLowCloudLayer_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GenusOfLowCloud_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0000Z"];?></td>


                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Three_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GenusOfMediumCloud_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0000Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Four_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualHighCloudLayer_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GenusOfHighCloud_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0000Z"];?></td>

                 <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorEight_Five_Time_0000Z"];?></td>

                 <td><?php echo $finalarraymerge_Time_0000Z [$i]["AmountOfIndividualHighCloudLayer_Time_0000Z"];?></td>
                 <td><?php echo $finalarraymerge_Time_0000Z [$i]["GenusOfHighCloud_Time_0000Z"];?></td>
                 <td><?php echo $finalarraymerge_Time_0000Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0000Z"];?></td>

                 <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorNine_One_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SupplementaryInformation_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SectionIndicator555_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["GroupIndicatorOne_Three_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["SignOfDataFourthOccurance_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["WetBulbTemperature_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["RelativeHumidity_Time_0000Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0000Z [$i]["VapourPressure_Time_0000Z"];?></td>
            </tr>


            <tr>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["Same_Day2"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["Day_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["UnitOfWind_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["BlockNumber_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["StationNumber_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["IndOrOmissionOfPrecipitation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["TypeOfStation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HeightOfLowestCloud_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HorizontalVisibility_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["TotalCloudCover_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["WindDirection_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["WindSpeed_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorOne_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SignOfDataFirstOccurance_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AirTemperature_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorTwo_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SignOfDataSecondOccurance_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["DewPointTemperature_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorThree_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["PressureAtStationLevel_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorFour_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["StandardIsobaricSurface_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GPM_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorSix_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfPrecipitation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["DurationOfPeriodOfPrecipitation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorSeven_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["PresentWeather_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["PastWeather_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfLowClouds_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["LowCloudsOftheGenera_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["MediumCloudsOftheGenera_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HighCloudsOftheGenera_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SectionIndicator333_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorZero_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GrassMinimumTemperature_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["CI_OfPrecipitation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["BOrEOfPrecipitation_Time_0300Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorOne_Two_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SignOfDataThirdOccurance_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["MaximumTemperature_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorTwo_Two_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SignOfDataFourthOccurance_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["MinimumTemperature_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorFive_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfEvaporation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicator55_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["DurationOfSunshine_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorFive_Two_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SignOfPressureChange_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["PressureChgIn24Hrs_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorSix_Two_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfPrecipitation_Two_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0300Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Two_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualLowCloudLayer_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GenusOfLowCloud_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0300Z"];?></td>


                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Three_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GenusOfMediumCloud_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0300Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Four_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualHighCloudLayer_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GenusOfHighCloud_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0300Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorEight_Five_Time_0300Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0300Z [$i]["AmountOfIndividualHighCloudLayer_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GenusOfHighCloud_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0300Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorNine_One_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SupplementaryInformation_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SectionIndicator555_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["GroupIndicatorOne_Three_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["SignOfDataFourthOccurance_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["WetBulbTemperature_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["RelativeHumidity_Time_0300Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0300Z [$i]["VapourPressure_Time_0300Z"];?></td>
            </tr>

            <tr>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["Same_Day3"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["Day_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["UnitOfWind_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["BlockNumber_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["StationNumber_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["IndOrOmissionOfPrecipitation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["TypeOfStation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HeightOfLowestCloud_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HorizontalVisibility_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["TotalCloudCover_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["WindDirection_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["WindSpeed_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorOne_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SignOfDataFirstOccurance_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AirTemperature_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorTwo_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SignOfDataSecondOccurance_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["DewPointTemperature_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorThree_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["PressureAtStationLevel_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorFour_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["StandardIsobaricSurface_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GPM_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorSix_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfPrecipitation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["DurationOfPeriodOfPrecipitation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorSeven_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["PresentWeather_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["PastWeather_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfLowClouds_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["LowCloudsOftheGenera_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["MediumCloudsOftheGenera_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HighCloudsOftheGenera_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SectionIndicator333_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorZero_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GrassMinimumTemperature_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["CI_OfPrecipitation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["BOrEOfPrecipitation_Time_0600Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorOne_Two_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SignOfDataThirdOccurance_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["MaximumTemperature_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorTwo_Two_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SignOfDataFourthOccurance_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["MinimumTemperature_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorFive_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfEvaporation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicator55_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["DurationOfSunshine_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorFive_Two_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SignOfPressureChange_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["PressureChgIn24Hrs_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorSix_Two_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfPrecipitation_Two_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0600Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Two_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualLowCloudLayer_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GenusOfLowCloud_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0600Z"];?></td>


                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Three_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GenusOfMediumCloud_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0600Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Four_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualHighCloudLayer_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GenusOfHighCloud_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0600Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorEight_Five_Time_0600Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0600Z [$i]["AmountOfIndividualHighCloudLayer_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GenusOfHighCloud_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0600Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorNine_One_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SupplementaryInformation_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SectionIndicator555_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["GroupIndicatorOne_Three_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["SignOfDataFourthOccurance_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["WetBulbTemperature_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["RelativeHumidity_Time_0600Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0600Z [$i]["VapourPressure_Time_0600Z"];?></td>
            </tr>

            <tr>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["Same_Day4"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["Day_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["UnitOfWind_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["BlockNumber_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["StationNumber_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["IndOrOmissionOfPrecipitation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["TypeOfStation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HeightOfLowestCloud_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HorizontalVisibility_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["TotalCloudCover_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["WindDirection_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["WindSpeed_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorOne_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SignOfDataFirstOccurance_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AirTemperature_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorTwo_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SignOfDataSecondOccurance_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["DewPointTemperature_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorThree_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["PressureAtStationLevel_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorFour_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["StandardIsobaricSurface_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GPM_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorSix_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfPrecipitation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["DurationOfPeriodOfPrecipitation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorSeven_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["PresentWeather_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["PastWeather_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfLowClouds_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["LowCloudsOftheGenera_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["MediumCloudsOftheGenera_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HighCloudsOftheGenera_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SectionIndicator333_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorZero_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GrassMinimumTemperature_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["CI_OfPrecipitation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["BOrEOfPrecipitation_Time_0900Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorOne_Two_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SignOfDataThirdOccurance_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["MaximumTemperature_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorTwo_Two_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SignOfDataFourthOccurance_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["MinimumTemperature_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorFive_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfEvaporation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["IndicatorOfTypeOfIntrumentation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicator55_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["DurationOfSunshine_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorFive_Two_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SignOfPressureChange_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["PressureChgIn24Hrs_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorSix_Two_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfPrecipitation_Two_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_0900Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Two_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualLowCloudLayer_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GenusOfLowCloud_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_0900Z"];?></td>


                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Three_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualMediumCloudLayer_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GenusOfMediumCloud_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_0900Z"];?></td>




                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Four_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualHighCloudLayer_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GenusOfHighCloud_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0900Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorEight_Five_Time_0900Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0900Z [$i]["AmountOfIndividualHighCloudLayer_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GenusOfHighCloud_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_0900Z"];?></td>

                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorNine_One_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SupplementaryInformation_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SectionIndicator555_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["GroupIndicatorOne_Three_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["SignOfDataFourthOccurance_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["WetBulbTemperature_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["RelativeHumidity_Time_0900Z"];?></td>
                <td><?php echo $finalarraymerge_Time_0900Z [$i]["VapourPressure_Time_0900Z"];?></td>
            </tr>

            <tr>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["Same_Day5"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["Day_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["UnitOfWind_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["BlockNumber_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["StationNumber_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["IndOrOmissionOfPrecipitation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["TypeOfStation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HeightOfLowestCloud_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HorizontalVisibility_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["TotalCloudCover_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["WindDirection_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["WindSpeed_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorOne_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SignOfDataFirstOccurance_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AirTemperature_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorTwo_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SignOfDataSecondOccurance_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["DewPointTemperature_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorThree_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["PressureAtStationLevel_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorFour_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["StandardIsobaricSurface_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GPM_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorSix_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfPrecipitation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["DurationOfPeriodOfPrecipitation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorSeven_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["PresentWeather_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["PastWeather_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfLowClouds_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["LowCloudsOftheGenera_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["MediumCloudsOftheGenera_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HighCloudsOftheGenera_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SectionIndicator333_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorZero_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GrassMinimumTemperature_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["CI_OfPrecipitation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["BOrEOfPrecipitation_Time_1200Z"];?></td>




                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorOne_Two_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SignOfDataThirdOccurance_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["MaximumTemperature_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorTwo_Two_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SignOfDataFourthOccurance_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["MinimumTemperature_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorFive_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfEvaporation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicator55_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["DurationOfSunshine_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorFive_Two_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SignOfPressureChange_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["PressureChgIn24Hrs_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorSix_Two_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfPrecipitation_Two_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_1200Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Two_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualLowCloudLayer_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GenusOfLowCloud_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1200Z"];?></td>


                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Three_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GenusOfMediumCloud_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1200Z"];?></td>




                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Four_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualHighCloudLayer_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GenusOfHighCloud_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1200Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorEight_Five_Time_1200Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1200Z [$i]["AmountOfIndividualHighCloudLayer_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GenusOfHighCloud_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1200Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorNine_One_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SupplementaryInformation_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SectionIndicator555_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["GroupIndicatorOne_Three_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["SignOfDataFourthOccurance_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["WetBulbTemperature_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["RelativeHumidity_Time_1200Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1200Z [$i]["VapourPressure_Time_1200Z"];?></td>
            </tr>

            <tr>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["Same_Day6"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["Day_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["UnitOfWind_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["BlockNumber_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["StationNumber_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["IndOrOmissionOfPrecipitation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["TypeOfStation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HeightOfLowestCloud_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HorizontalVisibility_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["TotalCloudCover_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["WindDirection_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["WindSpeed_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorOne_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SignOfDataFirstOccurance_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AirTemperature_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorTwo_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SignOfDataSecondOccurance_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["DewPointTemperature_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorThree_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["PressureAtStationLevel_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorFour_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["StandardIsobaricSurface_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GPM_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorSix_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfPrecipitation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["DurationOfPeriodOfPrecipitation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorSeven_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["PresentWeather_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["PastWeather_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfLowClouds_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["LowCloudsOftheGenera_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["MediumCloudsOftheGenera_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HighCloudsOftheGenera_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SectionIndicator333_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorZero_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GrassMinimumTemperature_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["CI_OfPrecipitation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["BOrEOfPrecipitation_Time_1500Z"];?></td>




                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorOne_Two_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SignOfDataThirdOccurance_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["MaximumTemperature_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorTwo_Two_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SignOfDataFourthOccurance_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["MinimumTemperature_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorFive_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfEvaporation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicator55_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["DurationOfSunshine_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorFive_Two_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SignOfPressureChange_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["PressureChgIn24Hrs_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorSix_Two_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfPrecipitation_Two_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_1500Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Two_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualLowCloudLayer_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GenusOfLowCloud_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1500Z"];?></td>


                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Three_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GenusOfMediumCloud_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1500Z"];?></td>




                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Four_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualHighCloudLayer_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GenusOfHighCloud_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1500Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorEight_Five_Time_1500Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1500Z [$i]["AmountOfIndividualHighCloudLayer_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GenusOfHighCloud_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1500Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorNine_One_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SupplementaryInformation_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SectionIndicator555_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["GroupIndicatorOne_Three_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["SignOfDataFourthOccurance_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["WetBulbTemperature_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["RelativeHumidity_Time_1500Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1500Z [$i]["VapourPressure_Time_1500Z"];?></td>
            </tr>

            <tr>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["Same_Day7"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["Day_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["UnitOfWind_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["BlockNumber_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["StationNumber_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["IndOrOmissionOfPrecipitation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["TypeOfStation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HeightOfLowestCloud_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HorizontalVisibility_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["TotalCloudCover_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["WindDirection_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["WindSpeed_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorOne_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SignOfDataFirstOccurance_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AirTemperature_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorTwo_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SignOfDataSecondOccurance_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["DewPointTemperature_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorThree_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["PressureAtStationLevel_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorFour_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["StandardIsobaricSurface_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GPM_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorSix_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfPrecipitation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["DurationOfPeriodOfPrecipitation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorSeven_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["PresentWeather_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["PastWeather_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfLowClouds_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["LowCloudsOftheGenera_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["MediumCloudsOftheGenera_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HighCloudsOftheGenera_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SectionIndicator333_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorZero_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GrassMinimumTemperature_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["CI_OfPrecipitation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["BOrEOfPrecipitation_Time_1800Z"];?></td>




                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorOne_Two_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SignOfDataThirdOccurance_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["MaximumTemperature_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorTwo_Two_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SignOfDataFourthOccurance_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["MinimumTemperature_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorFive_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfEvaporation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["IndicatorOfTypeOfIntrumentation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicator55_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["DurationOfSunshine_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorFive_Two_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SignOfPressureChange_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["PressureChgIn24Hrs_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorSix_Two_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfPrecipitation_Two_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_1800Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Two_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualLowCloudLayer_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GenusOfLowCloud_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_1800Z"];?></td>


                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Three_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualMediumCloudLayer_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GenusOfMediumCloud_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_1800Z"];?></td>




                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Four_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualHighCloudLayer_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GenusOfHighCloud_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1800Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorEight_Five_Time_1800Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1800Z [$i]["AmountOfIndividualHighCloudLayer_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GenusOfHighCloud_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_1800Z"];?></td>

                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorNine_One_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SupplementaryInformation_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SectionIndicator555_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["GroupIndicatorOne_Three_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["SignOfDataFourthOccurance_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["WetBulbTemperature_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["RelativeHumidity_Time_1800Z"];?></td>
                <td><?php echo $finalarraymerge_Time_1800Z [$i]["VapourPressure_Time_1800Z"];?></td>
            </tr>

            <tr>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["Same_Day8"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["Day_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["UnitOfWind_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["BlockNumber_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["StationNumber_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["IndOrOmissionOfPrecipitation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["TypeOfStation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HeightOfLowestCloud_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HorizontalVisibility_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["TotalCloudCover_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["WindDirection_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["WindSpeed_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorOne_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SignOfDataFirstOccurance_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AirTemperature_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorTwo_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SignOfDataSecondOccurance_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["DewPointTemperature_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorThree_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["PressureAtStationLevel_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorFour_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["StandardIsobaricSurface_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GPM_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorSix_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfPrecipitation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["DurationOfPeriodOfPrecipitation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorSeven_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["PresentWeather_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["PastWeather_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfLowClouds_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["LowCloudsOftheGenera_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["MediumCloudsOftheGenera_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HighCloudsOftheGenera_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SectionIndicator333_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorZero_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GrassMinimumTemperature_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["CI_OfPrecipitation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["BOrEOfPrecipitation_Time_2100Z"];?></td>




                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorOne_Two_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SignOfDataThirdOccurance_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["MaximumTemperature_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorTwo_Two_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SignOfDataFourthOccurance_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["MinimumTemperature_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorFive_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfEvaporation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["IndicatorOfTypeOfIntrumentation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicator55_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["DurationOfSunshine_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorFive_Two_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SignOfPressureChange_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["PressureChgIn24Hrs_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorSix_Two_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfPrecipitation_Two_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["DurationOfPeriodOfPrecipitation_Two_Time_2100Z"];?></td>

                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Two_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualLowCloudLayer_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GenusOfLowCloud_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HeightBaseOfLowCloudLayerOfMass_Time_2100Z"];?></td>


                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Three_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualMediumCloudLayer_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GenusOfMediumCloud_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HeightOfBaseMediumCloudLayerOfMass_Time_2100Z"];?></td>




                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Four_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualHighCloudLayer_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GenusOfHighCloud_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_2100Z"];?></td>

                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorEight_Five_Time_2100Z"];?></td>

                <td><?php echo $finalarraymerge_Time_2100Z [$i]["AmountOfIndividualHighCloudLayer_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GenusOfHighCloud_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["HeightBaseOfHighCloudLayerOfMass_Time_2100Z"];?></td>

                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorNine_One_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SupplementaryInformation_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SectionIndicator555_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["GroupIndicatorOne_Three_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["SignOfDataFourthOccurance_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["WetBulbTemperature_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["RelativeHumidity_Time_2100Z"];?></td>
                <td><?php echo $finalarraymerge_Time_2100Z [$i]["VapourPressure_Time_2100Z"];?></td>
            </tr>
        <?php
        }
        ?>
        </table>
        <br><br>
        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
        <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>

        <br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export">Export to csv</button>


        <a href="<?php echo base_url()."index.php/SynopticReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
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
            $('#generateSynopticReport_Button').click(function(event) {


                //Check that the a station is selected from the list Managerations(Admin)
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
                //Check that the DATE is selected from the month
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
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