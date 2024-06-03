<template>
    <AuthenticatedLayout>
        <div class="row">
            <!-- General data -->
            <div class="col-lg-12 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Form Data Kelas</h5>
                            </div>
                        </div>


                        <!-- card body -->
                        <div class="w-full row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Nama"
                                    v-model="form.name"
                                    />
                                    <label for="tb-fname">Nama Kelas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Tahun Ajaran</label>
                                    <v-select v-model="form.id_tahun_ajaran" placeholder="Pilih tahun ajaran" :options="tahunAjaranList"></v-select>
                                </div>
                            </div>
                            <div class="col-md-12">
                               <div class="row justify-content-between">
                                <div class="px-2 col-auto">
                                        <Link :href="route('kelas.index')" class=" btn btn-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path fill="currentColor" d="M16 2C8.2 2 2 8.2 2 16s6.2 14 14 14s14-6.2 14-14S23.8 2 16 2m0 26C9.4 28 4 22.6 4 16S9.4 4 16 4s12 5.4 12 12s-5.4 12-12 12"/><path fill="currentColor" d="M21.4 23L16 17.6L10.6 23L9 21.4l5.4-5.4L9 10.6L10.6 9l5.4 5.4L21.4 9l1.6 1.6l-5.4 5.4l5.4 5.4z"/></svg>
                                            Batal
                                        </Link>
                                    </div>
                                    <div class="px-2 col-auto">
                                        <button @click="postDataHandler" class=" btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z" clip-rule="evenodd"/></svg>
                                            Perbarui
                                        </button>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
import StringManipulation from '@/StringManipulation.js';
import Toast from '@/Toast.js'
export default {
    props:{
        kelas:Object
    },
    components:{
        AuthenticatedLayout, Link
    },
    data() {
        return {
            form:useForm({
                name: this.kelas.nama,
                id_tahun_ajaran: null
            }),
            tahunAjaranList:[],
        }
    },
    beforeMount() {
        this.fetchTahunAjaran();
    },
    methods: {
        async fetchTahunAjaran(){
            try {
                let request = await axios.get(route('tahun_ajaran.show_all'));
                let response = request.data;
                this.tahunAjaranList = response.map((item) => {
                    return {
                        'code' : item.id,
                        'label' : `${item.start_tahun}/${item.end_tahun} - Semester ${new StringManipulation().capitalizeLetter(item.semester)}`
                    }
                });
                console.log(this.kelas)
                this.form.id_tahun_ajaran = this.tahunAjaranList.filter((item) => {
                    if (item.code == this.kelas.tahun_pelajaran_id) {
                        return item
                    }
                })
            } catch (error) {
                console.log(error)
            }
        },
        async postDataHandler(){
            try {
                
                let request = await axios.put(route('kelas.update',{id:this.kelas.id}),{
                        nama :this.form.name,
                        tahun_pelajaran_id: this.form.id_tahun_ajaran.code
                    });
                
                if (request.status == 200) {
                    
                    Toast.fire({
                        'icon':'success',
                        'title' : 'Berhasil menubah data kelas'
                    });
                    setTimeout(() => {
                        window.location.href = route('kelas.index');
                    }, 2000);
                }
            } catch (error) {
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal mengubah data kelas'
                })
            }
        }
    },
}
</script>