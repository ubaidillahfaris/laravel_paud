<template>
    <component :is="LayoutComponent">
        <div class="grid grid-cols-1 gap-6">
    
    
            <div class="w-full card p-4">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
                <!-- card header -->
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Tagihan</h5>
                        <p class="card-subtitle mb-0">
                            manajemen tagihan siswa
                        </p>
                    </div>
                </div>

                <div class="py-2">
                    <FilterTabel
                        @on-length-change="(value) => {
                            length = value;
                        }"
                        @on-search="(value) => {
                            search = value;
                        }"
                        >
                        <div class="col-3">
                            <KelasList @on-change="(value) => {selectedKelas = value}"></KelasList>
                        </div>
                    </FilterTabel>
                    <div class="overflow-auto w-full">
                        <table class="table w-full align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Kelas</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Sudah dibayar</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <tr v-for="(item, index) in data" :key="index">
                                    <td>
                                        {{ item?.siswa_kelas?.nama??'' }}
                                    </td>
                                    <td>
                                        {{ item?.siswa?.nama_lengkap??'' }}
                                    </td>
                                    <td>
                                        {{ item?.nominal??'' }}
                                    </td>
                                    <td>
                                        {{ item?.nominal_terbayar??'' }}
                                    </td>
                                    <td>
                                        <div v-if="item?.nominal_terbayar != null">
                                            <svg xmlns="http://www.w3.org/2000/svg" class=" text-primary" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z" clip-rule="evenodd"/></svg>
                                        </div>
                                        <div v-else>
                                            <svg xmlns="http://www.w3.org/2000/svg" class=" text-danger" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2c5.53 0 10 4.47 10 10s-4.47 10-10 10S2 17.53 2 12S6.47 2 12 2m3.59 5L12 10.59L8.41 7L7 8.41L10.59 12L7 15.59L8.41 17L12 13.41L15.59 17L17 15.59L13.41 12L17 8.41z"/></svg>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                     <!-- pagination -->
                    <Pagination class="mt-3" 
                    :linksData="links" @on-click="(value) => {
                        getDataSiswa(value)
                    }"></Pagination>
                </div>
            </div>
        </div>
    </component>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import StringManipulation from '@/StringManipulation.js'
import Pagination from '@/Components/Pagination.vue';
import FilterTabel from '@/Pages/Kelas/FilterTabel.vue';
import KelasList from '../../Components/KelasList.vue';

export default {
    props:{
        user_role:String
    },
    async created() {
        if (this.user_role == 'admin') {
        this.LayoutComponent = (await import('@/Layouts/Admin/Layout.vue')).default;
        } else {
        this.LayoutComponent = (await import('@/Layouts/Guru/Layout.vue')).default;
        }
    },
    components:{
        Link,AuthenticatedLayout,Pagination,FilterTabel,KelasList
    },
    data() {
        return {
            LayoutComponent: null,
            length: 10,
            search: null,
            selectedKelas:null,
            data: [],
            links : [],
            from: 1
        }
    },
    mounted() {
        this.getDataSiswa();
    },
    watch: {
        length(){
            this.getDataSiswa()
        },
        search(){
            this.getDataSiswa()
        },
        selectedKelas(){
            this.getDataSiswa()
        }
    },
    methods: {
        async getDataSiswa(urlParam){
            try {

                let url; 

                if (urlParam != null) {
                    url = urlParam;
                }else{
                    url = route('tagihan.show',{
                        _query:{
                            length:this.length,
                            search: this.search,
                            kelas : this.selectedKelas
                        }
                    })
                }

                const request = await axios.get(url);
                const response = request.data;
                

                if (request.status != 200) {
                    return 
                }
                
                this.form = response.from
                this.data = response.data.map((item)=>{
                    item.nominal = StringManipulation.rupiah(item.nominal)
                    item.nominal_terbayar = StringManipulation.rupiah(item.nominal_terbayar)
                    return item
                })

                this.links = response.links


            } catch (error) {
                
            }
        }
    },
}
</script>