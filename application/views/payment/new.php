<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	
	<h4>Add New Payment</h4>

	<br>

	<?php
		if(isset($_GET['referal']))
		{
			$r = $_GET['referal'];

			if(count($referal) > 0)
			{
				foreach ($referal as $row) {
					$coachname = $row->coachname;
					$pricetext = $row->pricelistname." - ".$row->price;
					$pricetotal = $row->price;
					$total_member = $row->total_member;
					$payment_id = $row->paymentid;
				}

				$spot = $total_member - count($memberlist);
	?>
			<div class="form-group">
				<label>Coach</label>
				<input type="text" name="name" class="form-control" value="<?= $coachname; ?>" readonly="true" >
			</div>

			<div class="form-group">
				<label>Pricelist</label>
				<input type="text" name="pricelist" class="form-control" value="<?= $pricetext; ?>" readonly="true" >
			</div>

			<br>
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<form action="<?= base_url('payment/add_memberpayment') ?>" method="POST">
						<div class="form-group">
							<input type="hidden" name="payment_id" value="<?= $payment_id; ?>">
						</div>
						<div class="form-group">
							<input type="hidden" name="referal" value="<?= $r; ?>">
						</div>
						<div class="form-group">
							<label>Choose <?= $spot; ?> Member</label>
							<select class="form-control" name='member_id' 
							<?php
								if($spot==0)
									echo "disabled='true'";
							?>>
							<?php 
								foreach($member as $row)
								{ 
							?>
									<option value="<?= $row->id; ?>">
										<?=  $row->uid." - ".$row->name." - ".$row->address; ?>   
									</option>
							<?php 
								} 
							?>
							</select> 
						</div>

						<?php
							if($spot!=0)
							{
						?>
							<button type="submit" class="btn btn-primary">Add Member</button>
						<?php	
							}
						?>
					</form>
					<br>
				</div>
				<div class="col-md-8 col-sm-12 table-responsive" style="background: white; padding: 25px">
					<table class="table">
						<thead>
                            <tr>
                                <th>UID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Session Left</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php

                                $no = 1;

                                foreach ($memberlist as $m) { ?>
                                    
                                <tr>
                                    <td><?= $m->uid ?></td>
                                    <td><?= $m->name ?></td>
                                    <td><?= $m->address ?></td>
                                    <td><?= $m->session_left ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('payment/delete_member_payment').'?id='.$m->memberpaymentid.'&r='.$r ?>" class="btn btn-danger btn-sm">X</a>
                                    </td>
                                </tr>

                            <?php   
                                }
                            ?>
                        </tbody>
					</table>
				</div>
			</div>

			<br>
			<form action="<?= base_url('payment/final_submit') ?>" method="POST">
				<input type="hidden" name="payment_id" value="<?= $payment_id; ?>">
				<input type="hidden" name="total" value="<?= $pricetotal; ?>">
				<button type="submit" class="btn btn-success btn-block">Submit Final Payment</button>
			</form>
	<?php		
			}
			else
			{	
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Error occured, please try again!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

				redirect('payment');
			}
	?>		
		
	<?php		
		}
		else
		{
	?>
			<form action="<?= base_url('payment/draft') ?>" method="POST">
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
					<label>Pricelist</label>
					<select class="form-control" name='pricelist_id'>
					<?php 
						foreach($pricelist as $row)
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
				
				<br>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
	<?php		
		}
	?>
	
</div>


</div>
<!-- End of Main Content -->