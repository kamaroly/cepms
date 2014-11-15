
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
<p><?php echo lang('index_heading');?></p>

<div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo lang('index_fname_th');?></th>
            <th><?php echo lang('index_lname_th');?></th>
            <th><?php echo lang('index_email_th');?></th>
            <th><?php echo lang('index_groups_th');?></th>
            <th><?php echo lang('index_status_th');?></th>
            <th><?php echo lang('index_action_th');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user):?>
        <tr>
            <td><?php echo $user->first_name;?></td>
            <td><?php echo $user->last_name;?></td>
            <td><?php echo $user->email;?></td>
            <td>
                <?php foreach ($user->groups as $group):?>
                    <?php echo anchor("users/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
            </td>
            <td><?php echo ($user->active) ? anchor("users/deactivate/".$user->id, lang('index_active_link')) : anchor("users/activate/". $user->id, lang('index_inactive_link'));?></td>
            <td><?php echo anchor("users/edit_user/".$user->id, 'Edit') ;?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<p>|</p>

</div>
</div>
</div>