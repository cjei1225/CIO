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
$point = array(
  'name'  => 'point[]',
  'id'    => 'point',
  'value' => set_value('point'),
  );

$point2 = array(
  'name'  => 'point[]',
  'id'    => 'point',
  'value' => set_value('point'),
  'style' => 'width:80%;',
  'class' => 'right'
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

foreach($pre_admission_details as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $sector         = $row_info->client_sector;
    $gender         = $row_info->gender;
    $birth_place    = $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
    $schedule       = $row_info->schedule;
    $conference_id  = $row_info->conference_id;
    $birthday       = $row_info->birthday;
    $start_time     = $row_info->start_time;
    $end_time       = $row_info->end_time;
    $created        = $row_info->created;


}
if($birthday != null)
{
  $age = ageCalculator($birthday);
}
else
{
  $age = ageCalculator($created);
}
function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
if($birthday != null){
$age = ageCalculator($birthday);
}
else{
$age = ageCalculator($birthday).'(admit date, no birthday)';
}
?>


<main >
          
          <div class="container">
            
            <div> 

              <fieldset class="z-depth-2">
                <?php    echo form_open('auth/conference_minutes_submission'); ?>
                <center>
                  <h6 >Social Service Department</h6>
                </center>
                <center>
                  <h6 ><b>Conference Minutes</b></h6>
                  
                </center>
               
                 <h5 class="divider black"></h5>
                   <div class="form-group">
                    <center>
                    <label class="left">Date: <?php echo date('M d Y', strtotime($schedule)); ?></label>
                    <br>
                     <label class="left">Time: <?php echo $start_time.' - '.$end_time;?></label>
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
                       <table class="table striped bordered hoverable"  id="myTable">
                        <thead>
                          <th>Point</th>

                        </thead>
                        <tbody>
                        	<?php 
								            echo form_hidden('conference_id', $conference_id);
                            echo form_hidden('client_id', $client_id);
                            ?>

                           <tr>
                            <td>
                              
                              <div class="col s11">1.<input type="text" name="point[]" value="" id="point" style="width:98%;" /></div> 
                              <div class="col s2 left"><button type="button"  value="view" class="btn  waves-effect green z-depth-2" onClick="sub_topic('1');" >Add Sub point</button></div>
                              <div class="col s10" id="sub_point_1">
                                <input type="text" name="sub_point_1[]" value="" id="point" style="width:80%;" class="right" />
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                   </div>
                    <div ALIGN="right">
                      </br>
                      <button type="button" value="view" class="btn  waves-effect btn-md  blue z-depth-2" onClick="myFunction();"> Add Row</button>
                      <button type="submit" value="view" class="btn  waves-effect btn-md  green z-depth-2">Accept</button>
                    </div>
                    <?php echo form_close(); ?>
                   </fieldset>
                </div>

          </div>
        </main>

<script>
  var main = 1;
  function myFunction() 
  {
    var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
    var row   = tableRef.insertRow(tableRef.rows.length);
    var td1 = row.insertCell(0);
    main = main + 1;
    //td1.innerHTML = "<div class=\"col s11\">"+main+"<input type=\"text\" name=\"point[]\" value=\"\" id=\"point\" style=\"width:98%;\" /></div><div class=\"col s2 left\"><button type=\"button\" value=\"view\" class=\"btn  waves-effect   green z-depth-2\" onClick=\"sub_topic();\">Add Sub point</button></div><div id=\"sub_point\" class=\"col s10\"><input type=\"text\" name=\"point[]\" value=\"\" id=\"point\" style=\"width:80%;\" class=\"right\"  /></div>";
    td1.innerHTML = "<td><div class=\"col s11\">"+main+".<input type=\"text\" name=\"point[]\" value=\"\" id=\"point\" style=\"width:98%;\" /></div><div class=\"col s2 left\"><button type=\"button\"  value=\"view\" class=\"btn  waves-effect green z-depth-2\" onClick=\"sub_topic("+(main)+");\" >Add Sub point</button></div><div class=\"col s10\" id=\"sub_point_"+(main)+"\"><input type=\"text\" name=\"sub_point_"+main+"[]\" value=\"\" id=\"point\" style=\"width:80%;\" class=\"right\" /></div></td>";
    row.appendChild(td1);
 
  }

  function sub_topic(divName)
  {
    var sub = document.getElementById('sub_point_'+divName);

    var dummy = document.createElement('div');
    dummy.innerHTML = "<input type=\"text\" name=\"sub_point_"+main+"[]\" value=\"\" id=\"point\" style=\"width:80%;\" class=\"right\" />";

    sub.appendChild(dummy);

  }
</script>