let notifications = [];
let id = 0;

window.showNotification = (title, message) => {
    const notificationContainer = document.querySelector('.notification-container')
    const messageElement = newMessage(title,message )
    const id = getUniqueId()

    const existsMessage = notifications.find(x => x.title == title && x.message == message)

    if(existsMessage)
        return;

    notifications.push({
        id,
        title,
        message
    })

    console.log(notifications)

    setTimeout(() => {
        notificationContainer.removeChild(messageElement)
        notifications = notifications.filter(x => x.id !== id);
        console.log(notifications)
    }, 5000)

    notificationContainer.appendChild(messageElement)
}


function getUniqueId(){
    const randomNumber = Math.random().toString(36).substring(2, 10);
    const timestamp = new Date().getTime();
    return randomNumber + timestamp;
}

function newMessage(title, body){
    const message  = `<div class="notification alert alert-info">
        <span class="fw-bolder">${title}</span><br>
        <span>${body}</span>
    </div>`
    return stringHtmlToElement(message);
}
function stringHtmlToElement(html){
    const tmpContainer = document.createElement('div')
    tmpContainer.innerHTML = html;
    return tmpContainer.firstChild;
}
