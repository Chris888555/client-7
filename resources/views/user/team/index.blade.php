@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Team</h1>

    <a href="/teams" class="btn btn-info btn-md mb-4 active">Team</a>
    <a href="/genealogy" class="btn btn-info btn-md mb-4">Genealogy</a>

    <!-- Recent Members Table (Static content) -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="table-responsive">
            <table class="min-w-full table-auto table table-striped">
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
</div>
@endsection
