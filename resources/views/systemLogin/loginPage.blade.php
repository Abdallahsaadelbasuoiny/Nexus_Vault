@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>System Login</h4>
            </div>
            <div class="card-body">

                {{-- عرض أخطاء الدخول المنبثقة من back()->withErrors(['msg' => ...]) --}}
                @if($errors->has('msg'))
                    <div class="alert alert-danger">
                        {{ $errors->first('msg') }}
                    </div>
                @endif

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                @if(session('logout'))
                    <div class="alert alert-info">
                        {{ session('logout') }}
                    </div>
                @endif

                <form action="{{ route('checkLogin') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="loginName" class="form-label">Login Name / Email</label>
                        <input type="text" name="loginName" id="loginName" class="form-control @error('loginName') is-invalid @enderror" required value="{{ old('loginName') }}">
                        @error('loginName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection