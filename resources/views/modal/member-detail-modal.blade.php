<!-- Modal -->
<div class="modal fade" id="member{{ $member->id }}" tabindex="-1" aria-labelledby="js-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">メンバー詳細</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　名前　</label><br>
                    {{$member->name}}
                </div>
                <div class="mt-1 mb-3">
                    <a href="{{ route('Member_project_Plan',['id' => $member->id ]) }}" class="btn btn-sm btn-outline-primary">担当プロジェクト & ワークスの確認</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                <a href="{{ route('EditMember',['id' => $member->id ]) }}" class="btn  btn-outline-success">編集</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->