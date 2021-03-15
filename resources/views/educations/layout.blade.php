.
<!DOCTYPE html>

<html>

<head>
    <title>Laravel7 CRUD @fahmidasclassroom.com</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>
<script>
    $(document).ready(function () {
        /* When click New customer button */
        $('#new-education').click(function () {
            $('#btn-save').val("create-education");
            $('#education').trigger("reset");
            $('#educationCrudModal').html("Add New Education");
            $('#crud-modal').modal('show');
        });

        /* Show customer */
        $('body').on('click', '#show-education', function () {
            $('#educationCrudModal-show').html("Eduaction Details");
            $('#crud-modal-show').modal('show');
        });

        /* Edit customer */
        $('body').on('click', '#edit-education', function () {
            var education_id = $(this).data('id');
            $.get('educations/' + education_id + '/edit', function (data) {
                $('#educationCrudModal').html("Edit education");
                $('#btn-update').val("Update");
                $('#btn-save').prop('disabled', false);
                $('#crud-modal').modal('show');
                $('#edu_id').val(data.id);
                $('#sekolah').val(data.sekolah);
                $('#jurusan').val(data.jurusan);
                $('#tahun_masuk').val(data.tahun_masuk);
                $('#tahun_lulus').val(data.tahun_lulus);
            })
        });

        /* Delete customer */
        $('body').on('click', '#delete-education', function () {
            var education_id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "educations/" +
                    education_id,
                data: {
                    "id": education_id,
                    "_token": token,
                },
                success: function (data) {
                    $('#msg').html('Education entry deleted successfully');
                    $("#education_id_" + education_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

    $(document).ready(function () {

        /* When click New customer button */
        $('#new-experience').click(function () {
            $('#btn-save').val("create-experience");
            $('#experience').trigger("reset");
            $('#experienceCrudModal').html("Add New Experience");
            $('#crud-modal-experience').modal('show');
        });

        /* Show customer */
        $('body').on('click', '#show-experience', function () {
            $('#experienceCrudModal-show').html("Experience Details");
            $('#crud-modal-show-experience').modal('show');
        });

        /* Edit customer */
        $('body').on('click', '#edit-experience', function () {
            var experience_id = $(this).data('id');
            $.get('experiences/' + experience_id + '/edit', function (data) {
                $('#experienceCrudModal').html("Edit experience");
                $('#btn-update').val("Update");
                $('#btn-save').prop('disabled', false);
                $('#crud-modal-experience').modal('show');
                $('#exp_id').val(data.id);
                $('#perusahaan').val(data.perusahaan);
                $('#jabatan').val(data.jabatan);
                $('#tahun').val(data.tahun);
            })
        });

        /* Delete customer */
        $('body').on('click', '#delete-experience', function () {
            var experience_id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "experiences/" +
                    experience_id,
                data: {
                    "id": experience_id,
                    "_token": token,
                },
                success: function (data) {
                    $('#msg').html('Experience entry deleted successfully');
                    $("#experience_id_" + experience_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

</script>

</html>
