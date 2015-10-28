<?php


?>


<main>
    <div class="container">
        <div class="row">
            <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_admin_reports.php'); ?>
            <div class="col s10">
                <fieldset class="z-depth-2">
                <table class=>
                                <thead>
                                    <td>Dorm Name</td>
                                    <td>Sector</td>
                                    <td>Occupants</td>
                                    <td>Vacancy</td>
                                    <td>Capacity</td>
                                </thead>
                                <tbody>
                                    <?php foreach($Dorm_count as $row_dorm) { ?>
                                    <tr>
                                        <td><?php echo $row_dorm->d_name; ?></td>
                                        <td><?php if($row_dorm->d_sector == 1){echo 'Child and Youth';}
                                        elseif($row_dorm->d_sector == 2){echo 'Older Persons';}
                                        elseif($row_dorm->d_sector == 3){echo 'Special Needs';}
                                        elseif($row_dorm->d_sector == 4){echo 'Crisis Situation';} ?> </td>
                                        <td><?php echo $row_dorm->d_count; ?></td>
                                        <td><?php echo $row_dorm->d_capacity - $row_dorm->d_count;?></td>
                                        <td> <?php echo $row_dorm->d_capacity;?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </fieldset>
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
      $(function() {

    var data = [{
        label: "Child and Youth <br> <?php echo $CAY ?>" ,
        data: <?php echo $CAY; ?>
    }, {
        label: "Older Persons <br> <?php echo $OP ?>",
        data: <?php echo $OP; ?>
    }, {
        label: "Persons with Special Needs <br> <?php echo $PWSN ?>",
        data: <?php echo $PWSN; ?>
    }, {
        label: "Person In Crisis Situation <br>     <?php echo $PICS ?>",
        data: <?php echo $PICS; ?>
    }];

    var plotObj = $.plot($("flot-pie-chart"), data, {
        series: {
            pie: {
                show: true,
                color: '#fff'
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: true
        }
    });

});
    </script>
  <script type="text/javascript">
   Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
    
        }, {
            y: '2007',
            a: 75,
          
        }, {
            y: '2008',
            a: 50,
           
        }, {
            y: '2009',
            a: 75,
          
        }, {
            y: '2010',
            a: 50,
           
        }, {
            y: '2011',
            a: 75,
           
        }, {
            y: '2012',
            a: 100,
           
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Series A'],
        hideHover: 'auto',
        resize: true,
    });
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