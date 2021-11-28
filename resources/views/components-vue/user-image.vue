<template>
    <div>
        <!-- <div @click="removeImage" class="w-10 relative bottom-80 md:bottom-64 left-72 md:left-96 text-right font-bold text-3xl text-red-800 transform scale-x-125 cursor-pointer " title="Remove Photo">X</div> -->
        
        <div ref="imgRef" @click="imageMenu = true"  class=" group w-52 h-52 bottom-96 md:w-80 md:h-80 overflow-hidden md:bottom-72 rounded-full shadow-2xl cursor-pointer border-8 mx-auto relative border-mygreenDark border-t-3 pt-24 text-center text-xl text-gray-100 bg-cover">   
           <div v-if="imageMenu" class="w-40 border-1 border-gray-200 shadow-xl relative bottom-10 left-4 rounded-xl z-50 bg-white  text-right md:text-left font-bold text-lg text-mygreenSDark cursor-pointer md:-bottom-5 md:-left-2 md:w-80 ">
            <ul class="list-none">
                <li class="text-center p-2 md:p-8 hover:bg-gray-200" @click="modalOpener">Update Image</li>
                <li class="text-center p-2 md:p-8 text-red-400 hover:bg-gray-200" @click="removeImage">Delete Image</li>
            </ul>
        </div>
            <div class="spinner" ref="spinner"></div>
            
            <div class="relative top-10 right-2 text-red-400 font-bold bg-gray-800 bg-opacity-50 rounded-full" ref="err"></div>

        </div>
       
            
        <div class="m-0 visible transition-all ease-in-out relative z-50">
            <div :class="activeModal">
            <div class="modal-background" @click="closeModal"></div>
            <div class="modal-content">
                <div class="bg-gray-200 p-8 flex flex-wrap justify-between">
                    <input value="" ref="input" type="file" class="py-2">
                    <btn ref="cropbtn" value="Save" class="py-2"></btn>
                </div>
            <div class="bg-gray-200 px-4 pb-4">
                <div ref="imgDiv"></div>
            </div>
            <button @click="closeModal" class="modal-close is-large" aria-label="close"></button>
        </div> 
          
        </div>
      
        </div>
    </div>



</template> 

<script>
import {Spinner} from 'spin.js';
let opts = {
  lines: 13, // The number of lines to draw
  length: 0, // The length of each line
  width: 30, // The line thickness
  radius: 45, // The radius of the inner circle
  scale: 1, // Scales overall size of the spinner
  corners: 1, // Corner roundness (0..1)
  speed: 2, // Rounds per second
  rotate: 0, // The rotation offset
  animation: 'spinner-line-fade-quick', // The CSS animation name for the lines
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#ffffff', // CSS color or array of colors
  fadeColor: 'transparent', // CSS color or array of colors
  top: '50%', // Top position relative to parent
  left: '50%', // Left position relative to parent
  shadow: '0 0 1px transparent', // Box-shadow for the lines
  zIndex: 2000000000, // The z-index (defaults to 2e9)
  className: 'spinner', // The CSS class to assign to the spinner
  position: 'absolute', // Element positioning
};


let spinner = new Spinner(opts);
require('../../css/spinner.css');
 import axios from 'axios';
import Cropper from 'cropperjs';
let UserImage = {
    data(){
        return {
            imageObj:null,
            imageURI: null,
            cropper: null,  
            croppedImage: null,
            activeModal: 'modal',
            imgSrc: this.vsrc,
            imageBlob: null,
            imageMenu: false,
            
            
        }
    },
    computed:{

    },
    methods:{
        removeImage(){
            
            this.$refs.imgRef.style.backgroundImage = `url(${this.userAvatar})`;
            axios.post('/upload', {remove: 1, image: 'no'})
            setTimeout(()=>{
                this.imageMenu = false 
            }, 200)
            

        },
        closeModal(){
            this.activeModal = 'modal'
            
        },
        modalOpener(){
            this.activeModal = "modal is-active"
            setTimeout(()=>{
                this.imageMenu = false 
            }, 200)
        }
    },
    
    mounted(){
        window.addEventListener('click',(e)=>{
            if(e !== this.$refs.imgRef){
                this.imageMenu = false
            }
        },true)
        //     let content = `<img src=${this.vsrc} class='${this.vclass}' width='300'>
            // let img = "background-image: url('{{this.vsrc}}')"
            
            if(this.imgSrc.endsWith('.png')){
                this.$refs.imgRef.style.backgroundImage = `url(${this.imgSrc})`;
            }else{
                this.$refs.imgRef.style.backgroundImage = `url(${this.userAvatar})`;
            }
    this.$refs.input.onchange = (event)=>{
    try{
        this.$refs.imgDiv.textContent = '';
        cropper.destroy();
    }catch{}
    if(event.target.files[0] || event.target.files.length > 0){
            let imageFile = event.target.files[0];
            this.imageURI = URL.createObjectURL(imageFile);
            this.imageObj = new Image();
            this.imageObj.src = this.imageURI;
            this.$refs.imgDiv.appendChild(this.imageObj);
            this.imageObj.onload = ()=>{
            
            let cropper = new Cropper(this.imageObj,{        
                aspectRatio: 1 / 1,
                dragMode: 'move',
                viewMode: 3,
            })
                
            this.$children[0].$refs.genbtn.onclick= ()=>{
                let croppedURI = cropper.getCroppedCanvas({height:800, width:800}).toDataURL();
                this.activeModal = 'modal'
                cropper.getCroppedCanvas({height:500, width:500}).toBlob(blob=>{
                    let data = new FormData();
                    data.append('image',blob);
                    data.append('remove', 0)
                    spinner.spin(this.$refs.spinner);
                    
                    axios({
                    method: 'post',
                    url: '/upload',
                    data,
                    headers: {'Content-Type': 'multipart/form-data'}
                    })
                    .then(res=>{
                        this.$refs.err.innerHTML = '';
                        this.$refs.imgRef.style.backgroundImage = `url(${croppedURI})`;
                        console.log(res.data);
                    }).catch(err=>{
                        this.$refs.err.innerHTML = 'Faild to Upload, Try Again';
                        console.log(err.response);
                    }).then(res=> {
                    
                    spinner.stop()
                    })
                })
            }
        }
    }
}
        },
    props:[
        'vclass',
        'vsrc',
        'userAvatar'
    ],
    components:{
        'btn': require('./utilities/general-btn.vue').default,
    }
   
}

export default UserImage;
</script>