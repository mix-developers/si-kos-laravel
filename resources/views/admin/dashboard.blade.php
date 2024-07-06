@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    @if (Auth::user()->role == 'Admin')
        <div class="row">
            @include('admin.dashboard_component.card1', [
                'count' => $users,
                'title' => 'Users',
                'subtitle' => 'Total users',
                'color' => 'primary',
                'icon' => 'user',
            ])

        </div>
    @else
        @include('admin.dashboard_component.pemilik_kos')
    @endif
@endsection
