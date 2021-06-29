<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

{{--Add Student Modal  --}}
<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <ul id="saveform_errlist"></ul>

        <div class="form group mb-3">
            <label for="">Student Name</label>
            <input type="text" class="name form-control">
        </div>
        <div class="form group mb-3">
            <label for="">Email</label>
            <input type="email" class="email  form-control">
        </div>

        <div class="form group mb-3">
            <label for="">Phone</label>
            <input type="number" class="phone form-control">
        </div>
        <div class="form group mb-3">
            <label for="">Course</label>
            <input type="text" class="course form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_student">Save</button>
      </div>
    </div>
  </div>
</div>
{{-- End Add Student modal --}}

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-header">
                    <h4>Student Data
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddStudentModal" class="btn btn-primary float-end btn-sm">Add Student</a>
                    </h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $(document).on('click','.add_student',function (e){
            e.preventDefault();
            var data={
                'name':$('.name').val(),
                'email':$('.email').val(),
                'phone':$('.phone').val(),
                'course':$('.course').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"/students",
                data:data,
                dataType:"json",
                success:function (response){
                    // console.log(response.errors.name);
                    if (response.status==400){
                        $('#saveform_errlist').html("");
                        $('#saveform_errlist').addClass('alert alert-danger');
                        $.each(response.errors,function (key,err_values){
                            $('#saveform_errlist').append('<li>'+err_values+'</li>')
                        });
                    }
                    else {
                        $('#saveform_errlist').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)
                        $('#AddStudentModal').modal('hide');
                        $('#AddStudentModal').find('input').val("");
                    }
                }
            });
        });
    });
</script>

</body>
</html>



