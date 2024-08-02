<template>
    <v-select v-model="selectedSiswa" :options="optionData" :filterable="false" @search="onSearch">
    </v-select>
</template>

<script>
export default {
    props:{
        kelasId:{
            type:Number,
        }
    },
    data: () => ({
        response:{},
        search: null,
        selectedSiswa:{
            code: null,
            label:null
        }
    }),
    watch: {
        kelasId(newVal){
            this.fetchSiswa()
        },
        selectedSiswa(newVal){
            this.$emit('on-change',newVal)
        }
    },
    computed: {
        optionData() {
            const siswaList = this.response.data;
            if (siswaList != null && siswaList.length > 0) {
                return siswaList.map((item) => {
                    return {
                        code: item.id,
                        label: item.nama_lengkap
                    }
                })
            }
            return [];
        },
        paginated() {
            return this.filtered.slice(this.offset, this.limit + this.offset)
        },
        hasNextPage() {
            const nextOffset = this.offset + this.limit
            return Boolean(
                this.filtered.slice(nextOffset, this.limit + nextOffset).length
            )
        },
        hasPrevPage() {
            const prevOffset = this.offset - this.limit
            return Boolean(
                this.filtered.slice(prevOffset, this.limit + prevOffset).length
            )
     },
    },
    beforeMount() {
        this.fetchSiswa()
    },
    methods: {
        onSearch(query) {
            this.search = query
            this.fetchSiswa()
        },
        async fetchSiswa(){

            let param = {
                search: this.search
            };

            const url = route('siswa.show',{
                kelas_id: this.kelasId,
                _query:param
            });
            const request = await axios.get(url);
            this.response = request.data
        }
    },
}
</script>

<style scoped>
.pagination {
  display: flex;
  margin: 0.25rem 0.25rem 0;
}
.pagination button {
  flex-grow: 1;
}
.pagination button:hover {
  cursor: pointer;
}
</style>