<?php /*a:1:{s:63:"/Applications/MAMP/htdocs/tp6/app/admin/view/index/console.html";i:1586787238;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 控制台主页一</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all">
    <script src="/static/layui/layui.js"></script>
    <style>
        .layui-btn-primary:hover {
            border-color: #fff;
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
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            <div class="layui-card">
                <div class="layui-card-header">服务器信息</div>
                <div class="layui-card-body layui-text">
                    <table class="layui-table">
                        <colgroup><col width="100"><col><col width="100"><col></colgroup>
                        <tbody>
                        <tr>
                            <td>操作系统</td>
                            <td><?php echo htmlentities(PHP_OS); ?></td>
                            <td>脚本引擎</td>
                            <td><?php echo request()->server('SERVER_SOFTWARE'); ?></td>
                        </tr>
                        <tr>
                            <td>PHP版本</td>
                            <td><?php echo htmlentities(PHP_VERSION); ?></td>
                            <td>CURL支持</td>
                            <td><?php $curl = @curl_version();echo $curl['version'] ? $curl['version'] : '<i class="layui-icon layui-icon-close" style="font-size: 22px; color: #FF5722;"></i>'; ?></td>
                        </tr>
                        <tr>
                            <td>安装目录</td>
                            <td><?php echo request()->server('DOCUMENT_ROOT'); ?></td>
                            <td>服务器</td>
                            <td><?php echo request()->server('HTTP_HOST'); ?></td>
                        </tr>
                        <tr>
                            <td>最大上传</td>
                            <td><?php echo get_cfg_var("file_uploads") ? get_cfg_var("upload_max_filesize") : '<i class="layui-icon layui-icon-close" style="font-size: 22px; color: #FF5722;"></i>';?></td>
                            <td>GD图形库</td>
                            <td><?php $gd = @gd_info(); echo $gd['GD Version'] ? $gd['GD Version'] : '<i class="layui-icon layui-icon-close" style="font-size: 22px; color: #FF5722;"></i>';?></td>
                        </tr>
                        <tr>
                            <td>脚本超时</td>
                            <td><?php $t = ini_get("max_execution_time"); echo $t;?>秒</td>
                            <td>mysql</td>
                            <td><?php echo think\facade\Db::query("select version() as v;")[0]['v']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">版本信息</div>
                <div class="layui-card-body layui-text">
                    <table class="layui-table">
                        <colgroup>
                            <col width="100">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>开发版本</td>
                            <td>
                                <?php echo env('JT_V'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>开发者</td>
                            <td>枫零落</td>
                        </tr>
                        <tr>
                            <td>ThinkPHP</td>
                            <td>
                                <?php echo think\App::VERSION; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Layui</td>
                            <td>
                                <script>
                                    document.write(layui.v)
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>主要特色</td>
                            <td>零门槛 / 响应式 / 清爽 / 极简</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div class="layui-card">
        <div class="layui-card-header">
            <div style="float: left">操作日志</div>
            <?php if(count($logs) > 0): ?>
            <div style="float: right">
                <button class="layui-btn layui-btn-radius btn-add layui-btn-sm" id="clear">清空日志</button>
            </div>
            <?php endif; ?>
        </div>
        <div class="layui-card-body layui-text">
            <table class="layui-table" lay-skin="line">
                <thead>
                <tr>
                    <th style="width: 50px;">编号</th>
                    <th style="width: 80px;">用户</th>
                    <th style="width: 60px">操作类型</th>
                    <th>详情</th>
                    <th style="width: 150px;">操作时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($logs) <= 0): ?>
                    <tr>
                        <td colspan="5" align="center">操作日志为空</td>
                    </tr>
                <?php else: foreach($logs as $l): ?>
                    <tr>
                        <td><?php echo htmlentities($l['id']); ?></td>
                        <td><?php echo htmlentities($l['name']); ?></td>
                        <td><?php echo htmlentities($l['type']); ?></td>
                        <td><?php echo htmlentities($l['content']); ?></td>
                        <td><?php echo htmlentities($l['create_t']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        layui.use(['element','table'], function() {
            var element = layui.element, $ = layui.jquery;
            $('#clear').click(function () {
                layer.confirm('您确定要清空日志吗？', function () {
                    $.get("<?php echo url('index/clear'); ?>", function (res) {
                        if (res.code === 0) {
                            layer.msg(res.msg);
                            window.location.href = "<?php echo url('index/console'); ?>";
                        } else {
                            layer.msg(res.msg)
                        }
                    });
                })
            });
        })
    </script>
</div>
</body>
</html>
