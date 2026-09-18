@extends('layouts.app')

@section('title', 'List Notification')

@section('content')

    <div class="container">

        <h3>List Notification</h3>

        <div class="row">
            <div class="col-lg-6">
                <form method="get" action="{{ route('listNotification') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search... "
                            value="{{ $search ?? '' }}">
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

                <a href="{{ route('addNotification') }}" class="btn btn-success">Add New</a><br><br>

                <table class="table table-bordered">
                    <tr>
                        <th>SI.No</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Click Action</th>
                        <th>Notification To</th>
                        <th>Date</th>
                    </tr>

                    @forelse ($notifications as $index => $notification)
                        <tr>
                            <td>{{ $notifications->firstItem() + $index }}</td>
                            <td>
                                <a href="{{ $notification->click_action ?: '#' }}" target="fcmclick">
                                    {{ $notification->title }}
                                </a>
                            </td>
                            <td>{{ $notification->message }}</td>
                            <td>{{ $notification->click_action }}</td>
                            <td>All users</td>
                            <td>{{ $notification->notification_date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No records found!</td>
                        </tr>
                    @endforelse
                </table>

                {{ $notifications->links() }}
            </div>
        </div>

        <a href="" class="btn btn-primary">Back</a>
        &nbsp;&nbsp;
        <a href="" class="btn btn-primary">Next</a>

    </div>

    <script>

        // alert success for add notification
        @if (session('success_add'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#10B981', // green color
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('success_add') }}'
            });
        @endif
    </script>

@endsection
