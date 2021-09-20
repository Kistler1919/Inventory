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

let Suppliers = require('./components/suppliers/index.vue').default;
let AddSupplier = require('./components/suppliers/AddSupplier.vue').default;
let EditSupplier = require('./components/suppliers/EditSupplier.vue').default;

let Categories = require('./components/category/index.vue').default;
let AddCategory = require('./components/category/AddCategory.vue').default;
let EditCategory = require('./components/category/EditCategory.vue').default;

let Products = require('./components/products/index.vue').default;
let AddProduct = require('./components/products/AddProduct.vue').default;
let EditProduct = require('./components/products/EditProduct.vue').default;

let Expenses = require('./components/expenses/index.vue').default;
let AddExpense = require('./components/expenses/AddExpense.vue').default;
let EditExpense = require('./components/expenses/EditExpense.vue').default;

let Salary = require('./components/salary/employees.vue').default;
let PaySalary = require('./components/salary/create.vue').default;
let Salaries = require('./components/salary/index.vue').default;
let ViewSalary = require('./components/salary/view.vue').default;
let EditSalary = require('./components/salary/edit.vue').default;

export const routes = [
  { path: '/', component: HomeComponent, name: 'home'},
  { path: '/login', component: LoginComponent, name: 'login'},
  { path: '/logout', component: LogoutComponent, name: 'logout'},
  { path: '/register', component: RegisterComponent, name: 'register'},
  { path: '/forgot-password', component: ForgotPasswordComponent, name: 'forgotPassword'},

  // Employee CRUD routes
  { path: '/employees', component: Employees, name: 'employees'},
  { path: '/add-employee', component: AddEmployee, name: 'add-employee'},
  { path: '/edit-employee/:id', component: EditEmployee, name: 'edit-employee'},
  
  // Supplier CRUD routes
  { path: '/suppliers', component: Suppliers, name: 'suppliers'},
  { path: '/add-supplier', component: AddSupplier, name: 'add-supplier'},
  { path: '/edit-supplier/:id', component: EditSupplier, name: 'edit-supplier'},

  // Category CRUD routes
  { path: '/categories', component: Categories, name: 'categories'},
  { path: '/add-category', component: AddCategory, name: 'add-category'},
  { path: '/edit-category/:id', component: EditCategory, name: 'edit-category'},
  
  
  // Products CRUD routes
  { path: '/products', component: Products, name: 'products'},
  { path: '/add-product', component: AddProduct, name: 'add-product'},
  { path: '/edit-product/:id', component: EditProduct, name: 'edit-product'},
  
  // Expenses CRUD routes
  { path: '/expenses', component: Expenses, name: 'expenses'},
  { path: '/add-expense', component: AddExpense, name: 'add-expense'},
  { path: '/edit-expense/:id', component: EditExpense, name: 'edit-expense'},
  
  // Salary routes
  { path: '/alloc-salary', component: Salary, name: 'alloc-salary'},
  { path: '/salaries', component: Salaries, name: 'salaries'},
  { path: '/pay-salary/:id', component: PaySalary, name: 'pay-salary'},
  { path: '/view-salary/:id', component: ViewSalary, name: 'view-salary'},
  { path: '/edit-salary/:id', component: EditSalary, name: 'edit-salary'},
]