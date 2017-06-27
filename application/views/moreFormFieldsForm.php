<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//'StationNumber' => $row->StationNumber,
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            More Form Fields
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">More Form Fields</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewmoreformfieldsform) && count($displaynewmoreformfieldsform)) {
        ?>
        <div class="row">
        <form action='<?= base_url(); ?>index.php/MoreFormFieldsForm/insertMoreFormFieldsFormData/' method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <div id="output"></div>
            <script language="javascript">
                function allowIntegerInputOnly(inputvalue) {
                    //var invalidChars = /[^0-9]/gi
                    var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                    if(integerOnly.test(inputvalue.value)) {
                        inputvalue.value = inputvalue.value.replace(integerOnly,"");
                    }
                }

                function allowCharactersInputOnly(inputvalue) {
                    //var invalidChars = /[^0-9]/gi
                    var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                    if(charsOnly.test(inputvalue.value)) {
                        inputvalue.value = inputvalue.value.replace(charsOnly,"");
                    }
                }
            </script>
        <div class="col-lg-6">

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Select Date</span>
                    <input type="text" name="date_mff" required class="form-control" placeholder="Enter select date" id="date">
                    <input type="hidden" name="checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield" id="checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield">

                </div>
            </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Station Name</span>
                        <input type="text" name="station_mff" id="station_mff" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Station Number</span>
                        <input type="text" name="stationNo_mff" required class="form-control" id="stationNo_mff" readonly  value="<?php echo $userstationNo;?>" readonly="readonly" >
                    </div>
                </div>






            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME</span>
                    <select name="time_mff" id="time_mff" required class="form-control">
                        <option value="">--Select TIME Options--</option>
                        <option value="0000Z">0000Z</option>
                        <option value="0100Z">0100Z</option>
                        <option value="0200Z">0200Z</option>
                        <option value="0300Z">0300Z</option>
                        <option value="0400Z">0400Z</option>
                        <option value="0500Z">0500Z</option>
                        <option value="0600Z">0600Z</option>
                        <option value="0700Z">0700Z</option>
                        <option value="0800Z">0800Z</option>
                        <option value="0900Z">0900Z</option>
                        <option value="1000Z">1000Z</option>
                        <option value="1100Z">1100Z</option>
                        <option value="1200Z">1200Z</option>
                        <option value="1300Z">1300Z</option>
                        <option value="1400Z">1400Z</option>
                        <option value="1500Z">1500Z</option>
                        <option value="1600Z">1600Z</option>
                        <option value="1700Z">1700Z</option>
                        <option value="1800Z">1800Z</option>
                        <option value="1900Z">1900Z</option>
                        <option value="2000Z">2000Z</option>
                        <option value="2100Z">2100Z</option>
                        <option value="2200Z">2200Z</option>
                        <option value="2300Z">2300Z</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Unit of Wind Speed</span>
                    <input type="text" name="UnitOfWindSpeed_mff" id="UnitOfWindSpeed_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Unit of Wind Speed" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Ind. or omission of precipitation</span>
                    <input type="text" name="IndOrOmissionOfPrecipitation_mff" id="IndOrOmissionOfPrecipitation_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Ind. or omission of precipitation " >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Type of station/present & past weather</span>
                    <input type="text" name="TypeOfStation_Present_Past_Weather_mff" id="TypeOfStation_Present_Past_Weather_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Type of station/present & past weather" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Height Of Lowest Cloud</span>
                    <input type="text" name="heightOfLowestCloud_mff" id="heightOfLowestCloud_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Height Of The Lowest Cloud" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Standard isobaric surface</span>
                    <input type="text" name="StandardIsobaricSurface_mff"id="StandardIsobaricSurface_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Standard isobaric surface" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Geopotential Of Standard Isobaric Surface</span>
                    <input type="text" name="gpm_mff" id="gpm_mff"   class="form-control"  placeholder="Enter the Geopotential Of Standard Isobaric Surface" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Duration Of Period Of Precipitation</span>
                    <input type="text" name="dopop_mff" id="dopop_mff"   class="form-control" placeholder="Enter the Duration Of Period Of Precipitation" >
                </div>
            </div>


        </div>
        <div class="col-lg-6">





            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Past Weather</span>
                    <input type="text" name="pastweather_mff" id="pastweather_mff"   class="form-control" placeholder=" Enter Past Weather " >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Grass Mininum temperature</span>
                    <input type="text" name="gmt_mff" id="gmt_mff"   class="form-control" placeholder=" Enter Grass Mininum temperature " >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Character and Intensity of Precipitation</span>
                    <input type="text" name="CI_OfPrecipitation_mff" id="CI_OfPrecipitation_mff"   class="form-control"  placeholder=" Enter Character and Intensity of Precipitation" >
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Beginning or End of Precipitation</span>
                    <input type="text" name="BE_OfPrecipitation_mff" id="BE_OfPrecipitation_mff"    class="form-control"    placeholder="Enter Beginning or End of Precipitation" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Indicator of type of intrumentation</span>
                    <input type="text" name="IndicatorOfTypeOfIntrumentation_mff" id="IndicatorOfTypeOfIntrumentation_mff"    class="form-control"    placeholder="Enter the Indicator of type of intrumentation" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Duration of Sunshine</span>
                    <input type="text" name="DurationOfSunshine_mff" id="DurationOfSunshine_mff"    class="form-control"    placeholder="Enter the Duration of Sunshine" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Sign of Pressure Change</span>
                    <input type="text" name="SignOfPressureChange_mff" id="SignOfPressureChange_mff"    class="form-control"    placeholder="Enter the Sign of Pressure Change" >
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Supplementary Information</span>
                    <input type="text" name="supplementaryinformation_mff" id="supplementaryinformation_mff" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Supplementary Information" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Vapour Pressure</span>
                    <input type="text" name="VapourPressure_mff" id="VapourPressure_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"   placeholder="Enter the Vapour Pressure" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WIND RUN</span>
                    <input type="text" name="windrun_mff"   id="windrun_mff"   class="form-control"  placeholder=" Enter the  WIND RUN" >
                </div>
            </div>


            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TH GRAPH</span>
                    <input type="text" name="thgraph_mff"  id="thgraph_mff"   class="form-control"  placeholder=" Enter TH GRAPH" >
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">

            <a href="<?= base_url(); ?>index.php/MoreFormFieldsForm/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

            <button type="submit" id="postMoreFormFieldsData_button" name="postMoreFormFieldsData_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add More Form Fields</button>
        </div>
        </form>
        </div>
    <?php
    }elseif((is_array($moreformfieldsform_id) && count($moreformfieldsform_id))) {
        foreach($moreformfieldsform_id as $moreformfieldsdata){

            $metadataform_id = $moreformfieldsdata->id;
            ?>
            <div class="row">
            <form action='<?= base_url(); ?>index.php/MoreFormFieldsForm/updateMoreFormFieldsFormData' method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <div id="output"></div>
            <script language="javascript">
                function allowIntegerInputOnly(inputvalue) {
                    //var invalidChars = /[^0-9]/gi
                    var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                    if(integerOnly.test(inputvalue.value)) {
                        inputvalue.value = inputvalue.value.replace(integerOnly,"");
                    }
                }

                function allowCharactersInputOnly(inputvalue) {
                    //var invalidChars = /[^0-9]/gi
                    var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                    if(charsOnly.test(inputvalue.value)) {
                        inputvalue.value = inputvalue.value.replace(charsOnly,"");
                    }
                }
            </script>
            <div class="col-lg-6">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Select Date</span>
                        <input type="text" name="date" class="form-control" value="<?php echo $moreformfieldsdata->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
                        <input type="hidden" name="id" value="<?php echo $moreformfieldsdata->id;?>">
                    </div>
                </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Station</span>
                            <input type="text" name="station" id="station" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                        </div>
                    </div>




                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> Station Number</span>
                            <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $moreformfieldsdata->StationNumber;?>" readonly="readonly" >
                        </div>
                    </div>





                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME</span>
                        <input type="text" name="timeRecorded" required class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $moreformfieldsdata->TIME;?>" readonly="readonly" >

                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Unit of Wind Speed</span>
                        <input type="text" name="UnitOfWindSpeed" id="UnitOfWindSpeed" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $moreformfieldsdata->UnitOfWindSpeed;?>"  class="form-control"  placeholder="Enter the Unit of Wind Speed" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Ind. or omission of precipitation</span>
                        <input type="text" name="IndOrOmissionOfPrecipitation" id="IndOrOmissionOfPrecipitation" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $moreformfieldsdata->IndOrOmissionOfPrecipitation;?>"  class="form-control"  placeholder="Enter the Ind. or omission of precipitation" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Type of station/present & past weather</span>
                        <input type="text" name="TypeOfStation_Present_Past_Weather" id="TypeOfStation_Present_Past_Weather" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $moreformfieldsdata->TypeOfStation_Present_Past_Weather;?>"  class="form-control"  placeholder="Enter the Type of station/present & past weather" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Height Of Lowest Cloud</span>
                        <input type="text" name="heightOfLowestCloud" value="<?php echo $moreformfieldsdata->HeightOfLowestCloud;?>" id="heightOfLowestCloud" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Height Of The Lowest Cloud" >
                    </div>
                </div>

             <!--   <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Total Cloud Cover</span>
                        <input type="text" name="totalCloudCover" id="totalCloudCover" value="<?php echo $moreformfieldsdata->TotalCloudCover;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Total Cloud Cover" >
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Standard isobaric surface</span>
                        <input type="text" name="StandardIsobaricSurface"id="StandardIsobaricSurface" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $moreformfieldsdata->StandardIsobaricSurface;?>"  class="form-control"  placeholder="Enter the Standard isobaric surface" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Geopotential Of Standard Isobaric Surface</span>
                        <input type="text" name="gpm" id="gpm"   value="<?php echo $moreformfieldsdata->GPM;?>"  class="form-control"  placeholder="Enter the Geopotential Of Standard Isobaric Surface" >
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Duration Of Period Of Precipitation</span>
                        <input type="text" name="dopop" id="dopop"  value="<?php echo $moreformfieldsdata->DurationOfPeriodOfPrecipitation;?>"  class="form-control" placeholder="Enter the Duration Of Period Of Precipitation" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Past Weather</span>
                        <input type="text" name="pastweather"  value="<?php echo $moreformfieldsdata->Past_Weather;?>" id="pastweather"  class="form-control" placeholder=" Enter Past Weather " >
                    </div>
                </div>


            </div>
            <div class="col-lg-6">



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Grass Mininum temperature</span>
                        <input type="text" name="gmt" value="<?php echo $moreformfieldsdata->GrassMinTemp;?>" id="gmt"   class="form-control" placeholder=" Enter Grass Mininum temperature " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Character and Intensity of Precipitation</span>
                        <input type="text" name="CI_OfPrecipitation" value="<?php echo $moreformfieldsdata->CI_OfPrecipitation;?>" id="CI_OfPrecipitation"   class="form-control"  placeholder=" Enter Character and Intensity of Precipitation" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Beginning or End of Precipitation</span>
                        <input type="text" name="BE_OfPrecipitation"  value="<?php echo $moreformfieldsdata->BE_OfPrecipitation;?>" id="BE_OfPrecipitation"    class="form-control"    placeholder="Enter Beginning or End of Precipitation" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Indicator of type of intrumentation</span>
                        <input type="text" name="IndicatorOfTypeOfIntrumentation" id="IndicatorOfTypeOfIntrumentation"  value="<?php echo $moreformfieldsdata->IndicatorOfTypeOfIntrumentation;?>"   class="form-control"    placeholder="Enter the Indicator of type of intrumentation" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Duration of Sunshine</span>
                        <input type="text" name="DurationOfSunshine" id="DurationOfSunshine"  value="<?php echo $moreformfieldsdata->DurationOfSunshine;?>"   class="form-control"    placeholder="Enter the Duration of Sunshine" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Sign of Pressure Change</span>
                        <input type="text" name="SignOfPressureChange" id="SignOfPressureChange"  value="<?php echo $moreformfieldsdata->SignOfPressureChange;?>"   class="form-control"    placeholder="Enter the Sign of Pressure Change" >
                    </div>
                </div>





                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Supplementary Information</span>
                        <input type="text" name="supplementaryinformation"  value="<?php echo $moreformfieldsdata->Supp_Info;?>" id="supplementaryinformation"  onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Supplementary Information" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Vapour Pressure</span>
                        <input type="text" name="VapourPressure" id="VapourPressure" value="<?php echo $moreformfieldsdata->VapourPressure;?>"  onkeyup="allowIntegerInputOnly(this)" class="form-control"   placeholder="Enter the Vapour Pressure" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WIND RUN</span>
                        <input type="text" name="windrun" value="<?php echo $moreformfieldsdata->Wind_Run;?>"  id="windrun"   class="form-control"  placeholder=" Enter TH GRAPH" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TH GRAPH</span>
                        <input type="text" name="thgraph" value="<?php echo $moreformfieldsdata->T_H_Graph;?>"  id="thgraph"   class="form-control"  placeholder=" Enter TH GRAPH" >
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Approved</span>
                        <select name="approval"  id="approval"  class="form-control">
                            <option value="<?php echo $moreformfieldsdata->Approved;?>"><?php echo $moreformfieldsdata->Approved;?></option>
                            <option value="">--Select Approval Options--</option>
                            <option value="TRUE">TRUE</option>
                            <option value="FALSE">FALSE</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a href="<?php echo base_url()."index.php/MoreFormFieldsForm/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updatemoreformfieldsdata_button" id="updatemoreformfieldsdata_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update More Form Field</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?= base_url(); ?>index.php/MoreFormFieldsForm/DisplayMoreFormFieldsForm/">
                    <i class="fa fa-plus"></i> Add new more Form Fields Form</a>



            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">More Form Field Form</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Station</th>
                                <th>Station No</th>
                                <th>TIME</th>
                                <th>Height Of Lowest Cloud</th>
                                <th>Unit Of WindSpeed</th>
                                <th>GPM</th>
                                <th>Duration Of Precipitation</th>
                                <th>Past Weather</th>
                                <th>GrassMinTemp</th>
                                <th>C&I Of Precipitation</th>

                                <th>B&E Of Precipitation</th>
                                <th>Supp Info</th>
                                <th>T_H_Graph</th>

                                <?php if($userrole=='OC' || $userrole=='Observer'){ ?>
                                    <th>Approved</th>

                                    <th>By</th>
                                    <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($moreformfieldsformdata) && count($moreformfieldsformdata)) {
                                foreach($moreformfieldsformdata as $data){
                                    $count++;
                                    $moreformfielddataid = $data->id;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->Date;?></td>
                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->TIME;?></td>
                                        <td ><?php echo $data->HeightOfLowestCloud;?></td>
                                        <td ><?php echo $data->UnitOfWindSpeed;?></td>
                                        <td ><?php echo $data->GPM;?></td>
                                        <td ><?php echo $data->DurationOfPeriodOfPrecipitation;?></td>
                                        <td><?php echo $data->Past_Weather;?></td>
                                        <td><?php echo $data->GrassMinTemp;?></td>


                                        <td ><?php echo $data->CI_OfPrecipitation;?></td>
                                        <td ><?php echo $data->BE_OfPrecipitation;?></td>
                                        <td><?php echo $data->Supp_Info;?></td>
                                        <td><?php echo $data->T_H_Graph;?></td>

                                        <td><?php echo $data->Approved;?></td>

                                        <td><?php echo $data->SubmittedBy;?></td>
                                        <?php if($userrole=='OC' || $userrole=='Observer'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/MoreFormFieldsForm/DisplayMoreFormFieldsFormForUpdate/" .$moreformfielddataid ;?>" style="cursor:pointer;">Edit</a>
                                          <!--  or <a href="<?php echo base_url() . "index.php/MoreFormFieldsForm/deleteMetarFormData/" .$moreformfielddataid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $moreformfielddataid->StationName;?>');">Delete</a></td><?php }?> -->
                                    </tr>

                                <?php
                                }
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

    <script>
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#postMoreFormFieldsData_button').click(function(event) {

                 //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddMoreFormFieldsFormData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert(" Record With the date,station,station Number and Time exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }





                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_mff').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_mff').val("");  //Clear the field.
                    $("#station_mff").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_mff').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_mff').val("");  //Clear the field.
                    $("#stationNo_mff").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_mff=$('#time_mff').val();
                if(time_mff==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  form not picked");
                    $('#time_mff').val("");  //Clear the field.
                    $("#time_mff").focus();
                    return false;

                }

////////////////////////////////////////////////////////////////////////////////////////////


            }); //button
            //  return false;

        });  //document
    </script>
                  <script>
                  function checkDuplicateEntryData_OnAddMoreFormFieldsFormData(){
                      //Check against the date,stationName,StationNumber,Time.
                      var date = $('#date').val();

                      var stationName= $('#station_mff').val();
                      var stationNumber = $('#stationNo_mff').val();

                      var timeRecorded = $('#time_mff').val();
                      $('#checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield').val("");


                      if ((date != undefined) && (timeRecorded != undefined) && (stationName != undefined) && (stationNumber != undefined)) {
                          $.ajax({
                              url: "<?php echo base_url(); ?>"+"index.php/MoreFormFieldsForm/checkInDBIfMoreFormFieldsFormRecordExistsAlready",
                              type: "POST",
                              data:{'date':date,'timeRecorded':timeRecorded,'stationName': stationName,'stationNumber':stationNumber},
                              cache: false,
                              async: false,

                              success: function(data){

                                  if(data=="true"){

                                      $('#checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield').empty();

                                      // alert(data);
                                      $("#checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield").val(data);

                                  }
                                  else if(data=="false"){
                                      $('#checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield').empty();

                                      // alert(data);
                                      $("#checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield").val(data);

                                  }
                              }

                          });//end of ajax

                          var truthvalue=$("#checkduplicateEntryOnAddMoreFormFieldsData_hiddentextfield").val();

                      }//end of if

                      else if((date == undefined) || (timeRecorded == undefined) || (stationName == undefined) || (stationNumber == undefined) ){

                          var truthvalue="Missing";
                      }

                      return truthvalue;

                   }//end of the function
    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#updatemoreformfieldsdata_button').click(function(event) {
                //Check that Date selected
                var date=$('#expdate').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station').val("");  //Clear the field.
                    $("#station").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo').val("");  //Clear the field.
                    $("#stationNo").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time=$('#timeRecorded').val();
                if(time==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }

////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
                //Check that Approved IS PICKED FROM A LIST
                var approval=$('#approval').val();
                if(approval==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select approval from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////



            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_UnitOfWindSpeed;
            var oldValue_UnitOfWindSpeed=$('#UnitOfWindSpeed').val();

            $('#UnitOfWindSpeed').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_UnitOfWindSpeed = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#UnitOfWindSpeed').val(newValue_UnitOfWindSpeed);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#UnitOfWindSpeed').val(oldValue_UnitOfWindSpeed);
                    return false;
                }

            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_IndOrOmissionOfPrecipitation;
            var oldValue_IndOrOmissionOfPrecipitation=$('#IndOrOmissionOfPrecipitation').val();

            $('#IndOrOmissionOfPrecipitation').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_IndOrOmissionOfPrecipitation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#IndOrOmissionOfPrecipitation').val(newValue_IndOrOmissionOfPrecipitation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#IndOrOmissionOfPrecipitation').val(oldValue_IndOrOmissionOfPrecipitation);
                    return false;
                }

            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_TypeOfStation_Present_Past_Weather;
            var oldValue_TypeOfStation_Present_Past_Weather=$('#TypeOfStation_Present_Past_Weather').val();

            $('#TypeOfStation_Present_Past_Weather').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_TypeOfStation_Present_Past_Weather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#TypeOfStation_Present_Past_Weather').val(newValue_TypeOfStation_Present_Past_Weather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#TypeOfStation_Present_Past_Weather').val(oldValue_TypeOfStation_Present_Past_Weather);
                    return false;
                }

            });
        });
    </script>


    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_heightOfLowestCloud;
            var oldValue_heightOfLowestCloud=$('#heightOfLowestCloud').val();

            $('#heightOfLowestCloud').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_heightOfLowestCloud = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#heightOfLowestCloud').val(newValue_heightOfLowestCloud);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#heightOfLowestCloud').val(oldValue_heightOfLowestCloud);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_StandardIsobaricSurface;
            var oldValue_StandardIsobaricSurface=$('#StandardIsobaricSurface').val();

            $('#StandardIsobaricSurface').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_StandardIsobaricSurface = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#StandardIsobaricSurface').val(newValue_StandardIsobaricSurface);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#StandardIsobaricSurface').val(oldValue_StandardIsobaricSurface);
                    return false;
                }

            });
        });
    </script>


    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_gpm;
            var oldValue_gpm= $('#gpm').val()

            $('#gpm').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_gpm = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gpm').val(newValue_gpm);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gpm').val(oldValue_gpm);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_dopop;
            var oldValue_dopop= $('#dopop').val();

            $('#dopop').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_dopop = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dopop').val(newValue_dopop);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dopop').val(oldValue_dopop);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_pastweather;
            var oldValue_pastweather= $('#pastweather').val();

            $('#pastweather').live('change paste', function(){
                //oldValue_airtemperature = newValue_airtemperature;
                newValue_pastweather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#pastweather').val(newValue_pastweather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#pastweather').val(oldValue_pastweather);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_gmt;
            var oldValue_gmt= $('#gmt').val();

            $('#gmt').live('change paste', function(){
               // oldValue_wetbulb = newValue_wetbulb;
                newValue_gmt = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gmt').val(newValue_gmt);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gmt').val(oldValue_gmt);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_CI_OfPrecipitation;
            var oldValue_CI_OfPrecipitation= $('#CI_OfPrecipitation').val()

            $('#CI_OfPrecipitation').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_CI_OfPrecipitation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CI_OfPrecipitation').val(newValue_CI_OfPrecipitation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CI_OfPrecipitation').val(oldValue_CI_OfPrecipitation);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_BE_OfPrecipitation;
            var oldValue_BE_OfPrecipitation= $('#BE_OfPrecipitation').val();

            $('#BE_OfPrecipitation').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_BE_OfPrecipitation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#BE_OfPrecipitation').val(newValue_BE_OfPrecipitation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#BE_OfPrecipitation').val(oldValue_BE_OfPrecipitation);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_IndicatorOfTypeOfIntrumentation;
            var oldValue_IndicatorOfTypeOfIntrumentation= $('#IndicatorOfTypeOfIntrumentation').val()

            $('#IndicatorOfTypeOfIntrumentation').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_IndicatorOfTypeOfIntrumentation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#IndicatorOfTypeOfIntrumentation').val(newValue_IndicatorOfTypeOfIntrumentation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#IndicatorOfTypeOfIntrumentation').val(oldValue_IndicatorOfTypeOfIntrumentation);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_DurationOfSunshine;
            var oldValue_DurationOfSunshine= $('#DurationOfSunshine').val()

            $('#DurationOfSunshine').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_DurationOfSunshine = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#DurationOfSunshine').val(newValue_DurationOfSunshine);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#DurationOfSunshine').val(oldValue_DurationOfSunshine);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_SignOfPressureChange;
            var oldValue_SignOfPressureChange= $('#SignOfPressureChange').val()

            $('#SignOfPressureChange').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_SignOfPressureChange = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#SignOfPressureChange').val(newValue_SignOfPressureChange);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#SignOfPressureChange').val(oldValue_SignOfPressureChange);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_VapourPressure;
            var oldValue_VapourPressure= $('#VapourPressure').val()

            $('#VapourPressure').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_VapourPressure = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#VapourPressure').val(newValue_VapourPressure);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#VapourPressure').val(oldValue_VapourPressure);
                    return false;
                }
            });
        });
    </script>


    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_supplementaryinformation;
            var oldValue_supplementaryinformation= $('#supplementaryinformation').val();

            $('#supplementaryinformation').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_supplementaryinformation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#supplementaryinformation').val(newValue_supplementaryinformation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#supplementaryinformation').val(oldValue_supplementaryinformation);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windrun;
            var oldValue_windrun= $('#windrun').val();

            $('#windrun').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_windrun = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windrun').val(newValue_windrun);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windrun').val(oldValue_windrun);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_thgraph;
            var oldValue_thgraph= $('#thgraph').val();

            $('#thgraph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_thgraph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#thgraph').val(newValue_thgraph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#thgraph').val(oldValue_thgraph);
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number should be picked from the DB.
        // For Insert/Add metar
        $(document.body).on('change','#stationManager_mff',function(){
            $('#stationNoManager_mff').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoManager_mff').val("");
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

                            $('#stationNoManager_mff').empty();

                            // alert(data);
                            $("#stationNoManager_mff").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoManager_mff').empty();
                            $('#stationNoManager_mff').val("");

                        }
                    }

                });



            }
            else {

                $('#stationNoManager_mff').empty();
                $('#stationNoManager_mff').val("");
            }

        })

    </script>

<?php require_once(APPPATH . 'views/footer.php'); ?>