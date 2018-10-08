@extends('layouts.app')

@section('title', 'تسجيل - موضوع')

@section('content')

<div class="container">
    <div class="auth-form">
        <h2 class="auth-form__header">إنشاء حساب جديد</h2>

        <form method="POST" class="auth-form__form parsley" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input
                    id="name" type="name" placeholder="الإسم" 
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" 
                    value="{{ old('name') }}"
                    required autofocus>

                
                    @if ($errors->has('name'))
                        <ul class="parsley-errors-list filled server-errors">
                            <li class="parsley-type">{{ $errors->first('name') }}</li>
                        </ul>
                    @endif
            </div>

            <div class="form-group">
                <input
                    id="email" type="email" placeholder="الإيميل"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" value="{{ old('email') }}"
                    required autofocus
                    data-parsley-available-email
                    data-parsley-debounce="400">

                {{-- <input
                    id="email" type="email" placeholder="الإيميل"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" value="{{ old('email') }}"
                    required autofocus
                    data-parsley-remote
                    data-parsley-remote-validator="availableEmail"
                    data-parsley-remote-message="هذا الإيميل غير متوفر">  --}}

                
                @if ($errors->has('email'))
                    <ul class="parsley-errors-list filled server-errors">
                        <li class="parsley-type">{{ $errors->first('email') }}</li>
                    </ul>
                @endif
            </div>
    
            <div class="form-group">
                <input id="password" type="password" placeholder="كلمة المرور" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                
                @if ($errors->has('password'))
                    <ul class="parsley-errors-list filled server-errors">
                        <li class="parsley-type">{{ $errors->first('password') }}</li>
                    </ul>
                @endif
            </div>
    
            <div class="form-group">
                <input id="password_confirmation" type="password" placeholder="تأكيد كلمة المرور" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required data-parsley-equalto="#password" data-parsley-equalto-message="تأكد من تطابق كلمة المرور">

                
                @if ($errors->has('password_confirmation'))
                    <ul class="parsley-errors-list filled server-errors">
                        <li class="parsley-type">{{ $errors->first('password_confirmation') }}</li>
                    </ul>
                @endif
            </div>
            
            <button type="submit" class="btn btn--full btn--primary submit-btn">
                تسجيل
            </button>
        </form>
    </div>
</div>
@endsection
