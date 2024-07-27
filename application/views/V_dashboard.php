<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php if ($this->session->userdata('level') == 1) { ?><button class="btn btn-primary" data-toggle="modal" data-target="#modal_default" onclick="view_modal('1','Tambah')" href="#">
        <i class="fa fa-plus"></i> Tambah Data
      </button><?php } ?>
    <div class="row">
      <div class="col-md-3">
        <div class="sticky-top mb-3">
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body p-0">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Tanggal</th>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Keterangan</th>
                  </td><?php if ($this->session->userdata('level') == 1) { ?>
                    <th>Aksi</th><?php } ?>
                </tr>
              </thead>
              <?php
              $no = 1;
              foreach ($jadwal as $value) {
              ?>
                <tbody>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value->tanggal ?></td>
                    <td><?= $value->hari ?></td>
                    <td><?= $value->waktu ?></td>
                    <td><?= $value->keterangan ?></td><?php if ($this->session->userdata('level') == 1) { ?>
                      <td>
                        <button data-id="<?= $value->id; ?>" class="btn btn-primary btn-sm konfirmasiEdit" data-toggle="modal" data-target="#modal_default"><i class="fas fa-edit"></i></button>
                        <button data-id="<?= $value->id; ?>" class="btn btn-danger btn-sm konfirmasiHapus" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></button>
                      </td><?php } ?>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

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
            <input type="text" class="form-control" id="id" name="id" hidden>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
              <input type="text" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal" placeholder="Isi tanggal" />
              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="hari">Hari</label>
            <input type="text" class="form-control" id="hari" placeholder="Isi hari" name="hari">
          </div>
          <div class="form-group">
            <label for="waktu">Waktu</label>
            <input type="text" class="form-control" id="waktu" placeholder="Isi waktu" name="waktu">
          </div>
          <div class="form-group">
            <label for="keterangan">keterangan</label>
            <textarea class="form-control" id="keterangan" placeholder="Isi keterangan" name="keterangan"></textarea>
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
        <label id="iddelete2" hidden> </label> <label id="iddelete" hidden> </label> Apakah ingin hapus ?
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
  function view_modal(id, status) {

    if (status == "Tambah") {

      $('#exampleModalLabel').text('Tambah Data'); // name view
      $('#quickForm')[0].reset(); // reset form textbox
      $("#id").val(null).trigger("change"); // reset select filter
      $('#btnsubmit').text('Tambah'); // name Save
      document.getElementById("btnsubmit").style.visibility = "visible"; // Visible button   \

    } else {
      $('#quickForm')[0].reset(); // reset form

      var id = id;

      // Ajax isi data
      $.ajax({
        url: "<?php echo base_url('C_Dashboard/ajax_getbynin') ?>",
        method: "get",
        dataType: "JSON",
        data: {
          id: id,
        },
        success: function(data) {
          // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
          $('#id').val(data.id);
          $('#tanggal').val(data.tanggal);
          $('#hari').val(data.hari);
          $('#waktu').val(data.waktu);
          $('#keterangan').val(data.keterangan);

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

    fdata.append("id", $('#id').val());
    // Form data collect name value
    var form_data = $('#quickForm').serializeArray();
    $.each(form_data, function(key, input) {
      fdata.append(input.name, input.value);
    });


    // Simpan or Update data          
    var vurl;
    if ($trigger == "Tambah") {
      vurl = "<?php echo base_url('C_Dashboard/ajax_add') ?>";
    } else {
      vurl = "<?php echo base_url('C_Dashboard/ajax_update') ?>";
    }

    $.ajax({
      url: vurl,
      method: "post",
      processData: false,
      contentType: false,
      data: fdata,
      beforeSend: function() {

      },
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
    fdata.append('id', $('#iddelete').text());


    vurl = "<?php echo base_url('C_Dashboard/ajax_delete') ?>";

    // Post data
    $.ajax({
      url: vurl,
      method: "post",
      processData: false,
      contentType: false,
      data: fdata,

      success: function(data) {
        location.reload();

        $('#modal-delete').modal('hide');

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
</script>

<script>
  $(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0 //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        console.log(eventEl);
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
      header: {
        left: 'prev,next today',
        cIsi: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      'themeSystem': 'bootstrap',
      //Random default events
      events: [{
          title: 'JADWAL BANK SAMPAH',
          start: new Date(y, m, 6),
          backgroundColor: '#f56954', //red
          borderColor: '#f56954', //red
          allDay: true
        },
        {
          title: 'JADWAL BANK SAMPAH',
          start: new Date(y, m, 13),
          backgroundColor: '#f56954', //red
          borderColor: '#f56954', //red
          allDay: true
        },
        {
          title: 'JADWAL BANK SAMPAH',
          start: new Date(y, m, 20),
          backgroundColor: '#f56954', //red
          borderColor: '#f56954', //red
          allDay: true
        },
        {
          title: 'JADWAL BANK SAMPAH',
          start: new Date(y, m, 27),
          backgroundColor: '#f56954', //red
          borderColor: '#f56954', //red
          allDay: true
        },

      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function(e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color': currColor
      })
    })
    $('#add-new-event').click(function(e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color': currColor,
        'color': '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      ini_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
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