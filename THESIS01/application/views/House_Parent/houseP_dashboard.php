<?php

$client_id = array(
	'name'  => 'client_id[]',
	'id'    => 'client_id',
	'value' => set_value('client_id'),
	);
$remark = array(
	'name'  => 'remark[]',
	'id'    => 'remark',

	);
$i = 0;
?>


<main>
	<div class="container">
		<div class="row">
			<div class="col s10 offset-s1">
				<fieldset class="z-depth-2">	
					<center><h5 class="bold">Daily Report</h5></center>
					<h5 class="divider black"></h5>
					<div class="form-group">   
						<div class="table-responsive">
						<?php echo form_open('auth/hp_report_log'); ?>
							<table class="table centered striped bordered hoverable" id="dataTables-example">
								
								<thead>
									<tr>
										
										<th data-field="clientname">Client Name</th>
										<th data-field="remarks">Remarks</th>
									</tr>
								</thead>
								<tbody>
									
										<?php foreach($client_list as $row_client)
										{ $i = $i + 1;?>
												
												<tr>
												<?php if (is_null($row_client->client_lname)){
													$lname = 'unknown';
												}
												else
												{	$lname = $row_client->client_lname;
													}
													?>
													<td><?php echo $row_client->client_fname." ".$lname;?> </td>
													<td><?php echo form_input($remark); ?></td>
													<?php 
													echo form_hidden('date[]', date("m/d/y"));
													echo form_hidden('client_id[]', $row_client->client_id);
													?> 
												<td></td>
												</tr>
												
										<?php } ?>   
								    
								</tbody>
							</table>
							 <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
									 <?php echo form_close();  ?>
						</div>
						<div>
	           				
	            		</div>
					</div>     
				</fieldset> 
			</div>
		</div>
	</div>
</main>