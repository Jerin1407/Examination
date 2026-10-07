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

{{-- <script>
    $("#nextbtn").click(function() {
        if ($(".answer-submit").is(":visible")) {
            var id = $('.answer-submit:visible').val();
            saveExam(id);
        }
        show_next_question();
    })

    var ctime = 0;
    var ind_time = new Array();

    @php
        $ind_time = explode(',', $quiz['individual_time']);
    @endphp
    @for ($ct = 0; $ct < $quiz['noq']; $ct++)
        ind_time[{{ $ct }}] = {{ $ind_time[$ct] ?? 0 }};
    @endfor

    noq = "{{ $quiz['noq'] }}";
    show_question('0');

    function increasectime() {
        ctime += 1;
    }
    setInterval(increasectime, 1000);
    setInterval(setIndividual_time, 30000);
</script> --}}

<div id="warning_div"
    style="padding:10px; position:fixed;z-index:100;display:none;width:100%;border-radius:5px;height:200px; border:1px solid #dddddd;left:4px;top:70px;background:#ffffff;">
    <center>
        <b>{{ __('lang.really_Want_to_submit') }}</b> <br><br>
        <span id="processing"></span>

        <a href="javascript:cancelmove();" class="btn btn-danger" style="cursor:pointer;">{{ __('lang.cancel') }}</a>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="javascript:submit_quiz();" class="btn btn-info"
            style="cursor:pointer;">{{ __('lang.submit_quiz') }}</a>
    </center>
</div>

<script type="text/javascript" src="{{ asset('editor/tinymce.min.js') }}"></script>

{{-- <script type="text/javascript">
    tinymce.init({
        selector: '.tinymce_textarea',
        height: 100,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image jbimages {{ config('app.eqneditor') ? 'eqneditor' : '' }} charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | {{ config('app.eqneditor') ? 'eqneditor' : '' }}',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
        image_advtab: true,
        templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            },
            {
                title: 'Test template 2',
                content: 'Test 2'
            }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    $(document).on("change", "#userfile", function() {
        var rid = $('#rid').val();
        var form = new FormData();
        var file = $(this)[0].files[0];
        form.append('userfile', file);
        form.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('fileupload.do_upload') }}",
            data: form,
            type: "post",
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == "success") {
                    var element = $("<div class='row'>" +
                        "<div class='col-xs-4'>" +
                        "<div class='attachment row'>" +
                        "<p class='pull-left'>" + response.file_name + "</p>" +
                        "<input type='hidden' name='attachment_id[]' id='attachment_id' value = '" +
                        response.id + "'/>&nbsp;&nbsp;&nbsp;&nbsp;" +
                        "<span class='pull-right'><a  class='remove-item'>X</a></span></div></div></div>"
                    );
                    $("#attachments").append(element);
                    var attachment_id = [];
                    $("#attachments input").each(function() {
                        attachment_id.push($(this).val());
                    });
                }
            }
        });
    });

    $(".upload").click(function() {
        var id = $('#attachment_id').val();
        var q_id = $(this).val();
        var rid = $('.rid').val();
        $.ajax({
            url: "{{ route('fileupload.user_files') }}",
            data: {
                id: id,
                q_id: q_id,
                rid: rid,
                _token: '{{ csrf_token() }}'
            },
            type: "post",
            success: function(response) {
                $('#attachments').html("");
                alert("Successfully uploaded....");
            },
            error: function() {}
        });
    });

    $(document).ready(function() {
        var rid = $('.rid').val();
        $('.answer-submit').click(function() {
            var id = $(this).val();
            var content = tinyMCE.get('texteditor_' + id);
            var long_answer = content.getContent()
            $.ajax({
                url: "{{ route('result.add_long_answer') }}",
                data: {
                    long_answer: long_answer,
                    rid: rid,
                    q_id: id,
                    _token: '{{ csrf_token() }}'
                },
                type: "post",
                success: function(response) {},
                error: function() {}
            });
        });
    });

    function change_color_set(qn) {
        var did = '#qbtn' + qn;
        var q_type = '#q_type' + lqn;
        var ldid = '#qbtn' + lqn;
        var green = 0;
        var answer_value = "#answer_value" + lqn;
        if ($(answer_value).val() != '') {
            $(ldid).css('backgroundColor', '#449d44');
            $(ldid).css('color', '#ffffff');
        }
    }

    function saveExam(id) {
        var rid = $('.rid').val();
        var content = tinyMCE.get('texteditor_' + id);

        change_color_set(lqn);
        var long_answer = content.getContent()
        $.ajax({
            url: "{{ route('result.add_long_answer') }}",
            data: {
                long_answer: long_answer,
                rid: rid,
                q_id: id,
                _token: '{{ csrf_token() }}'
            },
            type: "post",
            success: function(response) {},
            error: function() {}
        });
    }

    $('body').on('click', '#attachments .remove-item', function() {
        $(this).closest('.attachment').remove();
        window.location.reload();
    });

    $('.highlighter').click(function() {
        var range = window.getSelection().getRangeAt(0);
        var selectionContents = range.extractContents();
        var span = document.createElement("span");
        span.appendChild(selectionContents);
        span.setAttribute("class", "uiWebviewHighlight");

        span.style.backgroundColor = "orange";
        span.style.color = "white";

        range.insertNode(span);
    });
</script> --}}
