<div class="card">
    <div class="card-header">
        <?php if ($this->session->userdata('level') == 1) { ?><button class="btn btn-primary" data-toggle="modal" data-target="#modal_default" onclick="view_modal('1','Tambah')" href="#">
                <i class="fa fa-plus"></i> Tambah Data
            </button><?php } ?>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="setor_sampah" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">ID Sampah</th>
                    <th style="width: 10%;">Jenis Sampah</th>
                    <th style="width: 5%;">Satuan</th>
                    <th style="width: 7%;">Harga</th>
                    <th style="width: 35%;">Deskripsi</th>
                    <?php if ($this->session->userdata('level') == 1) { ?> <th style="width: 15%;">Aksi</th><?php } ?>

                </tr>
            </thead>
            <?php
            $no = 1;
            foreach ($item as $value) {
            ?>

                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->id_sampah ?></td>
                        <td><?= $value->jenis_sampah ?></td>
                        <td><?= $value->satuan ?></td>
                        <td>Rp. <?= number_format($value->harga,  0, ',', '.')  ?></td>
                        <td><?= $value->deskripsi ?></td> <?php if ($this->session->userdata('level') == 1) { ?>
                            <td>
                                <button data-id="<?= $value->id_sampah; ?>" class="btn btn-primary btn-sm konfirmasiEdit" data-toggle="modal" data-target="#modal_default"><i class="fas fa-edit"></i></button>
                                <button data-id="<?= $value->id_sampah; ?>" class="btn btn-danger btn-sm konfirmasiHapus" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></button>
                            </td><?php } ?>
                    </tr>
                </tbody>
            <?php } ?>
            
        </table>
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
                    <form role="form" id="quickForm" method="POST" >
                        <div class="form-group">
                            <label for="jenis_sampah">ID Sampah</label>
                            <input type="text" class="form-control" id="id_sampah" placeholder="Isi ID sampah" name="id_sampah">
                        </div>
                        <div class="form-group">
                            <label for="jenis_sampah">Jenis Sampah</label>
                            <input type="text" class="form-control" id="jenis_sampah" placeholder="Isi jenis sampah" name="jenis_sampah">
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control" id="satuan" placeholder="Isi satuan" name="satuan">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" placeholder="Isi harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" placeholder="Isi deskripsi" name="deskripsi"></textarea>
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
            <div class="modal-content ">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">PERINGATAN !!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label id="iddelete2" hidden> </label>Apakah ingin hapus <label id="iddelete"> </label> ?
                </div>

                <div class="modal-footer justify-content-between ">
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

                    // Ajax update data
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
    function view_modal(id_sampah1, status) {

        if (status == "Tambah") {

            $('#exampleModalLabel').text('Tambah Data'); // name view
            $('#quickForm')[0].reset(); // reset form textbox
            $("#id_sampah").val(null).trigger("change"); // reset select filter
            $('#btnsubmit').text('Tambah'); // name Save
            document.getElementById("btnsubmit").style.visibility = "visible"; // Visible button   
            //Ajax kosongkan data

        } else {
            $('#quickForm')[0].reset(); // reset form

            var id_sampah = id_sampah1;

            // Ajax isi data
            $.ajax({
                url: "<?php echo base_url('C_Sampah/ajax_getbynin') ?>",
                method: "get",
                dataType: "JSON",
                data: {
                    id_sampah: id_sampah,
                },
                success: function(data) {
                    // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
                    $('#id_sampah').val(data.id_sampah);
                    $('#jenis_sampah').val(data.jenis_sampah);
                    $('#satuan').val(data.satuan);
                    $('#harga').val(data.harga);
                    $('#deskripsi').val(data.deskripsi);

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
                $('#exampleModalLabel').text('Ubah Data'); //name view modal update(revise procedure)
                $('#btnsubmit').text('Ubah'); //button name  
                document.getElementById("btnsubmit").style.visibility = "visible";
                document.getElementById("id_sampah").setAttribute('disabled', true);
                document.getElementById("nin").setAttribute('disabled', true);
            }
        }
    }
</script>


<script type="text/javascript">
    function Simpan_data($trigger) {

        // Form data
        var fdata = new FormData();

        fdata.append("id_sampah", $('#id_sampah').val());
        // Form data collect name value
        var form_data = $('#quickForm').serializeArray();
        $.each(form_data, function(key, input) {
            fdata.append(input.name, input.value);
        });


        // Simpan or Update data          
        var vurl;
        if ($trigger == "Tambah") {
            vurl = "<?php echo base_url('C_Sampah/ajax_add') ?>";
        } else {
            vurl = "<?php echo base_url('C_Sampah/ajax_update') ?>";
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

        // Delete by id_sampah
        fdata.append('id_sampah', $('#iddelete').text());
        // Url Post delete
        vurl = "<?php echo base_url('C_Sampah/ajax_delete') ?>";

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
    //  id_sampah selected konfirmasiHapus
    $(document).on("click", ".konfirmasiHapus", function() {
        $('#iddelete').text($(this).attr("data-id"));
    })

    //  id_sampah selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiEdit", function() {
        view_modal($(this).attr("data-id"), 'Edit');

    })

    //  id_sampah selected  konfirmasiView
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
    }
</script>

<!-- for Cannot read properties of undefined (reading 'data') -->