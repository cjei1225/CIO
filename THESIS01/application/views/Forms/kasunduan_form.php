<?php

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $first_name     = $row_info->first_name;
    $last_name      = $row_info->last_name;
  
}

?>
<main >

 <div class="container">
    <div id="loginsize">
     	



      	<fieldset class="z-depth-2">
        	<center><h5 class="bold">KASUNDUAN SA PAGTANGGAP</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
              <?php echo form_open("auth/create_kasunduan"); 

                    echo form_hidden ('Pname', $Pname);
                    echo form_hidden ('address', $address); 
                    echo form_hidden ('client_id', $client_id);
                    echo form_hidden ('duration', $duration);
                    echo form_hidden ('signature', $signature);
                    echo form_hidden ('witness1', $witness1);
                    echo form_hidden ('witness2', $witness2);
                    echo form_hidden ('user_id', $user_id);

                    ?>
              <p>Ako si <u><?php echo $Pname; ?></u>, naninirahan sa <u><?php echo $address; ?></u>, may sapat na gulang  (walang asawa/may asawa/balo/hiwalay), sa pamamagitan ng sulat na ito ay nakikiusap sa Hospicio de San Jose na tanggapin ang batang si <u><?php echo $fname.' '.$lname; ?></u>, sa loob ng <u><?php echo $duration; ?></u> (buwan / taon). </p>
              <p>Sa aking kahilingan, ako ay nakahandang tumupad sa mga sumusunod na patakaran:</p>
              <ol>
                <li>Dumalaw sa takdang araw ng pagdalaw (dalawang beses sa isang buwan) Na kung sa anumang kadahilanan, ako ay hindi makadalaw sa bata sa loob ng tatlong (3) buwan na sunod sunod (alinsunod sa P. D. 603), ito ay nangangahulugang hindi na ako interesado na makuha ang bata.  Gayon din sumasang-ayon akong ipaubaya ang aking karapatan bilang ina o ama at mailagay ang bata sa maayos na kalagayan sa pamamagitan ng pag papa-ampon.
                <li>Makipagtulungan at makiisa sa mga gawain o bagay-bagay para sa ikabubuti ng kapakanan ng bata, gayon din ang sumunod sa ibang patakaran ng Hospicio de San Jose.  Katulad halimbawa ng pagdalo sa miting, seminar, retreat at iba pa.   
                <li>Pumapayag akong manirahan ang bata sa loob lamang nang nabanggit na panahon.
                <li>Nangangako ako na kung ang bata ay may karamdaman at kailangang dalhin sa pagamutan, nakahanda akong alagaan o bantayan ang bata at ang kanyang mga pangangailangan ay aking sasagutin.
              </ol>

              <p>Na nauunawaan ko ang lahat ng nabanggit at nangangako akong hindi maghahabol o maghahain nang ano mang sakdal sibil o kriminal laban sa Hospicio de San Jose sa anumang kapakanan, sakuna, karamdaman o pagkamatay nang nasabing bata habang nasa ilalim ng pag-aaruga ng Hospicio de San Jose.</p>

              <u><?php echo $signature; ?></u></br>
              <b>(Lagna)</b> </br>
              (Ina, Ama o tumatayong magulang)</br>
              </br>
              Sinaksihan nina:</br>
              <u><?php echo $witness1; ?></u></br>
              <u><?php echo $witness2; ?></u></br>
              </br>
              <u><?php echo $first_name.' '.$last_name; ?></u></br>
              Social Worker</br>
              </br>
              <u>Dapat nsa system na to ^^</u></br>
              Head-Social Service</br>
              </br>
              Pinagtibay ni:</br>
              <u>Dapat nsa system na to ^^</u></br>
              Administrator </br>
              </br>

              <div>
               <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
              </div>
                <?php echo form_close();

                echo form_open("auth/mpdf_kasunduan"); 
                echo form_hidden('client_id', $client_id)?>
               <div>
               <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Print</button>
              </div>
              <?php echo form_close();?>
           	</div>
         </fieldset>    
    </div>
</div>
</main>