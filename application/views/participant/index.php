<!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Today's Schedule</h1>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h5 mb-2 text-gray-800">Active Schedule</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport</th>
                                <th>Schedule Start</th>
                                <th>Schedule Finish</th>
                                <th>Actual Start</th>
                                <th>Participant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $no = 1;

                                foreach ($scheduleregular as $row) { 
                            ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->sportname ?></td>
                                    <td><?= date("h:i A", strtotime($row->scheduled_start)) ?></td>
                                    <td><?= date("h:i A", strtotime($row->scheduled_finish)) ?></td>
                                    <?php 
                                        if($row->started_at == NULL) 
                                        {
                                    ?>
                                            <td>-</td>
                                    <?php 
                                        }
                                        else
                                        {
                                     ?>
                                            <td><?= date("h:i A", strtotime($row->started_at)) ?></td>
                                    <?php        
                                        }
                                    ?>
                                    <td><?= $row->total_participant ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('participant/register').'?id='.$row->scheduleid ?>" class="btn btn-success btn-sm">Register Member</a>
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
                <h1 class="h5 mb-2 text-gray-800">Repeat Schedule</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sport</th>
                                <th>Schedule Start</th>
                                <th>Schedule Finish</th>
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
                                    <td><?= $dayoftheweek[date('w',strtotime($row->scheduled_start))].", ".date("h:i A", strtotime($row->scheduled_start)); ?></td>
                                    <td><?= $dayoftheweek[date('w',strtotime($row->scheduled_finish))].", ".date("h:i A", strtotime($row->scheduled_finish)); ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('participant/generate_shedule').'?id='.$row->scheduleid ?>" class="btn btn-primary btn-sm">Create Schedule</a>
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