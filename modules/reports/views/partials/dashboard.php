<div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Today's Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <h6 class="bigstats">Below are some of the important statistics.</h6>
                  <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-user"></i> <span class="value"><?php echo number_format($countmembers); ?></span> <p><small>MEMBERS</small></p> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-money"></i> <span class="value"><?php echo number_format($cep_contributions); ?></span> <p><small>CEP CONTRIBUTION</small></p></div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-flag"></i> <span class="value"><?php echo number_format($social_contributions); ?></span> <p><small>SOCIAL CONTRIBUTION</small></p></div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-ok-sign"></i> <span class="value"><?php echo round($memberwithloan_percentage); ?>%</span>  <p><small>MEMBERS WITH LOANS</small></p></div>
                    <!-- .stat --> 
                  </div>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>