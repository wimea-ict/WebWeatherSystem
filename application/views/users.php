<?php require_once(APPPATH . 'views/header.php'); ?>
<?php
$session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$userstationId=$session_data['StationId'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>

    <aside class="right-side">
    <section class="content-header">
        <h1>
            Users
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>


    <?php

    if(is_array($displaynewstationuserform) && count($displaynewstationuserform)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/Users/insertUser/" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="output"></div>
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


                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">First Name</span>
                                <input type="text" name="user_firstname" id="user_firstname" onkeyup="allowCharactersInputOnly(this)"   required class="form-control"  required placeholder="Enter user's name">
                                <input type="hidden" name="checkduplicateEntryOnAddUserStationInformation_hiddentextfield" id="checkduplicateEntryOnAddUserStationInformation_hiddentextfield" required class="form-control">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">SurName</span>
                                <input type="text" name="user_surname"  id="user_surname" onkeyup="allowCharactersInputOnly(this)"  required class="form-control"   required placeholder="Enter user's name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> User Email</span>
                                <input type="email" name="user_email" id="user_email" required class="form-control" required placeholder="Enter user's email">
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">User Phone</span>
                                <input maxlength='10' type="text" name="user_phone" id="user_phone" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter user's contact ">
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-6">



                        <?php

                        if($userrole=='OC'){ ?>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> User Role</span>
                                    <select name="user_Role_AssignedBy_OC"  id="user_Role_AssignedBy_OC"  required class="form-control" placeholder="Select Role">
                                        <option value="">--Select User Roles--</option>
                                        <option value="Observer">Observer</option>
                                        <option value="ObserverArchive">ObserverArchive</option>
                                        <option value="ObserverDataEntrant">ObserverDataEntrant</option>

                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="user_station_OC" id="user_station_OC" value="<?php echo $userstation; ?>" readonly="readonly" required class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="user_stationNo_OC" id="user_stationNo_OC" required class="form-control"  readonly class="form-control" value="<?php echo $userstationNo; ?>" readonly="readonly" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Region</span>
                                    <input type="text" name="user_stationRegion_AssignedBy_Manager"
                                     id="user_stationRegion_AssignedBy_Manager" 
                                    required class="form-control"  readonly class="form-control" value="" readonly="readonly" >
                                </div>
                            </div>





                        <?php } elseif($userrole=='Manager' || $userrole=='ManagerData'){?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> User Role</span>
                                    <select name="user_Role_AssignedBy_Manager"  id="user_Role_AssignedBy_Manager"  required class="form-control" placeholder="Select Role">
                                        <option value="">--Select User Roles--</option>
                                        <option value="Observer">Observer</option>
                                        <option value="ObserverArchive">ObserverArchive</option>
                                        <option value="ObserverDataEntrant">ObserverDataEntrant</option>
                                        <option value="WeatherForecaster">WeatherForecaster</option>
                                        <option value="WeatherAnalyst">WeatherAnalyst</option>
                                        <option value="OC">OC</option>
                                        <option value="ZonalOfficer">ZonalOfficer</option>
                                        <option value="SeniorZonalOfficer">SeniorZonalOfficer</option>
                                        <option value="DataOfficer">DataOfficer</option>
                                        <option value="SeniorDataOfficer">SeniorDataOfficer</option>
                                        <option value="ManagerStationNetworks">ManagerStationNetworks</option>
                                    </select>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="user_station_Manager" id="user_station_Manager" class="form-control" required class="form-control" placeholder="Select Station">
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




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="user_stationNo_Manager" id="user_stationNo_Manager" required class="form-control"  readonly class="form-control" value="" readonly="readonly" >
                                  <!--  <input type="text" name="user_stationRegion_Manager" id="user_stationRegion_Manager" required class="form-control"  readonly class="form-control" value="" readonly="readonly" > -->

                                </div>
                            </div>



                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Region</span>
                                    <select name="user_stationRegion_AssignedBy_Manager" id="user_stationRegion_AssignedBy_Manager" readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" required class="form-control">
                                        <option value="">--Select REGION--</option>
                                        <option value="Central">Central</option>
                                        <option value="Northern">Northern</option>
                                        <option value="Southern">Southern</option>
                                        <option value="Eastern">Eastern</option>
                                        <option value="Western">Western</option>

                                    </select>
                                </div>
                            </div>






                        <?php } ?>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer clearfix">
                     <button type="submit" id="saveStationUserDetails_button" name="saveStationUserDetails_button" class="btn btn-primary "><i class="fa fa-plus"></i> Add User</button>
                    <a href="<?php echo base_url(); ?>index.php/Users/" class="btn btn-danger pull-left"><i class="fa fa-times"></i> Cancel</a>

                   
                </div>
            </form>
        </div>
    <?php
    }elseif((is_array($stationuserdataid) && count($stationuserdataid))) {
        foreach($stationuserdataid as $userdetails){

            $$userdetailsformid = $userdetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/Users/updateUser" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="output"></div>
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">FirstName</span>
                                    <input type="text" name="firstname" id="firstname" onkeyup="allowCharactersInputOnly(this)" class="form-control" required value="<?php echo $userdetails->FirstName;?>" placeholder="Enter staff's name"  class="form-control">
                                    <input type="hidden" name="id" id="id" value="<?php echo $userdetails->Userid;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">SurName</span>
                                    <input type="text" name="surname" id="surname" onkeyup="allowCharactersInputOnly(this)" required class="form-control" value="<?php echo $userdetails->SurName;?>" placeholder="Enter staff's email"  class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Email</span>
                                    <input type="email" name="email" id="email" required class="form-control" value="<?php echo $userdetails->UserEmail;?>" placeholder="Enter user's email "  class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Phone</span>
                                    <input type="text" name="contact" id="contact" required class="form-control" value="<?php echo $userdetails->UserPhone;?>" placeholder="Enter Phone "  class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <?php if($userrole=="OC"){ ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="Role_AssignedBy_OC"  id="Role_AssignedBy_OC"     required class="form-control" placeholder="Select Role">
                                            <option value="<?php echo $userdetails->UserRole;?>"><?php echo $userdetails->UserRole;?></option>
                                            <option value="">--Select User Roles--</option>
                                            <option value="Observer">Observer</option>
                                            <option value="ObserverArchive">ObserverArchive</option>
                                            <option value="ObserverDataEntrant">ObserverDataEntrant</option>
                                            <option value="WeatherForecaster">WeatherForecaster</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="station_OC"  id="station_OC" value="<?php echo $userstation; ?>" required class="form-control"   required class="form-control" readonly class="form-control" >


                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo_OC" id="stationNo_OC" required class="form-control"   readonly class="form-control" value="<?php echo $userstationNo; ?>" readonly="readonly" >
                                        <input type="hidden" name="stationid" id="stationid" required class="form-control"   readonly class="form-control" value="" readonly="readonly" >

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Region</span>
                                        <select name="stationRegion_OC" id="stationRegion_OC" onkeyup="allowCharactersInputOnly(this)" readOnly class="form-control">
                                            <option value="<?php echo $userdetails->StationRegion;?>"><?php echo $userdetails->StationRegion;?></option>
                                            <option value="">--Select REGION--</option>
                                            <option value="Central">Central</option>
                                            <option value="Northern">Northern</option>
                                            <option value="Southern">Southern</option>
                                            <option value="Eastern">Eastern</option>
                                            <option value="Western">Western</option>

                                        </select>
                                    </div>
                                </div>




                            <?php }elseif($userrole=="Manager" || $userrole=='ManagerData'){ ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="Role_AssignedBy_Manager"  id="Role_AssignedBy_Manager"  required class="form-control" placeholder="Select Role">
                                            <option value="<?php echo $userdetails->UserRole;?>"><?php echo $userdetails->UserRole;?></option>
                                            <option value="">--Select User Roles--</option>
                                            <option value="OC">OC</option>
                                            <option value="ZonalOfficer">Zonal Officer</option>
                                            <option value="SeniorZonalOfficer">Senior Zonal Officer</option>

                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="input-group">
                                    <?php
                                        $displaystation = $userdetails->StationName;
                                    ?>
                                        <span class="input-group-addon">Station</span>
                                        <select name="station_Manager"  id="station_Manager" required class="form-control" placeholder="Select Station">
                                            <option value="<?php echo $displaystation; ?>"><?php echo $displaystation;?></option>
                                            <?php
                                            if (is_array($stationsdata) && count($stationsdata)) {
                                                foreach($stationsdata as $station){?>
                                                    <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo_Manager" id="stationNo_Manager" required class="form-control"  value="" readonly class="form-control" value="" readonly="readonly" >
                                        <input type="hidden" name="stationid" id="stationid" required class="form-control"  value="" readonly class="form-control" value="" readonly="readonly" >

                                       <!-- <input type="text" name="stationRegion_Manager" id="stationRegion_Manager" required class="form-control"  value="" readonly class="form-control" value="" readonly="readonly" > -->

                                    </div>
                                </div>





                                <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon">Region</span>
                                    <select name="stationRegion_AssignedBy_Manager" id="stationRegion_AssignedBy_Manager"
                                     readonly class="form-control" onkeyup="allowCharactersInputOnly(this)" required class="form-control">
                                        <option value="">--Select REGION--</option>
                                        <option value="Central">Central</option>
                                        <option value="Northern">Northern</option>
                                        <option value="Southern">Southern</option>
                                        <option value="Eastern">Eastern</option>
                                        <option value="Western">Western</option>

                                    </select>

                                    </div>
                                </div>

                            <?php }?>






                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

              

                <button type="submit" name="updateStationUserDetails_button" id="updateStationUserDetails_button" class="btn btn-primary"><i class="fa fa-plus"></i> Update User</button>
				  <a  href="<?php echo base_url(); ?>index.php/Users/" class="btn btn-danger pull-left"><i class="fa fa-times"></i> Cancel</a>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/Users/DisplayStationUsersForm/">
                    <i class="fa fa-plus"></i> Add new User</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">

                    <?php require_once(APPPATH . 'views/error.php'); ?>
                   <div class="box-body table-responsive" style="overflow:auto;">
                        <table id="example1" class="table table-bordered table-fixed table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>First Name</th>
                                <th>SurName</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Station</th>
                                <th>Station Number</th>
                                <th> Region</th>
                                <th>Role</th>
                                <th class="no-print">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($allusers) && count($allusers)) {
                                foreach($allusers as $userdetails){
                                    $count++;
                                    $userdetailsid = $userdetails->Userid;



                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $userdetails->FirstName;?></td>
                                        <td ><?php echo $userdetails->SurName;?></td>
                                        <td ><?php echo $userdetails->UserPhone;?></td>
                                        <td ><?php echo $userdetails->UserEmail;?></td>
                                        <td ><?php echo $userdetails->StationName;?></td>
                                        <td ><?php echo $userdetails->StationNumber;?></td>
                                        <td ><?php echo $userdetails->station==0? $userdetails->region_zone: $userdetails->StationRegion;?></td>
                                        <td><?php echo $userdetails->UserRole;?></td>
                                        <?php if($userrole=='Manager' || $userrole=='ManagerData'|| $userrole=='OC'){ ?>
										<td class="no-print">
                                            <table><tr><td>
                                            <a class="btn btn-primary" href="<?php echo base_url() . "index.php/Users/DisplayStationUsersFormForUpdate/" .$userdetailsid ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Edit</a></td>
                                         <?php $fname =$userdetails->FirstName;$lname=$userdetails->SurName;
                                          if(  $userrole=='ManagerData' && $userdetails->Active == 1){ ?><td> 
                                            <a class="btn btn-danger" href="<?php echo base_url() . "index.php/Users/deleteUser/" .$userdetailsid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $fname.' '.$lname;?>');">
                                                  <li class="fa fa-times"></li> Deactivate</a>
                                                  </td><?php }else if($userrole=='ManagerData' && $userdetails->Active == 0){ ?>
                                                      <td> 
                                                      <a class="btn btn-success" href="<?php echo base_url() . "index.php/Users/activateUser/" .$userdetailsid ;?>"
                                                            onClick="return confirm('Are you sure you want to Activate <?php echo $fname.' '.$lname;?>');"><li class="fa fa-check"></li>&nbsp;&nbsp;Activate&nbsp;&nbsp;&nbsp;</a>
                                                            </td>
                                                <?php }
                                                  ?></tr></table></td>
                                           <?php }?>
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

    <script>
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#saveStationUserDetails_button').click(function(event) {


                var returntruthvalue=checkDuplicateEntryData_OnSaveNewUserDetails();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("USER Record With the (station,station Number) or Station Region and First Name,SurName AND ROLE exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate for OC.
                var hiddenvalue=$('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val();
               if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val("");  //Clear the field.
                   $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").focus();
                    return false;

               }






                //Check that Email is filled
               // var email=$('#useremail').val();
               // var filter= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
               // if (!filter.test(email)) {
                //    alert('Please provide a valid email address');
                //    $('#useremail').val("");  //Clear the field.
                //    $("#useremail").focus();
                //    return false;
              //  }




                //FOR MANAGER SELECT EITHER OC OR ZONAL OFFICER OR SENIOR ZONAL OFFICER
                var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();
                if(user_Role_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Role not picked");
                    $('#user_Role_AssignedBy_Manager').val("");  //Clear the field.
                    $("#user_Role_AssignedBy_Manager").focus();
                    return false;
                }
////////////////////////////////////////////////////////////////////////////////////////
                if(user_Role_AssignedBy_Manager=="OC"){
                //IF USER ROLE ASSIGNED BY MANAGER IS (OC)
                //Check that the a station Name is selected from the list.
                var user_station_Manager=$('#user_station_Manager').val();
                if(user_station_Manager==""){
                    alert("Please Select A Station from the list");
                    $('#user_station_Manager').val("");  //Clear the field.
                    $("#user_station_Manager").focus();
                    return false;

                }
                //Check that the a station Number is autofilled
                var user_stationNo_Manager=$('#user_stationNo_Manager').val();
                if(user_stationNo_Manager==""){
                    alert("Station Number not picked");
                    $('#user_stationNo_Manager').val("");  //Clear the field.
                    $("#user_stationNo_Manager").focus();
                    return false;

                }

                //HIDDEN TEXT FIELD
                //Check that the a station Region is autofilled
               // var user_stationRegion_Manager=$('#user_stationRegion_Manager').val();
               // if(user_stationRegion_Manager==""){
                //    alert("Station Region not picked");
                //    $('#user_stationRegion_Manager').val("");  //Clear the field.
                //    $("#user_stationRegion_Manager").focus();
                 //   return false;

               // }
                }else{
//////////////////////////////////////////////////////////////////////////////

                //IF USER ROLE ASSIGNED BY MANAGER IS (ZONAL  OFFICER AND SENIOR ZONAL OFFICER)
                var user_stationRegion_AssignedBy_Manager=$('#user_stationRegion_AssignedBy_Manager').val();
                if(user_stationRegion_AssignedBy_Manager=="" && user_Role_AssignedBy_Manager != 'SeniorDataOfficer' && user_Role_AssignedBy_Manager != 'DataOfficer' && user_Role_AssignedBy_Manager != 'ManagerStationNetworks'){  // returns true if the variable does NOT contain a valid number
                    alert("Station Region not picked");
                    $('#user_stationRegion_AssignedBy_Manager').val("");  //Clear the field.
                    $("#user_stationRegion_AssignedBy_Manager").focus();
                    return false;

                }

                }
//////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
                //FOR OC SELECT EITHER Observer,ObserverDataEntrant
                //Check that the a station Number is selected from the list of stations(Manager)
                var user_Role_AssignedBy_OC=$('#user_Role_AssignedBy_OC').val();
                if(user_Role_AssignedBy_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select User Roles");
                    $('#user_Role_AssignedBy_OC').val("");  //Clear the field.
                    $("#user_Role_AssignedBy_OC").focus();
                    return false;

                }
                if(user_Role_AssignedBy_OC=="Observer" || user_Role_AssignedBy_OC=="ObserverArchive" || user_Role_AssignedBy_OC=="ObserverDataEntrant"){
                //Check that the a station is autofilled
                var user_station_OC=$('#user_station_OC').val(); //ReadOnly
                if(user_station_OC==""){
                    alert("Station not picked");
                    $('#user_station_OC').val("");  //Clear the field.
                    $("#user_station_OC").focus();
                    return false;

                }
                //Check that the a station Number is autofilled
                var user_stationNo_OC=$('#user_stationNo_OC').val(); //ReadOnly
                if(user_stationNo_OC==""){
                    alert("Station Number not picked");
                    $('#user_stationNo_OC').val("");  //Clear the field.
                    $("#user_stationNo_OC").focus();
                    return false;

                }
                //Check that the a station Region is autofilled
               // var user_stationRegion_OC=$('#user_stationRegion_OC').val(); //ReadOnly
               // if(user_stationRegion_OC==""){
                 //   alert("Station Region not picked");
                 //   $('#user_stationRegion_OC').val("");  //Clear the field.
                 //   $("#user_stationRegion_OC").focus();
                 //   return false;

             //   }
                }

            });
        });
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnSaveNewUserDetails(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var firstname = $('#user_firstname').val();
            //alert(firstname);
            //return false;
            var surname = $('#user_surname').val();
           // var username=firstname
            var email = $('#user_email').val();


            var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();
            var user_Role_AssignedBy_OC=$('#user_Role_AssignedBy_OC').val();


            if(user_Role_AssignedBy_Manager=="OC"){

                var stationName_Manager = $('#user_station_Manager').val();
                var stationNumber_Manager = $('#user_stationNo_Manager').val();
            }

            if(user_Role_AssignedBy_OC=="Observer" || user_Role_AssignedBy_OC=="ObserverArchive" || user_Role_AssignedBy_OC=="ObserverDataEntrant" ){
            var stationName_OC = $('#user_station_OC').val();
            var stationNumber_OC = $('#user_stationNo_OC').val();
            }

            // stationName;
            // stationNumber;


            if((stationName_Manager!=undefined)&&(stationNumber_Manager!=undefined)){

               var  stationName=stationName_Manager;
               var  stationNumber=  stationNumber_Manager;

            }else if((stationName_OC!=undefined)&&(stationNumber_OC!=undefined)){


               var  stationName=stationName_OC;
              var  stationNumber=  stationNumber_OC;
            }

            if((stationName==undefined)&& (stationNumber==undefined) ){

                 stationName="null";
                 stationNumber="null";
            }

           // var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();

            if(user_Role_AssignedBy_Manager=="ZonalOfficer" || user_Role_AssignedBy_Manager=="SeniorZonalOfficer" ){

                var user_stationRegion_AssignedBy_Manager=$('#user_stationRegion_AssignedBy_Manager').val();
                var stationRegion=user_stationRegion_AssignedBy_Manager;
            }

            if(stationRegion==undefined){

                 stationRegion="null";

            }

            if(user_Role_AssignedBy_Manager!=undefined){

                var userRole=user_Role_AssignedBy_Manager;
            }else if(user_Role_AssignedBy_OC!=undefined){

                var userRole=user_Role_AssignedBy_OC;
            }

          // alert(stationName);
           // return false;

            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val("");

            if ((firstname != undefined) && (surname != undefined) && (email != undefined) && (userRole!=undefined)) {
                //alert("StationName  "+stationName+ "StationNumber "+stationNumber+"  StationRegion"+stationRegion);
                //alert(firstname+surname+email);
                // return false;
              // if((stationName=="") || (stationName != undefined) ||   (stationNumber=="") || (stationNumber!=undefined) ||(stationRegion=="")  ||(stationRegion!=undefined)){
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Users/checkInDBIfUserDetailsRecordExistsAlready",
                    type: "POST",
                    data:{'firstname':firstname,'surname':surname,'email':email,'stationName': stationName,'stationNumber':stationNumber,'stationRegion':stationRegion,'userRole':userRole},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').empty();

                           //  alert(data);
                           // return false;
                            $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').empty();

                            //alert(data);
                           // return false;
                            $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val();
             //  }
            }//end of if

            else if((firstname == undefined) || (surname == undefined) ||  (email == undefined)  ){

                var truthvalue="Missing";
            }

            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnSaveNewUserDetails2(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var firstname = $('#user_firstname').val();
            //alert(firstname);
            //return false;
            var surname = $('#user_surname').val();
            // var username=firstname
            var email = $('#user_email').val();

            var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();

            if(user_Role_AssignedBy_Manager=="ZonalOfficer" || user_Role_AssignedBy_Manager=="SeniorZonalOfficer" ){

                var user_stationRegion_AssignedBy_Manager=$('#user_stationRegion_AssignedBy_Manager').val();
                var stationRegion=user_stationRegion_AssignedBy_Manager;
            }


            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2').val("");

            if ((firstname != undefined) && (surname != undefined)  && (stationRegion != undefined) && (email != undefined)  ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Users/checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion",
                    type: "POST",
                    data:{'firstname':firstname,'surname':surname,'email':email,'stationRegion': stationRegion},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2').empty();

                            //alert(data);
                            //return false;
                            $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2').empty();

                            //alert(data);
                            $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2").val();

            }//end of if

            else if((firstname == undefined) || (surname == undefined) || (stationRegion == undefined)  || (email == undefined) ){

                var truthvalue="Missing";
            }

            return truthvalue;
            //alert(truthvalue);
            // return false;

        }//end of check duplicate values in the DB


    </script>


    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#updateStationUserDetails_button').click(function(event) {




                //Check that id of the row is picked
                var rowid=$('#id').val();
                if(rowid==""){  // returns true if the variable does NOT contain a valid number
                    alert("Row id not picked");
                    $('#id').val("");  //Clear the field.
                    $("#id").focus();
                    return false;

                }


                //Check that Email is filled
                //Check that Email is filled
                var email=$('#email').val();
                var filter= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!filter.test(email)) {
                    alert('Please provide a valid email address');
                    $('#email').val("");  //Clear the field.
                    $("#email").focus();
                    return false;

                }


                //FOR MANAGER SELECT EITHER OC OR ZONAL OFFICER OR SENIOR ZONAL OFFICER
                var Role_AssignedBy_Manager=$('#Role_AssignedBy_Manager').val();
                if(Role_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Role not picked");
                    $('#Role_AssignedBy_Manager').val("");  //Clear the field.
                    $("#Role_AssignedBy_Manager").focus();
                    return false;

                }
                if(Role_AssignedBy_Manager=="OC"){
////////////////////////////////////////////////////////////////////////////////////////
                //IF USER ROLE ASSIGNED BY MANAGER IS (OC)
                //Check that the a station Name is selected from the list.
                var station_Manager=$('#station_Manager').val();
                if(station_Manager==""){
                    alert("Please Select A Station from the list");
                    $('#station_Manager').val("");  //Clear the field.
                    $("#station_Manager").focus();
                    return false;

                }
                //Check that the a station Number is autofilled
                var stationNo_Manager=$('#stationNo_Manager').val();
                if(stationNo_Manager==""){
                    alert("Station Number not picked");
                    $('#stationNo_Manager').val("");  //Clear the field.
                    $("#stationNo_Manager").focus();
                    return false;

                }
                //HIDDEN TEXT FIELD
                //Check that the a station Region is autofilled
                var stationRegion_Manager=$('#stationRegion_Manager').val();
                if(stationRegion_Manager==""){
                    alert("Station Region not picked");
                    $('#stationRegion_Manager').val("");  //Clear the field.
                    $("#stationRegion_Manager").focus();
                    return false;

                }
                }else{
//////////////////////////////////////////////////////////////////////////////

                //IF USER ROLE ASSIGNED BY MANAGER IS (ZONAL  OFFICER AND SENIOR ZONAL OFFICER)
                var stationRegion_AssignedBy_Manager=$('#stationRegion_AssignedBy_Manager').val();
                if(stationRegion_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Region not picked");
                    $('#stationRegion_AssignedBy_Manager').val("");  //Clear the field.
                    $("#stationRegion_AssignedBy_Manager").focus();
                    return false;

                }
                }
//////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
                //FOR OC SELECT EITHER Observer,ObserverDataEntrant
                //Check that the a station Number is selected from the list of stations(Manager)
                var Role_AssignedBy_OC=$('#Role_AssignedBy_OC').val();
                if(Role_AssignedBy_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select User Roles");
                    $('#Role_AssignedBy_OC').val("");  //Clear the field.
                    $("#Role_AssignedBy_OC").focus();
                    return false;

                }
                if(Role_AssignedBy_OC=="Observer" || Role_AssignedBy_OC=="ObserverDataEntrant" || Role_AssignedBy_OC=="ObserverArchive" ){
                //Check that the a station is selected
                var station_OC=$('#station_OC').val(); //ReadOnly
                if(station_OC==""){
                    alert("Station not picked");
                    $('#station_OC').val("");  //Clear the field.
                    $("#station_OC").focus();
                    return false;

                }
                //Check that the a station Number is autofilled
                var stationNo_OC=$('#stationNo_OC').val(); //ReadOnly
                if(stationNo_OC==""){
                    alert("Station Number not picked");
                    $('#stationNo_OC').val("");  //Clear the field.
                    $("#stationNo_OC").focus();
                    return false;

                }
                //Check that the a station Region is autofilled
                var stationRegion_OC=$('#stationRegion_OC').val(); //ReadOnly
                if(stationRegion_OC==""){
                    alert("Station Region not picked");
                    $('#stationRegion_OC').val("");  //Clear the field.
                    $("#stationRegion_OC").focus();
                    return false;

                }
                }


            }); //button
            //  return false;

        });  //document
    </script>
    <script type="text/javascript">
        //Once the Manager selects the Roles.When OC role is selected.Then activate the Station Name select field.
        //Once the Manager selects Zonal Officer/Senior Zonal Officer Role the Activate the Station Region select Field
        // For Add User

        $(document.body).on('change','#user_Role_AssignedBy_Manager',function(){

            var UserRoleValue_Selected = this.value;
            if (UserRoleValue_Selected == "ZonalOfficer" || UserRoleValue_Selected == "SeniorZonalOfficer" ) {
                $('#user_station_Manager').attr('disabled', true);
                $('#user_station_Manager').val('');
                $('#user_stationNo_Manager').attr('disabled', true);
                $('#user_stationNo_Manager').val('');

                $('#user_station_Manager').attr('required', false);
                $('#user_stationNo_Manager').attr('required', false);
                $('#user_stationRegion_AssignedBy_Manager').attr('readonly', false);
                $('#user_stationRegion_AssignedBy_Manager').attr('disabled', false);  //Enforce the readOnly Attribute
                $('#user_stationRegion_AssignedBy_Manager').attr('required', true); //Enforce the required select text field

            }else if ( UserRoleValue_Selected == "ManagerData"  ||   UserRoleValue_Selected == "ManagerStationNetworks" || UserRoleValue_Selected == "DataOfficer" || UserRoleValue_Selected == "SeniorDataOfficer") {
              $('#user_station_Manager').attr('disabled', true);
              $('#user_station_Manager').val('');
              $('#user_stationNo_Manager').attr('disabled', true);
              $('#user_stationNo_Manager').val('');
              $('#user_stationRegion_AssignedBy_Manager').attr('disabled', true);
              $('#user_stationRegion_AssignedBy_Manager').val('');

              $('#user_station_Manager').attr('required', false);
              $('#user_stationNo_Manager').attr('required', false);
              $('#user_stationRegion_AssignedBy_Manager').attr('required', false);


            }
            else{
                //Activate all
                $('#user_station_Manager').attr('disabled', false);
                $('#user_stationNo_Manager').attr('disabled', false);
                $('#user_station_Manager').attr('required', true);
                $('#user_stationNo_Manager').attr('required', true);
                $('#user_stationRegion_AssignedBy_Manager').attr('disabled', true);  //Enforce the readOnly Attribute
                $('#user_stationRegion_AssignedBy_Manager').attr('required', false); //Enforce the required select text field

            }


        })

    </script>
    <script type="text/javascript">
        //Once the Manager selects the Roles.When OC role is selected.Then activate the Station Name select field.
        //Once the Manager selects Zonal Officer/Senior Zonal Officer Role the Activate the Station Region select Field
        // For Update User

        $(document.body).on('change','#Role_AssignedBy_Manager',function(){

            var RoleValue_Selected = this.value;


            if (RoleValue_Selected == "OC") {
                //Activate the select for Stations by removing the readOnly Attribute
                $('#station_Manager').attr('readonly', false);
                // Then Enforce the required select text field
                $('#station_Manager').attr('required', true);




                //Make Zonal Officer and Senior Zonal Officer,Select Region readOnly
                $('#stationRegion_AssignedBy_Manager').attr('readonly', true);  //Enforce the readOnly Attribute
                $('#stationRegion_AssignedBy_Manager').attr('required', false); //Enforce the required select text field



            }
            else if(RoleValue_Selected == "ZonalOfficer" || RoleValue_Selected == "SeniorZonalOfficer"){

                //Activate the select Region by removing the readOnly Attribute
                $('#stationRegion_AssignedBy_Manager').attr('readonly', false);
                // Then Enforce the required select text field
                $('#stationRegion_AssignedBy_Manager').attr('required', true); //Enforce the required select text field




                //Make OC Select Stations ReadOnly
                $('#station_Manager').attr('readonly', true);  //Enforce the readOnly Attribute
                $('#station_Manager').attr('required', false);  //Enforce the required select text field


            }else if(RoleValue_Selected == ""){

                //Make OC Select Stations ReadOnly
                $('#station_Manager').attr('readonly', true);  //Enforce the readOnly Attribute


                //Make Zonal Officer and Senior Zonal Officer,Select Region readOnly
                $('#stationRegion_AssignedBy_Manager').attr('readonly', true);  //Enforce the readOnly Attribute

            }


        })

    </script>
    <script type="text/javascript">
        //Once the Manager loads the page the value of Selected Role is displayed.
        //So Enforce the Station Select Required or Station Region Required
        //On Update User
        var role_AssignedBy_Manager = $("#Role_AssignedBy_Manager").val();


        if (role_AssignedBy_Manager != "") {
            if (role_AssignedBy_Manager == "OC") {
                //Activate the select for Stations by removing the readOnly Attribute
                $('#station_Manager').attr('readonly', false);
                // Then Enforce the required select text field
                $('#station_Manager').attr('required', true);




                //Make Zonal Officer and Senior Zonal Officer,Select Region readOnly
                $('#stationRegion_AssignedBy_Manager').attr('readonly', true);  //Enforce the readOnly Attribute
                $('#stationRegion_AssignedBy_Manager').attr('required', false); //Enforce the required select text field



            }
            else if(role_AssignedBy_Manager == "ZonalOfficer" || role_AssignedBy_Manager == "SeniorZonalOfficer"){

                //Activate the select Region by removing the readOnly Attribute
                $('#stationRegion_AssignedBy_Manager').attr('readonly', false);
                // Then Enforce the required select text field
                $('#stationRegion_AssignedBy_Manager').attr('required', true); //Enforce the required select text field




                //Make OC Select Stations ReadOnly
                $('#station_Manager').attr('readonly', true);  //Enforce the readOnly Attribute
                $('#station_Manager').attr('required', false);  //Enforce the required select text field


            }

        }

        else {


        }
    </script>

    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number, should be picked from the DB.
        // For Add User when user is OC
        $(document).on('change','#user_station_Manager',function(){
            $('#user_stationNo_Manager').val("");  //Clear the field.
            

            var stationName = this.value;
            if (stationName != "") {
                //alert(station);
                $('#user_stationNo_Manager').val("");

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

                            $('#user_stationNo_Manager').empty();
                            $('#user_stationId_Manager').empty();

                             //alert(data);
                            $("#user_stationNo_Manager").val(json[0].StationNumber);
                            $("#user_stationId_Manager").val(json[0].station_id);
                            $("#user_stationRegion_AssignedBy_Manager").val(json[0].StationRegion);



                        }
                        else{

                            $('#user_stationNo_Manager').empty();
                            $('#user_stationNo_Manager').val("");
                            $('#user_stationRegion_AssignedBy_Manager').empty();
                            $('#user_stationRegion_AssignedBy_Manager').val("");
                            



                        }
                    }

                });



            }
            else {
                $('#user_stationNo_Manager').empty();
                $('#user_stationNo_Manager').val("");

            }

        })
    </script>
    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number, should be picked from the DB.
        // For Update User when user is OC
        $(document).on('change','#station_Manager',function(){
            $('#stationNo_Manager').val("");  //Clear the field.

            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNo_Manager').val("");

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

                            $('#stationNo_Manager').empty();


                            // alert(data);
                            $("#stationNo_Manager").val(json[0].StationNumber);
                            $("#stationid").val(json[0].station_id);
                            $("#stationRegion_AssignedBy_Manager").val(json[0].StationRegion);


                        }
                        else{

                            $('#stationNo_Manager').empty();
                            $('#stationNo_Manager').val("");



                        }
                    }

                });



            }
            else {
                $('#stationNo_Manager').empty();
                $('#stationNo_Manager').val("");

            }

        })
    </script>

    <script type="text/javascript">
        //The Manager  Station is autopopulated on Update User(OC).The Station Number  shd be picked frm DB
        //Update User for OC
        var stationName =  $('#station_Manager').val();
        var roleName =  $('#Role_AssignedBy_Manager').val();
      //  $('#stationNo_Manager').html('');//Clear the field.

        if (stationName != "" && roleName != 'ZonalOfficer' && roleName != 'SeniorZonalOfficer') {
            //alert(station);
            $('#stationNo_Manager').val("");

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

                        $('#stationNo_Manager').empty();


                        // alert(data);
                        $("#stationNo_Manager").val(json[0].StationNumber);
                          $("#stationid").val(json[0].station_id);
                          $("#stationRegion_AssignedBy_Manager").val(json[0].StationRegion);



                    }
                    else{

                        $('#stationNo_Manager').empty();
                        $('#stationNo_Manager').val("");
                        $('#stationRegion_AssignedBy_Manager').empty();
                        $('#stationRegion_AssignedBy_Manager').val("");


                    }
                }

            });



        }
        else if(roleName == 'ZonalOfficer' || roleName == 'SeniorZonalOfficer'){
            var zonalnumber = <?php echo $this->uri->segment(3);?>;
            $.ajax({
                url: "<?php echo base_url(); ?>"+"index.php/Stations/getZonalRegion",
                type: "POST",
                data: {'zonalnumber': zonalnumber},
                cache: false,
                //dataType: "JSON",
                success: function(data){
                    if (data)
                    {
                        var json = JSON.parse(data);

                       // $('#stationNo_Manager').empty();


                        // alert(data);
                        //$("#stationNo_Manager").val(json[0].StationNumber);
                          //$("#stationid").val(json[0].station_id);
                          $("#stationRegion_AssignedBy_Manager").val(json[0].region_zone);



                    }
                    else{

                        //$('#stationNo_Manager').empty();
                        //$('#stationNo_Manager').val("");
                        $('#stationRegion_AssignedBy_Manager').empty();
                        $('#stationRegion_AssignedBy_Manager').val("");


                    }
                }

            });
        }

        else if(roleName == 'ManagerStationNetworks'||roleName == 'DataOfficer' || roleName == 'SeniorDataOfficer'){
            //alert('hey');
            $('#stationRegion_AssignedBy_Manager').empty();
            $('#stationRegion_AssignedBy_Manager').val("");
            $('#station_Manager').attr('readonly', true);  //Enforce the readOnly Attribute

            $('#station_Manager').empty();
            $('#station_Manager').val("");
            
        }
        
        else {
            
           // $('#stationNo_Manager').empty();
           // $('#stationNo_Manager').val("");
           // $('#stationRegion_AssignedBy_Manager').empty();
           // $('#stationRegion_AssignedBy_Manager').val("");


        }
    </script>
    <script type="text/javascript">
        //The OC  Station is autopopulated on Update User.The Station Number and Station Region shd be picked frm DB
        //Add User
        var stationName =  $('#user_station_OC').val();
        $('#user_stationNo_OC').html('');//Clear the field.
       

        if (stationName != "") {
            //alert(station);
            $('#user_stationNo_OC').val("");

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

                        $('#user_stationNo_OC').empty();
                        $('#user_stationRegion_AssignedBy_Manager').empty();

                        //alert(data);
                        $("#user_stationNo_OC").val(json[0].StationNumber);
                        $("#user_stationRegion_AssignedBy_Manager").val(json[0].StationRegion);
                        



                    }
                    else{

                        $('#user_stationNo_OC').empty();
                        $('#user_stationNo_OC').val("");



                    }
                }

            });



        }
        else {

            $('#user_stationNo_OC').empty();
            $('#user_stationNo_OC').val("");


        }


    </script>

    <script type="text/javascript">
        //The OC  Station is autopopulated on Update User.The Station Number and Station Region shd be picked frm DB
        //Update User
        var stationName =  $('#station_OC').val();
        $('#stationNo_OC').html('');//Clear the field.
        if (stationName != "") {
            //alert(station);
            $('#stationNo_OC').val("");

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

                        $('#stationNo_OC').empty();


                        // alert(data);
                        $("#stationNo_OC").val(json[0].StationNumber);


                    }
                    else{

                        $('#stationNo_OC').empty();
                        $('#stationNo_OC').val("");



                    }
                }

            });



        }
        else {

            $('#stationNo_OC').empty();
            $('#stationNo_OC').val("");


        }


    </script>

<?php require_once(APPPATH . 'views/footer.php'); ?>
