<?php
$age05 = 0;
$age610 = 0;
$age1115 = 0;
$age1620 = 0;

$age2125 = 0;
$age2630 = 0;
$age3135 = 0;
$age3640 = 0;

$age4145 = 0;
$age4650 = 0;
$age5155 = 0;
$age5660 = 0;

$age6165 = 0;
$age6670 = 0;
$age7175 = 0;
$age7680 = 0;

$age8185 = 0;
$age8690 = 0;
$age9195 = 0;
$age96100 = 0;

$ageelse = 0;

foreach ($client as $entity)
{
    $birthday = $entity->birthday;
    $created = $entity->created;

        if($birthday != null)
    {
      $age = ageCalculator($birthday);
    }
    else
    {
      $age = ageCalculator($created);
    }
    
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


<main>
    <div class="container">
        <div class="row">
            <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/header_footer/side_bar_admin_reports.php'); ?>
            <div class="col s10">

                <div class="col s12" id="test1">
                    <center><h5 class="bold">Client Age Group</h5></center>
                    <h5 class="divider black"></h5>
                    <div class="col s12" id="age_group"></div>
                </div>
               
            </div>
        </div>
    </div>
</main>




<script src="<?php echo base_url(); ?>/bootstrap/js/jquery-1.11.0.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/metisMenu/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/sb-admin-2.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/flot/excanvas.min.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>/bootstrap/js/plugins/flot/jquery.flot.tooltip.min.js"></script>



  <script type="text/javascript">
  
    Morris.Donut({
        element: 'age_group',
        data: [{
            label: "Children and Youth",
            value: "5"
        }, {
            label: "Older Person",
            value: "6"
        }, {
            label: "Special Needs",
            value: "6"
        }, {
            label: "People in Crisis Situation",
            value: "9"
        }
        ],
        resize: true,
    });
   
      </script>
</body>

</html>