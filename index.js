const pool = require('./db');

pool.query('SELECT * FROM sign', (err, res) => {
  if (err) {
    console.error('Error executing query', err.stack);
  } else {
    console.log(res.rows);
  }
});

