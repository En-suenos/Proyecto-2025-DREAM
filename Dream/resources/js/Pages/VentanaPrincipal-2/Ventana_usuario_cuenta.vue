<template>
  <div class="text-center p-5">
    <h1 class="text-3xl text-red-600 font-bold">¡Hola desde Vue en Laravel! 🎉</h1>
    <button @click="contador++" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
      Has hecho clic {{ contador }} veces
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return { contador: 0 };
  },
};
</script>
