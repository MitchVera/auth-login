<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-sm mx-auto p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-center text-2xl font-bold mb-4">Iniciar Sesión</h2>

      <!-- Formulario de Login -->
      <form @submit.prevent="login">
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
          class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"
        >
          Iniciar Sesión
        </button>
      </form>

      <!-- Enlace a registro -->
      <div class="mt-4 text-center">
        <p>No tienes cuenta? <router-link to="/register" class="text-blue-500">Regístrate</router-link></p>
      </div>
    </div>

        <!-- Aquí se renderizarán las rutas de Vue Router -->
        <router-view></router-view>
  </div>
  
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: null,
    };
  },
  methods: {
    async login() {
      try {
        // Llamada a la API de login
        const response = await axios.post('http://localhost:8000/api/login', {
          email: this.email,
          password: this.password,
        });

        // Guardar datos del usuario y token en localStorage
        localStorage.setItem('user', JSON.stringify(response.data.user));
        localStorage.setItem('token', response.data.token);

        // Redirigir al perfil después de iniciar sesión
        this.$router.push({ name: 'profile' });
      } catch (err) {
        // Manejo de errores en caso de credenciales incorrectas
        this.error = 'Credenciales inválidas';
      }
    },
  },
  mounted() {
    // Redirigir al perfil si el usuario ya tiene sesión activa
    if (localStorage.getItem('token')) {
      this.$router.push({ name: 'profile' });
    }
  },
};
</script>

<style scoped>
/* Estilos personalizados de TailwindCSS */
</style>