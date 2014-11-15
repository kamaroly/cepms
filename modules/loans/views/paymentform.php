<form class="form-horizontal" method="POST" ACTION="<?php echo site_url('loans/payment/'.$loan->loanid); ?>">


<table class="table table-striped">
    <thead>
        <tr>
         
         <th>Interest amount</th>
         <th>Amount to payback</th>
         <th>Monthly payment</th>
         <th>Due date</th>
         <th></th>
           
        </tr>
    </thead>
<tbody>
<tr>
   <td><?php echo $loan->total_loan_interest-$loan->approved_amount; ?></td>
   <td><?php echo $loan->total_loan_interest; ?></td>
   <td><?php echo $loan->monthly_payment_fees; ?></td>
   <td><?php echo date('Y-m-d',strtotime("+".$loan->installment." months", strtotime($loan->created_at))); ?></td>
</tr>
</tbody>
</table>
<legend></legend>
<input type="hidden" name="member_id" value="<?php echo $loan->member_id; ?>">
<input type="hidden" name="loan_id" value="<?php echo $loan->loanid; ?>">
<input type="hidden" name="total_loan_interest" value="<?php echo $loan->total_loan_interest; ?>">
  <div class="control-group span6">                     
      <label class="control-label">Payment date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2"  name="date_paid" value="<?php echo date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div>    

  <div class="control-group span4">                     
      <label class="control-label">Amount:</label>
    <div class="controls">
    <input type="text" name="paid_amount" value="<?php echo $loan->monthly_payment_fees; ?>" class="span2" >                 
    </div>
  </div> 
  <div class="control-group span4">                     
                      <label class="control-label" for="type_of_payment">Type of payment</label>
                      <div class="controls">
                        <select name="type_of_payment">
                            <option value="topup">Top up</option>
                            <option value="bank">Bank</option>
                        </select>
                       </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
     
  <div class="control-group span4">                     
      <label class="control-label">Description:</label>
    <div class="controls">
    <input type="text" name="description"  class="span2" >                 
    </div>
  </div>      
<br>    
<br>
<br>
<br>
<br>
<br>

<br>
<br>
<br>
<br>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
              <button class="btn btn-primary">Save</button>
            </div>

</form>