let FCM = require('fcm-node');
let serverKey = 'AIzaSyBdkMsP_2LTltamZvWF7u1B0AFEsGLtt9g'; //put your server key here
let fcm = new FCM(serverKey);

    let sendNotification = (token,data) => {
        //
        var message = { //this may vary according to the message type (single recipient, multicast, topic, et cetera)
            to: token, 
            collapse_key: 'green',
            notification: {  //you can send only notification or only data(or include both)
                title : data.title,
                message : data.message,
                request_id : data.request_id,
                delivery_type : 1,
                provider_type : data.provider_type,
                image : "",
            },
            data: {  //you can send only notification or only data(or include both)
                title : data.title,
                message : data.message,
                request_id : data.request_id,
                delivery_type : 1,
                provider_type : data.provider_type,
                image : "",
            }
        };

        fcm.send(message, function(err, response){
            if (err) {
                console.log("FCM NOTIFICATION : Something has gone wrong!", err);
                return false;
            } else {
                console.log("Successfully sent FCM NOTIFICATION with response: ", response);
                return true;
            }
        });

    }

    module.exports = sendNotification;