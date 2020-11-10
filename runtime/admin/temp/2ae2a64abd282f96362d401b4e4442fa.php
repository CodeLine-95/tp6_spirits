<?php /*a:1:{s:60:"/Applications/MAMP/htdocs/tp6/app/admin/view/user/index.html";i:1604996193;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>购买用户列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all">
    <script src="/static/layui/layui.js"></script>
    <style>
        .layui-btn:hover {
            opacity: .8;
            filter: alpha(opacity=80);
            color: #fff;
        }

        .btn-add-radius {
            border-radius: 100px;
        }
        .btn-add {
            background-color: rgba(4, 156, 196, 1);
        }
    </style>
</head>
<body style="background:#f6f6f6;">
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">
           <span class="layui-breadcrumb" lay-separator="/" style="visibility: visible;">
              <a href="<?php echo url('index/index'); ?>">控制台</a>
              <a><cite>用户管理</cite></a>
              <a><cite>购买用户列表</cite></a>
            </span>
        </div>
        <div class="layui-card-body">
            <table id="table" lay-filter="table_list"></table>
            <script type="text/html" id="rightToolbar">
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
        </div>
    </div>
</div>
<script type="text/javascript">
    layui.use(['element','table'], function(){
        var element = layui.element,$ = layui.jquery,table = layui.table;
        table.render({
            elem: '#table'
            ,height: "auto"
            ,defaultToolbar : false
            ,url: "<?php echo url('user/userList'); ?>"
            ,cols: [[ //表头
                {field: 'id', title: '编号', width:60, sort: false}
                ,{field: 'user_tel', title: '手机号', width:''}
                ,{field: 'create_time', title: '创建时间', width: 180}
                ,{fixed: 'right', title: '操作', width: 150, unresize: true, toolbar: "#rightToolbar"},
            ]]
            , page: {theme: '#2aace4',prev: '上一页',next: '下一页'}
            , request: {
                limitName : 'pageSize'
            }
            , skin: 'line'
            , text: {
                none: "数据为空!"
            }
        });

        //监听行工具栏
        table.on('tool(table_list)', function(obj){
            var layEvent = obj.event;
            var data = obj.data;
            if(layEvent === 'edit'){
                window.location.href = "<?php echo url('goods/edit'); ?>"+"?id="+data.id;
            }else if(layEvent === 'del'){
                layer.confirm("您确定要删除吗？", function () {
                    $.get("<?php echo url('goods/del'); ?>" + "?id=" + data.id, function (res) {
                        if (res.code == 0) {
                            layer.msg('删除成功')
                            window.location.reload()
                        } else {
                            layer.msg(res.msg)
                            window.location.reload()
                        }
                    });
                })
            }
        });
    });
</script>
</body>
</html>
