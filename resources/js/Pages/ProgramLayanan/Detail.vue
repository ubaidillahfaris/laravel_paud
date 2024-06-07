<template>
    <AuthenticatedLayout>
        <div class="row">

            <!-- card -->
            <div class="w-full card p-4">
                 
                
                <!-- header -->
                 <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">
                                    Program / Layanan
                                </h5>
                            <p class="card-subtitle mb-0">
                                Detail dan edit data program / layanan
                            </p>
                        </div>
                        <!-- end header -->
                </div>

                <!-- card body -->
                <div class="col">

                    <div class="row col-md-12">
                        <span class="col">Nama</span>
                        <span class="col">
                            <input
                                type="text"
                                class="form-control"
                                id="tb-fname"
                                v-model="programLayanan.name"
                                placeholder="Nama"/>
                        </span>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col">
                            <button @click="updateHandler" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                <!-- end card body -->

            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Toast from '@/Toast.js';
export default {
    props:{
        program_layanan: Object
    },
    components:{
        AuthenticatedLayout
    },
    data() {
        return {
            programLayanan: this.program_layanan
        }
    },
    methods: {
        async updateHandler(){

            Swal.fire({
                title: "Ubah data?",
                text: "Data akan diubah",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            })
            .then(async (result) => {
                try {
                    let request = await axios.put(route('program_layanan.update',{id: this.programLayanan.id}),this.programLayanan)
                    Toast.fire({
                        'icon':'success',
                        'title' : 'Data berhasil diubah'
                    })
                } catch (error) {
                    Toast.fire({
                        'icon':'error',
                        'title' : 'Data gagal diubah'
                    })
                }
            })
           
        }
    },
}
</script>