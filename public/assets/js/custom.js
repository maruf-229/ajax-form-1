$(document).ready(function() {
    fetchStudent();
    $('.add_student').on('click', function(e) {
        e.preventDefault();
        // alert('heda');
        let check = userHasUploadedImage();
        if (check) {
            let myForm = document.getElementById('addPostForm');
            let formData = new FormData(myForm);
            console.log(formData);
            uploadPost(formData);
        }
    });
});

// Save post
function uploadPost(formData) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


}



// validate image
function userHasUploadedImage() {
    let check = true;
    let file = $('#image').get(0).files[0];
    // console.log(file);
    if (file == undefined || file == null) {
        check = false;
        handleErrors();
        return check;
    }
    handleErrors();
    return check;
}

function handleErrors() {
    let file = $('#image').get(0).files[0];
    if (file == undefined || file == null) {
        $('#error_image').show();
    } else {
        $('#error_image').hide();
    }
}

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
                                <td>'+item.image+'</td>\
                                <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary btn-sm">Editt</button></td>\
                                <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                            </tr>'
                );
            });
        }
    });
}
