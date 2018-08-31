<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
	
    <section class="content-header">
        <h1>
            Customized Rainfall Report
            <small>Preview Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customized Rainfall Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayCustomRainfallReport/displaycustomrainfallreport/" method="post" enctype="multipart/form-data">
               
				 <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Region</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control"  placeholder="Please select station"   >
                            </div>
                        </div>
                    </div>
                   <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <select name="stationManager" id="stationManager"  required class="form-control" placeholder="Select Station">
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
					 
                                <input type="hidden" name="stationNoManager"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                            
               

               <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">From </span>
                              <input type="text" name="from" required id="report1" class="form-control metaryear" placeholder="" >
                        </div>
                    </div>
                </div>
				
				<div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> To &nbsp;</span>
                            <input type="text" name="to" id="report" class="form-control metaryear" required placeholder="" >
                        </div>
                    </div>
                </div>
				<div class="col-xs-2">
                    <input type="submit"  class="btn btn-primary"id="displaycustomisedreportrainfallreport_button" value="Generate report" >
                </div>
				
				 
            </form>
        </div>
		
        <hr>
    </div>

   <?php
    if(is_array($rainfalldata) &&
    count($rainfalldata) && is_array($noRainfallData) && is_array($stationsdata)){

    $year= $noRainfallData['year'];
    //$month= $displayYearlyRainfallReportHeaderFields['month'];
    $stationName=$noRainfallData['stationName'];

    $stationNumber=$noRainfallData['stationNumber'];
	$from =$noRainfallData['from'];
	 $to = $noRainfallData['to'];
    
    ?>

    <span><strong>Rainfall Observation At</strong></span>
    <span class="dotted-line"><?php echo $stationName;?></span><span><strong>Station</strong></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Between</strong></span> <span class="dotted-line"><?php echo $from;?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <span><strong>To</strong></span> <span class="dotted-line"><?php echo $to;?></span>

    <div class="clearfix"></div>
    <br>
    <table class="report-table" id="table2excel">

    <tr>
        <td class="main">Date </td>
        <td class="main">Amount Of Rainfall</td>
    </tr>
	<?php foreach($rainfalldata as $data){
		$count=0;
		if(empty($data->Rainfall)){
			
		$count++;}else{?>
	    
		<tr> 
		<td> <?php echo $data->Date;?></td>
		<td> <?php echo $data->Rainfall;?></td>
		</tr>
	<?php }}?>
	
    </table>
   
    <br><br>
    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
        <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br><br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/DisplayCustomRainfallReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
        <?php }elseif(is_array($noRainfallData)
                && count($noRainfallData)
                && empty($rainfalldata))
                            {

     $date= $noRainfallData['date'];
     //get the day in words.
     $dayInWords=date('l', strtotime($date));
     //Month
     //$month = date('m', strtotime($loop->date));
     $stationName=$noRainfallData['stationName'];
     $stationNumber=$noRainfallData['stationNumber'];
	 $from =$noRainfallData['from'];
	 $to = $noRainfallData['to'];
     ?>

     <center>
         <?php echo "No Rainfall Data Yet for ".$stationName.' '.'Between'.' '.$from. ' '.'To'.' '.$to.' '.'From the DB'; ?>
     </center>
 <?php } ?>
   
    </section><!-- /.content -->
    </aside><!-- /.right-side -->
	</div>
    
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
            $('#displaycustomisedreportrainfallreport_button').click(function(event) {


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
                //Check that the YEAR is selected from the list of Year
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Year not Selected");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();
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
	
 
<script type="text/javascript">

	
    $(document).ready(function(){
        var date_input=$('#report'); //our date input has the name "date"
   
        date_input.datepicker({
            format: 'yyyy-mm-dd',
          
            todayHighlight: true,
            autoclose: true
        })
    })

</script>
<script type="text/javascript">

	
    $(document).ready(function(){
        var date_input=$('#report1'); //our date input has the name "date"
           var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
		
            container: container,
            todayHighlight: true,
            autoclose: true
        })
    })

</script>





<?php require_once(APPPATH . 'views/footer.php'); ?>