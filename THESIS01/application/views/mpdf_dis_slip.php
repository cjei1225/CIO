<?php 
$client_id      = $dis_slip[0]->intake_id;
$fname          = $dis_slip[0]->client_fname;
$mname          = $dis_slip[0]->client_mname;
$lname          = $dis_slip[0]->client_lname;

$gender         = $dis_slip[0]->gender;
$case           = $dis_slip[0]->client_sector;
$created        = $dis_slip[0]->created;

$address	  	  = $dis_slip[0]->address;
$contact_num    = $dis_slip[0]->contact_num;
$first_name     = $dis_slip[0]->first_name;
$last_name      = $dis_slip[0]->last_name;
$dis_reason     = $dis_slip[0]->dis_reason;
      
if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
$date = date('F-d-Y');
if ($case == 1){$case = "Child and Youth";} elseif($case == 2){$case = "Older Person";}elseif($case == 3){$case = "Special Needs";}elseif($case == 4){$case = "Crisis Situation";}

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
   <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
   Social Services Department<br>
  </div>
    <label></label><br>
    <h6 style="text-align:center;"><b>DISCHARGE SLIP</b></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group" style="text-align:right;">
        <label>Date: <u>'.$date .'</u></label><br>
      </div>
      <div class="form-group">
        <label>Name: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Age upon Discharge/Gender: <u> Computed dapat / '.$gender .'</u> </label><br>
        <label>Date admitted: <u>'.$created.'</u> </label><br>
        <label>Case Category: <u>'. $case .'</u> </label><br>
        <label>Reason/s for discharge: <u>'. $dis_reason.'</u> </label><br>
        <label></label><br>
        <label></label><br>
        <label>Address: <u>'.$address.'</u></label><br>
        <label>Tel. / Contact #: <u>'.$contact_num.'</u></label><br>
        <label></label><br>
        <label></label><br>
        <label></label><br>
        <label></label><br>
        <label></label><br>
        <label></label><br>
        <label></label><br>
      </div>

        <style type="text/css">
        #wrap {width:600px;margin:0 auto;}
        #left_col {float:left;width:300px;}
        #right_col {float:right;width:300px;
        //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
        </style>
        <div id="wrap" style="text-align:center;">
          <div id="left_col">
            <label></label><br>
            <label><b>Recommended by:</b></label><br>
            <label></label><br>
            <label><u>'.$first_name.' '.$last_name.'</u></label><br>
            <label><i>Social Worker</i></label><br>
            <label></label><br>
            <label><b>Recommending Approval:</b></label><br>
            <label></label><br>
            <label><u></u></label><br>
            <label><i>Head, Social Services</i></label><br>
            <label></label><br>
          </div>
          <div id="right_col">  
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label><u></u></label><br>
            <label><i>Sister in-charge</i></label><br>
            <label></label><br>
          </div> 
          <label><b>Approved by:</b></label><br>
            <label></label><br>
            <label><u></u></label><br>
            <label><i>Administrator</i></label><br>
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
