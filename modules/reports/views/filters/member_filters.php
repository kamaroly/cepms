<form class="form-horizontal" method="POST" ACTION="<?php echo site_url('reports/'.$report_url); ?>" target="_blank">

<legend></legend>

<?php if(strpos($this->uri->uri_string(), 'activestatus')==false && strpos($this->uri->uri_string(), 'paybackplan')==false && strpos($this->uri->uri_string(), 'activeloanhistory')==false): ?>
  <div class="control-group span6">                     
     <label class="control-label">Start date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm">
                          <input class="span2"  name="start_date" value="<?php echo date('Y-m'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div>    
  <div class="control-group span6">                     
     <label class="control-label">End date:</label>
    <div class="controls">
                <div data-provide="datepicker" class="input-append date" data-date-format="yyyy-mm">
                          <input class="span2"  name="end_date" value="<?php echo date('Y-m'); ?>" readonly="" type="text">
                          <span class="add-on"><i class="icon-calendar"></i></span>
                      </div>
                </div>
  </div>

<?php endif; ?>
   <div class="control-group span6">                     
     <label class="control-label">MemberShip Number:</label>
    <div class="controls">
               <input class="span2"  name="membersids" type="text">
  </div>   
<br>
<br>
<br>
            <div class="control-group span6">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
              <button class="btn btn-primary">View</button>
            </div>

</form>