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
           New Stations
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Stations</li>
        </ol>
    </section>

    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewstationsform) && count($displaynewstationsform)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/NewStations/insertStationInformation/" method="post" enctype="multipart/form-data">
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

                                <input type="hidden" name="checkduplicateEntryOnAddNewStationsInformation_hiddentextfield" id="checkduplicateEntryOnAddNewStationsInformation_hiddentextfield">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="numberstation" id="numberstation"  onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter station number" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Station Registration Number</span>
                                <input type="text" name="registrationnumberstation" id="registrationnumberstation"  onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Station Registration Number" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Location</span>
                                <input type="text" name="locationstation" id="locationstation"    onkeyup="allowCharactersInputOnly(this)"  class="form-control"  placeholder="Enter Station Location">

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Indicator</span>
                                <input type="text" name="indicatorstation" id="indicatorstation"   onkeyup="allowCharactersInputOnly(this)"   class="form-control"   placeholder="Enter Station Indicator">
                            </div>
                        </div>





                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Region</span>
                                <select name="regionstation" id="regionstation" onkeyup="allowCharactersInputOnly(this)"  class="form-control">
                                    <option value="">--Select REGION--</option>
                                    <option value="Central">Central</option>
                                    <option value="Northern">Northern</option>
                                    <option value="Southern">Southern</option>
                                    <option value="Eastern">Eastern</option>
                                    <option value="Western">Western</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Country</span>
                                <input type="text" name="countrystation" id="countrystation" onkeyup="allowCharactersInputOnly(this)" value="<?php echo 'Uganda';?>" readonly class="form-control"  class="form-control"  placeholder="Enter country" >
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Latitude</span>
                                <input type="text" name="latitudestation" id="latitudestation" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter latitude " >
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-6">





                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Longitude</span>
                                <input type="text" name="longitudestation" id="longitudestation" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter longitude" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Altitude</span>
                                <input type="text" name="altitudestation" id="altitudestation" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter altitude" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Opened</span>
                                <input type="text" name="openedstation" id="date"  class="form-control"  placeholder="Enter opened date" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Closed</span>
                                <input type="text" name="closedstation" id="expdate"  class="form-control"  placeholder="Enter closed" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Status Of Station</span>
                                <select name="statusstation" id="statusstation" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                    <option value="">--Select Status Of Station--</option>
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Type Of Station</span>
                                <select name="typestation" id="typestation" onkeyup="allowCharactersInputOnly(this)"  class="form-control"  placeholder="Enter type" >
                                    <option value="">--Select Type Of Station--</option>
                                    <option value="Synoptic">Synoptic</option>
                                    <option value="Agrometeorological">Agrometeorological</option>
                                    <option value="Rainfall">Rainfall</option>
                                    <option value="Hygrometeorological">Hygrometeorological</option>
                                    <option value="Climatological">Climatological</option>



                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/NewStations/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="post_stationInformation" name="post_stationInformation" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Station</button>
                </div>
            </form>
        </div>
    <?php
    }elseif((is_array($stationdataid) && count($stationdataid))) {
        foreach($stationdataid as $stationdata){
            //echo $userrole;
            $stationsdataformid = $stationdata->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/NewStations/updateStationInformation" method="post" enctype="multipart/form-data">
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
                                    <input type="text" name="station_name"  id="station_name" required class="form-control" value="<?php echo $stationdata->StationName;?>"  readonly class="form-control"  >

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNo" required class="form-control" id=stationNo" value="<?php echo $stationdata->StationNumber;?>" readonly class="form-control"  >
                                    <input type="hidden" name="id" id="id" value="<?php echo $stationdata->id;?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station Registration Number</span>
                                    <input type="text" name="stationRegNo" id="stationRegNo" value="<?php echo $stationdata->StationRegNumber;?>"  readonly class="form-control" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter the Station Registration Number" >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Location</span>
                                    <input type="text" name="stationlocation" id="stationlocation"  value="<?php echo $stationdata->Location;?>" readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="Enter the Station Location">

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Indicator</span>
                                    <input type="text" name="stationindicator" id="stationindicator" value="<?php echo $stationdata->Indicator;?>" readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="Enter the Station Indicator">
                                </div>
                            </div>






                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station Region</span>
                                    <select name="stationregion" id="stationregion" onkeyup="allowCharactersInputOnly(this)" required class="form-control">
                                        <option value="<?php echo $stationdata->StationRegion;?>"><?php echo $stationdata->StationRegion;?></option>
                                        <option value="">--Select REGION--</option>
                                        <option value="Central">Central</option>
                                        <option value="Northern">Northern</option>
                                        <option value="Southern">Southern</option>
                                        <option value="Eastern">Eastern</option>
                                        <option value="Western">Western</option>

                                    </select>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Country</span>
                                    <input type="text" name="stationcountry" id="stationcountry" readonly class="form-control" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required value="<?php echo $stationdata->Country;?>" placeholder="Enter country" >
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Latitude</span>
                                    <input type="text" name="stationlatitude" id="stationlatitude" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required value="<?php echo $stationdata->Latitude;?>" required placeholder="Enter latitude " >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Longitude</span>
                                    <input type="text" name="stationlongitude" id="stationlongitude" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required value="<?php echo $stationdata->Longitude;?>" required placeholder="Enter longitude" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Altitude</span>
                                    <input type="text" name="stationaltitude" id="stationaltitude" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" required value="<?php echo $stationdata->Altitude;?>" required placeholder="Enter altitude" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Opened Date</span>
                                    <input type="text" name="stationopened" id="opened" required class="form-control" required value="<?php echo $stationdata->Opened;?>" required placeholder="Enter opened" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Closed Date</span>
                                    <input type="text" name="stationclosed" id="closed" required class="form-control" required value="<?php echo $stationdata->Closed;?>"  required placeholder="Enter closed" >
                                </div>
                            </div>









                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Status</span>
                                    <select name="stationstatus" id="stationstatus" onkeyup="allowCharactersInputOnly(this)" required class="form-control"   required placeholder="Enter Status" >
                                        <option value="<?php echo $stationdata->StationStatus;?>"><?php echo $stationdata->StationStatus;?></option>
                                        <option value="">--Select Status--</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>


                                    </select>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station Type</span>
                                    <select name="stationtype" id="stationtype" required class="form-control" onkeyup="allowCharactersInputOnly(this)" required placeholder="Enter type" >
                                        <option value="<?php echo $stationdata->StationType;?>"><?php echo $stationdata->StationType;?></option>
                                        <option value="">--Select Type Of Station--</option>
                                        <option value="Synoptic">Synoptic</option>
                                        <option value="Agrometeorological">Agrometeorological</option>
                                        <option value="Rainfall">Rainfall</option>
                                        <option value="Hygrometeorological">Hygrometeorological</option>
                                        <option value="Climatological">Climatological</option>



                                    </select>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/NewStations/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="update_stationInformation" id="update_stationInformation" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Station</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <?php  if($userrole=='ManagerStationNetworks'){ ?>
            <div class="row">
                <div class="col-xs-3"><a class="btn btn-primary no-print"
                                         href="<?php echo base_url(); ?>index.php/NewStations/DisplayStationsForm/">
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
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Station Reg No</th>
                                <th>Station Status</th>
                                <th>Location</th>
                                <th>Indicator </th>

                                <th>Region</th>
                                <th>Country</th>


                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Altitude</th>


                                <?php if($userrole=='ManagerStationNetworks'){ ?>

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
                                        <td><?php echo $stationdata->StationRegNumber;?></td>
                                        <td><?php echo $stationdata->StationStatus;?></td>
                                        <td ><?php echo $stationdata->Location;?></td>
                                        <td ><?php echo $stationdata->Indicator;?></td>

                                        <td ><?php echo $stationdata->StationRegion;?></td>
                                        <td ><?php echo $stationdata->Country;?></td>


                                        <td><?php echo $stationdata->Latitude;?></td>
                                        <td ><?php echo $stationdata->Longitude;?></td>
                                        <td ><?php echo $stationdata->Altitude;?></td>


                                        <?php if($userrole=='ManagerStationNetworks'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/NewStations/DisplayStationsFormForUpdate/" .$stationid ;?>" style="cursor:pointer;">Edit</a>
                                            <!--  or <a href="<?php echo base_url() . "index.php/NewStations/deleteStation/" .$stationid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $stationdata->StationName;?>');">Delete</a></td><?php }?> -->
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
              alert("hello");

                //Check for duplicate Entry Data when adding new archive metar form.
                var   stationName = $('#namestation').val();
                var   stationNumber= $('#numberstation').val();
                var   stationLocation = $('#locationstation').val();
                var   stationIndicator= $('#indicatorstation').val();

                $('#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield').val("");

                if ( (stationName != undefined) && (stationNumber != undefined) && (stationLocation != undefined) && (stationIndicator != undefined)   ) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>"+"index.php/NewStations/checkInDBIfStationNameAndStationNumberRecordExistsAlready",
                        type: "POST",
                        data:{'StationName': stationName,'StationNumber':stationNumber,'Location':stationLocation,'Indicator':stationIndicator},
                        cache: false,
                        async: false,

                        success: function(data){

                            if(data=="true"){

                                $('#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield').empty();

                                 alert(data);
                                $("#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield").val(data);

                            }
                            else if(data=="false"){
                                $('#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield').empty();

                                alert("value not 0picked");
                                $("#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield").val(data);

                            }
                        }

                    });//end of ajax

                    var truthvalue=$("#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield").val();

                }else{
                  alert("unknowns");
                } //end of else

                else if( (stationName == undefined) || (stationNumber == undefined) || (stationLocation == undefined) || (stationIndicator == undefined)  ){

                    alert("Missing");
                }





                //Check that Country is selected
                var namestation=$('#namestation').val();
                if(namestation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Name of the Station not selected");
                    $('#namestation').val("");  //Clear the field.
                    $("#namestation").focus();
                    return false;

                }

                //Check that Name is selected
                var numberstation=$('#numberstation').val();
                if(numberstation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Number of the Station not picked");
                    $('#numberstation').val("");  //Clear the field.
                    $("#numberstation").focus();
                    return false;

                }

                //Check that Name is selected
                var regNostation=$('#registrationnumberstation').val();
                if(regNostation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz input the Registraion Number of the Station ");
                    $('#registrationnumberstation').val("");  //Clear the field.
                    $("#registrationnumberstation").focus();
                    return false;

                }

                //Check that Location is selected
                var locationstation=$('#locationstation').val();
                if(locationstation==""){  // returns true if the variable does NOT contain a valid number
                    alert(" The location of  the station not picked");
                    $('#locationstation').val("");  //Clear the field.
                    $("#locationstation").focus();
                    return false;

                }

                //Check that Indicator is selected
                var indicatorstation=$('#indicatorstation').val();
                if(indicatorstation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Indicator Not Picked");
                    $('#indicatorstation').val("");  //Clear the field.
                    $("#indicatorstation").focus();
                    return false;

                }

                //Check that Region is selected
                var regionstation=$('#regionstation').val();
                if(regionstation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the region of the station");
                    $('#regionstation').val("");  //Clear the field.
                    $("#regionstation").focus();
                    return false;

                }

                //Check that Country is selected
                var countrystation=$('#countrystation').val();
                if(countrystation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Country of the Station not picked");
                    $('#countrystation').val("");  //Clear the field.
                    $("#countrystation").focus();
                    return false;

                }

                //Check that Station Status is selected
                var statusstation=$('#statusstation').val();
                if(statusstation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz select the Status Of Station");
                    $('#statusstation').val("");  //Clear the field.
                    $("#statusstation").focus();
                    return false;

                }

                //Check that Station Type is selected
                var typestation=$('#typestation').val();
                if(typestation==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz select the Type Of Station");
                    $('#typestation').val("");  //Clear the field.
                    $("#typestation").focus();
                    return false;

                }



                //Check that Opened Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The Opened date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }

                //Check that Closed Date selected
                var expdate=$('#expdate').val();
                if(expdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The Closed date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }

                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddNewStationsInformation_hiddentextfield").focus();
                    return false;

                }


            }); //button
            //  return false;


        });  //document


    </script>

    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#update_stationInformation').click(function(event) {


                //Check that id of the row is picked
                var rowid=$('#id').val();
                if(rowid==""){  // returns true if the variable does NOT contain a valid number
                    alert("Row id not picked");
                    $('#id').val("");  //Clear the field.
                    $("#id").focus();
                    return false;

                }



                //Check that Country is selected
                var stationname=$('#stationname').val();
                if(stationname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Name of the Station not picked");
                    $('#stationname').val("");  //Clear the field.
                    $("#stationname").focus();
                    return false;

                }

                //Check that Name is selected
                var stationNo=$('#stationNo').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Number of the Station not picked");
                    $('#stationNo').val("");  //Clear the field.
                    $("#stationNo").focus();
                    return false;

                }

                //Check that Name is selected
                var stationRegNo=$('#stationRegNo').val();
                if(stationRegNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz input the Registraion Number of the Station ");
                    $('#stationRegNo').val("");  //Clear the field.
                    $("#stationRegNo").focus();
                    return false;

                }

                //Check that Location is selected
                var stationlocation=$('#stationlocation').val();
                if(stationlocation==""){  // returns true if the variable does NOT contain a valid number
                    alert(" The location of  the station not picked");
                    $('#stationlocation').val("");  //Clear the field.
                    $("#stationlocation").focus();
                    return false;

                }

                //Check that Indicator is selected
                var stationindicator=$('#stationindicator').val();
                if(stationindicator==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Indicator Not Picked");
                    $('#stationindicator').val("");  //Clear the field.
                    $("#stationindicator").focus();
                    return false;

                }

                //Check that Region is selected
                var stationregion=$('#stationregion').val();
                if(stationregion==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the region of the station");
                    $('#stationregion').val("");  //Clear the field.
                    $("#stationregion").focus();
                    return false;

                }

                //Check that Country is selected
                var stationcountry=$('#stationcountry').val();
                if(stationcountry==""){  // returns true if the variable does NOT contain a valid number
                    alert("Country of the Station not picked");
                    $('#stationcountry').val("");  //Clear the field.
                    $("#stationcountry").focus();
                    return false;

                }

                //Check that Station Status is selected
                var stationstatus=$('#stationstatus').val();
                if(stationstatus==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz select the Status Of Station");
                    $('#stationstatus').val("");  //Clear the field.
                    $("#stationstatus").focus();
                    return false;

                }

                //Check that Station Type is selected
                var stationtype=$('#stationtype').val();
                if(stationtype==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz select the Type Of Station");
                    $('#stationtype').val("");  //Clear the field.
                    $("#stationtype").focus();
                    return false;

                }



                //Check that Opened Date selected
                var openeddate=$('#opened').val();
                if(openeddate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The Opened date");
                    $('#opened').val("");  //Clear the field.
                    $("#opened").focus();
                    return false;

                }

                //Check that Closed Date selected
                var closeddate=$('#closed').val();
                if(closeddate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The Closed date");
                    $('#closed').val("");  //Clear the field.
                    $("#closed").focus();
                    return false;

                }

            }
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
            var newValue_stationRegNo;
            var oldValue_stationRegNo=$('#stationRegNo').val();

            $('#stationRegNo').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_stationRegNo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#stationRegNo').val(newValue_stationRegNo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#stationRegNo').val(oldValue_stationRegNo);
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
