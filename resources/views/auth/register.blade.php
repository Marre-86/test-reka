@extends('layouts.main')
@section('content')

<div class="w-30">

<div class="card">
                <div class="card-header">
                  <h3>Register</h3>
                </div>
                <div class="card-body">


    @if ($errors->any())
        <div>
            <div>Something went wrong!</div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <div class="form-group row" style="margin-top:10px">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" class="form-control-plaintext" value="{{ old('name') }}" autofocus>
            </div>
        </div>
        <div class="form-group row" style="margin-top:10px">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" id="email" name="email" class="form-control-plaintext" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group row" style="margin-top:10px">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" id="password" name="password" class="form-control-plaintext" value="{{ old('password') }}">
            </div>
        </div>
        <div class="form-group row" style="margin-top:10px">
            <label for="password_confirmation" class="col-sm-3 col-form-label">Password confirmation</label>
            <div class="col-sm-9">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-plaintext" value="{{ old('password_confirmation') }}">
            </div>
        </div>

        <div style="margin-top:20px">
            <button class="btn btn-primary">Register</button>
        </div>
    </form>
    </div>
    </div>
</div>
@endsection