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
            Archive Scanned Synoptic Form Copy
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Synoptic Form Copy</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedSynopticFormReportDetails) && count($displaynewFormToArchiveScannedSynopticFormReportDetails)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedSynopticFormDataReportCopy/insertInformationForArchiveScannedSynopticFormReport/"  method="post" enctype="multipart/form-data">
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
                                <input type="text" name="formname_synoptic" id="formname_synoptic" readonly="readonly" required class="form-control" value="<?php echo 'SynopticForm';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield">

                            </div>
                        </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>

                                    <select name="station_ArchiveScannedSynopticFormReport" id="stationManager"   class="form-control" placeholder="Select Station">
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

                                     <input type="text" name="stationNo_ArchiveScannedSynopticFormReport"  id="stationNoManager" required class="form-control" value=""  readonly   >
                                </div>
                            </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Date</span>
                                <input type="text" name="dateOnScannedSynopticFormReport_synoptic" id="date" required class="form-control"  placeholder="Enter To the Date">

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_synoptic" class="form-control" onkeyup="" style="height:40px;" id="description_metar"></textarea>
                        </div>

                        <br><br>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">  Select First Part Form File to Upload:</span>
                                <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_synopticformreport_firstpage" id="archievescannedcopy_synopticformreport_firstpage" required class="form-control" size = "40">
                                <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                            </div>

                            <p class="help-block">Lighter file is better</p>
                        </div>
                        <script type="text/javascript">
                            function readURL(input) {

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#archievescannedcopy_synopticformreport_firstpage').val(e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#archievescannedcopy_synopticformreport_firstpage").change(function(){
                                readURL(this);
                            });
                        </script>

                        <br><br>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">  Select Second Part Form File to Upload:</span>
                                <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_synopticformreport_secondpage" id="archievescannedcopy_synopticformreport_secondpage" required class="form-control" size = "40">
                                <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                            </div>

                            <p class="help-block">Lighter file is better</p>
                        </div>
                        <script type="text/javascript">
                            function readURL2(input) {

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#archievescannedcopy_synopticformreport_secondpage').val(e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#archievescannedcopy_synopticformreport_secondpage").change(function(){
                                readURL2(this);
                            });
                        </script>



                    </div>
                </div>
                <div class="modal-footer clearfix"></div>
                <div class="clearfix"></div>
        </div>
        <center>

            <a href="<?php echo base_url(); ?>index.php/ArchiveScannedSynopticFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

            <button type="submit" id="postScannedSynopticFormDataReportCopy_button" name="postScannedSynopticFormDataReportCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT</button>
        </center>
        </form>
        </div>
    <?php
    }elseif((is_array($scannedsynopticformreportcopyidDetails) && count($scannedsynopticformreportcopyidDetails))) {
        foreach($scannedsynopticformreportcopyidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/ArchiveScannedSynopticFormDataReportCopy/updateInformationForArchiveScannedSynopticFormReport" method="post" enctype="multipart/form-data">
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
                                    <input type="text" name="dateOnScannedSynopticFormReport" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->form_date;?>" id="expdate" readonly="readonly" readonly class="form-control">
                                </div>
                            </div>



                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" onkeyup="" class="form-control" style="height:40px;" id="description">  <?php echo $idDetails->Description;?>    </textarea>

                            </div>

                            <br><br>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">  Select First Part Form File to Upload:</span>
                                    <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls"   name="updatearchievescannedcopy_synopticformreport_firstpage" id="updatearchievescannedcopy_synopticformreport_firstpage"  class="form-control" size = "40">
                                    <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                                </div>

                                <p class="help-block">Lighter file is better</p>
                            </div>
                            <script type="text/javascript">

                                function readURL_update(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#updatearchievescannedcopy_synopticformreport_firstpage').val(e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#updatearchievescannedcopy_synopticformreport_firstpage").change(function(){
                                    readURL_update(this);
                                });
                            </script>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class = "pull-left">Previously Uploaded File 1</i>
									<a href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedSynopticFormDataReportCopy/ViewImageFromBrowser/<?php echo $idDetails->FileRef;?>" target = "blank"><?php echo $idDetails->FileRef;?></a>
									</span>

                                </div>
                            </div>

                            <br><br>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">  Select Second Part Form File to Upload:</span>
                                    <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls"   name="updatearchievescannedcopy_synopticformreport_secondpage" id="updatearchievescannedcopy_synopticformreport_secondpage"  class="form-control" size = "40">
                                    <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                                </div>

                                <p class="help-block">Lighter file is better</p>
                            </div>
                            <script type="text/javascript">

                                function readURL2_update(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#updatearchievescannedcopy_synopticformreport_secondpage').val(e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#updatearchievescannedcopy_synopticformreport_secondpage").change(function(){
                                    readURL2_update(this);
                                });
                            </script>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Previously Uploaded Part File 2</span>
                                    <input type="text" name="PreviouslyUploadedFileName_synopticformreport_secondpage" id="PreviouslyUploadedFileName_synopticformreport_secondpage" required class="form-control"  value="<?php echo $idDetails->FileName_SecondPage;?>"  readonly="readonly" readonly class="form-control">
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

                <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedSynopticFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                <button type="submit" name="updateScannedSynopticFormDataReportCopy_button" id="updateScannedSynopticFormDataReportCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
            </center>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedSynopticFormDataReportCopy/DisplayFormToArchiveScannedSynopticFormReportDetails/">
                    <i class="fa fa-plus"></i> Add new Scanned Synoptic Form</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Synoptic Form Details</h3>
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
								<th>First page</th>
                                <th>Second Page</th>
                                <th>Description</th>
                                <th>Approved</th>
                                <th>By</th>
                            <?php if($userrole=="OC"|| $userrole=="ObserverArchive"||$userrole=="DataOfficer"||$userrole=="SeniorDataOfficer"){ ?>
                                    <th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($archivedscannedsynopticformreportcopydetails) && count($archivedscannedsynopticformreportcopydetails)) {
                                foreach($archivedscannedsynopticformreportcopydetails as $data){
                                  

                                    $scannedsynopticformdatadetails = $data->id;
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
										  <td class="no-print">
                                   <a title="click to view file" href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedSynopticFormDataReportCopy/ViewImageFromBrowser/<?php echo $data->FileName_FirstPage;?>" target = "blank"><?php echo $data->FileName_FirstPage;?></a>
                                  
                                </td>
                                <td class="no-print">
                                   <a title="click to view file" href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedSynopticFormDataReportCopy/ViewImageFromBrowser/<?php echo $data->FileName_SecondPage;?>" target = "blank"><?php echo $data->FileName_SecondPage;?></a>
                                  
                                </td>
                                        <td><?php echo $data->Description;?></td>
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SD_SubmittedBy;?></td>
                                   <?php if($userrole=="OC"|| $userrole=="ObserverArchive"||$userrole=="DataOfficer"||$userrole=="SeniorDataOfficer"){?>
                                     <td class="no-print">

									<table>
                                         <tr><td>
                                          
                                            <a  class= "btn btn-primary" href="<?php echo base_url() . "index.php/ArchiveScannedSynopticFormDataReportCopy/DisplayFormToArchiveScannedSynopticFormReportForUpdate/" .$data->id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li> Edit</a>
                                    </td>
											<?php if($userrole=='SeniorDataOfficer'){?>
											<td>
											
											<form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedSynopticFormDataReportCopy/update_approval/" .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
											</td><?php }?> 
									     </tr>
										 </table>
									</td>
                                    </tr>

                                <?php
									   }}
                            }
                          }
                            ?>
                            </tbody>
                        </table>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT</button>
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
            $('#postScannedSynopticFormDataReportCopy_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedSynopticFormDataReportCopy();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Synoptic Record with the Same date ,Station Name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number or date not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
             /*   var hiddenvalue=$('#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield").focus();
                    return false;

                }*/

                //Check that Form name  is picked
                var formname=$('#formname_synoptic').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_synoptic').val("");  //Clear the field.
                    $("#formname_synoptic").focus();
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
                var station=$('#station_ArchiveScannedSynopticFormReport').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedSynopticFormReport').val("");  //Clear the field.
                    $("#station_ArchiveScannedSynopticFormReport").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedSynopticFormReport').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedSynopticFormReport').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedSynopticFormReport").focus();
                    return false;

                }
                //Check that the a file has been uploaded
                var filenameselected1=$('#archievescannedcopy_synopticformreport_firstpage').val();
                if(filenameselected1==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_synopticformreport_firstpage').val("");  //Clear the field.
                    $("#archievescannedcopy_synopticformreport_firstpage").focus();
                    return false;

                }

                //Check that the a file has been uploaded
                var filenameselected2=$('#archievescannedcopy_synopticformreport_secondpage').val();
                if(filenameselected2==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_synopticformreport_secondpage').val("");  //Clear the field.
                    $("#archievescannedcopy_synopticformreport_secondpage").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedSynopticFormDataReportCopy(){

            //Check against the date,stationName,SManagernNumber,Time and Metar Option.
            var date= $('#date').val();


            var stationName = $('#stationManager').val();
          var stationNumber = $('#stationNoManager').val();




            $('#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedSynopticFormDataReportCopy/checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedSynopticFormDataReportCopy_hiddentextfield").val();

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
            $('#updateScannedSynopticFormDataReportCopy_button').click(function(event) {

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
                var updatefilenameselected1=$('#updatearchievescannedcopy_synopticformreport_firstpage').val();
                var previouslyuploadedfileName1=$('#PreviouslyUploadedFileName_synopticformreport_firstpage').val();
                if((updatefilenameselected1=="") && (previouslyuploadedfileName1=="")){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_synopticformreport_firstpage').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_synopticformreport_firstpage").focus();
                    return false;

                }
                // //Check that the a file has been uploaded and also the previously Uploaded file
                // var updatefilenameselected1_1=$('#updatearchievescannedcopy_synopticformreport_firstpage').val();
                // var previouslyuploadedfileName1_1=$('#PreviouslyUploadedFileName_synopticformreport_firstpage').val();
                // if((updatefilenameselected1_1!="") && (previouslyuploadedfileName1_1!="")){  // returns true if the variable does NOT contain a valid number
                //     alert(" A file has been  Uploaded and also previously uploaded file");
                //     $('#updatearchievescannedcopy_synopticformreport_firstpage').val("");  //Clear the field.
                //     $("#updatearchievescannedcopy_synopticformreport_firstpage").focus();
                //     return false;
                // }

                //Check that the a file has been uploaded
                var updatefilenameselected2=$('#updatearchievescannedcopy_synopticformreport_secondpage').val();
                var previouslyuploadedfileName2=$('#PreviouslyUploadedFileName_synopticformreport_secondpage').val();
                if((updatefilenameselected2=="") && (previouslyuploadedfileName2=="")){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_synopticformreport_secondpage').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_synopticformreport_secondpage").focus();
                    return false;

                }
                //Check that the a file has been uploaded and also the previously Uploaded file
              /*  var updatefilenameselected2_1=$('#updatearchievescannedcopy_synopticformreport_secondpage').val();
                var previouslyuploadedfileName2_1=$('#PreviouslyUploadedFileName_synopticformreport_secondpage').val();
                if((updatefilenameselected2_1!="") && (previouslyuploadedfileName2_1!="")){  // returns true if the variable does NOT contain a valid number
                    alert(" A file has been  Uploaded and also previously uploaded file");
                    $('#updatearchievescannedcopy_synopticformreport_secondpage').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_synopticformreport_secondpage").focus();
                    return false;
                }
*/






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
        //Once the Admin selects the Station the StManager Number should be picked from the DB Automatically.
        // For InManagerAdd Archieve DeManager Form Data
        $(document.body).on('change','#stationArchiveScannedSynopticFormReportManager',function(){
            $('#stationNoArchiveScannedSynopticFormReportManager').val("");// Managerear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoArchiveScannedSynopticFormReportManager').val("");
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

                            $('#stationNoArchiveScannedSynopticFormReportManager').val("");

                            // alert(data);
                            $("#stationNoArchiveScannedSynopticFormReportManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoArchiveScannedSynopticFormReportManager').empty();
                            $('#stationNoArchiveScannedSynopticFormReportManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoArchiveScannedSynopticFormReportManager').empty();
                    $('#stationNoArchiveScannedSynopticFormReportManager').val("");
                }     })

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
