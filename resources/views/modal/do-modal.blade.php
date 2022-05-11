<!-- Modal -->
<div class="modal fade" id="plan{{ $workslist->id }}" tabindex="-1" aria-labelledby="js-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">{{$workslist->name}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　プロジェクト　</label><br>
                    @foreach($projects AS $project)
                        {{$project->name}}
                    @endforeach
                </div>
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded rounded text-white">　スケジュール　</label><br>
                    {{date('Y 年 n 月 j 日', strtotime( $workslist->schedule_start))}}　～　{{date('Y 年 n 月 j 日', strtotime( $workslist->schedule_end))}}
                </div>
                <div class="mt-1 mb-3">
                    @if( $workslist->start !== null )
                        <label for="" class="mb-2 bg-info rounded text-white">　開始 & 終了　</label><br>
                        {{date('Y 年 n 月 j 日', strtotime( $workslist->start))}}　～　
                    @endif
                    @if($workslist->end !== null)
                        {{date('Y 年 n 月 j 日', strtotime( $workslist->end))}}
                    @endif
                </div>
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　担当者　</label><br>
                    <div class="col-md-5">
                        <p class="mb-0">{{$workslist -> member_name}}</p>
                    </div>
                </div>
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　コメント　</label><br>
                    {!!nl2br($workslist->memo)!!}
                </div>
            </div>
            <div class="modal-footer">
                @if($workslist->status == 1)
                    <a href="{{ route('StartPlan',['id'=> $workslist->id]) }}" class="btn btn-primary">開始</a>
                @elseif($workslist->status == 2)
                    <a href="{{ route('EndPlan',['id'=> $workslist->id]) }}" class="btn btn-warning">完了</a>
                @elseif($workslist->status == 3)
                    <button type="button" class="btn btn-secondary" disabled>このプランは完了しました</button>
                @endif 
                    <a href="{{ route('EditPlan',['id'=> $workslist->id]) }}" class="btn btn-outline-success">編集</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->