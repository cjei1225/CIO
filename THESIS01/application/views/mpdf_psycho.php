<?php 
$created        = date('F-d-Y', strtotime($psycho[0]->created));
$client_id      = $psycho[0]->client_id;
$fname          = $psycho[0]->client_fname;
$mname          = $psycho[0]->client_mname;
$lname          = $psycho[0]->client_lname;
$age            = $psycho[0]->age;
$gender         = $psycho[0]->gender;
$religion       = $psycho[0]->religion;
$Birthday       = $psycho[0]->birthday;
$refer_by       = $psycho[0]->refer_by;
$refer_date     = $psycho[0]->refer_date;
$refer_reason   = $psycho[0]->refer_reason;
$case_bg        = $psycho[0]->case_bg;
$educ_attain    = $psycho[0]->educ_attain;
$observed_beh   = $psycho[0]->observed_beh;
$intellectual_ability  = $psycho[0]->intellectual_ability;
$emotional_stat = $psycho[0]->emotional_stat;
$impression     = $psycho[0]->impression;
$recommendation = $psycho[0]->recommendation;

$first_name     = $psycho[0]->first_name;
$last_name      = $psycho[0]->last_name;

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