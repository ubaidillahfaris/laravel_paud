<template>
   <select v-model="selectedKelas" class="form-select">
        <option :value="null" selected>Pilih Kelas</option>
        <option :value="item.id" v-for="(item, index) in data" :key="index">
            {{ item.nama }}
        </option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            data:[],
            selectedKelas:null
        }
    },
    mounted() {
        this.fetchData()
    },
    watch: {
        selectedKelas(value){
            this.$emit('on-change',value)
        }
    },
    methods: {
        async fetchData(){
            const request = await axios.get(route('kelas.show_all'));
            if (request.status == 200) {
                const response = request.data
                this.data = response;
            }
        }
    },
}
</script>