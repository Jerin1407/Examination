@extends('layouts.app')

@section('title', 'Add New Exam')

@section('content')

    <div class="container">

        <h3>Add New Exam</h3>

        <div class="row">
            <form method="post" action="">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="quiz_name" class="sr-only">Exam Name</label>
                                <input type="text" id="quiz_name" name="quiz_name" class="form-control"
                                    placeholder="Exam Name" value="{{ old('quiz_name') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control tinymce_textarea"></textarea>
                            </div>

                            <a href="#" data-toggle="collapse" data-target="#advance_options"><u>Advance
                                    options</u></a>

                            <div id="advance_options" class="collapse">

                                <div class="form-group">
                                    <label for="start_date">Start Date (Exam can be attempted after this date. YYYY-MM-DD
                                        HH:II:SS )</label>
                                    <input type="text" id="start_date" name="start_date" value=""
                                        class="form-control" placeholder="Start Date" required>
                                </div>

                                <div class="form-group">
                                    <label for="end_date">End Date (Exam can be attempted before this date. eg. 2017-12-31
                                        23:59:00 )</label>
                                    <input type="text" id="end_date" name="end_date" value="" class="form-control"
                                        placeholder="End Date" required>
                                </div>

                                <div class="form-group">
                                    <label for="duration">Duration (in min.)</label>
                                    <input type="text" id="duration" name="duration" value="" class="form-control"
                                        placeholder="Duration (in min.)" required>
                                </div>

                                <div class="form-group">
                                    <label for="maximum_attempts">Allow Maximum Attempts</label>
                                    <input type="text" id="maximum_attempts" name="maximum_attempts" value=""
                                        class="form-control" placeholder="Allow Maximum Attempts" required>
                                </div>

                                <div class="form-group">
                                    <label for="pass_percentage">Minimum Percentage Required to Pass</label>
                                    <input type="text" id="pass_percentage" name="pass_percentage" value=""
                                        class="form-control" placeholder="Minimum Percentage Required to Pass" required>
                                </div>

                                <div class="form-group">
                                    <label for="correct_score">Correct Score</label>
                                    <input type="text" id="correct_score" name="correct_score" value=""
                                        class="form-control" placeholder="Correct Score" required>
                                </div>

                                <div class="form-group">
                                    <label for="incorrect_score">InCorrect Score</label>
                                    <input type="text" id="incorrect_score" name="incorrect_score" value=""
                                        class="form-control" placeholder="InCorrect Score" required>
                                </div>

                                <div class="form-group">
                                    <label for="ip_address">Allowed ip address to attempt this exam. To allow all, leave
                                        empty.</label>
                                    <input type="text" id="ip_address" name="ip_address" value=""
                                        class="form-control"
                                        placeholder="Allowed ip address to attempt this exam. To allow all, leave empty.">
                                </div>

                                <div class="form-group">
                                    <label>Allow to view correct answers after submitting exam</label> <br>
                                    <input type="radio" name="view_answer" value="1" @checked(old('view_answer', 1) == 1)>
                                    Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="view_answer" value="0" @checked(old('view_answer') === '0')> No
                                </div>

                                <div class="form-group">
                                    <label>Open exam - can be attempted without login?*</label> <br>
                                    <input type="radio" name="with_login" value="0" @checked(old('with_login') === '0')>
                                    Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="with_login" value="1" @checked(old('with_login', 1) == 1)>
                                    No
                                </div>

                                <div class="form-group">
                                    <label>Show ranking on result page</label> <br>
                                    <input type="radio" name="show_chart_rank" value="1"
                                        @checked(old('show_chart_rank', 1) == 1)> Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="show_chart_rank" value="0"
                                        @checked(old('show_chart_rank') === '0')> No
                                </div>

                                <div class="form-group">
                                    <label>Capture Photo</label> <br>
                                    <input type="radio" name="camera_req" value="1" @checked(old('camera_req') == 1)>
                                    Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="camera_req" value="0" @checked(old('camera_req', 0) == 0)>
                                    No
                                </div>
                                <input type="hidden" name="camera_req" value="0">

                                <div class="form-group">
                                    <label>Assign to groups</label> <br>
                                    <input type="checkbox" name="gids[]" value=""> Admin &nbsp;&nbsp;&nbsp;
                                </div>

                                <div class="form-group">
                                    <label>Or
                                        Assign to users</label> <br>

                                    <select class="js-example-basic-multiple form-control" name="uids[]"
                                        multiple="multiple">
                                        <option value="">Admin Admin (admin@example.com)</option>
                                    </select>
                                    <script type="text/javascript">
                                        $(".js-example-basic-multiple").select2();
                                    </script>
                                </div>

                                <div class="form-group">
                                    <label>Exam Template</label> <br>
                                    <select name="quiz_template">
                                        <option value="Default">Default</option>
                                        <option value="Practice">Practice</option>
                                    </select><br>
                                    <a href="">Enable Advance Template</a>
                                    <p>Based on indian examination system</p>
                                </div>

                                <div class="form-group">
                                    <label>How do you want to add questions into this Exam?</label> <br>
                                    <input type="radio" name="question_selection" value="1"
                                        @checked(old('question_selection') == 1)> Automatically - System selects question randomaly
                                    based on given categories,level and No. of questions<br>
                                    <input type="radio" name="question_selection" value="0"
                                        @checked(old('question_selection', 0) == 0)> Manually - Select question manually from question
                                    bank
                                </div>

                                <div class="form-group">
                                    <label>Quiz Price (Set 0 for free)</label> <br>
                                    <input type="text" name="quiz_price" value="0" class="form-control"
                                        placeholder="Enter quiz price" readonly required>
                                    <a href="">Enable this feature</a>
                                </div>

                                <div class="form-group">
                                    <label>Generate Certificate</label> <br>
                                    <input type="radio" name="gen_certificate" value="1"
                                        @checked(old('gen_certificate') == 1)> Yes<br>
                                    <input type="radio" name="gen_certificate" value="0"
                                        @checked(old('gen_certificate', 0) == 0)> No
                                </div>

                                <div class="form-group">
                                    <label for="certificate_text">Certificate Text</label>
                                    <textarea id="certificate_text" name="certificate_text" class="form-control">{{ old('certificate_text') }}</textarea><br>

                                    You can use following tags :
                                    {{ '<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>   <h3></h3>    <font></font>' }}<br>
                                    {email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained},
                                    {score_obtained}, {result}, {generated_date}, {result_id}, {qr_code}
                                </div>

                            </div>
                            <br><br>

                            <button class="btn btn-success" type="submit">Next</button>

                            <br><br><br>
                            *Some validation and features will not work in Open Quiz, however it will work if user logged
                            in.

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
