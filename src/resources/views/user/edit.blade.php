@extends ('layouts.app')

@include ('layouts.head', ['title' => 'ユーザー編集 | ポケモン【剣盾】育成論投稿サイト'])
@include ('layouts.header')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ユーザー編集画面') }}</div>

                    <div class="card-body">
                        <form 
                            method="POST" 
                            action="{{ route('user.update', ['id' => $user->id]) }}"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method ('PATCH')

                            <div class="form-group row">
                                <label for="icon" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>

                                <div class="col-md-6">
                                    <input type="file" class="@error('icon') is-invalid @enderror" name="icon" value="">

                                    @error ('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error ('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error ('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="introduction" class="col-md-4 col-form-label text-md-right">自己紹介文</label>

                                <div class="col-md-6">
                                    <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="introduction">{{ $user->introduction }}</textarea>

                                    @error ('introduction')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">送信</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include ('layouts.footer')
