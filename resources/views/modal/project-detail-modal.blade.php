<!-- Modal -->
<div class="modal fade" id="project{{ $project->id }}" tabindex="-1" aria-labelledby="js-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">{{$project->name}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　スケジュール　</label><br>
                    {{date('Y 年 n 月 j 日', strtotime( $project->schedule_start))}}　～　{{date('Y 年 n 月 j 日', strtotime( $project->schedule_end))}}
                </div>
                <div class="mt-1 mb-3">
                    @if( $project->start !== null )
                    <label for="" class="mb-2 bg-info rounded text-white">　開始 & 終了　</label><br>
                        {{date('Y 年 n 月 j 日', strtotime( $project->start))}}　～　
                    @endif
                    @if($project->end !== null)
                        {{date('Y 年 n 月 j 日', strtotime( $project->end))}}
                    @endif
                </div>
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　メンバー　</label><br>
                    <div class="col-md-5">
                        <p class="mb-0">{{'大久保賢人'}}</p>
                    </div>
                    <div class="col-md-5">
                        <p class="mb-0">{{'サンプル１'}}</p>
                    </div>
                    <div class="col-md-5">
                        <p class="mb-0">{{'サンプル２'}}</p>
                    </div>
                </div>
                <div class="mt-1 mb-3">
                    <label for="" class="mb-2 bg-info rounded text-white">　コメント　</label><br>
                    {!!nl2br($project->memo)!!}
                </div>
            </div>
            <div class="modal-footer">
                <a href=" {{ route('SelectProject',['id'=> $project->id]) }} " class="btn btn-primary">選択</a>
                <a href="{{ route('EditProject',['id'=> $project->id]) }}" class="btn  btn-outline-success">編集</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->