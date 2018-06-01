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
                Archive Monthly Rainfall Report Data
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Archive Monthly Rainfall Report Data</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>
            <?php

            if(is_array($displaynewarchivemonthlyrainfallForm) && count($displaynewarchivemonthlyrainfallForm)) {
                ?>
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/insertMonthlyRainfallFormReportData/" method="post" enctype="multipart/form-data">
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
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="text" name="date_archivedailymonthlyrainfalldata"  class="form-control compulsory" placeholder="Enter select date" id="date">
                                        
                                    </div>
                                </div>



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Station Name</span>
                                            <input type="text" name="station_archivedailymonthlyrainfalldata" id="station_archivedailymonthlyrainfalldata"  class="form-control compulsory" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> Station Number</span>
                                            <input type="text" name="stationNo_archivedailymonthlyrainfalldata"  class="form-control compulsory" id="stationNo_archivedailymonthlyrainfalldata" readonly  value="<?php echo $userstationNo;?>" readonly="readonly" >
                                        </div>
                                    </div>




                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">RAINFALL</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata" id="rainfall_archivedailymonthlyrainfalldata"  required class="form-control" required placeholder="Enter MAX" >
                                    </div>
                                </div>


                            </div>

                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <center>

                            <a href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                            <button type="submit" id="postarchiveMonthlyRainfallFormReportdata_button" name="postarchiveMonthlyRainfallFormReportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT</button>
                        </center>
                    </form>
                </div>
                <?php
            }elseif((is_array($updatearchivedmonthlyrainfallformreportdata) && count($updatearchivedmonthlyrainfallformreportdata))) {
                foreach($updatearchivedmonthlyrainfallformreportdata as $rainfalldata){

                    $rainfalldataid = $rainfalldata->id;
                    ?>
                    <div class="row">
                        <form action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/UpdateMonthlyRainfallFormReportData" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div id="output"></div>
                                <script language="javascript">
                                    function allowIntegerInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var integerOnly =/[^0-9\.'NIL''TR' ]/gi;  // integers and decimals //
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
                                            <span class="input-group-addon">Select Date</span>
                                            <input type="text" name="date" class="form-control" value="<?php echo $rainfalldata->Date;?>" placeholder="Enter select date" id="expdate">
                                            <input type="hidden" name="checkduplicateEntryOnUpdateArchieveMonthlyRainfallFormReportData" id="checkduplicateEntryOnUpdateArchieveMetarFormData">
                                            <input type="hidden" name="id" value="<?php echo $rainfalldata->id;?>">
                                        </div>
                                    </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Station</span>
                                                <input type="text" name="station" id="station" required class="form-control" value="<?php echo $rainfalldata->StationName;?>"  readonly class="form-control" >

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"> Station Number</span>
                                                <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $rainfalldata->StationNumber;?>" readonly="readonly" >
                                            </div>
                                        </div>



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RAINFALL</span>
                                            <input type="text" name="rainfall" id="rainfall" value="<?php echo $rainfalldata->Rainfall;?>"  required class="form-control" required placeholder="Enter RAINFALL" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Approved</span>
                                            <select name="approval" id="approval"  required class="form-control">
                                                <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?> </option>
                                                <option value="">--Select Approval Options--</option>
                                                <option value="TRUE">TRUE</option>
                                                <option value="FALSE">FALSE</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <center>

                                <a href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                                <button type="submit" name="updatearchiveMonthlyRainfallformreportdata_button" id="updatearchiveMonthlyRainfallformreportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE</button>
                            </center>
                        </form>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="row">
                    <div class="col-xs-3"><a class="btn btn-primary no-print"
                                             href="<?php echo base_url()."index.php/ArchiveMonthlyRainfallFormReportData/DisplayNewArchiveMonthlyRaifallForm/";?>"
                        <i class="fa fa-plus"></i> Add Archive Monthly Rainfall</a>



                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"> Archive Monthly Rainfall Report</h3>
                            </div><!-- /.box-header -->
                            <?php require_once(APPPATH . 'views/error.php'); ?>
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Station</th>
                                        <th>Station No</th>

                                        <th>RAINFALL</th>
                                    <?php if($userrole=='SeniorDataOfficer'){ ?>
                                            <th>Approved</th>

                                            <th>By</th>
                                            <th class="no-print">Action</th>
                                        <?php }?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    if (is_array($archivedrainfalldata) && count($archivedrainfalldata)) {
                                        foreach($archivedrainfalldata as $data){
                                            $count++;
                                            $id = $data->id;

                                            ?>
                                            <tr>
                                                <td ><?php echo $count;?></td>
                                                <td ><?php echo $data->Date;?></td>
                                                <td ><?php echo $data->StationName;?></td>
                                                <td ><?php echo $data->StationNumber;?></td>
                                                <td ><?php echo $data->Rainfall;?></td>
                                           <?php if($userrole=='SeniorDataOfficer'  ){ ?>
                                             <td><?php echo $data->Approved;?></td>

                                             <td><?php echo $data->SubmittedBy;?></td>
                                             <td class="no-print">
                                                    <a href="<?php echo base_url() . "index.php/ArchiveMonthlyRainfallFormReportData/DisplayArchivedMonthlyRainfallFormForUpdate/" .$id ;?>" style="cursor:pointer;">Edit</a>
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
            //Post Add New  Archive Dekadal  form Report data into the DB
            //Validate each select field before inserting into the DB
            $('#postarchiveMonthlyRainfallFormReportdata_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveMonthlyRainfallFormReportData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Archived Rainfall Record with the Same date ,station name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number or date not picked");
                    return false;
                }



                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").focus();
                    return false;

                }

                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_archivedailymonthlyrainfalldata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archivedailymonthlyrainfalldata').val("");  //Clear the field.
                    $("#station_archivedailymonthlyrainfalldata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archivedailymonthlyrainfalldata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archivedailymonthlyrainfalldata').val("");  //Clear the field.
                    $("#stationNo_archivedailymonthlyrainfalldata").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE DEKADAL RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveMonthlyRainfallFormReportData(){

            //Check against the date,stationName,SManagernNumber,Time and MetManagertion.
            var date= $('#date').val();


            var stationName = $('#station_archivedailymonthlyrainfalldata').val();
            var stationNumber = $('#stationNo_archivedailymonthlyrainfalldata').val();




            $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveMonthlyRainfallFormReportData/checkInDBIfArchiveMonthlyRainfallFormReportRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").val();

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
            $('#updatearchiveMonthlyRainfallformreportdata_button').click(function(event) {
                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
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
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_rainfall;
            var oldValue_rainfall=$('#rainfall').val();

            $('#rainfall').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_rainfall = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rainfall').val(newValue_rainfall);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#raiManager').val(oldValue_rainfall);
                    return false;
                }

       Manager});
        });
    </script>


    <script type="text/javascript">
        //Once the Admin seManager the Station the Station Number should be picManagerrom the DB Automatically.
        // FoManagerert/Add Archieve Dekadal Form Data
        $(document.body).on('change','#stationrainfallManager',function(){
            $('#stationNorainfallManager').val("");  //Clear the field.
            var stationName = this.value;


          (stationName != "") {
                //alert(station);
                $('#stationNorainfallManager').val("");
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

                            $('#stationNorainfallManager').val();

                            Managerert(data);
                            $("#stationNorainfallManager").val(json[0].StationNumber);

                   }
                        else{

                       $('#stationNorainfallManager')..empty();
                            $('#stationNorainfallManager').val("");

                        }
               }

                });



            }
       else {

                $('#stationNorainfallManager').empty();
                $('#stationNorainfallManager').val("");
            }

        })

    </script>


<?php require_once(APPPATH . 'views/footer.php'); ?>
<script src="<?php echo base_url(); ?>js/form0.js"></script>
