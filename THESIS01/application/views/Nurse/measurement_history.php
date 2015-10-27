<?php
include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
<main >

	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views//Nurse/side_bar_history.php'); ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	      	
				<table class="table table-striped centered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Blood Pressure</th>
                            <th>Pulse Rate/Min</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Temperature</th>
                            <th>Respiratory Rate/Min</th>
                            <th>Head Cir.</th>         
                            <th>Chest Cir.</th>
							<th>Abdomen Cir.</th>
                            <th>Examiner</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($measure_info as $info){
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo date('M-d-Y',strtotime($info->created)); ?></td>
                            <td><?php echo $info->blood_pressure; ?></td>
                            <td><?php echo $info->pulse_rate; ?></td>
                            <td><?php echo $info->height; ?></td>
                            <td><?php echo $info->weight; ?></td>
                            <td><?php echo $info->temperature; ?></td>
                            <td><?php echo $info->respiratory_rate; ?></td>
                            <td><?php echo $info->head_circum; ?></td>
                            <td><?php echo $info->chest_circum; ?></td>
                            <td><?php echo $info->abdomen_circum; ?></td>
                            <td><?php echo $info->first_name." ".$info->last_name; ?></td>
                        </tr>        
                            <?php } ?>
                    </tbody>
                </table>

	      	</div>
	    	 </fieldset>
            </div>
	    </div>
	</div>
</main>
