<!-- resources/views/admin/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Utilisateurs non approuvés</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name }} - {{ $user->email }}
                <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success">Approuver</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
