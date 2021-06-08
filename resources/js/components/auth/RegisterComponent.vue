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
                    <h1 class="h4 text-gray-700 mb-4">Registration Form</h1>
                  </div>
                  <form>
                    <div class="form-group">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Email Address">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                        placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <!-- <a class="font-weight-bold small" href="login.html">Already have an account?</a> -->
                    <router-link clrouter-linkss="font-weight-bold small" to="login">Already have an account? Login!</router-link>
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