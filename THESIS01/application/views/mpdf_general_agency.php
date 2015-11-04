<?php 
$created    = date('m/d/y', strtotime($agency_details[0]->created));
$client_id  = $agency_details[0]->client_id;
$fname      = $agency_details[0]->client_fname;
$mname      = $agency_details[0]->client_mname;
$lname      = $agency_details[0]->client_lname;
$nickname   = $agency_details[0]->nickname;
$Civil      = $agency_details[0]->civil_status;
if($agency_details[0]->gender == '1'){$gender= 'Male';}
elseif($agency_details[0]->gender == '2'){$gender = 'Female';}
$religion   = $agency_details[0]->religion;
$birthday   = $agency_details[0]->birthday;
$Birthplace = $agency_details[0]->birthplace;
$dorm_id    = $agency_details[0]->dorm_id;
$sw_id      = $agency_details[0]->sw_id;
$Birthday   = $agency_details[0]->birthday;
$admitDate  = $agency_details[0]->created;
$sector     = $agency_details[0]->client_sector;
if($agency_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($agency_details[0]->baptized == '0'){$baptized = 'no';}
elseif($agency_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $agency_details[0]->nationality;
$educ_attained = $agency_details[0]->educ_attained;
$school_attended = $agency_details[0]->school_attended;

$emergency_name = $agency_details[0]->emergency_name;
$emergency_add = $agency_details[0]->emergency_add;
$emergency_contact = $agency_details[0]->emergency_contact;
$id_presented = $agency_details[0]->id_presented;


$sw_name = $agency_details[0]->first_name." ".$agency_details[0]->last_name;
$agenName = $agency_details[0]->agency_name;
$agenAdd = $agency_details[0]->agency_add;
$agenContact = $agency_details[0]->agency_contact;
$agenSW = $agency_details[0]->agency_sw_name;
$agenSWContact = $agency_details[0]->agency_sw_contact;
$agenReason = $agency_details[0]->agency_reason;
$agenServices = $agency_details[0]->agency_service;
$health_history = $agency_details[0]->health_history;

$problem = $agency_details[0]->problem;
$intake_description = $agency_details[0]->intake_desc;      

$prob_when = $agency_details[0]->problem_when;
$prob_circumstances = $agency_details[0]->problem_circums;
$prob_duration = $agency_details[0]->problem_duration;
$prob_self_diagnosis = $agency_details[0]->problem_self_diag;
$assess_problem = $agency_details[0]->assess_problem;
$assess_needs = $agency_details[0]->assess_needs;
$assess_motiv = $agency_details[0]->assess_motiv;
$assess_resource  = $agency_details[0]->assess_resource;

$admission_type = $agency_details[0]->admission_type;
$status = $agency_details[0]->client_status;

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
                <label >A.K.A: <u>'.$nickname.'</u> </label><br>
                <label >Date of Birth: <u>'.$Birthday.'</u> </label><br>
                <label >Age: <u>'.$age.'</u> </label><br>
                <label >Gender: <u>'.$gender.'</u> </label><br>
                <label >Place of Birth: <u>'.$Birthplace .'</u></label><br>
                <label >Civil Status: <u>'. $Civil .'</u> </label><br>
                <label >Nationality: <u>'.$nationality.'</u></label><br>

            </div>
            <div id="right_col">
                <label >Religion: <u>'.$religion.'</u> </label><br>
                <label >Baptized? <u>'.$baptized.'</u></label><br>
                <label >Highest Educational Attainment: <u>'. $educ_attained .'</u></label><br>
                <label >School Attended: <u>'. $school_attended .'</u></label><br>
                <label >Contact person in case of emergency: <u>'. $emergency_name .'</u></label><br>
                <label >Address: <u>'. $emergency_add .'</u></label><br>
                <label >Tel. Nos.: <u>'. $emergency_contact .'</u></label><br>
                <label >I.D. PRESENTED: <u>'. $id_presented .'</u> </label><br>
            </div>
        </div>
      </div>
        <h5 class="divider black"></h5>'. 
     /*   if($family != null){.'
        <label><b>FAMILY BACKGROUND</b></label>
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
        }*/.'
        <div class="form-group">
        <label><b>AGENCY INFORMATION</b></label>
        <h5 class="divider black"></h5>
        <br>
        <label >Name of Agency/Institution: '.$agenName.'</label>
        <br>
        <label>Address: '.$agenAdd.'</label>
        <br>
        <label >Contact Number: '.$agenContact.'</label>
        <br>
        <label>Social Worker In-charge: '.$agenSW.'</label>
        <br>
        <label >Social Worker Contact Number: '.$agenSWContact.'</label>
        <br>
        <label>Reason: '.$agenReason.'</label>
        <br>
        <label>Services Received from the Agency: '.$agenServices.'</label>
        <br><br>

        <label><b>Description of client during interview</b></label>
        <p>' .$intake_description.'</p>
        <br>
        </div>

        <h5 class="divider black"></h5>
        <div class="form-group">
        <label><b>BRIEF HISTORY OF THE PROBLEM</b></label>
        <h5 class="divider black"></h5>
        <p> 
        <label>When did it start? <br> --' . $prob_when.'</label>
        <br>
        <label>Circumstances that led to the problem? <br> --' . $prob_circumstances.'</label>
        <br>
        <label>How long has the been happening (duration)? :<br> --' . $prob_duration.'</label>
        <br>
        <label>What did the client do about the problem ot has done about it? <br> --' .$assess_motiv .'
        <br>
        </p>
        <br>
        </div>

        <h5 class="divider black"></h5>
        <div class="form-group">
        <label><b>MEDICAL HISTORY</b></label>
        <h5 class="divider black"></h5>
        <p> ' .$health_history .' </p>
        <br>
        </div>

        <h5 class="divider black"></h5>
        <div class="form-group">
        <label><b>ASSESSMENT</b></label>
        <h5 class="divider black"></h5>
        <br>
        <ul>
        <li><b>-Immediate problems/needs to be worked out</b></li>
        <p>' .$assess_problem.' </p>
        <br>
        <br>
        <li><b>-Underlying problems/needs</b></li>
        <p> ' . $assess_needs.'</p>
        <br>
        <br>
        <li><b>-Motivation and capacity to relate and utilize help (assessment of strenghts & weaknesses)</b></li>
        <p>' . $assess_motiv .'</p>
        <br>
        <br>
        <li><b>-Resources (Internal and External)</b></li>
        <p> ' .$assess_resource .'</p>
        <br>
        <br>
        </ul>
        <br>
        </div>

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