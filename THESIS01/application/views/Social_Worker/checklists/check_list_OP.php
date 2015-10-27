<?php

$General_intake				 = '0';
$admission_form				 = '0';
$kasunduan					 = '0';
$aff_undertaking			 = '0';
$pre_admission_CC			 = '0';
$initial_scsr				 = '0';
$updated_scsr				 = '0';
$pt_progress_rep			 = '0';
$medical_rep				 = '0';
$referral_letter			 = '0';
$photos						 = '0';
$life_plans 				 = '0';
$gsis_sss	 				 = '0';
$recordings  				 = '0';


$pre_discharge_cc			 = '0';
$discharge_form				 = '0';
$discharge_sum				 = '0';
$death_certificate			 = '0';



?>
<?php 
	$i = 1;
	$document = array();
	foreach($checklist_items as $checklist_items)
		{
		$document = $checklist_items->document_type; 
		if($document == 1){$General_intake = '1';}
		elseif($document == 4){$admission_form = '1';}
		elseif($document == 37){$kasunduan = '1';}
		elseif($document == 38){$aff_undertaking = '1';}
		elseif($document == 39){$pre_admission_CC = '1';}
		elseif($document == 20){$initial_scsr = '1';}
		elseif($document == 20){$updated_scsr = '1';}	
		elseif($document == 40){$pt_progress_rep = '1';}
		elseif($document == 33){$medical_rep = '1';}
		elseif($document == 11){$referral_letter = '1';}
		elseif($document == 42){$photos = '1';}
		elseif($document == 41){$life_plans = '1';}
		elseif($document == 43){$gsis_sss = '1';}
		elseif($document == 9){$recordings = '1';}
		elseif($document == 44){$pre_discharge_cc = '1';}
		elseif($document == 27){$discharge_form = '1';}
		elseif($document == 45){$discharge_sum = '1';}
		elseif($document == 46){$death_certificate = '1';}


		}
 
?>



		           		<div class="row">
		             		<div class="table-responsive col s12 m6">
		          				<table>
				                    <tbody>
				                    	<tr>
				                        	<td><input id="check1" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?> ><label for="check1"></label></td>
				                        	<td>General Intake Sheet</td>
				                        	<td>03-04-2015</td>
				                      	</tr>

				                      	<tr>
				                        	<td><input id="check2" type="checkbox" <?php if($admission_form == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check2"></label></td>
				                        	<td>Admission Slip</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check3" type="checkbox" <?php if($kasunduan == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check3"></label></td>
				                        	<td>Kasunduan</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check4" type="checkbox" <?php if($aff_undertaking == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check4"></label></td>
				                        	<td>Notarized Affidavit of Undertakings</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check5" type="checkbox" <?php if($pre_admission_CC == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check5"></label></td>
				                        	<td>Pre-Admission Case Conference Materials</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check6" type="checkbox" <?php if($initial_scsr == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check6"></label></td>
				                        	<td>Initial Case Study Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check7" type="checkbox" <?php if($updated_scsr == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check7"></label></td>
				                        	<td>Updated Social Case Study Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                    </tbody>
		        				</table>
		           			</div>
		           			<div class="table-responsive col s12 m6">
			                	<table >
			                    	<tbody>
			                      	<tr>
			                        	<td><input id="check8" type="checkbox" <?php if($pt_progress_rep == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check8"></label></td>
			                        	<td>PT/ OT Developmental/ Progress Reports</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check9" type="checkbox" <?php if($medical_rep == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check9"></label></td>
			                        	<td>Medical Records/ Laboratory Records</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check10" type="checkbox" <?php if($referral_letter == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check10"></label></td>
			                        	<td>Referral Letter</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                        
			                        <tr>
			                        	<td><input id="check11" type="checkbox" <?php if($photos == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check11"></label></td>
			                        	<td>Photos</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check12" type="checkbox" <?php if($life_plans == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check12"></label></td>
			                        	<td>Life Plans</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check13" type="checkbox" <?php if($gsis_sss == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check13"></label></td>
			                        	<td>GSIS/ SSS Pension (ATM/ Passbook)</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check14" type="checkbox" <?php if($recordings == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check14"></label></td>
			                        	<td>Recordings</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       
			                    </tbody>
			                </table>
			             </div> 
			            </div>

    			    	` <div>
    			            <label ><b>POST-ADMISSION</b></label>
    			            <br>
    			            <table>
    		                    <tbody>
    		                      	<tr>
    		                        	<td><input id="check15" type="checkbox" <?php if($pre_discharge_cc == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check15"></label></td>
    		                        	<td>Pre-Discharge Case Conference Materials</td>
    		                        	<td>03-04-2015</td>
    		                      	</tr>
    		                      	
    		                      	<tr>
    		                        	<td><input id="check16" type="checkbox" <?php if($discharge_form == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check16"></label></td>
    		                        	<td>Discharge Form</td>
    		                        	<td>03-04-2015</td>
    		                      	</tr>
    		                      	
    		                      	<tr>
    		                        	<td><input id="check17" type="checkbox" <?php if($discharge_sum == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check17"></label></td>
    		                        	<td>Discharge Summary</td>
    		                        	<td>03-04-2015</td>
    		                      	</tr>

    		                      	<tr>
    		                        	<td><input id="check18" type="checkbox" <?php if($death_certificate == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check18"></label></td>
    		                        	<td>Death Certificate</td>
    		                        	<td>03-04-2015</td>
    		                      	</tr>

    		                    </tbody>
    		                </table>  
    		          </div>
