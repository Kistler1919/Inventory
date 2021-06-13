<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/employees" class="btn btn-primary"> List all employees</router-link>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Edit/Update Employee Details</h1>
                  </div>
                  <form class="user" @submit.prevent="updateEmployee" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
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
                          <input
                            type="text"
                            class="form-control"
                            name="username"
                            id="username"
                            placeholder="Username"
                            v-model="form.username"
                          />
                          <small class="text-danger" v-if="errors.username">{{ errors.username[0] }}</small>
                        </div>
                      </div>
                      
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
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
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
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
                        <input
                          type="text"
                          class="form-control"
                          name="salary"
                          id="salary"
                          placeholder="Salary"
                          v-model="form.salary"
                        />
                        <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                         <input
                          type="date"
                          class="form-control"
                          name="date_joined"
                          id="date_joined"
                          placeholder="Date Joined"
                          v-model="form.date_joined"
                        />
                        <small class="text-danger" v-if="errors.date_joined">{{ errors.date_joined[0] }}</small>
                      </div>
                      <div class="col-md-6">
                         <input
                          type="text"
                          class="form-control"
                          name="nid"
                          id="nid"
                          placeholder="NID"
                          v-model="form.nid"
                        />
                        <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
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
                          Save Employee
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
        username: '',
        email: '',
        address: '',
        phone: '',
        salary: '',
        date_joined: '',
        nid: '',
        photo: '',
        new_profile: '',
      },
      errors: {},
    }
  },
  created() {
    let id = this.$route.params.id
  	axios.get('/api/v1/employees/'+id)
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
    updateEmployee() {
      let id = this.$route.params.id
      axios.patch('/api/v1/employees/'+id, this.form)
        .then(() => {
          this.$router.push({ name: 'employees'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    },
  },
}
</script>

<style>

</style>