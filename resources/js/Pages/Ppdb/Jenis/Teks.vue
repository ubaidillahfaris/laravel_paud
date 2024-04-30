<template>
   <div class="col-md-6">
        <div class="form-floating mb-3">
            <input
            type="text"
            class="form-control"
            id="tb-fname"
            placeholder="Nama"
            v-model="pertanyaan"
            />
            <label for="tb-fname">Pertanyaan</label>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            pertanyaan:null
        }
    },
    watch: {
        pertanyaan(newVal){
            this.$emit('on-change',newVal)
        }
    },
}
</script>