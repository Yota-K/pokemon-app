@extends ('layouts.app')

@include ('layouts.head', ['title' => "$theory->title | ポケモン【剣盾】育成論投稿サイト"])
@include ('layouts.header')

@section ('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="content-wrapper">
            <h1 class="content-title">{{ $theory->title }}</h1>
            <div class="author-area">
            <div class="user-info">
                @if ($theory->user->icon_url !== null)
                    <span 
                        class="user-icon theory-user-icon"
                        style="background: url({{ asset(Storage::url($theory->user->icon_url)) }}); background-size: cover;"
                    ></span>
                @else
                    <span 
                        class="user-icon theory-user-icon"
                        style="background: url('https://drive.google.com/uc?id=1YtLZmd_Xy7Py_dKfUPtUTMN6bQnTfc5e'); background-size: cover;"
                    ></span>
                @endif
                <span class="user-name"><a href="{{ route('user.show', ['id' => $theory->user_id]) }}">{{ $theory->user->name }}</a></span>
                <span class="date">{{ $theory->created_at->format('Y年m月d日 H:i') }}</span>
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
            </div>
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
                <div class="pokemon-skills theory-box">
                    <span class="pokemon-skill">わざ：</span>
                    <span class="skill-name">{{ $theory->skill->skill_name_1 }} /</span>
                    <span class="skill-name">{{ $theory->skill->skill_name_2 }} /</span>
                    <span class="skill-name">{{ $theory->skill->skill_name_3 }} /</span>
                    <span class="skill-name">{{ $theory->skill->skill_name_4 }}</span>
                </div>
                <div class="pokemon-sub-data">
                    <span class="characteristic theory-box">特性：{{ $theory->pokemon->characteristic }}</span>
                    <span class="personality theory-box">性格：{{ $theory->pokemon->personality }}</span>
                    <span class="belongings theory-box">持ち物：{{ $theory->pokemon->belongings }}</span>
                </div>
            </div>
            <div id="content">
                @markdown ($content)
            </div>
        </div>
    </div>
</div>
@endsection

@section ('script')
<script src="{{ asset('js/good-btn.js') }}"></script>
@endsection

@include ('layouts.footer')
