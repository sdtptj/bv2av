<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="keywords" content="哔哩哔哩,bv,av号,bilibili,DrBlack,DrBlackの锦里">
    <meta name="description" content="BV转AV">
    <title>BV号转AV号 - DrBlack</title>
    <link href="./css.css" rel="stylesheet" type="text/css">
    <link href="./css2.css" rel="stylesheet" type="text/css">
    <link href="./css/flat-ui.css" rel="stylesheet">
    <link href="./css/demo.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="https://www.bootcss.com/p/buttons/css/buttons.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <title>BV转AV - DrBlack</title>
    <style>
        html,
        body {
            height: 100%;
        }
        
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }
        
        .container {
            text-align: center;
            display: block;
            position: relative;
            top: 150px;
            vertical-align: middle;
        }
        
        .content {
            text-align: center;
            display: inline-block;
        }
        
        .title {
            font-size: 66px;
        }
        
        .title small {
            font-size: 33px;
        }
        
        .title a {
            color: #000;
            text-decoration: none;
        }
        
        goo {
            display: block;
            position: fixed;
            top: 250px;
        }
        goog{
            display: block;
            position: fixed;
            bottom:0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="title">BV号转AV号<small> - <a target="_blank" href="https://github.com/Blokura/bv2av">代码引用</a> - <a target="_blank" href="https://www.drblack-system.com">DrBlackの锦里</a></small></div>
        </div>
        <h3 class="demo-panel-title">请在下方输入视频BV号</h3>
        <div class="row"></div>
            <div class="for-group">
                <div class="goo">
                    <form>
                    <input type="text" name="BV" placeholder="输入需要转换的BV号" class="form-control" />
                    <br>
                    </br>
                    <button class = "button center button button-glow button-border button-rounded button-primary" id="submit-query">转换</button>
                    </form>
                </div>
            </div>
        <?php
		if (isset($_GET['BV'])){  
			$str = trim($_GET['BV']);  //清理空格  
			$str = strip_tags($str);   //过滤html标签  
			$str = htmlspecialchars($str);   //将字符内容转化为html实体  
			$str = addslashes($str);  //防止SQL注入
		}  
		if($str != ""){
			$bv = stristr($str,"BV1");
			$bv = substr($bv,0,12);
			if(strlen($str) != 12){
				if(strlen($str) == 9){
					echo dec('BV1'.$str);
				}elseif(strlen($str) == 10){
					echo dec('BV'.$str);
				}else{
					echo "<font size='4' color='red'>".$str."←错误信息 哼唧，怎么能输入错误的BV号捏((٩(//̀Д/́/)۶))</font>";
				}
			}else{
				echo dec($bv);
			}
		}
		?>
</body>
<phppp>
<?php
//源代码来自Github Blokura/bv2av
//此代码为fork贡献修改，修改者Dr_Black
//转载代码请fork原版仓库，并在自己的版本中标注修改者以及原作者，顺便star一下吧2333
function dec($x){
	$table = 'fZodR9XQDSUm21yCkr6zBqiveYah8bt4xsWpHnJE7jL5VG3guMTKNPAwcF';
	$tr = array();
	for ($i=0;$i<58;$i++) {
		$tr[$table[$i]]=$i;
	}
	$s = array(11,10,3,8,4,6,2,9,5,7);
	$xor=177451812;
	$add=100618342136696320;
	//
	$r = 0;
	for ($i=0;$i<10;$i++) {
		$r += $tr[$x[$s[$i]]]*pow(58,$i);
	}
	$numbe = $r-$add^$xor;
	if($numbe <=0 )return "<font size='5' color='red'>".$numbe." 哼唧，怎么能输入错误的BV号捏((٩(//̀Д/́/)۶))</font>";
	if($numbe > 10000000000)return "<font size='5' color='red'>".$numbe." 查询的不是一个正确的BV号((٩(//̀Д/́/)۶))</font>";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.bilibili.com/x/web-interface/view/detail?bvid='.$x);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$output = curl_exec($ch);
	$json = json_decode($output);
	curl_close($ch);
	if(is_numeric($json->data->View->aid)){
		return $x."<br><font size='4'>看，我帮你找到啦ヾ(*´▽‘*)<br><font size=''>↓↓↓↓↓↓</br><font size='6' color='red'>av".$numbe."</font><br/><br/><a href='https://www.bilibili.com/video/av".$json->data->View->aid."' target='_blank'><img src='".str_replace("http://","https://",$json->data->View->pic)."' width='192' height='118'></a><br/>".$json->data->View->title."<br/>UP主:<a href='https://space.bilibili.com/".$json->data->View->owner->mid."' target='_blank'>".$json->data->View->owner->name."";
	}else{
        //return $x.'<br/><font size="5">看，我帮你找到啦ヾ(*´▽‘*)ﾉ<br>↓↓↓↓↓↓</br>
        //<br><font size="5" font color="red"><b>av'.$numbe."</b></font><b>";
        return $x.'<br/><font size="5">看，我帮你找到啦ヾ(*´▽‘*)ﾉ<br>↓↓↓↓↓↓</br>
        <br><font size="5" font color="red">av'.$numbe.'<br><br><a target="_blank" class="button button-3d button-primary button-rounded" href=https://www.bilibili.com/video/av'.$numbe.">点击跳转</a></b></font>";
	}
}
?>
</phppp>
<div class = "goog">
    <br>
    <br>
    <br>
	<p><a href="https://www.drblack-system.com/index.php/bv2av/">关于</a></p>
      <p>DrBlackの锦里 -  <span>胸に刻まれる あなたとの日々よ</span></p>
      <p> 2020 Copyrights - All Rights Reserved 粤ICP备18107693号</p>
</div>