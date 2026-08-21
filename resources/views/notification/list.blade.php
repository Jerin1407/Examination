@extends('layouts.app')

@section('title', 'List Notification')

@section('content')

    <div class="container">

        <h3>List Notification</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('lang.search') }}...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br>

                <a href="" class="btn btn-success">Add New</a><br><br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Click Action</th>
                        <th>Notification To</th>
                        <th>Date</th>
                    </tr>

                    <tr>
                        <td colspan="6">No records found!</td>
                    </tr>

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
                                        <a href="{{ route('user.edit_user', $val['uid']) }}">{{ $val['first_name'] }}
                                            {{ $val['last_name'] }}</a>
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
            $back = $limit - $rowsPerPage >= 0 ? $limit - $rowsPerPage : 0;
            $next = $limit + $rowsPerPage;
        @endphp

        <a href="{{ route('notification.index', $back) }}" class="btn btn-primary">{{ __('lang.back') }}</a>
        &nbsp;&nbsp;
        <a href="{{ route('notification.index', $next) }}" class="btn btn-primary">{{ __('lang.next') }}</a>

    </div>

@endsection
