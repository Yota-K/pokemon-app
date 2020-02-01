@extends ('layouts.app')

@include ('layouts.head')
@include ('layouts.header')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>{{ $user->name }}</h2>
                    <span class="email">{{ $user->email }}</span>
                    <div class="button-area">
                        <a class="btn btn-primary" href="#" role="button">プロフィールを編集する</a>
                        <a class="btn btn-primary" href="{{ route('theory.create') }}" role="button">育成論を投稿する</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include ('layouts.footer')
