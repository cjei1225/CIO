<?php 
$path = array(
  'name'  => 'path',
  'id'    => 'path',
  'value' => set_value('path'),
  );

$file = array(
  'name'  => 'file',
  'id'    => 'file',
  'value' => set_value('file'),
  );

$file_ploc = array(
  'name'  => 'file_ploc',
  'id'    => 'file_ploc',
  'placeholder' => 'Physical Location',
  'value' => set_value('file_ploc'),
  'class' => 'form-control',
  'length' => 20,

  );

$document_type = '20';

foreach($Profile_details as $Profile) 
{
  $id      = $Profile->id;
  $fname   = $Profile->first_name;
  $lname   = $Profile->last_name;
  $email   = $Profile->email;
  $role    = $Profile->role;
  $signature = $Profile->signature;
}

?>
<main>
  <div class="container">
    <div class="row">



      <div class="col s10">
        <fieldset class="z-depth-2">
          <center>
            <h5 class="bold">Profile</h5>
          </center>
          <h5 class="divider black"></h5>
          <div class="form-group">
            <img src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
            <label >Name: <?php echo $fname." ".$lname; ?> </label>
            <br>
            <label >Sector: <?php 
            if($role == "7"){echo "Older Persons";}
            elseif($role == "8"){echo "Special Needs";}
            elseif($role == "9"){echo " Crisis Situation ";}
            elseif($role == "10"){echo "child and Youth";}
            else{echo "Meh";} ?> </label>
            <br>
            <label >Role: <?php echo $role; ?> </label>
            <br>
            <label >Signature: <?php 
            if($signature == null)
            {
              echo form_open('auth/upload_signature');
              echo form_hidden('id', $id);
              
              echo form_close();
            } 
            else{echo "Meh";}?></label>
            <br>

                            
          </div>
          <div class="row">
            <div class="col s12">
           
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </main>