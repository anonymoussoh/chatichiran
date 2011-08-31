<?php
if((strpos($_SERVER["REMOTE_ADDR"],"61.27.73.")!==false)||(strpos($_SERVER["REMOTE_ADDR"],"118.110.199.")!==false)){
die("Hahaha You are idiot");
}
//To do or think
//最新発言だけログ残すか否か
//accessipどうにかしろよ
//割合バー

//パスワード設定
define("PASSWORD","notsecure");

//条件分岐
if($_POST){
 foreach($_POST as $key => $value){
  $post[$key] = htmlspecialchars($value,ENT_QUOTES,"UTF-8");
 }
 $html = new html();
 $utility = new Util();
 if($post['type']==="location"){
 $head = $html->head(1);
 $location = $utility->location($post['ipaddress']);
 $foot = $html->foot();
 }else if(($post['type']==="admin")&&($post['pass']===PASSWORD)){
  $head = $html->head(1);
  $admin = $utility->admin();
  $foot = $html->foot();
 }else if($post['type']==="edit"){
 $ua = htmlspecialchars($_POST['ua'],ENT_QUOTES,"UTF-8");
 $w_value = file_put_contents("ua.dat", $ua, LOCK_EX);
  if(($w_value!==false)||(empty($ua))){
  $head = $html->head(0);
  $body = $html->body();
  $unknown = $utility->unknownua();
  $foot = $html->foot();
  }else{
  die("Something went wrong!");
  }
 }else{
 $head = $html->head(0);
 $body = $html->body();
 $unknown = $utility->unknownua();
 $foot = $html->foot();
 }
}else{
$html = new html();
$utility = new Util();
$head = $html->head(0);
$body = $html->body();
$unknown = $utility->unknownua();
$foot = $html->foot();
}

class html{
 public $ip;

 function head($argument){
 if($argument){
  print <<<END
 <html lang="ja">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta http-equiv="Content-Style-Type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">
 <title>新チャット入室者一覧：GUI</title>
  <style type="text/css">
 body {
 font-family: 'Arial';}
 table,div,ul,p {
 font-size:0.85em;
 }
 form{
  display:inline;
 }
 table{
 background-color:silver;
 }
 td,th{
 background-color:white;
 
 }
 </style>
 </head>
  <body>
 <h1>新チャット入室者一覧：GUI</h1>
 <p><a href='http://81.la/m/index.html' target='_blank'>スーパー正男</a>｜<a href='http://81.la/cgi-bin/gekipawa/gekipawa.cgi' target='_blank'>劇空間ぱわふるリーグ２！</a>｜<a href='http://81.la/cgi-bin/chin/login.cgi' target='_blank'>珍走記一軍</a>｜<a href='http://81.la/cgi-bin/chin2/login.cgi' target='_blank'>二軍</a>｜<a href='http://81.la/cgi-bin/hako/hako-main.cgi' target='_blank'>箱庭諸島2</a>｜<a href='http://f27.aaa.livedoor.jp/~oshiberu/se/php/hako-main.php' target='_blank'>箱庭諸島S.E</a>｜<a href='http://81.la/cgi-bin/ra/hako-main.cgi' target='_blank'>箱庭諸島R.A.</a>｜<a href='http://81.la/cgi-bin/kaisen/hako-main.cgi' target='_blank'>箱庭諸島海戦</a>｜<a href='http://81.la/c/' target='_blank'>新チャット</a>｜<a href='http://81.la/shogiwiki/' target='_blank'>将棋Wiki</a>｜<a href='http://81.la/cgi-bin/up/' target='_blank'>アップローダー</a>｜<a href="http://81.la/~soh/chalogviewer/chalog.php" target="_blank">Chalog Viewer</a></p><hr>
END;
 
 }else{
 print <<<END
 <html lang="ja">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta http-equiv="Content-Style-Type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">
<!-- <meta http-equiv="refresh" content="30">-->
<!--やっつけ実装万歳-->
 <title>新チャット入室者一覧：GUI</title>
 <style type="text/css">
 body {
 font-family: 'Arial';}
 table,div,ul,p {
 font-size:0.85em;
 }
 form{
  display:inline;
 }
 table{
 background-color:silver;
 }
 td,th{
 background-color:white;
 
 }
 </style>
  <script type="text/javascript">
 var intsec = getCookie();
 if((intsec == "")||(intsec<=10)){
  intsec = 25;
 }
  setTimeout("location.reload()",1000*intsec);
 function getCookie(){
 tmp = document.cookie+";";
 index = tmp.indexOf("interval",0);
  if(index != -1){
   tmp = tmp.substring(index, tmp.length);
   index2 = tmp.indexOf("=",0)+1;
   index3 = tmp.indexOf(";",index2);
   return(unescape(tmp.substring(index2,index3)));
  }
  return("");
 }
 function setCookie(){
 if(document.relint.second.value>10){
 tmp = "interval="+document.relint.second.value+";";
 }else{
 tmp = "interval=10;";
 alert("短すぎるため10秒に設定されました");
 }
 today = new Date();
 time = today.getFullYear();
 time++;
//timeup = Math.ceil((today.getTime()+24*60*60*365*1000)/24*60*60*1000);
 tmp += "expires = "+new Date(time,1).toUTCString()+";";
 document.cookie = tmp;
 }
 function deleteCookie(){
  tmp = getCookie();
  if(tmp=""){
  alert("Cookie not found");
  }
  tmp = "interval=5;";
  today = new Date();
  time = today.getFullYear();
  time++;
  tmp += "expires = "+new Date(time).toUTCString()+";";
  document.cookie = tmp;
 }
 </script>
 </head>
 <body>
 <h1>新チャット入室者一覧：GUI</h1>
 <p><a href='http://81.la/m/index.html' target='_blank'>スーパー正男</a>｜<a href='http://81.la/cgi-bin/gekipawa/gekipawa.cgi' target='_blank'>劇空間ぱわふるリーグ２！</a>｜<a href='http://81.la/cgi-bin/chin/login.cgi' target='_blank'>珍走記一軍</a>｜<a href='http://81.la/cgi-bin/chin2/login.cgi' target='_blank'>二軍</a>｜<a href='http://81.la/cgi-bin/hako/hako-main.cgi' target='_blank'>箱庭諸島2</a>｜<a href='http://f27.aaa.livedoor.jp/~oshiberu/se/php/hako-main.php' target='_blank'>箱庭諸島S.E</a>｜<a href='http://81.la/cgi-bin/ra/hako-main.cgi' target='_blank'>箱庭諸島R.A.</a>｜<a href='http://81.la/cgi-bin/kaisen/hako-main.cgi' target='_blank'>箱庭諸島海戦</a>｜<a href='http://81.la/c/' target='_blank'>新チャット</a>｜<a href='http://81.la/shogiwiki/' target='_blank'>将棋Wiki</a>｜<a href='http://81.la/cgi-bin/up/' target='_blank'>アップローダー</a>｜<a href="http://81.la/~soh/chalogviewer/chalog.php" target="_blank">Chalog Viewer</a></p><hr>
END;
}


 }

 function foot(){

 echo "</body></html>";
 
 }
 
 function body(){
 $access_ip = getenv("REMOTE_ADDR");
 //注意
 $userlist = file_get_contents("http://a.81.la/c/chat.php?userlist=[]");
 $decoded_userlist = json_decode($userlist,true);
  if($decoded_userlist["error"]){
  die("Data Error");
  }
  echo "<table border='0' width='100%'>";
//セルの処理
 $cellwidth = 23;
 $namecellwidth = 100 - $cellwidth * 3;
 echo "<tr><th width='{$namecellwidth}%'>名前</th><th width='{$cellwidth}%'>IPアドレス</th>";
 echo "<th width='{$cellwidth}%'>OS/ブラウザ</th><th width='{$cellwidth}%'>入室状態</th></tr>";
  if(empty($decoded_userlist["newusers"])){
  echo "<tr><th colspan='4'>入室者なし</th></tr>";
  }else{
  $silency = 0;
   foreach ($decoded_userlist["newusers"] as $num => $line){
   $list[$num]['name'] = $line['name'];
   $list[$num]['useragent'] = htmlspecialchars($line['ua'],ENT_QUOTES,"UTF-8");
   //ここよりしたMHS用判定
   
    if(strpos($list[$num]['useragent'],"MobileHighChatSystem.PHP")!==false){
    preg_match("/\[ip\/([\d\.]+)\]/", $list[$num]['useragent'], $matchip);
    $list[$num]['ipa'][0] = long2ip($line['ip']);
    $list[$num]['ipa'][1] = $matchip[1];
    }else{
    //MHS/1.1 (MobileHighChatSystem.PHP) for JPhone [ip/111.86.141.211]
   //IPアドレスを通常形式に変換
   $list[$num]['ipa'] = long2ip($line['ip']);
   }
   //ブラウザ・OS判定・色の算出
   $evaluate = new evaluate($list[$num]['name'],$list[$num]['useragent'],$list[$num]['ipa']);
   $list[$num]['browser'] = $evaluate->browser();
   $list[$num]['os'] = $evaluate->os();
   list($list[$num]['r'],$list[$num]['g'],$list[$num]['b']) = $evaluate->color();
   //最新30発言内で発言があるかどうかを探す
   $n = 0;
   foreach($decoded_userlist["newcomments"] as $arr){
   //ここに芸がない
   //$arr['name']===$line['name']
    if($arr['ip']===$line['ip']){
     $matches[$num][$n] = $arr;
     $n++;
    }
   }
    if(empty($matches[$num])){
    $list[$num]['pace'] = 0;
    $list[$num]['diffminutes'] = "";
    $list[$num]['lastdate'] = "";
    $list[$num]['lastcomment'] = "";
    $list[$num]['match'] = "if";
    $silency++;
    }else{
    $num_match = count($matches[$num]);
    $lastcomment = end($matches[$num]);
     if($lastcomment['name']==="<span class='in'>■入室通知</span>"){
      if($num_match==1){
      $list[$num]['pace'] = 3;
      $list[$num]['lastdate'] = date("H:i:s", $lastcomment['date']);
      $list[$num]['lastcomment'] = "";
      $jst = time();
      $diff = $jst - $lastcomment['date'];
      $list[$num]['diffminutes'] = intval($diff/60);
      $silency++;
      }else{
      $lastcomment = prev($matches[$num]);
       while(1){
        if(($lastcomment['name']==="<span class='in'>■入室通知</span>")||($lastcomment['name']==="<span class='out'>■退室通知</span>")||($lastcomment['name']==="<span class='out'>■失踪通知</span>")){
        $lastcomment = prev($matches[$num]);
        }else if($lastcomment===false){
        $list[$num]['pace'] = 0;
        $list[$num]['diffminutes'] = "";
        $list[$num]['lastdate'] = "";
        $list[$num]['lastcomment'] = "";
        $list[$num]['match'] = "while";
        $silency++;
        break;
        }else{
        $jst = time();
        $diff = $jst - $lastcomment['date'];
        //20分の境目
         if($diff>=20*60){
         //$list[$num]['pace'] = "Inactive";
         $list[$num]['pace'] = 2;
         $silency++;
         }else{
         //$list[$num]['pace'] = "<b>Active</b>";
         $list[$num]['pace'] = 1;
         }
        $list[$num]['diffminutes'] = intval($diff/60);
        $list[$num]['lastdate'] = date("H:i:s", $lastcomment['date']);
        $thanpos = strpos($lastcomment['comment'],'<span class="small">(forwarded for:');
        if($thanpos!==false){
        $lastcomment['comment'] = substr($lastcomment['comment'],0,$thanpos);
        }
        $list[$num]['lastcomment'] = mb_strimwidth($lastcomment['comment'],0,30,"...","UTF-8");
        break;
        }
       }
      }
     }else{
     $jst = time();
     $diff = $jst - $lastcomment['date'];
     //20分の境目
      if($diff>=20*60){
      //$list[$num]['pace'] = "Inactive";
      $list[$num]['pace'] = 2;
      $silency++;
      }else{
      //$list[$num]['pace'] = "<b>Active</b>";
      $list[$num]['pace'] = 1;
      }
     $list[$num]['diffminutes'] = intval($diff/60);
     $list[$num]['lastdate'] = date("H:i:s", $lastcomment['date']);
     $thanpos = strpos($lastcomment['comment'],'<span class="small">(forwarded for:');
     if($thanpos!==false){
     $lastcomment['comment'] = substr($lastcomment['comment'],0,$thanpos);
     }
     $list[$num]['lastcomment'] = mb_strimwidth($lastcomment['comment'],0,30,"...","UTF-8");
     }
    }
   }
  }
  if(!empty($decoded_userlist['userlist'])){
   if($silency==($num+1)){
   echo "<span style='position:absolute;top:200px;left:600px;font-size:90px;color:red;'>静まり返った</span>";
   }
  //ここより上処理部分
  //ここより下表示部分
  $serverip = gethostbyname("a.81.la");
  foreach($list as $user){

  if(($access_ip===$user['ipa'])||($access_ip===$user['ipa'][1])){
  echo "<tr><th><span style='color:rgb(".$user['r'].",".$user['g'].",".$user['b'],")'><big>".htmlspecialchars($user['name'],ENT_QUOTES,"UTF-8")."</big></span>";
  }else{
  echo "<tr><th><span style='color:rgb(".$user['r'].",".$user['g'].",".$user['b'],")'>".htmlspecialchars($user['name'],ENT_QUOTES,"UTF-8")."</span>";
  }
  echo "</th>";
  
  if(is_array($user['ipa'])&&(preg_match("/MHS\/([\d\.]+)/",$user['browser']))){
  echo "<th>".$user['ipa'][0]."<br>(".$user['ipa'][1].")";
  echo "<form action='chatichiran.php' method='post' style='display:inline;'><input type='hidden' name='type' value='location'><input type='hidden' name='ipaddress' value=".$user['ipa'][1]."><input type='submit' value='調査'></form>";
  }else{
  echo "<th>".$user['ipa'];
  echo "<form action='chatichiran.php' method='post' style='display:inline;'><input type='hidden' name='type' value='location'><input type='hidden' name='ipaddress' value=".$user['ipa']."><input type='submit' value='調査'></form>";
  }
//  var_dump($user['ipa']);
  /*
   if(strpos($user['ipa'],"64.255.180.")===false){
   */

   /*
   }else{
   echo "(proxy)";
   }
  */
  echo "</th>";
  echo "<th title='".$user['useragent']."'>".$user['os']."<br>".$user['browser']."</th>";
  echo "<td align='center'>";
   if(empty($user['pace'])){
   echo "<b>発言なし</b>";
   }else{
    if($user['pace']===2){
    echo $user['lastdate']."（".$user['diffminutes']."分前）に発言<br>".$user['lastcomment'];
    }else if($user['pace']===3){
    echo "発言なし<br>".$user['lastdate']."（".$user['diffminutes']."分前）に入室";
    }else{
    echo "<strong>".$user['lastdate']."</strong>(最終発言：<strong>".$user['diffminutes']."</strong>分前)<br>".$user['lastcomment'];
    }
   }
  echo "</td>";
  echo "</tr>\n";
  }
  }
  
  
  //ROM部分
  if(!empty($decoded_userlist['romlist'])){
   foreach($decoded_userlist['romlist'] as $romuser){
   $romip = long2ip($romuser['ip']);
   $romuser['ua'] = htmlspecialchars($romuser['ua'],ENT_QUOTES,"UTF-8");
    if($romip===$serverip){
    continue;
    }else{
   $evaluate = new evaluate("(ROM)",$romuser['ua'],$romip);
   $romuser['browser'] = $evaluate->browser();
   $romuser['os'] = $evaluate->os();
   list($romuser['r'],$romuser['g'],$romuser['b']) = $evaluate->color();
   echo "<tr><th><span style='color:rgb({$romuser['r']},{$romuser['g']},{$romuser['b']})'>(ROM)</span></th>";
   echo "<th>".$romip;
    if(strpos($romip,"64.255.180.")===false){
    echo "<form action='chatichiran.php' method='post' style='display:inline;'><input type='hidden' name='type' value='location'><input type='hidden' name='ipaddress' value=".$romip."><input type='submit' value='調査'></form>";
    }else{
    echo "(proxy)";
    }
   echo "</th>";
   echo "<th title='{$romuser['ua']}'>{$romuser['os']}<br>{$romuser['browser']}</th><td>&nbsp;</td></tr>\n";
   }
   }
  }
 echo "</table>";
 echo "リロード間隔設定（10秒未満は10秒に設定）<form name='relint'>";
 echo "<input type='text' size='10' value='' name='second'>";
 echo "<input type='submit' value='変更' onClick='setCookie()'>";
 echo "<input type='submit' value='設定破棄' onClick='deleteCookie()'>";
 echo "</form>";
 echo "<ul>";
 echo "<li>IPアドレスの調査ボタンでその人の所在県名がわかる。（不明になることもある、proxyされるとわからなくなる、ときおり不正確だったりする）</li>";
 echo "<li>更新間隔は25秒、ActiveとInactiveの境は20分</li>";
 echo "<li>UserAgentは偽装可能であるためブラウザおよびOSは目安</li>";
 echo "<li>「OS/ブラウザ」のセルにオンマウスするとUA全体を表示（title属性）</li>";
 echo "<li>IPアドレス→県名は<a href='http://www.geotargeting.jp/'>geotargeting</a>様のサービスを利用しています。THANK YOU geotargeting!</li>";
 echo "<li>入室状況は最新30発言の状態を表示</li>";
 echo "</ul>";
 echo "<form action='chatichiran.php' method='post'>";
 echo "<input type='hidden' name='type' value='admin'>";
 echo "<input type='password' name='pass' value='' size='12'>";
 echo "<input type='submit' value='管理'>";
 echo "</form>";
 echo "<hr>";
 }
}
class Util{

 function location($ip){
 $returnresult = file_get_contents("http://www1.geotg.jp/sample.geo?ip=".$ip."&id=sample&pw=test&format=json");
 $result = json_decode($returnresult,true);
 echo $ip;
 echo "<br>";
 $prefecture = array("不明","北海道","青森","岩手","宮城","秋田","山形","福島","茨城","栃木","群馬","埼玉","千葉","東京","神奈川","新潟","富山","石川","福井","山梨","長野","岐阜","静岡","愛知","三重","滋賀","京都","大阪","兵庫","奈良","和歌山","鳥取","島根","岡山","広島","山口","徳島","香川","愛媛","高知","福岡","佐賀","長崎","熊本","大分","宮崎","鹿児島","沖縄");
 echo $prefecture[$result['region']];
 echo "<hr>Served by <a href='http://www.geotargeting.jp/'>geotargeting</a>.<br>";
 echo "<a href='chatichiran.php'>戻る</a>";
 }
 
 
 function unknownua(){
 $unknown = file("ua.dat");
 echo "<h2>Unknown UAs</h2>";
 echo "<div>";
 if(!empty($unknown)){
  foreach($unknown as $value){
  echo $value;
  echo "<br>";
  }
 }
 echo "</div>";
 
 }
 
 function admin(){
 $unknown = file_get_contents("ua.dat");
 echo "<form action='chatichiran.php' method='post'>";
 echo "<input type='hidden' name='type' value='edit'>";
 echo "<textarea name='ua' rows='25' cols='200'>".$unknown."</textarea><br>";
 echo "<input type='submit' value='更新'>";
 
 }
}

class evaluate{
 private $useragent;
 private $os;
 private $browser;
 private $ip;
 private $name;
 function __construct($name,$useragent,$ip){
   $this->useragent = $useragent;
   $this->ip = $ip;
   $this->name = $name;
 }
 function browser(){
    if(empty($this->useragent)){
    $this->browser = "Nothing";
    }else if(preg_match("/Chrome\/([\d\.]+)/", $this->useragent, $matchchrome)){
    $this->browser = $matchchrome[0];
    //Google Chrome
    }else if(preg_match("/MSIE ([\d\.]+)/", $this->useragent, $matchsea)){
    $this->browser = "Internet Explorer ".$matchsea[1];
    }else if(strpos($this->useragent,"Lunascape")!==false){
    $this->browser = "Lunascape";
     if(preg_match("/(Webkit|Gecko)/",$this->useragent,$match)){
     $this->browser .= " (".$match[0].")";
     }else{
     $this->browser .= "(Trident?)";
     }
    }else if(preg_match("/SeaMonkey\/([\d\.]+)/", $this->useragent, $matchsea)){
    $this->browser = $matchsea[0];
    //SeaMonkey
    }else if(preg_match("/Firefox\/([\w\.]+)/", $this->useragent, $matchfox)){
    $this->browser = $matchfox[0];
    //Mozilla Firefox
    }else if(preg_match("/Opera (Mini|Mobi)\/([\d\.]+)/",$this->useragent,$matchoperam)){
    $this->browser = $matchoperam[0];
    }else if(strpos($this->useragent,"Opera")!==false){
    $this->browser = "Opera";
     if(preg_match("/Version\/([\d\.]+)/", $this->useragent, $matchopera)){
     $this->browser .= " ".$matchopera[1];
     }
     if(strpos($this->ip,"64.255.180.")!==false){
     $this->browser .= "(Opera Turbo)";
     }
    }else if(strpos($this->useragent,"Safari")!==false){
     if(strpos($this->useragent,"Mobile Safari")!==false){
     $this->browser = "Webkit Mobile";
     }else{
     $this->browser = "Safari";
     }
    }else if(preg_match("/TextEdicha\/([\d\.]+)/", $this->useragent, $matchtec)){
    $this->browser = "<a href='http://soft.mamesoft.jp/textedicha/'>".$matchtec[0]."</a>";
    //TextEdicha
    }else if(strpos($this->useragent,"Mamesoft")!==false){
    $this->browser = "Mamesoft Web Basic";
    }else if(preg_match("/Sayaka\(tentative\)\/([\d\.]+)/", $this->useragent, $matchsayaka)){
    $this->browser = "<a href='http://m06t625.81.la/soft/sayaka/'>".$matchsayaka[0]."</a>";
    //Sayaka(tentative)
    }else if(preg_match("/81chat_([\d\.]+)/", $this->useragent, $matchabc)){
    $this->browser = $matchabc[0];
    //81chat
    }else if(preg_match("/MHS\/([\d\.]+)/", $this->useragent, $matchmhs)){
    $this->browser = $matchmhs[0];
    //MHS/1.1 (MobileHighChatSystem.PHP) for JPhone [ip/111.86.141.211]
    }else if(strpos($this->useragent,"Nintendo 3DS")!==false){
    $this->browser = "NetFront";
    }else{
    $this->browser = "Unknown";
    $targetbrowser = file_get_contents("ua.dat");
    $resultbrowser = strpos($targetbrowser,$this->useragent);
     if($resultbrowser === false){
     $time = time();
     $appendline = "BROWSER:".$this->name."<>".$this->useragent."<>".$this->ip."<>".$time."\n";
     file_put_contents("ua.dat", $appendline, FILE_APPEND|LOCK_EX);
     }
    }
  return $this->browser;
 }
 
 function os(){
    if(empty($this->useragent)){
    $this->os = "Nothing";
    }else if(strpos($this->useragent,"Windows")!==false){
     if(strpos($this->useragent,"NT 6.1")!==false){
     $this->os = "Windows 7";
     }else if (strpos($this->useragent,"NT 6.0")!==false){
     $this->os = "Windows Vista";
     }else if (strpos($this->useragent,"NT 5.1")!==false){
     $this->os = "Windows XP";
     }else{
     $this->os = "Windows";
     }
    }else if(strpos($this->useragent,"Macintosh")!==false){
    $this->os = "Mac";
    }else if(strpos($this->useragent,"Android")!==false){
    $this->os = "Android";
    }else if(strpos($this->useragent,"Linux")!==false){
    $this->os = "Linux";
    }else if(strpos($this->useragent,"iPod")!==false){
    $this->os = "iPod";
    }else if(strpos($this->useragent,"iPad")!==false){
    $this->os = "iPad";
    }else if((strpos($this->useragent,"J2ME/MIDP")!==false)||(strpos($this->useragent,"iPhone")!==false)){
    $this->os = "iPhone";
    }else if(strpos($this->useragent,"Python")!==false){
    $this->os = "Python";
    }else if(preg_match("/PlayStation/i", $this->useragent)){
    $this->os = "PlayStation";
    }else if(strpos($this->useragent,"(MobileHighChatSystem.PHP) for JPhone")!==false){
    $this->os = "smartphone???";
    //MHS/1.1 (MobileHighChatSystem.PHP) for JPhone [ip/111.86.141.211]
    }else if(preg_match("/Nintendo \w+/", $this->useragent,$matchnintendo)){
    $this->os = $matchnintendo[0];
    }else{
    $this->os = "Unknown";
    $targetos = file_get_contents("ua.dat");
    $resultos = strpos($targetos,$this->useragent);
     if($resultos === false){
     $time = time();
     $appendline = "OS:".$this->name."<>".$this->useragent."<>".$this->ip."<>".$time."\n";
     file_put_contents("ua.dat", $appendline, FILE_APPEND|LOCK_EX);
     }
    }
   return $this->os;
 }

 function color(){
 if(is_array($this->ip)){
 $this->ip = $this->ip[0];
 }
  $color = explode(".", $this->ip);
  $r = intval($color[0] / 1.33);
  $g = intval($color[1] / 1.33);
  $b = intval($color[2] / 1.33);
  return array($r,$g,$b);
 }

}