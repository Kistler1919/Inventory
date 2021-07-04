<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/expenses" class="btn btn-primary"> List all expenses</router-link>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-4">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Add New Expense</h1>
                  </div>
                  <form class="user" @submit.prevent="addExpense">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1"><b>Expense Details</b></label>
                      <textarea 
                        class="form-control" 
                        id="exampleFormControlTextarea1" 
                        rows="3"
                        v-model="form.details"
                      />
                      <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1"><b>Amount</b></label>
                      <input
                        type="text"
                        class="form-control"
                        name="amount"
                        id="amount"
                        placeholder="1200"
                        v-model="form.amount"
                      />
                      <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1"><b>Date</b></label>
                      <input
                        type="date"
                        class="form-control"
                        name="date"
                        id="date"
                        placeholder="Date"
                        v-model="form.date"
                      />
                      <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
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
        details: null,
        amount: null,
        date: null,
      },
      errors: {},
    }
  },
  methods: {
    addExpense() {
      axios.post('/api/v1/expenses/', this.form)
        .then(() => {
          this.$router.push({ name: 'expenses'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style type="text/css">
</style>