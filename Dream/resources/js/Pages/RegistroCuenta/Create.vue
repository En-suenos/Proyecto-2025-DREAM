<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const formulario=useForm({
    nombre:'',
    correo:'',
    contraseña:'',
    nombre_cuenta:'',
})
const createUsuario=()=>{
    const url=route('registro.store');

    formulario.post(url, {
        onSuccess: (response)=>{

        }
    })
}
</script>

<template>
    <Head title="Registro" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div>
                <form @submit.prevent="createUsuario">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                          Nombre
                        </label>
                        <input v-model="formulario.nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Nombre de usuario" required>
                        </div>
    
                        <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="correo">
                          Correo
                        </label>
                        <input v-model="formulario.correo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="email" placeholder="Nombre de usuario" required>
                        </div>
    
                        <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="contraseña">
                          Contraseña
                        </label>
                        <input v-model="formulario.contraseña" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" required>
                        <p class="text-red-500 text-xs italic">Por favor, elige una contraseña más segura.</p>
                        </div>

                        <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre_cuenta">
                          Nombre de la cuenta
                        </label>
                        <input v-model="formulario.nombre_cuenta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Nombre de usuario" required>
                        </div>
    
                        <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                          Guardar
                        </button>
                    </div>
                </form>
                
            </div>

            <!-- <h1>
                Hola desde create 
            </h1> -->
        </div>
        
        
    </AuthenticatedLayout>
</template>