

<div  class="container">
  <table class="table table-striped" border="1"  style="float:center">

<div class="row" style="float:center">

<table class="table table-bordered" style="float:center;width:60%;border:1px solid #000;padding:40px;">
  <tr>
      <td style="padding:10px;"><center><img src="<?php echo base_url();?>assets/img/ceb_head.PNG"></center></td>
      
  </tr>
</table>
</div>
<div class="row">
<table class="table table-bordered" style="width:30%; border:1px solid #000;padding:1px;float:right;">
  <tr>
  	  <td style="padding:1px;">Nr d'Adherision</td>
  	  <th style="padding:1px;"><?php echo Model\members::get_by_nradherision($this->uri->segment(3))[0]->NrAdhesion;?></th>
  </tr>
   <tr>
  	  <td style="padding:1px;">Noms</td>
  	  <th style="padding:1px;"><?php echo Model\members::get_by_nradherision($this->uri->segment(3))[0]->Noms;?></th>
  </tr>
  <tr>
  	  <td style="padding:1px;">Institution</td>
  	  <th style="padding:1px;"><?php echo Model\members::get_by_nradherision($this->uri->segment(3))[0]->Institution;?></th>
  </tr>
  <tr>
  	  <td style="padding:1px;">Date d'adherision</td>
  	  <th style="padding:1px;"><?php echo Model\members::get_by_nradherision($this->uri->segment(3))[0]->DateAdhesion;?></th>
  </tr>
</table>


<h2 style="float:left"><u>Fiche de cotisation </u></h2>
</div>

<table class="table table-striped" border="1">
<thead>
<tr>
<th>NrAdhesion</th>
<th>Noms</th>
<th>DateAdhesion</th>
<th>Institution</th>
<th >Dated</th>
<th>NatureMvt</th>
<th>TypeOperation</th>
<th>Libelle</th>
<th>Epargne</th>
<th>Retrait</th>
<th>SoldeEpargne</th></tr>
</thead>
<tbody>
<?php foreach($cotisations as $cotisation) :?>
<tr>
<td><?php echo $cotisation->NrAdhesion; ?></td>
<td><?php echo $cotisation->Noms; ?></td>
<td><?php echo date('d-m-Y',strtotime($cotisation->DateAdhesion)); ?></td>
<td><?php echo $cotisation->Institution; ?></td>
<td><?php echo date('d-m-Y',strtotime($cotisation->Dated)); ?></td>
<td><?php echo $cotisation->NatureMvt; ?></td>
<td><?php echo $cotisation->TypeOperation; ?></td>
<td><?php echo $cotisation->Libelle; ?></td>
<td><?php echo $cotisation->Epargne; ?></td>
<td><?php echo $cotisation->Retrait; ?></td>
<td><?php echo $cotisation->SoldeEpargne; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<table class="table table-bordered" border="1">
  <tr>
     <td style="border:1 px solid #000;"><div class="panel-body"><u>Preparé par: DATIVA</u></div></td>
     <td style="border:1 px solid #000;"><div class="panel-body"><u>Gérant CEB : LATER </u></div> </td>
     <td style="border:1 px solid #000;"><div class="panel-body"><u>Beneficiaire :<?php echo Model\members::get_by_nradherision($this->uri->segment(3))[0]->Noms;?></u></div></td>
  </tr>
</table>

</div>