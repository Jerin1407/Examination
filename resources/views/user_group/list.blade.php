@extends('layouts.app')

@section('title', 'User Group')

@section('content')

<div class="container">
 
    <h3>{{ $title }}</h3>
 
    <div class="row">
        <div class="col-md-12">
            <br>
 
            @if (session('message'))
                {!! session('message') !!}
            @endif
 
            <div id="message"></div>
 
            <a href="{{ route('user.add_new_group') }}" class="btn btn-success">Add New</a>
 
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('lang.group_name') }}</th>
                    <th>{{ __('lang.price') }}</th>
                    <th>{{ __('lang.valid_for_days') }}</th>
                    <th>{{ __('lang.action') }}</th>
                </tr>
 
                @if (count($group_list) == 0)
                    <tr>
                        <td colspan="3">{{ __('lang.no_record_found') }}</td>
                    </tr>
                @endif
 
                @foreach ($group_list as $val)
                    <tr>
                        <td>{{ $val['group_name'] }}</td>
                        <td>{{ config('app.base_currency_prefix') }} {{ $val['price'] }} {{ config('app.base_currency_sufix') }}</td>
                        <td>{{ $val['valid_for_days'] }}</td>
                        <td>
                            <a href="{{ route('user.edit_group', $val['gid']) }}"><img src="{{ asset('images/edit.png') }}"></a>
 
                            {{-- Named "pre_remove_group" (a confirmation step before the actual
                                 delete, presumably), so this one's a plain GET navigation by
                                 design rather than a direct-delete link like the other list
                                 views' remove_entry() calls — no @csrf/POST concern here. --}}
                            <a href="{{ route('user.pre_remove_group', $val['gid']) }}"><img src="{{ asset('images/cross.png') }}"></a>
                        </td>
                    </tr>
                @endforeach
            </table>
 
        </div>
    </div>
 
</div>

@endsection