@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Members</h1>
    <!-- Recent Members Table (Static content) -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="table-responsive">
            <table class="min-w-full table-auto table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Sponsor</th>
                        <th>Upline</th>
                        <th>Type</th>
                        <th>Position</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $ctr => $value)
                        <tr>
                            <td>{{ $ctr + 1 }}</td>
                            <td>{{ $value->users->full_name }}</td>
                            <td>{{ $value->users->username }}</td>
                            <td>{{ $value->users->dpassword }}</td>
                            <td>{{ $value->sponsor }}</td>
                            <td>{{ $value->upline }}</td>
                            <td>{{ $value->codes->codesettings->prefix }}</td>
                            <td>{{ $value->pos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
