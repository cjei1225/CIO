<?php 
$client_id      = $dis_adop[0]->client_id;
$fname          = $dis_adop[0]->client_fname;
$mname          = $dis_adop[0]->client_mname;
$lname          = $dis_adop[0]->client_lname;
$age            = $dis_adop[0]->age;
$birthplace     = $dis_adop[0]->birthplace;
$birthday       = $dis_adop[0]->birthday;
$birth_stat     = $dis_adop[0]->birth_stat;
$gender         = $dis_adop[0]->gender;
$case           = $dis_adop[0]->client_sector;
$created        = date('F-d-Y', strtotime($dis_adop[0]->created));
$adop_father    = $dis_adop[0]->adop_father;
$adop_mother    = $dis_adop[0]->adop_mother;
$dorm           = $dis_adop[0]->d_name;

$first_name     = $dis_adop[0]->first_name;
$last_name      = $dis_adop[0]->last_name;

if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
$date = date('F-d-Y');
$time = date('h:i:s A');
if ($case == 1){$case = "Child and Youth";} elseif($case == 2){$case = "Older Person";}elseif($case == 3){$case = "Special Needs";}elseif($case == 4){$case = "Crisis Situation";}

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
   <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
   Social Services Department<br>
   Children and Youth Welfare Development Program<br>
   Adoption Services
  </div>
    <label></label><br>
    <h6 style="text-align:center;"><b>DISCHARGE FORM</b></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group" style="text-align:right;">
        <label>Date: <u>'.$date .'</u></label><br>
        <label>Time: <u>'.$time .'</u></label><br>
      </div>
      <div class="form-group">
        <label>Name of the Child: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Date of Birth/Gender:<u>'.$birthday.' / '.$gender .'</u> </label><br>
        <label>Age upon Discharge: <u> Computed dapat</u> </label><br>
        <label>Place of Birth: <u>'.$birthplace .'</u></label><br>
        <label>Birth Status: <u>'.$birth_stat.'</u> </label><br>
        <label>Date admitted in HSJ: <u>'.$created.'</u> </label><br>
        <label>Case Category: <u>'. $case .'</u> </label><br>
        <label>Dormitory: <u>'.$dorm.'</u> </label><br>
        <label>Number of months/years of Stay in HSJ: <u>Computed dapat</u></label><br>
        <label>Adoptive Father: <u>'.$adop_father.'</u></label><br>
        <label>Adoptive Mother: <u>'.$adop_mother.'</u></label><br>
      </div>
        <style type="text/css">
        #wrap {width:600px;margin:0 auto;}
        #left_col {float:left;width:300px;}
        #right_col {float:right;width:300px;
        //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
        </style>
        <div id="wrap">
          <div id="left_col">
            <label></label><br>
            <label>Discharge to:</label><br>
            <label>(Name and Signature)</label><br>
            <label></label><br>
            <label><u>'.$adop_father.'</u></label><br>
            <label>Adoptive Father</label><br>
            <label></label><br>
            <label>Recommended</label><br>
            <label></label><br>
            <label><u>'.$first_name.' '.$last_name.'</u></label><br>
            <label>Adoption Social Worker</label><br>
            <label></label><br>
            <label>Recommending Approval:</label><br>
            <label></label><br>
            <label><u></u></label><br>
            <label>Head, Social Services</label><br>
            <label></label><br>
            <label>Approved:</label><br>
            <label></label><br>
            <label><u></u></label><br>
            <label>Administrator</label><br>
          </div>
          <div id="right_col">  
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label><u>'.$adop_mother.'</u></label><br>
            <label>Adoptive Mother</label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label><u></u></label><br>
            <label>Head Nurse, Nursery Section</label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
          </div> 
        </div>

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