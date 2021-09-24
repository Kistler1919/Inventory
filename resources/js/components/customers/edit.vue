<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/customers" class="btn btn-primary"> List all customers</router-link>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Edit/Update Customer Details</h1>
                  </div>
                  <form class="user" @submit.prevent="updateCustomer" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Customer Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            placeholder="Full Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>E-mail</b></label>
                          <input
                            type="email"
                            class="form-control"
                            name="email"
                            id="email"
                            placeholder="E-mail"
                            v-model="form.email"
                          />
                          <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                      </div>
                      
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Phone</b></label>
                          <input
                            type="text"
                            class="form-control"
                            name="phone"
                            id="phone"
                            placeholder="Phone"
                            v-model="form.phone"
                          />
                          <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Address</b></label>
                          <input
                            type="address"
                            class="form-control"
                            name="address"
                            id="address"
                            placeholder="Address"
                            v-model="form.address"
                          />
                          <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-10">
                          <div class="custom-file">
                            <input 
                              type="file" 
                              class="custom-file-input" 
                              id="customFile"
                              @change="onFileSelected"
                            >
                            <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <img :src="form.photo" style="height: 40px; width: 40px;">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="row justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary ">
                          Save Customer
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
        name: '',
        email: '',
        address: '',
        phone: '',
        photo: '',
        new_profile: '',
      },
      errors: {},
    }
  },
  created() {
    let id = this.$route.params.id
  	axios.get('/api/v1/customers/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))
  },
  methods: {
    onFileSelected(event) {
      let file = event.target.files[0];
      if (file.size > 10485760) {  // 10485760
        Notification.image_validation()
      } else {
        let reader = new FileReader()
        reader.onload = event => {
          this.form.new_profile = event.target.result
        };
        reader.readAsDataURL(file);
      }
    },
    updateCustomer() {
      let id = this.$route.params.id
      axios.patch('/api/v1/customers/'+id, this.form)
        .then(() => {
          this.$router.push({ name: 'customers'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    },
  },
}
</script>

<style>

</style>