@extends('layouts.app')

@section('title', 'Edit Exam')

@section('content')

    <div class="container">

        <h3>Edit Exam</h3>

        <div class="row">
            <form method="post" action="{{ route('updateExam', $quiz->quid) }}">
                @csrf

                <div class="col-md-12">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            {{-- @if ($quiz['with_login'] == 0)
                            <div class="form-group">
                                <label>{{ __('lang.open_quiz_url') }}</label>
                                <input type="text" onclick="this.select()"
                                       value="{{ route('quiz.quiz_detail', [$quiz['quid'], urlencode($quiz['quiz_name'])]) }}"
                                       class="form-control">
                            </div>
                        @endif --}}

                            <div class="form-group">
                                <label for="quiz_name">Exam Name</label>
                                <input type="text" id="quiz_name" name="quiz_name" value="{{ $quiz->quiz_name }}" class="form-control"
                                    placeholder="Exam Name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control tinymce_textarea">{{ $quiz->description }}</textarea>
                            </div>
                            <a href="#" data-toggle="collapse" data-target="#advance_options">Advance options</a>

                            <div id="advance_options" class="collapse">

                                <div class="form-group">
                                    <label for="start_date">Start Date (Exam can be attempted after this date. YYYY-MM-DD
                                        HH:II:SS )</label>
                                    <input type="text" id="start_date" name="start_date" value="{{ $quiz->start_date }}"
                                        class="form-control" placeholder="Start Date" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date (Exam can be attempted before this date. eg. 2017-12-31
                                        23:59:00 )</label>
                                    <input type="text" id="end_date" name="end_date" value="{{ $quiz->end_date }}" class="form-control"
                                        placeholder="End Date" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration (in min.)</label>
                                    <input type="text" id="duration" name="duration" value="{{ $quiz->duration }}" class="form-control"
                                        placeholder="Duration" required>
                                </div>
                                <div class="form-group">
                                    <label for="maximum_attempts">Allow Maximum Attempts</label>
                                    <input type="text" id="maximum_attempts" name="maximum_attempts" value="{{ $quiz->maximum_attempts }}"
                                        class="form-control" placeholder="Allow Maximum Attempts" required>
                                </div>
                                <div class="form-group">
                                    <label for="pass_percentage">Minimum Percentage Required to Pass</label>
                                    <input type="text" id="pass_percentage" name="pass_percentage" value="{{ $quiz->pass_percentage }}"
                                        class="form-control" placeholder="Minimum Percentage Required to Pass" required>
                                </div>
                                <div class="form-group">
                                    <label for="correct_score">Correct Score</label>
                                    <input type="text" id="correct_score" name="correct_score" value="{{ $quiz->correct_score }}    "
                                        class="form-control" placeholder="Correct Score" required>
                                </div>
                                <div class="form-group">
                                    <label for="incorrect_score">InCorrect Score</label>
                                    <input type="text" id="incorrect_score" name="incorrect_score" value="{{ $quiz->incorrect_score }}"
                                        class="form-control" placeholder="InCorrect Score" required>
                                </div>
                                <div class="form-group">
                                    <label for="ip_address">Allowed ip address to attempt this exam. To allow all, leave
                                        empty.</label>
                                    <input type="text" id="ip_address" name="ip_address" value=""
                                        class="form-control"
                                        placeholder="Allowed ip address to attempt this exam. To allow all, leave empty.">
                                </div>

                                <div class="form-group">
                                    <label>Allow to view correct answers after submitting exam</label> <br>
                                    <input type="radio" name="view_answer" value="1"> Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="view_answer" value="0"> No
                                </div>
                                <div class="form-group">
                                    <label>Open exam - can be attempted without login?*</label> <br>
                                    <input type="radio" name="with_login" value="0"> Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="with_login" value="1"> No
                                </div>
                                <div class="form-group">
                                    <label>Show ranking on result page</label> <br>
                                    <input type="radio" name="show_chart_rank" value="1"> Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="show_chart_rank" value="0"> No
                                </div>

                                {{-- @if (config('app.webcam') == true) --}}
                                <div class="form-group">
                                    <label>Capture Photo</label> <br>
                                    <input type="radio" name="camera_req" value="1"> Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="camera_req" value="0"> No
                                </div>
                                {{-- @else
                                <input type="hidden" name="camera_req" value="0">
                            @endif --}}

                                <div class="form-group">
                                    <label>Assign to groups</label> <br>
                                    @forelse ($groups as $group)
                                        <label class="d-inline-block mr-3">
                                            <input type="checkbox" name="gids[]" value="{{ $group->gid }}">
                                            {{ $group->group_name }}
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                    @empty
                                        <p>No groups found</p>
                                    @endforelse
                                </div>

                                <div class="form-group">
                                    <label>Or
                                        Assign to users</label> <br>
                                    <select class="js-example-basic-multiple form-control" name="uids[]"
                                        multiple="multiple" style="width:100%">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->uid }}">
                                                {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(".js-example-basic-multiple").select2();
                                    </script>
                                </div>

                                <div class="form-group">
                                    <label>Exam Template</label> <br>
                                    <select name="quiz_template">
                                        <option value="Default">Default
                                        </option>
                                        <option value="Practice">Practice</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quiz_price">Quiz Price (Set 0 for free)</label> <br>
                                    <input type="text" id="quiz_price" name="quiz_price" value=""
                                        class="form-control" placeholder="Quiz Price" required>
                                </div>

                                <div class="form-group">
                                    <label>Generate Certificate</label> <br>
                                    <input type="radio" name="gen_certificate" value="1"> Yes<br>
                                    <input type="radio" name="gen_certificate" value="0"> No
                                </div>

                                <div class="form-group">
                                    <label for="certificate_text">Certificate Text</label>
                                    <textarea id="certificate_text" name="certificate_text" class="form-control" style="height:250px;"></textarea><br>
                                    You can use following tags:
                                    {{ '<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>  <h3></h3>  <font></font>' }}<br>
                                    {email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained},
                                    {score_obtained}, {result}, {generated_date}, {result_id}, {qr_code}

                                    <br><br>
                                    <a href="" target="preview_cert" class="btn btn-warning">Preview</a>
                                    <span style="color:#ff0000">First click submit button (at bottom of page) to get
                                        updated Preview</span>
                                </div>

                            </div>
                            <br><br>

                            {{-- <div class="alert alert-warning">Questions added in to this exam</div>
                            <a href="" class="btn btn-danger">Add questions into exam</a>

                            <table class="table table-bordered" style="margin-top:10px;">
                                <tr>
                                    <th>SI.No</th>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                    <th>Category Name</th>
                                    <th>Level Name</th>
                                    <th>Correct</th>
                                    <th>InCorrect</th>
                                    <th>Action</th>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>Question 1
                                    </td>
                                    <td>short answer</td>
                                    <td>catogory</td>
                                    <td>level</td>
                                    <td>
                                        <input type="text" style="width:60px;" name="i_correct[]" value="">
                                    </td>
                                    <td>
                                        <input type="text" style="width:60px;" name="i_incorrect[]" value="">
                                    </td>
                                    <td>
                                        <a href="" title=""><img src="{{ asset('images/cross.png') }}"></a>

                                        <img src="{{ asset('images/empty.png') }}" title="">
                                        <a href="javascript:cancelmove('Up','');">
                                            <img src="{{ asset('images/up.png') }}" title="">
                                        </a>

                                        <a href="javascript:cancelmove('Down','');">
                                            <img src="{{ asset('images/down.png') }}" title="">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <div class="alert alert-warning">Warning! Your exam doesn't have any question.</div>

                            <div class="form-group">
                                <select name="cid[]">
                                    <option value="0">select
                                        category name</option>
                                    <option value="">
                                        category_name</option>
                                </select>
                                <select name="lid[]">
                                    <option value="0">select level name</option>
                                    <option value="">
                                        level_name</option>
                                </select>

                                no questions added
                                <select name="noq[]">
                                    <option value="">noq</option>
                                    <option value="0">0</option>
                                </select>

                                correct <input type="text" name="i_correct[]" style="width:40px;" value="">
                                | incorrect <input type="text" style="width:40px;" name="i_incorrect[]"
                                    value="">
                            </div>
                            <hr>

                            <div class="form-group">
                                <select name="cid[]" id="cid">
                                    <option value="0">select category name
                                    </option>
                                    <option value="">category name</option>
                                </select>
                                <select name="lid[]" onchange="no_q_available(this.value);">
                                    <option value="0">select level name
                                    </option>
                                    <option value="">level name</option>
                                </select>

                                no questions available
                                <span id="no_q_available"></span>

                                <br><br>
                                correct score <input type="text" name="i_correct[]" style="width:40px;"
                                    value="1">
                                | incorrect score <input type="text" style="width:40px;" name="i_incorrect[]"
                                    value="0">
                            </div> --}}

                            <a class="btn btn-success" href="">Back</a>
                            <button class="btn btn-success" type="submit">Update Exam</button>

                            <br><br><br>
                            *Some validation and features will not work in Open Quiz, however it will work if user
                            logged in.

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div id="warning_div"
        style="padding:10px; position:fixed;z-index:100;display:none;width:100%;border-radius:5px;height:200px; border:1px solid #dddddd;left:4px;top:70px;background:#ffffff;">
        <center>
            <b>to which position</b><br>
            <input type="text" style="width:30px" id="qposition" value=""><br><br>
            <a href="javascript:cancelmove();" class="btn btn-danger" style="cursor:pointer;">Cancel</a>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="javascript:movequestion();" class="btn btn-info" style="cursor:pointer;">Move</a>
        </center>
    </div>

@endsection

@push('scripts')
    <script>
        tinymce.init({
            selector: '.tinymce_textarea',
            height: 300,
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
