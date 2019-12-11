@extends('frontend.layouts.app')
@section('content')
<section  class="d-flex justify-content-center">
    <div class="columns align-item-center">
        <div class="area-padding-top">
            <h1>
                Forgot Password?
            </h1>
            <h2>
                Give your registered email id and we will <br>
                send you password reset email.
            </h2>
        </div>
    </div>
</section>
<section class="d-flex justify-content-center">
    <div class="area-padding">
        <div class="container">
            <div class="row">
                            

                            <form method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="field  flex-column text-center">
                                    <label class="label" for="email">Email</label>
                                    <div class="form-group control has-icons-left">
                                        <input class="form-control form__input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                               name="email"
                                               id="email"
                                               type="text"
                                               placeholder="example@email.com"
                                               value="{{ old('email') }}" autofocus>

                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit"   class="btn btn-primary btn-round">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
            </div>
        </div>
    </div>
</section>
@endsection
