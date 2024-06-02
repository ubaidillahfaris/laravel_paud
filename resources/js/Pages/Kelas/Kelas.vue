<template>
    <AuthenticatedLayout>
        <div class="grid grid-cols-1 gap-6">

            <!-- card create kelas -->
            <div class="card w-25 bg-light-info  zoom-none shadow-none">
                <div class="card-body">
                <div class="row alig n-items-start">
                    <div class="col-8">
                    <h5 class="card-title mb-9 fw-semibold"> Buat data kelas </h5>
                    <div class="d-flex align-items-center pb-1">
                        <Link :href="route('kelas.create')" class="btn btn-primary">Create</Link>
                    </div>
                    </div>
                </div>
                </div>
            </div>



            <!-- card -->
            <div class="w-full card p-4">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    
                    <!-- card header -->
                       <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Data kelas</h5>
                            <p class="card-subtitle mb-0">
                                Manajemen daftar kelas
                            </p>
                            <div class="py-2"></div>
                        </div>
                    </div>

                    
                    <!-- content -->
    
                        <!-- tabel -->
                        <DataList></DataList>

                </div>




        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import DataList from '@/Pages/Kelas/DataList.vue';

export default {
    components:{
        Link,AuthenticatedLayout,DataList
    },
    data() {
        return {
            
        }
    },
    mounted() {
        
    },
    methods: {
        
    },
}
</script>