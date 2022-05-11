<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorksController extends Controller
{
    // 選択されたプロジェクトのプランを表示
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

        $projects = project::where('id',$id)->orderby('schedule_end','asc')->paginate(15);
        // dd($projects);
        
        $workslists = work::where('project_id',$id)->orderby('schedule_end','asc')->paginate(15);
        // dd($workslists);

        $work = work::where('project_id', $id)->where('status','<', 3)->get();
        // dd($work);

        if(!$work -> isEmpty()){
            $project -> end = null;
            $project -> save();
        }

        $project_box = 'off';

        return view('workout.home',compact('projects','workslists','project_box'));
    }

    // 選択プロジェクトの新規プランを作成
    public function RegistPlan(Request $request)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required | string | max: 100',
            'schedule_start'=> 'required | ',
            'schedule_end'=> 'required  | after_or_equal:schedule_start',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
            'schedule_start.required' => '開始日：入力は必須です。',
            'schedule_end.required' => '終了日：入力は必須です。',
            'schedule_end.after_or_equal' => '終了日：開始日より後に設定してください。',
        ]);

        $data = $request->all();
        // dd($data);

        $project_id = work::create
        ([
            'name' => $data['name'],
            'schedule_start' => $data['schedule_start'],
            'schedule_end' => $data['schedule_end'],
            'memo' => $data['memo'],
            'user_id' => $data['user_id'],
            'project_id' => $data['project_id'],
        ]);

        $id = $data['project_id'];

        return redirect()->route('SelectProject',['id'=>$id]);
    }

    //works開始
    public function StartPlan($id)
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

    // プラン終了
    public function EndPlan($id)
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


    // プラン編集画面へ移動
    public function EditPlan($id)
    {
        $plan = work::find($id);
        // dd($plan -> project_id);

        $projects = project::where('id', $plan -> project_id)->orderby('schedule_end','asc')->paginate(15);
        // dd($projects);

        $project_box = 'off';

        return view('workout.edit-plan',compact('plan','projects','project_box'));
    }


    // プランのDB更新
    public function ChangePlan(Request $request,$id)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required | string | max: 100',
            'schedule_start'=> 'required | ',
            'schedule_end'=> 'required  | after_or_equal:schedule_start',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
            'schedule_start.required' => '開始日：入力は必須です。',
            'schedule_end.required' => '狩猟日::入力は必須です。',
            'schedule_end.after_or_equal' => '終了日：開始日より後に設定してください。',
        ]);

        $work = work::find($id);
        $data = $request->all();
        // dd($data);

            $work -> name = $data['name'] ;
            $work -> schedule_start = $data['schedule_start'];
            $work -> schedule_end = $data['schedule_end'];
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


    // プラン削除
    public function DeletePlan(Request $request,$id)
    {
        $work = work::find($id);
        // dd($work);

        $works_id = $work->project_id;
        // dd($works_id);

        $work->delete();

        return redirect()->route('SelectProject',['id' => $works_id]);
    }

}
