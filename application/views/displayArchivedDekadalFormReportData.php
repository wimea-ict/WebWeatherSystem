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
           Archived Dekadal Form Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archived Dekadal Form Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedDekadalFormReportData/displayArchivedDekadalFormReport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='OC'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='ManagerData' || $userrole=='DataOfficer'){?>
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

                <?php }elseif($userrole=='ManagerData' || $userrole=='DataOfficer'){?>
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
                            <span class="input-group-addon">From Date</span>
                            <input type="text" name="fromdate" id="date" class="form-control summonth" placeholder="Please select the date" >
                        </div>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> ToDate</span>
                            <input type="text" name="todate" id="expdate" class="form-control summonth" placeholder="Please select the date" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <input type="submit" name="generateArchivedDekadalFormReport_button" id="generateArchivedDekadalFormReport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>
    <?php

    if(is_array($displayArchivedDekadalFormReportHeaderFields) && count($displayArchivedDekadalFormReportHeaderFields)){

        //$range= $displayDekadalReportHeaderFields['range'];
        $stationName=$displayArchivedDekadalFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedDekadalFormReportHeaderFields['stationNumber'];

        //$monthAsANumber=0;
        $FromDate= $displayArchivedDekadalFormReportHeaderFields['FromDate'];
        $ToDate= $displayArchivedDekadalFormReportHeaderFields['ToDate'];


        //$monthInWords= $displayDekadalReportHeaderFields['monthInWords'];
        $monthAsANumber= $displayArchivedDekadalFormReportHeaderFields['monthAsANumberselected'];

        $year= $displayArchivedDekadalFormReportHeaderFields['year'];


        ///php
        // $dateValue = strtotime('2012-06-05');
        // $year = date('Y',$dateValue);
        // $monthName = date('F',$dateValue);
        //date('m', strtotime($fromdate));
        $FromDatemonthDay = date('j',strtotime($FromDate));
        $ToDatemonthDay = date('j',strtotime($ToDate));


        // $splt_range = split("-",$range);
        // $splt_frst = split("/",$splt_range[0]);
        // $mnth_yr = $splt_frst[0].'/'.$splt_frst[2];

        //$range = $_GET['range'];
        // $splt = split("-",$range);
        // $first = split("/",$splt[0]);
        // $last = split("/",$splt[1]);

        // $start = $first[2].'-'.$first[0].'-'.$first[1];
        // $end = $last[2].'-'.$last[0].'-'.$last[1];
        //}
        ?>

        <center>
            <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
            <h3>TEN DAY (DEKADAL) FORM</h3>
        </center>

        <span><strong>Weather Station</strong></span>
        <span class="dotted-line"><?php echo $stationName;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Registered Number</strong></span> <span class="dotted-line"><?php echo $stationNumber;?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Dekad</strong></span><span class="dotted-line"><?php echo $FromDatemonthDay.'/'.$ToDatemonthDay;?></span>
        <span class="dotted-line"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Month/Year</strong></span> <span class="dotted-line"><?php echo $monthAsANumber. '/'.$year;?></span>


        <div class="clearfix"></div>
        <br>
        <!-- <p><strong>Reading of selected parameters</strong></p> -->
        <table class="report-table" id="table2excel">
        <tr>
            <td class="main" colspan="10">  <center>TIME OF OBSERVATION 9:00 AM </center>  </td>
            <td class="main" colspan="7"> <center> TIME OF OBSERVATION 3:00 PM </center>    </td>
        </tr>

        <tr>
            <td class="main" rowspan="2">DATE </br> OF </br> MONTH</td>
            <td class="main" colspan="5"><center>TEMPERATURES</center></td>

            <td class="main" rowspan="2">RELATIVE </br> HUMIDITY</td>
            <td class="main" colspan="2"> <center>WIND</center></td>
            <td class="main" rowspan="2">RAIN </br> FALL</td>
            <td class="main" colspan="3"> <center>TEMPERATURES</center>   </td>

            <td class="main" rowspan="2">RELATIVE </br> HUMIDITY</td>
            <td class="main" colspan="2"> <center>WIND</center></td>


        </tr>

        <tr>
            <td class="main">MAX </td>
            <td class="main">MIN</td>
            <td class="main">DRY </br> BULB</td>
            <td class="main">WET </br> BULB</td>
            <td class="main">DEW </br> POINT</td>
            <td class="main">DIRECTION</td>
            <td class="main">SPEED</td>
            <td class="main">DRY </br> BULB</td>
            <td class="main">WET </br> BULB</td>
            <td class="main">DEW </br> POINT</td>
            <td class="main">DIRECTION</td>
            <td class="main">SPEED</td>
        </tr>

        <?php
        $count = 0;
        //archivedDekadalFormReportdataforAnyTenDaysOfAMonth
        if (is_array($archivedDekadalFormReportdataforAnyTenDaysOfAMonth) && count($archivedDekadalFormReportdataforAnyTenDaysOfAMonth)) {

            //Create Arrays to store data to be formated e.g if data for a day is missing we insert it
            $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth=array();


            //First loop thru  the array for observationslip with TIME 0600Z and then  insert it into the different array we have created
            //format if day not there.
            //the days of the Month
            $print=0;
            $index=0;

            for($daynum = $FromDatemonthDay; $daynum<=$ToDatemonthDay; $daynum++ ){

                foreach($archivedDekadalFormReportdataforAnyTenDaysOfAMonth as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DayOfTheMonth"]=$data->DayOfTheMonth;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["MAXIMUM_TEMPERATURE"]=$data->MAX_TEMP;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["MINIMUM_TEMPERATURE"]=$data->MIN_TEMP;

                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DRY_BULB_0600Z"]=$data->DRY_BULB_0600Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WET_BULB_0600Z"]=$data->WET_BULB_0600Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DEW_POINT_0600Z"]=$data->DEW_POINT_0600Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["RELATIVE_HUMIDITY_0600Z"]=$data->RELATIVE_HUMIDITY_0600Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_DIRECTION_0600Z"]=$data->WIND_DIRECTION_0600Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_SPEED_0600Z"]=$data->WIND_SPEED_0600Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["RAINFALL_0600Z"]=$data->RAINFALL_0600Z;


                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DRY_BULB_1200Z"]=$data->DRY_BULB_1200Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WET_BULB_1200Z"]=$data->WET_BULB_1200Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DEW_POINT_1200Z"]=$data->DEW_POINT_1200Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["RELATIVE_HUMIDITY_1200Z"]=$data->RELATIVE_HUMIDITY_1200Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_DIRECTION_1200Z"]=$data->WIND_DIRECTION_1200Z;
                        $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_SPEED_1200Z"]=$data->WIND_SPEED_1200Z;

                        $print=1;
                        $index++;

                        break;
                    }//end of if
                    else{

                        $print=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($print==0){

                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DayOfTheMonth"]=$daynum;
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["MAXIMUM_TEMPERATURE"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["MINIMUM_TEMPERATURE"]='';

                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DRY_BULB_0600Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WET_BULB_0600Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DEW_POINT_0600Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["RELATIVE_HUMIDITY_0600Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_DIRECTION_0600Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_SPEED_0600Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["RAINFALL_0600Z"]='';


                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DRY_BULB_1200Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WET_BULB_1200Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["DEW_POINT_1200Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["RELATIVE_HUMIDITY_1200Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_DIRECTION_1200Z"]='';
                    $array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth[$index]["WIND_SPEED_1200Z"]='';

                    $index++;
                }//end of if
            }//end of for loop for OS TIME 0600Z
            ///////////////////////////////////////  ?>
            <?php
            //FIRST LOOP THR THE ARRAY
            foreach($array_archivedDekadalFormReportdataforAnyTenDaysOfAMonth as $data){ ?>

                <tr>
                    <td class="main"><?php echo $data['DayOfTheMonth'];?></td>

                    <td class="main"><?php echo $data['MAXIMUM_TEMPERATURE'];?></td>
                    <td class="main"><?php echo $data['MINIMUM_TEMPERATURE'];?></td>
                    <td class="main"><?php echo $data['DRY_BULB_0600Z'];?></td>
                    <td class="main"><?php echo $data['WET_BULB_0600Z'];?></td>
                    <td class="main"><?php echo $data['DEW_POINT_0600Z'];?></td>
                    <td class="main"><?php echo $data['RELATIVE_HUMIDITY_0600Z'];?></td>
                    <td class="main"><?php echo $data['WIND_DIRECTION_0600Z'];?></td>
                    <td class="main"><?php echo $data['WIND_SPEED_0600Z'];?></td>




                    <?php
                    if($data['RAINFALL_0600Z']=='' ) {
                        ?>
                        <td class="main"></td>

                    <?php
                    }else if($data['RAINFALL_0600Z'] < 0.1){
                        ?>
                        <td class="main"><?php echo 'TR';?></td>

                    <?php
                    }else if($data['RAINFALL_0600Z'] > 0.1){
                        ?>
                        <td class="main"><?php echo $data['RAINFALL_0600Z'];?></td>

                    <?php
                    }else if($data['RAINFALL_0600Z']=='NIL' ) {
                        ?>
                        <td class="main"><?php echo 'NIL';?></td>

                    <?php
                    }elseif($data['RAINFALL_0600Z']=='TR' ) {
                        ?>
                        <td class="main"><?php echo 'TR';?></td>

                    <?php }
                    ?>



                    <td class="main"><?php echo $data['DRY_BULB_1200Z'];?></td>
                    <td class="main"><?php echo $data['WET_BULB_1200Z'];?></td>
                    <td class="main"><?php echo $data['DEW_POINT_1200Z'];?></td>
                    <td class="main"><?php echo $data['RELATIVE_HUMIDITY_1200Z'];?></td>
                    <td class="main"><?php echo $data['WIND_DIRECTION_1200Z'];?></td>
                    <td class="main"><?php echo $data['WIND_SPEED_1200Z'];?></td>

                </tr>

            <?php    }


            ?>

        <?php
        } //end of beginning if statement
        ?>
        </table>
        <br><br>
        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
       <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br>
        <button type="button" onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button type="button" button id="export"   class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button type="button" button id="exportcsv" class="btn btn-primary no-print" data-export="export"><i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/DisplayArchivedDekadalFormReportData/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
    <?php }?>
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
            $('#generateArchivedDekadalFormReport_button').click(function(event) {


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
                //////////////////////////////////////////////////////////////////////////////////////////////               //////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the MONTH is selected from the list of MONTHS
                var fromdate=$('#date').val();
                if(fromdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("From Date Not Selected");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the YEAR is selected from the list of Year
                var todate=$('#expdate').val();
                if(todate==""){  // returns true if the variable does NOT contain a valid number
                    alert("To Date not Selected");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }
/////////////////////////////////////////////////////////////////////

                var fromdate_forDekadalreport=new Date($('#date').val());
                var todate_forDekadalreport=new Date($('#expdate').val());

                //NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME YEAR
                var getyearFromThe_fromDate=fromdate_forDekadalreport.getFullYear();
                var getyearFromThe_toDate=todate_forDekadalreport.getFullYear();

                if(getyearFromThe_fromDate!=getyearFromThe_toDate){
                    //var getmonthFromThe_fromDate=fromdate_forDekadalreport.getMonth() + 1;
                    //var getmonthFromThe_toDate=todate_forDekadalreport.getMonth() + 1;
                    alert("Please Select A range within the same year");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }

////////////////////////////////////////////////////////////////////////////////////////////
                ////NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME MONTH
                var getmonthFromThe_fromDate=fromdate_forDekadalreport.getMonth() + 1;
                var getmonthFromThe_toDate=todate_forDekadalreport.getMonth() + 1;


                if(getmonthFromThe_fromDate!=getmonthFromThe_toDate){
                    // alert(getmonthFromThe_toDate+"|"+getmonthFromThe_fromDate);
                    alert("Please Select A range within the same month");
                    //AirTemporDryBulbTemp+"|"+DewPoint
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }
//////////////////////////////////////////////////////////////////////////////////////////////////
                ///NID TO GET THE TEN DAY COUNT OF A MONTH.
                var getdayFrom_ThefromDate=parseInt(fromdate_forDekadalreport.getDate());  //get the date like 12 of the month
                var getdayFrom_ThetoDate=parseInt(todate_forDekadalreport.getDate());


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
////////////////////////////////////////////////////////////////////////////////////////////////
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
