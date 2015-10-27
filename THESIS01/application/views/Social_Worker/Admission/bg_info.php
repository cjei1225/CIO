<?php

$problem = array(
  'name'  => 'problem',
  'id'  => 'problem',
  'value' => set_value('problem'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'form_control',
);

$prob_when = array(
  'name'  => 'prob_when',
  'id'  => 'prob_when',
  'value' => set_value('prob_when'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

$prob_duration = array(
  'name'  => 'prob_duration',
  'id'  => 'prob_duration',
  'value' => set_value('prob_duration'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

$prob_circumstances = array(
  'name'  => 'prob_circumstances',
  'id'  => 'prob_circumstances',
  'value' => set_value('prob_circumstances'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);


$prob_self_diagnosis = array(
  'name'  => 'prob_self_diagnosis',
  'id'  => 'prob_self_diagnosis',
  'value' => set_value('prob_self_diagnosis'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);


$description = array(
  'name'  => 'description',
  'id'  => 'description',
  'value' => set_value('description'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

$healthHis = array(
  'name'  => 'healthHis',
  'id'  => 'healthHis',
  'value' => set_value('healthHis'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);


$immediateProb = array(
  'name'  => 'immediateProb',
  'id'  => 'immediateProb',
  'value' => set_value('immediateProb'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

$underlyingNeeds = array(
  'name'  => 'underlyingNeeds',
  'id'  => 'underlyingNeeds',
  'value' => set_value('underlyingNeeds'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

$motivation = array(
  'name'  => 'motivation',
  'id'  => 'motivation',
  'value' => set_value('motivation'),
  'rows'  => '5',
  'cols'  => '150',
  'class' => 'materialize-textarea',
);

$resource = array(
  'name'  => 'resource',
  'id'  => 'resource',
  'value' => set_value('resource'),
  'class' => 'materialize-textarea',
);

$FamName1 = array(
  'name'  => 'FamName1',
  'id'  => 'FamName1',
  'value' => set_value('FamName1'),
  'class' => 'form-control',
);
$FamRel1 = array(
  'name'  => 'FamRel1',
  'id'  => 'FamRel1',
  'value' => set_value('FamRel1'),
  'class' => 'form-control',
);

$FamName = array(
  'name'  => 'FamName[]',
  'id'  => 'FamName',
  'value' => set_value('FamName'),
  'class' => 'form-control',
);

$FamAge = array(
  'name'  => 'FamAge[]',
  'id'  => 'FamAge',
  'value' => set_value('FamAge'),
  'class' => 'form-control',
);

$FamRel = array(
  'name'  => 'FamRel[]',
  'id'  => 'FamRel',
  'value' => set_value('FamRel'),
  'class' => 'form-control',
);

$FamCS = array(
  'name'  => 'FamCS[]',
  'id'  => 'FamCS',
  'value' => set_value('FamCS'),
  'class' => 'form-control',
);

$FamEduc = array(
  'name'  => 'FamEduc[]',
  'id'  => 'FamEduc',
  'value' => set_value('FamEduc'),
  'class' => 'form-control',
);

$FamOccu = array(
  'name'  => 'FamOccu[]',
  'id'  => 'FamOccu',
  'value' => set_value('FamOccu'),
  'class' => 'form-control',
);

$FamAdd = array(
  'name'  => 'FamAdd[]',
  'id'  => 'FamAdd',
  'value' => set_value('FamAdd'),
  'class' => 'form-control',
);

?>


<main >

<div class="container">
  <div class="row">
    <div class="col s3">
        <ul class="menu">
           <li><a href="#" ><span>Step 1: Admission Type</span></a></li>
              <li><a href="#" ><span>Step 2: Guardian Information</span></a></li>
              <li><a href="#" ><span>Step 3: Client Information </span></a></li>
              <li><a href="#" class="active"><span>Step 4: Background Info</span></a></li>
              <li><a href="#"><span>Step 5: View Intake Output</span></a></li>
              <li><a href="#"><span>Step 6: Upload Documents</span></a></li>
        </ul>
        </ul>
    </div>

      <div class="col s9">
        <?php echo form_open("auth/submit_intake"); ?>
        <?php echo form_hidden('client_id', $client_id); 
          echo form_hidden('admission_type', $admission_type); ?> 
          <fieldset class="z-depth-2">
            <center><h4 class="bold">Background Information</h4></center>
              <h5 class="divider black"></h5>
              <div class="form-group">
                <strong>Client ID : <?=$client_id;?></strong>
          
                <div>
                  <?php if ($role == '9') { ?>
                  <div class="input-field col s6 ">
                    <?php echo form_label('Problems Presented', $problem['id']); ?>
                    <?php echo form_textarea($problem, $problem['id']); ?>
                  </div>
                  <?php } ?>

                  <div class="input-field col s6 ">       
                    <?php echo form_label('Description of client during interview', $description['id']); ?>
                    <?php echo form_textarea($description, $description['id']); ?>
                    <?php echo form_error($description['name']); ?><?php echo isset($errors[$description['name']])?$errors[$description['name']]:''; ?>
                  </div>

                   <div class="col center s12">
                  <h5>Family Background</h5>
                  <div class="divider"></div>
                </div>
                 <table class="table centered striped bordered"  id="myTable" >
                      <thead>
                        <tr>
                          <th >Name</th>
                          <th >Relationship to the Client</th>
                          <th >DOB / Age</th>
                          <th >Civil Status</th>
                          <th >Educational Attainment</th>
                          <th >Occupation / Income</th>
                          <th >Address / Whereabouts</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo form_input($FamName); ?></td>
                          <td><?php echo form_input($FamRel); ?></td>
                          <td><?php echo form_input($FamAge); ?></td>
                          <td>
                            <select name="FamCS[]" class="browser-default">
                                        <option value="" disabled selected>Civil Status *</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Widower">Widower</option>
                                </select>
                          </td>
                          <td>
                            <select name="FamEduc[]" class="browser-default">
                                        <option value="" disabled selected>Highest Educational Attainment *</option>
                                        <option value="No Education">No Education</option>
                                        <option value="Pre-school">Pre-school</option>
                                        <option value="Elementary School">Elementary School</option>
                                        <option value="High School">High School</option>
                                        <option value="College">College</option>
                                </select>
                              </td>
                          <td><?php echo form_input($FamOccu); ?></td>
                          <td><?php echo form_input($FamAdd); ?></td>
                        </tr>
                        <tr>
                          <td><?php echo form_input($FamName); ?></td>
                          <td><?php echo form_input($FamRel); ?></td>
                          <td><?php echo form_input($FamAge); ?></td>
                          <td>
                            <select name="FamCS[]" class="browser-default">
                                        <option value="" disabled selected>Civil Status *</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Widower">Widower</option>
                                </select>
                          </td>
                          <td>
                            <select name="FamEduc[]" class="browser-default">
                                        <option value="" disabled selected>Highest Educational Attainment *</option>
                                        <option value="No Education">No Education</option>
                                        <option value="Pre-school">Pre-school</option>
                                        <option value="Elementary School">Elementary School</option>
                                        <option value="High School">High School</option>
                                        <option value="College">College</option>
                                </select>
                              </td>
                          <td><?php echo form_input($FamOccu); ?></td>
                          <td><?php echo form_input($FamAdd); ?></td>  
                        </tr>
                      </tbody>
                    </table>

                    <div class="col s6" align="left">
                      <button type="button" onclick=myFunction() value="view" class="btn  waves-effect btn-md  blue z-depth-2">Add row</button>
                    </div>
                </div> 

                </div>
                <?php if($admission_type == "1")
                { ?>
                <div class="col center s12">
                  <h5>Brief History of the problem</h5>
                  <div class="divider"></div>
                </div>

                <div class="input-field col s6 ">       
                  <?php echo form_label('When did it start?', $prob_when['id']); ?>
                  <?php echo form_input($prob_when); ?>
                  <?php echo form_error($prob_when['name']); ?><?php echo isset($errors[$prob_when['name']])?$errors[$prob_when['name']]:''; ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('Circumstances that led to the problem?', $prob_circumstances['id']); ?>
                  <?php echo form_input($prob_circumstances); ?>
                  <?php echo form_error($prob_circumstances['name']); ?><?php echo isset($errors[$prob_circumstances['name']])?$errors[$prob_circumstances['name']]:''; ?>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('How long has the problem been happening (duration)?', $prob_duration['id']); ?>
                  <?php echo form_input($prob_duration); ?>
                  <?php echo form_error($prob_duration['name']); ?><?php echo isset($errors[$prob_duration['name']])?$errors[$prob_duration['name']]:''; ?>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('What did the client do about the problem or has done about it? ', $prob_self_diagnosis['id']); ?>
                  <?php echo form_input($prob_self_diagnosis); ?>
                  <?php echo form_error($prob_self_diagnosis['name']); ?><?php echo isset($errors[$prob_self_diagnosis['name']])?$errors[$prob_self_diagnosis['name']]:''; ?>
                </div>        

                <div class="col center s12">
                  <h5>Medical History</h5>
                  <div class="divider"></div>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('Health History', $healthHis['id']); ?>
                  <?php echo form_textarea($healthHis, $healthHis['id']); ?>
                  <?php echo form_error($healthHis['name']); ?><?php echo isset($errors[$healthHis['name']])?$errors[$healthHis['name']]:''; ?>
                </div>
              
                <div class="col center s12">
                  <h5>ASSESSMENT</h5>
                  <div class="divider"></div>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('Immediate problems/needs to be worked out', $immediateProb['id']); ?>
                  <?php echo form_textarea($immediateProb, $immediateProb['id']); ?>
                  <?php echo form_error($immediateProb['name']); ?><?php echo isset($errors[$immediateProb['name']])?$errors[$immediateProb['name']]:''; ?>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('Underlying problems/needs', $underlyingNeeds['id']); ?>
                  <?php echo form_textarea($underlyingNeeds, $underlyingNeeds['id']); ?>
                  <?php echo form_error($underlyingNeeds['name']); ?><?php echo isset($errors[$underlyingNeeds['name']])?$errors[$underlyingNeeds['name']]:''; ?>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('Motivation and capacity to relate and utilize help (assessment of strengths & weaknesses)', $motivation['id']); ?>
                  <?php echo form_textarea($motivation, $motivation['id']); ?>
                  <?php echo form_error($motivation['name']); ?><?php echo isset($errors[$motivation['name']])?$errors[$motivation['name']]:''; ?>
                </div>
                <div class="input-field col s6 ">       
                  <?php echo form_label('Resources (internal and external)', $resource['id']); ?>
                  <?php echo form_textarea($resource, $resource['id']); ?>
                  <?php echo form_error($resource['name']); ?><?php echo isset($errors[$resource['name']])?$errors[$resource['name']]:''; ?>

                </div>        
                <?php } ?>
    

      
        
        
             
              <div>
                <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
              </div>
              </fieldset>
                    <?php echo form_close(); ?>
         </div>
          </div>
      </div>
    </div>
</main>

<script>
function myFunction() {
   var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
   var row   = tableRef.insertRow(tableRef.rows.length);
    var td1 = row.insertCell(0);
    var td2 = row.insertCell(1);
    var td3 = row.insertCell(2);
    var td4 = row.insertCell(3);
    var td5 = row.insertCell(4);
    var td6 = row.insertCell(5);
    var td7 = row.insertCell(6);
    td1.innerHTML = "<input class=\"form-control\"  type=\"text\" name=\"FamName\">";
    td2.innerHTML = "<input class=\"form-control\"  type=\"text\" name=\"FamRel\">";
    td3.innerHTML = "<input class=\"form-control\"  type=\"text\" name=\"FamAge\">";
    td4.innerHTML = "<select name=\"FamCS\" class=\"browser-default\"><option value= \"\" disabled selected> Civil Status </option><option value=\"Single\">Single</option><option value=\"Married\">Married</option><option value=\"Widow\">Widow</option><option value=\"Widower\">Widower</option></select>";
    td5.innerHTML = "<select name=\"FamEduc\" class=\"browser-default\"><option value=\"\" disabled selected>Highest Educational Attainment</option><option value=\"No Education\">No Education</option><option value=\"Pre-school\">Pre-school</option><option value=\"Elementary School\">Elementary School</option><option value=\"High School\">High School</option><option value=\"College\">College</option></select>";
    td6.innerHTML = "<input class=\"form-control\"  type=\"text\" name=\"FamOccu\"> ";
    td7.innerHTML = "<input class=\"form-control\"  type=\"text\" name=\"FamAdd\"> ";
    row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    row.appendChild(td4);
    row.appendChild(td5);
    row.appendChild(td6);
    row.appendChild(td7);
    // Append a text node to the cell
/*var newText1  = document.createTextNode('New row')
td1.appendChild(newText1);
    var newText2  = document.createTextNode('New row')
td2.appendChild(newText2);
var newText3  = document.createTextNode('New row')
td3.appendChild(newText3);
    var newText4  = document.createTextNode('New row')
td4.appendChild(newText4);
var newText5  = document.createTextNode('New row')
td5.appendChild(newText5);
*/
}
</script>