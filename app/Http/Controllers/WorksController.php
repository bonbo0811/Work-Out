<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Work;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorksController extends Controller
{
    // 選択されたプロジェクトのワークスを表示
    public function SelectProject($id)
    {
        $project = project::find($id);
        // dd($project);

        $work = work::where('project_id', $id)->where('status','<', 3)->get();
        // dd($work);

        if(!$work -> isEmpty()){
            $project -> end = null;
            $project -> save();
        }

        $work2 = work::where('project_id', $id)->where('status','>', 1)->get();
        // dd($work2);

        if($work2 -> isEmpty()){
            $project -> start = null;
            $project -> save();
        }

        $user = \AUTH::user(); 
        $members = member::where('user_id',$user['id'])->get();

        $projects = project::where('id',$id)->orderby('schedule_end','asc')->paginate(15);
        // dd($projects);
        
        $workslists = work::where('project_id',$id)->orderby('schedule_end','asc')->paginate(15);
        // dd($workslists);

        $project = project::find($id);
        $project_name = $project -> name;
        // dd($project_name);

        $project_box = 'off';

        $works_box = 'on';

        return view('workout.home',compact('projects','workslists','project_box','works_box','members','project_name'));
    }


    // 選択プロジェクトの新規ワークスを作成
    public function RegistWorks(Request $request)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required| string| max: 100',
            'schedule_start'=> 'required| ',
            'schedule_end'=> 'required| after_or_equal:schedule_start',
            'member1'=>'required| exists:members,id| different:member2| different:member3',
            'member2'=>'nullable| exists:members,id| different:member1| different:member3',
            'member3'=>'nullable| exists:members,id| different:member1| different:member2',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
            'schedule_start.required' => '開始日：入力は必須です。',
            'schedule_end.required' => '終了日：入力は必須です。',
            'schedule_end.after_or_equal' => '終了日：開始日より後に設定してください。',
            'member1.required' => 'メンバー１は必須です。',
            'member1.different' => '同じメンバーが選ばれています。',
            'member1.exists' => 'そのメンバーは削除されているため選択できません。',
            'member2.different' => '同じメンバーが選ばれています。',
            'member2.exists' => 'そのメンバーは削除されているため選択できません。',
            'member3.different' => '同じメンバーが選ばれています。',
            'member3.exists' => 'そのメンバーは削除されているため選択できません。',
        ]);

        $data = $request->all();
        // dd($data);

        $member1 = member::find($data['member1']);
        // dd($member1->name);

        if(!$data['member2'] == null)
        {
            $member2 = member::find($data['member2']);
            // dd($member2->name);
            $member2name = $member2->name;
        }else{
            $member2name = null;
        }

        if(!$data['member3'] == null)
        {
            $member3 = member::find($data['member3']);
            // dd($member3->name);
            $member3name = $member3->name;
        }else{
            $member3name = null;
        }

        $project = project::find($data['project_id']);
        $project_name = $project -> name;
        // dd($project_name);

        $project_id = work::create
        ([
            'name' => $data['name'],
            'schedule_start' => $data['schedule_start'],
            'schedule_end' => $data['schedule_end'],
            'member1' => $data['member1'],
            'member1_name' => $member1->name,
            'member2' => $data['member2'],
            'member2_name' => $member2name,
            'member3' => $data['member3'],
            'member3_name' => $member3name,
            'memo' => $data['memo'],
            'user_id' => $data['user_id'],
            'project_id' => $data['project_id'],
            'project_name' => $project_name,
        ]);

        $id = $data['project_id'];

        return redirect()->route('SelectProject',['id'=>$id]);
    }


    //works開始
    public function StartWorks($id)
    {
        $work = work::find($id);

        $today = new Carbon('today');

            $work->status = 2 ;
            $work->start = $today;

        $work->save();

        $project = project::find($work->project_id);

        if( $project->start == null)
        {
            $project->start = $today;
            $project->save(); 
        }

        return redirect()->route('SelectProject',['id'=> $project->id ]);
    }


    // ワークス終了
    public function EndWorks($id)
    {
        $work = work::find($id);

        $today = new Carbon('today');

            $work->status = 3 ;
            $work->end = $today;

        $work->save();

        $works = work::where('project_id', $work->project_id )->where('status','<', 3)->get();
        // dd($works);
        $project = project::find($work->project_id); 

        $today = new Carbon('today');

        if($works -> isEmpty()){
            $project -> end = $today;
            $project -> save();
        }

        return redirect()->route('SelectProject',['id'=> $work->project_id ]);
    }


    // ワークス編集画面へ移動
    public function EditWorks($id)
    {
        $work = work::find($id);
        // dd($work -> project_id);

        $projects = project::where('id', $work -> project_id)->orderby('schedule_end','asc')->paginate(15);
        // dd($projects);

        $user = \AUTH::user();
        $members = member::where('user_id',$user['id'])->get();

        $project_box = 'off';

        return view('workout.edit-works',compact('work','projects','project_box','members'));
    }


    // ワークスのDB更新
    public function ChangeWorks(Request $request,$id)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required| string | max: 100',
            'schedule_start'=> 'required| ',
            'schedule_end'=> 'required | after_or_equal:schedule_start',
            'member1'=>'required| exists:members,id| different:member2| different:member3',
            'member2'=>'nullable| exists:members,id| different:member1| different:member3',
            'member3'=>'nullable| exists:members,id| different:member1| different:member2',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
            'schedule_start.required' => '開始日：入力は必須です。',
            'schedule_end.required' => '狩猟日::入力は必須です。',
            'schedule_end.after_or_equal' => '終了日：開始日より後に設定してください。',
            'member1.required' => 'メンバー１は必須です。',
            'member1.different' => '同じメンバーが選ばれています。',
            'member1.exists' => 'そのメンバーは削除されているため選択できません。',
            'member2.different' => '同じメンバーが選ばれています。',
            'member2.exists' => 'そのメンバーは削除されているため選択できません。',
            'member3.different' => '同じメンバーが選ばれています。',
            'member3.exists' => 'そのメンバーは削除されているため選択できません。',
        ]);

        $work = work::find($id);
        $data = $request->all();
        // dd($data);

        $member1 = member::find($data['member1']);
        // dd($member->name);

        if(!$data['member2'] == null)
        {
            $member2 = member::find($data['member2']);
            // dd($member2->name);
            $member2name = $member2->name;
        }else{
            $member2name = null;
        }

        if(!$data['member3'] == null)
        {
            $member3 = member::find($data['member3']);
            // dd($member3->name);
            $member3name = $member3->name;
        }else{
            $member3name = null;
        }

            $work -> name = $data['name'] ;
            $work -> schedule_start = $data['schedule_start'];
            $work -> schedule_end = $data['schedule_end'];
            $work -> member1 = $data['member1'];
            $work -> member1_name = $member1->name;
            $work -> member2 = $data['member2'];
            $work -> member2_name = $member2name;
            $work -> member3 = $data['member3'];
            $work -> member3_name = $member3name;
            $work -> status = $data['status'];
            $work -> memo = $data['memo'];

            if( $data['status'] == 1 ){
                $work -> start = null;
                $work -> end = null;
            }elseif ($data['status'] == 2){
                $work -> end = null;
            }

        $work -> save();

        return redirect() -> route('SelectProject',['id' => $work->project_id]);
    }


    // ワークス削除
    public function DeleteWorks(Request $request,$id)
    {
        $work = work::find($id);
        // dd($work);

        $works_id = $work->project_id;
        // dd($works_id);

        $work->delete();

        return redirect()->route('SelectProject',['id' => $works_id]);
    }

}
