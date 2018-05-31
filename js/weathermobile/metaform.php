 <?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");

 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
//Date StationName StationNumber TIME METARSPECI CCCC YYGGgg Dddfffmfm WWorCOVAK W1W1 NlCCNmCCNhCC Air_temperature Dew_temperature Wet_bulb TTTdTd Qnhhpa Qnhin
//Qfehpa Qfein REW1W1 Approved CreationDate SubmittedBy	

//qfehpa rew1w1 qfein qnhin qnhhpa TTTd	N1ch airTemp dewTemp wetBulb w1w1 wwwcavok dddff yygggg
//cccc speci timesubmitted snumber sname datesubmitted

$con = mysqli_connect("localhost", "jmuhumuza", "joshua", "mobilewimeadb") or die("failed to connect"); // Connect to database server(localhost) with username and password.
//mysqli_select_db("mobilewimeadb") or die('failed to select database');

 /*$inserdt = mysqli_query($con,to metarfg(Date,StationName) values ('josjsnjsnjfs')(StationName) values ('josjsnjsnjfs')");
      if($inserdt){
		echo "successful";
			}
  			else{
			echo mysqli_error();
}
*/
   $postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);
        $datesubmitted =  date("Y/m/d");
        $sname = $request->sname;
        $snumber = $request->snumber;
        $stime = $request->timesubmitted;
        $speci = $request->speci;
        $cccc = $request->cccc;
        $yygggg = $request->yygggg;
        $dddff = $request->dddff;
        $wwwcavok = $request->wwwcavok;
        $w1w1 = $request->w1w1;
        $wetBulb = $request->wetBulb;
        $dewTemp = $request->dewTemp;
        $airTemp = $request->airTemp;
        $N1ch = $request->N1ch;
        $TTTd = $request->TTTd;
        $qnhhpa = $request->qnhhpa;
        $qnhin = $request->qnhin;
        $qfein = $request->qfein;
        $rew1w1 = $request->rew1w1;
        $qfehpa = $request->qfehpa;
        $creationDate = date("Y/m/d");
		$submitter = "joshua";
		$approver ="muhumuza";
		//$datesubmitted $sname $snumber $stime $speci $cccc $yygggg $dddff $wwwcavok $w1w1 $wetBulb $dewTemp $airTemp $N1ch $TTTd $qnhhpa $qnhin $qfein $rew1w1
		//$qfehpa $creationDate $submitter
        if ($sname != "") {
//		 $inserdt = mysqli_query($con, "insert into metarfg(StationName) values ('josjsnjsnjfs')");
//		$resultsv = mysqli_query($con, "insert into  logs(StationName)	values ('".$sname."')" );
	$results = mysqli_query($con,"insert into metarfg(Date, StationName, StationNumber, TIME, METARSPECI, CCCC, YYGGgg, Dddfffmfm, WWorCOVAK, W1W1, NlCCNmCCNhCC, Air_temperature, Dew_temperature, Wet_bulb, TTTdTd, Qnhhpa, Qnhin, Qfehpa, Qfein, REW1W1, Approved, CreationDate, SubmittedBy)
		values ('".$datesubmitted."','".$sname."','".$snumber."','".$stime."','".$speci."', '".$cccc."','".$yygggg."','".$dddff."','".$wwwcavok."','".$w1w1."','".$N1ch."','".$airTemp."','".$dewTemp."','".$wetBulb."','".$TTTd."','".$qnhhpa."','".$qnhin."','".$qfehpa."','".$qfein."', '".$rew1w1."','".$approver."', '".$creationDate."','".$submitter."')" ) or die(mysqli_error());
	
	
            echo "Server returns: ";
        }
        else {
            echo "Empty username parameter!";
        }
    }
	
	

?>
