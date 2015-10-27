<?php 
$Pname = array(
  'name'  => 'Pname',
  'id'  => 'Pname',
  'value' => set_value('Pname'),
);

$address = array(
  'name'  => 'address',
  'id'  => 'address',
  'value' => set_value('address'),
);

$duration = array(
  'name'  => 'duration',
  'id'  => 'duration',
  'value' => set_value('duration'),
);

$signature = array(
  'name'  => 'signature',
  'id'  => 'signature',
  'value' => set_value('signature'),
);

$witness1 = array(
  'name'  => 'witness1',
  'id'  => 'witness1',
  'value' => set_value('witness1'),
);

$witness2 = array(
  'name'  => 'witness2',
  'id'  => 'witness2',
  'value' => set_value('witness2'),
);

?>


<main >

 <div class="container">
    <div id="loginsize">
      <?php echo form_open("auth/input_kasunduan"); ?>
        <fieldset class="z-depth-2">
          <center><h5 class="bold">Kasunduan Input Form</h5></center>
            <h5 class="divider black"></h5>
            <div class="form-group">
              <?php echo form_hidden('client_id', $client_id); ?>
              <div class="input-field col s6 ">
                <?php echo form_label('Pname', $Pname['id']); ?>
                <?php echo form_input($Pname); ?>
              </div>
              <div class="input-field col s6 ">
                <?php echo form_label('address', $address['id']); ?>
                <?php echo form_input($address); ?>
              </div>
              <div class="input-field col s6 ">
                <?php echo form_label('duration', $duration['id']); ?>
                <?php echo form_input($duration); ?>
              </div>
              <div class="input-field col s6 ">
                <?php echo form_label('signature', $signature['id']); ?>
                <?php echo form_input($signature); ?>
              </div>
              <div class="input-field col s6 ">
                <?php echo form_label('witness1', $witness1['id']); ?>
                <?php echo form_input($witness1); ?>
              </div>
              <div class="input-field col s6 ">
                <?php echo form_label('witness2', $witness2['id']); ?>
                <?php echo form_input($witness2); ?>
              </div>
              <div>
              <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
              </div>
              <?php echo form_close(); ?>
            </div>
         </fieldset>        
    
 </div>
</main>