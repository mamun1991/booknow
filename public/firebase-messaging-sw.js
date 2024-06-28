importScripts("https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js");

// import { initializeApp } from "firebase/app";
// import { getMessaging } from "firebase/messaging";

// import 

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyAzGWti-p6LMbCM-YjGsUSM7SjrGOcdxRs",
    authDomain: "booknow-a1749.firebaseapp.com",
    projectId: "booknow-a1749",
    storageBucket: "booknow-a1749.appspot.com",
    messagingSenderId: "387228470825",
    appId: "1:387228470825:web:be7f954ddd16a8203a1638"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log(
        "Received background message: ",
        payload
    );
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        // icon: payload.notification.image,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
