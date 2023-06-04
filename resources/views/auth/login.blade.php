@extends('layouts.main')
@section('content')

<div class="w-30">

    <div class="card">
        <div class="card-header">
            <h3>Login</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" name="email" class="form-control-plaintext" value="{{ old('email') }}">
                    </div>  
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" name="password" class="form-control-plaintext" value="{{ old('password') }}">
                    </div>          
                </div>

                <div style="margin-top:20px">
                    <button class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection