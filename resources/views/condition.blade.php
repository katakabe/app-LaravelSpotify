@extends('layouts.app')

@section('title')
<title>プレイリスト生成</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プレイリスト生成</div>

                <div class="card-body">
                    {{Form::open(['route' => ['condition.store']])}}

                        {{Form::token()}}

                        @if ($errors->has('seed'))
                            <div class="form-group col-sm-12">
                                <p class="error-message text-danger">{{ $errors->first('seed') }}</p>
                            </div>
                        @endif

                        <!-- ジャンル -->

                        <div class="form-group col-sm-12">
                            {{Form::label('seed_genres', 'Seed Genres', [])}}
                            <span class="badge badge-danger">必須</span>
                            <small id="seed_artists_help" class="form-text text-muted">
                                ジャンル
                            </small>
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::select('seed_genres', $genres, old('id'), [
                                'class'    => 'form-control',
                                'placeholder' => 'ジャンルを選択してください'
                            ])}}
                        </div>

                        <!-- アーティスト -->

                        <div class="form-group col-sm-12">
                            {{Form::label('seed_artists_1','Seed Artists', [])}}
                            <span class="badge badge-danger">必須</span>
                            <small id="seed_artists_help" class="form-text text-muted">
                                アーティスト名 Spotify URI
                            </small>
                        </div>
                        <div class="form-group col-sm-12">
                            {{Form::text('seed_artists_1', 'spotify:artist:6mEQK9m2krja6X1cfsAjfl', [
                                'id'          => 'seed_artists_1',
                                'class'       => 'form-control',
                                'placeholder' => 'spotify:artist:6mEQK9m2krja6X1cfsAjfl',
                            ])}}
                        </div>
                        <div class="form-group col-sm-12">
                            {{Form::text('seed_artists_2', 'spotify:artist:6mEQK9m2krja6X1cfsAjfl', [
                                'id'          => 'seed_artists_2',
                                'class'       => 'form-control',
                                'placeholder' => 'spotify:artist:6mEQK9m2krja6X1cfsAjfl',
                            ])}}
                        </div>

                        <!-- 曲 -->

                        <div class="form-group col-sm-12">
                            {{Form::label('seed_tracks_1', 'Seed Tracks', [])}}
                            <span class="badge badge-danger">必須</span>
                            <small id="seed_tracks_help" class="form-text text-muted">
                                曲名 Spotify URI
                            </small>
                        </div>
                        <div class="form-group col-sm-12">
                            {{Form::text('seed_tracks_1', 'spotify:track:6EzZn96uOc9JsVGNRpx06n', [
                                'id'          => 'seed_tracks_1',
                                'class'       => 'form-control',
                                'placeholder' => 'spotify:track:6EzZn96uOc9JsVGNRpx06n',
                            ])}}
                        </div>
                        <div class="form-group col-sm-12">
                            {{Form::text('seed_tracks_2', 'spotify:track:7D7GCO3CtDT1WDcj2W5VDV', [
                                'id'          => 'seed_tracks_2',
                                'class'       => 'form-control',
                                'placeholder' => 'spotify:track:7D7GCO3CtDT1WDcj2W5VDV',
                            ])}}
                        </div>

                        <!-- テンポ※最低と最高に編集済み -->

                        <div class="form-group col-sm-12">
                            {{Form::label('min_tempo', 'Min Tempo', [])}}
                            <span class="badge badge-warning">任意</span>
                            <small id="min_tempo_help" class="form-text text-muted">
                                最低テンポ
                            </small>
                        </div>
                        <div class="form-group col-sm-12">
                            {{Form::text('min_tempo', '', [
                                'id'          => 'min_tempo',
                                'class'       => 'form-control',
                                'placeholder' => '80',
                            ])}}
                        </div>
                        @if ($errors->has('min_tempo'))
                            <div class="form-group col-sm-12">
                                <p class="error-message text-danger">{{ $errors->first('min_tempo') }}</p>
                            </div>
                        @endif

                        <div class="form-group col-sm-12">
                            {{Form::label('max_tempo', 'Max Tempo', [])}}
                            <span class="badge badge-warning">任意</span>
                            <small id="max_tempo_help" class="form-text text-muted">
                                最大テンポ
                            </small>
                        </div>
                        <div class="form-group col-sm-12">
                            {{Form::text('max_tempo', '', [
                                'id'          => 'max_tempo',
                                'class'       => 'form-control',
                                'placeholder' => '120',
                            ])}}
                        </div>
                        @if ($errors->has('max_tempo'))
                            <div class="form-group col-sm-12">
                                <p class="error-message text-danger">{{ $errors->first('max_tempo') }}</p>
                            </div>
                        @endif

                        <!-- 曲調 -->

                        <div class="form-group col-sm-12">
                            {{Form::label('mode', 'Mode', [])}}
                            <span class="badge badge-warning">任意</span>
                            <small id="mode_help" class="form-text text-muted">
                                曲の雰囲気
                            </small>
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::select('modes', [1 => '明るい', 0 => '暗い'], null, [
                                'class'    => 'form-control',
                                'placeholder' => '曲の雰囲気を選択してください'
                            ])}}
                        </div>

                        <div class="form-group col-sm-12">
                            {{Form::submit('Submit', [
                                'class' => 'btn btn-primary my-1'
                            ])}}
                        </div>

                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
