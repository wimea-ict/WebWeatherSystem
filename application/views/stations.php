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
            Stations
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Stations</li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewstationsform) && count($displaynewstationsform)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/Stations/insertStationInformation/" method="post" enctype="multipart/form-data">
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
                                <span class="input-group-addon"> Station Name</span>
                                <input type="text" name="namestation" id="namestation" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required placeholder="Enter Station name" >
                                <input type="hidden" name="checkduplicateEntryOnAddNewStationInformation_hiddentextfield" id="checkduplicateEntryOnAddNewStationInformation_hiddentextfield">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="numberstation" id="numberstation" onkeyup="allowIntegerInputOnly(this)" required class="form-control" placeholder="Enter station number" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Location</span>
                                <input type="text" name="locationstation" id="locationstation" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required placeholder="Enter location" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Country</span>
                                <input type="text" name="countrystation" id="countrystation" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="Enter country" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Region</span>
                                <input type="text" name="regionstation" id="regionstation" onkeyup="allowCharactersInputOnly(this)" required class="form-control" placeholder="Enter region" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Code</span>
                                <input type="text" name="codestation" id="codestation" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" placeholder="Enter code " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">City</span>
                                <input type="text" name="citystation" id="citystation" onkeyup="allowCharactersInputOnly(this)" required class="form-control" placeholder="Enter city " >
                            </div>
                        </div>



                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Status</span>
                                <input type="text" name="statusstation" id="statusstation" onkeyup="allowCharactersInputOnly(this)" required class="form-control"  placeholder="Enter Status" >
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Latitude</span>
                                <input type="text" name="latitudestation" id="latitudestation" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" placeholder="Enter latitude " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Longitude</span>
                                <input type="text" name="longitudestation" id="longitudestation" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" required placeholder="Enter longitude" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Altitude</span>
                                <input type="text" name="altitudestation" id="altitudestation" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter altitude" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Opened</span>
                                <input type="text" name="openedstation" id="date" required class="form-control" required placeholder="Enter opened date" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Closed</span>
                                <input type="text" name="closedstation" id="expdate" required class="form-control" required placeholder="Enter closed" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Type</span>
                                <input type="text" name="typestation" id="typestation" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="Enter type" >
                            </div>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/Stations/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="post_stationInformation" name="post_stationInformation" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Station</button>
                </div>
            </form>
        </div>
    <?php
    }elseif((is_array($stationdataid) && count($stationdataid))) {
        foreach($stationdataid as $stationdata){

            $stationsdataformid = $stationdata->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/Stations/updateStationInformation" method="post" enctype="multipart/form-data">
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
                            <span class="input-group-addon">Station Name</span>
                            <input type="text" name="station_name"  id="station_name" required class="form-control" value="<?php echo $stationdata->StationName;?>"   >

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> Station Number</span>
                            <input type="text" name="stationNo" required class="form-control" id=stationNo" value="<?php echo $stationdata->StationNumber;?>"  >
                        </div>
                    </div>




                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Location</span>
                        <input type="text" name="stationlocation" id="stationlocation"  onkeyup="allowCharactersInputOnly(this)" required class="form-control" required value="<?php echo $stationdata->Location;?>" placeholder="Enter location" >
                         <input type="hidden" name="id" value="<?php echo $stationdata->id;?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Country</span>
                        <input type="text" name="stationcountry" id="stationcountry" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required value="<?php echo $stationdata->Country;?>" placeholder="Enter country" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Region</span>
                        <input type="text" name="stationregion" id="stationregion" onkeyup="allowCharactersInputOnly(this)" required class="form-control" value="<?php echo $stationdata->Region;?>" placeholder="Enter region" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Code</span>
                        <input type="text" name="stationcode" id="stationcode" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $stationdata->Code;?>" placeholder="Enter code " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">City</span>
                        <input type="text" name="stationcity" id="stationcity" onkeyup="allowCharactersInputOnly(this)" required class="form-control" placeholder="Enter city " value="<?php echo $stationdata->City;?>" >
                    </div>
                </div>

            </div>
            <div class="col-lg-6">



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Status</span>
                        <input type="text" name="stationstatus" id="stationstatus" onkeyup="allowCharactersInputOnly(this)" required class="form-control"  value="<?php echo $stationdata->Status;?>" placeholder="Enter Status" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Latitude</span>
                        <input type="text" name="stationlatitude" id="stationlatitude" onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $stationdata->Latitude;?>" placeholder="Enter latitude " >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Longitude</span>
                        <input type="text" name="stationlongitude" id="stationlongitude" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required value="<?php echo $stationdata->Longitude;?>" placeholder="Enter longitude" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Altitude</span>
                        <input type="text" name="stationaltitude" id="stationaltitude" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" required value="<?php echo $stationdata->Altitude;?>" placeholder="Enter altitude" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Opened Date</span>
                        <input type="text" name="stationopened" id="opened" required class="form-control" required value="<?php echo $stationdata->Opened;?>" placeholder="Enter opened" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Closed Date</span>
                        <input type="text" name="stationclosed" id="closed" required class="form-control" required value="<?php echo $stationdata->Closed;?>" placeholder="Enter closed" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Type</span>
                        <input type="text" name="stationtype" id="stationtype" required class="form-control" required value="<?php echo $stationdata->Type;?>" placeholder="Enter type" >
                    </div>
                </div>
                </div>

            </div>
            <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/Stations/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="update_stationInformation" id="update_stationInformation" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Station</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
       <?php  if($userrole=='Manager'){ ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/Stations/DisplayStationsForm/">
                    <i class="fa fa-plus"></i> Add new Station</a>

            </div>

        </div>
        <?php } ?>
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
                                <th>Name</th>
                                <th>Number</th>
                                <th>Location</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>Code </th>
                                <th>City</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Altitude</th>
                                <th>Opened </th>
                                <th>Closed</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Created</th>
                                <?php if($userrole=='Manager'){ ?>

                                    <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($stationsdata) && count($stationsdata)) {
                                foreach($stationsdata as $stationdata){
                                    $count++;
                                    $stationid = $stationdata->id;
                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $stationdata->StationName;?></td>
                                        <td ><?php echo $stationdata->StationNumber;?></td>
                                        <td ><?php echo $stationdata->Location;?></td>
                                        <td ><?php echo $stationdata->Country;?></td>
                                        <td ><?php echo $stationdata->Region;?></td>
                                        <td ><?php echo $stationdata->Code;?></td>
                                        <td><?php echo $stationdata->City;?></td>
                                        <td><?php echo $stationdata->Latitude;?></td>
                                        <td ><?php echo $stationdata->Longitude;?></td>
                                        <td ><?php echo $stationdata->Altitude;?></td>
                                        <td><?php echo $stationdata->Opened;?></td>
                                        <td><?php echo $stationdata->Closed;?></td>
                                        <td ><?php echo $stationdata->Status;?></td>
                                        <td ><?php echo $stationdata->Type;?></td>
                                        <td><?php echo $stationdata->CreationDate;?></td>
                                        <?php if($userrole=='Manager'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/Stations/DisplayStationsFormForUpdate/" .$stationid ;?>" style="cursor:pointer;">Edit</a>
                                            or <a href="<?php echo base_url() . "index.php/Stations/deleteStation/" .$stationid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $stationdata->StationName;?>');">Delete</a></td><?php }?>
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
            $('#post_stationInformation').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddNewStationInformationData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Station Record With the station Name,station Number  exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }



                //Check that Opened Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }

                var expdate=$('#expdate').val();
                if(expdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
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
        function checkDuplicateEntryData_OnAddNewStationInformationData(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.

         var  stationName = $('#namestation').val();
        var   stationNumber= $('#numberstation').val();






            $('#checkduplicateEntryOnAddNewStationInformation_hiddentextfield').val("");

            if ( (stationName != undefined) && (stationNumber != undefined)   ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/checkInDBIfStationNameAndStationNumberRecordExistsAlready",
                    type: "POST",
                    data:{'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddNewStationInformation_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddNewStationInformation_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddNewStationInformation_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddNewStationInformation_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddNewStationInformation_hiddentextfield").val();

            }//end of if

            else if( (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#update_stationInformation').click(function(event) {
                //Check that Date selected
                var date=$('#opened').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }
                var closeddate=$('#closed').val();
                if(closeddate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#closed').val("");  //Clear the field.
                    $("#closed").focus();
                    return false;

                }


                }
/////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////




            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_station_name;
            var oldValue_station_name=$('#station_name').val();

            $('#station_name').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_station_name = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#station_name').val(newValue_station_name);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#station_name').val(oldValue_station_name);
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
            var newValue_stationNo;
            var oldValue_stationNo=$('#stationNo').val();

            $('#stationNo').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_stationNo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationNo').val(newValue_stationNo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationNo').val(oldValue_stationNo);
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
            var newValue_stationlocation;
            var oldValue_stationlocation=$('#stationlocation').val();

            $('#stationlocation').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_stationlocation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationlocation').val(newValue_stationlocation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationlocation').val(oldValue_stationlocation);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_stationcountry;
            var oldValue_stationcountry= $('#stationcountry').val()

            $('#stationcountry').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_stationcountry = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationcountry').val(newValue_stationcountry);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationcountry').val(oldValue_stationcountry);
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
            var newValue_stationregion;
            var oldValue_stationregion= $('#stationregion').val()

            $('#stationregion').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_stationregion = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationregion').val(newValue_stationregion);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationregion').val(oldValue_stationregion);
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
            var newValue_stationcode;
            var oldValue_stationcode= $('#stationcode').val();

            $('#stationcode').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_stationcode = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationcode').val(newValue_stationcode);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationcode').val(oldValue_stationcode);
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
            var newValue_stationcity;
            var oldValue_stationcity= $('#stationcity').val();

            $('#stationcity').live('change paste', function(){
                //oldValue_airtemperature = newValue_airtemperature;
                newValue_stationcity = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationcity').val(newValue_stationcity);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationcity').val(oldValue_stationcity);
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
            var newValue_stationstatus;
            var oldValue_stationstatus= $('#stationstatus').val();

            $('#stationstatus').live('change paste', function(){
                //oldValue_wetbulb = newValue_wetbulb;
                newValue_stationstatus = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationstatus').val(newValue_stationstatus);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationstatus').val(oldValue_stationstatus);
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
            var newValue_stationlatitude;
            var oldValue_stationlatitude= $('#stationlatitude').val()

            $('#stationlatitude').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_stationlatitude = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationlatitude').val(newValue_stationlatitude);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationlatitude').val(oldValue_stationlatitude);
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
            var newValue_stationlongitude;
            var oldValue_stationlongitude= $('#stationlongitude').val();

            $('#stationlongitude').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_stationlongitude = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationlongitude').val(newValue_stationlongitude);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationlongitude').val(oldValue_stationlongitude);
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
            var newValue_stationaltitude;
            var oldValue_stationaltitude= $('#stationaltitude').val();

            $('#stationaltitude').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_stationaltitude = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationaltitude').val(newValue_stationaltitude);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationaltitude').val(oldValue_stationaltitude);
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
            var newValue_stationtype;
            var oldValue_stationtype= $('#stationtype').val();

            $('#stationtype').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_stationtype = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationtype').val(newValue_stationtype);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationtype').val(oldValue_stationtype);
                    return false;
                }
            });
        });
    </script>
<?php require_once(APPPATH . 'views/footer.php'); ?>