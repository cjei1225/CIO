<?php
$notesReco = array(
  'name'  => 'notesReco',
  'id'  => 'notesReco',
  'value' => set_value('notesReco'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');

?>

<main >

 <div class="container">
     <div class="row">
       <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Nurse/side_bar_custody.php'); ?>
        <div class="col s10">
          <fieldset class="z-depth-1">
           <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>
           
          <?php foreach($note_info as $info){ 

              $created = date('M-d-Y',strtotime($info->created));
              $staff_name = $info->first_name." ".$info->last_name;
              $notes = $info->notes;

            }
                if($note_info == null){
                $created = "No data";
                $staff_name = "No data";
                $notes = "No data";
                           
                }

               ?>
                 
            <center>
                <h5 class="bold">Previous Input</h5>
              </center>
              <h5 class="divider black"></h5>
              <div class="form-group">
                
                    <label>Update Date: <?php echo $created; ?></label><br>
                    <label>Notes: <?php echo $notes; ?></label><br>
                    <label>Noted By: <?php echo $staff_name; ?></label><br>
                
              </div>
     	<?php echo form_open("auth/insert_notes_recommendation"); ?>
      	
        	<center><h5 class="bold">NOTES / RECOMMENDATIONS</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
              <?php echo form_hidden('client_id', $client_id);
              ?>
              Notes and/or Recommendation<br>
      				<?php echo form_textarea($notesReco); ?>  
              <div class="input-field col s9 ">
              </div>
              <div class="input-field col s3 ">
              <?php foreach($doc_info as $doc_info) 
              { ?>
                <?php  echo form_hidden('doc_id', $doc_info->id); ?>
                Doctor:  <br>
                <?php  echo "Dr.".$doc_info->first_name." ".$doc_info->first_name; ?><br>
        				License No: <br>
        				insert code here <br>
                <?php // echo $doc_info->licenseNo; ?>
        				PTR No: <br>
                insert code here 
        				<?php // echo $doc_info->ptrNo; ?><br>
        				Hospital / Clinic: <br>
                insert code here 
                <?php // echo $doc_info->hospitalClinic; ?><br>
             <?php }
              ?>
              </div>
            <div>
           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
            </div>
             </fieldset>
               		<?php echo form_close(); ?>
        </div>
      </div>
  </div>
</main>