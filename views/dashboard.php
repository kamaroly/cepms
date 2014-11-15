 <div class="container">

   <!--Notification area -->
   
        <div class="span6">
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

      
        </div>

            <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
             <div class="shortcuts">
  
  <a href="<?php echo site_url('members/batchcotisation');?>" class="shortcut">
    <i class="shortcut-icon icon-download-alt">
    </i>
    <span class="shortcut-label">
      Level Cotisation.
    </span>
    
  </a>
  <a href="<?php echo site_url('members/save');?>" class="shortcut">
    <i class="shortcut-icon icon-plus-sign">
    </i>
    <span class="shortcut-label">
      Add Member
    </span>
    
  </a>
  <a href="<?php echo site_url('members');?>" class="shortcut">
    <i class="shortcut-icon icon-signal">
    </i>
    
    <span class="shortcut-label">
      Search members
    </span>
    
  </a>
  <a href="<?php echo site_url('settings');?>" class="shortcut">
    
    <i class="shortcut-icon icon-cog">
    </i>
    <span class="shortcut-label">
     Configurations
    </span>
    
  </a>
  <a href="<?php echo site_url('users/create_user');?>" class="shortcut">
    <i class="shortcut-icon icon-user">
    </i>
    <span class="shortcut-label">
      Add new user
    </span>
    
  </a>
  <a href="<?php echo site_url('journals/save');?>" class="shortcut">
    <i class="shortcut-icon icon-file">
    </i>
    <span class="shortcut-label">
     Add Journal
    </span>
    
  </a>
  <a href="<?php echo site_url('transactions/save');?>" class="shortcut">
    <i class="shortcut-icon  icon-refresh">
    </i>
    
    <span class="shortcut-label">
      Add transaction
    </span>
    
  </a>
  <a href="<?php echo site_url('accounts/save');?>" class="shortcut">
    
    <i class="shortcut-icon icon-tag">
    </i>
    <span class="shortcut-label">
      Add account
    </span>
    
  </a>
  
</div>
  <!-- /shortcuts --> 
            </div>
           
          </div>

         
            <!-- /widget-content --> 
          </div>
        </div>

