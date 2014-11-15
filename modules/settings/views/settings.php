<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('journals');?>" class="active">
                  <i class="icon-cog"></i>
                  <h3>Settings</h3>
                </a>
               
            </div> <!-- /widget-header -->
          
   <div class="widget-content">

  <form id="edit-profile" class="form-horizontal" method="POST"ACTION="<?php echo site_url('settings/save');?>">
  <!--Load global configuration -->
  <?php $this->load->view('global_settings'); ?>
  
  <!--Load contribution levels -->  
  <?php $this->load->view('contribution_settings'); ?>   
                      <br>
                        <div class="form-actions  ">
                        <button type="submit" class="btn btn-primary">Save</button> <a class="btn" href="<?php echo site_url('members'); ?>">Cancel</a>                                        
                    </div>

</div>
<?php echo form_close(); ?>
      </div>
    </div>
  </div>