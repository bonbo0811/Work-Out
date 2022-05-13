@extends('layouts.app')

@section('content')

<div class="col-md-5 p-0">
    <div class="card h-100">
        <div class="card-header d-flex">{{ $plan ->name }} の編集<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            <div class="card-body py-2 px-4 mt-1">
                <div class="mt-1 mb-1 text-end">
                    <form method="post" action="{{ route('DeletePlan',['id' => $plan->id]) }}">
                        @csrf
                        <input type="hidden" name="id">
                        <button type="submit" class="btn-sm btn-warning text-decoration-none me-1">
                            削除
                        </button>
                    </form>
                </div> <!--mt-1 mb-1 text-end-->

                <form action="{{ route('ChangePlan',['id' => $plan->id]) }}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="" class="mb-2 form-label">プラン名</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name', $plan -> name) }}">
                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $message)
                                    <p class="small text-danger">→ {{ $message }} </p>
                                @endforeach
                            @endif 
                    </div>
                    <div class="mt-1 mb-3">
                        <label for="" class="mb-2 form-label">スケジュール</label><br>
                        <input type="date" name="schedule_start" value="{{ old('schedule_start', $plan -> schedule_start) }}">　～　<input type="date" name="schedule_end" value="{{ old('schedule_end', $plan ->schedule_end) }}">
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
                        <label for="" class="mb-1 form-label">状態</label><br>
                        <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineRadio1" type="radio" name="status" value="1"  {{ $plan->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">ToDo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineRadio2" type="radio" name="status" value="2"  {{ $plan->status == 2 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Doing</label>
                            </div>                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineRadio3" type="radio" name="status" value="3"  {{ $plan->status == 3 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio3">Done</label>
                        </div>
                    </div>
                    <div class="mt-1 mb-3">
                        <label for="" class="mt-1">メンバー1<span class="small text-danger"> 必須</span></label><br>
                            <div>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member1">
                                    @foreach($projects AS $project)
                                        <option selected value=" ">未選択</option>
                                        <option value="{{ $project->member1 }}"{{ old('member1', $plan -> member1) === $project->member1 ? 'selected' : '' }}>{{ $project->member1_name }}</option>
                                        @if(!$project->member2 == null)
                                        <option value="{{ $project->member2 }}"{{ old('member1', $plan -> member1) === $project->member2 ? 'selected' : '' }}>{{ $project->member2_name }}</option>
                                        @endif
                                        @if(!$project->member3 == null)
                                        <option value="{{ $project->member3 }}"{{ old('member1', $plan -> member1) === $project->member3 ? 'selected' : '' }}>{{ $project->member3_name }}</option>
                                        @endif
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
                                    @foreach($projects AS $project)
                                        <option selected value=" ">未選択</option>
                                        <option value="{{ $project->member1 }}"{{ old('member2', $plan -> member2) === $project->member1 ? 'selected' : '' }}>{{ $project->member1_name }}</option>
                                        @if(!$project->member2 == null)
                                        <option value="{{ $project->member2 }}"{{ old('member2', $plan -> member2) === $project->member2 ? 'selected' : '' }}>{{ $project->member2_name }}</option>
                                        @endif
                                        @if(!$project->member3 == null)
                                        <option value="{{ $project->member3 }}"{{ old('member2', $plan -> member2) === $project->member3 ? 'selected' : '' }}>{{ $project->member3_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        <label for="" class="mt-1">メンバー3</label><br>
                            <div>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member3">
                                    @foreach($projects AS $project)
                                        <option selected value=" ">未選択</option>
                                        <option value="{{ $project->member1 }}"{{ old('member3', $plan -> member3) === $project->member1 ? 'selected' : '' }}>{{ $project->member1_name }}</option>
                                        @if(!$project->member2 == null)
                                        <option value="{{ $project->member2 }}"{{ old('member3', $plan -> member3) === $project->member2 ? 'selected' : '' }}>{{ $project->member2_name }}</option>
                                        @endif
                                        @if(!$project->member3 == null)
                                        <option value="{{ $project->member3 }}"{{ old('member3', $plan -> member3) === $project->member3 ? 'selected' : '' }}>{{ $project->member3_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="mt-1 mb-4">
                        <label for="" class="mb-2 form-label">コメント</label>
                        <textarea class="form-control" name="memo" id="exampleFormControlTextarea1" rows="4">{{ old('memo',$plan->memo) }} </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">編集</button>
                    <a href="{{ route('SelectProject',['id' => $plan -> project_id] ) }}" class="btn btn-secondary ms-2">戻る</a>
                </form>
            </div>
        </div>
    </div>

@endsection
