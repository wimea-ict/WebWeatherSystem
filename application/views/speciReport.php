<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$StationRegion=$session_data['StationRegion'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//'StationNumber' => $row->StationNumber,
?>
    <aside class="right-side" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Speci Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Speci Report</li>

        </ol>
    </section>
    <!-- Main content -->
    <section>
    <?php require_once(APPPATH . 'views/error.php'); ?>


    <?php if($userrole=="ZonalOfficer" || $userrole== "WeatherForecaster" || ($userrole=="SeniorZonalOfficer") ){  ?>

        <?php } ?>
        <br><br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                    </div>
                    <?php require_once(APPPATH .'views/error.php'); ?>
                    <div class="box-body table-responsive" style="overflow:auto;">
                        <table id="example1" class="table table-bordered table-fixed table-striped">
                            <thead>
                            <tr>
                              <th>ID</th>
                              <th>Submission Time</th>
                              <th>Date</th>
                              <th>Station</th>
                              <th>TIME</th>

                              <th>Rainfall (mm)</th>
                              <th>Cloud Search LightReading</th>
                              <th>Dry Bulb</th>
                              <th>Wet Bulb</th>
                              <th>Max Reset</th>
                              <th>Max Reset</th>
                              <th>Min Read</th>
                              <th>Piche Read</th>
                              <th>Piche Reset</th>
                              <th>Time Marks Thermo</th>
                              <th>Time Marks Hygro</th>
                              <th>Time Marks RainRec</th>
                              <th>sun duration</th>
                              <th>windrun</th>

                              <th>By</th>
                              <th>Remarks</th>
                              <th>Approved</th>

                              <?php  if( $observationslipformdata[0]->DeviceType!="AWS" && ( $userrole=='OC' || $userrole== "WeatherForecaster" || $userrole=='Observer' || $userrole=="ObserverDataEntrant" || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer') ){ ?>

                                  <th class="no-print">Action</th>
                              <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($observationslipformdata) && count($observationslipformdata)) {
                              foreach($observationslipformdata as $observationslipdata){
                                  $count++;
                                  $observationslipid = $observationslipdata->id;
                                  ?>
                                  <tr>
                                      <td ><?php echo $observationslipdata->id;?></td>
                                        <td ><?php echo $observationslipdata->CreationDate;?></td>
                                      <td ><?php echo $observationslipdata->Date;?></td>
                                      <td ><?php echo $observationslipdata->StationName;?></td>
                                      <td ><?php echo $observationslipdata->TIME;?></td>

                                      <th><?php echo $observationslipdata->Rainfall;?></th>

                                      <td><?php echo $observationslipdata->CloudSearchLightReading;?></td>
                                      <td ><?php echo $observationslipdata->Dry_Bulb;?></td>
                                      <td ><?php echo $observationslipdata->Wet_Bulb;?></td>
                                      <td><?php echo $observationslipdata->Max_Reset;?></td>
                                      <td ><?php echo $observationslipdata->Max_Reset;?></td>
                                      <td ><?php echo $observationslipdata->Min_Read;?></td>
                                      <th><?php echo $observationslipdata->Piche_Read;?></th>
                                      <th><?php echo $observationslipdata->Piche_Reset;?></th>
                                      <th><?php echo $observationslipdata->TimeMarksThermo;?></th>
                                      <th><?php echo $observationslipdata->TimeMarksHygro;?></th>
                                      <th><?php echo $observationslipdata->TimeMarksRainRec;?></th>
                                      <th><?php echo $observationslipdata->sunduration;?></th>
                                      <th><?php echo $observationslipdata->windrun;?></th>

                                      <td><?php echo $observationslipdata->SubmittedBy;?></td>
                                      <th><?php echo $observationslipdata->Remarks;?></th>
                                      <td><?php echo $observationslipdata->Approved; ?></td>
                                      <?php if(  $observationslipformdata[0]->DeviceType!="AWS" && ( $userrole=='OC' || $userrole== "WeatherForecaster" || $userrole=='Observer' || $userrole=="ObserverDataEntrant" || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' )){ ?>
                                        <td class="no-print">

                                          <a href="<?php if($observationslipdata->DeviceType!="AWS") echo base_url() . "index.php/ObservationSlipForm/DisplayObservationSlipFormForUpdate/" .$observationslipid ;
                                           else echo "#";?>" style="cursor:pointer;" onClick="<?php if($observationslipdata->DeviceType=="AWS") echo "return confirm('AWS data cannot be edited ');"; ?>" >Edit</a>

                                    </td>
                                  <?php  } ?>
                                  </tr>

                          <?php } } ?>
                            </tbody>
                        </table>

                        </div>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print</button>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>


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
    $(document).on("change","#metar_speci" function(){

      var metarORspeci = document.getElementById('metar_speci').value;
      if(metarORspeci=="metar"){
        document.getElementById('metartimeId').style.display="block";
        document.getElementById('specitimeId').style.display="none";
      }else if (metarORspeci=="speci") {
        document.getElementById('metartimeId').style.display="none";
        document.getElementById('specitimeId').style.display="block";
      }else{
        alert("#003");
      }
    })
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#postObservationSlipFormData_button').click(function(event) {
                //Check for duplicate Entry Data when adding new  Observation/Raw Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddObservationSlipFormData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("observation/raw data Record With the date,station,station Number and Time exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }


				//Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").focus();
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
                var station=$('#station_observationslipform').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_observationslipform').val("");  //Clear the field.
                    $("#station_observationslipform").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_observationslipform').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_observationslipform').val("");  //Clear the field.
                    $("#stationNo_observationslipform").focus();
                    return false;

                }

                //Check that the TIME is selected from the list of TIME for the observation/raw data
                var time_observationslipform=$('#time_observationslipform').val();
                if(time_observationslipform==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please input TIME");
                    $('#time_observationslipform').val("");  //Clear the field.
                    $("#time_observationslipform").focus();
                    return false;

                }

///////////////////////////////////////////////////////////////////////
                var maxRead_observationslipform=$('#maxRead_observationslipform').val();
                if(maxRead_observationslipform > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxRead Temperature can't go beyond 42 degrees");
                    $('#maxRead_observationslipform').val("");  //Clear the field.
                    $("#maxRead_observationslipform").focus();
                    return false;

                }
                var maxReset_observationslipform=$('#maxReset_observationslipform').val();
                if(maxReset_observationslipform > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxReset Temperature can't go beyond 42 degrees");
                    $('#maxReset_observationslipform').val("");  //Clear the field.
                    $("#maxReset_observationslipform").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var minRead_observationslipform=$('#minRead_observationslipform').val();
                if(minRead_observationslipform > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinRead Temperature can't go beyond 42 degrees");
                    $('#minRead_observationslipform').val("");  //Clear the field.
                    $("#minRead_observationslipform").focus();
                    return false;

                }
                var minReset_observationslipform=$('#minReset_observationslipform').val();
                if(minReset_observationslipform > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinReset Temperature can't go beyond 42 degrees");
                    $('#minReset_observationslipform').val("");  //Clear the field.
                    $("#minReset_observationslipform").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var winddirection_observationslipform=$('#winddirection_observationslipform').val();
                if((winddirection_observationslipform > 360) || (winddirection_observationslipform < 000) ){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Direction should be between 000 to 360");
                    $('#winddirection_observationslipform').val("");  //Clear the field.
                    $("#winddirection_observationslipform").focus();
                    return false;

                }
                var windspeed_observationslipform=$('#windspeed_observationslipform').val();
                if(minReset_observationslipform < 000){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Speed can't go beyond 000");
                    $('#windspeed_observationslipform').val("");  //Clear the field.
                    $("#windspeed_observationslipform").focus();
                    return false;

                }



            }); //button
            //  return false;

        });  //document
    </script>
    <script type="text/javascript">
        //Once the anyone selects the Present Weather Item Select Dropdown.Make the Present Weather Code text field required
        //Else mek it not required
        // For Add New OS

        $(document.body).on('change','#presentweather_observationslipform',function(){

            var PresentWeather_Selected = this.value;


            if (PresentWeather_Selected=="") {

                // Then Enforce the required select text field
                $('#presentweatherCode_observationslipform').attr('required', true);

            }
            else if(PresentWeather_Selected !=""){
                // Then Enforce the required select text field
                $('#presentweatherCode_observationslipform').attr('required', false); //Enforce the required select text field
            }

        })

    </script>
    <script type="text/javascript">
        //Once the anyone selects the Present Weather Item Select Dropdown.Make the Present Weather Code text field required
        //Else mek it not required
        // For Update OS

        $(document.body).on('change','#presentweather',function(){

            var PresentWeather_Selected_OnUpdate = this.value;


            if (PresentWeather_Selected_OnUpdate=="") {

                // Then Enforce the required select text field
                $('#presentweatherCode').attr('required', true);

            }
            else if(PresentWeather_Selected_OnUpdate !=""){
                // Then Enforce the required select text field
                $('#presentweatherCode').attr('required', false); //Enforce the required select text field
            }




        })

    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddObservationSlipFormData(){

            //Check against the date,stationName,StationNumber,Time
            var date= $('#date').val();


            var stationName = $('#station_observationslipform').val();
            var stationNumber= $('#stationNo_observationslipform').val();

            var time_OfObservationSlipForm = $('#time_observationslipform').val();


            $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').val("");

            if ((date != undefined) && (time_OfObservationSlipForm != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ObservationSlipForm/checkInDBIfObservationSlipFormRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time_OfObservationSlipForm':time_OfObservationSlipForm,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddObservationSlipFormData_hiddentextfield").val();

            }//end of if

            else if((date == undefined) || (time_OfObservationSlipForm == undefined) || (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }


            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
	<script type="text/javascript">
        //Once the Update page loads get the value of the TIME.
        //On Update observation/raw data

        $('#getTIMEFilledInBeforeUpdate_hiddentextfield').val("");  //Clear the field.
        $('#getTIMEFilledInBeforeUpdate_hiddentextfield').empty();
        $("#getTIMEFilledInBeforeUpdate_hiddentextfield").val(timeOnUpdateOfTheForm);


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB When the fields are not picked frm the DB
            //Validate each field before inserting into the DB
            $('#updateObservationSlipFormData_button').click(function(event) {

                //Check for duplicate Entry Data when adding new archive metar form.
                var timeRecordedAfterUpdate=$('#timeRecorded').val();
                var initialTimeRecordedBeforeUpdate=$("#getTIMEFilledInBeforeUpdate_hiddentextfield").val();
                //if Time was updated.Check for Duplicates frm DB.Not Equal to the inital inserted TIME
                //if Time was not updated.Do nothing.Just do not check for duplicates.
                if(initialTimeRecordedBeforeUpdate!=timeRecordedAfterUpdate){

                    if (checkDuplicateEntryData_OnUpdateObservationSlipFormData() == 'true') {
                        alert("observation/raw data Record With the date,station,station Number and Time exists already in the db");
                         return false;
                    } else if(checkDuplicateEntryData_OnUpdateObservationSlipFormData() == 'Missing'){
                        alert('Station Name or Number not picked');
                        return false;
                    }

                    //getTIMEFilledInBeforeUpdate_hiddentextfield

                }//END OF IF INTITAL TIME IS NOT EQUAL TO UPDATED TIME.CHECK FOR DUPLICATES.




                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalueForIntialTIMEFilledInBeforeUpdate=$('#getTIMEFilledInBeforeUpdate_hiddentextfield').val();
                if(hiddenvalueForIntialTIMEFilledInBeforeUpdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked for initial time");
                      $('#getTIMEFilledInBeforeUpdate_hiddentextfield').val("");  //Clear the field.
                     $("#getTIMEFilledInBeforeUpdate_hiddentextfield").focus();
                    return false;

                }




                //Check that id of the row is picked
                var rowid=$('#id').val();
                if(rowid==""){  // returns true if the variable does NOT contain a valid number
                    alert("Row id not picked");
                     $('#id').val("");  //Clear the field.
                     $("#id").focus();
                    return false;

                }




                //Check that Date selected
                var date=$('#expdate').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
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

                //Check that the TIME is selected from the list of TIME for the observation/raw data
                var timeRecorded=$('#timeRecorded').val();
                if(timeRecorded==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  observation/raw data not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }

///////////////////////////////////////////////////////////////////////
                var maxRead=$('#maxRead').val();
                if(maxRead > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxRead Temperature can't go beyond 42 degrees");
                    $('#maxRead').val("");  //Clear the field.
                    $("#maxRead").focus();
                    return false;

                }
                var maxReset=$('#maxReset').val();
                if(maxReset > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxReset Temperature can't go beyond 42 degrees");
                    $('#maxReset').val("");  //Clear the field.
                    $("#maxReset").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var minRead=$('#minRead').val();
                if(minRead > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinRead Temperature can't go beyond 42 degrees");
                    $('#minRead').val("");  //Clear the field.
                    $("#minRead").focus();
                    return false;

                }
                var minReset=$('#minReset').val();
                if(minReset > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinReset Temperature can't go beyond 42 degrees");
                    $('#minReset').val("");  //Clear the field.
                    $("#minReset").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var winddirection=$('#winddirection').val();
                if((winddirection > 360) || (winddirection < 000) ){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Direction should be between 000 to 360");
                    $('#winddirection').val("");  //Clear the field.
                    $("#winddirection").focus();
                    return false;

                }
                var windspeed=$('#windspeed').val();
                if(minReset < 000){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Speed can't go beyond 000");
                    $('#windspeed').val("");  //Clear the field.
                    $("#windspeed").focus();
                    return false;

                }


                //Check that REWIW1 IS PICKED FROM A LIST
                var approval=$('#approval').val();
                if(approval==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select approval from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }













            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnUpdateObservationSlipFormData(){

            //Check against the date,stationName,StationNumber,Time
            //$('#updateForm').append('<input type="hidden" name="checkduplicateEntryOnUpdateObservationSlipFormData_hiddentextfield" id="checkduplicateEntryOnUpdateObservationSlipFormData_hiddentextfield" value="" />');

            var output="false";
            var date= $('#expdate').val();


            var stationName = $('#station').val();
            var stationNumber= $('#stationNo').val();

            var time_OfObservationSlipForm = $('#timeRecorded').val();




            if ((date != undefined) && (time_OfObservationSlipForm != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ObservationSlipForm/checkInDBIfObservationSlipFormRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time_OfObservationSlipForm':time_OfObservationSlipForm,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            output = data;
                            // alert(output);
                            //alert(data);
                            //return false;




                        }
                        else if(data=="false"){

                            output = data;
                            // alert(output);
                            //alert(data);
                            //return false;

                        }
                    }

                });//end of ajax

            }//end of if

            else if((date == undefined) || (time_OfObservationSlipForm == undefined) || (stationName == undefined) || (stationNumber == undefined)  ){

               // alert("Missing");
                //return false;
                //functionreturnvalue="Missing";
                output = "Missing";

            }

            return output;


        }//end of check duplicate values in the DB On Update


    </script>
    <script>

      function  someOtherFunc(data){

          $('#checkduplicateEntryOnUpdateObservationSlipFormData_hiddentextfield').val("");  //Clear the field.
          $('#checkduplicateEntryOnUpdateObservationSlipFormData_hiddentextfield').empty();
          $("#checkduplicateEntryOnUpdateObservationSlipFormData_hiddentextfield").val(data);

      }

    </script>
<?php if((is_array($observationslipidupdate) && count($observationslipidupdate))){?>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
          /////////////////////////////////////////////////////////////////////////////
                      var newValue_date;
                      var oldValue_station=$('#date').val();

                      $('#date').live('change paste', function(){
                          newValue_date = $(this).val();

                          var retVal = confirm("Do you want to make updates to this field ?");
                          if( retVal == true ){
                              //document.write ("User wants to continue!");

                              $('#date').val(newValue_date);
                              return true;
                          }
                          else{
                              $('#date').val(oldValue_date);
                              return false;
                          }

                      });
                      /////////////////////////////////////////////////////////////////////////////
                                  var newValue_totalamountofallclouds_observationslipform;
                                  var oldValue_totalamountofallclouds_observationslipform=$('#totalamountofallclouds_observationslipform').val();

                                  $('#totalamountofallclouds_observationslipform').live('change paste', function(){
                                      newValue_totalamountofallclouds_observationslipform = $(this).val();

                                      var retVal = confirm("Do you want to make updates to this field ?");
                                      if( retVal == true ){
                                          //document.write ("User wants to continue!");

                                          $('#totalamountofallclouds_observationslipform').val(newValue_totalamountofallclouds_observationslipform);
                                          return true;
                                      }
                                      else{
                                          $('#totalamountofallclouds_observationslipform').val(oldValue_totalamountofallclouds_observationslipform);
                                          return false;
                                      }

                                  });

          /////////////////////////////////////////////////////////////////////////////
                      var newValue_totalamountoflowclouds_observationslipform;
                      var oldValue_totalamountoflowclouds_observationslipform=$('#totalamountoflowclouds_observationslipform').val();

                      $('#totalamountoflowclouds_observationslipform').live('change paste', function(){
                          newValue_totalamountoflowclouds_observationslipform = $(this).val();

                          var retVal = confirm("Do you want to make updates to this field ?");
                          if( retVal == true ){
                              //document.write ("User wants to continue!");

                              $('#totalamountoflowclouds_observationslipform').val(newValue_totalamountoflowclouds_observationslipform);
                              return true;
                          }
                          else{
                              $('#totalamountoflowclouds_observationslipform').val(oldValue_totalamountoflowclouds_observationslipform);
                              return false;
                          }

                      });
                      /////////////////////////////////////////////////////////////////////////////
                                  var newValue_metar_speci;
                                  var oldValue_metar_speci=$('#metar_speci').val();

                                  $('#metar_speci').live('change paste', function(){
                                      newValue_metar_speci = $(this).val();

                                      var retVal = confirm("Do you want to make updates to this field ?");
                                      if( retVal == true ){
                                          //document.write ("User wants to continue!");

                                          $('#metar_speci').val(newValue_metar_speci);
                                          return true;
                                      }
                                      else{
                                          $('#metar_speci').val(oldValue_metar_speci);
                                          return false;
                                      }

                                  });
                                  /////////////////////////////////////////////////////////////////////////////
                                              var newValue_specitimeId;
                                              var oldValue_specitimeId=$('#specitimeId').val();

                                              $('#specitimeId').live('change paste', function(){
                                                  newValue_specitimeId = $(this).val();

                                                  var retVal = confirm("Do you want to make updates to this field ?");
                                                  if( retVal == true ){
                                                      //document.write ("User wants to continue!");

                                                      $('#specitimeId').val(newValue_specitimeId);
                                                      return true;
                                                  }
                                                  else{
                                                      $('#specitimeId').val(oldValue_specitimeId);
                                                      return false;
                                                  }

                                              });

                      /////////////////////////////////////////////////////////////////////////////
                                  var newValue_metartimeId;
                                  var oldValue_metartimeId=$('#metartimeId').val();

                                  $('#metartimeId').live('change paste', function(){
                                      newValue_metartimeId = $(this).val();

                                      var retVal = confirm("Do you want to make updates to this field ?");
                                      if( retVal == true ){
                                          //document.write ("User wants to continue!");

                                          $('#metartimeId').val(newValue_metartimeId);
                                          return true;
                                      }
                                      else{
                                          $('#metartimeId').val(oldValue_metartimeId);
                                          return false;
                                      }

                                  });

/////////////////////////////////////////////////////////////////////////////
            var newValue_TypeOfLowClouds1_observationslipform;
            var oldValue_TypeOfLowClouds1_observationslipform=$('#TypeOfLowClouds1_observationslipform').val();

            $('#TypeOfLowClouds1_observationslipform').live('change paste', function(){
                newValue_TypeOfLowClouds1_observationslipform = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#TypeOfLowClouds1_observationslipform').val(newValue_TypeOfLowClouds1_observationslipform);
                    return true;
                }
                else{
                    $('#TypeOfLowClouds1_observationslipform').val(oldValue_TypeOfLowClouds1_observationslipform);
                    return false;
                }

            });
            /////////////////////////////////////////////////////////////////////////////
                        var newValue_OktasOfLowClouds1_observationslipform;
                        var oldValue_OktasOfLowClouds1_observationslipform=$('#OktasOfLowClouds1_observationslipform').val();

                        $('#OktasOfLowClouds1_observationslipform').live('change paste', function(){
                            newValue_OktasOfLowClouds1_observationslipform = $(this).val();

                            var retVal = confirm("Do you want to make updates to this field ?");
                            if( retVal == true ){
                                //document.write ("User wants to continue!");

                                $('#OktasOfLowClouds1_observationslipform').val(newValue_OktasOfLowClouds1_observationslipform);
                                return true;
                            }
                            else{
                                $('#OktasOfLowClouds1_observationslipform').val(oldValue_OktasOfLowClouds1_observationslipform);
                                return false;
                            }

                        });
  /////////////////////////////////////////////////////////////////////////////
                                    var newValue_HeightLowClouds1_observationslipform;
                                    var oldValue_HeightLowClouds1_observationslipform=$('#HeightLowClouds1_observationslipform').val();

                                    $('#HeightLowClouds1_observationslipform').live('change paste', function(){
                                        newValue_HeightLowClouds1_observationslipform = $(this).val();

                                        var retVal = confirm("Do you want to make updates to this field ?");
                                        if( retVal == true ){
                                            //document.write ("User wants to continue!");

                                            $('#HeightLowClouds1_observationslipform').val(newValue_HeightLowClouds1_observationslipform);
                                            return true;
                                        }
                                        else{
                                            $('#HeightLowClouds1_observationslipform').val(oldValue_HeightLowClouds1_observationslipform);
                                            return false;
                                        }

        });
        /////////////////////////////////////////////////////////////////////////////
                                          var newValue_CLCODEOfLowClouds1_observationslipform;
                                          var oldValue_CLCODEOfLowClouds1_observationslipform=$('#CLCODEOfLowClouds1_observationslipform').val();

                                          $('#CLCODEOfLowClouds1_observationslipform').live('change paste', function(){
                                              newValue_CLCODEOfLowClouds1_observationslipform = $(this).val();

                                              var retVal = confirm("Do you want to make updates to this field ?");
                                              if( retVal == true ){
                                                  //document.write ("User wants to continue!");

                                                  $('#CLCODEOfLowClouds1_observationslipform').val(newValue_CLCODEOfLowClouds1_observationslipform);
                                                  return true;
                                              }
                                              else{
                                                  $('#CLCODEOfLowClouds1_observationslipform').val(oldValue_CLCODEOfLowClouds1_observationslipform);
                                                  return false;
                                              }

              });
              /////////////////////////////////////////////////////////////////////////////
                                                var newValue_TypeOfMediumClouds1_observationslipform;
                                                var oldValue_TypeOfMediumClouds1_observationslipform=$('#TypeOfMediumClouds1_observationslipform').val();

                                                $('#TypeOfMediumClouds1_observationslipform').live('change paste', function(){
                                                    newValue_TypeOfMediumClouds1_observationslipform = $(this).val();

                                                    var retVal = confirm("Do you want to make updates to this field ?");
                                                    if( retVal == true ){
                                                        //document.write ("User wants to continue!");

                                                        $('#TypeOfMediumClouds1_observationslipform').val(newValue_TypeOfMediumClouds1_observationslipform);
                                                        return true;
                                                    }
                                                    else{
                                                        $('#TypeOfMediumClouds1_observationslipform').val(oldValue_TypeOfMediumClouds1_observationslipform);
                                                        return false;
                                                    }

                    });
                    /////////////////////////////////////////////////////////////////////////////
                                                      var newValue_OktasOfMediumClouds1_observationslipform;
                                                      var oldValue_OktasOfMediumClouds1_observationslipform=$('#OktasOfMediumClouds1_observationslipform').val();

                                                      $('#OktasOfMediumClouds1_observationslipform').live('change paste', function(){
                                                          newValue_OktasOfMediumClouds1_observationslipform = $(this).val();

                                                          var retVal = confirm("Do you want to make updates to this field ?");
                                                          if( retVal == true ){
                                                              //document.write ("User wants to continue!");

                                                              $('#OktasOfMediumClouds1_observationslipform').val(newValue_OktasOfMediumClouds1_observationslipform);
                                                              return true;
                                                          }
                                                          else{
                                                              $('#OktasOfMediumClouds1_observationslipform').val(oldValue_OktasOfMediumClouds1_observationslipform);
                                                              return false;
                                                          }

                          });
/////////////////////////////////////////////////////////////////////////////
                                  var newValue_HeightOfMediumClouds1_observationslipform;
                                  var oldValue_HeightOfMediumClouds1_observationslipform=$('#HeightOfMediumClouds1_observationslipform').val();

                                  $('#HeightOfMediumClouds1_observationslipform').live('change paste', function(){
                                      newValue_HeightOfMediumClouds1_observationslipform = $(this).val();

                                      var retVal = confirm("Do you want to make updates to this field ?");
                                      if( retVal == true ){
                                          //document.write ("User wants to continue!");

                                          $('#HeightOfMediumClouds1_observationslipform').val(newValue_HeightOfMediumClouds1_observationslipform);
                                          return true;
                                      }
                                      else{
                                          $('#HeightOfMediumClouds1_observationslipform').val(oldValue_HeightOfMediumClouds1_observationslipform);
                                          return false;
                                      }

      });
      /////////////////////////////////////////////////////////////////////////////
                                        var newValue_CLCODEOfMediumClouds1_observationslipform;
                                        var oldValue_CLCODEOfMediumClouds1_observationslipform=$('#CLCODEOfMediumClouds1_observationslipform').val();

                                        $('#CLCODEOfMediumClouds1_observationslipform').live('change paste', function(){
                                            newValue_CLCODEOfMediumClouds1_observationslipform = $(this).val();

                                            var retVal = confirm("Do you want to make updates to this field ?");
                                            if( retVal == true ){
                                                //document.write ("User wants to continue!");

                                                $('#CLCODEOfMediumClouds1_observationslipform').val(newValue_CLCODEOfMediumClouds1_observationslipform);
                                                return true;
                                            }
                                            else{
                                                $('#CLCODEOfMediumClouds1_observationslipform').val(oldValue_CLCODEOfMediumClouds1_observationslipform);
                                                return false;
                                            }

            });
            /////////////////////////////////////////////////////////////////////////////
                                              var newValue_TypeOfHighClouds1_observationslipform;
                                              var oldValue_TypeOfHighClouds1_observationslipform=$('#TypeOfHighClouds1_observationslipform').val();

                                              $('#TypeOfHighClouds1_observationslipform').live('change paste', function(){
                                                  newValue_TypeOfHighClouds1_observationslipform = $(this).val();

                                                  var retVal = confirm("Do you want to make updates to this field ?");
                                                  if( retVal == true ){
                                                      //document.write ("User wants to continue!");

                                                      $('#TypeOfHighClouds1_observationslipform').val(newValue_TypeOfHighClouds1_observationslipform);
                                                      return true;
                                                  }
                                                  else{
                                                      $('#TypeOfHighClouds1_observationslipform').val(oldValue_TypeOfHighClouds1_observationslipform);
                                                      return false;
                                                  }

                  });
/////////////////////////////////////////////////////////////////////////////
                                var newValue_OktasOfHighClouds1_observationslipform;
                                var oldValue_OktasOfHighClouds1_observationslipform=$('#OktasOfHighClouds1_observationslipform').val();

                                $('#OktasOfHighClouds1_observationslipform').live('change paste', function(){
                                    newValue_OktasOfHighClouds1_observationslipform = $(this).val();

                                    var retVal = confirm("Do you want to make updates to this field ?");
                                    if( retVal == true ){
                                        //document.write ("User wants to continue!");

                                        $('#OktasOfHighClouds1_observationslipform').val(newValue_OktasOfHighClouds1_observationslipform);
                                        return true;
                                    }
                                    else{
                                        $('#OktasOfHighClouds1_observationslipform').val(oldValue_OktasOfHighClouds1_observationslipform);
                                        return false;
                                    }

    });
/////////////////////////////////////////////////////////////////////////////
                      var newValue_HeightOfHighClouds1_observationslipform;
                      var oldValue_HeightOfHighClouds1_observationslipform=$('#HeightOfHighClouds1_observationslipform').val();

                      $('#HeightOfHighClouds1_observationslipform').live('change paste', function(){
                          newValue_HeightOfHighClouds1_observationslipform = $(this).val();

                          var retVal = confirm("Do you want to make updates to this field ?");
                          if( retVal == true ){
                              //document.write ("User wants to continue!");

                              $('#HeightOfHighClouds1_observationslipform').val(newValue_HeightOfHighClouds1_observationslipform);
                              return true;
                          }
                          else{
                              $('#HeightOfHighClouds1_observationslipform').val(oldValue_HeightOfHighClouds1_observationslipform);
                              return false;
                          }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_CLCODEOfHighClouds1_observationslipform;
                  var oldValue_CLCODEOfHighClouds1_observationslipform=$('#CLCODEOfHighClouds1_observationslipform').val();

                  $('#CLCODEOfHighClouds1_observationslipform').live('change paste', function(){
                      newValue_CLCODEOfHighClouds1_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#CLCODEOfHighClouds1_observationslipform').val(newValue_CLCODEOfHighClouds1_observationslipform);
                          return true;
                      }
                      else{
                          $('#CLCODEOfHighClouds1_observationslipform').val(oldValue_CLCODEOfHighClouds1_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_TypeOfLowClouds2;
                  var oldValue_TypeOfLowClouds2=$('#TypeOfLowClouds2').val();

                  $('#TypeOfLowClouds2').live('change paste', function(){
                      newValue_TypeOfLowClouds2 = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#TypeOfLowClouds2').val(newValue_TypeOfLowClouds2);
                          return true;
                      }
                      else{
                          $('#TypeOfLowClouds2').val(oldValue_TypeOfLowClouds2);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfLowClouds2;
                  var oldValue_OktasOfLowClouds2=$('#OktasOfLowClouds2').val();

                  $('#OktasOfLowClouds2').live('change paste', function(){
                      newValue_OktasOfLowClouds2 = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#OktasOfLowClouds2').val(newValue_OktasOfLowClouds2);
                          return true;
                      }
                      else{
                          $('#OktasOfLowClouds2').val(oldValue_OktasOfLowClouds2);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightOfLowClouds2_observationslipform;
                  var oldValue_HeightOfLowClouds2_observationslipform=$('#HeightOfLowClouds2_observationslipform').val();

                  $('#HeightOfLowClouds2_observationslipform').live('change paste', function(){
                      newValue_HeightOfLowClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightOfLowClouds2_observationslipform').val(newValue_HeightOfLowClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightOfLowClouds2_observationslipform').val(oldValue_HeightOfLowClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_CLCODEOfLowClouds2;
                  var oldValue_CLCODEOfLowClouds2=$('#CLCODEOfLowClouds2').val();

                  $('#CLCODEOfLowClouds2').live('change paste', function(){
                      newValue_CLCODEOfLowClouds2 = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#CLCODEOfLowClouds2').val(newValue_CLCODEOfLowClouds2);
                          return true;
                      }
                      else{
                          $('#CLCODEOfLowClouds2').val(oldValue_CLCODEOfLowClouds2);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_TypeOfMediumClouds2_observationslipform;
                  var oldValue_TypeOfMediumClouds2_observationslipform=$('#TypeOfMediumClouds2_observationslipform').val();

                  $('#TypeOfMediumClouds2_observationslipform').live('change paste', function(){
                      newValue_TypeOfMediumClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#TypeOfMediumClouds2_observationslipform').val(newValue_TypeOfMediumClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#TypeOfMediumClouds2_observationslipform').val(oldValue_TypeOfMediumClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfMediumClouds2_observationslipform;
                  var oldValue_OktasOfMediumClouds2_observationslipform=$('#OktasOfMediumClouds2_observationslipform').val();

                  $('#OktasOfMediumClouds2_observationslipform').live('change paste', function(){
                      newValue_OktasOfMediumClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#OktasOfMediumClouds2_observationslipform').val(newValue_OktasOfMediumClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#OktasOfMediumClouds2_observationslipform').val(oldValue_OktasOfMediumClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightOfMediumClouds2_observationslipform;
                  var oldValue_HeightOfMediumClouds2_observationslipform=$('#HeightOfMediumClouds2_observationslipform').val();

                  $('#HeightOfMediumClouds2_observationslipform').live('change paste', function(){
                      newValue_HeightOfMediumClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightOfMediumClouds2_observationslipform').val(newValue_HeightOfMediumClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightOfMediumClouds2_observationslipform').val(oldValue_HeightOfMediumClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_CLCODEOfMediumClouds2_observationslipform;
                  var oldValue_CLCODEOfMediumClouds2_observationslipform=$('#CLCODEOfMediumClouds2_observationslipform').val();

                  $('#CLCODEOfMediumClouds2_observationslipform').live('change paste', function(){
                      newValue_CLCODEOfMediumClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#CLCODEOfMediumClouds2_observationslipform').val(newValue_CLCODEOfMediumClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#CLCODEOfMediumClouds2_observationslipform').val(oldValue_CLCODEOfMediumClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_TypeOfHighClouds2_observationslipform;
                  var oldValue_TypeOfHighClouds2_observationslipform=$('#TypeOfHighClouds2_observationslipform').val();

                  $('#TypeOfHighClouds2_observationslipform').live('change paste', function(){
                      newValue_TypeOfHighClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#TypeOfHighClouds2_observationslipform').val(newValue_TypeOfHighClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#TypeOfHighClouds2_observationslipform').val(oldValue_TypeOfHighClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightOfHighClouds2_observationslipform;
                  var oldValue_HeightOfHighClouds2_observationslipform=$('#HeightOfHighClouds2_observationslipform').val();

                  $('#HeightOfHighClouds2_observationslipform').live('change paste', function(){
                      newValue_HeightOfHighClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightOfHighClouds2_observationslipform').val(newValue_HeightOfHighClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightOfHighClouds2_observationslipform').val(oldValue_HeightOfHighClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_TypeOfLowClouds3;
                  var oldValue_TypeOfLowClouds3=$('#TypeOfLowClouds3').val();

                  $('#TypeOfLowClouds3').live('change paste', function(){
                      newValue_TypeOfLowClouds3 = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#TypeOfLowClouds3').val(newValue_TypeOfLowClouds3);
                          return true;
                      }
                      else{
                          $('#TypeOfLowClouds3').val(oldValue_TypeOfLowClouds3);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfLowClouds3_observationslipform;
                  var oldValue_OktasOfLowClouds3_observationslipform=$('#OktasOfLowClouds3_observationslipform').val();

                  $('#OktasOfLowClouds3_observationslipform').live('change paste', function(){
                      newValue_OktasOfLowClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#OktasOfLowClouds3_observationslipform').val(newValue_OktasOfLowClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#OktasOfLowClouds3_observationslipform').val(oldValue_OktasOfLowClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightLowClouds3_observationslipform;
                  var oldValue_HeightLowClouds3_observationslipform=$('#HeightLowClouds3_observationslipform').val();

                  $('#HeightLowClouds3_observationslipform').live('change paste', function(){
                      newValue_HeightLowClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightLowClouds3_observationslipform').val(newValue_HeightLowClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightLowClouds3_observationslipform').val(oldValue_HeightLowClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_CLCODEOfLowClouds3_observationslipform;
                  var oldValue_CLCODEOfLowClouds3_observationslipform=$('#CLCODEOfLowClouds3_observationslipform').val();

                  $('#CLCODEOfLowClouds3_observationslipform').live('change paste', function(){
                      newValue_CLCODEOfLowClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#CLCODEOfLowClouds3_observationslipform').val(newValue_CLCODEOfLowClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#CLCODEOfLowClouds3_observationslipform').val(oldValue_CLCODEOfLowClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_TypeOfMediumClouds3_observationslipform;
                  var oldValue_TypeOfMediumClouds3_observationslipform=$('#TypeOfMediumClouds3_observationslipform').val();

                  $('#TypeOfMediumClouds3_observationslipform').live('change paste', function(){
                      newValue_TypeOfMediumClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#TypeOfMediumClouds3_observationslipform').val(newValue_TypeOfMediumClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#TypeOfMediumClouds3_observationslipform').val(oldValue_TypeOfMediumClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfMediumClouds3_observationslipform;
                  var oldValue_OktasOfMediumClouds3_observationslipform=$('#OktasOfMediumClouds3_observationslipform').val();

                  $('#OktasOfMediumClouds3_observationslipform').live('change paste', function(){
                      newValue_OktasOfMediumClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#OktasOfMediumClouds3_observationslipform').val(newValue_OktasOfMediumClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#OktasOfMediumClouds3_observationslipform').val(oldValue_OktasOfMediumClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightOfMediumClouds3_observationslipform;
                  var oldValue_HeightOfMediumClouds3_observationslipform=$('#HeightOfMediumClouds3_observationslipform').val();

                  $('#HeightOfMediumClouds3_observationslipform').live('change paste', function(){
                      newValue_HeightOfMediumClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightOfMediumClouds3_observationslipform').val(newValue_HeightOfMediumClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightOfMediumClouds3_observationslipform').val(oldValue_HeightOfMediumClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_CLCODEOfMediumClouds3_observationslipform;
                  var oldValue_CLCODEOfMediumClouds3_observationslipform=$('#CLCODEOfMediumClouds3_observationslipform').val();

                  $('#CLCODEOfMediumClouds3_observationslipform').live('change paste', function(){
                      newValue_CLCODEOfMediumClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#CLCODEOfMediumClouds3_observationslipform').val(newValue_CLCODEOfMediumClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#CLCODEOfMediumClouds3_observationslipform').val(oldValue_CLCODEOfMediumClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_TypeOfHighClouds3_observationslipform;
                  var oldValue_TypeOfHighClouds3_observationslipform=$('#TypeOfHighClouds3_observationslipform').val();

                  $('#TypeOfHighClouds3_observationslipform').live('change paste', function(){
                      newValue_TypeOfHighClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#TypeOfHighClouds3_observationslipform').val(newValue_TypeOfHighClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#TypeOfHighClouds3_observationslipform').val(oldValue_TypeOfHighClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfHighClouds3_observationslipform;
                  var oldValue_OktasOfHighClouds3_observationslipform=$('#OktasOfHighClouds3_observationslipform').val();

                  $('#OktasOfHighClouds3_observationslipform').live('change paste', function(){
                      newValue_OktasOfHighClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#OktasOfHighClouds3_observationslipform').val(newValue_OktasOfHighClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#OktasOfHighClouds3_observationslipform').val(oldValue_OktasOfHighClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightOfHighClouds3_observationslipform;
                  var oldValue_HeightOfHighClouds3_observationslipform=$('#HeightOfHighClouds3_observationslipform').val();

                  $('#HeightOfHighClouds3_observationslipform').live('change paste', function(){
                      newValue_HeightOfHighClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightOfHighClouds3_observationslipform').val(newValue_HeightOfHighClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightOfHighClouds3_observationslipform').val(oldValue_HeightOfHighClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_CLCODEOfHighClouds3_observationslipform;
                  var oldValue_CLCODEOfHighClouds3_observationslipform=$('#CLCODEOfHighClouds3_observationslipform').val();

                  $('#CLCODEOfHighClouds3_observationslipform').live('change paste', function(){
                      newValue_CLCODEOfHighClouds3_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#CLCODEOfHighClouds3_observationslipform').val(newValue_CLCODEOfHighClouds3_observationslipform);
                          return true;
                      }
                      else{
                          $('#CLCODEOfHighClouds3_observationslipform').val(oldValue_CLCODEOfHighClouds3_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_cloudsearchlight;
                  var oldValue_cloudsearchlight=$('#cloudsearchlight').val();

                  $('#cloudsearchlight').live('change paste', function(){
                      newValue_cloudsearchlight = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#cloudsearchlight').val(newValue_cloudsearchlight);
                          return true;
                      }
                      else{
                          $('#cloudsearchlight').val(oldValue_cloudsearchlight);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_rainfall;
                  var oldValue_rainfall=$('#rainfall').val();

                  $('#rainfall').live('change paste', function(){
                      newValue_rainfall = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#rainfall').val(newValue_rainfall);
                          return true;
                      }
                      else{
                          $('#rainfall').val(oldValue_rainfall);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfHighClouds2_observationslipform;
                  var oldValue_oktasOfHighClouds2_observationslipform=$('#oktasOfHighClouds2_observationslipform').val();

                  $('#oktasOfHighClouds2_observationslipform').live('change paste', function(){
                      newValue_oktasOfHighClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#oktasOfHighClouds2_observationslipform').val(newValue_oktasOfHighClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#oktasOfHighClouds2_observationslipform').val(oldValue_oktasOfHighClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_OktasOfHighClouds2_observationslipform;
                  var oldValue_OktasOfHighClouds2_observationslipform=$('#OktasOfHighClouds2_observationslipform').val();

                  $('#OktasOfHighClouds2_observationslipform').live('change paste', function(){
                      newValue_OktasOfHighClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#OktasOfHighClouds2_observationslipform').val(newValue_OktasOfHighClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#OktasOfHighClouds2_observationslipform').val(oldValue_OktasOfHighClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_HeightOfHighClouds2_observationslipform;
                  var oldValue_HeightOfHighClouds2_observationslipform=$('#HeightOfHighClouds2_observationslipform').val();

                  $('#HeightOfHighClouds2_observationslipform').live('change paste', function(){
                      newValue_HeightOfHighClouds2_observationslipform = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#HeightOfHighClouds2_observationslipform').val(newValue_HeightOfHighClouds2_observationslipform);
                          return true;
                      }
                      else{
                          $('#HeightOfHighClouds2_observationslipform').val(oldValue_HeightOfHighClouds2_observationslipform);
                          return false;
                      }

});

/////////////////////////////////////////////////////////////////////////////
                  var newValue_timeRecorded;
                  var oldValue_timeRecorded=$('#timeRecorded').val();

                  $('#timeRecorded').live('change paste', function(){
                      newValue_timeRecorded = $(this).val();

                      var retVal = confirm("Do you want to make updates to this field ?");
                      if( retVal == true ){
                          //document.write ("User wants to continue!");

                          $('#timeRecorded').val(newValue_timeRecorded);
                          return true;
                      }
                      else{
                          $('#timeRecorded').val(oldValue_timeRecorded);
                          return false;
                      }

});
        });
    </script>
<?php }?>


    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_totalamountofallclouds;
            var oldValue_totalamountofallclouds=$('#totalamountofallclouds').val();

            $('#totalamountofallclouds').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_totalamountofallclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#totalamountofallclouds').val(newValue_totalamountofallclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#totalamountofallclouds').val(oldValue_totalamountofallclouds);
                    return false;
                }

            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_totalamountoflowclouds;
            var oldValue_totalamountoflowclouds=$('#totalamountoflowclouds').val();

            $('#totalamountoflowclouds').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_totalamountoflowclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#totalamountoflowclouds').val(newValue_totalamountoflowclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#totalamountoflowclouds').val(oldValue_totalamountoflowclouds);
                    return false;
                }

            });
        });
    </script>



    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds1 ;
            var oldValue_HeightOfLowClouds1= $('#HeightOfLowClouds1').val()

            $('#HeightOfLowClouds1').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds1').val(newValue_HeightOfLowClouds1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds1').val(oldValue_HeightOfLowClouds1);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds2 ;
            var oldValue_HeightOfLowClouds2= $('#HeightOfLowClouds2').val()

            $('#HeightOfLowClouds2').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds2').val(newValue_HeightOfLowClouds2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds2').val(oldValue_HeightOfLowClouds2);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds3 ;
            var oldValue_HeightOfLowClouds3= $('#HeightOfLowClouds3').val()

            $('#HeightOfLowClouds3').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds3').val(newValue_HeightOfLowClouds3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds3').val(oldValue_HeightOfLowClouds3);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds1 ;
            var oldValue_HeightOfMeduimClouds1= $('#HeightOfMeduimClouds1').val()

            $('#HeightOfMeduimClouds1').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds1').val(newValue_HeightOfMeduimClouds1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds1').val(oldValue_HeightOfMeduimClouds1);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds2 ;
            var oldValue_HeightOfMeduimClouds2= $('#HeightOfMeduimClouds2').val()

            $('#HeightOfMeduimClouds2').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds2').val(newValue_HeightOfMeduimClouds2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds2').val(oldValue_HeightOfMeduimClouds2);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds3 ;
            var oldValue_HeightOfMeduimClouds3= $('#HeightOfMeduimClouds3').val()

            $('#HeightOfMeduimClouds3').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds3').val(newValue_HeightOfMeduimClouds3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds3').val(oldValue_HeightOfMeduimClouds3);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds1 ;
            var oldValue_HeightOfHighClouds1= $('#HeightOfHighClouds1').val()

            $('#HeightOfHighClouds1').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds1').val(newValue_HeightOfHighClouds1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds1').val(oldValue_HeightOfHighClouds1);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds2 ;
            var oldValue_HeightOfHighClouds2= $('#HeightOfHighClouds2').val()

            $('#HeightOfHighClouds2').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds2').val(newValue_HeightOfHighClouds2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds2').val(oldValue_HeightOfHighClouds2);
                    return false;
                }
            });
        });
    </script>


    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds3 ;
            var oldValue_HeightOfHighClouds3= $('#HeightOfHighClouds3').val()

            $('#HeightOfHighClouds3').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds3').val(newValue_HeightOfHighClouds3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds3').val(oldValue_HeightOfHighClouds3);
                    return false;
                }
            });
        });
    </script>


    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_cloudsearchlight;
            var oldValue_cloudsearchlight= $('#cloudsearchlight').val()

            $('#cloudsearchlight').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_cloudsearchlight = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudsearchlight').val(newValue_cloudsearchlight);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudsearchlight').val(oldValue_cloudsearchlight);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_rainfall;
            var oldValue_rainfall= $('#rainfall').val();

            $('#rainfall').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
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
                    $('#rainfall').val(oldValue_rainfall);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_drybulb;
            var oldValue_drybulb= $('#drybulb').val();

            $('#drybulb').live('change paste', function(){
                //oldValue_airtemperature = newValue_airtemperature;
                newValue_drybulb = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#drybulb').val(newValue_drybulb);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#drybulb').val(oldValue_drybulb);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_wetbulb;
            var oldValue_wetbulb= $('#wetbulb').val();

            $('#wetbulb').live('change paste', function(){
                oldValue_wetbulb = newValue_wetbulb;
                newValue_wetbulb = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wetbulb').val(newValue_wetbulb);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wetbulb').val(oldValue_wetbulb);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_maxRead;
            var oldValue_maxRead= $('#maxRead').val()

            $('#maxRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_maxRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxRead').val(newValue_maxRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxRead').val(oldValue_maxRead);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_maxReset;
            var oldValue_maxReset= $('#maxReset').val()

            $('#maxReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_maxReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxReset').val(newValue_maxReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxReset').val(oldValue_maxReset);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_minRead;
            var oldValue_minRead= $('#minRead').val()

            $('#minRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_minRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minRead').val(newValue_minRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minRead').val(oldValue_minRead);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_minReset;
            var oldValue_minReset= $('#minReset').val()

            $('#minReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_minReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minReset').val(newValue_minReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minReset').val(oldValue_minReset);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_picheRead;
            var oldValue_picheRead= $('#picheRead').val()

            $('#picheRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_picheRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#picheRead').val(newValue_picheRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#picheRead').val(oldValue_picheRead);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_picheReset;
            var oldValue_picheReset= $('#picheReset').val()

            $('#picheReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_picheReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#picheReset').val(newValue_picheReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#picheReset').val(oldValue_picheReset);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_presentweatherCode;
            var oldValue_presentweatherCode= $('#presentweatherCode').val()

            $('#presentweatherCode').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_presentweatherCode = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#presentweatherCode').val(newValue_presentweatherCode);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#presentweatherCode').val(oldValue_presentweatherCode);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_pastweather;
            var oldValue_pastweather= $('#pastweather').val()

            $('#pastweather').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_pastweather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#pastweather').val(newValue_pastweather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#pastweather').val(oldValue_pastweather);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_timemarksThermo;
            var oldValue_timemarksThermo= $('#timemarksThermo').val();

            $('#timemarksThermo').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksThermo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksThermo').val(newValue_timemarksThermo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksThermo').val(oldValue_timemarksThermo);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_timemarksHygro;
            var oldValue_timemarksHygro= $('#timemarksHygro').val();

            $('#timemarksHygro').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksHygro = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksHygro').val(newValue_timemarksHygro);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksHygro').val(oldValue_timemarksHygro);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_timemarksRainRec;
            var oldValue_timemarksRainRec= $('#timemarksRainRec').val();

            $('#timemarksRainRec').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksRainRec = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksRainRec').val(newValue_timemarksRainRec);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksRainRec').val(oldValue_timemarksRainRec);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_presentweather;
            var oldValue_presentweather= $('#presentweather').val();

            $('#presentweather').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_presentweather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#presentweather').val(newValue_presentweather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#presentweather').val(oldValue_presentweather);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_visibility;
            var oldValue_visibility= $('#visibility').val();

            $('#visibility').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_visibility = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#visibility').val(newValue_visibility);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#visibility').val(oldValue_visibility);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_winddirection;
            var oldValue_winddirection= $('#winddirection').val();

            $('#winddirection').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_winddirection = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddirection').val(newValue_winddirection);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddirection').val(oldValue_winddirection);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windspeed;
            var oldValue_windspeed= $('#windspeed').val();

            $('#windspeed').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_windspeed = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windspeed').val(newValue_windspeed);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windspeed').val(oldValue_windspeed);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_gusting;
            var oldValue_gusting= $('#gusting').val();

            $('#gusting').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_gusting = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gusting').val(newValue_gusting);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gusting').val(oldValue_gusting);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_attdThermo;
            var oldValue_attdThermo= $('#attdThermo').val();

            $('#attdThermo').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_attdThermo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#attdThermo').val(newValue_attdThermo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#attdThermo').val(oldValue_attdThermo);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_prAsRead;
            var oldValue_prAsRead= $('#prAsRead').val();

            $('#prAsRead').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_prAsRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#prAsRead').val(newValue_prAsRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#prAsRead').val(oldValue_prAsRead);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_correction;
            var oldValue_correction= $('#correction').val();

            $('#correction').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_correction = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#correction').val(newValue_correction);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#correction').val(oldValue_correction);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_CLP;
            var oldValue_CLP= $('#CLP').val();

            $('#CLP').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_CLP = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CLP').val(newValue_CLP);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CLP').val(oldValue_CLP);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_MSLPR;
            var oldValue_MSLPR= $('#MSLPR').val();

            $('#MSLPR').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_MSLPR = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#MSLPR').val(newValue_MSLPR);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#MSLPR').val(oldValue_MSLPR);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_timeMarksBarograph;
            var oldValue_timeMarksBarograph= $('#timeMarksBarograph').val();

            $('#timeMarksBarograph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_timeMarksBarograph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timeMarksBarograph').val(newValue_timeMarksBarograph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timeMarksBarograph').val(oldValue_timeMarksBarograph);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_timeMarksAnemograph;
            var oldValue_timeMarksAnemograph= $('#timeMarksAnemograph').val();

            $('#timeMarksAnemograph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_timeMarksAnemograph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timeMarksAnemograph').val(newValue_timeMarksAnemograph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timeMarksAnemograph').val(oldValue_timeMarksAnemograph);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_otherTMarks;
            var oldValue_otherTMarks= $('#otherTMarks').val();

            $('#otherTMarks').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_otherTMarks = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#otherTMarks').val(newValue_otherTMarks);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#otherTMarks').val(oldValue_otherTMarks);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_remarks;
            var oldValue_remarks= $('#remarks').val();

            $('#remarks').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_remarks = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#remarks').val(newValue_remarks);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#remarks').val(oldValue_remarks);
                    return false;
                }
            });
    );
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windRun;
            var oldValue_windRun= $('#windRun').val();

            $('#windRun').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_windRun = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windRun').val(newValue_windRun);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windRun').val(oldValue_windRun);
                    return false;
                }
            });
            );
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_DurationOfSunshine;
            var oldValue_DurationOfSunshine= $('#DurationOfSunshine').val();

            $('#DurationOfSunshine').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_DurationOfSunshine = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#DurationOfSunshine').val(newValue_DurationOfSunshine);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#DurationOfSunshine').val(oldValue_DurationOfSunshine);
                    return false;
                }
            });
            );
    </script>





<?php require_once(APPPATH . 'views/footer.php'); ?>
<script src="<?php echo base_url(); ?>js/form.js"></script>
