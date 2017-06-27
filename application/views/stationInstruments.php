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
                                <input type="text" name="stationinstrumentname" id="stationinstrumentname" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="Enter instrument name" >
                                <input type="hidden" name="checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield" id="checkduplicateEntryOnAddNewStationInstrumentData_hiddentextfield">

                            </div>
                        </div>

                        <?php

                        if($userrole=='OC'){ ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="stationinstrumentOC" id="stationinstrumentOC" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            </div>

                        <?php } elseif($userrole=='Manager'){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="stationinstrumentManager" id="stationinstrumentManager"  required  class="form-control" placeholder="Select Station">
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
                                    <input type="text" name="stationNoinstrumentOC" required class="form-control" id="stationNoinstrumentOC" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                </div>
                            </div>

                        <?php }elseif($userrole=='Manager'){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNoinstrumentManager" required class="form-control" id="stationNoinstrumentManager" readonly class="form-control" value="" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                </div>
                            </div>
                        <?php }?>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Instrument Code</span>
                                <input type="text" name="stationinstrumentcode" id="stationinstrumentcode" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter code " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Manufacturer</span>
                                <input type="text" name="stationinstrumentmanufacturer" id="stationinstrumentmanufacturer" onkeyup="allowCharactersInputOnly(this)" required class="form-control" placeholder="Enter manufacturer " >
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Date Registered</span>
                                <input type="text" name="stationinstrumentdateregistered"  id="date" required class="form-control" placeholder="Enter date registered" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Expiry Date</span>
                                <input type="text" name="stationinstrumentexpirydate" id="expdate" required class="form-control" placeholder="Enter expiry date " >
                            </div>
                        </div>





                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="stationinstrumentdescription" id="stationinstrumentdescription" onkeyup="allowCharactersInputOnly(this)" class="form-control" style="height:150px;" ></textarea>

                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/StationInstruments/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="post_StationInstrumentInformation_button" name="post_StationInstrumentInformation_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Instrument</button>
                </div>
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
                                    <input type="hidden" name="id" value="<?php echo $instrumentdata->id;?>">
                                </div>
                            </div>

                            <?php if($userrole=='OC'){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="stationOC" id="stationOC" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" >

                                    </div>
                                </div>

                            <?php }else if($userrole=='Manager'){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="stationManager" id="stationManager" required class="form-control" value="<?php echo $instrumentdata->StationName;?>"  readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" >

                                    </div>
                                </div>

                            <?php } ?>
                            <?php if($userrole=='OC'){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNoOC" required class="form-control" id="stationNoOC" readonly class="form-control" value="<?php echo $instrumentdata->StationNumber;?>" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
                                    </div>
                                </div>

                            <?php }elseif($userrole=='Manager'){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNoManager" required class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $instrumentdata->StationNumber;?>" readonly="readonly" onkeyup="allowIntegerInputOnly(this)" >
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
                                <textarea name="instrumentdescription" id="instrumentdescription" onkeyup="allowCharactersInputOnly(this)" class="form-control" style="height:150px;" ><?php echo $instrumentdata->Description;?></textarea>

                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/StationInstruments/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="update_StationInstrumentInformation_button" id="update_StationInstrumentInformation_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Instrument</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/StationInstruments/DisplayStationInstrumentForm/">
                    <i class="fa fa-plus"></i> Add new Station Instrument</a>

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
                                            or <a href="<?php echo base_url() . "index.php/Stations/deleteStation/" .$instrumentid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $instrumentid->InstrumentName;?>');">Delete</a></td><?php }?>
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




                //Check that the a station is selecteManagerm the list of stations(AdmiManager
                 var stationManager=$('#stationinstrumentManager').val();
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
               $('#stationinstrumentManager').val("");  //Clear the field.
               $("#stationinstrumentManager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoManager=$('#stationNoinstrumentManager').val();
                if(stationNoManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoinstrumentManager').val("");  //Clear the field.
                    $("#stationNoinstrumentManager").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var stationOC=$('#stationinstrumentOC').val();
                if(stationOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#stationinstrumentOC').val("");  //Clear the field.
                    $("#stationinstrumentOC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoOC=$('#stationNoinstrumentOC').val();
                if(stationNoOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoinstrumentOC').val("");  //Clear the field.
                    $("#stationNoinstrumentOC").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that Date selected
                var stationinstrumentdateregistered=$('#date').val();
                if(stationinstrumentdateregistered==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date when the instrument was registered");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }
                //Check that Date selected
                var stationinstrumentexpirydate=$('#expdate').val();
                if(stationinstrumentexpirydate==""){  // returns true if the variable does NOT contain a valid number
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
            var instrumentname = $('#stationinstrumentname').val();
       var stationNameOC = $('#stationinstrumentOC').val();
       var stationNumberOC = $('#stationNoinstrumentOC').val();

            var stationNameManager = $('#stationinstrumentManager').val();
            var stationNumberManager = $('#stationNoinstrumentManager').val();


       if((stationNameOC!=undefined) && (stationNumberOC!=undefined)){

                var stationName=stationNameOC;
                var stationNumber=stationNumberOC;


            }else if((stationNameManager!=undefined) && (stationNumberManager!=undefined)){
                var stationName=stationNameManager;
                var stationNumber=stationNumberManager;

            }

            var stationinstrumentcode = $('#stationinstrumentcode').val();


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
                var stationManager=('#stationManager').val();
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
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var instrumentdateregistered=$('#instrumentdateregistered').val();
                if(instrumentdateregistered==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select date when instrument was registered");
                    $('#instrumentdateregistered').val("");  //Clear the field.
                    $("#instrumentdateregistered").focus();
                    return false;

                }

////////////////////////////////////////////////////////////////////////////////////////////
                //Check that METAR/SPECI IS PICKED FROM A LIST
                var instrumentexpirydate=$('#instrumentexpirydate').val();
                if(instrumentexpirydate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select date when the instrument will expiry.");
                    $('#instrumentexpirydate').val("");  //Clear the field.
                    $("#instrumentexpirydate").focus();
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
        //Once the AdmiManagerects the Station the Station Number should be picked from the DB Manageratically.
        // For Insert/AddManagerieve Weather Summary Form Data
        $(document.body).on('stationinstrumentManager',function(){
            $('#stationNoinstrumentManager').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoinstrumentManager').val("");
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

                            $('#stationNoinstrumentManager').val("");

                            // alert(data);
                            $("#stationNoinstrumentManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoinstrumentManager').empty();
                            $('#stationNoinstrumentManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoinstrumentManager').empty();
                    $('#stationNoinstrumentManager').val("");
                }     })

    </script>


<?php require_once(APPPATH . 'views/footer.php'); ?>