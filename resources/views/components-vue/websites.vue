<template>
    <div class="w-full">
        <div>
            <div class="border-b-2 border-gray-300 pb-2 -mt-4">
                <label class=" font-bold text-2xl text-gray-500">Websites \ Links</label>
            </div>
            <div class="my-5">
                <div v-if="empty" class="text-gray-400 font-semibold">
                    You don't have any added links, yet !
                </div>
                <div v-for="(link, name) in websites" :key="name">
                    <div class="flex items-center w-full">
                        <h2 @click="removeWebsite" :name="name" class="transform cursor-pointer scale-x-125 text-red-500 mr-2 font-bold text-xl">X</h2>
                        <a :href="link" class="block transition-all rounded-lg bg-gray-100 hover:bg-gray-200 py-3 mb-1 px-4">
                            <div class="flex items-center">
                                <h3 class="text-md text-mygreenSDark mr-2 font-bold overflow-hidden">{{name}}</h3>
                                <span class="text-mygreenDark mr-1/2 text-3xl">|</span>
                                <span class="text-sm text-gray-400 relative ">{{link}}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t-1 border-gray-300 py-3">
                <label class=" font-bold text-lg text-gray-500">Add a Link</label>
            </div>
            <div class="field">
                <div class="control w-3/4">
                    <div class="text-md text-mygreenSDark font-semibold w-full">Name:</div>
                    <input type="text" v-model="websiteName" class="input" placeholder="e.g. My Website">
                </div>
                <div class="control mt-3">
                    <div class="text-md text-mygreenSDark font-semibold w-full">Link:</div>
                    <input type="text" class="input" v-model="websiteLink" placeholder="e.g. https://www.mywebsite.com">
                    <span class="text-red-600 text-sm font-semibold" v-html="websiteMsg"></span>
                </div>
                <div class="control mt-4">
                    <button class="button is-primary" @click="addWebsite">Add</button>
                </div>
               
            </div>

        </div>
    </div>
</template> 

<script>
const isEmpty = require('lodash.isempty');
let Websites = {
    data(){
        return {
            websites: {},
            websiteName: '',
            websiteLink: '',
            websiteMsg: '',
        }
    },
    computed:{
        empty(){
            return isEmpty(this.websites);
        },
        currentWebsites(){
            return this.$store.getters.allStates.websites
        }
    },
    methods:{
        removeWebsite(e){
            this.$delete(this.websites, e.target.getAttribute('name'))
            this.$store.commit('updateWebsites',this.websites)
        },
        addWebsite(e){
            
            if(Array.isArray(this.websites)){this.websites = {}}
            if(this.websiteName.length || this.websiteLink.length){
                if(this.websiteLink.toLowerCase().startsWith('https://')){
                    this.$set(this.websites, this.websiteName, this.websiteLink)
                    this.$store.commit('updateWebsites',this.websites)
                }else{
                    this.websiteMsg = `Please enter a valid link.
                    <br><span class="text-gray-400 italic text-sm">A valid link starts with "https://"</span>`

                }
            }else{
                this.websiteMsg = 'Please enter a website name and a link to it';
            }
            
        
        }
    },
    created() {
        this.websites = this.currentWebsites;
    },
    mounted(){
        
    },

 
    props:[

    ],
    components:{
        'btn': require('./utilities/general-btn.vue').default,
    }
   
}

export default Websites;
</script>

