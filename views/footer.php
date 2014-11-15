    
<div class="footer" style="   width: 100%; 
    position: relative;
    margin-bottom:-10px;
    z-index: -1;">
    
    <div class="footer-inner">
        
        <div class="container">
            
            <div class="row">
                
                <div class="span12"><center>
                    &copy; IIS 2014 <a href="#">CEPMS</a>. </center>
                </div> <!-- /span12 -->
                
            </div> <!-- /row -->
            
        </div> <!-- /container -->
        
    </div> <!-- /footer-inner -->
    
</div> <!-- /footer -->


<script src="<?php echo assets_url('js/jquery-1.7.2.min.js'); ?>"></script>
<script src="<?php echo assets_url('js/bootstrap.js'); ?>"></script>
<script src="<?php echo assets_url('js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo assets_url('js/main.js'); ?>"></script>
<script src="<?php echo assets_url('js/angular.min.js'); ?>"></script>

<script src="<?php echo assets_url('js/base.js'); ?>"></script>
<script type="text/javascript">

// add multiple select / deselect functionality
            $("#selectall").click(function ()
            {
                  $('.case').attr('checked', this.checked);
            });
         
            // if all checkbox are selected, check the selectall checkbox
            // and viceversa
            $(".case").click(function(){
         
                if($(".case").length == $(".case:checked").length)
                {
                    $("#selectall").attr("checked", "checked");
                } 
                else
                {
                    $("#selectall").removeAttr("checked");
                }
         
            });
  $('a[data-toggle="modal"]').on('click', function(e){
       e.preventDefault();  // <-- Add this line
        // update modal header with contents of button that invoked the modal
        $('#myModalLabel').html( $(this).html() );
        //fixes a bootstrap bug that prevents a modal from being reused
        $('#utility_body').load(
            $(this).attr('href'),
            function(response, status, xhr) {
                if (status === 'error') {
                    console.log(xhr);
                    $('#utility_body').html('<h2>Oops! unable to completed the action!</h2><p>Sorry, but there was an error:' + xhr.status + ' ' + xhr.statusText+ '</p>');
                }
                return this;
            }
        );
    });
</script>

<!-- Modal -->
<div id="utility" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h1 id="myModalLabel">Click outside modal to close it</h1>
  </div>
  <div class="modal-body" id="utility_body">

  </div>
</div>


  
</body>