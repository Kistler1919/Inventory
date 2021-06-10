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
                  <form class="user" @submit.prevent="signup">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        placeholder="Full Name"
                        v-model="form.name"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        name="username"
                        id="username"
                        placeholder="Username"
                        v-model="form.username"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="Email Address"
                        v-model="form.email"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        placeholder="Password"
                        v-model="form.password"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        class="form-control"
                        name="confirm_password"
                        id="confirm_password"
                        placeholder="Confirm Password"
                        v-model="form.password_confirmation"
                      />
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Register
                      </button>
                    </div>
                    <!-- <hr />
                    <a href="#" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Register with
                      Facebook
                    </a> -->
                  </form>
                  <hr />
                  <div class="text-center">
                    <!-- <a class="font-weight-bold small" href="login.html">Already have an account?</a> -->
                    <router-link class="font-weight-bold small" to="login"
                      >Already have an account? Login!</router-link
                    >
                  </div>
                  <div class="text-center"></div>
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
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: 'home' })
    }
  },
  data() {
    return {
      form: {
        name: null,
        username: null,
        email: null,
        password: null,
        confirm_password: null,
      },
      errors: {},
    }
  },
  methods: {
    signup() {
      axios.post('api/v1/auth/signup', this.form)
        .then(res => {
          User.responseAfterLogin(res)
          Toast.fire({
            icon: 'success',
            title: 'Registered successfully',
          })
          this.$router.push({ name: 'home' })
        })
        .catch((error) => (this.errors = error.response.data.errors))
        
    },
  },
}
</script>

<style type="text/css">
</style>