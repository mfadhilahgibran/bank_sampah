<div class="card">
    <div class="card-header">

        <?php if ($this->session->userdata('level') == 1) { ?><button class="btn btn-primary no-print" data-toggle="modal" data-target="#modal_default" onclick="view_modal('1','Tambah')" href="#">
                <i class="fa fa-plus"></i> Tambah Data
            </button><?php } ?>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="setor_sampah" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Tarik</th>
                    <th>Tanggal</th>
                    <th>NIN</th>
                    <th>Nama</th>
                    <th>Jumlah Tarik</th>
                    <?php if ($this->session->userdata('level') == 1) { ?> <th class="no-print">Aksi</th><?php } ?>

                </tr>
            </thead>
            <?php $no = 1;
            foreach ($tarikSampah as $value) { ?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->id_tarik ?></td>
                        <td><?= $value->tanggal ?></td>
                        <td><?= $value->nin ?></td>
                        <td><?= $value->nama ?></td>
                        <!-- <td>Rp. <= $value->saldo ?></td> -->
                        <td>Rp. <?= number_format($value->jumlah_tarik,  0, ',', '.') ?></td><?php if ($this->session->userdata('level') == 1) { ?>
                            <td class="no-print">
                                <button data-id="<?= $value->id_tarik; ?>" class="no-print btn btn-success btn-sm konfirmasiEdit" data-toggle="modal" data-target="#modal_default"><i class="fas fa-eye"></i></button>

                            </td><?php } ?>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
        <button class="no-print btn btn-primary mt-2" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>

    </div>
    <!-- Modal Tambah data setor_sampah -->
    <div class="modal fade" id="modal_default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Update Data</h4>
                    <button type="button" class="btn-close-add" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <label>ID Tarik</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="id_tarik" name="id_tarik" value="<?= $id ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal" placeholder="Isi Tanggal" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nin">NIN</label>
                            <select class="form-control " id="nin" name="nin" onchange="handleSelectChange_nin(event)" style="width: 100%;">
                                <option value='' selected="selected">-Pilih-</option>
                                <?php
                                foreach ($nin as $value) {
                                    echo "<option value='$value->nin'>$value->nin - $value->nama - $value->saldo</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="saldo">Saldo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control" id="saldo" placeholder="Saldo" name="saldo" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_tarik">Jumlah Tarik</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control" id="jumlah_tarik" placeholder="Isi jumlah tarik" name="jumlah_tarik">
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="btnsubmit" onclick="Simpan_data()">Tambah</button>
                    <button type="button" class="btn btn-danger" id="delete" onclick="Delete_data()"><i class="fas fa-trash"> Hapus</i></button>
                </div>
                </form>
            </div>
        </div>

    </div>


    <!-- modal-delete -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">WARNING !!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label id="iddelete2" hidden> </label>Apakah ingin delete <label id="iddelete"> </label> ?
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <form action="#" method="post">
                        <!-- <button type="button" id="delete" onclick="Delete_data()" class="btn btn-outline-light">Yes</button> -->
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Delete-->
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7-beta.0/jquery.inputmask.min.js"></script>


<script src="<?= base_url('assets/template'); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/template'); ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets/template'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url('assets/template'); ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/template'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#saldo, #jumlah_tarik').inputmask({
            alias: 'numeric',
            groupSeparator: '.',
            autoGroup: true,
            digits: 2, // Angka di belakang koma
            digitsOptional: false, // Mengharuskan angka di belakang koma
            placeholder: '0',
            rightAlign: false,
            unmaskAsNumber: true, // Mengeluarkan nilai sebagai angka
            radixPoint: ',', // Menggunakan koma sebagai pemisah desimal
            allowMinus: false, // Menghilangkan tanda minus jika tidak diperlukan
            onBeforePaste: function(pastedValue) {
                // Menghilangkan pemisah ribuan sebelum memproses
                return pastedValue.replace(/\./g, '').replace(',', '.');
            },
            // Fungsi ini digunakan untuk mempertahankan angka setelah titik
            postFormat: function(value) {
                return value.replace(',', '.');
            }
        });
    });
</script>

<!-- <script>
    function calculateTotal() {
        var berat = parseFloat(document.getElementById("saldo").value.replace('.', '').replace(',', '.'));
        var harga = parseFloat(document.getElementById("jumlah_tarik").value.replace('.', '').replace(',', '.'));
        var total = berat * harga;
        document.getElementById("total").value = total.toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
</script> -->
<script type="text/javascript">
    /// @note Untuk Add,Edit,delete.
    function view_modal(id_tarik1, status) {

        if (status == "Tambah") {

            $('#exampleModalLabel').text('Tambah Data'); // name view
            $('#quickForm')[0].reset(); // reset form textbox
            document.getElementById("delete").style.visibility = "hidden"; // Visible button          
            document.getElementById("id_tarik").removeAttribute('disabled');
            document.getElementById("nin").removeAttribute('disabled');
            //Ajax kosongkan data

        } else {
            $('#quickForm')[0].reset(); // reset form

            var id_tarik = id_tarik1;

            // Ajax isi data
            $.ajax({
                url: "<?php echo base_url('C_Tarik_saldo/ajax_getbynin') ?>",
                method: "get",
                dataType: "JSON",
                data: {
                    id_tarik: id_tarik,
                },
                success: function(data) {
                    // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
                    $('#id_tarik').val(data.id_tarik);
                    $('#tanggal').val(data.tanggal);
                    $('#nin').val(data.nin);
                    $('#nama').val(data.nama);
                    $('#saldo').val(data.saldo);
                    $('#jumlah_tarik').val(data.jumlah_tarik);

                },
                error: function(e) {
                    alert(e);
                }
            });
            // Disable and button submit dan text form           
            if (status == "Delete") {
                document.getElementById("btnsubmit").style.visibility = "hidden";
                $('#exampleModalLabel').text('View Data'); //name view modal add            
            } else {
                $('#exampleModalLabel').text('Data Tarik'); //name view modal update(revise procedure) 
                document.getElementById("btnsubmit").style.visibility = "hidden";
                document.getElementById("delete").style.visibility = "visible";

            }
        }
    }
</script>


<script type="text/javascript">
    function Simpan_data() {

        var saldo1 = parseInt($('#saldo').val());
        var saldo = $('#saldo').val();
        var jumlah_tarik1 = parseInt($('#jumlah_tarik').val());
        var jumlah_tarik = $('#jumlah_tarik').val();
        if (saldo1 < jumlah_tarik1 || saldo == 0 || saldo < jumlah_tarik) {
            alert("Saldo tidak mencukupi");
            return false;
        }

        var fdata = new FormData();
        fdata.append("id_tarik", $('#id_tarik').val());
        var form_data = $('#quickForm').serializeArray();
        $.each(form_data, function(key, input) {
            if (input.name === 'saldo' || input.name === 'jumlah_tarik') {
                fdata.append(input.name, parseFloat(input.value.replace('.', '').replace(',', '.')));
            } else {
                fdata.append(input.name, input.value);
            }
        });

        $.ajax({
            url: "<?php echo base_url('C_Tarik_saldo/ajax_add') ?>",
            method: "post",
            processData: false,
            contentType: false,
            data: fdata,
            success: function(data) {
                location.reload();
                $('#quickForm')[0].reset();
                $("#modal_default").modal('hide');
            },
            error: function(e) {
                alert('gagal');
            }
        });
    }



    function Delete_data() {

        // Form data
        var fdata = new FormData();

        // Delete by id_tarik
        fdata.append("id_tarik", $('#id_tarik').val());
        // Form data collect name value
        var form_data = $('#quickForm').serializeArray();
        $.each(form_data, function(key, input) {
            // Gunakan parseFloat untuk mempertahankan nilai desimal
            if (input.name === 'saldo' || input.name === 'jumlah_tarik') {
                fdata.append(input.name, parseFloat(input.value.replace('.', '').replace(',', '.')));
            } else {
                fdata.append(input.name, input.value);
            }
        });
        // Url Post delete
        vurl = "<?php echo base_url('C_Tarik_saldo/ajax_delete') ?>";

        // Post data
        $.ajax({
            url: vurl,
            method: "post",
            processData: false,
            contentType: false,
            data: fdata,

            success: function(data) {
                location.reload();
                $('#modal_default').modal('hide');

            },
            error: function(e) {
                //Pesan Gagal
                gagal(e);
            }
        });

    }
</script>



<script type="text/javascript">
    //  id_tarik selected konfirmasiHapus
    $(document).on("click", ".konfirmasiHapus", function() {
        $('#iddelete').text($(this).attr("data-id"));

    })

    //  id_tarik selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiEdit", function() {
        view_modal($(this).attr("data-id"), 'Edit');

    })

    //  id_tarik selected  konfirmasiView
    $(document).on("click", ".konfirmasiView", function() {
        view_modal($(this).attr("data-id"), 'View');
    })

    // ID Rows selected
    $('#example1').on('click', 'tr', function() {
        $('#iddelete2').text($('#example1').DataTable().row(this).id());
    });

    function handleSelectChange_nin(event) {
        var value = $("#nin option:selected").text();
        var res = value.split(" - ");
        $('#nama').val(res[1]);
        $('#saldo').val(res[2]);
    }
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

    })
</script>