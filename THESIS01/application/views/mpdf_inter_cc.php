<?php foreach($inter_cc as $row_info) 
      {
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $age            = $row_info->age;
          $birthplace     = $row_info->birthplace;
          $birthday       = $row_info->birthday;
          $nationality    = $row_info->nationality;
          $gender         = $row_info->gender;
          $case           = $row_info->client_sector;
          $created        = date('F-d-Y', strtotime($row_info->created));
          $disability     = $row_info->disability;
          $signi_info     = $row_info->signi_info;

          $first_name     = $row_info->first_name;
          $last_name      = $row_info->last_name;
          $role           = $row_info->role;
      }
      if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
      if ($role == 7){$role = "Older Person";} elseif($role == 8){$role = "Persons with Special Needs";} elseif($role == 9){$role = "Crisis Intervention";} elseif($role == 10){$role = "Child and Youth";}


$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
    <b>HOSPICIO DE SAN JOSE</b><br>
    Ayala Bridge, Manila<br>
    <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
    <b>Social Service Department</b>
  </div>
  <h6 style="text-align:center;">Intervention Case Conference</h6>
  <h6 style="text-align:center;">Date & Time:<u> dapat variable $schedule dito </u></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label><b>I.  IDENTIFYING INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <label>Name: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Age/Gender:<u>'.$age.' / '.$gender .'</u> </label><br>
        <label>Date of Birth: <u>'.$birthday .'</u> </label><br>
        <label>Place of Birth: <u>'.$birthplace .'</u></label><br>
        <label>Nationality: <u>'.$nationality.'</u> </label><br>
        <label>Date Admitted: <u>'. $created .'</u> </label><br>
        <label>Case Status: <u> Ongoing dapat ba?</u> </label><br>
        <label>Disability: <u>'. $disability .'</u></label><br>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>II. SIGNIFICANT INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <label><u>'.$signi_info.'</u></label>
      </div>
      <div class="form-group">
        <h5 class="divider black"></h5>
        <label><b>III.  RECOMMENDATION MADE BY THE CASE MANAGEMENT TEAM</b></label><br>
        <h5 class="divider black"></h5>
        <table style="border-style:solid;border-width:1px">
            <thead>
            <tr style="border-style:solid;border-width:1px">
              <th>Areas of Concerns</th>
              <th>Specific Activities</th>
              <th>Time Frame</th>
              <th>Perons Responsible</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
      </div>
      <div class="form-group"><br>
      <label><b>Name and signature of the CMT present during the conference:</b></label><br><br>
      <table style="border-style:solid;border-width:1px">
        <thead>
        <tr style="border-style:solid;border-width:1px">
          <th>Name</th>
          <th>Signature</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
        </tbody>
      </table>
      </div>
      <label></label><br>
      <label>Prepared by:</label><br>
      <label></label><br>
      <label><u>'.$first_name.' '.$last_name.'</u></label><br>
      <label><i>Social Worker</i></label><br>
      <label>'.$role.' Program</label><br>
      <label></label><br>
      <label>Noted by:</label><br>
      <label></label><br>
      <label><u>sa system na dapat</u></label><br>
      <label><i>Head, Social Service Department</i></label><br>  

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