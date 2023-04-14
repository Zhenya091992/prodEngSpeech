<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {defineComponent, nextTick, onMounted, reactive, ref} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

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

defineComponent(PrimaryButton)

let instance = reactive({word: {}})
let value = 10
let playList = []
let data = []
let keysData = []
const countWords =ref(0)
const audio = ref(null)

async function getData() {
    return fetch(
        "api/listen/allLearnedWords",
        {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
            }
        }
    ).then(function (response) {
        return response.json();
    }
    ).catch(function (err) {
        console.log(err);
    })
}

function getKeysData (data) {
    keysData = Object.keys(data)
}

function getWord (data) {
    return  data[keysData[ keysData.length * Math.random() << 0]]
}

const actionWithWord = (id, action) => {
    axios({
        method: "get",
        url: 'api/enWords/action/?idWord=' + id + '&action=' + action
    }).then((response) => {
        let key = keysData.indexOf(String(id))
        if (key !== -1) {
            delete keysData[String(key)]
            keysData = keysData.flat()
            countWords.value = keysData.length
        }
    }).catch((response) => {
        console.log(response)
    })
}

const addWordsForLearning = () => {
    axios({
        method: "get",
        url: 'api/enWords/addToLearn'
    }).then((response) => {
        data = Object.assign(response.data, data)
        keysData = Object.keys(data)
        countWords.value = keysData.length
    }).catch((response) => {
        console.log(response)
    })
}

onMounted(async () => {
    data = await getData()
    keysData = Object.keys(data)
    countWords.value = keysData.length
    let loop = async () => {
        instance.word = await getWord(data)
        playList = [instance.word.audio]
        playList.push(...instance.word.translate.map(function (item) {
            return item.audio
        }))
        const MyPlayer = new Player(audio.value, playList)
        MyPlayer.play()
        audio.value.onended = function () {
            MyPlayer.next()
        }

        setTimeout(loop, +value * 1000)
    }
    loop()
})
</script>

<template>
    <div class="container max-w-lg my-8 mx-auto columns-3">
        <div class="box-content font-semibold">
            <h2 id="word">{{ instance.word.word }}</h2>
            <h3 id="transcription">{{ instance.word.transcription }}</h3>
        </div>
        <div class="box-border text-gray-600">
            <h3 v-for="ruWord in instance.word.translate">{{ ruWord.word }}</h3>
        </div>
    </div>
    <div class="container max-w-lg my-4 mx-auto">
        <div class="flex justify-between">
            <primary-button @click="audio.play()">
                Play
            </primary-button>
            <audio ref="audio" id="player" preload="metadata">
            </audio>
            <div class="mx-2">
                <p>Playing cycle {{ value }} sec</p>
                <input type="range" class="form-range" v-model="value" min="5" max="20" step="0.5">
            </div>

        </div>
        <div class="flex justify-between">
            <PrimaryButton class="my-4" @click="actionWithWord(instance.word.id, 'learned')">
                Learned
            </PrimaryButton>
            <div class="pt-5">
                <p>words in learn {{ countWords }}</p>
            </div>
            <SecondaryButton class="my-4" @click="addWordsForLearning">
                Add 10 words
            </SecondaryButton>
        </div>
    </div>



</template>
