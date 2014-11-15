  <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>">
<h2><u><?php echo $this->uri->segment(3); ?> member report from <?php echo $this->input->post('start_date') ;?> to <?php echo $this->input->post('end_date') ;?></u></h2>

<div class="main-inner">
    <div class="container">
      
<div class="widget ">

 <div class="widget-content">

<?php if(count($members)>0): ?>
 
<table class="table table-striped" style="border:1px solid #ccc;">
    <thead>
        <tr>
          
           <th  style="font-size:14;text-align:Left">Membership #</th>
           <th  style="font-size:14;text-align:Left">Rank</th>
           <th  style="font-size:14;text-align:Left">First name</th>
           <th  style="font-size:14;text-align:Left">Last name</th>
           <th  style="font-size:14;text-align:Left">Start Date</th>
           <th  style="font-size:14;text-align:Left">Level</th>
           <th  style="font-size:14;text-align:Left">Status</th>
             <th></th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($members as $member):?>
    <tr>

<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo $member->membership_number;?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo $member->rank;?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo $member->first_name;?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo $member->last_name;?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo date('Y-m-d',strtotime($member->start_date));?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo $member->level;?> </td>
<td style="border:1px solid #ccc;font-size:12px; text-align:Left"> <?php echo $member->status;?> </td>

  <td>

          </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
	No member available.
<?php endif; ?>

      </div>
    </div>
  </div>
