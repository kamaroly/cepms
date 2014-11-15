
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
<!-- Modal -->


<?php echo $links ;?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
          
            <th>TYPE</th>
             <th>Action</th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($journals as $journal):?>
        <tr>
            <td><?php echo $journal->id;?></td>
            <td><?php echo $journal->type;?></td>         
              <td>
<a class="btn btn-primary" href="<?php echo site_url('journals/save/'.$journal->id);?>"><i class="btn-icon-only icon-code"></i>Edit</a>
<a class="btn btn-danger" href="<?php echo site_url('journals/delete/'.$journal->id);?>" onclick="return confirm('Are you sure you want to delete this member?');"><i class="btn-icon-only icon-remove"></i>Delete</a>
               
          </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php echo $links ;?>
      </div>
    </div>
  </div>