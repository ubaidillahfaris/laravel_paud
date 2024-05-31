<template>
   <div class="w-full card p-4">
        <div class="grid grid-cols-1"></div>
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">Daftar Tahun Ajaran</h5>
            </div>
        </div>

        <!-- tabel -->
            <div class="row justify-between">
                <div class="col-md-2">
                    <select v-model="selectedLength" class="form-select">
                        <option :value="item" v-for="(item, index) in lengthData" :key="index">
                            {{ item }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle text-nowrap mb-0">
                <thead>
                    <tr class="text-muted fw-semibold">
                    <th scope="col" class="ps-0">Tahun Ajaran</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Tempat Pembagian Rapor</th>
                    <th scope="col">Tanggal Pembagian Rapor</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top">
                    <tr v-for="(item, index) in dataList??[]" :key="index">
                    <td class="ps-0">
                        <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                            
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">{{ item.tahun_ajaran }}</h6>
                        </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0 fs-3">{{item.semester}}</p>
                    </td>
                    <td>
                        <p class="mb-0 fs-3">{{item.tempat_pembagian_raport}}</p>
                    </td>
                    <td>
                        <p class="fs-3 text-dark mb-0">{{ item.tanggal_pembagian_raport  }}</p>
                    </td>
                    <td>
                        <select @change="onStatusChange(item.id, $event)" class="form-select text-white" :class="{
                           'bg-primary' : item.status == 'Aktif',
                           'bg-danger' : item.status == 'Tidak Aktif',
                        }">
                            <option :value="true" :selected="item.status == 'Aktif'">Aktif</option>
                            <option :value="false" :selected="item.status == 'Tidak Aktif'">Tidak Aktif</option>
                        </select>
                    </td>
                    <td>
                        
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
        <!-- end tabel -->
    </div>
</template>

<script>
import Pagination from '@/Components/Pagination.vue';
import axios from 'axios';
import moment from 'moment';
import StringManipulation from '@/StringManipulation.js'
import Swal from 'sweetalert2';
import Toast from '@/Toast.js'

export default {
    data() {
        return {
            selectedLength:10,
            dataList:[],
        }
    },
    beforeMount() {
        this.fetchData();
    },
    computed: {
        lengthData(){
            let page = [];
            for (let index = 0; index <= 100; index++) {
                if (index == 10) {
                    page.push(index)
                }
                if (index % 25 == 0 && index != 0) {
                    page.push(index);
                }
                
            }
            return page;
        }
    },
    watch: {
        selectedLength(newVal){
            this.fetchData()
        }
    },
    methods: {
        async fetchData(){
            let request = await axios.get(route('tahun_ajaran.show',{
                _query:{
                    length: this.selectedLength
                }
            }));
            let response = request.data;
            let mappingData = response.data;
            this.dataList = mappingData.map((item) => {
                return {
                    'id' : item.id,
                    'tahun_ajaran' : `${item.start_tahun}/${item.end_tahun}`,
                    'semester' : new StringManipulation().capitalize(item.semester),
                    'tempat_pembagian_raport' : new StringManipulation().capitalizeLetter(item.kota_pembagian?.name??''),
                    'tanggal_pembagian_raport' : moment(item.tanggal_pembagian_raport).format('Y-MMMM-D'),
                    'status' : item.is_active == true ? 'Aktif' : 'Tidak Aktif'
                };
            });
        },
        async onStatusChange(id, component){
            let value = component.target.value;
            
            try {

                Swal.fire({
                    title: "Ingin mengubah status Tahun Ajaran?",
                    text: "Anda tetap dapat mengubah status dikemudian hari!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, ubah sekarang!"
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            this.onUpdateHandler(id, value).then((result) => {
                                Toast.fire({
                                    'icon':'success',
                                    'title' : 'Berhasil mengubah status tahun ajaran'
                                })
                            });
                        }
                    });

               
            } catch (error) {
                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal mengubah status tahun ajaran'
                })
            }
        },
        async onUpdateHandler(id, value){
            try {
                let request = await axios.put(route('tahun_ajaran.update_status',{
                        id:id,
                        _query:{
                            status:value
                        }
                    },
                ));

                this.fetchData();
                
            } catch (error) {
                throw error
            }
        }
    },
}
</script>