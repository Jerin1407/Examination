@extends('layouts.app')

@section('title', 'Edit Study Material')

@section('content')

    <div class="container">

        <h3>Edit Study Material</h3>

        <div class="row">
            <form method="post" action="{{ route('updateStudyMaterial', $studyMaterial->stid) }}" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required id="title" name="title"
                                    value="{{ old('title', $studyMaterial->title) }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="study_description">Description</label>
                                <textarea id="study_description" name="study_description" class="form-control tinymce_textarea">{{ old('study_description', $studyMaterial->study_description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="userfile">File Upload</label>
                                <input type="file" id="userfile" name="userfile">
                                @if ($studyMaterial->attachment)
                                    <p class="help-block">
                                        Current file:
                                        <a href="{{ asset('storage/' . $studyMaterial->attachment) }}" target="_blank">
                                            {{ basename($studyMaterial->attachment) }}
                                        </a>
                                        (leave blank to keep the existing file)
                                    </p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="cid">Category</label>
                                <select name="cid" id="cid" class="form-control">
                                    <option value="0">--Select--</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->cid }}"
                                            {{ old('cid', $studyMaterial->cid) == $category->cid ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @empty
                                        <p>No category found</p>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Group Name</label> <br>
                                @forelse ($groups as $group)
                                    <input type="checkbox" name="gid[]" value="{{ $group->gid }}"
                                        {{ in_array((int) $group->gid, old('gid', $selectedGids)) ? 'checked' : '' }}>
                                    {{ $group->group_name }} &nbsp; &nbsp; &nbsp;
                                @empty
                                    <p>No groups found</p>
                                @endforelse
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
