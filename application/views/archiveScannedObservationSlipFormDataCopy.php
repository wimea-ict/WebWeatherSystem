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
            Archive Scanned Observation Slip Form Copy
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Observation Slip Form Copy</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedObservationSlipFormDetails) && count($displaynewFormToArchiveScannedObservationSlipFormDetails)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/insertInformationForArchiveScannedObservationSlipFormDetails/"  method="post" enctype="multipart/form-data">
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
                                <span class="input-group-addon">Form</span>
                                <input type="text" name="formname_observationslipform" id="formname_observationslipform" readonly="readonly" required class="form-control" value="<?php echo 'Observation Slip Form';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield">

                            </div>
                        </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="station_ArchiveScannedObservationSlipForm" id="station_ArchiveScannedObservationSlipForm" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Station Number</span>
                                <input type="text" name="stationNo_ArchiveScannedObservationSlipForm" required class="form-control" id="stationNo_ArchiveScannedObservationSlipForm" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> TIME</span>
                                <select name="time_ArchiveScannedObservationSlipForm" id="time_ArchiveScannedObservationSlipForm" required class="form-control">
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
                                </select> </div>
                        </div>




                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Date</span>
                                <input type="text" name="dateOnScannedObservationSlipForm_observationslipform" id="date" required class="form-control"  placeholder="Enter To the Date">

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_observationslipform" class="form-control" onkeyup="" style="height:40px;" id="description_observationslipform"></textarea>
                        </div>





                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">  Select file to upload:</span>
                                <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_observationslipform" id="archievescannedcopy_observationslipform" required class="form-control" size = "40">
                            <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                            </div>

                            <p class="help-block">Lighter file is better</p>
                        </div>
                        <script type="text/javascript">
                            function readURL(input) {

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#archievescannedcopy_observationslipform').val(e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#archievescannedcopy_observationslipform").change(function(){
                                readURL(this);
                            });
                        </script>


                    </div>
                </div>
                <div class="modal-footer clearfix"></div>
                <div class="clearfix"></div>
        </div>
        <center>

            <a href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>

            <button type="submit" id="postScannedObservationSlipFormCopy_button" name="postScannedObservationSlipFormCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT </button>
        </center>
        </form>
        </div>
    <?php
    }elseif((is_array($scannedobservationslipformcopyidDetails) && count($scannedobservationslipformcopyidDetails))) {
        foreach($scannedobservationslipformcopyidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/updateInformationForArchiveScannedObservationSlipFormDetails" method="post" enctype="multipart/form-data">
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
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="station" id="station" required class="form-control" value="<?php echo $idDetails->StationName;?>"  readonly class="form-control" >
                                        <input type="hidden" name="id" id="id" required class="form-control" value="<?php echo $idDetails->id;?>"  readonly class="form-control" >

                                    </div>
                                </div>




                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="hidden" name="stationId" required class="form-control" id="stationId" readonly class="form-control" value="<?php echo $idDetails->station;?>" readonly="readonly" >
                                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $idDetails->StationNumber;?>" readonly="readonly" >
                                    </div>
                                </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> TIME</span>
                                    <input type="text" name="timeRecorded" required class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $idDetails->TIME;?>" readonly="readonly" >

                                </div>
                            </div>






                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Date</span>
                                    <input type="text" name="dateOnScannedObservationSlipForm" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->form_date;?>" id="expdate" readonly="readonly" readonly class="form-control">
                                </div>
                            </div>



                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" onkeyup="" class="form-control" style="height:40px;" id="description">  <?php echo $idDetails->Description;?>    </textarea>

                            </div>



                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">  Select file to upload:</span>
                                    <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls"  value="<?php echo $idDetails->Description;?>" name="updatearchievescannedcopy_observationslipform" id="updatearchievescannedcopy_observationslipform"  class="form-control" size = "40">
                                    <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                                </div>

                                <p class="help-block">Lighter file is better</p>
                            </div>
                            <script type="text/javascript">

                                function readURL(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#updatearchievescannedcopy_observationslipform').val(e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#updatearchievescannedcopy_observationslipform").change(function(){
                                    readURL(this);
                                });
                            </script>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class = 'pull-left'>Previously Uploaded File</i>

									<a href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedObservationSlipFormDataCopy/ViewImageFromBrowser/<?php echo $idDetails->FileRef;?>" target = "blank"><?php echo $idDetails->FileRef;?></a>
									</span>
								</div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Approved</span>
                                    <select name="approval" id="approval"  required class="form-control">
                                        <option value="<?php echo $idDetails->Approved;?>"><?php echo $idDetails->Approved;?></option>
                                        <option value="">--Select Approval Options--</option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
            </div>
            <center>

                <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                <button type="submit" name="updateScannedObservationSlipFormCopy_button" id="updateScannedObservationSlipFormCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
            </center>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormDetails/">
                    <i class="fa fa-plus"></i> Add new Scanned Observation Slip Form</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Observation Slip Form Details</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Date</th>
                                <th>TIME</th>
                                <th>Description</th>
                                <th>Approved</th>
                                <th>By</th>
                            <?php if($userrole=="OC"|| $userrole=="ObserverArchive"){ ?>
                                    <th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($archivedscannedobservationslipformcopydetails) && count($archivedscannedobservationslipformcopydetails)) {
                                foreach($archivedscannedobservationslipformcopydetails as $data){
                                    $count++;
                                    $scannedobservationslipformdatadetails = $data->id;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->form_date;?></td>
                                        <td ><?php echo $data->TIME;?></td>
                                        <td><?php echo $data->Description;?></td>
                                        <td ><?php echo $data->Approved?"TRUE":"FALSE";?></td>
                                        <td><?php echo $data->SubmittedBy;?></td>
                                   <?php if($userrole=="OC"|| $userrole=="ObserverArchive"){ ?>
                                     <td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormForUpdate/" .$data->id ;?>" style="cursor:pointer;">Edit</a>
                                  </td>
                                    </tr>

                                <?php
                                }
                            }
                          }
                            ?>
                            </tbody>
                        </table>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT</button>
                    </div>
                </div>
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
            //Post Add New  Archive Scanned Copy of  Metar  form  data into the DB
            //Validate each select field before inserting into the DB
            $('#postScannedObservationSlipFormCopy_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedObservationSlipFormDataCopyDetails();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Observation Slip Form Record with the Same date ,Station Name and Station Number and TIME Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number or date not picked");
                    return false;
                }

                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").focus();
                    return false;

                }


                //Check that Form name  is picked
                var formname=$('#formname_observationslipform').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_observationslipform').val("");  //Clear the field.
                    $("#formname_observationslipform").focus();
                    return false;

                }

                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }




                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_ArchiveScannedObservationSlipForm').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedObservationSlipForm').val("");  //Clear the field.
                    $("#station_ArchiveScannedObservationSlipForm").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedObservationSlipForm').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedObservationSlipForm').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedObservationSlipForm").focus();
                    return false;

                }
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_archiveobservationslipform=$('#time_ArchiveScannedObservationSlipForm').val();
                if(time_archiveobservationslipform==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#time_ArchiveScannedObservationSlipForm').val("");  //Clear the field.
                    $("#time_ArchiveScannedObservationSlipForm").focus();
                    return false;

                }
                //Check that the a file has been uploaded
                var filenameselected=$('#archievescannedcopy_observationslipform').val();
                if(filenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#archievescannedcopy_observationslipform").focus();
                    return false;

                }



            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedObservationSlipFormDataCopyDetails(){

            //Check against the date,stationName,SManagernNumber,Time and Metar Option.
            var date= $('#date').val();



            var stationName = $('#station_ArchiveScannedObservationSlipForm').val();
            var stationNumber = $('#stationNo_ArchiveScannedObservationSlipForm').val();
            var time=$('#time_ArchiveScannedObservationSlipForm').val();



            $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedObservationSlipFormDataCopy/checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time': time,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").val();

            }//end of if
            else if((date == undefined) || (time == undefined) ||  (stationName == undefined) || (stationNumber == undefined)){

                var truthvalue="Missing";
            }


            return truthvalue;
        }//end of check duplicate values in the DB
        // return false;

    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive Dekadal form Report data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updateScannedObservationSlipFormCopy_button').click(function(event) {

                //Check that Form name  is picked
                var formname=$('#formname').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname').val("");  //Clear the field.
                    $("#formname").focus();
                    return false;

                }



                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Date not picked");
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
                //Check that the a file has been uploaded
                var updatefilenameselected=$('#updatearchievescannedcopy_observationslipform').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_observationSlipForm').val();
                if((updatefilenameselected=="") && (previouslyuploadedfileName=="")){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_observationslipform").focus();
                    return false;
                }

                //Check that the a file has been uploaded and also the previously Uploaded file
                var updatefilenameselected=$('#updatearchievescannedcopy_observationslipform').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_observationSlipForm').val();
                if((updatefilenameselected!="") && (previouslyuploadedfileName!="")){  // returns true if the variable does NOT contain a valid number
                    alert(" A file has been  Uploaded and also previously uploaded file");
                    $('#updatearchievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_observationslipform").focus();
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

            var newValue_description;
            var oldValue_description=$('#description').val();

            $('#description').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
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
        //Once the Admin selects the Station the StaManagerNumber should be picked from the DB Automatically.
        // For InseManagerd Archieve DekManagerForm Data
        $(document.body).on('change','#stationArchiveScannedObservationSlipFormManager',function(){
            $('#stationNoArchiveScannedObservationSlipFormManager').val("");  //Managerar the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoArchiveScannedObservationSlipFormManager').val("");
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

                            $('#stationNoArchiveScannedObservationSlipFormManager').val("");

                            // alert(data);
                            $("#stationNoArchiveScannedObservationSlipFormManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoArchiveScannedObservationSlipFormManager').empty();
                            $('#stationNoArchiveScannedObservationSlipFormManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoArchiveScannedObservationSlipFormManager').empty();
                    $('#stationNoArchiveScannedObservationSlipFormManager').val("");
                }     })

    </script>


<?php require_once(APPPATH . 'views/footer.php'); ?>
