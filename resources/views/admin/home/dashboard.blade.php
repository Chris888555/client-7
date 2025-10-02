@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

    <h1 class=" font-bold mb-6">Quick Actions ⚡</h1>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Manage Users -->
        <a href="{{ route('admin.manage-users') }}"
           class="flex items-center gap-4 p-6 bg-white shadow rounded-xl transition hover:shadow-lg hover:scale-105">
            <div class="rounded-lg p-3 flex items-center justify-center bg-teal-100 text-teal-700">
                <span class="material-icons text-2xl">group</span>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-teal-700">Manage Users</h3>
                <p class="text-sm text-gray-500">View and approve user accounts</p>
            </div>
        </a>

        <!-- Create Materials -->
        <a href="{{ route('materials.create') }}"
           class="flex items-center gap-4 p-6 bg-white shadow rounded-xl transition hover:shadow-lg hover:scale-105">
            <div class="rounded-lg p-3 flex items-center justify-center bg-teal-100 text-teal-700">
                <span class="material-icons text-2xl">add_box</span>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-teal-700">Create Materials</h3>
                <p class="text-sm text-gray-500">Upload new learning materials</p>
            </div>
        </a>

        <!-- Create Package -->
        <a href="{{ route('packages.create') }}"
           class="flex items-center gap-4 p-6 bg-white shadow rounded-xl transition hover:shadow-lg hover:scale-105">
            <div class="rounded-lg p-3 flex items-center justify-center bg-teal-100 text-teal-700">
                <span class="material-icons text-2xl">inventory</span>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-teal-700">Create Packages</h3>
                <p class="text-sm text-gray-500">Add new product/service packages</p>
            </div>
        </a>

        <!-- Academy Courses -->
        <a href="{{ route('academy.course.index') }}"
           class="flex items-center gap-4 p-6 bg-white shadow rounded-xl transition hover:shadow-lg hover:scale-105">
            <div class="rounded-lg p-3 flex items-center justify-center bg-teal-100 text-teal-700">
                <span class="material-icons text-2xl">school</span>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-teal-700">Academy Courses</h3>
                <p class="text-sm text-gray-500">Manage courses, modules & lessons</p>
            </div>
        </a>

        <!-- Theme Settings -->
        <a href="{{ route('admin.theme.settings') }}"
           class="flex items-center gap-4 p-6 bg-white shadow rounded-xl transition hover:shadow-lg hover:scale-105">
            <div class="rounded-lg p-3 flex items-center justify-center bg-teal-100 text-teal-700">
                <span class="material-icons text-2xl">settings</span>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-teal-700">Theme Settings</h3>
                <p class="text-sm text-gray-500">Customize dashboard appearance</p>
            </div>
        </a>

    </div>
</div>
@endsection
