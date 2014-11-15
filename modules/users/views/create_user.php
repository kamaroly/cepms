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

<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("users/create_user");?>

    <p>
        <?php echo lang('create_user_fname_label', 'first_name');?> <br />
        <?php echo bs_form_input($first_name);?>
    </p>

    <p>
        <?php echo lang('create_user_lname_label', 'last_name');?> <br />
        <?php echo bs_form_input($last_name);?>
    </p>

    <p>
        <?php echo lang('create_user_company_label', 'company');?> <br />
        <?php echo bs_form_input($company);?>
    </p>

    <p>
        <?php echo lang('create_user_email_label', 'email');?> <br />
        <?php echo bs_form_input($email);?>
    </p>

    <p>
        <?php echo lang('create_user_phone_label', 'phone');?> <br />
        <?php echo bs_form_input($phone);?>
    </p>

    <p>
        <?php echo lang('create_user_password_label', 'password');?> <br />
        <?php echo bs_form_input($password);?>
    </p>

    <p>
        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
        <?php echo bs_form_input($password_confirm);?>
    </p>


    <p><?php echo bs_form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>

</div>
</div>
</div>
