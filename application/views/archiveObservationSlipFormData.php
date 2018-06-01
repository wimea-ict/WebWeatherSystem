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
            Archive Observation Slip Form
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Observation Slip Form</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewarchiveobervationslipform) && count($displaynewarchiveobervationslipform)) {
        ?>
        <div class="row">
        <form action='<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/insertArchiveObservationSlipFormData/' id ="regForm" method="post" enctype="multipart/form-data">
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

		<!-- Section 1 -->
			  <div class="tab"><h4>Station & CLouds Info:</h4>
			   <table id="example1" class="table table-bordered table-striped">
			   		<tr>
               <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
								<select name="station_archiveobservationslipformdata" id="stationManager"   class="form-control" placeholder="Select Station">
                      <option value="">Select Stations</option>
                      <?php
                      if (is_array($stationsdata) && count($stationsdata)) {
                          foreach($stationsdata as $station){?>
                              <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                          <?php }
                      } ?>
                  </select>
								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo_archiveobservationslipformdata"  class="form-control" id="stationNoManager" readonly class="form-control" value="" readonly="readonly" >
							</div>

						</td>
          <?php } else{ ?>
            <td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									<input type="text" name="station_archiveobservationslipformdata" id="station_archiveobservationslipformdata"  class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo_archiveobservationslipformdata"  class="form-control" id="stationNo_archiveobservationslipformdata" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
							</div>

						</td>
          <?php } ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date_archiveobservationslipformdata"  class="form-control compulsory" placeholder="Enter select date" id="date">
								</div>

						</td>
					</tr>
					<tr>
						<td colspan = "4">
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								<select name="time_archiveobservationslipformdata" id="time_archiveobservationslipformdata"  class="form-control compulsory">
									<option value=""></option>
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
						</td>
						<td colspan="4">

								<div class="input-group">
									<span class="input-group-addon">Total amount of all clouds</span>
									 <select name="totalamountofallclouds_archiveobservationslipformdata"  id="totalamountofallclouds_archiveobservationslipformdata"  onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder=" Enter total amount of all clouds" >
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
						<td colspan="4">


								<div class="input-group">
									<span class="input-group-addon">Total amount of low clouds</span>
									 <select name="totalamountoflowclouds_archiveobservationslipformdata" id="totalamountoflowclouds_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control "  placeholder="Enter total amount of low clouds" >
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
						<select  name="TypeOfLowClouds1_archiveobservationslipformdata"  id="TypeOfLowClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
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
							 <select name="OktasOfLowClouds1_archiveobservationslipformdata" id="OktasOfLowClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS  for LOW CLOUD" >
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
							<input type="text" name="HeightOfLowClouds1_archiveobservationslipformdata"  id="HeightLowClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = 'width:70px;'>
						</td>

						<td>
							 <select  name="CLCODEOfLowClouds1_archiveobservationslipformdata"  id="CLCODEOfLowClouds1_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of  LOW CLOUD " >
							<option value=""></option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>

						<td>
							<select name="TypeOfMediumClouds1_archiveobservationslipformdata"  id="TypeOfMediumClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
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
							 <select name="OktasOfMediumClouds1_archiveobservationslipformdata" id="OktasOfMediumClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS  OF MEDIUM CLOUD" >
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
							 <input type="text" name="HeightOfMediumClouds1_archiveobservationslipformdata"  id="HeightOfMediumClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">
						</td>

						<td>
							<select name="CLCODEOfMediumClouds1_archiveobservationslipformdata"  id="CLCODEOfMediumClouds1_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
							<option value=""> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							 <select name="TypeOfHighClouds1_archiveobservationslipformdata"  id="TypeOfHighClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF HIGH CLOUD" >
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
							<select name="OktasOfHighClouds1_archiveobservationslipformdata" id="OktasOfHighClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF HIGH CLOUD" >
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
							<input type="text" name="HeightOfHighClouds1_archiveobservationslipformdata"  id="HeightOfHighClouds1_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfHighClouds1_archiveobservationslipformdata"  id="CLCODEOfHighClouds1_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE OF MEDIUM CLOUD " >
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
							 <select  name="TypeOfLowClouds2_archiveobservationslipformdata"  id="TypeOfLowClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW CLOUD" >
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
							 <select name="OktasOfLowClouds2_archiveobservationslipformdata" id="OktasOfLowClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS OF LOW CLOUD" >
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
							 <input type="text" name="HeightOfLowClouds2_archiveobservationslipformdata"  id="HeightOfLowClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">
						</td>
						<td>
							 <select  name="CLCODEOfLowClouds2_archiveobservationslipformdata"  id="CLCODEOfLowClouds2_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of LOW CLOUD " >
							<option value=""> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>
						</select>
						</td>
						<td>
							  <select name="TypeOfMediumClouds2_archiveobservationslipformdata"  id="TypeOfMediumClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
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
							<select name="OktasOfMediumClouds2_archiveobservationslipformdata" id="OktasOfMediumClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF MEDIUM CLOUD" >
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
							 <input type="text" name="HeightOfMediumClouds2_archiveobservationslipformdata"  id="HeightOfMediumClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width: 70px">
						</td>
						<td>
							 <select name="CLCODEOfMediumClouds2_archiveobservationslipformdata"  id="CLCODEOfMediumClouds2_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							<option value=""> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							  <select name="TypeOfHighClouds2_archiveobservationslipformdata"  id="TypeOfHighClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF HIGH CLOUD" >
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
							 <select name="OktasOfHighClouds2_archiveobservationslipformdata" id="OktasOfHighClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF HIGH CLOUD" >
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
							<input type="text" name="HeightOfHighClouds2_archiveobservationslipformdata"  id="HeightOfHighClouds2_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfHighClouds2_archiveobservationslipformdata"  id="CLCODEOfHighClouds2_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
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
							 <select  name="TypeOfLowClouds3_archiveobservationslipformdata"  id="TypeOfLowClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of low Cloud" >
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
							 <select name="OktasOfLowClouds3_archiveobservationslipformdata" id="OktasOfLowClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
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
							 <input type="text" name="HeightOfLowClouds3_archiveobservationslipformdata"  id="HeightLowClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width: 70px;">
						</td>

						<td>
							 <select  name="CLCODEOfLowClouds3_archiveobservationslipformdata"  id="CLCODEOfLowClouds3_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE of LOW CLOUD " >
							<option value=""> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>
						<td>
							<select name="TypeOfMediumClouds3_archiveobservationslipformdata"  id="TypeOfMediumClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE OF MEDIUM CLOUD" >
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
							<select name="OktasOfMediumClouds3_archiveobservationslipformdata" id="OktasOfMediumClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS OF MEDIUM CLOUD" >
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
							<input type="text" name="HeightOfMediumClouds3_archiveobservationslipformdata"  id="HeightOfMediumClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfMediumClouds3_archiveobservationslipformdata"  id="CLCODEOfMediumClouds3_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							   <option value=""> </option>
								<option value="Ac">Ac</option>
								<option value="As">As</option>
								<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							 <select name="TypeOfHighClouds3_archiveobservationslipformdata"  id="TypeOfHighClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter TYPE HIGH CLOUD" >
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
							  <select name="OktasOfHighClouds3_archiveobservationslipformdata" id="OktasOfHighClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter OKTAS HIGH CLOUD" >
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
							 <input type="text" name="HeightOfHighClouds3_archiveobservationslipformdata"  id="HeightOfHighClouds3_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="0" style = "width:70px;">
						</td>
						<td>
							 <select name="CLCODEOfHighClouds3_archiveobservationslipformdata"  id="CLCODEOfHighClouds3_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE MEDIUM CLOUD " >
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
								<input type="text" name="cloudsearchlight_archiveobservationslipformdata" id="cloudsearchlight_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Cloud Searchlight Alidade Reading" >
							</div>
						</td>
						<td colspan="6">
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
							<input type="text" name="rainfall_archiveobservationslipformdata" id="rainfall_archiveobservationslipformdata"   class="form-control" placeholder="Enter Rainfall(mm)" >
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
							<input type="text" name="drybulb_archiveobservationslipformdata" id="drybulb_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Dry Bulb" >
						</div>
						</td>
						<td align = "center"><b>Rainfall & Temperature:</b></td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Wet Bulb</span>
							<input type="text" name="wetbulb_archiveobservationslipformdata" id="wetbulb_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Wet Bulb" >
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
							 <input type="text" name="maxRead_archiveobservationslipformdata"  id="maxRead_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MAX READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">MAX Reset</span>
								<input type="text" name="maxReset_archiveobservationslipformdata" id="maxReset_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MAX RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">MIN Read</span>
								 <input type="text" name="minRead_archiveobservationslipformdata"  id="minRead_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MIN READ" >
							</div><br>

							<div class="input-group">
								<span class="input-group-addon">MIN Reset</span>
								 <input type="text" name="minReset_archiveobservationslipformdata" id="minReset_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter MIN RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">PICHE Read</span>
								<input type="text" name="picheRead_archiveobservationslipformdata"  id="picheRead_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter PICHE READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">PICHE Reset</span>
								<input type="text" name="picheReset_archiveobservationslipformdata" id="picheReset_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter PICHE RESET" >
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
							 <input type="text" name="timemarksThermo_archiveobservationslipformdata"  id="timemarksThermo_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS THERMO" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">HYGRO</span>
							<input type="text" name="timemarksHygro_archiveobservationslipformdata" id="timemarksHygro_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS HYGRO" >
						</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">RAIN REC</span>
							<input type="text" name="timemarksRainRec_archiveobservationslipformdata" id="timemarksRainRec_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS RAIN REC" >
						</div>
						</td>
					</tr>

				</table>
			  </div>



			  <!-- Section 3 -->
			  <div class="tab">
          <b>Weather Info:</b>
					<table id="example1" class="table table-bordered table-striped">
					<tr>
            <td>
             <div class="input-group">
                    <span class="input-group-addon">PRESENT WEATHER</span>
                    <input type="text" name="presentweather_archiveobservationslipformdata" id="presentweather_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter PRESENT WEATHER" >

                </div>
            </td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">M.S.L.Pr(mb) or 850mb. Ht.(gpm)</span>
								<input type="text" name="MSLPR_archiveobservationslipformdata" id="MSLPR_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter M.S.L.Pr(mb) or 850mb. Ht.(gpm)" >
							</div>

						</td>
					</tr>



					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">VISIBILITY</span>
							<input type="text" name="visibility_archiveobservationslipformdata" id="visibility_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter VISIBILITY" >
						</div>
						</td>
						<td>
						 <div class="input-group">
							<span class="input-group-addon">GUSTING(KTS)</span>
							 <input type="text" name="gusting_archiveobservationslipformdata" id="gusting_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter GUSTING (KTS)" >
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
								 <input type="text" name="winddirection_archiveobservationslipformdata" id="winddirection_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter WIND DIRECTION" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND SPEED(KTS)</span>
								<input type="text" name="windspeed_archiveobservationslipformdata" id="windspeed_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter WIND SPEED(KTS)" >
							</div>
						</td>
					</tr>


					</table>
			  </div>


			  <!-- Section 4 -->
			  <div class = "tab"><h2>More Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Attd.Thermo.(C)</span>
								 <input type="text" name="attdThermo_archiveobservationslipformdata" id="attdThermo_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter ATTD.THERMO." >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">Pr.As Read(C)</span>
								<input type="text" name="prAsRead_archiveobservationslipformdata" id="prAsRead_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Pr.As Read" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Correction</span>
								<input type="text" name="correction_archiveobservationslipformdata" id="correction_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Correction" >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">C.L.P(mb)</span>
								<input type="text" name="CLP_archiveobservationslipformdata" id="CLP_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter C.L.P(mb)" >
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
								 <input type="text" name="timeMarksBarograph_archiveobservationslipformdata" id="timeMarksBarograph_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS BAROGRAPH" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME MARKS ANEMOGRAPH</span>
								 <input type="text" name="timeMarksAnemograph_archiveobservationslipformdata" id="timeMarksAnemograph_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter TIME MARKS ANEMOGRAPH" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Other T/MARKS </span>
								<input type="text" name="otherTMarks_archiveobservationslipformdata" id="otherTMarks_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter Other T/MARKS" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Remarks or any other Observations </span>
								 <input type="text" name="remarks_archiveobservationslipformdata" id="remarks_archiveobservationslipformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder="Enter Remarks or any other Observations" >
							</div>
						</td>
					</tr>
				</table>
			  </div>

        <div class="clearfix"></div>
        </div>
	<div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="postarchiveobservationslipformdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
        </form>
        </div>
    <?php
    }elseif((is_array($archivedobservationslipformdataidupdate) && count($archivedobservationslipformdataidupdate))) {
        foreach($archivedobservationslipformdataidupdate as $observationslipformidupdate){

            $observationslipformid = $obervationslipformidupdate->id;
            ?>
            <div class="row">
            <form action='<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/UpdateArchiveObservationSlipFormData' id="regForm" method="post" enctype="multipart/form-data">
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

			<!-- Section 1 -->
			  <div class="tab"><h4>Station & CLouds Info:</h4>
			   <table id="example1" class="table table-bordered table-striped">
			   		<tr>
              <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
           <td colspan = "4">

               <div class="input-group">
                 <span class="input-group-addon">Station Name</span>
               <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                     <option value="<?php echo $observationslipformidupdate->StationName;?>"><?php echo $observationslipformidupdate->StationName;?></option>
                     <?php
                     if (is_array($stationsdata) && count($stationsdata)) {
                         foreach($stationsdata as $station){?>
                             <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                         <?php }
                     } ?>
                 </select>
               </div>

           </td>
           <td colspan = "4">

             <div class="input-group">
               <span class="input-group-addon"> Station Number</span>
                <input type="text" name="stationNo_archiveobservationslipformdata"  class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $observationslipformidupdate->StationNumber;?>" readonly="readonly" >
             </div>

           </td>
         <?php } else{ ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									<input type="text" name="station" id="station"  class="form-control" value="<?php echo $observationslipformidupdate->StationName;?>"  readonly class="form-control" >

								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo_archiveobservationslipformdata"  class="form-control" id="stationNo_archiveobservationslipformdata" readonly class="form-control" value="<?php echo $observationslipformidupdate->StationNumber;?>" readonly="readonly" >
							</div>

						</td>
          <?php } ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date" class="form-control" value="<?php echo $observationslipformidupdate->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
									<input type="hidden" name="id" value="<?php echo $observationslipformidupdate->id;?>">
								</div>

						</td>
					</tr>
					<tr>
						<td colspan = "4">
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								 <input type="text" name="timeRecorded"  class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $observationslipformidupdate->TIME;?>" readonly="readonly" >
							</div>
						</td>
						<td colspan="4">

								<div class="input-group">
									<span class="input-group-addon">Total amount of all clouds</span>
									 <select name="totalamountofallclouds" onkeyup="allowIntegerInputOnly(this)"   id="totalamountofallclouds"  class="form-control"  placeholder=" Enter total amount of all clouds" >
										<option value="<?php echo $observationslipformidupdate->TotalAmountOfAllClouds;?>"><?php echo $observationslipformidupdate->TotalAmountOfAllClouds;?> </option>
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
						<td colspan="4">


								<div class="input-group">
									<span class="input-group-addon">Total amount of low clouds</span>
									  <select name="totalamountoflowclouds" onkeyup="allowIntegerInputOnly(this)"  id="totalamountoflowclouds"  class="form-control"  placeholder="Enter total amount of all clouds" >
										<option value="<?php echo $observationslipformidupdate->TotalAmountOfLowClouds;?>"><?php echo $observationslipformidupdate->TotalAmountOfLowClouds;?> </option>
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
						 <select  name="TypeOfLowClouds1"  id="TypeOfLowClouds1" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW CLOUD" >
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
							<select name="OktasOfLowClouds1" id="OktasOfLowClouds1" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
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
							<input type="text" name="HeightOfLowClouds1"  id="HeightOfLowClouds1" value="<?php echo $observationslipformidupdate->HeightOfLowClouds1;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = 'width:60px;'>
						</td>

						<td>
							 <select  name="CLCODEOfLowClouds1"  id="CLCODEOfLowClouds1"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF LOW CLOUD " >
                        <option value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds1;?>"><?php echo $observationslipformidupdate->CLCODEOfLowClouds1;?> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>

						<td>
							 <select  name="TypeOfMediumClouds1"  id="TypeOfMediumClouds1" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of Medium Cloud" >
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
							 <select name="OktasOfMediumClouds1" id="OktasOfMediumClouds1" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS MEDIUM CLOUD" >
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
							 <input type="text" name="HeightOfMediumClouds1"  id="HeightOfMediumClouds1" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds1;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control"style = "width:70px;" >
						</td>

						<td>
							 <select  name="CLCODEOfMediumClouds1"  id="CLCODEOfMediumClouds1"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							<option value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds1;?>"><?php echo $observationslipformidupdate->CLCODEOfMediumClouds1;?> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							  <select  name="TypeOfHighClouds1"  id="TypeOfHighClouds1" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of HIGH Cloud" >
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
							<select name="OktasOfHighClouds1" id="OktasOfHighClouds1" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS HIGH CLOUD" >
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
							 <input type="text" name="HeightOfHighClouds1"  id="HeightOfHighClouds1" value="<?php echo $observationslipformidupdate->HeightOfHighClouds1;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width:70px;" >
						</td>
						<td>
							<select  name="CLCODEOfHighClouds1"  id="CLCODEOfHighClouds1"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE HIGH CLOUD " >
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
							 <select  name="TypeOfLowClouds2"  id="TypeOfLowClouds2" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
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
							<select name="OktasOfLowClouds2" id="OktasOfLowClouds2" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
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
							<input type="text" name="HeightOfLowClouds2"  id="HeightOfLowClouds2" value="<?php echo $observationslipformidupdate->HeightOfLowClouds2;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width:60px;" >
						</td>
						<td>
							 <select  name="CLCODEOfLowClouds2"  id="CLCODEOfLowClouds2"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE OF LOW CLOUD " >
                        <option value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds2;?>"><?php echo $observationslipformidupdate->CLCODEOfLowClouds2;?> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>
						</select>
						</td>
						<td>
							 <select  name="TypeOfMediumClouds2"  id="TypeOfMediumClouds2" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of Medium Cloud" >
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
							<select name="OktasOfMediumClouds2" id="OktasOfMediumClouds2" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS MEDIUM CLOUD" >
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
							<input type="text" name="HeightOfMediumClouds2"  id="HeightOfMediumClouds2" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds2;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width: 70px">
						</td>
						<td>
							 <select  name="CLCODEOfMediumClouds2"  id="CLCODEOfMediumClouds2"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
							<option value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds2;?>"><?php echo $observationslipformidupdate->CLCODEOfMediumClouds2;?> </option>
							<option value="Ac">Ac</option>
							<option value="As">As</option>
							<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							   <select  name="TypeOfHighClouds2"  id="TypeOfHighClouds2" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of HIGH Cloud" >
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
							 <select name="OktasOfHighClouds2" id="OktasOfHighClouds2" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS  OF HIGH CLOUD" >
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
							 <input type="text" name="HeightOfHighClouds2"  id="HeightOfHighClouds2" value="<?php echo $observationslipformidupdate->HeightOfHighClouds2;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width:70px;">
						</td>
						<td>
							<select  name="CLCODEOfHighClouds2"  id="CLCODEOfHighClouds2"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF HIGH CLOUD " >
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
							 <select  name="TypeOfLowClouds3"  id="TypeOfLowClouds3" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of LOW Cloud" >
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
							<select name="OktasOfLowClouds3" id="OktasOfLowClouds3" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS of LOW CLOUD" >
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
							<input type="text" name="HeightOfLowClouds3"  id="HeightOfLowClouds3" value="<?php echo $observationslipformidupdate->HeightOfLowClouds3;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width: 60px;">
						</td>

						<td>
							<select  name="CLCODEOfLowClouds3"  id="CLCODEOfLowClouds3"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CLCODE OF LOW CLOUD " >
							<option value="<?php echo $observationslipformidupdate->CLCODEOfLowClouds3;?>"><?php echo $observationslipformidupdate->CLCODEOfLowClouds3;?> </option>
							<option value="Sc">Sc</option>
							<option value="St">St</option>
							<option value="Cu">Cu</option>
							<option value="Cb">Cb</option>

						</select>
						</td>
						<td>
							 <select  name="TypeOfMediumClouds3"  id="TypeOfMediumClouds3" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of Medium Cloud" >
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
							 <select name="OktasOfMediumClouds3" id="OktasOfMediumClouds3" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS MEDIUM CLOUD" >
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
							<input type="text" name="HeightOfMediumClouds3"  id="HeightOfMediumClouds3" value="<?php echo $observationslipformidupdate->HeightOfMediumClouds3;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width:70px;">
						</td>
						<td>
							 <select  name="CLCODEOfMediumClouds3"  id="CLCODEOfMediumClouds3"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF MEDIUM CLOUD " >
								<option value="<?php echo $observationslipformidupdate->CLCODEOfMediumClouds3;?>"><?php echo $observationslipformidupdate->CLCODEOfMediumClouds3;?> </option>
								<option value="Ac">Ac</option>
								<option value="As">As</option>
								<option value="Ns">Ns</option>
							</select>
						</td>
						<td>
							 <select  name="TypeOfHighClouds3"  id="TypeOfHighClouds3" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Type of HIGH Cloud" >
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
							 <select name="OktasOfHighClouds3" id="OktasOfHighClouds3" onkeyup="allowIntegerInputOnly(this)" class="form-control" placeholder="Enter OKTAS OF HIGH  CLOUD" >
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
							<input type="text" name="HeightOfHighClouds3"  id="HeightOfHighClouds3" value="<?php echo $observationslipformidupdate->HeightOfHighClouds3;?>" onkeyup="allowIntegerInputOnly(this)"  class="form-control" style = "width:70px;">
						</td>
						<td>
							 <select  name="CLCODEOfHighClouds3"  id="CLCODEOfHighClouds3"  onkeyup="allowCharactersInputOnly(this)"  class="form-control" placeholder=" Enter CL CODE OF HIGH CLOUD " >
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
								 <input type="text" name="cloudsearchlight" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->CloudSearchLightReading;?>" id="cloudsearchlight"  class="form-control" placeholder="Enter Cloud Searchlight Alidade Reading" >
							</div>
						</td>
						<td colspan="6">
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
							<input type="text" name="rainfall"  value="<?php echo $observationslipformidupdate->Rainfall;?>" id="rainfall"  class="form-control" placeholder="Enter Rainfall(mm)" >
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
							 <input type="text" name="drybulb" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Dry_Bulb;?>" id="drybulb"  class="form-control" placeholder="Enter Dry Bulb" >
						</div>
						</td>
						<td align = "center"><b>Rainfall & Temperature:</b></td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Wet Bulb</span>
							<input type="text" name="wetbulb" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Wet_Bulb;?>" id="wetbulb"  class="form-control" placeholder="Enter Wet Bulb" >
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
							<input type="text" name="maxRead"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Max_Read;?>" id="maxRead"  class="form-control" placeholder="Enter MAX READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">MAX Reset</span>
								 <input type="text" name="maxReset" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->Max_Reset;?>"id="maxReset"  class="form-control" placeholder="Enter MAX RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">MIN Read</span>
								 <input type="text" name="minRead" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Min_Read;?>" id="minRead"  class="form-control" placeholder="Enter MIN READ" >
							</div><br>

							<div class="input-group">
								<span class="input-group-addon">MIN Reset</span>
								 <input type="text" name="minReset" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Min_Reset;?>" id="minReset"  class="form-control" placeholder="Enter MIN RESET" >
							</div>
						</td>

						<td>
							 <div class="input-group">
								<span class="input-group-addon">PICHE Read</span>
								 <input type="text" name="picheRead" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->Piche_Read;?>" id="picheRead"  class="form-control" placeholder="Enter PICHE READ" >
							</div> <br>

							 <div class="input-group">
								<span class="input-group-addon">PICHE Reset</span>
								 <input type="text" name="picheReset" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Piche_Reset;?>" id="picheReset"  class="form-control" placeholder="Enter PICHE RESET" >
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
							 <input type="text" name="timemarksThermo" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TimeMarksThermo;?>" id="timemarksThermo"  class="form-control" placeholder="Enter TIME MARKS THERMO" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">HYGRO</span>
							<input type="text" name="timemarksHygro" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksHygro;?>" id="timemarksHygro"  class="form-control" placeholder="Enter TIME MARKS HYGRO" >
						</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">RAIN REC</span>
							<input type="text" name="timemarksRainRec" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksRainRec;?>" id="timemarksRainRec"  class="form-control" placeholder="Enter TIME MARKS RAIN REC" >
						</div>
						</td>
					</tr>

				</table>
			  </div>



			  <!-- Section 3 -->
			  <div class="tab">
          <b>Weather Info:</b>
					<table id="example1" class="table table-bordered table-striped">
					<tr>
            <td>
             <div class="input-group">
                    <span class="input-group-addon">PRESENT WEATHER</span>
                    <input type="text" name="presentweather" onkeyup="allowCharactersInputOnly(this)"  id="presentweather" value="<?php echo $observationslipformidupdate->Present_Weather;?>"  class="form-control" placeholder="Enter PRESENT WEATHER" >

                </div>
            </td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">M.S.L.Pr(mb) or 850mb. Ht.(gpm)</span>
								<input type="text" name="MSLPR" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->MSLPr;?>" id="MSLPR"  class="form-control" placeholder="Enter M.S.L.Pr(mb) or 850mb. Ht.(gpm)" >
							</div>

						</td>
					</tr>



					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">VISIBILITY</span>
							<input type="text" name="visibility" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Visibility;?>" id="visibility"  class="form-control" placeholder="Enter VISIBILITY" >
						</div>
						</td>
						<td>
						 <div class="input-group">
							<span class="input-group-addon">GUSTING(KTS)</span>
							 <input type="text" name="gusting" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Gusting;?>" id="gusting"  class="form-control" placeholder="Enter GUSTING (KTS)" >
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
								 <input type="text" name="winddirection"  onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Wind_Direction;?>" id="winddirection"  class="form-control"  placeholder="Enter WIND DIRECTION" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND SPEED(KTS)</span>
								 <input type="text" name="windspeed" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->Wind_Speed;?>" id="windspeed"  class="form-control"  placeholder="Enter WIND SPEED(KTS)" >
							</div>
						</td>
					</tr>


					</table>
			  </div>


			  <!-- Section 4 -->
			  <div class = "tab"><h2>More Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Attd.Thermo.(C)</span>
								 <input type="text" name="attdThermo" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->AttdThermo;?>" id="attdThermo"  class="form-control" placeholder="Enter ATTD.THERMO." >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">Pr.As Read(C)</span>
								<input type="text" name="prAsRead" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->PrAsRead;?>" id="prAsRead"  class="form-control" placeholder="Enter Pr.As Read" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Correction</span>
								<input type="text" name="correction" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->Correction;?>" id="correction"  class="form-control" placeholder="Enter Correction" >
							</div> <br>

							<div class="input-group">
								<span class="input-group-addon">C.L.P(mb)</span>
								<input type="text" name="CLP" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->CLP;?>" id="CLP"  class="form-control" placeholder="Enter C.L.P(mb)" >
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
								 <input type="text" name="timeMarksBarograph" onkeyup="allowIntegerInputOnly(this)"  value="<?php echo $observationslipformidupdate->TimeMarksBarograph;?>" id="timeMarksBarograph"  class="form-control" placeholder="Enter TIME MARKS BAROGRAPH" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME MARKS ANEMOGRAPH</span>
								<input type="text" name="timeMarksAnemograph" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $observationslipformidupdate->TimeMarksAnemograph;?>" id="timeMarksAnemograph"  class="form-control" placeholder="Enter TIME MARKS ANEMOGRAPH" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Other T/MARKS </span>
								<input type="text" name="otherTMarks" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $observationslipformidupdate->OtherTMarks;?>" id="otherTMarks"  class="form-control" placeholder="Enter Other T/MARKS" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Remarks or any other Observations </span>
								 <input type="text" name="remarks" onkeyup="allowCharactersInputOnly(this)"  value="<?php echo $observationslipformidupdate->Remarks;?>" id="remarks"  class="form-control" placeholder="Enter Remarks or any other Observations" >
							</div>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<div class="input-group">
								<span class="input-group-addon">Approved</span>
								<select name="approval" id="approval"   class="form-control">
									<option value="<?php echo $observationslipformidupdate->Approved;?>"><?php echo $observationslipformidupdate->Approved;?></option>
									<option value="">--Select Approval Options--</option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
							</div>
						</td>
					</tr>
				</table>
			  </div>




        <div class="clearfix"></div>
        </div>
		 <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="updatearchiveobservationslipformdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
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
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url()."index.php/ArchiveObservationSlipFormData/DisplayNewArchiveObservationSlipForm/";?>"
                    <i class="fa fa-plus"></i> Add Archive Observation Slip</a>



            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Archive Observation Slip Form</h3>
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
                                <th>TIME</th>
                                <th>Dry Bulb</th>
                                <th>Wet Bulb</th>
                                <th>Present Weather</th>
                                <th>Visibility</th>
                                <th>Wind Direction</th>
                                <th>Wind Speed</th>

                                <th>Rainfall (mm)</th>
                                <th>Gusting </th>
                                <th>Max Read</th>
                                <th>Min Read</th>
                                <th>Piche Read</th>

                            <?php if( $userrole=='SeniorDataOfficer'  || $userrole=='DataOfficer' || $userrole=='ObserverArchive'  || $userrole=='OC' ){ ?>
                                    <th>Approved</th>
                                    <th>By</th>
                                    <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($archivedobservationslipformdata) && count($archivedobservationslipformdata)) {
                                foreach($archivedobservationslipformdata as $archiveobservationslipdata){
                                    $count++;
                                    $archiveobservationslipdataid = $archiveobservationslipdata->id;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Date;?></td>
                                        <td ><?php echo $archiveobservationslipdata->StationName;?></td>
                                        <td ><?php echo $archiveobservationslipdata->StationNumber;?></td>
                                        <td ><?php echo $archiveobservationslipdata->TIME;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Dry_Bulb;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Wet_Bulb;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Present_Weather;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Visibility;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Wind_Direction;?></td>
                                        <td><?php echo $archiveobservationslipdata->Wind_Speed;?></td>
                                        <td><?php echo $archiveobservationslipdata->Rainfall;?></td>


                                        <td ><?php echo $archiveobservationslipdata->Gusting;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Max_Read;?></td>
                                        <td><?php echo $archiveobservationslipdata->Min_Read;?></td>
                                        <td><?php echo $archiveobservationslipdata->Piche_Read;?></td>
                                   <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer' || $userrole=='ObserverArchive' || $userrole=='OC' ){ ?>
                                     <td><?php echo $archiveobservationslipdata->Approved;?></td>

                                     <td><?php echo $archiveobservationslipdata->SubmittedBy;?></td>
                                     <td class="no-print">

                                            <a href="<?php echo base_url()."index.php/ArchiveObservationSlipFormData/DisplayArchiveObservationSlipFormForUpdate/" .$archiveobservationslipdataid; ?>" style="cursor:pointer;">Edit</a>

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
    <script>
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#postarchiveobservationslipformdata_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveObservationSlipFormData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("An Archived Observation Slip Record With the date,station,station Number and Time exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").focus();
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
                var station=$('#station_archiveobservationslipformdata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#station_archiveobservationslipformdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archiveobservationslipformdata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#stationNo_archiveobservationslipformdata").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_archiveobservationslipform=$('#time_archiveobservationslipformdata').val();
                if(time_archiveobservationslipform==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#time_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#time_archiveobservationslipformdata").focus();
                    return false;

                }


///////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////////////////////////////////////////////
                var maxRead_archiveobservationslipformdata=$('#maxRead_archiveobservationslipformdata').val();
                if(maxRead_archiveobservationslipformdata > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxRead Temperature can't go beyond 42 degrees");
                    $('#maxRead_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#maxRead_archiveobservationslipformdata").focus();
                    return false;

                }
                var maxReset_archiveobservationslipformdata=$('#maxReset_archiveobservationslipformdata').val();
                if(maxReset_archiveobservationslipformdata > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxReset Temperature can't go beyond 42 degrees");
                    $('#maxReset_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#maxReset_archiveobservationslipformdata").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var minRead_archiveobservationslipformdata=$('#minRead_archiveobservationslipformdata').val();
                if(minRead_archiveobservationslipformdata > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinRead Temperature can't go beyond 42 degrees");
                    $('#minRead_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#minRead_archiveobservationslipformdata").focus();
                    return false;

                }
                var minReset_archiveobservationslipformdata=$('#minReset_archiveobservationslipformdata').val();
                if(minReset_archiveobservationslipformdata > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinReset Temperature can't go beyond 42 degrees");
                    $('#minReset_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#minReset_archiveobservationslipformdata").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var winddirection_archiveobservationslipformdata=$('#winddirection_archiveobservationslipformdata').val();
                if((winddirection_archiveobservationslipformdata > 360) || (winddirection_archiveobservationslipformdata < 000) ){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Direction should be between 000 to 360");
                    $('#winddirection_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#winddirection_archiveobservationslipformdata").focus();
                    return false;

                }
                var windspeed_archiveobservationslipformdata=$('#windspeed_archiveobservationslipformdata').val();
                if(windspeed_archiveobservationslipformdata < 000){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Speed can't go beyond 000");
                    $('#windspeed_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#windspeed_archiveobservationslipformdata").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveObservationSlipFormData(){

            //Check against the dManagertationName,StatioManagerer,Time
            var date= $('#date').val();
            var stationName = $('#station_archiveobservationslipformdata').val();
            var stationNumber = $('#stationNo_archiveobservationslipformdata').val();
            var time_OfObservationSlipForm = $('#time_archiveobservationslipformdata').val();


            $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').val("");

            if ((date != undefined) && (time_OfObservationSlipForm != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveObservationSlipFormData/checkInDBIfArchiveObservationSlipFormDataRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time_OfObservationSlipForm':time_OfObservationSlipForm,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").val();

            }//end of if

            else if((date == undefined)  ||(time_OfObservationSlipForm == undefined)|| (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB When the fields are not picked frm the DB
            //Validate each field before inserting into the DB
            $('#updatearchiveobservationslipformdata_button').click(function(event) {
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
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var timeRecorded=$('#timeRecorded').val();
                if(timeRecorded==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }


///////////////////////////////////////////////////////////////////////////////////
                //Check that REWIW1 IS PICKED FROM A LIST
                var approval=$('#approval').val();
                if(approval==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select approval from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////
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


            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
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
            ///////////////////////////////////////////////////////////////////////////////////////////
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
            var oldValue_HeightOfLowClouds1= $('#HeightOfLowClouds1').val();

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
            var oldValue_HeightOfLowClouds2= $('#HeightOfLowClouds2').val();

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
            var oldValue_HeightOfLowClouds3= $('#HeightOfLowClouds3').val();

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
            var oldValue_HeightOfMeduimClouds1= $('#HeightOfMeduimClouds1').val();

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
            var oldValue_HeightOfMeduimClouds2= $('#HeightOfMeduimClouds2').val();

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
            var oldValue_HeightOfMeduimClouds3= $('#HeightOfMeduimClouds3').val();

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
            var oldValue_HeightOfHighClouds1= $('#HeightOfHighClouds1').val();

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
            var oldValue_HeightOfHighClouds2= $('#HeightOfHighClouds2').val();

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
            var oldValue_HeightOfHighClouds3= $('#HeightOfHighClouds3').val();

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
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_cloudsearchlight;
            var oldValue_cloudsearchlight= $('#cloudsearchlight').val();

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
            ///////////////////////////////////////////////////////////////////////////////////////////
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
            ///////////////////////////////////////////////////////////////////////////////////////////
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
            var oldValue_maxRead= $('#maxRead').val();

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
            var oldValue_maxReset= $('#maxReset').val();

            $('#maxReser').live('change paste', function(){
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
            var oldValue_minRead= $('#minRead').val();

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
            var oldValue_minReset= $('#minReset').val();

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
            var oldValue_picheRead= $('#picheRead').val();

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
            var oldValue_picheReset= $('#picheReset').val();

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


<?php require_once(APPPATH . 'views/footer.php'); ?>
<script src="<?php echo base_url(); ?>js/form0.js"></script>
