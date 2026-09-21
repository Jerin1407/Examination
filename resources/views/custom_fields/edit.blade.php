@extends('layouts.app')

@section('title', 'Custom Registration Fields')

@section('content')

    <div class="container">

        <h3>Edit Custom Registration Fields</h3>

        <div class="row">
            <form method="post" action="{{ route('updateCustomFields', $field->field_id) }}">
                @csrf
                <br><br>

                <div class="form-group">
                    <label>Field Name</label>
                    <input type="text" name="field_title" class="form-control"
                        value="{{ old('field_title', $field->field_title) }}" required>
                </div>

                <div class="form-group">
                    <label>Field Type</label>
                    <select name="field_type" class="form-control">
                        <option value="text" @selected(old('field_type', $field->field_type) == 'text')>Text</option>
                        <option value="password" @selected(old('field_type', $field->field_type) == 'password')>Password</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Field Validate</label>
                    <input type="text" name="field_validate" class="form-control"
                        value="{{ old('field_validate', $field->field_validate) }}">
                </div>

                <div class="form-group">
                    <label>Field Default Validate</label>
                    <input type="text" name="field_value" class="form-control"
                        value="{{ old('field_value', $field->field_value) }}">
                </div>

                <div class="form-group">
                    <label>Display or Mandatory to fill at</label>
                    <select name="display_at" class="form-control">
                        <option value="Registration" @selected(old('display_at', $field->display_at) == 'Registration')>Registration</option>
                        <option value="Result" @selected(old('display_at', $field->display_at) == 'Result')>Before Showing Result</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>

@endsection
