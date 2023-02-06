import axios from "axios";

Pusher.logToConsole = true;
const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER
});
const id = $('#getId').val();
const channel = pusher.subscribe(`user.${id}`);
channel.bind('user-event', function (data) {
    app.message = data;
    alert(data);
})
const app = Vue.createApp({
    data() {
        return {
            message: '',
        }
    },
    watch: {
        message: function () {
           alert(this.message);
        }
    },
    methods: {
        send_user(id = 1) {
        },
    },
}).mount('#admin');


