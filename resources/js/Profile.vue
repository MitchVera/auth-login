<template>
    <div v-if="user" class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="max-w-sm mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold mb-4">Perfil</h2>
  
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Nombre</label>
          <p class="mt-1">{{ user.name }}</p>
        </div>
  
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Apellido</label>
          <p class="mt-1">{{ user.lastname }}</p>
        </div>
  
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Teléfono</label>
          <p class="mt-1">{{ user.phone }}</p>
        </div>
  
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
          <p class="mt-1">{{ user.email }}</p>
        </div>
  
        <div class="mt-4 text-center">
          <button
            @click="logout"
            class="w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600"
          >
            Cerrar Sesión
          </button>
        </div>
      </div>
    </div>
  
    <!-- Si no hay usuario, se redirige al login -->
    <div v-else>
      <p>Cargando perfil...</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: JSON.parse(localStorage.getItem('user')) || null,
      };
    },
    methods: {
      logout() {
        // Eliminar usuario y token del localStorage y redirigir al login
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        this.$router.push({ name: 'login' });
      },
    },
    mounted() {
      // Si no hay token o usuario, redirige al login
      if (!localStorage.getItem('token')) {
        this.$router.push({ name: 'login' });
      }
    },
  };
  </script>
  
  <style scoped>
  /* Estilos personalizados de TailwindCSS */
  </style>