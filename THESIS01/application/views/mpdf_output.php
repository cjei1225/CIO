

   
    

<?php foreach($client_info as $row_info) 
      {
          $created = date('F-d-Y', strtotime($row_info->created));
          $client_id      = $row_info->client_id;
          $fname      = $row_info->client_fname;
          $mname      = $row_info->client_mname;
          $lname      = $row_info->client_lname;
          $nickname   = $row_info->nickname;
          $Civil      = $row_info->civil_status;
          $age            = $row_info->age;
          $gender         = $row_info->gender;
          $religion       = $row_info->religion;
          $Birthplace     = $row_info->birthplace;
          $dorm_id        = $row_info->dorm_id;
          $sw_id          = $row_info->sw_id;
          $Birthday     = $row_info->birthday;
          $admitDate    = $row_info->created;
          $sector     = $row_info->client_sector;
          $baptized   = $row_info->baptized;
          $nationality = $row_info->nationality;
          $present_add = $row_info->present_add;
          $contact_num = $row_info->contact_num;
          $permanent_add = $row_info->permanent_add;
          $educ_attained = $row_info->educ_attained;
          $emergency_name = $row_info->emergency_name;
          $emergency_add = $row_info->emergency_add;
          $emergency_contact = $row_info->emergency_contact;
          $referral_source = $row_info->referral_source;
          $source_add = $row_info->source_add;
          $source_contact = $row_info->source_contact;
          $id_presented = $row_info->id_presented;

          $problem = $row_info->problem;
          $agent_name = $row_info->agent_name;
          $agent_reason = $row_info->agent_reason;
          $agent_service = $row_info->agent_service;
          $problem_history = $row_info->problem_history;
          $intake_description = $row_info->intake_desc;
          $health_history = $row_info->health_history;
          $family_bg = $row_info->family_bg;
          $assess_problem = $row_info->assess_problem;
          $assess_needs = $row_info->assess_needs;
          $assess_motiv = $row_info->assess_motiv;
          $assess_resource  = $row_info->assess_resource;
      }
      

$html='  
 <main >

        <div class="container">

          <div>

         
             <div>

              
                <center>
                  <h6>Social Service Department</h6>
                 
                </center>
                <center>
                  <h6 ><b>GENERAL INTAKE FORM</b></h6>
                </center>
                <center><img src="' .base_url().'materialize/title logo.png" width="100" height="100"></center>
                 <h5 class="divider black"></h5>
                   <div class="form-group">
                    <label class="right">Date:'. $created.'</label>
                    <div class ="row">
                      <div class="col s6">
                        <br>
                        <label><b>CLIENT\'S IDENTIFYING INFORMATION</b></label>
                        <br>
                         <label >Name: '.$fname." ".$mname.". ".$lname.'</label>
                          <br>
                          <label >A.K.A:  '/$nickname.'</label>
                          <br>
                          <label >Date of Birth: '.$Birthday.'</label>
                          <br>
                          <label>Age:'.$age.'</label>
                           <br>
                           <label >Gender: '. $gender.'</label>
                           <br>
                           <label >Civil Status:'. $Civil .'</label>
                          <br>
                          <label >Religion:'. $religion.'</label>
                          <br>
                          <label >Baptized:'.$baptized.'</label>
                          <br>
                          <label >Nationality:'.$nationality.'</label>
                          <br>
                           <label >Place of Birth: '.$Birthplace .'</label>
                            
                          </div>
                          <br><br>
                          <div class="col s6">
                           <label >Present Address: '.$present_add.'</label>
                           <br>
                           <label >Tel./ Cel Nos.: '.$contact_num .'</label>
                           <br>
                           <label>Permanent Address: '.$permanent_add .'</label>
                           <br>
                           <label >Highest Educational Attainment: '. $educ_attained .'</label>
                           <br>
                           <label >Contact person in case of emergency: '. $emergency_name .'</label>
                           <br>
                           <label >Address: '. $emergency_add .'</label>
                           <br>
                           <label >Tel. Nos.: '. $emergency_contact .'</label>
                           <br>
                           <label >Source of Referral: '.$referral_source .'</label>
                           <br>
                           <label >Address: '. $source_add .'</label>
                           <br>
                           <label >Tel./ Cel Nos.:  '. $source_contact.'</label>
                           <br>
                           <label >I.D. PRESENTED: '. $id_presented .' </label>
                           <br>
                         </div>
                       </div>
                       <label >FAMILY/HOUSEHOLD COMPOSITION:</label>
                       <br>
                        <table class="Table bordered centered">
                          <thead>
                            <th>Name</th>
                            <th>Relation-ship to Client</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Civil Status</th>
                            <th>Educational Attainment</th>
                            <th>Occupation/Income</th>
                            <th>Address/Whereabouts</th>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                       <br>
                       <label><b>PROBLEM PRESENTED (Immediate cause of client\'s request for  help)</b></label>

                       <p>'. $problem.'
                       </p>
                       <br>
                       <br>
                       <br>
                       <br>
                       <label><b>OTHER AGENCY/INSTITUTION APPROACHED BY THE CLIENT (specify)</b></label>
                       <br>
                       <label>Name of Agency/Institutions: '.$agent_name .'</label>
                       <br>
                       <label>Whem/Why? '. $agent_reason .'</label>
                       <br>
                       <label>Sevices Received from the Agency '. $agent_service.'</label>
                       <br>
                       <label><b>BRIEF HISTORY OF THE PROBLEM</b></label>
                        <p> '. $problem_history .'</p>
                       <br>
                       <br>
                       <br>
                       <br>
                       <label><b>DESCRIPTION OF THE CLIENT AT INTAKE</b></label>
                       <p> '. $intake_description .'</p>
                       <br>
                       <br>
                       <br>
                       <br>
                       <label><b>HEALTH HISTORY</b></label>
                       <p> '. $health_history .'</p>
                       <br>
                       <br>
                       <br>
                       <br>

                       <label><b>FAMILY BACKGROUND (for adoption cases please fill-up the attached sheet)</b></label>
                       <p> '. $family_bg .' </p>
                       <br>
                       <br>
                       <br>
                       <br>
                       <label><b>ASSESSMENT</b></label>
                       <br>
                       <ul>
                        <li>Immediate problems/needs to be worked out</li>
                        <p> '. $assess_problem .' </p>
                        <br>
                       <br>
                       <li>Underlying problems/needs</li>
                       <p>  '.$assess_needs .'</p>
                       <br>
                       <br>
                       <li>Motivation and capacity to relate and utilize help (assessment of strenghts & weaknesses)</li>
                       <p> '. $assess_motiv .' </p>
                       <br>
                       <br>
                       <li>Resources (Internal and External)</li>
                       <p> '. $assess_resource .' </p>
                       <br>
                       <br>
                       </ul>
                       <br>
                    
                       <br>
                       <label >Intake Social Worker: '. $sw_id .'</label>
                      
                      
                      
                      
                   </div>
                  
                   
                </div>
          </div>
      </div>
        </main>


';


 include(APPPATH.'/third_party/mpdf/mpdf.php');
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents(APPPATH.'../materialize/css/materialize.css');
$stylesheet2 = file_get_contents(APPPATH.'../materialize/css/style.css');
$stylesheet3 = file_get_contents(APPPATH.'../materialize/css/morris.css');
$stylesheet4 = file_get_contents(APPPATH.'../materialize/css/datepicker.css');
$stylesheet5 = file_get_contents(APPPATH.'../materialize/css/dataTables.bootstrap.css');
$stylesheet6 = file_get_contents(APPPATH.'../materialize/font-awesome-4.1.0/css/font-awesome.min.css');

$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($stylesheet3,1);
$mpdf->WriteHTML($stylesheet4,1);
$mpdf->WriteHTML($stylesheet5,1);
$mpdf->WriteHTML($stylesheet6,1);

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;


    ?>