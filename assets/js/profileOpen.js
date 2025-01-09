// Function toggles the profile buttons on the frontend.
function toggleProfile() {
  const menu = document.getElementById("Menu");

  menu.style.display =
    menu.style.display === "none" || menu.style.display === ""
      ? "block"
      : "none";
}
