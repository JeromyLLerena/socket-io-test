@extends('layouts.master')

@section('content')
    <ul id="messages"></ul>
    <label class="chat-info"></label>
    <form action="">

      <input id="m" autocomplete="off" /><button>Send</button>
      {!! csrf_field() !!}
    </form>
@stop

@section('footer')
    <script src="{{ asset('js/socket.io.js') }}"></script>
    <script>
        //var socket = io('http://localhost:3000');
        var socket = io('http://socket-io-test.app:3000');
        $('button').click(function(){
            var msg_string = $('#m').val();
            $('#m').val('');
            console.log(msg_string);
            $.ajax({
                url : "send",
                type: "POST",
                data : {message: msg_string},
            });
            return false;
        });

        socket.on("chat-channel:App\\Events\\NewMessage", function(msg){

            console.log(msg);
        var strong = $('<strong>');
        var data = msg.data;
        var li = $('<li>'+ data.message + '</li>');
        var row = $;
        //var row = $('<li> <strong>' + msg[0] + ': </strong>' + msg[1] + ' </li>');
        if (socket.id != msg[0]) {
          strong.html(li);
          row = strong;
        } else {
          row = li;
        }

        $('#messages').append(row);
            // increase the power everytime we load test route
            //$('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });

    </script>

<!--
    <script>
      var socket = io();
      $('#m').keypress(function(){
        if ($('.chat-info').text() == '') {
          socket.emit('writing', socket.id);
        }
      });

      $('form').submit(function(){
        socket.emit('message', [socket.id, $('#m').val()]);
        $('#m').val('');
        return false;
      });

      socket.on('chat message', function(msg){
        var strong = $('<strong>');
        var li = $('<li>'+ msg[0] + ': ' + msg[1] + '</li>');
        var row = $;
        //var row = $('<li> <strong>' + msg[0] + ': </strong>' + msg[1] + ' </li>');
        if (socket.id != msg[0]) {
          strong.html(li);
          row = strong;
        } else {
          row = li;
        }

        $('#messages').append(row);
      });
      socket.on('writing', function(info){
        if ($('.chat-info').text() == '') {
          $('.chat-info').text(info);
        }
        //$('.chat-info').text();
        setTimeout(function(){
          if ($('.chat-info').text().length > 0) {
            $('.chat-info').text('');
          }
        }, 2000);
      });

    </script>
    -->
@stop