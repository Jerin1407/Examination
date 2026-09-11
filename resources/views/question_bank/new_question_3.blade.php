@extends('layouts.app')

@section('title', 'Add New Question')

@section('content')

    <div class="container">

        <h3>Add New</h3>

        <div class="row">
            <form method="post" id="qf" action="">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                Match the Column
                            </div>

                            <div class="form-group">
                                <label for="cid">Select Category</label>
                                <select class="form-control" name="cid" id="cid">
                                    <option value="">category_name</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lid">Select Level</label>
                                <select class="form-control" name="lid" id="lid">
                                    <option value="">level_name</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paragraph">Paragraph</label>
                                <textarea id="paragraph" name="paragraph" class="form-control tinymce_textarea"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea id="question" name="question" class="form-control tinymce_textarea"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control tinymce_textarea"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Options 1)</label> <br>
                                <input type="text" name="option[]" value="">
                                =
                                <input type="text" name="option2[]" value="">
                            </div>

                            <input type="hidden" name="parag" id="parag" value="0">
                            <button class="btn btn-default" type="submit">Submit</button>

                            <button class="btn btn-default" type="button" onclick="javascript:parags();">Submit & Add new
                                with same paragraph</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
        function parags() {
            $('#parag').val('1');
            $('#qf').submit();
        }
    </script>

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
