<form class="form-horizontal" method="POST" ACTION="<?php echo site_url('reports/'.$report_url); ?>" target="_blank">

<legend></legend>


  <div class="control-group span6">                     
     <label class="control-label">Start date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2"  name="start_date" value="<?php echo date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div>    
  <div class="control-group span6">                     
     <label class="control-label">End date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm-dd">
                          <input class="span2"  name="end_date" value="<?php echo date('Y-m-d'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div> 
<br>
<br>
<br>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
              <button class="btn btn-primary">View</button>
            </div>

</form>