import './bootstrap';
import Alpine from 'alpinejs';
import Echo from "laravel-echo";
window.Pusher = require("pusher-js");
window.Alpine = Alpine;
const echo = new Echo({
    broadcaster: "pusher",
    key: "your-app-key",
    cluster: "mt1",
    encrypted: true,
});
echo.channel("import-progress")
.listen("FileImportProgress", (event) => {
    console.log(event.progress);
    // Update your progress bar here based on the event.progress
    // Update your progress bar here
    //document.getElementById('progress-bar').value = event.progress;
      // Update the progress bar
      let progressBar = document.getElementById('progress-bar');
      progressBar.value = event.progress;

      // Optionally, show/hide loading spinner
      if (event.progress === 100) {
          document.getElementById('loadingSpinner').style.display = 'none';
      } else {
          document.getElementById('loadingSpinner').style.display = 'block';
      }
});

// Optional: Handle form submission, show loading spinner and prevent re-submission
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let fileInput = document.getElementById('fileInput');
    if (fileInput.files.length > 0) {
        // Show the loading spinner when import starts
        document.getElementById('loadingSpinner').style.display = 'block';

        // You can use AJAX here if you want to import without refreshing the page, or let the form submit normally
        this.submit();
    } else {
        alert('Please select a file first!');
    }
});


Alpine.start();
