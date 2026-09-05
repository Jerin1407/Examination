@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="container">
        <h3>Edit User</h3>
        <div class="row">
            <form method="POST" action="{{ route('updateUser', $user->uid) }}">
                @csrf
                <div class="col-md-8"> <br>
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                Group Name:
                                {{-- group_name (Price: 0)  --}}
                                {{ optional($groups->firstWhere('gid', $user->gid))->group_name ?? '—' }}
                                (Price: {{ optional($groups->firstWhere('gid', $user->gid))->price ?? 0 }})
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="sr-only">Email Address </label>
                                <input type="email" id="inputEmail" name="email" value="{{ $user->email }}"
                                    class="form-control" placeholder="Email Address" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="sr-only">Password </label>
                                <input type="text" id="inputPassword" name="password" value="{{ $user->password }}"
                                    class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">First Name </label>
                                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}"
                                    placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"> Last Name </label>
                                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"
                                    placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"> Contact Number </label>
                                <input type="text" name="contact_no" class="form-control" value="{{ $user->contact_no }}"
                                    placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"> Skype ID </label>
                                <input type="text" name="skype_id" class="form-control" value="{{ $user->skype_id }}"
                                    placeholder="Skype ID">
                            </div>
                            <div class="form-group">
                                <label> Select Group </label>
                                <select class="form-control" name="gid" onchange="getexpiry();" id="gid">
                                    <option value="0">Select Group</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->gid }}"
                                            {{ $user->gid == $group->gid ? 'selected' : '' }}>
                                            {{ $group->group_name }} (Price: {{ $group->price }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subscription_expired">Subscription Expired </label>
                                <input type="text" name="subscription_expired" id="subscription_expired"
                                    class="form-control"
                                    value="{{ $user->subscription_expired ? \Carbon\Carbon::createFromTimestamp($user->subscription_expired)->format('Y-m-d H:i:s') : '' }}"
                                    placeholder="Subscription Expired">
                            </div>
                            <div class="form-group">
                                <label>Account Type </label>
                                <select class="form-control" name="su">
                                    <option value="0">Select Account Type</option>
                                    @foreach ($accountTypes as $accountType)
                                        <option value="{{ $accountType->account_id }}"
                                            {{ $user->su == $accountType->account_id ? 'selected' : '' }}>
                                            {{ $accountType->account_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Account Status </label>
                                <select class="form-control" name="user_status">
                                    <option value="Active" {{ $user->user_status == 'Active' ? 'selected' : '' }}>
                                        Active </option>
                                    <option value="Inactive" {{ $user->user_status == 'Inactive' ? 'selected' : '' }}>
                                        Inactive </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Field Title </label>
                                <input type="text" name="field_name" class="form-control" value=""
                                    placeholder="Field Title" field_validate>
                            </div>
                            <button class="btn btn-default" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8">
                <h3>Payment History</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Payment Gateway</th>
                        <th>Paid Date</th>
                        <th>Amount</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                    </tr>

                    @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_gateway }}</td>
                            <td>{{ $payment->paid_date ? \Carbon\Carbon::createFromTimestamp($payment->paid_date)->format('Y-m-d H:i:s') : '—' }}
                            </td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->transaction_id }}</td>
                            <td>{{ $payment->payment_status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No Record Found!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

@endsection
