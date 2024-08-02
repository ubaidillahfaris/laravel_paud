<template>
    <v-search 
    v-model="searchVal"
    shortcutKey="/"
    ></v-search>
</template>

<script>
export default {
   data() {
    return {
        searchVal:''
    }
   },
   watch: {
    searchVal(newVal){
        this.$emit('on-search',newVal)
    }
   },
}
</script>