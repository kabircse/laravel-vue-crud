<template>
    <div class="container">
        <h2>Table Data</h2>
        <input @keyup="searchStudent()" v-model="search" name="search" type="text" class="form-control" />
        <table class="table table-bordered table-condensed table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in student.data">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.mobile }}</td>
                    <td>{{ row.address }}</td>
                  </tr>
                </tbody>
        </table>
        <h2>Add Student</h2>
        <form v-on:submit.prevent="addStudent()" class="form" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Type Name" v-model="addData.name" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="mobile" placeholder="Type Mobile No" v-model="addData.mobile" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" rows="10" cols="10" placeholder="Type Address" v-model="addData.address" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Add" class="btn btn-info" />
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
            data(){
                return {
                    student:{},
                    search: '',
                    addData:{ name : '', mobile: '', address: '' }
                }
            },
            created:function(){
                //this.fetchStudent();
                this.searchStudent();
            },

            methods:{
                fetchStudent(){
                    var vm = this;
                    axios.get('api/student').then(function(response){
                        Vue.set(vm.$data, 'student', response.data.data);
                    });
                },
                searchStudent(){
                    var vm = this;
                    axios.get(`api/student?search=${this.search}`).then(function(response){
                        Vue.set(vm.$data, 'student', response.data.data);
                    });
                },
                addStudent(){
                    var vm = this;
                    var inputData = vm.addData;
                    axios.post('api/student', inputData).then(function(response){
                        vm.addData = { name:"", mobile:"", address:""};
                        //console.log('success');
                    });
                }
            }
    }
</script>
