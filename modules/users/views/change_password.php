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
          
<h1><?php echo lang('change_password_heading');?></h1>

<div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("users/change_password");?>

    <p>
        <?php echo lang('change_password_old_password_label', 'old');?> <br />
        <?php echo bs_form_input($old_password);?>
    </p>

    <p>
        <label for="new"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
        <?php echo bs_form_input($new_password);?>
    </p>

    <p>
        <?php echo lang('change_password_new_password_confirm_label', 'new_confirm');?> <br />
        <?php echo bs_form_input($new_password_confirm);?>
    </p>

    <?php echo form_input($user_id);?>
    <p><?php echo bs_form_submit('submit', lang('change_password_submit_btn'));?></p>

<?php echo form_close();?>

</div>
</div>
</div>
