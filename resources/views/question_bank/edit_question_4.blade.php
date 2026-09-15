@extends('layouts.app')

@section('title', 'Edit Question')

@section('content')

    <div class="container">

        <h3>Edit Question</h3>

        <div class="row">
            <form method="post" action="">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                Short Answer
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
                                <label for="answer">Answer in one or two words (comma separated for multiple
                                    possibilities.) Not case sensitive</label> <br>
                                <input type="text" id="answer" name="option[]" class="form-control" value="">
                            </div>

                            <button class="btn btn-default" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>

            <div class="col-md-3">
                <div class="form-group">
                    <table class="table table-bordered">
                        <tr>
                            <td>No. of Times Correct</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>No. of Times Incorrect</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>No. of Times Unattempted</td>
                            <td>0</td>
                        </tr>
                    </table>
                </div>
            </div>
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
