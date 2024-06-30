<template>
     <AuthenticatedLayout>


        <ul class="nav nav-underline mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#create_page" role="tab" aria-controls="create_page" aria-expanded="true" aria-selected="true">
                <span>Buat RPPH</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="draf-tab" data-bs-toggle="tab" href="#draf" role="tab" aria-controls="draf" aria-selected="false" tabindex="-1">
                <span>Draf RPPH</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="simpan-tab" data-bs-toggle="tab" href="#simpan" role="tab" aria-controls="simpan" aria-selected="false" tabindex="-1">
                <span>Simpan RPPH</span>
                </a>
            </li>
        </ul>


        <div class="tab-content tabcontent-border" id="myTabContent">

            <div role="tabpanel" class="tab-pane fade active show" id="create_page" aria-labelledby="create_page-tab">
                <!-- card -->
                    <div class="w-full card p-4">
                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Buat kegiatan RPPH</h5>
                                <p class="card-subtitle mb-0">
                                    
                                </p>
                                
                            </div>
                            <button @click="addToDrafHandler" class=" btn btn-outline-primary">
                                Tambah ke draf
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64"><path fill="currentColor" d="M32 2C15.432 2 2 15.432 2 32c0 16.568 13.432 30 30 30s30-13.432 30-30C62 15.432 48.568 2 32 2m1.693 46V37.428H15V27.143h18.693V16L49 32z"/></svg>
                            </button>
                        </div>
                        <!-- end header -->
    
    
                        <!-- body section -->
                        <div class="w-full row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                    v-model="data.name"
                                    />
                                    <label for="tb-fname">Nama Kegiatan</label>
                                    <!-- <span class="text-danger" v-if="errors['tema']" >isi tema</span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                    v-model="data.start_time"
                                    />
                                    <label for="tb-fname">Jam Mulai</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                    v-model="data.end_time"
                                    />
                                    <label for="tb-fname">Jam Selesai</label>
                                </div>
                            </div>
                        <div class="row pt-3 border-top">
                            <p>Langkah kegiatan</p>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="inputLangkah"
                                        type="text"
                                        class="form-control"
                                        id="tb-fname"
                                        placeholder="tema"
                                    />
                                    <label for="tb-fname">Langkah - Langkah Kegiatan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button @click="addLangkah" class="btn btn-primary">Tambah daftar kegiatan</button>
                            </div>
                             
                            <!-- list capaian pembelajaran -->
                            <div v-for="(item, index) in data.langkah" :key="index">
                                <div class="col-md-3 btn d-flex btn-light-primary w-100 d-block text-primary font-medium mb-2">
                                    {{ item }} 
                                    <span @click="deleteLangkah(index)" class="badge ms-auto bg-danger">delete</span>
                                </div>
                            </div>


                        </div>
                        </div>
                        <!-- end body section -->
                    </div>
            </div>


            <div class="tab-pane fade" id="draf" role="tabpanel" aria-labelledby="draf-tab">
                <!-- card -->
                    <div class="w-full card p-4">
                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Daftar Kegiatan</h5>
                                <p class="card-subtitle mb-0">
                                    
                                </p>                    
                            </div>
                        </div>
                        <!-- end header -->

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Nama kegiatan</td>
                                    <td>Jam Mulai</td>
                                    <td>Jam Selesai</td>
                                    <td>Langkah Kegiatan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in form" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.start_time}}</td>
                                    <td>{{item.end_time}}</td>
                                    <td>
                                        <ul v-for="(item, index) in item.langkah" :key="index">
                                            <li>- {{ item }}</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>


            <div role="tabpanel" class="tab-pane fade active" id="simpan" aria-labelledby="simpan-tab">
                <div class="w-full card p-4">
                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Daftar Kegiatan</h5>
                                <p class="card-subtitle mb-0">
                                    
                                </p>                    
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>Tanggal : {{ now }}</p>
                        </div>
                        <div class="form-check mb-3">
                            <input id="checkBox" type="checkbox" class="form-check-input">
                            <label for="checkBox" class="form-check-label">Data yang saya tuliskan sudah benar</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button @click="postHandler" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </div>
            </div>
        
        
        </div>

     </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Guru/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
import Toast from '@/Toast.js';
import moment from 'moment';

export default {
    props:{
        rpph_id: Number
    },
    components:{
        Link,AuthenticatedLayout
    },
    data() {
        return {
            inputLangkah:null,
            form:[],
            now: moment(),
            data:{
                name:null,
                start_time:null,
                end_time:null,
                langkah:[]
            }
        }
    },
    methods: {
        addLangkah(){
            if (this.inputLangkah != null) {
                this.data.langkah.push(this.inputLangkah)
                this.inputLangkah = null;
            }else{
                Toast.fire({
                    'title' : 'Isi data langkah - langkah kegiatan',
                    'icon' : 'error'
                })
            }
        },
        addToDrafHandler(){
            if (this.data.name != null && this.data.start_time != null 
                && this.data.end_time != null && this.data.langkah.length > 0) {
                
                this.form.push(this.data);
                this.resetData();

            }else{
                Toast.fire({
                    'title' : 'Lengkapi data dibawah',
                    'icon' : 'error'
                })
            }
        },
        resetData(){
            this.data = {
                name:null,
                start_time:null,
                end_time:null,
                langkah:[]
            }
        },
        resetForm(){
            this.form = []
        },
        async postHandler(){
            try {
                let request = await axios.post(route('rpph.kegiatan.store',{
                    rpphId : this.rpph_id
                }),{
                    data : this.form
                });

                Toast.fire({
                    'icon' : 'success',
                    'title' : 'Berhasil membuat kegiatan'
                });
            } catch (error) {
                console.log(error)
                Toast.fire({
                    'icon' : 'error',
                    'title' : 'Gagal membuat kegiatan'
                });
            }
        }
    },
}
</script>