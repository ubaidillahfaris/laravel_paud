<template>
    <GuestLayout>
        <Head title="Register" />

        <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
          <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
              <div class="card mb-0">
                <div class="card-body">
                  <a href="./index.html" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                    <ApplicationLogo></ApplicationLogo>
                  </a>
                  <p class="h4 fw-bold">Register</p>
                  <p class="">
                    <small>
                        Daftarkan akun anda untuk menikmati layanan dari Paudnesia. 
                        Aplikasi bisa digunakan untuk Anda yang mempunyai anak yang bersekolah di tempat yang berbeda.
                    </small>
                  </p>
                  <form class="mt-4">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" v-model="form.name" id="exampleInputtext" aria-describedby="textHelp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" v-model="form.email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" v-model="form.password" id="exampleInputPassword1">
                    </div>     
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" v-model="form.password_confirmation" id="exampleInputPassword1">
                    </div>                    
                    <button type="button" @click="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
                    <div class="d-flex align-items-center">
                      <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
                      <a class="text-primary fw-medium ms-2" :href="route('login')">Sign In</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import axios from 'axios';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = async () => {

  const request = await axios.post(route('register'),form)
  const response = request.data;

  console.log(response);
  
};
</script>