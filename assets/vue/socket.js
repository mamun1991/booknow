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
self.addEventListener('install', function (event) {
  event.waitUntil(self.skipWaiting()); // Activate worker immediately
});

self.addEventListener('activate', function (event) {
  event.waitUntil(self.clients.claim()); // Become available to all pages
});

self.addEventListener('message', event => {
  // const { type, payload } = event.data;
  console.log('Message received in service worker:', event.data);
  event.waitUntil(
    self.registration.showNotification('event.data', {
      body: `You have a new order from `
    });
  );
});


self.addEventListener('push', event => {
  // const data = event.data.json();
  console.log('Message received in service worker:', event.data);
  // Display a notification
  event.waitUntil(
    self.registration.showNotification('data.title', {
      body: 'data.body',
      // icon: '/path/to/icon.png', // Path to your notification icon
      // data: { url: '/' } // Optional data to be sent to the notification
    })
  );
});

self.addEventListener('notificationclick', event => {
  // Handle notification click event
  const notification = event.notification;
  const url = notification.data.url;

  event.waitUntil(
    clients.openWindow(url)
  );
});
