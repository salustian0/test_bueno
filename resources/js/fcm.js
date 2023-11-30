import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage,  } from "firebase/messaging";


const firebaseConfig = {
    apiKey: "AIzaSyCDHsi-cyhJ_hADE2UG-Kihxg0XXXdZKEU",
    authDomain: "testbueno-224dc.firebaseapp.com",
    projectId: "testbueno-224dc",
    storageBucket: "testbueno-224dc.appspot.com",
    messagingSenderId: "440615405487",
    appId: "1:440615405487:web:e6e8061b89035a761bd15a",
    measurementId: "G-96WNPJDY9Q"
};


function startNotification(){
    const app = initializeApp(firebaseConfig)
    const messaging = getMessaging(app);

    getToken(messaging, {vapidKey: 'BOfwROlJ9chO3_oqpbDNMEQoCBBpCMcJbeTb0ABz_wCklkY5lp5jFCowl9fHQApq4SWYDDoWauYEWehGpNwWwac'}).then((token) => {

        sendTokenToServer(token)


        if(!window.hasDeviceToken){
            console.log('not has device token')
        }else{
            console.log('has device token')
        }
    })

    onMessage(messaging, (payload) => {
        console.log('new message received: ', payload)

        window.showNotification(payload.notification.title,payload.notification.body)
    })
}

function sendTokenToServer(token){
    const url = `${window.url}/users/send_device_token`
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const  requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({device_token: token})
    };


    fetch(url, requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro na solicitação: ${response.status} - ${response.statusText}`);
            }

            return response.json()
        })
        .then((response) => {
            console.log({response})
        })
        .catch((error) => {
        console.log({error})
    })
}


if(window.isAuth){
    if (Notification.permission === 'granted') {
        console.log('Permissão de notificação concedida.');
        startNotification();

    } else{
        const btnRequestPermission = document.querySelector('#btn-request-permission')
        btnRequestPermission.classList.remove('d-none')

        btnRequestPermission.addEventListener('click', () => {
            requestPermission()
        })
    }
}




async function requestPermission(){
    try {
        const permissao = await Notification.requestPermission();
        console.log('Permissão de notificação:', permissao);
    } catch (error) {
        console.error('Erro ao solicitar permissão de notificação:', error);
    }
}


// const app = firebase.initializeApp(firebaseConfig)
// const messaging = firebase.messaging()
//
// messaging.getToken({vapidKey: 'BOfwROlJ9chO3_oqpbDNMEQoCBBpCMcJbeTb0ABz_wCklkY5lp5jFCowl9fHQApq4SWYDDoWauYEWehGpNwWwac'}).then((resp) => {
//     console.log(resp)
// })
// messaging.onMessage((payload) => {
//     console.log('message received', payload)
// })
