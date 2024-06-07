<template>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-2 py-8" >
                <select v-model="selectedLength" class="form-select">
                    <option :value="item" v-for="(item, index) in lengthData" :key="index">
                        {{ item }}
                    </option>
                </select>
            </div>
            <div class="col-3 py-8">
                <input
                    type="text"
                    class="form-control"
                    id="tb-fname"
                    placeholder="Search..."
                    v-model="search"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selectedLength : 10,
            search:null
        }
    },
    computed: {
        lengthData(){
            let data = [];
            for (let i = 0; i <= 100; i++) {
                if (i == 10) {
                    data.push(10)
                }
                else if(i % 25 == 0 && i != 0){
                    data.push(i)
                }
            }

            return data;
        }
    },
    watch: {
        selectedLength(newVal){
            this.$emit('on-length-change',newVal);
        },
        search(newVal){
            this.$emit('on-search',newVal)
        }
    },
}
</script>