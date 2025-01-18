import { createRouter, createWebHistory } from 'vue-router';
import App from '../App.vue'; // Pantalla de Login
import Register from '../components/Register.vue'; // Pantalla de Registro
import Profile from '../components/Profile.vue'; // Pantalla de Perfil

const routes = [
  { path: '/', component: App, name: 'login' },  // Página principal de login
  { path: '/register', component: Register, name: 'register' },
  { path: '/profile', component: Profile, name: 'profile' },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;