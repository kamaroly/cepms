  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Membere  Details</u></h2>

<div class="main-inner">
    <div class="container">
<div class="widget ">

 <div class="widget-content">
<?php if($member): ?>        
<p>Membership Number:      <strong><?php echo $member->membership_number; ?></strong></p>       
<p>Rank:                   <strong><?php echo $member->rank; ?></strong></p>        
<p>First Name:             <strong><?php echo $member->first_name; ?></strong></p>        
<p>Last Name :             <strong><?php echo $member->last_name; ?></strong></p>       
<p>Date of Birth:          <strong><?php echo $member->dob; ?></strong></p>       
<p>Nationality:            <strong><?php echo $member->nationality; ?></strong></p>       
<p>District:               <strong><?php echo $member->district; ?></strong></p>        
<p>Province:               <strong><?php echo $member->province; ?></strong></p>        
<p>Sex :                   <strong><?php echo $member->sex; ?></strong></p>       
<p>Nation Identication:    <strong><?php echo $member->nid; ?></strong></p>       
<p>Telephone:              <strong><?php echo $member->phone; ?></strong></p>       
<p>E-Mail :                <strong><?php echo $member->email; ?></strong></p>       
<p>Start Date:             <strong><?php echo $member->start_date; ?></strong></p>        
<p>Service  :              <strong><?php echo $member->service; ?></strong></p>       
<p>Level :                 <strong><?php echo $member->level; ?></strong></p>       
<p>Cep Fund :              <strong><?php echo $member->cep_fund; ?></strong></p>        
<p>Social Fund :           <strong><?php echo $member->social_fund; ?></strong></p>       
<p>Net Salary :            <strong><?php echo $member->net_salary; ?></strong></p>        
<p>Top up :                <strong><?php echo $this->config->item($member->level.'_topup'); ?></strong></p>        
<p>Status :                <strong><?php echo $member->status; ?></strong></p>        


 <div class="control-group span6">   
                   <label class="control-label" for="rank">Photo</label>
                   <div class="controls">
                    <?php if(isset($member) && $member->photo!=null && $member->photo!='' && $member->photo!='N/A') :?>
                   <img src="<?php echo assets_url('img/'.$member->photo) ?>" class="img-rounded">  
                    <?php else: ?>   
                     No photo uploaded yet.
                    <?php endif; ?>
                 
                 </div> <!-- /control-group --> 
                 </div>      
                    
                <div class="control-group span5 pull-right">   
                   <label class="control-label" for="rank">Signature</label>
                     <div class="controls">
               <?php if(isset($member) && $member->signature!=null && $member->signature!='' && $member->signature!='N/A') :?>
                   <img src="<?php echo assets_url('img/'.$member->signature) ?>" class="img-rounded">     
               <?php else: ?>   
                     No signature uploaded yet.
               <?php endif; ?> 
                
               </div> <!-- /control-group -->  
                 </div>    
        
Genereted   by        
<?php else: ?>
  No member available.
<?php endif; ?>

      </div>
    </div>
  </div>