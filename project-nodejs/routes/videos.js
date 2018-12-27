var express = require('express');
var router = express.Router();

/* GET home page. */
/* C1
router.get('/video/list', function(req, res, next) {
  res.send("List Video");
});
*/
//  C2
router.get('/list', function(req, res, next) {
    res.send("List Video");
});
router.get('/add', function(req, res, next) {
    res.send("Add Video");
});

module.exports = router;
