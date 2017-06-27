<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>
                <b>Name: <?php echo $name ; ?> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Role: <?php echo $userrole  ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Station: <?php echo $userstation  ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Station Number: <?php echo $userstationNo ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                </b>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archived Observation Slip Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div class="no-print">
        <div id="output"></div>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedObservationSlipFormData/displayarchivedobservationslipformreport/" method="post" enctype="multipart/form-data">
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
                            <span class="input-group-addon">Select Time</span>
                            <!-- <input type="text" name="day" id="day" class="form-control sumyear" placeholder="Please select the day" > -->
                            <select name="ArchivedObservationSlipFormReportTime" id="ArchivedObservationSlipFormReportTime" required class="form-control">
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
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Date</span>
                            <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <input type="submit" name="generatearchivedobservationslipformreport_button" id="generatearchivedobservationslipformreport_button" class="btn btn-primary" value="Generate Archived report" >
                </div>
            </form>
        </div>
        <hr>
    </div>


    <?php
    if(is_array($displayArchivedObservationSlipFormReportHeaderFields) &&
        count($displayArchivedObservationSlipFormReportHeaderFields) &&

     is_array($archivedobservationslipformdataforspecifictimeofaday) &&
         !empty($archivedobservationslipformdataforspecifictimeofaday)

    ){

        // $day= $displayObservationSlipReportHeaderFields['day'];
        $timeInZoo= $displayArchivedObservationSlipFormReportHeaderFields['TimeInZoo'];
        $date= $displayArchivedObservationSlipFormReportHeaderFields['date'];
        $stationName=$displayArchivedObservationSlipFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedObservationSlipFormReportHeaderFields['stationNumber'];
        ?>
        <h3>Form No.393(Rev.9/2015)</h3>
        <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
        <br><br>
        <span><strong>FORM OBS001OBSERVATION SLIP</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br>
        <span><strong>TIME</strong></span><span class="dotted-line"><?php echo $timeInZoo;?></span>
        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
        <span><strong>DATE</strong></span> <span class="dotted-line"><?php echo $date;?></span>

        <div class="clearfix"></div>


        <br>
        <?php
        $count = 0;

            foreach($archivedobservationslipformdataforspecifictimeofaday as $data){
                $count++;
                $observationslipid = $data->id;

                ?>

                <table class="report-table" id="table2excel">

                    <table class="report-table">

                        <tr>
                            <td class="main" colspan="12">
                                Total amount of all clouds <span class="dotted-line"><?php echo $data->TotalAmountOfAllClouds;?> Oktas </span>
                    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                    Total amount of low clouds <span class="dotted-line"><?php echo $data->TotalAmountOfLowClouds;?>  Oktas</span>
                    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                     </td>
                </tr>

                <tr>

                    <td class="main" colspan="4">LOW</td>

                    <td class="main" colspan="4">MIDDLE</td>

                    <td class="main" colspan="4">HIGH</td>


                </tr>

                <tr>
                    <td class="main">Type</td>
                    <td class="main">Oktas</td>
                    <td class="main">Height</td>
                    <td class="main">CL CODE</td>


                    <td class="main">Type</td>
                    <td class="main">Oktas</td>
                    <td class="main">Height</td>
                    <td class="main">CL CODE</td>


                    <td class="main">Type</td>
                    <td class="main">Oktas</td>
                    <td class="main">Height</td>
                    <td class="main">CL CODE</td>

                </tr>

                <tr>
                    <td class="main"><?php echo $data->TypeOfLowClouds;?></td>
                    <td class="main"><?php echo $data->OktasOfLowClouds;?></td>
                    <td class="main"><?php echo $data->HeightOfLowClouds;?></td>
                    <td class="main"><?php echo $data->CLCODEOfLowClouds;?></td>


                    <td class="main"><?php echo $data->TypeOfMediumClouds;?></td>
                    <td class="main"><?php echo $data->OktasOfMediumClouds;?></td>
                    <td class="main"><?php echo $data->HeightOfMediumClouds;?></td>
                    <td class="main"><?php echo $data->CLCODEOfMediumClouds;?></td>

                    <td class="main"><?php echo $data->TypeOfHighClouds;?></td>
                    <td class="main"><?php echo $data->OktasOfHighClouds;?></td>
                    <td class="main"><?php echo $data->HeightOfHighClouds;?></td>
                    <td class="main"><?php echo $data->CLCODEOfHighClouds;?></td>

                </tr>

                <tr>

                    <td class="main" colspan="6">Cloud Searchlight Alidade Reading
                        <span class="dotted-line"><?php echo $data->CloudSearchLightReading;?> </span>
                    </td>

                    <td class="main" colspan="6">Rainfall(mm)
                        <span class="dotted-line"><?php echo $data->Rainfall;?> </span>
                    </td>
                </tr>

              </table>
                <br><br>

        <table class="report-table">

            <tr>
                <td class="main" rowspan="2">Dry Bulb</td>
                <td class="main" rowspan="2">Wet Bulb</td>

                <td class="main" colspan="2">Max</td>

                <td class="main" colspan="2">Min</td>

                <td class="main" colspan="2">Piche</td>

                <td class="main" colspan="3">Time Marks</td>

            </tr>

            <tr>

                <td class="main">Read</td>
                <td class="main">Reset</td>


                <td class="main">Read</td>
                <td class="main">Reset</td>


                <td class="main">Read</td>
                <td class="main">Reset</td>


                <td class="main">Thermo</td>
                <td class="main">Hygro</td>
                <td class="main">Rain Rec.</td>

            </tr>

            <tr>

                <td class="main"><?php echo $data->Dry_Bulb;?></td>
                <td class="main"><?php echo $data->Wet_Bulb;?></td>

                <td class="main"><?php echo $data->Max_Read;?></td>
                <td class="main"><?php echo $data->Max_Reset;?></td>


                <td class="main"><?php echo $data->Min_Read;?></td>
                <td class="main"><?php echo $data->Min_Reset;?></td>

                <td class="main"><?php echo $data->Piche_Read;?></td>
                <td class="main"><?php echo $data->Piche_Reset;?></td>


                <td class="main"><?php echo $data->TimeMarksThermo;?></td>
                <td class="main"><?php echo $data->TimeMarksHygro;?></td>
                <td class="main"><?php echo $data->TimeMarksRainRec;?></td>

            </tr>
        </table>
                <br><br>

            <table class="report-table">

                <tr>
                    <td class="main" rowspan="2">Present Weather</td>
                    <td class="main" rowspan="2">Visibility</td>



                    <td class="main" colspan="2">Wind</td>

                    <td class="main" rowspan="2">Gusting(Kts)</td>
                </tr>


                <tr>
                    <td class="main">Direction</td>
                    <td class="main">Speed (Kts)</td>

                </tr>

                <tr>

                    <td class="main"><?php echo $data->Present_Weather;?></td>

                    <td class="main"><?php echo $data->Visibility;?></td>

                    <td class="main"><?php echo $data->Wind_Direction;?></td>
                    <td class="main"><?php echo $data->Wind_Speed;?></td>

                    <td class="main"><?php echo $data->Gusting;?></td>

                </tr>
            </table>

            <br>
                <br>

            <table class="report-table">
                <tr>
                    <td class="main">Attd.Thermo.(&deg;C)</td>
                    <td class="main"><?php echo $data->AttdThermo;?></td>


                    <td class="main" colspan="2">Time Marks</td>

                    <td class="main">Other T/Marks</td>
                </tr>


                <tr>
                    <td class="main">Pr.As Read(mbs)</td>
                    <td class="main"><?php echo $data->PrAsRead;?></td>


                    <td class="main">Barograph</td>

                    <td class="main">Anemograph</td>

                    <td class="main"><?php echo $data->OtherTMarks;?></td>
                </tr>


                <tr>
                    <td class="main">Correction(mb)</td>
                    <td class="main"><?php echo $data->Correction;?></td>


                    <td class="main"><?php echo $data->TimeMarksBarograph;?></td>

                    <td class="main"><?php echo $data->TimeMarksAnemograph;?></td>

                    <td class="main"><?php echo $data->OtherTMarks;?></td>
                </tr>


                <tr>
                    <td class="main">C.L.P(mb)</td>
                    <td class="main"><?php echo $data->CLP;?></td>


                    <td class="main" colspan="3">Remarks or any other Observations</td>


                </tr>

                <tr>
                    <td class="main">M.S.L.Pr(mb)</td>
                    <td class="main"><?php echo $data->MSLPr;?></td>


                    <td class="main"><?php echo $data->Remarks;?></td>
                    <td class="main"><?php echo $data->Remarks;?></td>
                    <td class="main"><?php echo $data->Remarks;?></td>


                </tr>
            </table>


        </table>




         <?php
                }
        ?>
        <br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print"  data-export="export"><i class="fa fa-print"></i> Export to csv</button>


        <a href="<?php echo base_url()."index.php/DisplayArchivedObservationSlipFormData/"; ?>" class="btn btn-warning pull-right"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>

    <?php }elseif(is_array($displayArchivedObservationSlipFormReportHeaderFields) &&
    count($displayArchivedObservationSlipFormReportHeaderFields) &&

    is_array($archivedobservationslipformdataforspecifictimeofaday) &&
    empty($archivedobservationslipformdataforspecifictimeofaday)){
        // $day= $displayObservationSlipReportHeaderFields['day'];
        $timeInZoo= $displayArchivedObservationSlipFormReportHeaderFields['TimeInZoo'];
        $date= $displayArchivedObservationSlipFormReportHeaderFields['date'];
        $stationName=$displayArchivedObservationSlipFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedObservationSlipFormReportHeaderFields['stationNumber']; ?>


        <center>
        <?php echo "No Archived Observation Slip Report Data Yet for ".$stationName.' '.'Date'.' '.$date. ' '.'And Time   '.$timeInZoo.' '.'From the DB'; ?>
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
            $('#generatearchivedobservationslipformreport_button').click(function(event) {


                // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.

                    $("#stationManager").focus();
                    return false;
                }
                //Manager that the a stationManagerer is selectManagerom the list of stations(Admin)
                var stationNoManager=$('#stationNoManager').val();
                if (stationNoManager==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Number not picked");
                    $('#stationNoManager').val("");  //Clear the field.
                    $("#stationNoManager").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var stationOC=$('#stationOC').val();
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
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
                //////////////////////////////////////////////////////////////////////////////////////////////               //////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the DATE is selected from the list of TIME for the METAR
                var time=$('#ArchivedObservationSlipFormReportTime').val();
                if(time==""){  // returns true if the variable does NOT contain a valid number
                    alert("Time not Selected from the List");
                    $('#ArchivedObservationSlipFormReportTime').val("");  //Clear the field.
                    $("#ArchivedObservationSlipFormReportTime").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the DATE is selected from the list of TIME for the METAR
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