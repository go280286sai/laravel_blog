<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
</head>
<link rel="stylesheet" href="/assets/css/chat.css">
<body>
<h1>Pusher Test</h1>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-4">

                <div class="box box-warning direct-chat direct-chat-warning" id="app">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chat Messages</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title=""
                                    data-widget="chat-pane-toggle" data-original-title="Contacts">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">

                        <div class="direct-chat-messages">
                                <div  v-for="message in messages" v-html="message">
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <form action="/admin/chat_send" method="post" id="formMessage">
                            @csrf
                            <div class="input-group">
                                <input id="msg_send" type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <input type="hidden" name="avatar" value="{{\Illuminate\Support\Facades\Auth::user()->getAvatar()}}">
                                <input type="hidden" name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                                <input type="hidden" name="date" value="{{date('d M H:i a')}}">
                                <span class="input-group-btn">
                                    <button name="send" @click="sending"
                                            class="btn-warning btn-flat">{{__('admin.send')}}</button>
                          </span>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery-1.11.3.min.js'}}"></script>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    const pusher = new Pusher('1b896f3ab917cb558ce6', {
        cluster: 'eu'
    });

    const channel = pusher.subscribe('chat');
    channel.bind('my-event', function (data) {

        app.messages.push( `
        <div class="direct-chat-info clearfix">
                                    <span
                                        class="direct-chat-name pull-right">${data.name}</span>
            <span class="direct-chat-timestamp pull-left">${data.date}</span>
        </div>

        <img class="direct-chat-img"
             src="${data.avatar}"
             alt="message user image">
        </div>
        <p class="direct-chat-text">${data.message}</p>`);
        // app.messages.push(data.name);
    });

    // Vue application
    const app = new Vue({
        el: '#app',
        data: {
            messages: [],
        },
        methods: {
            sending(event) {
                event.preventDefault();
                let message = $('#formMessage')
                $.ajax({
                    url: message.attr('action'),
                    type: message.attr('method'),
                    data: message.serialize()
                })
                $('#msg_send').val('');
            },
        }
    });

</script>
</body>
