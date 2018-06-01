<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//$userstationNo=$session_data['StationNumber'];
//$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Archived Monthly Rainfall Report
        <small> Page</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Archived Monthly Rainfall Report</li>

    </ol>
</section>

<!-- Main content -->
<section class="content report">
<div id="output"></div>
<div class="row">
    <form action="<?php echo base_url(); ?>index.php/DisplayArchivedMonthlyRainfallFormReportData/displayArchivedmonthlyrainfallFormreport/" method="post" enctype="multipart/form-data">
        <?php  if($userrole=='OC'){?>
            <div class="col-xs-3">
                <div class="form-group">
                    <div class="input-group">

                        <span class="input-group-addon">Station</span>
                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                    </div>
                </div>
            </div>
        <?php }elseif($userrole=='ManagerData' || $userrole=='DataOfficer'){?>
            <div class="col-xs-3">
                <div class="form-group">
                    <div class="input-group">

                        <span class="input-group-addon">Station</span>
                        <select name="stationManager" id="stationManager"   class="form-control" placeholder="Select Station">
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
            </div>
        <?php } ?>

        <?php if($userrole=='OC'){ ?>
            <div class="col-xs-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="hidden" name="page" value="monthly_rainfall_report" >

                        <span class="input-group-addon">Station Number</span>
                        <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                    </div>
                </div>
            </div>

        <?php }elseif($userrole=='ManagerData' || $userrole=='DataOfficer'){?>
            <div class="col-xs-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="hidden" name="page" value="monthly_rainfall_report" >

                        <span class="input-group-addon">Station Number</span>
                        <input type="text" name="stationNoManager"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                    </div>
                </div>
            </div>
        <?php }?>

        <div class="col-xs-3">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Select Month</span>
                    <input type="text" name="month" id="month" class="form-control rainmonth" placeholder="Select month" >
                </div>
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Select Year</span>
                    <input type="text" name="year" id="year" class="form-control rainyear" placeholder="Select year" >
                </div>
            </div>
        </div>

        <div class="col-xs-3">
            <input type="submit" name="generatearchivedmonthlyrainfallformreport_button" id="generatearchivedmonthlyrainfallformreport_button" class="btn btn-primary" value="Generate Archived Monthly Rainfall Report" >
        </div>
    </form>
</div>
<hr>
<?php
if(is_array($displayArchivedMonthlyRainfallFormReportHeaderFields) &&
    count($displayArchivedMonthlyRainfallFormReportHeaderFields) &&
    is_array($archivedmonthlyrainfallformreportdata) &&
    !empty($archivedmonthlyrainfallformreportdata)) {

    $stationName=$displayArchivedMonthlyRainfallFormReportHeaderFields['stationName'];
    $stationNumber=$displayArchivedMonthlyRainfallFormReportHeaderFields['stationNumber'];

    $monthAsANumber=0;
    $year=0;

    $monthInWords= $displayArchivedMonthlyRainfallFormReportHeaderFields['monthInWords'];
    $monthAsANumber= $displayArchivedMonthlyRainfallFormReportHeaderFields['monthAsANumberselected'];

    $year= $displayArchivedMonthlyRainfallFormReportHeaderFields['year'];

    //$getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);
    $getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);


    ?>
    <span><strong>Form No.496(Rev.10/2015)</strong></span>
    <center>
        <h3>UGANDA NATIONAL METEOROLOGY AUTHORITY</h3>
        <h3>MONTHLY RAINFALL REPORT</h3>
    </center>

    <span><strong>Region</strong></span>
    <span class="dotted-line"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>District</strong></span> <span class="dotted-line"></span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br>
    <span><strong>Station Name</strong></span> <span class="dotted-line"><?php echo $stationName;?></span><br>
    <span><strong>Number</strong></span> <span class="dotted-line"><?php echo $stationNumber;?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Month</strong></span> <span class="dotted-line"><?php echo $monthInWords;?></span>
    <span><strong>Year</strong></span> <span class="dotted-line"><?php echo $year;?></span>

    <br><br>
    <span><strong>Enter daily totals under date measured</strong></span>

    <div class="clearfix"></div>
<br>
<?php
$one;
$two;
$three;
$four;
$five;
$six;
$seven;
$eight;
$nine;
$ten;
$eleven;
$twelve;
$thirteen;
$fourteen;
$fifteen;
$sixteen;
$seventeen;
$eighteen;
$nineteen;
$twenty;
$twentyone;
$twentytwo;
$twentythree;
$twentyfour;
$twentyfive;
$twentysix;
$twentyseven;
$twentyeight;
$twentynine;
$thirty;
$thirtyone;

$totalrainfallmeasured=0.0;
$numberOfRainfallDays=0;

foreach($archivedmonthlyrainfallformreportdata as $data){
    echo $data->DayOfTheMonth;

    if ($data->DayOfTheMonth == 1) {
        $one = $data->Rainfall;

        if(($one=='0') ||  ($one=='NIL') || empty($one)){
            $one="NIL";


        }

        elseif(($one < 0.1) || ($one=='TR')){
            $one ='TR';


        }
        elseif(($one >= 0.1) && ($one <= 0.9)){
            $one=$data->Rainfall;
            $totalrainfallmeasured+=$one;

        }

        elseif($one >= 1.0){
            $one=$data->Rainfall;
            $totalrainfallmeasured+=$one;
            $numberOfRainfallDays+=1;

        }
    }

    if ($data->DayOfTheMonth == 2) {
        $two = $data->Rainfall;
        if(($two=='0') ||  ($two=='NIL') || empty($two)){
            $two="NIL";


        }

        elseif(($two < 0.1) || ($two=='TR')){
            $two ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($two >= 0.1) && ($two <= 0.9)){
            $two=$data->Rainfall;
            $totalrainfallmeasured+=$two;

        }

        elseif($two >= 1.0){
            $two=$data->Rainfall;
            $totalrainfallmeasured+=$two;
            $numberOfRainfallDays+=1;

        }

    }

    if ($data->DayOfTheMonth ==3) {
        $three = $data->Rainfall;
        if(($three=='0') ||  ($three=='NIL') || empty($three)){
            $three="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($three < 0.1) || ($three=='TR')){
            $three ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($three >= 0.1) && ($three <= 0.9)){
            $three=$data->Rainfall;
            $totalrainfallmeasured+=$three;

        }

        elseif($three >= 1.0){
            $three=$data->Rainfall;
            $totalrainfallmeasured+=$three;
            $numberOfRainfallDays+=1;

        }
    }
    if($data->DayOfTheMonth ==4){
        $four=$data->Rainfall;
        if(($four=='0') ||  ($four=='NIL') || empty($four)){
            $four="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($four < 0.1) || ($four=='TR')){
            $four ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($four >= 0.1) && ($four <= 0.9)){
            $four=$data->Rainfall;
            $totalrainfallmeasured+=$four;

        }

        elseif($four >= 1.0){
            $four=$data->Rainfall;
            $totalrainfallmeasured+=$four;
            $numberOfRainfallDays+=1;

        }
    }

    if ($data->DayOfTheMonth ==5) {
        $five = $data->Rainfall;
        if(($five=='0') ||  ($five=='NIL') || empty($five)){
            $five="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($five < 0.1) || ($five=='TR')){
            $five ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($five >= 0.1) && ($five <= 0.9)){
            $five=$data->Rainfall;
            $totalrainfallmeasured+=$five;

        }

        elseif($five >= 1.0){
            $five=$data->Rainfall;
            $totalrainfallmeasured+=$five;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==6) {
        $six = $data->Rainfall;
        if(($six=='0') ||  ($six=='NIL') || empty($six)){
            $six="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($six < 0.1) || ($six=='TR')){
            $six ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($six >= 0.1) && ($six <= 0.9)){
            $six=$data->Rainfall;
            $totalrainfallmeasured+=$six;

        }

        elseif($six >= 1.0){
            $six=$data->Rainfall;
            $totalrainfallmeasured+=$six;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==7) {
        $seven = $data->Rainfall;
        if(($seven=='0') ||  ($seven=='NIL') || empty($seven)){
            $seven="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($seven < 0.1) || ($seven=='TR')){
            $seven ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($seven >= 0.1) && ($seven <= 0.9)){
            $seven=$data->Rainfall;
            $totalrainfallmeasured+=$seven;

        }

        elseif($seven >= 1.0){
            $seven=$data->Rainfall;
            $totalrainfallmeasured+=$seven;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==8) {
        $eight = $data->Rainfall;
        if(($eight=='0') ||  ($eight=='NIL') || empty($eight)){
            $eight="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($eight < 0.1) || ($eight=='TR')){
            $eight ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($eight >= 0.1) && ($eight <= 0.9)){
            $eight=$data->Rainfall;
            $totalrainfallmeasured+=$eight;

        }

        elseif($eight >= 1.0){
            $eight=$data->Rainfall;
            $totalrainfallmeasured+=$eight;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==9) {
        $nine = $data->Rainfall;
        if(($nine=='0') ||  ($nine=='NIL') || empty($nine)){
            $nine="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($nine < 0.1) || ($nine=='TR')){
            $nine ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($nine >= 0.1) && ($nine <= 0.9)){
            $nine=$data->Rainfall;
            $totalrainfallmeasured+=$nine;

        }

        elseif($nine >= 1.0){
            $nine=$data->Rainfall;
            $totalrainfallmeasured+=$nine;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==10) {
        $ten = $data->Rainfall;
        if(($ten=='0') ||  ($ten=='NIL') || empty($ten)){
            $ten="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($ten < 0.1) || ($ten=='TR')){
            $ten ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($ten >= 0.1) && ($ten <= 0.9)){
            $ten=$data->Rainfall;
            $totalrainfallmeasured+=$ten;

        }

        elseif($ten >= 1.0){
            $ten=$data->Rainfall;
            $totalrainfallmeasured+=$ten;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==11) {
        $eleven = $data->Rainfall;
        if(($eleven=='0') ||  ($eleven=='NIL') || empty($eleven)){
            $eleven="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($eleven < 0.1) || ($eleven=='TR')){
            $eleven ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($eleven >= 0.1) && ($eleven <= 0.9)){
            $eleven=$data->Rainfall;
            $totalrainfallmeasured+=$eleven;

        }

        elseif($eleven >= 1.0){
            $eleven=$data->Rainfall;
            $totalrainfallmeasured+=$eleven;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==12) {
        $twelve = $data->Rainfall;
        if(($twelve=='0') ||  ($twelve=='NIL') || empty($twelve)){
            $twelve="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twelve < 0.1) || ($twelve=='TR')){
            $twelve ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twelve >= 0.1) && ($twelve <= 0.9)){
            $twelve=$data->Rainfall;
            $totalrainfallmeasured+=$twelve;

        }

        elseif($twelve >= 1.0){
            $twelve=$data->Rainfall;
            $totalrainfallmeasured+=$twelve;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==13) {
        $thirteen = $data->Rainfall;
        if(($thirteen=='0') ||  ($thirteen=='NIL') || empty($thirteen)){
            $thirteen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($thirteen < 0.1) || ($thirteen=='TR')){
            $thirteen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($thirteen >= 0.1) && ($thirteen <= 0.9)){
            $thirteen=$data->Rainfall;
            $totalrainfallmeasured+=$thirteen;

        }

        elseif($thirteen >= 1.0){
            $thirteen=$data->Rainfall;
            $totalrainfallmeasured+=$thirteen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==14) {
        $fourteen = $data->Rainfall;
        if(($fourteen=='0') ||  ($fourteen=='NIL') || empty($fourteen)){
            $fourteen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($fourteen < 0.1) || ($fourteen=='TR')){
            $fourteen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($fourteen >= 0.1) && ($fourteen <= 0.9)){
            $fourteen=$data->Rainfall;
            $totalrainfallmeasured+=$fourteen;

        }

        elseif($fourteen >= 1.0){
            $fourteen=$data->Rainfall;
            $totalrainfallmeasured+=$fourteen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==15) {
        $fifteen = $data->Rainfall;
        if(($fifteen=='0') ||  ($fifteen=='NIL') || empty($fifteen)){
            $fifteen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($fifteen < 0.1) || ($fifteen=='TR')){
            $fifteen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($fifteen >= 0.1) && ($fifteen <= 0.9)){
            $fifteen=$data->Rainfall;
            $totalrainfallmeasured+=$fifteen;

        }

        elseif($fifteen >= 1.0){
            $fifteen=$data->Rainfall;
            $totalrainfallmeasured+=$fifteen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==16) {
        $sixteen = $data->Rainfall;
        if(($sixteen=='0') ||  ($sixteen=='NIL') || empty($sixteen)){
            $sixteen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($sixteen < 0.1) || ($sixteen=='TR')){
            $sixteen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($sixteen >= 0.1) && ($sixteen <= 0.9)){
            $sixteen=$data->Rainfall;
            $totalrainfallmeasured+=$sixteen;

        }

        elseif($sixteen >= 1.0){
            $sixteen=$data->Rainfall;
            $totalrainfallmeasured+=$sixteen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==17) {
        $seventeen = $data->Rainfall;
        if(($seventeen=='0') ||  ($seventeen=='NIL') || empty($seventeen)){
            $seventeen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($seventeen < 0.1) || ($seventeen=='TR')){
            $seventeen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($seventeen >= 0.1) && ($seventeen <= 0.9)){
            $seventeen=$data->Rainfall;
            $totalrainfallmeasured+=$seventeen;

        }

        elseif($seventeen >= 1.0){
            $seventeen=$data->Rainfall;
            $totalrainfallmeasured+=$seventeen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==18) {
        $eighteen = $data->Rainfall;
        if(($eighteen=='0') ||  ($eighteen=='NIL') || empty($eighteen)){
            $eighteen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($eighteen < 0.1) || ($eighteen=='TR')){
            $eighteen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($eighteen >= 0.1) && ($eighteen <= 0.9)){
            $eighteen=$data->Rainfall;
            $totalrainfallmeasured+=$eighteen;

        }

        elseif($eighteen >= 1.0){
            $eighteen=$data->Rainfall;
            $totalrainfallmeasured+=$eighteen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==19) {
        $nineteen = $data->Rainfall;
        if(($nineteen=='0') ||  ($nineteen=='NIL') || empty($nineteen)){
            $nineteen="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($nineteen < 0.1) || ($nineteen=='TR')){
            $nineteen ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($nineteen >= 0.1) && ($nineteen <= 0.9)){
            $nineteen=$data->Rainfall;
            $totalrainfallmeasured+=$nineteen;

        }

        elseif($nineteen >= 1.0){
            $nineteen=$data->Rainfall;
            $totalrainfallmeasured+=$nineteen;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==20) {
        $twenty = $data->Rainfall;
        if(($twenty=='0') ||  ($twenty=='NIL') || empty($twenty)){
            $twenty="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twenty < 0.1) || ($twenty=='TR')){
            $twenty ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twenty >= 0.1) && ($twenty <= 0.9)){
            $twenty=$data->Rainfall;
            $totalrainfallmeasured+=$twenty;

        }

        elseif($twenty >= 1.0){
            $twenty=$data->Rainfall;
            $totalrainfallmeasured+=$twenty;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==21) {
        $twentyone = $data->Rainfall;
        if(($twentyone=='0') ||  ($twentyone=='NIL') || empty($twentyone)){
            $twentyone="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentyone < 0.1) || ($twentyone=='TR')){
            $twentyone ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentyone >= 0.1) && ($twentyone <= 0.9)){
            $twentyone=$data->Rainfall;
            $totalrainfallmeasured+=$twentyone;

        }

        elseif($twentyone >= 1.0){
            $twentyone=$data->Rainfall;
            $totalrainfallmeasured+=$twentyone;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==22) {
        $twentytwo = $data->Rainfall;
        if(($twentytwo=='0') ||  ($twentytwo=='NIL') || empty($twentytwo)){
            $twentytwo="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentytwo < 0.1) || ($twentytwo=='TR')){
            $twentytwo ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentytwo >= 0.1) && ($twentytwo <= 0.9)){
            $twentytwo=$data->Rainfall;
            $totalrainfallmeasured+=$twentytwo;

        }

        elseif($twentytwo >= 1.0){
            $twentytwo=$data->Rainfall;
            $totalrainfallmeasured+=$twentytwo;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==23) {
        $twentythree = $data->Rainfall;
        if(($twentythree=='0') ||  ($twentythree=='NIL') || empty($twentythree)){
            $twentythree="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentythree < 0.1) || ($twentythree=='TR')){
            $twentythree ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentythree >= 0.1) && ($twentythree <= 0.9)){
            $twentythree=$data->Rainfall;
            $totalrainfallmeasured+=$twentythree;

        }

        elseif($twentythree >= 1.0){
            $twentythree=$data->Rainfall;
            $totalrainfallmeasured+=$twentythree;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==24) {
        $twentyfour = $data->Rainfall;
        if(($twentyfour=='0') ||  ($twentyfour=='NIL') || empty($twentyfour)){
            $twentyfour="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentyfour < 0.1) || ($twentyfour=='TR')){
            $twentyfour ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentyfour >= 0.1) && ($twentyfour <= 0.9)){
            $twentyfour=$data->Rainfall;
            $totalrainfallmeasured+=$twentyfour;

        }

        elseif($twentyfour >= 1.0){
            $twentyfour=$data->Rainfall;
            $totalrainfallmeasured+=$twentyfour;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==25) {
        $twentyfive=$data->Rainfall;
        if(($twentyfive=='0') ||  ($twentyfive=='NIL') || empty($twentyfive)){
            $twentyfive="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentyfive < 0.1) || ($twentyfive=='TR')){
            $twentyfive ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentyfive >= 0.1) && ($twentyfive <= 0.9)){
            $twentyfive=$data->Rainfall;
            $totalrainfallmeasured+=$twentyfive;

        }

        elseif($twentyfive >= 1.0){
            $twentyfive=$data->Rainfall;
            $totalrainfallmeasured+=$twentyfive;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==26) {
        $twentysix = $data->Rainfall;
        if(($twentysix=='0') ||  ($twentysix=='NIL') || empty($twentysix)){
            $twentysix="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentysix < 0.1) || ($twentysix=='TR')){
            $twentysix ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentysix >= 0.1) && ($twentysix <= 0.9)){
            $twentysix=$data->Rainfall;
            $totalrainfallmeasured+=$twentysix;

        }

        elseif($twentysix >= 1.0){
            $twentysix=$data->Rainfall;
            $totalrainfallmeasured+=$twentysix;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==27) {
        $twentyseven = $data->Rainfall;
        if(($twentyseven=='0') ||  ($twentyseven=='NIL') || empty($twentyseven)){
            $twentyseven="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentyseven < 0.1) || ($twentyseven=='TR')){
            $twentyseven ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentyseven >= 0.1) && ($twentyseven <= 0.9)){
            $twentyseven=$data->Rainfall;
            $totalrainfallmeasured+=$twentyseven;

        }

        elseif($twentyseven >= 1.0){
            $twentyseven=$data->Rainfall;
            $totalrainfallmeasured+=$twentyseven;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==28) {
        $twentyeight = $data->Rainfall;
        if(($twentyeight=='0') ||  ($twentyeight=='NIL') || empty($twentyeight)){
            $twentyeight="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentyeight < 0.1) || ($twentyeight=='TR')){
            $twentyeight ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentyeight >= 0.1) && ($twentyeight <= 0.9)){
            $twentyeight=$data->Rainfall;
            $totalrainfallmeasured+=$twentyeight;

        }

        elseif($twentyeight >= 1.0){
            $twentyeight=$data->Rainfall;
            $totalrainfallmeasured+=$twentyeight;
            $numberOfRainfallDays+=1;

        }
    }
    if ($data->DayOfTheMonth ==29) {
        $twentynine = $data->Rainfall;
        if(($twentynine=='0') ||  ($twentynine=='NIL') || empty($twentynine)){
            $twentynine="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($twentynine < 0.1) || ($twentynine=='TR')){
            $twentynine ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($twentynine >= 0.1) && ($twentynine <= 0.9)){
            $twentynine=$data->Rainfall;
            $totalrainfallmeasured+=$twentynine;

        }

        elseif($twentynine >= 1.0){
            $twentynine=$data->Rainfall;
            $totalrainfallmeasured+=$twentynine;
            $numberOfRainfallDays+=1;

        }
    }
    if($data->DayOfTheMonth==30){
        $thirty=$data->Rainfall;
        if(($thirty=='0') ||  ($thirty=='NIL') || empty($thirty)){
            $thirty="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($thirty < 0.1) || ($thirty=='TR')){
            $thirty ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($thirty >= 0.1) && ($thirty <= 0.9)){
            $thirty=$data->Rainfall;
            $totalrainfallmeasured+=$thirty;

        }

        elseif($thirty >= 1.0){
            $thirty=$data->Rainfall;
            $totalrainfallmeasured+=$thirty;
            $numberOfRainfallDays+=1;

        }
    }
    if($data->DayOfTheMonth==31){
        $thirtyone=$data->Rainfall;
        if(($thirtyone=='0') ||  ($thirtyone=='NIL') || empty($thirtyone)){
            $thirtyone="NIL";
            // $totalrainfallmeasured+=0.0;

        }

        elseif(($thirtyone < 0.1) || ($thirtyone=='TR')){
            $thirtyone ='TR';
            // $totalrainfallmeasured+=0.0;

        }
        elseif(($thirtyone >= 0.1) && ($thirtyone <= 0.9)){
            $thirtyone=$data->Rainfall;
            $totalrainfallmeasured+=$thirtyone;

        }

        elseif($thirtyone >= 1.0){
            $thirtyone=$data->Rainfall;
            $totalrainfallmeasured+=$thirtyone;
            $numberOfRainfallDays+=1;

        }
    }
}
?>


<table class="report-table" id="table2excel">

    <tr>
        <td class="main">2</td>
        <td class="main">3</td>
        <td class="main">4</td>
        <td class="main">5</td>
        <td class="main">6</td>
        <td class="main">7</td>
        <td class="main">8</td>
        <td class="main">9</td>
        <td class="main">10</td>
        <td class="main">11</td>
    </tr>

    <tr>
        <td class="main"><?php echo $two;?></td>
        <td class="main"><?php echo $three;?></td>
        <td class="main"><?php echo $four;?></td>
        <td class="main"><?php echo $five;?></td>
        <td class="main"><?php echo $six;?></td>
        <td class="main"><?php echo $seven;?></td>
        <td class="main"><?php echo $eight;?></td>
        <td class="main"><?php echo $nine;?></td>
        <td class="main"><?php echo $ten;?></td>
        <td class="main"><?php echo $eleven;?></td>


    </tr>
    <tr>
        <td class="main">12</td>
        <td class="main">13</td>
        <td class="main">14</td>
        <td class="main">15</td>
        <td class="main">16</td>
        <td class="main">17</td>
        <td class="main">18</td>
        <td class="main">19</td>
        <td class="main">20</td>
        <td class="main">21</td>
    </tr>

    <tr>
        <td class="main"><?php echo $twelve;?></td>
        <td class="main"><?php echo $thirteen;?></td>
        <td class="main"><?php echo $fourteen;?></td>
        <td class="main"><?php echo $fifteen;?></td>
        <td class="main"><?php echo $sixteen;?></td>
        <td class="main"><?php echo $seventeen;?></td>
        <td class="main"><?php echo $eighteen;?></td>
        <td class="main"><?php echo $nineteen;?></td>
        <td class="main"><?php echo $twenty;?></td>
        <td class="main"><?php echo $twentyone;?></td>
    </tr>
    <tr>
        <td class="main">22</td>
        <td class="main">23</td>
        <td class="main">24</td>
        <td class="main">25</td>
        <td class="main">26</td>
        <td class="main">27</td>
        <td class="main">28</td>
        <td class="main">29</td>
        <td class="main">30</td>
        <td class="main">31</td>
    </tr>
    <tr>
        <td class="main"><?php echo $twentytwo;?></td>
        <td class="main"><?php echo $twentythree;?></td>
        <td class="main"><?php echo $twentyfour;?></td>
        <td class="main"><?php echo $twentyfive;?></td>
        <td class="main"><?php echo $twentysix;?></td>
        <td class="main"><?php echo $twentyseven;?></td>
        <td class="main"><?php echo $twentyeight;?></td>
        <td class="main"><?php echo $twentynine;?></td>
        <td class="main"><?php echo $thirty;?></td>
        <td class="main"><?php echo $thirtyone;?></td>
    </tr>
    <tr>
        <td class="no-border"></td>
        <td class="main" colspan="3">1st of Following Month</td>
        <td class="main" colspan="2">Total</td>
        <td class="main" colspan="2">Days</td>


    </tr>
    <tr>
        <td class="no-border"></td>
        <td class="main" colspan="3"></td>
        <td class="main" colspan="2"><?php echo $totalrainfallmeasured;?></td>
        <td class="main" colspan="2"><?php echo $numberOfRainfallDays;?></td>


    </tr>

</table>
<br><br>
<span>Observations</span> <span class="dotted-line"></span>
<p>To be completed at the Meteorological Department</p>
<table class="report-table">

    <tr>
        <td class="main">AVERAGE </td>
        <td class="main">YEARS</td>
        <td class="main">MAX. FALL</td>
        <td class="main">DATE(S)</td>
    </tr>

    <tr>
        <td class="main">.</td>
        <td class="main"></td>
        <td class="main"></td>
        <td class="main"></td>


    </tr>
</table>
<br><br>
     <br><br>
       </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
       <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br><br><br>
    <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
    <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
    <a href="<?php echo base_url()."index.php/DisplayArchivedMonthlyRainfallFormReportData/"; ?>" class="btn btn-warning pull-right"><i class="fa fa-times"></i> Close Report</a>
    <div class="clearfix"></div>
    <br><br>


<?php }elseif(is_array($displayArchivedMonthlyRainfallFormReportHeaderFields) &&
count($displayArchivedMonthlyRainfallFormReportHeaderFields) &&
is_array($archivedmonthlyrainfallformreportdata) &&
empty($archivedmonthlyrainfallformreportdata)) {

$stationName=$displayArchivedMonthlyRainfallFormReportHeaderFields['stationName'];
$stationNumber=$displayArchivedMonthlyRainfallFormReportHeaderFields['stationNumber'];

$monthAsANumber=0;
$year=0;

$monthInWords= $displayArchivedMonthlyRainfallFormReportHeaderFields['monthInWords'];
$monthAsANumber= $displayArchivedMonthlyRainfallFormReportHeaderFields['monthAsANumberselected'];

$year= $displayArchivedMonthlyRainfallFormReportHeaderFields['year'];

//$getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);
$getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);?>
    <center>
        <?php echo "No Archived Monthly Rainfall Report Data Yet for ".$stationName.' '.'for the Month of'.' '.$monthInWords.' '.'and Year '.$year.' '.'From the DB'; ?>
    </center>
<?php }
?>
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        //Post metar form data into the DB
        //Validate each field before inserting into the DB
        $('#generatearchivedmonthlyrainfallformreport_button').click(function(event) {


            // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
            var stationManager=$('#stationManager').val();
            if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                alert("Please Select A Station from the list");
                $('#stationManager').val("");  //Clear the field.

                $("#stationManager").focus();
                return false;
            }
            //Manager that the a stationManagerer is selectManagerom the list of stations(Admin)
            var stationNoManager=$('#stationNoManager').val();
            if (stationNoManager==""){  // returns true if the variable does NOT contManager valid number
                alert("Station Number not picked");
                $('#stationNoManager').val("");  //Clear the field.
                $("#stationNoManager").focus();
                return false;

            }

            //Check that the a station is selected from the list of stations(Manager)
            var stationOC=$('#stationOC').val();
            if(stationOC==""){  // returns true if the variable does NOT contain a valid number
                alert("Station not picked");
                $('#stationOC').val("");  //Clear the field.
                $("#stationOC").focus();
                return false;

            }
            //Check that the a station Number is selected from the list of stations(Manager)
            var stationNoOC=$('#stationNoOC').val();
            if(stationNoOC==""){  // returns true if the variable does NOT contain a valid number
                alert("Station Number not picked");
                $('#stationNoOC').val("");  //Clear the field.
                $("#stationNoOC").focus();
                return false;

            }
            //////////////////////////////////////////////////////////////////////////////////////////////               //////////////////////////////////////////////////////////////////////////////////////////////////
            //Check that the MONTH is selected from the list of MONTHS
            var month=$('#month').val();
            if(month==""){  // returns true if the variable does NOT contain a valid number
                alert("Month not Selected from the List");
                $('#month').val("");  //Clear the field.
                $("#month").focus();
                return false;

            }
///////////////////////////////////////////////////////////////////////////////////////////////
            //Check that the YEAR is selected from the list of Year
            var year=$('#year').val();
            if(year==""){  // returns true if the variable does NOT contain a valid number
                alert("Year not Selected");
                $('#year').val("");  //Clear the field.
                $("#year").focus();
                return false;

            }


        });
    });
</script>
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




<?php require_once(APPPATH . 'views/footer.php'); ?>
