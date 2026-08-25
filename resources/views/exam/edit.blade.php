@extends('layouts.app')

@section('title', 'Edit Exam')

@section('content')

<div class="container">
 
        <h3>Edit Exam</h3>
 
    <div class="row">
        <form method="post" action="">
            @csrf
 
            <div class="col-md-12">
                <br>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
 
                        @if ($quiz['with_login'] == 0)
                            <div class="form-group">
                                <label>{{ __('lang.open_quiz_url') }}</label>
                                <input type="text" onclick="this.select()"
                                       value="{{ route('quiz.quiz_detail', [$quiz['quid'], urlencode($quiz['quiz_name'])]) }}"
                                       class="form-control">
                            </div>
                        @endif
 
                        @if (!session('addquestion'))
                            <div class="form-group">
                                <label for="quiz_name">{{ __('lang.quiz_name') }}</label>
                                <input type="text" id="quiz_name" name="quiz_name" value="{{ old('quiz_name', $quiz['quiz_name']) }}"
                                       class="form-control" placeholder="{{ __('lang.quiz_name') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('lang.description') }}</label>
                                <textarea id="description" name="description" class="form-control tinymce_textarea">{{ old('description', $quiz['description']) }}</textarea>
                            </div>
                            <a href="#" data-toggle="collapse" data-target="#advance_options">{{ __('lang.advance_options') }}</a>
                        @endif
 
                        <div id="advance_options" class="collapse">
 
                            <div class="form-group">
                                <label for="start_date">{{ __('lang.start_date') }}</label>
                                <input type="text" id="start_date" name="start_date"
                                       value="{{ old('start_date', \Illuminate\Support\Carbon::parse($quiz['start_date'])->format('Y-m-d H:i:s')) }}"
                                       class="form-control" placeholder="{{ __('lang.start_date') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">{{ __('lang.end_date') }}</label>
                                <input type="text" id="end_date" name="end_date"
                                       value="{{ old('end_date', \Illuminate\Support\Carbon::parse($quiz['end_date'])->format('Y-m-d H:i:s')) }}"
                                       class="form-control" placeholder="{{ __('lang.end_date') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">{{ __('lang.duration') }}</label>
                                <input type="text" id="duration" name="duration" value="{{ old('duration', $quiz['duration']) }}"
                                       class="form-control" placeholder="{{ __('lang.duration') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="maximum_attempts">{{ __('lang.maximum_attempts') }}</label>
                                <input type="text" id="maximum_attempts" name="maximum_attempts" value="{{ old('maximum_attempts', $quiz['maximum_attempts']) }}"
                                       class="form-control" placeholder="{{ __('lang.maximum_attempts') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pass_percentage">{{ __('lang.pass_percentage') }}</label>
                                <input type="text" id="pass_percentage" name="pass_percentage" value="{{ old('pass_percentage', $quiz['pass_percentage']) }}"
                                       class="form-control" placeholder="{{ __('lang.pass_percentage') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="correct_score">{{ __('lang.correct_score') }}</label>
                                <input type="text" id="correct_score" name="correct_score" value="{{ old('correct_score', $quiz['correct_score']) }}"
                                       class="form-control" placeholder="{{ __('lang.correct_score') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="incorrect_score">{{ __('lang.incorrect_score') }}</label>
                                <input type="text" id="incorrect_score" name="incorrect_score" value="{{ old('incorrect_score', $quiz['incorrect_score']) }}"
                                       class="form-control" placeholder="{{ __('lang.incorrect_score') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ip_address">{{ __('lang.ip_address') }}</label>
                                <input type="text" id="ip_address" name="ip_address" value="{{ old('ip_address', $quiz['ip_address']) }}"
                                       class="form-control" placeholder="{{ __('lang.ip_address') }}">
                            </div>
 
                            <div class="form-group">
                                <label>{{ __('lang.view_answer') }}</label> <br>
                                <input type="radio" name="view_answer" value="1" @checked(old('view_answer', $quiz['view_answer']) == 1)> {{ __('lang.yes') }}&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="view_answer" value="0" @checked(old('view_answer', $quiz['view_answer']) == 0)> {{ __('lang.no') }}
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.open_quiz') }}</label> <br>
                                <input type="radio" name="with_login" value="0" @checked(old('with_login', $quiz['with_login']) == 0)> {{ __('lang.yes') }}&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="with_login" value="1" @checked(old('with_login', $quiz['with_login']) == 1)> {{ __('lang.no') }}
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.show_rank') }}</label> <br>
                                <input type="radio" name="show_chart_rank" value="1" @checked(old('show_chart_rank', $quiz['show_chart_rank']) == 1)> {{ __('lang.yes') }}&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="show_chart_rank" value="0" @checked(old('show_chart_rank', $quiz['show_chart_rank']) == 0)> {{ __('lang.no') }}
                            </div>
 
                            @if (config('app.webcam') == true)
                                <div class="form-group">
                                    <label>{{ __('lang.capture_photo') }}</label> <br>
                                    <input type="radio" name="camera_req" value="1" @checked(old('camera_req', $quiz['camera_req']) == 1)> {{ __('lang.yes') }}&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="camera_req" value="0" @checked(old('camera_req', $quiz['camera_req']) == 0)> {{ __('lang.no') }}
                                </div>
                            @else
                                <input type="hidden" name="camera_req" value="0">
                            @endif
 
                            <div class="form-group">
                                <label>{{ __('lang.assign_to_group') }}</label> <br>
                                @php $quizGids = explode(',', $quiz['gids']); @endphp
                                @foreach ($group_list as $val)
                                    <input type="checkbox" name="gids[]" value="{{ $val['gid'] }}"
                                           @checked(in_array($val['gid'], old('gids', $quizGids)))> {{ $val['group_name'] }} &nbsp;&nbsp;&nbsp;
                                @endforeach
                            </div>
 
                            <div class="form-group">
                                <label>{{ __('lang.assign_to_student') }}</label> <br>
                                @php $quizUids = explode(',', $quiz['uids']); @endphp
                                <select class="js-example-basic-multiple form-control" name="uids[]" multiple="multiple" style="width:100%">
                                    @foreach ($user_list as $uval)
                                        <option value="{{ $uval['uid'] }}" @selected(in_array($uval['uid'], old('uids', $quizUids)))>
                                            {{ $uval['first_name'] }} {{ $uval['last_name'] }} ({{ $uval['email'] }})
                                        </option>
                                    @endforeach
                                </select>
                                <script type="text/javascript">
                                    $(".js-example-basic-multiple").select2();
                                </script>
                            </div>
 
                            <div class="form-group">
                                <label>{{ __('lang.quiz_template') }}</label> <br>
                                <select name="quiz_template">
                                    @foreach (config('app.quiz_templates') as $val)
                                        <option value="{{ $val }}" @selected(old('quiz_template', $quiz['quiz_template']) == $val)>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
 
                            <div class="form-group">
                                <label for="quiz_price">{{ __('lang.quiz_price') }}</label> <br>
                                <input type="text" id="quiz_price" name="quiz_price" value="{{ old('quiz_price', $quiz['quiz_price']) }}"
                                       class="form-control" placeholder="{{ __('lang.quiz_price') }}" required>
                            </div>
 
                            <div class="form-group">
                                <label>{{ __('lang.generate_certificate') }}</label> <br>
                                <input type="radio" name="gen_certificate" value="1" @checked(old('gen_certificate', $quiz['gen_certificate']) == 1)> {{ __('lang.yes') }}<br>
                                <input type="radio" name="gen_certificate" value="0" @checked(old('gen_certificate', $quiz['gen_certificate']) == 0)> {{ __('lang.no') }}
                            </div>
 
                            <div class="form-group">
                                <label for="certificate_text">{{ __('lang.certificate_text') }}</label>
                                <textarea id="certificate_text" name="certificate_text" class="form-control" style="height:250px;">{{ old('certificate_text', $quiz['certificate_text']) }}</textarea><br>
                                {{ __('lang.tags_use') }} {{ "<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>  <h3></h3>  <font></font>" }}<br>
                                {email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained}, {score_obtained}, {result}, {generated_date}, {result_id}, {qr_code}
 
                                <br><br>
                                <a href="{{ route('result.preview_certificate', $quiz['quid']) }}" target="preview_cert" class="btn btn-warning">{{ __('lang.preview') }}</a>
                                <span style="color:#ff0000">{{ __('lang.preview_warning') }}</span>
                            </div>
 
                        </div>
                        <br><br>
 
                        @if ($quiz['question_selection'] == '0')
 
                            @if (count($questions) == 0)
                                @if (!session('addquestion'))
                                    <div class="alert alert-warning">{{ __('lang.no_question_warning') }}</div>
                                @endif
                                <a href="{{ route('quiz.add_question', $quiz['quid']) }}" class="btn btn-danger">{{ __('lang.add_question_into_quiz') }}</a>
                            @else
                                <h4>{{ __('lang.questions_added_into_quiz') }}</h4>
                                <a href="{{ route('quiz.add_question', $quiz['quid']) }}" class="btn btn-danger">{{ __('lang.add_question_into_quiz') }}</a>
 
                                <table class="table table-bordered" style="margin-top:10px;">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('lang.question') }}</th>
                                        <th>{{ __('lang.question_type') }}</th>
                                        <th>{{ __('lang.category_name') }}</th>
                                        <th>{{ __('lang.level_name') }}</th>
                                        <th>{{ __('lang.correct') }}</th>
                                        <th>{{ __('lang.incorrect') }}</th>
                                        <th>{{ __('lang.action') }}</th>
                                    </tr>
 
                                    @if (count($questions) == 0)
                                        <tr>
                                            <td colspan="6">{{ __('lang.no_question_added') }}</td>
                                        </tr>
                                    @endif
 
                                    @php
                                        // NOTE: the original indexed $quiz['correct_score'] /
                                        // $quiz['incorrect_score'] as if they were arrays
                                        // ($quiz['correct_score'][$key]), but every other use of
                                        // these two fields in this same view treats them as plain
                                        // scalar strings (see the single correct_score/
                                        // incorrect_score inputs above). That's inconsistent in the
                                        // original — isset() on a string offset in PHP checks
                                        // string character position, not a per-question value, so
                                        // this almost certainly wasn't doing what it looked like it
                                        // was doing. I'm guessing the actual intent was a
                                        // comma-separated per-question score list (parallel to
                                        // qids/gids/uids elsewhere in this view), so I've exploded
                                        // both on comma here to get a real per-question array.
                                        // Please double check this matches how your quiz model
                                        // actually stores per-question correct/incorrect scores —
                                        // I can't verify that without the controller/model.
                                        $correctScores = explode(',', $quiz['correct_score']);
                                        $incorrectScores = explode(',', $quiz['incorrect_score']);
                                        $qidsCount = count(explode(',', $quiz['qids']));
                                    @endphp
 
                                    @foreach ($questions as $key => $val)
                                        <tr>
                                            <td>{{ $val['qid'] }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($val['question']), 50, '') }}</td>
                                            <td>{{ $val['question_type'] }}</td>
                                            <td>{{ $val['category_name'] }}</td>
                                            <td>{{ $val['level_name'] }}</td>
                                            <td>
                                                <input type="text" style="width:60px;" name="i_correct[]"
                                                       value="{{ $correctScores[$key] ?? '1' }}">
                                            </td>
                                            <td>
                                                <input type="text" style="width:60px;" name="i_incorrect[]"
                                                       value="{{ $incorrectScores[$key] ?? '0' }}">
                                            </td>
                                            <td>
                                                <a href="{{ route('quiz.remove_qid', [$quiz['quid'], $val['qid']]) }}"
                                                   title="{{ __('lang.remove_from_quiz') }}"><img src="{{ asset('images/cross.png') }}"></a>
 
                                                @if ($key == 0)
                                                    <img src="{{ asset('images/empty.png') }}" title="">
                                                @else
                                                    <a href="javascript:cancelmove('Up','{{ $quiz['quid'] }}','{{ $val['qid'] }}','{{ $key + 1 }}');">
                                                        <img src="{{ asset('images/up.png') }}" title="{{ __('lang.up') }}">
                                                    </a>
                                                @endif
 
                                                @if ($key != ($qidsCount - 1))
                                                    <a href="javascript:cancelmove('Down','{{ $quiz['quid'] }}','{{ $val['qid'] }}','{{ $key + 1 }}');">
                                                        <img src="{{ asset('images/down.png') }}" title="{{ __('lang.down') }}">
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
 
                        @else
 
                            @if (count($qcl) == 0)
                                @if (!session('addquestion'))
                                    <div class="alert alert-warning">{{ __('lang.no_question_warning') }}</div>
                                @endif
                            @else
                                <h4>{{ __('lang.questions_added_into_quiz') }}</h4><br>
                            @endif
 
                            @foreach ($qcl as $vall)
                                <div class="form-group">
                                    <select name="cid[]">
                                        <option value="0">{{ __('lang.select') }} {{ __('lang.category_name') }}</option>
                                        @foreach ($category_list as $val)
                                            <option value="{{ $val['cid'] }}" @selected($val['cid'] == $vall['cid'])>{{ $val['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <select name="lid[]">
                                        <option value="0">{{ __('lang.select') }} {{ __('lang.level_name') }}</option>
                                        @foreach ($level_list as $val)
                                            <option value="{{ $val['lid'] }}" @selected($val['lid'] == $vall['lid'])>{{ $val['level_name'] }}</option>
                                        @endforeach
                                    </select>
 
                                    {{ __('lang.no_questions_added') }}
                                    <select name="noq[]">
                                        <option value="{{ $vall['noq'] }}">{{ $vall['noq'] }}</option>
                                        <option value="0">0</option>
                                    </select>
 
                                    {{ __('lang.correct') }} <input type="text" name="i_correct[]" style="width:40px;" value="{{ $vall['i_correct'] }}">
                                    | {{ __('lang.incorrect') }} <input type="text" style="width:40px;" name="i_incorrect[]" value="{{ $vall['i_incorrect'] }}">
                                </div>
                                <hr>
                            @endforeach
 
                            <div class="form-group">
                                <select name="cid[]" id="cid">
                                    <option value="0">{{ __('lang.select') }} {{ __('lang.category_name') }}</option>
                                    @foreach ($category_list as $val)
                                        <option value="{{ $val['cid'] }}">{{ $val['category_name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="lid[]" onchange="no_q_available(this.value);">
                                    <option value="0">{{ __('lang.select') }} {{ __('lang.level_name') }}</option>
                                    @foreach ($level_list as $val)
                                        <option value="{{ $val['lid'] }}">{{ $val['level_name'] }}</option>
                                    @endforeach
                                </select>
 
                                {{ __('lang.no_questions_available') }}
                                <span id="no_q_available"></span>
 
                                <br><br>
                                {{ __('lang.correct_score') }} <input type="text" name="i_correct[]" style="width:40px;" value="1">
                                | {{ __('lang.incorrect_score') }} <input type="text" style="width:40px;" name="i_incorrect[]" value="0">
                            </div>
 
                        @endif
 
                        @if (session('addquestion') && $quiz['question_selection'] == '0')
                            <a class="btn btn-success" href="{{ route('quiz.index') }}">{{ __('lang.back') }}</a>
                        @else
                            <button class="btn btn-success" type="submit">{{ __('lang.update') }} {{ __('lang.quiz') }}</button>
                        @endif
 
                        <br><br><br>
                        {{ __('lang.open_quiz_warning') }}
 
                    </div>
                </div>
            </div>
        </form>
    </div>
 
</div>
 
<div id="warning_div" style="padding:10px; position:fixed;z-index:100;display:none;width:100%;border-radius:5px;height:200px; border:1px solid #dddddd;left:4px;top:70px;background:#ffffff;">
    <center>
        <b>{{ __('lang.to_which_position') }}</b><br>
        <input type="text" style="width:30px" id="qposition" value=""><br><br>
        <a href="javascript:cancelmove();" class="btn btn-danger" style="cursor:pointer;">{{ __('lang.cancel') }}</a>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="javascript:movequestion();" class="btn btn-info" style="cursor:pointer;">{{ __('lang.move') }}</a>
    </center>
</div>

@endsection