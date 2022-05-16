<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Login</div>
            
            <div class="card-body">
                <ValidationObserver ref="form" v-slot="{ handleSubmit }">
                    <form @submit.prevent="handleSubmit(userLogin)">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"
                            >Email</label
                            >

                            <div class="col-md-6">
                            <ValidationProvider vid="email" name="Email" rules="required|email" v-slot="{errors}">
                                <input
                                    id="email"
                                    type="email"
                                    v-model="email"
                                    class="form-control"
                                    
                                >
                                <span class="invalid-feedback d-block">{{errors[0]}}</span>
                            </ValidationProvider>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                            for="password"
                            class="col-md-4 col-form-label text-md-end"
                            >Password</label
                            >

                            <div class="col-md-6">
                            <ValidationProvider vid="password" name="Password" rules="required" v-slot="{errors}">
                               
                            <input
                                id="password"
                                type="password"
                                v-model="password"
                                class="form-control"
                                name="password"
                            />
                            <span class="invalid-feedback d-block">{{errors[0]}}</span>
                            </ValidationProvider>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember"
                                />

                                <label class="form-check-label" for="remember">
                                Remember Me
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </ValidationObserver>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name:"LoginComponent",

  data(){
      return{
          email:'',
          password:''
      }
  },
  methods:{
      userLogin(){
          axios.post('/login', {
              email:this.email,
              password: this.password
          }).then((res) =>{
              location.href ='/dashboard';
          }).catch((error) =>{
              let errEmail = error.response.data.errors.email[0];
              let errPass = '';
              if(error.response.data.errors.password){
                errPass = error.response.data.errors.password[0];
              }
              this.$refs.form.setErrors({
                  email:[errEmail],
                  password :[errPass]
              });
          })
      }
  }
};
</script>
