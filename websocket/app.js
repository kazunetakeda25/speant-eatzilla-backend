var ws = new (require('ws')).Server({port: (process.env.PORT || 3000)});
var mysql = require('mysql');
var moment = require('moment');
var fcm = require('./fcm.js');


/** storing db configuration */
var dbConfig = {
    host: 'localhost',
    user: 'root',
    //password: '',
    password: '00000',
    database: 'eatzilla',
    connectionLimit: 100,
    waitForConnections: true,
    queueLimit: 0,
    debug: true,
    wait_timeout: 28800,
    connect_timeout: 10,
    timezone: 'UTC',
    dateStrings: [
        'DATE',
        'DATETIME'
    ]
}
/** storing db configuration end*/
var conn = mysql.createPool(dbConfig);
conn.on('connection', function (connection) {
    console.log('MYSQL : pool connection established')
    connection.query("SET time_zone='+00:00';", function(error) {
        console.log('Failed to set mysql connection timezone to UTC')
    })
});

var sockets = ids = [];

ws.on('connection', function(w){
    try{
        console.log('connection open')
        w.on('message', function(msg){
            console.log(msg)
            var data = JSON.parse(msg);

            if (data.type == 'init') {
                id = data.id;
                sockets[id] = w;
                if(!ids.includes(id))
                    ids.push(id);

                    //console.log('receiver ids:',sockets)
                    //listenAll();
            }
            var mysqlTimestamp = moment(Date.now()).format('YYYY-MM-DD HH:mm:ss');
                    var from_id = data.from_id;
                    var to_id = data.to_id;
                    var is_read = 0;

            if (data.type == 'message') {
                if(ids.includes(data.to_id))
                {
                    //console.log('receiver id:',ids)
                    var is_read = 1;
                    sockets[data.to_id].send(msg);
                }else
                {
                    console.log('receiver offline',data.to_id)
                    //w.send({"status":false,"message":"Receiver is offline"});
                }
                var strInputString = data.message;
                var message = strInputString.replace(/'/g, "\\'");
                var query = `INSERT INTO chat_messages (request_id, user_id, provider_id, provider_type, message, from_id, to_id, is_read, created_at, updated_at) VALUES (${data.request_id}, ${data.user_id}, ${data.provider_id}, ${data.provider_type}, '${message}', '${from_id}', '${to_id}', '${is_read}','${mysqlTimestamp}', '${mysqlTimestamp}')`
                console.log('query', query)
                conn.query(query, (err, result) => {
                    if (err) {
                        console.log('message not inserted', err.message)
                        return
                    }
                    console.log('message inserted to db', result.insertId)
                    if(data.provider_type==2 && to_id!='Admin_1')
                    {
                        var query1 = 'select device_token from users where id='+data.user_id;
                        conn.query(query1, (err1, result1) => {
                            if (err1 || result1 === undefined || result1 === null || result1.length==0) {
                                try {
                                    console.log('data failed', err1.message)
                                } catch (error) {
                                    console.log('No error , No data found');
                                }
                                return
                            }
                            console.log('result-->', result1[0].device_token)
                            var push_data = {title:"New chat received",message:"New chat received",request_id:data.request_id,provider_type:data.provider_type}
                            fcm(result1[0].device_token,push_data);
                        });
                    }
                    if(data.provider_type==4 && to_id!='Admin_1')
                    {
                        var query1 = 'select device_token from delivery_partners where id='+data.user_id;
                        conn.query(query1, (err1, result1) => {
                            console.log('data failed', result1)
                            if (err1 || result1 === undefined || result1 === null || result1.length==0) {
                                try {
                                    console.log('data failed', err1.message)
                                } catch (error) {
                                    console.log('No error , No data found');
                                }
                                return
                            }
                            console.log('result-->', result1[0].device_token)
                            var push_data = {title:"New chat received",message:"New chat received",request_id:data.request_id,provider_type:data.provider_type}
                            fcm(result1[0].device_token,push_data);
                        });
                    }
                    if(data.provider_type==1)
                    {
                        if(data.to_id=='User_'+data.user_id)
                            var query1 = 'select device_token from users where id='+data.user_id;
                        else
                            var query1 = 'select device_token from delivery_partners where id='+data.provider_id;

                        conn.query(query1, (err1, result1) => {
                            if (err1 || result1 === undefined || result1 === null || result1.length==0) {
                                try {
                                    console.log('data failed', err1.message)
                                } catch (error) {
                                    console.log('No error , No data found');
                                }
                                return
                            }
                            console.log('result-->', result1[0].device_token)
                            var push_data = {title:"New chat received",message:"New chat received",request_id:data.request_id,provider_type:data.provider_type}
                            fcm(result1[0].device_token,push_data);
                        });
                    }
                    
                });
            }
        });
    }catch(Exception)
    {
        console.error(error);
    }
  
  
    w.on('close', function(e) {
        console.log('Closing :: ' + e);
    });

    function listenAll(){
        console.log("sockets:" + sockets);
        sockets.forEach( function(wsc,i){
            wsc.on('close', function(){
                console.log("Connection closed"+i);
                let current = ids[i];
                delete sockets[current];
                delete ids[i];
            });
        });
    }


});


