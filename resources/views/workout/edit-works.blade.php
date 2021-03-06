@extends('layouts.app')

@section('content')

<div class="col-md-5 p-0">
    <div class="card h-100">
        <div class="card-header d-flex">{{ $work ->name }} の編集<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
            <div class="card-body py-2 px-4 mt-1">
                <div class="mt-1 mb-1 text-end">
                    <form method="post" action="{{ route('DeleteWorks',['id' => $work->id]) }}">
                        @csrf
                        <input type="hidden" name="id">
                        <button type="submit" class="btn-sm btn-warning text-decoration-none me-1" onClick="delete_alert(event);return false;">
                            削除
                        </button>
                    </form>
                </div> <!--mt-1 mb-1 text-end-->

                <form action="{{ route('ChangeWorks',['id' => $work->id]) }}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="" class="mb-2 form-label">ワークス名<span class="small text-danger"> 必須</span></label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name', $work->name) }}">
                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $message)
                                    <p class="small text-danger">→ {{ $message }} </p>
                                @endforeach
                            @endif 
                    </div>
                    <div class="mt-1 mb-3">
                        <label for="" class="mb-2 form-label">スケジュール<span class="small text-danger"> 必須</span></label><br>
                        <input type="date" name="schedule_start" value="{{ old('schedule_start', $work->schedule_start) }}">　～　<input type="date" name="schedule_end" value="{{ old('schedule_end', $work->schedule_end) }}">
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
                        <label for="" class="mb-1 form-label">状態<span class="small text-danger"> 必須</span></label><br>
                        <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineRadio1" type="radio" name="status" value="1"  {{ $work->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">ToDo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineRadio2" type="radio" name="status" value="2"  {{ $work->status == 2 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Doing</label>
                            </div>                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineRadio3" type="radio" name="status" value="3"  {{ $work->status == 3 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio3">Done</label>
                        </div>
                    </div>
                    <div class="mt-1 mb-3">
                        <label for="" class="mt-1">メンバー1<span class="small text-danger"> 必須</span></label><br>
                            <div>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member1">
                                    @foreach($projects AS $project)
                                        <option selected value=" " class="text-black-50">未選択</option>
                                        <option value="{{ $project->member1 }}" @if($project->member1 === (int)old('member1',$work->member1)) selected @endif>{{ $project->member1_name }}</option>
                                        @if(!$project->member2 == null)
                                        <option value="{{ $project->member2 }}" @if($project->member2 === (int)old('member1',$work->member1)) selected @endif>{{ $project->member2_name }}</option>
                                        @endif
                                        @if(!$project->member3 == null)
                                        <option value="{{ $project->member3 }}" @if($project->member3 === (int)old('member1',$work->member1)) selected @endif>{{ $project->member3_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($errors->has('member1'))
                                    @foreach($errors->get('member1') as $message)
                                        <p class="small text-danger mb-1">→ {{ $message }} </p>
                                    @endforeach
                                @endif 
                            </div>
                        <label for="" class="mt-1">メンバー2</label><br>
                            <div>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member2">
                                    @foreach($projects AS $project)
                                        <option selected value=" " class="text-black-50">未選択</option>
                                        <option value="{{ $project->member1 }}" @if($project->member1 === (int)old('member2',$work->member2)) selected @endif>{{ $project->member1_name }}</option>
                                        @if(!$project->member2 == null)
                                        <option value="{{ $project->member2 }}" @if($project->member2 === (int)old('member2',$work->member2)) selected @endif>{{ $project->member2_name }}</option>
                                        @endif
                                        @if(!$project->member3 == null)
                                        <option value="{{ $project->member3 }}" @if($project->member3 === (int)old('member2',$work->member2)) selected @endif>{{ $project->member3_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                    @if($errors->has('member2'))
                                        @foreach($errors->get('member2') as $message)
                                            <p class="small text-danger mb-1">→ {{ $message }} </p>
                                        @endforeach
                                    @endif 
                            </div>
                        <label for="" class="mt-1">メンバー3</label><br>
                            <div>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member3">
                                    @foreach($projects AS $project)
                                        <option selected value=" " class="text-black-50">未選択</option>
                                        <option value="{{ $project->member1 }}" @if($project->member1 === (int)old('member3',$work->member3)) selected @endif>{{ $project->member1_name }}</option>
                                        @if(!$project->member2 == null)
                                        <option value="{{ $project->member2 }}" @if($project->member2 === (int)old('member3',$work->member3)) selected @endif>{{ $project->member2_name }}</option>
                                        @endif
                                        @if(!$project->member3 == null)
                                        <option value="{{ $project->member3 }}" @if($project->member3 === (int)old('member3',$work->member3)) selected @endif>{{ $project->member3_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                    @if($errors->has('member3'))
                                        @foreach($errors->get('member3') as $message)
                                            <p class="small text-danger mb-1">→ {{ $message }} </p>
                                        @endforeach
                                    @endif 
                            </div>
                    </div>
                    <div class="mt-1 mb-4">
                        <label for="" class="mb-2 form-label">コメント</label>
                        <textarea class="form-control" name="memo" id="exampleFormControlTextarea1" rows="4">{{ old('memo',$work->memo) }} </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">編集</button>
                    <a href="{{ route('SelectProject',['id' => $work->project_id] ) }}" class="btn btn-secondary ms-2">戻る</a>
                </form>
            </div>
        </div>
    </div>

@endsection
