<?php 
$Remarks = array(
  'name'  => 'Remarks[]',
  'id'    => 'Remarks',
  'value' => set_value('Remarks'),
  );
$Person_responsible = array(
  'name'  => 'Person_responsible',
  'id'    => 'Person_responsible',
  'value' => set_value('Person_responsible'),
  );
$task = array(
  'name'  => 'task[]',
  'id'    => 'task',
  'value' => set_value('task'),
  );
$start_date = array(
  'name'  => 'start_date',
  'id'    => 'start_date',
  'value' => set_value('start_date'),
  );
$end_date = array(
  'name'  => 'end_date',
  'id'    => 'end_date',
  'value' => set_value('end_date'),
  );


include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
?>


<main >

  <div class="container">
    <div class="row">
    <?php
    if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_custody.php');
        }

        ?>
    <div class="col s10"> 

      <fieldset class="z-depth-2">

        <center>
          <h6 >Social Service Department</h6>
        </center>
        <center>
          <h6 ><b>PLAN OF ACTION</b></h6>
          
        </center>
       
         <h5 class="divider black"></h5>
           <div class="form-group">
            <center>
            <label class="right">Date:</label>
            <br>
             <label class="right">Time:</label>
            <br>
            </center>
             <h5 class="divider black"></h5>
            <label><b>CLIENT:</b></label>
            <br>

             <label >Name:<?php echo $fname; ?></label>
              <br>
              <label>Age:<?php  echo $age; ?></label>
               <br>
               <label >Gender: <?php
               if($gender == '1'){echo 'Male';}
                elseif($gender == '2'){echo 'Female';} ?></label>
               <br>
                <label>Sector:<?php 
                if($sector == '1'){echo 'Child and Youth';}
                elseif($sector == '2'){echo 'Older Persons';}
                elseif($sector == '3'){echo 'Special Needs';}
                elseif($sector == '4'){echo 'Crisis Situation';}
                
                ?></label>
               <br>

               <label ><b> PLAN:</b></label>
               <br>
               <table class="table centered striped bordered hoverable"  id="myTable">
                <thead>
                  <th>Task/ Intervention:</th>
                  <th>Person Responsible:</th>
                  <th>Time Start:</th>
                  <th>Time End:</th>
                  <th>Remark/ Status:</th>
                </thead>
                <tbody>
                  <?php 
                  foreach($POA_details as $POA_detail)
                  {?>

                  
                
                  <tr>
                    <td><?php echo $POA_detail->task;?></td>
                    <td><?php echo $POA_detail->first_name." ".$POA_detail->last_name;?></td>
                    <td><?php echo $POA_detail->start_date;?></td>
                    <td><?php echo $POA_detail->end_date;?></td>
                    <td><?php echo $POA_detail->remarks;?></td>
                  </tr>
                    <?php $status = $POA_detail->status; 
                          $POA_id = $POA_detail->plan_of_action_id;
                    }?>

    
                </tbody>

              </table>
              <br>
              
              
           </div>
           <?php if($status == '0')
           { echo form_open('auth/edit_POA');
              echo form_hidden('POA_id', $POA_id); 
              echo form_hidden('client_id', $client_id); ?>

            <button type="submit" value="view" class="btn waves-effect  blue z-depth-2">Edit </button>
          <?php 

            echo form_close();  
          } ?>
      </fieldset>
    </div>
  </div>
</main>