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
                        
                        <?php echo form_open('trans/bgkar/transaction_edit', 'class="form-horizontal form-label-left submit" autocomplete="off"'); ?>
                        <!-- FORM -->
                        <div class="form-group has-success">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Gaji Pokok *</label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <h2 class="money"><?php echo $a[0]['nominal']; ?></h2>
                            </div>
                            <label class="control-label-left col-md-3 col-sm-3 col-xs-12"><span id="result" class="label label-primary"><?php echo $a[0]['nama_golgaji']; ?></span></label>
                            <?php
                            echo '<input type="hidden" name="uri" value="'.$d.'" />'; 
                            echo '<input type="hidden" name="id_karyawan" value="'.$id_k.'" />'; 
                            echo '<input type="hidden" name="id_transaksi_k" value="'.$id_t.'" />'; 
                            ?>
                        </div>  
                        <?php foreach($b as $b){ 


                            echo '<div class="form-group has-warning">';
                                echo '<label class="control-label col-md-2 col-sm-2 col-xs-12">'.$b['nama_tunjangan'].' *</label>';
                                echo '<div class="col-md-7 col-sm-7 col-xs-12">
                                        <h2 class="money">'.$b["nominal"].'</h2>
                                    </div>';
                                echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                                    echo '<button type="button" class="edit btn btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg" data-vnom="'.$b["nominal"].'" data-vtitle="'.$b["nama_tunjangan"].'" data-vtype="tunj"  data-vidk="'.$id_k.'" data-vseg4="'.$d.'" data-vtype_id="'.$b["id_tunjangan_karyawan"].'">Ubah</button>';
                                echo '</div>';
                            echo '</div>';
                            $n++;
                        }
                        
                        foreach($c as $c){ 


                            echo '<div class="form-group has-error">';
                                echo '<label class="control-label col-md-2 col-sm-2 col-xs-12">'.$c['nama_potongan'].' *</label>';
                                echo '<div class="col-md-7 col-sm-7 col-xs-12">
                                        <h2 class="money">'.$c["nominal"].'</h2>
                                    </div>';
                                echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                                    echo '<button type="button" class="edit btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg" data-vnom="'.$c["nominal"].'" data-vtitle="'.$c["nama_potongan"].'" data-vtype="ptng"  data-vidk="'.$id_k.'" data-vseg4="'.$d.'" data-vtype_id="'.$c["id_potongan_karyawan"].'">Ubah</button>';
                                echo '</div>';
                            echo '</div>';
                            $n++;
                        }
                        ?>
                        <div class="form-group">
                            <div class="ol-xs-12 pull-right">
                            <a href="<?php echo base_url().'trans/bgkar/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" class="btn btn-default" >Batal</a>
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

    $('.edit').click(function(){

        var Val2 = $(this).data('vtitle');
        var Val3 = $(this).data('vnom');
        var Val4 = $(this).data('vtype');
        var Val5 = $(this).data('vidk');
        var Val6 = $(this).data('vseg4');
        var Val7 = $(this).data('vtype_id');
        $(".modal-body #vtitle").text( Val2 );
        $(".modal-body .inj").autoNumeric('set', Val3);
        $(".modal-footer .vtype").val( Val4 );
        $(".modal-footer .vidk").val( Val5 );
        $(".modal-footer .vseg4").val( Val6 );
        $(".modal-footer .vtype_id").val( Val7 );
    });
});
</script>
<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('trans/bgkar/transaction_edit', 'class="submit form-horizontal form-label-left" autocomplete="off"'); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Ubah</h4>
            </div>
            <div class="modal-body">
                <!-- FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="vtitle"></label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input class="money form-control inj" placeholder="Masukkan Nominal Angka" name="nominal" required />
                        </div>
                    </div>
                    <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
                </div>
                <!-- /FORM -->
            </div>
            <div class="modal-footer">
                <input type="hidden" name="vtype" class="vtype" />
                <input type="hidden" name="vseg4" class="vseg4" />
                <input type="hidden" name="vidk" class="vidk" />
                <input type="hidden" name="vtype_id" class="vtype_id" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </div>
            
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
