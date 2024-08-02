<template>
    <component :is="LayoutComponent">
        <div class="grid grid-cols-1 gap-6">
            <div class="w-full card p-4">
                <!-- card header -->
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Pembayaran tagihan</h5>
                            <p class="card-subtitle mb-0">
                                Pastikan data dan nominal yang dicatat sesuai dan valid
                            </p>
                        </div>
                    </div>
                <!-- end card header -->
                

                <!-- card body -->
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 row align-items-start"> 
                        <div class="col-lg-12 mb-4">
                            <div clas="mb-4">Nama Siswa</div>
                            <div class="fs-6 fw-bold text-primary">
                                {{ siswa.nama_lengkap }}
                            </div>
                            <p>Total tagihan {{ formattedTotalTagihan }}</p>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="form-floating mb-3 w-full">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="tb-fname"
                                    placeholder="nominal"
                                    v-model="form.nominal_terbayar"
                                />
                                <label for="tb-fname">Nominal</label>
                                <span class="text-end">{{ formatTagihan }}</span>
                            </div>
                            <span class="text-danger" v-show="errors.nominal_terbayar">{{ errors.nominal_terbayar }}</span>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <image-upload @image-uploaded="(value) => {
                                form.gambar_faktur = value
                            }"></image-upload>
                            <span class="text-danger" v-show="errors.gambar_faktur">{{ errors.gambar_faktur }}</span>
                        </div>


                        <div class="col-lg-12">
                            <button @click="postHandler" class="btn btn-primary float-end">
                                Bayar Tagihan
                            </button>
                        </div>

                    </div>
                <!-- end card body -->

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
    props:{
        tagihan:Object,
        siswa: Object
    },
    components:{
        SearchInput,KelasList
    },
    data() {
        return {
            form:useForm({
                '_method': "put",
                'nominal_terbayar' : 0,
                'tanggal_bayar' : this.$moment(this.$moment.now()).format('yyyy-M-d'),
                'gambar_faktur' : null,
                'tempat_bayar' : null,
                'teller' : null,
            }),
            errors:{}
        }
    },
    computed: {
        formatTagihan(){
            return this.$Helper.rupiah(this.form.nominal_terbayar)
        },
        formattedTotalTagihan(){
            return this.$Helper.rupiah(this.tagihan.nominal)
        }
    },
    watch: {
        
    },
    methods: {
        async postHandler(){
            try {
                const url = route('tagihan.bayar',{id: this.tagihan.id})

                const request = await axios.post(
                    url,
                    this.form,
                    {
                        headers: {'Content-Type': 'multipart/form-data'}
                    }
                )
                return this.$inertia.visit(route('tagihan.index'))
            } catch (error) {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                }
            }
        }
    },
}
</script>