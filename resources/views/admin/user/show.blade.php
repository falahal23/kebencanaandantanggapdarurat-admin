@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h3>Detail User</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Dibuat:</strong> {{ optional($user->created_at)->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
