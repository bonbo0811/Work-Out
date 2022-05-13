<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Work;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProjectsController extends Controller
{
    // 準備中プロジェクトを取得 -> 表示
    public function PreparationProject()
    {
        $user = \AUTH::user();
        $projects = Project::where('user_id',$user['id'])->whereNull('start')->orderby('schedule_end','asc')->paginate(15);
        $project_box = 'off';

        return view('layouts.app',compact('projects','project_box'));
    }


    // 行動中プロジェクトを取得 -> 表示
    public function ExecutionProject()
    {
        $user = \AUTH::user();
        $projects = Project::where('user_id',$user['id'])->whereNotNull('start')->whereNull('end')->orderby('schedule_end','asc')->paginate(15);
        $project_box = 'off';

        return view('layouts.app',compact('projects','project_box'));
    }


    // 完了済みプロジェクトを取得 -> 表示
    public function CompletionProject()
    {
        $user = \AUTH::user();
        $projects = Project::where('user_id',$user['id'])->whereNotNull('end')->orderby('schedule_end','asc')->paginate(15);
        $project_box = 'off';

        return view('layouts.app',compact('projects','project_box'));
    }


    // 新規プロジェクト登録
        public function RegistProject(REQUEST $request)
        {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required  | max: 100',
            'schedule_start'=> 'required | ',
            'schedule_end'=> 'required | date | after_or_equal:schedule_start',
            'member1'=> 'required | ',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
            'schedule_start.required' => '開始日：入力は必須です。',
            'schedule_end.required' => '終了日：入力は必須です。',
            'schedule_end.after_or_equal' => '終了日：開始日より後に設定してください。',
            'member1.required' => 'メンバー1を選択してください。',
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

        $project_id = Project::create
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
        ]);

        return redirect()->route('home');
        }


    // プロジェクト編集画面へ
    public function EditProject($id)
    {
        $projects = project::where('id', $id)->orderby('schedule_end','asc')->paginate(15);
        // dd($projects);

        $project = project::find($id);
        $project_box = 'off';

        $user = \AUTH::user();
        $members = member::where('user_id',$user['id'])->get();

        return view('workout.edit-project',compact('projects','project','project_box','members'));
    }


    // プロジェクトDB更新
    public function ChangeProject(REQUEST $request, $id)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required | string | max: 100',
            'schedule_start'=> 'required | ',
            'schedule_end'=> 'required  | after_or_equal:schedule_start',
            'member.required' => 'メンバーを選択してください。',
            'member1'=> 'required | ',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
            'schedule_start.required' => '開始日：入力は必須です。',
            'schedule_end.required' => '終了日：入力は必須です。',
            'schedule_end.after_or_equal' => '終了日：開始日より後に設定してください。',
            'member1.required' => 'メンバー1を選択してください。',
        ]);

        $project = project::find($id);
        $data = $request->all();
        // dd($data);

        $member1 = member::find($data['member1']);

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

            $project -> name = $data['name'];
            $project -> schedule_start = $data['schedule_start'];
            $project -> schedule_end = $data['schedule_end'];
            $project -> member1 = $data['member1'];
            $project -> member1_name = $member1->name;
            $project -> member2 = $data['member2'];
            $project -> member2_name = $member2name;
            $project -> member3 = $data['member3'];
            $project -> member3_name = $member3name;
            $project -> memo = $data['memo'];

        $project -> save();

        return redirect()->route('home');
    }


    // プロジェクト削除
    public function DeleteProject(Request $request,$id)
    {
        $project = project::find($id);
        // dd($project);

        $works = work::where('project_id',$id)->delete();
        // dd($works);

        $project ->delete();

        return redirect()->route('home');
    }

}