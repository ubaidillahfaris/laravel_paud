<template>
    <AuthenticatedLayout>
        <div class="row">
            <!-- General data -->
            <div class="col-lg-12 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Data Umum</h5>
                            </div>
                        </div>
                        <div class="w-full row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Nama"
                                    v-model="form.nama_gelombang"
                                    />
                                    <label for="tb-fname">Nama gelombang</label>
                                </div>
                            </div>
                            <div class="row w-full">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="start-date"
                                        placeholder="Nama"
                                        v-model="form.awal_pendaftaran"
                                        />
                                        <label for="start-date">Tanggal awal pendaftaran</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="start-date"
                                        placeholder="Nama"
                                        v-model="form.akhir_pendaftaran"
                                        />
                                        <label for="start-date">Tanggal akhir pendaftaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Informasi umum</label>
                                        <div class="form-floating mb-3">
                                            <textarea v-model="form.informasi_umum" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end General data -->

            <!-- General data -->
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Asesmen Diagnostik</h5>
                            </div>
                        </div>
                        <div class="w-full row">
                            
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Jenis Survey</label>
                                    <select v-model="form.tipe" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected hidden>Pilih...</option>
                                        <option value="teks">Teks</option>
                                        <option value="pilihan">Pilihan</option>
                                        <option value="pilihan_ganda">Pilihan ganda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row w-full">
                                <template v-if="form.tipe == 'teks'">
                                    <Teks 
                                    ref="teksKomponentRef"
                                    @on-change="(value)=>{
                                        pertanyaan = value;
                                        tipe = 'teks'
                                    }"></Teks>
                                </template>
                                <template v-if="form.tipe == 'pilihan'">
                                    <Pilihan
                                    ref="pilihanKomponentRef"
                                    @on-change="(value)=>{
                                        pertanyaan = value.soal
                                        tipe = 'pilihan'
                                        listJawaban = value.jawaban
                                    }"></Pilihan>
                                </template>

                                <template v-if="form.tipe == 'pilihan_ganda'">
                                    <Pilihan
                                    ref="pilihanKomponentRef"
                                    @on-change="(value)=>{
                                        pertanyaan = value.soal
                                        tipe = 'pilihan_ganda'
                                        listJawaban = value.jawaban
                                    }"></Pilihan>
                                </template>
                                
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button @click="()=>{
                                        simpanPertanyaan()
                                        
                                    }" class="btn btn-primary ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12m10-8a8 8 0 1 0 0 16a8 8 0 0 0 0-16"/><path d="M13 7a1 1 0 1 0-2 0v4H7a1 1 0 1 0 0 2h4v4a1 1 0 1 0 2 0v-4h4a1 1 0 1 0 0-2h-4z"/></g></svg>
                                    <span>Tambah pertanyaan</span>    
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end General data -->
            <div class="col-lg-4">
                <!-- Card -->
              <div class="card" >
                <div class="card-body">
                  <h4 class="card-title">Pertanyaan Asesmen</h4>
                  <div class="todo-widget overflow-y-auto" style="height: calc(100vh / 3);">
                    <ul class="list-task todo-list list-group mb-0" data-role="tasklist">
                      <li 
                      @click="selectSoalHandler(item)"
                      v-for="(item, index) in soalComponent" :key="index"
                      class="
                          list-group-item
                          todo-item
                          border-0
                          mb-0
                          py-3
                          pe-3
                          ps-0
                        " data-role="task">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input success check-light-success" id="newc1" />
                          <label class="
                              form-check-label
                              todo-label
                              d-md-flex
                              align-items-center
                              ps-2
                            " for="newc1">
                            <div>
                              <h5 class="todo-desc mb-0 fs-3 font-weight-medium">
                                {{ item.text }}
                              </h5>
                              <div class="todo-desc text-muted fw-normal fs-2">
                                {{ item.tipe }}
                              </div>
                            </div>
                            <div class="ms-auto">
                              <div class="dropdown dropstart">
                                <a href="#" class="link" id="new" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="ti ti-dots fs-6 text-dark"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="new">
                                  <li>
                                    <button
                                    class="btn dropdown-item "
                                    data-bs-toggle="modal"
                                    data-bs-target="#bs-example-modal-sm"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0"/></svg>
                                    <span>Detail</span>
                                    </button>
                                    <!-- sample modal content -->
                                  </li>
                                  <li>
                                    <button @click="hapusPertanyaanStack(index)" class="btn btn-danger dropdown-item" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6zM8 9h8v10H8zm7.5-5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                        <span>Hapus</span>
                                    </button>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </li>
                      
                    </ul>
                  </div>
                  <button @click="postPertanyaanHandler" class="btn btn-primary mt-4  d-flex align-items-center">
                    <span class="me-2">Upload PPDB</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"  viewBox="0 0 512 512"><path fill="currentColor" d="M473 39.05a24 24 0 0 0-25.5-5.46L47.47 185h-.08a24 24 0 0 0 1 45.16l.41.13l137.3 58.63a16 16 0 0 0 15.54-3.59L422 80a7.07 7.07 0 0 1 10 10L226.66 310.26a16 16 0 0 0-3.59 15.54l58.65 137.38c.06.2.12.38.19.57c3.2 9.27 11.3 15.81 21.09 16.25h1a24.63 24.63 0 0 0 23-15.46L478.39 64.62A24 24 0 0 0 473 39.05"/></svg>
                </button>
                </div>
              </div>
              <!-- Card -->
              
              
                <!-- Modal -->
                    <div
                        class="modal fade"
                        id="bs-example-modal-sm"
                        tabindex="-1"
                        aria-labelledby="mySmallModalLabel"
                        aria-hidden="true"
                        >
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div
                                class="modal-header d-flex align-items-center"
                            >
                                <h6 class="modal-title" id="myModalLabel">
                                    {{ form.tipe }}
                                </h6>
                                <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    {{ pertanyaan }}
                                </h4>
                                
                                <ul>
                                    <li v-for="(item, index) in listJawaban" :key="index">
                                        <span>{{ item }}</span>
                                    </li>
                                </ul>

                            </div>
                            <div class="modal-footer">
                                <button
                                type="button"
                                class="btn btn-light-danger text-danger font-medium waves-effect"
                                data-bs-dismiss="modal"
                                >
                                Close
                                </button>
                            </div>
                        </div>
                            <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <!-- End Modal -->
                   
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import Teks from '@/Pages/Ppdb/Jenis/Teks.vue';
import Pilihan from '@/Pages/Ppdb/Jenis/Pilihan.vue';
import axios from 'axios';

export default {
    components:{
        AuthenticatedLayout,Link,Teks, Pilihan
    },
    data() {
        return {
            form:useForm({
                nama_gelombang:null,
                tipe:'teks',
                awal_pendaftaran:null,
                akhir_pendaftaran:null,
                informasi_umum:null
            }),
            pertanyaan:null,
            listJawaban:[],
            soalComponent:[{
                text:null,
                tipe:null,
                listJawaban:[]
            }],
            selectedSoal:null
        }
    },
    methods: {
        simpanPertanyaan(){

            if (this.soalComponent.length > 0 && (this.soalComponent[0].text == null && this.soalComponent[0].tipe == null)) {
                this.soalComponent.pop();
            }

            this.soalComponent.push({
                text: this.pertanyaan,
                tipe: this.form.tipe,
                listJawaban: this.listJawaban
            });
            this.clearValue();


        },
        clearValue(){
            switch (this.form.tipe) {
                case 'teks':
                        this.$refs.teksKomponentRef.pertanyaan = null;
                    break;
            
                default:
                    break;
            }


            this.pertanyaan = null;
            this.tipe = null;
            this.listJawaban = [];

            this.form.tipe = 'teks';
        },
        hapusPertanyaanStack(index){
            this.soalComponent.splice(index,1);
        },
        async postPertanyaanHandler(){ 
            const informasi_umum = this.form

            const data = {
                nama_gelombang:informasi_umum.nama_gelombang,
                awal_pendaftaran:informasi_umum.awal_pendaftaran,
                akhir_pendaftaran:informasi_umum.akhir_pendaftaran,
                informasi_umum:informasi_umum.informasi_umum,
                data:this.soalComponent
            }

            await axios.post(route('ppdb.master.create'),data);
        },
        selectSoalHandler(item){
            this.form.tipe = item.tipe;
            this.pertanyaan = item.text;
            this.listJawaban = item.listJawaban
        }
    },
}
</script>