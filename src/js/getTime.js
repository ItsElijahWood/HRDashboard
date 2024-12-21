function isMobile() {
  const width = window.innerWidth;

  if (width <= 417) {
    return null;
  } else if (width <= 768) {
    return "currentTime";
  }

  return "currentTimeAndTimeZone";
}

// Creates options variable to store temporary times
// Formats the times to EN-UK along with the variable
// Checks for mobile and returns currentTime and timeZone
function getTimeInTimeZone(timeZone) {
  try {
    const options = {
      timeZone: timeZone,
      hour: "2-digit",
      minute: "2-digit",
      hour12: false,
    };

    const formatter = new Intl.DateTimeFormat("en-UK", options);
    const currentTime = formatter.format(new Date());
    const mobileS = isMobile();

    if (mobileS === "currentTime") {
      return `${currentTime}`;
    } else if (mobileS === "currentTimeAndTimeZone") {
      return `${currentTime} ${timeZone}`;
    }

    return ""; // Return width when <= 400px
  } catch (error) {
    console.error("Invalid timezone:", error.message);
    return null;
  }
}

const timeZone = "Europe/London";
const pTime = document.getElementById("divTimeMath");

// Display time when no error
pTime
  ? setInterval(() => {
      pTime.textContent = `${getTimeInTimeZone(timeZone)}`;
    }, 1000)
  : (pTime.textContent = "Failed to load time.");
