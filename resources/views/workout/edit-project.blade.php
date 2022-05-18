@extends('layouts.app')

@section('content')

<div class="col-md-5 p-0">
    <div class="card h-100">
        <div class="card-header d-flex">{{ $project ->name }} の編集<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            <div class="card-body py-2 px-4 mt-1">
                <div class="mt-1 mb-1 text-end">
                    <form action="{{ route('DeleteProject',['id' => $project->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="id">
                        <button type="submit" class="btn-sm btn-warning text-decoration-none me-1">
                            削除
                        </button>
                    </form>
                </div> <!--mt-1 mb-1 text-end-->

                <form action="{{ route('ChangeProject',['id' => $project->id]) }}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="" class="mb-2 form-label">プロジェクト名<span class="small text-danger"> 必須</span></label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name', $project -> name) }}">
                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $message)
                                    <p class="small text-danger">→ {{ $message }} </p>
                                @endforeach
                            @endif 
                    </div>
                    <div class="mt-1 mb-3">
                        <label for="" class="mb-2 form-label">スケジュール<span class="small text-danger"> 必須</span></label><br>
                        <input type="date" name="schedule_start" value="{{ old('schedule_start', $project -> schedule_start) }}">　～　<input type="date" name="schedule_end" value="{{ old('schedule_end',$project ->schedule_end) }}">
                            @if($errors->has('schedule_start'))
                                @foreach($errors->get('schedule_start') as $message)
                                    <p class="small text-danger">→ {{ $message }} </p>
                                @endforeach
                            @endif 
                            
                            @if($errors->has('schedule_end'))
                                @foreach($errors->get('schedule_end') as $message)
                                    <p class="small text-danger">→ {{ $message }} </p>
                                @endforeach
                            @endif 
                    </div>
                    <div class="mt-1 mb-3">
                        <label for="" class="mt-1">メンバー1<span class="small text-danger"> 必須</span></label><br>
                        <div>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member1">
                                <option selected value=" " class="text-black-50">未選択</option>
                                @foreach($members AS $member)
                                    <option value="{{ $member->id }}"{{ old('member1', $project->member1) === $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                                @if($errors->has('member1'))
                                    @foreach($errors->get('member1') as $message)
                                        <p class="small text-danger">→ {{ $message }} </p>
                                    @endforeach
                                @endif 
                        </div>
                        <label for="" class="mt-1">メンバー2</label><br>
                        <div>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member2">
                                <option selected value=" " class="text-black-50">未選択</option>
                                @foreach($members AS $member)
                                    <option value="{{ $member->id }}"{{ old('member2', $project->member2) === $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="" class="mt-1">メンバー3</label><br>
                        <div>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member3">
                                <option selected value=" " class="text-black-50">未選択</option>
                                @foreach($members AS $member)
                                    <option value="{{ $member->id }}"{{ old('member3', $project->member3) === $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-1 mb-4">
                        <label for="" class="mb-2 form-label">コメント</label>
                        <textarea class="form-control" name="memo" id="exampleFormControlTextarea1" rows="4">{{ old('memo', $project -> memo) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">編集</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary ms-2">戻る</a>
                </form>
            </div>
        </div>
    </div>

@endsection
