<?= $this->extend('base') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-list"></i>&nbsp;Pegawai
                    <div class="float-right">
                        <button class="btn btn-success btn-sm" onclick="add_record()"><i class="fa fa-plus-circle"></i>&nbsp;Add Record</button>
                        <a style="margin: 2px;" href="<?php echo base_url('pegawai'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i>&nbsp;Refresh</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div id="message"></div>
                    </div>
                    <table class="table table-striped table-bordered" style="font-style: Calibri;font-size:11px">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($result) && is_array($result)) { ?>
                                <?php foreach ($result as $row) { ?>
                                    <tr>
                                        <td>
                                            <a href="#" onclick="view_record(<?php echo $row['pegawai_id']; ?>) "title="View"><span style="font-size: 1em; color: Mediumslateblue;"><i class="fa fa-eye"></i></span></a>
                                            <a href="#" onclick="edit_record(<?php echo $row['pegawai_id']; ?>) "title="Edit"><span style="font-size: 1em; color: Dodgerblue;"><i class="fa fa-edit"></i></span></a>
                                            <a href="#" onclick="delete_record(<?php echo $row['pegawai_id']; ?>) "title="Delete"><span style="font-size: 1em; color: Tomato;"><i class="fa fa-trash"></i></span></a>
                                        </td>
                                        <td><?php echo $row['nip']; ?></td>
                                        <td><?php echo $row['nama_pegawai']; ?></td>
                                        <td><?php echo $row['alamat']; ?></td>
                                        <td><?php echo $row['created_at'] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center">No record found !</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?= $pager->links(); ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Add/ Update Modal-->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajaxModalLabel">Add/ Update Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-pegawai">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="hidden" name="pegawai_id" id="pegawai_id">
                        <input type="text" class="form-control" id="nip" name="nip">
                        <span><i class="text-danger" id="nip-error"></i></span>
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai">
                        <span><i class="text-danger" id="nama_pegawai-error"></i></span>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        <span><i class="text-danger" id="alamat-error"></i></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-circle-left "></i>&nbsp;Close</button>
                <button type="button" class="btn btn-primary" onclick="proses()"><i class="fa fa-plus-circle"></i>&nbsp;Save Record</button>
            </div>
        </div>
    </div>
</div>
<!-- !. Add/ Update Modal-->

<!--View Record Modal-->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajaxModalLabel">View Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" 
                        cellspacing="0" width="100%"
                        style="font-style: Calibri;font-size:14px;
                            border: 1px solid #ccc;" >
                    <tr style="background: #eee;color: #4c4a4a;">
                        <th width="130">NIP</th>
                        <td id="v_nip"></td>
                    </tr>
                    <tr style="background: #fff;color: #4c4a4a;">
                        <th>Nama Pegawai</th>
                        <td id="v_nama_pegawai"></td>
                    </tr>
                    <tr style="background: #eee;color: #4c4a4a;">
                        <th>Alamat</th>
                        <td id="v_alamat"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-circle-left "></i>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>
<!-- !. View Record Modal-->

<!--Delete Record Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajaxModalLabel">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-pegawai">
                    <input type="hidden" name="pegawai_id" id="pegawai_id">
                </form>
                <table class="table table-bordered" 
                        cellspacing="0" width="100%"
                        style="font-style: Calibri;font-size:14px;
                            border: 1px solid #ccc;" >
                    <tr style="background: #eee;color: #4c4a4a;">
                        <th width="130">NIP</th>
                        <td id="d_nip"></td>
                    </tr>
                    <tr style="background: #fff;color: #4c4a4a;">
                        <th>Nama Pegawai</th>
                        <td id="d_nama_pegawai"></td>
                    </tr>
                    <tr style="background: #eee;color: #4c4a4a;">
                        <th>Alamat</th>
                        <td id="d_alamat"></td>
                    </tr>
                </table>
                <h5 align="right">Are you sure want to delete this record?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-circle-left "></i>&nbsp;Close</button>
                <button type="button" class="btn btn-danger" onclick="proses()"><i class="fa fa-trash"></i>&nbsp;Delete Record</button>
            </div>
        </div>
    </div>
</div>
<!-- !. Delete Record Modal-->
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    let url;
    let status = 'add';
    $(document).ready(function() {
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
    })
    
    function clear_error_message() {
        $('#nip-error').html('');
        $('#nama_pegawai-error').html('');
        $('#alamat-error').html('');
    }

    function add_record() {
        status = 'add';
        clear_error_message();
        $('#ajaxModal').modal('show');
        $('#form-pegawai')[0].reset();
    }

    function view_record(pegawai_id) {
        status = 'edit';
        $('#viewModal').modal('show');
        $.ajax({
            url: "<?php echo base_url('pegawai/show'); ?>"+ '/' + pegawai_id,
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                if (res.success == true) {
                    $('#v_nip').html(res.data.nip);
                    $('#v_nama_pegawai').text(res.data.nama_pegawai);
                    $('#v_alamat').html(res.data.alamat);
                }
            }
        });
    }

    function edit_record(pegawai_id) {
        status = 'edit';
        clear_error_message();
        $('#ajaxModal').modal('show');
        $('#pegawai_id').val(pegawai_id);
        $.ajax({
            url: "<?php echo base_url('pegawai/edit'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: $('#form-pegawai').serialize(),
            success: function(res) {
                if (res.success == true) {
                    $('#nip').val(res.data.nip);
                    $('#nama_pegawai').val(res.data.nama_pegawai);
                    $('#alamat').val(res.data.alamat);
                }
            }
        });
    }

    function delete_record(pegawai_id) {
        status = 'delete';
        $('#deleteModal').modal('show');
        $('#pegawai_id').val(pegawai_id);
        $.ajax({
            url: "<?php echo base_url('pegawai/show'); ?>"+ '/' + pegawai_id,
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                if (res.success == true) {
                    $('#d_nip').html(res.data.nip);
                    $('#d_nama_pegawai').text(res.data.nama_pegawai);
                    $('#d_alamat').html(res.data.alamat);
                }
            }
        });
    }

    function proses() {
        if (status == 'add') {
            url = "<?php echo base_url('pegawai/store'); ?>";
        } else if (status == 'edit') {
            url = "<?php echo base_url('pegawai/update'); ?>";
        } else if (status == 'delete') {
            url = "<?php echo base_url('pegawai/destroy'); ?>";
        }
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: $('#form-pegawai').serialize(),
            success: function(res) {
                //console.log(res);
                if(res.errors) {
                    if(res.errors.nip){
                        $('#nip-error').html(res.errors.nip);
                    }
                    if(res.errors.nama_pegawai){
                        $('#nama_pegawai-error').html(res.errors.nama_pegawai);
                    }
                    if(res.errors.alamat){
                        $('#alamat-error').html(res.errors.alamat);
                    }
                }
                if (res.success == true) {
                    $('#message').removeClass('hide'); 
                    $('#message').html('<div class="alert alert-success alert-dismissible">\n\
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\n\
                        <h5><i class="icon fa fa-info-circle"></i> <b>Success!</b> '+ res.message +'</h5></div>'
                    );
                    if (status == 'add') {
                        $('#ajaxModal').modal('hide');
                    } else if (status == 'edit') {
                        $('#ajaxModal').modal('hide');
                    } else if (status == 'delete') {
                        $('#deleteModal').modal('hide');
                    }
                    //window.location.href = "<//?php echo base_url('pegawai'); ?>";
                    location.reload(); 
                }
            }
        });
    }
</script>
<?= $this->endSection() ?>