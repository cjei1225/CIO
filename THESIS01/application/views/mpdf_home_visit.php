<?php foreach($home_visit as $row_info) 
      {
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $response       = $row_info->response;
          $visit_date     = $row_info->visit_date;
          $visit_place    = $row_info->visit_place;
          $objective      = $row_info->objective;
          $narration      = $row_info->narration;
          $assessment     = $row_info->assessment;
          $action_plan    = $row_info->action_plan;

          $first_name     = $row_info->first_name;
          $last_name      = $row_info->last_name;
          $role           = $row_info->role;
      }
      if ($role == 7){$role = "Older Person";} elseif($role == 8){$role = "Persons with Special Needs";} elseif($role == 9){$role = "Crisis Intervention";} elseif($role == 10){$role = "Child and Youth";}
  

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
   <img src="' .base_url().'materialize/title logo.png" width="100" height="100">
  </div>
    <h6 style="text-align:center;"><b>HOME VISIT FEEDBACK REPORT</b></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label>Re: <u>'.$response.'-'.$fname.' '.$mname.' '.$lname.'</u> </label><br>
        <label>Date of Visit:<u>'.$visit_date.'</u> </label><br>
        <label>Place of Visit: <u>'.$visit_place.'</u> </label><br><br>
        <label>Objectives: <u>'.$objective .'</u></label><br><br><br>
        
        <label>Narrative: <u>'.$narration.'</u> </label><br><br><br>
        <label>Assessment: <u>'. $assessment .'</u> </label><br><br><br>
        <label>Plan of Action: <u>'.$action_plan.'</u> </label><br><br><br>
      </div>
      <label></label><br>
      <label></label><br>
      <label></label><br>
      <label>Prepared by:</label><br>
      <label></label><br>
      <label><u>'.$first_name.' '.$last_name.'</u></label><br>
      <label><i>'.$role.' Program</i></label><br>
      <label><i>Social Worker</i></label><br>
      <label></label><br>
      <label></label><br>
      <label></label><br>
      <label>Noted by:</label><br>
      <label></label><br>
      <label><u>sa system na dapat</u></label><br>
      <label><i>Supervising Social Worker</i></label><br>  

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