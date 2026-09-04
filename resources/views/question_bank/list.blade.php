@extends('layouts.app')

@section('title', 'List Question Bank')

@section('content')

    <div class="container">

        <h3>List Question Bank</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="get" action="{{ route('listQuestion') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..."
                            {{ request('search') }}>
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
                    <form method="get" action="{{ route('listQuestion') }}">
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
                                <div style="background:#eeeeee;width:100%;height:10px;">
                                    <div style="background:#449d44;width:{{ $percentCorrected }}%;height:10px;"></div>
                                    <span style="font-size:10px;">{{ $percentCorrected }}%</span>
                                </div>
                            </td>
                            <td>
                                <a href="">
                                    <img src="{{ asset('images/edit.png') }}">
                                </a>

                                <a href=""
                                    onclick="return confirm('Are you sure you want to delete this question?');">
                                    <img src="{{ asset('images/cross.png') }}">
                                </a>
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

        <br><br><br><br>

        <!-- Excel import -->
        <div class="card">
            <div class="card-heading">
                <h4>Import Questions by .xls</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                    <select name="cid" required>
                        <option value="0">Select Category</option>
                        <option value="0">Select Category</option>
                    </select>

                    <select name="did" required>
                        <option value="0">Select Level</option>
                        <option value="0">Select Level</option>
                    </select>

                    Upload Excel File (.xls only)

                    <input type="hidden" name="size" value="3500000">
                    <input type="file" name="xlsfile" style="width:150px;float:left;margin-left:10px;">
                    <div style="clear:both;margin-bottom:15px;"></div>
                    <input type="submit" value="Import" style="margin-top:5px;" class="btn btn-default">

                    <a href="{{ asset('sample/sample.xls') }}" target="new">Click here</a> to download sample file to
                    know
                    file format.
                </form>
            </div>
        </div>

        <!-- Word import -->
        <div class="card" style="margin-top:20px;">
            <div class="card-heading">
                <h4>Import Questions by .docx</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="alert alert-warning">Currently it only support Multiple choice single answer and Multiple
                        choice multiple answer type questions</div>

                    <select name="cid" required>
                        <option value="0">Select Category</option>
                        <option value="0">Select Category</option>
                    </select>

                    <select name="lid" required>
                        <option value="0">Select Level</option>
                        <option value="0">Select Level</option>
                    </select>

                    Upload MS word file (.docx only)

                    <input type="hidden" name="size" value="3500000">
                    <input type="file" name="word_file" style="width:150px;float:left;margin-left:10px;">
                    <div style="clear:both;"></div>

                    <p style="padding:10px;"><a href="javascript:advanceconfig();">Advance Options</a></p>

                    <div id="advanceconfig" style="padding:10px;display:none">
                        <table>
                            <tr>
                                <td>Question Splitter:</td>
                                <td><input type="text" name="question_split" value="/Q:[0-9]+\)/"></td>
                            </tr>
                            <tr>
                                <td>Paragraph Splitter:</td>
                                <td><input type="text" name="paragraph_split" value="Paragraph:"></td>
                            </tr>
                            <tr>
                                <td>Description Splitter:</td>
                                <td><input type="text" name="description_split" value="/Sol:/"></td>
                            </tr>
                            <tr>
                                <td>Options Splitter:</td>
                                <td><input type="text" name="option_split" value="/[A-Z]:\)/"></td>
                            </tr>
                            <tr>
                                <td>Correct Option Splitter:</td>
                                <td><input type="text" name="correct_split" value="/Correct:/"></td>
                            </tr>
                        </table>
                    </div>

                    <input type="submit" value="Import" style="margin-top:5px;" class="btn btn-default">

                    <a href="{{ asset('sample/sample.docx') }}" target="new">Click here</a> to download sample file to
                    know file format.
                </form>
            </div>
        </div>

        <script>
            function advanceconfig() {
                $('#advanceconfig').toggle();
            }
        </script>

        <br><br><br><br>

    </div>

@endsection
