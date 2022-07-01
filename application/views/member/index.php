<!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Member List</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="<?= base_url("member/new") ?>" class="btn btn-primary">+ Add Member</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Session Left</th>
                                <th>Member Since</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $no = 1;

                                foreach ($member as $m) { ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $m->name ?></td>
                                    <td><?= $m->address ?></td>
                                    <td><?= $m->phone ?></td>
                                    <td><?= $m->session_left ?></td>
                                    <td><?= $m->created_at ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('member/edit').'?id='.$m->id ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('member/delete_action').'?id='.$m->id ?>" class="btn btn-danger btn-sm">X</a>
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