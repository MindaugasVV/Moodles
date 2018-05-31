window.Vue = require('vue');

let studentsDataModel = {
    Students:[]
};

const app = new Vue({
    el: '#wrapper',
    data:studentsDataModel,
    methods:{
        onChangeList(e){
            axios.post('/filterSelectList/' + e.target.value).then(response => app.Students = response.data);
        }
    },
});

