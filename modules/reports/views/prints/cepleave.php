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
                             <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
                            <h2 class="page-header">

                                <small class="pull-right">ITALIKI: <?php echo date('d/m/Y') ?></small>
                                <i class="fa fa-globe"></i> ICYEMEZO CYO GUSUBIZWA IMIGABANE.
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-12 col-xs-12">
                       <p>Njyewe <u><?php echo $member->first_name.' '.$member->last_name; ?> </u> wari ufite membership number <u><?php echo ($member->membership_number) ?> </u>
                        nsubijwe amafaranga nari naratanze igihe nari ndi umunyamuryango wa cep angana na <u><?php echo number_format($total_cep_contributions); ?> RWF</u>
                        . CEP ikaba yisubije inguzanyo nari nyisigayemo ingana na <u><?php echo $outstanding; ?></u> , ayo <?php echo ( $balance > 0)?'nakiriye':'ngomba gusubiza CEP'; ?> angana na
                        <u><?php echo number_format($balance)?> RWF</u></p>
                        </div>


                    </div><!-- /.row -->
<div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" style="float:left;margin-right:30px;">
                            
                            <address>
                                <strong><u>Uwari umunyamuryango</u>.</strong><br>
                                <br>
                                Amazina:<strong><?php echo $member->first_name.' '.$member->last_name; ?> </strong>.<br>
                                <br>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong><u> CASH N'UMUKONO BY'UHAGARARIYE CEP</u></strong><br>
                                
                                .........................................<br>
                                .........................................<br>
                                .........................................<br>
                            </address>
                        </div><!-- /.col -->
                    </div>
     </section>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            </div>
                    </div>
          