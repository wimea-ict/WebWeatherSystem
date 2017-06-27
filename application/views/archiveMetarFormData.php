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
           Archive Metar Form
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Archive Metar Form</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewarchivemetarform) && count($displaynewarchivemetarform)) {
        ?>
        <div class="row">
        <form action='<?= base_url(); ?>index.php/ArchiveMetarFormData/insertAchiveMetarForm/' method="post" enctype="multipart/form-data">
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
                    <span class="input-group-addon">Select Date</span>
                    <input type="text" name="date_archivemetarformdata" required class="form-control" placeholder="Enter select date" id="date">
                    <input type="hidden" name="checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield" id="checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield">
                </div>
            </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Station Name</span>
                        <input type="text" name="station_archivemetarformdata" id="station_archivemetarformdata" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Station Number</span>
                        <input type="text" name="stationNo_archivemetarformdata" required class="form-control" id="stationNo_archivemetarformdata" readonly  value="<?php echo $userstationNo;?>" readonly="readonly" >
                    </div>
                </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TIME</span>
                    <select name="time_archivemetarformdata" id="time_archivemetarformdata"  required class="form-control">
                        <option value="">--Select TIME Options--</option>
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
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Metar/Speci</span>
                    <select name="metarspeci_archivemetarformdata" id="metarspeci_archivemetarformdata" required class="form-control">
                        <option value="">--Select Options--</option>
                        <option value="METAR">METAR</option>
                        <option value="SPECI">SPECI</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">CCCC</span>
                    <input type="text" name="cccc_archivemetarformdata" id="cccc_archivemetarformdata" onkeyup="allowCharactersInputOnly(this)" required class="form-control" required placeholder="CCCC" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">YYGGgg</span>
                    <input type="text" name="yyGGgg_archivemetarformdata" id="yyGGgg_archivemetarformdata"  required class="form-control" required placeholder="YYGGgg" >

                </div>
            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Dddff/fm/fm</span>
                    <input type="text" name="dddfffmfm_archivemetarformdata" id="dddfffmfm_archivemetarformdata"  required class="form-control" required placeholder="Dddff/fm/fm" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">VVVV or COVAK</span>
                    <input type="text" name="wwcovak_archivemetarformdata" id="wwcovak_archivemetarformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder=" Enter VVVV or COVAK" >
                </div>
            </div>


        </div>
        <div class="col-lg-6">

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">W1W1</span>
                     <input type="text" name="w1w1_archivemetarformdata" id="w1w1_archivemetarformdata"   class="form-control" placeholder=" Enter W1W1 ">
                   <!-- <select name="w1w1_archivemetarformdata" id="w1w1_archivemetarformdata"   required class="form-control">
                        <option value="">--Select Options--</option>
                        <option value="RA">RA</option>
                        <option value="Fg">Fg</option>
                        <option value="Hz">Hz </option>

                        <option value="Ts">Ts</option>
                    </select> -->
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">N1CCh1h1NnCChhhNhCChhh</span>
                    <input type="text" name="ncc_archivemetarformdata" id="ncc_archivemetarformdata"   class="form-control" placeholder=" Enter N1CCh1h1NnCChhhNhCChhh " >
                </div>
            </div>




            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TT/TdTd</span>
                    <input type="text" name="tttdtd_archivemetarformdata" id="tttdtd_archivemetarformdata"     required class="form-control"  required placeholder="Enter TT/TdTd" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">QNH(hpa)</span>
                    <input type="text" name="qnhhpa_archivemetarformdata"  id="qnhhpa_archivemetarformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="QNH(hpa)" id="qnhhpa">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">QNH(in)</span>
                    <input type="text" name="qnhin_archivemetarformdata"  id="qnhin_archivemetarformdata" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="QNH(in)" id="qnhin">
                </div>
            </div>




            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">QFE(hpa)</span>
                    <input type="text" name="qfehpa_archivemetarformdata" id="qfehpa_archivemetarformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder=" Enter QFE(hpa)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">QFE(in)</span>
                    <input type="text" name="qfein_archivemetarformdata"  id="qfein_archivemetarformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder=" Enter QFE(in)" >
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">RE W1W1</span>
                    <input type="text" name="rew1w1_archivemetarformdata"  id="rew1w1_archivemetarformdata" onkeyup="allowCharactersInputOnly(this)"  class="form-control"  placeholder=" Enter QFE(in)" >


                     </div>
            </div>

        </div>
        <div class="clearfix"></div>
        </div>

        <div class="modal-footer clearfix">

            <a href="<?= base_url(); ?>index.php/ArchiveMetarForm/" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

            <button type="submit" id="postarchivemetarformdata_button" name="postarchivemetarformdata_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Save  New Archive metar Form</button>
        </div>
        </form>
        </div>
    <?php
    }elseif((is_array($archivemetarformdataid) && count($archivemetarformdataid))) {
        foreach($archivemetarformdataid as $metadataform){

            $metadataformid = $metadataform->id;
            ?>
            <div class="row">
            <form action='<?= base_url(); ?>index.php/ArchiveMetarFormData/updateArchiveMetarFormData' method="post" enctype="multipart/form-data">
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
                        <span class="input-group-addon">Select Date</span>
                        <input type="text" name="date" class="form-control" value="<?php echo $metadataform->Date;?>" placeholder="Enter select date" id="expdate">
                          <input type="hidden" name="id" value="<?php echo $metadataform->id;?>">
                    </div>
                </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Station</span>
                            <input type="text" name="station" id="station" required class="form-control" value="<?php echo $metadataform->StationName;?>"  readonly class="form-control" >

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> Station Number</span>
                            <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $metadataform->StationNumber;?>" readonly="readonly" >
                        </div>
                    </div>





                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">METAR/SPECI</span>
                        <select name="metarspeci" id="metarspeci"  required class="form-control">
                            <option value="<?php echo $metadataform->METARSPECI;?>"> <?php echo $metadataform->METARSPECI;?></option>
                            <option value="">Select Options</option>
                            <option value="METAR">METAR</option>
                            <option value="SPECI">SPECI</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">CCCC</span>
                        <input type="text" name="cccc" id="cccc" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" value="<?php echo $metadataform->CCCC;?>" required placeholder="CCCC" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">YYGGgg</span>
                        <input type="text" name="yyGGgg" id="yyGGgg"   required class="form-control" value="<?php echo $metadataform->YYGGgg;?>" required placeholder="YYGGgg" >

                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TIME</span>
                        <input type="text" name="timeRecorded" id="timeRecorded"   required class="form-control" value="<?php echo $metadataform->TIME;?>" required placeholder="time" readonly="readonly" >



                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Dddff/fm/fm</span>
                        <input type="text" name="dddfffmfm" id="dddfffmfm"   required class="form-control" required value="<?php echo $metadataform->Dddfffmfm;?>" placeholder="Dddfffmfm" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">WW or COVAK</span>
                        <input type="text" name="wwcovak" id="wwcovak"  onkeyup="allowIntegerInputOnly(this)" required class="form-control" value="<?php echo $metadataform->WWorCOVAK;?>" placeholder="WW or COVAK" >
                    </div>
                </div>


            </div>
            <div class="col-lg-6">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">W1W1</span>
                        <input type="text" name="w1w1" id="w1w1"   class="form-control" value="<?php echo $metadataform->W1W1;?>" placeholder="W1W1 ">

                       <!-- <select name="w1w1" id="w1w1"   required class="form-control">
                            <option value="<?php echo $metadataform->W1W1;?>"><?php echo $metadataform->W1W1;?></option>
                            <option value="">Select Options</option>
                            <option value="RA">RA</option>
                            <option value="Fg">Fg</option>
                            <option value="Hz">Hz </option>

                            <option value="Ts">Ts</option>
                        </select>  -->
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">N1CCh1h1NnCChhhNhCChhh</span>
                        <input type="text" name="ncc" id="ncc"   class="form-control" value="<?php echo $metadataform->NlCCNmCCNhCC;?>" placeholder="N1CCh1h1NnCChhhNhCChhh ">
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">TT/TdTd</span>
                        <input type="text" name="tttdtd"  id="tttdtd"  required class="form-control"  value="<?php echo $metadataform->TTTdTd;?>" required placeholder="TT" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">QNH(hpa)</span>
                        <input type="text" name="qnhhpa" id="qnhhpa" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $metadataform->Qnhhpa;?>"  placeholder="QNH(hpa)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">QNH(in)</span>
                        <input type="text" name="qnhin" id="qnhin" onkeyup="allowIntegerInputOnly(this)"     class="form-control" value="<?php echo $metadataform->Qnhin;?>"  placeholder="QNH(in)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">QFE(hpa)</span>
                        <input type="text" name="qfehpa" id="qfehpa" class="form-control" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $metadataform->Qfehpa;?>"  placeholder="QFE(hpa)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">QFE(in)</span>
                        <input type="text" name="qfein" id="qfein" class="form-control" onkeyup="allowIntegerInputOnly(this)" value="<?php echo $metadataform->Qfein;?>"  placeholder="QFE(in)" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">RE W1W1</span>
                        <input type="text" name="rew1w1"  id="rew1w1" onkeyup="allowCharactersInputOnly(this)" value="<?php echo $metadataform->REW1W1;?>"  class="form-control"  placeholder=" Enter REW1W1" >


                        </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Approved</span>
                        <select name="approval" id="approval"  required class="form-control">
                            <option value="<?php echo $metadataform->Approved;?>"><?php echo $metadataform->Approved;?> </option>
                            <option value="">--Select Approval Options--</option>
                            <option value="TRUE">TRUE</option>
                            <option value="FALSE">FALSE</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
            </div>
            <div class="modal-footer clearfix">

                <a href="<?php echo base_url()."index.php/ArchiveMetarFormData/"; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>

                <button type="submit" name="updatearchivemetarformdata_button" id="updatearchivemetarformdata_button" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Update Archive Metar Form</button>
            </div>
            </form>
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url()."index.php/ArchiveMetarFormData/DisplayArchivedMetarForm/";?>"
                    <i class="fa fa-plus"></i> Add new Archive Metar Form</a>



            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Archive Metar Form</h3>
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
                                <th>Metar Speci</th>
                                <th>CCCC</th>
                                <th>YYGGgg</th>
                                <th>Dddff/ fm/fm</th>
                                <th>WW or COVAK</th>
                                <th>W1 W1</th>
                                <th>NCC</th>

                                <th>TT/ TdTd</th>
                                <th>QNH (hpa)</th>
                                <th>QNH (in)</th>
                                <th>QFE (hpa)</th>
                                <th>QFE (in)</th>
                                <th>RE W1W1</th>
                            <?php if($userrole=="OC"|| $userrole=="ObserverDataEntrant"){ ?>
                                    <th>Approved</th>

                                    <th>By</th>
                                    <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($archivedmetarformdata) && count($archivedmetarformdata)) {
                                foreach($archivedmetarformdata as $metardata){
                                    $count++;
                                    $metarid = $metardata->id;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $metardata->Date;?></td>
                                        <td ><?php echo $metardata->StationName;?></td>
                                        <td ><?php echo $metardata->StationNumber;?></td>
                                        <td ><?php echo $metardata->METARSPECI;?></td>
                                        <td ><?php echo $metardata->CCCC;?></td>
                                        <td ><?php echo $metardata->YYGGgg;?></td>
                                        <td ><?php echo $metardata->Dddfffmfm;?></td>
                                        <td ><?php echo $metardata->WWorCOVAK;?></td>
                                        <td><?php echo $metardata->W1W1;?></td>
                                        <td><?php echo $metardata->NlCCNmCCNhCC;?></td>


                                        <td ><?php echo $metardata->TTTdTd;?></td>
                                        <td ><?php echo $metardata->Qnhhpa;?></td>
                                        <td><?php echo $metardata->Qnhin;?></td>
                                        <td><?php echo $metardata->Qfehpa;?></td>
                                        <td><?php echo $metardata->Qfein;?></td>
                                        <td><?php echo $metardata->REW1W1;?></td>
                                        <td><?php echo $metardata->Approved;?></td>

                                        <td><?php echo $metardata->SubmittedBy;?></td>
                                  <?php if($userrole=="OC"|| $userrole=="ObserverDataEntrant"){ ?><td class="no-print">

                                            <a href="<?php echo base_url() . "index.php/ArchiveMetarFormData/DisplayArchivedMetarFormForUpdate/" .$metarid ;?>" style="cursor:pointer;">Edit</a>
                                           <!-- or <a href="<?php echo base_url() . "index.php/ArchiveMetarFormData/deleteArchiveMetarFormData/" .$metarid ;?>"
                                                  onClick="return confirm('Are you sure you want to delete <?php echo $metardata->StationName;?>');">Delete</a></td><?php }?> -->
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
            //Post Add New  Archive metar form data into the DB
            //Validate each select field before inserting into the DB
            $('#postarchivemetarformdata_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveMetarFormData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Archive Metar With the date,station,station Number and Time exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
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
                var station=$('#station_archivemetarformdata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archivemetarformdata').val("");  //Clear the field.
                    $("#station_archivemetarformdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archivemetarformdata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archivemetarformdata').val("");  //Clear the field.
                    $("#stationNo_archivemetarformdata").focus();
                    return false;

                }

                //Check that the TIME is selected from the list of TIME for the METAR
                var time=$('#time_archivemetarformdata').val();
                if(time==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  METAR not picked");
                    $('#time_archivemetarformdata').val("");  //Clear the field.
                    $("#time_archivemetarformdata").focus();
                    return false;

                }


                //Check that METAR/SPECI IS PICKED FROM A LIST
                var metarspeci=$('#metarspeci_archivemetarformdata').val();
                if(metarspeci==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select either METAR or SPECI from the list.");
                    $('#metarspeci_archivemetarformdata').val("");  //Clear the field.
                    $("#metarspeci_archivemetarformdata").focus();
                    return false;

                }





                //Check that WIW1 IS PICKED FROM A LIST
                var w1w1=$('#w1w1_archivemetarformdata').val();
                if(w1w1==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select W1 W1 from the list.");
                    $('#w1w1_archivemetarformdata').val("");  //Clear the field.
                    $("#w1w1_archivemetarformdata").focus();
                    return false;

                }




            }); //button


        });  //document
        </script>
        <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveMetarFormData(){

            //Check against the date,stationName,SManagernNumber,Time and MetarManageron.
                var date= $('#date').val();
                var stationName=$('#station_archivemetarformdata').val();
                var stationNumber=$('#stationNo_archivemetarformdata').val();
                var timeOfMetarRecorded = $('#time_archivemetarformdata').val();
                var metarOption = $('#metarspeci_archivemetarformdata').val();

            $('#checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield').val("");

            if ((date != undefined) && (timeOfMetarRecorded != undefined) && (stationName != undefined) && (stationNumber != undefined) && (metarOption != undefined)  ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveMetarFormData/checkInDBIfArchiveMetarFormRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber,'timeOfMetarRecorded':timeOfMetarRecorded,'metarOption':metarOption},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveMetarFormData_hiddentextfield").val();

            }//end of if

        else if((date == undefined) || (timeOfMetarRecorded == undefined) || (stationName == undefined) || (stationNumber == undefined) || (metarOption == undefined) ){

            var truthvalue="Missing";
        }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updatearchivemetarformdata_button').click(function(event) {
                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
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

                //Check that the TIME is selected from the list of TIME for the METAR
                var time=$('#timeRecorded').val();
                if(time==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  METAR not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }

                //Check that METAR/SPECI IS PICKED FROM A LIST
                var metarspeci=$('#metarspeci').val();
                if(metarspeci==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select either METAR or SPECI from the list.");
                    $('#metarspeci').val("");  //Clear the field.
                    $("#metarspeci").focus();
                    return false;

                }
                //Check that WIW1 IS PICKED FROM A LIST
                var w1w1=$('#w1w1').val();
                if(w1w1==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select W1W1 from the list.");
                    $('#w1w1').val("");  //Clear the field.
                    $("#w1w1").focus();
                    return false;

                }


                //Check that Approved IS PICKED FROM A LIST
                var approved=$('#approval').val();
                if(approved==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select Approved from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
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

            var newValue_yyGGgg;
            var oldValue_yyGGgg=$('#yyGGgg').val();

            $('#yyGGgg').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_yyGGgg = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#yyGGgg').val(newValue_yyGGgg);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#yyGGgg').val(oldValue_yyGGgg);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_dddfffmfm ;
            var oldValue_dddfffmfm= $('#dddfffmfm').val()

            $('#dddfffmfm').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_dddfffmfm = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dddfffmfm').val(newValue_dddfffmfm);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dddfffmfm').val(oldValue_dddfffmfm);
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
            var newValue_wwcovak;
            var oldValue_wwcovak= $('#wwcovak').val()

            $('#wwcovak').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_wwcovak = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wwcovak').val(newValue_wwcovak);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wwcovak').val(oldValue_wwcovak);
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
            var newValue_ncc;
            var oldValue_ncc= $('#ncc').val();

            $('#ncc').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_ncc = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#ncc').val(newValue_ncc);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#ncc').val(oldValue_ncc);
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
            var newValue_tttdtd;
            var oldValue_tttdtd= $('#tttdtd').val();

            $('#tttdtd').live('change paste', function(){
                //oldValue_tttdtd = newValue_tttdtd;
                newValue_tttdtd = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#tttdtd').val(newValue_tttdtd);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#tttdtd').val(oldValue_tttdtd);
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
            var newValue_qnhhpa;
            var oldValue_qnhhpa= $('#qnhhpa').val()

            $('#qnhhpa').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_qnhhpa = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#qnhhpa').val(newValue_qnhhpa);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#qnhhpa').val(oldValue_qnhhpa);
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
            var newValue_qnhin;
            var oldValue_qnhin= $('#qnhin').val()

            $('#qnhin').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_qnhin = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#qnhin').val(newValue_qnhin);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#qnhin').val(oldValue_qnhin);
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
            var newValue_qfehpa;
            var oldValue_qfehpa= $('#qfehpa').val();

            $('#qfehpa').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_qfehpa = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#qfehpa').val(newValue_qfehpa);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#qfehpa').val(oldValue_qfehpa);
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
            var newValue_qfein;
            var oldValue_qfein= $('#qfein').val();

            $('#qfein').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_qfein = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#qfein').val(newValue_qfein);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#qfein').val(oldValue_qfein);
                    return false;
                }
            });
        });
    </script>


    <script type="text/javascript">
        //When doing A Speci we end on TTTdTd for required fields
        //On Add new Metar
        $(document.body).on('change','#metarspeci_archivemetarform',function(){

            var metarspeci = this.value;


            if (metarspeci == "SPECI") {
                $('#qnhhpametar').attr('required', false);


                $('#qnhinmetar').attr('readonly', false);
                $('#qnhinmetar').attr('required', false);

            }
            else if(metarspeci == "METAR"){
                $('#qnhhpametar').attr('required', true);

                $('#qnhinmetar').attr('readonly', true);
                $('#qnhinmetar').attr('required', true);

            }


        })

    </script>
    <script type="text/javascript">
        //When doing A Speci we end on TTTdTd for required fields
        //On Edit Metar
        $(document.body).on('change','#metarspeci',function(){

            var metarspeci = this.value;


            if (metarspeci == "SPECI") {
                $('#qnhhpa').attr('required', false);


                $('#qnhin').attr('readonly', false);
                $('#qnhin').attr('required', false);

            }
            else if(metarspeci == "METAR"){
                $('#qnhhpa').attr('required', true);

                $('#qnhin').attr('readonly', true);
                $('#qnhin').attr('required', true);

       }


        })

    </script>
    <script type="text/javascript">
        //Once the AdmManagerlects the Station the Station Number shoulManagerpicked from the DB Automatically.
       // Managerr Insert/Add Archieve metar Form Data
    (document.body).on('change','#stationmetarManager',function(){
            $('#stationNometarManager').val("");  //Clear the field.
            var stationName = this.value;


       if (stationName != "") {
                //alert(station);
                $('#stationNometarAdmin').val("");
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

                            $('#stationNometarManager').val("");

                       // alert(data);
                            $("#stationNometarManager").val(json[0].StationNumber);
                    }
                        else{

                       $('#stationNometarManager').empty();
                            $('#statiManageretarAdmin').val("");

                        }
               }

                });



                    else {

                $('#stationNometarManager').empty();
                $('#stationNometarManager').val("");
            }     })

    </script>


<?php require_once(APPPATH . 'views/footer.php'); ?>