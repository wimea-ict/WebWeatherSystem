<?php require_once(APPPATH . 'views/header.php'); ?>
<?php
$session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Instruments
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Instruments</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewinstrumentsform) && count($displaynewinstrumentsform)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/StationInstruments/insertInstrument/"  method="post" enctype="multipart/form-data">
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
                    <div class="col-lg-8">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Instrument Name</span>
                                <input type="text" name="station_instrumentname" id="station_instrumentname" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="Enter instrument name" >
                                <input type="hidden" name="checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield" id="checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield">

                            </div>
                        </div>

                        <?php

                        if($userrole=='OC'){ ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station Name</span>
                                    <input type="text" name="stationinstrument_OC" id="stationinstrument_OC" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            </div>

                        <?php } elseif($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="stationinstrument_insertInstrument" id="stationinstrument_insertInstrument"  required  class="form-control" placeholder="Select Station">
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

                        <?php } ?>

                        <?php if($userrole=='OC'){ ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNoinstrument_OC" id="stationNoinstrument_OC" required class="form-control"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                  <!--  <input type="hidden" name="stationRegion_OC" id="stationRegion_OC" required class="form-control" value="<?php echo $StationRegion;?>"  readonly class="form-control" >  -->

                                </div>
                            </div>

                        <?php }elseif($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNoinstrument_insertInstrument" required class="form-control" id="stationNoinstrument_insertInstrument" readonly class="form-control" value="" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                  <!--  <input type="hidden" name="stationRegion_insertInstrument" id="stationRegion_insertInstrument" required class="form-control" value=""  readonly class="form-control" > -->

                                </div>
                            </div>
                        <?php }?>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Instrument Code</span>
                                <input type="text" name="station_instrumentcode" id="station_instrumentcode" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter code " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Manufacturer</span>
                                <input type="text" name="station_instrumentmanufacturer" id="station_instrumentmanufacturer" onkeyup="allowCharactersInputOnly(this)" required class="form-control" placeholder="Enter manufacturer " >
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Date Registered</span>
                                <input type="text" name="station_instrumentdateregistered"  id="date" required class="form-control" placeholder="Enter date registered" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Expiry Date</span>
                                <input type="text" name="station_instrumentexpirydate" id="expdate" required class="form-control" placeholder="Enter expiry date " >
                            </div>
                        </div>





                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="station_instrumentdescription" id="station_instrumentdescription" onkeyup="allowCharactersInputOnly(this)" class="form-control" style="height:40px;" ></textarea>

                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <center>

                    <a href="<?php echo base_url(); ?>index.php/StationInstruments/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>

                    <button type="submit" id="post_StationInstrumentInformation_button" name="post_StationInstrumentInformation_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT </button>
                </center>
            </form>
        </div>
    <?php
    }elseif((is_array($stationinstrumentdataid) && count($stationinstrumentdataid))) {
        foreach($stationinstrumentdataid as $instrumentdata){

            $instrumentformid = $instrumentdata->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/StationInstruments/updateInstrument" method="post" enctype="multipart/form-data">
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
                        <div class="col-lg-8">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Instrument Name</span>
                                    <input type="text" name="instrumentname" id="instrumentname" required class="form-control" required value="<?php echo $instrumentdata->InstrumentName;?>" placeholder="Enter instrument name"  onkeyup="allowCharactersInputOnly(this)" readonly class="form-control">
                                    <input type="hidden" name="id" id="id" value="<?php echo $instrumentdata->id;?>">
                                </div>
                            </div>

                            <?php if($userrole=='OC'){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="station_OC" id="station_OC" required class="form-control" value="<?php echo $instrumentdata->StationName;?>"  readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" >

                                    </div>
                                </div>

                            <?php }else if($userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="station_updateInstrument" id="station_updateInstrument" required class="form-control" value="<?php echo $instrumentdata->StationName;?>"  readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" >

                                    </div>
                                </div>

                            <?php } ?>
                            <?php if($userrole=='OC'){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo_OC" required class="form-control" id="stationNo_OC" readonly class="form-control" value="<?php echo $instrumentdata->StationNumber;?>" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                      <!--  <input type="hidden" name="stationRegion_OC_updateInstrument" id="stationRegion_OC_updateInstrument" required class="form-control" value="<?php echo  $instrumentdata->StationRegion;?>"  readonly class="form-control" > -->

                                    </div>
                                </div>

                            <?php }elseif($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Numberoo</span>
                                        <input type="text" name="stationNo_updateInstrument" required class="form-control" id="stationNo_updateInstrument" readonly class="form-control" value="<?php echo $instrumentdata->StationNumber;?>" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                       <!-- <input type="hidden" name="stationRegion_updateInstrument" id="stationRegion_updateInstrument" required class="form-control" value="<?php echo  $instrumentdata->StationRegion;?>"  readonly class="form-control" > -->

                                    </div>
                                </div>
                            <?php }?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Code</span>
                                    <input type="text" name="instrumentcode" id="instrumentcode" onkeyup="allowIntegerInputOnly(this)" readonly class="form-control" required class="form-control" value="<?php echo $instrumentdata->InstrumentCode;?>" placeholder="Enter code " readonly="readonly"  >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Manufacturer</span>
                                    <input type="text" name="instrumentmanufacturer" id="instrumentmanufacturer" onkeyup="allowCharactersInputOnly(this)" required class="form-control" value="<?php echo $instrumentdata->Manufacturer;?>" placeholder="Enter manufacturer " >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Date Registered</span>
                                    <input type="text" name="instrumentdateregistered" id="closed" required class="form-control" value="<?php echo $instrumentdata->DateRegistered;?>" placeholder="Enter date registered" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Expiry Date</span>
                                    <input type="text" name="instrumentexpirydate" id="opened" required class="form-control" placeholder="Enter expiry date " value="<?php echo $instrumentdata->ExpirationDate;?>" >
                                </div>
                            </div>



                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="instrumentdescription" id="instrumentdescription" onkeyup="allowCharactersInputOnly(this)" class="form-control" style="height:40px;" ><?php echo $instrumentdata->Description;?></textarea>

                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <center>

                <a  href="<?php echo base_url(); ?>index.php/StationInstruments/" class="btn btn-danger"><i class="fa fa-times"></i> BACK </a>

                <button type="submit" name="update_StationInstrumentInformation_button" id="update_StationInstrumentInformation_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
            </center>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/StationInstruments/DisplayStationInstrumentForm/">
                    <i class="fa fa-plus"></i> Add Station Instrument</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Stations</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Instrument Name</th>
                                <!--<th>Element Name</th> -->
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Instrument Code</th>
                                <th>Manufacturer</th>
                                <th>Description</th>
                                <th>Date Registered</th>
                                <th>Expiry Date</th>
                                <?php if( $userrole=="OC" || $userrole=="Manager"){ ?><th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($instruments) && count($instruments)) {
                                foreach($instruments as $instrumentdata){
                                    $count++;
                                    $instrumentid = $instrumentdata->id;


                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $instrumentdata->InstrumentName;?></td>
                                        <!-- <td ><?php echo $instrumentdata->ElementName;?></td> -->
                                        <td ><?php echo $instrumentdata->StationName;?></td>
                                        <td ><?php echo $instrumentdata->StationNumber;?></td>
                                        <td ><?php echo $instrumentdata->InstrumentCode;?></td>
                                        <td><?php echo $instrumentdata->Manufacturer;?></td>
                                        <td><?php echo $instrumentdata->Description;?></td>
                                        <td ><?php echo $instrumentdata->DateRegistered;?></td>
                                        <td><?php echo $instrumentdata->ExpirationDate;?></td>
                                        <?php if( $userrole=='OC' || $userrole=="Manager"){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/StationInstruments/DisplayStationInstrumentFormForUpdate/" .$instrumentid ;?>" style="cursor:pointer;">Edit</a>
                                            <!--   or <a href="<?php echo base_url() . "index.php/Stations/deleteStation/" .$instrumentid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $instrumentid->InstrumentName;?>');">Delete</a></td><?php }?> -->
                                    </tr>

                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button>
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
            $('#post_StationInstrumentInformation_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddStationInstrumentData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Instrument Record With the same instrument name,station,station Number and Code exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }



                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield").focus();
                    return false;

                }

                //Check that the a station is selecteManagerm the list of stations(AdmiManager
                var station=$('#stationinstrument_insertInstrument').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationinstrument_insertInstrument').val("");  //Clear the field.
                    $("#stationinstrument_insertInstrument").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNoinstrument_insertInstrument').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoinstrument_insertInstrument').val("");  //Clear the field.
                    $("#stationNoinstrument_insertInstrument").focus();
                    return false;

                }
                var stationRegion=$('#stationRegion_insertInstrument').val();
                if (stationRegion==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_insertInstrument').val("");  //Clear the field.
                    $("#stationRegion_insertInstrument").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var station_OC=$('#stationinstrument_OC').val();
                if(station_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#stationinstrument_OC').val("");  //Clear the field.
                    $("#stationinstrument_OC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo_OC=$('#stationNoinstrument_OC').val();
                if(stationNo_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoinstrument_OC').val("");  //Clear the field.
                    $("#stationNoinstrument_OC").focus();
                    return false;

                }
                var stationRegion_OC=$('#stationRegion_OC').val();
                if (stationRegion_OC==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_OC').val("");  //Clear the field.
                    $("#stationRegion_OC").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that Date selected
                var station_instrumentdateregistered=$('#date').val();
                if(station_instrumentdateregistered==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date when the instrument was registered");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }
                //Check that Date selected
                var station_instrumentexpirydate=$('#expdate').val();
                if(station_instrumentexpirydate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date when the instrument will expire");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddStationInstrumentData(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var instrumentname = $('#station_instrumentname').val();
            var stationNameOC = $('#stationinstrument_OC').val();
            var stationNumberOC = $('#stationNoinstrument_OC').val();

            var stationNameManager = $('#stationinstrument_insertInstrument').val();
            var stationNumberManager = $('#stationNoinstrument_insertInstrument').val();


            if((stationNameOC!=undefined) && (stationNumberOC!=undefined)){

                var stationName=stationNameOC;
                var stationNumber=stationNumberOC;


            }else if((stationNameManager!=undefined) && (stationNumberManager!=undefined)){
                var stationName=stationNameManager;
                var stationNumber=stationNumberManager;

            }

            var stationinstrumentcode = $('#station_instrumentcode').val();


            $('#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield').val("");

            if ((instrumentname != undefined) && (stationinstrumentcode != undefined) && (stationName != undefined) && (stationNumber != undefined)   ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/StationInstruments/checkInDBIfStationInstrumentCodeInformationRecordExistsAlready",
                    type: "POST",
                    data:{'instrumentname':instrumentname,'stationinstrumentcode':stationinstrumentcode,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield").val();

            }//end of if

            else if((instrumentname == undefined) || (stationinstrumentcode == undefined) || (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#update_StationInstrumentInformation_button').click(function(event) {




                //Check that id of the row is picked
                var rowid=$('#id').val();
                if(rowid==""){  // returns true if the variable does NOT contain a valid number
                    alert("Row id not picked");
                    $('#id').val("");  //Clear the field.
                    $("#id").focus();
                    return false;

                }



                //Check that Date selected
                var instrumentName=$('#instrumentname').val();
                if(instrumentName==""){  // returns true if the variable does NOT contain a valid number
                    alert("Instrument Name not picked");
                    $('#instrumentname').val("");  //Clear the field.
                    $("#instrumentname").focus();
                    return false;

                }


                //Check that Date selected
                var instrumentCode=$('#instrumentcode').val();
                if(instrumentCode==""){  // returns true if the variable does NOT contain a valid number
                    alert("Instrument Code not picked");
                    $('#instrumentcode').val("");  //Clear the field.
                    $("#instrumentcode").focus();
                    return false;

                }
                //Check that the a station is selected from the list Managerations(Admin)
                var station=('#station_updateInstrument').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#station_updateInstrument').val("");  //Clear the field.
                    $("#station_updateInstrument").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_updateInstrument').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_updateInstrument').val("");  //Clear the field.
                    $("#stationNo_updateInstrument").focus();
                    return false;

                }
                var stationRegion=$('#stationRegion_updateInstrument').val();
                if (stationRegion==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_updateInstrument').val("");  //Clear the field.
                    $("#stationRegion_updateInstrument").focus();
                    return false;

                }
/////////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the a station is selected from the list of stations(Manager)
                var station_OC=$('#station_OC').val();
                if(station_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_OC').val("");  //Clear the field.
                    $("#station_OC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo_OC=$('#stationNo_OC').val();
                if(stationNo_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_OC').val("");  //Clear the field.
                    $("#stationNo_OC").focus();
                    return false;

                }
                var stationRegion_OC=$('#stationRegion_OC_updateInstrument').val();
                if (stationRegion_OC==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_OC_updateInstrument').val("");  //Clear the field.
                    $("#stationRegion_OC_updateInstrument").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var instrumentdateregistered=$('#closed').val();
                if(instrumentdateregistered==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select date when instrument was registered");
                    $('#closed').val("");  //Clear the field.
                    $("#closed").focus();
                    return false;

                }

////////////////////////////////////////////////////////////////////////////////////////////
                //Check that METAR/SPECI IS PICKED FROM A LIST
                var instrumentexpirydate=$('#opened').val();
                if(instrumentexpirydate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select date when the instrument will expiry.");
                    $('#opened').val("");  //Clear the field.
                    $("#opened").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////

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
            var newValue_instrumentmanufacturer;
            var oldValue_instrumentmanufacturer=$('#instrumentmanufacturer').val();

            $('#instrumentmanufacturer').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_instrumentmanufacturer = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#instrumentmanufacturer').val(newValue_instrumentmanufacturer);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#instrumentmanufacturer').val(oldValue_instrumentmanufacturer);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_instrumentdescription;
            var oldValue_instrumentdescription= $('#instrumentdescription').val()

            $('#instrumentdescription').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_instrumentdescription = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#instrumentdescription').val(newValue_instrumentdescription);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#instrumentdescription').val(oldValue_instrumentdescription);
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript">
        //Once the Manager selects the Station the Station Region should be picked from the DB.
        //Add Element.
        $(document.body).on('change','#stationinstrument_insertInstrument',function(){
            $('#stationNoinstrument_insertInstrument').val("");  //Clear the field.
            var stationName = this.value;
            if (stationName != "") {
                //alert(station);
                $('#stationNoinstrument_insertInstrument').val("");
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

                            $('#stationNoinstrument_insertInstrument').empty();

                            // alert(data);
                            $("#stationNoinstrument_insertInstrument").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoinstrument_insertInstrument').empty();
                            $('#stationNoinstrument_insertInstrument').val("");
                        }
                    }
                });
            }
            else {

                $('#stationNoinstrument_insertInstrument').empty();
                $('#stationNoinstrument_insertInstrument').val("");
            }
        })
    </script>
    <script type="text/javascript">
        //Once the Manager/Zonal Officer/Senior Zonal Officer loads the page the value of Selected Station is displayed.So Get the StationNumber from the DB.
        //On Update Instrument
        var stationName = $("#station_updateInstrument").val();
        $('#stationNo_updateInstrument').val("");  //Clear the field.

        if (stationName != "") {
            //alert(station);
            $('#stationNo_updateInstrument').val("");
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

                        $('#stationNo_updateInstrument').empty();

                        // alert(data);
                        $("#stationNo_updateInstrument").val(json[0].StationNumber);

                    }
                    else{

                        $('#stationNo_updateInstrument').empty();
                        $('#stationNo_updateInstrument').val("");

                    }
                }

            });
        }
        else {

            $('#stationNo_updateInstrument').empty();
            $('#stationNo_updateInstrument').val("");
        }
    </script>


<?php require_once(APPPATH . 'views/footer.php'); ?>
