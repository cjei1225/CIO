<?php foreach($pt_prog as $row_info) 
      {
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $age            = $row_info->age;
          $covered_period = $row_info->covered_period;
          $diagnosis      = $row_info->diagnosis;
          $nationality    = $row_info->nationality;
          $gender         = $row_info->gender;
          $problem_1      = $row_info->problem_1;
          $problem_2      = $row_info->problem_2;
          $problem_3      = $row_info->problem_3;
          $progress_1     = $row_info->progress_1;
          $progress_1     = $row_info->progress_2;
          $progress_1     = $row_info->progress_3;
          $plan_1         = $row_info->plan_1;
          $plan_2         = $row_info->plan_2;
          $plan_3         = $row_info->plan_3;
          $reco           = $row_info->reco;

          $first_name     = $row_info->first_name;
          $last_name      = $row_info->last_name;
      }
      if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
      $date = date('F-d-Y');
      $time = date('h:i:s A');
     



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
  <h6 style="text-align:center;">Date Prepared:<u>'.$date.'</u></b></h6>
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
      <label><u>sa system na dapat</u></label><br>
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