<?php
$n = 0;
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Transaksi Gaji Karyawan<small><?php echo read_custom_id_ifempty('speg_biodata',$get[0]['id_biodata'],'nama_biodata','(Master Biodata Dihapus)'); ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        
                        <?php echo form_open('trans/bgkar/transaction', 'class="form-horizontal form-label-left submit" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group has-success">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Gaji Pokok *</label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <h2 class="money"><?php echo $a[0]['nominal_golgaji']; ?></h2>
                            </div>
                            <label class="control-label-left col-md-3 col-sm-3 col-xs-12"><span id="result" class="label label-primary"><?php echo $a[0]['nama_golgaji']; ?></span></label>
                            <?php
                            foreach($a as $a){                                 
                                echo '<input type="hidden" name="a['.$n.'][kode_golgaji]" value="'.$a['kode_golgaji'].'" />';                      
                                echo '<input type="hidden" name="a['.$n.'][nama_golgaji]" value="'.$a['nama_golgaji'].'" />';                     
                                echo '<input type="hidden" name="a['.$n.'][nominal]" value="'.$a['nominal_golgaji'].'" />';                               
                                echo '<input type="hidden" name="a['.$n.'][tgl_transaksi]" value="'.$dt_t.'" />';
                                $n++;
                            }
                            echo '<input type="hidden" name="uri" value="'.$d.'" />'; 
                            ?>
                        </div>  
                        <?php foreach($b as $b){ 


                            echo '<div class="form-group has-warning">';
                                echo '<label class="control-label col-md-2 col-sm-2 col-xs-12">'.$b['nama_tunjangan'].' *</label>';
                                echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                                    echo '<input type="text" name="b['.$n.'][nominal]" class="form-control money" value="0" required />';
                                echo '</div>';
                                echo '<div class="col-md-4 col-sm-4 col-xs-12">';
                                    echo '<input type="text" name="b['.$n.'][keterangan]" class="form-control" maxlength="100"  placeholder="Masukkan Keterangan Transaksi" />';
                                echo '</div>';
                                echo '<label class="control-label-left col-md-3 col-sm-3 col-xs-12"><small>'.$b['ket_tunjangan'].'</small></label>';

                                echo '<input type="hidden" name="b['.$n.'][nama_tunjangan]" value="'.$b['nama_tunjangan'].'" />';
                                echo '<input type="hidden" name="b['.$n.'][id_karyawan]" value="'.$id_k.'" />';
                                echo '<input type="hidden" name="b['.$n.'][id_transaksi_k]" value="'.$id_t.'" />';                                
                                echo '<input type="hidden" name="b['.$n.'][tgl_transaksi]" value="'.$dt_t.'" />';
                            echo '</div>';
                            $n++;
                        }
                        ?>
                        <?php foreach($c as $c){ 


                            echo '<div class="form-group has-error">';
                                echo '<label class="control-label col-md-2 col-sm-2 col-xs-12">'.$c['nama_potongan'].' *</label>';
                                echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                                    echo '<input type="text" name="c['.$n.'][nominal]" class="form-control money" value="0" required />';
                                echo '</div>';
                                echo '<div class="col-md-4 col-sm-4 col-xs-12">';
                                    echo '<input type="text" name="c['.$n.'][keterangan]" class="form-control" maxlength="100"  placeholder="Masukkan Keterangan Transaksi" />';
                                echo '</div>';
                                echo '<label class="control-label-left col-md-3 col-sm-3 col-xs-12"><small>'.$c['ket_potongan'].'</small></label>';

                                echo '<input type="hidden" name="c['.$n.'][nama_potongan]" value="'.$c['nama_potongan'].'" />';
                                echo '<input type="hidden" name="c['.$n.'][id_karyawan]" value="'.$id_k.'" />';
                                echo '<input type="hidden" name="c['.$n.'][id_transaksi_k]" value="'.$id_t.'" />';                                
                                echo '<input type="hidden" name="c['.$n.'][tgl_transaksi]" value="'.$dt_t.'" />';
                            echo '</div>';
                            $n++;
                        }
                        ?>
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