<?php 
$created    = date('m/d/y', strtotime($surrender_details[0]->created));
$client_id  = $surrender_details[0]->client_id;
$fname      = $surrender_details[0]->client_fname;
$mname      = $surrender_details[0]->client_mname;
$lname      = $surrender_details[0]->client_lname;
$nickname   = $surrender_details[0]->nickname;
$Civil      = $surrender_details[0]->civil_status;
if($surrender_details[0]->gender == '1'){$gender= 'Male';}
elseif($surrender_details[0]->gender == '2'){$gender = 'Female';}
$religion   = $surrender_details[0]->religion;
$birthday   = $surrender_details[0]->birthday;
$Birthplace = $surrender_details[0]->birthplace;
$dorm_id    = $surrender_details[0]->dorm_id;
$sw_id      = $surrender_details[0]->sw_id;
$Birthday   = $surrender_details[0]->birthday;
$admitDate  = $surrender_details[0]->created;
$sector     = $surrender_details[0]->client_sector;
if($surrender_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($surrender_details[0]->baptized == '0'){$baptized = 'no';}
elseif($surrender_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $surrender_details[0]->nationality;
$educ_attained = $surrender_details[0]->educ_attained;
$school_attended = $surrender_details[0]->school_attended;

$emergency_name = $surrender_details[0]->emergency_name;
$emergency_add = $surrender_details[0]->emergency_add;
$emergency_contact = $surrender_details[0]->emergency_contact;
$id_presented = $surrender_details[0]->id_presented;
$health_history = $surrender_details[0]->health_history;

$sw_name = $surrender_details[0]->first_name." ".$surrender_details[0]->last_name;

$problem = $surrender_details[0]->problem;
$intake_description = $surrender_details[0]->intake_desc;

$surrenderer_name = $surrender_details[0]->surrender_name;      
$surrenderer_rel = $surrender_details[0]->surrender_rel;      
$surrenderer_age = $surrender_details[0]->surrender_age;      
$surrenderer_gender = $surrender_details[0]->surrender_gender; 
if($surrender_details[0]->surrender_gender == '1'){$surrenderer_gender= 'Male';}
elseif($surrender_details[0]->surrender_gender == '2'){$surrenderer_gender = 'Female';}     
$surrenderer_add = $surrender_details[0]->surrender_address;      
$surrenderer_contact = $surrender_details[0]->surrender_contact;      
$surrenderer_reason = $surrender_details[0]->surrender_reason;      


$admission_type = $surrender_details[0]->admission_type;
$status = $surrender_details[0]->client_status;

if($birthday != null)
{
  $age = ageCalculator($birthday);
}
else
{
  $age = ageCalculator($created);
}
function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
if($birthday != null){
$age = ageCalculator($birthday);
}
else{
$age = ageCalculator($birthday).'(admit date, no birthday)';
}


$html= $page.$page2;
$page ='  
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
        </div>';



$page2 = '
          <br>
      </div>
    </div>

        <h5 class="divider black"></h5>
        <div class="form-group">
        <label><b>SURRENDER INFORMATION</b></label>
        <h5 class="divider black"></h5>
        <br>
        <label >Name: '.$surrenderer_name.'</label>
        <br>
        <label>Relationship: '.$surrenderer_rel.'</label>
        <br>
        <label >Age: '.$surrenderer_age.'</label>
        <br>
        <label>Gender: '.$surrenderer_gender.'</label>
        <br>
        <label >Address: '.$surrenderer_add.'</label>
        <br>
        <label>Contact Number: '.$surrenderer_contact.'</label>
        <br>
        <label>Reason: '.$surrenderer_reason.'</label>
        <br><br>

        <label><b>Description of client during interview</b></label>
        <p>' . $intake_description .'</p>
        <br>


        <br>
        <label >Social Worker: ' . $sw_name.'</label>
      </div>
    </div>
  </div>
</main>


';

/*
            

if($family != null){'
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
              <tbody>'
                foreach($family as $member){'
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
          '.
          }
*/
include(APPPATH.'/third_party/mpdf/mpdf.php');
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents(APPPATH.'../materialize/css/materialize.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is 

$mpdf->WriteHTML($page.$page2);
$mpdf->Output();
exit;
?>