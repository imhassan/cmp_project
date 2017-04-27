        <footer class="main-footer">
            <div class="container">
              <strong>&copy; <?php echo date('Y'); ?> All Rights Reserved </a>.
            </div><!-- /.container -->
        </footer>
    </div><!-- ./wrapper -->
    <style type="text/css">
        label.error{
          color: red;
        } 
    </style>
     
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
    
    
  </body>
</html>
