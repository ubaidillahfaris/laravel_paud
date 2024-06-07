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
                        Konfigurasi data program / layanan
                    </p>
                </div>
                <!-- end header -->
            </div>


            <!-- body -->
            <div class="py-2">
                <DataList></DataList>
            </div>
            <!-- end body -->
        </div>
        <!-- end card -->
            
          


        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link} from '@inertiajs/vue3';
import DataList from './DataList.vue';


export default {
    components:{
        AuthenticatedLayout,Link, DataList, 
    }
}
</script>