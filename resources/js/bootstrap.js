window._ = require('lodash');

// window.axios = require('axios');
//
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//


import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});


window.Echo.channel('chats').listen('ChatStatusUpdated', event => {
    console.log('Evento:');

    // const messages = [];
    // messages.push({'from_user_id': event.from_user_id, 'to_user_id': event.to_user_id , 'content': event.content});

    console.log(event);
});

