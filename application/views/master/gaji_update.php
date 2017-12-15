<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Gaji Golongan <small><?php echo $edit[0]['kode_golgaji']; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('master/gaji/update/'.$edit[0]['id_golgaji'], 'class="form-horizontal submit form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Masukkan Keterangan Gaji" name="nama_golgaji" value="<?php echo $edit[0]['nama_golgaji']?>" maxlength="50" required />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                                    <input class="money form-control" placeholder="Masukkan Nominal Angka" value="<?php echo $edit[0]['nominal_golgaji']?>" name="nominal_golgaji" required />
                                </div>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi<br />Peringatan ! Merevisi nominal gaji akan berdampak pada nominal penggajian bulan selanjutnya. Jika tidak ingin mengubah apapun, tekan tombol "Batal"</small></label>
                        </div>
                        
                        <input type="hidden" name="rev_golgaji" value="<?php echo $edit[0]['rev_golgaji']?>" />
                        <input type="hidden" name="kode_golgaji" value="<?php echo $edit[0]['kode_golgaji']?>" />

                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'master/gaji'; ?>" class="btn btn-default" >Batal</a>
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