
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

<h1><?php echo lang('deactivate_heading');?></h1>
<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

<?php echo form_open("users/deactivate/".$user->id);?>

    <p>
        <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
        <input type="radio" name="confirm" value="yes" checked="checked" />
        <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
        <input type="radio" name="confirm" value="no" />
    </p>

    <?php echo form_hidden($csrf); ?>
    <?php echo form_hidden(array('id'=>$user->id)); ?>

    <p><?php echo bs_form_submit('submit', lang('deactivate_submit_btn'));?></p>

<?php echo form_close();?>
</div>
</div>
</div>