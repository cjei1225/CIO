<?php 
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
                  <h5>HOSPICIO DE SAN JOSE</h5>
                  <h7>Ayala Bridge, Manila</h7>
                  
                </center>
                <center>
                  <h6 ><b>HOME VISIT FEEDBACK REPORT</b></h6>
                </center>
                <center><img src="<?php echo base_url(); ?>/materialize/title logo.png" width="100" height="100"></center>
                 <h5 class="divider black"></h5>
                   <div class="form-group">
                    
                     <label >Re:<?php echo $home_visit[0]->response; ?></label>
                      <br>
                      <label>Date of Visit:<?php echo date('M d Y', strtotime($home_visit[0]->visit_date)); ?></label>
                       <br>
                     
                       <label >Objective:<?php echo $home_visit[0]->objective; ?></label>
                        <br>
                       <br>
                        <label>Narrative:<?php echo $home_visit[0]->narration; ?></label>
                       <br>
                       <label>Assessment:<?php echo $home_visit[0]->assessment; ?></label>
                       <br>

                       
                       
                       <label>Prepared By:</label>
                       <br>
                       <label  >Program for Persons with Special Needs</label>
                       <br>
                       <label  >Socail Worker</label>
                       <br>
                       <label >Noted by:</label>
                       <br>
                       <br>
                       <label >Supervising Social Worker</label>
                   </div>

              </fieldset>
              </div>
        </div>
    </div>
</main>


<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
</script>