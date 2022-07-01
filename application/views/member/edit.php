<?php
	if(count($member)>0)
	{
		foreach ($member as $row)
		{
			$id = $row->id;
	        $name = $row->name;
	        $address = $row->address;
	        $phone = $row->phone;
		}
	}
	else
		redirect('member','refresh');
?>


	<div class="container-fluid">

		<h4>Edit Member</h4>

		<br>

		<form action="<?= base_url('member/edit_action') ?>" method="POST">
			<div class="form-group">
				<input type="hidden" name="id" value="<?= $id ?>">
			</div>
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="member Full Name" autocomplete="off" value="<?= $name ?>">
				<?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off" value="<?= $address ?>">
				<?= form_error('address', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input type="text" name="phone" class="form-control" placeholder="Phone Number (ex: 08xxx)" autocomplete="off" value="<?= $phone ?>">
				<?= form_error('phone', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<br>

			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</form>
	</div>

</div>
<!-- End of Main Content -->