<!doctype html>
<html lang="en">

<?php include 'components/head.php';?>
   

    
    <body data-layout="horizontal" data-topbar="light">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
    
    <!-- <------------------------------HEADER-------------------->  
    <?php include 'components/header.php';?>
    


    <!-------------------------- BARRA DE CUSTOMIZAÇÃO -------------->
    <?php include 'components/custom-bar.php';?>

        <div class="hori-overlay"></div>
    


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                <?php include 'components/table.php';?>
           
                       
                </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; Vuesy.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

   
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    
    <?php include 'components/scripts.php';?>
 
    </body>

</html>