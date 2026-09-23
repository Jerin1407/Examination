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
                                    <option value="0">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->cid }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lid">Select Level</label>
                                <select class="form-control" name="lid" id="lid">
                                    <option value="0">Select Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->lid }}">
                                            {{ $level->level_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($withParagraph ?? false)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="paragraph">Paragraph : English</label>
                                        <textarea id="paragraph" name="paragraph" class="form-control tinymce_textarea"></textarea>
                                    </div>
                                </div>
                            @endif

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
                                @for ($i = 1; $i <= ($nop ?? 4); $i++)
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Options {{ $i }}) : English</label> <br>

                                            <input type="radio" name="score" value="{{ $i }}"
                                                {{ old('score') == $i ? 'checked' : '' }}>
                                            Select Correct Option
                                            <br>

                                            <textarea name="option{{ $i }}" class="form-control tinymce_textarea"></textarea>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <input type="hidden" name="parag" id="parag" value="0">
                            <button class="btn btn-default" type="submit">Submit</button>

                            @if ($withParagraph ?? false)
                                <button class="btn btn-default" type="button" onclick="parags();">
                                    Submit & Add new with same paragraph
                                </button>
                            @endif

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
