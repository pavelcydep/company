
@extends('layouts.main')
@section('content')


<div class="container">
<a href="{{url('/users')}}" class="btn btn-success" >Сотрудники</a>
<a href="{{url('/map')}}" class="btn btn-success" >Карта</a>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewBook">Добавить компанию</a>
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Компании</strong></h3>
                </div>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th width="50">No</th>
                        <th>Компания</th>
                        <th>Email</th>
                        <th>Адрес</th>
                        <th>Логотип</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="bookForm" name="bookForm" class="form-horizontal">
                   <input type="hidden" name="book_id" id="book_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Компания</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Компания" value="" maxlength="50" required="">
                          </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Логотип</label>
                        <div class="col-sm-12">
                            <textarea id="logo" name="logo" required="" placeholder="Логотип" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Адрес</label>
                        <div class="col-sm-12">
                            <textarea id="addres" name="addres" required="" placeholder="адрес" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Сохранить
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

<script>
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

</script>
@endsection
