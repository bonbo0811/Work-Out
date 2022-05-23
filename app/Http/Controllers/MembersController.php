<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Project;
use App\Models\Work;


class MembersController extends Controller
{
    // （メンバーコントローラー）メンバー一覧
    public function MemberList()
    {
        $user = \AUTH::user();
        $projects = Project::where('user_id',$user['id'])->orderby('schedule_end','asc')->paginate(15);
        $project_box = 'on';
        $members = member::where('user_id',$user['id'])->orderby('created_at','asc')->paginate(15);

        return view('workout.memberlist',compact('projects','project_box','members'));
    }


    // 新規メンバー登録
    public function RegistMember(Request $request)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required | max: 100',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
        ]);

        $data = $request->all();
        // dd($data);

        $member_id = member::create
        ([
            'name' => $data['name'],
            'user_id' => $data['user_id'],
        ]);

        return redirect()->route('MemberList');
    }


    // メンバー編集ページへ
    public function EditMember($id)
    {
        $member = member::find($id);

        $projects = project::where('user_id', $member -> user_id)->orderby('schedule_end','asc')->paginate(15);
        // dd($projects);

        $project_box = 'off';

        return view('workout.edit-member',compact('member','projects','project_box'));
    }


    // メンバーDB編集
    public function ChangeMember(Request $request, $id)
    {
        // バリデーション
        $validate = $request ->validate([
            'name' => 'required  | max: 100',
        ],
        // バリデーションメッセージ
        [
            'name.required' => '入力は必須です。',
            'name.max' => '入力は100文字までです。',
        ]);

        $member = member::find($id);
        $data = $request->all();
        // dd($member);

            $member -> name = $data['name'];

        $member -> save();

        return redirect()->route('MemberList');
    }


    // プラン削除
    public function DeleteMember(Request $request,$id)
    {
        $member = member::find($id);
        // dd($member);

        $member->delete();

        return redirect()->route('MemberList');
    }

    // 担当プロジェクト、プランを表示
    public function Member_project_Plan($id)
    {
        $member = member::find($id);
        // dd($member);

        $projects = project::where('member1',$id)->orwhere('member2',$id)->orwhere('member3',$id)->paginate(15);
        // dd($projects);

        $workslists = work::where('member1',$id)->orwhere('member2',$id)->orwhere('member3',$id)->paginate(15);
        // dd($workslists);

        $project = project::where('member1',$id)->orwhere('member2',$id)->orwhere('member3',$id)->first();
        $project_name = $project -> name;
        // dd($project_name);

        $project_box = 'off';

        $plan_box = 'off';

        return view('workout.home',compact('projects','project_box','plan_box','workslists','project_name'));
    }
}
