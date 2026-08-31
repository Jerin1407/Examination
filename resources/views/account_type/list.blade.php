@extends('layouts.app')

@section('title', 'List Account Type')

@section('content')

    {{-- @if (session('message'))
    {!! session('message') !!}
@endif --}}
    <br><br>

    <div class="container">

        <h3>List Account Type</h3><br>

        <a href="" class="btn btn-success">Add New</a><br><br>

        <div class="row">
            <div class="col-md-12">

                <div id="message"></div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>account - 1</td>
                            <td>
                                <a href="{{ route('editAccountType') }}">
                                    <img src="{{ asset('images/edit.png') }}">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
