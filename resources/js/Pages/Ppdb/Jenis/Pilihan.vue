<template>
    <div class="form-group mb-4 col-md-6">
        
        <div class="form-floating mb-3">
            <input
            type="text"
            class="form-control"
            id="tb-fname"
            placeholder="Nama"
            v-model="soalTemplate.soal"
            />
            <label for="tb-fname">Pertanyaan</label>
        </div>

        <div class="form-floating input-group mb-6" v-for="(item, index) in soalTemplate.jawaban" :key="index">
            <input
                type="text"
                class="form-control"
                id="tb-fname"
                placeholder="Jawaban"
                v-model="soalTemplate.jawaban[index]"
            />
            <button @click="hapusPilihanHandler(index)" class="btn btn-danger text-white" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg>
            </button>
            <label for="tb-fname">Jawaban {{ index + 1 }}</label>
        </div>
        
        <button @click="tambahPilihanHandler" class="btn btn-secondary">Tambah Jawaban</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pilihanJawaban:[],
            soalTemplate:{
                soal:null,
                jawaban:[null]
            },
        }
    },
    watch: {
        soalTemplate:({
            deep:true,
            handler(newVal){
                this.$emit('on-change',newVal);
            }
        })
    },
    methods: {
        tambahPilihanHandler(){
            this.soalTemplate.jawaban.push(null)
        },
        hapusPilihanHandler(index){
            this.soalTemplate.jawaban.splice(index,1)
        }
    },
}
</script>