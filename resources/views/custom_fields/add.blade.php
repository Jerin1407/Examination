@extends('layouts.app')

@section('title', 'Custom Registration Fields')

@section('content')

    <div class="container">

        <h3>Add Custom Registration Fields</h3>

        <div class="row">
            <form method="post" action="">
                @csrf
                <br><br>

                <div class="form-group">
                    <label>Field Name</label>
                    <input type="text" name="field_title" class="form-control" value="" required>
                </div>

                <div class="form-group">
                    <label>Field Type</label>
                    <select name="field_type" class="form-control">
                        <option value="text" @selected(old('field_type') == 'text')>Text</option>
                        <option value="password" @selected(old('field_type') == 'password')>Password</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Field Validate</label>
                    <input type="text" name="field_validate" class="form-control"
                        value="{{ old('field_validate', 'pattern="[A-Za-z0-9]{1,100}"') }}">
                </div>

                <div class="form-group">
                    <label>Field Default Validate</label>
                    <input type="text" name="field_value" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label>Display or Mandatory to fill at</label>
                    <select name="display_at" class="form-control">
                        <option value="Registration" @selected(old('display_at') == 'Registration')>Registration</option>
                        <option value="Result" @selected(old('display_at') == 'Result')>Before Showing Result</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>

@endsection
