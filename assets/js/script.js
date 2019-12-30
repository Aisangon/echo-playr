let currentPlaylist = [];
let shufflePlaylist = [];
let tempPlaylist = [];
let audioElement = null;
let mouseDown = false;
let currentIndex = 0;
let repeat = false;
let shuffle = false;

// function openPage(url) {
//     if(!url.includes('?')) {
//         url = url + "?";
//     }
//     let encodedUrl = encodeURI(`${url}&userLoggedin=${userLoggedIn}`);
//     fetch(encodedUrl)
//     .then(response => {
//         return response.text();
//     })
//     .then(body => {
//         document.querySelector('#main-content').innerHTML = body.split("main-content\">")[1];
//     });
// }

document.addEventListener("DOMContentLoaded", function() {
    let addPlaylistItem = document.querySelectorAll('.addToPlaylist');

        Array.from(addPlaylistItem).forEach(item => {
            item.addEventListener('click', function() {
                var playlistId = this.dataset.id;
                var albumSongValue = $(this).parents().siblings().closest('.albumSongId').val();
    
                var playlistData = `playlistId=${playlistId}&songId=${albumSongValue}`;
                fetch('includes/handlers/ajax/addToPlaylist.php', {
                    headers: {"Content-type": "application/x-www-form-urlencoded"},
                    method: 'POST',
                    body: playlistData
                })
                .catch(err => alert(err));
            });
        });
});

function removeFromPlaylist(element, playlistId) {
    var albumSongValue = $(element).parents().siblings().closest('.albumSongId').val();
    var playlistData = `playlistId=${playlistId}&songId=${albumSongValue}`;

    fetch('includes/handlers/ajax/removeFromPlaylist.php', {
        headers: {"Content-type": "application/x-www-form-urlencoded"},
        method: 'POST',
        body: playlistData
    })
    .then(location.reload())
    .catch(err => alert(err));
}

function createPlaylist() {
    let popup = prompt('Please enter the name of your playlist');
    if(popup !== null) {
        const data = `name=${popup}&username=${userLoggedIn}`;
        fetch('includes/handlers/ajax/createPlaylist.php', {
            headers: {"Content-type": "application/x-www-form-urlencoded"},
            method: 'POST',
            body: data
        })
        .then(location.reload())
        .catch(err => alert(err));
    }
}

function deletePlaylist(playlistId) {
    let confirmPopup = confirm('Are you sure you want to delete this playlist?');

    if(confirmPopup === true) {
        const deleteData = `playlistId=${playlistId}`;
        fetch('includes/handlers/ajax/deletePlaylist.php', {
            headers: {"Content-type": "application/x-www-form-urlencoded"},
            method: 'POST',
            body: deleteData
        })
        .then(window.location.href = 'yourMusic.php')
        .catch(err => alert(err));
    }
}

class Audio {
    
    constructor() {
        this.currentlyPlaying = null;
        this.audio = document.createElement('audio');
        const self = this;
        
        this.audio.addEventListener('ended', function() {
            nextSong();
        });
        
        this.audio.addEventListener('canplay', function() {
            const formattedDuration = self.formatTime(this.duration);
            document.getElementById('remainingTime').innerHTML = formattedDuration;
            self.updateVolumeProgressBar(this);
        });
        
        this.audio.addEventListener('timeupdate', function() {
            if(this.duration) self.updateTimeProgressBar(this);
        });
        
        this.audio.addEventListener('volumechange', function() {
            self.updateVolumeProgressBar(this);
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
        const timeProgress = JSON.stringify(currentAudio.currentTime / currentAudio.duration * 100);
        document.getElementById('audioProgress').style.width = `${timeProgress}%`;
    }
    
    updateVolumeProgressBar(audio) {
        const volumeProgress = JSON.stringify(audio.volume * 100);
        document.getElementById('volumeProgress').style.width = `${volumeProgress}%`;
    }
    
    setTime(seconds) {
        this.audio.currentTime = seconds;
    }
    
}