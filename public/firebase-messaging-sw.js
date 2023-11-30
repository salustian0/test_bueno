importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-app-compat.js')
importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging-compat.js')

const firebaseConfig = {
    apiKey: "AIzaSyCDHsi-cyhJ_hADE2UG-Kihxg0XXXdZKEU",
    authDomain: "testbueno-224dc.firebaseapp.com",
    projectId: "testbueno-224dc",
    storageBucket: "testbueno-224dc.appspot.com",
    messagingSenderId: "440615405487",
    appId: "1:440615405487:web:e6e8061b89035a761bd15a",
    measurementId: "G-96WNPJDY9Q"
};



const app = firebase.initializeApp(firebaseConfig)
const messaging = firebase.messaging()

messaging.onBackgroundMessage( (payload) => {
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload?.notification?.body,
        icon: payload?.notification?.icon,
    }

    self.registration.showNotification(notificationTitle, notificationOptions)
})
