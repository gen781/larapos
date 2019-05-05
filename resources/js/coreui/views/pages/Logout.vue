<template>
  
</template>

<script>
    export default {
        mounted () {
            axios.post('/api/logout','',{
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                console.log(response.data)
            }).catch(error => {
                console.log(error)
            });
            this.$store.commit('logoutUser')
            this.$router.push({ name: 'Login' })
        }
    }
</script>