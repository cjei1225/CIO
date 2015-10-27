<?php 
$Schedule = array(
	'name'  => 'Schedule',
    'id'    => 'Schedule',
    'placeholder' =>'Date'
	);

$Location = array(
	'name'  => 'Location',
    'id'    => 'Location',
	);
$Capacity = array(
	'name'  => 'Capacity',
    'id'    => 'Capacity',
	);
?>        

        <main> 
	       	<div class="container ">
	       		<div class="row">
	       			<div class="col s10 offset-s1">
				      	<fieldset class="z-depth-2">
					        <?php echo form_open('auth/Admin_Conference_Create');?>
						        <div class="row">
						        	 <center><h5><b>CASE CONFERENCE</b></h5></center>
                						<h6 class="divider black"></h6>
									
                					<div class="col s4">
	                					<select name="Conference_Type" class="browser-default">
						                    <option value="" disabled selected>Conference Type</option>
						                    <option value="1">Intervention case conference</option>
						                    <option value="2">Pre admission case conference</option>
					                	</select>
                					</div>

									<div class="col s4">
							          	<?php echo form_label('Date of Conference', $Schedule['id']); ?>
										<input type="date" id="Schedule" name="Schedule" class="datepicker">
										<?php echo form_error($Schedule['name']); ?><?php echo isset($errors[$Schedule['name']])?$errors[$Schedule['name']]:''; ?>
									</div>

									<div class="col s4">
										<select name="start_time"  class="browser-default">
		                                  <option value="-----" disabled selected>-----</option>
		                                  <option value="01:00">01:00</option>
		                                  <option value="02:00">02:00</option>
		                                  <option value="03:00">03:00</option>
		                                  <option value="04:00">04:00</option>
		                                  <option value="05:00">05:00</option>
		                                  <option value="06:00">06:00</option>
		                                  <option value="07:00">07:00</option>
		                                  <option value="08:00">08:00</option>
		                                  <option value="09:00">09:00</option>
		                                  <option value="10:00">10:00</option>
		                                  <option value="11:00">11:00</option>
		                                  <option value="12:00">12:00</option>
		                                  <option value="13:00">13:00</option>
		                                  <option value="14:00">14:00</option>
		                                  <option value="15:00">15:00</option>
		                                  <option value="16:00">16:00</option>
		                                  <option value="17:00">17:00</option>
		                                  <option value="18:00">18:00</option>
		                                  <option value="19:00">19:00</option>
		                                  <option value="20:00">20:00</option>
		                                  <option value="21:00">21:00</option>
		                                  <option value="22:00">22:00</option>
		                                  <option value="23:00">23:00</option>
		                                  <option value="24:00">24:00</option>
		                                </select>
									</div>

									<div class="col s4">
										<select name="end_time"  class="browser-default">
		                                  <option value="-----" disabled selected>-----</option>
		                                  <option value="01:00">01:00</option>
		                                  <option value="02:00">02:00</option>
		                                  <option value="03:00">03:00</option>
		                                  <option value="04:00">04:00</option>
		                                  <option value="05:00">05:00</option>
		                                  <option value="06:00">06:00</option>
		                                  <option value="07:00">07:00</option>
		                                  <option value="08:00">08:00</option>
		                                  <option value="09:00">09:00</option>
		                                  <option value="10:00">10:00</option>
		                                  <option value="11:00">11:00</option>
		                                  <option value="12:00">12:00</option>
		                                  <option value="13:00">13:00</option>
		                                  <option value="14:00">14:00</option>
		                                  <option value="15:00">15:00</option>
		                                  <option value="16:00">16:00</option>
		                                  <option value="17:00">17:00</option>
		                                  <option value="18:00">18:00</option>
		                                  <option value="19:00">19:00</option>
		                                  <option value="20:00">20:00</option>
		                                  <option value="21:00">21:00</option>
		                                  <option value="22:00">22:00</option>
		                                  <option value="23:00">23:00</option>
		                                  <option value="24:00">24:00</option>
		                                </select>
									</div>

									<div class="col s4">
										<?php echo form_label('Location', $Location['id']); ?>
										<?php echo form_input($Location); ?>
										<?php echo form_error($Location['name']); ?><?php echo isset($errors[$Location['name']])?$errors[$Location['name']]:''; ?>
									</div>

									<div class="col s4">
										<?php echo form_label('Capacity', $Capacity['id']); ?>
										<?php echo form_input($Capacity); ?>
										<?php echo form_error($Capacity['name']); ?><?php echo isset($errors[$Capacity['name']])?$errors[$Capacity['name']]:''; ?>
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
     
    <script>

     </script>

