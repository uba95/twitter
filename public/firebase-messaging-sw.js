/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyA1z-mjlbZPXCSkXJqmlO-9QQo_MW_V2S0",
    authDomain: "laravel1-7de84.firebaseapp.com",
    databaseURL: "https://laravel1-7de84.firebaseio.com",
    projectId: "laravel1-7de84",
    storageBucket: "laravel1-7de84.appspot.com",
    messagingSenderId: "906989839223",
    appId: "1:906989839223:web:29b77267b4defd4d553772",
    measurementId: "G-HWSMX0K0SP"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});