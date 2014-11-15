  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Loan not  yet  paid report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>

<div class="main-inner">
    <div class="container">
      
<div class="widget ">

 <div class="widget-content">

<?php if(count($loansnotyetpaid)>0): ?>
  
<table class="table table-striped" style="border:1px solid #ccc;">
<tr>
<th style="font-size:14;text-align:Left">S/N </th>	 
<th style="font-size:14;text-align:Left">First name</th> 
<th style="font-size:14;text-align:Left">Last name</th>
<th style="font-size:14;text-align:Left">Loan date</th>
<th style="font-size:14;text-align:Right">Amount + interest</th>
<th style="font-size:14;text-align:Right">Amount paid as of today</th>
<th style="font-size:14;text-align:Right">Amount to pay</th>
<th style="font-size:14;text-align:Right">Final payment date</th>
</tr>
<tbody>
    <?php $sum_loan=0;
        $sum_loanpaid=0;
        $sum_loanyetpaid=0; ?>
<?php foreach ($loansnotyetpaid as $memberloan) :?>  
   <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $memberloan->membership_number; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $memberloan->first_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $memberloan->last_name; ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo date('Y-m-d',strtotime($memberloan->letter_date)); ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><?php echo $memberloan->total_loan_interest;$sum_loan+=$memberloan->total_loan_interest; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><?php echo $memberloan->paid_amount;$sum_loanpaid+=$memberloan->paid_amount;?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><?php echo $memberloan->balance;$sum_loanyetpaid+=$memberloan->balance; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Right"><?php echo date('Y-m-d',strtotime("+".$memberloan->installment." months", strtotime($memberloan->created_at))); ?></td>
   </tr>
<?php endforeach; ?>
</tbody>
</table>
<br>
<div class="pull-right"><b><?php echo "Total Loan Amount "?><u> <?php echo ":".$sum_loan;  echo "  rwf "?></u> </b></div>
<br>
<div class="pull-right"><b><?php echo "Total Paid "?><u> <?php echo ":".$sum_loanpaid; echo "  rwf "?></u></b></div>
<br>
<div class="pull-right"><b><?php echo "Total to be paid "?><u> <?php echo ":".$sum_loanyetpaid;echo "  rwf "?></u></b></div>
<?php else: ?>
	No Loan available.
<?php endif; ?>

      </div>
    </div>
  </div>
