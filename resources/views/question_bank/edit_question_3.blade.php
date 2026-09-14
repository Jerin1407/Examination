@extends('layouts.app')

@section('title', 'Edit Exam')

@section('content')

<div class="container">
 
    <h3>Edit Exam</h3>
 
    <div class="row">
        <form method="post" action="{{ route('qbank.edit_question_3', $question['qid']) }}">
            @csrf
 
            <div class="col-md-8">
                <br>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
 
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
 
                        <div class="form-group">
                            {{ __('lang.match_the_column') }}
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
 
                        {{-- Same single-language pattern as new_question_3: no $lang loop
                             here either, consistent with match-the-column being
                             single-language-only in the "new question" form too. --}}
 
                        @if (strip_tags($question['paragraph']) != '')
                            <div class="form-group">
                                <label for="paragraph">{{ __('lang.paragraph') }}</label>
                                <textarea id="paragraph" name="paragraph" class="form-control">{{ old('paragraph', $question['paragraph']) }}</textarea>
                            </div>
                        @endif
 
                        <div class="form-group">
                            <label for="question">{{ __('lang.question') }}</label>
                            <textarea id="question" name="question" class="form-control">{{ old('question', $question['question']) }}</textarea>
                        </div>
 
                        <div class="form-group">
                            <label for="description">{{ __('lang.description') }}</label>
                            <textarea id="description" name="description" class="form-control">{{ old('description', $question['description']) }}</textarea>
                        </div>
 
                        @foreach ($options as $key => $val)
                            <div class="form-group">
                                <label>{{ __('lang.options') }} {{ $key + 1 }})</label> <br>
                                <input type="text" name="option[]" value="{{ old('option.' . $key, $val['q_option']) }}">
                                =
                                <input type="text" name="option2[]" value="{{ old('option2.' . $key, $val['q_option_match']) }}">
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