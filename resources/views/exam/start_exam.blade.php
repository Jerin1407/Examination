<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Start Exam')</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- custom css -->
    <link href="{{ asset('css/style.css?q=' . time()) }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- TinyMCE Text Editor -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .logo {
            font-size: 20px;
            line-height: 50px;
            text-align: center;
            margin-top: 10px;
            padding: 0 10px;
            width: 100%;
            font-family: 'Kaushan Script', cursive;
            font-weight: 400;
            height: 48px;
            display: block;
            background-color: #367fa9;
            color: #f9f9f9;
            box-sizing: border-box;
        }

        .sidebar {
            width: 16rem !important;
        }

        .logo-style {
            width: 173px;
            float: left;
            margin: 10px 2px 0;
        }
    </style>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        var base_url = "{{ url('/') }}";
    </script>

    @if (request()->segment(1) . '/' . request()->segment(2) != 'quiz/attempt')
        <!-- custom javascript -->
        <script src="{{ asset('js/basic.js?q=' . time()) }}"></script>
    @endif

    <!-- firebase messaging manifest.json -->
    <link rel="manifest" href="{{ asset('js/manifest.json') }}">

    <!-- Template javascript -->
    <script src="{{ asset('js/basic.js?q=' . time()) }}"></script>
    <style>
        td {
            font-size: 14px;
            padding: 4px;
        }

        .row {
            margin: 0px;
        }
    </style>

    <script>
        var Timer;
        var TotalSeconds;

        function CreateTimer(TimerID, Time) {
            Timer = document.getElementById(TimerID);
            TotalSeconds = Time;

            UpdateTimer()
            window.setTimeout("Tick()", 1000);
        }

        function Tick() {
            if (TotalSeconds <= 0) {
                alert("Time's up!");
                return;
            }

            TotalSeconds -= 1;

            UpdateTimer()
            window.setTimeout("Tick()", 1000);
        }

        function UpdateTimer() {
            var Seconds = TotalSeconds;

            var Days = Math.floor(Seconds / 86400);
            Seconds -= Days * 86400;

            var Hours = Math.floor(Seconds / 3600);
            Seconds -= Hours * (3600);

            var Minutes = Math.floor(Seconds / 60);
            Seconds -= Minutes * (60);

            var TimeStr = ((Days > 0) ? Days + " days " : "") + LeadingZero(Hours) + ":" + LeadingZero(Minutes) + ":" +
                LeadingZero(Seconds)

            Timer.innerHTML = TimeStr;
        }

        function LeadingZero(Time) {
            return (Time < 10) ? "0" + Time : +Time;
        }

        setTimeout(submitform, '');

        // function submitform() {
        //     alert('Time Over');
        //     window.location = "{{ route('viewResult') }}";
        // }
    </script>
</head>

<body>

    <div class=" ">

    <div style="background:#3D4A5D;padding:4px;color:#ffffff;">
        <div class="save_answer_signal" id="save_answer_signal2"></div>
        <div class="save_answer_signal" id="save_answer_signal1"></div>

        <div style="float:right;width:150px; margin-right:10px;">
            Time left: <span id='timer'>
                <script type="text/javascript">
                    window.onload = CreateTimer("timer");
                </script>
            </span>
        </div>
        <div style="float:left;width:150px; ">
            <h4>exam name</h4>
        </div>
        <div style="clear:both;"></div>
    </div>

    <div style="clear:both;"></div>

    <div class="row" style="margin-top:0px;">
        <div class="col-md-9">

            <!-- Category button -->
            <div class="row" style="margin:2px;">

                <a href="javascript:switch_category('cat_');" class="btn btn-info"
                    style="cursor:pointer;margin-left:5px;">category</a>
                <input type="hidden" id="cat_" value="">
            </div>

            <form method="post" action="" id="quiz_form">
                @csrf
                <input type="hidden" name="rid" value="" class="rid">
                <input type="hidden" name="noq" value="" class="noq">
                <input type="hidden" name="individual_time" id="individual_time" value="">

                <div id="q" class="question_div">
                    <div class="question_container">
                        paragraph<br>
                        question paragraph
                        <hr>

                        question 1)<br>

                        lorem ipsum dolor sit amet,
                    </div>

                    <div class="option_container">

                        {{-- multiple choice single answer --}}

                        <input type="hidden" name="question_type[]" id="q_type" value="1">

                        <div class="op">
                            <table>
                                <tr>
                                    <td>
                                        abc)
                                        <input type="radio" name="answer[][]" id="answer_value" value="">
                                    </td>
                                    <td>q_option</td>
                                </tr>
                            </table>
                        </div>

                        {{-- multiple choice multiple answer --}}

                        <input type="hidden" name="question_type[]" id="q_type" value="2">

                        <div class="op">
                            <table>
                                <tr>
                                    <td>
                                        abc) <input type="checkbox" name="answer[][]" id="answer_value" value="">
                                    </td>
                                    <td>q_option</td>
                                </tr>
                            </table>
                        </div>

                        {{-- short answer --}}

                        <input type="hidden" name="question_type[]" id="q_type" value="4">

                        <div class="op">
                            answer
                            <input type="text" autocomplete="off" name="answer[][]" value="" id="answer_value">
                        </div>

                        {{-- long answer --}}

                        <input type="hidden" name="question_type[]" id="q_type" class="q_k" value="5">
                        <input type="hidden" class="qu_id" value="" name="qstn_no">

                        <div class="form-group">
                            <label for="texteditor_">answer</label>
                            <textarea name="lng_answer" id="texteditor_" class="form-control tinymce_textarea"></textarea>
                        </div>
                        <button class="btn btn-default answer-submit" value=""
                            type="button">submit</button><br><br>
                        <div class="text_data"></div>

                        <div class="form-group">
                            <label for="userfile" id="file_upl">file_upload</label>
                            <input type="file" class="data_file" id="userfile" name="userfile">
                            <div class="col-xs-8">
                                <div id='attachments'></div>
                            </div>
                            <button class="btn btn-default upload" value="" type="button">upload</button>
                        </div>

                        {{-- match the column --}}

                        <input type="hidden" name="question_type[]" id="q_type" value="3">

                        <div class="op">
                            <table>
                                <tr>
                                    <td>abc) 1</td>
                                    <td>
                                        <select name="answer[][]" id="answer_value">
                                            <option value="0">Select</option>
                                            <option value=""></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="parag" id="parag" value="0">
            </form>
        </div>

        <div class="col-md-3" style="min-height:84%;padding:5px;color:#212121;background:#CEDDF0;">

            <b>Navigator</b>
            <div style="max-height:60%;overflow-y:auto;">
                <div class="qbtn" onclick="javascript:show_question('');" id="qbtn">1</div>

                <br><br><br>
                <div class="op">
                    <b>Notepad</b>
                    <textarea style="width:100%;height:100%;"></textarea><br>
                </div>
                <div style="clear:both;"></div>
            </div>
            <hr>
            <div></div>

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
</div>

<div class="footer_buttons" style="background:#3D4A5D;">
    <button class="btn btn-warning" onclick="javascript:review_later();" style="margin-top:2px;">Flag</button>

    <button class="btn btn-info" onclick="javascript:clear_response();" style="margin-top:2px;">Clear</button>

    <button class="btn btn-success" id="backbtn" style="visibility:hidden;margin-top:2px;"
        onclick="javascript:show_back_question();">Back</button>

    <button class="btn btn-success" id="nextbtn" style="margin-top:2px;">Save & Next</button>

    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <button class="btn btn-success highlighter" style="background-color:orange;" type="button" id="highlighter">
        Highlighter
    </button>

    <button class="btn btn-danger" onclick="javascript:cancelmove();" style="margin-top:2px;float: right;">End
        Exam</button>
</div>

</body>

</html>
