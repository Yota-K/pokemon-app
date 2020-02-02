@extends ('layouts.app')

@include ('layouts.head')
@include ('layouts.header')

@section ('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1>{{ $theory->title }}</h1>
            <div class="user-info">
                <span class="user-name">{{ $theory->user->name }}</span>
                <span class="date">{{ $theory->created_at->format('Y年m月d日 H:i') }}</span>
            </div>
            <div class="pokemon-data">
                <span class="pokemon-name">{{ $theory->pokemon->pokemon_name }}</span>
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
                <div class="pokemon-sub-data">
                    <span class="characteristic">特性：{{ $theory->pokemon->characteristic }}</span>
                    <span class="personality">性格：{{ $theory->pokemon->personality }}</span>
                    <span class="belongings">持ち物：{{ $theory->pokemon->belongings }}</span>
                </div>
                <div class="content-wrapper">
                    <div id="content">
                        @markdown ($content)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include ('layouts.footer')
