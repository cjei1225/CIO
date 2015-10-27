<?php 
$activity = array(
  'name'  => 'activity[]',
  'id'  => 'activity',
  'value' => set_value('activity'),
  'style' => 'width:50%;'
);

 include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');

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
                              <div id="design_drop">
                                <select name="timeStart[0]">
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
                                </select>
                              </div>
                            </div>
                            <div class="col s2"> - </div> 
                            <div class="form-group col s5">
                              <div id="design_drop">
                                <select name="timeEnd[0]">
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
                                </select>
                              </div>
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
                    
                    <input id="ctr" type="hidden" value="1" />
                    <!-- ^ THIS IS CTR -->

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
var c = 1;
function myFunction() {
   var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
   var row   = tableRef.insertRow(tableRef.rows.length);
    var td1 = row.insertCell(0);
    var td2 = row.insertCell(1);
    var td3 = row.insertCell(2);

     td1.innerHTML = "<div class=\"form-group col s5\"><div id=\"design_drop\"><select name=\"timeStart["+window.c+"]\"><option value=\"-----\" disabled selected>-----</option><option value=\"01:00\">01:00</option><option value=\"02:00\">02:00</option><option value=\"03:00\">03:00</option><option value=\"04:00\">04:00</option><option value=\"05:00\">05:00</option><option value=\"06:00\">06:00</option><option value=\"07:00\">07:00</option><option value=\"08:00\">08:00</option><option value=\"09:00\">09:00</option><option value=\"10:00\">10:00</option><option value=\"11:00\">11:00</option><option value=\"12:00\">12:00</option><option value=\"13:00\">13:00</option><option value=\"14:00\">14:00</option><option value=\"15:00\">15:00</option><option value=\"16:00\">16:00</option><option value=\"17:00\">17:00</option><option value=\"18:00\">18:00</option><option value=\"19:00\">19:00</option><option value=\"20:00\">20:00</option><option value=\"21:00\">21:00</option><option value=\"22:00\">22:00</option><option value=\"23:00\">23:00</option><option value=\"24:00\">24:00</option></select></div></div><div class=\"col s2\">-</div><div class=\"form-group col s5\"><div id=\"design_drop\"><select name=\"timeEnd[]\"><option value=\"-----\" disabled selected>-----</option><option value=\"01:00\">01:00</option><option value=\"02:00\">02:00</option><option value=\"03:00\">03:00</option><option value=\"04:00\">04:00</option><option value=\"05:00\">05:00</option><option value=\"06:00\">06:00</option><option value=\"07:00\">07:00</option><option value=\"08:00\">08:00</option><option value=\"09:00\">09:00</option><option value=\"10:00\">10:00</option><option value=\"11:00\">11:00</option><option value=\"12:00\">12:00</option><option value=\"13:00\">13:00</option><option value=\"14:00\">14:00</option><option value=\"15:00\">15:00</option><option value=\"16:00\">16:00</option><option value=\"17:00\">17:00</option><option value=\"18:00\">18:00</option><option value=\"19:00\">19:00</option><option value=\"20:00\">20:00</option><option value=\"21:00\">21:00</option><option value=\"22:00\">22:00</option><option value=\"23:00\">23:00</option><option value=\"24:00\">24:00</option></select></div></div>";
    td2.innerHTML = "<input style=\"width:50%;\" type=\"text\" name=\"activity[]\" value=\"\" id=\"activity\"/> ";
    td3.innerHTML = "<div id=\"design_drop\"><select name=\"personRes[]\"> <option value=\"\" disabled selected>Person</option><?php foreach ($user as $row_users){echo '<option value='.$row_users->id.'>'.$row_users->first_name.' '.$row_users->last_name.'</option>'; }?></select></div>";
    
    /*
    *     
    *     something = getElementById("#ctr") --> id = ctr  
    *     something.attr("value", c) <-- something like this
    */
   row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);

     window.c = window.c + 1;

}
</script>