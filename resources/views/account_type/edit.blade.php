@extends('layouts.app')

@section('title', 'Edit Account Type')

@section('content')

    <div class="container">

        <h3>Edit Account Type</h3>

        <div class="row">
            <form method="post" action="{{ route('updateAccountType', $accountType->account_id) }}">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('account_name', $accountType->account_name) }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Users</label><br>

                                @foreach (['Add', 'Edit', 'View', 'List', 'List_all', 'Myaccount', 'Remove'] as $perm)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="{{ $perm }}" name="users[]"
                                            {{ in_array($perm, old('users', $selected['users'])) ? 'checked' : '' }}>
                                        {{ $perm === 'Myaccount' ? 'My Account' : ($perm === 'List_all' ? 'List All' : $perm) }}
                                    </label>
                                @endforeach

                            </div>
                            <div class="form-group">
                                <label>Quiz</label><br>

                                @foreach (['Attempt', 'Add', 'Edit', 'View', 'List', 'List_all', 'Remove'] as $perm)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="{{ $perm }}" name="quiz[]"
                                            {{ in_array($perm, old('quiz', $selected['quiz'])) ? 'checked' : '' }}>
                                        {{ $perm === 'List_all' ? 'List All' : $perm }}
                                    </label>
                                @endforeach

                            </div>
                            <div class="form-group">
                                <label>Result</label><br>

                                @foreach (['View', 'List', 'List_all', 'Remove'] as $perm)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="{{ $perm }}" name="results[]"
                                            {{ in_array($perm, old('results', $selected['results'])) ? 'checked' : '' }}>
                                        {{ $perm === 'List_all' ? 'List All' : $perm }}
                                    </label>
                                @endforeach

                            </div>
                            <div class="form-group">
                                <label>Questions</label><br>

                                @foreach (['Add', 'Edit', 'View', 'list', 'List_all', 'Remove'] as $perm)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="{{ $perm }}" name="questions[]"
                                            {{ in_array($perm, old('questions', $selected['questions'])) ? 'checked' : '' }}>
                                        {{ $perm === 'List_all' ? 'List All' : ucfirst($perm) }}
                                    </label>
                                @endforeach

                            </div>
                            <div class="form-group">
                                <label>Study Material</label><br>

                                @foreach (['Add', 'Edit', 'View', 'List', 'List_all', 'Remove'] as $perm)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="{{ $perm }}" name="study_material[]"
                                            {{ in_array($perm, old('study_material', $selected['study_material'])) ? 'checked' : '' }}>
                                        {{ $perm === 'List_all' ? 'List All' : $perm }}
                                    </label>
                                @endforeach

                            </div>
                            <div class="form-group">
                                <label>Appointment</label><br>

                                @foreach (['Add', 'Edit', 'View', 'List', 'List_all', 'Remove'] as $perm)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="{{ $perm }}" name="appointment[]"
                                            {{ in_array($perm, old('appointment', $selected['appointment'])) ? 'checked' : '' }}>
                                        {{ $perm === 'List_all' ? 'List All' : $perm }}
                                    </label>
                                @endforeach


                            </div>
                            <div class="form-group">
                                <label>Setting</label><br>

                                <label class="checkbox-inline">
                                    <input type="checkbox" value="All" name="setting"
                                        {{ old('setting', $accountType->setting) === 'All' ? 'checked' : '' }}>
                                    All
                                </label>

                            </div>

                            <button class="btn btn-info" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
