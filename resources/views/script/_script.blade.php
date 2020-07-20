<script type="text/javascript">
    $('.progress').hide();

    //All Image List
    $(function allImage() {
        $.ajax({
            type: "GET",
            url: "{{route('all-image')}}",
            success: function (response) {
                let allImage = '';
                $.each(response.data, function (k, imageData) {
                    allImage += @include('script.content')
                });
                $('#all-images').append(allImage);
            },
            error: function (e) {
                var errors = e.responseJSON;
                errorsHtml = '<div class="alert alert-danger alert-dismissible fade show">';
                $.each(errors.errors, function (k, v) {
                    errorsHtml += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
                    errorsHtml += '<strong>' + 'Errors !' + '</strong>' + v;
                });
                errorsHtml += '</div>';
                $('#error_message').html(errorsHtml);
            }
        });
    });

    //Image Remove
    function removeImage(id) {
        swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{route('image-remove')}}",
                    type: "POST",
                    data: {
                        image_id: id,
                    },
                    success: function (response) {
                        $('#remove_' + response.image_id).remove();
                        console.log(response);
                    },
                    error: function (data) {
                        console.log("Error: ", data);
                    }

                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }


    // Image Upload
    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        if (!form.image.value) {
            alert('File not found');
            return false;
        }
    }

    (function () {
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $('form').ajaxForm({
            beforeSubmit: validate,
            beforeSend: function () {
                $('.progress').show();
                status.empty();
                var percentVal = '0%';
                var posterValue = $('input[name=file]').fieldValue();
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function (response) {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);

                let allImage = '';
                let imageData = response.data[0];
                allImage += @include('script.content')
                $('#all-images').prepend(allImage);

                $('#image-save').trigger("reset");
                //$("#image-add .close").click();
                $(".dropify-clear").trigger("click");

                errorsHtml = '<div class="alert alert-success alert-dismissible fade show">';
                errorsHtml += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
                errorsHtml += '<strong>' + 'Success!' + '</strong>' + response.message;
                errorsHtml += '</div>';
                $('#success_message').html(errorsHtml);

            },
            complete: function (response) {
               // console.log(response);
            },error: function (e) {
                var errors = e.responseJSON;
                errorsHtml = '<div class="alert alert-danger alert-dismissible fade show">';
                $.each(errors.errors, function (k, v) {
                    errorsHtml += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
                    errorsHtml += '<strong>' + 'Errors !' + '</strong>' + v;
                });
                errorsHtml += '</div>';
                $('#error_message').html(errorsHtml);
            }
        });
    })();

    //Image Title Filter
    function imageTitleFilter() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();

        ul = document.getElementById("all-images");
        li = ul.getElementsByClassName('thumb');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            title = li[i].getElementsByTagName("p")[0];
            txtValue = title.textContent || title.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
