

<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('transactions');?>" class="active">
                  <i class="icon-th-list"></i>
                  <h3>Transactions list </h3>
                </a>
                <a href="<?php echo site_url('transactions/save');?>" >
                   <i class="icon-plus-sign"></i>
                   <h3>New Transaction</h3>
                </a>
            </div> <!-- /widget-header -->
          
   <div class="widget-content">

    <?php if(! empty($errors)): ?>
     <div class="container">

         <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Error!</strong> <?php echo $errors;?>       
         </div>
     </div>
 <?php endif; ?>

<style type="text/css">

.profile-picture{
  width: 140px;
  height: 140px;
  float: left;
  display: block;
}
</style>

<form action="<?php echo site_url($this->uri->uri_string());?>" enctype="multipart/form-data" method="POST" class="form-horizontal">

<legend>Account</legend>
    <!-- START LEFT COLUMNS -->

<div class="col-xs-6">

  <div class="form-group">


    <label for="from_account" class="control-label col-xs-4">From account: </label>
    <div class="col-xs-8">

         <select name="from_account">
            <?php foreach ($accounts as $account) :?>
               <option value="<?php echo $account->id; ?>"><?php echo $account->code.' ['.$account->name.']'; ?></option>
            <?php endforeach; ?>
           </select>
              
      </div>
 <p></p>
   <label for="to_account" class="control-label col-xs-4">Amount</label>
      <div class="col-xs-8">
          <input  name="amount" value="<?php echo set_value('amount'); ?>"/>   
      </div>
  <p></p>
     <label for="to_account" class="control-label col-xs-4">To account: </label>
    <div class="col-xs-8">

         <select name="to_account">
            <?php foreach ($accounts as $account) :?>
               <option value="<?php echo $account->id; ?>"><?php echo $account->code.' ['.$account->name.']'; ?></option>
            <?php endforeach; ?>
           </select>
             
      </div>
 <p></p>
    <label for="journals" class="control-label col-xs-4">Journals: </label>
    <div class="col-xs-8">

         <select name="journal">
            <?php foreach ($journals as $journal) :?>
               <option value="<?php echo $journal->id; ?>"><?php echo $journal->type; ?></option>
            <?php endforeach; ?>
           </select>
             
      </div>
 <p></p>
  
    <label for="payment_method" class="control-label col-xs-4">Payment Method: </label>
    <div class="col-xs-8">

         <select name="payment_method" id="payment_method">
           <option value="CHEQUE"> CHEQUE</option>
           <option value="PAYSLIP"> PAY SLIP</option>
           </select>
             
      </div>
   <p></p>
  
    <label for="number" class="control-label col-xs-4">Reference: </label>
    <div class="col-xs-8">
      <input type="number" id="number" name="reference_number">
      </div>

  <p></p>
    <label for="comment" class="control-label col-xs-4">Comment</label>
         <div class="col-xs-8">
            <textarea name="comment">

            </textarea>
         </div>

<button class="btn btn-small btn-success"onclick="return confirm('Are you sure you want to save this transaction? You won\'t be able to reverse it.');"><i class="icon-save"></i> Save</button>

<a class="btn" href="<?php echo site_url('transactions'); ?>">Cancel</a> 
  
</form>

  </div>
  </div>
</div>
