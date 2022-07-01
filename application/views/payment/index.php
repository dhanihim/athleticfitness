<!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Payment List</h1>

        <a href="<?= base_url("payment/new") ?>" class="btn btn-primary">+ Add Payment</a>
        <br>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5>Not Yet Deposited (<?= count($paymentpending); ?>)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UID</th>
                                <th>Coach Name</th>
                                <th>Pricelist Name</th>
                                <th>Total</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $no = 1;

                                foreach ($paymentpending as $row) { ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->uid ?></td>
                                    <td><?= $row->coachname ?></td>
                                    <td><?= $row->pricelistname ?></td>
                                    <td><?= number_format($row->total, 0, '.', '.'); ?></td>
                                    <td><?= $row->paymentcreatedat ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('payment/accept_action').'?id='.$row->paymentid.'&n='.$row->session ?>" class="btn btn-success btn-sm">Accept</a>
                                        <a href="<?= base_url('payment/view').'?referal='.$row->uid ?>" class="btn btn-info btn-sm" target="_blank">View</a>
                                        <a href="<?= base_url('payment/delete_action').'?id='.$row->paymentid ?>" class="btn btn-danger btn-sm">X</a>
                                    </td>
                                </tr>

                            <?php   
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5>Deposited Payment (<?= count($paymentdone); ?>)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UID</th>
                                <th>Coach Name</th>
                                <th>Pricelist Name</th>
                                <th>Total</th>
                                <th>Created At</th>
                                <th>Deposited At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $no = 1;

                                foreach ($paymentdone as $row) { ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->uid ?></td>
                                    <td><?= $row->coachname ?></td>
                                    <td><?= $row->pricelistname ?></td>
                                    <td><?= number_format($row->total, 0, '.', '.'); ?></td>
                                    <td><?= $row->created_at ?></td>
                                    <td><?= $row->deposited_at ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('payment/view').'?referal='.$row->uid ?>" class="btn btn-info btn-sm" target="_blank">View</a>
                                        <a href="<?= base_url('payment/delete_action').'?id='.$row->id ?>" class="btn btn-danger btn-sm">X</a>
                                    </td>
                                </tr>

                            <?php   
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->