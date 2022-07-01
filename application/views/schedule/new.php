<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	
	<h4>Add New Schedule</h4>

	<br>

	<form action="<?= base_url('schedule/new_action') ?>" method="POST">
		<div class="form-group">
			<label>Sport</label>
			<select class="form-control" name='sport_id'>
			<?php 
				foreach($sport as $row)
				{ 
			?>
					<option value="<?= $row->id; ?>">
						<?=  $row->name; ?>   
					</option>
			<?php 
				} 
			?>
			</select> 
		</div>
		<div class="form-group">
			<label>Coach</label>
			<select class="form-control" name='coach_id'>
			<?php 
				foreach($coach as $row)
				{ 
			?>
					<option value="<?= $row->id; ?>">
						<?=  $row->name; ?>   
					</option>
			<?php 
				} 
			?>
			</select> 
		</div>
		<div class="form-group">
			<label>Type</label>
			<select class="form-control" name='type'>
				<option value="0">Reguler</option>
				<option value="1">Repeat Every Week</option>
			</select> 
		</div>
		<div class="form-group">
			<label>Scheduled Start</label>
			<input type="datetime-local" name="scheduled_start" class="form-control" required="true">
			<?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<div class="form-group">
			<label>Scheduled Finish</label>
			<input type="datetime-local" name="scheduled_finish" class="form-control" required="true">
			<?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
		</div>
		<br>

		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</form>
</div>


</div>
<!-- End of Main Content -->