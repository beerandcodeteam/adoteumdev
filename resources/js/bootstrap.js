window._ = require('lodash');

// window.axios = require('axios');
//
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//


import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'ceac84d189f60fdf06a8', //TODO: adicionar para pegar como variável de ambiente
    cluster: 'mt1',
    forceTLS: true
});

window.Echo.channel('chats').listen('ChatStatusUpdated', event => {
    console.log('Evento:');
    console.log(event);
});
