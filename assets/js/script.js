let currentPlaylist = [];
let audioElement = null;

class Audio {

    constructor() {
        this.currentlyPlaying = null;
        this.audio = document.createElement('audio');
    }

    setTrack(src) {
        this.audio.src = src;
    }

    play() {
        this.audio.play();
    }

    pause() {
        this.audio.pause();
    }

}