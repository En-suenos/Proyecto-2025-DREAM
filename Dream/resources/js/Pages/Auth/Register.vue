<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import fondoLuna1 from '@/img/fondoLuna1.jpg'

// Estados para controlar la visibilidad de contraseñas
const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
const isPasswordFocused = ref(false);
const isPasswordConfirmationFocused = ref(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// Función para mostrar contraseña mientras se mantiene presionado
const startShowingPassword = (field) => {
    if (field === 'password') {
        showPassword.value = true;
    } else {
        showPasswordConfirmation.value = true;
    }
};

// Función para ocultar contraseña cuando se suelta el botón
const stopShowingPassword = (field) => {
    if (field === 'password') {
        showPassword.value = false;
    } else {
        showPasswordConfirmation.value = false;
    }
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="min-h-screen bg-cover bg-center bg-fixed flex items-center justify-center p-4"
            :style="{ backgroundImage: `url(${fondoLuna1})` }">

            <form @submit.prevent="submit" class="bg-white/15 backdrop-blur-2xl p-8 rounded-3xl shadow-2xl border border-white/30 relative overflow-hidden w-full max-w-md">
                <!-- Efecto de brillo adicional -->
                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-3xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <InputLabel for="name" value="Name" class="text-white" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full bg-white/20 border-white/30 text-white placeholder-white/70"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter your name"
                    />

                    <InputError class="mt-2 text-white/90" :message="form.errors.name" />
                </div>

                <div class="mt-4 relative z-10">
                    <InputLabel for="email" value="Email" class="text-white" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full bg-white/20 border-white/30 text-white placeholder-white/70"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        placeholder="Enter your email"
                    />

                    <InputError class="mt-2 text-white/90" :message="form.errors.email" />
                </div>

                <div class="mt-4 relative z-10">
                    <InputLabel for="password" value="Password" class="text-white" />

                    <!-- Contenedor para campo de contraseña con ojitos -->
                    <div class="relative">
                        <TextInput
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            class="mt-1 block w-full bg-white/20 border-white/30 text-white placeholder-white/70 pr-10"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            placeholder="Enter your password"
                            @focus="isPasswordFocused = true"
                            @blur="isPasswordFocused = false"
                        />
                        
                        <!-- Botón de ojitos para contraseña -->
                        <button 
                            v-if="isPasswordFocused || form.password"
                            type="button"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors duration-200 focus:outline-none"
                            @mousedown="startShowingPassword('password')"
                            @mouseup="stopShowingPassword('password')"
                            @mouseleave="stopShowingPassword('password')"
                            @touchstart="startShowingPassword('password')"
                            @touchend="stopShowingPassword('password')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <InputError class="mt-2 text-white/90" :message="form.errors.password" />
                </div>

                <div class="mt-4 relative z-10">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                        class="text-white"
                    />

                    <!-- Contenedor para campo de confirmación de contraseña con ojitos -->
                    <div class="relative">
                        <TextInput
                            id="password_confirmation"
                            :type="showPasswordConfirmation ? 'text' : 'password'"
                            class="mt-1 block w-full bg-white/20 border-white/30 text-white placeholder-white/70 pr-10"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                            @focus="isPasswordConfirmationFocused = true"
                            @blur="isPasswordConfirmationFocused = false"
                        />
                        
                        <!-- Botón de ojitos para confirmación de contraseña -->
                        <button 
                            v-if="isPasswordConfirmationFocused || form.password_confirmation"
                            type="button"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors duration-200 focus:outline-none"
                            @mousedown="startShowingPassword('confirmation')"
                            @mouseup="stopShowingPassword('confirmation')"
                            @mouseleave="stopShowingPassword('confirmation')"
                            @touchstart="startShowingPassword('confirmation')"
                            @touchend="stopShowingPassword('confirmation')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <InputError
                        class="mt-2 text-white/90"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="mt-4 flex items-center justify-end relative z-10">
                    <Link
                        :href="route('login')"
                        class="rounded-md text-sm text-white underline hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition duration-200"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton
                        class="ms-4 bg-white/30 hover:bg-white/40 border-white/40 text-white backdrop-blur-sm"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Estilos adicionales para mejorar el efecto brumoso */
form {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 
        0 8px 32px 0 rgba(31, 38, 135, 0.37),
        inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
}

/* Mejora la apariencia de los inputs */
::placeholder {
    color: rgba(255, 255, 255, 0.7) !important;
}

/* Asegura que el botón de ojitos tenga buen contraste */
button:focus {
    outline: 2px solid rgba(255, 255, 255, 0.5);
    outline-offset: 2px;
    border-radius: 4px;
}

/* Efecto visual cuando se mantiene presionado el botón */
button:active {
    transform: translateY(-50%) scale(0.95);
}
</style>