@extends('layouts.auth')

@section('content')

<div class="col-md-5 p-0 m-auto">
    <div class="card h-100">
        <div class="card-header fw-bolder d-flex">Tutorial<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            <div class="card-body py-2 px-4 mb-5">
                <h3 class="fw-bold text-muted text-center mt-3 mb-3">Work-Out</h4>
                <div class="px-4 py-2">
                    初めまして{{ Auth::user()->name }}さん。<br>
                    {{ config('app.name', 'Laravel') }}をご利用いただきありがとうございます。
                </div>
                <div class="px-4 py-2">
                    {{ config('app.name', 'Laravel') }}では、ログインユーザーごとにプロジェクトを作成し、プロジェクトを完了するためのワークスを洗い出して行きましょう。
                </div>
                <div style="background-color:#FFFFEE;" class="rounded mt-4 mb-3 p-2 border col-md-10 m-auto">
                    <h6 class="bg-primary text-light text-center rounded-pill p-1 col-md-10 fw-bold m-auto mb-2 mt-2">Work-Outの始め方</h6>
                        <div class="m-auto col-md-11">
                            <p class="mb-2">① 新規登録後、メンバーを登録し、Work-Outを開始します。</p>
                            <p class="mb-2">② プロジェクトを作成</p>
                            <p class="mb-2">③ 作成したプロジェクトの中でワークスを作成します。</p>
                            <p class="mb-2">④ ワークスを選択し、開始→完了することでプロジェクトを効率よく管理できます。</p>
                        </div>
                </div>
                <div class="p-2 text-center">
                    <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#RegistMember-modal">メンバーを登録</button>
                    @include('modal.new-member-modal',['id'=>'RegistMember-modal','name'=>'メンバー'])
                </div>
            </div>
        </div>
    </div>

@endsection
