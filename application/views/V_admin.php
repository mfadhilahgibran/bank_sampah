<div class="card">
    <div class="card-header">
        <?php if ($this->session->userdata('level') == 1) { ?><button class="btn btn-primary" data-toggle="modal" data-target="#modal_default" onclick="view_modal('1','Tambah')" href="#">
                <i class="fa fa-plus"></i> Tambah Data
            </button><?php } ?>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="nasabah" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIA</th>
                    <th>Kata Sandi</th>
                    <th>Nama</th>
                    <th>RT</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Email</th>

                    <?php if ($this->session->userdata('level') == 1) { ?>
                        <th>Aksi</th><?php } ?>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($admin as $nb) { ?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $nb->nia ?></td>
                        <td><?= $nb->password ?></td>
                        <td><?= $nb->nama ?></td>
                        <td><?= $nb->rt ?></td>
                        <td><?= $nb->alamat ?></td>
                        <td><?= $nb->telepon ?></td>
                        <td><?= $nb->email ?></td>

                        </td><?php if ($this->session->userdata('level') == 1) { ?>
                            <td>
                                <button data-id="<?= $nb->nia; ?>" class="btn btn-primary btn-sm konfirmasiEdit" data-toggle="modal" data-target="#modal_default"><i class="fas fa-edit"></i></button>
                                <button data-id="<?= $nb->nia; ?>" class="btn btn-danger btn-sm konfirmasiHapus" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></button>

                            </td><?php } ?>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
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
                            <label for="nia">NIA</label>
                            <input type="text" class="form-control" id="nia" placeholder="Isi NIA" name="nia">
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
                    <!-- <button type="submit" class="btn btn-primary" id="btnsubmit" onclick="Tambah_data()">Tambah</button> -->
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

                //berhasil( "Form successful submitted!" );
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
                // Ajax Ubah data
                Simpan_data("Ubah");
            } else {
                berhasil(status);
            }
        });
    });
</script>

<script type="text/javascript">
    /// @note Untuk Add,Edit,delete.
    function view_modal(nia1, status) {

        if (status == "Tambah") {

            $('#exampleModalLabel').text('Tambah Data'); // name view
            $('#quickForm')[0].reset(); // reset form textbox
            $("#nia").val(null).trigger("change"); // reset select filter
            $('#btnsubmit').text('Tambah'); // name Save
            document.getElementById("btnsubmit").style.visibility = "visible"; // Visible button          
            document.getElementById("nia").removeAttribute('disabled');
            //Ajax kosongkan data

        } else {
            $('#quickForm')[0].reset(); // reset form

            var nia = nia1;

            // Ajax isi data
            $.ajax({
                url: "<?php echo base_url('C_Admin/ajax_getbyno_induk') ?>",
                method: "get",
                dataType: "JSON",
                data: {
                    nia: nia,
                },
                success: function(data) {
                    // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
                    $('#nia').val(data.nia);
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
            if (status == "Lihat") {
                document.getElementById("btnsubmit").style.visibility = "hidden";
                $('#exampleModalLabel').text('View Data'); //name view modal add            
            } else {
                $('#exampleModalLabel').text('Ubah Data'); //name view modal update(revise procedure)
                $('#btnsubmit').text('Ubah'); //button name  
                document.getElementById("btnsubmit").style.visibility = "visible";
                document.getElementById("nia").setAttribute('disabled', true);
            }
        }
    }
</script>


<script type="text/javascript">
    function Simpan_data($trigger) {


        // Form data
        var fdata = new FormData();


        // Form data collect


        fdata.append("nia", $('#nia').val());
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
            vurl = "<?php echo base_url('C_Admin/ajax_add') ?>";
        } else {
            vurl = "<?php echo base_url('C_Admin/ajax_update') ?>";
        }

        $.ajax({
            url: vurl,
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

        // Form data
        var fdata = new FormData();

        // Delete by nia
        fdata.append('nia', $('#iddelete').text());
        // Url Post delete
        vurl = "<?php echo base_url('C_Admin/ajax_delete') ?>";

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
                // Pesan berhasil

            },
            error: function(e) {
                //Pesan Gagal
                gagal(e);
            }
        });

    }
</script>



<script type="text/javascript">
    //  nia selected konfirmasiHapus
    $(document).on("click", ".konfirmasiHapus", function() {
        $('#iddelete').text($(this).attr("data-id"));
    })

    //  nia selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiEdit", function() {
        view_modal($(this).attr("data-id"), 'Ubah');

    })

    //  nia selected  konfirmasiView
    $(document).on("click", ".konfirmasiView", function() {
        view_modal($(this).attr("data-id"), 'Lihat');
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