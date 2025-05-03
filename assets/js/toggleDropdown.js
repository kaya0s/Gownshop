function toggleDropdown() {
        const dropdown = document.getElementById("userDropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    // Close dropdown when clicking outside
    window.onclick = function(e) {
        if (!e.target.closest('.user-container')) {
            document.getElementById("userDropdown").style.display = "none";
        }
    }