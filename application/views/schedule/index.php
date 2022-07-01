<!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Schedule List</h1>
        <a href="<?= base_url("schedule/new") ?>" class="btn btn-primary">+ Add Schedule</a>
        <br>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="mb-2 text-gray-800">Repeated Schedule</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport</th>
                                <th>Coach</th>
                                <th>Scheduled Start</th>
                                <th>Scheduled Finish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $no = 1;

                                foreach ($schedulerepeat as $row) { ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->sportname ?></td>
                                    <td><?= $row->coachname ?></td>
                                    <td><?= $dayoftheweek[date('w',strtotime($row->scheduled_start))].", ".date("h:i A", strtotime($row->scheduled_start)); ?></td>
                                    <td><?= $dayoftheweek[date('w',strtotime($row->scheduled_finish))].", ".date("h:i A", strtotime($row->scheduled_finish)); ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('schedule/delete_action').'?id='.$row->scheduleid ?>" class="btn btn-danger btn-sm">X</a>
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
                <h5 class="mb-2 text-gray-800">History Schedule</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport</th>
                                <th>Coach</th>
                                <th>Scheduled Start</th>
                                <th>Scheduled Finish</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $no = 1;

                                foreach ($scheduleregular as $row) { ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->sportname ?></td>
                                    <td><?= $row->coachname ?></td>
                                    <td><?= $row->scheduled_start ?></td>
                                    <td><?= $row->scheduled_finish ?></td>
                                    <td>
                                        <strong>
                                            <?php
                                                if($row->started_at == null)
                                                {
                                                    if($row->scheduled_finish<date('Y-m-d H:i:s'))
                                                        echo "<span style='color:red'>Not Started</span>";
                                                    else
                                                        echo "<span style='color:yellow'>Pending</span>";
                                                }
                                                else
                                                    if($row->scheduled_finish>date('Y-m-d H:i:s'))
                                                        echo "<span style='color:blue'>On Going</span>";
                                                    else
                                                        echo "<span style='color:green'>Finished</span>";
                                            ?>
                                        </strong>
                                    </td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('schedule/delete_action').'?id='.$row->scheduleid ?>" class="btn btn-danger btn-sm">X</a>
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
<!-- End of Main Content -->/