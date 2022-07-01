<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	
	<h4>Add New Pricelist</h4>

	<br>

	<form action="<?= base_url('pricelist/new_action') ?>" method="POST">
		<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="Pricelist Name" autocomplete="off" autofocus="true">
			<?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<input type="number" name="price" class="form-control" placeholder="Price value" autocomplete="off">
			<?= form_error('price', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<input type="number" name="total_member" class="form-control" placeholder="Total member" autocomplete="off">
			<?= form_error('total_member', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<input type="number" name="session_per_member" class="form-control" placeholder="Session per member" autocomplete="off">
			<?= form_error('session_per_member', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<input type="number" name="validity" class="form-control" placeholder="Valid for how many day(s)" autocomplete="off">
			<?= form_error('validity', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<br>

		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</form>
</div>


</div>
<!-- End of Main Content -->