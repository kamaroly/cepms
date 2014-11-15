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

  <div class="">

<form class="faq-search">
 &nbsp;&nbsp; <strong>Search :</strong> 
  <select name="field">
   <option value="membership_number">Membership number</option>
   <option value="first_name">First Name</option>
   <option value="last_name">Last Name</option>

  </select>
  <input type="text" name="search" placeholder="Search by Keyword">
  <button class="btn btn-primary"><i class="icon-search"></i></button>
</form>
</div>

<form action="<?php echo site_url('reports/membersreports'); ?>" method="post" class="form-horizontal" target="_blank">
<div class="pull-left"><strong>From </strong></div>
<div data-provide="datepicker" class="input-append date pull-left" data-date-format="yyyy-mm" >
                          <input class="span2" name="start_date" value="2014-08" readonly="" type="text">
                          <span class="add-on" style=" "><i class=" icon-calendar"></i></span>
<i class="icon-chevron-right"></i>                          
</div>

<div data-provide="datepicker" class="input-append date pull-left" data-date-format="yyyy-mm">
                          <input class="span2" name="end_date" value="2014-08" readonly="" type="text">
                         <span class="add-on" style=" "><i class=" icon-calendar"></i></span>
</div>
<input type="submit" name="button" value="Contributions" class="btn btn-success">
<input type="submit" name="button" value="Loans" class="btn btn-success">
<button class="btn btn-inverse" name="button" value="refund" role="button"onclick="return confirm('Are you sure you want to refund all contribution done by selected members?');"> <i class="icon-repeat"> Refund Contributions for selected Member & Leave CEP</i> </button>
<div>
</div>

  <div class="pull-left"><?php echo $links ;?></div>
 
<table class="table table-striped">
    <thead>
        <tr>
          
           <th><input type="checkbox" id="selectall" /></th>
           <th>Membership #</th>
           <th>Rank</th>
           <th>First name</th>
           <th>Last name</th>
           <th>Start Date</th>
           <th>Level</th>
           <th>Cep fund</th>
           <th>Social fund</th>
           <th>Net salary</th>
           <th>Status</th>
             <th></th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($members as $member):?>
<tr <?php echo ($member->status=='left')?'style="background:#999"':'' ?>>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>><input type="checkbox" name="membersids[]" value="<?php echo $member->id;?>" class="case"/></td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->membership_number;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->rank;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->first_name;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->last_name;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->start_date;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->level;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->cep_fund;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->social_fund;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->net_salary;?> </td>
<td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>> <?php echo $member->status;?> </td>

  <td <?php echo ($member->status=='left')?'style="background:#999"':'' ?>>
<?php if($member->status!='left'): ?>
 <a  <?php echo ($this->loans->eligibleforloan($member->id,TRUE)==0)?'class="btn btn-success"  onclick="alert(\'This member has not paid 50% of of his recent Loan.\')"':'class="btn btn-primary" href="'.site_url('loans/save/'.$member->id).'"' ; ?>>
 <i class="btn-icon-only  icon-credit-card"></i> <?php echo ($this->loans->eligibleforloan($member->id,TRUE)==1)?' Give a Loan':'Loan at '.$this->loans->GetPaymentPercentage($member->id,TRUE).' %'; ?></a>
<?php endif; ?>

<a class="btn btn-inverse" href="<?php echo site_url('members/save/'.$member->id);?>"><i class="btn-icon-only icon-pencil"></i>E</a>
<a class="btn btn-danger" href="<?php echo site_url('members/delete/'.$member->id);?>" onclick="return confirm('Are you sure you want to delete this member?');"><i class="btn-icon-only icon-trash"></i>D</a>
               
          </tr>
    <?php endforeach;?>
    </tbody>
</table>
</form>
<?php if(count($members)>0): ?>
<?php echo $links ;?>
<?php endif; ?>
      </div>
    </div>
  </div>


   