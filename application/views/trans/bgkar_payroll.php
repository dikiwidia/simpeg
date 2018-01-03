<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Transaksi Gaji Karyawan<small><?php echo $title; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        <div class="btn-group">
                            <a href="<?php echo base_url().'trans/bgkar'; ?>"class="btn btn-default "><i class="fa fa-undo"></i> Kembali</a>
                        </div>
						<table id="datatable-responsive" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Karyawan</th>
									<th>Kode Gaji</th>
									<th>Gaji Pokok</th>
									<th>Tunjangan</th>
									<th>Potongan</th>
									<th>Jumlah</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach($get as $a){
										if(read_custom_numrows('speg_gaji_karyawan',array('id_karyawan' => $a['id_karyawan'],'id_transaksi_k'=>$id_trans)) == 0){
											$n_gaji = '<span class="label label-danger">Belum di Proses</span>';
											$n_g	= 0;

											$k_gaji = '<span class="label label-danger">Belum di Proses</span>';

											$opt_dec1 = FALSE;
										} else {
											$n_gaji = read_custom_cond('speg_gaji_karyawan',array('id_karyawan' => $a['id_karyawan'],'id_transaksi_k'=>$id_trans),'nominal');
											$n_g	= $n_gaji;
											
											$k_gaji = read_custom_cond('speg_gaji_karyawan',array('id_karyawan' => $a['id_karyawan'],'id_transaksi_k'=>$id_trans),'kode_golgaji');

											$opt_dec1 = TRUE;
										}

										if(read_custom_numrows('speg_tunjangan_karyawan',array('id_karyawan' => $a['id_karyawan'],'id_transaksi_k'=>$id_trans)) == 0){
											$n_tunj = '<span class="label label-danger">Belum di Proses</span>';
											$n_t = 0;

											$opt_dec2 = FALSE;
										} else {
											$n_tunj = read_custom_query('SELECT SUM(nominal) AS total_tunj FROM speg_tunjangan_karyawan WHERE id_karyawan = '.$a["id_karyawan"].' AND id_transaksi_k = '.$id_trans,'total_tunj');
											$n_t = $n_tunj;

											$opt_dec2 = TRUE;
										}

										if(read_custom_numrows('speg_potongan_karyawan',array('id_karyawan' => $a['id_karyawan'],'id_transaksi_k'=>$id_trans)) == 0){
											$n_potg = '<span class="label label-danger">Belum di Proses</span>';
											$n_p = 0;

											$opt_dec3 = FALSE;
										} else {
											$n_potg = read_custom_query('SELECT SUM(nominal) AS total_potg FROM speg_potongan_karyawan WHERE id_karyawan = '.$a["id_karyawan"].' AND id_transaksi_k = '.$id_trans,'total_potg');
											$n_p = $n_potg;

											$opt_dec3 = TRUE;
										}

										if($opt_dec1 == FALSE && $opt_dec2 == FALSE && $opt_dec3 == FALSE){
											$opt ='<a class="last edit" href="'.base_url().'trans/bgkar/payroll/'.$this->uri->segment(4).'/pay/'.$a['id_karyawan'].'">Bayar</a>';
										} else {
											$opt ='<a class="last edit" href="'.base_url().'trans/bgkar/payroll/'.$this->uri->segment(4).'/reset/'.$a['id_karyawan'].'">Hapus</a>';
										}

										$ars = $n_g + $n_t - $n_p;

										echo "<tr>";
										echo "<td>".$i++."</td>";
										echo "<td>".read_custom_id_ifempty('speg_biodata',$a['id_biodata'],'nama_biodata','<span class="label label-danger">(Master Biodata Dihapus)</span>')."</td>";
										echo "<td>".$k_gaji."</td>";
										echo "<td class='money'>".$n_gaji."</td>";
										echo "<td class='money'>".$n_tunj."</td>";
										echo "<td class='money'>".$n_potg."</td>";
										echo "<td class='money'>".$ars."</td>";
										echo '<td>'.$opt.'</td>';
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
					</div>
                </div>
            </div>
		</div>
    </div>
</div>
<!-- /page content -->
<script>
$(document).ready(function(){
    var t = $('#datatable-responsive').DataTable({
		"paging": true,
		"pageLength": 10,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0,
        } ],
        "order": [[ 1, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

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