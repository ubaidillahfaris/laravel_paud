<template>
<component :is="LayoutComponent">
    <div class="grid grid-cols-1 gap-6">

        <div class="w-full card p-4">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
                <!-- card header -->
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Buat tagihan baru</h5>
                    <p class="card-subtitle mb-0">
                        Isi data siswa dan jumlah tagihan
                    </p>
                </div>
            </div>
        </div>
    </div>
</component>
</template>

<script>
import {useForm} from '@inertiajs/vue3';
import axios from 'axios';

export default {
    async created() {
        const layoutPath = this.userRole === 'admin'
            ? '@/Layouts/Admin/Layout.vue'
            : '@/Layouts/Guru/Layout.vue';

        this.LayoutComponent = (await import(layoutPath)).default;
    },
    data() {
        return {
            
        }
    },
}
</script>