@extends('layouts.app')

@section('title', 'تسجيل - موضوع')

@section('content')

<div class="container">
    <div class="auth-form">
        <h2 class="auth-form__header">إنشاء حساب جديد</h2>

        <form method="POST" class="auth-form__form" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input id="name" type="name" placeholder="الإسم" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <input id="email" type="email" placeholder="الإيميل" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
    
            <div class="form-group">
                <input id="password" type="password" placeholder="كلمة المرور" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
    
            <div class="form-group">
                <input id="password_confirmation" type="password" placeholder="تأكيد كلمة المرور" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            
            <button type="submit" class="btn btn--full btn--primary submit-btn">
                تسجيل
            </button>
        </form>
    </div>
</div>
@endsection
