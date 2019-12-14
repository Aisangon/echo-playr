let currentPlaylist = [];
let audioElement = null;

class Audio {

    constructor() {
        this.currentlyPlaying = null;
        this.audio = document.createElement('audio');
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

}