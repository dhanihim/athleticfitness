<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	
	<h4>Add New Member</h4>

	<br>

	<form action="<?= base_url('member/new_action') ?>" method="POST">
		<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="Member Full Name" autocomplete="off" autofocus="true">
			<?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off">
			<?= form_error('address', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<input type="text" name="phone" class="form-control" placeholder="Phone Number (ex: 08xxx)" autocomplete="off">
			<?= form_error('phone', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		
		<br>

		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</form>
</div>


</div>
<!-- End of Main Content -->