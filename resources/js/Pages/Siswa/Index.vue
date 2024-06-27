<template>
    <AuthenticatedLayout>
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
                     <!-- table -->
                        <DataList :kelas_id="kelas_id"></DataList>
                     <!-- end table -->

            </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link, useForm} from '@inertiajs/vue3';
import axios from 'axios';
import DataList from './DataList.vue';

export default {
    components:{
        Link,AuthenticatedLayout,DataList
    },
    props:{
        kelas_id:Number
    },
}
</script>