@extends('layouts.app')

@section('title', 'View User')

@section('content')

    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
            </div>
            <div class="col-sm-2">
                <a href="" class="pull-right">
                    <img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/?s=100">
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">

                <ul class="list-group">
                    <li class="list-group-item text-muted">Profile</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span>
                        {{ $user->registered_date ? \Carbon\Carbon::createFromTimestamp($user->registered_date)->format('Y-m-d H:i:s') : '—' }}
                    </li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Group Name</strong></span>
                        {{ $group->group_name ?? '—' }}</li>
                    <li class="list-group-item text-right">
                        <span class="pull-left"><strong>Account Type</strong></span>
                        {{ $accountType->account_name ?? '—' }}
                    </li>
                </ul>

                <div class="card shadow py-2">
                    <div class="card-heading" style="padding:5px;">Contact</div>
                    <div class="card-body"><i class="fa fa-envelope fa-1x"></i> {{ $user->email }}</div>
                    <div class="card-body"><i class="fa fa-phone fa-1x"></i> {{ $user->contact_no }}</div>
                </div>

                <ul class="list-group">
                    <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Exam Attempted</strong></span> 0
                    </li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Pass</strong></span> 0</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Fail</strong></span> 0</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Last Attempt</strong></span> Not
                        attempted any quiz</li>
                </ul>

            </div>

            <div class="col-sm-9">
                <h3>Categorywise Performance</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Category</th>
                                <th>Overall Percentage</th>
                                <th>Percentage in last attempt</th>
                            </tr>

                            {{-- <tr style="background-color:{{ intval($val) <= 50 ? '#f2dede' : '#dff0d8' }};"> --}}
                            <tr>
                                <td>category_name</td>
                                <td>0%</td>
                                <td>
                                    <i class="fa fa-arrow-up" style="color:green;" title="improving"></i>
                                    <i class="fa fa-arrow-down" style="color:red;" title="improving2"></i>
                                    0%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3>Questions which was answered incorrect</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>SI.No</th>
                                <th>Question</th>
                                <th>Action</th>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>question</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-eye" title="View Question"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3>Payment History</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
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
                                    <td colspan="5">No record found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">question</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-success">q_option</div>
                        <div class="alert alert-default">q_option</div>

                        q_option = q_option_match<br>

                        <div class="alert alert-success">q_option</div>

                        {{-- long_answer branch was empty in the original — nothing to render. --}}

                        <hr>

                        description
                    </div>
                    <div class="modal-footer">
                        <p>question_type</p>
                        <p>
                            Percent Corrected:
                            no_time_corrected / no_time_served
                            <span style="font-size:10px;">0%</span>
                            not_used
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
