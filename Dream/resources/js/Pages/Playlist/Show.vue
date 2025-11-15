<script setup>
/**
 * Show.vue — Reproductor "Spotify-lite" completo con cielo estrellado
 *
 * Requisitos:
 * - Prop `playlist` con estructura:
 *    {
 *      id, nombre, descripcion,
 *      sonidos: [ "archivo.mp3" | { archivo: "archivo.mp3", nombre: "Nombre", cover: "/images/cover.jpg" } , ... ]
 *    }
 *
 * Funcionalidades incluidas:
 * - Reproducción continua automática
 * - Siguiente / Anterior
 * - Shuffle (aleatorio)
 * - Repeat modes: none | all | one
 * - Barra de progreso + seek (scrubbing)
 * - Volumen (persistente en localStorage)
 * - Mini visualizer (CSS)
 * - Exportar: JSON, M3U, TXT, CSV
 * - Importar: JSON, M3U
 * - Descargar pista individual (usa /audio/<archivo>)
 * - Guardado de última pista y posición en localStorage
 * - Diseño responsive estilo "Spotify" con cielo estrellado
 * - Función playGlobal para comunicación entre componentes
 */

import { ref, computed, watch, onMounted, onBeforeUnmount } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  playlist: {
    type: Object,
    required: true
  }
});

/* ---------- Helpers ---------- */
const SOUND_URL_PREFIX = '/audio/'; // Cambia si tus audios están en otro lugar
const LS_PREFIX = `player_playlist_${props.playlist.id}_`; // storage key prefix

const getSoundFile = (s) => {
  if (!s) return '';
  return typeof s === 'string' ? s : (s.archivo || s.file || '');
};
const getSoundName = (s) => {
  if (!s) return 'Sonido sin nombre';
  return typeof s === 'string' ? s : (s.nombre || s.title || getSoundFile(s));
};
const getSoundCover = (s) => {
  if (!s) return null;
  return typeof s === 'object' && s.cover ? s.cover : null;
};
const getSoundUrl = (file) => `${SOUND_URL_PREFIX}${file}`;

/* ---------- State ---------- */
const audio = ref(null);
const tracks = computed(() => Array.isArray(props.playlist.sonidos) ? props.playlist.sonidos : []);
const trackCount = computed(() => tracks.value.length);

const currentIndex = ref(0); // index in tracks array
const isPlaying = ref(false);
const currentTime = ref(0);
const duration = ref(0);
const volume = ref(Number(localStorage.getItem(LS_PREFIX + 'volume')) || 0.8);
const muted = ref(false);
const shuffle = ref(false);
const repeatMode = ref(localStorage.getItem(LS_PREFIX + 'repeat') || 'none'); // none | all | one
const shuffleOrder = ref([]);
const visualizerOn = ref(true);

/* restore last state */
const lastIndexSaved = Number(localStorage.getItem(LS_PREFIX + 'lastIndex'));
const lastTimeSaved = Number(localStorage.getItem(LS_PREFIX + 'lastTime'));

if (!isNaN(lastIndexSaved) && lastIndexSaved >= 0 && lastIndexSaved < trackCount.value) {
  currentIndex.value = lastIndexSaved;
}

/* ---------- Audio lifecycle & events ---------- */
const initAudio = () => {
  if (!audio.value) audio.value = new Audio();
  audio.value.preload = 'metadata';
  audio.value.volume = volume.value;
  audio.value.addEventListener('loadedmetadata', onLoadedMetadata);
  audio.value.addEventListener('timeupdate', onTimeUpdate);
  audio.value.addEventListener('ended', onEnded);
  audio.value.addEventListener('error', onError);
};

const destroyAudio = () => {
  if (!audio.value) return;
  audio.value.removeEventListener('loadedmetadata', onLoadedMetadata);
  audio.value.removeEventListener('timeupdate', onTimeUpdate);
  audio.value.removeEventListener('ended', onEnded);
  audio.value.removeEventListener('error', onError);
  try { audio.value.pause(); audio.value.src = ''; } catch(e) {}
  audio.value = null;
};

const loadTrack = (index, autoPlay = false, restorePosition = false) => {
  if (!tracks.value.length) return;
  index = normalizeIndex(index);
  currentIndex.value = index;
  const file = getSoundFile(tracks.value[index]);
  if (!file) {
    console.warn('Track without file at index', index);
    return;
  }
  initAudio();
  audio.value.src = getSoundUrl(file);
  audio.value.load();
  if (restorePosition && lastTimeSaved && !isNaN(lastTimeSaved)) {
    audio.value.currentTime = lastTimeSaved;
  } else {
    audio.value.currentTime = 0;
  }
  if (autoPlay) play();
};

const onLoadedMetadata = () => {
  duration.value = audio.value.duration || 0;
  // if saved time present and we are restoring, set it
  if (!isNaN(lastTimeSaved) && lastTimeSaved > 0 && audio.value.currentTime === 0) {
    audio.value.currentTime = Math.min(lastTimeSaved, duration.value - 0.1);
  }
};

const onTimeUpdate = () => {
  currentTime.value = audio.value.currentTime || 0;
  // save last time periodically
  localStorage.setItem(LS_PREFIX + 'lastTime', Math.floor(currentTime.value));
};

const onEnded = () => {
  if (repeatMode.value === 'one') {
    play(true);
    return;
  }
  // if shuffle, compute next from shuffleOrder
  if (shuffle.value) {
    const pos = shuffleOrder.value.indexOf(currentIndex.value);
    if (pos >= 0 && pos < shuffleOrder.value.length - 1) {
      currentIndex.value = shuffleOrder.value[pos + 1];
      loadTrack(currentIndex.value, true);
      return;
    } else {
      // reached end of shuffle list
      if (repeatMode.value === 'all') {
        generateShuffleOrder();
        currentIndex.value = shuffleOrder.value[0];
        loadTrack(currentIndex.value, true);
        return;
      } else {
        isPlaying.value = false;
        return;
      }
    }
  } else {
    // sequential
    if (currentIndex.value < trackCount.value - 1) {
      currentIndex.value++;
      loadTrack(currentIndex.value, true);
    } else {
      if (repeatMode.value === 'all') {
        currentIndex.value = 0;
        loadTrack(currentIndex.value, true);
      } else {
        isPlaying.value = false;
      }
    }
  }
};

const onError = (e) => {
  console.error('Audio error', e);
  isPlaying.value = false;
};

/* ---------- Playback controls ---------- */
const play = async (force = false) => {
  if (!audio.value) initAudio();
  if (!audio.value.src) loadTrack(currentIndex.value, false);
  try {
    await audio.value.play();
    isPlaying.value = true;
  } catch (err) {
    console.warn('Play blocked', err);
    if (force) { /* ignore */ }
  }
};

const pause = () => {
  if (!audio.value) return;
  audio.value.pause();
  isPlaying.value = false;
};

const togglePlay = () => {
  if (isPlaying.value) pause(); else play();
};

const next = () => {
  if (!trackCount.value) return;
  if (shuffle.value) {
    // find current pos in shuffleOrder
    const pos = shuffleOrder.value.indexOf(currentIndex.value);
    if (pos === -1) {
      // generate and pick next
      generateShuffleOrder();
      currentIndex.value = shuffleOrder.value[0];
    } else {
      if (pos < shuffleOrder.value.length - 1) currentIndex.value = shuffleOrder.value[pos + 1];
      else {
        if (repeatMode.value === 'all') {
          generateShuffleOrder();
          currentIndex.value = shuffleOrder.value[0];
        } else {
          // end
          pause();
          return;
        }
      }
    }
  } else {
    if (currentIndex.value < trackCount.value - 1) currentIndex.value++;
    else {
      if (repeatMode.value === 'all') currentIndex.value = 0;
      else { pause(); return; }
    }
  }
  loadTrack(currentIndex.value, true);
};

const prev = () => {
  if (!trackCount.value) return;
  if (audio.value && audio.value.currentTime > 3) {
    audio.value.currentTime = 0;
    return;
  }
  if (shuffle.value) {
    const pos = shuffleOrder.value.indexOf(currentIndex.value);
    if (pos > 0) currentIndex.value = shuffleOrder.value[pos - 1];
    else currentIndex.value = shuffleOrder.value[0];
  } else {
    if (currentIndex.value > 0) currentIndex.value--;
    else currentIndex.value = 0;
  }
  loadTrack(currentIndex.value, true);
};

const jumpTo = (index) => {
  if (index < 0 || index >= trackCount.value) return;
  currentIndex.value = index;
  loadTrack(index, true);
};

/* ---------- Global Player Integration ---------- */
const playGlobal = (index) => {
    window.dispatchEvent(new CustomEvent("play-global", {
        detail: {
            tracks: props.playlist.sonidos.map(s => getSoundFile(s)),
            index: index
        }
    }));
};

const playCurrentGlobal = () => {
    playGlobal(currentIndex.value);
};

/* ---------- Shuffle / Repeat ---------- */
const generateShuffleOrder = () => {
  const n = trackCount.value;
  const arr = Array.from({ length: n }, (_, i) => i);
  for (let i = n - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
  shuffleOrder.value = arr;
  // ensure currentIndex is in front of list
  if (!shuffleOrder.value.includes(currentIndex.value)) {
    shuffleOrder.value.unshift(currentIndex.value);
  }
};
const toggleShuffle = () => {
  shuffle.value = !shuffle.value;
  if (shuffle.value) {
    generateShuffleOrder();
  } else {
    shuffleOrder.value = [];
  }
};

/* ---------- Seek & Volume ---------- */
const seekPercent = ref(0);
watch(currentTime, (t) => {
  seekPercent.value = duration.value ? (t / duration.value) * 100 : 0;
});

const seekToPercent = (p) => {
  if (!audio.value || !duration.value) return;
  const t = (p / 100) * duration.value;
  audio.value.currentTime = t;
  currentTime.value = t;
};

const setVolume = (v) => {
  volume.value = Math.min(1, Math.max(0, v));
  if (audio.value) audio.value.volume = volume.value;
  localStorage.setItem(LS_PREFIX + 'volume', volume.value);
};

const toggleMute = () => {
  muted.value = !muted.value;
  if (audio.value) audio.value.muted = muted.value;
};

/* ---------- Export / Import ---------- */
const exportJSON = () => {
  const payload = {
    nombre: props.playlist.nombre,
    descripcion: props.playlist.descripcion,
    sonidos: tracks.value.map(t => {
      return typeof t === 'string' ? { archivo: t, nombre: t } : t;
    })
  };
  downloadBlob(JSON.stringify(payload, null, 2), `${slugify(props.playlist.nombre || 'playlist')}.json`, 'application/json');
};

const exportM3U = () => {
  const lines = ['#EXTM3U'];
  tracks.value.forEach(t => lines.push(getSoundFile(t)));
  downloadBlob(lines.join('\n'), `${slugify(props.playlist.nombre || 'playlist')}.m3u`, 'audio/x-mpegurl');
};

const exportTXT = () => {
  const lines = tracks.value.map((t, i) => `${i+1}. ${getSoundName(t)} - ${getSoundFile(t)}`);
  downloadBlob(lines.join('\n'), `${slugify(props.playlist.nombre || 'playlist')}.txt`, 'text/plain');
};

const exportCSV = () => {
  const rows = [['index','nombre','archivo','cover']];
  tracks.value.forEach((t, i) => {
    rows.push([i+1, `"${escapeCsv(getSoundName(t))}"`, getSoundFile(t), getSoundCover(t) || '']);
  });
  const csv = rows.map(r => r.join(',')).join('\n');
  downloadBlob(csv, `${slugify(props.playlist.nombre || 'playlist')}.csv`, 'text/csv');
};

const downloadBlob = (content, filename, mime) => {
  const blob = new Blob([content], { type: mime });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  a.click();
  URL.revokeObjectURL(url);
};

const slugify = (s) => (s || 'playlist').toString().toLowerCase().replace(/\s+/g,'_').replace(/[^a-z0-9_\-\.]/g, '');

const escapeCsv = (s) => (s || '').replace(/"/g, '""');

/* Import: supports JSON (our schema) and simple M3U files */
const importFileInput = ref(null);
const onImportClick = () => importFileInput.value?.click();

const handleImportFile = async (e) => {
  const file = e.target.files && e.target.files[0];
  if (!file) return;
  const text = await file.text();
  if (file.name.endsWith('.json')) {
    try {
      const data = JSON.parse(text);
      if (Array.isArray(data.sonidos)) {
        // for safety, prompt user before replacing — here we'll just replace
        // In real app, ask confirmation
        // map to required format
        const mapped = data.sonidos.map(s => typeof s === 'string' ? s : ({ archivo: s.archivo || s.file, nombre: s.nombre || s.archivo, cover: s.cover || null }));
        // replace playlist.sonidos (warning: prop is readonly — in Inertia you'd send to server)
        // Here we'll just offer the export of the imported list and jump to first track
        // Save imported list locally as a temporary playlist for playback
        tempImportedTracks.value = mapped;
        currentIndex.value = 0;
        loadTrackFromArray(tempImportedTracks.value, 0, true);
      } else {
        alert('JSON no contiene "sonidos" como array');
      }
    } catch (err) {
      alert('JSON inválido');
    }
  } else if (file.name.endsWith('.m3u')) {
    // parse lines ignoring comment lines
    const lines = text.split(/\r?\n/).map(l => l.trim()).filter(Boolean);
    const files = lines.filter(l => !l.startsWith('#'));
    const mapped = files.map(f => ({ archivo: f, nombre: f }));
    tempImportedTracks.value = mapped;
    currentIndex.value = 0;
    loadTrackFromArray(tempImportedTracks.value, 0, true);
  } else {
    alert('Formato no soportado. Usa .json o .m3u');
  }
  e.target.value = ''; // reset input
};

const tempImportedTracks = ref(null); // if user imports, use these for playback instead of props.playlist.sonidos
const activeTracks = computed(() => tempImportedTracks.value ? tempImportedTracks.value : tracks.value);

// helper to play from imported array
const loadTrackFromArray = (arr, index, autoPlay=false) => {
  if (!arr || !arr.length) return;
  const file = getSoundFile(arr[index]);
  if (!file) return;
  initAudio();
  audio.value.src = getSoundUrl(file);
  audio.value.load();
  if (autoPlay) play();
};

/* ---------- Download individual track ---------- */
const downloadTrack = (track) => {
  const file = getSoundFile(track);
  if (!file) return;
  // Try to force browser download
  const a = document.createElement('a');
  a.href = getSoundUrl(file);
  a.download = file;
  a.click();
};

/* ---------- Persistence ---------- */
watch(currentIndex, (val) => {
  localStorage.setItem(LS_PREFIX + 'lastIndex', val.toString());
});
watch(() => repeatMode.value, (v) => localStorage.setItem(LS_PREFIX + 'repeat', v));
watch(volume, (v) => localStorage.setItem(LS_PREFIX + 'volume', v.toString()));

/* ---------- Util / normalize ---------- */
const normalizeIndex = (i) => {
  if (!trackCount.value) return 0;
  if (i < 0) return 0;
  if (i >= trackCount.value) return trackCount.value - 1;
  return i;
};

/* ---------- UI helpers ---------- */
const formatTime = (s) => {
  if (!s || isNaN(s)) return '0:00';
  const m = Math.floor(s / 60);
  const sec = Math.floor(s % 60).toString().padStart(2, '0');
  return `${m}:${sec}`;
};

/* ---------- Lifecycle ---------- */
onMounted(() => {
  initAudio();
  // load initial track from saved state or chosen index
  const idx = Number(localStorage.getItem(LS_PREFIX + 'lastIndex')) || currentIndex.value || 0;
  currentIndex.value = normalizeIndex(idx);
  // if there is imported list, play that; otherwise load from props
  loadTrack(currentIndex.value, false, true);
  // restore volume
  if (audio.value) audio.value.volume = volume.value;
});

onBeforeUnmount(() => {
  // save time
  if (audio.value) localStorage.setItem(LS_PREFIX + 'lastTime', Math.floor(audio.value.currentTime || 0));
  destroyAudio();
});

/* ---------- Visualizer (CSS-driven) ---------- */
const visualizerBars = computed(() => {
  // dynamic number of bars depending on width could be implemented — keep fixed
  return Array.from({ length: 8 }, (_, i) => i);
});

/* ---------- Small UX helpers ---------- */
const toggleRepeat = () => {
  if (repeatMode.value === 'none') repeatMode.value = 'all';
  else if (repeatMode.value === 'all') repeatMode.value = 'one';
  else repeatMode.value = 'none';
};
</script>

<template>
  <Head :title="`Playlist: ${props.playlist.nombre}`" />

  <AuthenticatedLayout>
    <!-- Fondo de cielo estrellado -->
    <div class="night-sky">
      <!-- Luna -->
      <div class="moon"></div>

      <!-- Estrellas -->
      <div class="stars"></div>
      <div class="stars2"></div>
      <div class="stars3"></div>
      <div class="stars4"></div>

      <!-- Contenido principal -->
      <div class="min-h-screen relative z-10 text-white p-6">
        <div class="max-w-6xl mx-auto space-y-6">

          <!-- Header -->
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
              <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center shadow-2xl shadow-blue-400/30">
                <i class="fas fa-moon text-3xl text-white"></i>
              </div>
              <div>
                <h1 class="text-3xl font-bold text-white drop-shadow-lg">{{ props.playlist.nombre }}</h1>
                <p class="text-gray-200 mt-1 drop-shadow">{{ props.playlist.descripcion || 'Sin descripción' }}</p>
                <p class="text-gray-300 text-sm mt-1 drop-shadow">{{ trackCount }} sonidos</p>
              </div>
            </div>

            <div class="flex items-center gap-3">
              <Link :href="route('playlist.index')" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/10 transition-all">Volver</Link>

              <div class="flex items-center gap-2">
                <button @click="exportJSON" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded backdrop-blur-sm border border-white/10 transition-all">Exportar JSON</button>
                <button @click="exportM3U" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded backdrop-blur-sm border border-white/10 transition-all">Exportar M3U</button>
                <button @click="exportTXT" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded backdrop-blur-sm border border-white/10 transition-all">Exportar TXT</button>
                <button @click="exportCSV" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded backdrop-blur-sm border border-white/10 transition-all">Exportar CSV</button>
              </div>

              <input ref="importFileInput" type="file" accept=".json,.m3u" @change="handleImportFile" class="hidden" />
              <button @click="onImportClick" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded backdrop-blur-sm border border-white/10 transition-all">Importar</button>
            </div>
          </div>

          <!-- Player Panel -->
          <div class="bg-gradient-to-tr from-white/5 to-white/10 p-6 rounded-2xl shadow-2xl border border-white/10 backdrop-blur-lg">
            <div class="md:flex md:items-center md:justify-between gap-6">

              <!-- Left: cover + info -->
              <div class="flex items-center gap-4 md:w-1/3">
                <div class="w-28 h-28 rounded-xl overflow-hidden bg-gray-700/50 flex items-center justify-center border border-white/10 backdrop-blur-sm">
                  <img v-if="getSoundCover(props.playlist.sonidos[currentIndex])" :src="getSoundCover(props.playlist.sonidos[currentIndex])" alt="cover" class="w-full h-full object-cover" />
                  <div v-else class="w-full h-full flex items-center justify-center text-2xl text-white/90">
                    <i class="fas fa-music"></i>
                  </div>
                </div>
                <div>
                  <div class="text-lg font-semibold text-white drop-shadow">{{ getSoundName(props.playlist.sonidos[currentIndex]) }}</div>
                  <div class="text-sm text-gray-200 mt-1 drop-shadow">{{ getSoundFile(props.playlist.sonidos[currentIndex]) }}</div>
                </div>
              </div>

              <!-- Center: controls -->
              <div class="flex-1">
                <div class="flex flex-col items-center gap-3">
                  <div class="flex items-center gap-4">
                    <button @click="toggleShuffle" :class="shuffle ? 'text-blue-400' : 'text-white/80'" class="p-2 rounded hover:bg-white/10 backdrop-blur-sm transition-all"><i class="fas fa-random"></i></button>
                    <button @click="prev" class="p-3 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-all"><i class="fas fa-backward"></i></button>

                    <button @click="togglePlay" class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-blue-400/30 transition-all transform hover:scale-105">
                      <i v-if="isPlaying" class="fas fa-pause"></i>
                      <i v-else class="fas fa-play"></i>
                    </button>

                    <button @click="next" class="p-3 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-all"><i class="fas fa-forward"></i></button>
                    <button @click="toggleRepeat" :class="repeatMode === 'none' ? 'text-white/80' : 'text-blue-400'" class="p-2 rounded hover:bg-white/10 backdrop-blur-sm transition-all"><i class="fas fa-redo"></i></button>
                  </div>

                  <!-- Progress -->
                  <div class="w-full max-w-3xl mt-2">
                    <div class="flex items-center justify-between text-xs text-gray-200 mb-1 drop-shadow">
                      <span>{{ formatTime(currentTime) }}</span>
                      <span>{{ formatTime(duration) }}</span>
                    </div>

                    <div class="relative h-2 bg-white/10 rounded-full cursor-pointer backdrop-blur-sm" @click.stop.prevent="(e) => { const rect = e.target.getBoundingClientRect(); const clickX = e.clientX - rect.left; const pct = (clickX / rect.width) * 100; seekToPercent(pct); }">
                      <div class="absolute left-0 top-0 h-2 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full" :style="{ width: (duration ? (currentTime / duration) * 100 : 0) + '%' }"></div>
                    </div>
                  </div>

                  <!-- Visualizer -->
                  <div v-if="visualizerOn" class="flex gap-1 mt-4 items-end h-12">
                    <div v-for="b in visualizerBars" :key="b" class="w-1.5 bg-gradient-to-t from-blue-400 to-blue-500 rounded animate-visual" :style="{ animationDelay: (b * 50) + 'ms' }"></div>
                  </div>
                </div>
              </div>

              <!-- Right: volume & actions -->
              <div class="md:w-1/3 flex flex-col items-end gap-4">
                <div class="flex items-center gap-3">
                  <button @click="toggleMute" class="p-2 rounded hover:bg-white/10 backdrop-blur-sm transition-all"><i :class="muted || volume === 0 ? 'fas fa-volume-mute' : volume < 0.5 ? 'fas fa-volume-down' : 'fas fa-volume-up'"></i></button>
                  <input type="range" min="0" max="1" step="0.01" v-model.number="volume" @input="setVolume(volume)" class="w-40 volume-slider" />
                </div>

                <div class="flex items-center gap-3">
                  <!-- Botón para reproducir actual globalmente -->
                  <button @click="playCurrentGlobal()" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 px-3 py-2 rounded text-white backdrop-blur-sm border border-white/10 transition-all">
                    <i class="fas fa-broadcast-tower mr-1"></i> Reproducir Global
                  </button>

                  <button v-if="trackCount" @click="downloadTrack(props.playlist.sonidos[currentIndex])" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 px-3 py-2 rounded text-white backdrop-blur-sm border border-white/10 transition-all">
                    <i class="fas fa-download mr-1"></i> Descargar
                  </button>
                  <button v-if="trackCount" @click="jumpTo(0)" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 px-3 py-2 rounded text-white backdrop-blur-sm border border-white/10 transition-all">
                    <i class="fas fa-step-backward mr-1"></i> Inicio
                  </button>
                </div>

              </div>

            </div>
          </div>

          <!-- Tracks list -->
          <div class="bg-white/5 p-4 rounded-xl border border-white/10 backdrop-blur-lg">
            <h3 class="text-lg font-semibold mb-3 text-white drop-shadow">Pistas</h3>
            <div class="space-y-2">
              <div v-for="(t, i) in activeTracks" :key="i" class="flex items-center justify-between p-2 rounded hover:bg-white/10 backdrop-blur-sm transition-all border border-transparent hover:border-white/5">
                <div class="flex items-center gap-3">
                  <div class="w-10 text-gray-300 text-center">{{ i + 1 }}</div>
                  <div>
                    <div class="font-medium text-white drop-shadow">{{ getSoundName(t) }}</div>
                    <div class="text-sm text-gray-200 drop-shadow">{{ getSoundFile(t) }}</div>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <!-- Botón para reproducir en este reproductor -->
                  <button @click="jumpTo(i)" class="px-3 py-2 rounded bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white transition-all transform hover:scale-105">
                    <i class="fas fa-play mr-1"></i> Reproducir
                  </button>

                  <!-- Nuevo botón para reproducir globalmente -->
                  <button @click="playGlobal(i)" class="px-3 py-2 rounded bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white transition-all transform hover:scale-105">
                    <i class="fas fa-broadcast-tower mr-1"></i> Global
                  </button>

                  <button @click="downloadTrack(t)" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-all">
                    <i class="fas fa-download mr-1"></i> Descargar
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Fondo de cielo estrellado */
.night-sky {
  position: relative;
  min-height: 100vh;
  background: linear-gradient(135deg, #0c0c2e 0%, #1a1a3e 50%, #2d1b69 100%);
  overflow: hidden;
}

/* Luna */
.moon {
  position: absolute;
  top: 50px;
  right: 50px;
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #f9f3c5 0%, #e8d89e 100%);
  border-radius: 50%;
  box-shadow:
    0 0 60px rgba(249, 243, 197, 0.6),
    0 0 100px rgba(249, 243, 197, 0.4),
    inset -10px -10px 20px rgba(0, 0, 0, 0.2);
  animation: moonGlow 4s ease-in-out infinite alternate;
}

@keyframes moonGlow {
  0% {
    box-shadow:
      0 0 60px rgba(249, 243, 197, 0.6),
      0 0 100px rgba(249, 243, 197, 0.4);
  }
  100% {
    box-shadow:
      0 0 80px rgba(249, 243, 197, 0.8),
      0 0 120px rgba(249, 243, 197, 0.6);
  }
}

/* Estrellas */
.stars, .stars2, .stars3 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}

.stars::before, .stars2::before, .stars3::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image:
    radial-gradient(2px 2px at 20px 30px, #eee, transparent),
    radial-gradient(2px 2px at 40px 70px, #fff, transparent),
    radial-gradient(1px 1px at 90px 40px, #ddd, transparent),
    radial-gradient(1px 1px at 130px 80px, #fff, transparent),
    radial-gradient(2px 2px at 160px 30px, #eee, transparent);
  background-repeat: repeat;
  background-size: 200px 100px;
  animation: starsMove 50s linear infinite;
}

.stars2::before {
  background-image:
    radial-gradient(1px 1px at 50px 160px, #fff, transparent),
    radial-gradient(1px 1px at 90px 40px, #eee, transparent),
    radial-gradient(2px 2px at 130px 80px, #fff, transparent),
    radial-gradient(1px 1px at 160px 120px, #ddd, transparent);
  animation: starsMove 100s linear infinite;
  animation-delay: -50s;
}

.stars3::before {
  background-image:
    radial-gradient(1px 1px at 110px 80px, #fff, transparent),
    radial-gradient(1px 1px at 190px 20px, #eee, transparent),
    radial-gradient(1px 1px at 160px 60px, #ddd, transparent);
  animation: starsMove 150s linear infinite;
  animation-delay: -100s;
}

@keyframes starsMove {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(-100px);
  }
}

/* Visualizer */
.animate-visual {
  animation: visualAnim 900ms infinite ease-in-out;
  height: 6px;
}
@keyframes visualAnim {
  0% { transform: scaleY(0.3); opacity: 0.5; }
  50% { transform: scaleY(1.6); opacity: 1; }
  100% { transform: scaleY(0.4); opacity: 0.6; }
}

/* Slider de volumen personalizado */
.volume-slider {
  -webkit-appearance: none;
  height: 6px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  outline: none;
}

.volume-slider::-webkit-slider-runnable-track {
  height: 6px;
  background: linear-gradient(90deg,
    rgba(251, 191, 36, 0.95) 0%,
    rgba(251, 191, 36, 0.95) var(--val, 50%),
    rgba(255, 255, 255, 0.12) var(--val, 50%),
    rgba(255, 255, 255, 0.12) 100%);
  border-radius: 999px;
}

.volume-slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 16px;
  height: 16px;
  border-radius: 999px;
  background: white;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
  cursor: pointer;
  transition: all 0.2s ease;
}

.volume-slider::-webkit-slider-thumb:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
}

/* Efectos de texto */
.drop-shadow {
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.drop-shadow-lg {
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
}

/* Transiciones suaves */
.transition-all {
  transition: all 0.3s ease;
}

/* Efectos de backdrop */
.backdrop-blur-sm {
  backdrop-filter: blur(8px);
}

.backdrop-blur-lg {
  backdrop-filter: blur(16px);
}
</style>
