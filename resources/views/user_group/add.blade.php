@extends('layouts.app')

@section('title', 'Add New User Group')

@section('content')

    <div class="container">

        <h3>Add New User Group</h3>

        <div class="row">
            <form method="post" action="{{ route('saveUserGroup') }}">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="group_name">Group Name</label>
                                <input type="text" required id="group_name" name="group_name" class="form-control"
                                    value="{{ old('group_name') }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control tinymce_textarea">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price (numeric only)</label>
                                <input type="text" required id="price" name="price" class="form-control"
                                    value="{{ old('price', 0) }}"> <br>
                                <p class="alert alert-warning">
                                    Free version doesn't support payment gateway. <br>
                                    Create free group (with zero price) or <a href="">Upgrade version</a>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="valid_for_days">Valid for days, 0 = unlimited</label>
                                <input type="text" required id="valid_for_days" name="valid_for_days"
                                    class="form-control" value="{{ old('valid_for_days', 0) }}">
                            </div>

                            <button class="btn btn-default" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    @push('scripts')
        <script>
            tinymce.init({
                selector: '.tinymce_textarea',
                height: 300,
                promotion: false,
                branding: false,
                menubar: 'file edit insert view format table tools',
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste help wordcount emoticons codesample'
                ],
                toolbar: 'undo redo | blocks | bold italic | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image | ' +
                    'print preview fullscreen forecolor backcolor emoticons codesample help',
                toolbar_mode: 'sliding',

                images_upload_credentials: true,
                automatic_uploads: true,

                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save(); // syncs HTML back into the underlying <textarea> before form submit
                    });
                }
            });
        </script>
    @endpush

@endsection
