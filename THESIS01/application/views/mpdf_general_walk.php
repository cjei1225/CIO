<?php 
$created    = $founder_details[0]->created;
$client_id  = $founder_details[0]->client_id;
$fname      = $founder_details[0]->client_fname;
$mname      = $founder_details[0]->client_mname;
$lname      = $founder_details[0]->client_lname;
$nickname   = $founder_details[0]->nickname;
$Civil      = $founder_details[0]->civil_status;
if($founder_details[0]->gender == '1'){$gender= 'Male';}
elseif($founder_details[0]->gender == '2'){$gender = 'Female';}
$religion   = $founder_details[0]->religion;
$birthday   = $founder_details[0]->birthday;
$Birthplace = $founder_details[0]->birthplace;
$dorm_id    = $founder_details[0]->dorm_id;
$sw_id      = $founder_details[0]->sw_id;
$Birthday   = $founder_details[0]->birthday;
$admitDate  = $founder_details[0]->created;
$sector     = $founder_details[0]->client_sector;
if($founder_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($founder_details[0]->baptized == '0'){$baptized = 'no';}
elseif($founder_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $founder_details[0]->nationality;
$educ_attained = $founder_details[0]->educ_attained;
$school_attended = $founder_details[0]->school_attended;

$emergency_name = $founder_details[0]->emergency_name;
$emergency_add = $founder_details[0]->emergency_add;
$emergency_contact = $founder_details[0]->emergency_contact;
$id_presented = $founder_details[0]->id_presented;
$health_history = $founder_details[0]->health_history;

$sw_name = $founder_details[0]->first_name." ".$founder_details[0]->last_name;

$problem = $founder_details[0]->problem;
$intake_description = $founder_details[0]->intake_desc;

$founder_name = $founder_details[0]->founder_name;
$found_age = $founder_details[0]->founder_age;
$found_gender = $founder_details[0]->founder_gender;
$found_address = $founder_details[0]->founder_address;
$found_contact = $founder_details[0]->founder_contact;
$found_where = $founder_details[0]->founder_where;
$found_when = $founder_details[0]->founder_when;


$admission_type = $founder_details[0]->admission_type;
$status = $founder_details[0]->client_status;

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
              <label >School Attended: <u>'. $school_attended .'</u></label><br>
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
        <h5 class="divider black"></h5>'. 
       /* if($family != null){.'
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
        <label><b>FOUNDER INFORMATION</b></label>
        <h5 class="divider black"></h5>
        <br>
        <label >Name:' . $founder_name.'</label>
        <br>
        <label >Age:' . $found_age.'</label>
        <br>
        <label>Gender:' . $found_gender.'</label>
        <br>
        <label >Address:' . $found_address.'</label>
        <br>
        <label>Contact Number:' . $found_contact.'</label>
        <br>
        <label>Where was the client found?:' . $found_where.'</label>
        <br>
        <label>When was the client found?:' .$found_when.'</label>
        <br><br>
        
        </div>
        <label><b>Description of client during interview</b></label>
        <p>' . $intake_description .'</p>
        <br>


        <br>
        <label >Social Worker: '. $sw_name.'</label>
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