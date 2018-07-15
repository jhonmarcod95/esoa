var vm = new Vue({
    el: '#app',
    data: {
        statement_period: ['2018-04-30', '2018-04-30'], //request
        statement_amount: [] //response
    },
    methods: {
    },
    computed :{
    },
    watch : {
        statement_period:function(val) {
            axios.get('/esoa/public/statement/compute/' + val).then(
                response => this.statement_amount = [response.data]
            );
        }
    },
});
