@extends('layouts.app')

@section('title', 'Add New Question')

@section('content')

    <div class="container">

        <h3>Add New</h3>

        <div class="row">
            <form method="post" id="qf" action="">
                @csrf

                <div class="col-md-12">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                Multiple Choice Single Answer
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

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paragraph">Paragraph : English</label>
                                    <textarea id="paragraph" name="paragraph" class="form-control tinymce_textarea"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="question">Question : English</label>
                                    <textarea id="question" name="question" class="form-control tinymce_textarea"></textarea>
                                    <br>

                                    <span style="color:red; font-size:12px;">
                                        <a href="javascript:toogleuperror();">Getting error while uploading image?</a> "The
                                        upload path does not appear to be valid"
                                    </span>
                                    <div style="display:none;" id="uperror">
                                        Go to 'My_Savsoft_Quiz_Folder*/editor/plugins/jbimages/' Open config.php. at line
                                        number 41 update <b>savsoftquiz_v5_enterprise</b> with
                                        <b>My_Savsoft_Quiz_Folder</b><br>
                                        Note: Here My_Savsoft_Quiz_Folder is the folder name where you installed/uploaded
                                        savsoft quiz files. if its done in root folder of domain then remove
                                        'savsoftquiz_v5_enterprise/' from path.
                                    </div>
                                    <script>
                                        function toogleuperror() {
                                            $('#uperror').toggle();
                                        }
                                    </script>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description">Description : English</label>
                                    <textarea id="description" name="description" class="form-control tinymce_textarea"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Options 1) : English</label> <br>

                                        <input type="radio" name="score" value="1"
                                            {{ old('score') == 1 ? 'checked' : '' }}>
                                        Select Correct Option
                                        <br>

                                        <textarea name="option1" class="form-control"></textarea>
                                    </div>
                                </div>
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
