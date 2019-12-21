let currentPlaylist = [];
let audioElement = null;

class Audio {

    constructor() {
        this.currentlyPlaying = null;
        this.audio = document.createElement('audio');
        const self = this;
        
        this.audio.addEventListener('canplay', function() {
            const formattedDuration = self.formatTime(this.duration);
            document.getElementById('remainingTime').innerHTML += formattedDuration;
        });

        this.audio.addEventListener('timeupdate', function() {
            if(this.duration) self.updateTimeProgressBar(this);
        });
    }

    setTrack(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    play() {
        this.audio.play();
    }

    pause() {
        this.audio.pause();
    }

    formatTime(timeToFormat) {
        const time = Math.round(timeToFormat);
        const minutes = Math.floor(time / 60);
        const seconds = time - (minutes * 60);
        return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    updateTimeProgressBar(currentAudio) {
        document.getElementById('currentTime').innerHTML = this.formatTime(currentAudio.currentTime);
        const progress = JSON.stringify(currentAudio.currentTime / currentAudio.duration * 100);
        document.getElementById('audioProgress').style.width = `${progress}%`;
    }

}