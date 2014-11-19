<div class="main-inner">
    <div class="container">
   <!--Notification area -->

<div class="widget" ng-app>
              
              <div class="widget-header">
                <a href="<?php echo site_url('journals');?>" class="active">
                  <i class="icon-credit-card"></i>
                  <h3>Give new loan</h3>
                </a>
               
            </div> <!-- /widget-header -->
          
   <div class="widget-content">

 <form  class="form-horizontal" method="POST" ACTION="<?php echo site_url($this->uri->uri_string());?>">

<fieldset>
<legend class="span12">
<label class="label label-primary span3"><H3>MAX TOP UP  :<u><?php echo number_format($topup=($this->config->item(str_replace(' ', '_', $member->level.'_topup'))*12)-(($this->config->item($member->level.'_topup')*12)*0.18)); ?></u></H3></label>
<label class="label label-inverse span3"><H3>OUTSTANDING :<u><?php echo number_format($outstanding=($this->Loans->GetOustandingPayment($member->id,TRUE)<0)?0:$this->Loans->GetOustandingPayment($member->id,TRUE)); ?></u> </H3></label>
<label class="label label-success span3"><H3>RECEIVABLE  :<u><?php echo number_format($topup-$outstanding); ?></u></H3></label>
<label class="label label-warning span3"><H3>PAYABLE     :<u><?php echo number_format($this->config->item(str_replace(' ', '_', $member->level.'_topup'))*12); ?></u></H3></label>

  <?php $interest_rate = $this->config->item('interest_rate');?>
  <?php if ($outstanding) {
    $interest_rate  = $loanDetails->interest_rate;
  } ?>
  

</legend>

                  <input type="hidden" name="member_id" value="<?php echo $member->id; ?>" />
                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Rank:</label>
                      <div class="controls">
                        <input type="text" name="rank" value="<?php echo $member->rank; ?>" readonly/>
                      </div>
                </div>
                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Level:</label>
                      <div class="controls">
                        <input type="text" name="level" value="<?php echo $member->level; ?>" readonly/>
                      </div>
                </div>
                <div class="control-group span4">                     
                      <label class="control-label" for="rank">First Name:</label>
                      <div class="controls">
                        <input type="text" name="first_name" value="<?php echo $member->first_name; ?>" readonly/>
                      </div>
                </div>

                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Last Name:</label>
                      <div class="controls">
                        <input type="text" name="last_name" value="<?php echo $member->last_name; ?>" readonly/>
                      </div>
                </div>
                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Membership date:</label>
                      <div class="controls">
                        <input type="text" name="start_date" value="<?php echo $member->start_date; ?>" readonly/>
                      </div>
                </div>

              <div class="control-group span4">                     
                      <label class="control-label" for="rank">Letter Date:</label>
                      <div class="controls">
                        <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2" size="8 " name="letter_date" value="<?php echo date('Y-m-d') ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
                
    </fieldset>  
     <fieldset >
      <legend>Loan Details</legend>
                  <input type="hidden"   />
          
                   <div class="control-group span4">                     
                      <label class="control-label" for="rank">Loan Contract Number:</label>
                      <div class="controls">
                        <input type="number" name="loan_contract_number" value="<?php echo $contractid; ?>" readonly/>
                      </div>
                </div>
                <div class="control-group span4">                     
                      <label class="control-label" for="interest_rate">Interest Rate:  </label>
                      <div class="controls">
                    
                        <input type="number" name="interest_rate" ng-model="interest_rate" ng-init="interest_rate =<?php echo $interest_rate; ?>" readonly/>
                      </div>
                </div>
               

                                <div class="control-group span4">                     
                      <label class="control-label" for="wished_amount">Wished amount:   </label>
                      <div class="controls">
                        <input type="number" name="wished_amount" readonly value=" <?php echo intval(($this->Loans->eligibleforloan($member->id)*12)/(1+($interest_rate/100))); ?> " />
                      </div>
                </div>
                
                <div class="control-group span4">                     
                      <label class="control-label" for="approved_amount">Approved amount:</label>
                      <div class="controls">
                        <input type="number" name="approved_amount" ng-model="approved_amount" />
                      </div>
                </div>
                
                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Installment:</label>
                      <div class="controls">
                <select name="installment" ng-model="installment" ng-init="installment=12">

                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="12" selected>12</option>
              </select>
                      </div>
                </div>

                 <div class="control-group span4">                     
                      <label class="control-label" for="rank">Total Interest:</label>
                      <div class="controls">
                        <input type="number" name="interest" readonly value="{{(approved_amount*((interest_rate)/100)) }}" ng-model="total_interest" />
                      </div>
                </div>
                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Total Loan + Interest:</label>
                      <div class="controls">
                        <input type="number" name="total_loan_interest" ng-model="total_loan_interest" value="{{approved_amount*(1+(interest_rate/100))  }}" readonly/>
                      </div>
                </div>
         
                                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Monthly payment fees :</label>
                      <div class="controls">
                        <input type="number" name="monthly_payment_fees" ng-model="MonthlyPayment"  value="{{(approved_amount*(1+(interest_rate/100)))/installment  }}" ng-init="MonthlyPayment=<?php echo $this->config->item($member->level.'_topup'); ?>" readonly/>
                      </div>
                </div>
                
                  <div class="control-group span4">                     
                      <label class="control-label" for="rank">Bank :</label>
                      <div class="controls">
                        <input type="text" name="bank" />
                      </div>
                </div>

                <div class="control-group span4">                     
                      <label class="control-label" for="rank">Cheque number :</label>
                      <div class="controls">
                        <input type="text" name="cheque_number" />
                      </div>
                </div>
                 <div class="control-group span6">                     
                      <label class="control-label" for="rank"> Description :</label>
                      <div class="controls">
                        <input type="text" name="description" class="span6" />
                      </div>
                </div>
                  
     </fieldset>
       
                      <br>
                        <div class="form-actions">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to give this loan? this action cannot be reverted once done.');">Save</button> <a class="btn" href="<?php echo site_url('members'); ?>">Cancel</a>                                        
                    </div>

</div>

      </div>
    </div>
<?php echo form_close();?>
  </div>

