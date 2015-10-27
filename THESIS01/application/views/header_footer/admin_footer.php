

   <div class="container"id="foottext">
        <footer class="page-footer yellow darken-3" >
          <div class="footer-copyright">
            <div id="footertext">Created by CIDO</div>
          </div>
        </footer>
       </div>
      </div>  
      <!--Import jQuery before materialize.js-->


      <script src="<?php echo base_url(); ?><?php echo base_url(); ?>materialize/js/tabcontent.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>materialize/js/jquery-2.1.3.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>materialize/js/materialize.js"></script>
      <script type="text/javascript">
     $(".dropdown-button").dropdown({hover:false,  constrain_width: false});
      </script>
      <script type="text/javascript" src="<?php echo base_url(); ?>materialize/js/morris/morris.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>materialize/js/morris/raphael.min.js"></script>
      <script src="<?php echo base_url(); ?>/materialize/js/plupload.full.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>/materialize/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url(); ?>/bootstrap/js/plugins/metisMenu/metisMenu.min.js"></script>

  <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>/bootstrap/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>/bootstrap/js/plugins/dataTables/dataTables.bootstrap.js"></script>
  
  <!-- Custom Theme JavaScript -->
  <script src="<?php echo base_url(); ?>/bootstrap/js/sb-admin-2.js"></script>
  
  <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
     $('.datepicker').pickadate({
    selectMonths: false, // Creates a dropdown to control month
    selectYears: 80, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });
         $(document).ready(function(){
    $('ul.tabs').tabs();
  });
        $(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });

  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
    </script>

    </body>
  </html>