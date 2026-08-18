@extends('layouts.app')

@section('title', 'View Study Material')

@section('content')

    <div class="container">

        <div class="row">
            <br>
            <div class="card panel-default">
                <div class="card-heading" style="padding:10px;">
                    <h3>Study Material : GitHub</h3>
                </div>
                <div class="card-body" style="padding:10px;">

                    <strong>Description</strong> This is a study material description.

                    <br>

                    <hr>

                    {{-- <video width="320" height="240" controls>
                        <source src="{{ asset('upload/' . $result['attachment']) }}" type="video/mp4">
                        <source src="{{ asset('upload/' . $result['attachment']) }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video> --}}
                    <a href="" target="study_material">Download Attachment</a>

                </div>

                <div class="card-footer" style="padding:10px;">
                    Category: Category 1
                </div>

                <div class="card-footer" style="padding:10px;">
                    Group Name: <br>

                    Admin
                </div>
            </div>

            <a href="">Back</a>
        </div>

    </div>

@endsection
