<?php

header("Access-Control-Allow-Origin: *");
header("content-type:application/json");

 

$con = mysqli_connect("localhost", "jmuhumuza", "joshua","mobilewimeadb") or die("failed to connect"); // Connect to database server(localhost) with username and password.
//mysqli_select_db("mobilewimeadb") or die('failed to select database');

 
//sdate name number	stime windspeed cloudsechlghtAlidade stationtype lowcloudheight stdiosbaricsurface geopotential	preciptationperiod pastweather
//grassmintemp stationtypepresent characterintensity beginpreciptation indicator sunshineduration pressuresign suppinfo	 vapourpressure windrun thgraph 
   $postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);
        $datesubmitted =  date("Y/m/d");
        $sname = $request->name;
        $snumber = $request->number;
        $stime = $request->stime;
        $windspeed = $request->windspeed;
        $IndOrOmissionOfPrecipitation = $request->IndOrOmissionOfPrecipitation;
        $stationtype = $request->stationtype;
        $lowcloudheight = $request->lowcloudheight;
        $stdiosbaricsurface = $request->stdiosbaricsurface;
        $geopotential = $request->geopotential;
        $preciptationperiod = $request->preciptationperiod;
        $pastweather = $request->pastweather;
        $grassmintemp = $request->grassmintemp;
        $stationtypepresent = $request->stationtypepresent;
        $characterintensity = $request->characterintensity;
        $beginpreciptation = $request->beginpreciptation;
        $indicator = $request->indicator;
        $sunshineduration = $request->sunshineduration;
        $pressuresign = $request->pressuresign;
        $suppinfo = $request->suppinfo;
        $vapourpressure = $request->vapourpressure;
        $windrun = $request->windrun;
        $thgraph = $request->thgraph;
		$creationDate = date("Y/m/d");
		$submitter = "joshua";
		$approver ="muhumuza";
//Date, StationName, StationNumber, TIME, UnitOfWindSpeed, IndOrOmissionOfPrecipitation, TypeOfStation_Present_Past_Weather, HeightOfLowestCloud
//StandardIsobaricSurface, GPM, DurationOfPeriodOfPrecipitation, Past_Weather, GrassMinTemp, CI_OfPrecipitation, BE_OfPrecipitation IndicatorOfTypeOfIntrumentation
//DurationOfSunshine SignOfPressureChange Supp_Info VapourPressure Wind_Run T_H_Graph Approved SubmittedBy CreationDate

		
		
// $datesubmitted $sname $snumber $stime $windspeed	$cloudsechlghtAlidade $stationtype $lowcloudheight $stdiosbaricsurface $geopotential
																																		// $preciptationperiod $pastweather $grassmintemp $stationtypepresent $characterintensity $beginpreciptation $indicator $sunshineduration 
																																																																																								// $pressuresign $suppinfo $vapourpressure  $windrun $thgraph $creationDate $submitter $approver		
	if ($sname != "") {
		$results = mysqli_query($con,"insert into moreformfields(Date, StationName, StationNumber, TIME, UnitOfWindSpeed, IndOrOmissionOfPrecipitation, TypeOfStation_Present_Past_Weather, HeightOfLowestCloud, StandardIsobaricSurface, GPM, DurationOfPeriodOfPrecipitation, Past_Weather, GrassMinTemp, CI_OfPrecipitation, BE_OfPrecipitation, IndicatorOfTypeOfIntrumentation, DurationOfSunshine, SignOfPressureChange, Supp_Info, VapourPressure, Wind_Run, T_H_Graph, Approved, SubmittedBy, CreationDate )
		values ('".$datesubmitted."','".$sname."','".$snumber."','".$stime."','".$windspeed."', '".$IndOrOmissionOfPrecipitation."','".$stationtype."','".$lowcloudheight."','".$stdiosbaricsurface."','".$geopotential."','".$preciptationperiod."','".$pastweather."','".$grassmintemp."','".$characterintensity."','".$beginpreciptation."','".$indicator."','".$sunshineduration."','".$pressuresign."','".$suppinfo."', '".$vapourpressure."','".$windrun."', '".$thgraph."','".$approver."','".$submitter."', '".$creationDate."')" ) or die(mysqli_error);
	
	
            echo "Server returns: ffmfmfkfmk" ;
        }
        else {
            echo "Empty username parameter!";
        }
		
		
		}

mysqli_close($con);



?>
