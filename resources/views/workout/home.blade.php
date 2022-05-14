@extends('layouts.app')

@section('content')

<div class="col-md-3 p-0">
    <div class="card h-100">
        <div class="card-header d-flex">ToDo<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            @if( $plan_box == 'on')
            <div class="mt-3 mb-2 text-end">
                <button class="btn-sm btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#RegistPlan-modal">新規登録</button>
                @include('modal.new-plan-modal',['id'=>'RegistPlan-modal','name'=>'プラン'])
            </div> <!-- mt-1 mb-3 text-end -->
            @elseif( $plan_box == 'off')
                <div class="mt-5 p-1"></div>
            @endif
            <div class="card-body py-2 px-4 mb-5">
                @foreach($workslists AS $workslist)
                    @if($workslist->status == 1)
                    <div class="list-group">
                        <a href="" class="list-group-item list-group-item-warning list-group-item-action" data-bs-toggle="modal" data-bs-target="#plan{{ $workslist->id }}">{{ $workslist->name }}</a>
                        @include('modal.do-modal')
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-3 p-0">
        <div class="card h-100">
            <div class="card-header d-flex">Doing</div>
            <div class="card-body py-3 px-4 mt-5 mb-5">
                @foreach($workslists AS $workslist)
                    @if($workslist->status == 2)
                    <div class="list-group">
                        <a href="" class="list-group-item list-group-item-danger list-group-item-action" data-bs-toggle="modal" data-bs-target="#plan{{ $workslist->id }}">{{ $workslist->name }}</a>
                        @include('modal.do-modal')
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-3 p-0">
        <div class="card h-100">
            <div class="card-header d-flex">Done</div>
            <div class="card-body py-3 px-4 mt-5 mb-5">
                @foreach($workslists AS $workslist)
                    @if($workslist->status == 3)
                    <div class="list-group">
                        <a href="" class="list-group-item list-group-item-success list-group-item-action" data-bs-toggle="modal" data-bs-target="#plan{{ $workslist->id }}">{{ $workslist->name }}</a>
                        @include('modal.do-modal')
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection
