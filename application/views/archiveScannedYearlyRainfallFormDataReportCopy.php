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
            Archive Scanned Yearly Rainfall Form Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Yearly Rainfall Form Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedYearlyRainfallFormReport) && count($displaynewFormToArchiveScannedYearlyRainfallFormReport)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/insertInformationForArchiveScannedYearlyRainfallFormReport/"  method="post" enctype="multipart/form-data">
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
                                <input type="text" name="formname_yearlyrainfallformreport" id="formname_yearlyrainfallformreport" required class="form-control" value="<?php echo 'Annual Rainfall Form';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield">

                            </div>
                        </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="station_ArchiveScannedYearlyRainfallFormReport" id="station_ArchiveScannedYearlyRainfallFormReport" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNo_ArchiveScannedYearlyRainfallFormReport" required class="form-control" id="stationNo_ArchiveScannedYearlyRainfallFormReport" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                </div>
                            </div>





                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Year</span>
                                <input type="text" name="yearOfScannedYearlyRainfallFormReport_yearlyrainfallformreport" id="year" required class="form-control"  placeholder="Enter the year">

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_yearlyrainfallformreport" onkeyup="allowCharactersInputOnly(this)" class="form-control" style="height:150px;" id="description_yearlyrainfallformreport"></textarea>

                        </div>

                        <div style="width:160px; height:120px; margin-bottom:4px; max-height:120px; overflow:hidden; border:1px solid; position:relative" class="pull-left">
                            <img id="blah" src="#" alt="your image" class="img-responsive" />
                            <label style="position:absolute; bottom:0; left:0; width:100%; height:15px; background:rgbargba(0,0,0,.4); color:#fff;" id="name"></label>
                        </div>
                        <div class="clearfix"></div>



                        <div class="form-group">
                            <div class="btn btn-success btn-file">
                                <i class="fa fa-paperclip"></i> Choose file
                                <input type="file" name="archievescannedcopy_yearlyrainfallformdatareport" id="archievescannedcopy_yearlyrainfallformdatareport" required class="form-control" size = "40">

                            </div>

                            <p class="help-block">Lighter images are better</p>
                        </div>
                        <script type="text/javascript">
                            function readURL(input) {

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#blah').attr('src', e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#archievescannedcopy_yearlyrainfallformdatareport").change(function(){
                                readURL(this);
                            });
                        </script>

                    </div>
                </div>
                <div class="modal-footer clearfix"></div>
                <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="postScannedArchiveYearlyRainfallFormReportDataCopy_button" name="postScannedArchiveYearlyRainfallFormReportDataCopy_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Archive Scanned Yearly Rainfall Form Report</button>
                </div>
            </form>
        </div>
    <?php
    }elseif((is_array($scannedyearlyrainfallformreportidDetails) && count($scannedyearlyrainfallformreportidDetails))) {
        foreach($scannedyearlyrainfallformreportidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/updateInformationForArchiveScannedYearlyRainfallFormReport" method="post" enctype="multipart/form-data">
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
                                    <span class="input-group-addon"> Form Name</span>
                                    <input type="text" name="formname" class="form-control" required value="<?php echo $idDetails->Form;?>" readonly="readonly"   readonly class="form-control" id="formname">
                                    <input type="hidden" name="id" value="<?php echo $idDetails->id;?>">
                                </div>
                            </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="station" id="station" required class="form-control" value="<?php echo $idDetails->StationName;?>"  readonly class="form-control" >

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $idDetails->StationNumber;?>" readonly="readonly" >
                                    </div>
                                </div>




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Year</span>
                                    <input type="text" name="yearOfScannedYearlyRainfallFormReport" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->Year;?>" id="year">
                                </div>
                            </div>



                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" onkeyup="allowCharactersInputOnly(this)" class="form-control" style="height:150px;" id="description"><?php echo $idDetails->Description;?></textarea>

                            </div>

                            <div style="width:500px; height:200px; margin-bottom:4px; max-height:120px; overflow:hidden; border:2px solid; position:relative" class="pull-left">
                                <img id="blah" src="<?php echo base_url().'archive/'. $idDetails->FileName ?>" alt="your image" class="img-responsive" />
                                <label style="position:absolute; bottom:0; left:0; width:100%; height:15px; background:rgbargba(0,0,0,.4); color:#fff;" id="name"></label>
                            </div>
                            <div class="clearfix"></div>



                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Choose file
                                    <input type="file" name="updatearchievescannedcopy_yearlyrainfallformdatareportcopy" id="updatearchievescannedcopy_yearlyrainfallformdatareportcopy"   required class="form-control" size = "40">

                                </div>

                                <p class="help-block">Lighter images are better</p>
                            </div>
                            <script type="text/javascript">
                                function readURL(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#blah').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#updatearchievescannedcopy_yearlyrainfallformdatareportcopy").change(function(){
                                    readURL(this);
                                });
                            </script>


                        </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updateScannedArchiveYearlyRainfallFormReportDataCopy_button" id="updateScannedArchiveYearlyRainfallFormReportDataCopy_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Scanned Yearly Rainfall Form Report Details</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/DisplayFormToArchiveScannedYearlyRainfallFormReport/">
                    <i class="fa fa-plus"></i> Add new Scanned Yearly Rainfall Form Report</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Yearly Rainfall Form Report Details</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Form</th>

                                <th>Station Name</th>
                                <th>Station Number</th>


                                <th>Year</th>
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

                            if (is_array($archivedscannedyearlyrainfallformreportdetails) && count($archivedscannedyearlyrainfallformreportdetails)) {
                                foreach($archivedscannedyearlyrainfallformreportdetails as $data){
                                    $count++;

                                    $scannedweathersummaryformreportdetails = $data->id;


                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->Form;?></td>

                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>

                                        <td ><?php echo $data->Year;?></td>

                                        <td><?php echo $data->Description;?></td>
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SubmittedBy;?></td>
                                   <?php if($userrole=="OC"|| $userrole=="ObserverArchive"){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/DisplayFormToArchiveScannedYearlyRainfallFormReportForUpdate/" .$data->id ;?>" style="cursor:pointer;">Edit</a>
                                         <!--   or <a href="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/deleteInformationForArchiveScannedYearlyRainfallFormReport/" .$data->id ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $data->Form;?>');">Delete</a></td><?php }?> -->
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
            //Post Add New  Archive Scanned Copy of  Metar  form  data into the DB
            //Validate each select field before inserting into the DB
            $('#postScannedArchiveYearlyRainfallFormReportDataCopy_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedYearlyRainfallFormDataReportCopy();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Yearly Rainfall Record with the Same year,Station Name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number  ,year not picked");
                    return false;
                }



                //Check that Form name  is picked
                var formname=$('#formname_yearlyrainfallformreport').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_yearlyrainfallformreport').val("");  //Clear the field.
                    $("#formname_yearlyrainfallformreport").focus();
                    return false;

                }


                //Check that Date selected
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the Year");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();
                    return false;

                }



                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_ArchiveScannedYearlyRainfallFormReport').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedYearlyRainfallFormReport').val("");  //Clear the field.
                    $("#station_ArchiveScannedYearlyRainfallFormReport").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedYearlyRainfallFormReport').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedYearlyRainfallFormReport').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedYearlyRainfallFormReport").focus();
                    return false;

                }

                //Check that the a file has been uploaded
                var filenameselected=$('#archievescannedcopy_yearlyrainfallformdatareport').val();
                if(filenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_yearlyrainfallformdatareport').val("");  //Clear the field.
                    $("#archievescannedcopy_yearlyrainfallformdatareport").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedYearlyRainfallFormDataReportCopy(){

            //Check against the date,stationName,StManagerNumber,Time and Metar Option.

            var year= $('#year').val();

            var stationName = $('#station_ArchiveScannedYearlyRainfallFormReport').val();
            var stationNumber = $('#stationNo_ArchiveScannedYearlyRainfallFormReport').val();


            $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').val("");

            if ((year != undefined)&&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/checkInDBIfArchiveScannedYearlyRainfallFormDataReportCopyRecordExistsAlready",
                    type: "POST",
                    data:{'year':year,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").val();

            }//end of if
            else if((year == undefined) || (stationName == undefined) || (stationNumber == undefined)){

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
            $('#updateScannedArchiveYearlyRainfallFormReportDataCopy_button').click(function(event) {

                //Check that Form name  is picked
                var formname=$('#formname').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname').val("");  //Clear the field.
                    $("#formname").focus();
                    return false;

                }

                //Check that Date selected
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the Year");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();

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
                var updatefilenameselected=$('#updatearchievescannedcopy_yearlyrainfallformdatareport').val();
                if(updatefilenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_yearlyrainfallformdatareport').val("");  //Clear the field.
                    $("#archievescannedcopy_yearlyrainfallformdatareport").focus();
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
        //Once the Admin selects the Station the Station Managerr should be picked from the DB Automatically.
        // For Insert/Add ArcManager Dekadal ManagerData
        $(document.body).on('change','#stationNoArchiveScannedYearlyRainfallFormReportManager',function(){
            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");  //CleManagere field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");
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

                            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");

                            // alert(data);
                            $("#stationNoArchiveScannedYearlyRainfallFormReportManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').empty();
                            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoArchiveScannedYearlyRainfallFormReportManager').empty();
                    $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");
                }     })

    </script>
<?php require_once(APPPATH . 'views/footer.php'); ?>