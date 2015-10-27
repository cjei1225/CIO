<?php foreach($client_info as $row_info) 
      {
          $created        = date('F-d-Y', strtotime($row_info->created));
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $nickname       = $row_info->nickname;
          $Civil          = $row_info->civil_status;
          $age            = $row_info->age;
          $gender         = $row_info->gender;
          $religion       = $row_info->religion;
          $Birthplace     = $row_info->birthplace;
          $dorm_id        = $row_info->dorm_id;
          $sw_id          = $row_info->sw_id;
          $Birthday       = $row_info->birthday;
          $admitDate      = $row_info->created;
          $sector         = $row_info->client_sector;
          $baptized       = $row_info->baptized;
          $nationality    = $row_info->nationality;
          $present_add    = $row_info->present_add;
          $contact_num    = $row_info->contact_num;
          $permanent_add  = $row_info->permanent_add;
          $educ_attained  = $row_info->educ_attained;
          $emergency_name = $row_info->emergency_name;
          $emergency_add  = $row_info->emergency_add;
          $emergency_contact = $row_info->emergency_contact;
          $referral_source = $row_info->referral_source;
          $source_add     = $row_info->source_add;
          $source_contact = $row_info->source_contact;
          $id_presented   = $row_info->id_presented;

          $problem        = $row_info->problem;
          $agent_name     = $row_info->agent_name;
          $agent_reason   = $row_info->agent_reason;
          $agent_service  = $row_info->agent_service;
          $problem_history = $row_info->problem_history;
          $intake_description = $row_info->intake_desc;
          $health_history = $row_info->health_history;
          $family_bg      = $row_info->family_bg;
          $assess_problem = $row_info->assess_problem;
          $assess_needs   = $row_info->assess_needs;
          $assess_motiv   = $row_info->assess_motiv;
          $assess_resource= $row_info->assess_resource;
          $first_name     = $row_info->first_name;
          $last_name      = $row_info->last_name;
      }
      if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
      if ($baptized == 1){$baptized = "Yes";} elseif($baptized == 0){$baptized = "No";}

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
   <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
   <b>Social Service Department</b>
  </div>
    <h6 style="text-align:center;"><b>GENERAL INTAKE FORM</b></h6>
    <p style="text-align:right;">Date : '.$created.'</p>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label><b>I. CLIENT\'S IDENTIFYING INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <style type="text/css">
        #wrap {width:600px;margin:0 auto;}
        #left_col {float:left;width:300px;}
        #right_col {float:right;width:300px;
        //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
        </style>
        <div id="wrap">
          <div id="left_col">
              <label >Name: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
              <label >A.K.A:<u>'.$nickname.'</u> </label><br>
              <label >Date of Birth: <u>'.$Birthday.'</u> </label><br>
              <label >Age: <u>'.$age.'</u> </label><br>
              <label >Gender: <u>'.$gender.'</u> </label><br>
              <label >Civil Status: <u>'. $Civil .'</u> </label><br>
              <label >Religion: '.$religion.'</u> </label><br>
              <label >Baptized? <u>'.$baptized.'</u></label><br>
              <label >Nationality: <u>'.$nationality.'</u></label><br>
              <label >Place of Birth: <u>'.$Birthplace .'</u></label><br>
              <label >Present Address: <u>'.$present_add.'</u></label><br>
          </div>
          <div id="right_col">
              <label >Tel./ Cel Nos.: <u>'.$contact_num .'</u></label><br>
              <label >Permanent Address: <u>'.$permanent_add .'</u></label><br>
              <label >Highest Educational Attainment: <u>'. $educ_attained .'</u></label><br>
              <label >Contact person in case of emergency: <u>'. $emergency_name .'</u></label><br>
              <label >Address: <u>'. $emergency_add .'</u></label><br>
              <label >Tel. Nos.: <u>'. $emergency_contact .'</u></label><br>
              <label >Source of Referral: <u>'.$referral_source .'</u></label><br>
              <label >Address: <u>'. $source_add .'</u></label><br>
              <label >Tel./ Cel Nos.:  <u>'. $source_contact.'</u></label><br>
              <label >I.D. PRESENTED: <u>'. $id_presented .'</u> </label><br>
          </div>
        </div>
      </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label ><b>II. FAMILY/HOUSEHOLD COMPOSITION</b></label>
          <h5 class="divider black"></h5>
          <table style="border-style:solid;border-width:1px">
            <thead>
            <tr style="border-style:solid;border-width:1px">
              <th>Name</th>
              <th>Relationship to Client</th>
              <th>Date of Birth</th>
              <th>Age</th>
              <th>Civil Status</th>
              <th>Educational Attainment</th>
              <th>Occupation/ Income</th>
              <th>Address/ Whereabouts</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label ><b>III. PROBLEM PRESENTED </b><br>(Immediate cause of client\'s request for  help):</label>
          <h5 class="divider black"></h5>
          <p>'. $problem.'</p>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>IV. OTHER AGENCY/INSTITUTION APPROACHED BY THE CLIENT </b>(specify)</label>
          <h5 class="divider black"></h5>
            <ul>
              <li><label>Name of Agency/Institutions: <u>'.$agent_name .'</u></label></li>
              <li><label>Whem/Why? <u>'. $agent_reason .'</u></label></li>
              <li><label>Sevices Received from the Agency <u>'. $agent_service.'</u></label></li>
            </ul>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>V. BRIEF HISTORY OF THE PROBLEM</b></label>
          <h5 class="divider black"></h5>
          <p> '. $problem_history .'</p>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>VI. DESCRIPTION OF THE CLIENT AT INTAKE</b></label>
          <h5 class="divider black"></h5>
          <p>'. $intake_description .'</p>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>VII. HEALTH HISTORY</b></label>
          <h5 class="divider black"></h5>
          <p> '. $health_history .'</p>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>VIII. FAMILY BACKGROUND </b><br>(for adoption cases please fill-up the attached sheet)</label>
          <h5 class="divider black"></h5>
          <p>'. $family_bg .' </p>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
        <label><b>IX. ASSESSMENT</b></label>
        <h5 class="divider black"></h5>
          <ul >
            <li>-- Immediate problems/needs to be worked out</li>
              <u>'. $assess_problem .' </u><br>
            <li>-- Underlying problems/needs</li>
              <u>'.$assess_needs .' </u><br>
            <li>-- Motivation and capacity to relate and utilize help (assessment of strenghts & weaknesses)</li>
              <u>'. $assess_motiv .'</u><br>
            <li>-- Resources (Internal and External)</li>
              <u>'. $assess_resource .' </u><br>
          </ul>
        </div>
        <br>
      <label > <u> '.$first_name." ".$last_name.'</u><br>Intake Social Worker</label>
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