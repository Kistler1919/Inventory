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
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Email Address">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <a href="#" class="btn btn-primary btn-block">Login</a>
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
                    <router-link clrouter-linkss="font-weight-bold small" to="register">Create an Account!</router-link>
                  </div>
                  <div class="text-center">
                    <router-link clrouter-linkss="font-weight-bold small" to="forgot-password">Forgot your password?</router-link>
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

}
</script>

<style type="text/css">

</style>