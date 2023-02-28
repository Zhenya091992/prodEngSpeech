let paginateCount = 0;

document.getElementById("delayRange").addEventListener("change", async function() {
    document.getElementById('delay').textContent = this.value;
});
$(document).ready(async function() {
    let audio = document.getElementById("player");
    let word = document.getElementById("word");
    let translate = document.getElementById("translate");
    let transcription = document.getElementById("transcription");

    audio.controls = true;
    audio.loop = false;
    audio.autoplay = true;

    let timerId = setTimeout(function again() {
        generate();
        timerId = setTimeout(again, 7 * 1000)
    }, 2000)


    async function generate () {
        let response = await getData(paginateCount++);
        let enWord = response;
        let playlist = [];
        playlist.push(enWord.audio)
        playlist.push(...enWord.translate.map(function (item) {
            return item.audio
        }));

        word.textContent = enWord.word;
        translate.textContent = enWord.translate.reduce(function (str, current, index) {
            if (index == 0) return current.word;

            return str + ', ' + current.word;
        }, '');
        transcription.textContent = enWord.transcription;

        const MyPlayer = new Player(audio, playlist)
        MyPlayer.play()
        audio.onended = function () {
            MyPlayer.next()
        }
    }
});

function getData(count) {
    let url = 'learning';
    return fetch(
        url,
        {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json;charset=utf-8',
            }
        }
    ).then(function (response) {
            return response.json()
        }
    ).catch(function (err) {
        console.log(err);
    })
}

function Player(audioElem, playlist) {
    this.audioElem = audioElem
    this.playlist = playlist
    this.currentTrack = 0
    this.currentTrackPath = this.playlist[this.currentTrack]
    this.countTracks = this.playlist.length
    this.play = function () {
        this.currentTrackPath = this.playlist[this.currentTrack]
        if (!this.playlist[this.currentTrack]) {
            this.next()

            return
        }
        this.audioElem.src = this.currentTrackPath
        this.audioElem.play()
    }
    this.next = function () {
        if (this.currentTrack == this.countTracks - 1) return;
        ++this.currentTrack
        this.play()
    }
}
