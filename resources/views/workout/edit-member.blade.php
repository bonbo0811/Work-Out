@extends('layouts.app')

@section('content')

<div class="col-md-5 p-0">
    <div class="card h-100">
        <div class="card-header d-flex">メンバーの編集<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            <div class="card-body py-2 px-4 mt-1">
                <div class="mt-1 mb-1 text-end">
                    <form action="{{ route('DeleteMember',['id' => $member->id ]) }}" method="post">
                        @csrf
                        <input type="hidden" name="id">
                        <button type="submit" class="btn-sm btn-warning text-decoration-none me-1">
                            削除
                        </button>
                    </form>
                </div> <!--mt-1 mb-1 text-end-->

                <form action="{{ route('ChangeMember',['id' => $member->id ]) }}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="" class="mb-2 form-label">メンバーの名前<span class="small text-danger"> 必須</span></label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name', $member->name) }}">
                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $message)
                                    <p class="small text-danger">→ {{ $message }} </p>
                                @endforeach
                            @endif 
                    </div>
                    <button type="submit" class="btn btn-primary">編集</button>
                    <a href="{{ route('MemberList') }}" class="btn btn-secondary ms-2">戻る</a>
                </form>
            </div>
        </div>
    </div>

@endsection
