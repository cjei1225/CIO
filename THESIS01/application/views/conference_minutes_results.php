<?php 
foreach($client_info as $row_info) 
{
  $client_id      = $row_info->client_id;
  $fname   = $row_info->client_fname;
  $lname   = $row_info->client_lname;
  $gender         = $row_info->gender;
  $birth_place     = $row_info->birthplace;
  $birthday       =$row_info->birthday;
  $dorm_id        = $row_info->dorm_id;
  $sw_id          = $row_info->sw_id;
  $d_name         = $row_info->d_name;
  $nationality    = $row_info->nationality;
  $sector   = $row_info->client_sector;
  $problem    = $row_info->problem;
  $created    = $row_info->created;
  $admission_type = $row_info->admission_type;
  $status = $row_info->client_status;
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
                  <h6 ><b>INTERVENTION CASE CONFERENCE</b></h6>
                </center>
                <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
                 <h5 class="divider black"></h5>
                   <div class="form-group">
                    <center>
                    <label class="left">Date:</label>
                    
                    <br>
                    </center>
                     <h5 class="divider black"></h5>
                    <label><b>I. IDENTIFYING INFORMATION</b></label><br>
                     <label >Name: <?php echo $fname." ".$lname; ?></label>
                      <br>
                      <label>Age:<?php echo $age; ?></label>
                       <br>
                       <label >Gender:  <?php if ($gender == 1){echo "Male";}
                                      elseif($gender == 2){echo "Female";} ?></label>
                       <br>
                       <label >Date of Birth: <?php echo date('F-d-y', strtotime($birthday)); ?></label>
                        <br>
                       <label >Place of Birth: <?php echo $birth_place; ?></label>
                        <br>
                       <label >Nationality: <?php echo $nationality; ?></label>
                       <br>
                       <label >Date Admitted: <?php echo date('F-d-y', strtotime($created)); ?></label>
                       <br>
                       <label >Case Status: <?php echo $sector; ?></label>
                       <br>
                       <label >Disability:<?php echo $problem; ?></label>
                       <br>
                       <br>
                       <label ><b>II. RECOMMENDATION MADE BY THE CASE MANAGEMENT TEAM</b></label>
                       <br>
                       <table class="table bordered">
                        <thead>
                          <th>AREAS OF CONCERNS</th>

                        </thead>  
                        <tbody>
                          <?php foreach($conference_point as $point)
                          { ?>
                          <tr>
                            <td>
                              <div class="col s11">1.<?php echo $point->main_topic; ?> </div> 
                              <div class="col s10 right" id="sub_point_1">
                                <ul>
                                 <?php foreach($conference_sub_point as $sub)
                                 {

                                  if($point->topic_id == $sub->main_topic_id)
                                    {echo "<li>".$sub->sub_topic."</li>";}
                                 } ?>
                               </ul>
                               </div>
                           </td>


                          </tr>

                          <?php } ?>
                        </tbody>
                       </table>
                       <br>
                       <br>
                       
                       <label class="right">Prepared by:</label>
                       <br>
                     
                       <br>
                       <label class="right" >Persons with Special Needs</label>
                       <br>
                       <label >Noted By:</label>
                       <br>
                    
                       <br>
                       <label >Head Social Service Department:</label>
                   </div>
                   <div ALIGN="right">
                     </br>
                     
                   </div>
    </fieldset>
    </div>
    </div>     
</main>