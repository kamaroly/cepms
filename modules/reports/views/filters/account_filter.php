<form class="form-horizontal" method="POST" ACTION="<?php echo site_url('reports/'.$report_url); ?>" target="_blank">

<legend></legend>

  <div class="control-group span6">                     
     <label class="control-label">Start date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2"  name="start_date" value="<?php echo date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div>    
  <div class="control-group span6">                     
     <label class="control-label">End date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2"  name="end_date" value="<?php echo date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div>

 <?php if ($report_url!='bilan'): ?>
   <div class="control-group span6">                     
       <label for="from_account" class="control-label col-xs-4">Choose account: </label>
    <div class="col-xs-8">

         <select name="from_account">
           <option value="0" seleted>Select Account</option>
            <?php foreach ($accounts as $account) :?>
               <option value="<?php echo $account->id; ?>"><?php echo $account->code.' ['.$account->name.']'; ?></option>
            <?php endforeach; ?>
           </select>
              
      </div>
  </div>   
  <<?php endif; ?>
<br>
<br>
<br>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
              <button class="btn btn-primary">View</button>
            </div>

</form>