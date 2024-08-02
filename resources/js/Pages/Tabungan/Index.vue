<template>
    <component :is="LayoutComponent">

        <div class="grid grid-cols-1 gap-6">
    
    
        <div class="w-full card p-4">
            
            <!-- card header -->
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
            
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Tabungan</h5>
                    <p class="card-subtitle mb-0">
                        manajemen tabungan siswa
                    </p>
                </div>
                
            </div>
            <!-- end card header -->
            </div>
        </div>
    </component>
</template>

<script>
import {Link, useForm} from '@inertiajs/vue3';
import StringManipulation from '@/StringManipulation.js'
import Pagination from '@/Components/Pagination.vue';
import FilterTabel from '@/Pages/Kelas/FilterTabel.vue';
import KelasList from '../../Components/KelasList.vue';

export default {
    props:{
        user_role:String
    },
    components:{
        Link,Pagination,FilterTabel,KelasList
    },
}
</script>