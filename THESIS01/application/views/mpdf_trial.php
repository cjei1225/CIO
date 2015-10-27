<?php

foreach($kasunduan as $row_info) 
{
    
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $first_name     = $row_info->first_name;
    $last_name      = $row_info->last_name;
    $Pname          = $row_info->parent_name;
    $address        = $row_info->address;
    $duration       = $row_info->duration;
    $signature      = $row_info->signature;
    $witness1       = $row_info->witness1;
    $witness2       = $row_info->witness2;

   
}

$html=
'<main >

 <div class="container">
    <div id="loginsize"> 

        	<h5 class="bold"  style="text-align:center;">KASUNDUAN SA PAGTANGGAP</h5>
            <h5 class="divider black"></h5>
           	<div class="form-group">
              <p>Ako si <u>'.$Pname.'</u>, naninirahan sa <u>'.$address.'</ul>, may sapat na gulang  (walang asawa/may asawa/balo/hiwalay), sa pamamagitan ng sulat na ito ay nakikiusap sa Hospicio de San Jose na tanggapin ang batang si <u>'.$fname.' '.$lname.'</u>, sa loob ng <u>'.$duration.'</u> (buwan / taon). </p>
              <p>Sa aking kahilingan, ako ay nakahandang tumupad sa mga sumusunod na patakaran:</p>
              <ol>
                <li>Dumalaw sa takdang araw ng pagdalaw (dalawang beses sa isang buwan) Na kung sa anumang kadahilanan, ako ay hindi makadalaw sa bata sa loob ng tatlong (3) buwan na sunod sunod (alinsunod sa P. D. 603), ito ay nangangahulugang hindi na ako interesado na makuha ang bata.  Gayon din sumasang-ayon akong ipaubaya ang aking karapatan bilang ina o ama at mailagay ang bata sa maayos na kalagayan sa pamamagitan ng pag papa-ampon.
                <li>Makipagtulungan at makiisa sa mga gawain o bagay-bagay para sa ikabubuti ng kapakanan ng bata, gayon din ang sumunod sa ibang patakaran ng Hospicio de San Jose.  Katulad halimbawa ng pagdalo sa miting, seminar, retreat at iba pa.   
                <li>Pumapayag akong manirahan ang bata sa loob lamang nang nabanggit na panahon.
                <li>Nangangako ako na kung ang bata ay may karamdaman at kailangang dalhin sa pagamutan, nakahanda akong alagaan o bantayan ang bata at ang kanyang mga pangangailangan ay aking sasagutin.
              </ol>

              <p>Na nauunawaan ko ang lahat ng nabanggit at nangangako akong hindi maghahabol o maghahain nang ano mang sakdal sibil o kriminal laban sa Hospicio de San Jose sa anumang kapakanan, sakuna, karamdaman o pagkamatay nang nasabing bata habang nasa ilalim ng pag-aaruga ng Hospicio de San Jose.</p>

              <u>'.$signature.'</u></br>
              <b>(Lagna)</b> </br>
              (Ina, Ama o tumatayong magulang)</br>
              </br>
              Sinaksihan nina:</br>
              <u>'.$witness1.'</u></br>
              <u>'.$witness2.'</u></br>
              </br>
              <u>'.$first_name.' '.$last_name .'</u></br>
              Social Worker</br>
              </br>
              <u>Dapat nsa system na to ^^</u></br>
              Head-Social Service</br>
              </br>
              Pinagtibay ni:
              <u>Dapat nsa system na to ^^</u></br>
              Administrator </br>
              </br>
      
           	</div>

           <?php echo form_close(); ?>		
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