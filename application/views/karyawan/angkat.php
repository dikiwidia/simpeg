<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Karyawan<small><?php echo $title; ?></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sort"></i> Sortir <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url().'karyawan/angkat/sort/a'; ?>">Berdasarkan Karyawan Aktif</a></li>
                                <li><a href="<?php echo base_url().'karyawan/angkat/sort/p'; ?>">Berdasarkan Karyawan Pensiun</a></li>
                                <li><a href="<?php echo base_url().'karyawan/angkat/sort/k'; ?>">Berdasarkan Karyawan Keluar</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url().'karyawan/angkat'; ?>">Kembali</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo base_url().'karyawan/angkat/new'; ?>"class="btn btn-success "><i class="fa fa-plus"></i> Baru</a>
                        </div>
						<table id="datatable-responsive" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Karyawan</th>
									<th>Tanggal Masuk</th>
									<th>Tanggal Keluar</th>
									<th>Nomor SK. Karyawan</th>
									<th>Status</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                    $i = 1;
                                    foreach($get as $a){
                                        $status = $a['status_karyawan'];
                                        if($status == "A"){$status = '<span class="label label-success">Aktif</span>';}
                                        elseif($status == "P"){$status = '<span class="label label-warning">Pensiun</span>';}
                                        else{$status = '<span class="label label-danger">Keluar</span>';}

                                        echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".read_custom_id_ifempty('speg_biodata',$a['id_biodata'],'nama_biodata','<span class="label label-danger">(Master Biodata Dihapus)</span>')."</td>";
                                        echo "<td>".date_id(ifemptydate($a['t_m_karyawan'],'-'))."</td>";
                                        echo "<td>".date_id(ifemptydate($a['t_p_karyawan'],'-'))."</td>";
                                        echo "<td>".ifempty($a['nosk_karyawan'],'-')."</td>";
                                        echo "<td>".$status."</td>";
                                        echo '<td><a class="last edit" href="'.base_url().'karyawan/angkat/edit/'.$a['id_karyawan'].'">Ubah</a> <a class="last edit" href="'.base_url().'karyawan/angkat/delete/'.$a['id_karyawan'].'">Hapus</a></td>';
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