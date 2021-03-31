const fs = require("fs");

var livereload = require("livereload");
var server = livereload.createServer({
	port: 35729,
	// https: {
	// 	key: fs.readFileSync('/srv/rhdwp/ssl/localhost.key'),
	// 	cert: fs.readFileSync('/srv/rhdwp/ssl/localhost.crt')
	// },
	exts: ["html", "css", "js", "php", "scss"],
});
server.watch(".");
