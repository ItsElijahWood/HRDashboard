const { mongoose } = require("../routes/databasec");

const userSchema = new mongoose.Schema({
  username: { type: String, required: true, unique: true },
  password: { type: String, required: true },
});

module.exports = { userSchema };
