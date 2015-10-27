<?php 
$client_id = $social[0]->client_id;
$fname          = $social[0]->client_fname;
$mname          = $social[0]->client_mname;
$lname          = $social[0]->client_lname;
$age            = $social[0]->age;
$birthplace     = $social[0]->birthplace;
$birthday       = $social[0]->birthday;
$nationality    = $social[0]->nationality;
$gender         = $social[0]->gender;
$case           = $social[0]->client_sector;
$created        = date('F-d-Y', strtotime($social[0]->created));
$intake_description = $social[0]->intake_desc;
$exceptionality = $social[0]->exceptionality;
$facts_abandon  = $social[0]->facts_abandonment;
$fam_details    = $social[0]->fam_details;
$circumstances  = $social[0]->circumstances;
$present_envi   = $social[0]->present_envi;
$eval_reco      = $social[0]->eval_reco;
$first_name     = $social[0]->first_name;
$last_name      = $social[0]->last_name;
if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
      
if($birthday != null)
{
  $age = ageCalculator($birthday);
}
else
{
  $age = ageCalculator($created);
}
function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
if($birthday != null){
$age = ageCalculator($birthday);
}
else{
$age = ageCalculator($birthday).' (admit date, no birthday)';
}

  foreach($update as $row_update)
  {
    $medical = $row_update->medical_development;
    $present_envi = $row_update->present_description;
    $Eval_reco = $row_update->Eval_reco;
  }

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
  <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
  UPDATED SOCIAL CASE STUDY REPORT</div>
  <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label><b>I.  IDENTIFYING INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <label>Name of the Child: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Date of Birth: <u>'.$birthday .'</u> </label><br>
        <label>Age/Gender:<u>'.$age.' / '.$gender .'</u> </label><br>
        <label>Birthplace: <u>'.$birthplace .'</u></label><br>
        <label>Legal Status: <u>'.$nationality.'</u> </label><br>
        <label>Exceptionality: <u>'. $exceptionality .'</u> </label><br>
        <label>Date Admitted: <u>'. $created .'</u></label><br>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>II. CIRCUMSTANCES OF REFERRAL AND ADMISSION</b></label><br>
        <h5 class="divider black"></h5>
        <label><u>'.$circumstances.'</u></label>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>III. BACKGROUND INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <div style="margin-left:30px;">
          <label><b>A.  THE CLIENT</b></label><br>
          <label>Description of the client  upon admission</label><br>
          <label><u>'.$intake_description.'</u></label><br>
          <label>Medical and Developmental History of the client</label><br>
          <label><u>'.$medical.'</u></label><br>
          <label>Description of the client’s Present environment</label><br>
          <label><u>'.$present_envi.'</u></label><br>
          <label><b>B.  THE FAMILY</b></label><br>
          <label><u>'.$fam_details.'</u></label><br>
          </div>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>IV. FACTS OF ABANDONMENT</b></label><br>
        <h5 class="divider black"></h5>
        <label><u>'.$facts_abandon.'</u></label>
      </div>
        <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>V. EVALUATION AND RECOMMENDATION</b></label><br>
        <h5 class="divider black"></h5>
        <label><u>'.$Eval_reco.'</u></label>
      </div>
      
      <label></label><br>
      <label>Prepared by:</label><br>
      <label></label><br>
      <label><u>'.$first_name.' '.$last_name.'</u></label><br>
      <label><i>Social Worker</i></label><br>
      <label></label><br>
      <label>Noted by:</label><br>
      <label></label><br>
      <label><u>sa system na dapat</u></label><br>
      <label><i>Head, Social Service Department</i></label><br>  
      <label></label><br>
      <label>Approved by:</label><br>
      <label></label><br>
      <label><u>sa system na dapat</u></label><br>
      <label><i>Administrator</i></label><br>  
      </div>
    </div>
  </div>
</main>


';


include(APPPATH.'/third_party/mpdf/mpdf.php');
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents(APPPATH.'../materialize/css/materialize.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>