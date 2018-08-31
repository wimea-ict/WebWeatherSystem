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
            Archive Scanned Metar Form Copy
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Metar Form Copy</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedMetarForm) && count($displaynewFormToArchiveScannedMetarForm)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedMetarFormDataCopy/insertInformationForArchiveScannedMetarForm/"  method="post" enctype="multipart/form-data">
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
                                <input type="text" name="formname_metar" id="formname_metar" readonly="readonly" required class="form-control" value="<?php echo 'MetarReport';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield">

                            </div>
                        </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="station_ArchiveScannedMetarForm" id="stationManager"   class="form-control" placeholder="Select Station">
                                    <option value="">Select Station</option>
                                    <?php
                                    if (is_array($stationsdata) && count($stationsdata)) {
                                        foreach($stationsdata as $station){?>
                                            <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                        <?php }
                                    } ?>
                                </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                     <input type="text" name="stationNo_ArchiveScannedMetarForm"  id="stationNoManager" required class="form-control" value=""  readonly   >
                                </div>
                            </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Date</span>
                                <input type="text" name="dateOnScannedMetarForm_metar" id="date" required class="form-control"  placeholder="Enter To the Date">

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_metar" class="form-control" onkeyup="" style="height:40px;" id="description_metar"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">  Select file to upload:</span>
                                <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_metarform" id="archievescannedcopy_metarform" required class="form-control" size = "40">
                                <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                            </div>

                            <p class="help-block">Lighter file is better</p>
                        </div>
                        <script type="text/javascript">
                            function readURL(input) {

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#archievescannedcopy_metarform').val(e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#archievescannedcopy_metarform").change(function(){
                                readURL(this);
                            });
                        </script>




                    </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
                </div>
                <center>

                    <a href="<?php echo base_url(); ?>index.php/ArchiveScannedMetarFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                    <button type="submit" id="postScannedMetarFormDataCopy_button" name="postScannedMetarFormDataCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT </button>
                </center>
            </form>
        </div>
    <?php
    }elseif((is_array($scannedmetarformidDetails) && count($scannedmetarformidDetails))) {
        foreach($scannedmetarformidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/ArchiveScannedMetarFormDataCopy/updateInformationForArchiveScannedMetarForm" method="post" enctype="multipart/form-data">
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
                                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $idDetails->StationNumber;?>" readonly="readonly" >
                                        <input type="hidden" name="stationId" required class="form-control" id="stationId" readonly class="form-control" value="<?php echo $idDetails->station;?>" readonly="readonly" >

                                    </div>
                                </div>







                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Date</span>
                                    <input type="text" name="dateOnScannedMetarForm" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->form_date;?>" id="expdate" readonly="readonly" readonly class="form-control">
                                </div>
                            </div>



                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" onkeyup="" class="form-control" style="height:40px;" id="description">  <?php echo $idDetails->Description;?>    </textarea>

                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">  Select file to upload:</span>
                                    <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls"  value="<?php echo $idDetails->Description;?>" name="updatearchievescannedcopy_metarform" id="updatearchievescannedcopy_metarform"  class="form-control" size = "40">
                                    <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                                </div>

                                <p class="help-block">Lighter file is better</p>
                            </div>
                            <script type="text/javascript">

                                function readURL(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#updatearchievescannedcopy_metarform').val(e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#updatearchievescannedcopy_metarform").change(function(){
                                    readURL(this);
                                });
                            </script>

                            <div class="form-group">
                                <div class="input-group">
									 <span class="input-group-addon"><i class = "pull-left"> Previously Uploaded File </i>
									<a href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedMetarFormDataCopy/ViewImageFromBrowser/<?php echo $idDetails->FileRef;?>" target = "blank"> <?php echo $idDetails->FileRef;?></a>
									</span>
                                     <input type="hidden" name="PreviouslyUploadedFileName_metarform" id="PreviouslyUploadedFileName_metarform" required class="form-control"  value="<?php echo $idDetails->FileRef;?>"  readonly="readonly" readonly class="form-control">

                                   </div>
								
                            </div>




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Approved</span>
                                   
										<?php if($userrole=="DataOfficer" || $idDetails->Approved=='TRUE'){?>
								<select name="approval" id="approval" disabled  class="form-control" >
									<option value="<?php echo $idDetails->Approved;?>"><?php echo $idDetails->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<input type="hidden" name="approval" value="<?php echo $idDetails->Approved;?>">
								<?php }else{?>
								   <select name="approval" id="approval"  class="form-control" >
									<option value="<?php echo $idDetails->Approved;?>"><?php echo $idDetails->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<?php }?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
            </div>
            <center>

                <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedMetarFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>

                <button type="submit" name="updateScannedMetarFormDataCopy_button" id="updateScannedMetarFormDataCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
            </center>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedMetarFormDataCopy/DisplayFormToArchiveScannedMetarForm/">
                    <i class="fa fa-plus"></i> Add new Scanned Metar Form</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Metar Form Details</h3>
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
								<th>File Name</th>
                                <th>Description</th>
                                <th>Approved</th>
                                <th>By</th>
                            
                                    <th class="no-print">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($archivedscannedmetarformdetails) && count($archivedscannedmetarformdetails)) {
                                foreach($archivedscannedmetarformdetails as $data){
                                   
                                    $scannedmetarformdetails = $data->id;
									if($userrole =='DataOfficer' && $data->Approved =='TRUE' ){
									   $count++;
									   }else{
										   $count++;


                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->form_date;?></td>
										<td>
										<a title="click to view file" href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedMetarFormDataCopy/ViewImageFromBrowser/<?php echo $data->FileRef;?>"><?php echo $data->FileRef;?></a> 
										
                                        </td>
                                        <td><?php echo $data->Description;?></td>
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SD_SubmittedBy;?></td>
                                  
                                     <td class="no-print">

                                            <table>
                                         <tr><td>
                                           <a class="btn btn-primary" href="<?php echo base_url() . "index.php/ArchiveScannedMetarFormDataCopy/DisplayFormToArchiveScannedMetarFormForUpdate/" .$data->id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Edit</a>
											</td>
											<?php if($userrole=='SeniorDataOfficer'){?>
											<td>
											
											<form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedMetarFormDataCopy/update_approval/" .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
											</td><?php }?> 
									     </tr>
										 </table>
									
									
									</td></tr>

                                <?php
									   }
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
            //Post Add New  Archive Scanned Copy of  Metar  form  data into the DB
            //Validate each select field before inserting into the DB
            $('#postScannedMetarFormDataCopy_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedMetarFormDataCopy();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Metar Record with the Same date ,Station Name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number or date not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
              /*  var hiddenvalue=$('#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield").focus();
                    return false;

                }*/

                //Check that Form name  is picked
                var formname=$('#formname_metar').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_metar').val("");  //Clear the field.
                    $("#formname_metar").focus();
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
                var station=$('#station_ArchiveScannedMetarForm').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedMetarForm').val("");  //Clear the field.
                    $("#station_ArchiveScannedMetarForm").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedMetarForm').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedMetarForm').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedMetarForm").focus();
                    return false;

                }
                //Check that the a file has been uploaded
                var filenameselected=$('#archievescannedcopy_metarform').val();
                if(filenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_metarform').val("");  //Clear the field.
                    $("#archievescannedcopy_metarform").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedMetarFormDataCopy(){

            //Check against the date,stationName,SManagernNumber,Time and Metar Option.
       var date= $('#date').val();

            var stationName = $('#stationManager').val();
            var stationNumber=$('#stationNoManager').val();


            $('#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedMetarFormDataCopy/checkInDBIfArchiveScannedMetarFormDataCopyRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedMetarFormDataCopy_hiddentextfield").val();

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
            //Update  Archive Dekadal form Report data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updateScannedMetarFormDataCopy_button').click(function(event) {

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
                var updatefilenameselected=$('#updatearchievescannedcopy_metarform').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_metarform').val();
                if((updatefilenameselected=="") && (previouslyuploadedfileName=="")){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_metarform').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_metarform").focus();
                    return false;
                }

                //Check that the a file has been uploaded and also the previously Uploaded file
           /*     var updatefilenameselected=$('#updatearchievescannedcopy_metarform').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_metarform').val();
                if((updatefilenameselected!="") && (previouslyuploadedfileName!="")){  // returns true if the variable does NOT contain a valid number
                    alert(" A file has been  Uploaded and also previously uploaded file");
                    $('#updatearchievescannedcopy_metarform').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_metarform").focus();
                    return false;
                }*/

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
        //Once the Admin selects the StatiManagere Station Number should be picked from the DB Automatically.Manager    // For Insert/Add ArManagere Dekadal Form Data
        $(document.body).on('change','#sManagernArchiveScannedMetarFormAdmin',function(){
            $('#stationNoArchiveScannedMetarFormAdmin').Manager");  //Clear the field.
            var stationName = this.value;


            if (stationNaManager "") {
                //alert(station);
                $('#stationNoArchiveScannedMetarFormAdmin').val("");
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/getStationNumber",
                    type: "POST",
                    data: {'stationName': stationName},
                    cache: false,
                    //dataType: "JSON",
                    successManagerction(data){
                        if (data)
                        {
                      Manager var json = JSON.Manager(data);

                            $('#stationNoArchiveScannedMetarFormAdmin').empty();

      Manager                 // alert(data);
              Manager         $("#stationNoArchiveScannedMetarFormAdmin").val(json[0].StationNuManager;

                 Manager  }
                        else{

                            $('#stationManagerhiveScannedMetarFormAdmin').empty();
                        Manager('#stationNoArchiveScannedMetarFormAdmin').val("");

         Manager          }
                    }

 Manager          });



            }
            else {

           Manager$('#stationNoArchiveScannedMetarFormAdmin').empty();
                $('#stationNoArchiveScannedMetarFormAdmin').val("");
            }

        })

    </script>
     <script type="text/javascript">
        //Once the Admin selects the Station the Station Number should be picked from the DB.
        // For Add Update Daily
        $(document).on('change','#stationManager',function(){
            $('#stationNoManager').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoManager').val("");
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

                            //alert(data);
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



<?php require_once(APPPATH . 'views/footer.php'); ?>
