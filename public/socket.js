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
self.addEventListener('push', function (event) {
  // const data = event.data.json();
  // const { title, body } = data;
  event.waitUntil(
    self.registration.showNotification('title', {
      body: 'body',
      // You can add more options here, such as icons, etc.
    })
  );
});