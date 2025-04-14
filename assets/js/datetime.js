function updateDateTime() {
    const now = new Date();

    const dateOptions = { month: 'long', day: 'numeric', year: 'numeric' };
    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

    const formattedDate = now.toLocaleDateString('en-US', dateOptions);
    const formattedTime = now.toLocaleTimeString('en-US', timeOptions);

    document.getElementById("dateTimeDisplay").textContent = `Today is ${formattedDate} — ${formattedTime}`;
}

updateDateTime(); // Show immediately
setInterval(updateDateTime, 1000); // Update every second