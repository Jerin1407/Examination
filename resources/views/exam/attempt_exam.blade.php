@extends('layouts.app')

@section('title', 'Attempt Exam')

@section('content')

    <div class="container">

        <h3>Attempt Exam</h3>

        <div class="row">
            <form method="post" id="quiz_detail" action="">
                @csrf

                <div class="col-md-12">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <table class="table table-bordered">
                                <tr>
                                    <td>Exam Name</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Description<br></td>
                                </tr>
                                <tr>
                                    <td>Start Date (Exam can be attempted after this date. YYYY-MM-DD HH:II:SS )</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>End Date (Exam can be attempted before this date. eg. 2017-12-31 23:59:00 )</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Duration (in min.)</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Allow Maximum Attempts</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Minimum Percentage Required to Pass</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Correct Score</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>InCorrect Score</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Select Language</td>
                                    <td>
                                        <select name="selected_lang" id="changelang">
                                            <option value="English">English</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>

                            <div style="color:#ff0000;">camera_instructions</div>
                            <div id="my_photo"
                                style="width:500px;height:500px;background:#212121;padding:2px;border:1px solid #666666;color:red">
                            </div>
                            <br><br>

                            <script type="text/javascript" src="{{ asset('js/webcamjs/webcam.js') }}"></script>
                            {{-- <script language="JavaScript">
                                Webcam.set({
                                    width: 500,
                                    height: 500,
                                    image_format: 'jpeg',
                                    jpeg_quality: 90
                                });
                                Webcam.attach('#my_photo');

                                function take_snapshot() {
                                    Webcam.snap(function(data_uri) {
                                        document.getElementById('my_photo').innerHTML = '<img src="' + data_uri + '"/>';
                                    });
                                }

                                function upload_photo() {
                                    Webcam.snap(function(data_uri) {
                                        Webcam.upload(data_uri, '{{ route('quiz.upload_photo') }}', function(code, text) {
                                            // Upload complete!
                                            // 'code' will be the HTTP response code from the server, e.g. 200
                                            // 'text' will be the raw response content
                                            document.getElementById('quiz_detail').submit();
                                        });
                                    });
                                }

                                function capturephoto() {
                                    void(take_snapshot());
                                    upload_photo();
                                }
                            </script> --}}

                            <button class="btn btn-success" type="button"
                                onclick="javascript:capturephoto();">capture_start_quiz</button>
                            <button class="btn btn-success" type="submit">start_quiz</button>

                            <button class="btn btn-success" type="submit">Start Exam</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="">Back</a>

                            <div class="alert alert-danger">login_required</div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="">Back</a>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
