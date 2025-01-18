import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';

// Importa los componentes de las páginas
import Register from './Register.vue';
import Profile from './Profile.vue';

// Configura las rutas
const routes = [
  { path: '/', component: App, name: 'login' },  // Ruta para el login
  { path: '/register', component: Register, name: 'register' }, // Ruta para el registro
  { path: '/profile', component: Profile, name: 'profile' }, // Ruta para el perfil
];

// Crea el router
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Crea la aplicación Vue y usa Vue Router
createApp(App)
  .use(router) // Usa el router en la aplicación
  .mount('#app'); // Monta la aplicación en el elemento con id 'app'