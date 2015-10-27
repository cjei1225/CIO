<div class="col s2 left">
  <div class=" grey lighten-4" style="height:100%;">
    <div  >
      <div class="panel-body" style="height:100%;" >

         <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
         <br>

      	<?php
        echo form_open('auth/measure_history');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Measurements History</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/growth_record_history');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit"  value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Growth Records</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/immunization_history');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Immunization History</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/laboratory_exam_history');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Laboratory Exams</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/list_illness_history');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Illness List</button>
        <?php
        echo form_close();
        ?>

        <?php
        echo form_open('auth/notes_recommendation_history');
        echo form_hidden('client_id', $client_id);
        ?>
        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Notes History</button>
        <?php
        echo form_close();
        ?>

       </div>
    </div>
  </div>
</div> 