                    <div class="control-group span4 ">                     
                      <label class="control-label" for="Level">Level</label>
                      <div class="controls">
                       <select name="level" onchange="this.options[this.selectedIndex].value && (window.location = '<?php echo site_url("members/batchcotisation") ;?>/'+this.options[this.selectedIndex].value);">
                            <option value="A0" <?php echo ($this->uri->segment(3)=='A0')?'selected':'';?> >A0 </option>
                            <option value="A1" <?php echo ($this->uri->segment(3)=='A1')?'selected':'';?> >A1 </option>
                            <option value="A2" <?php echo ($this->uri->segment(3)=='A2')?'selected':'';?> >A2 </option>
                            <option value="A3" <?php echo ($this->uri->segment(3)=='A3')?'selected':'';?> >A3 </option>
                            <option value="Dr Generaliste" <?php echo ($this->uri->segment(3)=='Dr Generaliste')?'selected':'';?> >Dr Generaliste </option> 
                            <option value="MASTER" <?php echo ($this->uri->segment(3)=='MASTER')?'selected':'';?> >MASTERS </option>
                            <option value="SPECIALISTE" <?php echo ($this->uri->segment(3)=='SPECIALISTE')?'selected':'';?> >SPECIALISTE </option>
                  
                     </select>   
                     </div>  
                    </div> <!-- /controls -->    
                   
                    <div class="control-group span4">                     
                      <label class="control-label" for="start_date">Month</label>
                      <div class="controls">
                          <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm">
                          <input class="span2" size="8 " name="month" value="<?php echo date('Y-m');?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                      </div> <!-- /controls -->       
                    
                    </div> <!-- /control-group -->
                    <div class="control-group span4">                     
                      <label class="control-label" for="email">CEP Fund</label>
                      <div class="controls">
                        <input type="text" name="cep_fund" value="<?php echo $this->config->item(str_replace('%20','_',$this->uri->segment(3)).'_cep'); ?>"size="4" >
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group span4">                     
                      <label class="control-label" for="email">Social Fund</label>
                      <div class="controls">
                        <input type="text" name="social_fund" value="<?php echo $this->config->item(str_replace('%20','_',$this->uri->segment(3)).'_social'); ?>" size="4" >
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
<hr>       <div class="control-group span4">                     
                      <div class="controls">
              <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to save? this operation cannot be reversed.');">Save</button> <a class="btn" href="<?php echo site_url('members'); ?>">Cancel</a>  
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->



                     
            
            
      