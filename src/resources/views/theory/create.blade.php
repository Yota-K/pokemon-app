@extends ('layouts.app')

@include ('layouts.head', ['title' => '育成論の編集 | ポケモン【剣盾】育成論投稿サイト'])
@include ('layouts.header')

@section ('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">育成論</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('theory.store') }}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="form-group mb-2">
                <label>育成論のタイトル</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>ポケモンの名前</label>
                    <input type="text" class="form-control" name="pokemon_name">
                </div>
                <div class="form-group col-md-2">
                    <label>タイプ1</label>
                    <select name="first_type" class="form-control">
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>タイプ2</label>
                    <select name="second_type" class="form-control">
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                @for ($i = 1; 5 > $i; $i++)
                    <div class="form-group col-md-2">
                        <label>ポケモンの技{{ $i }}</label>
                        <input type="text" class="form-control" name="skill_name_{{ $i }}">
                    </div>
                @endfor
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>ポケモンの特性</label>
                    <input type="text" class="form-control" name="characteristic">
                </div>
                <div class="form-group col-md-2">
                    <label>ポケモンの性格</label>
                    <select name="personality" class="form-control">
                        @foreach ($personalities as $personality)
                            <option value="{{ $personality }}">{{ $personality }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>ポケモンの持ち物</label>
                    <input type="text" class="form-control" name="belongings">
                </div>
            </div>
            <div class="form-group">
                <label>育成論</label>
                <textarea id="editor"></textarea>
                <textarea id="hidden-editor" style="display: none;" name="content"></textarea>
            </div>
            <div class="form-group">
                <label>概要</label>
                <textarea class="form-control" rows="3" name="description"></textarea>
            </div>
            <button id="submit-btn" type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
</div>
@endsection

@include ('layouts.footer')
