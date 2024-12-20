require("dotenv").config();
const mongoose = require("mongoose");

// Mongoose connection to db
mongoose
  .connect(process.env.URI)
  .then(() => {
    console.log("Connected to database");
  })
  .catch((err) => {
    console.error("Error connecting to database", err);
  });

module.exports = { mongoose };
