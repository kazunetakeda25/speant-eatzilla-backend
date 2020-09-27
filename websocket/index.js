let express = require('express');
var plaid = require('plaid');
var mysql = require('mysql');

const app = express();
var router = express.Router()

const WebSocket = require('ws')
const wss = new WebSocket.Server({ port: 8081 });

  wss.on('connection', ws => {
    
    ws.on('message', message => {
      console.log('message received '+message)
      let msg = JSON.parse(message);
      wss.clients.forEach(client => {
          
          let data = {};
              data.status = 'new-request-received';
              data.statusCode = 200;
              data.msg = msg.id;
              client.send(JSON.stringify(data));

      });
      
    })
    ws.send('ho!');
  });

  app.use(express.urlencoded({extended: true}));
  app.use(express.json()); 

  // CORS
  app.use(function (req, res, next) {
      // Websites allowed to connect
      res.setHeader('Access-Control-Allow-Origin', '*');
      // Request methods to be allowed
      res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
      // Request headers to be allowed
      res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
      // Pass to next layer of middleware
      res.setHeader('Content-Type', 'application/json');
      // setting header content-type application/json
      next();
  });

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
    // connection.query("SET time_zone='+00:00';", function(error) {
    //     console.log('Failed to set mysql connection timezone to UTC')
    // })
  });

  //plaid configuration
  var client = new plaid.Client(
    '5c63ddce08ed150010a9ba61',
    '0be6d5b19ba2482b79925503084fb7',
    'ba3695619012375d9ea588181e8ed0',
    plaid.environments.sandbox
);

  // routes
  app.get('/', (req, res) => res.send('Hello World'));

  app.get('/new-request',(req,res) => {
      var WebSocket = require('universal-websocket-client');
      const socket = new WebSocket('ws://localhost:8081');
      // Connection opened
      socket.addEventListener('open', function (event) {
          let data = {};
          data.type = 'broadcast'; 
          data.id = req.query.id;
          socket.send(JSON.stringify(data));
          res.send('success');
      });
  });


  app.get('/get_access_token', function(request, response, next) {
      PUBLIC_TOKEN = request.query.public_token;
      client.exchangePublicToken(PUBLIC_TOKEN, function(error, tokenResponse) {
        if (error != null) {
        var msg = 'Could not exchange public_token!';
        console.log(msg + '\n' + JSON.stringify(error));
        return response.json({
          error: msg
        });
      }
      ACCESS_TOKEN = tokenResponse.access_token;
      ITEM_ID = tokenResponse.item_id;
      console.log(tokenResponse);
      return response.json({
        access_token: ACCESS_TOKEN,
        item_id: ITEM_ID,
        error: false
      });
    });
  });

  app.get('/generate_assetreport',(req,res) => {
    const ACCESS_TOKENS = [req.query.access_token];
    const daysRequested = 180;
    const id = req.query.id;
    const options = {
    };
    console.log(ACCESS_TOKENS);
    client.createAssetReport(ACCESS_TOKENS, daysRequested, options, (error, createResponse) => {
      if (error != null) {
        console.log(error);
        return res.json({
          status: false,
          error: error.error_message
        });
      }
      console.log(createResponse);
      const assetReportId = createResponse.asset_report_id;
      const assetReportToken = createResponse.asset_report_token;
      var query = `update users set asset_report_id='${assetReportId}', asset_report_token='${assetReportToken}' where id='${id}'`
      conn.query(query, (err, result) => {
        return res.json({
          status: true,
          asset_report_id: assetReportId,
          asset_report_token: assetReportToken
        });
      });
    });
  });

  app.get('/get_assetreport',(req,res) => {
    const ASSET_REPORT_TOKEN = req.query.asset_report_token;
    client.getAssetReport(ASSET_REPORT_TOKEN, false, (error, getResponse) => {
        if (error != null) {
          if (error.status_code === 400 &&
              error.error_code === 'PRODUCT_NOT_READY') {
                console.log(error);
                return res.json({
                  status: false,
                  error: error.error_message
                });
          } else {
            console.log(error);
            return res.json({
              status: false,
              error: error.error_message
            });
          }
        }
        const report = getResponse.report;
        console.log(report);
        return res.json({
          status: true,
          items: report
        });
    });
  });

// app config
app.listen(3030, () => {
  console.log(`Server running at http://localhost:3030/`);
});
 

