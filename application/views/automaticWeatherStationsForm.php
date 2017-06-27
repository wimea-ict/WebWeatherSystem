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
            Automatic Weather Stations Form
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Automatic Weather Stations</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewautomaticweatherstationsForm) && count($displaynewautomaticweatherstationsForm)) {
        ?>
        <div class="row">
        <form action="<?php echo base_url(); ?>index.php/AutomaticWeatherStations/insertAWSData/" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <div id="output"></div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Select Date</span>
                <input type="text" name="dateaws" class="form-control" placeholder="Enter select date" id="expdate">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Select Time</span>
                <input type="text" name="timeaws" data-format="HH:mm PP" class="form-control" placeholder="Enter select time" id="time">
            </div>
        </div>



        <?php if($userrole=='Manager'){ ?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Station Name</span>
                    <input type="text" name="stationawsManager" id="stationawsManager" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                </div>
            </div>

        <?php } elseif($userrole=='Managerer'){?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Station Name</span>
                    <select name="statioManageragerin" id="stManageranagerdmin"   class="form-control" placeholder="Select Station">
                        <option value="0">Select Stations</option>
                        <?php
                        if (is_array($stationsdata) && count($stationsdata)) {
                            foreach($stationsdata as $station){?>
                                <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                            <?php }
                        } ?>
                    </select>
                </div>
            </div>

        <?php } ?>

        <?php if($userrole=='OC'){ ?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"> Station Number</span>
                    <input type="text" name="stationNoawsManager" required class="form-control" id="stationNoawsManager" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                </div>
            </div>

        <?php }elseif($userrole=='Manager'){?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"> Station Number</span>
                    <input type="text" name="stationNoawsManager" required class="form-control" id="stationNoawsManager" readonly class="form-control" value="" readonly="readonly" >
                </div>
            </div>
        <?php }?>


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Txt</span>
                <input type="text" name="txtaws"  required class="form-control" required placeholder="Name of the transmitting node" id="max">
            </div>
        </div>

        <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">MAC Address of the Transmitting Node</span>
                    <input type="text" name="e64aws"  required class="form-control" required placeholder="Enter MAC Address of the Transmitting Node" id="max">
                </div>
         </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">ID</span>
                <input type="text" name="idaws"  required class="form-control" required placeholder="Enter id of the transmitting node" id="min">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Temperature</span>
                <input type="text" name="tempaws" class="form-control" required placeholder="Enter the Temperature" id="rainfall">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"> Soil Temperature</span>
                <input type="text" name="soiltemperatureaws" class="form-control" required placeholder="Enter the Soil Temperature" id="rainfall">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Temperature of Microprocessor</span>
                <input type="text" name="t_mcuaws" required class="form-control" placeholder=" Enter Temperature of Microprocessor" id="duration">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Voltage of Microprocessor</span>
                <input type="text" name="v_mcuaws" required class="form-control" placeholder="Voltage of Microprocessor" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">P0</span>
                <input type="text" name="p0aws" required class="form-control" placeholder="Enter P0" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">(p0_lst60 *0.2)</span>
                <input type="text" name="p0_lst60_0.2aws" required class="form-control" placeholder="Enter (p0_lst60 *0.2)" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">P1</span>
                <input type="text" name="p1aws" required class="form-control" placeholder="Enter P1" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">P1_t</span>
                <input type="text" name="p1_taws"   required class="form-control" placeholder="Enter P1_t" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">P1_lst</span>
                <input type="text" name="p1_lstaws"   required class="form-control" placeholder="Enter P1_lst " id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Uptime</span>
                <input type="text" name="uptimeaws" required class="form-control" placeholder="Enter Uptime" id="city">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Error</span>
                <input type="text" name="erroraws"  required class="form-control" placeholder="Enter the Error" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Input Voltage </span>
                <input type="text" name="v_inaws"   required class="form-control" placeholder="Enter the Input Voltage" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Analog Voltage One</span>
                <input type="text" name="a1aws" required class="form-control" placeholder="Enter Analog Voltage One" id="wind">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Analog Voltage Two</span>
                <input type="text" name="a2aws"  required class="form-control" placeholder="Enter Analog Voltage Two" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Enter Analog Voltage Three</span>
                <input type="text" name="a3aws" class="form-control" required placeholder="Enter Analog Voltage Three" id="anemometer">
            </div>
        </div>


        </div>
        <div class="col-lg-6">


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Station Longitude</span>
                <input type="text" name="gw_lonaws"  required class="form-control" placeholder="Enter the Station Longitude" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Station Latitude</span>
                <input type="text" name="gw_lataws" required class="form-control" required placeholder="Enter the Station Latitude" id="evap2">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">P_MS5611</span>
                <input type="text" name="p_ms5611aws" class="form-control" required placeholder="Enter P_MS5611" id="grpindiator">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">UT</span>
                <input type="text" name="utaws"  required class="form-control" placeholder="Enter UT" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">RH_SHT2X</span>
                <input type="text" name="rh_sht2xaws" required class="form-control" required placeholder="Enter RH_SHT2X" id="evap2">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">T_SHT2X </span>
                <input type="text" name="t_sht2xaws"  required class="form-control" required placeholder="Enter T_SHT2X" id="grpindiator">
            </div>
        </div>



        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">ADC1</span>
                <input type="text" name="adc1aws"  required class="form-control" required placeholder="Enter ADC1" id="grasstemp">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">ADC2</span>
                <input type="text" name="adc2aws" class="form-control" required placeholder="Enter ADC2" id="charintes">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">DOMAIN</span>
                <input type="text" name="domainaws" class="form-control" required placeholder="Enter Domain" id="begend">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">TZ</span>
                <input type="text" name="tzaws"  required class="form-control" placeholder="Enter TZ" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">UP</span>
                <input type="text" name="upaws" class="form-control" required placeholder="Enter UP" id="evap2">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Temperature of the Box</span>
                <input type="text" name="temperatureoftheboxaws" required class="form-control" required placeholder="Enter the Temperature of the Box" id="grpindiator">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Soil Moisture</span>
                <input type="text" name="v_a1aws"  required class="form-control" required placeholder="Enter the Soil Moisture" id="grasstemp">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Wind Speed</span>
                <input type="text" name="p0_taws"  required class="form-control" required placeholder="Enter the Wind Speed" id="charintes">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">((V_A1)/(V_A2)-0.05)*400</span>
                <input type="text" name="((V_A1)_(V_A2)_0.05)_400aws"  required class="form-control" required placeholder="Enter ((V_A1)/(V_A2)-0.05)*400" id="begend">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">V_AD1*100</span>
                <input type="text" name="V_AD1_100aws" required class="form-control"  required placeholder="Enter V_AD1*100" id="radtype">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">V_AD2*100</span>
                <input type="text" name="V_AD2_100aws" required class="form-control" required placeholder="Enter V_AD2*100" id="evap2">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">V_AD3*100</span>
                <input type="text" name="V_AD3_100aws"   required class="form-control" required placeholder="Enter V_AD3*100" id="grpindiator">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">V_AD1*1000</span>
                <input type="text" name="V_AD1_1000aws"  required class="form-control" required placeholder="Enter V_AD1*1000" id="grasstemp">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">V_AD2*1000</span>
                <input type="text" name="V_AD2_1000aws" required class="form-control" required placeholder="Enter V_AD2*1000" id="charintes">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">V_AD3*1000</span>
                <input type="text" name="V_AD3_1000aws"  required class="form-control" required placeholder="Enter V_AD3*1000" id="begend">
            </div>
        </div>

        </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">

            <a href="<?php echo base_url()."index.php/AutomaticWeatherStations/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

            <button type="submit" id="post_aws" name="post" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add AWS Info</button>
        </div>
        </form>
        <br><br>
        </div>
    <?php
    }elseif((is_array($updateawsformdata) && count($updateawsformdata))) {
        foreach($updateawsformdata as $awsdata){

            $awsid = $awsdata->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/AutomaticWeatherStations/updateAWSFormData" method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <div id="output"></div>
            <div class="col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Select Date</span>
                    <input type="text" name="date" class="form-control" value="<?php echo $awsdata->Date;?>" placeholder="Enter select date" id="date">
                    <input type="hidden" name="id" value="<?php echo $awsdata->id;?>">
                </div>
            </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Select Time</span>
                        <input type="text" name="time" value="<?php echo $awsdata->Time;?>" data-format="HH:mm PP" class="form-control" placeholder="Enter select time" id="time">
                    </div>
                </div>



                <?php if($userrole=='OC'){ ?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Station Name</span>
                            <input type="text" name="stationOC" id="stationOC" required class="form-control" value="<?php echo $awsdata->StationName;?>"  readonly class="form-control" >

                        </div>
                    </div>

                <?php }elseif($userrole=='Manager'){?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Station Name</span>
                         <select name="stationManager" id="stationManager"   class="form-control" placeholder="Select Station">
                                <option value="<?php echo $awsdata->StationName;?>"><?php echo $awsdata->StationName;?></option>
                                <option value="0">Select Stations</option>
                                <?php
                                if (is_array($stationsdata) && count($stationsdata)) {
                                    foreach($stationsdata as $station){?>
                                        <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                    <?php }
                                } ?>
                            </select>
                        </div>
                    </div>

                <?php } ?>

                <?php if($userrole=='OC'){ ?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> Station Number</span>
                            <input type="text" name="stationNoOC" required class="form-control" id="stationNoOC" readonly class="form-control" value="<?php echo $awsdata->StationNumber;?>" readonly="readonly" >
                        </div>
                    </div>

              <?php }elseif($userrole=='Manager'){?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> Station Number</span>
                            <input type="text" name="stationNoManager" required class="form-control" id="stationNoManager" readonly class="form-control" value="" readonly="readonly" >
                        </div>
                    </div>
                <?php }?>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Txt</span>
                        <input type="text" name="txt" value="<?php echo $awsdata->Txt;?>"  required class="form-control" required placeholder="Name of the transmitting node" id="max">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">MAC Address of the Transmitting Node</span>
                        <input type="text" name="e64" value="<?php echo $awsdata->E64;?>"  required class="form-control" required placeholder="Enter MAC Address of the Transmitting Node" id="max">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">ID of the Transmitting Node</span>
                        <input type="text" name="idofthetransmittingnode" value="<?php echo $awsdata->IdOfTransmittingNode;?>"  required class="form-control" required placeholder="Enter id of the transmitting node" id="min">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Temperature</span>
                        <input type="text" name="temp" value="<?php echo $awsdata->Temperature;?>" reqiured class="form-control" required placeholder="Enter the Temperature" id="rainfall">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Soil Temperature</span>
                        <input type="text" name="soiltemperature" value="<?php echo $awsdata->SoilTemperature;?>"  required class="form-control" required placeholder="Enter the Soil Temperature" id="rainfall">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Temperature of Microprocessor</span>
                        <input type="text" name="t_mcu" value="<?php echo $awsdata->T_mcu;?>" required class="form-control" placeholder=" Enter Temperature of Microprocessor" id="duration">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Voltage of Microprocessor</span>
                        <input type="text" name="v_mcu"  value="<?php echo $awsdata->V_mcu;?>"required class="form-control" placeholder="Voltage of Microprocessor" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">P0</span>
                        <input type="text" name="p0" value="<?php echo $awsdata->P0;?>" required class="form-control" placeholder="Enter P0" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">(p0_lst60 *0.2)</span>
                        <input type="text" name="p0_lst60_0.2aws" value="<?php echo $awsdata->P0_lst60_02;?>" required class="form-control" placeholder="Enter (p0_lst60 *0.2)" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">P1</span>
                        <input type="text" name="p1" value="<?php echo $awsdata->P1;?>" required class="form-control" placeholder="Enter P1" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">P1_t</span>
                        <input type="text" name="p1_t"  value="<?php echo $awsdata->P1_t;?>"  required class="form-control" placeholder="Enter P1_t" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">P1_lst</span>
                        <input type="text" name="p1_lst"  value="<?php echo $awsdata->P1_lst;?>" required class="form-control" placeholder="Enter P1_lst " id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Uptime</span>
                        <input type="text" name="uptime" value="<?php echo $awsdata->Uptime;?>" required class="form-control" placeholder="Enter Uptime" id="city">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Error</span>
                        <input type="text" name="error"  value="<?php echo $awsdata->Error;?>" required class="form-control" placeholder="Enter the Error" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Input Voltage </span>
                        <input type="text" name="v_in"  value="<?php echo $awsdata->V_in;?>" required class="form-control" placeholder="Enter the Input Voltage" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Analog Voltage One</span>
                        <input type="text" name="a1"  value="<?php echo $awsdata->A1;?>"required class="form-control" placeholder="Enter Analog Voltage One" id="wind">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Analog Voltage Two</span>
                        <input type="text" name="a2"  value="<?php echo $awsdata->A2;?>" required class="form-control" placeholder="Enter Analog Voltage Two" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Enter Analog Voltage Three</span>
                        <input type="text" name="a3" value="<?php echo $awsdata->A3;?>" required class="form-control" required placeholder="Enter Analog Voltage Three" id="anemometer">
                    </div>
                </div>


            </div>
            <div class="col-lg-6">


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Station Longitude</span>
                        <input type="text" name="gw_lon" value="<?php echo $awsdata->GW_LON;?>"  required class="form-control" placeholder="Enter the Station Longitude" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Station Latitude</span>
                        <input type="text" name="gw_lat"  value="<?php echo $awsdata->GW_LAT;?>" required class="form-control" required placeholder="Enter the Station Latitude" id="evap2">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">P_MS5611</span>
                        <input type="text" name="P_ms5611"  value="<?php echo $awsdata->P_MS5611;?>" required class="form-control" required placeholder="Enter P_MS5611" id="grpindiator">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">UT</span>
                        <input type="text" name="ut"   value="<?php echo $awsdata->UT;?>" required class="form-control" placeholder="Enter UT" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">RH_SHT2X</span>
                        <input type="text" name="rh_sht2x"  value="<?php echo $awsdata->RH_SHT2X;?>" required class="form-control" required placeholder="Enter RH_SHT2X" id="evap2">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">T_SHT2X </span>
                        <input type="text" name="t_sht2x"  value="<?php echo $awsdata->T_SHT2X;?>" required class="form-control" required placeholder="Enter T_SHT2X" id="grpindiator">
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">ADC1</span>
                        <input type="text" name="adc1"  value="<?php echo $awsdata->ADC1;?>" required class="form-control" required placeholder="Enter ADC1" id="grasstemp">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">ADC2</span>
                        <input type="text" name="adc2" value="<?php echo $awsdata->ADC2;?>"  required class="form-control" required placeholder="Enter ADC2" id="charintes">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">DOMAIN</span>
                        <input type="text" name="domain" value="<?php echo $awsdata->DOMAIN;?>" required class="form-control" required placeholder="Enter Domain" id="begend">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TZ</span>
                        <input type="text" name="tz"  value="<?php echo $awsdata->TZ;?>" required class="form-control" placeholder="Enter TZ" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">UP</span>
                        <input type="text" name="up"  value="<?php echo $awsdata->UP;?>" required class="form-control" required placeholder="Enter UP" id="evap2">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Temperature of the Box</span>
                        <input type="text" name="temperatureofthebox" value="<?php echo $awsdata->TemperatureOfBox;?>" required class="form-control" required placeholder="Enter the Temperature of the Box" id="grpindiator">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Soil Moisture</span>
                        <input type="text" name="v_a1"   value="<?php echo $awsdata->V_a1;?>" required class="form-control" required placeholder="Enter the Soil Moisture" id="grasstemp">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Wind Speed</span>
                        <input type="text" name="p0_t"  value="<?php echo $awsdata->P0_T;?>" required class="form-control" required placeholder="Enter the Wind Speed" id="charintes">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">((V_A1)/(V_A2)-0.05)*400</span>
                        <input type="text" name="((V_A1)_(V_A2)_0.05)_400"  value="<?php echo $awsdata->V_A1_V_A2_005_400;?>" required class="form-control" required placeholder="Enter ((V_A1)/(V_A2)-0.05)*400" id="begend">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">V_AD1*100</span>
                        <input type="text" name="V_AD1_100" value="<?php echo $awsdata->V_AD1_100;?>" required class="form-control"  required placeholder="Enter V_AD1*100" id="radtype">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">V_AD2*100</span>
                        <input type="text" name="V_AD2_100" value="<?php echo $awsdata->V_AD2_100;?>" required class="form-control" required placeholder="Enter V_AD2*100" id="evap2">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">V_AD3*100</span>
                        <input type="text" name="V_AD3_100"  value="<?php echo $awsdata->V_AD3_100;?>"  required class="form-control" required placeholder="Enter V_AD3*100" id="grpindiator">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">V_AD1*1000</span>
                        <input type="text" name="V_AD1_1000" value="<?php echo $awsdata->V_AD1_1000;?>" required class="form-control" required placeholder="Enter V_AD1*1000" id="grasstemp">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">V_AD2*1000</span>
                        <input type="text" name="V_AD2*1000" value="<?php echo $awsdata->V_AD2_1000;?>" required class="form-control" required placeholder="Enter V_AD2*1000" id="charintes">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">V_AD3*1000</span>
                        <input type="text" name="V_AD3*1000" value="<?php echo $awsdata->V_AD3_1000;?>"  required class="form-control" required placeholder="Enter V_AD3*1000" id="begend">
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a href="<?php echo base_url()."index.php/AutomaticWeatherStations/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="update" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update AWS</button>
            </div>
            </form>
            <br><br>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/AutomaticWeatherStations/DisplayAutomaticWeatherStationsForm/"><i class="fa fa-plus"></i> Add AWS info</a>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">AWS Form</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Day </th>
                                <th>Time</th>

                                <th>Station Name</th>
                                <th>Station No </th>

                                <th>Name</th>
                                <th>MAC</th>


                                <th>ID</th>
                                <!--<th>Maxi</th>-->
                                <th>Temperature</th>
                                <th>Soil Temperature</th>
                                <th>Temperature of Micr</th>
                                <th>Voltage of Micr</th>
                                <th>Uptime</th>
                                <th>Input Voltage</th>
                                <th>Analog Input Voltage</th>

                                <?php if( $userrole=='OC'){ ?><th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            foreach($formdataforaws as $data){
                                $count++;
                                $id = $data->id;


                                ?>
                                <tr>
                                    <td ><?php echo $count;?></td>
                                    <td ><?php echo $data->Date;?></td>
                                    <td ><?php echo $data->Time;?></td>

                                    <td ><?php echo $data->StationName;?></td>
                                    <td ><?php echo $data->StationNumber;?></td>

                                    <td ><?php echo $data->Txt;?></td>
                                    <td ><?php echo $data->E64;?></td>
                                    <td ><?php echo $data->IdOfTransmittingNode;?></td>

                                    <td ><?php echo $data->Temperature;?></td>
                                    <td ><?php echo $data->SoilTemperature;?></td>
                                    <td><?php echo $data->T_mcu;?></td>
                                    <td ><?php echo $data->V_mcu;?></td>
                                    <td ><?php echo $data->Uptime;?></td>
                                    <td ><?php echo $data->V_in;?></td>
                                    <td ><?php echo $data->A1;?></td>



                                    <?php if( $userrole=='OC'){ ?>
                                        <td class="no-print">
                                        <a href="<?php echo base_url()."index.php/AutomaticWeatherStations/DisplayAutomaticWeatherStationsFormForUpdate/" .$data->id ;?>"
                                           style="cursor:pointer;">Edit</a>
                                    <!--    or
                                        <a href="<?php echo base_url()."index.php/AutomaticWeatherStations/deleteAWSFormData/" .$data->id ;?>"
                                           onClick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                        </td><?php }?> -->
                                </tr>

                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    <?php
    }
    ?>
    </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.0.2
<script src="js/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>





<?php require_once(APPPATH . 'views/footer.php'); ?>