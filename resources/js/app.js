/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import DisplayDashboardComponent from '../js/components/DisplayDashboardComponent.vue'
import Echo from 'laravel-echo';
import io from 'socket.io-client';


const app = createApp({});



const echo = new Echo({
    broadcaster: 'socket.io',
    client: io, // Pass the Socket.io client here
    host: window.location.hostname + ':6001',
});

echo.channel('public').listen('.notification', (data) => {
    // Display the notification as a pop-up using a Vue.js modal component or library
});
app.component('example-component', ExampleComponent);
app.component('display-component', DisplayDashboardComponent);



app.mount('#vue_app');
