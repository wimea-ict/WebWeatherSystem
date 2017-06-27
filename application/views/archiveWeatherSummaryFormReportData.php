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
                Archive Weather Summary Form Report Data
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Archive Weather Summary Form Report Data</li>

            </ol>
        </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewarchiveweathersummaryFormreportdata) && count($displaynewarchiveweathersummaryFormreportdata)) {
        ?>
        <div class="row">
        <form action="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/insertArchiveWeatherSummaryFormReportData/" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="date_archiveweathersummaryformreportdata"  required class="form-control" placeholder="Enter select date" id="date">
                    <input type="hidden" name="checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield" id="checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield">

                </div>
            </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Station</span>
                        <input type="text" name="station_archiveweathersummaryformreportdata" id="station_archiveweathersummaryformreportdata" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                    </div>
                </div>




                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Station Number</span>
                        <input type="text" name="stationNo_archiveweathersummaryformreportdata" required class="form-control" id="stationNo_archiveweathersummaryformreportdata" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                    </div>
                </div>




            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Max Temp</span>
                    <input type="text" name="maxTemp_wsf" id="maxTemp_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter max temp" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Min Temp</span>
                    <input type="text" name="minTemp_wsf" id="minTemp_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter min temp" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Sunshine(Hrs)</span>
                    <input type="text" name="sunshine_wsf" id="sunshine_wsf" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" required placeholder="Enter the Sunshine (Hrs)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">DB 0600Z</span>
                    <input type="text" name="db0600Z_wsf" id="db0600Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter DB for 0600Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WB 0600Z</span>
                    <input type="text" name="wb0600Z_wsf" id="wb0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" placeholder="Enter WB for 0600Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">DP 0600Z</span>
                    <input type="text" name="dp0600Z_wsf" id="dp0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" placeholder="Enter DP for 0600Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">VP 0600Z</span>
                    <input type="text" name="vp0600Z_wsf"  id="vp0600Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter VP for 0600Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">RH 0600Z</span>
                    <input type="text" name="rh0600Z_wsf" id="rh0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  required  class="form-control" placeholder="Enter RH for 0600Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">CLP 0600Z</span>
                    <input type="text" name="clp0600Z_wsf"  id="clp0600Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter CLP for 0600Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">GPM 0600Z</span>
                    <input type="text" name="gpm0600Z_wsf" id="gpm0600Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter GPM for 0600Z" >
                </div>
            </div>


            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WIND DIR 0600Z</span>
                    <input type="text" name="winddir0600Z_wsf"  id="winddir0600Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter Wind Direction for 0600z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">FF 0600Z</span>
                    <input type="text" name="ff0600Z_wsf"  id="ff0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  required class="form-control"  placeholder="Enter FF for 0600Z" >
                </div>
            </div>


        </div>
        <div class="col-lg-6">

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">DB 1200Z</span>
                    <input type="text" name="db1200Z_wsf"  id="db1200Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter DB for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WB 1200Z</span>
                    <input type="text" name="wb1200Z_wsf" id="wb1200Z_wsf"  onkeyup="allowIntegerInputOnly(this)"  required class="form-control" placeholder="Enter WB for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">DP 1200Z</span>
                    <input type="text" name="dp1200Z_wsf" id="dp1200Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter DP for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">VP 1200Z</span>
                    <input type="text" name="vp1200Z_wsf" id="vp1200Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter VP for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">RH 1200Z</span>
                    <input type="text" name="rh1200Z_wsf" id="rh1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" placeholder="Enter RH for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">CLP 1200Z</span>
                    <input type="text" name="clp1200Z_wsf" id="clp1200Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter CLP for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">GPM 1200Z</span>
                    <input type="text" name="gpm1200Z_wsf" id="gpm1200Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter GPM for 1200Z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WIND DIR 1200Z</span>
                    <input type="text" name="winddir1200Z_wsf"  id="winddir1200Z_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter Wind Direction for 1200z" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">FF 1200Z</span>
                    <input type="text" name="ff1200Z_wsf" id="ff1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  required class="form-control"  placeholder="Enter FF for 1200Z" >
                </div>
            </div>


            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Wind Run</span>
                    <input type="text" name="windrun_wsf" id="windrun_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder=" Enter Wind Run" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">R/F</span>
                    <input type="text" name="rf_wsf" id="rf_wsf" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder=" Enter R/F" >
                </div>
            </div>



            <div class="form-group">
                <label><span>Did we have: </span></label><br>

                <label><input type="checkbox" name="thunderstorm_wsf" class="form-control" value="true"> Thunder storm (Ts)</label>
                <label><input type="checkbox" name="fog_wsf" class="form-control" value="true"> Fog (Fg)</label>
                <label><input type="checkbox" name="haze_wsf" class="form-control" value="true"> Haze (Hz)</label>
                <label><input type="checkbox" name="hailstorm_wsf" class="form-control" value="true"> Hail storm (Hs)</label>
                <label><input type="checkbox" name="earthquake_wsf" class="form-control" value="true"> Earth Quake</label>

            </div>
        </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">

            <a href="<?php echo base_url()."index.php/ArchiveWeatherSummaryFormReportData/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

            <button type="submit" id="postarchiveweathersummaryformreportdata_button" name="postarchiveweathersummaryformreportdata_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add  New Archive Weather Summary Form</button>
        </div>
        </form>
        </div>
    <?php
    }elseif((is_array($updatearchiveweathersummaryformreportdata) && count($updatearchiveweathersummaryformreportdata))) {
        foreach($updatearchiveweathersummaryformreportdata as $data){

            $formdataid = $data->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/updateArchiveWeatherSummaryFormReportData" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="date" class="form-control" value="<?php echo $data->Date;?>" placeholder="Enter select date" id="expdate">
                        <input type="hidden" name="id" value="<?php echo $data->id;?>">
                    </div>
                </div>




                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Station Name</span>
                            <input type="text" name="station" id="station" required class="form-control" value="<?php echo $data->StationName;?>"  readonly class="form-control" >

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> Station Number</span>
                            <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $data->StationNumber;?>" readonly="readonly" >
                        </div>
                    </div>




                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Max Temp</span>
                        <input type="text" name="maxTemp" id="maxTemp" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->TEMP_MAX;?>" required placeholder="Enter max temp" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Min Temp</span>
                        <input type="text" name="minTemp" id="minTemp" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->TEMP_MIN;?>" required placeholder="Enter min temp" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Sunshine(Hrs)</span>
                        <input type="text" name="sunshine" id="sunshine" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->SUNSHINE;?>" required placeholder="Sunshine (Hrs)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">DB 0600Z</span>
                        <input type="text" name="db0600Z" id="db0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->DB_0600Z;?>" required placeholder="Enter DB for 0600Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WB 0600Z</span>
                        <input type="text" name="wb0600Z" id="wb0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->WB_0600Z;?>" placeholder="Enter WB for 0600Z " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">DP 0600Z</span>
                        <input type="text" name="dp0600Z" id="dp0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->DP_0600Z;?>" placeholder="Enter DP for 0600Z " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">VP 0600Z</span>
                        <input type="text" name="vp0600Z" id="vp0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->VP_0600Z;?>" placeholder="Enter VP for 0600Z " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">RH 0600Z</span>
                        <input type="text" name="rh0600Z" id="rh0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->RH_0600Z;?>" placeholder="Enter RH for 0600Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">CLP 0600Z</span>
                        <input type="text" name="clp0600Z" id="clp0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter CLP for 0600Z" value="<?php echo $data->CLP_0600Z;?>" >
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">GPM 0600Z</span>
                        <input type="text" name="gpm0600Z" id="gpm0600Z" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" value="<?php echo $data->GPM_0600Z;?>" required placeholder="Enter GPM for 0600Z" >
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WIND DIR 0600Z</span>
                        <input type="text" name="winddir0600Z" id="winddir0600Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->WIND_DIR_0600Z;?>" required placeholder="Enter Wind Direction for 0600Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">FF 0600Z</span>
                        <input type="text" name="ff0600Z" id="ff0600Z" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" value="<?php echo $data->FF_0600Z;?>" required placeholder="Enter FF for 0600z" >
                    </div>
                </div>



            </div>
            <div class="col-lg-6">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">DB 1200Z</span>
                        <input type="text" name="db1200Z" id="db1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->DB_1200Z;?>" required placeholder="Enter DB for 1200Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WB 1200Z</span>
                        <input type="text" name="wb1200Z" id="wb1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->WB_1200Z;?>" placeholder="Enter WB for 1200Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">DP 1200Z</span>
                        <input type="text" name="dp1200Z" id="dp1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->DP_1200Z;?>" placeholder="Enter DP for 1200Z " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">VP 1200Z</span>
                        <input type="text" name="vp1200Z" id="vp1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->VP_1200Z;?>" placeholder="Enter VP for 1200Z " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">RH 1200Z</span>
                        <input type="text" name="rh1200Z" id="rh1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->RH_1200Z;?>" placeholder="Enter RH for 1200Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">CLP 1200Z</span>
                        <input type="text" name="clp1200Z" id="clp1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter CLP for 1200Z" value="<?php echo $data->CLP_1200Z;?>" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">GPM 1200Z</span>
                        <input type="text" name="gpm1200Z" id="gpm1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->GPM_1200Z;?>" required placeholder="Enter GPM for 1200Z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Wind Direction 1200Z</span>
                        <input type="text" name="winddir1200Z" id="winddir1200Z" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" value="<?php echo $data->WIND_DIR_1200Z;?>" required placeholder="Enter Wind Direction for 1200z" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">FF 1200Z</span>
                        <input type="text" name="ff1200Z" id="ff1200Z" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->FF_1200Z;?>" required placeholder="Enter FF for 1200Z" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Wind Run</span>
                        <input type="text" name="windrun" id="windrun" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $data->WIND_RUN;?>" required placeholder="Wind Run" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">R/F</span>
                        <input type="text" name="rf" id="rf"  required class="form-control" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $data->R_F;?>" required placeholder="R/Day" >
                    </div>
                </div>





                <div class="form-group">
                    <label><span>Did we have: </span></label><br>

                    <input type="checkbox" <?php if($data->ThunderStorm == "true") echo "checked"; ?> name="thunder" class="form-control" value="true"> Thunder storm (Ts)
                    <input type="checkbox" name="fog" <?php if($data->Fog == "true") echo "checked"; ?> class="form-control" value="true"> Fog (Fg)
                    <input type="checkbox" name="haze" <?php if($data->Haze == "true") echo "checked"; ?> class="form-control" value="true"> Haze (Hz)
                    <input type="checkbox" name="hailstorm" <?php if($data->HailStorm == "true") echo "checked"; ?> class="form-control" value="true"> Hail storm (Hs)
                    <input type="checkbox" name="quake" <?php if($data->EarhtQuake == "true") echo "checked"; ?> class="form-control"> Earth Quake

                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Approved</span>
                        <select name="approval" id="approval" class="form-control">
                            <option value="<?php echo $data->Approved;?>"><?php echo $data->Approved;?></option>
                            <option value="">--Select Options--</option>
                            <option value="TRUE">TRUE</option>
                            <option value="FALSE">FALSE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a href="<?php echo base_url()."index.php/ArchiveWeatherSummaryFormReportData/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updatearchiveweathersummaryformreportdata_button" id="updatearchiveweathersummaryformreportdata_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Archive Weather Summary Form</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/DisplayNewArchiveWeatherSummaryFormReportData/">
                    <i class="fa fa-plus"></i> Add new Archive Weather Summary Form</a>
            </div>

        </div>
        <br>
        <div class="row">
        <div class="col-xs-12">

        <div class="box">
        <div class="box-header">
            <h3 class="box-title"> Archive  Weather Summary Form Report Data</h3>
        </div><!-- /.box-header -->

        <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Station</th>
            <th>Station No</th>
            <th>Max</th>
            <th>Min</th>
            <th>Sun shine</th>
            <th>DB</th>
            <th>WB</th>
            <th>DP</th>
            <th>VP </th>
            <th>RH</th>
            <th>CLP</th>
            <th>GPM</th>
            <th>Wind dir</th>
            <th>FF</th>
            <th>Wind Run</th>
            <th>R_F</th>


            <th>By</th>
            <th>Approved</th>
        <?php if($userrole=="OC"|| $userrole=="ObserverDataEntrant"){ ?><th class="no-print">Action</th><?php }?>
        </tr>
        </thead>
        <tbody>
        <?php
        $count = 0;
        if (is_array($archivedweathersummaryformreportdata) && count($archivedweathersummaryformreportdata)) {
            foreach($archivedweathersummaryformreportdata as $dailydata){
                $count++;
                $dailyid = $dailydata->id;
                ?>
                <tr>
                    <td ><?php echo $count;?></td>
                    <td ><?php echo $dailydata->Date;?></td>
                    <td ><?php echo $dailydata->StationName;?></td>
                    <td ><?php echo $dailydata->StationNumber;?></td>
                    <td ><?php echo $dailydata->TEMP_MAX;?></td>
                    <td ><?php echo $dailydata->TEMP_MIN;?></td>
                    <td ><?php echo $dailydata->SUNSHINE;?></td>

                    <td ><?php echo $dailydata->DB_0600Z;?></td>
                    <td ><?php echo $dailydata->WB_0600Z;?></td>
                    <td><?php echo $dailydata->DP_0600Z;?></td>
                    <td><?php echo $dailydata->VP_0600Z;?></td>
                    <td><?php echo $dailydata->RH_0600Z;?></td>
                    <td><?php echo $dailydata->CLP_0600Z;?></td>
                    <td><?php echo $dailydata->GPM_0600Z;?></td>
                    <td><?php echo $dailydata->WIND_DIR_0600Z;?></td>
                    <td><?php echo $dailydata->FF_0600Z;?></td>


                    <td><?php echo $dailydata->WIND_RUN;?></td>
                    <td><?php echo $dailydata->R_F;?></td>


                    <td ><?php echo $dailydata->SubmittedBy;?></td>
                    <td ><?php echo $dailydata->Approved;?></td>
               <?php if($userrole=="OC"|| $userrole=="ObserverDataEntrant"){ ?>
                        <td class="no-print">
                        <a href="<?php echo base_url()."index.php/ArchiveWeatherSummaryFormReportData/DisplayArchiveWeatherSummaryFormReportDataForUpdate/" .$dailydata->id ;?>"
                           style="cursor:pointer;">Edit</a>
                   <!--or
                        <a href="<?php echo base_url()."index.php/ArchiveWeatherSummaryFormReportData/deleteArchiveWeatherSummaryFormData/" .$dailydata->id ;?>"

                           onClick="return confirm('Are you sure you want to delete this record?');">Delete</a></td><?php }?> -->
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
        }  }
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
            //Post Add New  Archive Weather Summary  form Report data into the DB
            //Validate each (select) field before inserting into the DB
            $('#postarchiveweathersummaryformreportdata_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveWeatherSummaryFormReportData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Weather Record with the Same date ,station name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number or date not picked");
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
                var station=$('#station_archiveweathersummaryformreportdata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archiveweathersummaryformreportdata').val("");  //Clear the field.
                    $("#station_archiveweathersummaryformreportdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archiveweathersummaryformreportdata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archiveweathersummaryformreportdata').val("");  //Clear the field.
                    $("#stationNo_archiveweathersummaryformreportdata").focus();
                    return false;

                }





            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE WEATHER SUMMARY FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveWeatherSummaryFormReportData(){

            //Check against the date,stationName,SManagernNumber,Time and Metar Option.
            var date= $('#date').val();

            var stationName= $('#station_archiveweathersummaryformreportdata').val();
          var stationNumber = $('#stationNo_archiveweathersummaryformreportdata').val();

            $('#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveWeatherSummaryFormReportData/checkInDBIfArchiveWeatherSummaryFormReportRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").val();

            }//end of if
            else if((date == undefined) ||  (stationName == undefined) || (stationNumber == undefined)){

                var truthvalue="Missing";
            }


            return truthvalue;
        }//end of check duplicate values in the DB
        // return false;

    </script>

    <script>
        $(document).ready(function() {
            //Update  Archive Weather Summary form Report data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updatearchiveweathersummaryformreportdata_button').click(function(event) {
                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate"). focus();
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

                //Check that Approved IS PICKED FROM A LIST
                var approved=$('#approval').val();
                if(approved==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select Approved from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }



            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_maxTemp;
            var oldValue_maxTemp=$('#maxTemp').val();

            $('#maxTemp').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_maxTemp = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxTemp').val(newValue_maxTemp);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxTemp').val(oldValue_maxTemp);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_minTemp ;
            var oldValue_minTemp= $('#minTemp').val()

            $('#minTemp').live('change paste', function(){
                //oldValue_minTemp = newValue_minTemp;
                newValue_minTemp = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minTemp').val(newValue_minTemp);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minTemp').val(oldValue_minTemp);
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
            var newValue_sunshine;
            var oldValue_sunshine= $('#sunshine').val()

            $('#sunshine').live('change paste', function(){
                // oldValue_dryBulb0600Z = newValue_dryBulb0600Z;
                newValue_sunshine = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#sunshine').val(newValue_sunshine);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#sunshine').val(oldValue_sunshine);
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
            var newValue_db0600Z;
            var oldValue_db0600Z= $('#db0600Z').val();

            $('#db0600Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_db0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#db0600Z').val(newValue_db0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#db0600Z').val(oldValue_db0600Z);
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
            var newValue_wb0600Z;
            var oldValue_wb0600Z= $('#wb0600Z').val();

            $('#wb0600Z').live('change paste', function(){
                //oldValue_dewPoint0600Z = newValue_dewPoint0600Z;
                newValue_wb0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wb0600Z').val(newValue_wb0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wb0600Z').val(oldValue_wb0600Z);
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
            var newValue_dp0600Z;
            var oldValue_relativeHumidity0600Z= $('#dp0600Z').val()

            $('#dp0600Z').live('change paste', function(){
                //oldValue_relativeHumidity0600Z = newValue_relativeHumidity0600Z;
                newValue_dp0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dp0600Z').val(newValue_dp0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dp0600Z').val(oldValue_dp0600Z);
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
            var newValue_vp0600Z;
            var oldValue_vp0600Z= $('#vp0600Z').val()

            $('#vp0600Z').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_vp0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#vp0600Z').val(newValue_vp0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#vp0600Z').val(oldValue_vp0600Z);
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
            var newValue_rh0600Z;
            var oldValue_rh0600Z= $('#rh0600Z').val();

            $('#rh0600Z').live('change paste', function(){
                // oldValue_windSpeed0600Z = newValue_windSpeed0600Z;
                newValue_rh0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rh0600Z').val(newValue_rh0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rh0600Z').val(oldValue_rh0600Z);
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
            var newValue_clp0600Z;
            var oldValue_clp0600Z= $('#clp0600Z').val();

            $('#clp0600Z').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_clp0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#clp0600Z').val(newValue_clp0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#clp0600Z').val(oldValue_clp0600Z);
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
            var newValue_gpm0600Z;
            var oldValue_gpm0600Z= $('#gpm0600Z').val()

            $('#gpm0600Z').live('change paste', function(){
                // oldValue_dryBulb1200Z = newValue_dryBulb1200Z;
                newValue_gpm0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gpm0600Z').val(newValue_gpm0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gpm0600Z').val(oldValue_gpm0600Z);
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
            var newValue_winddir0600Z;
            var oldValue_winddir0600Z= $('#winddir0600Z').val();

            $('#winddir0600Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_winddir0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddir0600Z').val(newValue_winddir0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddir0600Z').val(oldValue_winddir0600Z);
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
            var newValue_ff0600Z;
            var oldValue_ff0600Z= $('#ff0600Z').val();

            $('#ff0600Z').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_ff0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#ff0600Z').val(newValue_ff0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#ff0600Z').val(oldValue_ff0600Z);
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
            var newValue_db1200Z;
            var oldValue_db1200Z= $('#db1200Z').val();

            $('#db1200Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_db1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#db1200Z').val(newValue_db1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#db1200Z').val(oldValue_db1200Z);
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
            var newValue_wb1200Z;
            var oldValue_wb1200Z= $('#wb1200Z').val();

            $('#wb1200Z').live('change paste', function(){
                //oldValue_dewPoint0600Z = newValue_dewPoint0600Z;
                newValue_wb1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wb1200Z').val(newValue_wb1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wb1200Z').val(oldValue_wb1200Z);
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
            var newValue_dp1200Z;
            var oldValue_dp1200Z= $('#dp1200Z').val()

            $('#dp1200Z').live('change paste', function(){
                //oldValue_relativeHumidity0600Z = newValue_relativeHumidity0600Z;
                newValue_dp1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dp1200Z').val(newValue_dp1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dp1200Z').val(oldValue_dp1200Z);
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
            var newValue_vp1200Z;
            var oldValue_vp1200Z= $('#vp1200Z').val()

            $('#vp1200Z').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_vp1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#vp1200Z').val(newValue_vp1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#vp1200Z').val(oldValue_vp1200Z);
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
            var newValue_rh1200Z;
            var oldValue_rh1200Z= $('#rh1200Z').val();

            $('#rh1200Z').live('change paste', function(){
                // oldValue_windSpeed0600Z = newValue_windSpeed0600Z;
                newValue_rh1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rh1200Z').val(newValue_rh1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rh1200Z').val(oldValue_rh1200Z);
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
            var newValue_clp1200Z;
            var oldValue_clp1200Z= $('#clp1200Z').val();

            $('#clp1200Z').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_clp1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#clp1200Z').val(newValue_clp1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#clp1200Z').val(oldValue_clp1200Z);
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
            var newValue_gpm1200Z;
            var oldValue_gpm1200Z= $('#gpm1200Z').val()

            $('#gpm1200Z').live('change paste', function(){
                // oldValue_dryBulb1200Z = newValue_dryBulb1200Z;
                newValue_gpm1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gpm1200Z').val(newValue_gpm1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gpm1200Z').val(oldValue_gpm1200Z);
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
            var newValue_winddir1200Z;
            var oldValue_winddir1200Z= $('#winddir1200Z').val();

            $('#winddir1200Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_winddir1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddir1200Z').val(newValue_winddir1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddir1200Z').val(oldValue_winddir1200Z);
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
            var newValue_ff1200Z;
            var oldValue_ff1200Z= $('#ff1200Z').val();

            $('#ff1200Z').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_ff1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#ff1200Z').val(newValue_ff1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#ff1200Z').val(oldValue_ff1200Z);
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
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
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
            var newValue_rf;
            var oldValue_rf= $('#rf').val();

            $('#rf').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_rf = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rf').val(newValue_rf);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alertManagerttttt");
                    $('#rf').val(oldValue_rf);
                    return false;

            });
        });
    </script>







<?php require_once(APPPATH . 'views/footer.php'); ?>