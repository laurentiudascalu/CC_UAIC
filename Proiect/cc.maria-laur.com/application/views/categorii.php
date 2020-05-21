<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php $this->load->view('sus'); ?>
	<h2 class="mb-4">Categorii <a href="<?php echo site_url('categorie/0'); ?>" class="link-new btn btn-success">+ Adauga categorie noua</a></h2>
    <table class="table table-bordered table-hover tabel-min" id="boxuriTable">
        <thead class="thead-dark">
          <tr>
          	<th>ID</th>
            <th>Tip</th>
            <th>Tip key</th>
            <th>Categorie</th>
            <th>Optiuni</th>
          </tr>
        </thead>
    	<tbody>
		    <?php if(isset($categorii) && $categorii->num_rows()>0){ $i=0; foreach ($categorii->result_array() as $row) { $i++;  ?>
		        <tr id="linieBoxuri<?php echo $i; ?>">
		        	<td class="tc tdnr"><?php echo $row['id']; ?></td>
		            <td class="jedit" data="<?php echo enc('categorii',$row['id'],'tip'); ?>"><?php echo $row['tip']; ?></td>
		            <td class="jedit" data="<?php echo enc('categorii',$row['id'],'tip_key'); ?>"><?php echo $row['tip_key']; ?></td>
		            <td class="jedit" data="<?php echo enc('categorii',$row['id'],'categorie'); ?>"><?php echo $row['categorie']; ?></td>
		            <td class="tc tdopt"> <a href="<?php echo site_url('categorie/'.$row['id']); ?>" class=""><i class="far fa-edit"></i></a> / <span class="cp" onclick="del('categorii','<?php echo $row['id']; ?>','id','#linieBoxuri<?php echo $i; ?>');"><i class="far fa-trash-alt text-danger"></i></span></td>
		        </tr>
		    <?php } } ?>
    	</tbody>
	</table> 
<script>
  $(document).ready( function () {
    $('#boxuriTable').DataTable({
      responsive: true,
      fixedHeader: true
    });
  } );
</script> 
<?php $this->load->view('footer'); ?>