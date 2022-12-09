<template>
    <div>
        <h1>Report Pages</h1>
    </div>
</template>

<script>
export default {
    name: 'MiniPosReport',

    data() {
        return {
            
        };
    },

    mounted() {
        
    },

    methods: {
        
    },

    beforeRouteEnter (to, from, next) {
      if(window.Laravel.isLoggin){
          next();
      }else{
          window.location.href ="/login"
      }
    }
};
</script>

<style lang="scss" scoped>

</style>