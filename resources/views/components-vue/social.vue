<template>
    <div class="w-full">
        <div>
            <div class="border-b-2 border-gray-300 pb-2 -mt-4">
                <label class=" font-bold text-2xl text-gray-500">Social Accounts</label>
            </div>
            <div class="flex flex-wrap py-4">
                <div v-if="empty" class="text-gray-400 font-semibold">
                    You don't have any added social accounts, yet !
                </div>
                <div v-for="(link, app) in Accounts" :key="app">
                    <h4 class="relative left-8 text-red-400 transform scale-x-125 cursor-pointer font-bold" :name="app" @click="removeSocial">X</h4>
                    <a :href="app"><i
                    :class="'mx-2 text-'+painter(app)+' text-5xl fab fa-'+app.toLowerCase()"></i></a>
                </div>
            </div>
            <div class="border-t-1 border-gray-300 py-3">
                <label class=" font-bold text-lg text-gray-500">Add Social Accounts</label>
            </div>
            <div class="field has-addons">
                <div class="control">
                    <select v-model="select" class="select" @change="socialMessage = false">
                        <option value="Select One" default>Select One</option>
                        <option value="Twitter">Twitter</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Youtube">YouTube</option>
                        <option value="Snapchat">Snapchat</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Github">Github</option>
                        <option value="Discord">Discord</option>
                        <option value="Twitch">Twitch</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="LinkedIn">LinkedIn</option>
                    </select>

                </div>
                <div class="control">
                    <input type="text" :placeholder="placeHolder" v-model="input"  class="input">
                </div>
                <div class="control">
                    <a @click="addSocial" class="button is-primary">Add</a>
                </div>
            </div>
            <div class="field">
                <label class="text-red-500 font-bold" v-html="selectMsg"></label>
            </div>
        </div>

    </div>
</template>

<script>
const forOwn = require('lodash.forown');
const isEmpty = require('lodash.isempty')
let Social = {
    data(){
        return {
            input: '',
            select: "Select One",
            Accounts: {},
            selectMsg: '',

        }
    },
    computed:{
        empty(){
            return isEmpty(this.Accounts);

        },
        appColor(e){
            return e.target

        },
        defaultSocial(){
            return this.$store.getters.allStates.social
        },
        placeHolder(){
            if (this.select !== 'Select One') {
                return `Link to Your ${this.select} Account`;
            }else{
                return 'Choose a Social Platform'
            }
        }
    },
    methods:{

        painter(app){
        let color = '';
            switch (app) {
                case 'Youtube': color = 'red-500'; break;
                case 'Twitter': color = 'blue-400'; break;
                case "Facebook": color = 'blue-500'; break;
                case "Snapchat": color = 'yellow-300'; break;
                case "LinkedIn": color = 'blue-600'; break;
                case "Whatsapp": color = 'green-400'; break;
                case "Twitch": color = 'purple-400'; break;
                case "Github": color = 'gray-900'; break;
                case "Instagram": color = 'purple-500'; break;
                case 'Discord': color = 'indigo-500'; break;
                default:
                    break;
            }
            return color;
        },
        addSocial(){
            if(this.select !== 'Select One'){
                if(this.input !== ''){
                    if(this.input.toLowerCase().startsWith('https://')){
                        if(this.Accounts.hasOwnProperty(this.select)){
                            this.selectMsg = `You may use only one ${this.select} account`;
                        }else{
                        this.$set(this.Accounts,this.select, this.input)
                        this.$store.commit('updateSocial',this.Accounts);
                        this.selectMsg = ''
                        }
                    }else{
                        this.selectMsg = `Please enter a valid link,<br>not the ${this.select} user name itself
                        <br><span class="text-gray-400 italic text-sm">NOTE: A valid link starts with "https://"</span>`
                    }
                }else{
                this.selectMsg = `Please enter the link to your ${this.select} account`;
                }
            }else{
                this.selectMsg = `Please select an App`;
            }
        },
        removeSocial(e){
            console.log(e.target.getAttribute('name'));
          this.$delete(this.Accounts, e.target.getAttribute('name'));
        this.$store.commit('updateSocial',this.Accounts);
    },


    },
    created() {
        let currentSocial = this.defaultSocial;
        forOwn(currentSocial,(link,app)=>{
            this.Accounts[app] = link
        })

    },
    mounted(){

    },


    props:[

    ],
    components:{
        'btn': require('./utilities/general-btn.vue').default,
    }

}

export default Social;
</script>

