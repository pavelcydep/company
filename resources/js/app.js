/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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





window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
