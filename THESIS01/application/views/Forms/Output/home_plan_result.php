<?php
include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
<main >

	 <div class="container">
	    <div class="row">
            <?php
    
            if($status == 0)
            {
              include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
            }
            elseif($status == 1)
            {
              include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
            }
            ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <center>
	            <h5 class="bold">Home Plan</h5>
	          </center>
	          <h5 class="divider black"></h5>
              <center>
                  <h6 >Social Service Department</h6>
                </center>
                <center>
                  <h6 ><b>INTERVENTION CASE CONFERENCE</b></h6>
                </center>
                <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
                 <h5 class="divider black"></h5>
	           <br><br>
	      	   
				<table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Action</th>
                            <th>Person Responsible</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($home_plan_items as $item){ ?>
                            <tr>
                                <td><?php echo $item->time_start.' - '.$item->time_end; ?></td>
                                <td><?php echo $item->activity; ?></td>
                                <td><?php echo $item->first_name." ".$item->last_name; ?></td>

                        
                            </tr>
                            <?php } ?>

                      
                    </tbody>
                </table>
                <br>
                
	      	</div>
	    	 </fieldset>
            </div>
	    </div>
	</div>
</main>
