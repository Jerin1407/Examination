@extends('layouts.app')

@section('title', 'View Study Material')

@section('content')

    <div class="container">

        <div class="row">
            <br>
            <div class="card panel-default">
                <div class="card-heading" style="padding:10px;">
                    <h3>Study Material : {{ $studyMaterial->title }}</h3>
                </div>
                <div class="card-body" style="padding:10px;">

                    <strong>Description</strong> {!! $studyMaterial->study_description !!}

                    <br>

                    <hr>

                    {{-- <video width="320" height="240" controls>
                        <source src="{{ asset('upload/' . $result['attachment']) }}" type="video/mp4">
                        <source src="{{ asset('upload/' . $result['attachment']) }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video> --}}
                    @if ($studyMaterial->attachment)
                        <a href="{{ asset('storage/' . $studyMaterial->attachment) }}" target="study_material">Download
                            Attachment</a>
                    @else
                        <span>No attachment available</span>
                    @endif

                </div>

                <div class="card-footer" style="padding:10px;">
                    Category: {{ $category->category_name ?? 'N/A' }}
                </div>

                <div class="card-footer" style="padding:10px;">
                    Group Name: <br>

                    @forelse ($groupNames as $groupName)
                        {{ $groupName }}@if (!$loop->last)
                            ,
                        @endif
                        @empty
                            N/A
                        @endforelse
                    </div>
                </div>

                <a href="{{ route('listStudyMaterial') }}">Back</a>
            </div>

        </div>

    @endsection
