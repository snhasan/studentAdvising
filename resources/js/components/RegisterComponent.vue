<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form>
                            

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" v-model="name" class="form-control" name="name"  required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" v-model="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" v-model="password" class="form-control" name="password" required autocomplete="new-password">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" v-model="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click.prevent="submitRegister">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
 input{
     background-color: rgba(0,0,0,.2);
     border:none;
     color:#fff;
 }
</style>

<script>
import axios from "axios"

    export default {
        name: "RegisterComponent",
        data(){
            return {
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
            }

        },
        mounted(){
            
        },
        methods:{
            submitRegister(){
                axios.post('/register',{
                name:this.name,
                email:this.email,
                password:this.password,
                password_confirmation:this.password_confirmation
                }).then((res)=>{
                    location.href ='/dashboard';
                }).catch((error) =>{
                    console.log('error');
                })
            }
        }
    }
</script>
