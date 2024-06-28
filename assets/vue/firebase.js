// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging } from "firebase/messaging";

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

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const messaging = getMessaging(app);
