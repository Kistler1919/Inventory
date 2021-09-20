<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="add-employee" class="btn btn-primary">Add New Employee</router-link>
    </div>
        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-10 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">List of all Employees</h1>
                  </div>
                  <hr>
                  <div class="container-fluid" id="container-wrapper">
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                  <form class="navbar-search mr-3">
                        <div class="input-group">
                            <input v-model="searchTerm" type="text" class="form-control bg-light border-1 small" placeholder="Search"
                            aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                            </div>
                        </div>
                        </form>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>E-mail</th>
                        <th>Salary</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filterSearchTerm" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td><img :src="employee.photo" id="profile"/></td>
                        <td>{{ employee.email }}</td>
                        <td>$ {{ employee.salary }}</td>
                        <td>
                          <div >
                            <router-link :to="{ name: 'pay-salary', params:{ id: employee.id } }" class="btn btn-sm btn-primary">Pay Salary</router-link>
                          </div>
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

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

<script>
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: 'login'})
    }
  },
  data() {
    return {
      employees: [],
      searchTerm: '',
    }
  },

  computed: {
    filterSearchTerm(){
      return this.employees.filter(employee => {
        return employee.name.match(this.searchTerm)
      })
    }
  },
  methods: {
    getEmployees() {
      axios.get('api/v1/employees')
        .then(({data}) => (this.employees = data))
        .catch(error => this.errors = error.response.data.errors)
    },
  },
  created() {
    this.getEmployees();
  }
}
</script>

<style>
  #profile {
    height: 40px;
    width: 40px;
    border-radius: 20px;
  }
</style>