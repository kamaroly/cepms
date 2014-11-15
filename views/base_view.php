
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="<?php echo assets_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/bootstrap-responsive.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/font-awesome.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/datepicker.css'); ?>"rel="stylesheet" type="text/css" >
    <link href="<?php echo assets_url('css/pages/dashboard.css'); ?>" rel="stylesheet">


   
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner navbar-fixed-top"  style="position:fixed;">
        <div class="container">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
            <a class="brand" href="<?php echo site_url('/') ?>">
                CEPMS
            </a>        

             <?php if($this->ion_auth->logged_in()): ?>
            <div class="nav-collapse">
                <ul class="nav pull-right">
         
                    <li class="dropdown">                       
                        <a href="#" >
                            <i class="icon-user"></i> 
                          <?php echo $this->config->item('user_last_name').' '.$this->config->item('user_first_name'); ?>  
                            <b class="caret"></b>
                        </a>
                                     
                    </li>
                    <li >                       
                        <a href="<?php echo site_url('users/change_password') ?>" >
                            <i class="icon-cog"></i>
                          Change Password
                           
                        </a>
                                              
                    </li>
                <li><a href="<?php echo site_url('users/logout'); ?>">
                   <i class="icon-signout"></i>
                  Logout</a></li>
                </ul>
            
                
            </div><!--/.nav-collapse -->    
           <?php endif; ?>
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div> <!-- /navbar -->
 <?php if($this->ion_auth->logged_in()): ?>
 <div class="subnavbar navbar navbar-fixed-top" style="position:fixed; top:40px;overflow: hidden;">

    <div class="subnavbar-inner">
    
        <div class="container">

            <ul class="mainnav">
            
                <li class="<?php echo ($this->uri->segment(1)=='')?'active':''; ?>">
                    <a href="<?php echo site_url('/');?>">
                        <i class="icon-dashboard"></i>
                        <span>Dashboard</span>
                    </a>                        
                </li>
                
                <li class="<?php echo ($this->uri->segment(1)=='members')?'active':''; ?>">
                    <a href="<?php echo site_url('members');?>">
                        <i class="icon-list-alt"></i>
                        <span>Members</span>
                    </a>                    
                </li>
                    <li class="<?php echo ($this->uri->segment(1)=='loans')?'active':''; ?>">
                    <a href="<?php echo site_url('loans');?>">
                        <i class=" icon-credit-card"></i>
                        <span>Loans</span>
                    </a>                    
                </li>                 
                 <li class="<?php echo ($this->uri->segment(1)=='transactions')?'active':''; ?>">                   
                    <a href="<?php echo site_url('transactions');?>">
                        <i class="icon-money"></i>
                        <span>Transactions</span>
                    </a>                                    
                </li>

               <li class="<?php echo ($this->uri->segment(1)=='journals')?'active':''; ?>">                   
                    <a href="<?php echo site_url('journals');?>">
                        <i class="icon-book"></i>
                        <span>Journals</span>
                    </a>                                    
                </li>                          
                    
                <li class="<?php echo ($this->uri->segment(1)=='accounts')?'active':''; ?>">                   
                    <a href="<?php echo site_url('accounts');?>">
                        <i class="icon-credit-card"></i>
                        <span>Accounts</span>
                    </a>                                    
                </li>
                
              
                  <li class="<?php echo ($this->uri->segment(1)=='reports')?'active':''; ?>">                   
                    <a href="<?php echo site_url('reports');?>">
                        <i class="icon-bar-chart"></i>
                        <span>Reports</span>
                    </a>                                    
                </li>
                 
            <li class="dropdown ">
            <a href="<?php echo site_url('users');?>" class="<?php echo ($this->uri->segment(1)=='users')?'active':''; ?>">

                 <i class="icon-user"></i><span>Users management</span> <b class="caret"></b></a>
         
           </li>

            <li class="<?php echo ($this->uri->segment(1)=='settings')?'active':''; ?>">                   
                    <a href="<?php echo site_url('settings');?>">
                        <i class=" icon-cog"></i>
                        <span>Settings</span>
                    </a>                                    
                </li>
                </ul>
            
                
            </div><!--/.nav-collapse -->    
                </li>
            
            </ul>
             
        </div> <!-- /container -->
    
    </div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    
 <?php endif; ?>     
 <div class="main" >
    
  <div class="main-inner"style="margin-top:105px;">
 <?php if($this->ion_auth->logged_in()): ?>

    <?php if(! empty($message)): ?>
     <div class="container">

         <div class="alert alert-success">
                     <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $message;?>       
         </div>
     </div>
     <?php endif; ?>
   <?php endif; ?>
 
     <?php if(! empty($errors)): ?>
     <div class="container">

         <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert">×</button>
                     <?php echo $errors;?>       
         </div>
     </div>
   <?php endif; ?>

     <?php echo $body;?>
  </div> <!-- /main-inner -->
</div> <!-- /main -->
</div>  
</div>  
</div>  
</div>  
</body> 

<?php echo $footer; ?>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->



</html>
