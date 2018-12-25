const http = require('http');
const config = require('./mmodule/config');
const helpes = require('./mmodule/helper');

http.createServer(helpes.onRequest).listen(config.port);