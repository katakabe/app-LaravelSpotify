@extends('layouts.app')

@section('title')
<title>{{ __('playlist.result') }}</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('playlist.result') }}</div>

                <div class="card-body">
                    <p><a href="{{ url('/') }}">back</a></p>
                    <p>プレイリストを作成しました</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">URI</th>
                                <th scope="col">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle"><a href="{{ $playlistUri }}">{{ $playlistUri }}</a></td>
                                <td>
                                    {{Form::open(['route' => ['playlist.destroy', $playlistUri], 'method' => 'delete'])}}
                                        {{Form::token()}}
                                        {{Form::submit('Unfollow', [
                                            'class' => 'btn btn-danger'
                                        ])}}
                                    {{Form::close()}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
