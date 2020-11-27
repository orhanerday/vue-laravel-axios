/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const {default: Axios} = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    data: {
        newCar: {'brand': '', 'model': ''},
        hasError: true,
        cars: [],
        mycar: [],
        modalShow: false,
        e_id: '',
        e_brand: '',
        e_model: '',
    },
    mounted: function mounted() {
        this.getCars();
    },
    methods: {
        getCars: function getCars() {
            var _this = this;
            axios.get('/getCars').then(function (response) {
                _this.cars = response.data;
            }).catch(error => {
                console.log("Get All: " + error);
            });
        },
        createCar: function createCar() {
            var input = this.newCar;
            var _this = this;
            if (input['brand'] == '' || input['model'] == '') {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios.post('/storeCar', input).then(function (response) {
                    _this.newCar = {'brand': '', 'model': ''}
                    _this.getCars();
                }).catch(error => {
                    console.log("Insert: " + error);
                });
            }
        },
        delVal(mycar) {
            this.mycar = mycar;
        },
        deleteCar: function deleteCar(car) {
            console.log(car)
            var _this = this;
            axios.post('/deleteCar/' + car.id).then(function (response) {
                _this.getCars();
            }).catch(error => {
                console.log("Delete car: " + error);
            });
        },
        setVal(val_id, val_brand, val_model) {
            this.e_id = val_id;
            this.e_brand = val_brand;
            this.e_model = val_model;
        },
        editCar: function () {
            this.modalShow = true;
            var _this = this;
            var id_val_1 = document.getElementById('e_id');
            var brand_val_1 = document.getElementById('e_brand');
            var model_val_1 = document.getElementById('e_model');
            var model = document.getElementById('myModal').value;
            axios.post('/editCars/' + id_val_1.value, {val_1: brand_val_1.value, val_2: model_val_1.value})
                .then(response => {
                    this.modalShow = false;
                    _this.getCars();
                });
        },
    }
});
