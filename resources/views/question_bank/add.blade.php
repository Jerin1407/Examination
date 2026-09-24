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
                                <select class="form-control" name="question_type" id="question_type"
                                    onchange="toggleNop(this.value);">
                                    <option value="0">Select Question Type</option>
                                    <option value="Multiple Choice Single Answer"
                                        {{ old('question_type') == 'Multiple Choice Single Answer' ? 'selected' : '' }}>
                                        Multiple Choice Single Answer</option>
                                    <option value="Multiple Choice Multiple Answer"
                                        {{ old('question_type') == 'Multiple Choice Multiple Answer' ? 'selected' : '' }}>
                                        Multiple Choice Multiple Answer</option>
                                    <option value="Match the Column"
                                        {{ old('question_type') == 'Match the Column' ? 'selected' : '' }}>Match the Column
                                    </option>
                                    <option value="Short Answer"
                                        {{ old('question_type') == 'Short Answer' ? 'selected' : '' }}>Short Answer</option>
                                    <option value="Long Answer"
                                        {{ old('question_type') == 'Long Answer' ? 'selected' : '' }}>Long Answer</option>
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

    <script>
        function toggleNop(questionType) {
            var nopDiv = document.getElementById('nop');
            if (questionType === 'Short Answer' || questionType === 'Long Answer') {
                nopDiv.style.display = 'none';
            } else {
                nopDiv.style.display = '';
            }
        }

        // Re-run on load so a validation-error redisplay (old('question_type')) shows the correct state
        document.addEventListener('DOMContentLoaded', function() {
            toggleNop(document.getElementById('question_type').value);
        });
    </script>

@endsection
