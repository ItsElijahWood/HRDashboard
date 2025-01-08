import config from "../../config.js";

function updateTime() {
  fetch(`${config.base_url}/include/getTime.php`)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("time").innerText = data;
    })
    .catch((error) => {
      console.error("Error fetching time:", error);
    });
}

setInterval(updateTime, 10000);
