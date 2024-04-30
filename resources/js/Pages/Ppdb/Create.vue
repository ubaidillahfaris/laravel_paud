<template>
    <AuthenticatedLayout>
        <div class="row">
            <!-- General data -->
            <div class="col-lg-12 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Data Umum</h5>
                            </div>
                        </div>
                        <div class="w-full row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="Nama"
                                    />
                                    <label for="tb-fname">Nama gelombang</label>
                                </div>
                            </div>
                            <div class="row w-full">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="start-date"
                                        placeholder="Nama"
                                        />
                                        <label for="start-date">Tanggal awal pendaftaran</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="start-date"
                                        placeholder="Nama"
                                        />
                                        <label for="start-date">Tanggal akhir pendaftaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Informasi umum</label>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end General data -->

            <!-- General data -->
            <div class="col-lg-12 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Asesmen Diagnostik</h5>
                            </div>
                        </div>
                        <div class="w-full row">
                            
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Jenis Survey</label>
                                    <select v-model="form.tipe" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected hidden>Pilih...</option>
                                        <option value="teks">Teks</option>
                                        <option value="pilihan">Pilihan</option>
                                        <option value="pilihan_ganda">Pilihan ganda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row w-full">
                                <template v-if="form.tipe == 'teks'">
                                    <Teks 
                                    ref="teksKomponentRef"
                                    @on-change="(value)=>{
                                        pertanyaan = value;
                                        tipe = 'teks'
                                    }"></Teks>
                                </template>
                                <template v-if="form.tipe == 'pilihan'">
                                    <Pilihan
                                    ref="pilihanKomponentRef"
                                    @on-change="(value)=>{
                                        pertanyaan = value.soal
                                        tipe = 'pilihan'
                                        listJawaban = value.jawaban
                                    }"></Pilihan>
                                </template>

                                <template v-if="form.tipe == 'pilihan_ganda'">
                                    <Pilihan
                                    ref="pilihanKomponentRef"
                                    @on-change="(value)=>{
                                        pertanyaan = value.soal
                                        tipe = 'pilihan_ganda'
                                        listJawaban = value.jawaban
                                    }"></Pilihan>
                                </template>
                                
                            </div>
                            <button @click="()=>{
                                simpanPertanyaan()
                                
                            }" class="btn btn-outline btn-primary">Tambah pertanyaan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end General data -->
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import Teks from '@/Pages/Ppdb/Jenis/Teks.vue';
import Pilihan from '@/Pages/Ppdb/Jenis/Pilihan.vue';

export default {
    components:{
        AuthenticatedLayout,Link,Teks, Pilihan
    },
    data() {
        return {
            form:useForm({
                tipe:'teks',
            }),
            pertanyaan:null,
            listJawaban:[],
            soalComponent:[{
                text:null,
                tipe:null,
                listJawaban:[]
            }]
        }
    },
    methods: {
        simpanPertanyaan(){
            if (this.soalComponent[0].text == null && this.soalComponent[0].tipe == null) {
                this.soalComponent.pop()
            }

            this.soalComponent.push({
                text:this.pertanyaan,
                tipe:this.form.tipe,
                listJawaban:this.listJawaban
            })
            this.clearValue()
            console.log(this.soalComponent)
        },
        clearValue(){
            switch (this.form.tipe) {
                case 'teks':
                        this.$refs.teksKomponentRef.pertanyaan = null;
                    break;
            
                default:
                    break;
            }


            this.pertanyaan = null;
            this.tipe = null;
            this.listJawaban = [];

            this.form.tipe = 'teks';
        }
    },
}
</script>