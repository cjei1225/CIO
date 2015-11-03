<?php
  
$client_id      = $kasunduan[0]->client_id;
$fname          = $kasunduan[0]->client_fname;
$lname          = $kasunduan[0]->client_lname;
$first_name     = $kasunduan[0]->first_name;
$last_name      = $kasunduan[0]->last_name;
$Pname          = $kasunduan[0]->parent_name;
$address        = $kasunduan[0]->address;
$duration       = $kasunduan[0]->duration;
$signature      = $kasunduan[0]->signature;
$witness1       = $kasunduan[0]->witness_1;
$witness2       = $kasunduan[0]->witness_2;
$created        = date('F-d-Y', strtotime($kasunduan[0]->created));

$html=
'<main >

<div class="container">
  <div id="loginsize"> 
  <div style="text-align:center;">
    <b>HOSPICIO DE SAN JOSE</b><br>
    Ayala Bridge, Manila<br>
    <img src="' .base_url().'materialize/title logo.png" width="100" height="100"><br>
    SOCIAL SERVICE DEPARTMENT
  </div>
    <p style="text-align:right;">Petsa : '.$created.'</p>

    <h6 class="bold"  style="text-align:center;">Kasunduan SA PAGTANGGAP</h6>
    <h5 class="divider black"></h5>
    <div class="form-group">
    <p>Ako si <u>'.$Pname.'</u>, naninirahan sa <u>'.$address.'</u>, may sapat na gulang  (walang asawa/may asawa/balo/hiwalay), sa pamamagitan ng sulat na ito ay nakikiusap sa Hospicio de San Jose na tanggapin ang batang si <u>'.$fname.' '.$lname.'</u>, sa loob ng <u>'.$duration.'</u> (buwan / taon). </p>
    <p>Sa aking kahilingan, ako ay nakahandang tumupad sa mga sumusunod na patakaran:
    <ol>
      <li>Dumalaw sa takdang araw ng pagdalaw (dalawang beses sa isang buwan) Na kung sa anumang kadahilanan, ako ay hindi makadalaw sa bata sa loob ng tatlong (3) buwan na sunod sunod (alinsunod sa P. D. 603), ito ay nangangahulugang hindi na ako interesado na makuha ang bata.  Gayon din sumasang-ayon akong ipaubaya ang aking karapatan bilang ina o ama at mailagay ang bata sa maayos na kalagayan sa pamamagitan ng pag papa-ampon.
      <li>Makipagtulungan at makiisa sa mga gawain o bagay-bagay para sa ikabubuti ng kapakanan ng bata, gayon din ang sumunod sa ibang patakaran ng Hospicio de San Jose.  Katulad halimbawa ng pagdalo sa miting, seminar, retreat at iba pa.   
      <li>Pumapayag akong manirahan ang bata sa loob lamang nang nabanggit na panahon.
      <li>Nangangako ako na kung ang bata ay may karamdaman at kailangang dalhin sa pagamutan, nakahanda akong alagaan o bantayan ang bata at ang kanyang mga pangangailangan ay aking sasagutin.
    </ol>

    <p>Na nauunawaan ko ang lahat ng nabanggit at nangangako akong hindi maghahabol o maghahain nang ano mang sakdal sibil o kriminal laban sa Hospicio de San Jose sa anumang kapakanan, sakuna, karamdaman o pagkamatay nang nasabing bata habang nasa ilalim ng pag-aaruga ng Hospicio de San Jose.</p></p>

    <style type="text/css">
    #wrap {width:600px;margin:0 auto;}
    #left_col {float:left;width:300px;}
    #right_col {float:right;width:300px;
    //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
    </style>
    <div id="Warp" style="text-align:center;">
      <div id ="left_col">
      <label><label><br>
      <label><label><br>
      <label><label><br>
      <label><label><br>
      <label>Sinaksihan nina:</label><br>
      <label><u>'.$witness1.'</u></label><br>
      <label><u>'.$witness2.'</u></label><br>
      <label><label><br>
      <label><u>'.$first_name.' '.$last_name .'</u><label><br>
      <label><i>Social Worker</i><label><br>
      <label><label><br>
      </div>
      <div id ="right_col">
      <label><u>'.$signature.'</u><label><br>
      <label><b>( L a g d a )</b><label><br>
      <label>(Ina,<br>Ama o tumatayong magulang)<label><br>
      <label><label><br>
      <label><label><br>
      <label><label><br>
      <label><label><br>
      <label><u>Dapat nsa system na to ^^</u><label><br>
      <label><i>Head-Social Service</i><label><br>
      <label><label><br>
      </div>
      <label >Pinagtibay ni:</label><br>
      <label ><u>Dapat nsa system na to ^^</u></label><br>
      <label ><i>Administrator</i></label>
    <div>
  </div>
</div>
</main>
';

include(APPPATH.'/third_party/mpdf/mpdf.php');
$mpdf=new mPDF(); 
$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents(APPPATH.'../materialize/css/materialize.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;


    ?>