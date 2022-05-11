<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="js-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('RegistProject') }}" method="post">
            @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">新規{{ $name }}作成</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">{{ $name }}名</label>
                            <input type="text" class="form-control form-control-sm" name="name" required>
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">スケジュール</label><br>
                            <input type="date" name="schedule_start" required>　～　<input type="date" name="schedule_end" required>
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">リーダー</label><br>
                            <div>
                                @foreach($members AS $member)
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" type="radio" id="inlineCheckbox{{$member->id}}" name="member_id" value="{{ $member->id }}">
                                        <label class="form-check-label" for="inlineCheckbox{{$member->id}}">{{ $member->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-1 mb-3">
                            <label for="" class="mb-2">{{ $name }} コメント</label>
                            <textarea class="form-control"  placeholder="空欄でもOK" name="memo" id="exampleFormControlTextarea1" rows="4"></textarea>
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