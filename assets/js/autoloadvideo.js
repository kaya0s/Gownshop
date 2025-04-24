 // This script ensures the video plays automatically on load
 document.addEventListener('DOMContentLoaded', function() {
    const video = document.querySelector('.video-background');
    if (video) {
        video.play().catch(function(error) {
            console.log("Autoplay prevented: ", error);
            // Create a play button if autoplay is blocked
            if (error.name === "NotAllowedError") {
                const playButton = document.createElement('button');
                playButton.innerHTML = 'Play Video';
                playButton.className = 'btn btn-light position-absolute top-50 start-50 translate-middle';
                playButton.style.zIndex = '2';
                playButton.onclick = function() {
                    video.play();
                    this.remove();
                };
                document.querySelector('.hero-section').appendChild(playButton);
            }
        });
    }
});