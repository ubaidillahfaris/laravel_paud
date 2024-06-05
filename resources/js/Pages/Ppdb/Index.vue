<template>
     <AuthenticatedLayout>
           <div class="row">
               <div class="col-lg-12 d-flex align-items-strech">
               
               </div>
               <div class="col-lg-4">
               <div class="row">
                   <div class="col-lg-12 col-md-6 col-sm-12">
                   <!-- Monthly Earnings -->
                   <div class="card">
                       <div class="card-body">
                       <div class="row alig n-items-start">
                           <div class="col-8">
                           <h5 class="card-title mb-9 fw-semibold"> Buat PPDB Baru </h5>
                           <div class="d-flex align-items-center pb-1">
                               <Link :href="route('ppdb.create')" class="btn btn-primary">Create</Link>
                           </div>
                           </div>
                           <div class="col-4">
                           <div class="d-flex justify-content-end">
                               <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                               <i class="ti ti-currency-dollar fs-6"></i>
                               </div>
                           </div>
                           </div>
                       </div>
                       </div>
                       <div id="earning"></div>
                   </div>
                   </div>
               </div>
               </div>
           </div>
           <!--  Row 3 -->
           <div class="row">
             
            <!-- List data gelombang -->
            <div class="col-lg-12 d-flex align-items-strech">
                <DataList></DataList>
            </div>
            <!-- end list data gelombang -->
                   
        </div>
               
   </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link} from '@inertiajs/vue3';
import DataList from '@/Pages/Ppdb/DataList.vue';

export default {
    components:{
        AuthenticatedLayout,Link,DataList
    },
   
   
   
   
}
</script>