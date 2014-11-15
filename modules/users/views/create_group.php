<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('users');?>" class="active">
                  <i class="icon-th-list"></i>
                  <h3><?php echo lang('index_heading');?></h3>
                </a>
                <a href="<?php echo site_url('users/create_user');?>" >
                   <i class="icon-plus-sign"></i>
                   <h3><?php echo lang('index_create_user_link')?>  </h3>
                </a>

              <a href="<?php echo site_url('users/create_group');?>" >
                   <i class="icon-plus-sign"></i>
                   <h3><?php echo lang('index_create_group_link');?>  </h3>
                </a>
            </div> <!-- /widget-header -->
          
   <div class="widget-content">

<h1><?php echo lang('create_group_heading');?></h1>
<p><?php echo lang('create_group_subheading');?></p>

<div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("users/create_group");?>

    <p>
        <?php echo lang('create_group_name_label', 'group_name');?> <br />
        <?php echo bs_form_input($group_name);?>
    </p>

    <p>
        <?php echo lang('create_group_desc_label', 'description');?> <br />
        <?php echo bs_form_input($description);?>
    </p>

    <p><?php echo bs_form_submit('submit', lang('create_group_submit_btn'));?></p>

<?php echo form_close();?>

</div>
</div>
</div>


