// Auth Routes
let LoginComponent = require('./components/auth/LoginComponent.vue').default;
let RegisterComponent = require('./components/auth/RegisterComponent.vue').default;
let ForgotPasswordComponent = require('./components/auth/ForgotPasswordComponent.vue').default;
let LogoutComponent = require('./components/auth/LogoutComponent.vue').default;

// Protected Routes
let HomeComponent = require('./components/HomeComponent.vue').default;

export const routes = [
  { path: '/', component: HomeComponent, name: 'home'},
  { path: '/login', component: LoginComponent, name: 'login'},
  { path: '/logout', component: LogoutComponent, name: 'logout'},
  { path: '/register', component: RegisterComponent, name: 'register'},
  { path: '/forgot-password', component: ForgotPasswordComponent, name: 'forgotPassword'},
]