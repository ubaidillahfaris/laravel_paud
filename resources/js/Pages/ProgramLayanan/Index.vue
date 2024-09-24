<template>
    <AuthenticatedLayout>
        <div class="row">

            <!-- card -->
            <div class="w-full card p-4">
                
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Form Program Layanan</h5>
                                <p class="card-subtitle mb-0">
                                    Isi formulir program layanan
                                </p>
                                <div class="py-2"></div>
                            </div>
                        </div>
                        <div class="w-full row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="tb-fname"
                                            name="Program Layanan"
                                            v-model="form.name"
                                        />
                                        <label for="tb-fname">Nama Program Layanan</label>
                                    </div>
                                    <label class="h6 text-danger" v-if="errors['name']">
                                        {{ errors['name'][0] }}
                                    </label>
                                </div>
                                <button @click="postData" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z" clip-rule="evenodd"/></svg>
                                    Simpan
                                </button>
                            </div>
                            
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                
            </div>


            <!-- body -->
            <div class="w-full card p-4">
                <DataList></DataList>
            </div>
            <!-- end body -->
        </div>
        <!-- end card -->
            
          
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import DataList from './DataList.vue';
import Toast from '@/Toast';
import axios from 'axios';

export default {
    components:{
        AuthenticatedLayout,Link, DataList, 
    },
    data() {
        return {
            errors:{},
            form:useForm({
                name:null
            })
        }
    },
    beforeMount() {
        
    },
    methods: {
        async postData(){
            try {
                const request = await axios.post(route('program_layanan.store'),this.form);
                this.$inertia.visit(route('program_layanan.index'));
                Toast.fire({
                    'icon':'success',
                    'title' : 'Berhasil menambahkan program layanan'
                })
            } catch (error) {

                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                }

                Toast.fire({
                    'icon':'error',
                    'title' : 'Gagal menambahkan program layanan'
                })
            }
        }
    },
}
</script>