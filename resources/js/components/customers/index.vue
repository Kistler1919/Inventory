<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="add-customer" class="btn btn-primary">Add New Customers</router-link>
    </div>
        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-10 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">List of all Customers</h1>
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
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th>Address</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filterSearchTerm" :key="customer.id">
                        <td>{{ customer.name }}</td>
                        <td><img :src="customer.photo" id="profile"/></td>
                        <td>{{ customer.phone }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.address }}</td>
                        <td>
                          <div >
                            <router-link :to="{ name: 'edit-customer', params:{ id: customer.id } }" class="btn btn-sm btn-primary"><i class="fas fa-edit text-gray-100"></i></router-link>
                            <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash text-gray-100"></i></a>
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
      customers: [],
      searchTerm: '',
    }
  },

  computed: {
    filterSearchTerm(){
      return this.customers.filter(customer => {
        return customer.name.toUpperCase().match(this.searchTerm.toUpperCase())
      })
    }
  },
  methods: {
    getCustomers() {
      axios.get('api/v1/customers')
        .then(({data}) => (this.customers = data))
        .catch(error => this.errors = error.response.data.errors)
    },
    deleteCustomer(id) {
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
          axios.delete('api/v1/customers/'+id)
            .then(() => {
              this.customers = this.customers.filter(customer => {
                return customer.id != id
              })
            })
            .catch(() => {
              this.$router.push({ name: 'customers'})
            })
          Swal.fire(
            'Deleted!',
            'Customer record has been deleted.',
            'success'
          )
        }
      })
    }
  },
  created() {
    this.getCustomers();
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