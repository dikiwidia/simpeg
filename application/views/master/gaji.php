<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Gaji Pokok <small>Master Data</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <i class="fa fa-plus"></i> Baru
                        </button>
						<table id="datatable-responsive" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Gaji</th>
									<th>Deskripsi</th>
									<th>Nominal Gaji (Rp)</th>
									<th>Revisi</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                    $i = 1;
                                    //setlocale(LC_MONETARY,"en_US");
                                    //money_format("The price is %i", $number);
                                    foreach($gaji as $a){
                                        echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".$a['kode_golgaji']."</td>";
                                        echo "<td>".$a['nama_golgaji']."</td>";
                                        echo "<td>".$a['nominal_golgaji']."</td>";
                                        echo "<td>".$a['rev_golgaji']."</td>";
                                        echo '<td><a class="last" href="'.base_url().'master/gaji/edit/'.$a['id_golgaji'].'">Revisi</a></td>';
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
    $('.add').click(function(){
        var UserId = $(this).data('id');
        $(".modal-footer #UserID").val( UserId );
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
    $(".money").each(function (){
        //$(this).maskMoney({formatOnBlur: true, reverse: true, prefix: '$', selectAllOnFocus: true, precision: 2})
               //.maskMoney('mask',Number($(this).val()));
        $(this).autoNumeric('init', {aSep:'.', aDec:',' });
    });
               
    $(".submit").submit(function(){
        var form = $(this);
        $('.money').each(function(i){
            var self = $(this);
            try{
                var v = self.autoNumeric('get');
                self.autoNumeric('destroy');
                self.val(v);
            }catch(err){
                console.log("Not an autonumeric field: " + self.attr("name"));
            }
        });
        return true;
    });
});
</script>
<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('master/gaji/create', 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Tambah Baru</h4>
            </div>
            <div class="modal-body">
                <!-- FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Gaji *</label>
                    <div class="col-md- col-sm-5 col-xs-12">
                        <input type="text" class="form-control a" placeholder="Masukkan Kode Gaji (Tanpa Spasi)" name="kode_golgaji" maxlength="10" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" class="form-control" placeholder="Masukkan Keterangan Gaji" name="nama_golgaji" maxlength="50" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal *</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input class="money form-control" placeholder="Masukkan Nominal Angka" name="nominal_golgaji"  required />
                        </div>
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
<div class="modal fade tambah-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <?php echo form_open('master/user/create', 'class="submit form-horizontal form-label-left input_mask" autocomplete="off"'); ?>

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
                        <input type="text" id="namaPengguna" class="form-control" placeholder="Masukkan Nama Pengguna" name="nama_user" value="" maxlength="10" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><span id="result" class="label label-primary">Wajib diisi</span></label>
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
                <input type="hidden" id="UserID" name="id_biodata" value="" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-success" type="submit" value="Simpan" />
            </div>
            
            <?php echo form_close(); ?>

        </div>
    </div>
</div>