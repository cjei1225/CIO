<?php
include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
?>
<main >

	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Nurse/side_bar_history.php'); ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	      	   
				<table class="table table-striped centered table-hover">
                    <thead>
                        <tr>
                            <th >Date Added</th>
                            <th >Immunization</th>
                            <th >Date</th>
                            <th >Physician</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($immu_info as $info){ ?>
                            <tr>
                                <td><?php echo date('M-d-Y',strtotime($info->created)); ?></td>
                                <td><?php echo $info->immunization;  ?></td>
                                <td><?php echo $info->immunization_date; ?></td>
                                <td><?php echo $info->immunization_physician; ?></td>
                        
                            </tr>
                            <?php } ?>

                        <?php if($immu_info == null){ ?><tr><td colspan="4"><h6>No data </h6></td></tr> <?php } ?>
                    </tbody>
                </table>
                <br>
                
	      	</div>
	    	 </fieldset>
            </div>
	    </div>
	</div>
</main>
