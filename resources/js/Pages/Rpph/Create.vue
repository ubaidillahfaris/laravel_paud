<template>
   <AuthenticatedLayout>
     <!-- card -->
     <div class="w-full card p-4">
        <!-- card header -->
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">Buat data RPPH</h5>
                <p class="card-subtitle mb-0">
                    
                </p>
                <div class="py-2"></div>
                
            </div>
        </div>

        <!-- body -->
        <div class="w-full row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Kelas</label>
                    <select v-model="form.kelas_id" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected hidden :value="null">Pilih kelas...</option>
                        <option value="teks" v-for="(item, index) in kelas" :value="item.id" :key="index"> {{ item.nama }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    type="text"
                    class="form-control"
                    id="tb-fname"
                    placeholder="tema"
                    />
                    <label for="tb-fname">Tema</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    type="text"
                    class="form-control"
                    id="tb-fname"
                    placeholder="tema"
                    />
                    <label for="tb-fname">Sub Tema</label>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <small>Tanggal</small>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    type="date"
                    class="form-control"
                    id="tb-fname"
                    placeholder="tema"
                    />
                    <label for="tb-fname">Tanggal Mulai</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    type="date"
                    class="form-control"
                    id="tb-fname"
                    placeholder="tema"
                    />
                    <label for="tb-fname">Tanggal Berakhir</label>
                </div>
            </div>
            <div class="d-inline-flex align-items-center col-md-12 mb-3">
                <div class="mx-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="32" class="text-primary" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128m95.8 32.6L272 480l-32-136l32-56h-96l32 56l-32 136l-47.8-191.4C56.9 292 0 350.3 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-72.1-56.9-130.4-128.2-133.8"/></svg>
                </div>
                <div class="col">
                    <small>Guru</small>
                    <p>{{ guru.name }}</p>
                </div>

            </div>
            

            <!-- capaian pembelajaran form -->
                <div class="col-md-12 mb-3 border-top pt-3">
                    <div class="col mb-3">
                        <small>Capaian Pembelajaran</small>
                    </div>
                    
                    <!-- input capaian pembelajaran -->
                    <div class="row align-items-center">
                        <div class="col-md-6 form-floating mb-3">
                            <div class="form-floating">
                                <input
                                    v-model="capaianPembelajaranInput"
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                />
                                <label for="tb-fname">Input capaian pembelajaran</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button @click="addCapaianPembelajaran" class="btn btn-primary m-2">Tambah</button>
                            <button @click="clearCapaianPembelajaran" class="btn btn-danger m-2">Clear</button>
                        </div>
                    </div>

                    <!-- list capaian pembelajaran -->
                    <div v-for="(item, index) in form.capaian_pembelajaran" :key="index">
                        <div class="col-md-3 btn d-flex btn-light-primary w-100 d-block text-primary font-medium mb-2">
                            {{ item }} 
                            <span @click="deleteCapaianPembelajaran(index)" class="badge ms-auto bg-danger">delete</span>
                        </div>
                    </div>
                </div>
            <!-- end capaian pembelajaran form -->
             

            <!-- tujuan pembelajaran form -->
            <div class="col-md-12 mb-3 border-top pt-3">
                    <div class="col mb-3">
                        <small>Tujuan Pembelajaran</small>
                    </div>
                    
                    <!-- input tujuan pembelajaran -->
                    <div class="row align-items-center">
                        <div class="col-md-6 form-floating mb-3">
                            <div class="form-floating">
                                <input
                                    v-model="tujuanPembelajaranInput"
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                />
                                <label for="tb-fname">Input tujuan pembelajaran</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button @click="addTujuanPembelajaran" class="btn btn-primary m-2">Tambah</button>
                            <button @click="clearTujuanPembelajaran" class="btn btn-danger m-2">Clear</button>
                        </div>
                    </div>

                    <!-- list tujuan pembelajaran -->
                    <div v-for="(item, index) in form.tujuan_pembelajaran" :key="index">
                        <div class="col-md-3 btn d-flex btn-light-primary w-100 d-block text-primary font-medium mb-2">
                            {{ item }} 
                            <span @click="deleteTujuanPembelajaran(index)" class="badge ms-auto bg-danger">delete</span>
                        </div>
                    </div>
                </div>
            <!-- end tujuan pembelajaran form -->


            <!-- metode form -->
            <div class="col-md-12 mb-3 border-top pt-3">
                    <div class="col mb-3">
                        <small>Metode</small>
                    </div>
                    
                    <!-- input metode -->
                    <div class="row align-items-center">
                        <div class="col-md-6 form-floating mb-3">
                            <div class="form-floating">
                                <input
                                    v-model="metodeInput"
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                />
                                <label for="tb-fname">Input metode</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button @click="addMetodePembelajaran" class="btn btn-primary m-2">Tambah</button>
                            <button @click="clearMetodePembelajaran" class="btn btn-danger m-2">Clear</button>
                        </div>
                    </div>

                    <!-- list metode -->
                    <div v-for="(item, index) in form.metode" :key="index">
                        <div class="col-md-3 btn d-flex btn-light-primary w-100 d-block text-primary font-medium mb-2">
                            {{ item }} 
                            <span @click="deleteMetodePembelajaran(index)" class="badge ms-auto bg-danger">delete</span>
                        </div>
                    </div>
                </div>
            <!-- end metode form -->


            <!-- sumber belajar form -->
            <div class="col-md-12 mb-3 border-top pt-3">
                    <div class="col mb-3">
                        <small>Sumber Belajar</small>
                    </div>
                    
                    <!-- input sumber belajar -->
                    <div class="row align-items-center">
                        <div class="col-md-6 form-floating mb-3">
                            <div class="form-floating">
                                <input
                                    v-model="sumberBelajarInput"
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                />
                                <label for="tb-fname">Input sumber belajar</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button @click="addSumberBelajar" class="btn btn-primary m-2">Tambah</button>
                            <button @click="clearSumberBelajar" class="btn btn-danger m-2">Clear</button>
                        </div>
                    </div>

                    <!-- list sumber belajar -->
                    <div v-for="(item, index) in form.sumber_belajar" :key="index">
                        <div class="col-md-3 btn d-flex btn-light-primary w-100 d-block text-primary font-medium mb-2">
                            {{ item }} 
                            <span @click="deleteSumberBelajar(index)" class="badge ms-auto bg-danger">delete</span>
                        </div>
                    </div>
                </div>
            <!-- end sumber belajar form -->



            <!-- alat bahan form -->
            <div class="col-md-12 mb-3 border-top pt-3">
                    <div class="col mb-3">
                        <small>Alat dan bahan</small>
                    </div>
                    
                    <!-- input alat bahan -->
                    <div class="row align-items-center">
                        <div class="col-md-6 form-floating mb-3">
                            <div class="form-floating">
                                <input
                                    v-model="alatBahanInput"
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="tema"
                                />
                                <label for="tb-fname">Input alat dan bahan</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button @click="addAlatBahan" class="btn btn-primary m-2">Tambah</button>
                            <button @click="clearAlatBahan" class="btn btn-danger m-2">Clear</button>
                        </div>
                    </div>

                    <!-- list sumber belajar -->
                    <div v-for="(item, index) in form.alat_bahan" :key="index">
                        <div class="col-md-3 btn d-flex btn-light-primary w-100 d-block text-primary font-medium mb-2">
                            {{ item }} 
                            <span @click="deleteAlatBahan(index)" class="badge ms-auto bg-danger">delete</span>
                        </div>
                    </div>
                </div>
            <!-- end alat bahan form -->
             <div class="col-md-12">
                <button class="btn btn-primary">Simpan</button>
             </div>
        </div>

    </div>
   </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Guru/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
export default {
    components:{
        Link,AuthenticatedLayout
    },
    props:{
        guru:Object,
        kelas:Array
    },
    data() {
        return {
            capaianPembelajaranInput:null,
            tujuanPembelajaranInput:null,
            metodeInput:null,
            sumberBelajarInput:null,
            alatBahanInput:null,
            form:useForm({
                'kelas_id':null,
                'tema' : null,
                'sub_tema' : null,
                'start_date' : null,
                'end_date' : null,
                'guru_id' : this.guru.id,
                'capaian_pembelajaran': [],
                'tujuan_pembelajaran': [],
                'metode': [],
                'sumber_belajar': [],
                'alat_bahan': [],
            })
        }
    },
    mounted() {
      
    },
    methods:{
        addCapaianPembelajaran(){
            this.form.capaian_pembelajaran.push(this.capaianPembelajaranInput);
            this.capaianPembelajaranInput = null;
        },
        deleteCapaianPembelajaran(index){
            this.form.capaian_pembelajaran.splice(index, 1);
        },
        clearCapaianPembelajaran(){
            this.form.capaian_pembelajaran = [];
        },
        addTujuanPembelajaran(){
            this.form.tujuan_pembelajaran.push(this.capaianPembelajaranInput);
            this.capaianPembelajaranInput = null;
        },
        deleteTujuanPembelajaran(index){
            this.form.tujuan_pembelajaran.splice(index, 1);
        },
        clearTujuanPembelajaran(){
            this.form.tujuan_pembelajaran = [];
        },
        addMetodePembelajaran(){
            this.form.metode.push(this.metodeInput);
            this.metodeInput = null;
        },
        deleteMetodePembelajaran(index){
            this.form.metode.splice(index, 1);
        },
        clearMetodePembelajaran(){
            this.form.metode = [];
        },
        addSumberBelajar(){
            this.form.sumber_belajar.push(this.sumberBelajarInput);
            this.sumberBelajarInput = null;
        },
        deleteSumberBelajar(index){
            this.form.sumber_belajar.splice(index, 1);
        },
        clearSumberBelajar(){
            this.form.sumber_belajar = [];
        },
        addAlatBahan(){
            this.form.alat_bahan.push(this.alatBahanInput);
            this.alatBahanInput = null;
        },
        deleteAlatBahan(index){
            this.form.alat_bahan.splice(index, 1);
        },
        clearAlatBahan(){
            this.form.alat_bahan = [];
        }
    }
}
</script>