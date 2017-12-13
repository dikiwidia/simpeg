<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Biodata <small><?php echo $edit_bio[0]['nama_biodata']; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('master/bio/update/'.$edit_bio[0]['id_biodata'], 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap *</label>
                            <div class="col-md- col-sm-5 col-xs-12">
                                <input type="text" class="form-control a" placeholder="Masukkan Nama Lengkap (Tanpa Gelar Akademik)" name="nama_biodata" value="<?php echo $edit_bio[0]['nama_biodata']; ?>" maxlength="50" required>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir" name="tmplahir_biodata" value="<?php echo $edit_bio[0]['tmplahir_biodata']; ?>" maxlength="50" required>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" class="form-control" data-inputmask="'mask': '9999-99-99'" placeholder="e.g. 1995-10-26" value="<?php echo $edit_bio[0]['tglahir_biodata']; ?>" name="tglahir_biodata" required/>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="jkelamin_biodata" required/>
                                    <option value="L" <?php echo $r = ($edit_bio[0]['jkelamin_biodata'] == 'L') ? 'selected="selected"' : ''; ?>>Laki-Laki</option>
                                    <option value="P" <?php echo $r = ($edit_bio[0]['jkelamin_biodata'] == 'P') ? 'selected="selected"' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="id_agama" required/>
                                    <?php 
                                        foreach ($agama as $agama){
                                            $r = ($edit_bio[0]['id_agama'] == $agama["id_agama"]) ? 'selected="selected"' : '';
                                            echo '<option value="'.$agama["id_agama"].'" '.$r.'>'.$agama['nama_agama'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Surat Elektronik (email)</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="email" class="form-control" placeholder="e.g. info@example.com" value="<?php echo $edit_bio[0]['surel_biodata']; ?>" name="surel_biodata" maxlength="100">
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Ponsel</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="e.g. 085311555xxx" value="<?php echo $edit_bio[0]['kontak_biodata']; ?>" name="kontak_biodata" maxlength="15">
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>				
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat *</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <textarea class="form-control noresize" name="alamat_biodata" rows="3" placeholder="e.g. Jl. Soekarno Hatta No. 1, Rangkasbitung, Banten"><?php echo $edit_bio[0]['alamat_biodata']; ?></textarea>
                            </div>
                            <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Opsional</small></label>
                        </div>
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'master/bio'; ?>" class="btn btn-default" >Batal</a>
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