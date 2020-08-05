<x-app>
    
    <div class="card d-flex justify-content-center s1">
        <div class="card-header">{{ __('messages.Edit Profile') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('profile', current_user()) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="username" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Username') }}</label>

                    <div class="col-md-8">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Name') }}</label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ $user->name }}" required autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="avatar" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Avatar') }}</label>

                    <div class="col-md-8 d-flex justify-content-between">
                            <div>
                                <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror"
                                name="avatar">
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                            {{-- <img src="{{ $user->avatar }}" class="live-img h-100" width="40" alt="avatar"> --}}
                            <div class="live-img h-100"
                            style="width:40px;background-image: url({{ $user->avatar }});
                            background-size: cover;">
                                {{-- avatar_img --}}
                            </div>
                
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.E-Mail Address') }}</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $user->email }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bio" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Bio') }}</label>

                    <div class="col-md-8">
                        <textarea id="bio" rows="4" class="form-control @error('bio') is-invalid @enderror"
                        name="bio" required
                        >{{$user->bio}}</textarea>

                        @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Password') }}</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="password-confirm" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Confirm Password') }}</label>

                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('messages.Submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.form-control-file').change(function () {
            
            $('.live-img').css('background-image', 'url(' + window.URL.createObjectURL(this.files[0]) + ')');
            
            });

        });
    </script>
</x-app>