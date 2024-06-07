<template>

    
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

         <!-- tabel -->
         <div class="overflow-auto">
            <table class="table align-middle text-nowrap mb-0">
                <thead>
                    <tr class="text-muted fw-semibold">
                        <th scope="col" class="ps-0">Nama</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top">
                    <tr v-for="(item, index) in data??[]" :key="index">
                        <td class="ps-0">
                            {{ item.name }}
                        </td>
                        <td class="ps-0">
                           <div class="row">
                            <Link :href="route('program_layanan.show',{id: item.id})" class="col-auto mx-2 btn btn-outline-info">
                                Detail
                            </Link>
                            <button @click="deleteHandler(item.id)" class="col-auto mx-2 btn btn-outline-danger">
                                Hapus
                            </button>
                           </div>
                        </td>
                    </tr>
                </tbody>
            </table>
             <!-- pagination -->
        </div>
        <Pagination class="mt-3" 
        :linksData="links" @on-click="(value) => {
            fetchDataProgramLayanan(value)
        }"></Pagination>
</template>

<script>
import FilterTable from './FilterTable.vue';
import {Link} from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2';
import Pagination from '@/Components/Pagination.vue';

export default {
    components:{
        FilterTable,Link,Pagination
    },
    data() {
        return {
            length: 10,
            search:null,
            data:[],
            links:[]
        }
    },
    watch: {
        length(){
            this.fetchDataProgramLayanan()
        },
        search(){
            this.fetchDataProgramLayanan()
        }
    },
    mounted() {
        this.fetchDataProgramLayanan()
    },
    methods: {
        async fetchDataProgramLayanan(urlParam){
            let url;
            if (urlParam) {
                url = urlParam;
            } else {
                url = route('program_layanan.data',{
                    length: this.length,
                    search: this.search
                })
            }

            let request = await axios.get(url);
            
            if (request.status == 200) {
                let response = request.data;
                this.data = response.data;
                this.links = response.links;
            }
        },
        async deleteHandler(id){
                Swal.fire({
                    title: "Ingin menghapus data?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then(async (result) => {

                    try {
                        if (result.isConfirmed) {
                            await axios.delete(route('program_layanan.delete',{id: id}));
                            Swal.fire({
                                title: "Terhapus!",
                                text: "Data berhasil dihapus.",
                                icon: "success"
                            });

                            this.fetchDataProgramLayanan();
                        }
                        
                    } catch (error) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Data gagal dihapus.",
                            icon: "error"
                        });
                    }
                });
        }
    },
}
</script>