const express = require('express');
const { body, validationResult } = require('express-validator');
const { json } = require('body-parser');
const router = express.Router();

let mysql = require('mysql');

let con = mysql.createConnection({
    host: "87.229.6.116",
    user: "bruhajuj",
    password: "Kaklanaf",
    database: "Gather2Watch"
});

con.connect(function (err) {
    if (err) throw err;
    console.log("Connected!");
});


router.use(express.json());
router.use(express.urlencoded({ extended: true }));


router.get('/app/index.html', function (req, res) {
    res.end;
});

router.get("/", (req, res) => {
    res.sendFile(__dirname + "/app/register.html");
});

// async function CheckEmail(value) {
//     let checkemail = `SELECT COUNT(email) as count FROM felhasznalok WHERE email = '${value}'`;
//     await con.query(checkemail, function (err, result, fields) {
//         if (result[0].count >= 1) {
//             console.log(result[0].count);
//             console.log("Number of same emails found^^");
//             throw new Error('Swag Bog');
//         }
//         else if(result[0].count == 0){
//             console.log(result[0].count);
//             console.log("This email doesnt exist yet");
//         }
//     });
//     return true;
// }

async function CheckEmail(value) {
    const checkemail = `SELECT COUNT(email) as count FROM felhasznalok WHERE email = '${value}'`;
    const result = await new Promise((resolve, reject) => {
        con.query(checkemail, function (err, result, fields) {
            if (err) {
                reject(err);
            } else {
                resolve(result[0].count);
            }
        });
    });

    if (result >= 1) {
        throw new Error('Swag Bog');
    }

    return true;
}
router.post("/register",[body('name').isLength({ min: 3 }).trim().escape(),
body('email').isEmail().normalizeEmail(),
body('name', 'Name is required!').notEmpty(),
body('email', 'Email is required!').notEmpty(),
body('password1', 'Password is required!').notEmpty(),
body('password2', 'Passwords do not match.').custom((value, { req }) => { 
    if(value != req.body.password1){
        throw new Error('Bog GAG');
    }
    return true;
    
}),
body('email', 'This Email already exists').custom(async (value) => {
    return await CheckEmail(value);
    console.log("WHAT IS THIS^^^^^^");
    await CheckEmail(value);
})], (req, res) => {
    const username = req.body.name;
    const email = req.body.email;
    const password = req.body.password1;
    const user = {
        username: username,
        email: email
    }
    console.log("THESE ARE THE ROTTEN DATA!!!!");
    console.log(username);
    console.log(email);
    console.log(password);
    console.log("ITS THERE^^^^");

    const errors = validationResult(req);
    console.log(errors);
    if (!errors.isEmpty()) {
        console.log("There were errorsˇˇ");
        return res.status(400).json({ errors: errors.array() });
    }
    else {
        console.log("No errors found inserting into the database");
        let sql = `INSERT INTO felhasznalok (nev, email, jelszo) VALUES ('${username}', '${email}', '${password}')`;
        con.query(sql, function (err, result) {
            if (err) throw err;
        });
        res.render('pages/loggedin', {user : user})
    }
});
module.exports = router;