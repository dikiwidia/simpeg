<?php
if(read_custom_cond_bool('speg_data_karyawan',array('id_karyawan'=>$edit[0]['id_karyawan'])) == FALSE){
    $n = '(Data Karyawan Dihapus)';
}else{
    $o = read_custom_id('speg_data_karyawan',$edit[0]['id_karyawan'],'id_biodata');
    $n = read_custom_id_ifempty('speg_biodata',$o,'nama_biodata','(Master Biodata Dihapus)');
}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Gaji Karyawan<small><?php echo $n; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        <?php echo form_open('karyawan/golgaji/update/'.$edit[0]['id_golgaji_karyawan'], 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->                                       
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Gaji Sebelumnya</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control" value="<?php echo $edit[0]['kode_golgaji'] ?>" readonly/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Kode Gaji Sebelum Naik</small></label>
                        </div>          
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal Gaji Sebelumnya</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                                    <input type="text" class="form-control money" value="<?php echo $gaji_b[0]['nominal_golgaji']; ?>" readonly/>
                                </div>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Nominal Gaji Sebelum Naik</small></label>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Kode Gaji *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="kode_golgaji" required>
                                <option value="">--- PILIH KODE GAJI ---</option>
                                    <?php 
                                        foreach ($gaji as $gaji){
                                            echo '<option value="'.$gaji["kode_golgaji"].'">'.$gaji['kode_golgaji'].' ('.$gaji['nominal_golgaji'].')</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib dipilih</small></label>
                        </div>           
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. SK Penetapan</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Masukkan No. SK Penetapan" name="nosk_golgaji_karyawan" maxlength="100" />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>                                 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Penetapan *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" placeholder="(YYYY-MM-DD)" name="t_nk_golgaji_karyawan" required/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>              
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'karyawan/golgaji'; ?>" class="btn btn-default" >Batal</a>
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