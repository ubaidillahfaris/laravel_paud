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
                            <template v-if="state == 'create'">
                                <button @click="postData()" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z" clip-rule="evenodd"/></svg>
                                    Simpan
                                </button>
                            </template>
                            <template v-else>
                                <button @click="updateData()" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1l1-4Z"/></g></svg>
                                    Perbarui
                                </button>
                            </template>
                            
                        </div>
                    </div>
            </div>

            <!-- Component daftar tahun ajaran -->
            <DataListTahunAjaran ref="DataListComponent" @on-update="onUpdateDataHandler"></DataListTahunAjaran>
            
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';

import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
import Toast from '@/Toast.js'
import DataListTahunAjaran from '@/Pages/TahunAjaran/DataList.vue'
import moment from 'moment';

export default {
    components:{
        AuthenticatedLayout, Link, DataListTahunAjaran
    },
    data() {
        return {
            state:'create',
            kota:[],
            refreshData:false,
            updatedDataId:null,
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
                
                this.resetPageHandler();

                Toast.fire({
                    'icon':'success',
                    'title' : 'Berhasil menambahkan tahun ajaran'
                });

                
            } catch (error) {
                console.log(error)
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal menambahkan tahun ajaran'
                })
            }

        },
        async updateData(){
            try {
                let request = await axios.put(route('tahun_ajaran.update',{id:this.updatedDataId}),this.form);
                

                Toast.fire({
                    'icon':'success',
                    'title' : 'Berhasil memperbarui data tahun ajaran'
                });

                this.resetPageHandler();
                console.log(this.form)
            } catch (error) {
                console.log(error)
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal memperbarui data tahun ajaran'
                })
            }
        },
        async onUpdateDataHandler(item){
            let tahunList = item.tahun_ajaran.split('/');
            let selectKota = this.kota.filter((itemKota) => {
                if (itemKota.label == item.tempat_pembagian_raport.toUpperCase()) {
                    return itemKota
                }
            });
            
            let itemDataMap = useForm({
                'start_tahun' : tahunList[0],
                'end_tahun' : tahunList[1],
                'semester' : item.semester.toLowerCase(),
                'id_kota_pembagian_raport' : selectKota[0],
                'tanggal_pembagian_raport' :moment( item.tanggal_pembagian_raport).format('yyyy-MM-D')
            })

            this.updatedDataId  = item.id
            this.form = itemDataMap
            this.state = 'update'
            window.scrollTo(0,0);
        },
        resetPageHandler(){
            this.form = useForm({
                start_tahun : null,
                end_tahun : null,
                semester : null,
                id_kota_pembagian_raport : null,
                tanggal_pembagian_raport : null
            });
            this.$refs.DataListComponent.fetchData()
            this.state = 'create'
        }
        
    },
}
</script>