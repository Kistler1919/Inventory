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
                    <h1 class="h4 text-gray-700 mb-4">Password Recovery</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Your Email Address">
                    </div>
                    <div class="form-group">
                      <a href="#" class="btn btn-primary btn-block">Send</a>
                    </div>
                    <hr>
                  </form>
                  <!-- <hr> -->
                  <div class="text-center">
                    <router-link clrouter-linkss="font-weight-bold small" to="login">Back to login</router-link>
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

<script type="text/javascript">
export default {

}
</script>

<style type="text/css">

</style>