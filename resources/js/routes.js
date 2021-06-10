let LoginComponent = require('./components/auth/LoginComponent.vue').default;
let RegisterComponent = require('./components/auth/RegisterComponent.vue').default;
let ForgotPasswordComponent = require('./components/auth/ForgotPasswordComponent.vue').default;
let HomeComponent = require('./components/HomeComponent.vue').default;

export const routes = [
  { path: '/', component: HomeComponent, name: 'home'},
  { path: '/login', component: LoginComponent, name: 'login'},
  { path: '/register', component: RegisterComponent, name: 'register'},
  { path: '/forgot-password', component: ForgotPasswordComponent, name: 'forgotPassword'},
]