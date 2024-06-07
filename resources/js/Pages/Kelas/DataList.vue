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
                        <th scope="col" class="ps-0">Kelas</th>
                        <th scope="col">Tahun Ajaran</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Total Siswa</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top">
                    <tr v-for="(item, index) in data??[]" :key="index">
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.nama }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.tahun_ajaran }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.semester }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 fs-3">
                                {{ item.total_siswa }} Siswa
                            </p>
                        </td>
                        <td>
                            <div class="row"> 
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
        fetchDataKelas(value)
    }"></Pagination>

</template>

<script>
import FilterTabel from '@/Pages/Kelas/FilterTabel.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import StringManipulation from '@/StringManipulation.js'
import Pagination from '@/Components/Pagination.vue';
import Toast from '@/Toast.js'
export default {
    components:{
        FilterTabel, Pagination, Link
    },
    data() {
        return {
            length: 10,
            search: null,
            data: [],
            links : []
        }
    },
    watch: {
        length(){
            this.fetchDataKelas()
        },
        search(){
            this.fetchDataKelas()
        }
    },
    mounted() {
        this.fetchDataKelas()
    },
    methods: {
        async fetchDataKelas(urlParam){
            try {

                let url; 

                if (urlParam != null) {
                    url = urlParam;
                }else{
                    url = route('kelas.show',{
                        _query:{
                            length:this.length,
                            search: this.search
                        }
                    })
                }

                let request = await axios.get(url);
                let response = request.data;
                
                this.data = response.data.map((item) => {
                    return {
                        id: item.id,
                        nama: item.nama,
                        tahun_ajaran : `${item.tahun_ajaran?.start_tahun??''}/${item.tahun_ajaran?.end_tahun??''}`,
                        semester: item.tahun_ajaran?.semester ? new StringManipulation().capitalizeLetter(item.tahun_ajaran.semester): '',
                        total_siswa: item.siswa_count??0,
                    }
                });
                this.links = response.links
            } catch (error) {
                console.log(error)
            }
        },
        async onDeleteHandler(id){
            try {
                let request = await axios.delete(route('kelas.delete',{id:id}));
                if (request.status == 200) {
                    let response = request.data;
                    Toast.fire({
                        'icon':'success',
                        'title' : 'Berhasil menghapus data kelas'
                    })
                    this.fetchDataKelas()
                }
            } catch (error) {
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal menghapus data kelas'
                })
            }
        }
    },
}
</script>