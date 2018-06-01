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
                                <input type="text" name="name_element" id="name_element" required class="form-control" required placeholder="Enter element name" >
                                <input type="hidden" name="checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield" id="checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield">

                            </div>
                        </div>

                        <?php if($userrole=="OC"){ ?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="station_OC_element"  id="station_OC_element" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >
                                </div>
                            </div>

                        <?php }elseif($userrole=="Manager" || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){ ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="station_insertElement_element" id="station_insertElement_element"  required class="form-control" placeholder="Select Station">

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
                                    <input type="text" name="stationNo_OC_element" required class="form-control" id="stationNo_OC_element"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                   <!-- <input type="hidden" name="stationRegion_OC_element" id="stationRegion_OC_element" required class="form-control" value="<?php echo $StationRegion;?>"  readonly class="form-control" > -->

                                </div>
                            </div>
                        <?php }elseif($userrole=="Manager" || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNo_insertElement_element" required class="form-control" id="stationNo_insertElement_element" value="" readonly class="form-control" value="" readonly="readonly" >
                                    <input type="hidden" name="stationRegion_insertElement_element" id="stationRegion_insertElement_element" required class="form-control" value=""  readonly class="form-control" >

                                </div>
                            </div>
                        <?php }?>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Instrument Name</span>
                                <select name="instrumentname_element" id="instrumentname_element" required  class="form-control" placeholder="Select Instrument that Measures the Element">
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Abbrev</span>
                                <input type="text" name="abbrev_element" id="abbrev_element"  class="form-control" placeholder="Enter abbrev for the element" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Type</span>
                                <input type="text" name="type_element" id="type_element"  class="form-control" placeholder="Enter type of Element " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Units</span>
                                <input type="text" name="units_element" id="units_element"  class="form-control" placeholder="Enter units for the Element " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Scale</span>
                                <input type="text" name="scale_element" id="scale_element"  class="form-control" placeholder="Enter scale " >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Limits</span>
                                <input type="text" name="limits_element" id="limits_element" required class="form-control" placeholder="Enter limits " >
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_element" id="description_element" class="form-control" style="height:40px;" ></textarea>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <center>

                    <a href="<?php echo base_url(); ?>index.php/StationElements/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>

                    <button type="submit" id="post_stationinstrumentelement_button" name="post_stationinstrumentelement_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT </button>
                </center>
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
                                    <input type="text" name="elementName" id="elementName"required class="form-control" required value="<?php echo $elementdata->ElementName;?>" placeholder="Enter element name" readonly class="form-control">
                                    <input type="hidden" name="id" id="id" value="<?php echo $elementid;?>">
                                </div>
                            </div>

                            <?php if($userrole=="OC"){ ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="station_OC"  id="station_OC" required class="form-control" value="<?php echo $elementdata->StationName;?>"  readonly class="form-control" >
                                    </div>
                                </div>

                            <?php }elseif($userrole=="Manager" || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="station_updateElement" id="station_updateElement" required class="form-control" value="<?php echo $elementdata->StationName;?>"  readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" >

                                    </div>
                                </div>
                            <?php }?>
                            <?php if($userrole=="OC"){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo_OC" required class="form-control" id="stationNo_OC"  readonly class="form-control" value="<?php echo $elementdata->StationNumber;?>" readonly="readonly" >
                                       <!-- <input type="hidden" name="stationRegion_OC" id="stationRegion_OC" required class="form-control" value="<?php echo $StationRegion;?>"  readonly class="form-control" > -->

                                    </div>
                                </div>
                            <?php }elseif($userrole=="Manager" || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo_updateElement" required class="form-control" id="stationNo_updateElement" value="<?php echo $elementdata->StationNumber;?>" readonly class="form-control" value="" readonly="readonly" >
                                     <!--   <input type="hidden" name="stationRegion_updateElement" id="stationRegion_updateElement" required class="form-control" value="<?php echo $elementdata->StationRegion;?>"  readonly class="form-control" >  -->

                                    </div>
                                </div>
                            <?php }?>




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Instrument Name</span>
                                    <input type="text" name="instrumentname__element_Update" id="instrumentname__element_Update" value="<?php echo $elementdata->InstrumentName;?>" readonly="readonly" required  class="form-control" placeholder="Select Instrument that Measures the Element">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Abbrev</span>
                                    <input type="text" name="abbrev" id="abbrev"  class="form-control" value="<?php echo $elementdata->Abbrev;?>" placeholder="Enter abbrev">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Type</span>
                                    <input type="text" name="type" id="type"  class="form-control" value="<?php echo $elementdata->Type;?>" placeholder="Enter type ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Units</span>
                                    <input type="text" name="units" id="units"  class="form-control" value="<?php echo $elementdata->Units;?>" placeholder="Enter units ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Scale</span>
                                    <input type="text" name="scale" id="scale"  class="form-control" value="<?php echo $elementdata->Scale;?>" placeholder="Enter scale ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Limits</span>
                                    <input type="text" name="limits" id="limits" required class="form-control" value="<?php echo $elementdata->Limits;?>" placeholder="Enter limits ">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" id="description" class="form-control" style="height:40px;"><?php echo $elementdata->Description;?></textarea>

                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <center>

                <a  href="<?php echo base_url(); ?>index.php/StationElements/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>

                <button type="submit" name="update_stationinstrumentelement_button" id="update_stationinstrumentelement_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
            </center>
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

                                <th>Action</th>
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

                                        <?php if($userrole=='Manager'|| $userrole=='OC'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/StationElements/DisplayStationElementFormForUpdate/" .$elementid ;?>" style="cursor:pointer;">Edit</a>
                                            <!--  or <a href="<?php echo base_url() . "index.php/StationElements/deleteStation/" .$elementid ;?>"
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
            //Post Add New  Archive metar form data into the DB
            //Validate each select field before inserting into the DB
            $('#post_stationinstrumentelement_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddStationElementData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Element Record With the same name,station,station Number and Instrument used to measure exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }

                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield").focus();
                    return false;

                }


                //Check that Date selected
                var station=$('#station_insertElement_element').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not Selected");
                    $('#station_insertElement_element').val("");  //Clear the field.
                    $("#station_insertElement_element").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_insertElement_element').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("StationNo not picked");
                    $('#stationNo_insertElement_element').val("");  //Clear the field.
                    $("#stationNo_insertElement_element").focus();
                    return false;

                }
                var stationRegion=$('#stationRegion_insertElement_element').val();
                if (stationRegion==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_insertElement_element').val("");  //Clear the field.
                    $("#stationRegion_insertElement_element").focus();
                    return false;

                }

                //Check that Date selected
                var stationOC_element=$('#station_OC_element').val();
                if(stationOC_element==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not Selected");
                    $('#station_OC_element').val("");  //Clear the field.
                    $("#station_OC_element").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var stationNo_OC_element=$('#stationNo_OC_element').val();
                if(stationNo_OC_element==""){  // returns true if the variable does NOT contain a valid number
                    alert("StationNo not picked");
                    $('#stationNo_OC_element').val("");  //Clear the field.
                    $("#stationNo_OC_element").focus();
                    return false;

                }
                var stationRegion_OC_element=$('#stationRegion_OC_element').val();
                if (stationRegion_OC_element==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_OC_element').val("");  //Clear the field.
                    $("#stationRegion_OC_element").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var instrumentname_element=$('#instrumentname_element').val();
                if(instrumentname_element==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station");
                    $('#instrumentname_element').val("");  //Clear the field.
                    $("#instrumentname_element").focus();
                    return false;

                }






            }); //button


        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddStationElementData(){


            var elementname = $('#name_element').val();


            var stationNameManager = $('#station_insertElement_element').val();
            var stationNumberManager = $('#stationNo_insertElement_element').val();

            var stationNameOC = $('#station_OC_element').val();
            var stationNumberOC = $('#stationNo_OC_element').val();


            if((stationNameManager!=undefined) && (stationNumberManager!=undefined)){
                var stationName=stationNameManager;
                var stationNumber=stationNumberManager;

            }else if((stationNameOC!=undefined) && (stationNumberOC!=undefined)){
                var stationName=stationNameOC;
                var stationNumber=stationNumberOC;

            }



            //Instrument used to measure the Element
            var instrumentname_element=$('#instrumentname_element').val();


            $('#checkduplicateEntryOnAddNewStationInstrumentElementData_hiddentextfield').val("");

            if ((elementname != undefined) && (instrumentname_element != undefined) && (stationName != undefined) && (stationNumber != undefined)  ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/StationElements/checkInDBIfStationElementMeasuredFromAnInstrumentInformationRecordExistsAlready",
                    type: "POST",
                    data:{'elementname':elementname,'instrumentname_element': instrumentname_element,'stationName':stationName,'stationNumber':stationNumber},
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

            else if((elementname == undefined) || (instrumentname_element == undefined) || (stationName == undefined) || (stationNumber == undefined)  ){

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



                //Check that id of the row is picked
                var rowid=$('#id').val();
                if(rowid==""){  // returns true if the variable does NOT contain a valid number
                    alert("Row id not picked");
                    $('#id').val("");  //Clear the field.
                    $("#id").focus();
                    return false;

                }


                //Check that Date selected
                var elementName=$('#elementName').val();
                if(elementName==""){  // returns true if the variable does NOT contain a valid number
                    alert("Element Name not picked");
                    $('#elementName').val("");  //Clear the field.
                    $("#elementName").focus();
                    return false;

                }



                //Check that the a station is selected from the list Managerations(Admin)
                var station=$('#station_updateElement').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not Selected");
                    $('#station_updateElement').val("");  //Clear the field.
                    $("#station_updateElement").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_updateElement').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("StationNo not picked");
                    $('#stationNo_updateElement').val("");  //Clear the field.
                    $("#stationNo_updateElement").focus();
                    return false;

                }
                var stationRegion=$('#stationRegion_updateElement').val();
                if (stationRegion==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Region not picked");
                    $('#stationRegion_updateElement').val("");  //Clear the field.
                    $("#stationRegion_updateElement").focus();
                    return false;

                }

                //Check that Date selected
                var station_OC=$('#station_OC').val();
                if(station_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not Selected");
                    $('#station_OC').val("");  //Clear the field.
                    $("#station_OC").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var stationNo_OC=$('#stationNo_OC').val();
                if(stationNo_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("StationNo not picked");
                    $('#stationNo_OC').val("");  //Clear the field.
                    $("#stationNo_OC").focus();
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
                //Check that Instrument is selected
                var instrumentname_element_Update=$('#instrumentname_element_Update').val();
                // var instrumentname_element_Manager=$('#instrumentname_element_OC').val();
                if(instrumentname_element_Update==""){  // returns true if the variable does NOT contain a valid number
                    alert("Instrument Name not picked");
                    $('#instrumentname_element_Update').val("");  //Clear the field.
                    $("#instrumentname_element_Update").focus();
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
            });
        });
    </script>

    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number should be picked from the DB.
        //Add Element.
        $(document.body).on('change','#station_insertElement_element',function(){
            $('#stationNo_insertElement_element').val("");  //Clear the field.
            var stationName = this.value;
            if (stationName != "") {
                //alert(station);
                $('#stationNo_insertElement_element').val("");
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

                            $('#stationNo_insertElement_element').empty();

                            // alert(data);
                            $("#stationNo_insertElement_element").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNo_insertElement_element').empty();
                            $('#stationNo_insertElement_element').val("");
                        }
                    }
                });
            }
            else {

                $('#stationNo_insertElement_element').empty();
                $('#stationNo_insertElement_element').val("");
            }
        })
    </script>
    <script type="text/javascript">
        //Once the Manager/Zonal Officer/Senior Zonal Officer loads the page the value of Selected Station is displayed.So Get the StationNumber from the DB.
        //On Update Element
        var stationName = $("#station_updateElement").val();
        $('#stationNo_updateElement').val("");  //Clear the field.

        if (stationName != "") {
            //alert(station);
            $('#stationNo_updateElement').val("");
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

                        $('#stationNo_updateElement').empty();

                        // alert(data);
                        $("#stationNo_updateElement").val(json[0].StationNumber);

                    }
                    else{

                        $('#stationNo_updateElement').empty();
                        $('#stationNo_updateElement').val("");

                    }
                }

            });
        }
        else {

            $('#stationNo_updateElement').empty();
            $('#stationNo_updateElement').val("");
        }
    </script>


    <script type="text/javascript">
        //Once the Manager selects the Station, the Instruments attached to the Stations shd be picked from the InstrumentsTable DB.
        //Add Element.
        $(document.body).on('change','#station_insertElement_element',function(){
            $('#instrumentname_element').html('');//Clear the field.
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
                            $('#instrumentname_element').html('');
                            //$select.html('');
                            $("#instrumentname_element").append($('<option>').text("--Select Instrument Used to Measure Element--").attr('value', ''));
                            //alert(data);

                            //var json = JSON.parse(data);
                            // var json = JSON.parse(data);
                            // alert(json[0].InstrumentName);

                            var json = JSON.parse(data);
                            var i ;

                            for (i = 0; i < data.length; i++) {
                                $("#instrumentname_element").append($('<option>').text(json[i].InstrumentName)
                                    .attr('value', json[i].InstrumentName));
                            }
                        }
                        else{

                            $('#instrumentname_element').html('');

                        }

                    }//end of if for data


                }); //end of ajax.
            }//end of if
        })

    </script>



    <script type="text/javascript">
        //Once the OC  Station is autopopulated. the Instruments attached to the Stations shd   be picked from the InstrumentsTable DB.
        //Add Element.
        $('#instrumentname_element').html(''); //Clear the field.
        var stationName =  $('#station_OC_element').val();  //$("#stationAdmin").val();
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
                        $('#instrumentname_element').html('');
                        //$select.html('');

                        //alert(data);
                        $("#instrumentname_element").append($('<option>').text("--Select Instrument Used to Measure the Element--").attr('value', ''));

                        //var json = JSON.parse(data);
                        // var json = JSON.parse(data);
                        // alert(json[0].InstrumentName);

                        var json = JSON.parse(data);
                        var i ;

                        for (i = 0; i < data.length; i++) {
                            $("#instrumentname_element").append($('<option>').text(json[i].InstrumentName)
                                .attr('value', json[i].InstrumentName));
                        }


                    }
                    else{

                        $('#instrumentname_element').html('');

                    }

                }//end of if for data


            }); //end of ajax.
        }//end of if
    </script>




<?php require_once(APPPATH . 'views/footer.php'); ?>