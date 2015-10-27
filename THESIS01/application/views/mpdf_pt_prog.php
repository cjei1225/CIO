<?php 

$client_id      = $pt_prog[0]->client_id;
$fname          = $pt_prog[0]->client_fname;
$mname          = $pt_prog[0]->client_mname;
$lname          = $pt_prog[0]->client_lname;
$age            = $pt_prog[0]->age;
$covered_period = $pt_prog[0]->covered_period;
$diagnosis      = $pt_prog[0]->diagnosis;
$nationality    = $pt_prog[0]->nationality;
$gender         = $pt_prog[0]->gender;
$problem_1      = $pt_prog[0]->problem_1;
$problem_2      = $pt_prog[0]->problem_2;
$problem_3      = $pt_prog[0]->problem_3;
$progress_1     = $pt_prog[0]->progress_1;
$progress_1     = $pt_prog[0]->progress_2;
$progress_1     = $pt_prog[0]->progress_3;
$plan_1         = $pt_prog[0]->plan_1;
$plan_2         = $pt_prog[0]->plan_2;
$plan_3         = $pt_prog[0]->plan_3;
$reco           = $pt_prog[0]->reco;
$created        = date('F-d-Y', strtotime($pt_prog[0]->created));

$first_name     = $pt_prog[0]->first_name;
$last_name      = $pt_prog[0]->last_name;

if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}

     



$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
    <b>Hospicio de San Jose</b><br>
    <b>Ayala Bridge, Manila</b><br>
    <b>Physical Therapy and Rehabilitation Centre</b><br>
    <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
  </div>
  <h6 style="text-align:center;"><b>PROGRESS REPORT</b></h6>
  <h6 style="text-align:center;">Period Covered:<u>'.$covered_period.'</u></h6>
  <h6 style="text-align:center;">Date Prepared:<u>'.$created.'</u></b></h6>
  <div class ="row">
      <div class="col s6">
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label>Name of Patient: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Age/ Gender: <u>'.$age.' / '.$gender .'</u> </label><br>
        <label>Diagnosis:<u>'.$diagnosis.'</u> </label><br><br>
      </div>
      <div class="form-group">
        <label><b>Problem List:</b></label>
        <ol>
          <li><u>'.$problem_1.'</u></li>
          <li><u>'.$problem_2.'</u></li>
          <li><u>'.$problem_3.'</u></li>
        </ol>
      </div>
      <div class="form-group">
        <label><b>Progress Noted:</b></label>
        <ol>
          <li><u>'.$progress_1.'</u></li>
          <li><u>'.$progress_2.'</u></li>
          <li><u>'.$progress_3.'</u></li>
        </ol>
      </div>
      <div class="form-group">
        <label><b>Present PT Management (Plan):</b></label>
        <ol>
          <li><u>'.$plan_1.'</u></li>
          <li><u>'.$plan_2.'</u></li>
          <li><u>'.$plan_3.'</u></li>
        </ol>
      </div>
      <div class="form-group">
        <label><b>PT Recommendation:</b></label><br>
        <label><u>'.$reco.'</u> </label><br>
      </div>
      
      <label></label><br>
      <label>Prepared by:</label><br>
      <label></label><br>
      <label><u>'.$first_name.' '.$last_name.'</u></label><br>
      <label><i>PT Staff In-charge</i></label><br>
      <label></label><br>
      <label>Noted by:</label><br>
      <label></label><br>
      <label><u></u></label><br>
      <label><i>Head, Health Services Department</i></label><br>  
      <label></label><br>
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