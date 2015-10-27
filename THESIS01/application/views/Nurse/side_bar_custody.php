<div class="col s2 left">
  <div class=" grey lighten-4" style="height:100%;">
    <div  >
      <div class="panel-body" style="height:100%;" >
        <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
        <br>
        <?php
        echo form_open('auth/measure_update');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Measurements</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/appearance_update');
        echo form_hidden('client_id', $client_id); ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Admission Appearance</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/growth_record');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit"  value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Growth Records</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/birth_update');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Birth Information</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/immunization_update');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Immunization</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/laboratory_exam');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Laboratory Exams</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/list_illness');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Illness List</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/medical_condition');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Medical Condition</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/notes_recommendation');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Notes and Recommendation</button>
        <?php
        echo form_close();
        ?>


       </div>
    </div>
  </div>
</div> 