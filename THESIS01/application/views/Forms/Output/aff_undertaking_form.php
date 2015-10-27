<?php foreach($client_info as $row_info) 
      {
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $birthday       = $row_info->birthday;
          $birthplace     = $row_info->birthplace;
        }
?>
<main >

 <div class="container">
    <div id="loginsize">
     	<?php echo form_open("auth/create_aff_undertaking"); 
      echo form_hidden ('name1', $name1);
      echo form_hidden ('name2', $name2); 
      echo form_hidden ('address1', $address1);
      echo form_hidden ('address2', $address2);
      echo form_hidden ('relationship1', $relationship1);
      echo form_hidden ('relationship2', $relationship2);
      echo form_hidden ('client_id', $client_id);
      echo form_hidden ('var4', $var4);
      echo form_hidden ('var5', $var5);
      echo form_hidden ('var6', $var6);
      echo form_hidden ('var7', $var7);
      echo form_hidden ('var8', $var8);
      echo form_hidden ('var9', $var9);
      echo form_hidden ('var10', $var10);
      echo form_hidden ('affiant1', $affiant1);
      echo form_hidden ('affiant2', $affiant2);
      echo form_hidden ('witness1', $witness1);
      echo form_hidden ('witness2', $witness2);
      echo form_hidden ('day', $day);
      echo form_hidden ('month', $month);
      echo form_hidden ('taxnum', $taxnum);
      echo form_hidden ('taxplace', $taxplace);
      echo form_hidden ('taxdate', $taxdate);
      echo form_hidden ('docNum', $docNum);
      echo form_hidden ('pageNum', $pageNum);
      echo form_hidden ('bookNum', $bookNum);

      ?>

      	<fieldset class="z-depth-2">
        	<center><h5 class="bold">JOINT AFFIDAVIT OF UNDERTAKING</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
              <label>We <u><?php echo $name1;?></u> and <u><?php echo $name2; ?></u> of legal age, Filipino with postal address of <u><?php echo $address1;?></u> and <u><?php echo $address2;?></u> after having been sworn to in accordance with law hereby depose and state:</label>

              <ol>
                <li>That we are the <u><?php echo $relationship1; ?></u>, <u><?php echo $relationship2; ?></u> and shall be the guardians of <u><?php echo $fname." ".$mname." ".$lname; ?></u> born on <u><?php echo $birthday; ?></u> at <u><?php echo $birthplace; ?></u>.
                </br>
                <li>Considering her age, she could no longer take care of herself and as  guardians we are entrusting her to <b>HOSPICIO DE SAN JOSE </b>-  a licensed and accredited welfare institution located at Ayala Bridge, Manila for shelter;  
                </br>
                <li>That we undertake to pay for her board and lodging amounting to <b>Seven Thousand Pesos (Php7,000.00)</b> per month exclusive of her personal and medical expenses (toiletries, medicines, hospitalization, medical laboratory examination and maintenance).
                </br>
                <li>That we guaranty to sustain all the other financial requirements or obligation that she may incur while living in the institution. 
                </br>
                <li>That in case the client suffered from any illnesses or sickness, we will be responsible to pay for her hospitalization, laboratory, medicines and other expenses.
                </br>
                <li>That we also undertake to extend to Hospicio de San Jose and its management its full power and authority the necessary act and decision that would benefit the client and promote the client’s welfare and interest while she is in the custody.
                </br>
                <li>That aside from  us, the following persons are allowed  to visit and fetch  her and to be contracted in case of our  absence during emergency cases; (please indicate the name, address and contact numbers)
                  <ul>
                    <li><u><?php echo $var4; ?> </u>
                    <li><u><?php echo $var5; ?> </u>
                    <li><u><?php echo $var6; ?> </u>
                    <li><u><?php echo $var7; ?> </u>
                    <li><u><?php echo $var8; ?> </u>
                    <li><u><?php echo $var9; ?> </u>
                    <li><u><?php echo $var10; ?> </u>
                  </ul>
                </br>
                <li>That whatever happens to her beyond the control of the institution, the management shall not be held liable or answerable (death, accident, sickness etc.).
                </br>
                <li>That if ever the client has unexpected behavioral problems and in case the institution cannot handle the situation, the client will be reunified immediately to the guardians.
                </br>
                <li>That she will be treated equally together with the older persons in the institution.
                </br>
                <li>That we are fully aware of the policies, rules and regulations and we are willing to abide with whatever changes may occur. 
                </br>
                <li>That the above statements were done with our consent and no force was executed.
              </ol>
              <style type="text/css">
              #wrap {width:600px;margin:0 auto;}
              #left_col {float:left;width:300px;}
              #right_col {float:right;width:300px;
              }
              </style>
              <div id="wrap" style="text-align:center;">
              <label> FURTHER AFFIANT SAYETH NAUGHT </label><br>
                <div id="left_col">
                  <label></label><br>
                  <label><u><?php echo $affiant1; ?></u></label><br>
                  <label>Print Name and Signature</label><br>
                  <label></label><br>
                </div>
                <div id="right_col">  
                  <label></label><br>
                  <label><u><?php echo$affiant2; ?></u></label><br>
                  <label>Print Name and Signature</label><br>
                  <label></label><br>
                </div> 
                 <label>WITNESSES</label><br>
                 <div id="left_col">
                  <label></label><br>
                  <label><u><?php echo$witness1; ?></u></label><br>
                  <label></label><br>
                </div>
                <div id="right_col">  
                  <label></label><br>
                  <label><u><?php echo$witness2; ?></u></label><br>
                  <label>Social Worker</label><br>
                  <label></label><br>
                </div> 
              </div>
              <label>Subscribed and sworn before us this <u><?php echo $day; ?></u> day of <u><?php echo $month; ?></u> 2014 -- should change. Affiant exhibits his Community Tax Certificate No. <u><?php echo $taxnum; ?>  docu ata to -_- </u> issued at <u><?php echo $taxplace; ?></u> on <u><?php echo $taxdate; ?></u>.</label><br>
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
                <label>Doc. No.:<u><?php echo $docNum; ?></u> </br>
                <label>Page No.:<u><?php echo $pageNum; ?></u> </br>
                <label>Book No.:<u><?php echo $bookNum; ?></u> </br>
              </div> 
            </div>     
             
              <div>
              <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
              </div>
              <?php echo form_close(); ?>
            </div>
         </fieldset>        
    </div>
</div>
</main>