<template>
<AdminAuthenticatedLayout>
    <div class="grid grid-cols-1 gap-6">

        <div class="w-full card p-4">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
                <!-- card header -->
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Kurikulum Sekolah</h5>
                    <p class="card-subtitle mb-0">
                        Daftar data kurikulum sekolah anda
                    </p>
                </div>
                <div>
                    <Link :href="route('kurikulum.create')" class="btn btn-rounded btn-primary"> + Tambah </Link>
                </div>
               
            </div>
            <div class="mt-3">
                <div class="d-flex justify-content-between">
                    <div class="col-md-1">
                        <select v-model="length" class="form-select">
                            <option :value="item" v-for="item in [10, 25, 50, 75, 100]" :key="item">
                                {{ item }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input
                            type="text"
                            class="form-control"
                            id="tb-fname"
                            placeholder="Search..."
                            v-model="search"
                        />
                    </div>

                </div>
            </div>

            <div class="mt-3">
                <div class="overflow-auto">
                        <table class="table align-middle text-nowrap mb-0">
                        <thead>
                            <tr class="text-muted fw-semibold">
                            <th scope="col" class="ps-0">Nama Kurikulum</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="border-top">
                            <tr v-for="(item, index) in data" :key="index">
                            <td class="ps-0">
                                <div class="d-flex align-items-center">
                                <div class="me-2 pe-1">
                                    
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">{{ item.name }}</h6>
                                </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fs-3">{{item.is_active === true ? 'Aktif' : 'Tidak Aktif'}}</p>
                            </td>
                            <td class="row">
                                <button @click="onDeleteHandler(item.id)" class="btn btn-rounded btn-outline-danger col-sm-2">Hapus</button>
                                <div style="width: 1%;"></div>
                                <button @click="onEditDataHandler(item)" class="btn btn-rounded btn-outline-primary col-sm-2">Edit</button>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                <!-- end tabel -->
                <div class="py-2"></div>
                <Pagination @on-click="onSelectPageHandler" :links-data=paginationList></Pagination>
            </div>
        </div>
    </div>
</AdminAuthenticatedLayout>
</template>

<script>
import {Link, useForm, usePage} from '@inertiajs/vue3';
import AdminAuthenticatedLayout from '@/Layouts/Admin/Layout.vue'
import axios from 'axios';
import Pagination from '@/Components/Pagination.vue';
import Toast from '@/Toast.js';

export default {
    components:{
        AdminAuthenticatedLayout,Pagination,Link
    },
    mounted() {
        this.fetchData()
    },
    data() {
        return {
            userRole:usePage().props.auth.user.role,
            length:10,
            search:null,
            data:null,
            paginationList:null
        }
    },
    watch: {
        search(newVal){
            this.fetchData()
        },
        length(newVal){
            this.fetchData()
        },
    },
    methods: {
        async fetchData(url = route('kurikulum.show_all')){
            const request = await axios.get(url, {
                params:{
                    'length' : this.length,
                    'search' : this.search
                }
            })

            if (request.status == 200) {
                this.data = request.data.data
                this.paginationList = request.data.links
            }
        },
        async onDeleteHandler(id){
            try {
                const request = await axios.delete(route('kurikulum.delete',{id: id}));

                if (request.status == 200) {
                    this.fetchData();
                    Toast.fire('Berhasil menghapus data', '' , 'success')
                }


            } catch (error) {
                Toast.fire('Gagal menghapus data', '' , 'error')
            }
        },
        onEditDataHandler(id){
            return this.$inertia.visit(route('kurikulum.show',{id: id}))
        }
    },
}
</script>