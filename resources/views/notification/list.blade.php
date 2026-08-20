@extends('layouts.app')

@section('title', 'List Notification')

@section('content')

<div class="container">
 
    <h3>List Notification</h3>
 
    <div class="row">
        <div class="col-lg-6">
            <form method="post" action="{{ route('notification.index') }}">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="{{ __('lang.search') }}...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">{{ __('lang.search') }}</button>
                    </span>
                </div><!-- /input-group -->
            </form>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
 
    <div class="row">
        <div class="col-md-12">
            <br>
 
            @if (session('message'))
                {!! session('message') !!}
            @endif
 
            @if (in_array('All', $acp))
                <a href="{{ route('notification.add_new') }}" class="btn btn-success">{{ __('lang.add_new') }}</a><br><br>
            @endif
 
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>{{ __('lang.title') }}</th>
                    <th>{{ __('lang.message') }}</th>
                    @if ($loggedIn['su'] == '1')
                        <th>{{ __('lang.click_action') }}</th>
                        <th>{{ __('lang.notification_to') }}</th>
                    @endif
                    <th>{{ __('lang.date') }}</th>
                </tr>
 
                @if (count($result) == 0)
                    <tr>
                        <td colspan="6">{{ __('lang.no_record_found') }}</td>
                    </tr>
                @endif
 
                @foreach ($result as $val)
                    <tr>
                        <td>{{ $val['nid'] }}</td>
                        <td><a href="{{ $val['click_action'] }}" target="fcmclick">{{ $val['title'] }}</a></td>
                        <td>{{ $val['message'] }}</td>
 
                        @if ($loggedIn['su'] == '1')
                            <td>{{ $val['click_action'] }}</td>
                            <td>
                                @if ($val['uid'] == 0)
                                    {{ __('lang.all_users') }}
                                @else
                                    <a href="{{ route('user.edit_user', $val['uid']) }}">{{ $val['first_name'] }} {{ $val['last_name'] }}</a>
                                @endif
                            </td>
                        @endif
 
                        <td>{{ $val['notification_date'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
 
    @php
        $rowsPerPage = config('app.number_of_rows');
        $back = ($limit - $rowsPerPage) >= 0 ? $limit - $rowsPerPage : 0;
        $next = $limit + $rowsPerPage;
    @endphp
 
    <a href="{{ route('notification.index', $back) }}" class="btn btn-primary">{{ __('lang.back') }}</a>
    &nbsp;&nbsp;
    <a href="{{ route('notification.index', $next) }}" class="btn btn-primary">{{ __('lang.next') }}</a>
 
</div>
    
@endsection