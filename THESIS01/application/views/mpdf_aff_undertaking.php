<?php foreach($aff_under as $row_info) 
      {
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $birthday       = $row_info->birthday;
          $birthplace     = $row_info->birthplace;
          $name1          = $row_info->name1;
          $name2          = $row_info->name2;
          $address1       = $row_info->address1;
          $address2       = $row_info->address2;
          $relationship1  = $row_info->relationship1;
          $relationship2  = $row_info->relationship2;
          $var4           = $row_info->var4;
          $var5           = $row_info->var5;
          $var6           = $row_info->var6;
          $var7           = $row_info->var7;
          $var8           = $row_info->var8;
          $var9           = $row_info->var9;
          $var10          = $row_info->var10;
          $affiant1       = $row_info->affiant1;
          $affiant2       = $row_info->affiant2;
          $witness1       = $row_info->witness1;
          $witness2       = $row_info->witness2;
          $day            = $row_info->day;
          $month          = $row_info->month;
          $taxnum         = $row_info->taxnum;
          $taxplace       = $row_info->taxplace;
          $taxdate        = $row_info->taxdate;
          $docNum         = $row_info->docNum;
          $pageNum        = $row_info->pageNum;
          $bookNum        = $row_info->bookNum;
      }

$html='  
<main >
  <div class="container">
   <div style="text-align:center;">
     <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
     <b>JOINT AFFIDAVIT OF UNDERTAKING</b>
   </div>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label>We <u>'.$name1.'</u> and <u>'.$name2.'</u> of legal age, Filipino with postal address of <u>'.$address1.'</u> and <u>'.$address2.'</u> after having been sworn to in accordance with law hereby depose and state:</label>
        <ol>
          <li>That we are the <u>'.$relationship1.'</u>, <u>'.$relationship2.'</u> and shall be the guardians of <u>'.$fname." ".$mname." ".$lname.'</u> born on <u>'.$birthday.'</u> at <u>'.$birthplace.'</u>.</li>
          <li>Considering her age, she could no longer take care of herself and as  guardians we are entrusting her to <b>HOSPICIO DE SAN JOSE </b>-  a licensed and accredited welfare institution located at Ayala Bridge, Manila for shelter; </li>
          <li>That we undertake to pay for her board and lodging amounting to <b>Seven Thousand Pesos (Php7,000.00)</b> per month exclusive of her personal and medical expenses (toiletries, medicines, hospitalization, medical laboratory examination and maintenance).</li>
          <li>That we guaranty to sustain all the other financial requirements or obligation that she may incur while living in the institution. </li>
          <li>That in case the client suffered from any illnesses or sickness, we will be responsible to pay for her hospitalization, laboratory, medicines and other expenses.
          </li>
          <li>That we also undertake to extend to Hospicio de San Jose and its management its full power and authority the necessary act and decision that would benefit the client and promote the client’s welfare and interest while she is in the custody.</li>
          <li>That aside from  us, the following persons are allowed  to visit and fetch  her and to be contracted in case of our  absence during emergency cases; (please indicate the name, address and contact numbers)
            <ul>
              <li><u>'.$var4.'</u></li>
              <li><u>'.$var5.'</u></li>
              <li><u>'.$var6.'</u></li>
              <li><u>'.$var7.'</u></li>
              <li><u>'.$var8.' </u></li>
              <li><u>'.$var9.'</u></li>
              <li><u>'.$var10.'</u></li>
            </ul>
          </li>
          <li>That whatever happens to her beyond the control of the institution, the management shall not be held liable or answerable (death, accident, sickness etc.).</li>
          <li>That if ever the client has unexpected behavioral problems and in case the institution cannot handle the situation, the client will be reunified immediately to the guardians.</li>
          <li>That she will be treated equally together with the older persons in the institution.</li>
          <li>That we are fully aware of the policies, rules and regulations and we are willing to abide with whatever changes may occur. </li>
          <li>That the above statements were done with our consent and no force was executed.</li>
        </ol>
        <style type="text/css">
        #wrap {width:600px;margin:0 auto;}
        #left_col {float:left;width:300px;}
        #right_col {float:right;width:300px;}
        //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
        </style>
        <div id="wrap" style="text-align:center;">
        <label> FURTHER AFFIANT SAYETH NAUGHT </label><br>
          <div id="left_col">
            <label></label><br>
            <label><u>'.$affiant1.'</u></label><br>
            <label>Print Name and Signature</label><br>
            <label></label><br>
          </div>
          <div id="right_col">  
            <label></label><br>
            <label><u>'.$affiant2.'</u></label><br>
            <label>Print Name and Signature</label><br>
            <label></label><br>
          </div> 
           <label>WITNESSES</label><br>
           <div id="left_col">
            <label></label><br>
            <label><u>'.$witness1.'</u></label><br>
            <label></label><br>
          </div>
          <div id="right_col">  
            <label></label><br>
            <label><u>'.$witness2.'</u></label><br>
            <label>Social Worker</label><br>
            <label></label><br>
          </div> 
        </div>
        <label>Subscribed and sworn before us this <u>'. $day .'</u> day of <u>'.$month.'</u> 2014 -- should change. Affiant exhibits his Community Tax Certificate No. <u>'. $taxnum.'  docu ata to -_- </u> issued at <u>'. $taxplace.'</u> on <u>'.$taxdate.'</u>.</label><br><br>
        <div id="wrap" >
          <div id="right_col" style="text-align:right">
            <label>NOTARY PUBLIC</label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
            <label></label><br>
          </div>
          <div id="left_col">  
            <label></label><br>
            <label>Doc. No.:<u>'.$docNum.'</u> <br>
            <label>Page No.:<u>'.$pageNum.'</u> <br>
            <label>Book No.:<u>'.$bookNum.'</u> <br>
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