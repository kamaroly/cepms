<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/pages/printing.css') ?>">
    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            </div>
                    </div>
<section class="content invoice">                    
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">

                                <small class="pull-right">Date: <?php echo date('d/m/Y') ?></small> 
                        
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-12 col-xs-12">
                        <?php echo $body; ?>
                        </div>
<br>
 <strong>Generated by :</strong><?php echo $this->config->item('user_last_name').' '.$this->config->item('user_first_name'); ?>  
                         
                    </div><!-- /.row -->
                      

                    <!-- this row will not appear when printing -->
               
                </section>
         <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                         </div>
                    </div>