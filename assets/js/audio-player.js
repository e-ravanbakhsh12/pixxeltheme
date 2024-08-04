class AudioPlayer {
  constructor(playerElement) {
    this.playerElement = playerElement;
    this.audio = new Audio();
    this.loaded = false;
    this.audioUrlInput = playerElement.querySelector(".audioUrl");
    this.loadAudioButton = playerElement.querySelector(".loadAudio");
    this.audioCanvas = playerElement.querySelector(".audioCanvas");
    this.decorLine = playerElement.querySelector(".decorLine");
    this.ctx = this.audioCanvas.getContext("2d");
    this.isPlaying = false;

    this.loadAudioButton.addEventListener("click", () => {
      this.loadAudio();
      this.togglePlay();
    });
    this.audioCanvas.addEventListener("click", (event) => this.seekTo(event));
    this.audioCanvas.addEventListener("dblclick", () => this.togglePlay());
  }

  loadAudio() {
    if (this.loaded) return;
    const url = this.audioUrlInput.value;
    console.log("Loading audio from URL:", url); // Debugging log
    this.decorLine.classList.add('hidden');
    if (url) {
      this.audio.src = url;
      this.audio.load();
      this.audio.addEventListener("loadedmetadata", () => {
        console.log("Audio metadata loaded."); // Debugging log
        this.drawProgress();
      });
      this.audio.addEventListener("timeupdate", () => {
        this.drawProgress();
      });
      this.audio.addEventListener("error", (e) => {
        alert("Error loading audio: " + e.message);
      });
      this.loaded = true;
    } else {
      console.error("No URL provided for audio."); // Debugging log
    }
  }

  seekTo(event) {
    const rect = this.audioCanvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const progress = x / this.audioCanvas.width;
    this.audio.currentTime = progress * this.audio.duration;
  }

  togglePlay() {
    if (this.isPlaying) {
      this.audio.pause();
    } else {
      this.audio.play();
    }
    this.loadAudioButton.classList.toggle("pixxelicon-play");
    this.loadAudioButton.classList.toggle("pixxelicon-pause");
    this.isPlaying = !this.isPlaying;
  }

  stopPlay() {
    this.audio.pause();
    this.loadAudioButton.classList.add("pixxelicon-play");
    this.loadAudioButton.classList.remove("pixxelicon-pause");
    this.isPlaying = false;
  }

  drawProgress() {
    this.ctx.clearRect(0, 0, this.audioCanvas.width, this.audioCanvas.height);

    // Draw background progress bar with rounded corners
    this.ctx.fillStyle = "rgba(237, 245, 255, 1)";
    this.ctx.beginPath();
    this.ctx.moveTo(0, 45);
    this.ctx.arcTo(this.audioCanvas.width, 45, this.audioCanvas.width, 55, 5);
    this.ctx.arcTo(this.audioCanvas.width, 55, 0, 55, 5);
    this.ctx.arcTo(0, 55, 0, 45, 5);
    this.ctx.arcTo(0, 45, this.audioCanvas.width, 45, 5);
    this.ctx.fill();

    const progressWidth =
      (this.audio.currentTime / this.audio.duration) * this.audioCanvas.width;

    // Draw filled progress bar with rounded corners
    this.ctx.fillStyle = "rgba(1, 132, 253, 1)";
    this.ctx.beginPath();
    this.ctx.moveTo(0, 45);
    this.ctx.arcTo(progressWidth, 45, progressWidth, 55, 5);
    this.ctx.arcTo(progressWidth, 55, 0, 55, 5);
    this.ctx.arcTo(0, 55, 0, 45, 5);
    this.ctx.arcTo(0, 45, progressWidth, 45, 5);
    this.ctx.fill();

    this.drawCursor(progressWidth);
  }

  drawCursor(x) {
    const currentTime = this.formatTime(this.audio.currentTime);
    const totalTime = this.formatTime(this.audio.duration);

    // Define the y position offset for the cursor
    const cursorYOffset = 43; // Original y position 45 + 10px down

    // Define the width of the cursor
    const cursorWidth = 70; // Increased width by 20px (originally 50)

    // Draw the progress bar cursor as a rounded rectangle
    this.ctx.fillStyle = "rgba(1, 132, 253, 1)";
    this.ctx.strokeStyle = "rgba(237, 245, 255, 1)"; // Stroke color
    this.ctx.lineWidth = 1; // Stroke width
    this.ctx.beginPath();
    const start = x - cursorWidth / 2 < 0 ? 0 : x - cursorWidth / 2;
    this.ctx.moveTo(start, cursorYOffset); // Adjusted for new width
    this.ctx.arcTo(
      x + cursorWidth / 2,
      cursorYOffset,
      x + cursorWidth / 2,
      cursorYOffset + 15,
      5
    ); // Increased width
    this.ctx.arcTo(
      x + cursorWidth / 2,
      cursorYOffset + 15,
      start,
      cursorYOffset + 15,
      5
    );
    this.ctx.arcTo(start, cursorYOffset + 15, start, cursorYOffset, 5);
    this.ctx.arcTo(start, cursorYOffset, x + cursorWidth / 2, cursorYOffset, 5);
    this.ctx.fill();
    this.ctx.stroke();

    // Draw the current time inside the rectangle
    this.ctx.fillStyle = "rgba(237, 245, 255, 1)";
    this.ctx.font = "10px Ravi";
    this.ctx.textAlign = "center";
    const text = x > 25 ? currentTime + "/" + totalTime : currentTime;
    this.ctx.fillText(text, x, cursorYOffset + 10); // Adjusted position to align with new cursor height
  }

  formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs < 10 ? "0" + secs : secs}`;
  }
}
