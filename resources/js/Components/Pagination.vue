<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item" :class="{
                'disabled' : item.url == null
            }" v-for="(item, index) in linksData" :key="index">
                <button @click="onClick(item.url)"
                    class="page-link"
                    tabindex="-1"
                    aria-disabled="true"
                    >
                    <span v-html="item.label"></span>
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props:{
        linksData:Array
    },
    mounted() {
      
    },
    methods: {
        onClick(url){
            this.$emit('on-click',url)
        }
    },
}
</script>