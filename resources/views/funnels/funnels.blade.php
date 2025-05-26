@extends('layouts.users')

@section('title', 'Your Funnel')

@section('content')
    <h1>Your Funnel Type</h1>

    <div class="funnel-type">
        <p>Funnel: {{ $funnelValue ?? 'No funnel assigned' }}</p>
    </div>
@endsection
