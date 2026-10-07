@extends('layouts.app')

@section('title', 'View Result')

@section('content')

<script src="{{ asset('js/TweenMax.min.js') }}"></script>
<style>
    @media print {
        .navbar { display: none; }
        #footer { display: none; }
        .printbtn { display: none; }
        #social_share { display: none; }
        #page_break2 { page-break-after: always; }
        .noprint { display: none; }
    }
 
    @media screen {
        .onlyprint { display: none; }
    }
 
    td {
        color: #212121;
        font-size: 14px;
        padding: 4px;
    }
 
    .circle_result {
        width: 40px;
        height: 40px;
        border-radius: 20px;
        background: #0b8d6f;
        color: #ffffff;
        padding: 5px;
        font-size: 16px;
        text-align: center;
        margin-right: 20px;
        float: left;
    }
 
    .circle_ur {
        width: 40px;
        height: 40px;
        border-radius: 20px;
        background: #ffcc66;
        color: #ffffff;
        padding: 5px;
        font-size: 16px;
        text-align: center;
        margin-right: 20px;
        float: left;
    }
 
    .circle_l {
        width: 40px;
        height: 40px;
        border-radius: 20px;
        background: #ff3300;
        color: #ffffff;
        padding: 5px;
        font-size: 16px;
        text-align: center;
        margin-right: 20px;
        float: right;
    }
 
    .td_line {
        background: url('{{ asset('images/rankbar.png') }}');
        background-repeat: repeat-x;
    }
</style>
 
<div class="container">
 
    <div class="row noprint">
 
        <div class="col-lg-12"
             style="background-image:url('{{ asset('images/result_bg.jpg') }}');background-size:cover;font-size:18px;padding:20px;color:#ffffff;min-height:400px;">
 
            <div class="col-lg-12">
                <center>
                    <h2><span style="color:#e39500;">exam name</span></h2>
                </center>
            </div>
            <div class="col-lg-12">
                <center>
                    <h3><span style="color:#e39500;">Thank you for attempting the exam.</span></h3>
                </center>
            </div>
            <div class="col-lg-12">
                <center>
                    <h3><span style="color:#e39500;">Your result will be published on the website after valuation.</span></h3>
                </center>
            </div>
        </div>
    </div>
</div>
 
<script>
    $('.s_title').tooltip('show');
</script>
<script>
    function shoq(id) {
        if (id == "-1") {
            var did = ".rqn";
            $(did).css('display', 'block');
        } else {
            var did = ".rqn";
            $(did).css('display', 'none');
            var didd = "#qn" + id;
            $(didd).css('display', 'block');
        }
    }
</script>
 
<!-- disable copy, right click -->
<script type="text/javascript">
    $(document).ready(function() {
        //Disable cut copy paste
        $('body').bind('cut copy paste', function(e) {
            e.preventDefault();
        });
 
        //Disable mouse right click
        $("body").on("contextmenu", function(e) {
            return false;
        });
    });
</script>
<!-- disable copy, right click ends -->
 
<script type="text/javascript" src="{{ asset('editor/tinymce.min.js') }}"></script>
<script type="text/javascript">
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
</script>

@endsection