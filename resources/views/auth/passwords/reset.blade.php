@extends('frontend.layouts.app')
@section('content')
<section  class="d-flex justify-content-center">
    <div class="columns align-item-center">
        <div class="area-padding-top">
            <h1>
                Resets Password
            </h1>
            <h2>
                Create a new password.
            </h2>
        </div>
    </div>
</section>
<section class="d-flex justify-content-center">
    <div class="area-padding">
        <div class="container">
            <div class="row">
                   <form method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="field flex-column text-center">
                                    <label class="label" for="email">Email</label>
                                    <div class="control has-icons-left">
                                        <input class="form-control form__input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                               name="email"
                                               id="email"
                                               type="text"
                                               placeholder="hello@email.com"
                                               value="{{ old('email') }}" required autofocus>
                                               <br>
                                        <!-- <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span> -->
                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="field flex-column text-center">
                                    <label class="label" for="password">Password</label>
                                    <div class="control has-icons-left">
                                        <input class="form-control form__input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                               name="password"
                                               id="password"
                                               type="password"
                                               placeholder="Password"
                                               value="{{ old('password') }}">
                                        <br>
                                        <!-- <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span> -->
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="field flex-column text-center">
                                    <label class="label" for="password_confirmation">Confirm Password </label>
                                    <div class="control has-icons-left">
                                        <input class="form-control form__input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               type="password"
                                               placeholder="Password Confirmation"
                                               value="{{ old('password_confirmation') }}">
                                        <br>
                                        <!-- <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span> -->
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>

                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="btn btn-primary btn-round">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                            </form>
            </div>
        </div>
    </div>
</section>
@endsection
