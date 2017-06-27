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
                <li class="active">User logs</li>
           
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>
            
            
            <br>
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="box">
                    	
                        <div class="box-header">
                            <h3 class="box-title">User logs </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>User Role</th>
                                        <th>Action taken</th>
                                        <th>Details</th>
                                        <th>Station Name</th>
                                        <th>Station Number</th>
                                        <th>IP Address</th>
                                     <!--   <th class="no-print">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count = 0;
                        if (is_array($userlogs) && count($userlogs)) {
                         foreach($userlogs as $userlogsdata){
                                         $count++;
                                        $userlogsid = $userlogsdata->id;

                                        
                                ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $userlogsdata->Date;?></td>
                                        <td ><?php echo $userlogsdata->User;?></td>
                                        <td ><?php echo $userlogsdata->UserRole;?></td>
                                        <td ><?php echo $userlogsdata->Action;?></td>
                                        <td ><?php echo $userlogsdata->Details;?></td>
                                        <td ><?php echo $userlogsdata->StationName;?></td>
                                        <td ><?php echo $userlogsdata->StationNumber;?></td>
                                        <td ><?php echo $userlogsdata->IP;?></td>
                                     <!--   <td class="no-print"> <a href="<?php echo base_url() . "index.php/Users/deleteUserLogs/" .$userlogsid ;?>"
                                          onClick="return confirm('Are you sure to delete <?php echo $userlogsid->User;?>');">Delete</a></td>  -->
                                    </tr>
                                    
                                    <?php
                                    }
                        }
                                    ?>
                                </tbody>
                                
                            </table>
                            <br><br>
                            <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->


<?php require_once(APPPATH . 'views/footer.php'); ?>