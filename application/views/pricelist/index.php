<!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pricelist</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="<?= base_url("pricelist/new") ?>" class="btn btn-primary">+ Add Pricelist</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Total Member</th>
                                <th>Session per Member</th>
                                <th>Validity</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $no = 1;

                                foreach ($pricelist as $row) { ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->price ?></td>
                                    <td><?= $row->total_member ?></td>
                                    <td><?= $row->session_per_member ?></td>
                                    <td><?= $row->validity ?> day(s)</td>
                                    <td><?= $row->created_at ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('pricelist/edit').'?id='.$row->id ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('pricelist/delete_action').'?id='.$row->id ?>" class="btn btn-danger btn-sm">X</a>
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