

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

<style type="text/css">

.profile-picture{
  width: 140px;
  height: 140px;
  float: left;
  display: block;
}
</style>

<form action="<?php echo site_url($this->uri->uri_string());?>" enctype="multipart/form-data" method="POST" class="form-horizontal">

<legend>Account</legend>
    <!-- START LEFT COLUMNS -->

<div class="col-xs-6">

  <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-4">
         Account Code</label>
        <div class="col-xs-8">
       <input  name="code" value="<?php echo (isset($account) && count($account)>0)?$account->code:set_value('code');?>"/>   
         
      </div>
      <p></p>

   <label for="inputEmail" class="control-label col-xs-4">
         Account Name</label>
        <div class="col-xs-8">
          <input  name="name" value="<?php echo (isset($account) && count($account)>0)?$account->name:set_value('name');?>"/>   
         
      </div>
  <p></p>
 <div class="col-xs-8">
   <button class="btn btn-small btn-success"><i class="icon-save"></i> Save</button>
 </div>
    </div>
  
</form>

  </div>
  </div>
</div>
