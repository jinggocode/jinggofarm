importScripts('https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js');

// Initialize Firebase
  var config = {
    apiKey: "AIzaSyCmJHPz1COzm1tGUiztzTSQI7KDv8ixoOQ",
    authDomain: "jinggofarm-123.firebaseapp.com",
    databaseURL: "https://jinggofarm-123.firebaseio.com",
    projectId: "jinggofarm-123",
    storageBucket: "jinggofarm-123.appspot.com",
    messagingSenderId: "200273499431"
  };
  firebase.initializeApp(config);
  
  const messaging = firebase.messaging();