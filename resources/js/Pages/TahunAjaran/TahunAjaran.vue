<template>
    <AuthenticatedLayout>
        <div class="grid grid-cols-1 gap-6">
            <div class="w-full card p-4">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                       <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Tahun Ajaran</h5>
                            <p class="card-subtitle mb-0">
                                Konfigurasi tahun pelajaran
                            </p>
                            <div class="py-2"></div>
                        </div>
                    </div>
                    <div class="w-full row">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    name="Tahun awal ajaran"
                                    v-model="form.start_tahun"
                                />
                                <label for="tb-fname">Tahun Awal Ajaran</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    name="Tahun akhir ajaran"
                                    v-model="form.end_tahun"
                                />
                                <label for="tb-fname">Tahun Awal Ajaran</label>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Semester</label>
                                    <select v-model="form.semester"  class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected hidden>Pilih...</option>
                                        <option value="ganjil">Ganjil</option>
                                        <option value="genap">Genap</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tempat Pembagian Rapor</label>
                                <v-select v-model="form.id_kota_pembagian_raport" placeholder="Pilih kota" :options="kota"></v-select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="date"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Nama"
                                    v-model="form.tanggal_pembagian_raport"
                                />
                                <label for="tb-fname">Tanggal Pembagian</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button @click="postData()" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z" clip-rule="evenodd"/></svg>
                                Simpan
                            </button>
                        </div>
                    </div>
            </div>
            <div class="w-full card p-4">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                       <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Daftar Tahun Ajaran</h5>
                       </div>
                   </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import Pagination from '@/Components/Pagination.vue';
import {Link, useForm} from '@inertiajs/vue3';
import moment from 'moment';
import axios from 'axios';
import Toast from '@/Toast.js'

export default {
    components:{
        AuthenticatedLayout, Link
    },
    data() {
        return {
            kota:[],
            form:useForm({
                start_tahun : null,
                end_tahun : null,
                semester : null,
                id_kota_pembagian_raport : null,
                tanggal_pembagian_raport : null
            })
        }
    },
    beforeMount() {
        this.fetchDataKota();
    },
    methods: {
        async fetchDataKota(){
            let request = await axios.get(route('wilayah.kota'));
            let data = request.data;
            if (data.length > 0) {
                this.kota = data.map((item) => {
                    return {
                        code: item.id,
                        label : item.name
                    }
                })
            }
        },
        async postData(){
            try {
                let request = await axios.post(route('tahun_ajaran.create'),this.form);
                Toast.fire({
                    'icon':'success',
                    'title' : 'Berhasil menambahkan tahun ajaran'
                })
            } catch (error) {
                console.log(error)
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal menambahkan tahun ajaran'
                })
            }

        }
    },
}
</script>