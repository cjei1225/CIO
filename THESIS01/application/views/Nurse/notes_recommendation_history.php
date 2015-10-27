<?php

include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
<main >

	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/Nurse/side_bar_history.php'); ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	      	   
				<table class="table table-striped centered table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Noted By</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($note_info as $info){ ?>
                            <tr>
                                <td><?php echo date('M-d-Y',strtotime($info->created));  ?></td>
                                <td><?php echo $info->notes; ?></td>
                                <td><?php echo $info->first_name." ".$info->last_name; ?></td>
                            </tr>
                            <?php } ?>

                        <?php if($note_info == null){ ?><tr><td colspan="3"><h6>No data </h6></td></tr> <?php } ?>
                    </tbody>
                </table>
                <br>
                
	      	</div>
	    	 </fieldset>
            </div>
	    </div>
	</div>
</main>
