<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="js-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('RegistWorks') }}" method="post">
            @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @foreach($projects AS $project)
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                @endforeach
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">新規{{ $name }}作成</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">{{ $name }}名 <span class="small text-danger"> 必須</span></label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}" required>
                                @if($errors->has('name'))
                                    @foreach($errors->get('name') as $message)
                                        <p class="small text-danger">→ {{ $message }} </p>
                                    @endforeach
                                @endif 
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">スケジュール <span class="small text-danger"> 必須</span></label><br>
                            <input type="date" name="schedule_start" value="{{ old('schedule_start') }}" required>　～　<input type="date" name="schedule_end" value="{{ old('schedule_end') }}" required>
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
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member1" value="{{ old('member1') }}" required>
                                        @foreach($projects AS $project)
                                            <option selected value=" " class="text-black-50">未選択</option>
                                            <option value="{{ $project->member1 }}" @if( $project->member1 === (int)old('member1')) selected @endif>{{ $project->member1_name }}</option>
                                            @if(!$project->member2 == null)
                                            <option value="{{ $project->member2 }}" @if( $project->member2 === (int)old('member1')) selected @endif>{{ $project->member2_name }}</option>
                                            @endif
                                            @if(!$project->member3 == null)
                                            <option value="{{ $project->member3 }}" @if( $project->member3 === (int)old('member1')) selected @endif>{{ $project->member3_name }}</option>
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
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member2" value="{{ old('member2') }}">
                                        @foreach($projects AS $project)
                                            <option selected value=" " class="text-black-50">未選択</option>
                                            <option value="{{ $project->member1 }}" @if( $project->member1 === (int)old('member2')) selected @endif>{{ $project->member1_name }}</option>
                                            @if(!$project->member2 == null)
                                            <option value="{{ $project->member2 }}" @if( $project->member2 === (int)old('member2')) selected @endif>{{ $project->member2_name }}</option>
                                            @endif
                                            @if(!$project->member3 == null)
                                            <option value="{{ $project->member3 }}" @if( $project->member3 === (int)old('member2')) selected @endif>{{ $project->member3_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                        @if($errors->has('member2'))
                                            @foreach($errors->get('member2') as $message)
                                                <p class="small text-danger">→ {{ $message }} </p>
                                            @endforeach
                                        @endif 
                                </div>
                            <label for="" class="mt-1">メンバー3</label><br>
                                <div>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="member3">
                                        @foreach($projects AS $project)
                                            <option selected value=" " class="text-black-50">未選択</option>
                                            <option value="{{ $project->member1 }}" @if( $project->member1 === (int)old('member3')) selected @endif>{{ $project->member1_name }}</option>
                                            @if(!$project->member2 == null)
                                            <option value="{{ $project->member2 }}" @if( $project->member2 === (int)old('member3')) selected @endif>{{ $project->member2_name }}</option>
                                            @endif
                                            @if(!$project->member3 == null)
                                            <option value="{{ $project->member3 }}" @if( $project->member3 === (int)old('member3')) selected @endif>{{ $project->member3_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                        @if($errors->has('member3'))
                                            @foreach($errors->get('member3') as $message)
                                                <p class="small text-danger">→ {{ $message }} </p>
                                            @endforeach
                                        @endif 
                                </div>
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">{{ $name }} コメント</label>
                            <textarea class="form-control" placeholder="空欄でもOK" name="memo" id="exampleFormControlTextarea1" rows="4">{{ old('memo') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->