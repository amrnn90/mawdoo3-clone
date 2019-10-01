@extends('layouts.app')

@section('title', 'دخول - موضوع')

@section('content')
<div class="container">
    <div class="auth-form">
        <h2 class="page-title">تسجيل الدخول</h2>

        <form method="POST" class="auth-form__form parsley" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input id="email" type="email" placeholder="الإيميل" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <ul class="parsley-errors-list filled server-errors">
                        <li class="parsley-type">{{ $errors->first('email') }}</li>
                    </ul>
                @endif
            </div>
    
            <div class="form-group">
                <input id="password" type="password" placeholder="كلمة المرور" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <ul class="parsley-errors-list filled server-errors">
                        <li class="parsley-type">{{ $errors->first('password') }}</li>
                    </ul>
                @endif
            </div>
            
            <div class="form-group-double">                
                <div class="form-group">
                    <input class="form-check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        <span class="form-check-element"></span>
                        <span class="form-check-labeltext">تذكرني</span>
                    </label>
                </div>
                <div class="form-group">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        نسيت كلمة المرور؟
                    </a>
                </div>
            </div>
            <button type="submit" class="btn btn--full btn--primary submit-btn">
                دخول
            </button>
        </form>
    </div>
</div>
@endsection
