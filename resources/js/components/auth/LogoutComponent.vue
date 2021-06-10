<template>
  
</template>

<script>
export default {
  created(){
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    Toast.fire({
      icon: 'success',
      title: 'Logged out'
    })
    this.$router.push({ name: 'login'})
  }
}
</script>

<style>

</style>