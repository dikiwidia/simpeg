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
                        <a href="<?php echo base_url().'karyawan/golgaji'; ?>"class="btn btn-default "><i class="fa fa-undo"></i> Kembali</a>
                    </div>
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Kode Golongan</th>
                                <th>Nominal</th>
                                <th>SK Penetapan Gaji</th>
                                <th>Tanggal Ketetapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach($get as $b){
                                    //karyawan
                                    if(read_custom_cond_bool('speg_data_karyawan',array('id_karyawan'=>$b['id_karyawan'])) == FALSE){
                                        $p = '<span class="label label-danger">(Data Karyawan Dihapus)</span>';
                                    }else{
                                        $o = read_custom_id('speg_data_karyawan',$b['id_karyawan'],'id_biodata');
                                        $p = read_custom_id_ifempty('speg_biodata',$o,'nama_biodata','<span class="label label-danger">(Master Biodata Dihapus)</span>');
                                    }

                                    
                                    if(read_custom_numrows('speg_data_golgaji',array('id_golgaji'=>$b['id_golgaji'])) == 0){
                                        $q = '<span class="label label-danger">(Master Gol. Gaji Dihapus)</span>';
                                        $r = 0;
                                    }else{
                                        $q = read_custom_id('speg_data_golgaji',$b['id_golgaji'],'kode_golgaji');
                                        $r = read_custom_id('speg_data_golgaji',$b['id_golgaji'],'nominal_golgaji');
                                    }

                                    echo "<tr>";
                                    echo "<td>".$i++."</td>";
                                    echo "<td>".$p."</td>";
                                    echo "<td>".$q."</td>";
                                    echo "<td class='money'>".$r."</td>";
                                    echo "<td>".ifempty($b['nosk_golgaji_karyawan'],'-')."</td>";
                                    echo "<td>".date_id(ifemptydate($b['t_nk_golgaji_karyawan'],'-'))."</td>";
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