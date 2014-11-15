<?php //initiating variables

$closingBalance_debit=0;  // this is used when it's for debiting ( removing money on the account)
$closingBalance_credit=0; // This is used when it's crediting ( adding money on the account)


?>

<table border=1>
<caption><h4><u>BOOK OF THE BANK FROM <?php echo $this->input->post('start_date') ?> TO <?php echo $this->input->post('end_date') ?></u></h4></caption>
<thead>
<TH style="font-size:14;text-align:Left">DATE 	</TH>
<TH style="font-size:14;text-align:Left">TRANSACTION ID</TH>		
<TH style="font-size:14;text-align:Left">DESCRIPTION</TH>
<TH style="font-size:14;text-align:Left">PAYMENT METHOD (REFERENCE)</TH>
<TH style="font-size:14;text-align:Left">DEPOSIT </TH>	
<TH style="font-size:14;text-align:Left">WIDTHRAW 	</TH>
<TH style="font-size:14;text-align:Left">BALANCE</TH>
</thead>

<tbody>
<?php if(!empty($postings)): //check if the postings has any data in it ?>
<?php $creditsum2=0; ?>
<?php $debitsum2=0; ?>


<tr>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo date('Y-m-d',strtotime($start_date)); ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $MaxTranefsactionId; ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left">Libelle</td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $openingbalance;?></td>
	</tr>


<?php foreach ($postings as $posting) : ?>
	<tr>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo date('Y-m-d',strtotime($posting->created_at)); ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $posting->transaction_id; ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo ($posting->amount>0)?"VT/Rmst ".$posting->comment:"RT/CD ".$posting->comment; ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $posting->payment_method."(".$posting->reference_number.")"; //@todo:add this field in the database ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo ($posting->amount>0)?number_format($closingBalance_credit= $posting->amount):""; ($posting->amount>0)?$creditsum2+=$posting->amount:'';?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo ($posting->amount<0)?number_format($closingBalance_debit=-1*$posting->amount):"";($posting->amount<0)?$debitsum2+=-1*$posting->amount:''; ?></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo number_format($openingbalance+=$posting->amount); ?></td>
	</tr>
<?php endforeach; ?>
     <tr>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><strong><u>Total</u></strong></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><strong><u><?php echo number_format($creditsum2); ?></u></strong></td>
     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><strong><u><?php echo number_format($debitsum2); ?></u></strong></td>

     <td style="border:1px solid #ccc;font-size:12px; text-align:Left"></td>
     </tr>
<?php endif; ?>
</tbody>
</table>