@extends ('layouts.app')

@include ('layouts.head')
@include ('layouts.header')

@section ('content')

<section class="panel-body" id="search-form">
    <form method="GET" action="{{ route('home') }}">
        <div class="form-group">
            <label>ポケモンの名前をを検索！</label>
            <div class="pokemon-search">
                <input type="text" name="keyword" placeholder="ポケモンの名前を入力してください" />
                <button id="submit-btn" type="submit">検索</button>
            </div>
        </div>
    </form>
</section>

<div class="container">
    <div class="row justify-content-center">

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
                    <h2><a href="{{ route('theory.show', ['id' => $theory->id]) }}">{{ $theory->title }}</a></h2>
                    <div class="pokemon-data">
                        <span class="pokemon-name">ポケモン：{{ $theory->pokemon->pokemon_name }}</span>
                        <div class="pokemon-types">
                            <span class="pokemon-type">タイプ：</span>
                            <span class="type type-<?php echo $theory->pokemon->type_index(config('types'), $theory->pokemon->first_type); ?>">
                                {{ $theory->pokemon->first_type }}
                            </span>
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
                        @if ($theory->user->icon_url !== null)
                            <span 
                                class="user-icon theory-user-icon"
                                style="background: url({{ asset(Storage::url($theory->user->icon_url)) }}); background-size: cover;"
                            ></span>
                        @else
                            <span 
                                class="user-icon theory-user-icon"
                                style="background: url({{ asset(Storage::url('/default-icon/default-icon.png')) }}); background-size: cover;"
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
                            @if ($theory->is_good($theory->id, $theory->user_id))
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
                    @if (Auth::id() === $theory->user->id)
                        <div class="edit-area">
                            <a href="{{ route('theory.edit', ['id' => $theory->id]) }}">編集する</a>
                            <a href="{{ route('theory.delete', ['id' => $theory->id]) }}">削除する</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="pagination">
        {{ $theories->links() }}
    </div>

</div>
@endsection

@include ('layouts.footer')
