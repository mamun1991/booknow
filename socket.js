// store.js
// import { createStore } from 'vuex';

// const store = createStore({
//     state: {
//         websocketData: null,
//     },
//     mutations: {
//         setWebsocketData(state, data) {
//             state.websocketData = data;
//         },
//     },
// });

// export default store;



// service-worker.js

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open('my-cache').then((cache) => {
      return cache.addAll([
        '/',
        '/index.html',
        '/css/app.css',
        '/js/app.js',
        // Add other static assets
      ]);
    })
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
