
  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Contribution report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>
<div class="main-inner">
    <div class="container">   
<div class="widget ">
         
 <div class="widget-content">

<?php if(count($member_contributions)>0): ?>

<table class="table table-striped" style="border:1px solid #ccc;">
<tr>
<th style="font-size:14;text-align:center">S/N </th>	 
<th style="font-size:14;text-align:center">RANK  </th> 
<th style="font-size:14;text-align:center">NOM 	</th> 
<th style="font-size:14;text-align:center">PRENOM 	</th>
<th style="font-size:14;text-align:center">CEP CONTRIBUTIONS 	</th> 
<th style="font-size:14;text-align:center">SOCIAL FUND</th>
<th style="font-size:14;text-align:center">MONTH</th>
</tr>
<tbody>
  <?php $sum_cep=0;
        $sum_social=0; ?>
<?php foreach ($member_contributions as $member_contribution) :?>  
   <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->membership_number; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->rank; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->first_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->last_name; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->cep_contribution;$sum_cep+=$member_contribution->cep_contribution; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->social_fund; $sum_social+=$member_contribution->social_fund; ?></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><?php echo $member_contribution->month; ?></td>
   </tr style="border:1px solid #ccc;font-size:12px; text-align:center">
<?php endforeach; ?>
 <tr style="border:1px solid #ccc;">
    <td style="border:1px solid #ccc;font-size:12px; text-align:center" colspan="4">Total</td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><u><strong><?php echo $sum_cep; ?></strong></u></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center"><u><strong><?php echo $sum_social; ?></strong></u></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:center">&nbsp</td>
   </tr style="border:1px solid #ccc;font-size:12px; text-align:center">

</tbody>
</table>

<?php else: ?>
	No contribution available.
<?php endif; ?>

</div>
    </div>
  </div>
