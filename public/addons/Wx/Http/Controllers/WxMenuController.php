<?php
namespace Modules\Wx\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\WeChatService;
use Illuminate\Http\Request;
use Modules\Wx\Entities\WxMenu;
use Modules\Wx\Http\Requests\WxMenuRequest;
use Modules\Wx\Services\WeChatServer;

class WxMenuController extends Controller
{
    //显示列表
    public function index()
    {
        $data = WxMenu::paginate(10);
        return view('wx::wx_menu.index', compact('data'));
    }

    //创建视图
    public function create(WxMenu $wx_menu)
    {
        return view('wx::wx_menu.create',compact('wx_menu'));
    }

    //保存数据
    public function store(WxMenuRequest $request,WxMenu $wx_menu)
    {
//        dd($request->input('name'));
        $wx_menu->name = $request->input('name');
        $wx_menu->data = json_decode($request->input('data'));
        $wx_menu->save();
        return redirect('/wx/wx_menu')->with('success', '保存成功');
    }

    //显示记录
    public function show(WxMenu $field)
    {
        return view('wx::wx_menu.show', compact('field'));
    }

    //编辑视图
    public function edit(WxMenu $wx_menu)
    {
//        dd($wx_menu->toArray());
        return view('wx::wx_menu.edit', compact('wx_menu'));
    }

    //更新数据
    public function update(WxMenuRequest $request, WxMenu $wx_menu)
    {
        $wx_menu->name = $request->input('name');
        $wx_menu->data = json_decode($request->input('data'));
        $wx_menu->save();
        return redirect('/wx/wx_menu')->with('success','更新成功');
    }

    //删除模型
    public function destroy(WxMenu $wx_menu)
    {
        $wx_menu->delete();
        return redirect('wx/wx_menu')->with('success','删除成功');
    }

    public function push(WxMenu $menu,WeChatService $chatService){

        $data = $chatService->instance('button')->create(['button'=>$menu['data']]);

        if($data['errcode']==0){
            $menu->sta = 1;
            $menu->save();
            \DB::table('wx_menus')->where('id','!=',$menu['id'])->update(['sta'=>0]);
            return back()->with('success','微信菜单推送成功，请稍后在微信查看');
        }else{
            return back()->with('danger',$data['errmsg']);
        }
    }
}
