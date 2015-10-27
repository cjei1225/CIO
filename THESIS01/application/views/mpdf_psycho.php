<?php foreach($psycho as $row_info) 
      {
          $created        = date('F-d-Y', strtotime($row_info->created));
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $age            = $row_info->age;
          $gender         = $row_info->gender;
          $religion       = $row_info->religion;
          $Birthday       = $row_info->birthday;
          $refer_by       = $row_info->refer_by;
          $refer_date     = $row_info->refer_date;
          $refer_reason   = $row_info->refer_reason;
          $case_bg        = $row_info->case_bg;
          $educ_attain    = $row_info->educ_attain;
          $observed_beh   = $row_info->observed_beh;
          $intellectual_ability  = $row_info->intellectual_ability;
          $emotional_stat = $row_info->emotional_stat;
          $impression     = $row_info->impression;
          $recommendation = $row_info->recommendation;

          $first_name     = $row_info->first_name;
          $last_name      = $row_info->last_name;
      }
      if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}


$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
    <b>Hospicio de San Jose</b><br>
    <b>Psychological and Counseling Services</b><br>
    <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
  </div>
    <h6 style="text-align:center;"><b>PSYCHOLOGICAL REPORT</b></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label><b>IDENTIFYING INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <label>Name: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Birthday: <u>'.$Birthday.'</u> </label><br>
        <label>Age: <u>'.$age.'</u> </label><br>
        <label>Gender: <u>'.$gender.'</u> </label><br>
        <label>Religion: '.$religion.'</u> </label><br>
        <label>Educational Attainment: <u>'.$educ_attained.'</u> </label><br>
        <label>Referred by : <u>'.$refer_by.'</u></label><br>
        <label>Date Referral: <u>'.$refer_date .'</u></label><br>
        <label>Reason for Referral: <u>'.$refer_reason.'</u></label><br>
        <label>Case Background: <u>'.$case_bg .'</u></label><br>
      </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label ><b>EVALUATION PROCEDURES</b></label>
          <h5 class="divider black"></h5>
          <table style="border-style:solid;border-width:1px">
            <thead>
            <tr style="border-style:solid;border-width:1px">
              <th>Tests</th>
              <th>Date Taken</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
          <label>Behavioral Observation</label><br>
          <p><u>'.$observed_beh.'</u></p>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label ><b>FINDINGS</b></label>
          <h5 class="divider black"></h5>
            <ul>
              <li>-- Intellectual Ability</li>
              <u>'. $intellectual_ability .' </u><br>
              <li>-- Emotional Status</li>
              <u>'. $emotional_stat .' </u><br>
              <li>-- Impression</li>
              <u>'. $impression .' </u><br>
              <li>-- Recommendation</li>
              <u>'. $recommendation .' </u><br>
            </ul>
        </div>
        <br><br>
        <label>Prepared by:</label><br>
        <label > <u> '.$first_name." ".$last_name.'</u><br>
        Psychologist</label>
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