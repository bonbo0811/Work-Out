<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Work;
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

        $project_id = Project::create
        ([
            'name' => $data['name'],
            'schedule_start' => $data['schedule_start'],
            'schedule_end' => $data['schedule_end'],
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

        return view('workout.edit-project',compact('projects','project','project_box'));
    }


    // プロジェクトDB更新
    public function ChangeProject(REQUEST $request, $id)
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

        $project = project::find($id);
        $data = $request->all();
        // dd($data);

            $project -> name = $data['name'];
            $project -> schedule_start = $data['schedule_start'];
            $project -> schedule_end = $data['schedule_end'];
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
