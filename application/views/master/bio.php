<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Biodata<small>Master Data</small></h2>
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

                                        $c = read_custom_cond_bool('speg_user',array('id_biodata'=>$b['id_biodata']));

                                        if($c == FALSE){
                                            $html = '<a class="link adduser" data-toggle="modal" data-target=".tambah-user" data-id="'.$b['id_biodata'].'">* tambah</a>';
                                            $html_2 = '<label class="label label-primary">belum dibuat</label>';
                                        } else {
                                            $html = read_custom_cond('speg_user',array('id_biodata'=>$b['id_biodata']),'nama_user');

                                            $k = ifemptydatetime(read_custom_cond('speg_user',array('id_biodata'=>$b['id_biodata']),'tmasuk_user'),'x');
                                            
                                            if($k == "x"){
                                                $html_2 = '<label class="label label-success">pengguna baru</label>';
                                            } else {
                                                $html_2 = datetime_id(read_custom_cond('speg_user',array('id_biodata'=>$b['id_biodata']),'tmasuk_user'));
                                            }                                            
                                        }

                                        echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".$b['nama_biodata']."</td>";
                                        echo "<td>".$b['tmplahir_biodata'].", ".date_id($b['tglahir_biodata'])."</td>";
                                        echo "<td>".ifempty($b['surel_biodata'],'-')."</td>";
                                        echo "<td>".ifempty($b['kontak_biodata'],'-')."</td>";
                                        echo "<td>".$html."</td>";
                                        echo "<td>".$html_2."</td>";
                                        echo '<td><a class="last" href="'.base_url().'master/bio/edit/'.$b['id_biodata'].'">Ubah</a> <a class="last" href="'.base_url().'master/bio/delete/'.$b['id_biodata'].'">Hapus</a></td>';
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
$(document).ready(function(){
    $('.adduser').click(function(){
        var UserId = $(this).data('id');
        $(".modal-footer #UserID").val( UserId );
    });
    $('.date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
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

    $('#namaPengguna').keyup(function() {
        var contain = $(this).val();
        if(contain == ''){
            $('#result').text('Wajib diisi');
        } else {
            $.ajax({
            url      : "<?php echo base_url().'ajax/checking_username'; ?>",
            type     : "post",
            dataType : "json",
            data     : {"nama_user" : contain},
            success: function(data) {
                //$('#result').text(data);
                if(data == 1){
                    $('#result').text('Username telah digunakan').removeClass('label-primary').addClass('label-danger');
                }else{
                    $('#result').text('Username tersedia').removeClass('label-danger').addClass('label-primary');
                }
            }
            });
        }
    });
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
                        <input type="text" class="form-control a" placeholder="Masukkan Nama Lengkap (Non Gelar Akademik)" name="nama_biodata" maxlength="50" required />
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir" name="tmplahir_biodata" maxlength="50" required />
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" class="form-control date" placeholder="e.g. 1995-10-26" name="tglahir_biodata" required />
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control" name="jkelamin_biodata" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control" name="id_agama" required>
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
                        <textarea class="form-control noresize" name="alamat_biodata" rows="3" placeholder="e.g. Jl. Soekarno Hatta No. 1, Rangkasbitung, Banten" maxlength="500"></textarea>
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
                        <input type="text" id="namaPengguna" class="form-control" placeholder="Masukkan Nama Pengguna" name="nama_user" value="" maxlength="10" required />
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><span id="result" class="label label-primary">Wajib diisi</span></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kata Sandi *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="password" class="form-control" placeholder="Masukkan Kata Sandi" name="sandi_user" maxlength="50" required />
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Hak Akses Pengguna *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control" name="level_user" required>
                            <option value="1">Pengguna Biasa</option>
                            <option value="2">Operator</option>
                        </select>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <!-- /FORM -->
            </div>
            <div class="modal-footer">
                <input type="hidden" id="UserID" name="id_biodata" value="" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-success" type="submit" value="Simpan" />
            </div>
            
            <?php echo form_close(); ?>

        </div>
    </div>
</div>