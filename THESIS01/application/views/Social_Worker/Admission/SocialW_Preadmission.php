<?php 
$Schedule = array(
	'name'  => 'Schedule',
    'id'    => 'Schedule',
	);
$start_time = array(
	'name'  => 'start_time',
    'id'    => 'start_time',
	);
$end_time = array(
	'name'  => 'end_time',
    'id'    => 'end_time',
	);

foreach($client_info as $row_info)
{
	$admission_type = $row_info->admission_type;
}
$i=0;
?>        
        <main> 
	       	<div class="container">
	       		<div class="row">
				    <div class="col s2 left">
			            <div class=" grey lighten-4" style="height:100%;">
			              <div>
			                <div class="panel-body" style="height:100%;" >
			                  <?php
			                    echo form_open('auth/pending_client_page');
			                    echo form_hidden('client_id', $client_id); ?>

			                    <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
			                    <?php
			                    echo form_close();
			                  
			                  ?>

			                  <?php
			                  echo form_open('auth/view_intake');
			                  echo form_hidden('client_id', $client_id); ?>

			                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
			                  <?php
			                  echo form_close();
			                  ?>

			                  <?php
			                  echo form_open('auth/get_client_checklist_items');
			                  echo form_hidden('client_id', $client_id);
			                  ?>
			                  <button type="submit"  value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Check List </button>
			                  <?php
			                  echo form_close();
			                  ?>

			                  <?php
			                  echo form_open('auth/POA_list');
			                  echo form_hidden('client_id', $client_id);
			                  ?>
			                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Plan Of Action</button>
			                  <?php
			                  echo form_close();
			                  ?>

			                  <?php
					            if($admission_type == '3')
		                        {
		                          echo form_open('auth/media_certificate');
		                          echo form_hidden('client_id', $client_id);
		                          ?>
		                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Media Certificate</button>
		                          <?php
		                          echo form_close();
		                        }
		                        else{}
			                  ?>
			                 </div>
			              </div>
			            </div>
			        </div> 
	       			<div class="col s10">
				      	<fieldset class="z-depth-2">
					        <?php echo form_open('auth/submit_pre_admission_request');?>
					        <?php echo form_hidden('client_id', $client_id); ?>
						        <div class="row">
						        	 <center><h5><b>PRE-ADMISSION CASE CONFERENCE</b></h5></center>
                <h6 class="divider black"></h6>
									<div class="col s12 m4">
							          	<?php echo form_label('Date of Conference', $Schedule['id']); ?>
										<input type="date" id="Schedule" name="Schedule" class="datepicker">
										<?php echo form_error($Schedule['name']); ?><?php echo isset($errors[$Schedule['name']])?$errors[$Schedule['name']]:''; ?>
										 <br>
						                 <br>
						                 <br>
                
									</div>

									<div class="col s12 m4">
										<?php echo form_label('Start time', $start_time['id']); ?>
										<?php echo form_input($start_time); ?>
										<?php echo form_error($start_time['name']); ?><?php echo isset($errors[$start_time['name']])?$errors[$start_time['name']]:''; ?>
									</div>

									<div class="col s12 m4">
										<?php echo form_label('End time', $end_time['id']); ?>
										<?php echo form_input($end_time); ?>
										<?php echo form_error($end_time['name']); ?><?php echo isset($errors[$end_time['name']])?$errors[$end_time['name']]:''; ?>
									</div>

					              <div class="col s12 m12"> 
					                 <h6 class="divider black" style="margin-top:-50px;"></h6>
					                <label style="font-size:20px;"><i class="mdi-action-account-circle small" ></i> Attendees:</label>
					                 <h6 class="divider black"></h6>
					              </div>
							        
					                <div class="col "  style="width:166px;">
					                  <label>Social Worker</label>
					                  <br>
										<?php

			                            foreach ($employees as $row_employee)
			                            { 
			                            	if($row_employee->role == 7 || $row_employee->role == 8 || $row_employee->role == 9 || $row_employee->role == 10)
			                            		{ $i++;
			                            ?>
			               					
			                            	
				                        	<input id="check[<?php echo $i; ?>]" name="check[<?php echo $i; ?>]"type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
				                        	<br>
				                 
			                        	<?php
			                           			}
			                           	}
			                           	echo form_hidden('counter', $i);
			                            ?>
								    </div>
								    <div class="col " style="width:166px;">
						                 <label>Administrators</label>
						                  <br>
										<?php

			                            foreach ($employees as $row_employee)
			                            {  
			                            	if($row_employee->role == 0)
			                            		{$i++;
			                            ?>
			               					

					                        	<input id="check[<?php echo $i; ?>]" name="check[]" type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
				                 				<br>
			                        	<?php
			                           			}
			                           	}
			                           	echo form_hidden('counter', $i);
			                            ?>
							        </div>

					                <div class="col "  style="width:166px;">
					                  <label>Nurse</label>
					                  <br>
										<?php

				                            foreach ($employees as $row_employee)
				                            {  
				                            	if($row_employee->role == 2)
				                            		{$i++;
				                            ?>
						                    	<input id="check[<?php echo $i; ?>]" name="check[]" type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
					                        	<br>
				                        	<?php
				                           			}
				                           	}
				                           	echo form_hidden('counter', $i);
				                            ?>
							        </div>
							        
					                <div class="col "  style="width:166px;">
					                  <label>Psychiatrist</label>
					                  <br>
										<?php

			                            foreach ($employees as $row_employee)
			                            {  
			                            	if($row_employee->role == 3)
			                            	{$i++;
			                            ?>
			               					

				                        	<input id="check[<?php echo $i; ?>]" name="check[]" type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
				                        	<br>
		                        		<?php
		                           			}
			                           	}
			                           	echo form_hidden('counter', $i);
									    ?>
							        </div>
							        
					                <div class="col "  style="width:166px;">
					                 <label>Psychologist</label>
					                 <br>
										<?php

			                            foreach ($employees as $row_employee)
			                            {  
			                            	if($row_employee->role == 4)
			                            		{$i++;
			                            ?>
			               					

					                        	<input id="check[<?php echo $i; ?>]" name="check[]" type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
					                        	<br>
			                        	<?php
			                           			}
			                           	}
			                           	echo form_hidden('counter', $i);
			                            ?>
								    </div>

					              <div class="col "  style="width:166px;">
					                  <label>Physical Theraphist</label>
					                  <br>
										<?php

			                            foreach ($employees as $row_employee)
			                            {  
			                            	if($row_employee->role == 6)
			                            		{$i++;
			                            ?>
			               					

					                        	<input id="check[<?php echo $i; ?>]" name="check[]" type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
					                        	<br>
			                        	<?php
			                           			}
			                           	}
			                           	echo form_hidden('counter', $i);
			                            ?>
							        </div>

						            <div class="col " style="width:166px;">
						                 <label>House Parent</label>
						                  <br>
										<?php

			                            foreach ($employees as $row_employee)
			                            {  
			                            	if($row_employee->role == 5)
			                            		{$i++;
			                            ?>
			               					

					                        	<input id="check[<?php echo $i; ?>]" name="check[]" type="checkbox" value="<?php echo $row_employee->id; ?>"><label for="check[<?php echo $i; ?>]"><?php echo $row_employee->username; ?></label>
				                 				<br>
			                        	<?php
			                           			}
			                           	}
			                           	echo form_hidden('counter', $i);
			                            ?>
							        </div>

									<div class="col s12 center">
										<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
									</div>
								</div>
						    <?php echo form_close();?>  
						    </div>  
						</fieldset>
					</div>
				</div>
			</div>
        </main>

