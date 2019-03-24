<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="apple-mobile-web-app-capable" content="yes" />

        <title>Faitechno</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="pushable">
        <div class="ui right inverted sidebar">
            <div class="ui centered grid">
                <div class="stretched row">
                    <div class="column allmenu">
                        <button class="ui big fluid button onemenu schedule">
                            <i class="calendar alternate icon" id="schedule-mobile"></i>
                            Schedule
                        </button>
                        <button class="ui big fluid button onemenu notification">
                            <i class="bell icon" id="notification-mobile"></i>
                            Notification
                        </button>
                        <button class="ui big fluid button onemenu settings">
                            <i class="sliders horizontal icon"></i>
                            Settings
                        </button>
                        <button class="ui big fluid button onemenu information">
                            <i class="info icon"></i>
                            Info
                        </button>
                        <button class="ui big fluid labeled icon button onemenu logout">
                            <i class="sign out alternate icon"></i>
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="pusher">
            <main id="swup">
                @if(Auth::user()->nim == "123132")
                    <div class="admin box">
                        NOTIFICATION FORM
                        <form method="POST" action="{{ route('createNotification') }}">
                            @csrf
        
                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('message') }}</label>
        
                                <div class="col-md-6">
                                    <input id="message" type="text" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" value="{{ old('message') }}" required autofocus>
        
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('nim') }}</label>
        
                                <div class="col-md-6">
                                    <input id="nim" type="text" class="form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" name="nim" value="{{ old('nim') }}" required autofocus>
        
                                    @if ($errors->has('nim'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nim') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        REGISTRATION FORM
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
        
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('Nim') }}</label>
        
                                <div class="col-md-6">
                                    <input id="nim" type="text" class="form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" name="nim" value="{{ old('nim') }}" required autofocus>
        
                                    @if ($errors->has('nim'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nim') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="jurusan" class="col-md-4 col-form-label text-md-right">{{ __('Jurusan') }}</label>
        
                                <div class="col-md-6">
                                    <input id="jurusan" type="text" class="form-control{{ $errors->has('jurusan') ? ' is-invalid' : '' }}" name="jurusan" value="{{ old('jurusan') }}" required autofocus>
        
                                    @if ($errors->has('jurusan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('jurusan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        UPDATE / REFRESH ALL API TOKEN
                        <form method="GET" action="{{ route('updateToken') }}">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        UPDATE USER STATUS
                        <form method="POST" action="{{ route('updateStatus') }}">
                            @csrf
        
                            <div class="form-group row">
                                <label for="tahapan" class="col-md-4 col-form-label text-md-right">{{ __('Tahapan') }}</label>
        
                                <div class="col-md-6">
                                    <input id="tahapan" type="text" class="form-control{{ $errors->has('tahapan') ? ' is-invalid' : '' }}" name="tahapan" value="{{ old('tahapan') }}" required autofocus>
        
                                    @if ($errors->has('tahapan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tahapan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('Nim') }}</label>
        
                                <div class="col-md-6">
                                    <input id="nim" type="text" class="form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" name="nim" value="{{ old('nim') }}" required autofocus>
        
                                    @if ($errors->has('nim'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nim') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
        
                                <div class="col-md-6">
                                    <input id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ old('status') }}" required autofocus>
        
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <br>
                        ADD AVAILABLE SCHEDULE
                        <div id="app">
                            <calendar-component></calendar-component>
                        </div>
                    </div>
                @else
                    <div class="body-box ui dimmable">
                        <img class="bg_main" alt="" id="bg_jurusan">
                        <div id="app">
                            <caas-component user-data="{{ Auth::user() }}"></caas-component>
                        </div>
                        <div class="ui page dimmer">
                            <div class="content">
                                <div class="ui piled segment">
                                    <div class="ui grid center aligned">
                                        <div class="row">
                                            <div class="column">
                                                <h1 class="ui header">Daskom  Recruitment  Web  V1</h1>
                                            </div>
                                        </div>
                                        <div class="large screen tablet computer only row">
                                            <div class="right aligned five wide column">
                                                <button class="ui big instagram button">
                                                    <i class="instagram icon"></i>
                                                    @telu.daskom
                                                </button>
                                            </div>
                                            <div class="five wide column">
                                                <button class="ui big youtube button">
                                                    <i class="youtube icon"></i>
                                                    Daskom Tel-U
                                                </button>
                                            </div>
                                            <div class="left aligned four wide column">
                                                <button class="ui big line green button">
                                                    <i class="linechat icon"></i>
                                                    @svd6059m
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mobile only three column stackable row">
                                            <div class="column">
                                                <button class="ui big instagram button">
                                                    <i class="instagram icon"></i>
                                                    @telu.daskom
                                                </button>
                                            </div>
                                            <div class="column">
                                                <button class="ui big youtube button">
                                                    <i class="youtube icon"></i>
                                                    Daskom Tel-U
                                                </button>
                                            </div>
                                            <div class="column">
                                                <button class="ui big line green button">
                                                    <i class="linechat icon"></i>
                                                    @svd6059m
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="ui inverted header">Created with brain and fingers that supported by some cool stuff</h3>
                                <i class="big laravel icon"></i><i class="big vuejs icon"></i><i class="big sass icon"></i><i class="big html5 icon"></i><i class="big github icon"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </body>
</html>
