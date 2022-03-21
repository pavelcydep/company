<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Datatable Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ваш API-ключ>" type="text/javascript"></script>
    <script src="placemark.js" type="text/javascript"></script>


</head>

<body>



<div class="container">

    <a class="btn btn-success" href="javascript:void(0)" id="createNewBook">Новая компания</a>
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Laravel 8 Datatable Example</strong></h3>
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
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Логотип</label>
                        <div class="col-sm-12">
                            <textarea id="logo" name="logo" required="" placeholder="Logo" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Адрес</label>
                        <div class="col-sm-12">
                            <textarea id="logo" name="addres" required="" placeholder="addres" class="form-control"></textarea>
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
<script type="text/javascript">
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

<script type="text/javascript">
        // Инициализация карты
        ymaps.ready(init);
 
        function init() {
    var myMap = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        }),

    // Создаем геообъект с типом геометрии "Точка".
        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [55.8, 37.8]
            },
          
        });
       
    myMap.geoObjects
        .add(myGeoObject)
        .add(myPieChart)
        .add(new ymaps.Placemark([55.684758, 37.738521], {
            balloonContent: 'Beahan, Baumbach and Tremblay'
        }, {
            preset: 'islands#dotIcon',
        }))
        .add(new ymaps.Placemark([55.833436, 37.715175], {
            balloonContent: 'Moen Inc'
        }, {
            preset: 'islands#dotIcon',
            iconColor: '#735184'
        }))
        .add(new ymaps.Placemark([55.687086, 37.529789], {
            balloonContent: 'цвет <strong>влюбленной жабы</strong>'
        }, {
            preset: 'islands#dotIcon',
            iconColor: '#735184'
        }))
        .add(new ymaps.Placemark([55.782392, 37.614924], {
            balloonContent: 'цвет <strong>детской неожиданности</strong>'
        }, {
            preset: 'islands#circleDotIcon',
            iconColor: 'yellow'
        }))
        .add(new ymaps.Placemark([55.642063, 37.656123], {
            balloonContent: 'цвет <strong>красный</strong>'
        }, {
            preset: 'islands#redSportIcon'
        }))
        .add(new ymaps.Placemark([55.826479, 37.487208], {
            balloonContent: 'цвет <strong>фэйсбука</strong>'
        }, { preset: 'islands#blackStretchyIcon',
            preset: 'islands#governmentCircleIcon',
            iconColor: '#3b5998',
     

        }))
        .add(new ymaps.Placemark([55.694843, 37.435023], {
            balloonContent: 'цвет <strong>носика Гены</strong>',
            iconCaption: 'Очень длиннный, но невероятно интересный текст'
        }, {
            preset: 'islands#greenDotIconWithCaption'
        }))
        .add(new ymaps.Placemark([55.790139, 37.814052], {
            balloonContent: 'цвет <strong>голубой</strong>',
            iconCaption: 'Очень длиннный, но невероятно интересный текст'
        }, {
            preset: 'islands#blueCircleDotIconWithCaption',
            iconCaptionMaxWidth: '50'
        }));
}

          
    
    </script>
  <style>
           /*Размер карты*/
           #map { width:100%;height:500px }
           /*Отображение карты в черно-белом цвете */
           .ymaps-glass-pane, .ymaps-layers-pane {filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale") !important;
    /* Firefox 3.5+ Chrome 19+ & Safari 6+ */
    -webkit-filter: grayscale(100%) !important;  
}
    </style>


     
    
     </body>
</html>