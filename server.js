let fs = require('fs');
require('dotenv').config();
var credentials = null;
var server = null;
var cors = require('cors');
var corsOptions = {
     origin: 'https://'+ process.env.APP_DOMAIN,
      optionsSuccessStatus: 200
  }
/*
 * This is certification when it's not Let's encrypt, but some paid SSL
 */
// if(fs.existsSync('/opt/psa/var/certificates/'+process.env.SSL_CERT)) {
//     let cert = fs.readFileSync('/opt/psa/var/certificates/'+process.env.SSL_CERT).toString();
//     var s = "-----BEGIN CERTIFICATE-----";
//     var p = new RegExp("(" + s + ")");
//     let res = cert.split(p);
//
//     credentials = {
//         key: res[0],
//         cert: res[1]+res[2],
//         rejectUnauthorized: false
//     };
// }

if(fs.existsSync('/usr/local/psa/var/modules/letsencrypt/etc/live/'+process.env.APP_DOMAIN+'/privkey.pem')) {
    credentials = {
        key: fs.readFileSync('/usr/local/psa/var/modules/letsencrypt/etc/live/'+process.env.APP_DOMAIN+'/privkey.pem').toString(),
        cert: fs.readFileSync('/usr/local/psa/var/modules/letsencrypt/etc/live/'+process.env.APP_DOMAIN+'/cert.pem').toString(),
        ca: fs.readFileSync('/usr/local/psa/var/modules/letsencrypt/etc/live/'+process.env.APP_DOMAIN+'/chain.pem').toString(),
        rejectUnauthorized: false
    };
}
console.log('SSL:', credentials);

let app = require('express')();
app.use(cors(corsOptions));

if(credentials) {
    console.log('HTTPS server about to be created...');
    server = require('https').createServer(credentials, app);
} else {
    console.log('HTTP server about to be created...');
    server = require('http').createServer(app);
}
// const io = require('socket.io')(server, {
//     cors: {
//         origin: credentials ? 'https://'+ process.env.APP_DOMAIN : 'http://'+ process.env.APP_DOMAIN,
//     }
// });
const io = require('socket.io')(server, {
  cors: {
    origin: '*',
  }
 });

let Redis = require('ioredis');
let redis = new Redis();

server.listen(process.env.NODE_SERVER_PORT, function(){
    console.log('Server started at port '+process.env.NODE_SERVER_PORT+', CTRL + C to stop.');
});

redis.psubscribe(['*'], function(err, count){

});

redis.on('pmessage', function(subscribe, channel, message){
    message = JSON.parse(message);
    console.log(channel, message);
    io.emit(channel + ':' + message.event, message.data);
});


io.on('connection', function (socket) {
    // console.log('a user connected');
    socket.on('disconnect', function(){
        console.log('user disconnected');
    });
});

redis.on('ready', function(){
    console.log("Redis is running");
});
