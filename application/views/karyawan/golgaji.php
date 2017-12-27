<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Gaji Karyawan<small><?php echo $title; ?></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="btn-group">
                        <a href="<?php echo base_url().'karyawan/jabstruk/new'; ?>"class="btn btn-success "><i class="fa fa-plus"></i> Baru</a>
                    </div>
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Nama Unit</th>
                                <th>Jabatan</th>
                                <th>SK Penetapan Gaji</th>
                                <th>Tanggal Ketetapan</th>
                                <th>Selesai Jabatan</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach($get as $b){
                                    //nama
                                    if(read_custom_cond_bool('speg_data_karyawan',array('id_karyawan'=>$b['id_karyawan'])) == FALSE){
                                        $p = '<span class="label label-danger">(Data Karyawan Dihapus)</span>';
                                    }else{
                                        $o = read_custom_id('speg_data_karyawan',$b['id_karyawan'],'id_biodata');
                                        $p = read_custom_id_ifempty('speg_biodata',$o,'nama_biodata','<span class="label label-danger">(Master Biodata Dihapus)</span>');
                                    }
                                
                                    //unit
                                    $q = read_custom_id_ifempty('speg_data_unit',$b['id_unit'],'nama_unit','<span class="label label-danger">(Master Unit Dihapus)</span>');

                                    //jabatan
                                    $r = read_custom_id_ifempty('speg_data_jabatan',$b['id_jabatan'],'nama_jabatan','<span class="label label-danger">(Master Jabatan Dihapus)</span>');

                                    //status
                                    if($b['status_jabatan_karyawan'] == 'Y'){$s = '<span class="label label-success">Aktif</span>';}else{$s = '<span class="label label-primary">Nonaktif</span>';}

                                    echo "<tr>";
                                    echo "<td>".$i++."</td>";
                                    echo "<td>".$p."</td>";
                                    echo "<td>".$q."</td>";
                                    echo "<td>".$r."</td>";
                                    echo "<td>".ifempty($b['nosk_jabatan_karyawan'],'-')."</td>";
                                    echo "<td>".date_id(ifemptydate($b['tgl_m_jabatan_karyawan'],'-'))."</td>";
                                    echo "<td>".date_id(ifemptydate($b['tgl_s_jabatan_karyawan'],'-'))."</td>";
                                    echo "<td>".$s."</td>";
                                    echo '<td><a class="link" href="'.base_url().'karyawan/jabstruk/edit/'.$b['id_jabatan_karyawan'].'">Ubah</a> <a class="link" href="'.base_url().'karyawan/jabstruk/delete/'.$b['id_jabatan_karyawan'].'">Hapus</a></td>';
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
            "targets": 0
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
<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        
        <?php echo form_open('master/jabstruk/create', 'class="form-horizontal form-label-left input_mask" autocomplete="off"'); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Tambah Baru</h4>
        </div>
        <div class="modal-body">
            <!-- FORM -->
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Jabatan *</label>
                <div class="col-md- col-sm-5 col-xs-12">
                    <input type="text" class="form-control" placeholder="Masukkan Nama Jabatan" name="nama_jabatan" maxlength="50" required>
                </div>
                <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib diisi</small></label>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Level Jabatan *</label>
                <div class="col-md- col-sm-5 col-xs-12">
                    <input type="range" class="form-control" name="level_jabatan" oninput="document.getElementById('result').innerHTML = 'Level '+this.value" value="1" min="1" max="5" required>
                </div>
                <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><span id="result" class="label label-primary">Level 1</span></label>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan *</label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <textarea class="form-control noresize" name="ket_jabatan" rows="3" placeholder="Tambahkan Keterangan Maximal 500 Karakter" maxlength="500" required></textarea>
                </div>
                <label class="control-label-left col-md-4 col-sm-4 col-xs-12"><small>Wajib Diisi</small></label>
            </div>
            <!-- /FORM -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" type="submit" value="Simpan" />
        </div>
        
        <?php echo form_close(); ?>

    </div>
</div>
</div>