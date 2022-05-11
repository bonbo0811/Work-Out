<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="js-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('RegistPlan') }}" method="post">
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
                            <label for="" class="mb-2">{{ $name }}名</label>
                            <input type="text" class="form-control form-control-sm" name="name" required>
                                @if($errors->has('name'))
                                    @foreach($errors->get('name') as $message)
                                        <p class="small text-danger">→ {{ $message }} </p>
                                    @endforeach
                                @endif 
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">スケジュール</label><br>
                            <input type="date" name="schedule_start" required>　～　<input type="date" name="schedule_end" required>
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
                            <label for="" class="mb-2">メンバー</label><br>
                            
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">{{ $name }} コメント</label>
                            <textarea class="form-control"  placeholder="空欄でも可" name="memo" id="exampleFormControlTextarea1" rows="4"></textarea>
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