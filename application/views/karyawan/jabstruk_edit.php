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
						<h2>Jabatan Struktural<small><?php echo $n; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        <?php echo form_open('karyawan/jabstruk/update/'.$edit[0]['id_jabatan_karyawan'], 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Unit Kerja *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="id_unit" required>
                                <option value="">--- PILIH UNIT KERJA ---</option>
                                    <?php 
                                        foreach ($unit as $unit){
                                            $r = ($unit["id_unit"] == $edit[0]['id_unit']) ? "selected='selected'" : "";
                                            echo '<option value="'.$unit["id_unit"].'" '.$r.'>'.$unit['nama_unit'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Jabatan *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="id_jabatan" required>
                                <option value="">--- PILIH JABATAN ---</option>
                                    <?php 
                                        foreach ($jab as $jab){
                                            $r = ($jab["id_jabatan"] == $edit[0]['id_jabatan']) ? "selected='selected'" : "";
                                            echo '<option value="'.$jab["id_jabatan"].'" '.$r.'>'.$jab['nama_jabatan'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. SK Jabatan </label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Masukkan No. SK Jabatan" name="nosk_jabatan_karyawan" maxlength="100" />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>                                 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Mulai Menjabat</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" placeholder="(YYYY-MM-DD)" name="tgl_m_jabatan_karyawan"/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Selesai Menjabat</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" placeholder="(YYYY-MM-DD)" name="tgl_s_jabatan_karyawan"/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Jabatan *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="status_jabatan_karyawan" required>
                                    <option value="">--- PILIH STATUS ---</option>
                                    <option value="Y" <?php echo ($edit[0]['status_jabatan_karyawan'] == 'Y') ? "selected='selected'" : ""; ?>>Aktif</option>
                                    <option value="N" <?php echo ($edit[0]['status_jabatan_karyawan'] == 'N') ? "selected='selected'" : ""; ?>>Nonaktif</option>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>                   
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'karyawan/jabstruk'; ?>" class="btn btn-default" >Batal</a>
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