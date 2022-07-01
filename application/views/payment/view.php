<div class="container-fluid">
	<h4>Detail Payment</h4>

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
				<div class="col-md-12 col-sm-12 table-responsive" style="background: white; padding: 25px">
					<table class="table">
						<thead>
                            <tr>
                                <th>UID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Session Left</th>
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
                                </tr>

                            <?php   
                                }
                            ?>
                        </tbody>
					</table>
				</div>
			</div>
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

				//redirect('payment');
			}
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Error occured, please try again!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			//redirect('payment');
		}
	?>
	
</div>


</div>
<!-- End of Main Content -->