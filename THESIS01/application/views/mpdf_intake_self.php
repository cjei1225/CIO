<?php 
$created    = $self_details[0]->created;
$client_id  = $self_details[0]->client_id;
$fname      = $self_details[0]->client_fname;
$mname      = $self_details[0]->client_mname;
$lname      = $self_details[0]->client_lname;
$nickname   = $self_details[0]->nickname;
$Civil      = $self_details[0]->civil_status;
if($self_details[0]->gender == '1'){$gender= 'Male';}
elseif($self_details[0]->gender == '2'){$gender = 'Female';}
$religion   = $self_details[0]->religion;
$birthday   = $self_details[0]->birthday;
$Birthplace = $self_details[0]->birthplace;
$dorm_id    = $self_details[0]->dorm_id;
$sw_id      = $self_details[0]->sw_id;
$Birthday   = $self_details[0]->birthday;
$admitDate  = $self_details[0]->created;
$sector     = $self_details[0]->client_sector;
if($self_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($self_details[0]->baptized == '0'){$baptized = 'no';}
elseif($self_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $self_details[0]->nationality;
$educ_attained = $self_details[0]->educ_attained;
$school_attended = $self_details[0]->school_attended;

$emergency_name = $self_details[0]->emergency_name;
$emergency_add = $self_details[0]->emergency_add;
$emergency_contact = $self_details[0]->emergency_contact;
$id_presented = $self_details[0]->id_presented;


$sw_name = $self_details[0]->first_name." ".$self_details[0]->last_name;

$health_history = $self_details[0]->health_history;

$problem = $self_details[0]->problem;
$intake_description = $self_details[0]->intake_desc;      

$prob_when = $self_details[0]->problem_when;
$prob_circumstances = $self_details[0]->problem_circums;
$prob_duration = $self_details[0]->problem_duration;
$prob_self_diagnosis = $self_details[0]->problem_self_diag;
$assess_problem = $self_details[0]->assess_problem;
$assess_needs = $self_details[0]->assess_needs;
$assess_motiv = $self_details[0]->assess_motiv;
$assess_resource  = $self_details[0]->assess_resource;

$admission_type = $self_details[0]->admission_type;
$status = $self_details[0]->client_status;

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
        <label><b>CLIENT\'S IDENTIFYING INFORMATION</b></label><br>
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
          <label><b>FAMILY BACKGROUND </b><br></label>
          <h5 class="divider black"></h5>
          <p>'. $family_bg .' </p>
        </div>
        <h5 class="divider black"></h5>'. 
        if($family != null){.'
        <br>
        <table class="Table bordered centered">
            <thead>
              <th>Name</th>
              <th>Relationship to Client</th>
              <th>Age</th>
              <th>Civil Status</th>
              <th>Educational Attainment</th>
              <th>Occupation/Income</th>
              <th>Address/Whereabouts</th>
            </thead>
            <tbody>' .
              foreach($family as $member){ .'
                <tr>
                  <td>' .$member->name.'</td>
                  <td>' .$member->relationship.'</td>
                  <td>' .$member->age .'</td>
                  <td>' .$member->civil_status .'</td>
                  <td>' .$member->educ_attained.'</td>
                  <td>' .$member->occupation .'</td>
                  <td>' .$member->address .'</td>
                </tr>' .
              } .'
            </tbody>
        </table>
        <br>
        </div>
        <h5 class="divider black"></h5>'.
        }.'
        <div class="form-group">
          <label ><b>PROBLEM PRESENTED </b><br>(Immediate cause of client\'s request for  help):</label>
          <h5 class="divider black"></h5>
          <p>'. $problem.'</p>
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
        <label><b>ASSESSMENT</b></label>
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
      <label > <u> '.$sw_name.'</u><br>Intake Social Worker</label>
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