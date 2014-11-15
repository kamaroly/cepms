    <div class="main-inner">
        <div class="container">

       <!--Notification area -->
          
    <div class="widget ">
                  
                               
                  <div class="widget-header">
                    <a href="<?php echo site_url('members');?>" class="active">
                      <i class="icon-th-list"></i>
                      <h3>Member list </h3>
                    </a>
                    <a href="<?php echo site_url('members/save');?>">
                       <i class="icon-plus-sign"></i>
                       <h3>New member </h3>
                    </a>

                     <a href="<?php echo site_url('members/batchcotisation');?>" >
                       <i class="icon-plus-sign"></i>
                       <h3>Batch Contribution </h3>
                    </a>
                </div> <!-- /widget-header -->
 
  <div class="widget-content">
   <form id="edit-profile" class="form-horizontal" method="POST"ACTION="<?php echo site_url($this->uri->uri_string());?>">
  
  <?php $this->load->view('members/filter'); ?>

   <?php if(isset($members) && count($members)>0 ): ?>
   <legend></legend>
    <table class="table table-striped">
        <thead>
            <tr>

               <th><input type="checkbox" id="selectall" /></th>
               <th>Membership #</th>
               <th>Rank</th>
               <th>First name</th>
               <th>Last name</th>
               <th>Phone</th>
               <th>Start Date</th>
               <th>Service</th>
               <th>Level</th>
               <th>Cep_fund</th>
               <th>Social_fund</th>
               <th>Net_salary</th>
               
            </tr>
        </thead>
        <tbody>
        <?php foreach ($members as $member):?>
            <tr>
    
    <td><input type="checkbox" name="members[]" value="<?php echo $member->id;?>" class="case"/></td>
    <td> <?php echo $member->membership_number;?> </td>
    <td> <?php echo $member->rank;?> </td>
    <td> <?php echo $member->first_name;?> </td>
    <td> <?php echo $member->last_name;?> </td> 
    <td> <?php echo $member->phone;?> </td>
    <td> <?php echo $member->start_date;?> </td>
    <td> <?php echo $member->service;?> </td>
    <td> <?php echo $member->level;?> </td>
    <td> <?php echo $member->cep_fund;?> </td>
    <td> <?php echo $member->social_fund;?> </td>
    <td> <?php echo $member->net_salary;?> </td>

      <td>
                   
              </tr>
        <?php endforeach;?>
        </tbody>
    </table>
  <?php endif; ?>
      
          </div>
        </div>
</form>
      </div>


       