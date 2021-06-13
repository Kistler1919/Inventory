// Auth Routes
let LoginComponent = require('./components/auth/LoginComponent.vue').default;
let RegisterComponent = require('./components/auth/RegisterComponent.vue').default;
let ForgotPasswordComponent = require('./components/auth/ForgotPasswordComponent.vue').default;
let LogoutComponent = require('./components/auth/LogoutComponent.vue').default;

// Protected Routes
let HomeComponent = require('./components/HomeComponent.vue').default;
let AddEmployee = require('./components/employees/AddEmployee.vue').default;
let Employees = require('./components/employees/index.vue').default;
let EditEmployee = require('./components/employees/EditEmployee.vue').default;

export const routes = [
  { path: '/', component: HomeComponent, name: 'home'},
  { path: '/login', component: LoginComponent, name: 'login'},
  { path: '/logout', component: LogoutComponent, name: 'logout'},
  { path: '/register', component: RegisterComponent, name: 'register'},
  { path: '/forgot-password', component: ForgotPasswordComponent, name: 'forgotPassword'},


  { path: '/employees', component: Employees, name: 'employees'},
  { path: '/add-employee', component: AddEmployee, name: 'add-employee'},
  { path: '/edit-employee/:id', component: EditEmployee, name: 'edit-employee'},
]