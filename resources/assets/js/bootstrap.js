
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = require('jquery');

  require('materialize-css')
} catch (e) {}

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
axios = require('axios')
VueAxios = require('vue-axios');
window.Vue.use(VueAxios, axios);

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

window.Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const csrf_token = document.head.querySelector('meta[name="csrf-token"]');
if (csrf_token) {
    window.Vue.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token.content;
}
const api_token = document.body.querySelector('input[name="api_token"]');
if (api_token) {
    window.Vue.axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token.getAttribute('value');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
