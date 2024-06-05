<template>
    <AuthenticatedLayout>
        
        <div class="grid grid-cols-1 gap-6">
            <!-- card -->
                <div class="card">
                    <div class="card-body">
                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Data Calon Siswa</h5>
                                <span>Detail calon siswa yang mendaftar</span>

                            </div>
                        </div>
                        <!-- detail siswa -->
                        <div class="row">
                              <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Nama Lengkap</label>
                                  <p>{{ data_ppdb.nama_lengkap }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Nama Panggilan</label>
                                  <p>{{ data_ppdb.nama_panggilan }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">NIK</label>
                                  <p>{{ data_ppdb.nik }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Anak ke-</label>
                                  <p>{{ data_ppdb.anak_ke }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Jenis Kelamin</label>
                                  <p>{{ data_ppdb.jenis_kelamin == 'male' ? 'Laki - Laki' : data_ppdb.jenis_kelamin == 'female' ? 'Perempuan' : null}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Kota Lahir</label>
                                  <p>{{ data_ppdb.kota_lahir?.name??'' }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Tanggal Lahir</label>
                                  <p>{{ data_ppdb.tanggal_lahir }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Alamat Domisili</label>
                                  <p>{{ data_ppdb.alamat }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Foto</label>
                                  <p>
                                    <img :src="data_ppdb.foto_url" class="w-50 rounded" alt="" srcset="">
                                  </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                               <div class="mb-3 mb-sm-0">
                                   <h5 class="card-title fw-semibold">Data Orang Tua</h5>
                                   <span>Data orang tua calon siswa</span>
    
                               </div>
                        </div>
                        <!-- detail orang tua -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Nama Ayah</label>
                                  <p>{{ data_ppdb.nama_ayah }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                  <label class="form-label fw-semibold">Pekerjaan Ayah</label>
                                  <p>{{ data_ppdb.pekerjaan_ayah }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                    <label class="form-label fw-semibold">Nama ibu</label>
                                    <p>{{ data_ppdb.nama_ibu }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4 col">
                                    <label class="form-label fw-semibold">Pekerjaan ibu</label>
                                    <p>{{ data_ppdb.pekerjaan_ibu }}</p>
                                </div>
                            </div>
                        </div>


                        <template v-if="data_ppdb.status == 'not verified'">
                            <!-- form -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Pilih kelas</label>
                                    <v-select v-model="selectedKelas" placeholder="Pilih kelas" :options="listKelas"></v-select>
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <button @click="validasiHandler('decline')" class="btn btn-outline-danger col-auto mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M16 2C8.2 2 2 8.2 2 16s6.2 14 14 14s14-6.2 14-14S23.8 2 16 2m5.4 21L16 17.6L10.6 23L9 21.4l5.4-5.4L9 10.6L10.6 9l5.4 5.4L21.4 9l1.6 1.6l-5.4 5.4l5.4 5.4z"/></svg>
                                    Tolak
                                </button>
                                <div style="width: 1%;"></div>
                                <button @click="validasiHandler('verified')" :disabled="selectedKelas == null" class="btn btn-primary col-auto mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024"><path fill="currentColor" d="M512 0C229.232 0 0 229.232 0 512c0 282.784 229.232 512 512 512c282.784 0 512-229.216 512-512C1024 229.232 794.784 0 512 0m0 961.008c-247.024 0-448-201.984-448-449.01c0-247.024 200.976-448 448-448s448 200.977 448 448s-200.976 449.01-448 449.01m204.336-636.352L415.935 626.944l-135.28-135.28c-12.496-12.496-32.752-12.496-45.264 0c-12.496 12.496-12.496 32.752 0 45.248l158.384 158.4c12.496 12.48 32.752 12.48 45.264 0c1.44-1.44 2.673-3.009 3.793-4.64l318.784-320.753c12.48-12.496 12.48-32.752 0-45.263c-12.512-12.496-32.768-12.496-45.28 0"/></svg>
                                    Terima
                                </button>
                                
                            </div>
                        <!-- end form -->
                        </template>
                    </div>

                </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
import Toast from '@/Toast.js'

export default {
    components:{
        AuthenticatedLayout,Link,
    },
    props:{
        data_ppdb:Object,
        kelas:Array
    },
    data() {
        return {
            listKelas:[],
            selectedKelas:null,
        }
    },
    mounted() {
        this.listKelas = this.kelas.map((item) => {
            return {
                code : item.id,
                label: item.nama
            }
        })
    },
    methods: {
        async validasiHandler(status){
            try {
                let request = await axios.put(route('ppdb.validasi',{ppdb_id: this.data_ppdb.id}),{
                    'kelas_id' : this.selectedKelas.code,
                    'status' : status
                });
                let response = request.data;
                
                if (request.status == 200) {
                    Toast.fire({
                        'icon':'success',
                        'title' : response.message
                    })

                    setTimeout(() => {
                        window.history.go(-1); return false;
                    }, 2000);
                    
                }else{
                    Toast.fire({
                        'icon':'error',
                        'title' : 'Gagal memvalidasi calon pendaftar'
                    })
                }
                
            } catch (error) {
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal memvalidasi calon pendaftar'
                })
            }
        }
    },
}
</script>