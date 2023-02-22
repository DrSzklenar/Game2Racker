import { createConnection } from 'mysql';

let con = createConnection({
  host: "localhost",
  port:"3306",
  user: "root"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
  con.query("CREATE DATABASE teszt1234", function (err, result) {
    if (err) throw err;
    console.log("Database created");
  });
});