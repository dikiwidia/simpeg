<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Transaksi Gaji Karyawan<small>Buat Baru</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('trans/bgkar/create', 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Transaksi *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" id="checking" class="form-control a" placeholder="Masukkan Kode Transaksi (Tanpa Spasi)" name="kode_transaksi_k" maxlength="10" required>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><span id="result" class="label label-primary">Wajib diisi</span></label>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" id="checking" class="form-control a" placeholder="Masukkan Deskripsi" name="nama_transaksi_k" maxlength="50" required>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>                                                 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Hari Kerja *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" id="checking" class="form-control a" placeholder="Masukkan Total Hari Kerja" value="0" name="hrkj_transaksi_k" maxlength="2" required>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'trans/bgkar'; ?>" class="btn btn-default" >Batal</a>
                            <input class="btn btn-primary" type="submit" value="Simpan" />
                            </div>
                        </div>
                        <!-- /FORM -->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>
<!-- /page content -->
<script type="text/javascript">
$(document).ready(function(){
    $('.date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#checking').keyup(function() {
        var contain = $(this).val();
        var field   = "kode_transaksi_k";
        var table   = "speg_transaksi_k";

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
                    $('#result').text('Kode telah digunakan').removeClass('label-primary').addClass('label-danger');
                }else{
                    $('#result').text('Kode tersedia').removeClass('label-danger').addClass('label-primary');
                }
            }
            });
        }
    });
});
</script>