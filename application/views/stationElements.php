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
            Elements
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Elements</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewelementsform) && count($displaynewelementsform)) {
        ?>
        <div class="row">
            <form action='<?php echo base_url(); ?>index.php/StationElements/insertElement/' method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="output"></div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Element Name</span>
                                <input type="text" name="nameelement" class="form-control" required placeholder="Enter element name" id="name">
                            </div>
                        </div>

                        <?php if($userrole=="OC"){ ?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="stationOC_element"  id="stationOC_element" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >
                                </div>
                            </div>

                        <?php }elseif($userrole=="Manager"){ ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="stationManager_element" id="stationManager_element"   class="form-control" placeholder="Select Station">

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
                        <?php }?>
                        <?php if($userrole=="OC"){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNoOC_element" required class="form-control" id="stationNoOC_element"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                </div>
                            </div>
                        <?php }elseif($userrole=="Manager"){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNoManager_element" required class="form-control" id="stationNoManager_element" value="" readonly class="form-control" value="" readonly="readonly" >
                                </div>
                            </div>
                        <?php }?>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Instrument Name</span>
                                <select name="instrumentnameelement" id="instrumentnameelement"   class="form-control" placeholder="Select Instrument">
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Abbrev</span>
                                <input type="text" name="abbrevelement" required class="form-control" placeholder="Enter abbrev" id="abbrevelement">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Type</span>
                                <input type="text" name="typeelement" required class="form-control" placeholder="Enter type " id="typeelement">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Units</span>
                                <input type="text" name="unitselement" required class="form-control" placeholder="Enter units " id="unitselement">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Scale</span>
                                <input type="text" name="scaleelement" required class="form-control" placeholder="Enter scale " id="scaleelement">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Limits</span>
                                <input type="text" name="limitselement" required class="form-control" placeholder="Enter limits " id="limitselement">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="descriptionelement" class="form-control" style="height:150px;" id="descriptionelement"></textarea>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/StationElements/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="post_stationelement" name="post" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Element</button>
                </div>
            </form>
        </div>
    <?php
    }elseif((is_array($stationelementdataid) && count($stationelementdataid))) {
        foreach($stationelementdataid as $elementdata){

            $elementid = $elementdata->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/StationElements/updateElement" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="output"></div>
                        <div class="col-lg-8">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Element Name</span>
                                    <input type="text" name="elementname" class="form-control" required value="<?php echo $elementdata->ElementName;?>" placeholder="Enter element name">
                                    <input type="hidden" name="id" value="<?php echo $elementid;?>">
                                </div>
                            </div>

                            <?php if($userrole=="OC"){ ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC"  id="stationOC" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >
                                    </div>
                                </div>

                            <?php }elseif($userrole=="Manager"){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <select name="stationManager" id="stationManager"   class="form-control" placeholder="Select Station">
                                            <option value="<?php echo $elementdata->StationName;?>"><?php echo $elementdata->StationName;?></option>
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
                            <?php }?>
                            <?php if($userrole=="OC"){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNoOC" required class="form-control" id="stationNoOC"  readonly class="form-control" value="<?php echo $elementdata->StationNumber;?>" readonly="readonly" >
                                    </div>
                                </div>
                            <?php }elseif($userrole=="Manager"){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNoManager" required class="form-control" id="stationNoManager" value="" readonly class="form-control" value="" readonly="readonly" >
                                    </div>
                                </div>
                            <?php }?>

                            <?php if($userrole=="OC"){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Instrument Name</span>
                                        <select name="instrumentname_OC" id="instrumentname_OC"   class="form-control" placeholder="Select Station">
                                            <option value="<?php echo $elementdata->InstrumentName;?>"><?php echo $elementdata->InstrumentName;?></option>

                                        </select>
                                    </div>
                                </div>

                            <?php }elseif($userrole=="Manager"){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Instrument Name</span>
                                        <select name="instrumentname_Manager" id="instrumentname_Manager"   class="form-control" placeholder="Select Station">
                                            <option value="<?php echo $elementdata->InstrumentName;?>"><?php echo $elementdata->InstrumentName;?></option>

                                        </select>
                                    </div>
                                </div>
                            <?php }?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Abbrev</span>
                                    <input type="text" name="abbrev" required class="form-control" value="<?php echo $elementdata->Abbrev;?>" placeholder="Enter abbrev">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Type</span>
                                    <input type="text" name="type" required class="form-control" value="<?php echo $elementdata->Type;?>" placeholder="Enter type ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Units</span>
                                    <input type="text" name="units" required class="form-control" value="<?php echo $elementdata->Units;?>" placeholder="Enter units ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Scale</span>
                                    <input type="text" name="scale" required class="form-control" value="<?php echo $elementdata->Scale;?>" placeholder="Enter scale ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Limits</span>
                                    <input type="text" name="limits" required class="form-control" value="<?php echo $elementdata->Limits;?>" placeholder="Enter limits ">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" class="form-control" style="height:150px;"><?php echo $elementdata->Description;?></textarea>

                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/StationElements/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="update" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Element</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/StationElements/DisplayStationElementForm/">
                    <i class="fa fa-plus"></i> Add new Element</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Elements</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Element Name</th>
                                <th>Instrument Name</th>
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Abbrev</th>
                                <th>Type</th>
                                <th>Units</th>
                                <th>Scale</th>
                                <th>Limits</th>
                                <th>Description</th>
                                <th>Date Registered</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($elements) && count($elements)) {
                                foreach($elements as $elementdata){
                                    $count++;
                                    $elementid = $elementdata->id;
                                    //$elementid=base64_encode($id);

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $elementdata->ElementName;?></td>
                                        <td ><?php echo $elementdata->InstrumentName;?></td>
                                        <td ><?php echo $elementdata->StationName;?></td>
                                        <td ><?php echo $elementdata->StationNumber;?></td>
                                        <td ><?php echo $elementdata->Abbrev;?></td>
                                        <td><?php echo $elementdata->Type;?></td>
                                        <td ><?php echo $elementdata->Units;?></td>
                                        <td><?php echo $elementdata->Scale;?></td>
                                        <td><?php echo $elementdata->Limits;?></td>
                                        <td><?php echo $elementdata->Description;?></td>
                                        <td><?php echo $elementdata->CreationDate;?></td>
                                        <?php if($userrole=='Manager'|| $userrole=='OC'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/StationElements/DisplayStationElementFormForUpdate/" .$elementid ;?>" style="cursor:pointer;">Edit</a>
                                            or <a href="<?php echo base_url() . "index.php/StationElements/deleteStation/" .$elementid ;?>"
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
            $('#post_stationinstrumentelement_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddStationElementInstrumentData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Element Record With the same name,station,station Number and Instrument used to measure exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }




                //Check that the a station is selecteManagerm the list of stations(AdmiManager
                var stationManager=$('#stationManager_element').val();
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the lisManager                    " +
                        $('#stationManager_element').val("");  //Clear the Manager.
                    $("#stationManager_element").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoManager=$('#stationNoManager_element').val();
                if(stationNoManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoManager_element').val("");  //Clear the field.
                    $("#stationNoManager_element").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var stationOC=$('#stationNoOC_element').val();
                if(stationOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#stationNoOC_element').val("");  //Clear the field.
                    $("#stationNoOC_element").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoOC=$('#stationNoOC_element').val();
                if(stationNoOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoOC_element').val("");  //Clear the field.
                    $("#stationNoOC_element").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that Date selected
                var instrumentnameelement=$('#instrumentnameelement').val();
                if(instrumentnameelement==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The Instrument used to measure the element");
                    $('#instrumentnameelement').val("");  //Clear the field.
                    $("#instrumentnameelement").focus();
                    return false;

                }

///////////////////////////////////////////////////////////////////////////////////

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddStationElementInstrumentData(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var elementname = $('#nameelement').val();


            var stationNameManager = $('#stationManagerelement').val();
            var stationNumberManager = $('#stationNoManagerelement').val();

            var stationNameOC = $('#stationOCelement').val();
            var stationNumberOC = $('#stationNoOCelement').val();


            if((stationNameManager!=undefined) && (stationNumberManager!=undefined)){
                var stationName=stationNameManager;
                var stationNumber=stationNumberManager;

            }else if((stationNameOC!=undefined) && (stationNumberOC!=undefined)){
                var stationName=stationNameOC;
                var stationNumber=stationNumberOC;

            }
            //Instrument used to measure the Element
            var instrumentnameelement=$('#instrumentnameelement').val();


            $('#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield').val("");

            if ((elementname != undefined) && (instrumentnameelement != undefined) && (stationName != undefined) && (stationNumber != undefined)   ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/StationElements/checkInDBIfStationElementMeasuredFromAnInstrumentInformationRecordExistsAlready",
                    type: "POST",
                    data:{'elementname':elementname,'instrumentnameelement':instrumentnameelement,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield").val();

            }//end of if

            else if((elementname == undefined) || (instrumentnameelement == undefined) || (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#update_stationinstrumentelement_button').click(function(event) {
                //Check that Date selected
                var elementName=$('#elementname').val();
                if(elementName==""){  // returns true if the variable does NOT contain a valid number
                    alert("Element Name not picked");
                    $('#elementname').val("");  //Clear the field.
                    $("#elementname").focus();
                    return false;

                }


                //Check that Date selected
                var instrumentelementname=$('#instrumentname').val();
                if(instrumentelementname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Instrument Name not picked");
                    $('#instrumentname').val("");  //Clear the field.
                    $("#instrumentname").focus();
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




            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_abbrev;
            var oldValue_abbrev=$('#abbrev').val();

            $('#abbrev').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_abbrev = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#abbrev').val(newValue_abbrev);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#abbrev').val(oldValue_abbrev);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_type;
            var oldValue_type= $('#type').val()

            $('#type').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_type = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#type').val(newValue_type);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#type').val(oldValue_type);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_units;
            var oldValue_units= $('#units').val()

            $('#units').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_units = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#units').val(newValue_units);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#units').val(oldValue_units);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_scale;
            var oldValue_scale= $('#scale').val()

            $('#scale').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_scale = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#scale').val(newValue_scale);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#scale').val(oldValue_scale);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_limits;
            var oldValue_limits= $('#limits').val()

            $('#limits').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_limits = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#limits').val(newValue_limits);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#limits').val(oldValue_limits);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_description;
            var oldValue_description= $('#description').val()

            $('#description').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_description = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#description').val(newValue_description);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#description').val(oldValue_description);
                    return false;
                }
                Manager});
        });
    </script>




    <script type="text/javascript">
        //Once the Manager loads the page the value of Selected Station is displayed.So Get the StationNumber from the DB.
        //On Update Element
        var stationName = $("#stationManager").val();
        $('#stationNoManager').val("");  //Clear the field.

        if (stationName != "") {
            //alert(station);
            $('#stationNoAdmin').val("");
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
    </script>
    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number should be picked from the DB.
        //Add Element.
        $(document.body).on('change','#stationManager_element',function(){
            $('#stationNoManager_element').val("");  //Clear the field.
            var stationName = this.value;
            if (stationName != "") {
                //alert(station);
                $('#stationNoAdminelement').val("");
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

                            $('#stationNoManager_element').empty();

                            // alert(data);
                            $("#stationNoManager_element").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoManager_element').empty();
                            $('#stationNoManager_element').val("");
                        }
                    }
                });
            }
            else {

                $('#stationNoManager_element').empty();
                $('#stationNoManager_element').val("");
            }
        })
    </script>
    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number should be picked from the DB .
        //On Update and when the
        $(document.body).on('change','#stationManager',function(){
            $('#stationNoManager').val("");  //Clear the field.
            var stationName = this.value;
            if (stationName != "") {
                //alert(station);
                $('#stationNoAdmin').val("");
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

    <script type="text/javascript">
        //Once the Manager selects the Station, the Instruments attached to the Stations shd be picked from the InstrumentsTable DB.
        //Add Element.
        $(document.body).on('change','#stationManager_element',function(){
            $('#instrumentnameelement').html('');//Clear the field.
            var stationName = this.value;
            if(stationName!=""){
                // alert(stationName);

                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/StationInstruments/getInstruments",
                    type: "POST",
                    data: {'stationName': stationName},
                    cache: false,
                    success: function(data){
                        if (data)
                        {
                            //var json = JSON.parse(data);

                            //clear the current content of the select
                            $('#instrumentnameelement').html('');
                            //$select.html('');
                            $("#instrumentnameelement").append($('<option>').text("--Select Options--").attr('value', 0));
                            //alert(data);

                            //var json = JSON.parse(data);
                            // var json = JSON.parse(data);
                            // alert(json[0].InstrumentName);

                            var json = JSON.parse(data);
                            var i ;

                            for (i = 0; i < data.length; i++) {
                                $("#instrumentnameelement").append($('<option>').text(json[i].InstrumentName)
                                    .attr('value', json[i].InstrumentName));
                            }
                        }
                        else{

                            $('#instrumentnameelement').html('');

                        }

                    }//end of if for data


                }); //end of ajax.
            }//end of if
        })

    </script>

    <script type="text/javascript">
        //Once the Manager selects the Station the Instruments attached to the Stations shd   be picked from the InstrumentsTable DB.
        //Update Element.
        $(document.body).on('change','#stationManager',function(){
            var previousInstrumentName= $('#instrumentnameAdmin').val();
            $('#instrumentnameAdmin').html('');//Clear the field.
            var stationName = this.value;
            if(stationName!=""){
                // alert(stationName);

                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/StationInstruments/getInstruments",
                    type: "POST",
                    data: {'stationName': stationName},
                    cache: false,
                    success: function(data){
                        if (data)
                        {
                            //var json = JSON.parse(data);

                            //clear the current content of the select
                            $('#instrumentnameAdmin').html('');
                            //$select.html('');
                            $("#instrumentnameAdmin").append($('<option>').text(previousInstrumentName).attr('value', previousInstrumentName));
                            $("#instrumentnameAdmin").append($('<option>').text("--Select Options--").attr('value', 0));
                            //alert(data);

                            //var json = JSON.parse(data);
                            // var json = JSON.parse(data);
                            // alert(json[0].InstrumentName);

                            var json = JSON.parse(data);
                            var i ;

                            for (i = 0; i < data.length; i++) {
                                $("#instrumentnameAdmin").append($('<option>').text(json[i].InstrumentName)
                                    .attr('value', json[i].InstrumentName));
                            }
                        }
                        else{

                            $('#instrumentnameAdmin').html('');

                        }
                    }//end of if for data
                }); //end of ajax.
            }//end of if
        })
    </script>



    <script type="text/javascript">
        //Once the Manager  Station is autopopulated. the Instruments attached to the Stations shd   be picked from the InstrumentsTable DB.
        //Add Element.


        $('#instrumentnameelement').html(''); //Clear the field.
        var stationName =  $('#stationOC_element').val();  //$("#stationAdmin").val();
        if(stationName!=""){
            // alert(stationName);

            $.ajax({
                url: "<?php echo base_url(); ?>"+"index.php/StationInstruments/getInstruments",
                type: "POST",
                data: {'stationName': stationName},
                cache: false,
                success: function(data){
                    if (data)
                    {
                        //var json = JSON.parse(data);

                        //clear the current content of the select
                        $('#instrumentnameelement').html('');
                        //$select.html('');

                        //alert(data);
                        $("#instrumentnameelement").append($('<option>').text("--Select Options--").attr('value', 0));

                        //var json = JSON.parse(data);
                        // var json = JSON.parse(data);
                        // alert(json[0].InstrumentName);

                        var json = JSON.parse(data);
                        var i ;

                        for (i = 0; i < data.length; i++) {
                            $("#instrumentnameelement").append($('<option>').text(json[i].InstrumentName)
                                .attr('value', json[i].InstrumentName));
                        }


                    }
                    else{

                        $('#instrumentnameelement').html('');

                    }

                }//end of if for data


            }); //end of ajax.
        }//end of if
    </script>
    <script type="text/javascript">
        //Once the Manager  Station is autopopulated. the Instruments attached to the Stations shd   be picked from the InstrumentsTable DB.
        //Update Element.
        var previousInstrumentName=$('#instrumentnameManager').val();
        $('#instrumentnameManager').html('');//Clear the field.
        var stationName =  $('#stationManager').val();  //$("#stationAdmin").val();
        if(stationName!=""){
            // alert(stationName);

            $.ajax({
                url: "<?php echo base_url(); ?>"+"index.php/StationInstruments/getInstruments",
                type: "POST",
                data: {'stationName': stationName},
                cache: false,
                success: function(data){
                    if (data)
                    {
                        //var json = JSON.parse(data);

                        //clear the current content of the select
                        $('#instrumentnameManager').html('');
                        //$select.html('');
                        $("#instrumentnameManager").append($('<option>').text(previousInstrumentName).attr('value', previousInstrumentName));

                        $("#instrumentnameManager").append($('<option>').text("--Select Options--").attr('value', 0));
                        //alert(data);

                        //var json = JSON.parse(data);
                        // var json = JSON.parse(data);
                        // alert(json[0].InstrumentName);

                        var json = JSON.parse(data);
                        var i ;

                        for (i = 0; i < data.length; i++) {
                            $("#instrumentnameManager").append($('<option>').text(json[i].InstrumentName)
                                .attr('value', json[i].InstrumentName));
                        }


                    }
                    else{

                        $('#instrumentnameManager').html('');

                    }

                }//end of if for data


            }); //end of ajax.
        }//end of if
    </script>

<?php require_once(APPPATH . 'views/footer.php'); ?>