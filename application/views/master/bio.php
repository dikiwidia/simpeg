<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Biodata <small>Master Data</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <i class="fa fa-user-plus"></i> Tambah
                        </button>
						<table id="datatable-responsive" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Lengkap</th>
									<th>Lahir</th>
									<th>Email</th>
									<th>Kontak</th>
									<th>Nama User</th>
									<th>Terakhir Masuk</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                    $i = 1;
                                    foreach($biodata as $b){
                                        if($b['id_user'] == 0){
                                            $html = '<a class="link" data-toggle="modal" data-target=".tambah-user">* tambah</a>';
                                        } else {
                                            $html = read_custom_id('speg_user',$b['id_user'],'nama_user');
                                        }
                                        echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".$b['nama_biodata']."</td>";
                                        echo "<td>".$b['tmplahir_biodata']."</td>";
                                        echo "<td>".ifempty($b['surel_biodata'],'-')."</td>";
                                        echo "<td>".ifempty($b['kontak_biodata'],'-')."</td>";
                                        echo "<td>".$html."</td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    }
                                ?>
							</tbody>
						</table>
					</div>
                </div>
            </div>
		</div>
    </div>
</div>
<!-- /page content -->
<script>
$(function () {
	var t = $('#datatable-responsive').DataTable({
		"paging": true,
		"pageLength": 10,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>
<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <?php echo form_open('master/bio/create', 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Tambah Baru</h4>
            </div>
            <div class="modal-body">
                <!-- FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap *</label>
                    <div class="col-md- col-sm-5 col-xs-12">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap (Tanpa Gelar Akademik)" name="nama_biodata" maxlength="50" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir" name="tmplahir_biodata" maxlength="50" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" class="form-control" data-inputmask="'mask': '9999-99-99'" placeholder="e.g. 1995-10-26" name="tglahir_biodata" required/>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control" name="jkelamin_biodata" required/>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control" name="id_agama" required/>
                            <?php 
                                foreach ($agama as $agama){
                                    echo '<option value="'.$agama["id_agama"].'">'.$agama['nama_agama'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Surat Elektronik (email)</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="email" class="form-control" placeholder="e.g. info@example.com" name="surel_biodata" maxlength="100">
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Ponsel</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" class="form-control" placeholder="e.g. 085311555xxx" name="kontak_biodata" maxlength="15">
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                </div>				
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <textarea class="form-control noresize" name="alamat_biodata" rows="3" placeholder="e.g. Jl. Soekarno Hatta No. 1, Rangkasbitung, Banten"></textarea>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                </div>
                <!-- /FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </div>
            
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
<div class="modal fade tambah-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <?php echo form_open('master/user/create', 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buat User</h4>
            </div>
            <div class="modal-body">
                <!-- FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pengguna *</label>
                    <div class="col-md- col-sm-5 col-xs-12">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Pengguna" name="nama_user" maxlength="10" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kata Sandi *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="password" class="form-control" placeholder="Masukkan Kata Sandi" name="sandi_user" maxlength="50" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Hak Akses Pengguna *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control" name="level_user" required/>
                            <option value="1">Pengguna Biasa</option>
                            <option value="2">Operator</option>
                        </select>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <!-- /FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </div>
            
            <?php echo form_close(); ?>

        </div>
    </div>
</div>