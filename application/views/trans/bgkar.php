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
                            <a href="<?php echo base_url().'trans/bgkar/new'; ?>"class="btn btn-success "><i class="fa fa-plus"></i> Baru</a>
                        </div>
						<table id="datatable-responsive" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Deskripsi</th>
									<th>Hari Kerja</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                    $i = 1;
                                    foreach($get as $a){
                                        echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".$a['kode_transaksi_k']."</td>";
                                        echo "<td>".$a['nama_transaksi_k']."</td>";
                                        echo "<td>".$a['hrkj_transaksi_k']."</td>";
                                        echo '<td><center><a class="last edit" href="'.base_url().'trans/bgkar/edit/'.$a['id_transaksi_k'].'='.$a['kode_transaksi_k'].'">Ubah</a> | <a class="last edit" href="'.base_url().'trans/bgkar/delete/'.$a['id_transaksi_k'].'='.$a['kode_transaksi_k'].'">Hapus</a> | <a class="last edit" href="'.base_url().'trans/bgkar/payroll/'.$a['id_transaksi_k'].'='.$a['kode_transaksi_k'].'">Transaksi</a></center></td>';
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
});
</script>