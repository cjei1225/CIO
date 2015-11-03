<?php 
$client_id      = $dis_sum[0]->intake_id;
$fname          = $dis_sum[0]->client_fname;
$mname          = $dis_sum[0]->client_mname;
$lname          = $dis_sum[0]->client_lname;
$age            = $dis_sum[0]->age;
$birthplace     = $dis_sum[0]->birthplace;
$birthday       = $dis_sum[0]->birthday;
$birth_stat     = $dis_sum[0]->birth_stat;
$gender         = $dis_sum[0]->gender;
$case           = $dis_sum[0]->client_sector;
$created        = $dis_sum[0]->created;
$discharge_to   = $dis_sum[0]->discharge_to;
$discharge_reason = $dis_sum[0]->discharge_reason;
$dorm           = $dis_sum[0]->d_name;
$case_summary   = $dis_sum[0]->case_summary;
$post_place_stat = $dis_sum[0]->post_place_stat;

$first_name     = $dis_sum[0]->first_name;
$last_name      = $dis_sum[0]->last_name;

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