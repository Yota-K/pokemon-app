@extends ('layouts.app')

@include ('layouts.head', ['title' => 'ユーザー詳細 | ポケモン【剣盾】育成論投稿サイト'])
@include ('layouts.header')

@section ('content')
<div class="container">
    <div id="user-page" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="user-profile">
                        <h2>{{ $user->name }}</h2>
                        @if ($user->icon_url !== null)
                            <span 
                                class="user-icon profile-icon"
                                style="background: url({{ asset(Storage::url($user->icon_url)) }}); background-size: cover;"
                            ></span>
                        @else
                            <span 
                                class="user-icon profile-icon"
                                style="background: url('https://drive.google.com/uc?id=1YtLZmd_Xy7Py_dKfUPtUTMN6bQnTfc5e'); background-size: cover;"
                            ></span>
                        @endif
                        @if ($user->introduction !== null)
                            <div class="introduction">{{ $user->introduction }}</div>
                        @endif
                        @if (Auth::id() === $user->id)
                            <div class="button-area mt-3">
                                <a class="btn btn-primary" href="{{ route('user.edit', ['id' => $user->id]) }}" role="button">プロフィールを編集する</a>
                                <a class="btn btn-primary" href="{{ route('theory.create') }}" role="button">育成論を投稿する</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <h3 class="theory-heading">投稿した育成論</h3>
        </div>

        @empty (count($theories))
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p>投稿がありません</p>
                </div>
            </div>
        </div>
        @endempty

        @foreach ($theories as $theory)
        <div class="col-md-8 my-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="theory-title"><a href="{{ route('theory.show', ['id' => $theory->id]) }}">{{ $theory->title }}</a></h2>
                    <div class="pokemon-data">
                        <span class="pokemon-name">{{ $theory->pokemon->pokemon_name }}</span>
                        <div class="pokemon-types">
                            <span class="pokemon-type">タイプ：</span>
                            @if ( $theory->pokemon->first_type !== 'ー')
                                <span class="type type-<?php echo $theory->pokemon->type_index(config('types'), $theory->pokemon->first_type); ?>">
                                    {{ $theory->pokemon->first_type }}
                                </span>
                            @endif
                            @if ( $theory->pokemon->second_type !== 'ー')
                                <span class="type type-<?php echo $theory->pokemon->type_index(config('types'), $theory->pokemon->second_type); ?>">
                                    {{ $theory->pokemon->second_type }}
                                </span>
                            @endif
                        </div>
                        <div class="pokemon_skills">
                            <span class="pokemon-skill">わざ：</span>
                            <span class="skill-name">{{ $theory->skill->skill_name_1 }} /</span>
                            <span class="skill-name">{{ $theory->skill->skill_name_2 }} /</span>
                            <span class="skill-name">{{ $theory->skill->skill_name_3 }} /</span>
                            <span class="skill-name">{{ $theory->skill->skill_name_4 }}</span>
                        </div>
                        <div class="pokemon-sub-data">
                            <span class="characteristic">特性：{{ $theory->pokemon->characteristic }}</span>
                            <span class="personality">性格：{{ $theory->pokemon->personality }}</span>
                            <span class="belongings">持ち物：{{ $theory->pokemon->belongings }}</span>
                        </div>
                    </div>
                    <p class="description">{{ $theory->description }}[...]</p>
                    <div class="user-info">
                        @if ($user->icon_url !== null)
                            <span 
                                class="user-icon theory-user-icon"
                                style="background: url({{ asset(Storage::url($user->icon_url)) }}); background-size: cover;"
                            ></span>
                        @else
                            <span 
                                class="user-icon theory-user-icon"
                                style="background: url('https://drive.google.com/uc?id=1YtLZmd_Xy7Py_dKfUPtUTMN6bQnTfc5e'); background-size: cover;"
                            ></span>
                        @endif
                        <span class="user-name"><a href="{{ route('user.show', ['id' => $theory->user_id]) }}">{{ $theory->user->name }}</a></span>
                        <time class="date">{{ $theory->created_at->format('Y年m月d日 H:i') }}</time>
                    </div>
                    <div class="good-btn-area">
                        @if (Auth::guest())
                            <a href="{{ route('login') }}" class="good-btn" data-id="<?php echo $theory->id; ?>">
                                <i class="fa fa-heart"  aria-hidden="true"></i>
                            </a>
                            <span class="count-{{ $theory->id }}">{{ $theory->good_count($theory->id) }}</span>
                        @else
                            @if ( $theory->is_good($theory->id, Auth::id()) )
                                <span class="good-btn add-good" data-id="<?php echo $theory->id; ?>">
                                    <i class="fa fa-heart"  aria-hidden="true"></i>
                                </span>
                                <span class="count-{{ $theory->id }}">{{ $theory->good_count($theory->id) }}</span>
                            @else
                                <span class="good-btn" data-id="<?php echo $theory->id; ?>">
                                    <i class="fa fa-heart"  aria-hidden="true"></i>
                                </span>
                                <span class="count-{{ $theory->id }}">{{ $theory->good_count($theory->id) }}</span>
                            @endif
                        @endif
                    </div>
                    @if (Auth::id() === $theory->user_id)
                        <div class="edit-area">
                            <a href="{{ route('theory.edit', ['id' => $theory->id]) }}">編集する</a>
                            <a href="{{ route('theory.delete', ['id' => $theory->id]) }}">削除する</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        @endforeach

        <div class="pagination">
            {{ $theories->links() }}
        </div>

    </div>
</div>
@endsection

@section ('script')
<script src="{{ asset('js/good-btn.js') }}"></script>
@endsection

@include ('layouts.footer')
