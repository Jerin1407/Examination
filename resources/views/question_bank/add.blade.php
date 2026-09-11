@extends('layouts.app')

@section('title', 'Add New Question')

@section('content')

    <div class="container">

        <h3>Add New Question</h3>

        <div class="row">
            <form method="post" action="{{ route('nextQuestionType') }}">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label>Select Question Type</label>
                                <select class="form-control" name="question_type" onchange="hidenop(this.value);">
                                    <option value="0">Select Question Type</option>
                                    <option value="1">Multiple Choice Single Answer</option>
                                    <option value="2">Multiple Choice Multiple Answer</option>
                                    <option value="3">Match the Column</option>
                                    <option value="4">Short Answer</option>
                                    <option value="5">Long Answer</option>
                                </select>
                            </div>

                            <div class="form-group" id="nop">
                                <label for="nop_input">Number of Options</label>
                                <input type="text" name="nop" id="nop_input" class="form-control"
                                    value="{{ old('nop', 4) }}">
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="with_paragraph" id="with_paragraph">
                                <label for="with_paragraph">With Paragraph</label>
                            </div>

                            <button class="btn btn-default" type="submit">Next</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
