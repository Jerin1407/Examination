@extends('layouts.app')

@section('title', 'Edit Exam')

@section('content')

<div class="container">
 
    @php
        $lang = config('app.question_lang');
    @endphp
 
    <h3>{{ $title }}</h3>
 
    <div class="row">
        <form method="post" action="{{ route('qbank.edit_question_1', $question['qid']) }}">
            @csrf
 
            <div class="col-md-12">
                <br>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
 
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
 
                        <div class="form-group">
                            {{ __('lang.multiple_choice_single_answer') }}
                        </div>
 
                        <div class="form-group">
                            <label for="cid">{{ __('lang.select_category') }}</label>
                            <select class="form-control" name="cid" id="cid">
                                @foreach ($category_list as $val)
                                    <option value="{{ $val['cid'] }}" @selected(old('cid', $question['cid']) == $val['cid'])>{{ $val['category_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
 
                        <div class="form-group">
                            <label for="lid">{{ __('lang.select_level') }}</label>
                            <select class="form-control" name="lid" id="lid">
                                @foreach ($level_list as $val)
                                    <option value="{{ $val['lid'] }}" @selected(old('lid', $question['lid']) == $val['lid'])>{{ $val['level_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
 
                        @if (strip_tags($question['paragraph']) != '')
                            @foreach ($lang as $lkey => $val)
                                @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="paragraph{{ $lno }}">{{ __('lang.paragraph') }} : {{ $val }}</label>
                                        <textarea id="paragraph{{ $lno }}" name="paragraph{{ $lno }}" class="form-control">{{ old('paragraph' . $lno, $question['paragraph' . $lno]) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @endif
 
                        @foreach ($lang as $lkey => $val)
                            @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="question{{ $lno }}">{{ __('lang.question') }} : {{ $val }}</label>
                                    <textarea id="question{{ $lno }}" name="question{{ $lno }}" class="form-control">{{ old('question' . $lno, $question['question' . $lno]) }}</textarea>
                                </div>
                            </div>
                        @endforeach
 
                        @foreach ($lang as $lkey => $val)
                            @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description{{ $lno }}">{{ __('lang.description') }} : {{ $val }}</label>
                                    <textarea id="description{{ $lno }}" name="description{{ $lno }}" class="form-control">{{ old('description' . $lno, $question['description' . $lno]) }}</textarea>
                                </div>
                            </div>
                        @endforeach
 
                        @foreach ($options as $key => $val)
                            <div class="row">
                                @foreach ($lang as $lkey => $la)
                                    @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('lang.options') }} {{ $key + 1 }}) : {{ $la }}</label> <br>
 
                                            @if ($lkey == 0)
                                                <input type="radio" name="score" value="{{ $key }}" @checked(old('score', array_search(1, array_column($options, 'score'))) == $key)>
                                                Select Correct Option
                                            @endif
                                            <br>
 
                                            <textarea name="option{{ $lno }}[]" class="form-control">{{ old("option{$lno}.{$key}", $val['q_option' . $lno]) }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
 
                        <button class="btn btn-default" type="submit">{{ __('lang.submit') }}</button>
 
                    </div>
                </div>
            </div>
        </form>
 
        <div class="col-md-3">
            <div class="form-group">
                <table class="table table-bordered">
                    <tr><td>{{ __('lang.no_times_corrected') }}</td><td>{{ $question['no_time_corrected'] }}</td></tr>
                    <tr><td>{{ __('lang.no_times_incorrected') }}</td><td>{{ $question['no_time_incorrected'] }}</td></tr>
                    <tr><td>{{ __('lang.no_times_unattempted') }}</td><td>{{ $question['no_time_unattempted'] }}</td></tr>
                </table>
            </div>
        </div>
    </div>
 
</div>

@endsection