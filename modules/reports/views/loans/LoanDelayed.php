  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Loan report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>

<div class="main-inner">
    <div class="container">
      
<div class="widget ">

 <div class="widget-content">

<?php if(count($memberloans)>0): ?>

<table class="table table-striped" style="border:1px solid #ccc;">
	<caption><strong>Loan in delay of  payement  and their  Retribution revenue.</strong></caption>
	<thead>
<tr>
<th style="font-size:14px;text-align:Left">#</th>
<th style="font-size:14px;text-align:Left">Rank	 </th>
<th style="font-size:14px;text-align:Left">Fist Name </th>
<th style="font-size:14px;text-align:Left">last Name </th>
<th style="font-size:14px;text-align:Left">Loan Date </th>
<th style="font-size:14px;text-align:Left">Loan </th>
<th style="font-size:14px;text-align:Left">Start payment</th>
<th style="font-size:14px;text-align:Left">End Payement </th>
<th style="font-size:14px;text-align:Left">Last payment	 </th>
<th style="font-size:14px;text-align:Left">Overdue months </th>	
<th style="font-size:14px;text-align:Left">Retribution(1%)  </th>
</tr>
</thead>
<tbody>
<?php $loansum=0; ?>
<?php $interestsum=0; ?>

<?php foreach ($memberloans as $memberloan) :?>  
	<tr>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->membership_number; ?></td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->rank; ?>	 </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->first_name; ?></td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->last_name; ?></td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime($memberloan->letter_date)); ?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo number_format($memberloan->total_loan_interest); ?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime("+1 months", strtotime($memberloan->letter_date))); ?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime("+".(1+$memberloan->installment)." months", strtotime($memberloan->letter_date))); ?></td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo ($lastPaymentMonth=$this->loanpayments->LastPaymentDate($memberloan->member_id))?date('Y-m-d',strtotime($lastPaymentMonth)):"No payment so far"; ?></td>
<td style="border:1px solid #ccc;font-size:12px; text-align:center">
<?php echo $memberloan->cnt_months;?></td>	
<td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo number_format(($memberloan->approved_amount*0.01)*$memberloan->cnt_months); ?></td>

</tr>

<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
	No Loan available.
<?php endif; ?>

      </div>
    </div>
  </div>












