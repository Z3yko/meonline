<template>
<div id="container" class="mx-auto shadow-2xl p-6 mb-6 w-full md:w-1/2 mt-6">
<h1 class="text-2xl text-mygreenDark">Make your card and download it</h1>
    <div @click="card_direct($event)" class="tabs w-52">
        <ul class="mx-auto">
            <li><a id="vert">Vertical</a></li>
            <li><a id="hori">Horizental</a></li>
        </ul>
    </div>
    <h1 class="text-2xl text-mygreenDark border-b-1">Include in the card:</h1>
    <div class="flex mt-2">
        <input type="checkbox" @change="image_clicked" ref="c_image" :checked="d_image">&nbsp;
        <label>Photo</label>&nbsp;&nbsp;&nbsp;
        <input type="checkbox" @change="phone_clicked" ref="c_phone" :checked="d_phone">&nbsp;
        <label>Phone</label>&nbsp;&nbsp;&nbsp;
        <input type="checkbox" @change="email_clicked" ref="c_email" :checked="d_email">&nbsp;
        <label>Email</label>&nbsp;&nbsp;&nbsp;
        <input type="checkbox" @change="bio_clicked" ref="c_bio" :checked="d_bio">&nbsp;
        <label>Bio</label>
    </div>

<!--Vertical card-->
    <div id="card" v-if=" card_direction === 'vert' " class="border-1 p-5 border-gray-100 mt-4 relative shadow-lg w-64 h-96">
        <div v-if="d_image" class="overflow-hidden relative rounded-full w-24 mt-5 mx-auto shadow-xl">
            <img  :src="this.imgSrc" >
        </div>
        <h2 v-if="!d_image"><br><br><br></h2>
            <h1 v-if="d_d_name" class="mx-auto text-center text-lg font-bold mt-3">{{this.d_name}}</h1>
            <h2 v-if="d_bio" class="mx-auto text-center">{{this.bio}}</h2>
            <h2 v-if="!d_phone"><br></h2>
            <h3 v-if="d_phone" class="mx-auto text-center mt-5  text-xs">{{this.phone}}</h3>
            <h3 v-if="d_email" class="mx-auto text-center text-xs">{{this.email}}</h3>
        <div ref="qr_div_vert" class="transform scale-25 mx-auto -mt-12 ">
            <canvas  ref="qrcode" class="mx-auto"></canvas>
        </div>
    </div>
<!--    Horizental card-->
        <div id="card" v-if="card_direction === 'hori'" class="card h-48 mt-4 w-80  border-gray-200 border-0.5">

            <div class="card-content relative">
                <div class="media ">
                    <div v-if="d_image" class="media-left">
                        <figure class="image is-64x64">
                            <img  :src="this.imgSrc" alt="Placeholder image">

                        </figure>
                    </div>

                    <div ref="hori_titles" class="media-content mx-auto py-2 -mt-2">
                        <p ref="hori_name" class="title is-6">{{this.d_name}}</p>
                        <p v-if="d_bio" class=" text-xs -mt-4">{{this.bio}}</p>
                    </div>
                </div>

                <div class="content flex  h-12 ">
                    <span  class="text-xs block ">
                        <span v-if="d_phone">
                        {{this.phone}}
                        </span>
                        <br>
                        <span v-if="d_email">
                        {{this.email}}
                        </span>
                    </span>
                    <div ref="hori_qr_div" class="transform scale-25 -mt-6">
                        <canvas  ref="hori_qrcode" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2 mx-auto mt-6 -mb-4 ">
            <input @click="makeClicked" type="button" class="button is-success is-large " value="Make Card">
        </div>


</div>
</template>

<script>
const QRCode = require('qrcode')
import 'bulma';
import h2c from "../../js/html2canvas.js";
export default {
    name: "cardmaker",
    data(){
        return {
            d_d_name: true,
            d_phone: true,
            d_email: true,
            d_image: true,
            d_bio: true,
            imgSrc: '',
            card_direction: "hori",


        }
    },
    computed:{

    },
    methods:{
        makeClicked(){
            h2c(document.querySelector('#card'))
            .then(res=>{
                let image = res.toDataURL();
                let link = document.createElement('a');
                link.href = image;
                link.download = 'card.png';
                setTimeout(()=>{
                    link.click();
                },100)

            })

        },

        card_direct(event){
            this.card_direction = event.target.id
            setTimeout(()=>{
                QRCode.toCanvas(this.$refs.qrcode,`${window.location.origin}/${this.username}`, {errorCorrectionLevel: 'H'},error=>{
                    if (error) console.log(error);
                })
                QRCode.toCanvas(this.$refs.hori_qrcode,window.location.origin, {errorCorrectionLevel: 'H'},error=>{
                    if (error) console.log(error);
                })
            },0)

        },
        phone_clicked(){
            this.d_phone = this.$refs.c_phone.checked;
            if(!this.d_phone && !this.d_email){
                this.$refs.hori_qr_div.classList.add('ml-20')
            }else{
                this.$refs.hori_qr_div.classList.remove('ml-20')
            }
        },
        email_clicked(){
            this.d_email = this.$refs.c_email.checked;
            if(!this.d_phone && !this.d_email){
                this.$refs.hori_qr_div.classList.add('ml-20')
            }else{
                this.$refs.hori_qr_div.classList.remove('ml-20')
            }
        },
        bio_clicked(){
            this.d_bio = this.$refs.c_bio.checked;
            if(!this.d_bio){
                this.$refs.hori_name.classList.add('mt-4')
            }else{
                this.$refs.hori_name.classList.remove('mt-4')
            }
        },
        image_clicked(){
            this.d_image = this.$refs.c_image.checked;
            if(!this.d_image){
                this.$refs.hori_titles.classList.add('mt-4')
            }else{
                this.$refs.hori_titles.classList.remove('mt-4')
            }
        }
    },
    mounted() {
            fetch(this.image).then(res => {
                return res.blob();
            }).then(res => {
                this.imgSrc =  URL.createObjectURL(res);
            });

        QRCode.toCanvas(this.$refs.qrcode,window.location.origin, {errorCorrectionLevel: 'H'},error=>{
            if (error) console.log(error);
        })
        QRCode.toCanvas(this.$refs.hori_qrcode,window.location.origin, {errorCorrectionLevel: 'H'},error=>{
            if (error) console.log(error);
        })
    },
    props:[
        'username',
        'd_name',
        'email',
        'phone',
        'image',
        'bio'


    ]
}
</script>


