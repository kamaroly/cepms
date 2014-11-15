<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CEP MS REPORTS</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo site_url('assets/css/reports/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
         <link href="<?php echo site_url('assets/css/reports/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
       
        <!-- Ionicons -->
         <link href="<?php echo site_url('assets/css/reports/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="<?php echo site_url('assets/css/reports/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo site_url('/'); ?>" class="logo">
                <!-- Add the class .icon to your logo image or logo icon to add some margining -->
                CEPMS
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <?php $this->load->view('reports/partials/navigation_left'); ?>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
              
                <section class="content-header">
                         <!-- Main content -->
                <section class="content invoice">  
                <?php echo $body; ?>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                             </div>
                    </div>
</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


  
    </body>
</html>