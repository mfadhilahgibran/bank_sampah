<div class="card">
    <div class="card-header">
        <?php if ($this->session->userdata('level') == 1) { ?><button class="btn btn-primary" data-toggle="modal" data-target="#modal_default" onclick="view_modal('1','Tambah')" href="#" class="no-print">
                <i class="fa fa-plus"></i> Tambah Data
            </button><?php } ?>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="nasabah" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 6%;">NIN</th>
                    <th style="width: 9%;">Kata Sandi</th>
                    <th style="width: 9%;">Nama</th>
                    <th style="width: 4%;">RT</th>
                    <th style="width: 20%;">Alamat</th>
                    <th style="width: 9%;">Telepon</th>
                    <th style="width: 9%;">Email</th>
                    <th style="width: 9%;">Saldo</th>
                  
                        <th style="width: 10%;" class="no-print">Aksi</th>
                </tr> 
            </thead>
            <?php $no = 1;
            foreach ($nasabah as $nb) { ?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $nb->nin ?></td>
                        <td><?= $nb->password ?></td>
                        <td><?= $nb->nama ?></td>
                        <td><?= $nb->rt ?></td>
                        <td><?= $nb->alamat ?></td>
                        <td><?= $nb->telepon ?></td>
                        <td><?= $nb->email ?></td>
                        <td>Rp. <?= number_format($nb->saldo,  0, ',', '.')  ?></td>
                        
                            <td class="no-print">
                                <button data-id="<?= $nb->nin; ?>" class="btn btn-primary btn-sm konfirmasiEdit" data-toggle="modal" data-target="#modal_default"><i class="fas fa-edit"></i></button>
                                <?php if ($this->session->userdata('level') == 1) { ?>   <button data-id="<?= $nb->nin; ?>" class="btn btn-danger btn-sm konfirmasiHapus" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></button><?php } ?>

                            </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
        <button class="no-print btn btn-primary mt-2" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
    </div>
    <!-- Modal Tambah data Nasabah -->
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
                            <label for="nin">NIN</label>
                            <input type="text" class="form-control" id="nin" placeholder="Isi NIN" name="nin">
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="text" class="form-control" id="password" placeholder="Isi kata sandi" name="password">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="text" class="form-control" id="rt" placeholder="Isi RT" name="rt">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" id="telepon" placeholder="Isi Telepon" name="telepon">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Isi Email" name="email">
                        </div>
                        <div class="form-group" hidden>
                            <label for="level">level</label>
                            <input type="text" class="form-control" id="level" placeholder="Isi level" name="level" hidden>
                        </div>

                </div>
                <div class="modal-footer justify-content">
                    <button type="submit" class="btn btn-primary" id="btnsubmit">Update</button>
                    <button type="button" class="btn btn-danger btn-close-add" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">Keluar</span>
                    </button>
                </div>
                </form>
            </div>
        </div>

    </div>


    <!-- modal-delete -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">PERINGATAN !!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label id="iddelete2" hidden> </label>Apakah ingin hapus <label id="iddelete"> </label> ?
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                    <form action="#" method="post">
                        <button type="button" id="delete" onclick="Delete_data()" class="btn btn-danger">Ya</button>
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

<script type="text/javascript">
    $(document).ready(function() {

        $.validator.setDefaults({
            submitHandler: function() {
                var status = $('#exampleModalLabel').text();

                if (status == "Tambah Data") {

                    // Ajax insert data
                    Simpan_data("Tambah");

                } else if (status == "Ubah Data") {

                    // Ajax Ubah data
                    Simpan_data("Ubah");

                } else {

                    berhasil(status);

                }

            }
        });
        $("#quickForm").validate({
            // Specify validation rules
            rules: {
                // Add your validation rules here
            },
            // Specify validation error messages
            messages: {
                // Add your validation messages here
            }


        });
        $('#btnsubmit').on('click', function(e) {
            e.preventDefault();
            var status = $('#exampleModalLabel').text();
            if (status == "Tambah Data") {
                // Ajax insert data
                Simpan_data("Tambah");
            } else if (status == "Ubah Data") {
                // Ajax update data
                Simpan_data("Ubah");
            } else {
                berhasil(status);
            }
        });
    });
</script>

<script type="text/javascript">
    /// @note Untuk Add,Edit,delete.
    function view_modal(nin1, status) {

        if (status == "Tambah") {

            $('#exampleModalLabel').text('Tambah Data'); // name view
            $('#quickForm')[0].reset(); // reset form textbox
            $("#nin").val(null).trigger("change"); // reset select filter
            $('#btnsubmit').text('Tambah'); // name Save
            document.getElementById("btnsubmit").style.visibility = "visible"; // Visible button          
            document.getElementById("nin").removeAttribute('disabled');
            //Ajax kosongkan data

        } else {
            $('#quickForm')[0].reset(); // reset form

            var nin = nin1;

            // Ajax isi data
            $.ajax({
                url: "<?php echo base_url('C_Nasabah/ajax_getbyno_induk') ?>",
                method: "get",
                dataType: "JSON",
                data: {
                    nin: nin,
                },
                success: function(data) {
                    // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
                    $('#nin').val(data.nin);
                    $('#password').val(data.password);
                    $('#nama').val(data.nama);
                    $('#rt').val(data.rt);
                    $('#alamat').val(data.alamat);
                    $('#telepon').val(data.telepon);
                    $('#email').val(data.email);
                },
                error: function(e) {
                    alert(e);
                }
            });
            // Disable and button submit dan text form           
            if (status == "View") {
                document.getElementById("btnsubmit").style.visibility = "hidden";
                $('#exampleModalLabel').text('View Data'); //name view modal add            
            } else {
                $('#exampleModalLabel').text('Ubah Data'); //name view modal Ubah(revise procedure)
                $('#btnsubmit').text('Ubah'); //button name  
                document.getElementById("btnsubmit").style.visibility = "visible";
                document.getElementById("nin").setAttribute('disabled', true);
            }
        }
    }
</script>


<script type="text/javascript">
    function Simpan_data($trigger) {

        // Form data
        var fdata = new FormData();

        fdata.append("nin", $('#nin').val());
        fdata.append("nama", $('#nama').val());
        fdata.append("password", $('#password').val());
        fdata.append("rt", $('#rt').val());
        fdata.append("alamat", $('#alamat').val());
        fdata.append("telepon", $('#telepon').val());
        fdata.append("email", $('#email').val());

        // Form data collect name value
        var form_data = $('#quickForm').serializeArray();
        $.each(form_data, function(key, input) {
            fdata.append(input.name, input.value);
        });


        // Simpan or Update data          
        var vurl;
        if ($trigger == "Tambah") {
            vurl = "<?php echo base_url('C_Nasabah/ajax_add') ?>";
        } else {
            vurl = "<?php echo base_url('C_Nasabah/ajax_update') ?>";
        }

        $.ajax({
            url: vurl,
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

                //error
            }
        });

    }

    function Delete_data() {

        // Form data
        var fdata = new FormData();

        // Delete by nin
        fdata.append('nin', $('#iddelete').text());
        // Url Post delete
        vurl = "<?php echo base_url('C_Nasabah/ajax_delete') ?>";

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
                $('#modal-delete').modal('hide');
                // Delete rows datatables
                $('#example1').DataTable().row("#" + $('#iddelete2').text()).remove().draw();

            },
            error: function(e) {
                //Pesan Gagal
                gagal(e);
            }
        });

    }
</script>


<script type="text/javascript">
    //  nin selected konfirmasiHapus
    $(document).on("click", ".konfirmasiHapus", function() {
        $('#iddelete').text($(this).attr("data-id"));

    })

    //  nin selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiEdit", function() {
        view_modal($(this).attr("data-id"), 'Edit');

    })

    //  nin selected  konfirmasiView
    $(document).on("click", ".konfirmasiView", function() {
        view_modal($(this).attr("data-id"), 'View');
    })

    // ID Rows selected
    $('#example1').on('click', 'tr', function() {
        $('#iddelete2').text($('#example1').DataTable().row(this).id());
    });

    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>

<!-- for Cannot read properties of undefined (reading 'data') -->