@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Product</h4>
                {{ Form::open(['url' => '/admin/blog/posts/' . $post->id , 'method' => 'POST', 'class' => 'needs-validation', 'files' => true]) }}
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="name">Post title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value=""
                               required>
                        <div class="invalid-feedback">
                            Valid post title is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="name">Post description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder=""
                               value="" required>
                        <div class="invalid-feedback">
                            Valid post description is required.
                        </div>
                    </div>
                </div>

                <div class="row" style="width: 2000px">
                    <div class="col-md-5 mb-3">
                        <label for="name">Post content</label>
                        <textarea name="content"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 order-md-1">
                        <div class="mb-3">
                            <label for="name">Main post image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="mainImage" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Insert post</button>
                {{Form::close()}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.tiny.cloud/1/92nng51shtkxlrohcgkt8tvph3k5zk5vod056smrpjz2a64e/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';

            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
