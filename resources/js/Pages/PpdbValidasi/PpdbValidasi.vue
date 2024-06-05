<template>
    <AuthenticatedLayout>
        <div class="grid grid-cols-1 gap-6">
            <!-- card -->
                <div class="card">
                    <div class="card-body">
                        <!-- card header -->
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Calon siswa</h5>
                                <span>Daftar calon siswa yang mendaftar</span>

                            </div>
                        </div>
                        
                        <!-- filter tabel -->
                        <div class="container">
                            <FilterTabel
                                    @on-length-change="(value) => {
                                        length = value;
                                    }"
                                    @on-search="(value) => {
                                        search = value;
                                    }"
                                    >
                                </FilterTabel>
                        </div>

                        <!-- table -->
                        <div class="overflow-auto">
                            <table class="table align-middle text-nowrap mb-0">
                                <thead>
                                    <tr class="text-muted fw-semibold">
                                        <th scope="col" class="ps-0">Nama Siswa</th>
                                        <th scope="col">Nama Ayah</th>
                                        <th scope="col">Nama Ibu</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    <tr v-for="(item, index) in data??[]" :key="index">
                                        <td class="ps-0">
                                            {{ item.nama_lengkap }}
                                        </td>
                                        <td class="ps-0">
                                            {{ item.nama_ayah }}
                                        </td>
                                        <td class="ps-0">
                                            {{ item.nama_ibu }}
                                        </td>
                                        <td class="ps-0">
                                            {{ item.alamat }}
                                        </td>
                                        <td class="ps-0">
                                            <span class="mb-1 badge" :class="{
                                                'bg-primary' : item.status == 'verified',
                                                'bg-danger' : item.status == 'decline',
                                                'bg-dark' : item.status == 'not verified',
                                            }">
                                                {{ item.status }}
                                            </span>
                                        </td>
                                        <td class="ps-0">
                                            <Link :href="route('ppdb.detailPendaftar',{ppdb_id: item.id})" class="btn btn-outline-info">Detail Pendaftar</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                         <!-- pagination -->
                        <Pagination class="mt-3" 
                        :linksData="links" @on-click="(value) => {
                            fetchSiswa(value)
                        }"></Pagination>

                    </div>
                </div>
            <!-- end card -->
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import Toast from '@/Toast.js'
import FilterTabel from '@/Pages/Kelas/FilterTabel.vue';
import axios from 'axios';

export default {
    components:{
        AuthenticatedLayout,Link,
        FilterTabel,Pagination
    },
    props:{
        gelombang_id: Number
    },
    data() {
        return {
            data:[],
            links:[],
            length:10,
            search:null
        }
    },
    watch: {
        search(){
            this.fetchSiswa()
        },
        length(){
            this.fetchSiswa()
        },
    },
    mounted() {
        this.fetchSiswa();
    },
    methods: {
        async fetchSiswa(urlParam){

            let url;

            if (urlParam) {
                url = urlParam
            }else{
                url = route('ppdb.data_siswa',{
                    gelombang_id:this.gelombang_id,
                    search: this.search,
                    length: this.length
                });
            }

            let request = await axios.get(
                url
            );


            if (request.status == 200) {
                let response = request.data;
                this.data = response.data;
                this.links = response.links
            }
        }
    },
}
</script>