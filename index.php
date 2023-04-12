<!DOCTYPE html>
<html lang="en">
<!-- CALLING THE FROM INCLUDE FOLDER -->
<?php include('include/head.php') ?>
<!-- END  -->

<body>
           <!-- DYNAMIC PAGES -->
           <?php
        $include_folder = isset($_GET['folder']) ? $_GET['folder'] : 'pages/';
        $page = isset($_GET['page']) ? $_GET['page'] : 'menu';
        require_once($include_folder.$page.'.php');
        ?>
        <!-- END -->
        
      <!-- JavaScript Bundle with Popper -->
      <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>