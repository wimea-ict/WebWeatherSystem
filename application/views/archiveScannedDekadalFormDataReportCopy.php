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
            Archive Scanned Dekadal Form Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Dekadal Form Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedDekadalFormReport) && count($displaynewFormToArchiveScannedDekadalFormReport)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedDekadalFormDataReportCopy/insertInformationForArchiveScannedDekadalFormReport/"  method="post" enctype="multipart/form-data">
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
                                <input type="text" name="formname_dekadal" id="formname_dekadal" required class="form-control" value="<?php echo 'Dekadal Form';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield">

                            </div>
                        </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="station_ArchiveScannedDekadalFormReport" id="station_ArchiveScannedDekadalFormReport" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNo_ArchiveScannedDekadalFormReport" required class="form-control" id="stationNo_ArchiveScannedDekadalFormReport" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                </div>
                            </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> From Date</span>
                                <input type="text" name="FromdateOnScannedDekadalFormReport_dekadal" id="expdate" required class="form-control"  placeholder="Enter From  Date">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> To Date</span>
                                <input type="text" name="TodateOnScannedDekadalFormReport_dekadal" id="opened" required class="form-control"  placeholder="Enter To  Date">

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_dekadal"  class="form-control" style="height:150px;" id="description_dekadal" onkeyup="allowCharactersInputOnly(this)"></textarea>

                        </div>

                        <div style="width:160px; height:120px; margin-bottom:4px; max-height:120px; overflow:hidden; border:1px solid; position:relative" class="pull-left">
                            <img id="blah" src="#" alt="your image" class="img-responsive" />
                            <label style="position:absolute; bottom:0; left:0; width:100%; height:15px; background:rgbargba(0,0,0,.4); color:#fff;" id="name"></label>
                        </div>
                        <div class="clearfix"></div>



                        <div class="form-group">
                            <div class="btn btn-success btn-file">
                                <i class="fa fa-paperclip"></i> Choose file
                                <input type="file" name="archievescannedcopy_dekadalformdatareport" id="archievescannedcopy_dekadalformdatareport" required class="form-control" size = "40">

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

                            $("#archievescannedcopy_dekadalformdatareport").change(function(){
                                readURL(this);
                            });
                        </script>

                    </div>
                </div>
                <div class="modal-footer clearfix"></div>
                <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/ArchiveScannedDekadalFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="postScannedArchiveDekadalFormReportDetails_button" name="postScannedArchiveDekadalFormReportDetails_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Archive Scanned Dekadal Form Report</button>
                </div>
            </form>
        </div>
    <?php
    }elseif((is_array($scanneddekadalformreportidDetails) && count($scanneddekadalformreportidDetails))) {
        foreach($scanneddekadalformreportidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/ArchiveScannedDekadalFormDataReportCopy/updateInformationForArchiveScannedDekadalFormReport" method="post" enctype="multipart/form-data">
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
                                        <input type="text" name="station" id="station" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                    </div>
                                </div>




                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                    </div>
                                </div>








                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> From Date</span>
                                    <input type="text" name="FromdateOnScannedDekadalFormReport" id="date" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->FromDate;?>" readonly class="form-control" readonly="readonly" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">To Date</span>
                                    <input type="text" name="TodateOnScannedDekadalFormReport" id="closed" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->ToDate;?>" readonly class="form-control" readonly="readonly" >
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
                                    <input type="file" name="updatearchievescannedcopy_dekadalformdatareportcopy" id="updatearchievescannedcopy_dekadalformdatareportcopy"   required class="form-control" size = "40">

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

                                $("#updatearchievescannedcopy_dekadalformdatareportcopy").change(function(){
                                    readURL(this);
                                });
                            </script>


                        </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedDekadalFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updateScannedArchiveDekadalFormReportDetails_button" id="updateScannedArchiveDekadalFormReportDetails_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Scanned Dekadal Form Report Details</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedDekadalFormDataReportCopy/DisplayFormToArchiveScannedDekadalFormReport/">
                    <i class="fa fa-plus"></i> Add new Scanned Dekadal Form Report</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Dekadal Form Report Details</h3>
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

                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Description</th>
                                <th>Approved</th>
                                <th>By</th>
                             <?php  if($userrole=="OC"|| $userrole=="ObserverArchive"){ ?>
                                    <th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($archivedscanneddekadalformreportdetails) && count($archivedscanneddekadalformreportdetails)) {
                                foreach($archivedscanneddekadalformreportdetails as $data){
                                    $count++;

                                    $scanneddekadalformreportdetails = $data->id;


                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->Form;?></td>

                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->FromDate;?></td>
                                        <td ><?php echo $data->ToDate;?></td>

                                        <td><?php echo $data->Description;?></td>
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SubmittedBy;?></td>
                                   <?php if($userrole=="OC"|| $userrole=="ObserverArchive"){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/ArchiveScannedDekadalFormDataReportCopy/DisplayFormToArchiveScannedDekadalFormReportForUpdate/" .$data->id ;?>" style="cursor:pointer;">Edit</a>
                                          <!--  or <a href="<?php echo base_url() . "index.php/ArchiveScannedDekadalFormDataReportCopy/deleteInformationForArchiveScannedDekadalFormReport/" .$data->id ;?>"
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
            $('#postScannedArchiveDekadalFormReportDetails_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedDekadalFormDataReportCopy();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Dekadal Record with the Same date ,Station Name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number or date not picked");
                    return false;
                }



                //Check that Form name  is picked
                var formname=$('#formname_dekadal').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_dekadal').val("");  //Clear the field.
                    $("#formname_dekadal").focus();
                    return false;

                }

                //Check that Date selected
                var fromdate=$('#expdate').val();
                if(fromdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the from  date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }
                //Check that Date selected
                var todate=$('#opened').val();
                if(fromdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the to  date");
                    $('#opened').val("");  //Clear the field.
                    $("#opened").focus();
                    return false;

                }

                var fromdateforDekadalreport=new Date($('#expdate').val());
                var todateforDekadalreport=new Date($('#opened').val());

                //NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME YEAR
                var getyearFromThefromDate=fromdateforDekadalreport.getFullYear();
                var getyearFromThetoDate=todateforDekadalreport.getFullYear();

                if(getyearFromThefromDate!=getyearFromThetoDate){
                    alert("Please Select A range within the same year");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }

                ////NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME MONTH
                var getmonthFromThefromDate=fromdateforDekadalreport.getMonth() + 1;
                var getmonthFromThetoDate=todateforDekadalreport.getMonth() + 1;


                if(getmonthFromThefromDate!=getmonthFromThetoDate){
                    alert("Please Select A range within the same Month");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }

                ///NID TO GET THE TEN DAY COUNT OF A MONTH.
                var getdayFrom_ThefromDate=parseInt(fromdateforDekadalreport.getDate());  //get the date like 12 of the month
                var getdayFrom_ThetoDate=parseInt(todateforDekadalreport.getDate());


                //FROM DATE RANGE(1,11,21)
                if(((getdayFrom_ThefromDate!=1)  &&  (getdayFrom_ThetoDate!=10))
                    &&
                    ((getdayFrom_ThefromDate!=11) && (getdayFrom_ThetoDate!=20))

                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=28))

                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=29))


                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=30))

                    &&

                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=31))
                    ){
                    alert("Please Select a Range of 10 days");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    //$("#date").focus();
                    return false;
                }



                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_ArchiveScannedDekadalFormReport').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedDekadalFormReport').val("");  //Clear the field.
                    $("#station_ArchiveScannedDekadalFormReport").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedDekadalFormReport').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedDekadalFormReport').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedDekadalFormReport").focus();
                    return false;

                }
                //Check that the a file has been uploaded
                var filenameselected=$('#archievescannedcopy_dekadalformdatareportcopy').val();
                if(filenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_dekadalformdatareportcopy').val("");  //Clear the field.
                    $("#archievescannedcopy_dekadalformdatareportcopy").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedDekadalFormDataReportCopy(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var fromdate = $('#expdate').val();
            var todate=$('#opened').val();

            var stationName = $('#station_ArchiveScannedDekadalFormReport').val();
            var stationNumber = $('#stationNo_ArchiveScannedDekadalFormReport').val();




            $('#checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield').val("");

            if ((fromdate != undefined) &&  (todate != undefined)&&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedDekadalFormDataReportCopy/checkInDBIfArchiveScannedDekadalFormDataReportCopyRecordExistsAlready",
                    type: "POST",
                    data:{'fromdate':fromdate,'todate':todate,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedDekadaFormDataReportCopy_hiddentextfield").val();

            }//end of if
            else if((fromdate == undefined) ||  (todate == undefined) || (stationName == undefined) || (stationNumber == undefined)){

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
            $('#updateScannedArchiveDekadalFormReportDetails_button').click(function(event) {

                //Check that Form name  is picked
                var formname=$('#formname').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname').val("");  //Clear the field.
                    $("#formname").focus();
                    return false;

                }



                //Check that Date selected
                var update_fromdate=$('#date').val();
                if(update_fromdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("From Date not picked");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }
                //Check that Date selected
                var update_todate=$('#closed').val();
                if(update_todate==""){  // returns true if the variable does NOT contain a valid number
                    alert("From Date not picked");
                    $('#closed').val("");  //Clear the field.
                    $("#closed").focus()
                    return false; }

                var fromdateforDekadalreport=new Date($('#date').val());
                var todateforDekadalreport=new Date($('#closed').val());

                //NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME YEAR
                var getyearFromThefromDate=fromdateforDekadalreport.getFullYear();
                var getyearFromThetoDate=todateforDekadalreport.getFullYear();

                if(getyearFromThefromDate!=getyearFromThetoDate){
                    alert("Please Select A range within the same year");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }

                ////NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME MONTH
                var getmonthFromThefromDate=fromdateforDekadalreport.getMonth() + 1;
                var getmonthFromThetoDate=todateforDekadalreport.getMonth() + 1;


                if(getmonthFromThefromDate!=getmonthFromThetoDate){
                    alert("Please Select A range within the same Month");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }

                ///NID TO GET THE TEN DAY COUNT OF A MONTH.
                var getdayFrom_ThefromDate=parseInt(fromdateforDekadalreport.getDate());  //get the date like 12 of the month
                var getdayFrom_ThetoDate=parseInt(todateforDekadalreport.getDate());


                //FROM DATE RANGE(1,11,21)
                if(((getdayFrom_ThefromDate!=1)  &&  (getdayFrom_ThetoDate!=10))
                    &&
                    ((getdayFrom_ThefromDate!=11) && (getdayFrom_ThetoDate!=20))

                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=28))

                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=29))


                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=30))

                    &&

                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=31))
                    ){
                    alert("Please Select a Range of 10 days");
                    $('#date').val("");  //Clear the field.
                    $('#closed').val("");  //Clear the field.
                    //$("#date").focus();
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
                var updatefilenameselected=$('#updatearchievescannedcopy_dekadalformdatareportcopy').val();
                if(updatefilenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_dekadalformdatareportcopy').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_dekadalformdatareportcopy").focus();
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
        //Once the Admin selects the Station the SManagern Number should be picked from the DB Automatically.
        // For Managert/Add Archieve DManagerl Form Data
        $(document.body).on('change','#stationArchiveScannedDekadalFormReportManager',function(){
            $('#stationNoArchiveScannedDekadalFormReportManager').val("");//clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoArchiveScannedDekadalFormReportManager').val("");
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

                            $('#stationNoArchiveScannedDekadalFormReportManager').val("");

                            // alert(data);
                            $("#stationNoArchiveScannedDekadalFormReportManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoArchiveScannedDekadalFormReportManager').empty();
                            $('#stationNoArchiveScannedDekadalFormReportManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoArchiveScannedDekadalFormReportManager').empty();
                    $('#stationNoArchiveScannedDekadalFormReportManager').val("");
                }     })

    </script>
<?php require_once(APPPATH . 'views/footer.php'); ?>