<script setup>
import { ref, watch } from "vue";
import { router } from '@inertiajs/vue3';

const isVisible = ref(false);
const audio = ref(null);

const playlist = ref([]);
const currentIndex = ref(0);
const currentSound = ref(null);

const isPlaying = ref(false);
const progress = ref(0);
const duration = ref(0);

const volume = ref(1);
const repeat = ref(false);
const shuffle = ref(false);

const play = (index = null) => {
    if (index !== null) currentIndex.value = index;

    currentSound.value = playlist.value[currentIndex.value];
    if (!currentSound.value) return;

    if (!audio.value) audio.value = new Audio();

    audio.value.src = `/audio/${currentSound.value}`;
    audio.value.volume = volume.value;
    audio.value.play();

    isPlaying.value = true;
    isVisible.value = true;

    audio.value.onended = () => {
        if (repeat.value) {
            play();
            return;
        }
        playNext();
    };

    audio.value.ontimeupdate = () => {
        progress.value = audio.value.currentTime;
        duration.value = audio.value.duration;
    };
};

const playNext = () => {
    if (shuffle.value) {
        currentIndex.value = Math.floor(Math.random() * playlist.value.length);
    } else {
        currentIndex.value++;
        if (currentIndex.value >= playlist.value.length) currentIndex.value = 0;
    }
    play();
};

const playPrev = () => {
    currentIndex.value--;
    if (currentIndex.value < 0) currentIndex.value = playlist.value.length - 1;
    play();
};

const togglePlay = () => {
    if (!audio.value) return;
    if (isPlaying.value) {
        audio.value.pause();
        isPlaying.value = false;
    } else {
        audio.value.play();
        isPlaying.value = true;
    }
};

const seek = () => {
    if (audio.value) audio.value.currentTime = progress.value;
};

const setVolume = () => {
    if (audio.value) audio.value.volume = volume.value;
};

// EVENTO GLOBAL PARA RECIBIR PLAYLIST
window.addEventListener("play-global", (e) => {
    playlist.value = e.detail.tracks;
    currentIndex.value = e.detail.index;
    play();
});
</script>

<template>
    <div
        v-if="isVisible"
        class="fixed bottom-0 left-0 w-full bg-blue-900/90 backdrop-blur-xl border-t border-blue-700 shadow-2xl text-white z-50"
    >
        <div class="max-w-7xl mx-auto p-4 flex items-center gap-6">

            <!-- Botones -->
            <div class="flex items-center space-x-4">
                <button @click="playPrev" class="p-2 hover:text-blue-300">
                    ⏮
                </button>

                <button
                    @click="togglePlay"
                    class="p-3 bg-blue-600 hover:bg-blue-700 rounded-full text-xl"
                >
                    <span v-if="isPlaying">⏸</span>
                    <span v-else>▶️</span>
                </button>

                <button @click="playNext" class="p-2 hover:text-blue-300">
                    ⏭
                </button>
            </div>

            <!-- Info sonido -->
            <div class="flex-1">
                <div class="font-semibold">
                    {{ currentSound || 'Reproductor' }}
                </div>

                <!-- Progreso -->
                <div class="flex items-center gap-2">
                    <input
                        type="range"
                        min="0"
                        :max="duration"
                        step="0.1"
                        v-model="progress"
                        @input="seek"
                        class="w-full accent-blue-400"
                    />
                </div>
            </div>

            <!-- Volumen -->
            <div class="flex items-center gap-2 w-40">
                🔊
                <input
                    type="range"
                    min="0"
                    max="1"
                    step="0.01"
                    v-model="volume"
                    @input="setVolume"
                    class="accent-blue-400 w-full"
                />
            </div>

            <!-- Controles extra -->
            <div class="flex items-center gap-4">
                <button
                    @click="repeat = !repeat"
                    :class="repeat ? 'text-blue-400' : ''"
                >🔁</button>

                <button
                    @click="shuffle = !shuffle"
                    :class="shuffle ? 'text-blue-400' : ''"
                >🔀</button>
            </div>
        </div>
    </div>
</template>
