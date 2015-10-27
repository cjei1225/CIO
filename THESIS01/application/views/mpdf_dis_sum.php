<?php foreach($dis_sum as $row_info) 
      {
          $client_id      = $row_info->intake_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $age            = $row_info->age;
          $birthplace     = $row_info->birthplace;
          $birthday       = $row_info->birthday;
          $birth_stat     = $row_info->birth_stat;
          $gender         = $row_info->gender;
          $case           = $row_info->client_sector;
          $created        = $row_info->created;
          $discharge_to   = $row_info->discharge_to;
          $discharge_reason = $row_info->discharge_reason;
          $dorm           = $row_info->d_name;
          $case_summary   = $row_info->case_summary;
          $post_place_stat = $row_info->post_place_stat;

          $first_name     = $row_info->first_name;
          $last_name      = $row_info->last_name;
      }
      if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
      if ($case == 1){$case = "Child and Youth";} elseif($case == 2){$case = "Older Person";}elseif($case == 3){$case = "Special Needs";}elseif($case == 4){$case = "Crisis Situation";}

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
   <img src="' .base_url().'materialize/title logo.png" width="100" height="100">
  </div>
    <h6 style="text-align:center;"><b>DISCHARGE SUMMARY</b></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label><b>I. Identifying Information</b></label><br>
        <h5 class="divider black"></h5>
        <label>Name of the Child: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Date of Birth/Gender:<u>'.$birthday.' / '.$gender .'</u> </label><br>
        <label>Age upon Discharge: <u> Computed dapat</u> </label><br>
        <label>Place of Birth: <u>'.$birthplace .'</u></label><br>
        <label>Birth Status: <u>'.$birth_stat.'</u> </label><br>
        <label>Case Category: <u>'. $case .'</u> </label><br>
        <label>Dormitory: <u>'.$dorm.'</u> </label><br>
        <label>Number of months/years of Stay in HSJ: <u>Computed dapat</u></label><br>
        <label>Date admitted in HSJ: <u>'.$created.'</u> </label><br>
        <label>Date of Discharged: <u> Hindi ko alam ilalagay dito</u></label><br>
        <label>Discharged to: <u>'.$discharge_to.'</u></label><br>
        <label>Reason for discharged: <u>'.$discharge_reason.'</u></label><br>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>II. Case Summary</b></label><br>
        <h5 class="divider black"></h5>
        <label><u>'.$case_summary.'</u></label>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>III.  Post Placement Status</b></label><br>
        <h5 class="divider black"></h5>
        <label><u>'.$post_place_stat.'</u></label>
      </div>
      <label></label><br>
      <label></label><br>
      <label></label><br>
      <label>Prepared by:</label><br>
      <label></label><br>
      <label><u>'.$first_name.' '.$last_name.'</u></label><br>
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