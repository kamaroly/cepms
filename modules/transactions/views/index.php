
<div class="main-inner">
    <div class="container">

   <!--Notification area -->
      
<div class="widget ">
              
              <div class="widget-header">
                <a href="<?php echo site_url('transactions');?>" class="active">
                  <i class="icon-th-list"></i>
                  <h3>Transactions list </h3>
                </a>
                <a href="<?php echo site_url('transactions/save');?>" class="btn btn-success">
                   <i class="icon-plus-sign"></i>
                   <h3>New transaction </h3>
                </a>
            </div> <!-- /widget-header -->
          
   <div class="widget-content">


<!-- Modal -->
<?php if(count($transactions)>0): ?>
<?php echo $links ;?>
<table class="table table-striped">
    <thead>
        <tr>
            <th># Transaction ID </th>
            <th>From account</th>
            <th>To account</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Comment</th>
            <th>Done on</th>
            <th>Done by</th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($transactions as $transaction):?>
        <tr>
            <td><?php echo $transaction->transaction_id;?></td>
            <td><?php echo $transaction->from_account;?></td>   
            <td><?php echo $transaction->to_account;?></td>    
            <td><?php echo $transaction->journal_type;?></td>    
            <td><?php echo $transaction->amount;?></td>
            <td><?php echo $transaction->comment;?></td>
            <td><?php echo $transaction->created_at;?></td>  
            <td><?php echo $transaction->created_by;?></td>    
            <td>
          
          </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
  <p>There is no transaction in the database so far.</p>
<?php endif; ?>
<?php echo $links ;?>

      </div>
    </div>
  </div>