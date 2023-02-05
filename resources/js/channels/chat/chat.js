import axios from "axios";
import cache, {isSet} from "lodash";


Pusher.logToConsole = true;
const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER
});
const channel = pusher.subscribe('chat');
channel.bind('my-event', function (data) {
    const TEXT = `
        <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right">${data.name}</span>
            <span class="direct-chat-timestamp pull-left">${data.date}</span>
        </div>
        <img class="direct-chat-img" src="${data.avatar}" alt="message user image">
        </div>
        <p class="direct-chat-text">${data.message}</p>`
    app.messages.push(TEXT);
});
const app = Vue.createApp({
    data() {
        return {
            messages: [],
            status: false,
        }
    },
    methods: {
        sending(event) {
            event.preventDefault();
            let message = $('#formMessage')
            axios.post(message.attr('action'), message.serialize())
            axios.post('/admin/chat_add', message.serialize())
            $('#msg_send').val('')
        },
    },
}).mount('#app');
if(app.status == false){
      axios.get('/admin/chat_get').then(item=>{
        for (let data of item.data){
            app.messages.push(
                `<div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right">${data.name}</span>
            <span class="direct-chat-timestamp pull-left">${data.date}</span>
        </div>
        <img class="direct-chat-img" src="${data.avatar}" alt="message user image">
        </div>
        <p class="direct-chat-text">${data.message}</p>`

            )
        }

    });
}
