<main>
	<div class="container" >

		<div class="row">
			<div class="col s12">
				<div class="col s2">
		            <?php echo form_open('auth/Admin_Conference_Create'); 

                    ?>
                   <button class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside" type="submit">Create Conference</button> 
                  <?php echo form_close(); ?>
				</div>
			</div>
			<div class="col s12">
		   	 	<fieldset class="z-depth-2">
	  		       	<table class="table table-striped table-hover" id="dataTables-example">
	            			<thead>
			            			<td>Location</td>
			            			<td>Schedule</td>
			            			<td>Starting</td>
			             			<td>Ending</td>
			            			<td>Status</td>
			            			<td>Type</td>
			            			<td></td>
			            		</thead>
			            		<tbody>
			            			<?php foreach($Conference_count as $row_conference) { ?>
			            			<tr>
			            				<td><?php echo $row_conference->Location; ?></td>
			            				<td><?php echo $row_conference->schedule; ?></td>
			            				<td><?php echo $row_conference->start_time; ?></td>
			            				<td><?php echo $row_conference->end_time;?></td>
			            				<td><?php if($row_conference->status == 0){echo 'Open';}
			            							elseif($row_conference->status == 1){echo 'Concluded';}
			            							elseif($row_conference->status == 2){echo 'Waiting for Minutes';}
			            							elseif($row_conference->status == 3){echo 'Canceled';} ?></td>
			            				<td><?php if($row_conference->conference_type == 1){echo 'Intervention Case Conference';}
					            				
					            				elseif($row_conference->conference_type == 2){echo 'Pre Admission Case Conference';}
					            				?>
					            		</td>
			            				<td><?php 
			            					echo form_open('auth/get_conference_details');
				                            echo form_hidden('conference_id', $row_conference->conference_id);
				                            echo form_hidden('conference_type', $row_conference->conference_type);
				                            ?>
				                            <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">View</button>
				                            <?php echo form_close();?></td>
			            			</tr>
			            			<?php } ?>
			            		</tbody>
	            	</table>
	          	</fieldset>
          	</div>
      	</div>
	</div>
	        

	        	
			

</main>