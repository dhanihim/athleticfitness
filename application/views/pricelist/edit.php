<?php
	if(count($pricelist)>0)
	{
		foreach ($pricelist as $row)
		{
			$id = $row->id;
	        $name = $row->name;
	        $price = $row->price;
	        $total_member = $row->total_member;
	        $session_per_member = $row->session_per_member;
	        $validity = $row->validity;
		}
	}
	else
		redirect('pricelist','refresh');
?>


	<div class="container-fluid">

		<h4>Edit Pricelist</h4>

		<br>

		<form action="<?= base_url('pricelist/edit_action') ?>" method="POST">
			<div class="form-group">
				<input type="hidden" name="id" value="<?= $id ?>">
			</div>
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="Pricelist Name" autocomplete="off" autofocus="true" value="<?= $name ?>">
				<?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input type="number" name="price" class="form-control" placeholder="Price value" autocomplete="off" value="<?= $price ?>">
				<?= form_error('price', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input type="number" name="total_member" class="form-control" placeholder="Total member" autocomplete="off" value="<?= $total_member ?>">
				<?= form_error('total_member', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input type="number" name="session_per_member" class="form-control" placeholder="Session per member" autocomplete="off" value="<?= $session_per_member ?>">
				<?= form_error('session_per_member', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input type="number" name="validity" class="form-control" placeholder="Valid for how many day(s)" autocomplete="off" value="<?= $validity ?>">
				<?= form_error('validity', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<br>

			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</form>
	</div>

</div>
<!-- End of Main Content -->