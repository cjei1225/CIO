<main>
	<div class="container">
	   	<div class="row">	   		
	       	<div class="col s6">
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
			                            <button class="btn  waves-effect green right" type="submit" name="action">View</button>
			                            <?php echo form_close();?></td>
		            			</tr>
		            			<?php } ?>
		            		</tbody>
		            	</table>
	            	</div>
	      		</div>
	    	</div>

	      	<div class="col s6">
	      		<div class="card blue-grey darken-1">
		            <div class="card-content white-text">
		            	<span class="card-title">Medical Requests</span>
		            	<table class="white-text">
		            		<thead>
		            			<td>Client name</td>
		            			<td>Request Type</td>
		            			<td>Status</td>
		            			<td>Follow up</td>
		            		</thead>
		            		<tbody>
		            			<?php foreach($Request_count as $row_request){ ?>
			            			<tr>
			            				<td><?php echo $row_request->client_fname;?></td>
			            				<td><?php 
				            				if($row_request->request_type == 2){echo 'Medical Examination';}
				            				elseif($row_request->request_type == 4){echo 'Psychological Examination';}
				            				elseif($row_request->request_type == 3){echo 'Psychiatrict Examination';}
				            				elseif($row_request->request_type == 6){echo 'Physical Therapy';}?>
			            				</td>

			            				<td><?php 
			            					if($row_request->status == 0){echo 'In - Progress';}
			            					elseif($row_request->status == 1){echo 'Done';}?>
			            				</td>
			            				<td> Follow up 1 </td>
			            			</tr>
		            			<?php } ?>
		            		</tbody>
		            	</table>
	            	</div>
	      		</div>
	      	</div>  	
      	</div>
    </div>
</main>