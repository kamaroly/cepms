<?php //declaring variables to use;

$ending_balance_1=0;
$ending_balance_2=0;
$cumilative_interest=0;
$principals=0;

$repeat=1;
?>

<table border=1>
  <caption><h4><?php echo "Loan PayBack Plan  for ".$member->first_name.' '.$member->last_name.' with membership number '.$member->membership_number ; ?></h4></caption>
<tr>
<TH style="font-size:14;text-align:Left">PMT</TH> 
<TH style="font-size:14;text-align:Left">PAYMENT DATE</TH> 
<TH style="font-size:14;text-align:Left">ENDING BALANCE </TH> 
<TH style="font-size:14;text-align:Left">TOTAL PMT 	</TH>  
<TH style="font-size:14;text-align:Left">PRINCIPAL </TH> 	 
<TH style="font-size:14;text-align:Left">INTEREST 	 </TH> 
<TH style="font-size:14;text-align:Left">ENDING BALANCE</TH> 
<TH style="font-size:14;text-align:Left">CUMILATIVE INTEREST </TH>
</tr>

<tbody>
<?php for ($repeat=1;$repeat<=$paybackhistory->installment;$repeat++):?>
 <?php if ($repeat==1) {
 	$ending_balance_1=$paybackhistory->approved_amount;
 	$principals =$paybackhistory->approved_amount/$paybackhistory->installment;
 } ?>
  <tr>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $repeat; ?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo date('Y-m-d',strtotime("+".$repeat." months", strtotime($paybackhistory->letter_date))); ?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo number_format(intval(($repeat!=1)?$ending_balance_1=$ending_balance_1-$principals:$ending_balance_1));?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $paybackhistory->monthly_payment_fees ?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo number_format(intval($principals));?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo ($paybackhistory->approved_amount * $paybackhistory->interest_rate)/($paybackhistory->installment*100);$cumilative_interest+=($paybackhistory->approved_amount * $paybackhistory->interest_rate)/($paybackhistory->installment*100)?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo number_format(intval(($ending_balance_1>$paybackhistory->monthly_payment_fees)?$ending_balance_1-$paybackhistory->monthly_payment_fees:0)) ?></td>
   <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo number_format($cumilative_interest); ?></td>
  </tr>
<?php endfor; ?>
</tbody> 
</table>

