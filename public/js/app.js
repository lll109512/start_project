new Vue({
    el:"#app",
    data:{
        me:'123'
    },
    computed:{
        reverse(){
            return this.me.split('').reverse().join('')
        }
    }

});
Vue.config.devtools = true;
