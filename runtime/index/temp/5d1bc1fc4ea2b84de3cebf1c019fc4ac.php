<?php /*a:1:{s:62:"/Applications/MAMP/htdocs/tp6/app/index/view/index/result.html";i:1605023249;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>茅台酱酒防伪查询</title>
    <link rel="stylesheet" href="/static/css/index.css">
</head>
<body>
    <header>
        <img src="/static/img/mtlogo.png" alt="贵州茅台集团" class="page-logo">
    </header>
    <form action="<?php echo url('index/index/result',['code'=>$get['code'],'tel'=>$get['tel']]); ?>" method="post" style="margin-bottom: 100px;">
        <div id="codeDiv">
            <article class="input_list boxlist">
                <?php if($get['result_two'] != ''): ?>
                    <h1 id="resulth1" class="colorlist" style=" width:80%; text-align:center; margin-left:40px;"><?php echo htmlentities($get['result_two']); ?></h1>
                <?php else: ?>
                    <h1 id="txtcode" class="colorlist"><?php echo htmlentities($get['code']); ?></h1>
                    <input type="submit" value="查询防伪" id="determine" class="WhiteButton">
                <?php endif; ?>
            </article>
        </div>
    </form>
    <footer>
        <div class="tel">全国服务热线：400-622-9988</div>
        <div class="commpay">
            <h4>贵州茅台酒厂(集团)白金酒有限责任公司</h4>
            <p>KWEICHOW MOUTAI WINERY(GROUP)BATJIN LOQUOR CO.,LTD.</p>
        </div>
    </footer>
</body>
</html>