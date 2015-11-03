<?php 
$client_id      = $media[0]->intake_id;
$fname          = $media[0]->client_fname;
$mname          = $media[0]->client_mname;
$lname          = $media[0]->client_lname;
$nickname       = $media[0]->nickname;

$Birthplace     = $media[0]->birthplace;
$Birthday       = date('F d, Y', strtotime($media[0]->birthday));
$weight         = $media[0]->weight;
$height         = $media[0]->height;
$skin           = $media[0]->skin;
$body_built     = $media[0]->body_built;
$dis_marks      = $media[0]->dis_marks;
$health_stat    = $media[0]->health_stat;
$biological_mom = $media[0]->biological_mom;
$last_address   = $media[0]->last_address;
$biological_dad = $media[0]->biological_dad;
$found_date     = $media[0]->found_date;
$found_place    = $media[0]->found_place;
$found_person   = $media[0]->found_person;
$found_per_add  = $media[0]->found_per_add;
$tv_radio       = $media[0]->tv_radio;
$aired_time     = $media[0]->aired_time;
$aired_date     = $media[0]->aired_date;
$announcer      = $media[0]->announcer;
$witness_1      = $media[0]->witness_1;
$witness_2      = $media[0]->witness_2;
$witness_3      = $media[0]->witness_3;


$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
    REPUBLIC OF THE PHILIPPINES<br>
    DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT<br>
    National Capital Region<br>
    Manila<br>
    <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
  </div>
    <h6 style="text-align:center;"><b>MEDIA CERTIFICATION</b></h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label>This is to certify that the herein below described minor/s has been aired over the TV/Radio Program Indication below:<br><br>
          This Certification issued upon request of the Department of Social Welfare and Development for purpose of filing for Involuntary Commitment of said minor/s:</label><br><br>
        <label>Name: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
        <label>Alias:<u>'.$nickname.'</u> </label><br>
        <label>Age: <u></u> </label><br>
        <label>Place of Birth: <u>'.$Birthplace .'</u></label><br>
        <label>Date of Birth: <u>'.$Birthday.'</u> </label><br>
        <label>Weight: <u>'.$weight.'</u> </label><br>
        <label>Height: <u>'. $height .'</u> </label><br>
        <label>Complexion: <u>'.$skin.'</u> </label><br>
        <label>Body Built: <u>'.$body_built.'</u></label><br>
        <label>Health Status: <u>'.$health_stat.'</u></label><br>
        <label>Distinguishing Mark/s Disability : <u>'.$dis_marks.'</u></label><br>
        <label>Biological Mother’s Name : <u>'.$biological_mom .'</u></label><br>
        <label>Last Known Address : <u>'.$last_address .'</u></label><br>
        <label>Biological Father’s Name : <u>'. $biological_dad .'</u></label><br>
        <label>If foundling, Date Found : <u>'. $found_date .'</u></label><br>
        <label>Place Found: <u>'. $found_place .'</u></label><br>
        <label>Person Who Found the Child: <u>'. $found_person .'</u></label><br>
        <label>Address of Founder : <u>'.$found_per_add .'</u></label><br>
        <label>TV/ Radio Program : <u>'. $tv_radio .'</u></label><br>
        <label>Time Aired:  <u>'. $aired_time.'</u></label><br>
        <label>Date Aired: <u>'. $aired_date .'</u> </label><br>
        <label>Announcer : <u>'. $announcer .'</u> </label><br><br>
      </div>

        <style type="text/css">
        #wrap {width:600px;margin:0 auto;}
        #left_col {float:left;width:300px;}
        #right_col {float:right;width:300px;
        //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
        </style>
        <div id="wrap" style="text-align:center;">
        <label> WITNESS </label><br>
          <div id="left_col">
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label><u>'.$witness_1.'</u></label><br>
            <label>Print Name and Signature</label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
          </div>
          <div id="right_col">  
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label><u>'.$witness_2.'</u></label><br>
            <label>Print Name and Signature</label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
          </div> 
          <label><u>'.$witness_3.'</u></label><br>
          <label>Print Name and Signature</label><br>
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