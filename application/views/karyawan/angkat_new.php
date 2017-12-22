<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Karyawan<small>Buat Baru</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('karyawan/angkat/create', 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Nama *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="id_biodata" required>
                                <option value="">--- PILIH NAMA ---</option>
                                    <?php 
                                        foreach ($biodata as $biodata){
                                            echo '<option value="'.$biodata["id_biodata"].'">'.$biodata['nama_biodata'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>                  
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. SK Pengangkatan </label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Masukkan No. SK Pengangkatan" name="nosk_karyawan" maxlength="100" />
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>                                 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Mulai Bekerja</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" placeholder="(YYYY-MM-DD)" name="t_m_karyawan"/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Selesai Bekerja</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control date" placeholder="(YYYY-MM-DD)" name="t_p_karyawan"/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Karyawan *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="status_karyawan" required>
                                    <option value="">--- PILIH STATUS ---</option>
                                    <option value="A">Aktif</option>
                                    <option value="P">Pensiun</option>
                                    <option value="K">Keluar</option>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
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