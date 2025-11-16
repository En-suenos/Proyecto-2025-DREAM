<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import fondoLuna1 from '@/img/fondoLuna1.jpg'

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="min-h-screen bg-cover bg-center bg-fixed flex items-center justify-center p-4"
            :style="{ backgroundImage: `url(${fondoLuna1})` }">
            
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="bg-white/15 backdrop-blur-2xl p-8 rounded-3xl shadow-2xl border border-white/30 relative overflow-hidden w-full max-w-md">
                <!-- Efecto de brillo adicional -->
                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-3xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <InputLabel for="email" value="Email" class="text-white" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full bg-white/20 border-white/30 text-white placeholder-white/70"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email"
                    />

                    <InputError class="mt-2 text-white/90" :message="form.errors.email" />
                </div>

                <div class="mt-4 relative z-10">
                    <InputLabel for="password" value="Password" class="text-white" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full bg-white/20 border-white/30 text-white placeholder-white/70"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    />

                    <InputError class="mt-2 text-white/90" :message="form.errors.password" />
                </div>

                <div class="mt-4 block relative z-10">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" 
                            class="bg-white/20 border-white/30 text-indigo-600" />
                        <span class="ms-2 text-sm text-white">Remember me</span>
                    </label>
                </div>

                <div class="mt-4 flex items-center justify-end relative z-10">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="rounded-md text-sm text-white underline hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition duration-200"
                    >
                        Forgot your password?
                    </Link>

                    <PrimaryButton
                        class="ms-4 bg-white/30 hover:bg-white/40 border-white/40 text-white backdrop-blur-sm"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
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
</style>