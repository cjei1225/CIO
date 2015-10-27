<?php
$admit_CY = 0;
$admit_OP = 0;
$admit_SN = 0;
$admit_CS = 0;

$pend_CY = 0;
$pend_OP = 0;
$pend_SN = 0;
$pend_CS = 0;

$over_CY = 0;
$over_OP = 0;
$over_SN = 0;
$over_CS = 0;

foreach ($admitted as $sector)
{
    if($sector->client_sector == '1'){$admit_CY++;}
    elseif($sector->client_sector == '2'){$admit_OP++;}
    elseif($sector->client_sector == '3'){$admit_SN++;}
    elseif($sector->client_sector == '4'){$admit_CS++;}
}

foreach ($pending as $sector)
{
    if($sector->client_sector == '1'){$pend_CY++;}
    elseif($sector->client_sector == '2'){$pend_OP++;}
    elseif($sector->client_sector == '3'){$pend_SN++;}
    elseif($sector->client_sector == '4'){$pend_CS++;}
}

foreach ($overall as $sector)
{
    if($sector->client_sector == '1'){$over_CY++;}
    elseif($sector->client_sector == '2'){$over_OP++;}
    elseif($sector->client_sector == '3'){$over_SN++;}
    elseif($sector->client_sector == '4'){$over_CS++;}
}
?>


<main>
    <div class="container">
        <div class="row">
            <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/header_footer/side_bar_admin_reports.php'); ?>
            <div class="col s10">
                <div class="col s12">
                    <ul class="tabs" >
                      <li class="tab col s3"><a class="active" href="#test1">Admitted</a></li>
                      <li class="tab col s3"><a href="#test2">Pending</a></li>
                      <li class="tab col s3"><a href="#test3">Overall</a></li>

                    </ul>
                </div>

                <div class="col s12" id="test1">
                    <center><h5 class="bold">Admitted Client per Sector</h5></center>
                    <h5 class="divider black"></h5>
                    <div class="col s12" id="morris-donut-chart-admit"></div>
                </div>
                <div class="col s12" id="test2">
                    <center><h5 class="bold">Pending Client per Sector</h5></center>
                    <h5 class="divider black"></h5>
                    <div class="col s12" id="morris-donut-chart-pend"></div>             
                </div>
                <div class="col s12" id="test3" >
                    <center><h5 class="bold">Overall Client per Sector</h5></center>
                    <h5 class="divider black"></h5>
                    <div class="col s12" id="morris-donut-chart-over"></div>
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
        element: 'morris-donut-chart-admit',
        data: [{
            label: "Children and Youth",
            value: <?php echo $admit_CY; ?>
        }, {
            label: "Older Person",
            value: <?php echo $admit_OP; ?>
        }, {
            label: "Special Needs",
            value: <?php echo $admit_SN; ?>
        }, {
            label: "People in Crisis Situation",
            value: <?php echo $admit_CS; ?>
        }
        ],
        resize: true,
    });
    Morris.Donut({
        element: 'morris-donut-chart-pend',
        data: [{
            label: "Children and Youth",
            value: <?php echo $pend_CY; ?>
        }, {
            label: "Older Person",
            value: <?php echo $pend_OP; ?>
        }, {
            label: "Special Needs",
            value: <?php echo $pend_SN; ?>
        }, {
            label: "People in Crisis Situation",
            value: <?php echo $pend_CS; ?>
        }
        ],
        resize: true,
    });
    Morris.Donut({
        element: 'morris-donut-chart-over',
        data: [{
            label: "Children and Youth",
            value: <?php echo $over_CY; ?>
        }, {
            label: "Older Person",
            value: <?php echo $over_OP; ?>
        }, {
            label: "Special Needs",
            value: <?php echo $over_SN; ?>
        }, {
            label: "People in Crisis Situation",
            value: <?php echo $over_CS; ?>
        }
        ],
        resize: true,
    });
      </script>
</body>

</html>