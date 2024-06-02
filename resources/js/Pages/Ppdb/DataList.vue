<template>
    <div class="card w-100">
        <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
            <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">Daftar Gelombang</h5>
            <p class="card-subtitle mb-0"></p>
            </div>
            
            <div>
            
            </div>
        </div>

        <!-- page length filter -->
            <div class="row justify-content-between">
                <div class="col-md-2">
                    <select v-model="selectedLength" class="form-select">
                        <option :value="item" v-for="(item, index) in lengthData" :key="index">
                            {{ item }}
                        </option>
                    </select>
                </div>
               <div class="col-md-10">
                    <div class="row justify-content-end">
                        <span class="w-25">
                            <div class="form-group mb-4">
                                <select  class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected hidden>Status</option>
                                    <option :value="null">Semua</option>
                                    <option :value="true">Aktif</option>
                                    <option :value="false">Tidak Aktif</option>
                                </select>
                            </div>
                        </span>
                        <div class=" mb-3 w-25" style="float: right;">
                            <input
                            type="text"
                            class="form-control"
                            id="tb-fname"
                            placeholder="Search..."
                            />
                        </div>
                    </div>
               </div>
            </div>
        <!-- end page length filter -->

        <!-- table -->
        <div class="overflow-auto">
            <div class="table-responsive">
                <table class="table align-middle text-nowrap mb-0">
                <thead>
                    <tr class="text-muted fw-semibold">
                    <th scope="col" class="ps-0">Nama Gelombang</th>
                    <th scope="col">Tanggal Awal</th>
                    <th scope="col">Berakhir</th>
                    <th scope="col">Jumlah Pendaftar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                    </tr>
                </thead>
                <tbody class="border-top">
                    <tr v-for="(item, index) in data?.data??[]" :key="index">
                    <td class="ps-0">
                        <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                            
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">{{ item.nama_gelombang }}</h6>
                            <p class="fs-2 mb-0 text-muted">{{ item.informasi_umum }}</p>
                        </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0 fs-3">{{item.awal_pendaftaran}}</p>
                    </td>
                    <td>
                        <p class="mb-0 fs-3">{{item.akhir_pendaftaran}}</p>
                    </td>
                    <td>
                        <p class="fs-3 text-dark mb-0">{{ item.ppdb_count  }} Pendaftar</p>
                    </td>
                    <td>
                        <p class="fs-3 text-dark mb-0">
                            <div class="badge" :class="{
                                'bg-primary' : item.is_active == 'Aktif',
                                'bg-danger' : item.is_active == 'Tidak Aktif'
                            }">
                                {{ item.is_active  }} 
                            </div>
                        </p>
                    </td>
                    <td>
                        <p class="mb-0 fs-3">{{item.created_at}}</p>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import axios from 'axios';
import moment from 'moment';
export default {
    data() {
        return {
            selectedLength: 10,
            data:null
        }
    },
    mounted() {
        this.getDataPpdb()
    },
    watch: {
        selectedLength(){
            this.getDataPpdb()
        }
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
    methods: {
        async getDataPpdb(){
           const request =  await axios.get(
            route('ppdb.master.show',{
                _query:{
                    length:this.selectedLength
                }
            })
            )
           var response = request.data;
           const tempData = response?.data.map((item) => {
                item.awal_pendaftaran = moment(item.awal_pendaftaran).format('ll')
                item.akhir_pendaftaran = moment(item.akhir_pendaftaran).format('ll')
                item.created_at = moment(item.created_at).format('ll')
                item.is_active = item.is_active == true ? 'Aktif' : 'Tidak Aktif';
            return item
           })

           response.data = tempData
           this.data = response
        }
    },
}
</script>