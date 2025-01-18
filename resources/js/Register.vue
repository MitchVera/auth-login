<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="max-w-sm mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold mb-4">Registro</h2>
  
        <!-- Formulario de Registro -->
        <form @submit.prevent="register">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input
              type="text"
              id="name"
              v-model="name"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md"
              placeholder="Ingresa tu nombre"
              required
            />
          </div>
  
          <div class="mb-4">
            <label for="lastname" class="block text-sm font-medium text-gray-700">Apellido</label>
            <input
              type="text"
              id="lastname"
              v-model="lastname"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md"
              placeholder="Ingresa tu apellido"
              required
            />
          </div>
  
          <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Número de Teléfono</label>
            <input
              type="text"
              id="phone"
              v-model="phone"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md"
              placeholder="Ingresa tu número de teléfono"
              required
            />
          </div>
  
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input
              type="email"
              id="email"
              v-model="email"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md"
              placeholder="Ingresa tu correo"
              required
            />
          </div>
  
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input
              type="password"
              id="password"
              v-model="password"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md"
              placeholder="Ingresa tu contraseña"
              required
            />
          </div>
  
          <div v-if="error" class="text-red-500 text-sm mb-4">{{ error }}</div>
  
          <button
            type="submit"
            class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600"
          >
            Registrar
          </button>
        </form>
  
        <div class="mt-4 text-center">
          <p>¿Ya tienes cuenta? <router-link to="/" class="text-blue-500">Inicia sesión</router-link></p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        lastname: '',
        phone: '',
        email: '',
        password: '',
        error: null,
      };
    },
    methods: {
      async register() {
        try {
          const response = await axios.post('http://localhost:8000/api/register', {
            name: this.name,
            lastname: this.lastname,
            phone: this.phone,
            email: this.email,
            password: this.password,
          });
  
          // Redirigir al login después de registrar
          this.$router.push({ name: 'login' });
        } catch (err) {
          // Manejo de errores en el registro
          this.error = 'Hubo un problema al registrar el usuario';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos personalizados de TailwindCSS */
  </style>