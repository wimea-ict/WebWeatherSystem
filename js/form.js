var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab


// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("nextBtn");

// Get the <span> element that closes the modal
var back = document.getElementById("closex");

// When the user clicks yes
var go= document.getElementById("yesgo");

// When the user clicks on <span> (x), close the modal
span.onclick = function() {

    modal.style.display = "none";
}
function gosubmit() {
document.getElementById("regForm").submit();

}
function goback() {
  modal.style.display = "none";
  currentTab = 0;
  showTab(currentTab);
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function mycallback(){

    modal.style.display = "block";

}


function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";

    document.getElementById("nextBtn").addEventListener("click", mycallback);
  } else {
    document.getElementById("nextBtn").removeEventListener("click", mycallback);
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
  //
    //return false;
  }
  // Otherwise, display the correct tab:
  var metarORspeci = document.getElementById('metar_speci').value;

  if(currentTab==1 && n==1 && metarORspeci=="metar")
  currentTab++;//for metar skip section 2
  else if(currentTab==1 && n==-1 && metarORspeci=="metar")
  currentTab--;//for metar skip section 2
  showTab(currentTab);
}

function validateForm() {

  //Validate only submission form
  if(document.getElementsByTagName("form")[0].getAttributeNode("name").value=="updateForm" ){

    document.getElementsByClassName("step")[currentTab].className += " finish";
      return true;
  }


  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByClassName("compulsory");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    var metarORspeci = document.getElementById('metar_speci').value;
     if(metarORspeci=="metar"){
     if(y[i].getAttributeNode("name").value=="durationOfSunshine_observationslipform" || y[i].getAttributeNode("name").value=="windRun_observationslipform" )
     continue;
   }

    if (y[i].value == "" ){
      // add an "invalid"  class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  verifyTime();
  var diff=parseInt(document.getElementById("diff").value);
  if(diff>1)
  valid=false;
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function verifyTime(){
  var metarORspeci = document.getElementById('metar_speci').value;
  if(metarORspeci=="metar"){

document.getElementById("hideformetar1").style.display="none";
      var val0=$('#metar_time_observationslipform').val();
      var val=val0.split(":");
      var d = new Date();
      var diff =Math.abs(parseInt(val[0])-parseInt(d.getUTCHours()));

      if(diff>1)
      alert("Submission time for time "+val0+" expired");
      $('#diff').empty();
      $('#diff').val(diff);
  }else if (metarORspeci=="speci") {
document.getElementById("hideformetar1").style.display="block";
    var val0=$('#timepicker1').val();
    var val=val0.split(":");
    var d = new Date();
    var diff =Math.abs(parseInt(val[0])-parseInt(d.getUTCHours()));

    if(diff>1)
    alert("Submission time for time "+val0+" expired");
    $('#diff').empty();
    $('#diff').val(diff);
  }
}
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:

  x[n].className += " active";
}
