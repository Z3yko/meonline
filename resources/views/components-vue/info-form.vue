<template>
    <div class="w-full lg:w-3/4 max-w-700 mx-auto  bg-white pt-5">
    <div>
        <div class=" m-4 p-4 pb-6 border-b-3 border-gray-200">
            <div class="field ">
                <div class="border-b-2 border-gray-100 mb-5 -mt-4">
                    <label class=" font-bold text-2xl text-gray-500">Display Name</label>
                </div>
                <div class="control has-icons-left">
                    <input type="text" class="input" name="updateName" v-model="DdisplayName">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
            </div>
        </div>


        <div class=" m-4 p-4 pb-6 border-b-3 border-gray-200">
            <div class="field ">
                <div class="border-b-2 border-gray-100 mb-5  -mt-4">
                    <label class=" font-bold text-2xl text-gray-500">Location</label>
                </div>
                <div class="control has-icons-left">
                    <input type="text" placeholder="Location" name="updateLocation" v-model="Dlocation" class="input">
                    <span class="icon is-small is-left">
                        <i class="fas fa-map-marker"></i>
                    </span>
                </div>
            </div>
        </div>


        <div class=" m-4 p-4 pb-6 border-b-3 border-gray-200">
            <div class="field ">
                <div class="border-b-2 border-gray-100 mb-5  -mt-4">
                    <label class=" font-bold text-2xl text-gray-500">Bio</label>
                </div>
                <div class="control has-icons-left">
                    <textarea ref="bio" type="text" name="updateBio" v-model="Dbio" placeholder="About You..." class="textarea"></textarea>
                    <span class="icon is-small is-left">
                        <i class="fas fa-about"></i>
                    </span>
                </div>
                <span ref="counter" class="font-bold" :class="warningCounter"></span>
            </div>
        </div>



        <div class=" m-4 p-4 pb-6 border-b-3 border-gray-200">
            <div class="field ">
                <div class="border-b-2 border-gray-100 mb-5  -mt-4">
                <label class=" font-bold text-2xl text-gray-500">Contact Email</label>
            </div>
                <div class="control has-icons-left">
                    <input type="text" placeholder="example@email.com" class="input" name="updateContactEmail" v-model="DcontactEmail">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class=" mt-6 border-t-4 bg-white border-mygreenDark shadow-lg py-6 px-5">
            <phone></phone>
        </div>

        <div class=" mt-6 border-t-4 bg-white border-mygreenDark shadow-lg py-6 px-5">
            <social :currentApps="social"></social>
        </div>

        <div class=" mt-6 border-t-4 bg-white border-mygreenDark shadow-lg py-6 px-5">
            <websites></websites>
        </div>

    <div class="w-full my-10  flex shadow-2xl border-mygreenDark  border-b-6 justify-between pt-5 pb-12 px-16 ">
        <div>
            <div v-if="sendSuccess == true">
                <label class="font-bold text-2xl text-green-600">Profile updated <i class="fas fa-check text-2xl"> </i> </label>
            </div>
            <div v-else-if="sendSuccess === false" class="rounded-lg m-3 font-bold text-xl text-red-800 bg-red-100 border-red-900 border-2 p-2">
                <ul>
                    <li v-for="error in errors" :key="error">
                        {{error}}
                    </li>
                </ul>
            </div>
        </div>
        <button class=" button is-large is-success" @click="sendForm"> Save Changes</button>
    </div>


    </div>



    </div>
</template>

<script>

const forOwn = require('lodash.forown');
// import { mapMutations } from 'vuex'
import '../../css/int-tel.css';
import axios from 'axios';
let InfoForm = {
    data(){
        return {
            warningCounter: '',
            sendSuccess: null,
            errors: null,
            DdisplayName: this.name,
            Dlocation: this.location,
            Dbio: this.bio,
            DcontactEmail: this.ContactEmail,
        }
    },
    computed:{

        allStates(){
            return this.$store.getters.allStates
        }
    },
    methods:{

        sendForm(e){
            e.target.classList.add("is-loading")
            let sender = axios.post('/update-user-info',{
                name: this.DdisplayName,
                email: this.DcontactEmail,
                phone: this.allStates.contactPhone,
                location: this.Dlocation,
                bio: this.Dbio,
                social: this.allStates.social,
                websites: this.allStates.websites,
                })
                .then( res =>{
                    this.sendSuccess = true
                    console.log(res.data)})
                .catch( err => {
                    // let errors = err.response.data.errors
                    let e = []
                    let errors = err.response.data.errors
                    forOwn(errors,arr=>{
                        arr.forEach(el => {
                            e.push(el)
                        });
                    })
                    this.errors = e
                    this.sendSuccess = false


                })
                .then(res =>  e.target.classList.remove("is-loading"))

        },

        defaultStates(){
            this.$store.commit('updatePhone', this.phone)
            this.$store.commit('updateSocial', JSON.parse(this.social))
            this.$store.commit('updateWebsites', JSON.parse(this.websites))
        }
    },
    created() {
        this.defaultStates()
    },
    mounted(){
        (()=>{
            let element = this.$refs.bio;
            let counter = this.$refs.counter;
            let maxChars = 70;
            counter.innerHTML = `Max: ${maxChars}`
            window.onkeyup = ()=>{
                setTimeout(()=>{
                    let count = element.value.length;
                    if (count > 0){
                        counter.innerHTML = `${count}/${maxChars}`;
                    }else{
                        counter.innerHTML = `Max: ${maxChars}`
                    }
                    if (count > maxChars){
                        this.warningCounter = 'text-red-600';
                    }else{
                        this.warningCounter = '';
                    }
                },0)
            }
        })();
    },
    props:[
        'name',
        'location',
        'bio',
        'ContactEmail',
        'phone',
        'social',
        'websites',

    ],
    components:{
        'btn': require('./utilities/general-btn.vue').default,
        'phone': require('./phones.vue').default,
        'social': require('./social.vue').default
    }

}

export default InfoForm;
</script>
