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
                Archived Metar Form Data
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Archived Metar Form Data  Report</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/DisplayArchivedMetarFormData/displayachivedmetarFormreport/" method="post" enctype="multipart/form-data">
                        <?php  if($userrole=='OC'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($userrole=='Manager'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <select name="stationManager" id="stationManager"   class="form-control" placeholder="Select Station">
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

                        <?php }elseif($userrole=='Manager'){?>
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
                            <input type="submit" name="generatearchivedmetarFormReport_button" id="generatearchivedmetarFormReport_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>

            <?php
            if(is_array($displayArchivedMetarFormReportHeaderFields) &&
                count($displayArchivedMetarFormReportHeaderFields) &&
                 is_array($archivedmetarformreportdataforADay) &&
             !empty($archivedmetarformreportdataforADay)) {

                $date= $displayArchivedMetarFormReportHeaderFields['date'];
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayArchivedMetarFormReportHeaderFields['stationName'];
                $stationNumber=$displayArchivedMetarFormReportHeaderFields['stationNumber'];


                ?>

                <span><strong>STATION</strong></span> <span class="dotted-line"><?php echo $stationName;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>STATION NUMBER</strong></span>
                <span class="dotted-line"><?php echo $stationNumber;?></span>


                <span><strong>DAY</strong></span> <span class="dotted-line"><?php echo $dayInWords;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>DATE</strong></span>
                <span class="dotted-line"><?php echo $date;?></span>

                <div class="clearfix"></div>
                <br>
                <table class="report-table" id="table2excel">

                    <tr>
                        <td class="main">METAR <br> SPECI</td>
                        <td class="main">CCCC</td>
                        <td class="main">YYGGgg</td>
                        <td class="main">Dddff/<br> f/f</td>
                        <td class="main">WW or <br> COVAK</td>
                        <td class="main">WW</td>
                        <td class="main">NCChhhNCChhh N CChhh</td>
                        <!-- <td class="main">A/Temperature</td>
                         <td class="main">Dew Point</td>
                         <td class="main">Wet Bulb</td> -->
                        <td class="main">TT/ <br> TT</td>
                        <td class="main">QNH <br>(hpa)</td>
                        <td class="main">QNH <br>(in)</td>
                        <td class="main">QFE<br> (hpa)</td>
                        <td class="main">QFE<br> (in)</td>
                        <td class="main">RE <br> W1W1</td>
                    </tr>

                    <?php
                    $count = 0;

                        foreach($archivedmetarformreportdataforADay as $metardata){
                            $count++;
                            $metarid = $metardata->id;

                            ?>
                            <tr>


                                <td ><?php echo $metardata->METARSPECI;?></td>
                                <td ><?php echo $metardata->CCCC;?></td>
                                <td ><?php echo $metardata->YYGGgg;?></td>
                                <td ><?php echo $metardata->Dddfffmfm;?></td>
                                <td ><?php echo $metardata->WWorCOVAK;?></td>
                                <td><?php echo $metardata->W1W1;?></td>
                                <td><?php echo $metardata->NlCCNmCCNhCC;?></td>
                                <td ><?php echo $metardata->TTTdTd;?></td>
                                <td ><?php echo $metardata->Qnhhpa;?></td>
                                <td><?php echo $metardata->Qnhin;?></td>
                                <td><?php echo $metardata->Qfehpa;?></td>
                                <td><?php echo $metardata->Qfein;?></td>
                                <td><?php echo $metardata->REW1W1;?></td>


                            </tr>
                        <?php
                        }
                    ?>
                </table>
                <br><br>
                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
                <a href="<?php echo base_url()."index.php/DisplayArchivedMetarFormData/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>
            <?php }elseif(is_array($displayArchivedMetarFormReportHeaderFields) &&
    count($displayArchivedMetarFormReportHeaderFields) &&
    is_array($archivedmetarformreportdataforADay) &&
    empty($archivedmetarformreportdataforADay)) {

                $date= $displayArchivedMetarFormReportHeaderFields['date'];
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayArchivedMetarFormReportHeaderFields['stationName'];
                $stationNumber=$displayArchivedMetarFormReportHeaderFields['stationNumber'];




                ?>



                <center>
                    <?php echo "No Archived Metar Report Data Yet for ".$stationName.' '.'Date'.' '.$date. ' '.'From the DB'; ?>
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
            $('#generatearchivedmetarFormReport_button').click(function(event) {


/////////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the a station is selected from the list of stations(Manager)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Pliz pick stations from the list");
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