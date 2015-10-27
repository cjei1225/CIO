<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12" >
			<h1 class="page-header">List of Client</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" id="headhead">
					Client Directory
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Client No.</th>
									<th>Last Name</th>
									<th>First Name</th>
									<th>Gender</th>
									<th>Sector</th>
									<th>Dorm</th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
							
                            <?php foreach($client_list as $row_client){?>
                            <tr class="odd gradeX">
                                <td><?php echo $row_client->client_id; ?></td>
                                <td><?php echo $row_client->client_lname; ?></td>
                                <td><?php echo $row_client->client_fname; ?></td>
                                <td class="center"><?php 
                                if ($row_client->gender == 1){echo "Male";}
                                elseif($row_client->gender == 2){echo "Female";} ?> </td>
                                <td class="center"><?php 
	                                if ($row_client->client_sector == 1){echo "Child and youth";}
	                                elseif($row_client->client_sector == 2){echo "Older Person";}
	                                elseif($row_client->client_sector == 3){echo "Special Needs";}
	                                elseif($row_client->client_sector == 4){echo "Crisis Situation";} ?> 
                            	</td>
                            	<td><?php echo $row_client->dorm_id; ?></td>
                            <td><div class="btn btn-primary btn-sm" id="nurse"> <?php echo anchor('/auth/nurse_reports/', 'Select'); ?></div></td>

                            
                            </tr>
                            <?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->

			</div>