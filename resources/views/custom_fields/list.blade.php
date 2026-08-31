@extends('layouts.app')

@section('title', 'Custom Registration Fields')

@section('content')

    {{-- @if (session('message'))
    {!! session('message') !!}
@endif --}}
    <br><br>

    <div class="container">

        <h3>List Custom Registration Fields</h3><br>

        <a href="{{ route('addCustomFields') }}" class="btn btn-success">Add New</a><br><br>

        <div class="row">
            <div class="col-md-12">

                <div id="message"></div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>SI.No</th>
                            <th>Field Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>field_title</td>
                            <td>
                                <a href="">
                                    <img src="{{ asset('images/edit.png') }}">
                                </a>
                                <a href="">
                                    <img src="{{ asset('images/cross.png') }}">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
