<?php /*a:2:{s:61:"/Applications/MAMP/htdocs/tp6/app/admin/view/index/index.html";i:1604028452;s:61:"/Applications/MAMP/htdocs/tp6/app/admin/view/public/side.html";i:1604203174;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/base.css">
    <script src="/static/layui/layui.js"></script>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <a href='javascript:;' class="layui-logo" style="width:300px;">
                <span class='yingke_name'>后台</span>
            </a>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item userInfo_module">
                    <div class='user_name'><?php echo htmlentities($user['user_name']); ?>,您好</div>
                    <div class='user_tag'><?php echo htmlentities($user['user_nick']); ?>&nbsp;</div>
                </li>
                <a href="<?php echo url('index/logout'); ?>">
                    <li class="layui-btn layui-btn-radius layui-btn-primary logOut">退出</li>
                </a>
            </ul>
        </div>

        <div class="layui-side">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree yk_tree"  lay-shrink="all" lay-filter="test">
            <li class="layui-nav-item">
                <a href="javascript:;">用户管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="<?php echo url('admin/index'); ?>" target='right_content'>管理员</a></dd>
                    <dd><a href="<?php echo url('user/index'); ?>" target='right_content'>购买用户</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">商品管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="<?php echo url('goods/index'); ?>" target='right_content'>商品管理</a></dd>
                    <dd><a href="<?php echo url('goods/recode'); ?>" target='right_content'>商品二维码</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>

        <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="height:100%;margin-right: 12px;">
            <iframe src="<?php echo url('index/console'); ?>" frameborder="0" id='right_content' name='right_content'>
                您的浏览器不支持嵌入式框架，或者当前配置为不显示嵌入式框架。
            </iframe>
        </div>
    </div>
    <script type="text/javascript">
        layui.use('element', function(){
          var element = layui.element,$ = layui.jquery;

        });
    </script>
</div>
</body>
</html>