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
                                <input type="text" name="userfirstname" id="userfirstname" onkeyup="allowCharactersInputOnly(this)"   required class="form-control"   placeholder="Enter user's name">
                                <input type="hidden" name="checkduplicateEntryOnAddUserStationInformation_hiddentextfield" id="checkduplicateEntryOnAddUserStationInformation_hiddentextfield">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">SurName</span>
                                <input type="text" name="usersurname"  id="usersurname" onkeyup="allowCharactersInputOnly(this)"  required class="form-control"    placeholder="Enter user's name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> User Email</span>
                                <input type="email" name="useremail" id="useremail" required class="form-control"  placeholder="Enter user's email">
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">User Phone</span>
                                <input type="text" name="userphone" id="userphone" onkeyup="allowIntegerInputOnly(this)" required class="form-control"  placeholder="Enter user's contact ">
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-6">



                        <?php

                        if($userrole=='OC'){ ?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <input type="text" name="userstation_OC" id="userstation_OC" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="userstationNo_OC" id="userstationNo_OC" required class="form-control"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> User Role</span>
                                    <select name="userRoles_AssignedBy_OC"  id="userRoles_AssignedBy_OC"  required class="form-control" placeholder="Select Role">
                                        <option value="">--Select User Options--</option>

                                        <option value="Observer">Observer</option>
                                        <option value="ObserverArchive">ObserverArchive</option>
                                        <option value="ObserverDataEntrant">ObserverDataEntrant</option>

                                    </select>
                                </div>
                            </div>



                        <?php } elseif($userrole=='Manager'){?>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="userstation_Manager" id="userstation_Manager"  required class="form-control" placeholder="Select Station">
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
                                    <input type="text" name="userstationNo_Manager" id="userstationNo_Manager" required class="form-control"  readonly class="form-control" value="" readonly="readonly" >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> User Role</span>
                                    <select name="userRoles_AssignedBy_Manager"  id="userRoles_AssignedBy_Manager"  required class="form-control" placeholder="Select Role">
                                        <option value="">--Select User Options--</option>

                                        <option value="OC">OC</option>


                                    </select>
                                </div>
                            </div>





                        <?php } ?>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo base_url(); ?>index.php/Users/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                    <button type="submit" id="saveStationUserDetails_button" name="saveStationUserDetails_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add User</button>
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
                                    <input type="text" name="firstname" id="firstname" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required value="<?php echo $userdetails->FirstName;?>" placeholder="Enter staff's name" readonly class="form-control">
                                    <input type="hidden" name="id" value="<?php echo $userdetails->Userid;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">SurName</span>
                                    <input type="text" name="surname" id="surname" onkeyup="allowCharactersInputOnly(this)" required class="form-control" value="<?php echo $userdetails->SurName;?>" placeholder="Enter staff's email" readonly class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Email</span>
                                    <input type="email" name="email" id="email" required class="form-control" value="<?php echo $userdetails->UserEmail;?>" placeholder="Enter user's email " readonly class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Phone</span>
                                    <input type="text" name="contact" id="contact" required class="form-control" value="<?php echo $userdetails->UserPhone;?>" placeholder="Enter Phone " readonly class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <?php if($userrole=="OC"){ ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="station_OC"  id="station_OC" required class="form-control" value="<?php echo $userdetails->UserStation;?>"  readonly class="form-control" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="text" name="stationNo_OC" id="stationNo_OC" required class="form-control"  value="<?php echo $userdetails->StationNumber;?>" readonly class="form-control" value="" readonly="readonly" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="Role_AssignedBy_OC"  id="Role_AssignedBy_OC"  required class="form-control" placeholder="Select Role">
                                            <option value="<?php echo $userdetails->UserRole;?>"><?php echo $userdetails->UserRole;?></option>
                                            <option value="">--Select User Options--</option>

                                            <option value="Observer">Observer</option>
                                            <option value="ObserverArchive">ObserverArchive</option>
                                            <option value="ObserverDataEntrant">ObserverDataEntrant</option>

                                        </select>
                                    </div>
                                </div>



                            <?php }elseif($userrole=="Manager"){ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station</span>
                                        <select name="station_Manager"  id="station_Manager" required class="form-control" placeholder="Select Station">
                                            <option value="<?php echo $userdetails->UserStation;?>"><?php echo $userdetails->UserStation;?></option>
                                            <option value="">--Select Stations--</option>
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
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="Role_AssignedBy_Manager"  id="Role_AssignedBy_Manager"  required class="form-control" placeholder="Select Role">
                                            <option value="<?php echo $userdetails->UserRole;?>"><?php echo $userdetails->UserRole;?></option>

                                            <option value="">--Select User Options--</option>



                                            <option value="ObserverDataEntrant">OC</option>

                                        </select>
                                    </div>
                                </div>

                            <?php }?>






                        </div>

                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a  href="<?php echo base_url(); ?>index.php/Users/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updateStationUserDetails_button" id="updateStationUserDetails_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update User</button>
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
                    <div class="box-header">
                        <h3 class="box-title">Stations</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>First Name</th>
                                <th>SurName</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Station</th>
                                <th>Station Number</th>
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
                                        <td ><?php echo $userdetails->UserStation;?></td>
                                        <td ><?php echo $userdetails->StationNumber;?></td>
                                        <td><?php echo $userdetails->UserRole;?></td>
                                        <?php if($userrole=='Manager'|| $userrole=='OC'){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/Users/DisplayStationUsersFormForUpdate/" .$userdetailsid ;?>" style="cursor:pointer;">Edit</a>
                                         <!--   or <a href="<?php echo base_url() . "index.php/Users/deleteUser/" .$userdetailsid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $userdetailsid->FirstName.' '.$userdetailsid->SurName;?>');">Delete</a></td><?php }?> -->
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

                    alert("USER Record With the station,station Number and First Name and Sruname exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }





                //Check that Email is filled
                var email=$('#useremail').val();
                var filter= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!filter.test(email)) {
                    alert('Please provide a valid email address');
                    $('#useremail').val("");  //Clear the field.
                    $("#useremail").focus();
                    return false;
                }


                //Check that the a station is selected frManagere list of stations(Admin)
                var userstationManager=$('#userstation_Manager').val();
                if(userstationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#userstation_Manager').val("");  //Clear the field.
                    $("#userstation_Manager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var userstationNoManager=$('#userstationNo_Manager').val();
                if(userstationNoManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#userstationNo_Manager').val("");  //Clear the field.
                    $("#userstationNo_Manager").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var userstationOC=$('#userstation_OC').val();
                if(userstationOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#userstation_OC').val("");  //Clear the field.
                    $("#userstation_OC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var userstationNoOC=$('#userstationNo_OC').val();
                if(userstationNoOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#userstationNo_OC').val("");  //Clear the field.
                    $("#userstationNo_OC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var userRoles_AssignedBy_Manager=$('#userRoles_AssignedBy_Manager').val();
                if(userRoles_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select User Roles");
                    $('#userRoles_AssignedBy_Manager').val("");  //Clear the field.
                    $("#userRoles_AssignedBy_Manager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var userRoles_AssignedBy_OC=$('#userRoles_AssignedBy_OC').val();
                if(userRoles_AssignedBy_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select User Roles");
                    $('#userRoles_AssignedBy_OC').val("");  //Clear the field.
                    $("#userRoles_AssignedBy_OC").focus();
                    return false;

                }


            });
        });
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnSaveNewUserDetails(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var firstname = $('#userfirstname').val();
            var surname = $('#usersurname').val();
            var email = $('#useremail').val();
            var stationName_OC = $('#userstation_OC').val();
            var stationNumber_OC = $('#userstationNo_OC').val();


            var stationName_Manager = $('#userstation_Manager').val();
            var stationNumber_Manager = $('#userstationNo_Manager').val();


            if((stationName_Manager!=undefined)&&(stationNumber_Manager!=undefined)){

                var stationName=stationName_Manager;
                var stationNumber=  stationNumber_Manager;

            }else if((stationName_OC!=undefined)&&(stationNumber_OC!=undefined)){


                var stationName=stationName_OC;
                var stationNumber=  stationNumber_OC;
            }

            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val("");

            if ((firstname != undefined) && (surname != undefined) && (stationName != undefined) && (stationNumber != undefined) && (email != undefined)  ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Users/checkInDBIfUserDetailsRecordExistsAlready",
                    type: "POST",
                    data:{'firstname':firstname,'surname':surname,'email':email,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').empty();

                             //alert(data);
                            $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val();

            }//end of if

            else if((firstname == undefined) || (surname == undefined) || (stationName == undefined) || (stationNumber == undefined) || (email == undefined) ){

                var truthvalue="Missing";
            }




            return truthvalue;



        }//end of check duplicate values in the DB


    </script>


    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#updateStationUserDetails_button').click(function(event) {
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


                //Check that the a station is selected from the list Managerations(Admin)
                var stationManager=('#station_Manager').val();
                if(stationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#station_Manager').val("");  //Clear the field.
                    $("#stationManager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoManager=$('#stationNo_Manager').val();
                if(stationNoManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_Manager').val("");  //Clear the field.
                    $("#stationNo_Manager").focus();
                    return false;

                }
/////////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the a station is selected from the list of stations(Manager)
                var stationOC=$('#station_OC').val();
                if(stationOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_OC').val("");  //Clear the field.
                    $("#station_OC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoOC=$('#stationNo_OC').val();
                if(stationNoOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_OC').val("");  //Clear the field.
                    $("#stationNo_OC").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the a station Number is selected from the list of stations(Manager)
                var Role_AssignedBy_Manager=$('#Role_AssignedBy_Manager').val();
                if(Role_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select User Roles");
                    $('#Role_AssignedBy_Manager').val("");  //Clear the field.
                    $("#Role_AssignedBy_Manager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var Role_AssignedBy_OC=$('#Role_AssignedBy_OC').val();
                if(Role_AssignedBy_OC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select User Roles");
                    $('#Role_AssignedBy_OC').val("");  //Clear the field.
                    $("#Role_AssignedBy_OC").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////



            }); //button
            //  return false;

        });  //document
    </script>
    <script type="text/javascript">
        //Once the Admin selects the Station the Station Number should be picked from the DB.
        // For Add Update Daily
        $(document).on('change','#userstation_Manager',function(){
            $('#userstationNo_Manager').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#userstationNo_Manager').val("");
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

                            $('#userstationNo_Manager').empty();

                            // alert(data);
                            $("#userstationNo_Manager").val(json[0].StationNumber);

                        }
                        else{

                            $('#userstationNo_Manager').empty();
                            $('#userstationNo_Manager').val("");

                        }
                    }

                });



            }
            else {

                $('#userstationNo_Manager').empty();
                $('#userstationNo_Manager').val("");
            }

        })
    </script>

<?php require_once(APPPATH . 'views/footer.php'); ?>