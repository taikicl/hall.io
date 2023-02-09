<?php
    define("CHAT", "message_data.txt");
    date_default_timezone_set('Asia/Tokyo');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
    $text = $_POST['password'] . "," . $_POST['name'] . "," . $_POST['message'] . "," . date('m月d日 H時i分') . "\n";
        file_put_contents(CHAT, $text, FILE_APPEND);
    }

?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall掲示板-Beta</title>
    <link rel="icon" type="image/jpg" href="h.jpg">
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .wrap{
            width: 600px;
            margin: 0 auto;
            padding: 20px 0 100px 0;
            background: #f1f1f2;
            min-height: 100vh;
        }
        li{
            position: relative;
            padding: 10px 20px;
            margin: 0 10px 10px 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        span{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            font-size: 12px;
            color: #ccc;
        }
        .name{
            font-weight: bold;
            color: black;
            display: inline;
        }
        .title{
            position: fixed;
            top: 10%;
            left: 5vw;
        }
        .rule{
            position: fixed;
            top: 50%;
            left: 75vw;
        }
        textarea{
            resize: none;
            width: 250px;
            height: 150px;
        }
        form{
            position: fixed;
            top: 50%;
            left: 5vw;
        }
        button{
            width: 10em;
            height: 3em;
        }
        .kanrisya{
            display: inline;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <ul>

        </ul>
    </div>

    <div class="title">
        <h1>Hallの掲示板へようこそ</h1>
        <p>この掲示板サイトはまだ試作中の掲示板です。</p>
        <p>不具合やバグに関しては作成者である</p>
        <p><b>lris#5259</b>へ報告ください。</p>
        <p>可能な限り直しまぁす！！</p>
    </div>

    <div class="rule">
        <h2>&lt;掲示板のルール&gt;</h2>
        <p>・人の嫌がるような発言はしない</p>
        <p>・暴言、虚言を吐かない</p>
        <p>・荒らしやスパムなどをしない</p>
    </div>

    <div class="login">

    </div>

    <form action="index.php" method="post">
        <label>名前: <input type="text" name="name" size="20" id="play" placeholder="名前" autocomplete="on"></label>
        <br>
        <label>PASS: <input type="password" name="password" size="20" placeholder="Password"></label>
        <br>
        <label>内容: <textarea name="message" placeholder="内容をここに記入"></textarea></label>
        <br>
        <button type="submit" id="button" disabled>送信</button>
        <script>
            let element = document.getElementById('play');
            let button = document.getElementById('button');

            play.addEventListener('keyup', function() {
                let text = element.value;
                if(text){
                    button.disabled = null;
                }else{
                    button.disabled = "disabled";
                }
            })
        </script>
        

    </form>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script>
        $(function(){
            $.ajax({
                url: 'message_data.txt',
            })
            .done(function(data) {
                data.split('\n').forEach(function(chat){
                    const post_password = chat.split(',')[0];
                    const post_name = chat.split(',')[1];
                    const post_text = chat.split(',')[2];
                    const post_time = chat.split(',')[3];
                    // 文字があったら表示
                    
                    if(post_text){
                        if(post_password == "2525"){
                            const li = `<img src="kanrisya.jpg" class="kanrisya" alt="&lt;管理者&gt;" width="30" height="22"><p class="name">${post_name}</p><li>${post_text}<span>${post_time}</span></li>`;
                            $('ul').append(li);
                        }else{
                            const li = `<p class="name">${post_name}</p><li>${post_text}<span>${post_time}</span></li>`;
                            $('ul').append(li);
                        }
                    }
                });  
            });
        });
    </script>
</body>
</html>
