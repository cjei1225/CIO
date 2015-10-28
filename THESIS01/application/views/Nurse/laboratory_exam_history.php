<?php

include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
?>
<main >

	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Nurse/side_bar_history.php'); ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php    include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	      	   
				<table class="table table-striped centered table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Laboratory Test</th>
                            <th>Results</th>
                            <th>Action Done</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($lab_info as $info){ ?>
                            <tr>
                                <td><?php echo $info->lab_date;  ?></td>
                                <td><?php echo $info->lab_test; ?></td>
                                <td><?php echo $info->lab_result; ?></td>
                                <td><?php echo $info->lab_action; ?></td>
                            </tr>
                            <?php } ?>

                        <?php if($lab_info == null){ ?><tr><td colspan="4"><h6>No data </h6></td></tr> <?php } ?>
                    </tbody>
                </table>
                <br>
                
	      	</div>
	    	 </fieldset>
            </div>
	    </div>
	</div>
</main>
