  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Loan report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>

<div class="main-inner">
    <div class="container">
      
<div class="widget ">

 <div class="widget-content">

<?php if(count($memberloans)>0): ?>
  
<table class="table table-striped" style="border:1px solid #ccc;">

<tr  class="table table-striped" style="border:1px solid #ccc;">
<th style="font-size:14;text-align:center;border:1px solid #ccc">S/N </th>   
<th style="font-size:14;text-align:center;border:1px solid #ccc">First name</th> 
<th style="font-size:14;text-align:center;border:1px solid #ccc">Last name</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Final payment date</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Period</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc" colspan="3">Amount </th>
<th style="font-size:14;text-align:center;border:1px solid #ccc" colspan="3">Monthly Paid </th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Amount paid as of today</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Balance</th>

</tr>

<tr class="table table-striped" style="border:1px solid #ccc;">
<th style="font-size:14;text-align:center;border:1px solid #ccc"></th>   
<th style="font-size:14;text-align:center;border:1px solid #ccc"><th> 
<th style="font-size:14;text-align:center;border:1px solid #ccc"></th>
<th style="font-size:14;text-align:center;border:1px solid #ccc"></th>

<th style="font-size:14;text-align:center;border:1px solid #ccc" >Given </th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">interest</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Total</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Given </th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">interest</th>
<th style="font-size:14;text-align:center;border:1px solid #ccc">Total</th>

<th style="font-size:14;text-align:center;border:1px solid #ccc"></th>
<th style="font-size:14;text-align:center;border:1px solid #ccc"></th>

</tr>
<tbody>

<?php $approvedsum=0; ?>
<?php $Total_interest_sum=0; ?>
<?php $Total_interest_sum2=0; ?>
<?php $Month_payement_sum=0; ?>
<?php $Paid_amount_sum=0; ?>
<?php $Total_balance_sum=0; ?>
<?php $montly_amount_sum=0; ?>
<?php $montly_interest_sum=0; ?>

<?php foreach ($memberloans as $memberloan) :?>  
   <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:left"><?php echo $memberloan->membership_number; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:left"><?php echo $memberloan->first_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:left"><?php echo $memberloan->last_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime("+".$memberloan->installment." months", strtotime($memberloan->created_at))); ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->installment; ?></td>

   <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->approved_amount);$approvedsum+=$memberloan->approved_amount; ?></td>
   
       <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->interest);$Total_interest_sum2+=$memberloan->interest; ?></td>

   <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->total_loan_interest);$Total_interest_sum+=$memberloan->total_loan_interest; ?></td>

   <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->monthlypaid);$montly_amount_sum=+$memberloan->monthlypaid;?></td>

   <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->approved_amount*$memberloan->interest_rate/1200);$montly_interest_sum+=$memberloan->approved_amount*$memberloan->interest_rate/1200; ?></td>
  
       <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->monthly_payment_fees);$Month_payement_sum+=$memberloan->monthly_payment_fees; ?></td>


   <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->paid_amount);$Paid_amount_sum+=$memberloan->paid_amount; ?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:right"><?php echo number_format($memberloan->total_loan_interest-$memberloan->paid_amount);$Total_balance_sum+=($Total_interest_sum-$Paid_amount_sum); ?></td>

    
   </tr>
<?php endforeach; ?>

<tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:Left" colspan="5"><u><strong>Total</strong></u></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($approvedsum); ?></strong></u></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($Total_interest_sum2); ?></strong></u></td>

    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($Total_interest_sum); ?></strong></u></td>
        <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($montly_amount_sum); ?></strong></u></td>
        <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($montly_interest_sum); ?></strong></u></td>
        <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($Month_payement_sum); ?></strong></u></td>
       <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($Paid_amount_sum); ?></strong></u></td>
         <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><u><strong><?php echo number_format($Total_balance_sum); ?></strong></u></td>

     </tr>
</tbody>
</table>
<?php else: ?>
	No Loan available.
<?php endif; ?>

      </div>
    </div>
  </div>
