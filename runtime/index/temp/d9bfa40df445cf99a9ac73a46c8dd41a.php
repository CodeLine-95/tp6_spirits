<?php /*a:1:{s:61:"/Applications/MAMP/htdocs/tp6/app/index/view/index/index.html";i:1605020625;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>茅台酱酒</title>
    <link rel="stylesheet" href="/static/css/index.css">
</head>
<body>
    <header>
        <img src="/static/img/mtlogo.png" alt="贵州茅台集团" class="page-logo">
    </header>
    <div id="indexDiv">
        <article class="input_list boxlist">
            <a href="<?php echo url('index/index/search',['m'=>$get['m']]); ?>">
                <img src="/static/img/fwcx.png" alt="">
            </a>
            <a href="<?php echo htmlentities($get['domain']); ?>" target="_blank">
                <img src="/static/img/gw.png" alt="">
            </a>
            <a href="http://mp.weixin.qq.com/mp/profile_ext?action=home&amp;__biz=MjM5MjY0NjY4MA==#wechat_redirect" target="_blank">
                <img src="/static/img/wx.png" alt="">
            </a>
        </article>
    </div>

    <footer>
        <div class="tel">全国服务热线：400-622-9988</div>
        <div class="commpay">
            <h4>贵州茅台酒厂(集团)白金酒有限责任公司</h4>
            <p>KWEICHOW MOUTAI WINERY(GROUP)BATJIN LOQUOR CO.,LTD.</p>
        </div>
    </footer>
</body>
</html>