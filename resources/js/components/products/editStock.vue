<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/stock" class="btn btn-primary">Go Back</router-link>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Edit/Update Product Stocks</h1>
                  </div>
                  <form class="user" @submit.prevent="updateStock" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label for="exampleFormControlSelect1">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            name="name"
                            disabled
                            id="name"
                            placeholder="Product Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                      </div>
                      <div class="form-row mt-3">
                        <div class="col-md-12">
                            <label for="exampleFormControlSelect1">Quantity</label>
                            <input
                            type="text"
                            class="form-control"
                            name="quantity"
                            id="quantity"
                            placeholder="Quantity"
                            v-model="form.quantity"
                          />
                          <small class="text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
                        </div>
                      </div>
                      
                    </div>
                    
                    <div class="form-group">
                      <div class="row justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary ">
                          Update Stock
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

<script>
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: 'home' })
    }
  },
  data() {
    return {
      form: {
        quantity: '',
      },
      errors: {},
    }
  },
  created() {
    let id = this.$route.params.id
  	axios.get('/api/v1/products/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))
  },
  methods: {
    updateStock() {
      let id = this.$route.params.id
      axios.post('/api/v1/stock/update/'+id, this.form)
        .then(() => {
          this.$router.push({ name: 'stocks'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    },
  },
}
</script>

<style>

</style>