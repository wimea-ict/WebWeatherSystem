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
            Observation/Raw Data
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Observation/Raw Data</li>

        </ol>
    </section>
    <!-- Main content -->
    <section>
    <?php require_once(APPPATH . 'views/error.php'); ?>

    <?php

    if(is_array($displaynewobservationslipform) && count($displaynewobservationslipform)) {
        ?>
        <div class="row">
        <form action="<?php echo base_url(); ?>index.php/ObservationSlipForm/insertObervationSlipFormData/" method="post"  name="regForm" id="regForm"  enctype="multipart/form-data">

			 <script language="javascript">



     function chooseSpeciOrMetar(){

      verifyTime();
              var metarORspeci = document.getElementById('metar_speci').value;
              if(metarORspeci=="metar"){
                document.getElementById('metartimeId').style.display="block";
                document.getElementById('specitimeId').style.display="none";

              }else if (metarORspeci=="speci") {
                document.getElementById('metartimeId').style.display="none";
                document.getElementById('specitimeId').style.display="block";


              }else{
                alert("#0001");
              }


          }

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

			<!-- Section 1 -->
			  <div class="tab">
			   <table id="example1" class="table table-bordered table-striped">
			   		<tr>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									<input type="text" name="station_observationslipform" id="station_observationslipform" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								<input type="text" name="stationNo_observationslipform" id="stationNo_observationslipform" required class="form-control"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
							</div>

						</td>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date_observationslipform" id="date" required class="form-control compulsory" placeholder="Enter select date" value="<?php echo date("Y-m-d"); ?>">


								</div>

						</td>
					</tr>
					<tr>
						<td colspan="6">

								<div class="input-group">
									<span class="input-group-addon">Total amount of all clouds</span>
									<select name="totalamountofallclouds_observationslipform"  id="totalamountofallclouds_observationslipform"  onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder=" Enter total amount of All clouds" required>
										<option value="">--Select Total Amount Of All Clouds </option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
									</select>
								</div>

						</td>
						<td colspan="6">


								<div class="input-group">
									<span class="input-group-addon">Total amount of low clouds</span>
									<select  name="totalamountoflowclouds_observationslipform" id="totalamountoflowclouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter total amount of Low clouds" >
										<option value="">--Select Total Amount of Low Clouds </option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>


									</select>
								</div>

						</td>
					</tr>

					<tr>
						<td colspan="6">
              <div class="input-group"   >
                  <span class="input-group-addon">Time category</span>
                  <select name="metar_speci" id="metar_speci" required class="form-control compulsory" onchange="chooseSpeciOrMetar()">
                    <option value="metar">normal</option>
                    <option value="speci">speci</option>

                  </select>
                </div>

						</td>
						<td colspan="6">

              <div class="input-group" id="metartimeId" style="display:block;" >
                  <span class="input-group-addon">NORMAL TIME</span>
                  <select name="metar_time_observationslipform" id="metar_time_observationslipform"  class="form-control compulsory">
                    <option value="<?php $datetime= new DateTime('now',new DateTimeZone('UTC'));  echo $datetime->format('H').":"; echo date('i')>=30? "30Z":"00Z"; ?>"> <?php $datetime= new DateTime('now',new DateTimeZone('UTC'));  echo $datetime->format('H').":"; echo date('i')>=30? "30Z":"00Z"; ?></option>
                    <option value="00:00Z">00:00Z</option>
                    <option value="00:30Z">00:30Z</option>
                    <option value="01:00Z">01:00Z</option>
                    <option value="01:30Z">01:30Z</option>
                    <option value="02:00Z">02:00Z</option>
                    <option value="02:30Z">02:30Z</option>
                    <option value="03:00Z">03:00Z</option>
                    <option value="03:30Z">03:30Z</option>
                    <option value="04:00Z">04:00Z</option>
                    <option value="04:30Z">04:30Z</option>
                    <option value="05:00Z">05:00Z</option>
                    <option value="05:30Z">05:30Z</option>
                    <option value="06:00Z">06:00Z</option>
                    <option value="06:30Z">06:30Z</option>
                    <option value="07:00Z">07:00Z</option>
                    <option value="07:30Z">07:30Z</option>
                    <option value="08:00Z">08:00Z</option>
                    <option value="08:30Z">08:30Z</option>
                    <option value="09:00Z">09:00Z</option>
                    <option value="09:30Z">09:30Z</option>
                    <option value="10:00Z">10:00Z</option>
                    <option value="10:30Z">10:30Z</option>
                    <option value="11:00Z">11:00Z</option>
                    <option value="11:30Z">11:30Z</option>
                    <option value="12:00Z">12:00Z</option>
                    <option value="12:30Z">12:30Z</option>
                    <option value="13:00Z">13:00Z</option>
                    <option value="13:30Z">13:30Z</option>
                    <option value="14:00Z">14:00Z</option>
                    <option value="14:30Z">14:30Z</option>
                    <option value="15:00Z">15:00Z</option>
                    <option value="15:30Z">15:30Z</option>
                    <option value="16:00Z">16:00Z</option>
                    <option value="16:30Z">16:30Z</option>
                    <option value="17:00Z">17:00Z</option>
                    <option value="17:30Z">17:30Z</option>
                    <option value="18:00Z">18:00Z</option>
                    <option value="18:30Z">18:30Z</option>
                    <option value="19:00Z">19:00Z</option>
                    <option value="19:30Z">19:30Z</option>
                    <option value="20:00Z">20:00Z</option>
                    <option value="20:30Z">20:30Z</option>
                    <option value="21:00Z">21:00Z</option>
                    <option value="21:30Z">21:30Z</option>
                    <option value="22:00Z">22:00Z</option>
                    <option value="22:30Z">22:30Z</option>
                    <option value="23:00Z">23:00Z</option>
                    <option value="23:30Z">23:30Z</option>
                  </select>
                  <input type="hidden" name="diff" id="diff" value=""/>
                </div>
									<div class="input-group" id="specitimeId" style="display:none;">
									<span class="input-group-addon">SPECI TIME</span>

                    <div class="input-group bootstrap-timepicker timepicker">
                      <input id="timepicker1" type="text" name="speci_time_observationslipform" id="time_observationslipform"  class="form-control compulsory">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                    <span ng-hide="Timerequired" class="validator">Time required please</span>

                  <script type="text/javascript">
                              $('#timepicker1').timepicker();
                          </script>
								</div>

						</td>

					</tr>

					<tr>
						<td colspan = "4">
							<b>Low</b>
						</td>
						<td colspan = "4">
							<b>Medium</b>
						</td>
						<td colspan = "4">
							<b>High</b>
						</td>
					</tr>
					<tr>
						<td><b>type</b></td> <td><b>oktas</b></td> <td><b>height</b></td> <td><b>clcode</b></td> <td><b>type</b></td> <td><b>oktas</b></td>
						<td><b>height</b></td> <td><b>clcode</b></td> <td><b>type</b></td> <td><b>oktas</b></td> <td><b>height</b></td> <td><b>clcode</b></td>

					</tr>

					<!-- Type 1 clouds -->

					<tr>
						<td>
						<select  name="TypeOfLowClouds1_observationslipform"  id="TypeOfLowClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
						<option value=""></option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>

						</select>
						</td>

						<td>
							<select name="OktasOfLowClouds1_observationslipform" id="OktasOfLowClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS  for LOW CLOUD" >
							<option value=""></option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>


						</select>
						</td>

						<td>
							<input type="text" name="HeightOfLowClouds1_observationslipform"  id="HeightLowClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = 'width:70px;'>
						</td>

						<td>
							<select  name="CLCODEOfLowClouds1_observationslipform"  id="CLCODEOfLowClouds1_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of  LOW CLOUD " >
							<option value=""></option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>

						<td>
							<select name="TypeOfMediumClouds1_observationslipform"  id="TypeOfMediumClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
							<option value=""></option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							</select>
						</td>

						<td>
							<select name="OktasOfMediumClouds1_observationslipform" id="OktasOfMediumClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS  OF MEDIUM CLOUD" >
							<option value=""> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							</select>
						</td>

						<td>
							<input type="text" name="HeightOfMediumClouds1_observationslipform"  id="HeightOfMediumClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 " style = "width:70px;">
						</td>

						<td>
							<select name="CLCODEOfMediumClouds1_observationslipform"  id="CLCODEOfMediumClouds1_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
							<option value=""> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							<select name="TypeOfHighClouds1_observationslipform"  id="TypeOfHighClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF HIGH CLOUD" >
								<option value=""> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
						<td>
							 <select name="OktasOfHighClouds1_observationslipform" id="OktasOfHighClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF HIGH CLOUD" >
								<option value=""> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
						</td>
						<td>
							 <input type="text" name="HeightOfHighClouds1_observationslipform"  id="HeightOfHighClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 " style = "width:70px;">
						</td>
						<td>
							<select name="CLCODEOfHighClouds1_observationslipform"  id="CLCODEOfHighClouds1_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE OF MEDIUM CLOUD " >
								<option value=""></option>
								<option value="Cl">Cl</option>
								<option value="Cc">Cc</option>
								<option value="Cs">Cs</option>

							</select>
						</td>
					</tr>

					<!--  Type 2 clouds -->

					<tr>
						<td>
							<select  name="TypeOfLowClouds2_observationslipform"  id="TypeOfLowClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW CLOUD" >
							<option value=""></option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>

							</select>
						</td>

						<td>
							<select name="OktasOfLowClouds2_observationslipform" id="OktasOfLowClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS OF LOW CLOUD" >
							<option value=""> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
						</td>

						<td>
							<input type="text" name="HeightOfLowClouds2_observationslipform"  id="HeightOfLowClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">

						</td>
						<td>
							<select  name="CLCODEOfLowClouds2_observationslipform"  id="CLCODEOfLowClouds2_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of LOW CLOUD " >
							<option value=""> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>
						</select>
						</td>
						<td>
							<select name="TypeOfMediumClouds2_observationslipform"  id="TypeOfMediumClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
							<option value=""></option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							</select>
						</td>
						<td>
							<select name="OktasOfMediumClouds2_observationslipform" id="OktasOfMediumClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF MEDIUM CLOUD" >
							<option value=""> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							</select>
						</td>
						<td>
							 <input type="text" name="HeightOfMediumClouds2_observationslipform"  id="HeightOfMediumClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 "  style = "width: 70px">
						</td>
						<td>
							 <select name="CLCODEOfMediumClouds2_observationslipform"  id="CLCODEOfMediumClouds2_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							<option value=""> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>


							</select>
						</td>
						<td>
							 <select name="TypeOfHighClouds2_observationslipform"  id="TypeOfHighClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF HIGH CLOUD" >
								<option value=""> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
						<td>
							 <select name="OktasOfHighClouds2_observationslipform" id="OktasOfHighClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF HIGH CLOUD" >
								<option value=""> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
						</td>
						<td>
							<input type="text" name="HeightOfHighClouds2_observationslipform"  id="HeightOfHighClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 " style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfHighClouds2_observationslipform"  id="CLCODEOfHighClouds2_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
								<option value=""></option>
								<option value="Cl">Cl</option>
								<option value="Cc">Cc</option>
								<option value="Cs">Cs</option>
							</select>
						</td>
					</tr>

					<!-- Type 3 clouds -->
					<tr>
						<td>
							<select  name="TypeOfLowClouds3_observationslipform"  id="TypeOfLowClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of low Cloud" >
							<option value=""></option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>

						</select>
						</td>

						<td>
							<select name="OktasOfLowClouds3_observationslipform" id="OktasOfLowClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
							<option value=""> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
						</td>

						<td>
							<input type="text" name="HeightOfLowClouds3_observationslipform"  id="HeightLowClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 "  style = "width: 70px;">
						</td>

						<td>
							<select  name="CLCODEOfLowClouds3_observationslipform"  id="CLCODEOfLowClouds3_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of LOW CLOUD " >
							<option value=""> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>
						<td>
							<select name="TypeOfMediumClouds3_observationslipform"  id="TypeOfMediumClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
							<option value=""></option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							</select>
						</td>
						<td>
							<select name="OktasOfMediumClouds3_observationslipform" id="OktasOfMediumClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF MEDIUM CLOUD" >
							<option value=""> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							</select>
						</td>
						<td>
							 <input type="text" name="HeightOfMediumClouds3_observationslipform"  id="HeightOfMediumClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 " style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfMediumClouds3_observationslipform"  id="CLCODEOfMediumClouds3_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							   <option value=""> </option>
								<option value="Ac">Ac</option>
								<option value="As">As</option>
								<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							 <select name="TypeOfHighClouds3_observationslipform"  id="TypeOfHighClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE HIGH CLOUD" >
								<option value=""></option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
						<td>
							<select name="OktasOfHighClouds3_observationslipform" id="OktasOfHighClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS HIGH CLOUD" >
							<option value=""> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
						</td>
						<td>
							<input type="text" name="HeightOfHighClouds3_observationslipform"  id="HeightOfHighClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" 0 " style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfHighClouds3_observationslipform"  id="CLCODEOfHighClouds3_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
								<option value=""></option>
								<option value="Cl">Cl</option>
								<option value="Cc">Cc</option>
								<option value="Cs">Cs</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<div class="input-group">
								<span class="input-group-addon">Cloud Searchlight Alidade Reading</span>
								<input type="text" name="cloudsearchlight_observationslipform" id="cloudsearchlight_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Cloud Searchlight Alidade Reading" >
							</div>
						</td>
						<td colspan="6">
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
							<input type="text" name="rainfall_observationslipform" id="rainfall_observationslipform"   class="form-control" placeholder="Enter Rainfall(mm)" >
						</div>
						</td>
					</tr>
				</table>

				</div>


			  <!-- Section 2 -->
			  <div class="tab">

				 <table id="section2" class="table table-bordered table-striped">

					<tr>
						<td><b>MAX</b></td> <td><b>MIN</b></td> <td><b>PICHE</b></td>

					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">MAX Read</span>
							<input type="text" name="maxRead_observationslipform"  id="maxRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MAX READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">MAX Reset</span>
								<input type="text" name="maxReset_observationslipform" id="maxReset_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MAX RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">MIN Read</span>
								<input type="text" name="minRead_observationslipform"  id="minRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MIN READ" >
							</div><br>

							<div class="input-group">
								<span class="input-group-addon">MIN Reset</span>
								<input type="text" name="minReset_observationslipform" id="minReset_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MIN RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">PICHE Read</span>
								<input type="text" name="picheRead_observationslipform"  id="picheRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter PICHE READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">PICHE Reset</span>
								<input type="text" name="picheReset_observationslipform" id="picheReset_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter PICHE RESET" >
							</div>
						</td>
					</tr>

					<tr>
						<td colspan = "3"><center><b>Time marks</b></center></td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">THERMO</span>
							<input type="text" name="timemarksThermo_observationslipform"  id="timemarksThermo_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS THERMO" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">HYGRO</span>
							<input type="text" name="timemarksHygro_observationslipform" id="timemarksHygro_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS HYGRO" >
						</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">RAIN REC</span>
							<input type="text" name="timemarksRainRec_observationslipform" id="timemarksRainRec_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS RAIN REC" >
						</div>
						</td>
					</tr>

				</table>
			  </div>



			  <!-- Section 3 -->
			  <div class="tab">
					<table id="example1" class="table table-bordered table-striped">
					<tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">PRESENT WEATHER CODE</span>
                <input type="text" name="presentweatherCode_observationslipform" id="presentweatherCode_observationslipform"  onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter PRESENT WEATHER CODE" >

              </div>
            </td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">PRESENT WEATHER</span>
							<select name="presentweather_observationslipform" id="presentweather_observationslipform"   class="form-control" placeholder="Enter PRESENT WEATHER" >
								<option value="">--Select PRESENT WEATHER </option>
								<option value="FG">FG</option>  <!--FOG -->
								<option value="HZ">HZ</option>  <!--HAZE -->
								<option value="TS">TS</option>  <!--THUNDERSTORM -->
								<option value="LL">LL</option>  <!--LIGHTENING -->
								<option value="BR">BR</option>  <!--MIST -->
								<option value="GR">GR</option>  <!--HAIL -->
								<option value="DZ">DZ</option>  <!--DRIZZLE -->
								<option value="RA">RA</option>  <!--RAINFALL -->
							</select>
							</div>
						</td>
					</tr>

					<tr>
						<td>
              <div class="input-group">
               <span class="input-group-addon">Past Weather</span>
               <input type="text" name="pastweather_observationslipform" id="pastweather_observationslipform"   class="form-control" placeholder=" Enter Past Weather " >
             </div>
						</td>
						<td>

						</td>
					</tr>

					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">VISIBILITY</span>
							<input type="text" name="visibility_observationslipform" id="visibility_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter VISIBILITY" >
						</div>
						</td>
						<td>
						 <div class="input-group">
							<span class="input-group-addon">GUSTING(KTS)</span>
							<input type="text" name="gusting_observationslipform" id="gusting_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter GUSTING (KTS)" >
						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" align = "center"><b>wind</b></td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND DIRECTION</span>
								<input type="text" name="winddirection_observationslipform" id="winddirection_observationslipform" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" required placeholder="Enter WIND DIRECTION" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND SPEED(KTS)</span>
								<input type="text" name="windspeed_observationslipform" id="windspeed_observationslipform"  required class="form-control" required placeholder="Enter WIND SPEED(KTS)" >
							</div>
						</td>
					</tr>
					<tr id="hideformetar1" >
						<td>
							<div class="input-group">
								<span class="input-group-addon">SUN DURATION</span>
								<input type="text" name="durationOfSunshine_observationslipform" id="durationOfSunshine_observationslipform"    class="form-control"    placeholder="Enter the Duration of Sunshine" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">WIND RUN</span>
								<input type="text" name="windRun_observationslipform"   id="windRun_observationslipform"   class="form-control"  placeholder=" Enter the  WIND RUN" >
							</div>

						</td>
					</tr>
          <tr><td  colspan="2" align = "center" ><b>Rainfall & Temperature:</b></td></tr>
          <tr>
						<td >
							<div class="input-group">
							<span class="input-group-addon">Dry Bulb</span>
							<input type="text" name="drybulb_observationslipform" id="drybulb_observationslipform" onkeyup="allowIntegerInputOnly(this)"  required class="form-control" required placeholder="Enter Dry Bulb" >
						</div>
						</td>

						<td>
							<div class="input-group">
							<span class="input-group-addon">Wet Bulb</span>
							<input type="text" name="wetbulb_observationslipform" id="wetbulb_observationslipform" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter Wet Bulb" >
						</div>
						</td>
					</tr>

					</table>
			  </div>


			  <!-- Section 4 -->
			  <div class = "tab">
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Attd.Thermo.(C)</span>
								<input type="text" name="attdThermo_observationslipform" id="attdThermo_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter ATTD.THERMO." >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">Pr.As Read(C)</span>
								<input type="text" name="prAsRead_observationslipform" id="prAsRead_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Pr.As Read" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Correction</span>
								<input type="text" name="correction_observationslipform" id="correction_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Correction" >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">C.L.P(mb)</span>
								<input type="text" name="CLP_observationslipform" id="CLP_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter C.L.P(mb)" >
							</div>
						</td>
					</tr>

					<tr>
						<td colspan="2" align="center">
							<div class="input-group">
								<span class="input-group-addon">M.S.L.Pr(mb) or 850mb. Ht.(gpm)</span>
								<input type="text" name="MSLPR_observationslipform" id="MSLPR_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter M.S.L.Pr(mb) or 850mb. Ht.(gpm)" >
							</div>
						</td>

					</tr>

					<tr>
						<td colspan="2" align = "center">Time marks</td>
					</tr>

					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME MARKS BAROGRAPH</span>
								<input type="text" name="timeMarksBarograph_observationslipform" id="timeMarksBarograph_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS BAROGRAPH" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME MARKS ANEMOGRAPH</span>
								<input type="text" name="timeMarksAnemograph_observationslipform" id="timeMarksAnemograph_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS ANEMOGRAPH" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Other T/MARKS </span>
								<input type="text" name="otherTMarks_observationslipform" id="otherTMarks_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter Other T/MARKS" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Remarks or any other Observations </span>
								<input type="text" name="remarks_observationslipform" id="remarks_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter Remarks or any other Observations" >
							</div>
						</td>
					</tr>
				</table>
			  </div>

        <!-- Section 5 -->
      <div class = "tab">
        <table id="example1" class="table table-bordered table-striped">
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Unit of Wind Speed</span>
                <select name="UnitOfWindSpeed_mff" id="UnitOfWindSpeed_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Unit of Wind Speed" >
                  <option value="">--Select Unit Of Wind Speed </option>

                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>



                </select>
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Ind. or omission of precipitation</span>
                <select name="IndOrOmissionOfPrecipitation_mff" id="IndOrOmissionOfPrecipitation_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Ind. or omission of precipitation " >
                  <option value="">--Select Ind. or omission of precipitation </option>

                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>

                </select>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Type of station/present & past weather</span>
                <select name="TypeOfStation_Present_Past_Weather_mff" id="TypeOfStation_Present_Past_Weather_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Type of station/present & past weather" >
                  <option value="">--Select Type of station/present & past weather </option>

                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>

                </select>
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Height Of Lowest Cloud</span>
                <select name="heightOfLowestCloud_mff" id="heightOfLowestCloud_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Height Of The Lowest Cloud" >
                  <option value="">--Select Height Of Lowest Cloud </option>

                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>

                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Standard isobaric surface</span>
                <input type="text" name="StandardIsobaricSurface_mff"id="StandardIsobaricSurface_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Standard isobaric surface" >
              </div>
            </td>
            <td>

              <div class="input-group">
                <span class="input-group-addon">Geopotential Of Standard Isobaric Surface</span>
                <input type="text" name="gpm_mff" id="gpm_mff"   class="form-control"  placeholder="Enter the Geopotential Of Standard Isobaric Surface" >
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Duration Of Period Of Precipitation</span>
                <input type="text" name="dopop_mff" id="dopop_mff"   class="form-control" placeholder="Enter the Duration Of Period Of Precipitation" >
              </div>
            </td>
            <td>

            </td>
          </tr>
        </table>
      </div>

      <!-- Section 6 -->

      <div class = "tab">
        <table id="example1" class="table table-bordered table-striped">
          <tr>
            <td>
              <div class="input-group">
              <span class="input-group-addon">Grass Mininum temperature</span>
              <input type="text" name="gmt_mff" id="gmt_mff"   class="form-control" placeholder=" Enter Grass Mininum temperature " >
            </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Character and Intensity of Precipitation</span>
                <input type="text" name="CI_OfPrecipitation_mff" id="CI_OfPrecipitation_mff"   class="form-control"  placeholder=" Enter Character and Intensity of Precipitation" >
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Beginning or End of Precipitation</span>
                <input type="text" name="BE_OfPrecipitation_mff" id="BE_OfPrecipitation_mff"    class="form-control"    placeholder="Enter Beginning or End of Precipitation" >
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Indicator of type of intrumentation</span>
                <input type="text" name="IndicatorOfTypeOfIntrumentation_mff" id="IndicatorOfTypeOfIntrumentation_mff"    class="form-control"    placeholder="Enter the Indicator of type of intrumentation" >
              </div>
            </td>
          </tr>
          <tr>
              <td>
               <div class="input-group">
                <span class="input-group-addon">Sign of Pressure Change</span>
                <input type="text" name="SignOfPressureChange_mff" id="SignOfPressureChange_mff"    class="form-control"    placeholder="Enter the Sign of Pressure Change" >
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Supplementary Information</span>
                <input type="text" name="supplementaryinformation_mff" id="supplementaryinformation_mff" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Supplementary Information" >
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Vapour Pressure</span>
                <input type="text" name="VapourPressure_mff" id="VapourPressure_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"   placeholder="Enter the Vapour Pressure" >
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">TH GRAPH</span>
                <input type="text" name="thgraph_mff"  id="thgraph_mff"   class="form-control"  placeholder=" Enter TH GRAPH" >
              </div>
            </td>
          </tr>
          <tr>
            <td colspan = "1">
              <span class="input-group-addon">TREND</span>
              <textarea name="Trend_mff"  class="form-control" style="height:40px;" disabled id="Trend_mff" onkeyup=""></textarea>
            </td>
          </tr>
        </table>
      </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="postObservationSlipFormData_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>

  <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <h3>Are you sure you want submit?</h3>
    <button type="button" id="closex" class="close btn btn-sm"  style="float:left;"  onclick='goback()' >Back</button>
    <button type="button" id="yesgo" class="close btn-success btn-sm" style="color:#006400; float:right;" onclick="gosubmit() ">Yes</button>

  </div>

</div>
		</form>
	</div>

    <?php
    }elseif((is_array($observationslipidupdate) && count($observationslipidupdate))) {
        foreach($observationslipidupdate as $observationslipformidupdate){

            $observationslipformid = $obervationslipformidupdate->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ObservationSlipForm/UpdateObservationSlipFormData" method="post" name="updateForm" id="regForm" enctype="multipart/form-data">
            <div class="modal-body">
            <div id="output"></div>
            <script language="javascript">

          function chooseSpeciOrMetar(){

                   var metarORspeci = document.getElementById('metar_speci').value;
                   if(metarORspeci=="metar"){
                     document.getElementById('metartimeId').style.display="block";
                     document.getElementById('specitimeId').style.display="none";
                   }else if (metarORspeci=="speci") {
                     document.getElementById('metartimeId').style.display="none";
                     document.getElementById('specitimeId').style.display="block";
                   }else{
                     alert("#002");
                   }


               }
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

            			<!-- Section 1 -->
			  <div class="tab">
			   <table id="example1" class="table table-bordered table-striped">
					<tr>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									 <input type="text" name="station" id="station" required class="form-control" value="<?php echo $observationslipformidupdate->StationName;?>"  readonly class="form-control" >
								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $observationslipformidupdate->StationNumber;?>" readonly="readonly" >
							</div>

						</td>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date" class="form-control" value="<?php echo $observationslipformidupdate->Date;?>" placeholder="Enter select date" id="expdate" disabled class="form-control">
									<input type="hidden" name="id" id="id" value="<?php echo $observationslipformidupdate->id;?>">
								</div>

						</td>
					</tr>
					<tr>
						<td colspan="6">

								<div class="input-group">
									<span class="input-group-addon">Total amount of all clouds</span>
									<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="totalamountofallclouds_observationslipform"  id="totalamountofallclouds_observationslipform"  onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder=" Enter total amount of All clouds" required>
										 <option value="<?php echo $observationslipformidupdate->TotalAmountOfAllClouds;?>"><?php echo $observationslipformidupdate->TotalAmountOfAllClouds;?> </option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
									</select>
								</div>

						</td>
						<td colspan="6">


								<div class="input-group">
									<span class="input-group-addon">Total amount of low clouds</span>
									<select  <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="totalamountoflowclouds_observationslipform" id="totalamountoflowclouds_observationslipform" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter total amount of Low clouds" >
										<option value="<?php echo $observationslipformidupdate->TotalAmountOfLowClouds;?>"><?php echo $observationslipformidupdate->TotalAmountOfLowClouds;?> </option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>


									</select>
								</div>
						</td>
					</tr>

					<tr>
						<td colspan="6">

							<div class="input-group">
                <span class="input-group-addon">METAR/SPECI</span>
                <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="metar_speci" id="metar_speci" required class="form-control" onchange="chooseSpeciOrMetar()" >
                  <option selected value="<?php echo $observationslipformidupdate->speciOrMetar;?>"><?php echo $observationslipformidupdate->speciOrMetar;?></option>
                  <option value="speci"  >speci</option>
                  <option value="metar">metar</option>
                </select>


							</div>

						</td>
						<td colspan="6">
              <div class="input-group" id="specitimeId" style="display:<?php echo $observationslipformidupdate->speciOrMetar=="speci"? "block":"none";?>;" >
              <span class="input-group-addon">SPECI TIME</span>

                <div class="input-group bootstrap-timepicker timepicker">
                  <input id="timepicker1" type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="speci_time_observationslipform" value="<?php echo $observationslipformidupdate->TIME;?>" id="time_observationslipform" required class="form-control">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
                <span ng-hide="Timerequired" class="validator">Time required please</span>

              <script type="text/javascript">
                          $('#timepicker1').timepicker();
                      </script>
            </div>


                <div class="input-group" id="metartimeId"  style="display:<?php echo $observationslipformidupdate->speciOrMetar=="speci"? "none":"block";?>;" >
                    <span class="input-group-addon">METAR TIME</span>
                    <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="metar_time_observationslipform" id="time_observationslipform" required class="form-control">
                      <option value="<?php echo $observationslipformidupdate->TIME;?>"><?php echo $observationslipformidupdate->TIME;?></option>
                      <option value="00:00Z">00:00Z</option>
                      <option value="00:30Z">00:30Z</option>
                      <option value="01:00Z">01:00Z</option>
                      <option value="01:30Z">01:30Z</option>
                      <option value="02:00Z">02:00Z</option>
                      <option value="02:30Z">02:30Z</option>
                      <option value="03:00Z">03:00Z</option>
                      <option value="03:30Z">03:30Z</option>
                      <option value="04:00Z">04:00Z</option>
                      <option value="04:30Z">04:30Z</option>
                      <option value="05:00Z">05:00Z</option>
                      <option value="05:30Z">05:30Z</option>
                      <option value="06:00Z">06:00Z</option>
                      <option value="06:30Z">06:30Z</option>
                      <option value="07:00Z">07:00Z</option>
                      <option value="07:30Z">07:30Z</option>
                      <option value="08:00Z">08:00Z</option>
                      <option value="08:30Z">08:30Z</option>
                      <option value="09:00Z">09:00Z</option>
                      <option value="09:30Z">09:30Z</option>
                      <option value="10:00Z">10:00Z</option>
                      <option value="10:30Z">10:30Z</option>
                      <option value="11:00Z">11:00Z</option>
                      <option value="11:30Z">11:30Z</option>
                      <option value="12:00Z">12:00Z</option>
                      <option value="12:30Z">12:30Z</option>
                      <option value="13:00Z">13:00Z</option>
                      <option value="13:30Z">13:30Z</option>
                      <option value="14:00Z">14:00Z</option>
                      <option value="14:30Z">14:30Z</option>
                      <option value="15:00Z">15:00Z</option>
                      <option value="15:30Z">15:30Z</option>
                      <option value="16:00Z">16:00Z</option>
                      <option value="16:30Z">16:30Z</option>
                      <option value="17:00Z">17:00Z</option>
                      <option value="17:30Z">17:30Z</option>
                      <option value="18:00Z">18:00Z</option>
                      <option value="18:30Z">18:30Z</option>
                      <option value="19:00Z">19:00Z</option>
                      <option value="19:30Z">19:30Z</option>
                      <option value="20:00Z">20:00Z</option>
                      <option value="20:30Z">20:30Z</option>
                      <option value="21:00Z">21:00Z</option>
                      <option value="21:30Z">21:30Z</option>
                      <option value="22:00Z">22:00Z</option>
                      <option value="22:30Z">22:30Z</option>
                      <option value="23:00Z">23:00Z</option>
                      <option value="23:30Z">23:30Z</option>
                    </select>
                  </div>

						</td>

					</tr>

					<tr>
						<td colspan = "4">
							<b>Low</b>
						</td>
						<td colspan = "4">
							<b>Medium</b>
						</td>
						<td colspan = "4">
							<b>High</b>
						</td>
					</tr>
					<tr>
						<td><b>type</b></td> <td><b>oktas</b></td> <td><b>height</b></td> <td><b>clcode</b></td> <td><b>type</b></td> <td><b>oktas</b></td>
						<td><b>height</b></td> <td><b>clcode</b></td> <td><b>type</b></td> <td><b>oktas</b></td> <td><b>height</b></td> <td><b>clcode</b></td>

					</tr>

					<!-- Type 1 clouds -->

					<tr>
						<td>
						<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfLowClouds1_observationslipform"  id="TypeOfLowClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
						<option value="<?php echo $observationslipformidupdate->TypeOfLowClouds1;?>"><?php echo $observationslipformidupdate->TypeOfLowClouds1;?> </option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>

						</select>
						</td>

						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfLowClouds1_observationslipform" id="OktasOfLowClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS  for LOW CLOUD" >
							<option value="<?php echo $observationslipformidupdate->OktasOfLowClouds1;?>"><?php echo $observationslipformidupdate->OktasOfLowClouds1;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>


						</select>
						</td>

						<td>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfLowClouds1_observationslipform"  id="HeightLowClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfLowClouds1;?>" style = 'width:70px;'>
						</td>

						<td>
							<select  <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfLowClouds1_observationslipform"  id="CLCODEOfLowClouds1_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" >
							<option value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds1;?>"><?php echo $observationslipformidupdate->CLCODEOfLowClouds1;?> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>

						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfMediumClouds1_observationslipform"  id="TypeOfMediumClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
							<option value="<?php echo $observationslipformidupdate->TypeOfMediumClouds1;?>"><?php echo $observationslipformidupdate->TypeOfMediumClouds1;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							</select>
						</td>

						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfMediumClouds1_observationslipform" id="OktasOfMediumClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS  OF MEDIUM CLOUD" >
							 <option value="<?php echo $observationslipformidupdate->OktasOfMediumClouds1;?>"><?php echo $observationslipformidupdate->OktasOfMediumClouds1;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							</select>
						</td>

						<td>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfMediumClouds1_observationslipform"  id="HeightOfMediumClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds1;?>" style = "width:70px;">
						</td>

						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfMediumClouds1_observationslipform"  id="CLCODEOfMediumClouds1_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
							 <option value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds1;?>"><?php echo $observationslipformidupdate->CLCODEOfMediumClouds1;?> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfHighClouds1_observationslipform"  id="TypeOfHighClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF HIGH CLOUD" >
								<option value="<?php echo $observationslipformidupdate->TypeOfHighClouds1;?>"><?php echo $observationslipformidupdate->TypeOfHighClouds1;?> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfHighClouds1_observationslipform" id="OktasOfHighClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF HIGH CLOUD" >
								<option value="<?php echo $observationslipformidupdate->OktasOfHighClouds1;?>"><?php echo $observationslipformidupdate->OktasOfHighClouds1;?> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
						</td>
						<td>
							 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfHighClouds1_observationslipform"  id="HeightOfHighClouds1_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfLowClouds3;?>" style = "width:70px;">
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfHighClouds1_observationslipform"  id="CLCODEOfHighClouds1_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" >
								<option value="<?php echo $observationslipformidupdate->CLCODEOfHighClouds1;?>"><?php echo $observationslipformidupdate->CLCODEOfHighClouds1;?> </option>
								<option value="Cl">Cl</option>
								<option value="Cc">Cc</option>
								<option value="Cs">Cs</option>


							</select>
						</td>
					</tr>

					<!--  Type 2 clouds -->

					<tr>
						<td>

							<select  <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfLowClouds2"  id="TypeOfLowClouds2" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
								<option value="<?php echo $observationslipformidupdate->TypeOfLowClouds2;?>"><?php echo $observationslipformidupdate->TypeOfLowClouds2;?> </option>

								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>

							</select>

						</td>

						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfLowClouds2" id="OktasOfLowClouds2" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
								<option value="<?php echo $observationslipformidupdate->OktasOfLowClouds2;?>"><?php echo $observationslipformidupdate->OktasOfLowClouds2;?> </option>

								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
						</td>

						<td>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfLowClouds2_observationslipform"  id="HeightOfLowClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfLowClouds2;?>" style = "width:70px;">

						</td>
						<td>
							 <select  <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfLowClouds2"  id="CLCODEOfLowClouds2"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE OF LOW CLOUD " >
								<option value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds2;?>"><?php echo $observationslipformidupdate->CLCODEOfLowClouds2;?> </option>

								<option value="Sc">Sc</option>
								<option value="St">St</option>
								<option value="Cu">Cu</option>
								<option value="Cb">Cb</option>
							</select>
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfMediumClouds2_observationslipform"  id="TypeOfMediumClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
							<option value="<?php echo $observationslipformidupdate->TypeOfMediumClouds2;?>"><?php echo $observationslipformidupdate->TypeOfMediumClouds2;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							</select>
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfMediumClouds2_observationslipform" id="OktasOfMediumClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF MEDIUM CLOUD" >
							<option value="<?php echo $observationslipformidupdate->OktasOfMediumClouds2;?>"><?php echo $observationslipformidupdate->OktasOfMediumClouds2;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							</select>
						</td>
						<td>
							 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfMediumClouds2_observationslipform"  id="HeightOfMediumClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds2;?>"  style = "width: 70px">
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfMediumClouds2_observationslipform"  id="CLCODEOfMediumClouds2_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							 <option value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds2;?>"><?php echo $observationslipformidupdate->CLCODEOfMediumClouds2;?> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>


							</select>
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfHighClouds2_observationslipform"  id="TypeOfHighClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF HIGH CLOUD" >
								<option value="<?php echo $observationslipformidupdate->TypeOfHighClouds2;?>"><?php echo $observationslipformidupdate->TypeOfHighClouds2;?> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfHighClouds2_observationslipform" id="OktasOfHighClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF HIGH CLOUD" >
								  <option value="<?php echo $observationslipformidupdate->OktasOfHighClouds2;?>"><?php echo $observationslipformidupdate->OktasOfHighClouds2;?> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
						</td>
						<td>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfHighClouds2_observationslipform"  id="HeightOfHighClouds2_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfHighClouds2;?>" style = "width:70px;">
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfHighClouds2_observationslipform"  id="CLCODEOfHighClouds2_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
								<option value="<?php echo $observationslipformidupdate->CLCODEOfHighClouds2;?>"><?php echo $observationslipformidupdate->CLCODEOfHighClouds2;?> </option>
								<option value="Cl">Cl</option>
								<option value="Cc">Cc</option>
								<option value="Cs">Cs</option>
							</select>
						</td>
					</tr>

					<!-- Type 3 clouds -->
					<tr>
						<td>
							 <select  <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfLowClouds3"  id="TypeOfLowClouds3" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
                        <option value="<?php echo $observationslipformidupdate->TypeOfLowClouds3;?>"><?php echo $observationslipformidupdate->TypeOfLowClouds3;?> </option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
						</td>

						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfLowClouds3_observationslipform" id="OktasOfLowClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
							<option value="<?php echo $observationslipformidupdate->OktasOfLowClouds3;?>"><?php echo $observationslipformidupdate->OktasOfLowClouds3;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
						</td>

						<td>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfLowClouds3_observationslipform"  id="HeightLowClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"   style = "width: 70px;">
						</td>

						<td>
							<select  <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfLowClouds3_observationslipform"  id="CLCODEOfLowClouds3_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of LOW CLOUD " >
							<option value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds3;?>"><?php echo $observationslipformidupdate->CLCODEOfLowClouds3;?> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfMediumClouds3_observationslipform"  id="TypeOfMediumClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
							<option value="<?php echo $observationslipformidupdate->TypeOfMediumClouds3;?>"><?php echo $observationslipformidupdate->TypeOfMediumClouds3;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							</select>
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfMediumClouds3_observationslipform" id="OktasOfMediumClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF MEDIUM CLOUD" >
							<option value="<?php echo $observationslipformidupdate->OktasOfMediumClouds3;?>"><?php echo $observationslipformidupdate->OktasOfMediumClouds3;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							</select>
						</td>
						<td>
							 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfMediumClouds3_observationslipform"  id="HeightOfMediumClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds3;?>" style = "width:70px;">
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfMediumClouds3_observationslipform"  id="CLCODEOfMediumClouds3_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							   <option value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds3;?>"><?php echo $observationslipformidupdate->CLCODEOfMediumClouds3;?> </option>
								<option value="Ac">Ac</option>
								<option value="As">As</option>
								<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfHighClouds3_observationslipform"  id="TypeOfHighClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE HIGH CLOUD" >
							   <option value="<?php echo $observationslipformidupdate->TypeOfHighClouds3;?>"><?php echo $observationslipformidupdate->TypeOfHighClouds3;?> </option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
						<td>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="OktasOfHighClouds3_observationslipform" id="OktasOfHighClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS HIGH CLOUD" >
							<option value="<?php echo $observationslipformidupdate->OktasOfHighClouds3;?>"><?php echo $observationslipformidupdate->OktasOfHighClouds3;?> </option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
						</td>
						<td>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="HeightOfHighClouds3_observationslipform"  id="HeightOfHighClouds3_observationslipform" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->HeightOfHighClouds3;?>" style = "width:70px;">
						</td>
						<td>
							 <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLCODEOfHighClouds3_observationslipform"  id="CLCODEOfHighClouds3_observationslipform" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
								 <option value="<?php echo $observationslipformidupdate->CLCODEOfHighClouds3;?>"><?php echo $observationslipformidupdate->CLCODEOfHighClouds3;?> </option>
								<option value="Cl">Cl</option>
								<option value="Cc">Cc</option>
								<option value="Cs">Cs</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<div class="input-group">
								<span class="input-group-addon">Cloud Searchlight Alidade Reading</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="cloudsearchlight" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->CloudSearchLightReading;?>" id="cloudsearchlight"  class="form-control" placeholder="Enter Cloud Searchlight Alidade Reading" >
							</div>
						</td>
						<td colspan="6">
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
							 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="rainfall"  value="<?php echo $observationslipformidupdate->Rainfall;?>" id="rainfall"  class="form-control" placeholder="Enter Rainfall(mm)" >
						</div>
						</td>
					</tr>
				</table>

				</div>


			  <!-- Section 2 -->
			  <div class="tab">

				 <table id="example1" class="table table-bordered table-striped">
					<tr>
						<td >
							<div class="input-group">
							<span class="input-group-addon">Dry Bulb</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="drybulb" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Dry_Bulb;?>" id="drybulb" required class="form-control" required placeholder="Enter Dry Bulb" >
						</div>
						</td>
						<td align = "center"><b>Rainfall & Temperature:</b></td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Wet Bulb</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="wetbulb" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Wet_Bulb;?>" id="wetbulb" required class="form-control" required placeholder="Enter Wet Bulb" >
						</div>
						</td>
					</tr>
					<tr>
						<td><b>MAX</b></td> <td><b>MIN</b></td> <td><b>PICHE</b></td>

					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">MAX Read</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="maxRead"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Max_Read;?>" id="maxRead"  class="form-control"  placeholder="Enter MAX READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">MAX Reset</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="maxReset" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->Max_Reset;?>"id="maxReset"  class="form-control"  placeholder="Enter MAX RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">MIN Read</span>
								                        <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="minRead" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Min_Read;?>" id="minRead"  class="form-control"  placeholder="Enter MIN READ" >
							</div><br>

							<div class="input-group">
								<span class="input-group-addon">MIN Reset</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="minReset" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Min_Reset;?>" id="minReset"  class="form-control"  placeholder="Enter MIN RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">PICHE Read</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="picheRead" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->Piche_Read;?>" id="picheRead"  class="form-control" placeholder="Enter PICHE READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">PICHE Reset</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="picheReset" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Piche_Reset;?>" id="picheReset"  class="form-control" placeholder="Enter PICHE RESET" >
							</div>
						</td>
					</tr>

					<tr>
						<td colspan = "3"><center><b>Time marks</b></center></td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">THERMO</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="timemarksThermo" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TimeMarksThermo;?>" id="timemarksThermo"  class="form-control" placeholder="Enter TIME MARKS THERMO" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">HYGRO</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="timemarksHygro" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksHygro;?>" id="timemarksHygro"  class="form-control" placeholder="Enter TIME MARKS HYGRO" >
						</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">RAIN REC</span>
							 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="timemarksRainRec" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksRainRec;?>" id="timemarksRainRec"  class="form-control" placeholder="Enter TIME MARKS RAIN REC" >
						</div>
						</td>
					</tr>

				</table>
			  </div>



			  <!-- Section 3 -->
			  <div class="tab">
					<table id="example1" class="table table-bordered table-striped">
					<tr>

            <td>
							<div class="input-group">
								<span class="input-group-addon">PRESENT WEATHER CODE</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="presentweatherCode" value="<?php echo $observationslipformidupdate->Present_WeatherCode;?>"  onkeyup="allowIntegerInputOnly(this)" class="form-control" >

							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">PRESENT WEATHER</span>
							<select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="presentweather_observationslipform" id="presentweather_observationslipform"   class="form-control" placeholder="Enter PRESENT WEATHER" >
								<option value="<?php echo $observationslipformidupdate->Present_Weather;?>"><?php echo $observationslipformidupdate->Present_Weather;?> </option>
								<option value="FG">FG</option>  <!--FOG -->
								<option value="HZ">HZ</option>  <!--HAZE -->
								<option value="TS">TS</option>  <!--THUNDERSTORM -->
								<option value="LL">LL</option>  <!--LIGHTENING -->
								<option value="BR">BR</option>  <!--MIST -->
								<option value="GR">GR</option>  <!--HAIL -->
								<option value="DZ">DZ</option>  <!--DRIZZLE -->
								<option value="RA">RA</option>  <!--RAINFALL -->
							</select>
							</div>
						</td>
					</tr>

					<tr>

            <td>
              <div class="input-group">
               <span class="input-group-addon">Past Weather</span>
               <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="pastweather_observationslipform"  value="<?php echo $observationslipformidupdate->Past_Weather;?>"  id="pastweather_observationslipform"   class="form-control" placeholder=" Enter Past Weather " >
             </div>
						</td>
						<td>

						</td>
					</tr>

					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">VISIBILITY</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="visibility" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Visibility;?>" id="visibility" required class="form-control" required placeholder="Enter VISIBILITY" >
						</div>
						</td>
						<td>
						 <div class="input-group">
							<span class="input-group-addon">GUSTING(KTS)</span>
							<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="gusting" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Gusting;?>" id="gusting"  class="form-control" placeholder="Enter GUSTING (KTS)" >
						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" align = "center"><b>wind</b></td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND DIRECTION</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="winddirection"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Wind_Direction;?>" id="winddirection" required class="form-control" required placeholder="Enter WIND DIRECTION" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND SPEED(KTS)</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="windspeed"  value="<?php echo $observationslipformidupdate->Wind_Speed;?>" id="windspeed" required class="form-control" required placeholder="Enter WIND SPEED(KTS)" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">SUN DURATION</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="DurationOfSunshine" id="DurationOfSunshine"  value="<?php echo $observationslipformidupdate->sunduration;?>"   class="form-control"  >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">WIND RUN</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="windRun"   id="windRun" value="<?php echo $observationslipformidupdate->windrun;?>"  class="form-control"  placeholder=" Enter wind run" >
							</div>
						</td>
					</tr>

					</table>
			  </div>


			  <!-- Section 4 -->
			  <div class = "tab">
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Attd.Thermo.(C)</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="attdThermo" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->AttdThermo;?>" id="attdThermo"  class="form-control" placeholder="Enter ATTD.THERMO." >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">Pr.As Read(C)</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="prAsRead" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->PrAsRead;?>" id="prAsRead"  class="form-control" placeholder="Enter Pr.As Read" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Correction</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="correction" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Correction;?>" id="correction"  class="form-control" placeholder="Enter Correction" >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">C.L.P(mb)</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CLP" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->CLP;?>"   class="form-control" placeholder="Enter C.L.P(mb)" >
							</div>
						</td>
					</tr>

					<tr>
						<td  align="center">
							<div class="input-group">
								<span class="input-group-addon">M.S.L.Pr(mb) or 850mb. Ht.(gpm)</span>
								 <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="MSLPR" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->MSLPr;?>" id="MSLPR"  class="form-control" placeholder="Enter M.S.L.Pr(mb) or 850mb. Ht.(gpm)" >
							</div>
						</td>
						<td>
							<div class="input-group">
                        <span class="input-group-addon">Approved</span>
                        <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="approval" id="approval"  required class="form-control">
                            <option value="<?php echo $observationslipformidupdate->Approved;?>"><?php echo $observationslipformidupdate->Approved;?></option>
                            <option value="1">TRUE</option>
                            <option value="0">FALSE</option>
                        </select>
                    </div>
						</td>
					</tr>

					<tr>
						<td colspan="2" align = "center">Time marks</td>
					</tr>

					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME MARKS BAROGRAPH</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="timeMarksBarograph" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TimeMarksBarograph;?>" id="timeMarksBarograph"  class="form-control" placeholder="Enter TIME MARKS BAROGRAPH" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME MARKS ANEMOGRAPH</span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="timeMarksAnemograph" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksAnemograph;?>" id="timeMarksAnemograph"  class="form-control" placeholder="Enter TIME MARKS ANEMOGRAPH" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Other T/MARKS </span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="otherTMarks" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->OtherTMarks;?>"  class="form-control" placeholder="Enter Other T/MARKS" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Remarks or any other Observations </span>
								<input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="remarks" onkeyup="allowCharactersInputOnly(this)"  value="<?php echo $observationslipformidupdate->Remarks;?>" id="remarks"  class="form-control" placeholder="Enter Remarks or any other Observations" >
							</div>
						</td>
					</tr>
				</table>
			  </div>



        <!-- Section 5 -->
      <div class = "tab">
        <table id="example1" class="table table-bordered table-striped">
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Unit of Wind Speed</span>
                <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="UnitOfWindSpeed_mff" id="UnitOfWindSpeed_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Unit of Wind Speed" >
                  <option value="<?php echo $observationslipformidupdate->UnitOfWindSpeed;?>"><?php echo $observationslipformidupdate->UnitOfWindSpeed;?></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>



                </select>
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Ind. or omission of precipitation</span>
                <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="IndOrOmissionOfPrecipitation_mff" id="IndOrOmissionOfPrecipitation_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Ind. or omission of precipitation " >
                  <option value="<?php echo $observationslipformidupdate->IndOrOmissionOfPrecipitation;?>"><?php echo $observationslipformidupdate->IndOrOmissionOfPrecipitation;?></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>

                </select>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Type of station/present & past weather</span>
                <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="TypeOfStation_Present_Past_Weather_mff" id="TypeOfStation_Present_Past_Weather_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Type of station/present & past weather" >
                  <option value="<?php echo $observationslipformidupdate->TypeOfStation_Present_Past_Weather;?>"><?php echo $observationslipformidupdate->TypeOfStation_Present_Past_Weather;?></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>

                </select>
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Height Of Lowest Cloud</span>
                <select <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="heightOfLowestCloud_mff" id="heightOfLowestCloud_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Height Of The Lowest Cloud" >
                  <option value="<?php echo $observationslipformidupdate->HeightOfLowestCloud;?>"><?php echo $observationslipformidupdate->HeightOfLowestCloud;?></option>

                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>

                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Standard isobaric surface</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="StandardIsobaricSurface_mff"  value="<?php echo $observationslipformidupdate->StandardIsobaricSurface;?>" id="StandardIsobaricSurface_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter the Standard isobaric surface" >
              </div>
            </td>
            <td>

              <div class="input-group">
                <span class="input-group-addon">Geopotential Of Standard Isobaric Surface</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="gpm_mff" id="gpm_mff"  value="<?php echo $observationslipformidupdate->GPM;?>" class="form-control"  placeholder="Enter the Geopotential Of Standard Isobaric Surface" >
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Duration Of Period Of Precipitation</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="dopop_mff" id="dopop_mff"   value="<?php echo $observationslipformidupdate->DurationOfPeriodOfPrecipitation;?>" class="form-control" placeholder="Enter the Duration Of Period Of Precipitation" >
              </div>
            </td>
            <td>

            </td>
          </tr>
        </table>
      </div>

      <!-- Section 6 -->

      <div class = "tab">
        <table id="example1" class="table table-bordered table-striped">
          <tr>
            <td>
              <div class="input-group">
              <span class="input-group-addon">Grass Mininum temperature</span>
              <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="gmt_mff" id="gmt_mff" value="<?php echo $observationslipformidupdate->GrassMinTemp;?>"  class="form-control" placeholder=" Enter Grass Mininum temperature " >
            </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Character and Intensity of Precipitation</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="CI_OfPrecipitation_mff" id="CI_OfPrecipitation_mff"  value="<?php echo $observationslipformidupdate->CI_OfPrecipitation;?>"  class="form-control"  placeholder=" Enter Character and Intensity of Precipitation" >
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Beginning or End of Precipitation</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="BE_OfPrecipitation_mff" value="<?php echo $observationslipformidupdate->BE_OfPrecipitation;?>" id="BE_OfPrecipitation_mff"    class="form-control"    placeholder="Enter Beginning or End of Precipitation" >
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Indicator of type of intrumentation</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="IndicatorOfTypeOfIntrumentation_mff" value="<?php echo $observationslipformidupdate->IndicatorOfTypeOfIntrumentation;?>"id="IndicatorOfTypeOfIntrumentation_mff"    class="form-control"    placeholder="Enter the Indicator of type of intrumentation" >
              </div>
            </td>
          </tr>
          <tr>
              <td>
               <div class="input-group">
                <span class="input-group-addon">Sign of Pressure Change</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="SignOfPressureChange_mff" value="<?php echo $observationslipformidupdate->SignOfPressureChange;?>" id="SignOfPressureChange_mff"    class="form-control"    placeholder="Enter the Sign of Pressure Change" >
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Supplementary Information</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="supplementaryinformation_mff" value="<?php echo $observationslipformidupdate->Supp_Info;?>" id="supplementaryinformation_mff" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Supplementary Information" >
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <span class="input-group-addon">Vapour Pressure</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="VapourPressure_mff"value="<?php echo $observationslipformidupdate->VapourPressure;?>"  id="VapourPressure_mff" onkeyup="allowIntegerInputOnly(this)"  class="form-control"   placeholder="Enter the Vapour Pressure" >
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">TH GRAPH</span>
                <input type="text" <?php if($userrole=="WeatherForecaster") echo "disabled"; ?> name="thgraph_mff" value="<?php echo $observationslipformidupdate->T_H_Graph;?>"  id="thgraph_mff"   class="form-control"  placeholder=" Enter TH GRAPH" >
              </div>
            </td>
          </tr>
          <tr>
            <td colspan = "1">
              <span class="input-group-addon">TREND</span>
              <textarea <?php if($userrole=="WeatherForecaster") echo ""; else echo "disabled"; ?> name="Trend_mff" value="<?php echo $observationslipformidupdate->trend;?>"  class="form-control" style="height:40px;" id="Trend_mff" onkeyup=""></textarea>
            </td>
          </tr>
        </table>
      </div>


  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="postObservationSlipFormData_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <?php if(($userrole=="OC") || ($userrole=="Observer" || $userrole=="ObserverDataEntrant") ){  ?>

            <div class="col-xs-3"><a class="btn btn-primary no-print"
                href="<?php echo base_url(); ?>index.php/ObservationSlipForm/DisplayNewObservationSlipForm/">
                    <i class="fa fa-plus"></i> Add new Observation</a>
            </div>

        <?php } ?>
        <br><br>
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
                              <th>Submittion Time</th>
                              <th>Date</th>
                              <th>Station</th>
                              <th>TIME</th>
                              <th>Amount of all Clouds</th>
                              <th>Amount of low Clouds</th>
                              <th>Type Of Low Clouds1</th>
                              <th>Oktas Of Low Clouds1</th>
                              <th>Height Of Low Clouds1</th>
                              <th>CLCODE Of Low Clouds1</th>
                              <th>Type Of Low Clouds2</th>
                              <th>Oktas Of Low Clouds2</th>
                              <th>Height Of Low Clouds2</th>
                              <th>CLCODE Of Low Clouds2</th>
                              <th>CLCODE Of Low Clouds3</th>
                              <th>Type Of Medium Clouds1</th>
                              <th>Oktas Of Medium Clouds1</th>
                              <th>Height Of Medium Clouds1</th>
                              <th>CLCODE Of Medium Clouds1</th>
                              <th>Oktas Of Medium Clouds2</th>
                              <th>Height Of Medium Clouds2</th>
                              <th>CLCODE Of Medium Clouds2</th>
                              <th>Type Of Medium Clouds3</th>
                              <th>Oktas Of Medium Clouds3</th>
                              <th>Height Of Medium Clouds3</th>
                              <th>CLCODE Of Medium Clouds3</th>
                              <th>Oktas Of High Clouds1</th>
                              <th>Height Of High Clouds1</th>
                              <th>CLCODE Of High Clouds1</th>
                              <th>Type Of High Clouds2</th>
                              <th>Oktas Of High Clouds2</th>
                              <th>Height Of High Clouds2</th>
                              <th>CLCODE Of High Clouds2</th>
                              <th>Type Of High Clouds3</th>
                              <th>Oktas Of High Clouds3</th>
                              <th>Height Of High Clouds3</th>
                              <th>CLCODE Of High Clouds3</th>
                              <th>Cloud Search LightReading</th>

                              <th>Rainfall (mm)</th>
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
                              <th>Present Weather</th>
                              <th>Present Weather Code</th>
                              <th>Past Weather</th>
                              <th>Visibility</th>
                              <th>Wind Direction</th>
                              <th>Wind Speed</th>

                              <th>Gusting</th>
                              <th>AttdThermo</th>
                              <th>PrAsRead</th>
                              <th>Correction</th>
                              <th>CLP</th>
                              <th>MSLPr</th>
                              <th>Time Marks Barograph</th>
                              <th>Time Marks Anemograph</th>
                              <th>Other TMarks</th>
                              <th>Soil Moisture</th>
                              <th>Soil Temperature</th>
                              <th>sun duration</th>
                              <th>trend</th>
                              <th>windrun</th>
                              <th>specitime</th>
                              <th>UnitOfWindSpeed</th>
                              <th>IndOrOmissionOfPrecipitation</th>
                              <th>TypeOfStation_Present_Past_Weather</th>
                              <th>HeightOfLowestCloud</th>
                              <th>StandardIsobaricSurface</th>
                              <th>GPM</th>
                              <th>DurationOfPeriodOfPrecipitation</th>
                              <th>GrassMinTemp</th>
                              <th>CI_OfPrecipitation</th>
                              <th>BE_OfPrecipitation</th>
                              <th>IndicatorOfTypeOfIntrumentation</th>
                              <th>SignOfPressureChange</th>
                              <th>Supp_Info</th>
                              <th>VapourPressure</th>
                              <th>T_H_Graph</th>
                              <th>DeviceType</th>
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
                            if(is_array($observationslipformdata) && count($observationslipformdata)) {
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
                                      <td ><?php echo $observationslipdata->TotalAmountOfAllClouds;?></td>
                                      <td ><?php echo $observationslipdata->TotalAmountOfLowClouds;?></td>
                                      <th><?php echo $observationslipdata->TypeOfLowClouds1;?></th>
                                      <th><?php echo $observationslipdata->OktasOfLowClouds1;?></th>
                                      <th><?php echo $observationslipdata->HeightOfLowClouds1;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfLowClouds1;?></th>
                                      <th><?php echo $observationslipdata->TypeOfLowClouds2;?></th>
                                      <th><?php echo $observationslipdata->OktasOfLowClouds2;?></th>
                                      <th><?php echo $observationslipdata->HeightOfLowClouds2;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfLowClouds2;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfLowClouds3;?></th>
                                      <th><?php echo $observationslipdata->TypeOfMediumClouds1;?></th>
                                      <th><?php echo $observationslipdata->OktasOfMediumClouds1;?></th>
                                      <th><?php echo $observationslipdata->HeightOfMediumClouds1;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfMediumClouds1;?></th>
                                      <th><?php echo $observationslipdata->OktasOfMediumClouds2;?></th>
                                      <th><?php echo $observationslipdata->HeightOfMediumClouds2;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfMediumClouds2;?></th>
                                      <th><?php echo $observationslipdata->TypeOfMediumClouds3;?></th>
                                      <th><?php echo $observationslipdata->OktasOfMediumClouds3;?></th>
                                      <th><?php echo $observationslipdata->HeightOfMediumClouds3;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfMediumClouds3;?></th>
                                      <th><?php echo $observationslipdata->OktasOfHighClouds1;?></th>
                                      <th><?php echo $observationslipdata->HeightOfHighClouds1;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfHighClouds1;?></th>
                                      <th><?php echo $observationslipdata->TypeOfHighClouds2;?></th>
                                      <th><?php echo $observationslipdata->OktasOfHighClouds2;?></th>
                                      <th><?php echo $observationslipdata->HeightOfHighClouds2;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfHighClouds2;?></th>
                                      <th><?php echo $observationslipdata->TypeOfHighClouds3;?></th>
                                      <th><?php echo $observationslipdata->OktasOfHighClouds3;?></th>
                                      <th><?php echo $observationslipdata->HeightOfHighClouds3;?></th>
                                      <th><?php echo $observationslipdata->CLCODEOfHighClouds3;?></th>
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
                                      <th><?php echo $observationslipdata->Present_Weather;?></th>
                                      <th><?php echo $observationslipdata->Present_WeatherCode;?></th>
                                      <th><?php echo $observationslipdata->Past_Weather;?></th>
                                      <td ><?php echo $observationslipdata->Visibility;?></td>
                                      <td ><?php echo $observationslipdata->Wind_Direction;?></td>
                                      <td><?php echo $observationslipdata->Wind_Speed;?></td>
                                      <th><?php echo $observationslipdata->Gusting;?></th>
                                      <th><?php echo $observationslipdata->AttdThermo;?></th>
                                      <th><?php echo $observationslipdata->PrAsRead;?></th>
                                      <th><?php echo $observationslipdata->Correction;?></th>
                                      <th><?php echo $observationslipdata->CLP;?></th>
                                      <th><?php echo $observationslipdata->MSLPr;?></th>
                                      <th><?php echo $observationslipdata->TimeMarksBarograph;?></th>
                                      <th><?php echo $observationslipdata->TimeMarksAnemograph;?></th>
                                      <th><?php echo $observationslipdata->OtherTMarks;?></th>
                                      <th><?php echo $observationslipdata->SoilMoisture;?></th>
                                      <th><?php echo $observationslipdata->SoilTemperature;?></th>
                                      <th><?php echo $observationslipdata->sunduration;?></th>
                                      <th><?php echo $observationslipdata->trend;?></th>
                                      <th><?php echo $observationslipdata->windrun;?></th>
                                      <th><?php echo $observationslipdata->specitime;?></th>
                                      <th><?php echo $observationslipdata->UnitOfWindSpeed;?></th>
                                      <th><?php echo $observationslipdata->IndOrOmissionOfPrecipitation;?></th>
                                      <th><?php echo $observationslipdata->TypeOfStation_Present_Past_Weather;?></th>
                                      <th><?php echo $observationslipdata->HeightOfLowestCloud;?></th>
                                      <th><?php echo $observationslipdata->StandardIsobaricSurface;?></th>
                                      <th><?php echo $observationslipdata->GPM;?></th>
                                      <th><?php echo $observationslipdata->DurationOfPeriodOfPrecipitation;?></th>
                                      <th><?php echo $observationslipdata->GrassMinTemp;?></th>
                                      <th><?php echo $observationslipdata->CI_OfPrecipitation;?></th>
                                      <th><?php echo $observationslipdata->BE_OfPrecipitation;?></th>
                                      <th><?php echo $observationslipdata->IndicatorOfTypeOfIntrumentation;?></th>
                                      <th><?php echo $observationslipdata->SignOfPressureChange;?></th>
                                      <th><?php echo $observationslipdata->Supp_Info;?></th>
                                      <th><?php echo $observationslipdata->VapourPressure;?></th>
                                      <th><?php echo $observationslipdata->T_H_Graph;?></th>
                                      <th><?php echo $observationslipdata->DeviceType;?></th>
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
                        <div id="pagination">
                        <ul class="tsc_pagination">
                        <!-- Show pagination links -->
                        <?php

                         foreach ($links as $link){
                           echo "<li>". $link."</li>";
                        }
                         ?>
                        </div>
                        </div>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print</button>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    <?php
    }//end of else
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
