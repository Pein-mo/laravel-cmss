@extends('admin::layouts.master')
@section('content')
    {!! $ruleView !!}
    <div class="card" id="app">
        <div class="card-header">基本回复管理</div>
        <ul role="tablist" class="nav nav-tabs">
            <li class="nav-item"><a href="/wx/wx_reply_base" class="nav-link">基本回复列表</a></li>
            <li class="nav-item"><a href="#" class="nav-link active">添加基本回复</a></li>
        </ul>
        <form action="/wx/wx_reply_base" method="post">
            <div class="card-body card-body-contrast">
                @csrf
                <div class="form-group row">
                    <label for="content" class="col-12 col-sm-3 col-form-label text-md-right">回复内容</label>
                    <div class="col-md-10" v-for="(v,i) in contents">
                        <textarea id="content" name="content" rows="3" class="form-control form-control" v-model="v.content"></textarea>
                        <a href="javascript:;"><i class="fa fa-github-alt" aria-hidden="true"></i>图标</a>
                        <button class="btn btn-secondary" type="button" @click="del(i)">删除</button>
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-primary offset-sm-2" @click="add()" type="button">添加回复条目</button>
            </div>
        </form>
    </div>
    <script>
        require(['vue','hdjs'],function (vue,hdjs) {
            new vue({
                el:"#app",
                data:{
                    contents:[{content:''}]
                },
                //挂载
                mounted(){
                    alert(3);
                },
                methods:{
                    add(){
                        this.contents.push({content:''});
                    },
                    del(pos){
                        this.contents.splice(pos,1)
                    }
                }
            })
        });

    </script>
@endsection

