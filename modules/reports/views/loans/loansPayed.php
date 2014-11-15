  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Loan Payed and  their  Revenue report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>

<div class="main-inner">
    <div class="container">
      
<div class="widget ">

 <div class="widget-content">

<?php if(count($PayedAmount)>0): ?>
  
<table class="table table-striped" style="border:1px solid #ccc;">
<tr>
<th style="font-size:14;text-align:center">S/N </th>   
<th style="font-size:14;text-align:center">First name</th> 
<th style="font-size:14;text-align:center">Last name</th>
<th style="font-size:14;text-align:center">Loan Payed Date</th>
<th style="font-size:14;text-align:center">Loan</th>
<th style="font-size:14;text-align:center">Total Revenue of Loan</th>
</tr>
<tbody>
  <?php $loansum=0; ?>
  <?php $interestsum=0; ?>
<?php foreach ($PayedAmount as $PayedAmount) :?>  
   <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $PayedAmount->membership_number; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $PayedAmount->first_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $PayedAmount->last_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime($PayedAmount->modified_at)); ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo number_format($PayedAmount->approved_amount);$loansum+=$PayedAmount->approved_amount; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo number_format($PayedAmount->interest);$interestsum+=$PayedAmount->interest; ?></td>
   </tr>

<?php endforeach; ?>
<tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:center" colspan="4">Total</td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><u><strong><?php echo number_format($loansum); ?></strong></u></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><u><strong><?php echo number_format($interestsum); ?></strong></u></td>
    
     </tr>
</tbody>
</table>
<?php else: ?>
  No Loan available.
<?php endif; ?>

      </div>
    </div>
  </div>
