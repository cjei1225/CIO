<?php


   include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
    $birthStat    = 'Healthy';
    $healthStat   = 'Healthy';

?>


<main >
    <div class="container">
    	<div class="row">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/sidebar_checklist.php'); ?>
	     	<div class="col s10">
	     		<div class="col s4">
		        	<?php
		        		if($role == 7 || $role == 8 || $role == 9 || $role == 10)
		        		{
		                	echo form_open('auth/update_checklist');
		                	echo form_hidden('client_id', $client_id); ?>

		                	<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside">Add items</button>
		                	<?php
		                	echo form_close();
		              	}
		            ?>
	     		</div>
	     	</div>
		    <div class="col s10">
		      	<fieldset class="z-depth-2">    
		            <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
		            <center>
		                <h5>HOSPICIO DE SAN JOSE</h5>
		                <h7>Ayala Bridge, Manila</h7>
		                <h6 >Social Service Department</h6>
                    <?php 
                    if($client_sector == 1){echo '<h6> Child and Youth';}
                    elseif($client_sector == 2){echo '<h6>Older Person Development Program</h5>';}
                    elseif($client_sector == 3){echo '<h6>Speacial Needs';}
                    elseif($client_sector == 4){echo '<h6>Crisis Situation';}
                    ?>
		             
		            	<h6 ><b>CHECKLIST</b></h6>
		        	   </center>
		       
		         	<h5 class="divider black"></h5>
		            <div class="form-group">
		            	<div class="row">
		            		<div class="col s6">
  			            	<label ><b>BASIC INFORMATION</b></label>
  			            	<br>
  			              <h6>Name: <?php echo $client_fname.' '. $client_lname; ?></h6>
  			             	<h6>Nickname: <?php echo $nickname; ?></h6>
  			            	<h6>Age/Gender: <?php echo $age.'/'; if ($gender == 1){echo "Male";}
                                        elseif($gender == 2){echo "Female";} ?> </h6>
  			            	<h6>Date of Birth: <?php if($birthday != null){echo $birthday;}else{echo date('m/d/y', strtotime($created))." (Admit date)";} ?></h6>
  			              <h6>Place of Birth: <?php echo $birthplace; ?></h6>
  			              <h6>Religion: <?php echo $religion; ?></h6>
			              </div>
                    <div class="col s6">
			               	<br>
			                <h6>Nationality: <?php echo $nationality; ?></h6>
			               	<h6>Educational Attainment: <?php echo $educAttain; ?></h6>
			                <h6>Date Admitted: <?php echo date('m/d/y', strtotime($created)); ?></h6>
			               	<h6 >Case Category: <?php if ($admission_type == 1){echo "Referral";}
                                            elseif($admission_type == 2){echo "Surrender";}
                                            elseif($admission_type == 3){echo "Walk in(Found)";}
                                            elseif($admission_type == 4){echo "Self-surrendered (Crisis)";} ?></h6>
			               	
			               	<h6>Health Status: <?php echo $healthStat; ?></h6>
			              </div>
			            </div>   	
			            <label ><b>DOCUMENT ON FILE</b></label>
		            </div>
                  <?php 

                          if($client_sector == 1){include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Social_Worker/checklists/check_list_CY.php'); }
                          elseif($client_sector == 2){include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Social_Worker/checklists/check_list_OP.php');}
                          elseif($client_sector == 3){include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Social_Worker/checklists/check_list_SP.php'); }
                          elseif($client_sector == 4){include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Social_Worker/checklists/check_list_CS.php'); }  
        ?>
		        </fieldset>
		    </div>
		</div>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>