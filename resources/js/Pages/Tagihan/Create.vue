<template>
    <component :is="LayoutComponent">
        <div class="grid grid-cols-1 gap-6">

            <div class="w-full card p-4">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
                    <!-- card header -->
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Buat tagihan baru</h5>
                        <p class="card-subtitle mb-0">
                            Isi data siswa dan jumlah tagihan
                        </p>
                    </div>
                </div>
                

                <div class="row align-items-end">
                    <div class="col-6 mb-4">
                        <p>Filter kelas</p>
                        <KelasList @on-change="(value) => {
                            selectedKelas = value
                        }"></KelasList>
                    </div>
                    <div class="col-6 mb-4">
                        <p>Cari siswa</p>
                        <select-siswa @on-change="(value) => {selectedSiswa = {
                            id : value.code,
                            name : value.label
                        }}" :kelas-id="selectedKelas"></select-siswa>
                    </div>
                </div>
                
                <div><hr></div>
                <p class="card-title fw-semibold mb-4">Formulir</p>
                <div class="row align-items-start">
                    <div class="col-md-6">
                        <span>Nama Siswa : </span>
                        <div class="row align-items-center">
                            <template v-if="selectedSiswa.id == null">
                                <span class="col text-danger">Siswa belum dipilih</span>
                            </template>
                            <template v-else>
                                <span class="col fw-semibold">{{ selectedSiswa.name ?? 'Siswa belum dipilih' }}</span>
                            </template>
                            
                                
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input
                                :disabled="selectedSiswa.id == null"
                                type="number"
                                class="form-control"
                                id="tb-fname"
                                placeholder="nominal"
                                v-model="form.nominal"
                            />
                            <label for="tb-fname">Nominal</label>
                            <span class="text-end">{{ formatTagihan }}</span>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <button @click="postHandler" class="btn btn-primary" :disabled="selectedSiswa.id == null">
                            Buat tagihan
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </component>
</template>

<script>
import SearchInput from '@/Components/SearchInput.vue';
import KelasList from '@/Components/KelasList.vue';
import {useForm} from '@inertiajs/vue3';
import axios from 'axios';
export default {
    components:{
        SearchInput,KelasList
    },
    async created() {
        const layoutPath = this.userRole === 'admin'
            ? '@/Layouts/Admin/Layout.vue'
            : '@/Layouts/Guru/Layout.vue';

        this.LayoutComponent = (await import(layoutPath)).default;
    },
    data() {
        return {
            LayoutComponent: null,
            selectedSiswa: {
                id : null,
                name : null
            },
            selectedKelas:null,
            form:useForm({
                'siswa_id' : null,
                'status' : 'send',
                'nominal' : 0,
            })
        }
    },
    computed: {
        formatTagihan(){
            return this.$Helper.rupiah(this.form.nominal)
        }
    },
    props:{
        user_role:String
    },
    watch: {
        selectedSiswa(newVal){
            this.form.siswa_id = newVal.id;
        }
    },
    mounted() {
        
    },
    methods: {
        async postHandler(){
            try {
                const url = route('tagihan.store')
                const request = await axios.post(url,this.form)
                this.$inertia.visit(route('tagihan.index'));
            } catch (error) {
                
            }
        }
    },
}
</script>