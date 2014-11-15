  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u>Gift Report</u></h2>

<div class="main-inner">
    <div class="container">
<div class="widget ">

 <div class="widget-content">
<?php if(count($transactions)>0): ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="font-size:14;text-align:Left"># Transaction ID </th>
            <th style="font-size:14;text-align:Left">Account</th>
            <th style="font-size:14;text-align:Left">Type</th>
            <th style="font-size:14;text-align:Left">Comment</th>
            <th style="font-size:14;text-align:Left"> Done on</th>
           <th style="font-size:14;text-align:Left">Amount</th>
           
        </tr>
    </thead>
    <tbody>
        <?php $giftsum=0; ?>
    <?php foreach ($transactions as $transaction):?>
        <tr>
            <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $transaction->transaction_id;?></td>
            <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $transaction->to_account;?></td>    
            <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $transaction->journal_type;?></td>    
            <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo $transaction->comment;?></td>
            <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo date('Y-m-d',strtotime($transaction->created_at));?></td>  
            <td style="border:1px solid #ccc;font-size:12px; text-align:Left"><?php echo number_format($transaction->amount);$giftsum+=$transaction->amount;?></td>
          
          </tr>
    <?php endforeach;?>
    <td style="border:1px solid #ccc;font-size:12px; text-align:left" colspan="5"><u><strong>Total</u></strong></td>
    <td style="border:1px solid #ccc;font-size:12px; text-align:right"><u><strong><?php echo number_format($giftsum); ?></strong></u></td>
    
     </tr>
    </tbody>
</table>
<?php else: ?>
  <p>There is no account activity so far.</p>
<?php endif; ?>
      </div>
    </div>
  </div>