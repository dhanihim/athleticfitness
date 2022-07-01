<!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <?php

            foreach ($schedule as $row) {
                $sportname = $row->sportname;
                $coachname = $row->coachname;
                $scheduled_start = $row->scheduled_start;
                $scheduled_finish = $row->scheduled_finish;
            } 

        ?>
        <!-- Page Heading -->

        <h1 class="h4 mb-2 text-gray-800"><?= $sportname." - Coach '".$coachname."'"; ?></h1>
        <h1 class="h6 mb-2 text-gray-800"><?= $scheduled_start." - ".$scheduled_finish; ?></h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                  + Add Participant
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UID</th>
                                <th>Name</th>
                                <th>Session Left</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $no = 1;

                                foreach ($participant as $row) { 
                            ?>
                                    
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->uid ?></td>
                                    <td><?= $row->membername ?></td>
                                    <td><?= $row->session_left ?></td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <a href="<?= base_url('participant/delete_action').'?member='.$row->memberid."&schedule=".$_GET['id'] ?>" class="btn btn-danger btn-sm">X</a>
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

        <a href="<?= base_url('participant/start_schedule?id='.$_GET['id']) ?>" class="btn btn-success btn-block">Start Class</a>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Participant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('participant/new_action') ?>" method="POST">
            
            <input type="hidden" name="schedule_id" value="<?= $_GET['id'] ?>">

            <div class="form-group">
                <select class="form-control" name='member_id'>
                <?php 
                    foreach($available as $row)
                    { 
                ?>
                        <option value="<?= $row->id; ?>" 
                            <?php 
                                if($row->session_left<=0)
                                    echo "style='color:red'";
                            ?>
                        >
                            <?=  $row->uid." - ".$row->name." - ".$row->session_left." session(s)"; ?>   
                        </option>
                <?php 
                    } 
                ?>
                </select> 
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>