@extends('layouts.app')

@section('title', 'List Question Bank')

@section('content')

    <div class="container">

        <h3>List Question Bank</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
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
                    <form method="post" action="">
                        @csrf
                        <select name="cid">
                            <option value="0">All Category</option>
                            <option value="0">All Category</option>
                        </select>

                        <select name="lid">
                            <option value="0">All Level</option>
                            <option value="0">All Level</option>
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

                    {{-- <tr>
                        <td colspan="3">No questions found</td>
                    </tr> --}}

                    <tr>
                        <td>
                            <a href="">+</a>
                            1000
                        </td>
                        <td>

                            <span style="display:none;">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>No. of Times Corrected</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>No. of Times Incorrected</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>No. of Times Unattempted</td>
                                        <td>0</td>
                                    </tr>
                                </table>
                            </span>
                        </td>
                        <td>Long Answer</td>
                        <td>PART-1 / FOUNDATION- P1: ACCOUNTING</span></td>
                        <td>
                            <div style="background:#eeeeee;width:100%;height:10px;">
                                <div style="background:#449d44;width:10%;height:10px;"></div>
                                <span style="font-size:10px;">10%</span>
                            </div>
                            {{-- Not Used --}}
                        </td>
                        <td>
                            <a href=""><img src="{{ asset('images/edit.png') }}"></a>

                            <a href="">
                                <img src="{{ asset('images/cross.png') }}">
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

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

                    <a href="{{ asset('sample/sample.xls') }}" target="new">Click here</a> to download sample file to know
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
