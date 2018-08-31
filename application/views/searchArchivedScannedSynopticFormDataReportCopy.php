<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Search Archived Scanned Synoptic Form Report
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Search Archived Scanned Synoptic Form Report</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/SearchArchivedScannedSynopticFormDataReportCopy/displayarchivedscannedsynopticformreport/" method="post" enctype="multipart/form-data">
                        <?php  if($userrole=='OC'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($userrole=='ManagerData'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <select name="stationManager" id="stationManager" required  class="form-control" placeholder="Select Station">
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
                            </div>
                        <?php } ?>

                        <?php if($userrole=='OC'){ ?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="page" value="monthly_rainfall_report" >

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>

                        <?php }elseif($userrole=='ManagerData'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="page" value="monthly_rainfall_report" >

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNoManager"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                        <div class="col-xs-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Select Date</span>
                                    <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <input type="submit" name="searcharchivedscannedsynopticformreport_button" id="searcharchivedscannedsynopticformreport_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>

            <?php
            if(is_array($displayArchivedScannedSynopticFormDataReportDetails) &&
            count($displayArchivedScannedSynopticFormDataReportDetails) &&
             is_array($archivedscannedsynopticformdatareportcopyforADay) &&
            !empty($archivedscannedsynopticformdatareportcopyforADay)) {


                $date= $displayArchivedScannedSynopticFormDataReportDetails['date'];
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayArchivedScannedSynopticFormDataReportDetails['stationName'];
                $stationNumber=$displayArchivedScannedSynopticFormDataReportDetails['stationNumber'];


                ?>


                <br>
                <table class="report-table" id="table2excel">

                    <tr>
                        <td class="main">No.</td>
                        
                        <td class="main">Station Name</td>
                        <td class="main">Station Number</td>
                        <td class="main">Date</td>
                        <td class="main">Description</td>
                        <td class="no-print">File Names</td>

                    </tr>

                    <?php
                    $count = 0;
                      foreach($archivedscannedsynopticformdatareportcopyforADay as $data){
                            $count++;
                            $synopticid = $data->id;

                            ?>
                            <tr>


                                <td ><?php echo $count;?></td>
                               
                                <td ><?php echo $data->StationName;?></td>
                                <td ><?php echo $data->StationNumber;?></td>
                                <td ><?php echo $data->form_date;?></td>
                                <td><?php echo $data->Description;?></td>

                                <td class="no-print">
                                   <a title="click to view file" href="<?php echo base_url(); ?>/index.php/SearchArchivedScannedSynopticFormDataReportCopy/ViewImageFromBrowser/<?php echo $data->FileRef;?>" target = "blank"><?php echo $data->FileRef;?></a>
                                   
                                    

                                </td>



                            </tr>
                        <?php
                        }
                    ?>
                </table>
            
                <br><br>

                <div class="clearfix"></div>

                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-download"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-download"></i> Export to csv</button>
                <a href="<?php echo base_url()."index.php/MetarReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>
            <?php }elseif(is_array($displayArchivedScannedSynopticFormDataReportDetails) &&
            count($displayArchivedScannedSynopticFormDataReportDetails) &&
            is_array($archivedscannedsynopticformdatareportcopyforADay) &&
            empty($archivedscannedsynopticformdatareportcopyforADay)) {


            $date= $displayArchivedScannedSynopticFormDataReportDetails['date'];
            //get the day in words.
            $dayInWords=date('l', strtotime($date));
            //Month
            //$month = date('m', strtotime($loop->date));
            $stationName=$displayArchivedScannedSynopticFormDataReportDetails['stationName'];
            $stationNumber=$displayArchivedScannedSynopticFormDataReportDetails['stationNumber'];


            ?>
                <center>
                    <?php echo "No Archived Scanned Synoptic Report  for ".$stationName.' and  '.'Date'.' '.$date. ' '.'From the DB'; ?>
                </center>

                <?php } ?>

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
            $('#searcharchivedscannedsynopticformreport_button').click(function(event) {


                //Check that the a station is selected from the list Managerations(Admin)
             var stationManager=$('#stationManager').val();
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
                //Check that the TIME is selected from the list of TIME for the METAR
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Date not Selected");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }


            });
        });
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





<?php require_once(APPPATH . 'views/footer.php'); ?>