<?php /*a:1:{s:62:"/Applications/MAMP/htdocs/tp6/app/index/view/index/search.html";i:1605022309;}*/ ?>
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
    <form action="<?php echo url('index/index/search',['m'=>$get['m'],'tel'=>$get['tel']]); ?>" method="post" style="margin-bottom: 100px;">
        <div>
            <?php echo token_field('__token__', 'sha1'); ?>
            <input type="hidden" name="code" value="<?php echo htmlentities($get['m']); ?>">
            <article class="input_list boxlist">
                <h2 class="colorlist">请输入您的手机号:</h2>
                <p><input name="tel" type="text" value="<?php echo htmlentities($get['tel']); ?>" id="inputbox" placeholder="" maxlength="11"></p>
                <input type="submit" value="确定" id="determine" class="WhiteButton">
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