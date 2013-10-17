<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="ru" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	
	<title>TEST</title>
	<script src="http://localhost:8080/socket.io/socket.io.js"></script>

</head>
<body>
<div id="test_1"></div>

<input type="text" id="text" />
<a href="#" id="a">go</a>
<div id="test_2"></div>


 <div id="log"></div>
        <input type="text" id="input" autofocus><input type="submit" id="send" value="Send">



<script>
            // да я понял, но верстку то мы еще кстати тоже не копирнули
            // Создаем текст сообщений для событий
            strings = {
                'connected': '[sys][time]%time%[/time]: Вы успешно соединились к сервером как [user]%name%[/user].[/sys]',
                'userJoined': '[sys][time]%time%[/time]: Пользователь [user]%name%[/user] присоединился к чату.[/sys]',
                'messageSent': '[out][time]%time%[/time]: [user]%name%[/user]: %text%[/out]',
                'messageReceived': '[in][time]%time%[/time]: [user]%name%[/user]: %text%[/in]',
                'userSplit': '[sys][time]%time%[/time]: Пользователь [user]%name%[/user] покинул чат.[/sys]'
            };
        
             // Создаем соединение с сервером; websockets почему-то в Хроме не работают, используем xhr
            if (navigator.userAgent.toLowerCase().indexOf('chrome') != -1) {
                socket = io.connect('http://localhost:8080', {'transports': ['xhr-polling']});
            } else {
                socket = io.connect('http://localhost:8080');
            }
            socket.on('connect', function () {
                socket.on('message', function (msg) {
                    // Добавляем в лог сообщение, заменив время, имя и текст на полученные
                    document.querySelector('#log').innerHTML += strings[msg.event].replace(/\[([a-z]+)\]/g, '<span class="$1">').replace(/\[\/[a-z]+\]/g, '</span>').replace(/\%time\%/, msg.time).replace(/\%name\%/, msg.name).replace(/\%text\%/, unescape(msg.text).replace('<', '&lt;').replace('>', '&gt;')) + '<br>';
                    // Прокручиваем лог в конец
                    document.querySelector('#log').scrollTop = document.querySelector('#log').scrollHeight;
                });
                // При нажатии <Enter> или кнопки отправляем текст
                document.querySelector('#input').onkeypress = function(e) {
                    if (e.which == '13') {
                        // Отправляем содержимое input'а, закодированное в escape-последовательность
                        socket.send(escape(document.querySelector('#input').value));
                        // Очищаем input
                        document.querySelector('#input').value = '';
                    }
                };
                document.querySelector('#send').onclick = function() {
                    socket.send(escape(document.querySelector('#input').value));
                    document.querySelector('#input').value = '';
                };		
            });
        
        </script>

</body>
</html>