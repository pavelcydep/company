window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
});
$(function () {
  var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('company.index') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'company', name: 'company'},
          {data: 'email', name: 'email'},
          {data: 'logo', name: 'logo'},
          {data: 'addres', name: 'addres'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});


$('#createNewBook').click(function () {
      $('#saveBtn').val("Сохранить");
      $('#book_id').val('');
      $('#bookForm').trigger("reset");
      $('#modelHeading').html("Добавить компанию");
      $('#ajaxModel').modal('show');
  });
  $('body').on('click', '.edit', function () {
    var book_id = $(this).data('id');
    $.get("{{ url('/company') }}" +'/' + book_id +'/edit' , function (data) {
        $('#modelHeading').html("Изменить компанию");
        $('#saveBtn').val("Изменить");
        $('#ajaxModel').modal('show');
        $('#book_id').val(data.id);
        $('#company').val(data.company);
        $('#email').val(data.email);
        $('#logo').val(data.logo);
        $('#addres').val(data.addres);
       

    })
 });
  $('#saveBtn').click(function (e) {
      e.preventDefault();
      $(this).html('Save');

      $.ajax({
        data: $('#bookForm').serialize(),
        url: "{{ route('company.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {

            $('#bookForm').trigger("reset");
            $('#ajaxModel').modal('hide');
            table.draw();

        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
    });
  });




$('body').on('click', '.delete', function () {

var book_id = $(this).data("id");
confirm("Are You sure want to delete !");


$.ajax({
  type: "DELETE",
  url: "{{ (url('/company')) }}"+'/'+book_id+'/destroy',
  success: function (data) {
      table.draw();
  },
  error: function (data) {
      console.log('Error:', data);
  }
});
});