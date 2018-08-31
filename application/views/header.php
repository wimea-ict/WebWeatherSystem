<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userregion= $session_data['UserRegion'];
$surname=$session_data['SurName'];
$created=$session_data['CreationDate'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo base_url(); ?>img/wimea-icon.png" >
    <title>Weather | <?php echo $userrole; if(isset($_GET['page'])){ echo "- ". $_GET['page']; }?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- jQuery 2.0.2
<script src="js/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="<?php echo base_url(); ?>js/daterangepicker.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url(); ?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url(); ?>css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

    <link href="<?php echo base_url(); ?>css/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/bootstrap-timepicker/css/timepicker.less" rel="stylesheet" type="text/css" />  <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>css/bootstrap-timepicker/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Multiple Form section -->
    <link href="<?php echo base_url(); ?>css/form.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/dashboard.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.table2excel.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.tabletoCSV.js"></script>
<script src="<?php echo base_url(); ?>js/form0.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-timepicker-gh-pages/js/bootstrap-timepicker.js"></script>
	<style type="text/css" media="print">
	  @page { size: landscape; }
	  width: 100%;
	</style>
  <style>
    /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
}

/* The Close Button */


.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
        .report-table{
            width:100%;
        }

        .bootstrap-datetimepicker-widget {
            top: 220px;
            left: 350px;
        }

        .report-table td{
            border:1px solid;
            padding:5px;
        }

        .report-table td.no-border{
            border:none !important;
        }

        .report-table td.main{
            font-weight:bold;
        }

        .report span.dotted-line{
            border-bottom:1px dashed;
            padding:0 50px;
        }
    </style>

</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->

<header class="header">
    <a href="" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        WIMEA-ICT
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
		 <a href="" class="logo" style="color:white;text-transform:uppercase;">
                 <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php
				if($userrole == 'ManagerData'){echo "DataManager"."&nbsp" . "panel";}
							 else{echo $userrole ."&nbsp" . "panel";}
				 ?> 
                 </a>
        <div class="navbar-right" >

        <?php if($userrole == 'OC' || $userrole == 'ManagerData'){ ?>
         <ul class="nav navbar-nav">
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="label label-pill label-danger count" style="border-radius:10px;"></span> 
                <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                <ul id="ips" class="dropdown-menu dropdown-menu1">
                </ul>
                </li>
                
         </ul>
        <?php } ?>
		
		<ul class="nav navbar-nav" >
                <!-- Messages: style can be found in dropdown.less-->
                
                <li class="user user-menu">
                    <a style="color : white;">
                        <span >
							 <?php if($userrole == 'ManagerData'){echo "Hello"."&nbsp" ."DataManager"."&nbsp" . $surname;}
							 else{
							 echo"Hello"."&nbsp". $userrole ."&nbsp" . $surname;} ?> 
						</span>
                    </a>
                </li>

            </ul>
		
            <ul class="nav navbar-nav" >
                <!-- Messages: style can be found in dropdown.less-->
                
                <li class="user user-menu">
                    <a style="color : white;" href="<?php echo base_url(); ?>index.php/UserLogin/logout">
                        <i class="fa fa-sign-out"></i>
                        <span >Sign out</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>img/WIMEA LOGO.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Hello, <?php echo $surname;?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">


                <li class="active">
                    <a href="<?php echo base_url();?>index.php/UserLogin/showdashboardInfo">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>



                <?php  if( $userrole== "OC" || $userrole=="WeatherForecaster" || $userrole== "Observer" || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" ){
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Forms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <?php if($userrole=="WeatherForecaster") {?>
                    <ul class="treeview-menu">
                       <li><a href="<?php echo base_url();?>index.php/ObservationSlipForm/showWebmobiledata"><i class="fa fa-angle-double-right"></i> manual observations data</a></li>
                      </ul>
                  <?php }else{?>
                    <ul class="treeview-menu">

                       <li><a href="<?php echo base_url();?>index.php/ObservationSlipForm/showWebmobiledata"><i class="fa fa-angle-double-right"></i> MS observation data</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ObservationSlipForm/showAwsdata"><i class="fa fa-angle-double-right"></i> AWS observation data</a></li>
                    </ul>
                  <?php }?>
                </li>
                <?php } ?>

                <?php  if( $userrole== "ObserverDataEntrant"  || $userrole== "DataOfficer" || $userrole=="SeniorDataOfficer" || $userrole== "OC"){
                ?>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Archive Forms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                     <?php if($userrole=="OC"){?>
					   <ul class="treeview-menu">
						<li><a href="<?php echo base_url();?>index.php/ArchiveObservationSlipFormData"><i class="fa fa-angle-double-right"></i>Observation Slip Form</a></li>
                         </ul>
					<?php }else{?>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>index.php/ArchiveObservationSlipFormData"><i class="fa fa-angle-double-right"></i>Observation Slip Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveWeatherSummaryFormReportData"><i class="fa fa-angle-double-right"></i>Weather Summary Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/ArchiveMetarFormData"><i class="fa fa-angle-double-right"></i>Metar Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveSynopticFormReportData"><i class="fa fa-angle-double-right"></i>Synoptic Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveDekadalFormReportData"><i class="fa fa-angle-double-right"></i>Dekadal Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveMonthlyRainfallFormReportData"><i class="fa fa-angle-double-right"></i> Archive  Rainfall</a></li>

                    </ul>
					<?php } ?>
                </li>
                <?php } ?>

                <?php  if($userrole == "ManagerData"  || $userrole=="SeniorDataOfficer" ){
                ?>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Archived Form Reports</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedObservationSlipFormData"><i class="fa fa-angle-double-right"></i> Observation Slip Report</a></li>
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedWeatherSummaryFormReportData"><i class="fa fa-angle-double-right"></i> Weather Summary Report</a></li>
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedMetarFormData"><i class="fa fa-angle-double-right"></i> Metar Report</a></li>
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedSynopticFormReportData"><i class="fa fa-angle-double-right"></i> Synoptic Report</a></li>
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedDekadalFormReportData"><i class="fa fa-angle-double-right"></i> Dekadal Report</a></li>
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedMonthlyRainfallFormReportData"><i class="fa fa-angle-double-right"></i> Monthly  Rainfall Report</a></li>
                        <li><a href="<?php echo base_url();?>index.php/DisplayArchivedYearlyRainfallFormReportData"><i class="fa fa-angle-double-right"></i> Annual  Rainfall Report</a></li>

                    </ul>
                </li>
                <?php } ?>

              <?php  if( $userrole== "ObserverArchive" ||  $userrole== "DataOfficer" || $userrole=="SeniorDataOfficer"){
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Archive Scanned Forms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>


                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedObservationSlipFormDataCopy"><i class="fa fa-angle-double-right"></i> Observation Slip Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedMetarFormDataCopy"><i class="fa fa-angle-double-right"></i>  Metar Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedWeatherSummaryFormDataReportCopy"><i class="fa fa-angle-double-right"></i> Weather Summary Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedSynopticFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Synoptic Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedDekadalFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Dekadal Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedMonthlyRainfallFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Monthly Rainfall Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Annual Rainfall Form</a></li>

                    </ul>
                </li>
                <?php } ?>

                <?php if($userrole == "ManagerData"  || $userrole == "SeniorDataOfficer"){
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Search Scanned Forms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>


                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedObservationSlipFormDataCopy"><i class="fa fa-angle-double-right"></i>Observation Slip Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedMetarFormDataCopy"><i class="fa fa-angle-double-right"></i>Metar Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedWeatherSummaryFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Weather Summary Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedSynopticFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Synoptic Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedDekadalFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Dekadal Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedMonthlyRainfallFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Monthly Rainfall Form</a></li>

                        <li><a href="<?php echo base_url();?>index.php/SearchArchivedScannedYearlyRainfallFormDataReportCopy"><i class="fa fa-angle-double-right"></i>Annual Rainfall Form</a></li>

                    </ul>
                </li>
        <?php  }?>

                <?php
                if($userrole == "ManagerData" ||  $userrole=="ZonalOfficer" || $userrole=="SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherAnalyst" || $userrole=="WeatherForecaster" ){
                    ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span> Reports</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initialiseObservationSlipReport"><i class="fa fa-angle-double-right"></i> Observation Slip Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeMetarReport"><i class="fa fa-angle-double-right"></i> Metar Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeSpeciReport"><i class="fa fa-angle-double-right"></i> Speci Report</a></li>

                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializerainfallTempReport"><i class="fa fa-angle-double-right"></i> Rainfall temp Report</a></li>
                          <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeWeatherSummnaryReport"><i class="fa fa-angle-double-right"></i> Weather Summary Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeDekadalReport"><i class="fa fa-angle-double-right"></i> Dekadal Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeSynopticReport"><i class="fa fa-angle-double-right"></i> Synoptic Report</a></li>

                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeMonthlyRainfallReport"><i class="fa fa-angle-double-right"></i> Monthly Rainfall Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/ReportsController/initializeRainfallYearlyReport"><i class="fa fa-angle-double-right"></i> Annual Rainfall Report</a></li>
							<li><a href="<?php echo base_url();?>index.php/ReportsController/initializeRainfallCustomReport"><i class="fa fa-angle-double-right"></i> Customized Rainfall Report</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php
                if($userrole == "ManagerData" || $userrole== "OC" ){
                ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span> Users</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>index.php/Users"><i class="fa fa-angle-double-right"></i> Users</a></li>
                            <li><a href="<?php echo base_url();?>index.php/Users/userlogs"><i class="fa fa-angle-double-right"></i> User Logs</a></li>
                        </ul>
                    </li>
                     <?php }  ?>
                <?php
                if($userrole == "ManagerStationNetworks"){   ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span> System Data</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                            <li><a href="<?php echo base_url();?>index.php/Stations"><i class="fa fa-angle-double-right"></i> Stations</a></li>
                            <li><a href="<?php echo base_url();?>index.php/StationInstruments"><i class="fa fa-angle-double-right"></i> Instruments</a></li>
                            <li><a href="<?php echo base_url();?>index.php/StationElements"><i class="fa fa-angle-double-right"></i> Elements</a></li>

                            <li><a href="<?php echo base_url(); ?>index.php/NewStations/DisplayStationsForm/" ><i class="fa fa-angle-double-right"></i>Add New Station</a></li>

                        </ul>
                    </li>
                   <?php } ?>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <div id='popupwindow'>
<div style="z-index:200;" id="myModal2"  data-backdrop="false" class="modal">
                <div class="modal-content">
                <div class="modal-header">
                    <button  type="button" class="close" data-dismiss="modal">&times;
                    </button><h3 id="title1" class="modal-title"></h3></div><div id="popbody" class="modal-body">
                    </div><div id="footer"class="modal-footer">
                    
                </div></div></div>


</div>

    <script>

var getData = function (obj) {
    var link = obj.getAttribute("href");
    var content =  $('#popupwindow');
//alert(link);
    $.ajax({
    url: "<?php echo base_url(); ?>"+link,
    type: "POST",
    cache: false,
    success: function(data)
                {
                    $('#title1').empty();
                    $('#popbody').empty();
                    $('#footer').empty();
                var jsondata = JSON.parse(data);
                    for(var key in jsondata.result) {
                        
                        $('#title1').append(jsondata.result[key].FirstName+' '+jsondata.result[key].SurName+', '+
                        jsondata.result[key].UserRole);
                        $('#popbody').append('<span style="font-size:14px;float:left"><em>No. '+
                        jsondata.result[key].data_id+'</em></span><span style="font-size:18px;"><em><center>'+jsondata.result[key].Action+
                        '</em></span><span style="font-size:14px;float:right"><em>'+
                        jsondata.result[key].Date+'</em></span><br><br>');
                        var baseurl= "<?php echo base_url(); ?>"+
                        "index.php/ObservationSlipForm/getPopupRecord/"+jsondata.result[key].data_id+
                        "/"+jsondata.result[key].Userid+"/"+jsondata.result[key].Date;
                            break;
                    } 

                    
                    for(var key in jsondata.result) {
                        $('#popbody').append('<p>Changed <em><b>'+jsondata.result[key].field+'</b></em> from &nbsp;&nbsp;<em><b>'
                        +jsondata.result[key].old_value+
                        '</b></em>&nbsp;&nbsp; to &nbsp;&nbsp;<em><b>'+jsondata.result[key].new_value+'</b></em></em></p>'); 
                    } 
                    $('#footer').append('<a  href="'+baseurl+'" class="btn btn-success">View</a>'+
                    '&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
                    $('#myModal2').modal('show');
                }
});

};

 var count;
        $(document).ready(function(){
       function load_unseen_notification(view = '')
        {
        $.ajax({
        url:"<?php echo base_url(); ?>"+"index.php/ObservationSlipForm/getNotification",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
            count=data.unseen_notification;
            if(data.unseen_notification > 0)
            {
            $('.count').html(data.unseen_notification);
            }
        }
        });
        }
        
        load_unseen_notification();
        
        $(document).on('click', '.dropdown-toggle', function(){
        $('.count').html('');
        if(count >0){
            load_unseen_data();
        }else{
            var output = '<li><a href="#" class="text-bold text-italic">No New Notification Found</a></li>';
            $('.dropdown-menu1.dropdown-menu').html(output);
        }
        
        });
        
        setInterval(function(){ 
        load_unseen_notification();; 
        }, 5000);
        
        });

        function load_unseen_data(view = '')
        {
        $.ajax({
        url:"<?php echo base_url(); ?>"+"index.php/ObservationSlipForm/getNotificationData",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
            $('.dropdown-menu1.dropdown-menu').html(data.notification+'<span style="cursor:pointer" id = "viewall"><center><li>View All</li></center></span>');
        }
        });
        }

      $(document).on('click', '#viewall', function(){
          document.location.href="<?php echo base_url(); ?>"+"index.php/ObservationSlipForm/viewAllNotifications";
          
        });
        </script>