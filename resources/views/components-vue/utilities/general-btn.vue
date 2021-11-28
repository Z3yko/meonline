<template>

    <button ref="genbtn" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
    {{ value }}
</button>


</template>

<script>

export default {
    data(){
        return {

            
        }
    },
    computed:{

    },
    methods:{
            //..
      
    },
    mounted(){

        },
    props:[
        'value',
    ]
}
</script>