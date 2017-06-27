<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//'StationNumber' => $row->StationNumber,
?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>preview page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>

            <div>
                <center><h4><label>Name:</label> <?php echo $name; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>Station:</label> <?php echo $userstation; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>Station Number:</label> <?php echo $userstationNo; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>Role:</label> <?php echo $userrole; ?></h4></center>
            </div>
            <div class="clearfix"></div><hr>
            <div class="row"><div class="col-xs-12">
                    <img src="<?php echo base_url(); ?>img/awsbanner.png" class="img-responsive">
                </div></div>





            <br>

        </section><!-- /.content -->

    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

<?php require_once(APPPATH . 'views/footer.php'); ?>