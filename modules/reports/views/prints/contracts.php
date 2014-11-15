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
                                <i class="fa fa-globe"></i> AMASEZERANO Y' INGUZANYO.
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-12 col-xs-12">
                        <p><strong>Hagati  ya:</strong></p>
                        <p><strong>CEP</strong>: ni  umuryango w' ubufatanye ku  bakozi  bakorera mu bitaro bikuru bya GISIRIKARE mu Rwanda (Caise d' Entraide du Personnel)
Hagati ya (Mme)(Mlle) Mr <strong><?php echo $first_name.' '.$last_name; ?></strong>.
Umunyamuryango  wa  CEP ufite Numero: <strong><?php echo $membership_number; ?></strong> , utuye mu karere ka Kicukro 
Intara Kigali agiranye amasezerano n'inama ishinzwe inguzanyo ,bigashyirwaho umukono na Perezida wayo ibi bikurikira:</p>
                       
                       <p><strong>INGINGO YA 1.</strong></p>
                       <p>Mme,Mlle,Mr <strong><?php echo $first_name.' '.$last_name; ?></strong>.Umunyamuryango wa CEP ahawe inguzanyo ingana <strong><?php echo number_format(intval($approved_amount)); ?></strong> y'Amafaranga y'Rwanda ,Cheque No <strong><?php echo $cheque_number; ?></strong>
Izishyurywa mubyiciro <strong><?php echo $installment; ?></strong> amafaranga azishyurwa buri kwezi <strong><?php echo number_format(intval($monthly_payment_fees)); ?></strong>, inyungu  ya buri kwezi ingana <strong><?php echo intval($interest); ?></strong>. 
  </p>
 

  <p><strong>INGINGO YA 2.</strong></p>
  <p> Ukaba uzatangira kwishyura mu kwezi kwa <strong><?php echo date("M-Y", strtotime("+1 months")); ?></strong> Kugeza mu kwezi kwa  <strong><?php echo date("M-Y", strtotime("+".$installment." months")); ?></strong>  igihe  cyose  kingana n'amezi  <strong><?php echo $installment; ?></strong>.</p>
                       
   <p><strong>INGINGO YA 3.</strong></p>
   <P>CEP  ihaye nyirugurizwa,ikurikije amategeko ngenga yayo ,ayimicungire y'inguzanyo , n'amabwiriza y'igenamwenda ndetse n'aya masezerano ,inguzanyo izakatwa kuri top-up  ,Umushahara nahandi hose impande zose  zumvikanye(Prime de responsabilite ),Gardes,Transport  n'ibindi)</P>
    
<p><strong>INGINGO YA 4.</strong></p>
<p>Nyiri Kugurizwa  ,ahaye uburenganzira umukoresha we (RMH,RDF) gukata top_up,umushahara ,prime cyangwa n'ahandi hose  hashoboka  kugirango yishyure umwenda  abereyemo CEP
</p>
<p><strong>INGINGO YA 5.</strong></p>
<p>Nyiri  kugurizwa  yemeye ko aramutse  adatanze  amafaranga igihe cyo kwishyura kigeze,CEP  yakurikirana ubwishyu ku yindi mitungo ye aho  yaba iri hose kugirango umutungo  wayo ugaruzwe hiyongereho inyungu iteganyijwe ndetse nubukererwe.
</p>
<p><strong>INGINGO YA 6.</strong></p>
<p>Nyiri kugurizwa iyo yitabye Imana afitiye umwenda CEP ,uwo bashakanye byemewe namategeko yishyura uwo  mwenda .iyo akiri ingaragu,umwenda we  wishyurwa n'uwo  yaraze.
</p>
<p><strong>INGINGO YA 7.</strong></p>
<p>Ikibazo  cyose  cyavuka gikemurwa n'ubuyobozi bw'ibitaro,bitashoboa  bakitabaza inzego za RDF cyangwa izindi nzego zi gihugu  zibifitiye ububasha.
</p>
<br>
<p><strong>INGINGO YA 8.</strong></p>
<p>Iyo igihe cyo kwishyura kirangiye nyiri ukugurizwa atararangiza kwishyura inguzanyo ,inyungu ibarwa ku !% yinyingera ku kwezi uhereye kumunsi wa mbere wu bukererwe kandi  zibarirwa ku mwenda wose asigaranye.
</p>

<p><strong>INGINGO YA 9.</strong></p>
<p>Nyiri kugurizwa yemera ko amafaranga yibikira ku bushake byishingira umwenda asabye ,kandi mu kwishyura ,CEP itambutswa ku bandi nyirukugurizwa abereyemo umwenda.
</p>
<p><strong>INGINGO YA 10.</strong></p>
<p>Aya masezerano agomba gutungwa n'impande  zombie zigiranye amasezerano
</p>
                        </div>


                    </div><!-- /.row -->
<div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" style="float:left;margin-right:30px;">
                            
                            <address>
                                <strong><u>Uhawe Inguzanyo</u>.</strong><br>
                                <br>
                                Amazina:<strong><?php echo $first_name.' '.$last_name; ?></strong>.<br>
                                <br>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong><u> Komite Itanga inguzanyo</u></strong><br>
                                
                                .........................................<br>
                                .........................................<br>
                                .........................................<br>
                            </address>
                        </div><!-- /.col -->
                    </div>

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            </div>
                    </div>
                </section>