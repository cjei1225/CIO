<?php 
$i = 0;

/* foreach($lol as $wee)
	{
		foreach($wee as $lel)
		{
			echo '<br>'.$lel;
		}
		
	} */ ?>
<main>
	<div class="container" >
	   <div class="row">

	   		<div class="col s6">
		       	<div class="col s12">
	          		<div class="card blue-grey darken-1">
			            <div class="card-content white-text">
			            	<span class="card-title">Conferences</span>
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

		      	<div class="col s12">
	          		<div class="card blue-grey darken-1">
			            <div class="card-content white-text">
			            	<span class="card-title">Medical Requests</span>
			            	<table class="white-text">
			            		<thead>
			            			<td>Client</td>
			            			<td>Examination</td>
			            			<td>Status</td>
			            			<td></td>
			            		</thead>
			            		<tbody>
			            			<?php foreach($Request_count as $row_request){ ?>
				            			<tr>
				            				<td><?php echo $row_request->client_fname;?></td>
				            				<td><?php 
					            				if($row_request->request_type == 2){echo 'Medical';}
					            				elseif($row_request->request_type == 4){echo 'Psychological';}
					            				elseif($row_request->request_type == 3){echo 'Psychiatrict';}
					            				elseif($row_request->request_type == 6){echo 'Physical Therapy';}?>
				            				</td>

				            				<td><?php 
				            					if($row_request->status == 0){echo 'In - Progress';}
				            					elseif($row_request->status == 1){echo 'Done';}?>
				            				</td>
				            				<?php if($row_request->status == 1){echo '<td><button class="btn  waves-effect   green right disabled" type="submit" name="action">Follow up</button></td>';} 
				            				elseif($row_request->status == 0){echo '<td><button class="btn  waves-effect  right green " type="submit" name="action">Follow up</button></td>';}
				            					?>
				       
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
					              <a href="SW_pending_client_list">See More</a>
					            </div>
			            	</div>
		          		</div>
		        	</div>


		        	<div class="col s12">
		          		<div class="card blue-grey darken-1">
				            <div class="card-content white-text">
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
				            				<td> <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">View</button> </td>
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
