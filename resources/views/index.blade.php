@extends('layouts.master_insert')
@section('title', 'Laravel チュートリアル（初級）')

@section('content')
    <h3>従業員登録画面</h3>
    <p><span class="label label-danger">入力画面</span> -> 確認画面 -> 完了画面</p>

    <form action="{{ route('insert.confirm') }}" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group @if($errors->has('username')) has-error @endif">
            <label class="col-sm-2 control-label" for="username">名前：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="お名前を入力してください" value="{{ old('username') }}">
                @if($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group @if($errors->has('mail')) has-error @endif">
            <label class="col-sm-2 control-label" for="mail">Email：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mail" name="mail" placeholder="Emailを入力してください" value="{{ old('mail') }}">
                @if($errors->has('mail'))
                    <span class="text-danger">{{ $errors->first('mail') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group @if($errors->has('age')) has-error @endif">
            <label class="col-sm-2 control-label" for="age">年齢：</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="age" name="age" placeholder="年齢" value="{{ old('age') }}">
            </div>
            <div class="col-sm-8">歳
                @if($errors->has('age'))
                    <span class="text-danger">{{ $errors->first('age') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 text-center">
                <input type="submit" name="button1" value="送信" class="btn btn-primary btn-wide" />
            </div>
        </div>
    </form>

    <!-- 従業員一覧 -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">年齢</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workers as $worker)
                <tr>
                    <td>{{ $worker->username }}</td>
                    <td>{{ $worker->mail }}</td>
                    <td>{{ $worker->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection