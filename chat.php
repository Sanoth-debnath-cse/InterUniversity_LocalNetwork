<html>
<head>
    <title>Chat Bot</title>
    <link rel='stylesheet' href='../botmanager/themes/font.css'>
    <link rel="stylesheet" href="../botmanager/themes/newbound.min.css" />
    <link rel="stylesheet" href="../botmanager/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="../botmanager/jquerymobile_1_4_2/jquery.mobile.structure-1.4.2.min.css" />
    <script src="../botmanager/jquerymobile/jquery-1.9.1.min.js"></script>
    <script src="../botmanager/jquerymobile_1_4_2/jquery.mobile-1.4.2.min.js"></script>
    <script src="../botmanager/nav.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../peerbot/connections.css" />
    <script src="../peerbot/connections.js"></script>
</head>
<body>
<div id='botcontrols' data-role='page'>
    <div data-role="header">
        <h1 id="headertitle">Chat Bot</h1>
        <a href="../botmanager/index.html" data-icon="gear" data-ajax="false"></a>
    </div>
    <center>
        <div id='peerlist'></div>
        <div id='peermsg'></div>
    </center>
    <div id='displaychat'></div>
    <textarea id='entertext'></textarea>
    <input type='button' value='send' onclick='sendText();'>
</div>

<script type='text/javascript'>

    function sendText(){
        var t = $('#entertext').val();
        document.getElementById('displaychat').connection.send(t);
        $('#displaychat').append('Me:<br>'+t+'<br><br>');
        $('#entertext').val('');
    }

    function openWebsocket(){
        var url = document.URL;
        url = url.substring(url.indexOf(':'));
        url = 'ws'+url;
        var connection = new WebSocket(url, ['newbound']);

        connection.onopen = function(){
            connection.send('subscribe chat');
        };

        connection.onerror = function(error){
            console.log('Websocket error: '+error);
        };

        connection.onmessage = function(e){
            var o = JSON.parse(e.data);
            var peer = o.peer;
            var text = o.data;
            $('#displaychat').append(peer+':<br>'+text+'<br><br>');
        };

        document.getElementById('displaychat').connection = connection;
    }

    $(document).on('pagecreate', function(){
        buildConnectionBar('peerlist', openWebsocket);
    });

</script>

</body>
</html>