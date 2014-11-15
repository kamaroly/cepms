
<div class="main-inner">
    <div class="container">
      
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
    <div class="tab-content">
              
  <form id="edit-profile" class="form-horizontal" method="POST"ACTION="<?php echo site_url($this->uri->uri_string());?>"  accept-charset="utf-8" enctype="multipart/form-data">
                  <fieldset>
                

                 <div class="control-group span6">   
                   <label class="control-label" for="rank">Photo</label>
                   <div class="controls">
                    <?php if(isset($member) && $member->photo!=null && $member->photo!='' && $member->photo!='N/A') :?>
                   <img src="<?php echo assets_url('img/'.$member->photo) ?>" class="img-rounded">  
                    <?php else: ?>   
                     No photo uploaded yet.
                    <?php endif; ?>
                     <input type="file" name="photo" >
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
                 <input type="file" name="signature"> 
               </div> <!-- /control-group -->  
                 </div>     
                    
                    
              <div class="control-group span4 pull-left">                     
                   <label class="control-label" for="rank">Rank</label>
                      <div class="controls">
                        <select name="rank">
                              
  <option <?php echo (isset($member) && $member->rank=='lance Corporal')?'selected':''; ?> value="lance Corporal"> lance Corporal </option>
  <option <?php echo (isset($member) && $member->rank=='Corporal')?'selected':''; ?> value="Corporal"> Corporal </option>
  <option <?php echo (isset($member) && $member->rank=='Sergeant')?'selected':''; ?> value="Sergeant"> Sergeant </option>
  <option <?php echo (isset($member) && $member->rank=='Staff Sergeant')?'selected':''; ?> value="Staff Sergeant"> Staff Sergeant </option>
  <option <?php echo (isset($member) && $member->rank=='Warrant Officer II')?'selected':''; ?> value="Warrant Officer II"> Warrant Officer II </option>
  <option <?php echo (isset($member) && $member->rank=='Warrant Officer I')?'selected':''; ?> value="Warrant Officer I"> Warrant Officer I </option>
  <option <?php echo (isset($member) && $member->rank=='Second Lieutenant')?'selected':''; ?> value="Second Lieutenant"> Second Lieutenant </option>
  <option <?php echo (isset($member) && $member->rank=='First  Lieutenant')?'selected':''; ?> value="First  Lieutenant"> First  Lieutenant </option>
  <option <?php echo (isset($member) && $member->rank=='Captain')?'selected':''; ?> value="Captain"> Captain </option>
  <option <?php echo (isset($member) && $member->rank=='Major')?'selected':''; ?> value="Major"> Major </option>
  <option <?php echo (isset($member) && $member->rank=='Lieutenant Colonel')?'selected':''; ?> value="Lieutenant Colonel"> Lieutenant Colonel </option>
  <option <?php echo (isset($member) && $member->rank=='Colonel')?'selected':''; ?> value="Colonel"> Colonel </option>
  <option <?php echo (isset($member) && $member->rank=='Brigadier General')?'selected':''; ?> value="Brigadier General"> Brigadier General </option>
  <option <?php echo (isset($member) && $member->rank=='Major General')?'selected':''; ?> value="Major General"> Major General </option>
  <option <?php echo (isset($member) && $member->rank=='Lieutenant  General')?'selected':''; ?> value="Lieutenant  General"> Lieutenant  General </option>
  <option <?php echo (isset($member) && $member->rank=='General')?'selected':''; ?> value="General"> General </option>
  <option <?php echo (isset($member) && $member->rank=='Civilian ')?'selected':''; ?> value="Civilian"> Civilian  </option>


                        </select>

                       </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                     
                    <div class="control-group span4">                     
                      <label class="control-label" for="email">First name</label>
                      <div class="controls">
                        <input type="text" name="first_name" value="<?php echo isset($member)?$member->first_name:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->


                    <div class="control-group span4">                     
                      <label class="control-label" for="email">Last name</label>
                      <div class="controls">
                        <input type="text" name="last_name" value="<?php echo isset($member)?$member->last_name:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                   
                    <div class="control-group span4">                     
                      <label class="control-label" for="start_date">Date of Birth</label>
                      <div class="controls">
                          <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2" size="16" name="dob" value="<?php echo isset($member)?$member->dob:date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                      </div> <!-- /controls -->       
                    
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="email">Nationality</label>
                      <div class="controls">
                        <input type="text" name="nationality" value="<?php echo isset($member)?$member->nationality:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="email">District</label>
                      <div class="controls">
                        <input type="text" name="district" value="<?php echo isset($member)?$member->district:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="province">Province</label>
                      <div class="controls">
                        <input type="text" name="province" value="<?php echo isset($member)?$member->province:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="sex">Sex</label>
                      <div class="controls">
                        <input type="text" name="sex" value="<?php echo isset($member)?$member->sex:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->


                    <div class="control-group span4">                     
                      <label class="control-label" for="phone">Phone</label>
                      <div class="controls">
                        <input type="text" name="phone" value="<?php echo isset($member)?$member->phone:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
    
                    <div class="control-group span4">                     
                      <label class="control-label" for="email">Email</label>
                      <div class="controls">
                      <input type="email" name="email" value="<?php echo isset($member)?$member->email:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="start_date">Start Date</label>
                      <div class="controls">
                          <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2" size="16" name="start_date" value="<?php echo isset($member)?$member->start_date:date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                      </div> <!-- /controls -->       
                    
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="service">Service</label>
                      <div class="controls">
                        <input type="text" name="service" value="<?php echo isset($member)?$member->service:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="cep_fund">CEP fund</label>
                      <div class="controls">
                        <input type="text" name="cep_fund" value="<?php echo isset($member)?$member->cep_fund:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="social_fund">Social Fund</label>
                      <div class="controls">
                        <input type="text" name="social_fund" value="<?php echo isset($member)?$member->social_fund:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="net_salary">Net Salary</label>
                      <div class="controls">
                        <input type="text" name="net_salary" value="<?php echo isset($member)?$member->net_salary:''; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="status">Status</label>
                      <div class="controls">
                        <select name="status">
                            <option value="active" <?php echo (strtolower($member->status)=='active')?'SELECTED':''; ?>>Active</option>
                            <option value="inactive" <?php echo (strtolower($member->status)=='inactive')?'SELECTED':''; ?>>Inactive</option>
                            <option value="left" <?php echo (strtolower($member->status)=='left')?'SELECTED':''; ?>>Left</option>
                        </select>
                       </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                   
                          <div class="control-group span4">                     
                      <label class="control-label" for="Level">Level</label>
                      <div class="controls">
                       <select name="level">
                            <option value="A0" <?php echo (isset($member) && $member->level=='A0')?'selected':'';?> >A0 </option>
                            <option value="A1" <?php echo (isset($member) && $member->level=='A1')?'selected':'';?> >A1 </option>
                            <option value="A2" <?php echo (isset($member) && $member->level=='A2')?'selected':'';?> >A2 </option>
                            <option value="A3" <?php echo (isset($member) && $member->level=='A3')?'selected':'';?> >A3 </option>
                            <option value="Dr Generaliste" <?php echo (isset($member) && $member->level=='Dr Generaliste')?'selected':'';?> >Dr Generaliste </option> 
                            <option value="MASTERS" <?php echo (isset($member) && $member->level=='MASTER')?'selected':'';?> >MASTER </option>
                            <option value="SPECIALISTE" <?php echo (isset($member) && $member->level=='SPECIALISTE')?'selected':'';?> >SPECIALISTE </option>
                  
                   </select>     </div> <!-- /controls -->    
                   <?php if(isset($member)): ?>
                  </div> <!-- /control-group -->
    
                  <div class="control-group span4">                     
                      <label class="control-label" for="membership_id">Membership #:</label>
                      <div class="controls">
                          <input type="text" name="membership_id" readonly value="<?php echo isset($member)?$member->membership_number:''; ?>">
                    
                    </div>
                  </div>

                   <?php endif;?>   
                     </div>  

                          
                      <br>
                    </fieldset>
                        <div class="form-actions  ">
                        <button type="submit" class="btn btn-primary">Save</button> <a class="btn" href="<?php echo site_url('members'); ?>">Cancel</a>                                        
                    </div>
               </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

