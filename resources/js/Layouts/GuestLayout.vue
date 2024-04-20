<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">    
        <slot />
    </div>
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components:{
        ApplicationLogo, Link
    }    
}
</script>