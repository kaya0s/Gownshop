function toggleCustomerDropdown() {
    document.getElementById("customerDropdown").classList.toggle("show");
  }

  // Optional: close the dropdown if clicked outside
  window.onclick = function(event) {
    if (!event.target.closest('.customer-container')) {
      document.getElementById("customerDropdown").classList.remove("show");
    }
  };