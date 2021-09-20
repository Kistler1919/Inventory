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
                    <h1 class="h4 text-gray-700 mb-4">Make Payment</h1>
                  </div>
                  <form class="user" @submit.prevent="makePayment" >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Full Name</b></label>
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
                          <label for="exampleFormControlSelect1"><b>Month</b></label>
                          <select v-model="form.salary_month" placeholder="Month" class="form-control" id="exampleFormControlSelect1">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                          <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleFormControlSelect1"><b>Salary</b></label>
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
                      <div class="row justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary ">
                          Submit Payment
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
        salary_month: '',
        salary: '',
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
    makePayment() {
      let id = this.$route.params.id
      axios.post('/api/v1/salary/paid/'+id, this.form)
        .then(() => {
          this.$router.push({ name: 'alloc-salary'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    },
  },
}
</script>

<style>

</style>