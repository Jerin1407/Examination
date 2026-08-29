@extends('layouts.app')

@section('title', 'Send New Notification')

@section('content')

    <div class="container">

        <h3>Send New Notification</h3>

        <div class="row">
            <form method="post" action="">
                @csrf

                <div class="col-md-8">
                    <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required id="title" name="title" class="form-control"
                                    value="">
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <input type="text" required id="message" name="message" class="form-control"
                                    value="">
                            </div>

                            <div class="form-group">
                                <label for="click_action">Click Action</label>
                                <input type="text" required id="click_action" name="click_action"
                                    value="{{ old('click_action', url('/')) }}" class="form-control">
                            </div>

                            {{-- @if ($tuid == '0')
                            <input type="hidden" required name="notification_to[]"
                                   value="{{ '/topics/' . config('app.firebase_topic') }}">
                            {{ __('lang.send_to') }}: {{ __('lang.all_users') }}
                            <input type="hidden" required name="uid" value="0">
                            <br><br>
                        @else --}}

                            Send to :
                            All Users<br><br>

                            {{-- <input type="hidden" required name="notification_to[]" value="{{ $nuser->web_token }}">
                            <input type="hidden" required name="notification_to[]" value="{{ $nuser->android_token }}">
                            <input type="hidden" required name="uid" value="{{ $tuid }}"> --}}

                            <button class="btn btn-default" type="submit">Submit</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
