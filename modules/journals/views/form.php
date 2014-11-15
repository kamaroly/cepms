

<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('journals');?>" class="active">
                  <i class="icon-th-list"></i>
                  <h3>Journals list </h3>
                </a>
                <a href="<?php echo site_url('journals/save');?>" class="btn btn-success">
                   <i class="icon-plus-sign"></i>
                   <h3>New Journal </h3>
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

<legend>Journal</legend>
    <!-- START LEFT COLUMNS -->

<div class="col-xs-6">

<div class="form-group">
        <label for="inputEmail" class="control-label col-xs-4">
        Journal type </label>
        <div class="col-xs-8">
          <input  name="type" value="<?php echo isset($journal)?$journal->type:'';?>"/>   
          <button class="btn btn-small btn-success"><i class="icon-save"></i> Save</button>
      </div>

    </div>
  
</form>

  </div>
  </div>
</div>
