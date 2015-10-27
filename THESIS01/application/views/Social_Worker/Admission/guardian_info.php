<?php

$founder_name = array(
  'name'  => 'founder_name',
  'id'  => 'founder_name',
  'value' => set_value('founder_name'),
  'class' => 'form-control',
);

$found_when = array(
  'name'  => 'found_when',
  'id'  => 'found_when',
  'value' => set_value('found_when'),
);

$found_where = array(
  'name'  => 'found_where',
  'id'  => 'found_where',
  'value' => set_value('found_where'),
  'class' => 'form-control',
);

$found_address = array(
  'name'  => 'found_address',
  'id'  => 'found_address',
  'value' => set_value('found_address'),
  'class' => 'form-control',
);

$found_contact = array(
  'name'  => 'found_contact',
  'id'  => 'found_contact',
  'value' => set_value('found_contact'),
  'class' => 'form-control',
);

$found_age = array(
  'name'  => 'found_age',
  'id'  => 'found_age',
  'value' => set_value('found_age'),
  'class' => 'materialize-textarea',
);

$found_gender = array(
  'name'  => 'found_gender',
  'id'  => 'found_gender',
  'value' => set_value('found_gender'),
  'class' => 'materialize-textarea',
);

$surrenderer_name = array(
  'name'  => 'surrenderer_name',
  'id'  => 'surrenderer_name',
  'value' => set_value('surrenderer_name'),
  'class' => 'form-control',
);

$surrenderer_rel = array(
  'name'  => 'surrenderer_rel',
  'id'  => 'surrenderer_rel',
  'value' => set_value('surrenderer_rel'),
  'class' => 'form-control',
);

$surrenderer_age = array(
  'name'  => 'surrenderer_age',
  'id'  => 'surrenderer_age',
  'value' => set_value('surrenderer_age'),
  'class' => 'form-control',
);

$surrenderer_add = array(
  'name'  => 'surrenderer_add',
  'id'  => 'surrenderer_add',
  'value' => set_value('surrenderer_add'),
  'class' => 'form-control',
);

$surrenderer_contact = array(
  'name'  => 'surrenderer_contact',
  'id'  => 'surrenderer_contact',
  'value' => set_value('surrenderer_contact'),
  'class' => 'form-control',
);

$surrenderer_reason = array(
  'name'  => 'surrenderer_reason',
  'id'  => 'surrenderer_reason',
  'value' => set_value('surrenderer_reason'),
  'class' => 'form-control',
);

$surrenderer_gender = array(
  'name'  => 'surrenderer_gender',
  'id'  => 'surrenderer_gender',
  'value' => set_value('surrenderer_gender'),
  'class' => 'form-control',
);

$agenName = array(
  'name'  => 'agenName',
  'id'  => 'agenName',
  'value' => set_value('agenName'),
  'class' => 'form-control',
);

$agenAdd = array(
  'name'  => 'agenAdd',
  'id'  => 'agenAdd',
  'value' => set_value('agenAdd'),
  'class' => 'form-control',
);

$agenContact = array(
  'name'  => 'agenContact',
  'id'  => 'agenContact',
  'value' => set_value('agenContact'),
  'class' => 'form-control',
);

$agenSW = array(
  'name'  => 'agenSW',
  'id'  => 'agenSW',
  'value' => set_value('agenSW'),
  'class' => 'form-control',
);

$agenSWContact = array(
  'name'  => 'agenSWContact',
  'id'  => 'agenSWContact',
  'value' => set_value('agenSWContact'),
  'class' => 'form-control',
);

$agenReason = array(
  'name'  => 'agenReason',
  'id'  => 'agenReason',
  'value' => set_value('agenReason'),
  'class' => 'form-control',
);

$agenServices = array(
  'name'  => 'agenServices',
  'id'  => 'agenServices',
  'value' => set_value('agenServices'),
  'class' => 'form-control',
);



?>


<main >

<div class="container">
  <div class="row">
    <div class="col s3">
        <ul class="menu">
            <li><a href="#" ><span>Step 1: Admission Type</span></a></li>
            <li><a href="#" class="active"><span>Step 2: Guardian Information</span></a></li>
            <li><a href="#"><span>Step 3: Client Information</span></a></li>
            <li><a href="#"><span>Step 4: Background Info</span></a></li>
            <li><a href="#"><span>Step 5: View Intake Output</span></a></li>
            <li><a href="#"><span>Step 6: Upload Documents</span></a></li>
        </ul>
    </div>

      <div class="col s9">
          <fieldset class="z-depth-2">
            <center><h4 class="bold">Guardian Information</h4></center>
              <h5 class="divider black"></h5>
              <div class="form-group">
                <strong>Client ID : <?=$client_id;?></strong>
          

      <?php if($admission_type == "3")
      { ?>
        <?php echo form_open("auth/client_info_walk"); ?>
        <?php echo form_hidden('client_id', $client_id); ?> 
        <?php echo form_hidden('admission_type', $admission_type); ?> 
        <div class="col center s12">
          <h5>Founder Information</h5>
          <div class="divider"></div>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Name *', $founder_name['id']); ?>
          <?php echo form_input($founder_name); ?>
          <?php echo form_error($founder_name['name']); ?><?php echo isset($errors[$founder_name['name']])?$errors[$founder_name['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Age *'); ?>
          <input type="date" name="found_age" class="datepicker">
          <?php echo form_error($found_age['name']); ?><?php echo isset($errors[$found_age['name']])?$errors[$found_age['name']]:''; ?>
        </div>
        
        <div class="input-field col s6 "> 
          <?php echo form_label('Address *', $found_address['id']); ?>
          <?php echo form_input($found_address); ?>
          <?php echo form_error($found_address['name']); ?><?php echo isset($errors[$found_address['name']])?$errors[$found_address['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Contact number *', $found_contact['id']); ?>
          <?php echo form_input($found_contact); ?>
          <?php echo form_error($found_contact['name']); ?><?php echo isset($errors[$found_contact['name']])?$errors[$found_contact['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Gender *', $found_gender['id']); ?></br>      
          <input name="found_gender" value="1" type="radio" id="male" class="with-gap"/><label for="male">Male</label>
          <input name="found_gender" value="2" type="radio" id="fem" class="with-gap"/><label for="fem">Female</label>
           <?php echo form_error($found_gender['name']); ?><?php echo isset($errors[$found_gender['name']])?$errors[$found_gender['name']]:''; ?>
        </div>
        
        <div class="input-field col s6 ">
          <?php echo form_label('Where was the client found? *', $found_where['id']); ?>
          <?php echo form_input($found_where); ?>
          <?php echo form_error($found_where['name']); ?><?php echo isset($errors[$found_where['name']])?$errors[$found_where['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <label>When was the client found? *</label> 
          <input type="date" name="found_when" class="datepicker"/>
          <?php echo form_error($found_when['name']); ?><?php echo isset($errors[$found_when['name']])?$errors[$found_when['name']]:''; ?>
        </div>

      <?php 
      } elseif ($admission_type == "2") 
      {?>
       <?php echo form_open("auth/client_info_sur"); ?>
       <?php echo form_hidden('client_id', $client_id); ?> 
       <?php echo form_hidden('admission_type', $admission_type); ?> 

        <div class="col center s12">
          <h5>Surrender Information</h5>
          <div class="divider"></div>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Name *', $surrenderer_name['id']); ?>
          <?php echo form_input($surrenderer_name); ?>
          <?php echo form_error($surrenderer_name['name']); ?><?php echo isset($errors[$surrenderer_name['name']])?$errors[$surrenderer_name['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Relationship *', $surrenderer_rel['id']); ?>
          <?php echo form_input($surrenderer_rel); ?>
          <?php echo form_error($surrenderer_rel['name']); ?><?php echo isset($errors[$surrenderer_rel['name']])?$errors[$surrenderer_rel['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Birthdate *'); ?>
          <input type="date" name="surrenderer_age" class="datepicker">
          <?php echo form_error($surrenderer_age['name']); ?><?php echo isset($errors[$surrenderer_age['name']])?$errors[$surrenderer_age['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Address *', $surrenderer_add['id']); ?>
          <?php echo form_input($surrenderer_add); ?>
          <?php echo form_error($surrenderer_add['name']); ?><?php echo isset($errors[$surrenderer_add['name']])?$errors[$surrenderer_add['name']]:''; ?>   
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Contact number *', $surrenderer_contact['id']); ?>
          <?php echo form_input($surrenderer_contact); ?>
          <?php echo form_error($surrenderer_contact['name']); ?><?php echo isset($errors[$surrenderer_contact['name']])?$errors[$surrenderer_contact['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Reason *', $surrenderer_reason['id']); ?>
          <?php echo form_input($surrenderer_reason); ?>
          <?php echo form_error($surrenderer_reason['name']); ?><?php echo isset($errors[$surrenderer_reason['name']])?$errors[$surrenderer_reason['name']]:''; ?>    
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Gender *', $surrenderer_gender['id']); ?></br>         
          <input name="surrenderer_gender" value="1" type="radio" id="male" class="with-gap"/><label for="male">Male</label>
          <input name="surrenderer_gender" value="2" type="radio" id="fem" class="with-gap"/><label for="fem">Female</label>
          <?php echo form_error($surrenderer_gender['name']); ?><?php echo isset($errors[$surrenderer_gender['name']])?$errors[$surrenderer_gender['name']]:''; ?>    
        </div>
      <?php 
      } elseif ($admission_type == "1") 
      {?>
        <?php echo form_open("auth/client_info_ref"); ?>
        <?php echo form_hidden('client_id', $client_id); ?> 
        <?php echo form_hidden('admission_type', $admission_type); ?> 
        <?php echo form_hidden('agenAdd', $agenAdd); ?> 
        <div class="col center s12">
          <h5>AGENCY/INSTITUTION INFORMATION</h5>
          <div class="divider"></div>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Name of Agency / Institution *', $agenName['id']); ?>
          <?php echo form_input($agenName); ?>
          <?php echo form_error($agenName['name']); ?><?php echo isset($errors[$agenName['name']])?$errors[$agenName['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Agency Address *', $agenAdd['id']); ?>
          <?php echo form_input($agenAdd); ?>
          <?php echo form_error($agenAdd['name']); ?><?php echo isset($errors[$agenAdd['name']])?$errors[$agenAdd['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Agency Contact Number *', $agenContact['id']); ?>
          <?php echo form_input($agenContact); ?>
           <?php echo form_error($agenContact['name']); ?><?php echo isset($errors[$agenContact['name']])?$errors[$agenContact['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Social Worker In-charge *', $agenSW['id']); ?>
          <?php echo form_input($agenSW); ?>
          <?php echo form_error($agenSW['name']); ?><?php echo isset($errors[$agenSW['name']])?$errors[$agenSW['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Social Worker Contact Number *', $agenSWContact['id']); ?>
          <?php echo form_input($agenSWContact); ?>
          <?php echo form_error($agenSWContact['name']); ?><?php echo isset($errors[$agenSWContact['name']])?$errors[$agenSWContact['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Reason *', $agenReason['id']); ?>
          <?php echo form_input($agenReason); ?>
          <?php echo form_error($agenReason['name']); ?><?php echo isset($errors[$agenReason['name']])?$errors[$agenReason['name']]:''; ?>
        </div>

        <div class="input-field col s6 ">
          <?php echo form_label('Services Received from the Agency', $agenServices['id']); ?>
          <?php echo form_input($agenServices); ?>
          <?php echo form_error($agenServices['name']); ?><?php echo isset($errors[$agenServices['name']])?$errors[$agenServices['name']]:''; ?>    
        </div>      
      <?php } ?>       
        
        </div>
        <div class="col s12  center">
                <button class="btn  waves-effect green z-depth-2" type="submit" name="action">Submit</button>
              </div>
              </fieldset>
                    <?php echo form_close(); ?>
          </div>
      </div>
    </div>
</main>

    <script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>