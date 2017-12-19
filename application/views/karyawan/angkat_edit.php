<?php 
if($edit[0]['status_karyawan'] == "A"){$a='selected="selected"'; $p = ''; $k ='';}
elseif($edit[0]['status_karyawan'] == "P"){$a=''; $p = 'selected="selected"'; $k ='';}
elseif($edit[0]['status_karyawan'] == "K"){$a=''; $p = ''; $k ='selected="selected"';}
else{$a=''; $p = ''; $k ='';}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Angkat Karyawan<small>Ubah Data: <?php echo $edit[0]['id_biodata']; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('karyawan/angkat/update/'.$edit[0]['id_karyawan'], 'class="form-horizontal submit form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Nama *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" class="form-control" value="<?php echo read_custom_id_ifempty('speg_biodata',$edit[0]['id_biodata'],'nama_biodata','-'); ?>" readonly />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>                                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. SK Pengangkatan </label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control" value="<?php echo $edit[0]['nosk_karyawan']; ?>" placeholder="Masukkan No. SK Pengangkatan" name="nosk_karyawan" maxlength="100" />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional (Biarkan Jika Tidak Ingin Diubah)</small></label>
                        </div>                                 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Mulai Bekerja</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" value="<?php echo $edit[0]['t_m_karyawan']; ?>" placeholder="(YYYY-MM-DD)" name="t_m_karyawan"/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional (Biarkan Jika Tidak Ingin Diubah)</small></label>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Selesai Bekerja</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" value="<?php echo $edit[0]['t_p_karyawan']; ?>" placeholder="(YYYY-MM-DD)" name="t_p_karyawan"/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional (Biarkan Jika Tidak Ingin Diubah)</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Karyawan *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="status_karyawan" required>
                                    <option value="">--- PILIH STATUS ---</option>
                                    <option value="A" <?php echo $a; ?>>Aktif</option>
                                    <option value="P" <?php echo $p; ?>>Pensiun</option>
                                    <option value="K" <?php echo $k; ?>>Keluar</option>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi (Biarkan Jika Tidak Ingin Diubah)</small></label>
                        </div>               
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'karyawan/angkat'; ?>" class="btn btn-default" >Batal</a>
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