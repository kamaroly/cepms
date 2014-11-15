  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Loan report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>

<div class="main-inner">
    <div class="container">
      
<div class="widget ">

 <div class="widget-content">

<?php if(count($memberloans)>0): ?>
  
<table class="table table-striped" style="border:1px solid #ccc;">
<tr>
<th style="font-size:14;text-align:center">S/N </th>	 
<th style="font-size:14;text-align:center">First name</th> 
<th style="font-size:14;text-align:center">Last name</th>
<th style="font-size:14;text-align:center">Loan date</th>
<th style="font-size:14;text-align:center">Loan</th>
<th style="font-size:14;text-align:center">Total Revenue of Loan</th>
</tr>
<tbody>
	<?php $loansum=0; ?>
	<?php $interestsum=0; ?>
<?php foreach ($memberloans as $memberloan) :?>  
   <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->membership_number; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->first_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $memberloan->last_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime($memberloan->letter_date)); ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo number_format($memberloan->approved_amount);$loansum+=$memberloan->approved_amount; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo number_format($memberloan->interest);$interestsum+=$memberloan->interest; ?></td>
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
