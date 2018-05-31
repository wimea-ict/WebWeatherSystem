<?php
header("Access-Control-Allow-Origin: *");
/*header("content-type:application/json");

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
*/
$con = mysqli_connect("localhost", "jmuhumuza", "joshua", "mobilewimeadb") or die("failed to connect"); // Connect to database server(localhost) with username and password.

  $postdata ="hdhhd";// file_get_contents("php://input");
   if (isset($postdata)) {
       $request = json_decode($postdata);
               $date0 ="";// $request->dateSelected;
               $StationName ='lepppp';//$request->StationName;
               $StationNumber ='1209';//$request->StationNumber;
            /*   $time = $request->time;
               $rainfall =$request->rainfall;
               $amountClounds =$request->amountClounds;
               $totalLowClounds = $request->totalLowClounds;
               $typeLowCloud =$request->typeLowCloud;
               $oktasLowClouds =$request->oktasLowClouds;
               $lowCloudHeight = $request->lowCloudHeight;
               $CLCode =$request->CLCode;
               $mediumCloudType =$request->mediumCloudType;
               $mediumCloudHeight = $request->mediumCloudHeight;
               $maxReset =$request->maxReset;
               $MinRead =$request->MinRead;
               $minReset = $request->minReset;
               $picheRead =$request->picheRead;
               $OltasMediumCloud =$request->OltasMediumCloud;
                 $wetBulb = $request->wetBulb;
                  $maxRead =$request->maxRead;
                  $attdThermoReading =$request->attdThermoReading;
                  $prAsReadReading = $request->prAsReadReading;
                  $cldMbReading =$request->cldMbReading;
                  $valueInMbOrGpm =$request->valueInMbOrGpm;
                  $barographTimeMarks = $request->totalLowClounds;
                  $anemographTimeMarks =$request->anemographTimeMarks;
                  $otherTMarks =$request->otherTMarks;
                  $otherObservation = $request->otherObservation;
                  $picheReset =$request->picheReset;
                  $timeMarksThermo =$request->timeMarksThermo;
                  $timeMarksHygro = $request->timeMarksHygro;
                  $timeMarksRainRec =$request->timeMarksRainRec;
                  $presetWeather =$request->presetWeather;
                  $visibility = $request->visibility;
                  $windDirection =$request->windDirection;
                  $windSpeed =$request->windSpeed;
                  $gusting = $request->gusting;
                  $clodeMediumCloud =$request->clodeMediumCloud;
                  $typeHighCloud =$request->typeHighCloud;
                  $oktasHighCloud = $request->oktasHighCloud;
                  $heightHighCloud =$request->heightHighCloud;
                  $readingInMm =$request->readingInMm;
*/
   $submitter = "joshua";
   $approver ="muhumuza";

       if ($StationName != "") {
       $sql0="INSERT INTO observationslip(Date,  StationName,  StationNumber,  TIME,  TotalAmountOfAllClouds, TotalAmountOfLowClouds, TypeOfLowClouds,  OktasOfLowClouds, HeightOfLowClouds, CLCODEOfLowClouds, TypeOfMediumClouds, OktasOfMediumClouds, HeightOfMediumClouds, CLCODEOfMediumClouds, TypeOfHighClouds, OktasOfHighClouds, HeightOfHighClouds, CLCODEOfHighClouds, CloudSearchLightReading, Rainfall,Dry_Bulb, Wet_Bulb,Max_Read, Max_Reset,Min_Read,  Min_Reset,Piche_Read,Piche_Reset,TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec ,Present_Weather,Visibility,Wind_Direction,Wind_Speed ,Gusting,
  AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,SubmittedBy,Approved, CreationDate)
   VALUES(now(), '".$StationName."', ".$StationNumber.",   'xx',   'xx',  'xx',  'xx',   'xx',  'xx',  'xx',  'xx',  'xx',  'xx',  'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx','xx', 'xx','xx', 'xx','xx',  'xx','xx','xx','xx','xx','xx' ,'xx','xx','xx','xx' ,'xx',
  'xx','xx','xx','xx','xx','xx','xx','xx','xx','xx','xx',now())";
  echo $sql0;
   $results0 = mysqli_query($con, $sql0);
   if(!$results0)
    echo("Error description: " . mysqli_error($con));


           echo "Server returns: ";
       }
       else {
           echo "Empty username parameter!";
       }
   }



?>
