<template>
    <div class="mb-3">
        <label>{{ label }}</label>
        <v-select class="col-12" :options="items" @option:selected="onChangeEvent($event)" @open="openOptionHandler" :filterable="true" @search="onSearch">
        </v-select>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:{ 
        url:String,
        itemIndex:Array,
        label: {
            default: 'Option label',
            type: String
        },
    },
   mounted() {
   },
   data() {
        return {
            items:[]
        }
   },
    methods: {
        async openOptionHandler(){
          const request = await axios.get(this.url);
          const response = request.data;
          this.items = response.map((item)=>{
            return{
                'code' : item[this.itemIndex[0]],
                'label' : item[this.itemIndex[1]],
            }
          })
        },
        onChangeEvent(event){
            this.$emit('on-change',event.code);
        },
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