<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-4">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Login Form</h1>
                  </div>
                  <form class="user" @submit.prevent="login">
                    <div class="form-group">
                      <input type="email" 
                        class="form-control" 
                        name="email" 
                        id="email" 
                        aria-describedby="emailHelp"
                        placeholder="Email Address"
                        v-model="form.email"
                      >
                    </div>
                    <div class="form-group">
                      <input 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        id="password" 
                        placeholder="Password"
                        v-model="form.password"
                      >
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <router-link class="font-weight-bold small" to="register">Create an Account!</router-link>
                  </div>
                  <div class="text-center">
                    <router-link class="font-weight-bold small" to="forgot-password">Forgot your password?</router-link>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">

  export default {
    data(){
      return {
        form: {
          email: null,
          password: null,
        }
      }
    },
    methods: {
      login(){
        axios.post('api/v1/auth/login', this.form)
          .then(res => User.responseAfterLogin(res))
          .catch(err => console.log(err))
      }
    }
  }

</script>

<style type="text/css">

</style>