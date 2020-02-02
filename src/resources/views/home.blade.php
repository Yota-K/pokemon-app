@extends ('layouts.app')

@include ('layouts.head')
@include ('layouts.header')

@section ('content')
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
                        <div class="pokemon-sub-data">
                            <span class="characteristic">特性：{{ $theory->pokemon->characteristic }}</span>
                            <span class="personality">性格：{{ $theory->pokemon->personality }}</span>
                            <span class="belongings">持ち物：{{ $theory->pokemon->belongings }}</span>
                        </div>
                    </div>
                    <p class="description">{{ $theory->description }}[...]</p>
                    <div class="user-info">
                        <span class="user-name"><a href="{{ route('user.show', ['id' => $theory->user_id]) }}">{{ $theory->user->name }}</a></span>
                        <span class="date">{{ $theory->created_at->format('Y年m月d日 H:i') }}</span>
                    </div>
                    @if (Auth::id() === $theory->user_id)
                        <a href="{{ route('theory.edit', ['id' => $theory->id]) }}">編集する</a>
                        <a href="#" data-toggle="modal" data-target="#modal1">削除する</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <div class="modal fade" id="modal1" tabindex="-1"
            role="dialog" aria-labelledby="label1" aria-hidden="true"
        >
            <form class="modal-dialog" role="document" 
                method="POST" 
                action="{{ route('theory.destroy', ['theory' => $theory])}}"
            >
                @method ('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="label1">この操作は取り消せません</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    育成論を削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                    <button type="submit" class="btn btn-primary">はい</button>
                </div>
            </form>
          </div>
        </div>

    </div>
</div>
@endsection

@include ('layouts.footer')
