<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$surname=$session_data['SurName'];
$created=$session_data['CreationDate'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Weather Admin <?php if(isset($_GET['page'])){ echo "- ". $_GET['page']; }?></title>
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
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/dashboard.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.table2excel.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.tabletoCSV.js"></script>



    <style>
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
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <li class="user user-menu">
                    <a href="<?php echo base_url(); ?>index.php/UserLogin/logout">
                        <i class="fa fa-sign-out"></i>
                        <span>Sign out</span>
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



                <?php  if( $userrole== "OC" || $userrole== "Observer"){
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Forms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>


                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>index.php/ObservationSlipForm"><i class="fa fa-angle-double-right"></i> Observation Slip Form </a></li>
                        <li><a href="<?php echo base_url();?>index.php/MetarForm"><i class="fa fa-angle-double-right"></i> Metar Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/MoreFormFieldsForm"><i class="fa fa-angle-double-right"></i> More Form Fields</a></li>

                    </ul>
                </li>
                <?php } ?>

                <?php  if( $userrole== "ObserverDataEntrant"){
                ?>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i> <span> Archive Forms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>


                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>index.php/ArchiveObservationSlipFormData"><i class="fa fa-angle-double-right"></i>Observation Slip Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveWeatherSummaryFormReportData"><i class="fa fa-angle-double-right"></i>Weather Summary Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveMetarFormData"><i class="fa fa-angle-double-right"></i>Metar Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveSynopticFormReportData"><i class="fa fa-angle-double-right"></i>Synoptic Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveDekadalFormReportData"><i class="fa fa-angle-double-right"></i>Dekadal Form</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ArchiveMonthlyRainfallFormReportData"><i class="fa fa-angle-double-right"></i> Archive  Rainfall</a></li>

                    </ul>
                </li>
                <?php } ?>

                <?php  if($userrole == "Manager" || $userrole== "OC"){
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

              <?php  if( $userrole== "ObserverArchive"){
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

                <?php if($userrole == "Manager" || $userrole== "OC"){
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
                if($userrole == "Manager" || $userrole== "OC"){
                    ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span> Reports</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>index.php/ObservationSlipReport"><i class="fa fa-angle-double-right"></i> Observation Slip Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/MetarReport"><i class="fa fa-angle-double-right"></i> Metar Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/WeatherSummaryReport"><i class="fa fa-angle-double-right"></i> Weather Summary Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/DekadalReport"><i class="fa fa-angle-double-right"></i> Dekadal Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/SynopticReport"><i class="fa fa-angle-double-right"></i> Synoptic Report</a></li>

                            <li><a href="<?php echo base_url();?>index.php/MonthlyRainfallReport"><i class="fa fa-angle-double-right"></i> Monthly Rainfall Report</a></li>
                            <li><a href="<?php echo base_url();?>index.php/YearlyRainfallReport"><i class="fa fa-angle-double-right"></i> Annual Rainfall Report</a></li>
                        </ul>
                    </li>


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

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span> System Data</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                            <li><a href="<?php echo base_url();?>index.php/Stations"><i class="fa fa-angle-double-right"></i> Stations</a></li>
                          <!--  <li><a href="<?php echo base_url();?>index.php/StationInstruments"><i class="fa fa-angle-double-right"></i> Instruments</a></li>
                            <li><a href="<?php echo base_url();?>index.php/StationElements"><i class="fa fa-angle-double-right"></i> Elements</a></li> -->

                        </ul>
                    </li>
                <?php } ?>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>