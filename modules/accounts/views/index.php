
<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('accounts');?>" class="active">
                  <i class="icon-th-list"></i>
                  <h3>accounts list </h3>
                </a>
                <a href="<?php echo site_url('accounts/save');?>" class="btn btn-success">
                   <i class="icon-plus-sign"></i>
                   <h3>New account </h3>
                </a>
            </div> <!-- /widget-header -->
          
   <div class="widget-content">
<!-- Modal -->


<?php echo $links ;?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>TYPE</th>
            <th>NAME</th>
            <th>BALANCE</th>
            <th>Action</th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($accounts as $account):?>
        <tr>
            <td><?php echo $account->id;?></td>
            <td><?php echo $account->code;?></td>   
            <td><?php echo $account->name;?></td>    
            <td><?php echo $this->accounts->balance($account->id);?></td>      
              <td>
<a class="btn btn-primary" href="<?php echo site_url('accounts/save/'.$account->id);?>"><i class="btn-icon-only icon-code"></i>Edit</a>
<a class="btn btn-danger" href="<?php echo site_url('accounts/delete/'.$account->id);?>" onclick="return confirm('Are you sure you want to delete this member?');"><i class="btn-icon-only icon-remove"></i>Delete</a>
               
          </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php echo $links ;?>
      </div>
    </div>
  </div>