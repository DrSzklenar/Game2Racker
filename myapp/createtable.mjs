import { createConnection } from 'mysql';

let con = createConnection({
    host: "localhost",
    port:"3306",
    user: "root",
    database: "teszt1234"
});

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    let sql = "CREATE TABLE customers (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), address VARCHAR(255))";
    con.query(sql, function (err, result) {
      if (err) throw err;
      console.log("Table created");
    });
  });