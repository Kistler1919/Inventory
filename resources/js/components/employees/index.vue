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
                    <h1 class="h4 text-gray-700 mb-4">Employees List</h1>
                  </div>
                  <hr>
                  <div class="container-fluid" id="container-wrapper">
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DataTables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">DataTables</li>
            </ol>
          </div> -->

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
                        <th>Start date</th>
                        <th>Salary</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filterSearchTerm" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td><img :src="employee.photo" id="profile"/></td>
                        <td>{{ employee.email }}</td>
                        <td>{{ employee.date_joined }}</td>
                        <td>$ {{ employee.salary }}</td>
                        <td>
                          <div >
                            <router-link :to="{ name: 'edit-employee', params:{ id: employee.id } }" class="btn btn-sm btn-primary"><i class="fas fa-edit text-gray-100"></i></router-link>
                            <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash text-gray-100"></i></a>
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
    deleteEmployee(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This action is irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('api/v1/employees/'+id)
            .then(() => {
              this.employees = this.employees.filter(employee => {
                return employee.id != id
              })
            })
            .catch(() => {
              this.$router.push({ name: 'employees'})
            })
          Swal.fire(
            'Deleted!',
            'Employee record has been deleted.',
            'success'
          )
        }
      })
    }
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