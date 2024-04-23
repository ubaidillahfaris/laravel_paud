<template>
    <AuthenticatedLayout>
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Tambah mitra</h5>
                                <p class="card-subtitle mb-0">Isi formulir mitra sekolah</p>

                            </div>
                        </div>
                        <div class="w-full row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Enter Name here"
                                    v-model="form.name"
                                    />
                                    <label for="tb-fname">Nama Sekolah</label>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                
                                <OptionSelect
                                label="Provinsi"
                                :url="route('wilayah.provinsi')"
                                :item-index="['id','name']"
                                @on-change="(value) => {
                                    form.provinsi = value
                                }"
                                ></OptionSelect>
                            </div>
                            <div class="col-md-6">
                                <OptionSelect
                                label="Kota/Kabupaten"
                                :url="form.provinsi != null ? route('wilayah.kota',{province_id:form.provinsi}): null"
                                :item-index="['id','name']"
                                @on-change="(value) => {
                                    form.kota = value
                                }"
                                ></OptionSelect>
                            </div>
                            <div class="col-md-6">
                                <OptionSelect
                                label="Kecamatan"
                                :url="form.kota != null ? route('wilayah.kecamatan',{kota_id:form.kota}): null"
                                :item-index="['id','name']"
                                @on-change="(value) => {
                                    form.kecamatan = value
                                }"
                                ></OptionSelect>
                            </div>
                            <div class="col-md-6">
                                <OptionSelect
                                label="Desa"
                                :url="form.kecamatan != null ? route('wilayah.desa',{kecamatan_id:form.kecamatan}): null"
                                :item-index="['id','name']"
                                @on-change="(value) => {
                                    form.desa = value
                                }"
                                ></OptionSelect>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Enter Name here"
                                    v-model="form.alamat"
                                    />
                                    <label for="tb-fname">Alamat Sekolah</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Enter Name here"
                                    v-model="form.kontak"
                                    />
                                    <label for="tb-fname">Kontak / Nomor telepon</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Enter Name here"
                                    v-model="form.akreditasi"
                                    />
                                    <label for="tb-fname">Akreditasi Sekolah</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Unggah foto</label>
                                <input type="file" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <button @click="simpanHandler" class="btn btn-primary">
                                    <span class="me-2">Simpan</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634L21.044 2.32c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8l-8 6z"/></svg>
                                </button>
                            </div>
                        </div>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Superadmin/Layout.vue';
import OptionSelect from '@/Components/OptionSelect.vue';
import {useForm} from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components:{
        AuthenticatedLayout,OptionSelect
    },
    data() {
        return {
            form: useForm({
                name:null,
                provinsi:null,
                kota:null,
                kecamatan:null,
                desa:null,
                alamat:null,
                kontak:null,
                akreditasi:null,
                lat:null,
                long:null,
                image:null
            }),
            provinsiData:[]
        }
    },
    
    mounted() {

    },
    methods: {
        async simpanHandler(){
            await axios.post(route('sekolah.store',this.form));
        },
        async getProvinsiHanlder(){
            const request = await axios.get(route('wilayah.provinsi'));
            const response = request.data;
            const data = response.map((item) => {
                return{label: item.name, code: item.id}
            })
            this.provinsiData = data;
        }
    },
}
</script>