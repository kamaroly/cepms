
<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('loans');?>" class="active">
                  <i class="icon-th-list"></i>
                  <h3>loans list </h3>
                </a>
               
            </div> <!-- /widget-header -->
          
   <div class="widget-content">
<!-- Modal -->

<?php if(count($loans)>0): ?>
<div class="pull-left"><?php echo $links ;?></div>
 
  <div class="">

<form class="faq-search">
 <strong>Search :</strong> 
  <select name="field">
   <option value="member_id">Membership number</option>
   <option value="first_name">First Name</option>
   <option value="last_name">Last Name</option>

  </select>
  <input type="text" name="search" placeholder="Search by Keyword">
  <button class="btn btn-primary"><i class="icon-search"></i></button>
</form>
</div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
         <th>#</th>
         <th>Borrower</th>
         <th>Given amount</th>
         <th>Interest amount</th>
         <th>Amount to payback</th>
         <th>Monthly payment</th>
         <th>Balance</th>
         <th>Due date</th>
         <th></th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($loans as $loan):?>
        <tr>
<td><?php echo $loan->loanid; ?></td>
<td><?php echo $loan->first_name.' '.$loan->last_name; ?></td>
<td><?php echo $loan->approved_amount; ?></td>
<td><?php echo $loan->total_loan_interest-$loan->approved_amount; ?></td>
<td><?php echo $loan->total_loan_interest; ?></td>
<td><?php echo $loan->monthly_payment_fees; ?></td>
<td><?php echo $loan->total_loan_interest-$this->loanpayments->GetLoanPaymentSum($loan->loanid); ?></td>
<td><?php echo date('Y-m-d',strtotime("+".(1+$loan->installment)." months", strtotime($loan->letter_date))); ?></td>
<td>
<a data-toggle="modal" href="<?php echo site_url('loans/payment/'.$loan->loanid); ?>" data-target="#utility"
   class="btn btn-primary">
  <i class="btn-icon-only icon-list-alt"></i> Refund</a><br />

</td>
          </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php endif; ?>
<?php if(count($loans)>0): ?>
<?php echo $links ;?>
<?php endif; ?>
      </div>
    </div>
  </div>


