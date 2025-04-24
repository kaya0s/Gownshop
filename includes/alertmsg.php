<?php
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
            }, 1500);
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
            alert.className = 'error-alert';
            alert.innerText = message;
            document.body.appendChild(alert);
        
            // Remove after 3 seconds
            setTimeout(() => {
              alert.remove();
            }, 1500);
          }
        
          // Example usage
          showGreenAlert('".$_SESSION['errormsg']."');
        </script>
          <?php } ?>";
      unset($_SESSION['errormsg']);
  } 


  if(isset($_SESSION['adminmsg'])){
    echo "<script>
          function showGreenAlert(message) {
            const alert = document.createElement('div');
            alert.className = 'error-alert';
            alert.innerText = message;
            document.body.appendChild(alert);
        
            // Remove after 3 seconds
            setTimeout(() => {
              alert.remove();
            }, 1500);
          }
        
          // Example usage
          showGreenAlert('".$_SESSION['adminmsg']."');
        </script>
          <?php } ?>";
         unset($_SESSION['adminmsg']);
   }

   if (isset($_SESSION['greenmsg']) ) {
    echo "<script>
          function showGreenAlert(message) {
            const alert = document.createElement('div');
            alert.className = 'green-alert';
            alert.innerText = message;
            document.body.appendChild(alert);
        
            // Remove after 3 seconds
            setTimeout(() => {
              alert.remove();
            }, 1500);
          }
        
          // Example usage
          showGreenAlert('".$_SESSION['greenmsg']."');
        </script>
          <?php } ?>";
          
      unset($_SESSION['greenmsg']);
  } 
?>