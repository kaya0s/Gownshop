<?php
session_start();




  if (isset($_SESSION['successmsg']) ) {
    echo "<script>
    function showGreenAlert(message) {
      const alert = document.createElement('div');
      alert.className = 'success-alert';
      alert.innerText = message;
      document.body.appendChild(alert);
  
      // Remove after 3 seconds
      setTimeout(() => {
        alert.remove();
      }, 5000);
    }
  
    // Example usage
    showGreenAlert('".$_SESSION['successmsg']."');
  </script>
    <?php } ?>";
      unset($_SESSION['successmsg']);
  } 
    
 

  if (isset($_SESSION['errormsg']) ) {
    echo "<script>
    function showGreenAlert(message) {
      const alert = document.createElement('div');
      alert.className = 'success-alert';
      alert.innerText = message;
      document.body.appendChild(alert);
  
      // Remove after 3 seconds
      setTimeout(() => {
        alert.remove();
      }, 5000);
    }
  
    // Example usage
    showGreenAlert('".$_SESSION['errormsg']."');
  </script>
    <?php } ?>";
      unset($_SESSION['successmsg']);
  } 
?>