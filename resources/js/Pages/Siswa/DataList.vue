<template>
    <!-- filter tabel -->
    <FilterTabel
        @on-length-change="(value) => {
            length = value;
        }"
        @on-search="(value) => {
            search = value;
        }"
        >
    </FilterTabel>

    <!-- table -->
    <div class="overflow-auto">
            <table class="table align-middle text-nowrap mb-0">
                <thead>
                    <tr class="text-muted fw-semibold">
                        <th scope="col" class="ps-0">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis kelamin</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top">
                    <tr v-for="(item, index) in data??[]" :key="index">
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.row }}
                            </p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center mb-0 ">
                                <div class=" me-2 pe-1">
                                    <img :src="item.foto_url" class="rounded-circle" width="40" height="40" alt="" srcset="">
                                </div>
                                <div class="">
                                    <strong class="fs-3">{{ item.nama_lengkap }}</strong>
                                    <div class="fs-2 mb-0 text-muted">{{ item.nama_panggilan }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.alamat }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.jenis_kelamin }}
                            </p>
                        </td>
                        <td>
                            <div class="row"> 
                                <div class="col-auto px-2">
                                    <Link :href="route('kelas.edit',{id:item.id})" class="btn btn-rounded btn-outline-info">
                                        Info
                                    </Link>
                                </div>
                                <div class="col-auto px-2">
                                    <Link :href="route('kelas.edit',{id:item.id})" class="btn btn-rounded btn-outline-primary">
                                        Edit
                                    </Link>
                                </div>
                                <div class="col-auto px-2">
                                    <button @click="onDeleteHandler(item.id)" class="btn btn-rounded btn-outline-danger">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>

    <!-- pagination -->
    <Pagination class="mt-3" 
    :linksData="links" @on-click="(value) => {
        fetchDataSiswa(value)
    }"></Pagination>
</template>

<script>
import FilterTabel from '@/Pages/Kelas/FilterTabel.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import Pagination from '@/Components/Pagination.vue';
import Toast from '@/Toast.js'

export default {
    props:{
        kelas_id:Number
    },
    components:{
        FilterTabel, Pagination, Link
    },
    data() {
        return {
            length: 10,
            search: null,
            data: [],
            links : [],
        }
    },
    watch: {
        length(){
            this.fetchDataSiswa()
        },
        search(){
            this.fetchDataSiswa()
        }
    },
    mounted() {
        this.fetchDataSiswa()
    },
    methods: {
        async fetchDataSiswa(){
            try {
                let request = await axios.get(route('siswa.show',{kelas_id:this.kelas_id}))
                let response = request.data;
                
                this.data = response.data.map((item, index) => {
                    item.row = index + 1;
                    item.jenis_kelamin = item.jenis_kelamin == 'male' ? 'Laki - Laki' : 'Perempuan';
                    return item
                });
                this.links = response.links
                this.startRow = response.from
            } catch (error) {
                
            }
        }
    },
}
</script>