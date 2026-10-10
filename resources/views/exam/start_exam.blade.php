<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Start Exam')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/style.css?q=' . time()) }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        p,
        div,
        span,
        ul,
        li,
        a {
            direction: {{ config('app.direction', 'ltr') }};
        }

        .btn-default {
            border: 1px solid #c8c4c4;
        }

        form {
            width: 100%;
        }

        td {
            font-size: 14px;
            padding: 4px;
        }

        .row {
            margin: 0px;
        }

        .qbtn {
            display: inline-block;
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            color: #fff;
            background: #212121;
            margin: 2px;
            cursor: pointer;
            border-radius: 3px;
        }

        .qbtn.current {
            outline: 2px solid #3D4A5D;
            outline-offset: 1px;
        }

        .question_div {
            display: none;
            padding: 10px;
        }

        .question_container {
            margin-bottom: 15px;
        }

        .footer_buttons {
            padding: 6px 10px;
        }
    </style>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- TinyMCE Text Editor -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>

    <div style="background:#3D4A5D;padding:4px;color:#ffffff;">
        <div style="float:right;width:200px;margin-right:10px;">
            Time left: <span id="timer">--:--:--</span>
        </div>
        <div style="float:left;">
            <h4 style="margin:0;">{{ $exam->quiz_name }}</h4>
        </div>
        <div style="clear:both;"></div>
    </div>

    <div class="row" style="margin-top:0px;">
        <div class="col-md-9">

            <form method="post" action="" id="quiz_form">
                @csrf
                <input type="hidden" name="quid" value="{{ $exam->quid }}">
                <input type="hidden" name="selected_lang" value="{{ $lang }}">

                @forelse ($questions as $i => $question)
                    @php
                        $opts = $options->get($question->qid, collect());
                        $useAlt = $lang !== 'English';
                        $questionText = $useAlt && $question->question1 ? $question->question1 : $question->question;
                        $paragraphText =
                            $useAlt && $question->paragraph1 ? $question->paragraph1 : $question->paragraph;
                    @endphp

                    <div id="q_{{ $i }}" class="question_div">

                        <div class="question_container">
                            @if (!empty(trim(strip_tags((string) $paragraphText))))
                                {!! $paragraphText !!}
                                <hr>
                            @endif

                            <b>Question {{ $i + 1 }})</b><br>
                            {!! $questionText !!}
                        </div>

                        <div class="option_container">

                            @if ($question->question_type === 'Multiple Choice Single Answer')
                                @foreach ($opts as $n => $option)
                                    <div class="op">
                                        <table>
                                            <tr>
                                                <td>
                                                    {{ chr(97 + $n) }})
                                                    <input type="radio" name="answer[{{ $i }}][]"
                                                        value="{{ $option->oid }}">
                                                </td>
                                                <td>{!! $useAlt && $option->q_option1 ? $option->q_option1 : $option->q_option !!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @elseif ($question->question_type === 'Multiple Choice Multiple Answer')
                                @foreach ($opts as $n => $option)
                                    <div class="op">
                                        <table>
                                            <tr>
                                                <td>
                                                    {{ chr(97 + $n) }})
                                                    <input type="checkbox" name="answer[{{ $i }}][]"
                                                        value="{{ $option->oid }}">
                                                </td>
                                                <td>{!! $useAlt && $option->q_option1 ? $option->q_option1 : $option->q_option !!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @elseif ($question->question_type === 'Short Answer')
                                <div class="op">
                                    Answer
                                    <input type="text" autocomplete="off" name="answer[{{ $i }}][]"
                                        value="">
                                </div>
                            @elseif ($question->question_type === 'Long Answer')
                                <div class="form-group">
                                    <label for="long_{{ $i }}">Answer</label>
                                    <textarea name="answer[{{ $i }}][]" id="long_{{ $i }}" class="form-control tinymce_textarea" rows="8"></textarea>
                                </div>
                            @elseif ($question->question_type === 'Match the Column')
                                @php $choices = $opts->shuffle(); @endphp
                                <div class="op">
                                    <table>
                                        @foreach ($opts as $n => $option)
                                            <tr>
                                                <td>{{ chr(97 + $n) }})
                                                    {{ $useAlt && $option->q_option1 ? $option->q_option1 : $option->q_option }}
                                                </td>
                                                <td>
                                                    <select name="answer[{{ $i }}][{{ $option->oid }}]">
                                                        <option value="0">Select</option>
                                                        @foreach ($choices as $choice)
                                                            <option value="{{ $choice->oid }}">
                                                                {{ $useAlt && $choice->q_option_match1 ? $choice->q_option_match1 : $choice->q_option_match }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div style="padding:20px;">No questions found in this exam.</div>
                @endforelse
            </form>
        </div>

        <div class="col-md-3" style="min-height:84%;padding:5px;color:#212121;background:#CEDDF0;">

            <b>Navigator</b>
            <div style="max-height:60%;overflow-y:auto;">
                @foreach ($questions as $i => $question)
                    <div class="qbtn" id="qbtn_{{ $i }}" onclick="showQ({{ $i }});">
                        {{ $i + 1 }}</div>
                @endforeach

                <br><br><br>
                <div class="op">
                    <b>Notepad</b>
                    <textarea style="width:100%;height:100px;"></textarea><br>
                </div>
                <div style="clear:both;"></div>
            </div>
            <hr>

            <table>
                <tr>
                    <td style="font-size:12px;">
                        <div class="qbtn" style="background:#449d44;">&nbsp;</div> Answered
                    </td>
                    <td style="font-size:12px;">
                        <div class="qbtn" style="background:#c9302c;">&nbsp;</div> UnAnswered
                    </td>
                    <td style="font-size:12px;">
                        <div class="qbtn" style="background:#ec971f;">&nbsp;</div> Review Later
                    </td>
                    <td style="font-size:12px;">
                        <div class="qbtn" style="background:#212121;">&nbsp;</div> Not Visited
                    </td>
                </tr>
            </table>

            <div style="clear:both;"></div>
        </div>
    </div>

    <div class="footer_buttons" style="background:#3D4A5D;">
        <button class="btn btn-warning" type="button" onclick="flagQ();" style="margin-top:2px;">Flag</button>
        <button class="btn btn-info" type="button" onclick="clearQ();" style="margin-top:2px;">Clear</button>
        <button class="btn btn-success" type="button" id="backbtn" style="visibility:hidden;margin-top:2px;"
            onclick="showQ(current - 1);">Back</button>
        <button class="btn btn-success" type="button" id="nextbtn" style="margin-top:2px;"
            onclick="showQ(current + 1);">Save &amp; Next</button>

        <button class="btn btn-danger" type="button" onclick="endExam();" style="margin-top:2px;float:right;">End
            Exam</button>
    </div>

    <script>
        var total = {{ $questions->count() }};
        var current = 0;
        var visited = {};
        var flagged = {};

        function isAnswered(n) {
            var box = document.getElementById('q_' + n);
            if (!box) return false;

            var checked = box.querySelectorAll('input[type=radio]:checked, input[type=checkbox]:checked').length > 0;
            var typed = Array.prototype.some.call(box.querySelectorAll('input[type=text], textarea'), function(el) {
                return el.value.trim() !== '';
            });
            var picked = Array.prototype.some.call(box.querySelectorAll('select'), function(el) {
                return el.value !== '0';
            });

            return checked || typed || picked;
        }

        function refreshNav() {
            for (var n = 0; n < total; n++) {
                var btn = document.getElementById('qbtn_' + n);
                var color = '#212121'; // not visited

                if (flagged[n]) color = '#ec971f';
                else if (isAnswered(n)) color = '#449d44';
                else if (visited[n]) color = '#c9302c';

                btn.style.background = color;
                btn.classList.toggle('current', n === current);
            }
        }

        function showQ(n) {
            if (total === 0 || n < 0 || n > total - 1) return;

            document.querySelectorAll('.question_div').forEach(function(d) {
                d.style.display = 'none';
            });

            document.getElementById('q_' + n).style.display = 'block';
            current = n;
            visited[n] = true;

            document.getElementById('backbtn').style.visibility = n === 0 ? 'hidden' : 'visible';
            document.getElementById('nextbtn').textContent = n === total - 1 ? 'Save' : 'Save & Next';

            refreshNav();
        }

        function flagQ() {
            flagged[current] = !flagged[current];
            refreshNav();
        }

        function clearQ() {
            var box = document.getElementById('q_' + current);
            box.querySelectorAll('input[type=radio], input[type=checkbox]').forEach(function(el) {
                el.checked = false;
            });
            box.querySelectorAll('input[type=text], textarea').forEach(function(el) {
                el.value = '';
            });
            box.querySelectorAll('select').forEach(function(el) {
                el.value = '0';
            });
            refreshNav();
        }

        function endExam() {
            if (confirm('Are you sure you want to end the exam?')) {
                window.location = "{{ route('viewResult') }}";
            }
        }

        // Keep the navigator colours in step with the answers
        document.getElementById('quiz_form').addEventListener('input', refreshNav);
        document.getElementById('quiz_form').addEventListener('change', refreshNav);

        // Countdown timer (exam duration is in minutes)
        var totalSeconds = {{ (int) $exam->duration * 60 }};

        function pad(t) {
            return t < 10 ? '0' + t : t;
        }

        function tick() {
            var s = totalSeconds;
            var h = Math.floor(s / 3600);
            s -= h * 3600;
            var m = Math.floor(s / 60);
            s -= m * 60;

            document.getElementById('timer').textContent = pad(h) + ':' + pad(m) + ':' + pad(s);

            if (totalSeconds <= 0) {
                alert("Time's up!");
                window.location = "{{ route('listExam') }}";
                return;
            }

            totalSeconds -= 1;
            setTimeout(tick, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            tick();
            showQ(0);
        });
    </script>

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

</body>

</html>
