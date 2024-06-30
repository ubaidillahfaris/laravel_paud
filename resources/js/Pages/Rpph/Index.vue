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
                    <div class="overflow-auto">
                        <table class="table align-middle text-nowrap mb-0">
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
                                        <div class="d-inline-flex">
                                            <a :href="route('rpph.cetak',{id: item.id})" class="btn btn-success">Cetak</a>
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

export default {
    components:{
        AuthenticatedLayout, Link,FilterTable,Pagination
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

            console.log(response)
        }
    },
}
</script>