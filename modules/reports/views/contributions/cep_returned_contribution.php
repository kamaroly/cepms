
  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Refund Contribution report></u></h2>
<div class="main-inner">
    <div class="container">   
<div class="widget ">
         
 <div class="widget-content">

<?php if(count($returned)>0): ?>

<table class="table table-striped" style="border:1px solid #ccc;">
<tr>
<th style="border:1px solid #ccc;font-size:14;text-align:center">S/N </th>	 
<th style="border:1px solid #ccc;font-size:14;text-align:center">RANK  </th> 
<th style="border:1px solid #ccc;font-size:14;text-align:center">NOM 	</th> 
<th style="border:1px solid #ccc;font-size:14;text-align:center">PRENOM 	</th>
<th style="border:1px solid #ccc;font-size:14;text-align:center">TOTAL CEP CONTRIBUTIONS 	</th> 
<th style="border:1px solid #ccc;font-size:14;text-align:center">LOAN NOT PAID</th>
<th style="border:1px solid #ccc;font-size:14;text-align:center">BALANCE</th>
<th style="border:1px solid #ccc;font-size:14;text-align:center">DONE  AT</th>
</tr>
<tbody>
  <?php $sum_cep=0;
        $sum_social=0; ?>
<?php foreach ($returned as $returned) :?>  
   <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->membership_number; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->rank; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->first_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->last_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->total_cep_found; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->loan_not_paid_plus_interest; ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $returned->balance; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo date('Y-m-d',strtotime( $returned->created_at)); ?></td>

   </tr style="border:1px solid #ccc;font-size:12px; text-align:center">
<?php endforeach; ?>
 </tbody>
</table>

<?php else: ?>
	No contribution available.
<?php endif; ?>

</div>
    </div>
  </div>
