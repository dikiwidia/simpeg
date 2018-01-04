<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Potongan<small><?php echo $edit[0]['nama_potongan']; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('master/potongan/update/'.$edit[0]['id_potongan'], 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Potongan *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control" value="<?php echo $edit[0]['nama_potongan']; ?>" placeholder="Masukkan Deskripsi Potongan" name="nama_potongan" maxlength="50" required />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <textarea class="form-control noresize" name="ket_potongan" rows="3" placeholder="Tambahkan Keterangan Maximal 500 Karakter" maxlength="500" required><?php echo $edit[0]['ket_potongan']; ?></textarea>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib Diisi</small></label>
                        </div>
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'master/potongan'; ?>" class="btn btn-default" >Batal</a>
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

</script>