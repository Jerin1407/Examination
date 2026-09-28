@extends('layouts.app')

@section('title', 'Add Question into Exam')

@section('content')

    <div class="container">

        <h3>Add questions into exam: {{ $quiz->quiz_name }}</h3>

        <a href="{{ route('editExam', $quiz->quid) }}" class="btn btn-info">Back to exam</a><br><br>

        <div class="row">
            <div class="col-lg-6">
                <form method="get" action="{{ route('addQuestionIntoExam', $quiz->quid) }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..."
                            value="{{ request('search') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br>

                <div class="form-group">
                    <form method="get" action="{{ route('addQuestionIntoExam', $quiz->quid) }}">
                        @csrf
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <select name="cid">
                            <option value="0">All Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->cid }}"
                                    {{ request('cid') == $category->cid ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="lid">
                            <option value="0">All Level</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->lid }}" {{ request('lid') == $level->lid ? 'selected' : '' }}>
                                    {{ $level->level_name }}
                                </option>
                            @endforeach
                        </select>

                        <button class="btn btn-default" type="submit">Filter</button>
                    </form>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Question</th>
                        <th>Question Type</th>
                        <th>Category Name / Level Name</th>
                        <th>% Corrected</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($questions as $index => $question)
                        @php
                            $percentCorrected =
                                $question->no_time_served > 0
                                    ? round(($question->no_time_corrected / $question->no_time_served) * 100)
                                    : 0;
                        @endphp
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="$('#stats_{{ $question->qid }}').toggle();">+</a>
                                {{ $questions->firstItem() + $index }}
                            </td>
                            <td>
                                {{ \Illuminate\Support\Str::words(strip_tags($question->question), 6, '...') }}

                                <span id="stats_{{ $question->qid }}" style="display:none;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>No. of Times Corrected</td>
                                            <td>{{ $question->no_time_corrected }}</td>
                                        </tr>
                                        <tr>
                                            <td>No. of Times Incorrected</td>
                                            <td>{{ $question->no_time_incorrected }}</td>
                                        </tr>
                                        <tr>
                                            <td>No. of Times Unattempted</td>
                                            <td>{{ $question->no_time_unattempted }}</td>
                                        </tr>
                                    </table>
                                </span>
                            </td>
                            <td>{{ $question->question_type }}</td>
                            <td>{{ $question->category_name ?? '—' }} / {{ $question->level_name ?? '—' }}</td>
                            <td>
                                @if ($question->no_time_corrected == 0 && $question->no_time_incorrected == 0 && $question->no_time_unattempted == 0)
                                    Not used
                                @else
                                    <div style="background:#eeeeee;width:100%;height:10px;">
                                        <div style="background:#449d44;width:{{ $percentCorrected }}%;height:10px;"></div>
                                        <span style="font-size:10px;">{{ $percentCorrected }}%</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if (in_array($question->qid, $addedQids))
                                    <button type="button" class="btn btn-success" id="btn_{{ $question->qid }}" disabled>
                                        Added
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary add-question-btn"
                                        id="btn_{{ $question->qid }}" data-qid="{{ $question->qid }}">
                                        Add
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No questions found!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        @if ($questions->previousPageUrl())
            <a href="{{ $questions->previousPageUrl() }}" class="btn btn-primary">Back</a>
        @else
            <a href="#" class="btn btn-primary disabled">Back</a>
        @endif
        &nbsp;&nbsp;
        @if ($questions->nextPageUrl())
            <a href="{{ $questions->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <a href="#" class="btn btn-primary disabled">Next</a>
        @endif

    </div>

    <script>
        document.querySelectorAll('.add-question-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const qid = this.dataset.qid;
                const button = this;

                fetch(`{{ url('add-question-into-exam/' . $quiz->quid . '/add') }}/${qid}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            button.textContent = 'Added';
                            button.classList.remove('btn-primary', 'add-question-btn');
                            button.classList.add('btn-success');
                            button.disabled = true;
                        }
                    })
                    .catch(() => {
                        alert('Failed to add question. Please try again.');
                    });
            });
        });
    </script>

@endsection
