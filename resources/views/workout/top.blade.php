@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-3"></div>
        <h1 class="mt-5 fw-bolder">Work-Out</h1>
        <div class="bg-white bg-opacity-75 ms-4 me-4 mt-2 py-4 border col-md-8">
            <div class="px-4 ms-4 me-4">
                <p class="fw-bold mb-2">「Work-out」はプロジェクト単位でタスクを管理できるアプリです。</p>
                <p class="fw-bold mb-2">新規登録後、メンバーを作成し、プロジェクトを開始します。</p>
                <p class="fw-bold mb-2">作成したプロジェクトには目標期間の設定<br>担当メンバーの割り当て、ワークスを管理しましょう。</p>
            </div>
            <div class="px-4 mt-3 text-center">
                <div>
                    <a href="{{ route('login') }}" class="me-1 btn btn-primary">ログイン</a>
                    <a href="{{ route('register') }}" class="ms-1 btn btn-primary">新規登録</a>
                </div>
            </div>
        </div>
        <div style="background-color:#FFFFEE;" class="rounded mt-4 py-3 border col-md-9">
        <h4 class="fw-bold text-muted text-center mt-2 mb-4">Work-Outを始めよう</h4>
            <div class="col-md-8 mt-2 mb-4 m-auto">
                <img src="{{ asset('images/topimage1.png') }}" class="img-fluid border" alt="Work-Outのイメージ1">
            </div>
            <div class="px-4 ms-2 me-2">
                <h6 class="bg-primary text-light text-center rounded-pill p-1 col-md-3 fw-bold m-auto mb-3">Work-Outの始め方</h6>
                    <div class="m-auto col-md-7">
                        <p class="mb-2">① 新規登録後、メンバーを登録し、プロジェクトを開始します。</p>
                        <p class="mb-2">② プロジェクトを作成</p>
                        <p class="mb-2">③ 作成したプロジェクトにワークスを作成します。</p>
                        <p class="mb-2">④ ワークスを選択し、開始→完了することでプロジェクトを効率よく管理しましょう！</p>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection
