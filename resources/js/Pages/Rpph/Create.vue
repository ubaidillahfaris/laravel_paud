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
            <div class="d-inline-flex align-items-start col-md-12 mb-3">
                <div class="mx-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"><path fill="currentColor" d="M12.088 4.82a10 10 0 0 1 9.412.314a1 1 0 0 1 .493.748L22 6v13a1 1 0 0 1-1.5.866a8 8 0 0 0-8 0a1 1 0 0 1-1 0a8 8 0 0 0-7.733-.148l-.327.18l-.103.044l-.049.016l-.11.026l-.061.01L3 20h-.042l-.11-.012l-.077-.014l-.108-.032l-.126-.056l-.095-.056l-.089-.067l-.06-.056l-.073-.082l-.064-.089l-.022-.036l-.032-.06l-.044-.103l-.016-.049l-.026-.11l-.01-.061l-.004-.049L2 19V6a1 1 0 0 1 .5-.866a10 10 0 0 1 9.412-.314l.088.044z"/></svg>
                </div>
                <p class="text-primary bold">
                    <b>{{ kurikulum.name }}</b>
                </p>
            </div>


            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Kelas</label>
                    <select v-model="form.kelas_id" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected hidden :value="null">Pilih kelas...</option>
                        <option  v-for="(item, index) in kelas" :value="item.id" :key="index"> {{ item.nama }}</option>
                    </select>
                    <span class="text-danger" v-if="errors['kelas_id']" >isi data kelas</span>
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    v-model="form.tema"
                    type="text"
                    class="form-control"
                    id="tb-fname"
                    placeholder="tema"
                    />
                    <label for="tb-fname">Tema</label>
                    <span class="text-danger" v-if="errors['tema']" >isi tema</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    v-model="form.sub_tema"
                    type="text"
                    class="form-control"
                    id="tb-fname"
                    placeholder="tema"
                    />
                    <label for="tb-fname">Sub Tema</label>
                    <span class="text-danger" v-if="errors['sub_tema']" >isi sub tema</span>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <small>Tanggal</small>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input
                    v-model="form.start_date"
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
                    v-model="form.end_date"
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
                <button @click="postRpphHandler" class="btn btn-primary">Simpan</button>
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

export default {
    components:{
        Link,AuthenticatedLayout
    },
    props:{
        guru:Object,
        kelas:Array,
        kurikulum:Object
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
                'kurikulum_id' : this.kurikulum.id,
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
            }),
            errors:{}
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
            this.form.tujuan_pembelajaran.push(this.tujuanPembelajaranInput);
            this.tujuanPembelajaranInput = null;
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
        },
        async postRpphHandler(){
            
            try {

                let request = await axios.post(route('rpph.store'),this.form);
                Toast.fire({
                    title : 'Berhasil menyimpan data',
                    icon : 'success',
                    text : 'lanjutkan untuk membuat kegiatan rpph',
                    timer : 3000
                });

            } catch (error) {
                this.mappingErrorResponse(error)
                Toast.fire({
                    title : 'Gagal menyimpan data',
                    icon : 'error',
                    text : error.response.data.message,
                    timer : 3000
                });
            }
        },
        mappingErrorResponse(error){
            this.errors = [];

            const message = error.response.data.detail;
            for (const key in message) {
                if (Object.hasOwnProperty.call(message, key)) {
                    const element = message[key];
                    this.errors[key] = element[0]
                }
            }
        }
    }
}
</script>