@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Team</h1>

    <a href="/add-new-account">Add new account</a>

    <!-- Recent Members Table (Static content) -->
    <div class="bg-white shadow rounded-lg p-6">
        <table class="min-w-full table-auto text-left">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Sponsor</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                {!! $accounts !!}
            </tbody>
        </table>
    </div>
</div>
@endsection
