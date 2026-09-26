@extends('layouts.app')

@section('title', 'Add Question')

@section('content')

<div class="container">
 
    <h3>Add questions into exam: (exam name)</h3>
 
    <a href="" class="btn btn-info">Back to exam</a><br><br>
 
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

            <input type="hidden" id="added" value="{{ __('lang.added') }}">

            <div class="form-group">
                <form method="post" action="">
                    @csrf
                    <select name="cid">
                        <option value="0">All Category</option>
                            <option value="">category_name</option>
                    </select>
 
                    <select name="lid">
                        <option value="0">All Level</option>
                            <option value="">level_name</option>
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
 
                    <tr>
                            <td colspan="3">No records found!</td>
                        </tr>
 
                    <tr>
                        <td>
                            <a href="javascript:show_question_stat('');">+</a>
                            
                        </td>
                        <td>
                            question
 
                            <span style="display:none;" id="stat-">
                                <table class="table table-bordered">
                                    <tr><td>No. of Times Corrected</td><td></td></tr>
                                    <tr><td>No. of Times Incorrected</td><td></td></tr>
                                    <tr><td>No. of Times Unattempted</td><td></td></tr>
                                </table>
                            </span>
                        </td>
                        <td>question_type</td>
                        <td>Category_name / <span style="font-size:12px;">Level_name </span></td>
                        <td>
                                <div style="background:#eeeeee;width:100%;height:10px;">
                                    <div style="background:#449d44;width:0%;height:10px;"></div>
                                    <span style="font-size:10px;">0%</span>
                                </div>
                                {{-- Not used --}}
                        </td>
                        <td>
                            <a href="javascript:addquestion('','');" class="btn btn-primary" id="q">
                                Add / Added
                            </a>
                        </td>
                    </tr>
            </table>
        </div>
    </div>
 
    <a href="" class="btn btn-primary">Back</a>
    &nbsp;&nbsp;
    <a href="" class="btn btn-primary">Next</a>
 
</div>

@endsection