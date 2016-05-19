// server.js

// set up ======================================================================
// get all the tools we need
var express = require('express');
var app = express();
var port = process.env.PORT || 443;
var passport = require('passport');
var flash = require('connect-flash');

var morgan = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var session = require('express-session');

// pass passport for configuration
require('./passport')(passport);

// set up our express application
// log every request to the console
app.use(morgan('dev'));
// read cookies (needed for auth)
app.use(cookieParser());
// get information from html forms
app.use(bodyParser());

// required for passport
// session secret
app.use(session({ secret: 'ilovescotchscotchyscotchscotch' }));
app.use(passport.initialize());
// persistent login sessions
app.use(passport.session());
// use connect-flash for flash messages stored in session
app.use(flash());

// routes ======================================================================
// load our routes and pass in our app and fully configured passport
require('./routes.js')(app, passport)

// launch ======================================================================
app.listen(port);
console.log('The magic happens on port ' + port);
