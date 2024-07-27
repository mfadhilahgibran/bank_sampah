<div class="card">
    <div class="card-header">
        <?php if ($this->session->userdata('level') == 1) { ?>
            <button class="btn btn-primary no-print" data-toggle="modal" data-target="#modal_default" onclick="view_modal('1','Tambah')" href="#">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        <?php } ?>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="setor_sampah" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Setor</th>
                    <th>Tanggal</th>
                    <th>NIN</th>
                    <th>Nama</th>
                    <th>ID Sampah</th>
                    <th>Jenis Sampah</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <?php if ($this->session->userdata('level') == 1) { ?><th class="no-print">Aksi</th> <?php } ?>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($setorSampah as $value) { ?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->id_setor ?></td>
                        <td><?= $value->tanggal ?></td>
                        <td><?= $value->nin ?></td>
                        <td><?= $value->nama ?></td>
                        <td><?= $value->id_sampah ?></td>
                        <td><?= $value->jenis_sampah ?></td>
                        <td><?= $value->berat ?> Kg</td>
                        <td>Rp. <?= number_format($value->harga,  0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($value->total,  0, ',', '.') ?></td>
                        <?php if ($this->session->userdata('level') == 1) { ?>
                            <td class="no-print">
                                <button data-id="<?= $value->id_setor; ?>" class="btn btn-success btn-sm konfirmasiEdit" data-toggle="modal" data-target="#modal_default"><i class="fas fa-eye"></i></button>

                            </td>
                        <?php } ?>
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
                        <div class="form-group">
                            <label for="id_setor">ID Setor</label>
                            <input type="text" class="form-control" id="id_setor" placeholder="id_setor" name="id_setor" value="<?= $id ?>" readonly>
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
                            <select class="form-control" id="nin" name="nin" onchange="handleSelectChange_nin(event)" style="width: 100%;" disabled>
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
                            <label for="saldo">saldo</label>
                            <input type="text" class="form-control" id="saldo" placeholder="Isi saldo" name="saldo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_sampah">ID Sampah</label>
                            <select class="form-control" id="id_sampah" name="id_sampah" onchange="handleSelectChange_sampah(event)" style="width: 100%;">
                                <option value='<?= $value->jenis_sampah ?>' selected="selected">-Pilih-</option>
                                <?php
                                foreach ($sampah as $value) {
                                    echo "<option value='$value->id_sampah'>$value->id_sampah - $value->jenis_sampah - $value->harga</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_sampah">Jenis Sampah</label>
                            <input type="text" class="form-control" id="jenis_sampah" placeholder="Isi jenis sampah" name="jenis_sampah" readonly>
                        </div>
                        <div class="form-group">
                            <label for="berat">Berat</label>
                            <input type="text" class="form-control" id="berat" placeholder="Isi berat" name="berat" oninput="calculateTotal()">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control" id="harga" placeholder="harga" name="harga" oninput="calculateTotal()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control" id="total" placeholder="total" name="total" readonly>
                            </div>
                        </div>


                        <script>
                            function calculateTotal() {
                                var berat = parseFloat(document.getElementById("berat").value.replace('.', '').replace(',', '.'));
                                var harga = parseFloat(document.getElementById("harga").value.replace('.', '').replace(',', '.'));
                                var total = berat * harga;
                                document.getElementById("total").value = total.toLocaleString('id-ID', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        </script>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="btnsubmit" onclick="Simpan_data()">Tambah</button>
                    <button type="button" class="btn btn-danger" id="delete" onclick="Delete_data()"><i class="fas fa-trash"> Hapus</i></button>
                </div>
                </form>
            </div>
        </div>

    </div>


</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7-beta.0/jquery.inputmask.min.js"></script>


  <!-- Select2 -->
  <script src="<?= base_url('assets/template'); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/template'); ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets/template'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url('assets/template'); ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/template'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Page script -->


<script>
    $(document).ready(function() {
        $('#harga, #total').inputmask({
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


</script>

<script type="text/javascript">
    /// @note Untuk Add,Edit,delete.
    function view_modal(id_setor1, status) {
        if (status == "Tambah") {

            $('#exampleModalLabel').text('Tambah Data'); // name view
            $('#quickForm')[0].reset(); // reset form textbox

            // $('#btnsubmit').text('Save'); // name Save
            document.getElementById("btnsubmit").style.visibility = "visible"; // Visible button          
            document.getElementById("delete").style.visibility = "hidden"; // Visible button          
            document.getElementById("nin").removeAttribute('disabled');



            //Ajax kosongkan data

        } else {

            $('#quickForm')[0].reset(); // reset form

            var id_setor = id_setor1;

            // Ajax isi data
            $.ajax({
                url: "<?php echo base_url('C_Setor_sampah/ajax_getbynin') ?>",
                method: "get",
                dataType: "JSON",
                data: {
                    id_setor: id_setor,
                },
                success: function(data) {
                    // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
                    $('#id_setor').val(data.id_setor);
                    $('#tanggal').val(data.tanggal);
                    $('#nin').val(data.nin);
                    $('#nama').val(data.nama);
                    $('#saldo').val(data.saldo);
                    $('#id_sampah').val(data.id_sampah);
                    $('#jenis_sampah').val(data.jenis_sampah);
                    $('#berat').val(data.berat);
                    $('#harga').val(data.harga);
                    $('#total').val(data.total);
                },
                error: function(e) {
                    alert(e);
                }

            });
            //   Disable and button submit dan text form           
            if (status == "Delete") {
                // document.getElementById("btnsubmit").style.visibility = "hidden";
                $('#exampleModalLabel').text('View Data'); //name view modal add            
            } else {
                $('#exampleModalLabel').text('Data Setor'); //name view modal update(revise procedure)
                document.getElementById("btnsubmit").style.visibility = "hidden";
                document.getElementById("delete").style.visibility = "visible";
                document.getElementById("tanggal").setAttribute('disabled');

            }
        }
    }


    //simpan data
    function Simpan_data() {

        // Form data
        var fdata = new FormData();
        fdata.append("id_setor", $('#id_setor').val());

        // Kumpulkan data dari form
        var form_data = $('#quickForm').serializeArray();
        $.each(form_data, function(key, input) {
            // Gunakan parseFloat untuk mempertahankan nilai desimal
            if (input.name === 'berat' || input.name === 'harga' || input.name === 'total') {
                fdata.append(input.name, parseFloat(input.value.replace('.', '').replace(',', '.')));
            } else {
                fdata.append(input.name, input.value);
            }
        });
        $.ajax({
            url: "<?php echo base_url('C_Setor_sampah/ajax_add') ?>",
            method: "post",
            processData: false,
            contentType: false,
            data: fdata,
            beforeSend: function() {},
            success: function(data) {
                location.reload();
                $('#quickForm')[0].reset();
                $("#modal_default").modal('hide');

            },
            error: function(e) {
                alert('gagal');

                //error
            }
        });

    }

    function Delete_data() {
        // var total = $('#total').val();
        // // var saldo = $('#saldo').val();
        // var saldo = $('#saldo').val();
        // if (saldo < total) {
        //     alert("Saldo tidak mencukupi, kembalikan saldo yang sudah ditarik oleh anda");
        //     location.reload();
        //     return false;
        // }
        // Form data
        var fdata = new FormData();

        // Delete by id_setor
        fdata.append("id_setor", $('#id_setor').val());
        // fdata.append("total", $('#total').val());
        fdata.append("nin", $('#nin').val());
        var form_data = $('#quickForm').serializeArray();
        $.each(form_data, function(key, input) {
            // Gunakan parseFloat untuk mempertahankan nilai desimal
            if (input.name === 'harga' || input.name === 'total') {
                fdata.append(input.name, parseFloat(input.value.replace('.', '').replace(',', '.')));
            } else {
                fdata.append(input.name, input.value);
            }
        });
        // Url Post delete
        vurl = "<?php echo base_url('C_Setor_sampah/ajax_delete') ?>";

        // Post data
        $.ajax({
            url: vurl,
            method: "post",
            processData: false,
            contentType: false,
            data: fdata,
            success: function(data) {
                location.reload();
                // Hide modal delete
                $('#modal_default').modal('hide');
                berhasil(data.status);

            },
            error: function(e) {
                //Pesan Gagal
                gagal(e);
            }
        });

    }
</script>



<script type="text/javascript">
    //  id_setor selected konfirmasiHapus
    $(document).on("click", ".konfirmasiHapus", function() {
        $('#iddelete').text($(this).attr("data-id"));
    })

    //  id_setor selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiEdit", function() {
        view_modal($(this).attr("data-id"), 'Edit');

    })

    //  id_setor selected  konfirmasiView
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

    function handleSelectChange_sampah(event) {
        var value = $("#id_sampah option:selected").text();
        var res = value.split(" - ");
        $('#jenis_sampah').val(res[1]);
        $('#harga').val(res[2]);
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

        //Datemask yyyy/mm/dd
        $('#datemask').inputmask('yyyy/mm/dd', {
            'placeholder': 'yyyy/mm/dd'
        })
        //Datemask2 yyyy/mm/dd
        $('#datemask2').inputmask('yyyy/mm/dd', {
            'placeholder': 'yyyy/mm/dd'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY/MM/DD'
        });
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY/MM/DD hh:mm A'
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
                $('#reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'))
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

<!-- for Cannot read properties of undefined (reading 'data') -->