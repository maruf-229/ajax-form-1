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

{{--Edit modal--}}
<div class="modal fade" id="EditStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit and Update Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errlist"></ul>

                <input type="hidden" id="edit_stud_id">

                <div class="form group mb-3">
                    <label for="">Student Name</label>
                    <input type="text" id="edit_name" class="name form-control">
                </div>
                <div class="form group mb-3">
                    <label for="">Email</label>
                    <input type="email" id="edit_email" class="email  form-control">
                </div>

                <div class="form group mb-3">
                    <label for="">Phone</label>
                    <input type="number" id="edit_phone" class="phone form-control">
                </div>
                <div class="form group mb-3">
                    <label for="">Course</label>
                    <input type="text" id="edit_course" class="course form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_student">Update</button>
            </div>
        </div>
    </div>
</div>
{{--End Edit modal--}}

{{--Delete modal--}}
<div class="modal fade" id="DeleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_stud_id">
                <h4>Are You Sure You Want To Delete This Data ???</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete_student_btn">Yes,Delete</button>
            </div>
        </div>
    </div>
</div>
{{--end del modal--}}

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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Namr</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        fetchStudent();
        function fetchStudent(){
            $.ajax({
                type:"GET",
                url:"/fetch-students",
                dataType:"json",
                success:function (response){
                    // console.log(response.students)
                    $('tbody').html("");
                    $.each(response.students,function (key,item){
                        $('tbody').append(
                           '<tr>\
                                <td>'+item.id+'</td>\
                                <td>'+item.name+'</td>\
                                <td>'+item.email+'</td>\
                                <td>'+item.phone+'</td>\
                                <td>'+item.course+'</td>\
                                <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary btn-sm">Editt</button></td>\
                                <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                            </tr>'
                        );
                    });
                }
            });
        }

        $(document).on('click','.delete_student',function (e) {
            e.preventDefault();
            let stud_id=$(this).val();
            // alert(stud_id);
            $('#delete_stud_id').val(stud_id);
            $('#DeleteStudentModal').modal('show');
        });

        $(document).on('click','.delete_student_btn',function (e) {
            e.preventDefault();
            let stud_id=$('#delete_stud_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"/delete-student/"+stud_id,
                success:function (response){
                    // console.log(response);
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#DeleteStudentModal').modal('hide');
                    fetchStudent();
                }
            });
        });







        $(document).on('click','.edit_student',function (e) {
            e.preventDefault();
            let stud_id=$(this).val();
            // console.log(stud_id);
            $('#EditStudentModal').modal('show');
            $.ajax({
                type:"GET",
                url:"/edit-student/"+stud_id,
                // dataType:"json",
                success:function (response){
                    // console.log(response);
                    if (response.status==404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                    else {
                        $('#edit_name').val(response.student.name);
                        $('#edit_email').val(response.student.email);
                        $('#edit_phone').val(response.student.phone);
                        $('#edit_course').val(response.student.course);
                        $('#edit_stud_id').val(stud_id);
                    }
                }
            });
        });

        $(document).on('click','.update_student',function (e) {
            e.preventDefault();

            // $(this).text("Updating");

            let stud_id=$('#edit_stud_id').val();
            let data={
                'name':$('#edit_name').val(),
                'email':$('#edit_email').val(),
                'phone':$('#edit_phone').val(),
                'course':$('#edit_course').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"PUT",
                url:"/update-student/"+stud_id,
                data:data,
                dataType:"json",
                success:function (response){
                    // console.log(response)
                    if (response.status==400){
                        $('#updateform_errlist').html("");
                        $('#updateform_errlist').addClass('alert alert-danger');
                        $.each(response.errors,function (key,err_values){
                            $('#updateform_errlist').append('<li>'+err_values+'</li>')
                        });

                        // $('update_student').text("Update");

                    }else if (response.status==404){
                        $('#updateform_errlist').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)
                        // $('update_student').text("Update");
                    }
                    else {
                        $('#updateform_errlist').html("");
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)

                        $('#EditStudentModal').modal('hide');
                        // $('update_student').text("Update");
                        fetchStudent();
                    }
                }
            });
        });




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
                        $('#saveform_errlist').html("");
                        $('#AddStudentModal').modal('hide');
                        $('#AddStudentModal').find('input').val("");
                        fetchStudent();
                    }
                }
            });
        });
    });
</script>

</body>
</html>



