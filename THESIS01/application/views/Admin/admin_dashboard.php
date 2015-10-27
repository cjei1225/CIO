<main>
	<div class="container" >
	   <div class="row">

	   		<div class="col s6">
		       	<div class="col s12">
	          		<div class="card blue-grey darken-1">
			            <div class="card-content white-text">
			            	<span class="card-title">Meetings</span>
			            	<table class="white-text responsive-table">
			            		<thead>
			            			<td>Schedule</td>
			            			<td>Location</td>
			            			<td>Type</td>
			            			<td>Start</td>
			             			<td>End</td>
			            			<td></td>
			            		</thead>
			            		<tbody>
			            			<?php foreach($Conference_count as $row_conference) { ?>
			            			<tr>
			            				<td><?php echo date('m/d', strtotime($row_conference->schedule)); ?></td>
			            				<td><?php echo $row_conference->Location; ?></td>
			            				<td><?php 	if($row_conference->conference_type == 1){echo 'Intervention';}
					            				 	elseif($row_conference->conference_type == 2){echo 'Pre Admission';}
					            			?>
					            		</td>
			            				<td><?php echo $row_conference->start_time; ?></td>
			            				<td><?php echo $row_conference->end_time; ?></td>
			            				
			            				<td><?php 
			            					echo form_open('auth/get_conference_details');
				                            echo form_hidden('conference_id', $row_conference->conference_id);
				                            echo form_hidden('conference_type', $row_conference->conference_type);
				                            ?>
				                            <button class="btn  waves-effect green" type="submit" name="action">View</button>
				                            <?php echo form_close();?></td>
			            			</tr>
			            			<?php } ?>
			            		</tbody>
			            	</table>
		            	</div>
	          		</div>
	        	</div>

	        	
				
				<div class="col s12">
	          		<div class="card blue-grey darken-1">
			            <div class="card-content white-text">
			            	<span class="card-title">Dorm Status</span>
			            	<table class="white-text">
			            		<thead>
			            			<td>Dorm Name</td>
			            			<td>Occupants</td>
			            			<td>Vacancy</td>
			            			<td>Capacity</td>
			            		</thead>
			            		<tbody>
			            			<?php foreach($Dorm_count as $row_dorm) { ?>
			            			<tr>
			            				<td><?php echo $row_dorm->d_name; ?></td>
			            				<td><?php echo $row_dorm->d_count; ?></td>
			            				<td><?php echo $row_dorm->d_capacity - $row_dorm->d_count;?></td>
			            				<td> <?php echo $row_dorm->d_capacity;?></td>
			            			</tr>
			            			<?php } ?>
			            		</tbody>
			            	</table>
		            	</div>
	          		</div>
	        	</div>
	      </div>

	      <div class="col s6">
	        		<div class="col s12">
		          		<div class="card blue-grey darken-1">
				            <div class="card-content white-text" style="overflow-x:hidden; overflow-y:scroll; height:50%;">
				            	<span class="card-title">Pending (<?php echo $pending_count; ?>)</span>
				            	<table class="white-text">
				            		<thead>
				            			<td>Client Name</td>
				            			<td>Client ID </td>
				            			<td>Next Document</td>
				            			<td></td>
				            		</thead>
				            		<tbody>
				            			<?php foreach($Pending_client_count as $row_pending) { ?>
				            			<tr>
				            				<td><?php echo  $row_pending->client_fname;?></td>
				            				<td><?php echo $row_pending->client_id; ?></td>
				            				<td> Next Document 1 </td>
				            				<td><?php
					                            echo form_open('auth/pending_client_page');
					                            echo form_hidden('client_id', $row_pending->client_id);
					                            ?>
					                            <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">View</button>
					                            <?php echo form_close();?>
					                        </td>
				            			</tr>
				            			<?php } ?>
				            		</tbody>
				            	</table>
				            	<div class="card-action">
					              <a href="Admin_Pending_Clients">See More</a>
					            </div>
			            	</div>
		          		</div>
		        	</div>

		        	<div class="col s12">
		          		<div class="card blue-grey darken-1">
				            <div class="card-content white-text" style="overflow-x:hidden; overflow-y:scroll; height:50%;">
				            	<span class="card-title">Custody (<?php echo $custody_count; ?>)</span>
				            	<table class="white-text">
				            		<thead>
				            			<td>Client Name</td>
				            			<td>Client ID </td>
				            			<td>Next Document</td>
				            			<td>Link</td>
				            		</thead>
				            		<tbody>
				            			<?php foreach($Custody_client_count as $row_custody) { ?>
				            			<tr>
				            				<td><?php echo  $row_custody->client_fname;?></td>
				            				<td><?php echo $row_custody->client_id; ?></td>
				            				<td> Next Document 1 </td>
				            				<td><?php
					                            echo form_open('auth/admin_client_profile');
					                            echo form_hidden('client_id', $row_custody->client_id);
					                            ?>
					                            <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">View</button>
					                            <?php echo form_close();?>
					                        </td>
				            			</tr>
				            			<?php }?>
				            		</tbody>
				            	</table>
			            	</div>
		          		</div>
		        	</div>

		        	<div class="col s12">
		          		<div class="card blue-grey darken-1">
				            <div class="card-content white-text" style="overflow-x:hidden; overflow-y:scroll; height:50%;">
				            	<span class="card-title">For Discharge (<?php echo $discharge_count; ?>)</span>
				            	<table class="white-text">
				            		<thead>
				            			<td>Client Name</td>
				            			<td>Client ID </td>
				            			<td>Next Document</td>
				            			<td>Link</td>
				            		</thead>
				            		<tbody>
				            			<?php foreach($Discharge_client_count as $row_discharge){ ?>
				            			<tr>
				            				<td><?php echo  $row_discharge->client_fname;?></td>
				            				<td><?php echo $row_discharge->client_id; ?></td>
				            				<td> Next Document 1 </td>
				            				<td><?php
					                          	 echo form_open('auth/Admin_Client_Discharge');
					                            echo form_hidden('client_id', $row_discharge->client_id);
					                            ?>
					                            <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">View</button>
					                            <?php echo form_close();?>
					                        </td>
				            			</tr>
				            			<?php } ?>
				            		</tbody>
				            	</table>
			            	</div>
		          		</div>
		        	</div>
		        </div>
      	
      	</div>
    </div>

</main>