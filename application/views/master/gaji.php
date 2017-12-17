<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Gaji Golongan<small>Master Data</small></h2>
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
                                        echo "<td class='money dt-right'>".$a['nominal_golgaji']."</td>";
                                        echo "<td>".$a['rev_golgaji']."</td>";
                                        echo '<td><a class="last edit" href="'.base_url().'master/gaji/edit/'.$a['id_golgaji'].'">Revisi</a></td>';
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
            "targets": 0,
        } ],
        "order": [[ 1, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#checking').keyup(function() {
        var contain = $(this).val();
        var field   = "kode_golgaji";
        var table   = "speg_data_golgaji";

        if(contain == ''){
            $('#result').text('Wajib diisi').removeClass('label-danger').addClass('label-primary');;
        } else {
            $.ajax({
            url      : "<?php echo base_url().'ajax/checking'; ?>",
            type     : "post",
            dataType : "json",
            data     : {"tbl_name" : table, "field" : field, "value" : contain},
            success: function(data) {
                //$('#result').text(data);
                if(data >= 1){
                    $('#result').text('Kode gaji telah digunakan').removeClass('label-primary').addClass('label-danger');
                }else{
                    $('#result').text('Kode gaji tersedia').removeClass('label-danger').addClass('label-primary');
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
        var form=$(this);
        $('body').find('.money').each(function(){
            var self=$(this);
            var v = self.autoNumeric('get');
            // self.autoNumeric('destroy');
            self.val(v);
        });
    });
});
</script>
<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('master/gaji/create', 'class="submit form-horizontal form-label-left input_mask" autocomplete="off"'); ?>

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
                        <input type="text" id="checking" class="form-control a" placeholder="Masukkan Kode Gaji (Tanpa Spasi)" name="kode_golgaji" maxlength="10" required>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><span id="result" class="label label-primary">Wajib diisi</span></label>
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
                            <input class="money form-control" placeholder="Masukkan Nominal Angka" name="nominal_golgaji" required />
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
