<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/categories" class="btn btn-primary"> List all categories</router-link>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-4">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Add New Categories</h1>
                  </div>
                  <form class="user" @submit.prevent="addCategory">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        placeholder="Category Name"
                        v-model="form.name"
                      />
                      <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary ">
                          Submit
                        </button>
                      </div>
                      
                    </div>
                    
                  </form>
                  <div class="text-center">
                  
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
    if (!User.loggedIn()) {
      this.$router.push({ name: 'home' })
    }
  },
  data() {
    return {
      form: {
        name: null,
      },
      errors: {},
    }
  },
  methods: {
    addCategory() {
      axios.post('/api/v1/categories/', this.form)
        .then(() => {
          this.$router.push({ name: 'categories'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style type="text/css">
</style>