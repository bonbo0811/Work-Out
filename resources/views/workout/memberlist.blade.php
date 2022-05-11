@extends('layouts.app')

@section('content')

<div class="col-md-3 p-0">
    <div class="card h-100">
        <div class="card-header d-flex">Members<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            <div class="mt-3 mb-2 text-end">
                <button class="btn-sm btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#RegistMember-modal">新規登録</button>
                @include('modal.new-member-modal',['id'=>'RegistMember-modal','name'=>'メンバー'])
            </div> <!-- mt-1 mb-3 text-end -->
            <div class="card-body py-2 px-4 mb-5">
                <div class="list-group">
                    @foreach($members AS $member)
                    <div class="list-group">
                        <a href="" class="list-group-item list-group-item-warning list-group-item-action" data-bs-toggle="modal" data-bs-target="#member{{ $member->id }}">{{ $member->name }}</a>
                        @include('modal.member-detail-modal')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
