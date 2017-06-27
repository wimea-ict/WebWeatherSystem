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
            Observation Slip Form
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Observation Slip Form</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewobservationslipform) && count($displaynewobservationslipform)) {
        ?>
        <div class="row">
        <form action="<?php echo base_url(); ?>index.php/ObservationSlipForm/insertObervationSlipFormData/" method="post" enctype="multipart/form-data">
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
                <input type="text" name="date_observationslipform" id="date" required class="form-control" placeholder="Enter select date" >
                <input type="hidden" name="checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield" id="checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield">

            </div>
        </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Station Name</span>
                    <input type="text" name="station_observationslipform" id="station_observationslipform" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"> Station Number</span>
                    <input type="text" name="stationNo_observationslipform" id="stationNo_observationslipform" required class="form-control"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                </div>
            </div>






        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">TIME</span>
                <select name="time_observationslipform" id="time_observationslipform" required class="form-control">
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
                <span class="input-group-addon">Total amount of all clouds</span>
                <input type="text" name="totalamountofallclouds_observationslipform"  id="totalamountofallclouds_observationslipform"  onkeyup="allowIntegerInputOnly(this)"required class="form-control" required placeholder=" Enter total amount of all clouds" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Total amount of low clouds</span>
                <input type="text" name="totalamountoflowclouds_observationslipform" id="totalamountoflowclouds_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter total amount of all clouds" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">TYPE LOW CLOUD</span>
                <input type="text" name="TypeOfLowClouds_observationslipform"  id="TypeOfLowClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of low Cloud" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">OKTAS LOW CLOUD</span>
                <input type="text" name="OktasOfLowClouds_observationslipform" id="OktasLowClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS LOW CLOUD" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">HEIGHT OF LOW CLOUD</span>
                <input type="text" name="HeightOfLowClouds_observationslipform"  id="HeightLowClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" Enter HEIGHT LOW CLOUD " >

            </div>
        </div>


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">CL CODE</span>
                <input type="text" name="CLCODEOfLowClouds_observationslipform"  id="CLCODEOfLowClouds_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE LOW CLOUD " >

            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">TYPE MEDIUM CLOUD</span>
                <input type="text" name="TypeOfMediumClouds_observationslipform"  id="TypeOfMediumClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE MEDIUM CLOUD" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">OKTAS MEDIUM CLOUD</span>
                <input type="text" name="OktasOfMediumClouds_observationslipform" id="OktasOfMediumClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS MEDIUM CLOUD" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">HEIGHT MEDIUM CLOUD</span>
                <input type="text" name="HeightOfMediumClouds_observationslipform"  id="HeightOfMediumClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" Enter HEIGHT MEDIUM CLOUD " >

            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">CL CODE MEDIUM CLOUD</span>
                <input type="text" name="CLCODEOfMediumClouds_observationslipform"  id="CLCODEOfMediumClouds_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >

            </div>
        </div>


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">TYPE HIGH CLOUD</span>
                <input type="text" name="TypeOfHighClouds_observationslipform"  id="TypeOfHighClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE HIGH CLOUD" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">OKTAS HIGH CLOUD</span>
                <input type="text" name="OktasOfHighClouds_observationslipform" id="OktasOfHighClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS HIGH CLOUD" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">HEIGHT HIGH CLOUD</span>
                <input type="text" name="HeightOfHighClouds_observationslipform"  id="HeightOfHighClouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" Enter HEIGHT HIGH CLOUD " >

            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">CL CODE MEDIUM CLOUD</span>
                <input type="text" name="CLCODEOfHighClouds_observationslipform"  id="CLCODEOfHighClouds_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE HIGH CLOUD " >

            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Cloud Searchlight Alidade Reading</span>
                <input type="text" name="cloudsearchlight_observationslipform" id="cloudsearchlight_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Cloud Searchlight Alidade Reading" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Rainfall(mm)</span>
                <input type="text" name="rainfall_observationslipform" id="rainfall_observationslipform"   class="form-control" placeholder="Enter Rainfall(mm)" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Dry Bulb</span>
                <input type="text" name="drybulb_observationslipform" id="drybulb_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter Dry Bulb" >
            </div>
        </div>


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Wet Bulb</span>
                <input type="text" name="wetbulb_observationslipform" id="wetbulb_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter Wet Bulb" >
            </div>
        </div>


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">MAX Read</span>
                <input type="text" name="maxRead_observationslipform"  id="maxRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MAX READ" >
            </div>
        </div>



        </div>
        <div class="col-lg-6">






            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">MAX Reset</span>
                    <input type="text" name="maxReset_observationslipform" id="maxReset_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MAX RESET" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">MIN Read</span>
                    <input type="text" name="minRead_observationslipform"  id="minRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MIN READ" >
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">MIN Reset</span>
                    <input type="text" name="minReset_observationslipform" id="minReset_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MIN RESET" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">PICHE Read</span>
                    <input type="text" name="picheRead_observationslipform"  id="picheRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter PICHE READ" >
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">PICHE Reset</span>
                    <input type="text" name="picheReset_observationslipform" id="picheReset_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter PICHE RESET" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME MARKS THERMO</span>
                    <input type="text" name="timemarksThermo_observationslipform"  id="timemarksThermo_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS THERMO" >
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME MARKS HYGRO</span>
                    <input type="text" name="timemarksHygro_observationslipform" id="timemarksHygro_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS HYGRO" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME MARKS RAIN REC</span>
                    <input type="text" name="timemarksRainRec_observationslipform" id="timemarksRainRec_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS RAIN REC" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">PRESENT WEATHER</span>
                    <input type="text" name="presentweather_observationslipform" id="presentweather_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter PRESENT WEATHER" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">VISIBILITY</span>
                    <input type="text" name="visibility_observationslipform" id="visibility_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter VISIBILITY" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WIND DIRECTION</span>
                    <input type="text" name="winddirection_observationslipform" id="winddirection_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter WIND DIRECTION" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">WIND SPEED(KTS)</span>
                    <input type="text" name="windspeed_observationslipform" id="windspeed_observationslipform"  required class="form-control" placeholder="Enter WIND SPEED(KTS)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">GUSTING(KTS)</span>
                    <input type="text" name="gusting_observationslipform" id="gusting_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter GUSTING (KTS)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Attd.Thermo.(C)</span>
                    <input type="text" name="attdThermo_observationslipform" id="attdThermo_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter ATTD.THERMO." >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Pr.As Read(C)</span>
                    <input type="text" name="prAsRead_observationslipform" id="prAsRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Pr.As Read" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Correction</span>
                    <input type="text" name="correction_observationslipform" id="correction_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Correction" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">C.L.P(mb)</span>
                    <input type="text" name="CLP_observationslipform" id="CLP_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter C.L.P(mb)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">M.S.L.Pr(mb) or 850mb. Ht.(gpm)</span>
                    <input type="text" name="MSLPR_observationslipform" id="MSLPR_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter M.S.L.Pr(mb) or 850mb. Ht.(gpm)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME MARKS BAROGRAPH</span>
                    <input type="text" name="timeMarksBarograph_observationslipform" id="timeMarksBarograph_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS BAROGRAPH" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME MARKS ANEMOGRAPH</span>
                    <input type="text" name="timeMarksAnemograph_observationslipform" id="timeMarksAnemograph_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS ANEMOGRAPH" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Other T/MARKS </span>
                    <input type="text" name="otherTMarks_observationslipform" id="otherTMarks_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter Other T/MARKS" >
                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Remarks or any other Observations </span>
                    <input type="text" name="remarks_observationslipform" id="remarks_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter Remarks or any other Observations" >
                </div>
            </div>




        </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">

            <a href="<?php echo base_url(); ?>index.php/ObservationSlipForm/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

            <button type="submit" id="postObservationSlipFormData_button" name="postObservationSlipFormData_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Observation Slip</button>
        </div>
        </form>
        </div>
    <?php
    }elseif((is_array($observationslipidupdate) && count($observationslipidupdate))) {
        foreach($observationslipidupdate as $observationslipformidupdate){

            $observationslipformid = $obervationslipformidupdate->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ObservationSlipForm/UpdateObservationSlipFormData" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="date" class="form-control" value="<?php echo $observationslipformidupdate->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
                    <input type="hidden" name="id" value="<?php echo $observationslipformidupdate->id;?>">
                </div>
            </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Station</span>
                        <input type="text" name="station" id="station" required class="form-control" value="<?php echo $observationslipformidupdate->StationName;?>"  readonly class="form-control" >

                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Station Number</span>
                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $observationslipformidupdate->StationNumber;?>" readonly="readonly" >
                    </div>
                </div>


            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME</span>
                    <input type="text" name="timeRecorded" required class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $observationslipformidupdate->TIME;?>" readonly="readonly" >

                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Total amount of all clouds</span>
                    <input type="text" name="totalamountofallclouds" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TotalAmountOfAllClouds;?>" id="totalamountofallclouds" required class="form-control" required placeholder=" Enter total amount of all clouds" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Total amount of low clouds</span>
                    <input type="text" name="totalamountoflowclouds" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TotalAmountOfLowClouds;?>" id="totalamountoflowclouds" required class="form-control" required placeholder="Enter total amount of all clouds" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TYPE LOW CLOUD</span>
                    <input type="text" name="TypeOfLowClouds" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TypeOfLowClouds;?>" id="TypeOfLowClouds"  class="form-control"  placeholder="Enter type of low cloud" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">OKTAS LOW CLOUD</span>
                    <input type="text" name="OktasOfLowClouds" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->OktasOfLowClouds;?>" id="OktasOfLowClouds"  class="form-control" placeholder="Enter OKTAS LOW CLOUD" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">HEIGHT OF LOW CLOUDS</span>
                    <input type="text" name="HeightOfLowClouds"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->HeightOfLowClouds;?>" id="HeightOfLowClouds"  class="form-control" placeholder=" Enter HEIGHT LOW CLOUD " >

                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">CL CODE</span>
                    <input type="text" name="CLCODEOfLowClouds" onkeyup="allowCharactersInputOnly(this)"  value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds;?>" id="CLCODEOfLowClouds"  class="form-control" placeholder=" Enter CL CODE LOW CLOUD " >

                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TYPE MEDIUM CLOUD</span>
                    <input type="text" name="TypeOfMediumClouds"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TypeOfMediumClouds;?>" id="TypeOfMediumClouds"  class="form-control"  placeholder="Enter TYPE MEDIUM CLOUD" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">OKTAS MEDIUM CLOUD</span>
                    <input type="text" name="OktasOfMediumClouds" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->OktasOfMediumClouds;?>" id="OktasOfMediumClouds"  class="form-control" placeholder="Enter OKTAS MEDIUM CLOUD" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">HEIGHT MEDIUM CLOUD</span>
                    <input type="text" name="HeightOfMediumClouds"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds;?>" id="HeightOfMediumClouds"  class="form-control" placeholder=" Enter HEIGHT MEDIUM CLOUD " >

                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">CL CODE MEDIUM CLOUD</span>
                    <input type="text" name="CLCODEOfMediumClouds"  onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds;?>" id="CLCODEOfMediumClouds"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >

                </div>
            </div>


            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TYPE HIGH CLOUD</span>
                    <input type="text" name="TypeOfHighClouds" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TypeOfHighClouds;?>" id="TypeOfHighClouds" class="form-control"  placeholder="Enter TYPE HIGH CLOUD" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">OKTAS HIGH CLOUD</span>
                    <input type="text" name="OktasOfHighClouds" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->OktasOfHighClouds;?>" id="OktasOfHighClouds"  class="form-control" placeholder="Enter OKTAS HIGH CLOUD" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">HEIGHT HIGH CLOUD</span>
                    <input type="text" name="HeightOfHighClouds"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->HeightOfHighClouds;?>" id="HeightOfHighClouds"  class="form-control" placeholder=" Enter HEIGHT HIGH CLOUD " >

                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">CL CODE HIGH CLOUD</span>
                    <input type="text" name="CLCODEOfHighClouds" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->CLCODEOfHighClouds;?>"  id="CLCODEOfHighClouds"  class="form-control" placeholder=" Enter CL CODE HIGH CLOUD " >

                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Cloud Searchlight Alidade Reading</span>
                    <input type="text" name="cloudsearchlight" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->CloudSearchLightReading;?>" id="cloudsearchlight"  class="form-control" placeholder="Enter Cloud Searchlight Alidade Reading" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Rainfall(mm)</span>
                    <input type="text" name="rainfall"  value="<?php echo $observationslipformidupdate->Rainfall;?>" id="rainfall"  class="form-control" placeholder="Enter Rainfall(mm)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Dry Bulb</span>
                    <input type="text" name="drybulb" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Dry_Bulb;?>" id="drybulb" required class="form-control" required placeholder="Enter Dry Bulb" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Wet Bulb</span>
                    <input type="text" name="wetbulb" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Wet_Bulb;?>" id="wetbulb" required class="form-control" required placeholder="Enter Wet Bulb" >
                </div>
            </div>


            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">MAX Read</span>
                    <input type="text" name="maxRead"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Max_Read;?>" id="maxRead"  class="form-control"  placeholder="Enter MAX READ" >
                </div>
            </div>


            </div>
            <div class="col-lg-6">





                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">MAX Reset</span>
                        <input type="text" name="maxReset" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->Max_Reset;?>"id="maxReset"  class="form-control"  placeholder="Enter MAX RESET" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">MIN Read</span>
                        <input type="text" name="minRead" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Min_Read;?>" id="minRead"  class="form-control"  placeholder="Enter MIN READ" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">MIN Reset</span>
                        <input type="text" name="minReset" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Min_Reset;?>" id="minReset"  class="form-control"  placeholder="Enter MIN RESET" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">PICHE Read</span>
                        <input type="text" name="picheRead" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->Piche_Read;?>" id="picheRead"  class="form-control" placeholder="Enter PICHE READ" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">PICHE Reset</span>
                        <input type="text" name="picheReset" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Piche_Reset;?>" id="picheReset"  class="form-control" placeholder="Enter PICHE RESET" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME MARKS THERMO</span>
                        <input type="text" name="timemarksThermo" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TimeMarksThermo;?>" id="timemarksThermo"  class="form-control" placeholder="Enter TIME MARKS THERMO" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME MARKS HYGRO</span>
                        <input type="text" name="timemarksHygro" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksHygro;?>" id="timemarksHygro"  class="form-control" placeholder="Enter TIME MARKS HYGRO" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME MARKS RAIN REC</span>
                        <input type="text" name="timemarksRainRec" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksRainRec;?>" id="timemarksRainRec"  class="form-control" placeholder="Enter TIME MARKS RAIN REC" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">PRESENT WEATHER</span>
                        <input type="text" name="presentweather" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->Present_Weather;?>" id="presentweather"  class="form-control" placeholder="Enter PRESENT WEATHER" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">VISIBILITY</span>
                        <input type="text" name="visibility" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Visibility;?>" id="visibility" required class="form-control" required placeholder="Enter VISIBILITY" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WIND DIRECTION</span>
                        <input type="text" name="winddirection"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Wind_Direction;?>" id="winddirection" required class="form-control" required placeholder="Enter WIND DIRECTION" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WIND SPEED(KTS)</span>
                        <input type="text" name="windspeed" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->Wind_Speed;?>" id="windspeed" required class="form-control" required placeholder="Enter WIND SPEED(KTS)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">GUSTING(KTS)</span>
                        <input type="text" name="gusting" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Gusting;?>" id="gusting"  class="form-control" placeholder="Enter GUSTING (KTS)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Attd.Thermo.(C)</span>
                        <input type="text" name="attdThermo" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->AttdThermo;?>" id="attdThermo"  class="form-control" placeholder="Enter ATTD.THERMO." >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Pr.As Read(C)</span>
                        <input type="text" name="prAsRead" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->PrAsRead;?>" id="prAsRead"  class="form-control" placeholder="Enter Pr.As Read" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Correction</span>
                        <input type="text" name="correction" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Correction;?>" id="correction"  class="form-control" placeholder="Enter Correction" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">C.L.P(mb)</span>
                        <input type="text" name="CLP" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->CLP;?>" id="CLP"  class="form-control" placeholder="Enter C.L.P(mb)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">M.S.L.Pr(mb) or 850mb. Ht.(gpm)</span>
                        <input type="text" name="MSLPR" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->MSLPr;?>" id="MSLPR"  class="form-control" placeholder="Enter M.S.L.Pr(mb) or 850mb. Ht.(gpm)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME MARKS BAROGRAPH</span>
                        <input type="text" name="timeMarksBarograph" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TimeMarksBarograph;?>" id="timeMarksBarograph"  class="form-control" placeholder="Enter TIME MARKS BAROGRAPH" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME MARKS ANEMOGRAPH</span>
                        <input type="text" name="timeMarksAnemograph" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksAnemograph;?>" id="timeMarksAnemograph"  class="form-control" placeholder="Enter TIME MARKS ANEMOGRAPH" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Other T/MARKS </span>
                        <input type="text" name="otherTMarks" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->OtherTMarks;?>" id="otherTMarks"  class="form-control" placeholder="Enter Other T/MARKS" >
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Remarks or any other Observations </span>
                        <input type="text" name="remarks" onkeyup="allowCharactersInputOnly(this)"  value="<?php echo $observationslipformidupdate->Remarks;?>" id="remarks"  class="form-control" placeholder="Enter Remarks or any other Observations" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Approved</span>
                        <select name="approval" id="approval"  required class="form-control">
                            <option value="<?php echo $observationslipformidupdate->Approved;?>"><?php echo $observationslipformidupdate->Approved;?></option>
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

                <a href="<?php echo base_url()."index.php/ObservationSlipForm/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updateObservationSlipFormData_button" id="updateObservationSlipFormData_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Observation Slip</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ObservationSlipForm/DisplayNewObservationSlipForm/">
                    <i class="fa fa-plus"></i> Add new Observation Slip</a>



            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Observation Slip</h3>
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
                                <th>Dry Bulb</th>
                                <th>Wet Bulb</th>
                                <th>Present Weather</th>
                                <th>Visibility</th>
                                <th>Wind Direction</th>
                                <th>Wind Speed</th>

                                <th>Rainfall (mm)</th>
                                <th>Gusting </th>
                                <th>Max Read</th>
                                <th>Min Read</th>
                                <th>Piche Read</th>
                                <th>Approved</th>
                                <th>By</th>

                                <?php if($userrole=='OC' || $userrole=='Observer' ){ ?>

                                    <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($observationslipformdata) && count($observationslipformdata)) {
                                foreach($observationslipformdata as $observationslipdata){
                                    $count++;
                                    $observationslipid = $observationslipdata->id;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $observationslipdata->Date;?></td>
                                        <td ><?php echo $observationslipdata->StationName;?></td>
                                        <td ><?php echo $observationslipdata->StationNumber;?></td>
                                        <td ><?php echo $observationslipdata->TIME;?></td>
                                        <td ><?php echo $observationslipdata->Dry_Bulb;?></td>
                                        <td ><?php echo $observationslipdata->Wet_Bulb;?></td>
                                        <td ><?php echo $observationslipdata->Present_Weather;?></td>
                                        <td ><?php echo $observationslipdata->Visibility;?></td>
                                        <td ><?php echo $observationslipdata->Wind_Direction;?></td>
                                        <td><?php echo $observationslipdata->Wind_Speed;?></td>
                                        <td><?php echo $observationslipdata->Rainfall;?></td>


                                        <td ><?php echo $observationslipdata->Gusting;?></td>
                                        <td ><?php echo $observationslipdata->Max_Read;?></td>
                                        <td><?php echo $observationslipdata->Min_Read;?></td>
                                        <td><?php echo $observationslipdata->Piche_Read;?></td>

                                        <td><?php echo $observationslipdata->Approved;?></td>

                                        <td><?php echo $observationslipdata->SubmittedBy;?></td>
                                        <?php if( $userrole=='OC' || $userrole=='Observer'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/ObservationSlipForm/DisplayObservationSlipFormForUpdate/" .$observationslipid ;?>" style="cursor:pointer;">Edit</a>
                                         <!--   or <a href="<?php echo base_url() . "index.php/ObservationSlipForm/deleteObservationSlipFormData/" .$observationslipid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $observationslipdata->StationName;?>');">Delete</a></td><?php }?> -->
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
            $('#postObservationSlipFormData_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddObservationSlipFormData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Observation Slip Record With the date,station,station Number and Time exists already in the db");
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
                var station=$('#station_observationslipform').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_observationslipform').val("");  //Clear the field.
                    $("#station_observationslipform").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_observationslipform').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_observationslipform').val("");  //Clear the field.
                    $("#stationNo_observationslipform").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_observationslipform=$('#time_observationslipform').val();
                if(time_observationslipform==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  METAR not picked");
                    $('#time_observationslipform').val("");  //Clear the field.
                    $("#time_observationslipform").focus();
                    return false;

                }


///////////////////////////////////////////////////////////////////////////////////

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddObservationSlipFormData(){

            //Check against the date,stationName,StationNumber,Time
            var date= $('#date').val();


            var stationName = $('#station_observationslipform').val();
            var stationNumber= $('#stationNo_observationslipform').val();

            var time_OfObservationSlipForm = $('#time_observationslipform').val();


            $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').val("");

            if ((date != undefined) && (time_OfObservationSlipForm != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ObservationSlipForm/checkInDBIfObservationSlipFormRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time_OfObservationSlipForm':time_OfObservationSlipForm,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").val();

            }//end of if

            else if((date == undefined) || (time_OfObservationSlipForm == undefined) || (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB When the fields are not picked frm the DB
            //Validate each field before inserting into the DB
            $('#updateObservationSlipFormData_button').click(function(event) {
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
                var timeRecorded=$('#timeRecorded').val();
                if(timeRecorded==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  METAR not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }


///////////////////////////////////////////////////////////////////////////////////
                //Check that REWIW1 IS PICKED FROM A LIST
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
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_totalamountofallclouds;
            var oldValue_totalamountofallclouds=$('#totalamountofallclouds').val();

            $('#totalamountofallclouds').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_totalamountofallclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#totalamountofallclouds').val(newValue_totalamountofallclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#totalamountofallclouds').val(oldValue_totalamountofallclouds);
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
            var newValue_totalamountoflowclouds;
            var oldValue_totalamountoflowclouds=$('#totalamountoflowclouds').val();

            $('#totalamountoflowclouds').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_totalamountoflowclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#totalamountoflowclouds').val(newValue_totalamountoflowclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#totalamountoflowclouds').val(oldValue_totalamountoflowclouds);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_TypeOfLowClouds ;
            var oldValue_TypeOfLowClouds= $('#TypeOfLowClouds').val()

            $('#TypeOfLowClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_TypeOfLowClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#TypeOfLowClouds').val(newValue_TypeOfLowClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#TypeOfLowClouds').val(oldValue_TypeOfLowClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_OktasOfLowClouds ;
            var oldValue_OktasOfLowClouds= $('#OktasOfLowClouds').val()

            $('#OktasOfLowClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_OktasOfLowClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#OktasOfLowClouds').val(newValue_OktasOfLowClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#OktasOfLowClouds').val(oldValue_OktasOfLowClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds ;
            var oldValue_HeightOfLowClouds= $('#HeightOfLowClouds').val()

            $('#HeightOfLowClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds').val(newValue_HeightOfLowClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds').val(oldValue_HeightOfLowClouds);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_CLCODEOfLowClouds ;
            var oldValue_CLCODEOfLowClouds= $('#CLCODEOfLowClouds').val()

            $('#CLCODEOfLowClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_CLCODEOfLowClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CLCODEOfLowClouds').val(newValue_CLCODEOfLowClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CLCODEOfLowClouds').val(oldValue_CLCODEOfLowClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_TypeOfMeduimClouds ;
            var oldValue_TypeOfMeduimClouds= $('#TypeOfMeduimClouds').val()

            $('#TypeOfMeduimClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_TypeOfMeduimClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#TypeOfMeduimClouds').val(newValue_TypeOfMeduimClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#TypeOfMeduimClouds').val(oldValue_TypeOfMeduimClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_OktasOfMeduimClouds ;
            var oldValue_OktasOfMeduimClouds= $('#OktasOfMeduimClouds').val()

            $('#OktasOfMeduimClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_OktasOfMeduimClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#OktasOfMeduimClouds').val(newValue_OktasOfMeduimClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#OktasOfMeduimClouds').val(oldValue_OktasOfMeduimClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds ;
            var oldValue_HeightOfMeduimClouds= $('#HeightOfMeduimClouds').val()

            $('#HeightOfMeduimClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds').val(newValue_HeightOfMeduimClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds').val(oldValue_HeightOfMeduimClouds);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_CLCODEOfMeduimClouds ;
            var oldValue_CLCODEOfMeduimClouds= $('#CLCODEOfMeduimClouds').val()

            $('#CLCODEOfMeduimClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_CLCODEOfMeduimClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CLCODEOfMeduimClouds').val(newValue_CLCODEOfMeduimClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CLCODEOfMeduimClouds').val(oldValue_CLCODEOfMeduimClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_TypeOfHighClouds ;
            var oldValue_TypeOfHighClouds= $('#TypeOfHighClouds').val()

            $('#TypeOfHighClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_TypeOfHighClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#TypeOfHighClouds').val(newValue_TypeOfHighClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#TypeOfHighClouds').val(oldValue_TypeOfHighClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_OktasOfHighClouds ;
            var oldValue_OktasOfHighClouds= $('#OktasOfHighClouds').val()

            $('#OktasOfHighClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_OktasOfHighClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#OktasOfHighClouds').val(newValue_OktasOfHighClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#OktasOfHighClouds').val(oldValue_OktasOfHighClouds);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds ;
            var oldValue_HeightOfHighClouds= $('#HeightOfHighClouds').val()

            $('#HeightOfHighClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds').val(newValue_HeightOfHighClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds').val(oldValue_HeightOfHighClouds);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_CLCODEOfHighClouds ;
            var oldValue_CLCODEOfHighClouds= $('#CLCODEOfHighClouds').val()

            $('#CLCODEOfHighClouds').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_CLCODEOfHighClouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CLCODEOfHighClouds').val(newValue_CLCODEOfHighClouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CLCODEOfHighClouds').val(oldValue_CLCODEOfHighClouds);
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
            var newValue_cloudsearchlight;
            var oldValue_cloudsearchlight= $('#cloudsearchlight').val()

            $('#cloudsearchlight').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_cloudsearchlight = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudsearchlight').val(newValue_cloudsearchlight);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudsearchlight').val(oldValue_cloudsearchlight);
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
            var newValue_rainfall;
            var oldValue_rainfall= $('#rainfall').val();

            $('#rainfall').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_rainfall = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rainfall').val(newValue_rainfall);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rainfall').val(oldValue_rainfall);
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
            var newValue_drybulb;
            var oldValue_drybulb= $('#drybulb').val();

            $('#drybulb').live('change paste', function(){
                //oldValue_airtemperature = newValue_airtemperature;
                newValue_drybulb = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#drybulb').val(newValue_drybulb);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#drybulb').val(oldValue_drybulb);
                    return false;
                }

            });
        });
    </script>
    /////////////////////////////////////////////////////////////////////////////////////////
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_wetbulb;
            var oldValue_wetbulb= $('#wetbulb').val();

            $('#wetbulb').live('change paste', function(){
                oldValue_wetbulb = newValue_wetbulb;
                newValue_wetbulb = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wetbulb').val(newValue_wetbulb);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wetbulb').val(oldValue_wetbulb);
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
            var newValue_maxRead;
            var oldValue_maxRead= $('#maxRead').val()

            $('#maxRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_maxRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxRead').val(newValue_maxRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxRead').val(oldValue_maxRead);
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
            var newValue_maxReset;
            var oldValue_maxReset= $('#maxReset').val()

            $('#maxReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_maxReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxReset').val(newValue_maxReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxReset').val(oldValue_maxReset);
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
            var newValue_minRead;
            var oldValue_minRead= $('#minRead').val()

            $('#minRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_minRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minRead').val(newValue_minRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minRead').val(oldValue_minRead);
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
            var newValue_minReset;
            var oldValue_minReset= $('#minReset').val()

            $('#minReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_minReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minReset').val(newValue_minReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minReset').val(oldValue_minReset);
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
            var newValue_picheRead;
            var oldValue_picheRead= $('#picheRead').val()

            $('#picheRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_picheRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#picheRead').val(newValue_picheRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#picheRead').val(oldValue_picheRead);
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
            var newValue_picheReset;
            var oldValue_picheReset= $('#picheReset').val()

            $('#picheReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_picheReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#picheReset').val(newValue_picheReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#picheReset').val(oldValue_picheReset);
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
            var newValue_timemarksThermo;
            var oldValue_timemarksThermo= $('#timemarksThermo').val();

            $('#timemarksThermo').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksThermo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksThermo').val(newValue_timemarksThermo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksThermo').val(oldValue_timemarksThermo);
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
            var newValue_timemarksHygro;
            var oldValue_timemarksHygro= $('#timemarksHygro').val();

            $('#timemarksHygro').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksHygro = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksHygro').val(newValue_timemarksHygro);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksHygro').val(oldValue_timemarksHygro);
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
            var newValue_timemarksRainRec;
            var oldValue_timemarksRainRec= $('#timemarksRainRec').val();

            $('#timemarksRainRec').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksRainRec = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksRainRec').val(newValue_timemarksRainRec);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksRainRec').val(oldValue_timemarksRainRec);
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
            var newValue_presentweather;
            var oldValue_presentweather= $('#presentweather').val();

            $('#presentweather').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_presentweather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#presentweather').val(newValue_presentweather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#presentweather').val(oldValue_presentweather);
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
            var newValue_visibility;
            var oldValue_visibility= $('#visibility').val();

            $('#visibility').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_visibility = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#visibility').val(newValue_visibility);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#visibility').val(oldValue_visibility);
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
            var newValue_winddirection;
            var oldValue_winddirection= $('#winddirection').val();

            $('#winddirection').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_winddirection = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddirection').val(newValue_winddirection);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddirection').val(oldValue_winddirection);
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
            var newValue_windspeed;
            var oldValue_windspeed= $('#windspeed').val();

            $('#windspeed').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_windspeed = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windspeed').val(newValue_windspeed);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windspeed').val(oldValue_windspeed);
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
            var newValue_gusting;
            var oldValue_gusting= $('#gusting').val();

            $('#gusting').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_gusting = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gusting').val(newValue_gusting);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gusting').val(oldValue_gusting);
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
            var newValue_attdThermo;
            var oldValue_attdThermo= $('#attdThermo').val();

            $('#attdThermo').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_attdThermo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#attdThermo').val(newValue_attdThermo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#attdThermo').val(oldValue_attdThermo);
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
            var newValue_prAsRead;
            var oldValue_prAsRead= $('#prAsRead').val();

            $('#prAsRead').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_prAsRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#prAsRead').val(newValue_prAsRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#prAsRead').val(oldValue_prAsRead);
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
            var newValue_correction;
            var oldValue_correction= $('#correction').val();

            $('#correction').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_correction = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#correction').val(newValue_correction);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#correction').val(oldValue_correction);
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
            var newValue_CLP;
            var oldValue_CLP= $('#CLP').val();

            $('#CLP').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_CLP = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CLP').val(newValue_CLP);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CLP').val(oldValue_CLP);
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
            var newValue_MSLPR;
            var oldValue_MSLPR= $('#MSLPR').val();

            $('#MSLPR').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_MSLPR = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#MSLPR').val(newValue_MSLPR);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#MSLPR').val(oldValue_MSLPR);
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
            var newValue_timeMarksBarograph;
            var oldValue_timeMarksBarograph= $('#timeMarksBarograph').val();

            $('#timeMarksBarograph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_timeMarksBarograph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timeMarksBarograph').val(newValue_timeMarksBarograph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timeMarksBarograph').val(oldValue_timeMarksBarograph);
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
            var newValue_timeMarksAnemograph;
            var oldValue_timeMarksAnemograph= $('#timeMarksAnemograph').val();

            $('#timeMarksAnemograph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_timeMarksAnemograph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timeMarksAnemograph').val(newValue_timeMarksAnemograph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timeMarksAnemograph').val(oldValue_timeMarksAnemograph);
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
            var newValue_otherTMarks;
            var oldValue_otherTMarks= $('#otherTMarks').val();

            $('#otherTMarks').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_otherTMarks = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#otherTMarks').val(newValue_otherTMarks);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#otherTMarks').val(oldValue_otherTMarks);
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
            var newValue_remarks;
            var oldValue_remarks= $('#remarks').val();

            $('#remarks').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_remarks = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#remarks').val(newValue_remarks);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#remarks').val(oldValue_remarks);
                    return false;
                }
            });
    );
    </script>

    <script type="text/javascript">
        //Once the Admin selects the Station the Station Number should be picked from the DB.
        // For Add Update Daily
        $(document).on('change','#stationManager_observationslipform',function(){
            $('#stationNoManager_observationslipform').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoManager_observationslipform').val("");
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

                            $('#stationNoManager_observationslipform').empty();

                            // alert(data);
                            $("#stationNoManager_observationslipform").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoManager_observationslipform').empty();
                            $('#stationNoManager_observationslipform').val("");

                        }
                    }

                });



            }
            else {

                $('#stationNoManager_observationslipform').empty();
                $('#stationNoManager_observationslipform').val("");
            }

        })
    </script>


<?php require_once(APPPATH . 'views/footer.php'); ?>