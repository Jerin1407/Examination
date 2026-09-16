@extends('layouts.app')

@section('title', 'Add Study Material')

@section('content')

    <div class="container">

        <h3>Add Study Material</h3>

        <div class="row">
            <form method="post" action="{{ route('saveStudyMaterial') }}" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required id="title" name="title" class="form-control"
                                    value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="study_description">Description</label>
                                <textarea id="study_description" name="study_description" class="form-control tinymce_textarea"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="userfile">File Upload</label>
                                <input type="file" required id="userfile" name="userfile">
                            </div>

                            <div class="form-group">
                                <label for="cid">Category</label>
                                <select name="cid" id="cid" class="form-control">
                                    <option value="0">--Select--</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->cid }}">{{ $category->category_name }}</option>
                                    @empty
                                        <p>No category found</p>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Group Name</label> <br>
                                @forelse ($groups as $group)
                                    <input type="checkbox" name="gid[]" value="{{ $group->gid }}">
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
