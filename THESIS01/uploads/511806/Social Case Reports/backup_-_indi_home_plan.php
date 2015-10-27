<?php 
$activity = array(
  'name'  => 'activity[]',
  'id'  => 'activity',
  'value' => set_value('activity'),
  'style' => 'width:50%;'
);

$time = array(
  '-----'  => '-----',
  '01:00'  => '01:00',
  '02:00'  => '02:00',  
  '03:00'  => '03:00',  
  '04:00'  => '04:00',  
  '05:00'  => '05:00', 
  '06:00'  => '06:00',
  '07:00'  => '07:00',
  '08:00'  => '08:00',
  '09:00'  => '09:00',
  '10:00'  => '10:00',
  '11:00'  => '11:00',  
  '12:00'  => '12:00',  
  '13:00'  => '13:00',  
  '14:00'  => '14:00', 
  '15:00'  => '15:00',
  '16:00'  => '16:00',
  '17:00'  => '17:00',
  '18:00'  => '18:00',
  '19:00'  => '19:00',
  '20:00'  => '20:00',  
  '21:00'  => '21:00',  
  '22:00'  => '22:00',  
  '23:00'  => '23:00', 
  '24:00'  => '24:00'

);


foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $birthday       = $row_info->birthday;
    $dorm_name      = $row_info->d_name;
    $sw_id          = $row_info->sw_id;
    $sector         = $row_info->client_sector;
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

$age = ageCalculator($birthday);


?>

<style>

#design_drop select {
display: block;
width: 100%;
height: 34px;
padding: 6px 12px;
font-size: 14px;
line-height: 1.42857143;
color: #555;
background-color: #fff;
background-image: none;
border: 1px solid #ccc;
border-radius: 4px;
}

#remove_design input {
  color: white;
  background-color: transparent;
  border:0;
  padding: 1px 6px;
}

#submit a {
  color: white;
  border:0;
  text-decoration: none;
}

</style>
<main >
   <div class="container">
      <div class="row">
          <div class="col s2 left">
            <div class=" grey lighten-4" style="height:100%;">
                <div class="panel-body" style="height:100%;" >
                <?php 
                $file = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports' . DIRECTORY_SEPARATOR; 
                echo form_open('auth/SW_Discharge');
                echo form_hidden('client_id', $client_id );
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Discharge</button>
                <?php echo form_close(); ?>
                  
                <?php
                echo form_open('auth/socialW_medical_profile');
                echo form_hidden('client_id', $client_id);
                ?>

                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Medical</button>
                <?php
                echo form_close();
                ?>

                <?php
                echo form_open('auth/socialW_case_profile');
                echo form_hidden('client_id', $client_id);
                echo form_hidden('sw_id', $sw_id);                          
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Case</button>
                <?php
                echo form_close();
                ?>

                <?php
                echo form_open('auth/get_client_checklist_items');
                echo form_hidden('client_id', $client_id); ?>

                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Check List</button>
                <?php
                echo form_close();
                ?>

                <?php
                echo form_open('auth/get_house_reports');
                echo form_hidden('client_id', $client_id); ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">House Reports</button>
                <?php
                echo form_close();
                ?>

                <?php echo form_open('auth/before_inter'); 
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Intervention Material</button>
                <?php echo form_close(); ?>

                <?php echo form_open('auth/before_home_report'); 
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Home Visit Report</button>
                <?php echo form_close(); ?>
                <?php if($sector == '1')
                { ?>
                <?php echo form_open('auth/before_kasunduan');
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Kasunduan</button>
                <?php echo form_close(); ?>
                <?php } ?>
                <?php if($sector == '2')
                { ?>
                <?php echo form_open('auth/before_aff_undertaking');
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Affidavit of Undertaking</button>
                <?php echo form_close(); ?>
                <?php } ?>
                <?php echo form_open('auth/create_indi_home_plan'); 
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Indi Home Plan</button>
                <?php echo form_close(); ?>
                </div>
            </div>
          </div> 
          <div class="col s10">
          	<fieldset class="z-depth-2">
              <?php echo form_open("auth/submit_indi_home_plan"); ?>
              <?php echo form_hidden('client_id', $client_id); ?>
            	<center><h5 class="bold">Individualized Home Plan</h5></center>
              <h5 class="divider black"></h5>
              <div class="form-group">
                  <label>Name: <?php echo $fname." ".$lname; ?> </label>
                  </br>
                  <label>Age: <?php echo $age; ?></label>
                  </br>
                  <label>Ward: <?php echo $dorm_name; ?></label>
                  </br>
                  </br>
                    <table class="centered" id="myTable" >
                      <thead>
                        <tr>
                          <th>Time</th>
                          <th>Activities</th>
                          <th>Person(s) Responsible</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-group col s5">
                              <div id="design_drop"><select name="timeStart[0]">
<option value="-----" disabled selected>-----</option>
<option value="01:00">01:00</option>
<option value="02:00">02:00</option>
<option value="03:00">03:00</option>
<option value="04:00">04:00</option>
<option value="05:00">05:00</option>
<option value="06:00">06:00</option>
<option value="07:00">07:00</option>
<option value="08:00">08:00</option>
<option value="09:00">09:00</option>
<option value="10:00">10:00</option>
<option value="11:00">11:00</option>
<option value="12:00">12:00</option>
<option value="13:00">13:00</option>
<option value="14:00">14:00</option>
<option value="15:00">15:00</option>
<option value="16:00">16:00</option>
<option value="17:00">17:00</option>
<option value="18:00">18:00</option>
<option value="19:00">19:00</option>
<option value="20:00">20:00</option>
<option value="21:00">21:00</option>
<option value="22:00">22:00</option>
<option value="23:00">23:00</option>
<option value="24:00">24:00</option>
</select></div>
                            </div>
                            <div class="col s2"> - </div> 
                            <div class="form-group col s5">
                              <div id="design_drop"><select name="timeEnd[0]">
<option value="-----" disabled selected>-----</option>
<option value="01:00">01:00</option>
<option value="02:00">02:00</option>
<option value="03:00">03:00</option>
<option value="04:00">04:00</option>
<option value="05:00">05:00</option>
<option value="06:00">06:00</option>
<option value="07:00">07:00</option>
<option value="08:00">08:00</option>
<option value="09:00">09:00</option>
<option value="10:00">10:00</option>
<option value="11:00">11:00</option>
<option value="12:00">12:00</option>
<option value="13:00">13:00</option>
<option value="14:00">14:00</option>
<option value="15:00">15:00</option>
<option value="16:00">16:00</option>
<option value="17:00">17:00</option>
<option value="18:00">18:00</option>
<option value="19:00">19:00</option>
<option value="20:00">20:00</option>
<option value="21:00">21:00</option>
<option value="22:00">22:00</option>
<option value="23:00">23:00</option>
<option value="24:00">24:00</option>
</select></div>
                            </div>
                          </td>
                          <td><?php echo form_input($activity, $activity['id']); ?>
                          </td>
                          <td>
                            <div id="design_drop">
                              <select name="personRes[0]"> 
                                <option value="" disabled selected>Person</option>
                                <?php
                                foreach ($user as $row_users)
                                {
                                echo"<option value='".$row_users->id."'>".$row_users->first_name.' '.$row_users->last_name.'</option>'; 
                                }
                                ?>
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  <div>
                    <button type="button" onclick=myFunction() value="view" class="btn  waves-effect btn-md  blue z-depth-2">Add row</button>
                    <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
                  </div>
              </div>
              <?php echo form_close(); ?>
            </fieldset> 
          </div>   		
      </div>
  </div>
</main>

<script>
var c = 1a;
function myFunction() {
   var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
   var row   = tableRef.insertRow(tableRef.rows.length);
    var td1 = row.insertCell(0);
    var td2 = row.insertCell(1);
    var td3 = row.insertCell(2);

     td1.innerHTML = "<div class=\"form-group col s5\"><div id=\"design_drop\"><select name=\"timeStart["+c+"]\"><option value=\"-----\" disabled selected>-----</option><option value=\"01:00\">01:00</option><option value=\"02:00\">02:00</option><option value=\"03:00\">03:00</option><option value=\"04:00\">04:00</option><option value=\"05:00\">05:00</option><option value=\"06:00\">06:00</option><option value=\"07:00\">07:00</option><option value=\"08:00\">08:00</option><option value=\"09:00\">09:00</option><option value=\"10:00\">10:00</option><option value=\"11:00\">11:00</option><option value=\"12:00\">12:00</option><option value=\"13:00\">13:00</option><option value=\"14:00\">14:00</option><option value=\"15:00\">15:00</option><option value=\"16:00\">16:00</option><option value=\"17:00\">17:00</option><option value=\"18:00\">18:00</option><option value=\"19:00\">19:00</option><option value=\"20:00\">20:00</option><option value=\"21:00\">21:00</option><option value=\"22:00\">22:00</option><option value=\"23:00\">23:00</option><option value=\"24:00\">24:00</option></select></div></div><div class=\"col s2\">-</div><div class=\"form-group col s5\"><div id=\"design_drop\"><select name=\"timeEnd[]\"><option value=\"-----\" disabled selected>-----</option><option value=\"01:00\">01:00</option><option value=\"02:00\">02:00</option><option value=\"03:00\">03:00</option><option value=\"04:00\">04:00</option><option value=\"05:00\">05:00</option><option value=\"06:00\">06:00</option><option value=\"07:00\">07:00</option><option value=\"08:00\">08:00</option><option value=\"09:00\">09:00</option><option value=\"10:00\">10:00</option><option value=\"11:00\">11:00</option><option value=\"12:00\">12:00</option><option value=\"13:00\">13:00</option><option value=\"14:00\">14:00</option><option value=\"15:00\">15:00</option><option value=\"16:00\">16:00</option><option value=\"17:00\">17:00</option><option value=\"18:00\">18:00</option><option value=\"19:00\">19:00</option><option value=\"20:00\">20:00</option><option value=\"21:00\">21:00</option><option value=\"22:00\">22:00</option><option value=\"23:00\">23:00</option><option value=\"24:00\">24:00</option></select></div></div>";
    td2.innerHTML = "<input style=\"width:50%;\" type=\"text\" name=\"activity[]\" value=\"\" id=\"activity\"/> ";
    td3.innerHTML = "<div id=\"design_drop\"><select name=\"personRes[]\"> <option value=\"\" disabled selected>Person</option><?php foreach ($user as $row_users){echo '<option value='.$row_users->id.'>'.$row_users->first_name.' '.$row_users->last_name.'</option>'; }?></select></div>";

   row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);

     window.C = c + 1;

}
</script>