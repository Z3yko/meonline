<template>
    <div class="w-full">
        <div class="border-b-2 border-gray-300 pb-2 -mt-4">
            <label class=" font-bold text-2xl text-gray-500">Contact Phone</label>
        </div>
        <div v-if="update == false" class="" >

            <div class="flex flex-wrap text-gray-500 pt-6 pb-4">
                <h3 class="mr-5">{{currentNumberData}}</h3>
                <h3 class="border-b-2 border-gray-400 cursor-pointer" @click="updatePhone">Update Phone</h3>
            </div>
        </div>
        <div v-if="update == true" ref="updateForm" class="w-full my-8">


            <div v-if="true === false" class="mb-1 w-44">
                <div class="tabs">
                    <ul ref="ul" @click="phoneMethod">
                        <!-- is-active font-bold border-3 bg-blue-100 border-blue-400 -->
                      <li ref="call" class=""><a>Calls</a></li>
                      <li ref="message" class=""><a>Messages</a></li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="control">
                    <input class="input" autocomplete="one-time-code" ref="input"  inputmode="numeric">
                    <div :class="msgClass">{{msg}}</div>
                </div>
                <div class="control flex justify-between">
                    <a @click="verify" ref="btn" class="button font-bold is-primary mt-3" :disabled="verifyDisabled">Save</a>
                </div>
                <h3 @click="cancelClicked" class="font-bold underline cursor-pointer relative md:top-4 ml-3 inline-block"> Cancel</h3>
            </div>
            <div>

                <div class="w-1/2 min-w-70 p-3">
                    <input type="text" ref="otpInput" class="input" v-if="verifyBtnClicked == true">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const axios = require('axios').default;
import '../../css/int-tel.css';
import intlTelInput from 'intl-tel-input';
import 'bulma';

let Phones = {
    data(){
        return {
            msgORcall: '',
            contactNumber: null,
            phoneVerified: false,
            verifyBtnClicked: false,
            update: false,
            msg: '',
            msgIsError: null,
            verifyDisabled: true,



        }
    },
    computed:{
        currentNumberData(){
            return this.$store.getters.allStates.contactPhone
        },
        msgClass(){
            if (this.msgIsError === true) {
                this.msg = "Invalid Number";
                this.verifyDisabled = true;
                return "relative sm:top-2 sm:left-20 md:left-0 md:top-3 md:inline text-lg font-bold text-red-400";
            }else if(this.msgIsError === false){
                this.verifyDisabled = false;
                 this.msg = "Valid"
                return "relative sm:top-2 sm:left-20 md:left-0 md:top-3 md:inline text-green-500 text-lg font-bold";
            }
        }
    },
    methods:{
        updateCurrentPhone(newPhone){
            this.$store.commit('updatePhone', newPhone)
        },
        cancelClicked(){
            this.update = false;
            this.msgIsError = null;
            this.msg = '';
            this.verifyDisabled = true;
            this.verifyBtnClicked = false;
        },
        updatePhone(){
            this.update = true;
            this.$nextTick(()=>{
                let iti = intlTelInput(this.$refs.input, {
                    utilsScript: require('../../js/utils.js'),
                    separateDialCode: true,
                    initialCountry: "auto",
                    geoIpLookup: function (success){
                        fetch('http://ip-api.com/json')
                        .then( res => res.json() )
                        .catch( error => console.log(error.json()) )
                        .then( data => success(data.countryCode) )
                    }
                });

                    this.$refs.input.onkeyup = ()=>{
                        if (iti.isValidNumber()) {
                            this.msgIsError = false
                            this.contactNumber = iti.getNumber()
                        }else{
                            this.msgIsError = true
                        }

                    }
            })



        },
        phoneMethod(e){
            if (e.target.parentElement == this.$refs.call) {
                this.$refs.call.setAttribute('class','is-active font-bold border-3 bg-blue-100 border-blue-400')
                this.$refs.message.setAttribute('class','')
                this.msgORcall = 'call';
            }else{
                this.$refs.message.setAttribute('class','is-active font-bold border-3 bg-blue-100 border-blue-400')
                this.$refs.call.setAttribute('class','');
                this.msgORcall = 'message';
            }
        },
        verify(){
            this.phoneVerified = true
            // otpInput.setAttribute('class','hidden');
            this.$refs.input.setAttribute('class','Disabled input');
            this.$refs.btn.setAttribute('class','button font-bold is-success')
            this.$refs.btn.innerHTML = 'Verified';
            this.cancelClicked()
            this.update = false;
            this.$store.commit('updatePhone',this.contactNumber)
            // this.$store.infoForm.contactPhone = this.contactNumber

            this.verifyBtnClicked = false;
            // if (!this.verifyDisabled) {
            //     this.verifyBtnClicked = true;
            //     axios({
            //         method: 'POST',
            //         url: '/contact-phone-verifier',
            //         data:{
            //             phone: this.contactNumber
            //         }
            //     }).then(res=>{
            //         res = res.data;
            //         let otpInput = this.$refs.otpInput;
            //         otpInput.onkeyup = ()=>{
            //             if(otpInput.value.length == 4){
            //                 if(otpInput.value == '1234'){ //res.otp == otpInput.value
            //                     this.phoneVerified = true
            //                     otpInput.setAttribute('class','hidden');
            //                     this.$refs.input.setAttribute('class','Disabled input');
            //                     this.$refs.btn.setAttribute('class','button font-bold is-success')
            //                     this.$refs.btn.innerHTML = 'Verified';
            //                     this.cancelClicked()
            //                     this.update = false;
            //                     this.$store.commit('updatePhone',this.contactNumber)
            //                     // this.$store.infoForm.contactPhone = this.contactNumber

            //                     this.verifyBtnClicked = false;

            //                 }else{
            //                     otpInput.setAttribute('class','input is-danger');
            //                 }
            //             }
            //         }

            //     })
            // }
        }
    },

    mounted(){

  },


    props:[

    ],
    components:{
        'btn': require('./utilities/general-btn.vue').default,
    }

}

export default Phones;

</script>

