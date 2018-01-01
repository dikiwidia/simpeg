<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Transaksi Gaji Karyawan<small><?php echo $edit[0]['nama_transaksi_k']; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('trans/bgkar/update/'.$edit[0]['id_transaksi_k'].'='.$edit[0]['kode_transaksi_k'], 'class="form-horizontal submit form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->                            
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" id="checking" class="form-control a" placeholder="Masukkan Deskripsi" value="<?php echo $edit[0]['nama_transaksi_k']; ?>" name="nama_transaksi_k" maxlength="50" required>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>                                                 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Hari Kerja *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" id="checking" class="form-control a" placeholder="Masukkan Total Hari Kerja" value="<?php echo $edit[0]['hrkj_transaksi_k']; ?>"  name="hrkj_transaksi_k" maxlength="2" required>
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
});
</script>