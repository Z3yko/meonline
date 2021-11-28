<template>
  <div class=" mx-auto w-full md:w-3/4 lg:w-1/2">
  <div name="form" class="mx-auto w-full md:w-3/4 shadow-lg p-5 md:p-10 text-gray-400 italic ">
      <div class="text-sm font-bold not-italic text-mygreenSDark border-b-1/2 border-gray-200 mb-2">Account user name</div>
      <div class="flex justify-between mb-3">
          <span>{{currentName}}</span>
          <button @click="updateUser" class="button is-small is-primary is-outlined">
            Change&nbsp;&nbsp;<i class="fas fa-pen"></i>
          </button>
      </div>

      <div v-if="updateUserName" class="transition-all ease-in-out duration-300">
          <div :class="nameBoxClass">
              <div class="text-xs font-bold not-italic text-gray-500">New user name</div>
              <span class=" text-xs italic text-gray-400 mb-1 inline-block">
                  This is the account user name, Not the display name
              </span>
              <div class="control has-icons-left w-3/4">
                  <input type="text" v-model="newName" @input="checkName" class="input is-small">
                  <span ref="nameSpinner" class="relative inline-block ml-3 mb-1"></span>
                  <span ref="nameMsg" class="inline-block text-xs ml-4 mt-2">{{nameMsg}}</span>
                  <span class="icon is-left"><i class="fas fa-user"></i></span>
              </div>
              <div class="buttons is-right mr-4">
                  <span :class="nameSendMsgClass">{{nameSendMsg}}</span>
                  <div class="flex">
                      <button @click="updateUserName = false" class="button is-warning is-outlined mt-4">Cancel </button>
                      <button @click="SendNewName" ref="nameSaveBtn" disabled class="button is-primary mt-4">&nbsp;Save&nbsp;</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="text-sm font-bold not-italic text-mygreenSDark border-b-1/2 border-gray-200 mb-2">Account Email</div>
      <div class="flex justify-between ">
          <span>{{currentEmail}}</span>
          <span v-if="isVerified == 1" class="text-mygreenDark mt-0.5 font-bold text-sm ">Verified</span>
          <span v-if="isVerified == 0" :disabled="verifyDisabled" @click="verifyEmail" :class="verifyClass">{{verifyBtnContent}}</span>
          <button @click="updateEmail" class="button is-small is-primary is-outlined">
            Change&nbsp;&nbsp;<i class="fas fa-pen"></i>
          </button>
      </div>
      <div class="not-italic text-sm text-mygreenSDark mb-3">{{verifyMsg}}</div>

            <div v-if="updateUserEmail" class="transition-all ease-in-out duration-300">
          <div :class="emailBoxClass">
              <div class="text-xs font-bold not-italic text-gray-500">New Account Email</div>
              <span class=" text-xs italic text-gray-400 mb-1 inline-block">
                  This is the Email used to login, Only you can see it
              </span>
              <div class="control has-icons-left w-3/4">
                  <input type="email" v-model="newEmail" @input="checkEmail" class="input is-small">
                  <span ref="emailSpinner" class="relative inline-block ml-3 mb-1"></span>
                  <span ref="emailMsg" class="inline-block text-xs ml-4 mt-2">{{emailMsg}}</span>
                  <span class="icon is-left"><i class="fas fa-user"></i></span>
              </div>
              <div class="buttons is-right mr-4">
                  <span :class="emailSendMsgClass">{{emailSendMsg}}</span>
                  <div class="flex">
                      <button @click="updateUserEmail = false" class="button is-warning is-outlined mt-4">Cancel </button>
                      <button @click="SendNewEmail" ref="emailSaveBtn" disabled class="button is-primary mt-4">&nbsp;Save&nbsp;</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="text-sm font-bold not-italic text-mygreenSDark border-b-1/2 border-gray-200 mb-2">Account Password</div>
      <div class="flex justify-between mb-3">
          <span>***********</span>
          <button @click="passwordBox = true" class="button is-small is-primary is-outlined">
            Change&nbsp;&nbsp;<i class="fas fa-pen"></i>
          </button>
      </div>

      <div v-if="passwordBox">
          <div ref="passwordBox" class="field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out">
              
                  <span class=" text-sm not-italic font-bold text-mygreenSDark mb-1.5 inline-block">
                      Here you can update your account password
                  </span>
              <div class="control has-icons-left w-3/4">
                  <label class="text-xs text-mygreenSDark font-bold not-italic">current password:</label>
                  <input type="password" v-model="currentPassword" class="input is-small">
                  <label class=" text-xs text-mygreenSDark font-bold not-italic">new password:</label>
                  <input type="password" v-model="newPassword" class="input is-small">
                  <label class=" text-xs text-mygreenSDark font-bold not-italic">repeat new pasword:</label>
                  <input type="password" v-model="CnewPassword" class="input is-small">
              </div>
              <span :class="passwordMsgClass" class="inline-block pt-4 font-bold not-italic text-sm">{{passwordMsg}}</span>
              <div class="buttons is-right mr-4">
                  
                  <div class="flex">
                      
                      <button @click="passwordBox = false" ref="closePasswordBox" class="button is-warning is-outlined mt-4">Cancel </button>
                      <button @click="sendNewPassword" ref="passwordSaveBtn" class="button is-primary mt-4">&nbsp;Save&nbsp;</button>
                  </div>
              </div>
          </div>
      </div>

  <!-- <div class="field">
      <label class="label">User Name</label>
      <span class=" text-sm italic text-gray-400">
          This is the account user name, Not the display name
      </span>
      <div class="control has-icons-left">
          <input type="text" class="input" :value="userName">
          <span class="icon is-left"><i class="fas fa-user"></i></span>
      </div>
  </div> -->


  </div>
  </div>
</template>

<script>
import axios from 'axios';
import {Spinner} from 'spin.js';
let spinner = new Spinner({
  lines: 80, // The number of lines to draw
  length: 0, // The length of each line
  width: 26, // The line thickness
  radius: 60, // The radius of the inner circle
  scale: 0.11, // Scales overall size of the spinner
  corners: 1, // Corner roundness (0..1)
  speed: 2.2, // Rounds per second
  rotate: 45, // The rotation offset
  animation: 'spinner-line-fade-quick', // The CSS animation name for the lines
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#10e5b5', // CSS color or array of colors
  fadeColor: 'transparent', // CSS color or array of colors
  top: '50%', // Top position relative to parent
  left: '50%', // Left position relative to parent
  shadow: '0 0 1px transparent', // Box-shadow for the lines
  zIndex: 2000000000, // The z-index (defaults to 2e9)
  className: 'spinner', // The CSS class to assign to the spinner
  position: 'absolute', // Element positioning
}).spin();

export default {
    data(){
        return{
            currentName: this.accountUser,
            newName: this.accountUser,
            email: null,
            updateUserName: false,
            nameMsg: null,
            userValid: null,
            nameSendMsg: null,
            nameSendMsgClass: '',
            nameBoxClass: '',
            updateUserEmail: false,
            currentEmail: this.accountEmail,
            newEmail: this.accountEmail,
            emailMsg: null,
            nameBoxClass: '',
            emailSendMsgClass: null,
            emailSendMsg: null,
            emailBoxClass: '',
            emailCheckCounter: 0,
            isVerified: this.emailVerified,
            verifyClass: 'button is-small is-warning is-rounded',
            verifyBtnContent: 'Verify',
            verifyMsg: null,
            verifyDisabled: false,
            passwordBox: false,
            currentPassword: null,
            newPassword: null,
            CnewPassword: null,
            passwordMsgClass: '',
            passwordMsg: null,
            
        }
    },
    methods:{
        closePasswordBox(){
            this.$refs.passwordBox.classList.remove('bg-redd-100');
            this.passwordBox = false;
            this.$refs.passwordBox.classList.remove('bg-green-100');
            this.passwordMsg= '';

        },
        sendNewPassword(e){
            if(this.newPassword == this.CnewPassword){
                if(this.newPassword.length > 0 || this.CnewPassword.length > 0){
                    axios({
                        method:'post',
                        url:'account/update-password',
                        data: {
                            'currentPassword': this.currentPassword,
                            'password': this.newPassword,
                            'password_confirmation': this.CnewPassword,
                            }
                    }).then(res=> {
                        this.passwordMsg = res.data.msg;
                        this.passwordMsgClass = 'text-mygreenSDark';
                        this.$refs.passwordBox.classList.add('bg-green-100');
                        setTimeout(()=>{
                            this.passwordBox = false;
                            this.$refs.passwordBox.classList.remove('bg-green-100');
                            this.passwordMsg= '';
                        },2000);
    
                    }).catch(err=> {
                        this.passwordMsg = err.response.data.errors.currentPassword[0];
                        this.passwordMsgClass = 'text-red-600';
                        this.$refs.passwordBox.classList.add('bg-red-100');
    
                    })
                }else{
                    this.passwordMsg = 'write the new password and confirm it !';
                    this.passwordMsgClass = ' text-red-600';
                    this.$refs.passwordBox.classList.add('bg-red-100');
                }
            }else{
                this.passwordMsg = 'password and repeated password doesn\'t match';
                this.passwordMsgClass = ' text-red-600';
                this.$refs.passwordBox.classList.add('bg-red-100');
            }

        },
        verifyEmail(e){
            
            if(this.verifyDisabled == false){
                this.verifyDisabled = true
            e.target.classList.add('is-loading')
            axios({
                method:'post',
                url:'/email/verification-notification',
            }).then(()=>{
                this.verifyClass = 'button is-small is-primary font-bold is-rounded is-outlined'
                this.verifyBtnContent = 'Sent'
                this.verifyMsg = `A verification email has been sent to ${this.currentEmail}`
                
            })
        }
        },
        updateUser(){
            this.nameBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out';
            this.updateUserName = true;
            
        },
        updateEmail(){
            this.emailBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out';
            this.updateUserEmail = true;
            
        },
        checkName(e){
            let name = e.target.value;
            let value = name.trim();
            if(value.length == 0){
                this.$refs.nameSaveBtn.disabled = true;
                this.$refs.nameMsg.classList.remove('text-mygreenSDark');
                this.$refs.nameMsg.classList.add('text-red-600');
                this.nameMsg = "A name cannot be blank"
                return;
            }else if(value.length < 2){
                this.$refs.nameSaveBtn.disabled = true;
                this.$refs.nameMsg.classList.remove('text-mygreenSDark');
                this.$refs.nameMsg.classList.add('text-red-600');
                this.nameMsg = "A name length cannot be less than 2"
                return;
            }else{
                spinner.spin()
                this.$refs.nameSpinner.appendChild(spinner.el);
                axios({
                    method: 'get',
                    url: `/${value}`
                }).then(res=>{
                    this.$refs.nameMsg.classList.remove('text-red-600');
                    this.$refs.nameMsg.classList.add('text-mygreenSDark');
                    this.nameMsg = res.data
                    this.userValid = true;
                    
                    this.$refs.nameSaveBtn.disabled = false;
                }).catch(err=>{
                    this.$refs.nameMsg.classList.remove('text-mygreenSDark');
                    this.$refs.nameMsg.classList.add('text-red-600');
                    this.nameMsg = err.response.data.msg;
                    this.userValid = false;
                    this.$refs.nameSaveBtn.disabled = true;
    
                }).then(()=> {
                spinner.stop();
                })
            }
            
        },SendNewName(){
            if(this.userValid == true){
                this.$refs.nameSaveBtn.disabled = true;
                axios({
                    method: 'post',
                    url: '/account/name',
                    data: {name: this.newName}
                }).then(res=> {
                    console.log(res);
                this.nameMsg = '';
                this.nameSendMsg = res.data.nameSendMsg;
                this.nameSendMsgClass = 'text-xs mr-3 not-italic text-mygreenSDark font-bold mr-20'
                this.userValid = false;
                this.currentName = this.newName;
                this.nameBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out bg-green-100'
                setTimeout(()=>{
                    this.updateUserName = false;
                    this.nameSendMsg = ''
                    this.nameBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out'
                },1500)

                }).catch(err=>{
                    this.nameMsg = '';
                    this.nameSendMsg = err.response.data.errors.name[0];
                    this.nameSendMsgClass = 'text-xs mr-3 not-italic text-red-600 font-bold mr-20'
                    this.userValid = false;
                    this.$refs.nameSaveBtn.disabled = true;
                    this.nameBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out bg-red-100'
                })
            }
        },
        checkEmail(e){
            if(e.target.value.length != 0){
            this.emailCheckCounter++;
            if(this.emailCheckCounter > 4){
            let email = e.target.value;
            let value = email.trim();
            spinner.spin()
            this.$refs.emailSpinner.appendChild(spinner.el);
            axios({
                method: 'post',
                url: `/account/email`,
                data: {'email': value}
            }).then(res=>{
                this.$refs.emailMsg.classList.remove('text-red-600');
                this.$refs.emailMsg.classList.add('text-mygreenSDark');
                this.emailMsg = res.data.emailSendMsg;
                this.userValid = true;
                
                this.$refs.emailSaveBtn.disabled = false;
            }).catch(err=>{
                this.$refs.emailMsg.classList.remove('text-mygreenSDark');
                this.$refs.emailMsg.classList.add('text-red-600');
                this.emailMsg = err.response.data.errors.email[0];
                this.userValid = false;
                this.$refs.emailSaveBtn.disabled = true;

            }).then(()=> {
            spinner.stop();
            })
            }
            }else{this.emailMsg = ''}
        },
        SendNewEmail(){
            if(this.userValid == true){
                this.$refs.emailSaveBtn.disabled = true;
                spinner.spin()
                this.$refs.emailSaveBtn.appendChild(spinner.el);
                axios({
                    method: 'post',
                    url: '/account/update-email',
                    data: {email: this.newEmail}
                }).then(res=> {
                    
                    this.verifyMsg = ``
                    console.log(res);
                    this.emailMsg = '';
                    this.emailSendMsg = res.data.emailSendMsg;
                    this.emailSendMsgClass = 'text-xs mr-3 not-italic text-mygreenSDark font-bold mr-20'
                    this.userValid = false;
                    this.currentEmail = this.newEmail;
                    this.emailBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out bg-green-100'
                    
                    setTimeout(()=>{
                        this.updateUserEmail = false;
                        this.emailSendMsg = ''
                        this.emailBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out'
                        this.isVerified = 0;
                        this.verifyClass = 'button is-small is-warning is-rounded'
                        this.verifyBtnContent = 'Verify'
                        this.verifyDisabled = false
                    },1800)

                }).catch(err=>{
                    this.emailMsg = '';
                    this.emailSendMsg = err.response.data.errors.email[0];
                    this.emailSendMsgClass = 'text-xs mr-3 not-italic text-red-600 font-bold mr-20'
                    this.userValid = false;
                    this.$refs.emailSaveBtn.disabled = true;
                    this.emailBoxClass = 'field mb-4 shadow-md border-gray-100 border-1 py-4 px-2 transition-all ease-in-out bg-red-100'
                }).then(()=>{
                    spinner.stop();
                })
            }
        },

    },
    props:[
        'accountUser',
        'accountEmail',
        'emailVerified',
    ],


}
</script>
