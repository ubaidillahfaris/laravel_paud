<template>
     <AuthenticatedLayout>
        <!-- card -->
            <div class="w-full card p-4">
                <!-- card header -->
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Daftar RPPH</h5>
                        <p class="card-subtitle mb-0">
                            
                        </p>
                        
                    </div>
                </div>
                <!-- end header -->


                <!-- body section -->
                <div class="w-full row">
                    <!-- filter tabel -->
                        <FilterTable
                            @on-length-change="(value) => {
                                length = value;
                            }"
                            @on-search="(value) => {
                                search = value;
                            }"
                            >
                        </FilterTable>
                    <!-- end filter -->
                    <div class=" z-0">
                        <table class="table align-middle text-nowrap mb-0 position-relative z-1">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col">No.</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Kurikulum</th>
                                    <th scope="col">Tema</th>
                                    <th scope="col">Guru</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <tr v-for="(item, index) in data" :key="index">
                                    <td>{{startRow + index}}</td>
                                    <td class="ps-0">
                                        {{ item.kelas?.nama??'' }}
                                    </td>
                                    <td class="ps-0">
                                        {{ `${item.semester?.start_tahun??''} / ${item.semester?.end_tahun??''} - ${item.semester?.semester}`}}
                                    </td>
                                    <td class="ps-0">
                                        {{ item.kurikulum?.name??'' }}
                                    </td>
                                    <td class="ps-0">
                                        {{ item.tema??'' }}
                                    </td>
                                    <td class="ps-0">
                                        {{ item.guru.name??'' }}
                                    </td>
                                    <td class="ps-0">
                                            <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" >
                                                <div class="d-flex align-items-center">
                                                    <div class="user-profile-img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linejoin="round"><circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-width="2"/><path stroke-width="3" d="M12 12h.01v.01H12zm0-4.5h.01v.01H12zm0 9h.01v.01H12z"/></g></svg>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up position-absolute top-0 end-0 z-3" aria-labelledby="drop1">
                                                <div class="profile-dropdown" data-simplebar>
                                                    <div class="py-2 px-3 d-flex align-items-center">
                                                        <a class="btn" :href="route('rpph.cetak', {id: item.id})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M18 16.75h-2a.75.75 0 0 1 0-1.5h2A1.25 1.25 0 0 0 19.25 14v-4A1.25 1.25 0 0 0 18 8.75H6A1.25 1.25 0 0 0 4.75 10v4A1.25 1.25 0 0 0 6 15.25h2a.75.75 0 0 1 0 1.5H6A2.75 2.75 0 0 1 3.25 14v-4A2.75 2.75 0 0 1 6 7.25h12A2.75 2.75 0 0 1 20.75 10v4A2.75 2.75 0 0 1 18 16.75"/>
                                                                <path fill="currentColor" d="M16 8.75a.76.76 0 0 1-.75-.75V4.75h-6.5V8a.75.75 0 0 1-1.5 0V4.5A1.25 1.25 0 0 1 8.5 3.25h7a1.25 1.25 0 0 1 1.25 1.25V8a.76.76 0 0 1-.75.75m-.5 12h-7a1.25 1.25 0 0 1-1.25-1.25v-7a1.25 1.25 0 0 1 1.25-1.25h7a1.25 1.25 0 0 1 1.25 1.25v7a1.25 1.25 0 0 1-1.25 1.25m-6.75-1.5h6.5v-6.5h-6.5Z"/>
                                                            </svg>
                                                            Cetak
                                                        </a>
                                                    </div>
                                                    <div class="py-2 px-3 d-flex align-items-center">
                                                        <button @click="deleteHandler(item.id)" class="btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M16 9v10H8V9zm-1.5-6h-5l-1 1H5v2h14V4h-3.5zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2z"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination class="mt-3" 
                    :linksData="links" @on-click="(value) => {
                        getRpphData(value)
                    }"></Pagination>
                </div>
                <!-- end body section -->
            </div>

     </AuthenticatedLayout>


</template>

<script>
import AuthenticatedLayout from '@/Layouts/Guru/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
import Toast from '@/Toast.js';
import FilterTable from '@/Components/FilterTable.vue';
import Swal from 'sweetalert2';
import Pagination from '@/Components/Pagination.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

export default {
    components:{
        AuthenticatedLayout, Link,FilterTable,Pagination,Dropdown,DropdownLink
    },
    data() {
        return {
            data:[],
            links:[],
            startRow:0,
            length: 10,
            search:null,
        }
    },
    watch: {
        length(){
            this.getRpphData()
        },
        search(){
            this.getRpphData()
        }
    },
    mounted() {
        this.getRpphData()
    },
    methods: {
        async getRpphData(urlParam){
            let url;
            if (!url) {
                url = route('rpph.show',{
                    length: this.length,
                    search: this.search
                })
            }else{
                url = urlParam
            }


            let request = await axios.get(url);
            let response = request.data;

           if (request.status == 200) {
            this.startRow = response.from;
            this.links = response.links;
            this.data = response.data;
           }
        },
        async deleteHandler(id){
            try {
                const request = await axios.delete(route('rpph.delete',{id: id}));

                if (request.status == 200) {
                    this.getRpphData();
                    Toast.fire('Berhasil menghapus data', '' , 'success')
                }


            } catch (error) {
                Toast.fire('Gagal menghapus data', '' , 'error')
            }
        }
    },
}
</script>