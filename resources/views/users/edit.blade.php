@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="container">
        <h3>Edit User</h3>
        <div class="row">
            <form method="POST" action="">
                @csrf
                <div class="col-md-8"> <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body"> {{-- Success / Error Message --}} @if (session('message'))
                                {!! session('message') !!}
                            @endif {{-- Group Information --}} <div class="form-group">
                                {{ __('group_name') }}:
                                {{ $result['group_name'] }} ({{ __('price_') }}: {{ $result['price'] }}) </div>
                            {{-- Email --}} <div class="form-group"> <label for="inputEmail" class="sr-only">
                                    {{ __('email_address') }} </label> <input type="email" id="inputEmail" name="email"
                                    value="{{ old('email', $result['email']) }}" class="form-control"
                                    placeholder="{{ __('email_address') }}" required autofocus> </div>
                            {{-- Password --}} <div class="form-group"> <label for="inputPassword" class="sr-only">
                                    {{ __('password') }} </label> <input type="text" id="inputPassword" name="password"
                                    value="{{ old('password', $result['password']) }}" class="form-control"
                                    placeholder="{{ __('password') }}"> </div>
                            {{-- First Name --}} <div class="form-group"> <label class="sr-only">
                                    {{ __('first_name') }} </label> <input type="text" name="first_name"
                                    class="form-control" value="{{ old('first_name', $result['first_name']) }}"
                                    placeholder="{{ __('first_name') }}"> </div> {{-- Last Name --}} <div
                                class="form-group"> <label class="sr-only"> {{ __('last_name') }} </label> <input
                                    type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $result['last_name']) }}"
                                    placeholder="{{ __('last_name') }}"> </div> {{-- Contact Number --}} <div
                                class="form-group"> <label class="sr-only"> {{ __('contact_no') }} </label> <input
                                    type="text" name="contact_no" class="form-control"
                                    value="{{ old('contact_no', $result['contact_no']) }}"
                                    placeholder="{{ __('contact_no') }}"> </div> {{-- Skype ID --}} <div
                                class="form-group"> <label class="sr-only"> {{ __('skype_id') }} </label> <input
                                    type="text" name="skype_id" class="form-control"
                                    value="{{ old('skype_id', $result['skype_id']) }}" placeholder="{{ __('skype_id') }}">
                            </div> {{-- Select Group --}} <div class="form-group"> <label> {{ __('select_group') }} </label>
                                <select class="form-control" name="gid" onchange="getexpiry();" id="gid">
                                    @foreach ($group_list as $val)
                                        <option value="{{ $val['gid'] }}"
                                            {{ $result['gid'] == $val['gid'] ? 'selected' : '' }}>
                                            {{ $val['group_name'] }} ({{ __('price_') }}: {{ $val['price'] }})
                                        </option>
                                    @endforeach
                                </select> </div> {{-- Subscription Expiry --}} <div class="form-group"> <label
                                    for="subscription_expired"> {{ __('subscription_expired') }} </label> <input
                                    type="text" name="subscription_expired" id="subscription_expired"
                                    class="form-control"
                                    value="{{ $result['subscription_expired'] != 0 ? date('Y-m-d', $result['subscription_expired']) : '0' }}"
                                    placeholder="{{ __('subscription_expired') }}"> </div> {{-- Account Type --}} <div
                                class="form-group"> <label> {{ __('account_type') }} </label> <select class="form-control"
                                    name="su">
                                    @foreach ($account_type as $val)
                                        <option value="{{ $val['account_id'] }}"
                                            {{ $result['su'] == $val['account_id'] ? 'selected' : '' }}>
                                            {{ $val['account_name'] }} </option>
                                    @endforeach
                                </select> </div> {{-- Account Status --}} <div class="form-group"> <label>
                                    {{ __('account_status') }} </label> <select class="form-control" name="user_status">
                                    <option value="Active" {{ $result['user_status'] == 'Active' ? 'selected' : '' }}>
                                        {{ __('active') }} </option>
                                    <option value="Inactive" {{ $result['user_status'] == 'Inactive' ? 'selected' : '' }}>
                                        {{ __('inactive') }} </option>
                                </select> </div> {{-- Custom Fields --}} @foreach ($custom_form as $fval)
                                <div class="form-group"> <label> {{ $fval['field_title'] }} </label> <input
                                        type="{{ $fval['field_type'] }}" name="custom[{{ $fval['field_id'] }}]"
                                        class="form-control" value="{{ $custom_form_user[$fval['field_id']] ?? '' }}"
                                        {!! $fval['field_validate'] !!}> </div>
                            @endforeach <button class="btn btn-default" type="submit">
                                {{ __('submit') }}
                            </button> </div>
                    </div>
                </div>
            </form>
        </div> {{-- Payment History --}} <div class="row">
            <div class="col-md-8">
                <h3>{{ __('payment_history') }}</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>{{ __('payment_gateway') }}</th>
                        <th>{{ __('paid_date') }}</th>
                        <th>{{ __('amount') }}</th>
                        <th>{{ __('transaction_id') }}</th>
                        <th>{{ __('status') }}</th>
                    </tr>
                    @if (count($payment_history) == 0)
                        <tr>
                            <td colspan="5"> {{ __('no_record_found') }} </td>
                        </tr>
                    @else
                        @foreach ($payment_history as $val)
                            <tr>
                                <td> {{ $val['payment_gateway'] }} </td>
                                <td> {{ date('Y-m-d H:i:s', $val['paid_date']) }} </td>
                                <td> {{ $val['amount'] }} </td>
                                <td> {{ $val['transaction_id'] }} </td>
                                <td> {{ $val['payment_status'] }} </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

@endsection
