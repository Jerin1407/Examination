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
                                        <textarea id="paragraph" name="paragraph" class="form-control"></textarea>
                                    </div>
                                </div>
 
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="question">Question : English</label>
                                    <textarea id="question" name="question" class="form-control"></textarea>
                                </div>
                            </div>
 
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description">Description : English</label>
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                </div>
                            </div>
 
                            <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Options 1) : English</label> <br>
 
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