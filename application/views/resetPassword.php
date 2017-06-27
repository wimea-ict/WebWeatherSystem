<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userid=$session_data['Userid'];
?>
<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>WIMEA-ICT - Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-black">
<?php require_once(APPPATH . 'views/error.php'); ?>

<div class="form-box" id="login-box">

    <div class="header">
        <div class="col-lg-3">
            <img src="<?php echo base_url(); ?>img/WIMEA LOGO.png" class="img-responsive">
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <img src="<?php echo base_url(); ?>img/new-mak.png" class="img-responsive">
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <img src="<?php echo base_url(); ?>img/noradlogosort_.gif" class="img-responsive">
        </div>
        <div class="clearfix"></div>
        <hr>
        WIMEA-ICT Change System Password

    </div>
    <form action="<?php echo base_url(); ?>index.php/UserLogin/systemresetpassword" method="post">
        <div class="body bg-gray">

            <div class="form-group">
                <label>Password:</label>
                <input type="hidden" name="userid" value="<?php echo $userid;?>">
                <input type="password" name="password1" required class="form-control" required placeholder="Enter your password"/>
            </div>

            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirmpassword1" required class="form-control" required placeholder="Enter your password"/>
            </div>

        </div>
        <div class="footer">
            <input type="submit" class="btn bg-olive" name="resetsystempassword" value="Change password">
            <a href="<?php echo base_url(); ?>index.php/Welcome/" class="btn btn-warning pull-right" ><i class="fa fa-times"></i> Cancel</a>
            <hr>
            <p>In Partnership</p>
            <div class="col-lg-2">
                <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">
                <img src="<?php echo base_url(); ?>img/bergen.gif" class="img-responsive">
            </div>
            <div class="clearfix"></div>
            <p><a href="<?php echo base_url(); ?>index.php/Welcome/"><i class="fa fa-long-arrow-left"></i> Go back to login</a></p>
            <div class="clearfix"></div>
        </div>
    </form>
</div>


<!-- jQuery 2.0.2
<script src="js/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>