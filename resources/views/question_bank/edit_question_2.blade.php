@extends('layouts.app')

@section('title', 'Edit Question')

@section('content')

    <div class="container">

        <h3>Edit Question</h3>

        <div class="row">
            <form method="post" action="{{ route('updateQuestion2') }}">
                @csrf

                <input type="hidden" name="qid" value="{{ $question->qid }}">
                <input type="hidden" name="nop" value="{{ $options->count() }}">

                <div class="col-md-12">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                Multiple Choice Multiple Answer
                            </div>

                            <div class="form-group">
                                <label for="cid">Select Category</label>
                                <select class="form-control" name="cid" id="cid">
                                    <option value="0">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->cid }}"
                                            {{ $question->cid == $category->cid ? 'selected' : '' }}>
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
                                        <option value="{{ $level->lid }}"
                                            {{ $question->lid == $level->lid ? 'selected' : '' }}>
                                            {{ $level->level_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paragraph">Paragraph : English</label>
                                    <textarea id="paragraph" name="paragraph" class="form-control tinymce_textarea">{{ $question->paragraph }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="question">Question : English</label>
                                    <textarea id="question" name="question" class="form-control tinymce_textarea">{{ $question->question }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description">Description : English</label>
                                    <textarea id="description" name="description" class="form-control tinymce_textarea">{{ $question->description }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($options as $option)
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Options {{ $loop->iteration }}) : English</label> <br>

                                            <input type="checkbox" name="score[]" value="{{ $loop->iteration }}"
                                                {{ $option->score > 0 ? 'checked' : '' }}>
                                            Select Correct Option
                                            <br>

                                            <textarea name="option[]" class="form-control tinymce_textarea">{{ $option->q_option }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
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
                            <td>{{ $question->no_time_corrected }}</td>
                        </tr>
                        <tr>
                            <td>No. of Times Incorrect</td>
                            <td>{{ $question->no_time_incorrected }}</td>
                        </tr>
                        <tr>
                            <td>No. of Times Unattempted</td>
                            <td>{{ $question->no_time_unattempted }}</td>
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
